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
* @version $Id: block_mp3s.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* Updated:
*
*/

/**
* @ignore
*/

	//define('IN_PHPBB', true);

	if (!defined('IN_PHPBB'))
	{
		exit;
	}

	//$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
	global $phpbb_root_path;

	$one_song = '';
	$position = 'LEFT';
	$music ='';
	$music_list = '';
	$song_list[] = '';

	$mp3_path = 'mp3/music/';

	$queries = $cached_queries = 0;

/*
	mt_srand((double)microtime()*1000000);

	$handle=opendir('mp3/music');

	if( !$handle) 
		trigger_error('Error! Check to see if you added the mp3 directory!: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);

	$i = 0;
	$music_list = $mp3_path;

	while (false!==($file = readdir($handle)))
	{
  	if (@eregi(".mp3", $file) || @eregi("m3u", $file))
    {
	    $file .= '|';
			$music_list .= $file;
			$music_list .= $mp3_path;
			$song_list[$i++] = $mp3_path . $file;
    }
	}
	closedir($handle);
*/

 	$upload_dir = 'music';
	$upload = $user->lang['UPLOAD'];

	$template->assign_vars(array(
		'U_UPLOAD_DIR'	=> $upload_dir,
		'L_UPLOAD_FILE'	=> $upload,
		'MP3_POPUP_IMG'	=> $user->img('button_mp3_popup', 'MP3_POPUP'),
		//'UPLOAD_IMG'      => $user->img('icon_upload', 'UPLOAD'),

		'MP3S_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
	 ));

?>