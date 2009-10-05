<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   22 July 2008
* @copyright (c) 2008 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: web_page.php 291 2008-12-24 13:28:56Z nexur $
* Updated:
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

$mode = request_var('mode','');
$video = request_var('video', '');
$cat = request_var('cat', '');

$cat = ($cat) ? $cat : 'general';

if($video)
	$mode = 'youtube';

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

global $db, $user;
$loop_count = 0;
$emp = '?';
$rating = '';

//  we only have two test pages so far so catche others and redirect...
//if($mode == '') return;

//$sql = "SELECT * FROM ". K_YOUTUBE_TABLE . " WHERE video_category = '$cat' ORDER BY id, video_rating DESC";

$sql = "SELECT * FROM ". K_YOUTUBE_TABLE . " ORDER BY video_id, video_rating DESC";

if (!$result = $db->sql_query($sql)) { trigger_error('Error! Could not query portal modules information: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__); }

$result = $db->sql_query_limit($sql, 10);

while($row = $db->sql_fetchrow($result))
{
	if($row['video_rating'] ==  '')
		$row['video_rating'] = 0;

	switch($row['video_rating'])
	{
		case 0: $rating = '';		break;
		case 1: $rating = '*';		break;
		case 2: $rating = '**';		break;
		case 3: $rating = '***';	break;
		case 4: $rating = '****';	break;
		case 5: $rating = '*****';	break;
		default ;
	}
	$template->assign_block_vars('video_loop_row', array(
		'VIDEO_CAT'		=> $row['video_category'],
		'VIDEO_WHO'		=> $row['video_who'],
		'VIDEO_TITLE'	=> $row['video_title'],
		'VIDEO_LINK'	=> $row['video_link'],
		'VIDEO_RATING'	=> $rating,
	));

	if($row['video_category'] != $emp)
	{
		$template->assign_block_vars('video_loop_row_cats', array(
			'CATS'	=> $row['video_category'],
		));
	}
	$emp = $row['video_category'];
}
$db->sql_freeresult($result);


$sql = "SELECT id, body, head, foot FROM ". K_WEB_PAGES_TABLE . " WHERE page_name = '$mode' ";
if (
	!$result = $db->sql_query($sql)) { trigger_error('Error! Could not query portal modules information: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__); 
}
$row = $db->sql_fetchrow($result);

$head_id = $row['head'];
$foot_id = $row['foot'];

$body = $row['body'];
$db->sql_freeresult($result);

$sql = "SELECT id, body FROM ". K_WEB_PAGES_TABLE . " WHERE id = '$head_id' ";
if (!$result = $db->sql_query($sql)) 
{ 
	trigger_error('Error! Could not query portal modules information: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__); 
}
$row = $db->sql_fetchrow($result);
$head = $row['body'];
$db->sql_freeresult($result);

$sql = "SELECT id, body FROM ". K_WEB_PAGES_TABLE . " WHERE id = '$foot_id' ";
if (!$result = $db->sql_query($sql)) 
{
	trigger_error('Error! Could not query portal modules information: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__); 
}
$row = $db->sql_fetchrow($result);
$foot = $row['body'];
$db->sql_freeresult($result);


/* if loops later ..
$template->assign_block_vars('web_pages_row', array(
	'HEAD'	=>  htmlspecialchars_decode($head),
	'MY_VIDEO'	=> ($video) ? $video : 'D38LdpvNRrg',
	'FOOT'	=>  htmlspecialchars_decode($foot),
));
*/


$template->assign_vars(array(
	'YT_HEADER'	=>  htmlspecialchars_decode($head),
	'MY_VIDEO'	=> ($video) ? $video : 'D38LdpvNRrg', // default if blank!
	'YT_FOOTER'	=>  htmlspecialchars_decode($foot),
));



/***
$template->assign_block_vars('web_pages_row', array(
	'YT_HEAD' =>  htmlspecialchars_decode($web_pages['info']), 
	'PAGE' =>  htmlspecialchars_decode($web_pages['info']), 
	'YT_FOOT' =>  htmlspecialchars_decode($web_pages['info']), 
));
***/
/*
while($row = $db->sql_fetchrow($result))
{
	$web_pages[] = $row;
}

for ($i = 0; $i < count($web_pages); $i++)
{
	$template->assign_block_vars('web_pages_row', array(
		'TITLE' => $web_pages[$i]['name'],
		'IMAGE' => $web_pages[$i]['image'],
		'LINK' =>  $web_pages[$i]['link'],
		'HEAD' =>  htmlspecialchars_decode($web_pages[$i]['info']), 
		'PAGE' =>  htmlspecialchars_decode($web_pages[$i]['info']), 
		'FOOT' =>  htmlspecialchars_decode($web_pages[$i]['info']), 
	));
}
*/



// Output page
//page_header($user->lang[$name]);
page_header('youtube Page');

$template->set_filenames(array(
	'body' => 'blocks/block_web_utube.html')
);

page_footer();

?>