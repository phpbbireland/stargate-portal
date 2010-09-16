<?php
/**
*
* @package acp Stargate Portal
* @version $Id: acp_k_status.php 312 2009-11-23 02:51:12Z Michealo $
* @copyright (c) 2005-2009 Michael O'Toole aka michaelo
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package acp
*/

class acp_k_status
{
	var $u_action;
	var $parent_id = 0;

	function main($id, $mode)
	{
				
		global $db, $user, $auth, $template, $cache;
		global $config, $SID, $phpbb_root_path, $phpbb_admin_path, $phpEx;
	
		$message ='';
			
		$user->add_lang('acp/k_status');
		$this->tpl_name = 'acp_k_status';
		$this->page_title = 'ACP_STATUS_CONFIG';

		$form_key = 'acp_k_status';
		add_form_key($form_key);		
				
		$action = request_var('action', '');
		$mode	= request_var('mode', '');	
		
		$id = request_var('module', '');
		
		$submit = (isset($_POST['submit'])) ? true : false;		 
		
		$forum_id	= request_var('f', 0);		
		$forum_data = $errors = array();
		if ($submit && !check_form_key($form_key))
		{
			$submit = false;
			$mode = '';
			trigger_error($user->lang['FORM_INVALID']);
		}		
		
		$template->assign_vars(array(
			'U_EDIT'	=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_status&amp;mode=edit" . '&amp;module=' . $id,
			'U_DELETE'	=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_status&amp;mode=delete" . '&amp;module=' . $id,
			)
		);		
		
	
		switch ($mode)
		{
			case 'welcome': 
				if ($submit)
				{
					(int)$id     = request_var('id', 0); 
					$name	     = request_var('name', '');
					$author	     = request_var('author', '');
					$type	     = request_var('type', 0);
					$info        = request_var('info', '');
					$link        = request_var('link', '');
					$image       = request_var('image', '');
					$last_update = request_var('last_update', '');
				
					$mode='welcome';
					
					$message = 'Saving data... Pleas wait...';
				
					if ($name == '')
					{
						return;
					}

					if ($last_update == '')
					{
						$last_update = $today = date("D d M Y");						
					}
						
					$sql = "UPDATE " . K_STATUS_TABLE . " 
						SET
							id    = '$id', 
							type  = '" . $type . "',
							name  = '" . $name . "',
							author = '" . $author . "',
							info  = '" . $db->sql_escape($info) . "', 
							link  = '" . $db->sql_escape($link) . "', 
							image = '" . $db->sql_escape($image) . "', 
							last_update = '$last_update'
						WHERE id = $id";
					
					if (!$result = $db->sql_query($sql)) 
					{
						trigger_error($user->lang['ERROR_PORTAL_STATUS'] , '', __LINE__, __FILE__, $sql);
					}
					
					$template->assign_vars(array(
						'S_OPTION' => 'saved',
						'MESSAGE' => $message,
					));

					unset($submit);
					
					meta_refresh (1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_status&amp;mode=welcome");
					return;					
					
					
				}
				else
				{

					$template->assign_vars(array('S_OPTION' => 'welcome'));
					$sql = 'SELECT id, name, author, type, info, link, image, last_update
						FROM ' . K_STATUS_TABLE . '
						WHERE type = 0';
					$result = $db->sql_query($sql);
				
					$row = $db->sql_fetchrow($result);
	
					$id		= $row['id'];
					$name	= $row['name'];
					$author	= $row['author'];					
					$type	= $row['type'];
					$info	= $row['info'];
					$link	= $row['link'];
					$image	= $row['image'];
					$last_update = $row['last_update'];
				
					if ($last_update == '')
					{
						$last_update = $today = date("D d M Y");
					}

					$template->assign_vars(array(
						'S_ID'	        => $id,
						'S_NAME'	    => $name,
						'S_AUTHOR'	    => $author,						
						'S_TYPE'	    => $type,
						'S_INFO'        => $info,
						'S_LINK'        => $link,
						'S_IMAGE'       => $image,
						'S_LAST_UPDATE' => $last_update,
						'TITLE_EXPLAIN' => 'Welcome Message Editor',
						)
					);						

					$db->sql_freeresult($result);
				}
			break;

			case 'status': 

				$template->assign_vars(array('S_OPTION' => 'status'));
				$sql = 'SELECT id, name, author, type, info, link, image, last_update
					FROM ' . K_STATUS_TABLE . ' 
					WHERE type > 0';
				$result = $db->sql_query($sql);	
				
				while ($row = $db->sql_fetchrow($result))
				{
					if ($row['id'] != 0) // skip welcome block served elsewhere
					{
						$id		= $row['id'];
						$name	= $row['name'];
						$author	= $row['author'];
						$type	= $row['type'];
						$info	= $row['info'];
						$link	= $row['link'];
						$image	= $row['image'];
						$last_update = $row['last_update'];

						$template->assign_block_vars('status', array(
							'S_ID'	        => $id,
							'S_NAME'	    => $name,
							'S_AUTHOR'	    => $author,
							'S_TYPE'	    => $type,
							'S_INFO'        => $info,
							'S_LINK'        => $link,
							'S_IMAGE'       => $image,
							'S_LAST_UPDATE' => $last_update,
							)
						);						
					}
				}
				$db->sql_freeresult($result);				

			break;

			case 'blocks': 

				$template->assign_vars(array('S_OPTION' => 'status'));
				$sql = 'SELECT *
					FROM ' . K_STATUS_TABLE . ' 
					WHERE type = 1';
				$result = $db->sql_query($sql);	
				
				while ($row = $db->sql_fetchrow($result))
				{
					if ($row['id'] != 0) // skip welcome block served elsewhere
					{
						$id 	= $row['id'];
						$name	= $row['name'];
						$author	= $row['author'];						
						$type	= $row['type'];
						$info	= $row['info'];
						$link	= $row['link'];
						$image	= $row['image'];
						$last_update = $row['last_update'];

						$template->assign_block_vars('status', array(
							'S_ID'	        => $id,
							'S_NAME'	    => $name,
							'S_AUTHOR'	    => $author,							
							'S_TYPE'	    => $type,
							'S_INFO'        => $info,
							'S_LINK'        => $link,
							'S_IMAGE'       => $image,
							'S_LAST_UPDATE' => $last_update,
							)
						);						
					}
				}
				$db->sql_freeresult($result);				

			break;

			case 'themes': 

				$template->assign_vars(array('S_OPTION' => 'status'));
				$sql = 'SELECT *
					FROM ' . K_STATUS_TABLE . ' 
					WHERE type = 2';
				$result = $db->sql_query($sql);	
				
				while ($row = $db->sql_fetchrow($result))
				{
					if ($row['id'] != 0) // skip welcome block served elsewhere
					{
						$id = $row['id'];
						$name	= $row['name'];
						$author	= $row['author'];						
						$type	= $row['type'];
						$info	= $row['info'];
						$link	= $row['link'];
						$image	= $row['image'];
						$last_update = $row['last_update'];

						$template->assign_block_vars('status', array(
							'S_ID'	        => $id,
							'S_NAME'	    => $name,
							'S_AUTHOR'	    => $author,							
							'S_TYPE'	    => $type,
							'S_INFO'        => $info,
							'S_LINK'        => $link,
							'S_IMAGE'       => $image,
							'S_LAST_UPDATE' => $last_update,
							)
						);						
					}
				}
				$db->sql_freeresult($result);				
			break;

			case 'mods': 

				$template->assign_vars(array('S_OPTION' => 'status'));
				$sql = 'SELECT *
					FROM ' . K_STATUS_TABLE . ' 
					WHERE type = 3';
				$result = $db->sql_query($sql);	
				
				while ($row = $db->sql_fetchrow($result))
				{
					if ($row['id'] != 0) // skip welcome block served elsewhere
					{
						$id 	= $row['id'];
						$name	= $row['name'];
						$author = $row['author'];						
						$type	= $row['type'];
						$info	= $row['info'];
						$link	= $row['link'];
						$image	= $row['image'];
						$last_update = $row['last_update'];

						$template->assign_block_vars('status', array(
							'S_ID'	        => $id,
							'S_NAME'	    => $name,
							'S_AUTHOR'	    => $author,							
							'S_TYPE'	    => $type,
							'S_INFO'        => $info,
							'S_LINK'        => $link,
							'S_IMAGE'       => $image,
							'S_LAST_UPDATE' => $last_update,
							)
						);						
					}
				}
				$db->sql_freeresult($result);				

			break;

			case 'bugs': 

				$template->assign_vars(array('S_OPTION' => 'status'));
				$sql = 'SELECT *
					FROM ' . K_STATUS_TABLE . ' 
					WHERE type = 4';
				$result = $db->sql_query($sql);	
				
				while ($row = $db->sql_fetchrow($result))
				{
					if ($row['id'] != 0) // skip welcome block served elsewhere
					{
						$id		= $row['id'];
						$name	= $row['name'];
						$author	= $row['author'];						
						$type	= $row['type'];
						$info	= $row['info'];
						$link	= $row['link'];
						$image	= $row['image'];
						$last_update = $row['last_update'];

						$template->assign_block_vars('status', array(
							'S_ID'	        => $id,
							'S_NAME'	    => $name,
							'S_AUTHOR'	    => $author,							
							'S_TYPE'	    => $type,
							'S_INFO'        => $info,
							'S_LINK'        => $link,
							'S_IMAGE'       => $image,
							'S_LAST_UPDATE' => $last_update,
						));						
					}
				}
				$db->sql_freeresult($result);				

			break;

			case 'other': 

				$template->assign_vars(array('S_OPTION' => 'status'));
				$sql = 'SELECT *
					FROM ' . K_STATUS_TABLE . ' 
					WHERE type > 5';
				$result = $db->sql_query($sql);	
				
				while ($row = $db->sql_fetchrow($result))
				{
					if ($row['id'] != 0) // skip welcome block served elsewhere
					{
						$id		= $row['id'];
						$name	= $row['name'];
						$author	= $row['author'];						
						$type	= $row['type'];
						$info	= $row['info'];
						$link	= $row['link'];
						$image	= $row['image'];
						$last_update = $row['last_update'];

						$template->assign_block_vars('status', array(
							'S_ID'	        => $id,
							'S_NAME'	    => $name,
							'S_AUTHOR'	    => $author,							
							'S_TYPE'	    => $type,
							'S_INFO'        => $info,
							'S_LINK'        => $link,
							'S_IMAGE'       => $image,
							'S_LAST_UPDATE' => $last_update,
							)
						);						
					}
				}
				$db->sql_freeresult($result);

			break;

			case 'edit':

				if ($submit)
				{
					$id		     = request_var('id', 0); 
					$name	     = request_var('name', '');
					$author	     = request_var('author', '');
					$type	     = request_var('type', 0);
					$info        = request_var('info', '');
					$link        = request_var('link', '');
					$image       = request_var('image', '');
					$last_update = request_var('last_update', '');

					$mode='welcome';
					
					$message = 'Saving data... Pleas wait...';
				
					if ($name == '')
					{
						return;
					}

					if ($last_update == '')
					{
						$last_update = $today = date("D d M Y");
					}
						
					$sql = "UPDATE " . K_STATUS_TABLE . " 
						SET
							id    = '$id', 
							type  = '" . $type . "',
							name  = '" . $name . "', 
							author = '" . $author . "', 
							info  = '" . $db->sql_escape($info) . "', 
							link  = '" . $db->sql_escape($link) . "', 
							image = '" . $db->sql_escape($image) . "', 
							last_update = '$last_update'
						WHERE id = $id";
					
					if (!$result = $db->sql_query($sql))
					{
						trigger_error($user->lang['ERROR_PORTAL_STATUS'] , '', __LINE__, __FILE__, $sql);
					}
					
					$template->assign_vars(array(
						'S_OPTION' => 'saved',
						'MESSAGE' => $message,
					));
					
					unset($submit);
					
					meta_refresh(1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_status&amp;mode=status");
					return;					
				}
				else
				{
					$sql = 'SELECT id, name, author, type, info, link, image, last_update
						FROM ' . K_STATUS_TABLE . ' 
						WHERE id = ' . $id . '';

					if (!$result = $db->sql_query($sql)) 
					{
						trigger_error($user->lang['ERROR_PORTAL_STATUS'] , '', __LINE__, __FILE__, $sql);
					}
				
					while ($row = $db->sql_fetchrow($result))
					{
						$id		= $row['id'];
						$name	= $row['name'];
						$author	= $row['author'];						
						$type	= $row['type'];
						$info	= $row['info'];
						$link	= $row['link'];
						$image	= $row['image'];
						$last_update = $row['last_update'];
									
						$template->assign_vars(array(
							'S_ID'	        => $id,
							'S_NAME'	    => $name,
							'S_AUTHOR'      => $author,							
							'S_TYPE'	    => $type,
							'S_INFO'        => $info,
							'S_LINK'        => $link,
							'S_IMAGE'       => $image,
							'S_LAST_UPDATE' => $last_update,
							'TITLE_2' => 'Styles',
							)
						);					
					}
					$db->sql_freeresult($result);
				
					$template->assign_vars(array('S_OPTION' => 'edit'));
				}
				
			break;

			case 'add':
			{
				if ($submit)
				{
					//(int)$id     = request_var('id', 0); 
					$name	     = request_var('name', '');
					$author	     = request_var('author', '');
					$type	     = request_var('type', 0);
					$info        = request_var('info', '');
					$link        = request_var('link', '');
					$image       = request_var('image', '');
					$last_update = request_var('last_update', '');

					if ($last_update == '')
					{
						$last_update = $today = date("D d M Y");
					}
				
					if ($name == '')
					{
						return;
					}
					
					$sql = "INSERT INTO " . K_STATUS_TABLE . " (name, type, info, author, link, image, last_update) VALUES ('$name', '$type', '$info', '$author', '$link', '$image', '$last_update')";
					
					$result = $db->sql_query($sql);
					
					$template->assign_vars(array(
						'S_OPTION' => 'added',
						'MESSAGE' => 'Status block added',
					));
					
					unset($submit);
					
					meta_refresh (1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_status&amp;mode=add");
				}
				else
				{
					$template->assign_vars(array(
						'S_OPTION' => 'add',
					));				
				}
				break;
			}			
			case 'delete':
			{
				if (!$id)
				{
					trigger_error($user->lang['MUST_SELECT_VALID_STATUS_DATA'] . adm_back_link($this->u_action), E_USER_WARNING);
				}
				
				if (confirm_box(true))
				{
					$sql = 'DELETE FROM ' . K_STATUS_TABLE . "
						WHERE id = $id";
					$db->sql_query($sql);
				}
				else
				{ 
					confirm_box(false, $user->lang['CONFIRM_OPERATION_STATUS'], build_hidden_fields(array(
						'i'			=> 'k_status',
						'mode'		=> $mode,
						'title'		=> $name,
						'action'	=> 'delete',
					)));
				}				
				
				$template->assign_vars(array(
					'S_OPTION' => 'delete',
					'MESSAGE' => 'Status Block Deleted!</font><br />',
				));
				
				meta_refresh(1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_status&amp;mode=status");

				break;				
			}
			
			case 'default': 
							$template->assign_vars(array('S_OPTION' => 'status'));
			break;
		}

	}				
}

?>