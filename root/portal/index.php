<?php
/**
*
* @author michaelo phpbbireland@gmail.com - http://www.phpbbireland.com 
*
* @package umil
* @version 1.0.0
* @copyright (c) 2009 phpbbireland
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('UMIL_AUTO', true);
define('IN_PHPBB', true);

// correct root for poral as we install using root/portal/index.php //

$phpbb_root_path = './../';

$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

// The name of the mod to be displayed during installation.
$mod_name = 'STARGATE_PORTAL';

$version_config_name = 'portal_version';
$language_file = 'portal_install_umil';
$logo_img = 'portal/portal_install.png';

include($phpbb_root_path . 'portal/sql_data.' . $phpEx);

$versions = array(

	// Version 0.1.0
	'0.1.0' => array(
		// Add notice use portal removal tool for version prior to 1.0.0
	),
	// Version 0.2.0
	'0.2.0' => array(
		// Add notice use portal removal tool for version prior to 1.0.0
	),
	// Version 0.3.0
	'0.3.0' => array(
		// Add notice use portal removal tool for version prior to 1.0.0
	),
	// Version 0.4.0
	'0.4.0' => array(
		// Add notice use portal removal tool for version prior to 1.0.0
	),
	// Version 1.0.0
	'1.0.0' => array(
		// Add notice use portal removal tool for version prior to 1.0.0
	),
	// Version 1.0.1
	'1.0.1' => array(
		// Add notice use portal removal tool for version prior to 1.0.0
	),
	// Version 1.0.2
	'1.0.2' => array(
		// Add notice use portal removal tool for version prior to 1.0.0
	),
	// Version 1.0.3
	'1.0.3' => array(
		// Add notice use portal removal tool for version prior to 1.0.0
	),
	// Version 1.0.4
	'1.0.4' => array(
		// Add notice use portal removal tool for version prior to 1.0.0
	),
	// Version 1.0.5
	'1.0.5' => array(
		// Add notice use portal removal tool for version prior to 1.0.0
	),

	// Version 1.0.5
	'1.0.6' => array(
		// Add notice use portal removal tool for version prior to 1.0.0
	),

	// Version 2.0.5
	'2.0.0' => array(
		// Add notice use portal removal tool for version prior to 1.0.0
	),
	// Version 3.0.0
	'3.0.0' => array(
		// Add notice use portal removal tool for version prior to 1.0.0
	),
	// New version 3.1.1 MPV 3rd
	'3.1.1'	=> array(

		'permission_add' => array(
			array('a_k_portal', 1),
			array('a_k_web_pages', 1),
			array('a_k_tools', 1),
		),

		'permission_set' => array(
			array('ROLE_ADMIN_FULL', 'a_k_portal'),
			array('ROLE_ADMIN_FULL', 'a_k_web_pages'),
			array('ROLE_ADMIN_FULL', 'a_k_tools'),
		),

		'config_add' => array(
			array('portal_enabled', true),
		),


		'users_add' => array(
			array('user_left_blocks', '2'),
			array('user_center_blocks', '2'),
			array('user_right_blocks', '2'),
		),


		'table_add' => array(
			array('phpbb_k_acronyms', array(
					'COLUMNS'	=> array(
						'acronym_id'	=> array('UINT', NULL, 'auto_increment'),
						'acronym'		=> array('VCHAR:80', ''),
						'meaning'		=> array('STEXT_UNI', ''),
						'lang'			=> array('VCHAR:10', 'en'),
					),
					'PRIMARY_KEY'	=> 'acronym_id',
				),
			),

			array('phpbb_k_blocks', array(
					'COLUMNS' => array(
						'id'				=> array('UINT', NULL, 'auto_increment'),
						'ndx'				=> array('UINT', '0'),
						'title'				=> array('VCHAR:50', ''),
						'position'			=> array('CHAR:1', 'L'),
						'type'				=> array('CHAR:1', 'H'),
						'active'			=> array('BOOL', '1'),
						'html_file_name'	=> array('VCHAR', ''),
						'var_file_name'		=> array('VCHAR', 'none.gif'),
						'img_file_name'		=> array('VCHAR', 'none.gif'),
						'view_by'			=> array('UINT', '0'),
						'view_all'			=> array('BOOL', '1'),
						'view_groups'		=> array('VCHAR:100', ''),
						'view_pages'		=> array('VCHAR:100', ''),
						'groups'			=> array('UINT', '0'),
						'scroll'			=> array('BOOL', '0'),
						'block_height'		=> array('USINT', '0'),
						'has_vars'			=> array('BOOL', '0'),
						'is_static'			=> array('BOOL', '0'),
						'minimod_based'		=> array('BOOL', '0'),
						'mod_block_id'		=> array('UINT', '0'),
					),
					'PRIMARY_KEY'	=> 'id',
				),
			),

			array('phpbb_k_menus', array(
					'COLUMNS'	=> array(
						'm_id'			=> array('UINT', NULL, 'auto_increment'),
						'ndx'			=> array('UINT', '0'),
						'menu_type'		=> array('USINT', '0'),
						'name'			=> array('VCHAR:50', ''),
						'link_to'		=> array('VCHAR', ''),
						'extern'		=> array('BOOL', '0'),
						'menu_icon'		=> array('VCHAR:30', 'none.gif'),
						'append_sid'	=> array('BOOL', '1'),
						'append_uid'	=> array('BOOL', '0'),
						'view_by'		=> array('UINT', '0'),
						'soft_hr'		=> array('BOOL', '0'),
						'sub_heading'	=> array('BOOL', '0'),
					),
					'PRIMARY_KEY'	=> 'm_id',
				),
			),

			array('phpbb_k_blocks_config', array(
					'COLUMNS'	=> array(
						'id'					=> array('USINT', NULL, 'auto_increment'),
						'blocks_width'			=> array('USINT', '180'),
						'blocks_enabled'		=> array('BOOL', '1'),
						'use_external_files'	=> array('BOOL', '0'),
						'update_files'			=> array('BOOL', '0'),
						'layout_default'		=> array('BOOL', '2'),
						'portal_version'		=> array('VCHAR:8', '1.0.0'),
						'portal_config'			=> array('VCHAR:10', 'Site'),
					),
				'PRIMARY_KEY'	=> 'id',
				),
			),

			array('phpbb_k_blocks_config_vars', array(
					'COLUMNS'	=> array(
						'config_name'		=> array('VCHAR', ''),
						'config_value'		=> array('VCHAR', ''),
						'is_dynamic'		=> array('BOOL', '0'),
					),
					'PRIMARY_KEY'	=> 'config_name',
					'KEYS'			=> array('is_dynamic'	=> array('INDEX', 'is_dynamic'),
					),
				),
			),

			array('phpbb_k_newsfeeds', array(
				'COLUMNS'	=> array(
					'feed_id'			=> array('UINT', NULL, 'auto_increment'),
					'feed_title'		=> array('STEXT_UNI', ''),
					'feed_show'			=> array('BOOL', '1'),
					'feed_url'			=> array('STEXT_UNI', ''),
					'feed_position'		=> array('UINT:1', '1'),
					'feed_description'	=> array('UINT:1', '1'),
					),
					'PRIMARY_KEY'	=> 'feed_id',
				),
			),

			array('phpbb_k_modules', array(
				'COLUMNS'	=> array(
					'mod_id'				=> array('UINT', NULL, 'auto_increment'),
					'mod_link_id'			=> array('UINT', '0'),
					'mod_type'				=> array('VCHAR:50', ''),
					'mod_origin'			=> array('BOOL', '0'),
					'mod_name'				=> array('VCHAR', ''),
					'mod_filename'			=> array('XSTEXT_UNI', ''),
					'mod_author'			=> array('XSTEXT_UNI', ''),
					'mod_link'				=> array('VCHAR', NULL),
					'mod_author_co'			=> array('VCHAR', NULL),
					'mod_support_link'		=> array('VCHAR', NULL),
					'mod_copyright'			=> array('XSTEXT_UNI', NULL),
					'mod_thumb'				=> array('STEXT_UNI', NULL),
					'mod_last_update'		=> array('VCHAR:15', NULL),
					'mod_details'			=> array('MTEXT_UNI', NULL),
					'mod_download_count'	=> array('UINT:8', '0'),
					'mod_status'			=> array('USINT', '0'),
					'mod_version'			=> array('VCHAR:10', NULL),
					'mod_bbcode_uid'		=> array('VCHAR_UNI:8', ''),
					'mod_bbcode_bitfield'	=> array('VCHAR_UNI', ''),
					'mod_bbcode_options'	=> array('UINT:4', '0'),
					),
					'PRIMARY_KEY'	=> 'mod_id',
					'KEYS'			=> array('mod_name'	=> array('INDEX', 'mod_name'),
					),
				),
			),

			array('phpbb_k_web_pages', array(
				'COLUMNS'	=> array(
					'id'			=> array('UINT', NULL, 'auto_increment'),
					'active'		=> array('BOOL', '1'),
					'page_name'		=> array('VCHAR_UNI:60', ''),
					'page_type'		=> array('CHAR:1', 'B'),
					'last_updated'	=> array('VCHAR:15', NULL),
					'body'			=> array('MTEXT_UNI', ''),
					'head'			=> array('UINT', '0'),
					'foot'			=> array('UINT', '0'),
					'external_file'	=> array('VCHAR_UNI', ''),
					'page_meta'		=> array('VCHAR_UNI', ''),
					'page_title'	=> array('VCHAR_UNI:100', ''),
					'page_desc'		=> array('VCHAR_UNI:100', ''),
					'page_extn'		=> array('BOOL', '0'),
					),
					'PRIMARY_KEY'	=> 'id',
				),
			),

			array('phpbb_k_youtube', array(
				'COLUMNS'	=> array(
					'video_id'			=> array('UINT', NULL, 'auto_increment'),
					'video_category'	=> array('XSTEXT_UNI', ''),
					'video_who'			=> array('XSTEXT_UNI', ''),
					'video_link'		=> array('VCHAR', '12'),
					'video_title'		=> array('XSTEXT_UNI', ''),
					'video_rating'		=> array('UINT', '4'),
					'video_comment'		=> array('STEXT_UNI', NULL),
					'video_poster_id'	=> array('UINT', '0'),
					),
					'PRIMARY_KEY'	=> 'video_id',
					'KEYS'			=> array('video_category'	=> array('INDEX', 'video_category'),
					),
				),
			),

			array('phpbb_k_quotes', array(
				'COLUMNS'	=> array(
					'quote_id'	=> array('UINT', NULL, 'auto_increment'),
					'quote'		=> array('TEXT_UNI', ''),
					'author'	=> array('XSTEXT_UNI', 'unknown'),
					),
					'PRIMARY_KEY'	=> 'quote_id',
				),
			),

			array('phpbb_k_referrals', array(
				'COLUMNS'	=> array(
					'id'			=> array('UINT', NULL, 'auto_increment'),
					'host'			=> array('STEXT_UNI', ''),
					'hits'			=> array('UINT', '0'),
					'firstvisit'	=> array('TIMESTAMP', NULL),
					'lastvisit'		=> array('TIMESTAMP', NULL),
					'enabled'		=> array('BOOL', '1'),
					),
					'PRIMARY_KEY'	=> 'id',
				),
			),

			array('phpbb_k_cloud', array(
				'COLUMNS'	=> array(
					'tag_id'	=> array('UINT', NULL, 'auto_increment'),
					'is_active'	=> array('BOOL', '1'),
					'tag'		=> array('USINT', '1'),
					'link'		=> array('VCHAR', 'portal.php'),
					'rel'		=> array('VCHAR:20', 'extern'),
					'font_size'	=> array('VCHAR:10', '9'),
					'colour'	=> array('VCHAR:10', '000000'),
					'colour2'	=> array('VCHAR:10', '333333'),
					'hcolour'	=> array('VCHAR:10', '00ff00'),
					'text'		=> array('VCHAR:50', 'empty'),
					),
					'PRIMARY_KEY'	=> 'tag_id',
				),
			),

			array('phpbb_k_resource', array(
				'COLUMNS'	=> array(
					'id'	=> array('UINT', NULL, 'auto_increment'),
					'word'	=> array('VCHAR:30', ''),
					'type'	=> array('CHAR:1', 'V'),
					),
					'PRIMARY_KEY'	=> 'id',
				),
			),

			array('phpbb_k_pages', array(
				'COLUMNS'	=> array(
					'page_id'			=> array('UINT', NULL, 'auto_increment'),
					'page_name'		=> array('VCHAR_UNI:100', ''),
					),
					'PRIMARY_KEY'	=> 'page_id',
				),
			),
		),

		'module_add' => array(
			array('acp', '0', 'ACP_CAT_PORTAL'),
			array('acp', 'ACP_CAT_PORTAL', 'ACP_K_CONFIG'),
			array('acp', 'ACP_CAT_PORTAL', 'ACP_K_BLOCKS'),
			array('acp', 'ACP_CAT_PORTAL', 'ACP_K_MENUS'),
			array('acp', 'ACP_CAT_PORTAL', 'ACP_K_MODULES'),
			array('acp', 'ACP_CAT_PORTAL', 'ACP_K_WEB_PAGES'),
			array('acp', 'ACP_CAT_PORTAL', 'ACP_K_TOOLS'),
			array('acp', 'ACP_CAT_PORTAL', 'ACP_K_CLOUD'),
			array('acp', 'ACP_CAT_PORTAL', 'ACP_K_YOUTUBE'),

			array('acp', 'ACP_K_CONFIG',	array(
					'module_basename' => 'k_config',
				), 
			),
			array('acp', 'ACP_K_BLOCKS',	array(
					'module_basename' => 'k_blocks',
				),
			),
			array('acp', 'ACP_K_MENUS',		array(
					'module_basename' => 'k_menus',
				), 
			),
			array('acp', 'ACP_K_MODULES',	array(
					'module_basename' => 'k_modules',
				), 
			),
			array('acp', 'ACP_K_WEB_PAGES',	array(
					'module_basename' => 'k_web_pages',
				),
			),
			array('acp', 'ACP_K_CLOUD',		array(
					'module_basename' => 'k_cloud',
				),
			),
			array('acp', 'ACP_K_YOUTUBE',	array(
					'module_basename' => 'k_youtube',
				),
			),
			array('acp', 'ACP_K_TOOLS',		array(
					'module_basename' => 'k_acronyms',
				), 
			),
			array('acp', 'ACP_K_TOOLS',		array(
					'module_basename' => 'k_newsfeeds',
				),
			),
			array('acp', 'ACP_K_TOOLS',		array(
					'module_basename' => 'k_poll',
				),
			),
			array('acp', 'ACP_K_TOOLS',		array(
					'module_basename' => 'k_referrals',
				),
			),
			array('acp', 'ACP_K_TOOLS',		array(
					'module_basename' => 'k_vars',
				),
			),
			array('acp', 'ACP_K_TOOLS',		array(
					'module_basename' => 'k_quotes',
				),
			),
			array('acp', 'ACP_K_TOOLS',	array(
					'module_basename' => 'k_resource_words',
				),
			),
			array('acp', 'ACP_K_TOOLS',	array(
					'module_basename' => 'k_pages',
				),
			),
		), 

		'table_column_add' => array(
			array('phpbb_icons', 'icons_group', array('BOOL', 0)),
			array('phpbb_smilies', 'smiley_group', array('BOOL', 0)),
			array('phpbb_users', 'user_left_blocks', array('VCHAR', '')),
			array('phpbb_users', 'user_center_blocks', array('VCHAR', '')),
			array('phpbb_users', 'user_right_blocks', array('VCHAR', '')),
		),

		'table_insert' => array(
			array($k_acronyms_table, $k_acronyms_array),
			array($k_blocks_table, $k_blocks_array),
			array($k_blocks_config_table, $k_blocks_config_array),
			array($k_blocks_config_vars_table, $k_blocks_config_vars_array),
			array($k_cloud_table, $k_cloud_array),
			array($k_menus_table, $k_menus_array),
			array($k_modules_table, $k_modules_array),
			array($k_newsfeeds_table, $k_newsfeeds_array),
			array($k_quotes_table, $k_quotes_array),
			array($k_referrals_table, $k_referrals_array),
			array($k_web_pages_table, $k_web_pages_array),
			array($k_youtube_table, $k_youtube_array),
			array($k_resource_table, $k_resource_array),
			array($k_pages_table, $k_pages_array),
		),
	),

);//version

include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);

?>