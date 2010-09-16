<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Saturday, Jan 22, 2005
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.stargate-portal.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_cloud_searches.php 336 2009-01-23 02:06:37Z Michealo $
* Generate a random image used with the books block...
* Updated: 26 September 2009
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

// for bots test //
//$page_title = $user->lang['BLOCK_CLOUD'];

global $k_config, $user_id, $user, $template, $phpbb_root_path, $phpEx, $db, $config;

$queries = $cached_queries = 0;

if (isset($phpbb_root_path))
{
	$root_path = $phpbb_root_path;
}
else
{
	$root_path = './';
}

$scumuluscontent = '';

$cloud_search_cache = $k_config['cloud_search_cache'];

$cloud_max_tags		= $k_config['cloud_max_tags'];
$cloud_movie		= $k_config['cloud_movie'];
$cloud_width		= $k_config['cloud_width'];
$cloud_height		= $k_config['cloud_height'];
$cloud_bg_colour	= $k_config['cloud_bg_colour'];
$cloud_speed		= $k_config['cloud_speed'];
$cloud_mode			= '"' . $k_config['cloud_mode'] . '"';
$cloud_tcolour		= '0x' . $k_config['cloud_tcolour'];
$cloud_tcolour2		= '0x' . $k_config['cloud_tcolour2'];
$cloud_hicolour		= '0x' . $k_config['cloud_hicolour'];
$cloud_distr		= ($k_config['cloud_distr']) ? '"true"' : '"false"' ;
$cloud_wmode		= '"' . $k_config['cloud_wmode'] . '"';


$cloud_max_tags = 40;
$cloud_min_word_size = 4;
$font_size = '12';

$sql = 'SELECT l.word_text, word_count
	FROM ' . SEARCH_WORDLIST_TABLE . ' AS l, ' . SEARCH_WORDMATCH_TABLE . ' AS m
	WHERE m.word_id = l.word_id
	GROUP BY m.word_id';

$result = $db->sql_query_limit($sql, $cloud_max_tags, 0, $cloud_search_cache);

while ($row = $db->sql_fetchrow($result))
{
	//$link = 'search.php?keywords=' . $row['word_text'] . '* &search_engine=site&search_fields=all&show_results=topics';
	$link = append_sid($phpbb_root_path . 'search.' . $phpEx . '?keywords=' . $row['word_text'] . '* &search_engine=site&search_fields=all&show_results=topics');

	$rel='';

	if(strlen($row['word_text']) < $cloud_min_word_size) continue;

	if($row['word_count'] < '100')
	{
		$colour = '0083A4';
		$colour2 = 'FF850B';
		$font_size = '10';
		$hcolour = 'B20000';
	}
	else
	if($row['word_count'] < '500')
	{
		$colour = '00A44F';
		$colour2 = 'FF850B';
		$font_size = '11';
		$hcolour = 'cf8a9a';
	}
	else
	if($row['word_count'] < '1000')
	{
		$colour = '0039A4';
		$colour2 = 'FF850B';
		$font_size = '12';
		$hcolour = 'df8a9a';
	}
	else
	if($row['word_count'] < '1500')
	{
		$colour = 'A48E00';
		$colour2 = '52A4CC';
		$font_size = '13';
		$hcolour = 'ff8a9a';
	}
	else
	if($row['word_count'] < '1600')
	{
			$colour = 'FF9705';
			$colour2 = '52A4CC';
			$font_size = '14';
			$hcolour = 'ff8a9a';
	}
	else
	if($row['word_count'] < '1700')
	{
			$colour = 'FF9705';
			$colour2 = '52A4CC';
			$font_size = '14';
			$hcolour = 'ff8a9a';
	}
	else
	if($row['word_count'] < '1800')
	{
			$colour = '00A892';
			$colour2 = '52A4CC';
			$font_size = '15';
			$hcolour = 'ff8a9a';
	}
	else
	if($row['word_count'] < '1900')
	{
			$colour = 'D18E00';
			$colour2 = '52ABCC';
			$font_size = '16';
			$hcolour = 'fe8a2a';
	}
	else
	if($row['word_count'] < '2000')
	{
			$colour = 'C48E00';
			$colour2 = '52ABCC';
			$font_size = '17';
			$hcolour = 'fe8a2a';
	}
	else
	if($row['word_count'] < '3500')
	{
			$colour = '8B00C2';
			$colour2 = '52ABCC';
			$font_size = '18';
			$hcolour = 'fe8a2a';
	}
	else
	if($row['word_count'] > '3501')
	{
			$colour = 'C20000';
			$colour2 = '52A4A0';
			$font_size = '19';
			$hcolour = 'ff8a9a';
	}

	$scumuluscontent .= '<a href="' .  $link . '" ' . 'colour2="' .  $colour2 . '" ' . 'title="' . '" ' . 'rel="' . $rel . '" ' . 'style="font-size:' . $font_size . 'px;"' . 'color="0x' . $colour . '" hicolor="0x' . $hcolour . '">' . $row['word_text'] . '</a>; ';
}

$db->sql_freeresult($result);

$categories = urlencode($scumuluscontent); 

$tmp = '"categories", "';
$tmp .= $categories . '"';
$tmp2 = '"tagcloud", "<tags>';
$tmp2 .= $categories . '</tags>"';

$template->assign_vars(array(
	'SCLOUD_TCOLOUR'	=> $cloud_tcolour,
	'SCLOUD_TCOLOUR2'	=> $cloud_tcolour2,
	'SCLOUD_HICOLOR'	=> $cloud_hicolour,
	'SCLOUD_WIDTH'		=> $cloud_width,
	'SCLOUD_HEIGHT'		=> $cloud_height,
	'SCLOUD_BG_COLOUR'	=> $cloud_bg_colour,
	'SCLOUD_SPEED'		=> $cloud_speed,
	'SCLOUD_MODE'		=> $cloud_mode,
	'SCLOUD_WMODE'		=> $cloud_wmode,
	'SCLOUD_DISTR'		=> $cloud_distr,
	'SFLASHTAG'			=> $tmp2,
	'SCATEGORIES'		=> $tmp,
	'SCUMULUS'			=> $scumuluscontent,
	'SCLOUD_MOVIE'		=> $cloud_movie,

	'ROOT_PATH'			=> $phpbb_root_path,
	'T_IMAGESET_PATH'	=> "{$phpbb_root_path}styles/" . $user->theme['imageset_path'] . '/imageset',
	'T_THEME_PATH'		=> "{$phpbb_root_path}styles/" . $user->theme['theme_path'] . '/theme',

	'CLOUD_SEARCH_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
));

?>