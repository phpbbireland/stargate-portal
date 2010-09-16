<?php
/**
*
* @package acp Stargate Portal
* @version $Id: acp_k_poll.php 305 2009-01-01 16:03:23Z Michealo $
* @copyright (c) 2007 Stargate Portal Team
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

class acp_k_poll
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache;
		global $k_config, $SID, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		include_once($phpbb_root_path . 'includes/sgp_functions.'.$phpEx);

		$message ='';

		$user->add_lang('acp/k_poll');
		$this->tpl_name = 'acp_k_poll';
		$this->page_title = 'ACP_K_POLL';

		$form_key = 'acp_k_poll';
		add_form_key($form_key);

		// Set up general vars
		$action = request_var('action', '');
		$action = (isset($_POST['edit'])) ? 'edit' : $action;
		$action = (isset($_POST['add'])) ? 'add' : $action;
		$action = (isset($_POST['save'])) ? 'save' : $action;
		$poll_id = request_var('id', 0);


		$template->assign_vars(array(
			'POLL_POST_ID'			=> $k_config['poll_post_id'],
			'POLL_VIEW'				=> $k_config['poll_view'],
		));	


		$sql = 'SELECT config_name, config_value
			FROM ' . K_BLOCKS_CONFIG_VAR_TABLE . '';  

		$result = $db->sql_query($sql);

		while($row = $db->sql_fetchrow($result))
		{
			$k_config[$row['config_name']] = $row['config_value'];
		}

		switch ($action)
		{
			case 'editpoll':
	 			if ($action == 'editpoll')
				{
					$config_poll_post_id = request_var('poll_post_id','', true);
					$config_poll_view = request_var('poll_view','', true);
				}

				$template->assign_vars(array(
					'S_EDIT_POLL'			=> true,
					'U_BACK'				=> $this->u_action,					
					'U_ACTION_EDIT_COLUMN'	=> $this->u_action . '&amp;action=editpoll',
					'POLL_POST_ID'			=> $k_config['poll_post_id'],
					'POLL_VIEW'				=> $k_config['poll_view'],
				));					
            break;				

			case 'savepoll':
				$config_poll_post_id = request_var('poll_post_id','', true);
				$config_poll_view = request_var('poll_view','', true);

 				if ($action == 'savepoll')
				{
					$db->sql_query('UPDATE ' . K_BLOCKS_CONFIG_VAR_TABLE . ' SET config_value = "' . $config_poll_post_id . '" WHERE config_name = "poll_post_id"');
					$db->sql_query('UPDATE ' . K_BLOCKS_CONFIG_VAR_TABLE . ' SET config_value = "' . $config_poll_view . '" WHERE config_name = "poll_view"');
					
					$message = $user->lang['CONFIG_UPDATED'];
				}
				$db->sql_query($sql);

				//$cache->destroy('k_config');
				trigger_error($message . adm_back_link($this->u_action));
				
				$template->assign_vars(array(
					'S_SAVE_POLL'			=> true,
					'U_BACK'				=> $this->u_action,					
					'U_ACTION_SAVE_COLUMN'	=> $this->u_action . '&amp;action=savepoll',
					'POLL_POST_ID'			=> $k_config['poll_post_id'],
					'POLL_VIEW'				=> $k_config['poll_view']
					));
			break;			

			default:
				$template->assign_block_vars('poll_column', array(
					'S_EDIT_POLL'		=> false,
					'POLL_POST_ID'		=> 	$k_config['poll_post_id'],
					'POLL_VIEW'			=>  $k_config['poll_view'],
					'U_EDIT_POLL'		=> 	$this->u_action . '&amp;action=editpoll'
				));
			break;
		}
	}
}
?>