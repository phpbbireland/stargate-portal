<?php
/**
*
* @package acp Stargate Portal
* @version $Id: acp_k_tools.php 305 2009-01-01 16:03:23Z Michealo $
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

class acp_k_tools
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache;
		global $k_config, $SID, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		include($phpbb_root_path . 'includes/sgp_functions.'.$phpEx);

		$message ='';

		$user->add_lang('acp/k_tools');
		$this->tpl_name = 'acp_k_tools';
		$this->page_title = 'ACP_K_tools';

		$form_key = 'acp_k_tools';
		add_form_key($form_key);


		$mode = request_var('mode', '');
		$action = request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;
		$username = request_var('username', '');


		if ($action == 'reset_all')
		{
			$mode = 'tools';
		}

		if ($username && $action == '' )
		{
			$mode = 'username';
		}

		if ($submit && !check_form_key($form_key))
		{
			$submit = false;
			$mode = '';
			trigger_error($user->lang['FORM_INVALID']);
		}

		$template->assign_vars(array(
			'S_RESET'	=> false,
			'MESSAGE'	=> '',
			'USER_NAME'	=> ($username) ? $username : '',
		));

		switch ($mode)
		{
			case 'tools':

				if($submit && $action == 'reset_all')
				{
					$sql = "UPDATE " . USERS_TABLE . "
						SET user_login_attempts = '0'
						WHERE user_login_attempts != '0'";
					$result = $db->sql_query($sql);

					$template->assign_vars(array(
						'S_RESET'	=> true,
						'MESSAGE'	=> (isset($user->lang['REPORT'])) ? $user->lang['REPORT'] : 'L_NO_LANG_VAR',
					));

					$db->sql_freeresult($result);

					meta_refresh (2, append_sid("{$phpbb_admin_path}index.$phpEx", "i=k_tools&mode="));
				}

			break;

			case 'username':

				if($submit && $username != '')
				{
					$sql = "UPDATE " . USERS_TABLE . "
						SET user_login_attempts = '0'
						WHERE username = '" . $db->sql_escape($username) . "'";
					$result = $db->sql_query($sql);
	
					$template->assign_vars(array(
						'S_RESET'	=> true,
						'MESSAGE'	=> sprintf($user->lang['REPORT_ONE'], $username),
					));

					$db->sql_freeresult($result);

					meta_refresh (2, append_sid("{$phpbb_admin_path}index.$phpEx", "i=k_tools&mode="));
				}
			break;

			default:
			break;
		}
	}
}
?>