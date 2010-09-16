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
* @version $Id: block_cloud.php 336 2009-01-23 02:06:37Z Michealo $
* Generate a random image used with the books block...
* Updated: 25 September 2009 (added pseudo cloud for IE)
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

global $config, $k_config, $user_id, $user, $template, $phpbb_root_path, $phpEx, $db;

$sgp_cache_time = $k_config['sgp_cache_time'];
$queries = $cached_queries = 0;

$cumuluscontent = '';

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

$sql = 'SELECT *
	FROM ' . K_CLOUD_TABLE . '
	WHERE is_active = 1';
$result = $db->sql_query_limit($sql, $cloud_max_tags, 0, $sgp_cache_time);

while ($row = $db->sql_fetchrow($result))
{
	$cumuluscontent .= '<a href="' .  $row['link'] . '" ' . 'colour2="' .  $row['colour2'] . '" ' . 'title="3 topics' . '" ' . 'rel="' . $row['rel'] . '" ' . 'style="font-size:' . $row['font_size'] . 'pt;"' . 'color="0x' . $row['colour'] . '" hicolor="0x' . $row['hcolour'] . '">' . $row['text'] . '</a>; ';
	//$cumuluscontent_ie .= ' <a href="' . $row['link'] . '" ' . 'style="color:#' .  $row['colour'] . '; font-size:' . $row['font_size'] . 'pt; padding:3px;"'  . 'colour2="' .  $row['colour2'] . '" ' . 'title="3 topics' . '" ' . 'rel="' . $row['rel'] . '" ' . 'color="0x' . $row['colour'] . '" hicolor="0x' . $row['hcolour'] . '">' . $row['text'] . '</a>';
}
$db->sql_freeresult($result);

$categories = urlencode($cumuluscontent); 

$tmp = '"categories", "';
$tmp .= $categories . '"';
$tmp2 = '"tagcloud", "<tags>';
$tmp2 .= $categories . '</tags>"';

$template->assign_vars(array(
	'CLOUD_TCOLOUR'		=> $cloud_tcolour,
	'CLOUD_TCOLOUR2'	=> $cloud_tcolour2,
	'CLOUD_HICOLOR'		=> $cloud_hicolour,
	'CLOUD_WIDTH'		=> $cloud_width,
	'CLOUD_HEIGHT'		=> $cloud_height,
	'CLOUD_BG_COLOUR'	=> $cloud_bg_colour,
	'CLOUD_SPEED'		=> $cloud_speed,
	'CLOUD_MODE'		=> $cloud_mode,
	'CLOUD_WMODE'		=> $cloud_wmode,
	'CLOUD_DISTR'		=> $cloud_distr,
	'FLASHTAG'			=> $tmp2,
	'CATEGORIES'		=> $tmp,
	'CUMULUS'			=> $cumuluscontent,
	'CLOUD_MOVIE'		=> $cloud_movie,

	'CLOUD_DEBUG'		=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
));

?>