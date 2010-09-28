<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Saturday, Jan 22, 2005
* @copyright (c) 2005-2009 phpbbireland
* @home	http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*		this is part of the Stargate Portal copyright agreement...
*
* @version $Id: sgp_portal_blocks.php 314 23 November 2009 22:02:31Z Michealo $
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

	// If portal is not active return //
	if (!STARGATE)
	{
		return;
	}

	global $user, $phpbb_root_path, $config, $k_config;

	$sgp_cache_time = $k_config['sgp_cache_time'];

	$phpEx = substr(strrchr(__FILE__, '.'), 1);

	$user->add_lang('portal/portal');
	$user->add_lang('portal/portal_blocks_variables');

	$all = '';
	$old = false;

	$sql = 'SELECT *
		FROM ' . K_BLOCKS_CONFIG_TABLE;

	if ($result = $db->sql_query($sql))
	{
		$row = $db->sql_fetchrow($result);

		$blocks_width 	= (int)$row['blocks_width'];
		$blocks_enabled = $row['blocks_enabled'];
		$db->sql_freeresult($result);
	}
	else
	{
		trigger_error($user->lang['ERROR_PORTAL_CONFIG'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__); 
	}

	// if block disabled just return... //
	if (!$blocks_enabled) 
	{
		$template->assign_vars(array(
			'PORTAL_MESSAGE' => $user->lang('BLOCKS_DISABLED'),
		));
		return;
	}

	global $db, $config, $k_blocks, $user, $user_id, $avatar_img;
	global $template, $auth, $phpbb_root_path, $phpEx, $SID;
	global $k_config, $k_groups, $k_group_id, $k_group_name_id;

	$k_groups = $k_group_name_id = $k_group_id = array();

	$show_center = $show_left = $show_right = false;

	$big_image_path = $phpbb_root_path . 'images/block_images/large/';

	$loop_count = 0;

	$this_page = explode(".", $user->page['page']);

	$user_id = $user->data['user_id'];

	$sql = 'SELECT id, html_file_name, position, view_pages, title
		FROM ' . K_BLOCKS_TABLE . '
		WHERE active = 1 
			AND (view_by != 0 OR view_all = 1)';

	$result = $db->sql_query($sql, $sgp_cache_time);

	$active_blocks = array();

	while ($row = $db->sql_fetchrow($result))
	{
		$active_blocks[] = $row;
		$arr[$row['id']] = explode(','  , $row['view_pages']);
	}

	include($phpbb_root_path . 'blocks/block_build' . '.' . $phpEx);

	foreach ($active_blocks as $active_block)
	{
		$filename = substr($active_block['html_file_name'], 0, strpos($active_block['html_file_name'], '.'));

		if (file_exists($phpbb_root_path . 'blocks/' . $filename . '.' . $phpEx))
		{
			$this_page_name = $this_page[0];

			if (!$k_config['display_blocks_global']) 
			{
				$this_page_name = '';
			}
			
			$page_id = get_page_id($this_page_name);

			if(in_array($page_id, $arr[$active_block['id']]))
			{
				include($phpbb_root_path . 'blocks/' . $filename . '.' . $phpEx);
			}
		}
	}

	$sql = "SELECT group_id, user_type, user_style, user_avatar, user_avatar_type
		FROM " . USERS_TABLE . "
		WHERE user_id = $user_id";

	if ($result = $db->sql_query($sql, $sgp_cache_time))
	{
		$row = $db->sql_fetchrow($result);
		$user_avatar = $row['user_avatar'];
		$user_style = $row['user_style'];
		$usertype = $row['user_type'];
		$groupid = $row['group_id'];
		$db->sql_freeresult($result);
	}
	else
	{
		trigger_error($user->lang['ERROR_USER_TABLE'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__); 
	}

	$use_block_cookies =  $k_config['use_cookies'];

	//get all groups for processing later
	get_all_groups();

	$memberships = array();
	$memberships = sgp_group_memberships(false, $user->data['user_id'], false);

	// We use cookies to temporarily hold block positions and here we save positions to user table //
	if ($use_block_cookies)
	{
		if (isset($_COOKIE[$config['cookie_name'] . '_sgp_left']) || isset($_COOKIE[$config['cookie_name'] . '_sgp_center']) || isset($_COOKIE[$config['cookie_name'] . '_sgp_right']))
		{
			$left = request_var($config['cookie_name'] . '_sgp_left', '', false, true);
			$left = str_replace("left[]=", "", $left);
			$left = str_replace("&amp;", ',', $left);
			$LBA = explode(',', $left);

			$sql = 'UPDATE ' . USERS_TABLE . '
				SET user_left_blocks = ' . "'" . $left . "'" . '
				WHERE user_id = ' . $user->data['user_id'];
			$db->sql_query($sql);

			$center = request_var($config['cookie_name'] . '_sgp_center', '', false, true);
			$center = str_replace("center[]=&amp;", "", $center);
			$center = str_replace("center[]=", "", $center);
			$center = str_replace("&amp;", ',', $center);
			$CBA = explode(',', $center);

			$sql = 'UPDATE ' . USERS_TABLE . '
				SET user_center_blocks = ' . "'" . $center . "'" . '
				WHERE user_id = ' . $user->data['user_id'];
			$db->sql_query($sql);

			$right = request_var($config['cookie_name'] . '_sgp_right', '', false, true);
			$right = str_replace("right[]=", "", $right);
			$right = str_replace("&amp;", ',', $right);
			$RBA = explode(',', $right);

			$sql = 'UPDATE ' . USERS_TABLE . '
				SET user_right_blocks = ' . "'" . $right . "'" . '
				WHERE user_id = ' . $user->data['user_id'];
			$db->sql_query($sql);

			// this does not appear to be functioning? //
			$set_time = time() - 31536000;
			$user->set_cookie('sgp_left', '', $set_time);
			$user->set_cookie('sgp_center', '', $set_time);
			$user->set_cookie('sgp_right', '', $set_time);

			// The drag and drop script sets cache time to 0 if used, else it sets cache time to 300//
			$sgp_cache_time = request_var($config['cookie_name'] . '_sgp_block_cache', '', false, true);
		}
	}

	// get the block positions from user table 08 September 2010 //
	$sql = 'SELECT user_left_blocks, user_center_blocks, user_right_blocks
		FROM ' . USERS_TABLE . '
		WHERE user_id = ' . $user->data['user_id'];

	if ($result = $db->sql_query($sql, $sgp_cache_time))
	{
		$row = $db->sql_fetchrow($result);

		$left = $row['user_left_blocks'];
		$LB = explode(',', $left);
		$center = $row['user_center_blocks'];
		$CB = explode(',', $center);
		$right = $row['user_right_blocks'];
		$RB = explode(',', $right);

		$LCR = array_merge((array)$LB, (array)$CB, (array)$RB);

		$left .= ','; 
		$all .= $left .= $center .= $right;

		$sql = 'SELECT * 
			FROM ' . K_BLOCKS_TABLE . ' 
			WHERE active = 1 
				AND ' . $db->sql_in_set('id', $LCR) . ' 
			ORDER BY find_in_set(id,' . '\'' . $all . '\')';
	}

	// If no user block layout are set, we use default positions //
	if($row['user_left_blocks'] == '' || $row['user_center_blocks'] == '' || $row['user_right_blocks'] == '')
	{
		$sql = 'SELECT * 
			FROM ' . K_BLOCKS_TABLE . ' 
			WHERE active = 1
			ORDER BY ndx ASC';
	}

	if ($result = $db->sql_query($sql, $sgp_cache_time))
	{
		$L = $R = $C = 0;

		while ($row = $db->sql_fetchrow($result))
		{
			$block_position = $row['position'];

			// override default position with user designated position //
			if (in_array($row['id'], $LB)) 
			{
				$block_position		= 'L';
			} else if (in_array($row['id'], $CB)) 
			{
				$block_position		= 'C';
			} else if (in_array($row['id'], $RB)) 
			{
				$block_position		= 'R';
			}

			$block_id			= $row['id'];
			$block_ndx			= $row['ndx'];
			$block_title		= $row['title'];
			$block_active		= $row['active'];
			$block_type			= $row['type'];
			$block_view_by		= $row['view_by'];
			$block_view_groups	= $row['view_groups'];
			$block_view_all		= $row['view_all'];
			$block_scroll		= $row['scroll'];
			$block_height		= $row['block_height'];
			$html_file_name		= $row['html_file_name'];
			$img_file_name		= $row['img_file_name'];
			$view_pages			= $row['view_pages'];

			$arr = explode(',', $view_pages);
			$grps = explode(",", $block_view_groups);

			$process_block = false;
			$block_title = get_menu_lang_name($row['title']);

			// Advanced group options...

			// is block active //
			if ($block_view_by == 0)
			{
				$process_block = false;
			}
			else
			{
				// process blocks for different groups //
				if ($memberships)
				{
					foreach ($memberships as $member)
					{
						// First we check to see if the view_all over-ride is set (saves having to enter all groups) //
						if ($block_view_all)
						{
							$process_block = true;
						}
						else if ($block_view_by == $member['group_id'])	// Now we check for the users group id ($block_view_all is not set)... We also allow all blocks for admin //
						{
							$process_block = true;
						}
						else
						{
							for ($j = 0; $j < count($grps); $j++) // now we loop for all group the user is in //
							{
								if ($grps[$j] == $member['group_id'])
								{
									$process_block = true;
								}
							}
						}
					}
				}
				else
				{
					$process_block = false;
				}
			}

			$page_id = get_page_id($this_page_name);

			if($process_block && $block_view_by > 0 && in_array($page_id, $arr))
			{
				switch($block_position)
				{
					case 'L':
							$left_block_ary[$L]		= $html_file_name;
							$left_block_id[$L]		= $block_id;
							$left_block_ndx[$L]		= $block_ndx;
							$left_block_title[$L]	= $block_title;
							$left_block_img[$L]		= $img_file_name;
							$left_block_scroll[$L]	= $block_scroll;
							$left_block_height[$L]	= $block_height;
							$L++;
							$show_left = show_blocks($this_page_name, $block_position);
					break;
					case 'C':
							$center_block_ary[$C]		= $html_file_name;
							$center_block_id[$C]		= $block_id;
							$center_block_ndx[$C]		= $block_ndx;
							$center_block_title[$C]		= $block_title;
							$center_block_img[$C]		= $img_file_name;
							$center_block_scroll[$C]	= $block_scroll;
							$center_block_height[$C]	= $block_height;
							$C++;
							$show_center = show_blocks($this_page_name, $block_position);
					break;
					case 'R':
							$right_block_ary[$R]	= $html_file_name;
							$right_block_id[$R] 	= $block_id;
							$right_block_ndx[$R] 	= $block_ndx;
							$right_block_title[$R]	= $block_title;
							$right_block_img[$R]	= $img_file_name;
							$right_block_scroll[$R]	= $block_scroll;
							$right_block_height[$R]	= $block_height;
							$R++;
							$show_right = show_blocks($this_page_name, $block_position);
					break;
					default:
				}
			}
		}
	}
	else
	{
		trigger_error($user->lang['ERROR_PORTAL_BLOCKS'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__); 
	}
	$db->sql_freeresult($result);

if (isset($left_block_ary) && $show_left)
{
	foreach ($left_block_ary as $block => $value)
	{
		$template->assign_block_vars('left_block_files', array(
			'LEFT_BLOCKS'			=> portal_block_template($value),
			'LEFT_BLOCK_ID'			=> 'L_' .$left_block_id[$block],
			'LEFT_BLOCK_TITLE'		=> $left_block_title[$block],
			'LEFT_BLOCK_SCROLL'		=> $left_block_scroll[$block],
			'LEFT_BLOCK_HEIGHT'		=> $left_block_height[$block],
			'LEFT_BLOCK_IMG'		=> ($left_block_img[$block]) ? '<img src="' . $phpbb_root_path . 'images/block_images/small/' . $left_block_img[$block] . '" alt="" />' : '<img src="' . $phpbb_root_path . 'images/block_images/small/none.gif" height="1px" width="1px" alt="" >',
			'LEFT_BLOCK_IMG_2'		=> (file_exists($big_image_path . $left_block_img[$block])) ? '<img src="' . $big_image_path  . $left_block_img[$block] . '" alt="" />' : '<img src="' . $phpbb_root_path . 'images/block_images/large/none.png" alt="" >',
			'S_CONTENT_FLOW_BEGIN'	=> ($user->lang['DIRECTION'] == 'ltr') ? 'left' : 'right',
			'S_CONTENT_FLOW_END'	=> ($user->lang['DIRECTION'] == 'ltr') ? 'right' : 'left',
		));
	}
}

if (isset($right_block_ary) && $show_right)
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

if (isset($center_block_ary) && $show_center)
{
	foreach ($center_block_ary as $block => $value)
	{
		// As it is not always possible to display all data as intended in a narrow block (left or right blocks) we automatically load a wide layout if it exists //
		// We check the default template folder and the SGP common folder templates //

		$my_file_wide = "{$phpbb_root_path}styles/" . $user->theme['template_path'] . '/template/blocks/' . $value;
		$my_file_wide = str_replace('.html', '_wide.html', $my_file_wide);

		if(file_exists($my_file_wide))
		{
			$value = str_replace('.html', '_wide.html', $value);
		}
		else
		{
			$my_file_wide = "{$phpbb_root_path}styles/portal_common/template/blocks/" . $value;
			$my_file_wide = str_replace('.html', '_wide.html', $my_file_wide);
			if(file_exists($my_file_wide))
			{
				$value = str_replace('.html', '_wide.html', $value);
			}
		}

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
	'AVATAR'			=> sgp_get_user_avatar($user->data['user_avatar'], $user->data['user_avatar_type'], $user->data['user_avatar_width'], $user->data['user_avatar_height']),
	'BLOCK_WIDTH'	   => $blocks_width . 'px',

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

	'USER_NAME'		 => $user->data['username'],
	'USERNAME_FULL'		=> get_username_string('full', $user->data['user_id'], $user->data['username'], $user->data['user_colour']),
	'U_INDEX'			=> append_sid("{$phpbb_root_path}index.$phpEx"),
	'U_PORTAL'			=> append_sid("{$phpbb_root_path}portal.$phpEx"),
	'U_PORTAL_ARRANGE'	=> append_sid("{$phpbb_root_path}portal.$phpEx", "arrange=1"),
	'U_STAFF'			=> append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=leaders'),
	'U_SEARCH_BOOKMARKS'=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'i=main&mode=bookmarks'),
));

// process common data here //
if ($this_page[0] == 'viewtopic')
{
	global $phpEx, $phpbb_root_path;
	global $config, $user, $template, $k_quick_posting_mode, $forum_id, $post_data, $topic_id, $topic_data, $k_config;

	// include_once required is here //
	// using function_exists() will still result in redeclarations errors //
	// I confirmed I could use include_once under these circumstances over a year ago (official phpBB chat with devs) // 
	include_once($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
	include_once($phpbb_root_path . 'includes/functions_display.' . $phpEx);

	if (!isset($smilies_status))
	{
		generate_smilies('inline', $forum_id);
	}	

	// HTML, BBCode, Smilies, Images and Flash status amended version
	$bbcode_status		= ($config['allow_bbcode'] && $auth->acl_get('f_bbcode', $forum_id)) ? true : false;
	$smilies_status		= ($bbcode_status && $config['allow_smilies'] && $auth->acl_get('f_smilies', $forum_id)) ? true : false;
	$img_status			= ($bbcode_status && $auth->acl_get('f_img', $forum_id)) ? true : false;
	$url_status			= ($config['allow_post_links']) ? true : false;
	$quote_status		= ($auth->acl_get('f_reply', $forum_id)) ? true : false;
	$subscribe_topic	= ($config['allow_topic_notify'] && $user->data['is_registered'] && $user->data['user_notify']) ? true : false;
	$flash_status		= ($bbcode_status && $auth->acl_get('f_flash', $forum_id)) ? true : false;
	$enable_sig			= ($config['allow_sig'] && $user->optionget('attachsig')) ? true: false;

	add_form_key('posting');

	$template->assign_vars(array(
		'STARGATE'				=> true,
		'MESSAGE'				=> '',
		'L_QUICK_TITLE'			=> $user->lang['K_QUICK_REPLY'],
		'S_QUICK_TITLE'			=> 'Re: ' . $topic_data['topic_title'],
		'S_SMILIES_ALLOWED'		=> $smilies_status, 	
		'S_LINKS_ALLOWED'		=> $url_status,
		'S_SIG_ALLOWED'			=> ($auth->acl_get('f_sigs', $forum_id) && $config['allow_sig'] && $user->data['is_registered']) ? true : false,
		'S_SIGNATURE_CHECKED'	=> ($enable_sig) ? ' checked="checked"' : '',
		'S_SUBSCRIBE' 			=> $subscribe_topic,
		'S_BBCODE_QUOTE'		=> $quote_status,	
		'S_BBCODE_IMG'			=> $img_status, 
		'S_BBCODE_FLASH'		=> $flash_status,
		'U_MORE_SMILIES' 		=> append_sid("{$phpbb_root_path}posting.$phpEx", 'mode=smilies&amp;f=' . $forum_id),
		'S_USER_LOGGED_IN'		=> ($user->data['user_id'] != ANONYMOUS) ? true : false,
		'S_K_SHOW_SMILES'		=> $k_config['k_show_smilies'],
		'QUOTE_IMG' 			=> $user->img('icon_post_quote', 'REPLY_WITH_QUOTE'),
		)
	);
}

?>