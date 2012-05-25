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

		//$mode = request_var('mode', '');
		$action = request_var('action', '');
		//$submit = (isset($_POST['submit'])) ? true : false;

		$username = request_var('username', '');

		$reset_user_attempts = request_var('reset_user_attempts', '');
		$reset_users_attempts = request_var('reset_users_attempts', '');
		$reset_guest_layout = request_var('reset_guest_layout', '');

		if($reset_user_attempts)
		{
			if($username != '')
			{
				$mode = 'reset_user';
				$submit = true;
			}
			else
			{
				$mode = 'tools';
				$submit = false;
				$template->assign_vars(array(
					'U_BACK'	=> $this->u_action,
					'S_RESET'	=> false,
					'MESSAGE'	=> $user->lang['NO_MANE_GIVEN'],
				));
			}
		}
		else if($reset_users_attempts)
		{
			$mode = 'reset_users';
			$submit = true;
		}
		else if($reset_guest_layout)
		{
			$mode = 'reset_anon';
			$submit = true;
		}
		else
		{
			$mode = 'tools';
			$submit = false;
		}

		if (($reset_user_attempts || $reset_users_attempts || $reset_guest_layout) && !check_form_key($form_key))
		{
			$submit = false;
			$mode = 'tools';
			trigger_error($user->lang['FORM_INVALID']);
		}

		$template->assign_vars(array(
			'U_BACK'	=> $this->u_action,
			'S_RESET'	=> false,
			'USER_NAME'	=> ($username) ? $username : '?',
			'PROCESS'	=> $mode,
		));

		switch ($mode)
		{
			case 'reset_user':

				if($submit && $username != '')
				{
					$sql = "UPDATE " . USERS_TABLE . "
						SET user_login_attempts = '0'
						WHERE username = '" . $db->sql_escape($username) . "'";
					$result = $db->sql_query($sql);

					$template->assign_vars(array(
						'S_RESET'	=> true,
						'MESSAGE'	=> sprintf($user->lang['REPORT_USER'], $username),
					));

					$db->sql_freeresult($result);

					meta_refresh (2, append_sid("{$phpbb_admin_path}index.$phpEx", "i=k_tools&mode=tools"));
				}
			break;

			case 'reset_users':

				if($submit)
				{
					$sql = "UPDATE " . USERS_TABLE . "
						SET user_login_attempts = '0'
						WHERE user_login_attempts != '0'";
					$result = $db->sql_query($sql);

					$template->assign_vars(array(
						'S_RESET'	=> true,
						'MESSAGE'	=> (isset($user->lang['REPORT_USERS'])) ? $user->lang['REPORT_USERS'] : 'L_NO_LANG_VAR',
					));

					$db->sql_freeresult($result);

					meta_refresh (2, append_sid("{$phpbb_admin_path}index.$phpEx", "i=k_tools&mode=tools"));
				}

			break;

			case 'reset_anon':

				if($submit)
				{
					$sql = "UPDATE " . USERS_TABLE . "
						SET user_left_blocks = '', user_center_blocks = '', user_right_blocks = ''
						WHERE user_id = '1'";
					$result = $db->sql_query($sql);

					$template->assign_vars(array(
						'S_RESET'	=> true,
						'MESSAGE'	=> (isset($user->lang['REPORT_ANON'])) ? $user->lang['REPORT_ANON'] : 'L_NO_LANG_VAR',
					));

					$db->sql_freeresult($result);

					meta_refresh (2, append_sid("{$phpbb_admin_path}index.$phpEx", "i=k_tools&mode=tools"));
				}

			break;

			default:
			break;
		}
	}
}
?>