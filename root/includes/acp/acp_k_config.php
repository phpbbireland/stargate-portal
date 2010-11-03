<?php
/**
*
* @package acp Stargate Portal
* @version $Id: acp_k_config.php 312 2009-01-02 02:51:12Z Michealo $
* @copyright (c) 2007 Michael O'Toole aka michaelo
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package acp
*/

class acp_k_config
{
	var $u_action;
		
	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache;
		global $config, $SID, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$message ='';

		$user->add_lang('acp/k_config');
		$this->tpl_name = 'acp_k_config';
		$this->page_title = 'ACP_K_PORTAL_CONFIG';

		$form_key = 'acp_k_config';
		add_form_key($form_key);		

		$action = request_var('action', '');
		$mode	= request_var('mode', '');	
		$generate = request_var('generate', '');	

		$submit = (isset($_POST['submit'])) ? true : false;

		$forum_id	= request_var('f', 0);		
		$forum_data = $errors = array();

		if ($submit && !check_form_key($form_key))
		{
			$submit = false;
			$mode = '';
			trigger_error($user->lang['FORM_INVALID']);
		}		

		$sql = 'SELECT * FROM ' . K_BLOCKS_CONFIG_TABLE . '';
		if ($result = $db->sql_query($sql))
		{
			$row = $db->sql_fetchrow($result);

			$blocks_width		= $row['blocks_width'];
			$blocks_enabled		= $row['blocks_enabled'];
			$layout_default 	= $row['layout_default'];
			$portal_version		= $row['portal_version'];
			$id                 = $row['id'];
		}
		else
		{
			trigger_error($user->lang['ERROR_PORTAL_CONFIG'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
		}	

		$template->assign_vars(array(
			'L_PORTAL_MESSAGE'				=> $message,
			'S_BLOCKS_WIDTH'				=> $row['blocks_width'],
			'S_BLOCKS_ENABLED'				=> $row['blocks_enabled'],
			'S_PORTAL_SET_LAYOUT_DEFAULT'	=> $row['layout_default'],
			'S_PORTAL_VERSION'				=> $row['portal_version'],			
			'S_BLOCK_ID'                    => $row['id'],
			'U_BACK'						=> $this->u_action,
//			'U_BACK'						=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=portal_config&amp;mode=config",
		));		
		
		$template->assign_vars(array('S_OPT' => 'Configure')); // S_OPT is not a language variabe //

		if ($submit) 
		{
			$mode = 'save';
		}
		else
		{
			$mode = 'reset';
		}
	
		switch ($mode)
		{
			case 'save': 
			{
				
				$blocks_width   	= request_var('blocks_width', '');
				$blocks_enabled		= request_var('blocks_enabled', '');
				$layout_default 	= request_var('set_layout_default', '');
				$portal_version		= request_var('portal_version', '');
				
				$sql = "UPDATE " . K_BLOCKS_CONFIG_TABLE . "
					SET 
					blocks_width	= 	'" . $db->sql_escape($blocks_width) . "',
					blocks_enabled	= 	'" . $db->sql_escape($blocks_enabled) . "',
					layout_default	= 	'" . $db->sql_escape($layout_default) . "',
					portal_version	= 	'" . $db->sql_escape($portal_version) . "'
					WHERE id = '" . (int)$id . "'";

				$db->sql_query($sql);
				
				$mode='reset';
				
				$template->assign_var('S_OPT', 'save');
				
				meta_refresh(2, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_config&amp;mode=config");
				return;
				break;
			}
			case 'default': 
			break;
		}

		/*
		switch ($action)
		{
			case 'default': 
			break;
		}
		*/
		
	}				
}

?>