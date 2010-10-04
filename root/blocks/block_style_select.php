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
* @version $Id: block_style_select.php 299 04 October 2010 01:38:00Z Michaelo $
* Updated: 12 November2008 NeXur, 04 October 2010 Mike
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

global $user_id, $user, $template, $phpbb_root_path, $phpEx, $db, $config, $k_config;
$sgp_cache_time = $k_config['sgp_cache_time'];

$queries = $cached_queries = 0;

$user_id = $user->data['user_id'];					// get user id
$current_style = $user->data['user_style'];			// the current style
$new_style = request_var('style', '');				// selected style
$permanent = request_var('permanent', '');			// make style permanent
$style_count = 0;

// add this to sgp config...
$select_allow = ($config['override_user_style']) ? false : true;

// allowed style change and make it permanent? //
$style = $new_style = ($config['override_user_style']) ? $config['default_style'] : $new_style; 

if (!$config['override_user_style'] && $new_style != '' && $new_style != $current_style && $permanent)
{
	$sql = 'UPDATE ' . USERS_TABLE . '
		SET user_style = ' . $new_style . "
		WHERE user_id = $user_id";
	$db->sql_query($sql);
}

// Get current style information
if ($new_style)
{
	$sql = 'SELECT s.style_id, s.style_name, s.style_copyright, s.style_active, m.mod_origin, m.mod_author, m.mod_id, m.mod_status, m.mod_link, m.mod_author_co, m.mod_support_link, m.mod_download_count, m.mod_last_update
		FROM ' . STYLES_TABLE . " s
		LEFT JOIN " . K_MODULES_TABLE . " m ON (s.style_name = m.mod_name)
			WHERE s.style_id = '$new_style' AND s.style_active = 1";
}
else
{
	$sql = 'SELECT s.style_id, s.style_name, s.style_copyright, u.user_style, s.style_active, m.mod_origin, m.mod_id, m.mod_author, m.mod_status, m.mod_link, m.mod_author_co, m.mod_support_link, m.mod_download_count, m.mod_last_update
		FROM ' . USERS_TABLE . ' u, ' . STYLES_TABLE . " s
		LEFT JOIN " . K_MODULES_TABLE . " m ON (s.style_name = m.mod_name)
			WHERE u.user_id = '$user_id' AND s.style_id = u.user_style AND s.style_active = 1";
}
$result = $db->sql_query($sql, $sgp_cache_time);

while ($row = $db->sql_fetchrow($result))
{
	$mod_id					= $row['mod_id'];
	$mod_origin				= $row['mod_origin'];
	$style					= $row['style_id'];
	$stylename				= sgp_checksize ($row['style_name'], 16);
	$style_copyright		= ($row['style_copyright']) ? $row['style_copyright'] : $user->lang['WARNINGIMG_COPYRIGHT'];

	$style_details			= '';
	$style_author			= ($row['mod_author']) ? $row['mod_author'] : 'No author';
	$style_link				= ($row['mod_link']) ? $row['mod_link'] : 'No Link info';
	$style_ported_by		= ($row['mod_author_co']) ? $row['mod_author_co'] : 'No port details';
	$style_support_link		= ($row['mod_support_link']) ? $row['mod_support_link'] : 'No support link';
	$style_status			= ($row['mod_status']) ? $row['mod_status'] : 'No status details';
	$style_download_count	= ($row['mod_download_count']) ? $row['mod_download_count'] : '0';
	$style_last_update		= ($row['mod_last_update']) ? $row['mod_last_update'] : '';
}

$sql = 'SELECT user_style
	FROM ' . USERS_TABLE . "
	WHERE user_style = '$style'
	ORDER BY user_style";
$result = $db->sql_query($sql, $sgp_cache_time);

$style_count = sizeof($db->sql_fetchrowset($result));

// collect all data...
$sql = 'SELECT style_name, style_id, style_active
	FROM ' . STYLES_TABLE . '
	WHERE style_active = 1
	ORDER BY LOWER(style_name) ASC';
$result = $db->sql_query($sql, $sgp_cache_time);

$styles_num = sizeof($db->sql_fetchrowset($result));
		
if (!$result = $db->sql_query($sql))
{
	trigger_error($user->lang['ERROR_PORTAL_STYLE_SELECT'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
}

$select_theme = "<select class=\"inputbox autowidth\" onchange=\"this.form.submit();\" name=\"style\" >\n";

while ($row = $db->sql_fetchrow($result))
{
	if ($new_style)
	{
		$selected = ($new_style == $row['style_id']) ? " selected=\"selected\"" : "";
	}
	else
	{
		$selected = ($style == $row['style_id']) ? " selected=\"selected\"" : "";
	}
		
	$class = "\"list_release\"";
	$row['style_name'] = sgp_checksize ($row['style_name'],16);
	$select_theme .= "<option class=" . $class . " value=\"" . $row['style_id'] . "\"" . $selected . ">" . $row['style_name'] . "</option>";
}
$select_theme .= "</select>\n";

$select_theme_ok = $user->lang['WARNING_LOGIN_STYLE_SELECT']; //$user->lang['LOGIN_NOTIFY_FORUM']; //add lang key later...	'STYLE_SELECT_ALLOW'	  => 'Allow style change',

$s_hidden = '<input type="hidden"  id="change" name="change" value="' . $row['style_id'] . '" />';


// as $new_style will be empty for first call we need to set it to something else it will not work on first call //
if (!$new_style)
{
	$new_style = $current_style;
}

$s_select_action = append_sid('?style='. $new_style);


/* 04 October 2010 MPV update testing 

//check for vars in the current url
//$check = sizeof($_GET);

if ($check)
{
	$order   = array(".php?style=", ".php?");
	$replace = '.php';
	$s_select_action = str_replace($order, $replace . '?style=' . $new_style . '&amp;', build_url('style'));
}

Preliminary test results... it appears to work fine... why the other code? 
*/

//check if only style or sid is set
if (isset($_REQUEST['style']) or isset($_REQUEST['sid']))
{
	$s_select_action = build_url('style') .'?style='. $new_style;
}

switch($style_download_count)
{
	case 0:		$style_download_count = sprintf($user->lang['DOWNLOAD_COUNT_NONE'], $style_download_count);
	break;
	case 1:		$style_download_count = sprintf($user->lang['DOWNLOAD_COUNT'], $style_download_count);
	break;
	default:	$style_download_count = sprintf($user->lang['DOWNLOAD_COUNTS'], $style_download_count);
	break;

}

$template->assign_vars(array(
	'S_MOD_ID'			=> $mod_id,
	'S_EXTERNAL'		=> ($mod_origin) ? false : true, 
	'S_COPYRIGHT'		=> $style_copyright,
	'S_SELECT_ALLOW'	=> $select_allow,
	'S_SELECT_STYLE' 	=> $select_theme,
	'S_SELECT_CHANGE' 	=> $s_hidden,
	'S_SELECT_ACTION' 	=> $s_select_action,
	'S_TOTAL_STYLES'	=> $styles_num,
	'S_CURRENT_STYLE'	=> $stylename,
	'S_UPDATED'			=> $style_last_update,
	'S_AUTHOR'			=> $style_author,
	'S_AUTHOR_CO'		=> $style_ported_by,
	'S_DETAILS'			=> htmlspecialchars_decode($style_details),
	'S_LINK'			=> htmlspecialchars_decode($style_link),
	'S_SUPPORT'			=> htmlspecialchars_decode($style_support_link),
	'S_DOWNLOAD_COUNT'	=> $style_download_count,
	'S_COMPETED'		=> k_progress_bar($style_status),
	'S_DOWNLOAD_IMG'	=> '<img src="' . $phpbb_root_path . 'images/download.png" alt="" />',
	'S_ANIMGIF_IMG'		=> '<img src="' . $phpbb_root_path . 'images/theme_thumbs.gif" style="padding-bottom:6px;" width="120" height="84" alt="" />',
	'STYLE_USERS'		=> sprintf($user->lang['STYLE_USERS'], $style_count, ($style_count == 1) ? '' : 's'),
	'STYLE_SELECT_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
));

?>