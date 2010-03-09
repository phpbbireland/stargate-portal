<?php
/**
*
* @author Michael O'Toole (michaelo) http://phpbbireland.com
*
* @package acp (Stargate Portal)
* @version $Id: acp_k_menus.php 305 2009-01-01 16:03:23Z Michealo $
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

class acp_k_cloud_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_k_cloud',
			'title'		=> 'ACP_K_CLOUD',
			'version'	=> '1.0.0',
			'modes' => array(
				'add'		=> array('title' => 'ACP_K_CLOUD_ADD',			'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_CLOUDS')),
				'delete'	=> array('title' => 'ACP_K_CLOUD_DELETE',		'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_CLOUDS'), 'display' => false),
				'edit'		=> array('title' => 'ACP_K_CLOUD_EDIT',			'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_CLOUDS'), 'display' => false),
				'browse'	=> array('title' => 'ACP_K_CLOUD_BROWSE',		'auth' => 'acl_a_k_portal', 'cat' => array('ACP_K_CLOUDS'))
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