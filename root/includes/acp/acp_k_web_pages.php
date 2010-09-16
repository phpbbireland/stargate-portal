<?php
/**
*
* @package acp Stargate Portal
* @version $Id: acp_k_web_pages.php 305 2009-01-01 16:03:23Z Michealo $
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

class acp_k_web_pages
{
	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache;
		global $config, $SID, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		include($phpbb_root_path . 'includes/sgp_functions.'. $phpEx);
	
		$message ='';
		$search_message = '';
		$found = 0;
			
		$user->add_lang('acp/k_web_pages');
		$this->tpl_name = 'acp_k_web_pages';
		$this->page_title = 'ACP_K_WEB_PAGES';

		$form_key = 'acp_k_web_pages';
		add_form_key($form_key);		
				
		$action = request_var('action', '');
		$mode	= request_var('mode', '');

		$id = request_var('module', '');

		$submit = (isset($_POST['submit'])) ? true : false;
		$add	= (isset($_POST['add'])) ? true : false;
		
		$forum_id	= request_var('f', 0);		
		$forum_data = $errors = array();

		if ($submit && !check_form_key($form_key))
		{
			$submit = false;
			trigger_error('Error!'. $user->lang['FORM_INVALID'] . ' see ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
		}

		$template->assign_vars(array(
			'U_EDIT'	=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_web_pages&amp;mode=edit&amp;module=" . $id,
			'U_DELETE'	=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_web_pages&amp;mode=delete&amp;module=" . $id,
			)
		);


		$last_updated	= request_var('last_updated', '');

		if ($last_updated == '')
		{
			$last_updated = $today = date("D d M Y");
		}
		
		switch(request_var('page_type', ''))
		{
			case 'H':
					$template->assign_vars(array(
						'S_OPTION'		=> 'add',
						'S_SELECT'		=> 'head',
						'S_PAGE_TYPE'	=> 'H',
						'S_LAST_UPDATED'	=> $last_updated
					));
			break;
			case 'B':
					$template->assign_vars(array(
						'S_OPTION'	=> 'add',
						'S_SELECT'	=> 'body',
						'S_PAGE_TYPE'	=> 'B',
						'S_LAST_UPDATED'	=> $last_updated
				));
			break;
			case 'F':
					$template->assign_vars(array(
						'S_OPTION'	=> 'add',
						'S_SELECT'	=> 'foot',
						'S_PAGE_TYPE'	=> 'F',
						'S_LAST_UPDATED'	=> $last_updated
					));
			break;
			case 'P':
					$template->assign_vars(array(
						'S_OPTION'	=> 'add',
						'S_SELECT'	=> 'foot',
						'S_PAGE_TYPE'	=> 'P',
						'S_LAST_UPDATED'	=> $last_updated
					));
			break;
			default:
		}

		s_get_vars();

		switch ($mode)
		{
			case 'edit':
			{
				if ($submit)
				{
					(int)$id		= request_var('id', '');
					$active			= request_var('active', '');
					$page_name		= utf8_normalize_nfc(request_var('page_name', '', true));
					$page_title		= utf8_normalize_nfc(request_var('page_title', '', true));
					$page_desc		= utf8_normalize_nfc(request_var('page_desc', '', true));
					$page_meta		= utf8_normalize_nfc(request_var('page_meta', '', true));
					$page_extn		= utf8_normalize_nfc(request_var('page_extn', '', true));
					$external_file	= utf8_normalize_nfc(request_var('external_file', '', true));
					$page_type		= request_var('page_type', '');
					$head			= utf8_normalize_nfc(request_var('head', '', true));
					$body			= utf8_normalize_nfc(request_var('body', '', true));
					$foot			= utf8_normalize_nfc(request_var('foot', '', true));
					$last_updated	= utf8_normalize_nfc(request_var('last_updated', '', true));

					if ($head == '')
					{
						$head = 0;
					}
					if ($foot == '')
					{
						$foot = 0;
					}
					if ($page_extn == '')
					{
						$page_extn = 0;
					}

					//$body = process_for_vars($body, true);

					$message = 'Saving data... Please wait...';
				
					//if ($page_name == '') return;

					if ($last_updated == '' || $last_updated == '0')
					{
						$last_updated = $today = date("D d M Y");
					}

					$sql = "UPDATE " . K_WEB_PAGES_TABLE . " 
						SET
							active			= '" . $active . "',
							page_type		= '" . $page_type . "',
							page_name		= '" . $db->sql_escape($page_name) . "',
							page_title		= '" . $db->sql_escape($page_title) . "',
							page_desc		= '" . $db->sql_escape($page_desc) . "',
							page_meta		= '" . $db->sql_escape($page_meta) . "',
							page_extn		= '" . $db->sql_escape($page_extn) . "',
							external_file	= '" . $db->sql_escape($external_file) . "',
							head			= '" . $head . "',
							foot			= '" . $foot . "',
							body			= '" . $db->sql_escape($body) . "',
							last_updated	= '" . $db->sql_escape($last_updated) . "'
						WHERE id = $id LIMIT 1";
					
					if (!$result = $db->sql_query($sql))
					{
						trigger_error($user->lang['ERROR_PORTAL_WEB_TABLE'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
					}
					
					$template->assign_vars(array(
						'S_OPTION'	=> 'saved',
						'MESSAGE'	=> $message,
						'U_BACK'	=> $this->u_action,
					));
					
					unset($submit);
					
					meta_refresh (1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_web_pages&amp;mode=all");
					return;	
				}
				else
				{
					$sql = "SELECT * FROM " . K_WEB_PAGES_TABLE . " WHERE id =  '" . $id . "'";
					if (!$result = $db->sql_query($sql)) 
					{
						trigger_error($user->lang['ERROR_PORTAL_WEB_TABLE'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
					}

					$row = $db->sql_fetchrow($result);
					
					$mid			= $row['id'];
					$active			= $row['active'];
					$page_name		= $row['page_name'];
					$page_title		= $row['page_title'];
					$page_desc		= $row['page_desc'];
					$page_meta		= $row['page_meta'];
					$page_extn		= $row['page_extn'];
					$external_file	= $row['external_file'];
					$page_type		= $row['page_type'];
					$head			= $row['head'];
					$body			= $row['body'];
					$foot			= $row['foot'];
					$last_updated	= $row['last_updated'];

					// if there is no date for last update use todays date // 
					if ($last_updated == '')
					{
						$last_updated = $today = date("D d M Y");
					}

					// process html for var and replace if found //
					//$body = process_for_vars($body, false);

					$template->assign_block_vars('edit', array(
						'S_ID'				=> $mid,
						'S_ACTIVE'			=> $active,
						'S_PAGE_NAME'		=> $page_name,
						'S_PAGE_TITLE'		=> $page_title,
						'S_PAGE_DESC'		=> $page_desc,
						'S_PAGE_META'		=> $page_meta,
						'S_PAGE_EXTN'		=> $page_extn,
						'S_EXTERNAL_FILE'	=> $external_file,
						'S_PAGE_TYPE'		=> $page_type,
						'S_HEAD'			=> $head,
						'S_BODY'			=> $body,
						'S_FOOT'			=> $foot,
						'S_LAST_UPDATED'	=> $last_updated
					));

					$template->assign_vars(array(
						'S_OPTION'		=> 'edit',
					));

					get_headers_and_footers($head, $foot);
				}
				break;
			}
			case 'add':

				get_headers_and_footers('H', 'F');

				if ($submit)
				{
					$active			= request_var('active', '');
					$page_name		= utf8_normalize_nfc(request_var('page_name', '', true));
					$page_title		= utf8_normalize_nfc(request_var('page_title', '', true));
					$page_desc		= utf8_normalize_nfc(request_var('page_desc', '', true));
					$page_meta		= utf8_normalize_nfc(request_var('page_meta', '', true));
					$page_extn		= utf8_normalize_nfc(request_var('page_extn', '', true));
					$external_file	= utf8_normalize_nfc(request_var('external_file', '', true));
					$page_type		= request_var('page_type', '');
					$head			= utf8_normalize_nfc(request_var('head', '', true));
					$body			= utf8_normalize_nfc(request_var('body', '', true));
					$foot			= utf8_normalize_nfc(request_var('foot', '', true));
					$last_updated	= utf8_normalize_nfc(request_var('last_updated', '', true));

					if ($head == '')
					{
						$head = 0;
					}
					if ($foot == '')
					{
						$foot = 0;
					}

					if ($page_name == '')
					{
						return;
					}

					$sql = "INSERT INTO " . K_WEB_PAGES_TABLE . " (active, page_name, page_title, page_desc, page_meta, page_extn, page_type, body, head, foot, last_updated, external_file) VALUES ('$active', '$page_name', '$page_title', '$page_desc', '$page_meta', '$page_extn', '$page_type', '$body', '$head', '$foot', '$last_updated', '$external_file')";
					$result = $db->sql_query($sql);
					
					$template->assign_vars(array(
						'S_OPTION' => 'new',
						'MESSAGE' => 'Page added',
					));

					unset($submit);
					$cache->destroy('sql', K_WEB_PAGES_TABLE);
					meta_refresh(1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_web_pages&amp;mode=all");
				}
			break;

			case 'delete':
			{
				if (!$id)
				{
					trigger_error($user->lang['MUST_SELECT_VALID_MODULE_DATA'] . adm_back_link($this->u_action), E_USER_WARNING);
				}
		
				if (confirm_box(true))
				{
					$sql = 'DELETE FROM ' . K_WEB_PAGES_TABLE . "
						WHERE id = $id";
					$db->sql_query($sql);

					$template->assign_vars(array(
						'S_OPTION'	=> 'delete',
						'MESSAGE'	=> 'Module Block Deleted!</font><br />',
					));

					$cache->destroy('sql', K_WEB_PAGES_TABLE);
					meta_refresh(1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_web_pages&amp;mode=all");
					return;
				}
				else
				{ 
					confirm_box(false, $user->lang['CONFIRM_OPERATION_MODULE'], build_hidden_fields(array(
						'i'			=> 'k_web_pages',
						'mode'		=> $mode,
						'action'	=> 'delete',
					)));
				}				
				break;
			}
			case 'all':
			case 'body':
			case 'head':
			case 'foot':
			case 'portal':
			{
				// use switch?
				if ($mode == 'all')
				{
					$sql = "SELECT * FROM " . K_WEB_PAGES_TABLE . ' ORDER BY page_type ASC';
				}
				if ($mode == 'body')
				{
					$sql = "SELECT * FROM " . K_WEB_PAGES_TABLE . ' WHERE page_type LIKE ' . "'B'" . ' ORDER BY page_name ASC';
				}
				if ($mode == 'head')
				{
					$sql = "SELECT * FROM " . K_WEB_PAGES_TABLE . ' WHERE page_type LIKE ' . "'H'" . ' ORDER BY page_name ASC';
				}
				if ($mode == 'foot')
				{
					$sql = "SELECT * FROM " . K_WEB_PAGES_TABLE . ' WHERE page_type LIKE ' . "'F'" . ' ORDER BY page_name ASC';
				}
				if ($mode == 'portal')
				{
					$sql = "SELECT * FROM " . K_WEB_PAGES_TABLE . ' WHERE page_type LIKE ' . "'P'" . ' ORDER BY page_name ASC';
				}

				if (!$result = $db->sql_query($sql))
				{
					trigger_error($user->lang['ERROR_PORTAL_WEB_TABLE'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
				}

				while ($row = $db->sql_fetchrow($result))
				{
					$mid			= $row['id'];
					$active			= $row['active'];
					$page_name		= $row['page_name'];
					$page_title		= $row['page_title'];
					$page_desc		= $row['page_desc'];
					$page_meta		= $row['page_meta'];
					$page_extn		= $row['page_extn'];
					$external_file	= $row['external_file'];
					$page_type		= $row['page_type'];
					$head			= $row['head'];
					$body			= $row['body'];
					$foot			= $row['foot'];
					$last_updated	= $row['last_updated'];

					// if there is no date for last update use todays date // 
					if ($last_updated == '')
					{
						$last_updated = $today = date("D d M Y");
					}

					// process html for var and replace if found //
					//$body = process_for_vars($body, false);

					$template->assign_block_vars('all', array(
						'S_ID'				=> $mid,
						'S_ACTIVE'			=> $active,
						'S_PAGE_NAME'		=> $page_name,
						'S_PAGE_TITLE'		=> $page_title,
						'S_PAGE_DESC'		=> $page_desc,
						'S_PAGE_META'		=> $page_meta,
						'S_PAGE_EXTN'		=> $page_extn,
						'S_external_file'	=> $external_file,
						'S_PAGE_TYPE'		=> $page_type,
						'S_HEAD'			=> $head,
						'S_BODY'			=> $body,
						'S_FOOT'			=> $foot,
						'S_LAST_UPDATED'	=> $last_updated
					));

					$found++;
				}

				$template->assign_vars(array(
					'S_OPTION' => 'all',
					'S_PAGE_TYPE'	=> $mode,
				));

				$db->sql_freeresult($result);

				$template->assign_vars(array(
					'SEARCH_MESSAGE' => '<strong>Found:</strong> ' . $found . $user->lang['PAGES'],
				));

				break;
			}
			case 'default':
			break;
		}
	}
}


include_once($phpbb_root_path . 'includes/sgp_functions.'. $phpEx);

/***
* function takes the id of the header and footer for a given portal page (body)... It generated a list of each type with the correct item selected...
* this method must be used as the resulting code is inside a BEGIN loop... you may be able to nest BEGIN/END loops but I'm not sure...
*/
function get_headers_and_footers($i, $j)
{
	global $db, $template;

	$sql = "SELECT id, page_name, page_desc, page_extn, page_meta, page_type, head, foot FROM " . K_WEB_PAGES_TABLE . " WHERE active AND page_type LIKE 'H' OR page_type LIKE 'F' ORDER BY page_name ASC";

	$result = $db->sql_query($sql);

	$headopt = "<select class=\"inputbox autowidth\"  name=\"head\" >\n";
	$footopt = "<select class=\"inputbox autowidth\"  name=\"foot\" >\n";

	while ($row = $db->sql_fetchrow($result))
	{
		$selectedh = ($row['id'] == $i) ? " selected=\"selected\"" : "";
		$selectedf = ($row['id'] == $j) ? " selected=\"selected\"" : "";

		if ($row['page_type'] == 'H')
		{
			$headopt .= "<option value=\"" . $row['id'] . "\"" . $selectedh . "> " . $row['page_desc'] . "</option>";
		}
		else
		{
			$footopt .= "<option value=\"" . $row['id'] . "\"" . $selectedf . "> " . $row['page_desc'] . "</option>";
		}

	}
	$headopt .= "</select>\n";
	$footopt .= "</select>\n";

	$template->assign_vars(array(
		'S_HEAD_OPT'	=> $headopt,
		'S_FOOT_OPT'	=> $footopt,
	));

	$db->sql_freeresult($result);
}

/*
function s_get_vars()
{

	global $db, $template;

	$sql = 'SELECT * FROM ' . K_RESOURCE_TABLE . ' ORDER BY word ASC';
	$result = $db->sql_query($sql);	

	while ($row = $db->sql_fetchrow($result))
	{
		$template->assign_block_vars('adm_vars', array(
			'VAR'	=> $row['word'],
		));
	}
	$db->sql_freeresult($result);
}
*/
?>