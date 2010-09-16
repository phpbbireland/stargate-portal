<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Frin 2nd Jan, 2006
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_rotate_logo.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
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

$imglist = "";
mt_srand((double)microtime()*1000132);

global $rand_logo;

$logos_dir = "{$phpbb_root_path}styles/" . $user->theme['imageset_path'] . '/imageset/logos';


@$handle=opendir($logos_dir);

// quick report because people forget to add the image directory //
if (!$handle)
{
	trigger_error($user->lang['WARNINGIMG_DIR'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
}


while (false!==($file = readdir($handle)))
{
	if (strpos($file, ".gif") || strpos($file, ".jpg") || strpos($file, ".png"))
	{
		$imglist .= "$file ";
	}
}
closedir($handle);

$imglist = explode(" ", $imglist);
$a = sizeof($imglist)-2;
$random = mt_rand(0, $a);
$image = $imglist[$random];

$rand_logo .= '<img src="' . $logos_dir . '/' . $image . '" alt="" /><br />';

$template->assign_vars(array(
	'RAND_LOGO' => $rand_logo
));

$imgs ='';
?>