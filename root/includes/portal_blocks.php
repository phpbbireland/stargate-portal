<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Saturday, Jan 22, 2005
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: portal_blocks.php 314 2009-01-02 03:02:31Z Michealo $
* Updated:
*
*/

/**
* @ignore
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

	// Is portal active in config ? //
	if(!STARGATE)
		return;

	$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
	$phpEx = substr(strrchr(__FILE__, '.'), 1);

	$user->add_lang('portal/portal');
	$user->add_lang('portal/portal_blocks_variables');

	include_once($phpbb_root_path . 'includes/functions_user.'. $phpEx );

	global $db, $config, $k_config, $k_blocks, $user, $user_id, $avatar_img;
	global $k_groups, $k_group_id, $k_group_name_id;

	$k_groups = $k_group_name_id = $k_group_id = array();
	$left_count = $centre_count= $right_count = 0;
	$show_left = $show_right = false;

	$big_image_path = $phpbb_root_path . 'images/block_images/large/';

	$loop_count = 0;
	$this_page = explode(".", $user->page['page']);

	define('SHOW_LB_ON_INDEX',	(int)$k_config['show_lb_ipsmuy'][0]);
	define('SHOW_LB_ON_PORTAL',	(int)$k_config['show_lb_ipsmuy'][1]);
	define('SHOW_LB_ON_SEARCH',	(int)$k_config['show_lb_ipsmuy'][2]);
	define('SHOW_LB_ON_MCP',	(int)$k_config['show_lb_ipsmuy'][3]);
	define('SHOW_LB_ON_UCP',	(int)$k_config['show_lb_ipsmuy'][4]);
	define('SHOW_LB_ON_MEM',	(int)$k_config['show_lb_ipsmuy'][5]);

	define('SHOW_RB_ON_INDEX',	(int)$k_config['show_rb_ipsmuy'][0]);
	define('SHOW_RB_ON_PORTAL',	(int)$k_config['show_rb_ipsmuy'][1]);
	define('SHOW_RB_ON_SEARCH',	(int)$k_config['show_rb_ipsmuy'][2]);
	define('SHOW_RB_ON_MCP',	(int)$k_config['show_rb_ipsmuy'][3]);
	define('SHOW_RB_ON_UCP',	(int)$k_config['show_rb_ipsmuy'][4]);
	define('SHOW_RB_ON_MEM',	(int)$k_config['show_rb_ipsmuy'][5]);

	$user_id = $user->data['user_id'];

    $sql = 'SELECT html_file_name, position
        FROM ' . K_BLOCKS_TABLE . '
        WHERE active = 1 AND view_by != 0';

    $result = $db->sql_query($sql,600);

    $active_blocks = array();

    while ($row = $db->sql_fetchrow($result))
    {
        $active_blocks[] = $row;
    }

    foreach($active_blocks as $active_block)
    {
        $filename = substr($active_block['html_file_name'], 0, strpos($active_block['html_file_name'], '.'));

		if(file_exists($phpbb_root_path . 'blocks/' . $filename . '.' . $phpEx))
		{

			// treat viewforum as an index page //
			if($this_page[0] == 'viewforum' || $this_page[0] == 'viewtopic')
				$this_page[0] = 'index';
			// treat new pages web/porta_page ect as portal for now...
			if($this_page[0] == 'portal_page' || $this_page[0] == 'basic_rules' || $this_page[0] == 'inprogress')
				$this_page[0] = 'portal';


			switch($this_page[0])
			{
				case 'faq':
				case 'inprogress':
				case 'basic_rules':
				case 'portal':
				{
					if(SHOW_LB_ON_PORTAL && $active_block['position'] == 'L' || SHOW_RB_ON_PORTAL && $active_block['position'] == 'R' || $active_block['position'] == 'C')
					{
						include($phpbb_root_path . 'blocks/' . $filename . '.' . $phpEx); 
						$show_left = SHOW_LB_ON_PORTAL;
						$show_right = SHOW_RB_ON_PORTAL;
					}
				}
				break;
				case 'search':
				{
					if(SHOW_LB_ON_SEARCH && $active_block['position'] == 'L' || SHOW_RB_ON_SEARCH && $active_block['position'] == 'R' || $active_block['position'] == 'C')
					{
						include($phpbb_root_path . 'blocks/' . $filename . '.' . $phpEx); 
						$show_left = SHOW_LB_ON_SEARCH;
						$show_right = SHOW_RB_ON_SEARCH;
					}
				}
				break;

				case 'index':
				{
					if(SHOW_LB_ON_INDEX && $active_block['position'] == 'L' || SHOW_RB_ON_INDEX && $active_block['position'] == 'R')
					{
						include($phpbb_root_path . 'blocks/' . $filename . '.' . $phpEx); 
						$show_left = SHOW_LB_ON_INDEX;
						$show_right = SHOW_RB_ON_INDEX;
					}
					else
					if(SHOW_LB_ON_MEM && $active_block['position'] == 'L' || SHOW_RB_ON_MEM && $active_block['position'] == 'R')
					{
						include($phpbb_root_path . 'blocks/' . $filename . '.' . $phpEx); 
						$show_left = SHOW_LB_ON_MEM;
						$show_right = SHOW_RB_ON_MEM;
					}
					break;
				}

				case 'memberlist':
				{
					if(SHOW_LB_ON_MEM && $active_block['position'] == 'L' || SHOW_RB_ON_MEM && $active_block['position'] == 'R')
					{
						include($phpbb_root_path . 'blocks/' . $filename . '.' . $phpEx); 
						$show_left = SHOW_LB_ON_MEM;
						$show_right = SHOW_RB_ON_MEM;
					}
					break;
				}

				case 'mcp':
				{
					if(SHOW_LB_ON_MCP && $active_block['position'] == 'L' || SHOW_RB_ON_MCP && $active_block['position'] == 'R')
					{
						include($phpbb_root_path . 'blocks/' . $filename . '.' . $phpEx); 
						$show_left = SHOW_LB_ON_MCP;
						$show_right = SHOW_RB_ON_MCP;
					}
					break;
				}
				case 'ucp':
				{
					if(SHOW_LB_ON_UCP && $active_block['position'] == 'L' || SHOW_RB_ON_UCP && $active_block['position'] == 'R')
					{
						include($phpbb_root_path . 'blocks/' . $filename . '.' . $phpEx); 
						$show_left = SHOW_LB_ON_UCP;
						$show_right = SHOW_RB_ON_UCP;
					}
					break;
				}
				default:
					if($k_config['display_blocks_global'])
						include($phpbb_root_path . 'blocks/' . $filename . '.' . $phpEx);
					break;
			}
		}
    }

	//MOD//$sql = "SELECT group_id, user_type, user_style, user_avatar, user_avatar_type, user_country_flag FROM " . USERS_TABLE . " WHERE user_id = $user_id";

	$sql = "SELECT group_id, user_type, user_style, user_avatar, user_avatar_type
		FROM " . USERS_TABLE . "
		WHERE user_id = $user_id";

	if( $result = $db->sql_query($sql,300) )
	{
		$row = $db->sql_fetchrow($result);
		$user_avatar = $row['user_avatar'];
		//$user_country_flag	= $row['user_country_flag'];
		$user_style = $row['user_style'];
		$usertype = $row['user_type'];
		$groupid = $row['group_id'];
		$db->sql_freeresult($result);
	}
	else
		trigger_error('Error! See: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);

	$sql = 'SELECT *
		FROM ' . K_BLOCKS_CONFIG_TABLE;

	if( $result = $db->sql_query($sql) )
	{
		$row = $db->sql_fetchrow($result);

		$blocks_width 	= (int)$row['blocks_width'];
		$blocks_enabled = $row['blocks_enabled'];
		$db->sql_freeresult($result);
	}
	else
		trigger_error('Error! See: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);

	function portal_block_template($info)
	{
		global $template;

		// set template filename
		$template->set_filenames(array('name' => 'blocks/' . $info));

		// Return templated data
		return $template->assign_display('name');
	}

	$block_ary = array();

	$use_block_cookies =  $k_config['use_cookies'];

	$block_arrange_cookie = $config['cookie_name'] . '_CSET';

	if((!isset($_COOKIE['sgp_im3_LB']) && !isset($_COOKIE['sgp_im3_CB']) && !isset($_COOKIE['sgp_im3_RB'])))
		$use_block_cookies = false;
		
	// Get this user group
	//$group_name = which_group($groupid); //do we need this one anymore? see below...
	
	//get all groups for processing later
	get_all_groups();
	$memberships = array();
	$memberships = group_memberships(false, $user->data['user_id'], false);
	
	if($use_block_cookies && (request_var($block_arrange_cookie, '', '', true)))
	{
		$LBA = array();
		$CBA = array();
		$RBA = array();
		$row = array();
		$main = 0;
		$L = $C = $R = 0;

		if(isset($_COOKIE['sgp_im3_LB']))
		{
			$left = request_var('sgp_im3_LB', '', false, true);
			$left = str_replace("left[]=", "", $left);
			$left = str_replace("&amp;", ',', $left);
			$LBA = explode(',', $left);

			$sql = 'SELECT * FROM ' . K_BLOCKS_TABLE . ' WHERE active = 1 AND ' . $db->sql_in_set('id', $LBA)  . ' ORDER BY find_in_set(id,' . '\'' . $left . '\')';
			if($result = $db->sql_query($sql))
			{
				while($row[$main] = $db->sql_fetchrow($result))
				{
					$row[$main]['position'] = 'L';
					$main++;
				}
			}
		}

		if(isset($_COOKIE['sgp_im3_CB']))
		{
			$center = request_var('sgp_im3_CB', '', false, true);
			$center = str_replace("center[]=&amp;", "", $center);
			$center = str_replace("center[]=", "", $center);
			$center = str_replace("&amp;", ',', $center);
			$CBA = explode(',', $center);

			$sql = 'SELECT * FROM ' . K_BLOCKS_TABLE . ' WHERE active = 1 AND ' . $db->sql_in_set('id', $CBA)  . ' ORDER BY find_in_set(id,' . '\'' . $center . '\')';
			if($result = $db->sql_query($sql))
			{
				while($row[$main] = $db->sql_fetchrow($result))
				{
					$row[$main]['position'] = 'C';
					$main++;
				}
			}
		}

		if(isset($_COOKIE['sgp_im3_RB']))
		{
			$right = request_var('sgp_im3_RB', '', false, true);
			$right = str_replace("right[]=", "", $right);
			$right = str_replace("&amp;", ',', $right);
			$RBA = explode(',', $right);

			$sql = 'SELECT * FROM ' . K_BLOCKS_TABLE . ' WHERE active = 1 AND ' . $db->sql_in_set('id', $RBA) . ' ORDER BY find_in_set(id,' . '\'' . $right . '\')';
			if($result = $db->sql_query($sql))
			{
				while($row[$main] = $db->sql_fetchrow($result))
				{
					$row[$main]['position'] = 'R';
					$main++;
				}
			}
		}

		/* this code can be reduced later... Mike */
		for($i = 0; $i < count($row); $i++)
		{
			$block_id			= $row[$i]['id'];
			$block_ndx			= $row[$i]['ndx'];
			$block_title		= $row[$i]['title'];
			$block_position 	= $row[$i]['position'];
			$block_active		= $row[$i]['active'];
			$block_type			= $row[$i]['type'];
			$block_view_by		= $row[$i]['view_by'];
			$block_scroll		= $row[$i]['scroll'];
			$block_height		= $row[$i]['block_height'];
			$html_file_name		= $row[$i]['html_file_name'];
			$img_file_name		= $row[$i]['img_file_name'];

			$process_block = false;

			// Convert Menu Name to language variable... leave alone if not found!

			$block_title = $row[$i]['title'];

			$name = strtoupper($row[$i]['title']);
			$name = str_replace(" ","_", $name);
			$block_title = (!empty($user->lang[$name])) ? $user->lang[$name] : $block_title;
			
			// Advanced group options...
			
			if($block_view_by == 0)
			{
				$process_block = false;
			}
			else
			{
				if ($memberships)
				{
					foreach ($memberships as $member)
					{
						$group_name = $k_group_id[$member['group_id']]['group_name'];
						if($block_view_by == $member['group_id'] || $member['group_id'] == $k_group_name_id['ADMINISTRATORS'])
						{
							$process_block = true;
						}
						else
						{
							$loop_count++;
							switch($group_name)
							{
								case 'Guests':
								case 'GUESTS':
								case 'Anonymous':
								case 'ANONYMOUS':

									if($block_view_by == 1 || $block_view_by == $k_group_name_id['GUESTS']) $process_block = true;

								break;

								case 'Registered':
								case 'REGISTERED':
									
									if($block_view_by < 4 || $block_view_by < $k_group_name_id['GLOBAL_MODERATORS']) $process_block = true;

								break;

								case 'Registered Coppa':
								case 'REGISTERED_COPPA':		

									if($block_view_by < 4 || $block_view_by < $k_group_name_id['GLOBAL_MODERATORS']) $process_block = true;

								break;

								case 'Global Moderators':
								case 'GLOBAL_MODERATORS':		

										if($block_view_by < 5 || $block_view_by < $k_group_name_id['ADMINISTRATORS']) $process_block = true;

								break;

								case 'Bots':
								case 'BOTS':

									if($block_view_by ==  1 || $block_view_by ==  6 || $block_view_by ==  $k_group_name_id['GUESTS'] || $block_view_by ==  $k_group_name_id['BOTS']) $process_block = true;

								break;
								
								default:

									if($block_view_by == $loop_count || $block_view_by < 3 || $block_view_by < $k_group_name_id['REGISTERED_COPPA']) $process_block = true;
							}
						}
					}
					$loop_count = 0;
				}
				else
				{
					$process_block = false;
				}
			}
			
			if($process_block && $block_view_by > 0)
			{
				switch($block_position)
				{
					case 'L':
					{
						$left_block_ary[$L]  	= $html_file_name;
						$left_block_id[$L] 		= $block_id;
						$left_block_ndx[$L] 	= $block_ndx;
						$left_block_title[$L] 	= $block_title;
						$left_block_img[$L]	 	= $img_file_name;
						$left_block_scroll[$L]  = $block_scroll;
						$left_block_height[$L]	= $block_height;
					$L++;
						break;
					}
					case 'C':
					{
						$center_block_ary[$C]		= $html_file_name;
						$center_block_id[$C] 		= $block_id;
						$center_block_ndx[$C] 		= $block_ndx;
						$center_block_title[$C]		= $block_title;
						$center_block_img[$C]		= $img_file_name;
						$center_block_scroll[$C]  	= $block_scroll;
						$center_block_height[$C]	= $block_height;
						$C++;
					break;
					}
					case 'R':
					{
						$right_block_ary[$R]	= $html_file_name;
						$right_block_id[$R] 	= $block_id;
						$right_block_ndx[$R] 	= $block_ndx;
						$right_block_title[$R]	= $block_title;
						$right_block_img[$R]	= $img_file_name;
						$right_block_scroll[$R]	= $block_scroll;
						$right_block_height[$R]	= $block_height;
						$R++;
						break;
					}
					default:
				}
			}
		}
	}
	else
	{
		// Get all active blocks //
		$sql = 'SELECT * FROM ' . K_BLOCKS_TABLE . ' WHERE active = 1 ORDER BY ndx ASC';
		if($result = $db->sql_query($sql,600))
		{
			$L = $R = $C = 0;

			while ($row = $db->sql_fetchrow($result))
			{
				$block_id		= $row['id'];
				$block_ndx		= $row['ndx'];
				$block_title	= $row['title'];
				$block_position = $row['position'];
				$block_active	= $row['active'];
				$block_type		= $row['type'];
				$block_view_by	= $row['view_by'];
				$block_scroll	= $row['scroll'];
				$block_height	= $row['block_height'];
				$html_file_name	= $row['html_file_name'];
				$img_file_name	= $row['img_file_name'];

				$process_block = false;

				// Conver Menu Name to language variable if it is available else leave it alone...
				$block_title = $row['title'];
				$name = strtoupper($row['title']);
				$name = str_replace(" ","_", $name);
				$block_title = (!empty($user->lang[$name])) ? $user->lang[$name] : $block_title;
				
				// Advanced group options...
				
				if($block_view_by == 0)
				{
					$process_block = false;
				}
				else
				{
					if ($memberships)
					{
						foreach ($memberships as $member)
						{
							$group_name = $k_group_id[$member['group_id']]['group_name'];
							if($block_view_by == $member['group_id'] || $member['group_id'] == $k_group_name_id['ADMINISTRATORS'])
							{
								$process_block = true;
							}
							else
							{
								$loop_count++;
								switch($group_name)
								{
									case 'Guests':
									case 'GUESTS':
									case 'Anonymous':
									case 'ANONYMOUS':			if($block_view_by == 1 || $block_view_by == $k_group_name_id['GUESTS']) $process_block = true;
									break;

									case 'Registered':
									case 'REGISTERED':			if($block_view_by < 4 || $block_view_by < $k_group_name_id['GLOBAL_MODERATORS']) $process_block = true;
									break;

									case 'Registered Coppa':
									case 'REGISTERED_COPPA':	if($block_view_by < 4 || $block_view_by < $k_group_name_id['GLOBAL_MODERATORS']) $process_block = true;
									break;

									case 'Global Moderators':
									case 'GLOBAL_MODERATORS':	if($block_view_by < 5 || $block_view_by < $k_group_name_id['ADMINISTRATORS']) $process_block = true;
									break;

									case 'Bots':
									case 'BOTS':				if($block_view_by ==  1 || $block_view_by ==  6 || $block_view_by ==  $k_group_name_id['GUESTS'] || $block_view_by ==  $k_group_name_id['BOTS']) $process_block = true;
									break;

									default:
										if($block_view_by == $loop_count || $block_view_by < 3 || $block_view_by < $k_group_name_id['REGISTERED_COPPA']) $process_block = true;
								}
							}
						}
						$loop_count = 0;
					}
					else
					{
						$process_block = false;
					}
				}
				
				if($process_block && $block_view_by > 0)
				{
					switch($block_position)
					{
						case 'L':
						{
							$left_block_ary[$L]		= $html_file_name;
							$left_block_id[$L]		= $block_id;
							$left_block_ndx[$L]		= $block_ndx;
							$left_block_title[$L]	= $block_title;
							$left_block_img[$L]		= $img_file_name;
							$left_block_scroll[$L]	= $block_scroll;
							$left_block_height[$L]	= $block_height;
							$L++;
							break;
						}
						case 'C':
						{
							$center_block_ary[$C]		= $html_file_name;
							$center_block_id[$C]		= $block_id;
							$center_block_ndx[$C]		= $block_ndx;
							$center_block_title[$C]		= $block_title;
							$center_block_img[$C]		= $img_file_name;
							$center_block_scroll[$C]	= $block_scroll;
							$center_block_height[$C]	= $block_height;
							$C++;
							break;
						}
						case 'R':
						{
							$right_block_ary[$R]	= $html_file_name;
							$right_block_id[$R] 	= $block_id;
							$right_block_ndx[$R] 	= $block_ndx;
							$right_block_title[$R]	= $block_title;
							$right_block_img[$R]	= $img_file_name;
							$right_block_scroll[$R]	= $block_scroll;
							$right_block_height[$R]	= $block_height;
							$R++;
							break;
						}
						default:
					}
				}
			}
		}
		else
		{
			trigger_error('Error! See: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__); 
		}
	}

	$db->sql_freeresult($result);

if(isset($left_block_ary))
{
	foreach ($left_block_ary as $block => $value)
	{
    	$template->assign_block_vars('left_block_files', array(
        	'LEFT_BLOCKS'			=> portal_block_template($value),
	        'LEFT_BLOCK_ID'			=> 'L_' .$left_block_id[$block],
    	    'LEFT_BLOCK_TITLE'		=> $left_block_title[$block],
			'LEFT_BLOCK_SCROLL' 	=> $left_block_scroll[$block],
			'LEFT_BLOCK_HEIGHT'		=> $left_block_height[$block],
			'LEFT_BLOCK_IMG'		=> ($left_block_img[$block]) ? '<img src="' . $phpbb_root_path . 'images/block_images/small/' . $left_block_img[$block] . '" alt="" />' : '<img src="' . $phpbb_root_path . 'images/block_images/small/none.gif" height="1px" width="1px" alt="" >',
			'LEFT_BLOCK_IMG_2'		=> (file_exists($big_image_path . $left_block_img[$block])) ? '<img src="' . $big_image_path  . $left_block_img[$block] . '" alt="" />' : '<img src="' . $phpbb_root_path . 'images/block_images/large/none.png" alt="" >',
			'S_CONTENT_FLOW_BEGIN'	=> ($user->lang['DIRECTION'] == 'ltr') ? 'left' : 'right',
			'S_CONTENT_FLOW_END'	=> ($user->lang['DIRECTION'] == 'ltr') ? 'right' : 'left',
    	));
		//echo strtolower($left_block_title[$block]);echo '<br />';
	}
}

if(isset($right_block_ary))
{
	foreach ($right_block_ary as $block => $value)
	{
    	$template->assign_block_vars('right_block_files', array(
        	'RIGHT_BLOCKS'			=> portal_block_template($value),
	        'RIGHT_BLOCK_ID'		=> 'R_' .$right_block_id[$block],
    	    'RIGHT_BLOCK_TITLE'		=> $right_block_title[$block],
			'RIGHT_BLOCK_SCROLL'	=> $right_block_scroll[$block],
			'RIGHT_BLOCK_HEIGHT'	=> $right_block_height[$block],
			'RIGHT_BLOCK_IMG'		=> ($right_block_img[$block]) ? '<img src="' . $phpbb_root_path . 'images/block_images/small/' . $right_block_img[$block] . '" alt="" />' : '<img src="' . $phpbb_root_path . 'images/block_images/small/none.gif" height="1px" width="1px" alt="" >',
			'RIGHT_BLOCK_IMG_2'		=> (file_exists($big_image_path . $right_block_img[$block])) ? '<img src="' . $big_image_path  . $right_block_img[$block] . '" alt="" />' : '<img src="' . $phpbb_root_path . 'images/block_images/large/none.png" alt="" >',

			'S_CONTENT_FLOW_BEGIN'	=> ($user->lang['DIRECTION'] == 'ltr') ? 'left' : 'right',
			'S_CONTENT_FLOW_END'	=> ($user->lang['DIRECTION'] == 'ltr') ? 'right' : 'left',
    	));
	}
}

if(isset($center_block_ary))
{
	foreach ($center_block_ary as $block => $value)
	{
		// As it is not always possible to display all data as intended in a narrow block (left or right blocks) we automatically load a wide layout if it exists //
		$my_file_wide = "{$phpbb_root_path}styles/" . $user->theme['template_path'] . '/template/blocks/' . $value;
		$my_file_wide = str_replace('.html', '_wide.html', $my_file_wide);

		if(file_exists($my_file_wide))
			$value = str_replace('.html', '_wide.html', $value);

    	$template->assign_block_vars('center_block_files', array(
        	'CENTER_BLOCKS'			=> portal_block_template($value),
	        'CENTER_BLOCK_ID'		=> 'C_' .$center_block_id[$block],
    	    'CENTER_BLOCK_TITLE'	=> $center_block_title[$block],
			'CENTER_BLOCK_SCROLL'	=> $center_block_scroll[$block],
			'CENTER_BLOCK_HEIGHT'	=> $center_block_height[$block],
			'CENTER_BLOCK_IMG'		=> ($center_block_img[$block]) ? '<img src="' . $phpbb_root_path . 'images/block_images/small/' . $center_block_img[$block] . '" alt="" />' : '<img src="' . $phpbb_root_path . 'images/block_images/small/none.gif" height="1px" width="1px" alt="" >',
			'CENTER_BLOCK_IMG_2'	=> (file_exists($big_image_path . $center_block_img[$block])) ? '<img src="' . $big_image_path  . $center_block_img[$block] . '" alt="" />' : '<img src="' . $phpbb_root_path . 'images/block_images/large/none.png" alt="" >',

			'S_CONTENT_FLOW_BEGIN'	=> ($user->lang['DIRECTION'] == 'ltr') ? 'left' : 'right',
			'S_CONTENT_FLOW_END'	=> ($user->lang['DIRECTION'] == 'ltr') ? 'right' : 'left',
	    ));
	}
}


$template->assign_vars(array(
	'AVATAR'            => sgp_get_user_avatar($user->data['user_avatar'], $user->data['user_avatar_type'], $user->data['user_avatar_width'], $user->data['user_avatar_height']),
	'BLOCK_WIDTH'       => $blocks_width . 'px',

	'PORTAL_ACTIVE'		=> $config['portal_enabled'],
	'PORTAL_VERSION'	=> $config['portal_version'],
	'READ_ARTICLE_IMG'	=> $user->img('btn_read_article', 'READ_ARTICLE'),
	'POST_COMMENTS_IMG'	=> $user->img('btn_post_comments', 'POST_COMMENTS'),
	'VIEW_COMMENTS_IMG'	=> $user->img('btn_view_comments', 'VIEW_COMMENTS'),

	'SITE_NAME'				=> $config['sitename'],
	'S_USER_LOGGED_IN'		=> ($user->data['user_id'] != ANONYMOUS) ? true : false,

	'S_SHOW_LEFT_BLOCKS'	=> $show_left,
	'S_SHOW_RIGHT_BLOCKS'	=> $show_right,

	'S_BLOCKS_ENABLED' 			=> $blocks_enabled,
	'S_ALLOW_FOOTER_IMAGES'		=> ($k_config['allow_footer_images']) ? true : false,
	'S_CONTENT_FLOW_BEGIN'		=> ($user->lang['DIRECTION'] == 'ltr') ? 'left' : 'right',
	'S_CONTENT_FLOW_END'		=> ($user->lang['DIRECTION'] == 'ltr') ? 'right' : 'left',

	'USER_NAME'         => $user->data['username'],
	'USERNAME_FULL'	    => get_username_string('full', $user->data['user_id'], $user->data['username'], $user->data['user_colour']),
	'U_INDEX'			=> append_sid("{$phpbb_root_path}index.$phpEx"),
	'U_PORTAL'			=> append_sid("{$phpbb_root_path}portal.$phpEx"),
	'U_PORTAL_ARRANGE'	=> append_sid("{$phpbb_root_path}portal.$phpEx"."?arrange=1"),
	'U_STAFF'	        => append_sid("{$phpbb_root_path}memberlist.$phpEx", '?mode=leaders'),
	'U_SEARCH_BOOKMARKS'=> append_sid("{$phpbb_root_path}ucp.$phpEx", '&amp;i=main&mode=bookmarks'),
	'LEFT_BLOCKS'		=> $L,
	'CENTRE_BLOCKS'		=> $C,
	'RIGHT_BLOCKS'		=> $R,

));

?>