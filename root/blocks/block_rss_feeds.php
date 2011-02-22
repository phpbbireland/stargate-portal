<?php
/**
*			Simple yet powerfull PHP class to parse RSS files.
*			copyright (c) 2007 Jiri Smika (Smix) http://phpbb3.smika.net
*			(c) 2003-2004 original lastRSS by Vojtech Semecky http://lastrss.oslab.net/
*
*   Ported and rewritten for PhpBB3 and Stargate Portal by: NeXur
*
* @package Stargate Portal
* @author  Martin Larsson - aka NeXur
* @begin   Mars 2008
* @copyright (c) 2008 Martin Larsson - aka NeXur
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_rss_feeds.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated: 27 October 2008
*
*/

/**
* @ignore
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

// Disabled while I find a bug... possibly php version related...

$phpEx = substr(strrchr(__FILE__, '.'), 1);

// include lastRSS
include($phpbb_root_path . 'includes/sgp_lastrss.'.$phpEx);

global $k_config;

if(!$k_config['rss_feeds_enabled'])
{
	$template->assign_var('S_RSS_ENABLED', false);
	return;
}

$queries = $cached_queries = 0;

function ShowRSSdesc($url) 
{
    global $rss, $user, $phpbb_root_path;
	// Create lastRSS object
	$rss = new lastRSS;


	// portal globals/cache
	global $k_config;

	// Set cache dir, cache interval and character encoding
	$rss->cache_dir = './cache';
	$rss->cache_time = $k_config['rss_feeds_cache_time']; // Maximum age of the cache file for feed before it is updated, in seconds. 
	$rss->cp = 'UTF-8';  // character encoding of your page ! phpBB default is UTF8 so you don´t need to edit it
	$rss->rsscp = 'UTF-8'; // default encoding of RSS if encoding tag is not available
	$rss->items_limit = $k_config['rss_feeds_items_limit']; //number of news
	$rss->type = $k_config['rss_feeds_type']; // connection type (fopen / curl)

    if ($rs = $rss->get($url)) 
	{
		$msg= '<span class="gensmall"><strong>' . $rs['description'] . "</strong></span><br />";
		$msg.= "";
		// check if fopen or curl is installed
		if (function_exists('curl_init') == false && $rss->type == 'curl')
		{
			$msg.= '<li class="gensmall">' . $user->lang['NO_CURL'] . '</li>';
		}
		if(ini_get("allow_url_fopen") == false && $rss->type == 'fopen')
		{
			//fopen not installed. throw error
			$msg.= '<li class="gensmall">' . $user->lang['NO_FOPEN'] . '</li>';
		}
		if (ini_get('allow_url_fopen') == '1' && $rss->type == 'fopen' or function_exists('curl_init') && $rss->type == 'curl')
		{
			if ($rs['items_count'] <= 0)
			{
				$msg.= '<li class="gensmall">' . $user->lang['RSS_CACHE_ERROR'] . '</li>';
				$msg.= '<li class="gensmall">' . $user->lang['RSS_FEED_ERROR'] . '</li>';
			}
			else
			{
				foreach ($rs['items'] as $item)
				{ 
					$msg.= '<span class="gensmall"><img src="' . $phpbb_root_path . 'images/rss.png" title="" alt="" /> <a href="' . $item['link'] . '" rel="external">' . $item['title'] . '</a></span><br />';
				}
			}	
			$msg.= "<br />";
		}
		return $msg;
	}
}
function ShowRSSnodesc($url) 
{
	global $rss, $phpbb_root_path, $user;


	// portal globals/cache
	global $k_config;

	// Create lastRSS object
	$rss = new lastRSS;

    if ($rs = $rss->get($url)) 
	{
		$msg= "<br />";
		// check if fopen or curl is installed
		if (function_exists('curl_init') == false && $rss->type == 'curl')
		{
			$msg.= '<li class="gensmall">' . $user->lang['NO_CURL'] . '</li>';
		}
		if (ini_get('allow_url_fopen') == false && $rss->type == 'fopen')
		{
			//fopen not installed. throw error
			$msg.= '<li class="gensmall">' . $user->lang['NO_FOPEN'] . '</li>';
		}
		if (ini_get('allow_url_fopen') == '1' && $rss->type == 'fopen' or function_exists('curl_init') && $rss->type == 'curl')
		{
			if ($rs['items_count'] <= 0) 
			{ 
				$msg.= '<li class="gensmall">' . $user->lang['RSS_CACHE_ERROR'] . '</li>';
				$msg.= '<li class="gensmall">' . $user->lang['RSS_FEED_ERROR'] . '</li>';
			}
			else
			{
				foreach ($rs['items'] as $item)
				{ 
					$msg.= '<span class="gensmall"><img src="' . $phpbb_root_path . 'images/rss.png" title="" alt="" /> <a href="' . $item['link'] . '" rel="external">' . $item['title'] . '</a></span><br />';
				}
			}
			$msg.= "<br />";
		}	
		return $msg;
	}
}

// retrieve portal config variables
$rss_feeds_random_limit = $k_config['rss_feeds_random_limit'];

// portal globals/cache
global $k_config, $k_blocks;

foreach ($k_blocks as $blk)
{
	if ($blk['html_file_name'] == 'block_rss_feeds.html')
	{
		$block_cache_time = $blk['block_cache_time']; 
	}
}
$block_cache_time = (isset($block_cache_time) ? $block_cache_time : $k_config['block_cache_time_default']);

$sql = 'SELECT *
   FROM ' . K_NEWSFEEDS_TABLE . '
   WHERE feed_show = 1
   ORDER BY feed_id DESC';
$result = $db->sql_query_limit($sql, $rss_feeds_random_limit, 0, $block_cache_time);

if(!($result = $db->sql_query($sql, $block_cache_time)))
{
	trigger_error('RSS_LIST_ERROR');
} 
else
{
   	$i = 0;
   	while($row = $db->sql_fetchrow($result))
   	{ 
		$feeds[$i]['title'] = $row['feed_title'];
		$feeds[$i]['id'] = $row['feed_id'];
		$feeds[$i]['url'] = $row['feed_url'];
		$feeds[$i]['position'] = $row['feed_position'];
		$feeds[$i]['description'] = $row['feed_description'];
   		$i++;
   	}
} 
$db->sql_freeresult($result);

// Main feeds
for ($i = 0; isset($feeds[$i]['id']); $i++)
{
	$template->assign_block_vars('maincat', array(
		'S_ROW_POSITION'	=> $feeds[$i]['position'],
	));

	if ($feeds[$i]['position'] == 1) // left side
	{
		// Get left RSS content
		$feed_left_url[$feeds[$i]['position'] == 1] = $feeds[$i]['url'];
		$rss_left_column = '';
		if ($feeds[$i]['description'] == 1)
		{
			foreach ($feed_left_url as $url) $rss_left_column.=ShowRSSdesc($url);
		}
		if ($feeds[$i]['description'] == 2)
		{
			foreach ($feed_left_url as $url) $rss_left_column.=ShowRSSnodesc($url);
		}

		$find		= array('<strong>', '</strong>');
		$replace	= array('<br />', '<br />');
		$rss_left_column = str_replace($find, $replace, $rss_left_column);

		$template->assign_block_vars('rss_left_column', array(
			'LEFT_SYNDICATION' => $rss_left_column . '<br />',
			'FEEDS_TITLE' => '<a href="' . $feeds[$i]['url'] . '" rel="external" style="text-align:center;">' . $feeds[$i]['title'] . "</a>",
		));
	}
	
	if ($feeds[$i]['position'] == 2) // right side
	{
		// Get right RSS content
		$feed_right_url[$feeds[$i]['position'] == 2] = $feeds[$i]['url'];
		$rss_right_column ='';
		if ($feeds[$i]['description'] == 1)
		{
			foreach ($feed_right_url as $url) $rss_right_column.=ShowRSSdesc($url);
		}
		if ($feeds[$i]['description'] == 2)
		{
			foreach ($feed_right_url as $url) $rss_right_column.=ShowRSSnodesc($url);
		}
		$template->assign_block_vars('rss_right_column', array(
			'RIGHT_SYNDICATION'	=> $rss_right_column,
			'FEEDS_TITLE' => '<a href="' . $feeds[$i]['url'] . '" rel="external">' . $feeds[$i]['title'] . "</a>",
		));
	}

	$template->assign_var('S_RSS_ENABLED', true);

	$template->assign_vars(array(
		'RSS_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
	));

}
?>