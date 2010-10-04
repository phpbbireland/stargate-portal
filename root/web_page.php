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
* @version $Id: web_page.php 291 2008-12-24 13:28:56Z Mike $
* Updated: 13 February 2010
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
include($phpbb_root_path . 'includes/sgp_functions.' . $phpEx);
include($phpbb_root_path . 'includes/bbcode.' . $phpEx);

@define('WEB_PAGES', true);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

//global $db, $user, $phpbb_root_path, $config;
$extern = true;

$valid_mode = false;
$mode = request_var('mode','');
$style = request_var('style',1);
$f = request_var('f',0);
$t = request_var('t',0);
$topic_title = '';

if (isset($style) && $style != '1')
{
	// refresh page and set style to default (prosilver) //
	echo $user->lang['SGP_STYLE_ERROR_10'];
	meta_refresh(0, $phpbb_root_path . "web_page." . $phpEx ."?mode=" . $mode . "&amp;style=1");
	return;
}

// This code also provided us with a common 404 page as we have added code to the htaccess to redirect //
// page called without mode swicth, so set default page to 404 //

// mpv does not like html file with no extension (thinks they are binary files?)
// I will change the page name to .html for now... 
if(strpos('.html', $mode) == false)
{
	// $nmode = $mode with no extension for db query //
	$nmode = $mode;
	$mode = $mode . '.html';
}

// Get a lsit of all web page and compare to $mode //
$dir_list = sgp_get_file_list("{$phpbb_root_path}styles/portal_common/template/web_pages/pages/", '', false);

// Check the page is in the list //
for ($i = 0; $i < count($dir_list); $i++)
{
	if ($dir_list[$i] == $mode)
	{
		$valid_mode = true;
		break;
	}
}
// we don't have the selected page //
if (!$valid_mode)
{
	$mode = '404.html';
	$nmode = '404';
}

$sql = "SELECT id, page_name, page_meta, page_desc, page_extn ,body, head, foot FROM ". K_WEB_PAGES_TABLE . " WHERE page_name = '$nmode' ";

if (!$result = $db->sql_query($sql))
{
	trigger_error($user->lang['ERROR_PORTAL_MODULE'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__); 
}
$row = $db->sql_fetchrow($result);

// Check to see if we added this page, else process the 404 page //
if (count($row['id']) == 0) 
{
	$sql = "SELECT id, page_name, page_meta, page_desc, page_extn ,body, head, foot FROM ". K_WEB_PAGES_TABLE . " WHERE page_name = '$mode' ";
	if (!$result = $db->sql_query($sql))
	{ 
		trigger_error($user->lang['ERROR_PORTAL_MODULE'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__); 
	}
	$row = $db->sql_fetchrow($result);
}

// get id's for processing and save body text //
$idone = $row['id'];
$headone = $row['head'];
$footone = $row['foot'];
$body = $row['body'];

$page_name = $row['page_name'];
$page_meta = $row['page_meta'];
$page_desc = $row['page_desc'];
$page_extn = $row['page_extn'];

$style_path = $content = $topic_title = '';

$db->sql_freeresult($result);

// get the correct header using id from first query, save body text as $head //
$sql = "SELECT id, body FROM ". K_WEB_PAGES_TABLE . " WHERE id = '$headone' ";
if (!$result = $db->sql_query($sql)) 
{
	trigger_error($user->lang['ERROR_PORTAL_MODULE'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__); 
}

$row = $db->sql_fetchrow($result);
$head = $row['body'];
$db->sql_freeresult($result);

// get the correct footer using id from last first, save body text as $foot //
$sql = "SELECT id, body FROM ". K_WEB_PAGES_TABLE . " WHERE id = '$footone' ";

if (!$result = $db->sql_query($sql)) 
{
	trigger_error($user->lang['ERROR_PORTAL_MODULE'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__); 
}

$row = $db->sql_fetchrow($result);
$foot = $row['body'];
$db->sql_freeresult($result);

$style1 = "./styles/" . $user->theme['theme_path'] . '/theme/overload.css';
$style2 = "./styles/" . $user->theme['theme_path'] . '/theme/stylesheet.css';

if ($mode == 'post')
{
	if ($f && $t)
	{
		$content = get_content($f,$t);

		$find		= array('{PAGE_POST}', '{PAGE_STYLE1}', '{PAGE_STYLE2}', '{TOPIC_TITLE}', '{POST_AUTHOR}', '{POST_LINK}');
		$replace	= array($content['POST_TEXT'], $style1, $style2, $content['TOPIC_TITLE'], $content['POST_AUTHOR'], $content['POST_LINK']);

		$head = str_replace($find,$replace,$head);
		$body= str_replace($find, $replace, $body);
		$foot = str_replace($find,$replace,$foot);
	}

	$head = bbcode_nl2br($head);
	$body = bbcode_nl2br($body);
	$foot = bbcode_nl2br($foot);
}

$head = process_for_vars($head, true);
$body = process_for_vars($body, true);
$foot = process_for_vars($foot, true);

$vars = array("\0", "\n", "\r", "\t", '$page_name', '$page_meta', '$page_desc');
$data = array('', '', '', '', $page_name, $page_meta, $page_desc);
$head = str_replace($vars, $data, $head);

$body = str_replace('{L_NOT_FOUND}', '<h3>Web Pages Examples:</h3>These pages are presented as example only, not all links are valid...<br />', $body);

$template->assign_vars( array(
	'WEB_PAGE_HEAD'	=> htmlspecialchars_decode($head),
	'WEB_PAGE_NAME'	=> $page_name,
	'WEB_PAGE_META'	=> $page_meta,
	'WEB_PAGE_DESC'	=> $page_desc,
	'WEB_PAGE_BODY'	=> htmlspecialchars_decode($body),
	'WEB_PAGE_FOOT'	=> htmlspecialchars_decode($foot),
));

// generate page //
page_header($user->lang['WEB_PAGE']);

if ($extern)
{
	$template->set_filenames(array(
		'body' => 'web_pages/pages/' . $mode,
	));
}
else
{
	$template->set_filenames(array(
		'body' => 'blocks/block_web_page.html')
	);
}

page_footer();


function get_content($forum, $topic)
{
	global $db, $user, $phpbb_root_path, $config, $template, $phpEx;

	$search_limit = 1;
	$bbcode_bitfield = '';

    $forum_id = array($forum);
	$topic_id = array ($topic);

    $forum_id_where = create_where_clauses($forum_id, 'forum');
	$topic_id_where = create_where_clauses($topic_id, 'topic');

	$posts_ary = array(
		'SELECT' => 'p.*, t.*, u.username, u.user_colour',
			'FROM' => array(
				POSTS_TABLE => 'p',
	),

	'LEFT_JOIN' => array(
		array(
			'FROM' => array(USERS_TABLE => 'u'),
				'ON' => 'u.user_id = p.poster_id'
	),
	array(
		'FROM' => array(TOPICS_TABLE => 't'),
			'ON' => 'p.topic_id = t.topic_id'
		),
	),

	'WHERE' => str_replace( array('WHERE ', 'topic_id'), array('', 't.topic_id'), $topic_id_where) . '
		AND t.topic_status <> ' . ITEM_MOVED . '
			AND t.topic_approved = 1',
			'ORDER_BY' => 'p.post_id DESC',
	);

	$posts = $db->sql_build_query('SELECT', $posts_ary);

	$posts_result = $db->sql_query_limit($posts, $search_limit);

	while ($posts_row = $db->sql_fetchrow($posts_result))
	{
		$topic_title = $posts_row['topic_title'];
		$post_author = get_username_string('full', $posts_row['poster_id'], $posts_row['username'], $posts_row['user_colour']);
		$post_date = $user->format_date($posts_row['post_time']);
		$post_link = append_sid("{$phpbb_root_path}viewtopic.$phpEx", "p=" . $posts_row['post_id'] . "#p" . $posts_row['post_id']);

		$post_text = nl2br($posts_row['post_text']);

		$bbcode = new bbcode(base64_encode($bbcode_bitfield));
		$bbcode->bbcode_second_pass($post_text, $posts_row['bbcode_uid'], $posts_row['bbcode_bitfield']);

		$post_text = smiley_text($post_text);

		$info = array(
			'TOPIC_TITLE'	=> '<a href="' . $post_link . '">' . censor_text($topic_title) . '</a>',
			'POST_AUTHOR'	=> $post_author,
			'POST_DATE'		=> $post_date,
			'POST_LINK'		=> '<a href="' . $post_link . '"><img src="./images/extras/link-url.png"></a>&nbsp;&nbsp;',
			'POST_TEXT'		=> censor_text($post_text)
		);

		/*
		$template->assign_block_vars('web_pages', array(
			'TOPIC_TITLE' => censor_text($topic_title),
			'POST_AUTHOR' => $post_author,
			'POST_DATE' => $post_date,
			'POST_LINK' => $post_link,
			'POST_TEXT' => censor_text($post_text),
		));
		*/

	}
	// we could return an array with all the info ??

	//$topic_title = censor_text($topic_title);
	//return($post_text);
	return($info);
}
?>