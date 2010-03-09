<?php
/**
*
* @package acp Stargate Portal
* @version $Id: acp_k_menus.php 305 2009-01-01 16:03:23Z Michealo $
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

class acp_k_menus
{
	var $u_action = '';

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache;
		global $config, $SID, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$user->add_lang('acp/k_menus');
		$this->tpl_name = 'acp_k_menus';
		$this->page_title = 'ACP_MENUS';

		$form_key = 'acp_k_menus';
		add_form_key($form_key);

		//$action	= request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;

		$forum_id	= request_var('f', 0);
		$forum_data = $errors = array();

		if ($submit && !check_form_key($form_key))
		{
			$submit = false;
			$mode = '';
			trigger_error('Error! ' . $user->lang['FORM_INVALID'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
		}

		$menuitem	= request_var('menuitem', '');

		$template->assign_vars(array(

			'U_BACK'	=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_menus&amp;mode=nav",
			'U_EDIT'	=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_menus&amp;mode=edit" . '&amp;menu=' . $menuitem,
			'U_UP'		=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_menus&amp;mode=up" . '&amp;menu=' . $menuitem,
			'U_DOWN'	=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_menus&amp;mode=down" . '&amp;menu=' . $menuitem,
			'U_DELETE'	=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_menus&amp;mode=delete" . '&amp;menu=' . $menuitem,

			)
		);


		// Set up general vars
		//$action = request_var('action', '');

		$mode		= request_var('mode', '');
		$menu		= request_var('menu', '');
		$menuitem	= request_var('menuitem', '');

		$u_action = "{$phpbb_admin_path}index.$phpEx$SID&amp;i=$id&amp;mode=$mode";

		if($mode == '') $mode = 'head';

		if($submit)
		{
			$store = $mode;
		}

		switch ($mode)
		{
			case 'head': 	get_menu(0); 	$template->assign_vars(array('S_OPT' => 'head')); break;
			case 'nav':		get_menu(1); 	$template->assign_vars(array('S_OPT' => 'nav'));  break;
			case 'sub':		get_menu(2); 	$template->assign_vars(array('S_OPT' => 'sub'));  break;
			case 'all':		get_menu(90); 	$template->assign_vars(array('S_OPT' => 'all'));  break;
			case 'unalloc':	get_menu(99); 	$template->assign_vars(array('S_OPT' => 'unalloc')); break;

			case 'edit':
			{
				if($submit)
				{
					$m_id			= request_var('m_id', '');
					$ndx    		= request_var('ndx', '');
					$menu_type 		= request_var('menu_type', '');
					$menu_icon  	= request_var('menu_icon', '');
					$name       	= utf8_normalize_nfc(request_var('name', '', true));
					$link_to  		= request_var('link_to', '');
					$view_by    	= request_var('view_by', '');
					$append_sid		= request_var('append_sid', '');
					$append_uid		= request_var('append_uid', '');
					$soft_hr		= request_var('soft_hr', '');
					$sub_heading	= request_var('sub_heading', '');

					if(strstr($menu_icon, 'None'))
						$menu_icon = '';

					//echo $menu_icon;
					$sql_ary = array(
						'menu_type' => $menu_type,
						'ndx' => $ndx,
						'menu_icon' => $menu_icon,
						'name' => $name,
						'link_to' => $link_to,
						'view_by' => $view_by,
						'append_sid' => $append_sid,
						'append_uid' => $append_uid,
						'soft_hr'	=> $soft_hr,
						'sub_heading' => $sub_heading,
					);
					$sql = 'UPDATE ' . K_MENUS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . " WHERE m_id = $m_id";

					if(!$result = $db->sql_query($sql))
						trigger_error('Error! Could not update Nav Menu table. ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);

					$template->assign_vars(array(
						'L_MENU_REPORT' => 'Data is being saved....</font><br />',
						'S_OPT' => 'saving',
					));

					meta_refresh(1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_menus&amp;mode=nav");
					break;
				}


				// get all groups and fill array //
				get_all_groups();

				// A simple fix to allow delete
				if($menu > 99)
				{
					$menu = ($menu /100);
				}
				if($submit == 1)
					get_menu_item($m_id);
				else
					get_menu_item($menu);

				// temp switches //
				$template->assign_vars(array('S_OPT' => 'edit'));
				get_menu_icons();

				break;
			}

			case 'delete':
			{
				if (!$menu)
				{
					trigger_error($user->lang['MUST_SELECT_VALID_MENU_DATA'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				if (confirm_box(true))
				{
					$sql = 'SELECT name, m_id
						FROM ' . K_MENUS_TABLE . '
						WHERE m_id = ' . $menu;
					$result = $db->sql_query($sql);

					$name = (string) $db->sql_fetchfield('name');
					$id = (int) $db->sql_fetchfield('m_id');
					$db->sql_freeresult($result);
					$name .= ' Menu ';

					$sql = 'DELETE FROM ' . K_MENUS_TABLE . "
						WHERE m_id = $menu";
					$db->sql_query($sql);


					$template->assign_vars(array(
						'L_MENU_REPORT' => $name . 'Deleted!</font><br />',
						));

					$template->assign_vars(array('S_OPT' => 'delete'));

					$cache->destroy('sql', K_MENUS_TABLE);

					meta_refresh(1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_menus&amp;mode=all");

					break;
				}
				else
				{
					confirm_box(false, $user->lang['CONFIRM_OPERATION_MENUS'], build_hidden_fields(array(
						'i'			=> $id,
						'mode'		=> $mode,
						'action'	=> 'delete',
					)));
				}

				$template->assign_vars(array('L_MENU_REPORT' => 'Action Cancelled...'));

				meta_refresh(1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_menus&amp;mode=all");

				break;
			}

			case 'up':
			case 'down':
			{
				$to_move;
				$move_to;

				// get current menu data //
				$sql = "SELECT m_id, ndx, menu_type FROM " . K_MENUS_TABLE . "
					WHERE m_id = $menu LIMIT 1";

				if (!$result = $db->sql_query($sql))
						trigger_error('Error! Could not query portal menus information. ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);

				$row = $db->sql_fetchrow($result);
				$to_move['m_id'] = $row['m_id'];
				$to_move['ndx']  = $temp = $row['ndx'];
				$type = $row['menu_type'];

				if($mode == 'up')
				{
					$temp = $temp - 1;
				}
				if($mode == 'down')
				{
					$temp = $temp + 1;
				}

				// get move_to menu data//
				$sql = "SELECT m_id, ndx, menu_type FROM " . K_MENUS_TABLE . "
					WHERE ndx =  $temp AND menu_type = '$type' LIMIT 1";

				if(!$result = $db->sql_query($sql))
					trigger_error('Error! ' . $user->lang['MENU_MOVE_ERROR'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);

				$row = $db->sql_fetchrow($result);
				$move_to['m_id'] = $row['m_id'];
				$move_to['ndx']  = $row['ndx'];

				if($move_to['ndx'] != $temp )
					trigger_error('Error! ' . $user->lang['MENU_MOVE_ERROR'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);

				if($mode == 'up')
				{
					$sql = "UPDATE " . K_MENUS_TABLE . " SET ndx = " . $to_move['ndx'] . " WHERE m_id = " . $move_to['m_id'];
					if(!$result = $db->sql_query($sql))
						trigger_error('Error! ' . $user->lang['MENU_MOVE_ERROR'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);

					$sql = "UPDATE " . K_MENUS_TABLE . " SET ndx = " . $move_to['ndx'] . " WHERE m_id = " . $to_move['m_id'];
					if(!$result = $db->sql_query($sql))
						trigger_error('Error! ' . $user->lang['MENU_MOVE_ERROR'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
				}
				if($mode == 'down')
				{
					$sql = "UPDATE " . K_MENUS_TABLE . " SET ndx = " . $move_to['ndx'] . " WHERE m_id = " . $to_move['m_id'];
					if(!$result = $db->sql_query($sql))
						trigger_error('Error! ' . $user->lang['MENU_MOVE_ERROR'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);

					$sql = "UPDATE " . K_MENUS_TABLE . " SET ndx = " . $to_move['ndx'] . " WHERE m_id = " . $move_to['m_id'];
					if(!$result = $db->sql_query($sql))
						trigger_error('Error! ' . $user->lang['MENU_MOVE_ERROR'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
				}

				$template->assign_vars(array(
					'L_MENU_REPORT' => 'Sort Order updated Returning... please wait!</font><br />',
					'S_OPT' => 'updown',
				));

				$mode ='nav';

				$cache->destroy('sql', K_MENUS_TABLE);

				meta_refresh(1, append_sid("{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_menus&amp;mode=nav"));

				break;
			}

			case 'create':
			{
				if($submit)
				{
					//$m_id		=request_var('m_id', '');
					//$ndx    	= request_var('ndx', '');

					$menu_type 		= request_var('menu_type', '');
					$menu_icon  	= request_var('menu_icon', '');
					$name  			= utf8_normalize_nfc(request_var('name', '', true));
					$link_to  		= request_var('link_to', '');
					$view_by		= request_var('view_by', '');
					$append_sid		= request_var('append_sid', '');
					$append_uid		= request_var('append_uid', '');
					$soft_hr		= request_var('soft_hr', '');
					$sub_heading	= request_var('sub_heading', '');

					if(strstr($menu_icon, 'None'))
						$menu_icon = '';

					$ndx = get_next_ndx($menu_type);

					$sql_array = array(
                       'menu_type'		=> $menu_type,
                       'ndx'			=> $ndx,
                       'menu_icon'		=> $menu_icon,
                       'name'			=> $name,
                       'link_to'		=> $link_to,
                       'view_by'		=> $view_by,
                       'append_sid'		=> $append_sid,
                       'append_uid'		=> $append_uid,
                       'soft_hr'		=> $soft_hr,
                       'sub_heading'	=> $sub_heading,
					);
					
					$db->sql_query('INSERT INTO ' . K_MENUS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_array));

					$cache->destroy('sql', K_MENUS_TABLE);

					meta_refresh(1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_menus&amp;mode=$store");

					$template->assign_vars(array(
						'L_MENU_REPORT' => 'Menu Created...',
					));

					break;//return;
				}
				else
				{

					// get all groups and fill array //
					get_all_groups();

					get_menu_icons(); $template->assign_vars(array('S_OPT' => 'create'));
					break;
				}
			}
			case 'icons':
			{
				$dirslist='';
				$i = get_menu_icons();
				$template->assign_vars(array(
					'S_OPT' 				=> 'icons',
					'S_HIDE' 				=> 'HIDE',
					'L_ICONS_REPORT'		=> '',
					'S_MENU_ICON_COUNT'		=> $i,
					'S_MENU_ICONS_LIST'		=> $dirslist,
					)
				);
				$template->assign_vars(array('S_OPT' => 'icons'));
				break;
			}

			case 'manage':
				$template->assign_vars(array(
						'L_MENU_REPORT' => 'This is for future development...</font><br />',
						));
				$template->assign_vars(array('S_OPT' => 'manage'));
			break;

			case 'sync':
				$template->assign_vars(array(
						'L_MENU_REPORT' => 'Not Assigned...!</font><br />',
						));
				$template->assign_vars(array('S_OPT' => 'sync'));
			break;

			case 'default':

			case 'tools':
				$template->assign_vars(array('S_OPT' => 'Tools'));
			break;

		}

		$template->assign_vars(array('U_ACTION'		=> $u_action));
	}
}

function get_menu($this_one)
{
	global $db, $phpbb_root_path, $phpEx, $template;

	switch ($this_one)
	{
		case 0:		$sql = 'SELECT * FROM ' . K_MENUS_TABLE . ' WHERE menu_type = 0 ORDER BY ndx ASC'; break;									// header menus
		case 1:		$sql = 'SELECT * FROM ' . K_MENUS_TABLE . ' WHERE menu_type = 1 ORDER BY ndx ASC'; break;									// nav menus
		case 2:		$sql = 'SELECT * FROM ' . K_MENUS_TABLE . ' WHERE menu_type = 2 ORDER BY ndx ASC'; break;									// sub menus
		case 3:		$sql = 'SELECT * FROM ' . K_MENUS_TABLE . ' WHERE menu_type = 1 || menu_type = 2 || menu_type = 3 ORDER BY ndx ASC'; break;	// sub menus
		case 90: 	$sql = 'SELECT * FROM ' . K_MENUS_TABLE . ' ORDER BY menu_type, ndx ASC'; break;
		case 99:	$sql = 'SELECT * FROM ' . K_MENUS_TABLE . ' WHERE menu_type > 2 ORDER BY ndx, menu_type ASC'; break;
		default: 	$sql = 'SELECT * FROM ' . K_MENUS_TABLE . ' WHERE menu_type=' . $this_one; break;
	}

	if( $result = $db->sql_query($sql) )
	{
		while ( $row = $db->sql_fetchrow($result) )
		{
			$template->assign_block_vars('mdata', array(
				'S_MENUID' 	=> $row['m_id'],
				'S_MENU_NDX'	=> $row['ndx'],
				'S_MENU_TYPE'	=> $row['menu_type'],
				'S_MENU_ICON'	=> $row['menu_icon'],
				'S_MENU_ITEM_NAME'	=> $row['name'],
				'S_MENU_LINK'	=> $row['link_to'],
				'S_MENU_VIEW'	=> which_group($row['view_by']),
				'S_MENU_APPEND_SID' => $row['append_sid'],
				'S_MENU_APPEND_UID' => $row['append_uid'],
				'S_SOFT_HR'			=> $row['soft_hr'],
				'S_SUB_HEADING'	=> $row['sub_heading'],

				)
			);
		}
		$db->sql_freeresult($result);
	}
	else
	trigger_error('Error! ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
}

function get_menu_item($item)
{
	global $db, $template;

	$m_id = $item;

	$sql = 'SELECT * FROM ' . K_MENUS_TABLE . ' WHERE m_id=' . $item;
	if( $result = $db->sql_query($sql) )
	{
		$row = $db->sql_fetchrow($result);
	}

	$template->assign_vars(array(
		'S_MENUID' 	=> $row['m_id'],
		'S_MENU_NDX'	=> $row['ndx'],
		'S_MENU_TYPE'	=> $row['menu_type'],
		'S_MENU_ICON'	=> $row['menu_icon'],
		'S_MENU_ITEM_NAME'	=> $row['name'],
		'S_MENU_LINK'	=> $row['link_to'],
		'S_MENU_VIEW'	=> which_group($row['view_by']),
		'S_MENU_VIEW'	=> $row['view_by'],
		'S_MENU_APPEND_SID' => $row['append_sid'],
		'S_MENU_APPEND_UID' => $row['append_uid'],
		'S_SOFT_HR'			=> $row['soft_hr'],
		'S_SUB_HEADING'		=> $row['sub_heading'],
		)
	);
	$db->sql_freeresult($result);
}


function get_menu_icons()
{
	global $phpbb_root_path, $phpEx, $template, $dirslist;

	$dirslist='None ';

//	$dirs = dir('./../styles/portal_admin/theme/images/pips');
	$dirs = dir('./../images/block_images');

	while ($file = $dirs->read())
	{
		if(stripos($file, "enu") || stripos($file, ".gif") || stripos($file, ".png") && stripos($file ,"ogo_"))
			$dirslist .= "$file ";

		//if (eregi("menu", $file) && eregi(".gif", $file) || eregi(".png", $file))// && !eregi(" ",$file)) // only png files now...
		//if (eregi(".png", $file) || eregi(".gif", $file))// && (eregi("mini_", $file) || eregi("menu_", $file)))
		/*
		if (eregi("menu", $file) || eregi(".gif", $file) && eregi(".png", $file))
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
			$template->assign_block_vars('menuicons', array('S_MENU_ICONS'	=> $dirslist[$i]));
	}

	return $i;
}

function get_next_ndx($type)
{
	global $db, $ndx;
	$sql = "SELECT * FROM " . K_MENUS_TABLE . " WHERE menu_type = '$type' ORDER by ndx DESC";
	if( $result = $db->sql_query($sql) )
	{
		$row = $db->sql_fetchrow($result);		// just get last block ndx details	//
		$ndx = $row['ndx'];						// only need last ndx returned		//
		$ndx = $ndx + 1; 						// add 1 to index 					//
		return($ndx);
	}
}

function get_all_groups()
{
	global $db, $template;
	$i = 0;

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

// this is very inefficient... I will update later...
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

	//????//$name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");// not in all versions

	if($name == '')
		return('None');
	else
		return ($name);
}
?>