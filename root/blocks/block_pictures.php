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
* @version $Id: block_pictures.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated:
*
*/

/**
* @ignore
*/
if ( !defined('IN_PHPBB') )
{
	exit;
}

$picturescontent ='';
$pictures_id = "phpbbireland-20";
$imglist ="";
mt_srand((double)microtime()*1000000);

$handle=opendir('images/pictures/thumbs');
if( !$handle) trigger_error('Check to see if you added the image directory!');
while (false!==($file = readdir($handle)))
{
	if(strpos($file, ".gif") || strpos($file, ".jpg") || strpos($file, ".png"))
		$imglist .= "$file ";

	/*
	if (preg_match("/\b^.gif\b/i", $file) || preg_match("/\b^.jpg\b/i", $file) || preg_match("/\b^.png\b/i", $file))
		$imglist .= "$file ";

    if (eregi("gif", $file) || eregi("jpg", $file) || eregi("png", $file))
    {
			$imglist .= "$file ";
    }
	*/
}
closedir($handle);
$imglist = explode(" ", $imglist);
$a = sizeof($imglist)-2;
$random = mt_rand(0, $a);
$image = $imglist[$random];
//$asin = explode(".", $image);
//$picturescontent = "<br /><center><a href=\"http://www." .$pictures . "/exec/obidos/ASIN/$asin[0]/$pictures_id\" target=\"_blank\">";
$picturescontent .= "<img src=\"images/pictures/thumbs/$image\" border=\"0\" alt=\"$image\"><br/ >$image</center>";
$template->assign_vars(array('PICTURESCONTENT' => $picturescontent));
$imgs ='';
?>