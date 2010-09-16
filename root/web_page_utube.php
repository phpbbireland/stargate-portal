<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   22 July 2008
* @copyright (c) 2008-2009 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: web_page.php 291 2009-11-11 09:28:56Z Michaelo $
* Updated:
* This process could be cache??? Mike
*/

/**
* @ignore
*/

define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);

include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
include($phpbb_root_path . 'includes/sgp_functions.' . $phpEx);

$mode = request_var('mode','');

// use a default video //$video = request_var('video', 'http://www.youtube.com/v/dtu2h-BROHQ');

$video = request_var('video', '');
$cat = request_var('cat', 'general');
$ut_link_variable = isset($k_config['k_youtube_link']) ? $k_config['k_youtube_link'] : 'http://www.youtube.com/v/';

if($video)
{
	$mode = 'youtube';
}

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

$loop_count = 0;
$emp = '?';
$rating = '';

$sql = "SELECT * FROM ". K_YOUTUBE_TABLE . " ORDER BY video_who ASC";

if (!$result = $db->sql_query($sql)) 
{
	trigger_error($user->lang['ERROR_PORTAL_MODULE'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__); 
}

$result = $db->sql_query_limit($sql, 300);

while($row = $db->sql_fetchrow($result))
{
	if ($row['video_rating'] ==  '')
	{
		$row['video_rating'] = 0;
	}

	switch($row['video_rating'])
	{
		case 0: $rating = '';
		break;
		case 1: $rating = '*';
		break;
		case 2: $rating = '**';
		break;
		case 3: $rating = '***';
		break;
		case 4: $rating = '****';
		break;
		case 5: $rating = '*****';
		break;
		default: $rating = '';
		break;
	}

	$usr_name_full = get_user_data('full', $row['video_poster_id']);

	$template->assign_block_vars('video_loop_row', array(
		'VIDEO_CAT'			=> $row['video_category'],
		'VIDEO_WHO'			=> $row['video_who'],
		'VIDEO_TITLE'		=> $row['video_title'],
		'VIDEO_LINK'		=> append_sid("{$phpbb_root_path}web_page_utube.$phpEx", 'video=' . $ut_link_variable . $row['video_link']),
		'VIDEO_COMMENT'		=> htmlspecialchars_decode($row['video_comment']),
		'VIDEO_POSTER'		=> ($usr_name_full) ? $usr_name_full : '',
		'VIDEO_RATING'		=> $rating,
	));

	if ($video == $row['video_link'])
	{
		$template->assign_vars(array(
			'L_POSTERS_COMMENT'		=> ($usr_name_full) ? sprintf($user->lang['POSTERS_COMMENT'], $usr_name_full, htmlspecialchars_decode($row['video_comment'])) : '',
			'READY'					=> ($video) ? true : false,
		));
	}

	if ($row['video_category'] != $emp)
	{
		$template->assign_block_vars('video_loop_row_cats', array(
			'CATS'	=> $row['video_category'],
		));
	}
	$emp = $row['video_category'];
}
$db->sql_freeresult($result);


$sql = "SELECT id, page_name, page_meta, page_desc, page_extn, body, head, foot FROM ". K_WEB_PAGES_TABLE . " WHERE page_name = '$mode' ";

if (!$result = $db->sql_query($sql)) 
{ 
	trigger_error($user->lang['ERROR_PORTAL_MODULE'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__); 
}
$row = $db->sql_fetchrow($result);

$page_name = $row['page_name'];
$page_meta = $row['page_meta'];
$page_desc = $row['page_desc'];
$page_extn = $row['page_extn'];

$head_id = $row['head'];
$foot_id = $row['foot'];

$body = $row['body'];
$db->sql_freeresult($result);

$sql = "SELECT id, body FROM ". K_WEB_PAGES_TABLE . " WHERE id = '$head_id' ";

if (!$result = $db->sql_query($sql)) 
{ 
	trigger_error($user->lang['ERROR_PORTAL_MODULE'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__); 
}

$row = $db->sql_fetchrow($result);
$head = $row['body'];
$db->sql_freeresult($result);

$sql = "SELECT id, body FROM ". K_WEB_PAGES_TABLE . " WHERE id = '$foot_id' ";

if (!$result = $db->sql_query($sql)) 
{
	trigger_error($user->lang['ERROR_PORTAL_MODULE'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__); 
}

$row = $db->sql_fetchrow($result);
$foot = $row['body'];
$db->sql_freeresult($result);


// Find and replace any var in data //
$head = process_for_vars($head, true);
$body = process_for_vars($body, true);
$foot = process_for_vars($foot, true);

$vars = array("\0", "\n", "\r", "\t", '$page_name', '$page_meta', '$page_desc');
$data = array('', '', '', '', $page_name, $page_meta, $page_desc);
$head = str_replace($vars, $data, $head);

$template->assign_vars(array(
	'YT_HEADER'	=> htmlspecialchars_decode($head),
	'MY_VIDEO'	=> ($video) ? htmlspecialchars_decode($video) : '',
	'YT_FOOTER'	=> htmlspecialchars_decode($foot),
));

// Output page 
page_header($user->lang['YOUTUBE_PAGE']);

$template->set_filenames(array(
	'body' => 'blocks/block_web_utube.html')
);

page_footer();
?>