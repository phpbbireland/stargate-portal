<?php
/**
*
* @author Michael O'Toole (michaelo) http://phpbbireland.com
*
* @package acp (Stargate Portal)
* @version $Id: acp_k_modules.php 305 2009-01-01 16:03:23Z Michealo $
* @copyright (c) 2005-2009 phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package module_install
*/

class acp_k_modules_info 
{
	function module()
	{
		return array(
			'filename'	=> 'acp_k_modules',
			'title'		=> 'ACP_K_MODULES',
			'version'	=> '1.0.0',
			'modes' => array(
				'add'		=> array('title' => 'ACP_K_MODS_ADD','auth' => 'acl_a_k_portal', 'cat' => array('ACP_CAT_K_MODULES')),
				'edit'		=> array('title' => 'ACP_K_MODS_EDIT', 'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MODULES'), 'display' => false),
				'delete'	=> array('title' => 'ACP_K_MODS_DELETE', 'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MODULES'), 'display' => false),
				'all'		=> array('title' => 'ACP_K_MODS_MISC', 'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MODULES')),
				'style'		=> array('title' => 'ACP_K_MODS_STYLES', 'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MODULES')),
				'mod'		=> array('title' => 'ACP_K_MODS_MODS', 'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MODULES')),
				'block'		=> array('title' => 'ACP_K_MODS_BLOCKS', 'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MODULES')),
				'welcome'	=> array('title' => 'ACP_K_CONFIG_WELCOME', 'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_MODULES'))			
			),
		);
	}

	function install()
	{
	}

	function uninstall()
	{
	}
}

?>