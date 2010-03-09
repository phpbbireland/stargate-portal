<?php
/**
*
* @package acp
* @version $Id: acp_k_version_check.php 297 2008-12-30 18:40:30Z JohnnyTheOne $
* @copyright (c) 2007 Handyman - StarTrekGuide
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package mod_version_check
*/
class acp_version_check_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_version_check',
			'title'		=> 'ACP_K_MOD_VERSION_CHECK',
			'version'	=> '1.0.2',
			'modes'		=> array(
				'version_check'		=> array('title' => 'ACP_K_MOD_VERSION_CHECK', 'auth' => 'acl_a_k_tools', 'cat' => array('ACP_K_TOOLS')),
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