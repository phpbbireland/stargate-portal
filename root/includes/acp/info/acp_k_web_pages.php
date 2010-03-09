<?php
/**
*
* @author Michael O'Toole (michaelo) http://phpbbireland.com
*
* @package acp (Stargate Portal)
* @version $Id: acp_k_web_pages.php 305 2009-01-01 16:03:23Z Michealo $
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

class acp_k_web_pages_info 
{
	function module()
	{
		return array(
			'filename'	=> 'acp_k_web_pages',
			'title'		=> 'ACP_K_WEBPAGES',
			'version'	=> '1.0.0',
			'modes' => array(
				'add'		=> array('title' => 'ACP_K_WEB_PAGES_ADD',		'auth' => 'acl_a_k_web_pages', 'cat' => array('ACP_K_WEB_PAGES')),
				'edit'		=> array('title' => 'ACP_K_WEB_PAGES_EDIT',		'auth' => 'acl_a_k_web_pages', 'cat' => array('ACP_K_WEB_PAGES'), 'display' => false),
				'delete'	=> array('title' => 'ACP_K_WEB_PAGES_DELETE',	'auth' => 'acl_a_k_web_pages', 'cat' => array('ACP_K_WEB_PAGES'), 'display' => false),
				'all'		=> array('title' => 'ACP_K_WEB_PAGES_ALL',		'auth' => 'acl_a_k_web_pages', 'cat' => array('ACP_K_WEB_PAGES')),
				'body'		=> array('title' => 'ACP_K_WEB_PAGES_BODY',		'auth' => 'acl_a_k_web_pages', 'cat' => array('ACP_K_WEB_PAGES')),
				'head'		=> array('title' => 'ACP_K_WEB_PAGES_HEAD',		'auth' => 'acl_a_k_web_pages', 'cat' => array('ACP_K_WEB_PAGES')),
				'foot'		=> array('title' => 'ACP_K_WEB_PAGES_FOOT',		'auth' => 'acl_a_k_web_pages', 'cat' => array('ACP_K_WEB_PAGES')),
				'portal'	=> array('title' => 'ACP_K_WEB_PAGES_PORTAL',	'auth' => 'acl_a_k_web_pages', 'cat' => array('ACP_K_WEB_PAGES'))
			
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