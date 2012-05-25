<?php
/**
*
* @package acp Stargate Portal
* @version $Id: acp_k_blocks.php 312 2009-11-23 02:51:12Z Michealo $
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

/**
* @notes
* S_OPTIONS = switch used by html file
* BLOCK_REPORT = general html report text
**/

class acp_k_blocks
{
	var $u_action = '';

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache;
		global $config, $k_config, $phpbb_root_path, $phpbb_admin_path, $phpEx, $SID;

		include($phpbb_root_path . 'includes/sgp_functions_admin.'.$phpEx);

		// Define Switches for html file //

		$user->add_lang('acp/k_blocks');
		$this->tpl_name = 'acp_k_blocks';
		$this->page_title = 'ACP_BLOCKS';

		$form_key = 'acp_k_blocks';
		add_form_key($form_key);

		$action	= request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;

		if ($submit && !check_form_key($form_key))
		{
			$submit = false;
			$mode = '';
			trigger_error($user->lang['FORM_INVALID']);
		}

		// Can not use append_sid here, the $block_id is assigned to the html but unknow to this code //
		// Would require I add a form element and use request_var to retrieve it //
		// The global $SID is available so I make use of it...?

		$template->assign_vars(array(
			'U_BACK'			=> $this->u_action,
			'U_EDIT2'			=> "{$phpbb_admin_path}index.$phpEx{$SID}&amp;i=k_blocks&amp;mode=edit&amp;block=",
			'U_UP'				=> "{$phpbb_admin_path}index.$phpEx{$SID}&amp;i=k_blocks&amp;mode=up&amp;block=",
			'U_DOWN'			=> "{$phpbb_admin_path}index.$phpEx{$SID}&amp;i=k_blocks&amp;mode=down&amp;block=",
			'U_DELETE'			=> "{$phpbb_admin_path}index.$phpEx{$SID}&amp;i=k_blocks&amp;mode=delete&amp;block=",
			'U_SET_VARS_W'		=> "{$phpbb_admin_path}index.$phpEx{$SID}&amp;i=k_modules&amp;mode=welcome&amp;block=",
			'U_SET_VARS'		=> "{$phpbb_admin_path}index.$phpEx{$SID}&amp;i=k_vars&amp;mode=config&amp;block=",
			'U_LINK_MINIMOD'	=> "{$phpbb_admin_path}index.$phpEx{$SID}&amp;i=k_modules&mode=edit&amp;module=",
			'U_MANAGE_PAGES'	=> "{$phpbb_admin_path}index.$phpEx{$SID}&amp;i=k_pages&mode=manage"
		));

		// Set up general vars
		$mode	= request_var('mode', '');
		$block	= request_var('block', '');

		// bold current row text so things are easier to follow when moving/editing etc... //
		if (($block) ? $block : 0)
		{
			$sql = 'UPDATE ' . K_BLOCKS_CONFIG_VAR_TABLE . ' SET config_value = ' . (int)$block . ' WHERE config_name = "adm_block"';
			$db->sql_query($sql);
		}
		else
		{
			$wheresql =  ' WHERE config_name = "adm_block"';

			$sql = 'SELECT config_name, config_value
				FROM ' . K_BLOCKS_CONFIG_VAR_TABLE . $wheresql;

			$result = $db->sql_query($sql);

			$row = $db->sql_fetchrow($result);

			$k_config[$row['config_name']] = $row['config_value'];
		}

		$template->assign_var('ADM_BLOCK', $k_config['adm_block']);

		//$u_action = append_sid("{$phpbb_admin_path}index.$phpEx" , "i=$id&amp;mode=" . strtolower($mode));
		$u_action = append_sid("{$phpbb_admin_path}index.$phpEx" , "i=$id&amp;mode=" . $mode);

		switch ($mode)
		{
			case 'up':
			case 'down':
			{
				$to_move = $move_to = array();

				// get current block data//
				$sql = "SELECT id, ndx, position FROM " . K_BLOCKS_TABLE . "
					WHERE id = " . (int)$block . " LIMIT 1";

				if (!$result = $db->sql_query($sql))
				{
					trigger_error($user->lang['ERROR_PORTAL_BLOCKS'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
				}

				// Added function to reindex blocks after a block deletion Dicky
				if (isset($current_position) && $current_position != $position)
				{
					$index_start = get_lowest_ndx($current_position);
					reindex_column($current_position, $index_start);
				}

				$row = $db->sql_fetchrow($result);
				$to_move['id'] = $row['id'];
				$to_move['ndx']  = $temp = $row['ndx'];

				// position is char 'L', 'R', 'C' (char) //
				$position = $row['position'];

				if ($mode == 'up')
				{
					$temp = $temp - 1;
				}
				if ($mode == 'down')
				{
					$temp = $temp + 1;
				}

				// get move_to block data//
				$sql = "SELECT id, ndx, position FROM " . K_BLOCKS_TABLE . "
					WHERE ndx =  '" . (int)$temp . "' AND position = '" . $db->sql_escape($position) . "' LIMIT 1";

				if (!$result = $db->sql_query($sql))
				{
					trigger_error($user->lang['BLOCK_MOVE_ERROR'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
				}

				$row = $db->sql_fetchrow($result);

				$move_to['id'] = $row['id'];
				$move_to['ndx']  = $row['ndx'];

				if ($move_to['ndx'] != $temp || $move_to['id'] == '')
				{
					trigger_error($user->lang['BLOCK_MOVE_ERROR'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
				}

				if ($mode == 'up')// mod validation note... sql is not repeated!
				{
					// sql is not duplicated
					$sql = "UPDATE " . K_BLOCKS_TABLE . " SET ndx = " . $to_move['ndx'] . " WHERE id = " . $move_to['id'];
					if (!$result = $db->sql_query($sql))
					{
						trigger_error($user->lang['BLOCK_MOVE_ERROR'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
					}
					$sql = "UPDATE " . K_BLOCKS_TABLE . " SET ndx = " . $move_to['ndx'] . " WHERE id = " . $to_move['id'];
					if (!$result = $db->sql_query($sql))
					{
						trigger_error($user->lang['BLOCK_MOVE_ERROR'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
					}
				}

				if ($mode == 'down')// mod validation note... sql is not repeated!
				{
					// sql is not duplicated
					$sql = "UPDATE " . K_BLOCKS_TABLE . " SET ndx = " . $move_to['ndx'] . " WHERE id = " . $to_move['id'];
					if (!$result = $db->sql_query($sql))
					{
						trigger_error($user->lang['BLOCK_MOVE_ERROR'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
					}
					$sql = "UPDATE " . K_BLOCKS_TABLE . " SET ndx = " . $to_move['ndx'] . " WHERE id = " . $move_to['id'];
					if (!$result = $db->sql_query($sql))
					{
						trigger_error($user->lang['BLOCK_MOVE_ERROR'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
					}
				}

				$template->assign_var('BLOCK_REPORT', $user->lang['BLOCK_UPDATING']);

				if ($position)
				{
					$mode = $position;
				}
				else
				{
					$mode = 'manage';
				}

				$cache->destroy('sql', K_BLOCKS_TABLE);

				meta_refresh(1, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=k_blocks&amp;mode='. $mode));

				break;
			}

			case 'add':
			case 'ADD':
			{
				if ($submit)
				{
					if (request_var('html_file_name','') == "" OR request_var('title', '') == "")
					{
						$message = $user->lang['MISSING_BLOCK_DATA'];

						$template->assign_var('BLOCK_REPORT', $message .'<br />');

						meta_refresh(2, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=k_blocks&amp;mode=add'));
						return;
					}

					//$id				= request_var('m_id']; // auto assigned
					//$ndx				= request_var('ndx'];  // we calculate this

					$title				= utf8_normalize_nfc(request_var('title', '', true));
					$position			= request_var('position', '');
					$active 			= request_var('active', 1);
					$type				= request_var('type', '');
					$scroll  			= request_var('scroll', 0);
					$view_by			= request_var('view_by', 1);
					$view_groups		= request_var('view_groups', '');
					$view_all			= request_var('view_all', 1);
					$view_pages			= request_var('view_pages', '');
					$html_file_name		= request_var('html_file_name', '');
					$var_file_name		= request_var('var_file_name', '');
					$img_file_name		= request_var('img_file_name', '');
					$has_vars			= request_var('has_vars', 0);
					$minimod_based		= request_var('minimod_based', 0);
					$mod_block_id		= request_var('mod_block_id', 0);
					$block_cache_time	= request_var('block_cache_time', 300);

					if ($view_all)
					{
						$view_by = 1;
					}
					if ($img_file_name == '')
					{
						$img_file_name = 'default.gif';
					}
					if ($has_vars == 0)
					{
						$var_file_name = '';
					}
					if ($minimod_based == 0)
					{
						$mod_block_id = '0';
					}

					$view_page_id = request_var('view_page_id', array(0));

					for ($i = 0; $i < count($view_page_id); $i++)
					{
						$view_pages .= $view_page_id[$i];

						if ($i < count($view_page_id) - 1)
						{
							$view_pages .= ',';
						}
					}

					$ndx = get_next_ndx($position);		// get the next ndx to use for this position	//

					$sql_array = array(
						'ndx'				=> $ndx,
						'title'				=> $title,
						'active'			=> $active,
						'html_file_name'	=> $html_file_name,
						'var_file_name'		=> $var_file_name,
						'img_file_name'		=> $img_file_name,
						'position'			=> $position,
						'view_by'			=> $view_by,
						'view_groups'		=> $view_groups,
						'view_all'			=> $view_all,
						'view_pages'		=> $view_pages,
						'scroll'			=> $scroll,
						'has_vars'			=> $has_vars,
						'minimod_based'		=> $minimod_based,
						'mod_block_id'		=> $mod_block_id,
						'block_cache_time'	=> $block_cache_time,
					  );

					if (!$db->sql_query('INSERT INTO ' . K_BLOCKS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_array)))
					{
						trigger_error($user->lang['COULD_NOT_ADD_BLOCK'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
					}
					else
					{
						$message = $user->lang['BLOCK_ADDED'];
						$template->assign_var('BLOCK_REPORT', $title . $message . '</font><br />');
					}

					$cache->destroy('sql', K_BLOCKS_TABLE);

					meta_refresh(2, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=k_blocks&amp;mode=manage'));
					return;
				}
				else
				{

					// get all groups and fill array //
					get_all_groups();
					get_all_pages(0);
					get_all_minimods();
					get_all_vars_files($block);

					//Get all installed blocks//
					$data='';
					$c = 0;

					$sql = 'SELECT * FROM ' . K_BLOCKS_TABLE;
					if ($result = $db->sql_query($sql))
					{
						while ($row = $db->sql_fetchrow($result))
						{
							$data .= $row['id'];
							$data .=' ';
							$c++;
						}
					}

					$dirslist = '';

					$dirs = dir($phpbb_root_path . 'styles/_portal_common/template/blocks');

					while ($file = $dirs->read())
					{
						if (!stripos($file, ".bak"))
						{
							$dirslist .= "$file ";
						}
					}

					closedir($dirs->handle);

					$dirslist = explode(" ", $dirslist);
					sort($dirslist);

					for ($i=0; $i < sizeof($dirslist); $i++)
					{
						if ($dirslist[$i] != '')
						{
							$template->assign_block_vars('html_file_name', array('S_BLOCK_FILE_HTML' => $dirslist[$i]));
						}
					}

					$dirslist = '.. ';

					$dirs = dir($phpbb_root_path . 'images/block_images/block');

					while ($file = $dirs->read())
					{
						if (stripos($file, ".gif") ||  stripos($file, ".png"))
						{
							$dirslist .= "$file ";
						}
					}

					closedir($dirs->handle);

					$dirslist = explode(" ", $dirslist);
					sort($dirslist);

					for ($i=0; $i < sizeof($dirslist); $i++)
					{
						if ($dirslist[$i] != '')
						{
							$template->assign_block_vars('img_file_name', array('S_BLOCK_FILE_I' => $dirslist[$i]));
						}
					}
					$dirslist='';

					$template->assign_var('S_OPTIONS', strtoupper($mode));
				}
				break;
			}

			case 'edit':
			case 'EDIT':
			{
				if ($submit)
				{
					$id				= request_var('id', 0);
					$ndx			= request_var('ndx', 0);
					$title			= utf8_normalize_nfc(request_var('title', '', true));
					$position		= request_var('position', '');
					$type			= request_var('type', '');
					$active 		= request_var('active', 1);
					$view_by		= request_var('view_by', 1);
					$view_groups	= request_var('view_groups', '');
					$view_all		= request_var('view_all', 1);
					$view_pages		= request_var('view_pages', '');
					$scroll			= request_var('scroll', 0);
					$has_vars		= request_var('has_vars', 0);
					$minimod_based	= request_var('minimod_based', 0);
					$mod_block_id	= request_var('mod_block_id', 0);
					$html_file_name	= request_var('html_file_name', '');
					$var_file_name	= request_var('var_file_name', '');
					$img_file_name	= request_var('img_file_name', '');
					$block_cache_time	= request_var('block_cache_time', 300);

					$view_page_id = request_var('view_page_id', array(0));

					for ($i = 0; $i < count($view_page_id); $i++)
					{
						$view_pages .= $view_page_id[$i];

						if ($i < count($view_page_id) - 1)
						{
							$view_pages .= ',';
						}
					}


					// this shoud not happen but just in case //
					if (!$id)
					{
						$template->assign_var('BLOCK_REPORT', $user->lang['UNKNOWN_ERROR']);
						$submit = false;
						return;
					}

					if ($type == 1)
					{
						$type = 'H';
					}
					else
					{
						$type = 'B';
					}

					if ($view_by == '' && !$view_all)
					{
						$view_by = 0;
					}
					else if ($view_all)
					{
						$view_by = 1;
					}


					if ($img_file_name == '')
					{
						$img_file_name = 'default.gif';
					}
					if ($has_vars == 0)
					{
						$var_file_name = '';
					}
					if ($minimod_based == 0)
					{
						$mod_block_id = '0';
					}

					// get the current block position //
					$current_position = get_current_position($id);

					// if moving block position (column) //
					if ($current_position != $position)
					{
						$ndx = get_next_ndx($position);
					}

					// change to build array later
					$sql = "UPDATE " . K_BLOCKS_TABLE . "
						SET
							ndx					= '" . (int)$ndx. "',
							active				= '" . (int)$active . "',
							title				= '" . $db->sql_escape($title) . "',
							position			= '" . $db->sql_escape($position) . "',
							type				= '" . $db->sql_escape($type) . "',
							html_file_name		= '" . $db->sql_escape($html_file_name) . "',
							var_file_name		= '" . $db->sql_escape($var_file_name) . "',
							img_file_name		= '" . $db->sql_escape($img_file_name) . "',
							view_groups			= '" . $db->sql_escape($view_groups) . "',
							view_pages			= '" . $db->sql_escape($view_pages) . "',
							view_by				= '" . $db->sql_escape($view_by) . "',
							view_all			= '" . (int)$view_all . "',
							scroll				= '" . (int)$scroll . "',
							has_vars			= '" . (int)$has_vars . "',
							minimod_based		= '" . (int)$minimod_based . "',
							mod_block_id		= '" . (int)$mod_block_id . "',
							block_cache_time	= '" . (int)$block_cache_time . "'
							WHERE id = '$id'";

					if (!$result = $db->sql_query($sql))
					{
						trigger_error($user->lang['COULD_NOT_EDIT_BLOCK'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
					}

					$template->assign_var('BLOCK_REPORT', $user->lang['SAVING']);

					$cache->destroy('sql', K_BLOCKS_TABLE);

					delete_this_block_cached_file($html_file_name);

					if ($position)
					{
						$mode = $position;
					}
					else
					{
						$mode = 'manage';
					}
					meta_refresh(1, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=k_blocks&amp;mode=' . $mode));

					return;
				}

				// get all available html files, note.. we search the admin styles folder //

				$dirslist = '.. ';

				$dirs = dir($phpbb_root_path . 'styles/_portal_common/template/blocks');

				while ($file = $dirs->read())
				{
					if (!stripos($file, ".bak"))
					{
						$dirslist .= "$file ";
					}
				}
				closedir($dirs->handle);

				$dirslist = explode(" ", $dirslist);
				sort($dirslist);

				for ($i=0; $i < sizeof($dirslist); $i++)
				{
					if ($dirslist[$i] != '')
					{
						$template->assign_block_vars('html_file_name', array('S_BLOCK_FILE_HTML' => $dirslist[$i]));
					}
				}

				// get all available block images //

				$dirslist = '.. ';

				$dirs = dir($phpbb_root_path . 'images/block_images/block');

				while ($file = $dirs->read())
				{
					if (stripos($file, ".gif") || stripos($file, ".png"))
					{
						$dirslist .= "$file ";
					}
				}
				closedir($dirs->handle);

				$dirslist = explode(" ", $dirslist);
				sort($dirslist);

				for ($i=0; $i < sizeof($dirslist); $i++)
				{
					if ($dirslist[$i] != '')
					{
						$template->assign_block_vars('img_file_name', array('S_BLOCK_FILE_I' => $dirslist[$i]));
					}
				}
				$dirslist='';

				$template->assign_var('S_OPTIONS', 'ADD'); // not a language var //

				if ($block == '' || $block == 0) // just checking!
				{
					trigger_error($user->lang['NO_BLOCK_ID'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$sql = 'SELECT * FROM ' . K_BLOCKS_TABLE . ' WHERE id=' . (int)$block;

				if ($result = $db->sql_query($sql))
				{
					$row = $db->sql_fetchrow($result);
				}

				if ($row['img_file_name'] == '')
				{
					$row['img_file_name'] = 'default.gif';
				}

				$template->assign_vars(array(
					'S_ID'			=> $row['id'],
					'S_NDX'			=> $row['ndx'],
					'S_TITLE'		=> $row['title'],
					'S_POSITION'	=> $row['position'],
					'S_ACTIVE'		=> $row['active'],
					'S_TYPE'		=> $row['type'],
					'S_FNAME_H'		=> $row['html_file_name'],
					'S_FNAME_V'		=> $row['var_file_name'],
					'S_FNAME_I'		=> $row['img_file_name'],
					'S_VIEW_BY'		=> $row['view_by'],
					'S_VIEW_GROUPS'	=> $row['view_groups'],
					'S_VIEW_ALL'	=> $row['view_all'],
					'S_VIEW_PAGES'	=> $row['view_pages'],
					'S_SCROLL'		=> $row['scroll'],
					'S_HAS_VARS'	=> $row['has_vars'],
					'S_MINIMOD_BASED'	=> $row['minimod_based'],
					'S_MOD_BLOCK_ID'	=> $row['mod_block_id'],
					'BLOCK_CACHE_TIME'	=> $row['block_cache_time'],
				));

				// get all groups and fill array //
				get_all_pages($block);
				get_all_groups();
				get_all_minimods();
				get_all_vars_files($block);

				$db->sql_freeresult($result);

				$template->assign_var('S_OPTIONS', strtoupper($mode));

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
					$sql = 'SELECT title, id, position
						FROM ' . K_BLOCKS_TABLE . '
						WHERE id = ' . (int)$block;
					$result = $db->sql_query($sql);

					$row = $db->sql_fetchrow($result);

					$title = $row['title'];
					$id = $row['id'];
					$position = $row['position'];

					$db->sql_freeresult($result);

					// Get lowest ndx for current position block Dicky
					$index_start = get_lowest_ndx($position);

					$sql = "DELETE FROM " . K_BLOCKS_TABLE . "
						WHERE id = " . (int)$block;
					$db->sql_query($sql);

					// Added function to reindex blocks after a block deletion
					reindex_column($position, $index_start);

					$template->assign_var('BLOCK_REPORT', $title . $user->lang['BLOCK_DELETED'] . '</font><br />');

					$cache->destroy('sql', K_BLOCKS_TABLE);

					meta_refresh(1, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=k_blocks&amp;mode=manage'));

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

				$template->assign_var('BLOCK_REPORT', $user->lang['ACTION_CANCELLED']);

				meta_refresh(1, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=k_blocks&amp;mode=manage'));

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

					if ($result = $db->sql_query($sql))
					{
						while($row = $db->sql_fetchrow($result))
						{
							$thispos = $row['position'];
							if ($thispos == $newpos)
							{
								$index_no++;
							}
							else
							{
								$index_no = 1;
							}

							$sql = "UPDATE " . K_BLOCKS_TABLE . " SET ndx = '" . (int)$index_no . "' WHERE id = " . (int)$row['id'];

							//reset ndx to 1 when position changes
							$newpos = $row['position'];

							$results = $db->sql_query($sql);

							if (!$results)
							{
								trigger_error($user->lang['RE-INDEXING BLOCKS'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
							}
						}
					}

					$db->sql_freeresult($result);

					$template->assign_vars(array(
						'S_BUTTON_HIDE'	=> true,
						'BLOCK_REPORT' => $user->lang['BLOCKS_REINDEXED'],
					));

					$cache->destroy('sql', K_BLOCKS_TABLE);

					meta_refresh(1, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=k_blocks&amp;mode=manage'));

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

				$template->assign_var('BLOCK_REPORT', $user->lang['ACTION_CANCELLED']);

				meta_refresh(1, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=k_blocks&amp;mode=manage'));

				break;
			}

			case 'tools':
						$template->assign_var('S_OPTIONS', 'TOOLS'); // not  language var //
			break;

			case 'L':
			case 'C':
			case 'R':
			case '1':
			case '2':
			case '3':	$template->assign_var('S_TYPE', $mode);

			case 'manage':
			{
				if ($mode != 'manage')
				{
					$sql = "SELECT * FROM " . K_BLOCKS_TABLE . " WHERE position = '" . $db->sql_escape($mode) . "' ORDER by ndx, type";
				}
				else
				{
					$sql = 'SELECT * FROM ' . K_BLOCKS_TABLE . ' ORDER by position, ndx';
				}

				$l_b_first = $r_b_first = $c_b_first = $l_b_last = $r_b_last = $c_b_last = 1;

				if ($result = $db->sql_query($sql))
				{
					while ($row = $db->sql_fetchrow($result))
					{
						if ($row['img_file_name'] == '')
						{
							$row['img_file_name'] = 'default.gif';
						}

						if ($mode == 'manage')
						{
							if ($row['position'] == 'L')
							{
								$l_b_last = $l_b_last + 1;
							}
							else if ($row['position'] == 'R')
							{
								$r_b_last = $r_b_last + 1;
							}
							else if ($row['position'] == 'C')
							{
								$c_b_last = $c_b_last + 1;
							}
						}

						$template->assign_block_vars('bdata', array(
						'S_ID' 				=> $row['id'],
						'S_NDX'				=> $row['ndx'],
						'S_TITLE'			=> $row['title'],
						'S_POSITION'		=> $row['position'],
						'S_ACTIVE'			=> $row['active'],
						'S_TYPE'			=> $row['type'],
						'S_FNAME_H'			=> $row['html_file_name'],
						'S_FNAME_V'			=> $row['var_file_name'],
						'S_FNAME_I'			=> $row['img_file_name'],
						'S_VIEW_BY'	 		=> which_group($row['view_by']),
						'S_VIEW_GROUPS'		=> $row['view_groups'],
						'S_VIEW_ALL' 		=> $row['view_all'],
						'S_VIEW_PAGES'		=> $row['view_pages'],
						'S_SCROLL'			=> $row['scroll'],
						'S_HAS_VARS'		=> $row['has_vars'],
						'S_MINIMOD_BASED'	=> $row['minimod_based'],
						'S_MOD_BLOCK_ID'	=> $row['mod_block_id'],

						'S_BLOCK_CACHE_TIME'	=> $row['block_cache_time'],

						'S_BLOCK'			=> ($row['id'] == $block) ? $block : '.....'
						));
					}

					$db->sql_freeresult($result);
				}

				$template->assign_vars(array(
					'S_OPTIONS'	=> strtoupper($mode),
					'S_LBL'	=> $l_b_last-1,
					'S_RBL'	=> $r_b_last-1,
					'S_CBL'	=> $c_b_last-1,
					'S_LRC'	=> '1',
				));

			break;
			}
			case 'default':
			break;
		}

		$template->assign_var('U_ACTION', $u_action);
	}
}


function get_next_ndx($pos)
{
	global $db;

	$sql = "SELECT * FROM " . K_BLOCKS_TABLE . " WHERE position = '" . $db->sql_escape($pos) . "' ORDER by ndx DESC";
	if ($result = $db->sql_query($sql))
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

	$sql = "SELECT position FROM " . K_BLOCKS_TABLE . " WHERE id = '" . (int)$my_id . "'";
	if ($result = $db->sql_query($sql))
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

	if ($block == '')
		return;

	global $db;

	$sql = "SELECT mod_id FROM " . K_MODULES_TABLE . " WHERE mod_block_id = '$block' ";
	if ( $result = $db->sql_query($sql) )
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
	// should not be required...
}

/*
function get_all_groups()
{
	global $db, $template, $user;

	// Get us all the groups
	$sql = 'SELECT group_id, group_name
		FROM ' . GROUPS_TABLE . '
		ORDER BY group_id ASC, group_name';
	$result = $db->sql_query($sql);

	// backward compatability, set up group zero //
	$template->assign_block_vars('groups', array(
		'GROUP_NAME'	=> $user->lang['NONE'],
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
*/

/**
* Takes the $id of a given block
*
* (a) sets the page id, name and checkboxes for this block and
*    any pages it is displayed in...
*
* (b) creates the pages array
*
* 20 August 2010
*
**/
function get_all_pages($id)
{
	global $db, $template, $user;

	if ($id != 0)
	{
		$sql = 'SELECT id, view_pages FROM ' . K_BLOCKS_TABLE . ' WHERE id=' . (int)$id;
		if ($result = $db->sql_query($sql))
		{
			$row = $db->sql_fetchrow($result);
		}
		$db->sql_freeresult($result);
		$arr = explode(','  , $row['view_pages']);
	}

	// Get all pages
	$sql = 'SELECT page_id, page_name
		FROM ' . K_PAGES_TABLE . '
		ORDER BY page_id ASC, page_name';
	$result = $db->sql_query($sql);

	$template->assign_block_vars('pages', array(
		'PAGE_NAME'		=> $user->lang['NONE'],
		'PAGE_ID'		=> 0,
	));

	while ($row = $db->sql_fetchrow($result))
	{
		$page_id = $row['page_id'];
		$page_name = $row['page_name'];
		$template->assign_block_vars('pages', array(
			'PAGE_NAME'		=> $page_name,
			'PAGE_ID'		=> $page_id,
			'IS_CHECKED'	=> ($id) ? (in_array($page_id, $arr)) ? true : false : '',
			)
		);
	}
	$db->sql_freeresult($result);
}

function which_group($id)
{
	global $db, $template, $user;

	// Get us all the groups
	$sql = 'SELECT group_name
		FROM ' . GROUPS_TABLE . '
		WHERE group_id = ' . (int)$id;

	$result = $db->sql_query($sql);

	$name = $db->sql_fetchfield('group_name');

	$db->sql_freeresult($result);

	if ($name == '')
	{
		return('.. ');
	}
	else
	{
		return ($name);
	}
}


function get_all_minimods()
{
	global $db, $template, $user;

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

function get_all_vars_files($block)
{
	global $template, $user, $phpbb_admin_path;

	$dirslist = '.. ';

	$dirs = dir($phpbb_admin_path . '/style/k_block_vars');

	while ($file = $dirs->read())
	{
		if (!stripos($file, ".bak"))
		{
			if ($file != '.' and $file != '..')
			{
				$dirslist .= "$file ";
			}
		}
	}
	closedir($dirs->handle);

	$dirslist = explode(" ", $dirslist);
	sort($dirslist);

	for ($i=0; $i < sizeof($dirslist); $i++)
	{
		if ($dirslist[$i] != '')
		{
			$template->assign_block_vars('var_file_name', array('S_VAR_FILE_NAME' => $dirslist[$i]));
		}
	}
	$dirslist = '';
}


function delete_this_block_cached_file($thisfile)
{
	global $cache, $phpbb_root_path, $user;

	$thisfile .= '.php';

	$dirslist='';

	$dirs = dir($phpbb_root_path . 'cache');

	while ($file = $dirs->read())
	{
		if (strpos($file, $thisfile))
		{
			$cache->destroy($file);
			//unset($file);
		}
	}

	closedir($dirs->handle);
}

function delete_all_block_cached_files()
{
	global $cache, $phpbb_root_path, $user;

	$dirslist='';

	$dirs = dir($phpbb_root_path . 'cache');

	while ($file = $dirs->read())
	{
		if (stripos($file, "_blocks.block_"))
		{
			$cache->destroy($file);
		}
	}
	closedir($dirs->handle);
}


function reindex_column($position, $idx)
{
	global $db, $user;

	$sql = "SELECT id, ndx
		FROM  " . K_BLOCKS_TABLE . "
		WHERE position = '" . $db->sql_escape($position) . "'
		ORDER BY ndx";

	if ($result = $db->sql_query($sql))
	{
		$i = $idx;
		while ($row = $db->sql_fetchrow($result))
		{
			$id = $row['id'];
			$sql = 'UPDATE ' . K_BLOCKS_TABLE . ' SET ndx = ' . $i . ' WHERE id = ' . $id;
			if (!$result = $db->sql_query($sql))
			{
				trigger_error($user->lang['COULD_NOT_REINDEX_BLOCKS'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
			}
			++$i;
		}
	}
	$db->sql_freeresult($result);
}

// Get lowest ndx for current position block
function get_lowest_ndx($position)
{
	global $db;

	$sql = "SELECT ndx
		FROM  " . K_BLOCKS_TABLE . "
		WHERE position = '" . $db->sql_escape($position) . "'
		ORDER BY ndx ASC LIMIT 1";
	$result = $db->sql_query($sql);

	$index_start = (int) $db->sql_fetchfield('ndx');
	$db->sql_freeresult($result);

	return ($index_start);
}

?>