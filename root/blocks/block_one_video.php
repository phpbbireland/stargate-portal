<?php
/**
*
* @package stargate portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Saturday, Jan 22, 2005
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the copyright agreement...
*
* @version $Id$
*
* Updated: 04 March 2010
*
*/

/**
* @ignore
*/

	if (!defined('IN_PHPBB'))
	{
		exit;
	}

	$queries = $cached_queries = 0;

	$height = 0;

	$sql = "SELECT * FROM ". K_YOUTUBE_TABLE . " ORDER BY RAND() LIMIT 0,1";


	if (!$result = $db->sql_query($sql))
	{
		trigger_error('Error! Could not query portal modules information: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
	}

	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);


	if($row['video_rating'] ==  '')
	{
		$row['video_rating'] = 0;
	}

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

	if($row['video_category'])
	{
		$height = $height + 20;
	}
	if($row['video_who'])
	{
		$height = $height + 20;
	}
	if($row['video_title'])
	{
		$height = $height + 20;
	}

	// If you want a fixed video all the time, uncomment this code and add the video ID//
	// $row['video_link'] = 'put your video id here!';
	// Example = $row['video_link'] = 'dtu2h-BROHQ';

	$template->assign_vars(array(
		'VIDEO_PATH'	=> 'http://www.youtube.com/v/',
		'VIDEO_HEIGHT'	=> '80',
		'VIDEO_CAT'		=> isset($row['video_category']) ? $row['video_category'] : 'Not category given',
		'VIDEO_WHO'		=> isset($row['video_who']) ? $row['video_who'] : 'No artist given',
		'VIDEO_TITLE'	=> isset($row['video_title']) ? $row['video_title'] : 'No title given',
		'VIDEO_LINK'	=> isset($row['video_link']) ? $row['video_link'] : 'no link',
		'VIDEO_RATING'	=> $rating,
	));

	$db->sql_freeresult($result);

	// Pass any additional info
	$template->assign_vars(array(
		'ONE_VIDEO_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
	));

?>