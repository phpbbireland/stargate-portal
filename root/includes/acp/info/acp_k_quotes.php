<?php
/**
* @author Michael O'Toole (michaelo) http://phpbbireland.com
*
* @package acp (Stargate Portal)
* @version $Id: acp_k_quotes.php 305 2009-01-01 16:03:23Z Michealo $
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

class acp_k_quotes_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_k_quotes',
			'title'		=> 'ACP_K_TOOLS',
			'version'	=> '0.1.0',
			'modes'		=> array(
				'add'		=> array('title' => 'ACP_K_QUOTES_ADD', 'auth' => 'acl_a_k_tools', 'cat' => array('ACP_K_TOOLS')),
				'edit'		=> array('title' => 'ACP_K_QUOTES_EDIT', 'auth' => 'acl_a_k_tools', 'cat' => array('ACP_K_TOOLS')),
				'config'	=> array('title' => 'ACP_K_QUOTES_CONFIG', 'auth' => 'acl_a_k_tools', 'cat' => array('ACP_K_TOOLS')),
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