<?php
/**
*
* @package acp Stargate Portal
* @version $Id: acp_k_blocks.php 312 2009-01-02 02:51:12Z Michealo $
* @copyright (c) 2007 Michael O'Toole aka michaelo
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

class acp_k_blocks
{
	var $u_action = '';

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache;
		global $config, $SID, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$user->add_lang('acp/k_blocks');
		$this->tpl_name = 'acp_k_blocks';
		$this->page_title = 'ACP_BLOCKS';

		$form_key = 'acp_k_blocks';
		add_form_key($form_key);

		$action	= request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;

		$forum_id	= request_var('f', 0);
		$forum_data = $errors = array();
		if ($submit && !check_form_key($form_key))
		{
			$submit = false;
			$mode = '';
			trigger_error($user->lang['FORM_INVALID']);
		}

		$block='';
		$block	= request_var('id', '');
		//$groupid = request_var('group_id', '');

		// get title for block whos id = $block //

		//$mini_mod_id = get_module_id($block);  

		$template->assign_vars(array(
			'U_EDIT2'			=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_blocks&amp;mode=edit" . '&amp;block=' . $block,
			'U_UP'				=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_blocks&amp;mode=up" . '&amp;block=' . $block,
			'U_DOWN'			=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_blocks&amp;mode=down" . '&amp;block=' . $block,
			'U_BACK'			=> $this->u_action,
			'U_DELETE'			=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_blocks&amp;mode=delete" . '&amp;block=' . $block,
			'U_SET_VARS_W'		=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_modules&amp;mode=welcome" . '&amp;block=' . $block,
			'U_SET_VARS'		=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_vars&amp;mode=config" . '&amp;block=' . $block,
			'U_LINK_MINIMOD'	=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_modules&mode=edit" . '&amp;module=' . $block 
		));

		// Set up general vars
		$mode	= request_var('mode', '');
		$block	= request_var('block', '');

		$u_action = "{$phpbb_admin_path}index.$phpEx$SID&amp;i=$id&amp;mode=$mode"; // ? is this needed ? //

		switch ($mode)
		{
			case 'up':
			case 'down':

			{
				$to_move;
				$move_to;

				// get current block data//
				$sql = "SELECT id, ndx, position FROM " . K_BLOCKS_TABLE . "
					WHERE id = $block LIMIT 1";

				if(!$result = $db->sql_query($sql))
					trigger_error('Error! Could not get Blocks data from table, ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);

				$row = $db->sql_fetchrow($result);
				$to_move['id'] = $row['id'];
				$to_move['ndx']  = $temp = $row['ndx'];

				$position = $row['position'];

				if($mode == 'up')
				{
					$temp = $temp - 1;
				}
				if($mode == 'down')
				{
					$temp = $temp + 1;
				}				

				// get move_to block data//
				$sql = "SELECT id, ndx, position FROM " . K_BLOCKS_TABLE . "
					WHERE ndx =  $temp AND position = '$position' LIMIT 1";

				if(!$result = $db->sql_query($sql))
					trigger_error('Error! '. $user->lang['BLOCK_MOVE_ERROR'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);

				$row = $db->sql_fetchrow($result);

				$move_to['id'] = $row['id'];
				$move_to['ndx']  = $row['ndx'];

				if($move_to['ndx'] != $temp )
					trigger_error('Error! '. $user->lang['BLOCK_MOVE_ERROR'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);

				if($mode == 'up')
				{
					$sql = "UPDATE " . K_BLOCKS_TABLE . " SET ndx = " . $to_move['ndx'] . " WHERE id = " . $move_to['id'];
					if(!$result = $db->sql_query($sql))
						trigger_error('Error! '. $user->lang['BLOCK_MOVE_ERROR'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);

					$sql = "UPDATE " . K_BLOCKS_TABLE . " SET ndx = " . $move_to['ndx'] . " WHERE id = " . $to_move['id'];
					if(!$result = $db->sql_query($sql))
						trigger_error('Error! '. $user->lang['BLOCK_MOVE_ERROR'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
				}
				if($mode == 'down')
				{
					$sql = "UPDATE " . K_BLOCKS_TABLE . " SET ndx = " . $move_to['ndx'] . " WHERE id = " . $to_move['id'];
					if(!$result = $db->sql_query($sql))
						trigger_error('Error! '. $user->lang['BLOCK_MOVE_ERROR'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);

					$sql = "UPDATE " . K_BLOCKS_TABLE . " SET ndx = " . $to_move['ndx'] . " WHERE id = " . $move_to['id'];
					if(!$result = $db->sql_query($sql))
						trigger_error('Error! '. $user->lang['BLOCK_MOVE_ERROR'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
				}

				$template->assign_vars(array(
					'L_BLOCK_REPORT'	=> $user->lang['BLOCK_UPDATING'],
				));

				meta_refresh(1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_blocks&amp;mode=manage");

				break;
			}

			case 'add':
			{
				if($submit)
				{
					if(request_var('html_file_name','') == "" OR request_var('title','') == "")
					{
						$message = 'You have not entered the correct data'; //$message = $user->lang['MISSING_DATA'];
						$template->assign_vars(array(
							'L_BLOCK_REPORT' => 'Required data is missing...<br />',
						));

						meta_refresh(5, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_blocks&amp;mode=add");
						return;
					}

					//$id		= request_var('m_id']; // auto assigned
					//$ndx		= request_var('ndx'];  // we calculate this ?
					$title		= utf8_normalize_nfc(request_var('title', '', true));
					$position	= request_var('position', '');
					$active 	= request_var('active', '');
					$type		= request_var('type', '');
					$scroll  	= request_var('scroll', '');
					$view_by	= request_var('view_by', '');
					$html_file_name		= request_var('html_file_name', '');
					$img_file_name		= request_var('img_file_name', '');
					$has_vars			= request_var('has_vars', '');
					$minimod_based		= request_var('minimod_based', '');
					$mod_block_id		= request_var('mod_block_id', '');

					if($img_file_name == '') $img_file_name = 'none';
					if($minimod_based == 0) $mod_block_id = '0';

					$ndx = get_next_ndx($position);		// get the next ndx to use for this position	//

					$sql_array = array(
						'ndx'				=> $ndx,
						'title'				=> $title,
						'active'			=> $active,
						'html_file_name'	=> $html_file_name,
						'img_file_name'		=> $img_file_name,
						'position'			=> $position,
						'view_by'			=> $view_by,
						'scroll'			=> $scroll,
						'has_vars'			=> $has_vars,	
						'minimod_based'		=> $minimod_based,
						'mod_block_id'		=> $mod_block_id,
		           );

	               if(!$db->sql_query('INSERT INTO ' . K_BLOCKS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_array)))
					{
						trigger_error('Error! Could not add block. ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
					}
					else
					{
						$message = $user->lang['BLOCK_ADDED'];

						$template->assign_vars(array(
							'L_BLOCK_REPORT' => $title . $message . '</font><br />',
						));
					}

					$cache->destroy('sql', K_BLOCKS_TABLE);

					meta_refresh(2, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_blocks&amp;mode=manage");
					return;
				}
				else
				{

					// get all groups and fill array //
					get_all_groups();
					get_all_minimods();

					//Get all installed blocks//
					$data='';
					$c = 0;
					$sql = 'SELECT * FROM ' . K_BLOCKS_TABLE;
					if( $result = $db->sql_query($sql) )
					{
						while ( $row = $db->sql_fetchrow($result) )
						{
							$data .= $row['id'];
							$data .=' ';
							$c++;
						}
					}

					$dirslist='none ';
					$dirs = dir('./../styles/portal_common/template/blocks');
					while ($file = $dirs->read())
					{
						// small bug? in srtpos stripos...  If the needle is found in the fist character it appears to return 0 which will result in false (if) so 
						if(stripos($file, "lock_", 1) && !stripos($file, ".bak"))
							$dirslist .= "$file ";
						/*
						if (eregi("html", $file) && eregi("block", $file) && !eregi("bak", $file) && !eregi("blocks", $file))
						{
							$dirslist .= "$file ";
						}
						*/
					}
					closedir($dirs->handle);
					$dirslist = explode(" ", $dirslist);
					sort($dirslist);
					for ( $i=0; $i < sizeof($dirslist); $i++ )
					{
						if($dirslist[$i] != '')
							$template->assign_block_vars('html_file_name', array('S_BLOCK_FILE_HTML' => $dirslist[$i]));
					}
					$dirslist='';

					$dirslist='none ';
					$dirs = dir('./../images/block_images');

					while ($file = $dirs->read())
					{
						if(stripos($file, ".gif") ||  stripos($file, ".png"))
							$dirslist .= "$file ";
					}

					closedir($dirs->handle);
					$dirslist = explode(" ", $dirslist);
					sort($dirslist);

					for ( $i=0; $i < sizeof($dirslist); $i++ )
					{
						if($dirslist[$i] != '')
							$template->assign_block_vars('img_file_name', array('S_BLOCK_FILE_I' => $dirslist[$i]));
					}
					$dirslist='';

					$template->assign_vars(array('S_OPTIONS' => 'Add'));
				}
				break;
			}

			case 'edit':
			{
				if($submit)
				{
					$id				= request_var('id', '');
					$ndx			= request_var('ndx', '');
					$title			= utf8_normalize_nfc(request_var('title', '', true));
					$position		= request_var('position', '');
					$type			= request_var('type', '');
					$active 		= request_var('active', '');
					$view_by		= request_var('view_by', '');
					$scroll			= request_var('scroll', '');
					$has_vars		= request_var('has_vars', '');
					$minimod_based	= request_var('minimod_based', '');
					$mod_block_id	= request_var('mod_block_id', '');
					$html_file_name	= request_var('html_file_name', '');
					$img_file_name	= request_var('img_file_name', ''); 

					if($type == 1)
						$type = 'H';
					else
						$type = 'B';

					if($view_by == '') $view_by = 0;

					if($img_file_name == '') $img_file_name = 'none';
					if($minimod_based == 0) $mod_block_id = '0';

					// get the current block position //
					$current_position = get_current_position($id);

					// if moving block position (column) //
					if($current_position != $position)
						$ndx = get_next_ndx($position);

					$sql = "UPDATE " . K_BLOCKS_TABLE . "
					SET
						ndx = '$ndx',
						title = '$title',
						position = '$position',
						active = '$active',
						type = '$type',
						html_file_name = '$html_file_name',
						img_file_name = '$img_file_name',
						view_by = '$view_by',
						scroll = '$scroll',
						has_vars = '$has_vars',
						minimod_based = '$minimod_based',
						mod_block_id = '$mod_block_id'
				 	WHERE id = '$id'";

					if(!$result = $db->sql_query($sql))
						trigger_error('Error! Could not edit block. ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);

					$template->assign_vars(array(
						'L_BLOCK_REPORT'	=> 'Block has been edited successfully! Returning...</font><br />',
					));

					$cache->destroy('sql', K_BLOCKS_TABLE);

					meta_refresh(2, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_blocks&amp;mode=manage");

					return;
				}

				// get all available html files, note.. we search the admin styles folder //

				$dirslist='none ';
				$dirs = dir('./../styles/portal_common/template/blocks');

				while ($file = $dirs->read())
				{
					// small bug? in srtpos stripos...  If the needle is found in the fist character it appears to return 0 which will result in false (if) so 
					if(stripos($file, "lock_") && !stripos($file, ".bak"))
					{
						$dirslist .= "$file ";
					}
				}
				closedir($dirs->handle);

				$dirslist = explode(" ", $dirslist);
				sort($dirslist);

				for ( $i=0; $i < sizeof($dirslist); $i++ )
				{
					if($dirslist[$i] != '')
						$template->assign_block_vars('html_file_name', array('S_BLOCK_FILE_HTML' => $dirslist[$i]));
				}

				// get all available block images //

				$dirslist='none ';
				$dirs = dir('./../images/block_images');
				while ($file = $dirs->read())
				{
					if(stripos($file, ".gif") || stripos($file, ".png") && stripos($file ,"logo_"))
						$dirslist .= "$file ";
				}
				closedir($dirs->handle);

				$dirslist = explode(" ", $dirslist);
				sort($dirslist);

				for ( $i=0; $i < sizeof($dirslist); $i++ )
				{
					if($dirslist[$i] != '')
						$template->assign_block_vars('img_file_name', array('S_BLOCK_FILE_I' => $dirslist[$i]));
				}
				$dirslist='';

				$template->assign_vars(array('S_OPTIONS' => 'Add'));

				$sql = 'SELECT * FROM ' . K_BLOCKS_TABLE . ' WHERE id=' . $block;
				if( $result = $db->sql_query($sql) )
				{
					$row = $db->sql_fetchrow($result);
				}

				if($row['img_file_name'] == '') $row['img_file_name'] = 'none';

				$template->assign_vars(array(
					'S_ID'			=> $row['id'],
					'S_NDX'			=> $row['ndx'],
					'S_TITLE'		=> $row['title'],
					'S_POSITION'	=> $row['position'],
					'S_ACTIVE'		=> $row['active'],
					'S_TYPE'		=> $row['type'],
					'S_FNAME_H'		=> $row['html_file_name'],
					'S_FNAME_I'		=> $row['img_file_name'],
					'S_VIEW_BY'		=> $row['view_by'],
					'S_SCROLL'		=> $row['scroll'],
					'S_HAS_VARS'	=> $row['has_vars'],
					'S_MINIMOD_BASED'	=> $row['minimod_based'],
					'S_MOD_BLOCK_ID'	=> $row['mod_block_id']
				)); 

				// get all groups and fill array //
				get_all_groups();
				get_all_minimods();

				$db->sql_freeresult($result);

				$template->assign_vars(array(
					'S_OPTIONS'	=> 'Edit'
				));

				break;
			}

			case 'delete':
			{
				if (!$block)
				{
					trigger_error($user->lang['MUST_SELECT_VALID_BLOCK_DATA'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				if (confirm_box(true))
				{
					$sql = 'SELECT title, id
						FROM ' . K_BLOCKS_TABLE . '
						WHERE id = ' . $block;
					$result = $db->sql_query($sql);

					$title = (string) $db->sql_fetchfield('title');
					$id = (int) $db->sql_fetchfield('id');
					$db->sql_freeresult($result);
					$title .= ' Block ';

					$sql = 'DELETE FROM ' . K_BLOCKS_TABLE . "
						WHERE id = $block";
					$db->sql_query($sql);

					$template->assign_vars(array(
						'L_BLOCK_REPORT' => $title . 'Deleted!</font><br />',
					));

					$cache->destroy('sql', K_BLOCKS_TABLE);

					meta_refresh(1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_blocks&amp;mode=manage");

					break;

				}
				else
				{
					confirm_box(false, $user->lang['CONFIRM_OPERATION_BLOCKS'], build_hidden_fields(array(
						'i'			=> $id,
						'mode'		=> $mode,
						'action'	=> 'delete',
					)));
				}

				$template->assign_vars(array('L_BLOCK_REPORT' => 'Action Cancelled...'));

				meta_refresh(1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_blocks&amp;mode=manage");

				break;
			}

			case 'reindex':
			{
				$index_no = 1;

				if (confirm_box(true))
				{
					$thispos = $newpos = '';
					$list = array();

					$sql = 'SELECT * FROM ' . K_BLOCKS_TABLE . ' ORDER by position, ndx';

					if( $result = $db->sql_query($sql) )
					{
						while($row = $db->sql_fetchrow($result))
						{
							$thispos = $row['position'];
							if($thispos == $newpos)
								$index_no++;
							else
								$index_no = 1;

							$sql = "UPDATE " . K_BLOCKS_TABLE . " SET ndx = '" . $index_no . "' WHERE id = " . $row['id'];

							//reset ndx to 1 when position changes
							$newpos = $row['position'];

							$results = $db->sql_query($sql);

							if(!$results)
								trigger_error('Error! re-indexing blocks, ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
						}
					}

					$db->sql_freeresult($result);

					$template->assign_vars(array(
						'L_BLOCK_REPORT' => $user->lang['BLOCKS_REINDEXED'],
					));

					$cache->destroy('sql', K_BLOCKS_TABLE);

					meta_refresh(1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_blocks&amp;mode=manage");

					break;

				}
				else
				{
					confirm_box(false, $user->lang['CONFIRM_OPERATION_BLOCKS_REINDEX'], build_hidden_fields(array(
						'i'			=> $id,
						'mode'		=> $mode,
						'action'	=> 'reindex',
					)));
				}

				$template->assign_vars(array('L_BLOCK_REPORT' => 'Action Cancelled...'));

				meta_refresh(1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_blocks&amp;mode=manage");

				break;
			}

			case 'default':

			case 'tools':
							$template->assign_vars(array('S_OPTIONS' => 'Tools'));
							break; 	//default: trigger_error('NO_MODE');
			case 'L':
			case 'C':
			case 'R':
			case '1':
			case '2':
			case '3':
			case 'manage':
			{
				if($mode != 'manage')
					$sql = "SELECT * FROM " . K_BLOCKS_TABLE . " WHERE position = '$mode' ORDER by ndx, type";
				else
					$sql = 'SELECT * FROM ' . K_BLOCKS_TABLE . ' ORDER by position, ndx';
					//$sql = 'SELECT * FROM ' . K_BLOCKS_TABLE . ' ORDER by active DESC, type, ndx, id';

				if( $result = $db->sql_query($sql) )
				{
					while ( $row = $db->sql_fetchrow($result) )
					{
						if($row['img_file_name'] == '') $row['img_file_name'] = 'none';

						$template->assign_block_vars('bdata', array(
						'S_ID' 				=> $row['id'],
						'S_NDX'				=> $row['ndx'],
						'S_TITLE'			=> $row['title'],
						'S_POSITION'		=> $row['position'],
						'S_ACTIVE'			=> $row['active'],
						'S_TYPE'			=> $row['type'],
						'S_FNAME_H'			=> $row['html_file_name'],
						'S_FNAME_I'			=> $row['img_file_name'],
						'S_VIEW_BY'	 		=> which_group($row['view_by']),
						'S_SCROLL'			=> $row['scroll'],
						'S_HAS_VARS'		=> $row['has_vars'],
						'S_MINIMOD_BASED'	=> $row['minimod_based'],
						'S_MOD_BLOCK_ID'	=> $row['mod_block_id'],
						'S_BLOCK'			=> ($row['id'] == $block) ? $block : '.....'
						));
					}
 
					$db->sql_freeresult($result);
				}

				$template->assign_vars(array(
					'S_OPTIONS'	=> 'Manage',
				));

				break;
			}
		}

		$template->assign_vars(array('U_ACTION'		=> $u_action));
	}
}


function get_next_ndx($pos)
{
	global $db;

	$sql = "SELECT * FROM " . K_BLOCKS_TABLE . " WHERE position = '$pos' ORDER by ndx DESC";
	if( $result = $db->sql_query($sql) )
	{
		$row = $db->sql_fetchrow($result);		// just get last block ndx details	//
		$ndx = $row['ndx'];						// only need last ndx returned		//
		$ndx = $ndx + 1; 						// add 1 to index 					//
		return($ndx);
	}
}

function get_current_position($my_id)
{
	global $db;

	$sql = "SELECT position FROM " . K_BLOCKS_TABLE . " WHERE id = '$my_id' ";
	if( $result = $db->sql_query($sql) )
	{
		$row = $db->sql_fetchrow($result);		
		$position = $row['position'];

		return($position);
	}
	return(-1);
}

/*
function get_module_id($block)
{
echo '> '; echo $block;

	if($block == '')
		return;

	global $db;

	$sql = "SELECT mod_id FROM " . K_MODULES_TABLE . " WHERE mod_block_id = '$block' ";
	if( $result = $db->sql_query($sql) )
	{
		$row = $db->sql_fetchrow($result);		
		return($row['mod_block_id']);
	}
	return(-1);
}
*/

function resync_ndx_on_delete($id)
{
	// outstanding... we need to resync ndx on delete and add ... might also add a swap to make things faster...
}

function get_all_groups()
{
	global $db, $template;

	// Get us all the groups
	$sql = 'SELECT group_id, group_name
		FROM ' . GROUPS_TABLE . '
		ORDER BY group_id ASC, group_name';
	$result = $db->sql_query($sql);

	// backward compatability, set up group zero //
	$template->assign_block_vars('groups', array(
		'GROUP_NAME'	=> 'None',
		'GROUP_ID'		=> 0,
		)
	);

	while ($row = $db->sql_fetchrow($result))
	{
		$group_id = $row['group_id'];
		$group_name = $row['group_name'];

		$template->assign_block_vars('groups', array(
			'GROUP_NAME'	=> $group_name,
			'GROUP_ID'		=> $group_id,
			)
		);
	}
	$db->sql_freeresult($result);
}

function which_group($id)
{
	global $db, $template;

	// Get us all the groups
	$sql = 'SELECT group_name
		FROM ' . GROUPS_TABLE . '
		WHERE group_id = ' . $id;

	$result = $db->sql_query($sql);

	$name = $db->sql_fetchfield('group_name');

	$db->sql_freeresult($result);

	//????//$name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");

	if($name == '')
		return('None');
	else
		return ($name);
}


function get_all_minimods()
{
	global $db, $template;

	// Get all minimods for selection
	$sql = 'SELECT mod_id, mod_name
		FROM ' . K_MODULES_TABLE . '
		ORDER BY mod_id ASC'; 
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$mod_id = $row['mod_id'];
		$mod_name = $row['mod_name'];

		$template->assign_block_vars('minimods', array(
			'MINIMOD_NAME'	=> $mod_name,
			'MINIMOD_ID'	=> $mod_id,
			)
		);
	}
	$db->sql_freeresult($result);
}
?>