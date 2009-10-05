<?php
/**
* @Based on the original phpBB2 Acronym © 2005 CodeMonkeyX
* @author Michael O'Toole (michaelo) http://phpbbireland.com
*
* @package acp (Stargate Portal)
* @version $Id: acp_k_acronyms.php 305 2009-01-01 16:03:23Z Michealo $
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

class acp_k_acronyms_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_k_acronyms',
			'title'		=> 'ACP_K_TOOLS',
			'version'	=> '0.1.0',
			'modes'		=> array(
				'edit_acronym'  => array('title' => 'ACP_K_ACRONYMS', 'auth' => 'acl_a_k_tools', 'cat' => array('ACP_K_TOOLS')),
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