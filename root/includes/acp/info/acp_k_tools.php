<?php
/**
*
* @author Michael O'Toole (michaelo) http://phpbbireland.com
*
* @package acp (Stargate Portal)
* @version $Id: acp_k_tools.php 001  2011-22-01 10:03:23Z Michealo $
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

class acp_k_tools_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_k_tools',
			'title'		=> 'ACP_K_PORTAL_TOOLS',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'tools' 	=> array('title' => 'ACP_K_PORTAL_TOOLS', 'auth' => 'acl_a_k_portal',	'cat' => array('ACP_K_TOOLS')),
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