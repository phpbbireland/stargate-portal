<?php
/**
*
* @package acp Stargate Portal
* @Based on the original phpBB2 Acronym © 2005 CodeMonkeyX
* @www : http://www.codemonkeyx.net
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* -------------------------------------------------------------
* Addon for the Acronym mod from CodeMonkeyX
* Originally made for PHP-Nuke 6.5 by Mighty_Y <http://www.portedmods.com>
* but then also made for phpBB standalone as an act of respect for CodeMonkeyX
* -------------------------------------------------------------
* Ported to Stargate Potal by: Michaelo
*/

/**
* @todo [acronyms] check regular expressions for special char MEANINGs (stored specialchared in db)
* @package acp
*/

/**
* 28 October 2010 
* Edits re validation (Paul)
*
* Replace english with language var...
* Remove confusing S_OPT/S_OPTION lower case switch looks like english...
* Use $db->sql_build_array were possible to sanitise...
**/



if (!defined('IN_PHPBB'))
{
	exit;
}

/* this needs more work... Mike...*/

class acp_k_acronyms
{
	var $u_action;
	var $action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache;
		global $config, $k_config;
		global $SID, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		include($phpbb_root_path . 'includes/sgp_functions.'.$phpEx);
		include($phpbb_root_path . 'includes/sgp_functions_admin.'.$phpEx);

		$user->add_lang('acp/k_acronyms'); 
		$user->add_lang('acp/k_vars');

		// Set up the page
		$this->tpl_name = 'acp_k_acronyms';
		$this->page_title = 'ACP_K_ACRONYMS';

		// Set up general vars

		$action = request_var('config', '');
		$mode = request_var('mode', '');

		$action = request_var('action', '');
		$action = (isset($_POST['add'])) ? 'add' : ((isset($_POST['save'])) ? 'save' : ((isset($_POST['config'])) ? 'config' : $action));

		///$form_action = $this->u_action. '&action=add';

		$s_hidden_fields = '';
		$acronym_info = array();

		switch ($action)
		{
			case 'edit':
				$acronym_id = request_var('id', 0);

				if (!$acronym_id)
				{
					trigger_error($user->lang['NO_ACRONYM'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$sql = 'SELECT *
					FROM ' . K_ACRONYMS_TABLE . "
					WHERE acronym_id = $acronym_id";

				$result = $db->sql_query($sql);

				$acronym_info = $db->sql_fetchrow($result);

				$db->sql_freeresult($result);

				$s_hidden_fields .= '<input type="hidden" name="acronym_id" value="' . $acronym_id . '" />';

			//continue

			case 'add':
				$template->assign_vars(array(
					'S_EDIT_ACRONYM'	=> true,
					'S_EDIT'			=> false,
					'U_ACTION'			=> $this->u_action,
					'U_BACK'			=> $this->u_action,
					'ACRONYM'			=> (isset($acronym_info['acronym'])) ? $acronym_info['acronym'] : '',
					'MEANING'			=> (isset($acronym_info['meaning'])) ? $acronym_info['meaning'] : '',
					'LANG'				=> (isset($acronym_info['lang'])) ? $acronym_info['lang'] : $user->data['user_lang'],
					'S_HIDDEN_FIELDS'	=> $s_hidden_fields)
				);
				return;
			break;

			case 'save':
				$acronym_id	= request_var('acronym_id', 0);
				$acronym	= utf8_normalize_nfc(request_var('acronym', '', true));
				$meaning	= utf8_normalize_nfc(request_var('meaning', '', true));
				$lang		= request_var('lang', $user->data['user_lang']);

				// valid entries? //
				if (!$acronym || !$meaning)
				{
					trigger_error($user->lang['ENTER_ACRONYM'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				// prevent acronyms meaning from breaking things...
				if (strpos($meaning, 'Stargate', 1))
				{
					$meaning = str_replace('Stargate Portal', 'Stargate-Portal', $meaning);
				}

				$sql_ary = array(
					'acronym'	=> $acronym,
					'meaning'	=> $meaning,
					'lang'		=> $lang,
				);

				if ($acronym_id)
				{
					$db->sql_query('UPDATE ' . K_ACRONYMS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE acronym_id = ' . (int)$acronym_id);
				}
				else
				{
					$db->sql_query('INSERT INTO ' . K_ACRONYMS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));
				}

				$cache->destroy('_acronyms');
				$cache->destroy('sql', K_MODULES_TABLE);

				$log_action = ($acronym_id) ? 'LOG_EDIT_ACRONYM' : 'LOG_ADD_ACRONYM';
				add_log('admin', $log_action, $acronym);


				$template->assign_vars(array(
					'MESSAGE' => ($acronym_id) ? $user->lang['ACRONYM_UPDATED'] : $user->lang['ACRONYM_ADDED'],
					)
				);

				meta_refresh(3, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=k_acronyms'));

			break;

			case 'delete':
				$acronym_id = request_var('id', 0);

				if (!$acronym_id)
				{
					trigger_error($user->lang['NO_ACRONYM'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				if (confirm_box(true))
				{
					$sql = 'SELECT acronym
						FROM ' . K_ACRONYMS_TABLE . "
						WHERE acronym_id = " . (int)$acronym_id;

					$result = $db->sql_query($sql);
					$deleted_acronym = $db->sql_fetchfield('acronym');
					$db->sql_freeresult($result);

					$sql = 'DELETE FROM ' . K_ACRONYMS_TABLE . "
						WHERE acronym_id = " . (int)$acronym_id;
					$db->sql_query($sql);

					$cache->destroy('_acronyms');
					$cache->destroy('sql', K_MODULES_TABLE);

					add_log('admin', 'LOG_ACRONYM_DELETE', $deleted_acronym);

					$template->assign_vars(array(
						'MESSAGE' => $user->lang['ACRONYM_REMOVED'],
						)
					);

					meta_refresh(2, append_sid("{$phpbb_admin_path}index.$phpEx", 'i=k_acronyms'));

				}
				else
				{
					confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
						'i'			=> $id,
						'mode'		=> $mode,
						'id'		=> $acronym_id,
						'action'	=> 'delete',
					)));
				}

			break;

			case 'config':
				$template->assign_vars(array(
					'MESSAGE' => $user->lang['SWITCHING_TO_ACRONYM_VARS'],
					)
				);

				$switch = 'k_acronym_vars.html';
				meta_refresh (1, append_sid("{$phpbb_admin_path}index.$phpEx", "i=k_vars&amp;mode=config&amp;switch=" . $switch));

			break;
		}

		$template->assign_vars(array(
			'U_ACTION'			=> $this->u_action,
			'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
			)
		);

		$sql = 'SELECT *
			FROM ' . K_ACRONYMS_TABLE . '
			ORDER BY acronym';
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$template->assign_block_vars('acronyms', array(
				'ACRONYM'		=> $row['acronym'],
				'MEANING'		=> $row['meaning'],
				'U_EDIT'		=> $this->u_action . '&amp;action=edit&amp;id=' . $row['acronym_id'],
				'U_DELETE'		=> $this->u_action . '&amp;action=delete&amp;id=' . $row['acronym_id'])
			);
		}
		$db->sql_freeresult($result);
	}
}

/*
function validate_acronym_meaning($acro)
{
	global $db;
	$sql = 'SELECT meaning
		FROM ' . K_ACRONYMS_TABLE;
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		if (strpos($row['meaning'], $acro))
		{
			$db->sql_freeresult($result);
			return(false);
		}
	}
	$db->sql_freeresult($result);
	return(true);
}
*/

?>