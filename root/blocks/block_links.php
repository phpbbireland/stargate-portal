<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Saturday, 14th November, 2005
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_links.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated: 18th November 2008, 08:42
*
*/

/**
* @ignore
*/

	if ( !defined('IN_PHPBB') )
	{
		exit;
	}

	$phpEx = substr(strrchr(__FILE__, '.'), 1);

	$queries = 0;
	$cached_queries = 0;

	// portal globals/cache
	global $k_config, $phpbb_root_path;

	// retrieve portal config variables
	$number_of_links_to_display = $k_config['number_of_links_to_display'];

	// should we scroll this data ?
	$sql = "SELECT scroll
		FROM " . K_BLOCKS_TABLE . "
		WHERE html_file_name = 'block_links.html' ";

	if( $result = $db->sql_query($sql) )
	{
		$row = $db->sql_fetchrow($result);
		$scroll = $row['scroll'];
	}
	else
		trigger_error('Error! Could not query <strong> Blocks Table</strong>: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);

	$db->sql_freeresult($result);

	if(isset($k_config['link_forum_id']) && $k_config['link_forum_id'] != 0)
		$links_forum = 'posting.php?mode=post&amp;f=' . (int)$k_config['link_forum_id'];
	else
		$links_forum = '';

	//$linkimage1 = "phpbbireland";
	$imglist = '';

	mt_srand((double)microtime()*1000002);
	$imgs = dir($phpbb_root_path . 'images/links');

	while ($file = $imgs->read())
	{
		/*
		if (preg_match("/\b^.gif\b/i", $file) || preg_match("/\b^.jpg\b/i", $file) || preg_match("/\b^.png\b/i", $file))
			$imglist .= "$file ";
		*/

		if(strpos($file, ".gif") || strpos($file, ".jpg") || strpos($file, ".png"))
			$imglist .= "$file ";

		/*
    	if (eregi("gif", $file) || eregi("jpg", $file) || eregi("png", $file) )
    	{
			$imglist .= "$file ";
    	}
		*/
	}
	closedir($imgs->handle);
	$imglist = explode(" ", $imglist);

	$a = sizeof($imglist);

	$a = $a - 1;	// correct for loop //

	if($a < 1)		// don't process if no images //
		return;

	if($number_of_links_to_display > $a)	// we do not have enough images! so display what we have //
		$number_of_links_to_display = $a;

	$random = mt_rand(0, $a);

	if ($random >= ($a - $number_of_links_to_display))
		$random = ($a - $number_of_links_to_display);

	if($scroll)
	{
		$linkscontent  = '<br /> <div style="text-align: center; width: 100%; margin: 0 auto; padding: 0;">';

		for ($i = 0; $i <= $a-1; $i++)
		{
			$image = $imglist[$i];

			if(strpos($image, '.gif'))
				$lnk = explode(".gif", $image);
			else
			if(strpos($image, '.png'))
				$lnk = explode(".png", $image);
			else
			if(strpos($image, '.jpg'))
				$lnk = explode(".jpg", $image);

			$lnk[0] = str_replace('+','/', $lnk[0]);
			$lnk[0] = str_replace('@','?', $lnk[0]);
			$lnk[0] = str_replace('£','+', $lnk[0]);

			$linkscontent .= "<a rel=\"external\" href=\"http://$lnk[0]\"><img src=\"".$phpbb_root_path."images/links/$image\" alt=\"$lnk[0]\" /></a><br /><br />";
		}

		$linkscontent .= "</div>";
	}
	else
	{
		$linkscontent  = '<br /> <div style="text-align: center; width: 100%; margin: 0 auto; padding: 0;">';

		for ($i = 0; $i <= $number_of_links_to_display-1; $i++)
		{

			$image = $imglist[$i+$random];

			if(strstr($image, 'gif'))
				$lnk = explode(".gif", $image);
			else
			if(strstr($image, 'png'))
				$lnk = explode(".png", $image);
			else
			if(strstr($image, 'jpg'))
				$lnk = explode(".jpg", $image);

			$lnk[0] = str_replace('+','/', $lnk[0]);
			$lnk[0] = str_replace('@','?', $lnk[0]);
			$lnk[0] = str_replace('£','+', $lnk[0]);

			$linkscontent .= "<a rel=\"external\" href=\"http://$lnk[0]\"><img src=\"".$phpbb_root_path."images/links/$image\" alt=\"$lnk[0]\" /></a><br /><br />";
		}

		$linkscontent .= "</div>";
	}

	//if($number_of_links_to_display != 0) $linkscontent .= '</div>';

	$template->assign_vars(array(
		'LINKSCONTENT' 		=> $linkscontent,
		'SUBMIT_LINK' 		=> $links_forum,
		'LINKS_ERROR' 		=> true,
		'LINKS_COUNT'		=> $a,
		'S_SCROLL_LINKS'	=> ($scroll) ? true : false,
		'NK_PORTAL_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
	));

?>