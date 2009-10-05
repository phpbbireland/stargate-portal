<?php
/** 
*
* @package phpBB3
* @copyright (c) Michael O'Toole 2005 phpBBireland 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
* Last updated: 14 February 2007
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

global $phpEx, $phpbb_root_path;
global $config, $user, $template, $k_quick_posting_mode, $forum_id, $post_data, $topic_id, $topic_data, $k_config;

$user->add_lang('portal/portal');
$user->add_lang('portal/k_quick_posting');

include_once($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
include_once($phpbb_root_path . 'includes/functions_display.' . $phpEx);


if(!isset($smilies_status))
{
	generate_smilies('inline', $forum_id);
}	

// HTML, BBCode, Smilies, Images and Flash status amended version
$bbcode_status		= ($config['allow_bbcode'] && $auth->acl_get('f_bbcode', $forum_id)) ? true : false;
$smilies_status		= ($bbcode_status && $config['allow_smilies'] && $auth->acl_get('f_smilies', $forum_id)) ? true : false;
$img_status			= ($bbcode_status && $auth->acl_get('f_img', $forum_id)) ? true : false;
$url_status			= ($config['allow_post_links']) ? true : false;
$quote_status		= ($auth->acl_get('f_reply', $forum_id)) ? true : false;
$subscribe_topic	= ($config['allow_topic_notify'] && $user->data['is_registered'] && $user->data['user_notify']) ? true : false;
$flash_status		= ($bbcode_status && $auth->acl_get('f_flash', $forum_id)) ? true : false;
$enable_sig			= ($config['allow_sig'] && $user->optionget('attachsig')) ? true: false;
add_form_key('posting');

$template->assign_vars(array(
	'STARGATE'			=> true,
	'MESSAGE'			=> '',
	'L_QUICK_TITLE'		=> $user->lang['K_QUICK_REPLY'],
	'S_QUICK_TITLE'		=> 'Re: ' . $topic_data['topic_title'],
	'S_SMILIES_ALLOWED'	=> $smilies_status, 	
	'S_LINKS_ALLOWED'	=> $url_status,
	'S_SIG_ALLOWED'			=> ($auth->acl_get('f_sigs', $forum_id) && $config['allow_sig'] && $user->data['is_registered']) ? true : false,
	'S_SIGNATURE_CHECKED'	=> ($enable_sig) ? ' checked="checked"' : '',
	'S_SUBSCRIBE' 		=> $subscribe_topic,
	'S_BBCODE_QUOTE'	=> $quote_status,	
	'S_BBCODE_IMG'		=> $img_status, 
	'S_BBCODE_FLASH'	=> $flash_status,
	'U_MORE_SMILIES' 	=> append_sid("{$phpbb_root_path}posting.$phpEx", 'mode=smilies&amp;f=' . $forum_id),
	'S_USER_LOGGED_IN'	=> ($user->data['user_id'] != ANONYMOUS) ? true : false,
	'S_K_SHOW_SMILES'		=> $k_config['k_show_smilies'],
	'QUOTE_IMG' 		=> $user->img('icon_post_quote', 'REPLY_WITH_QUOTE'),
	)
);
?>