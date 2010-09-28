<?php
/***************************************************************************
 *                              acp_portal.php
 *                            -------------------
 *   begin                : Thursday, January 1st, 2006
 *   copyright            : (C) 2001 Michael O'Toole
 *   email                : support@phpirelland.com
 *
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 ***************************************************************************/

/**
* @package module_install
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

class acp_k_status_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_k_status',
			'title'		=> 'ACP_CAT_STATUS_CONFIG',
			'version'	=> '1.0.0',
			'modes'		=> array(
			'add'		=> array('title' => 'ACP_STATUS_ADD', 'auth' => 'acl_a_k_status'), 
			'status'	=> array('title' => 'ACP_STATUS_CONFIG', 'auth' => 'acl_a_k_status'), 
			'welcome'	=> array('title' => 'ACP_WELCOME_CONFIG', 'auth' => 'acl_a_k_status'), 
			'edit'		=> array('title' => 'ACP_STATUS_EDIT', 'auth' => 'acl_a_k_status'),
			 
			'themes'	=> array('title' => 'ACP_STATUS_THEMES', 'auth' => 'acl_a_k_status', 'cat' => array('ACP_CAT_STAUS')),
			'blocks'	=> array('title' => 'ACP_STATUS_BLOCKS', 'auth' => 'acl_a_k_status', 'cat' => array('ACP_CAT_STAUS')),
			'mods'		=> array('title' => 'ACP_STATUS_MODS', 'auth' => 'acl_a_k_status', 'cat' => array('ACP_CAT_STAUS')),
			'bugs'		=> array('title' => 'ACP_STATUS_BUGS', 'auth' => 'acl_a_k_status', 'cat' => array('ACP_CAT_STAUS')),			
			'other'		=> array('title' => 'ACP_STATUS_OTHER', 'auth' => 'acl_a_k_status', 'cat' => array('ACP_CAT_STAUS')),
			
			'config'	=> array('title' => 'ACP_STATUS_OTHER_CONFIG', 'auth' => 'acl_a_k_status', 'cat' => array('ACP_CAT_STAUS')),
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