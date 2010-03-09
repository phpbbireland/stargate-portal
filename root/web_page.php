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

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

global $db, $user;
$pos = 0;

$mode = request_var('mode','');

//  we only have two test pages so far so catche others and redirect...

if($mode == 'about' || $mode == 'welcome') 
	;
else
$mode = 'about';

//if($mode == '') return;

$sql = "SELECT id, body, head, foot FROM ". K_WEB_PAGES_TABLE . " WHERE page_name = '$mode' ";
if (!$result = $db->sql_query($sql)) { trigger_error('Error! Could not query portal modules information: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__); }
$row = $db->sql_fetchrow($result);
$idone = $row['id'];
$headone = $row['head'];
$footone = $row['foot'];
$body = $row['body'];
$db->sql_freeresult($result);

$sql = "SELECT id, body FROM ". K_WEB_PAGES_TABLE . " WHERE id = '$headone' ";
if (!$result = $db->sql_query($sql)) { trigger_error('Error! Could not query portal modules information: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__); }
$row = $db->sql_fetchrow($result);
$head = $row['body'];
$db->sql_freeresult($result);

$sql = "SELECT id, body FROM ". K_WEB_PAGES_TABLE . " WHERE id = '$footone' ";
if (!$result = $db->sql_query($sql)) { trigger_error('Error! Could not query portal modules information: ' . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__); }
$row = $db->sql_fetchrow($result);
$foot = $row['body'];
$db->sql_freeresult($result);

$head .= $body .= $foot;

$head = bbcode_nl2br($head);
$head = str_replace('\n','',$head);
$template->assign_block_vars('web_pages_row', array(
	'PAGE' =>  htmlspecialchars_decode($head),
));



/***
$template->assign_block_vars('web_pages_row', array(
	'HEAD' =>  htmlspecialchars_decode($web_pages['info']), 
	'PAGE' =>  htmlspecialchars_decode($web_pages['info']), 
	'FOOT' =>  htmlspecialchars_decode($web_pages['info']), 
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
page_header('Web Page');

$template->set_filenames(array(
	'body' => 'blocks/block_web_page.html')
);

page_footer();

?>