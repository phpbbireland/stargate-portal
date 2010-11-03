<?php
/**
*
* @package acp Stargate Portal
* @Based on the original Tsangaris Gregory - aka Cybermage
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* -------------------------------------------------------------
* Ported to Stargate Potal by: Michaelo
* @version $Id: acp_k_quotes.php 297 2008-12-30 18:40:30Z Michaelo $
*/

/**
*
* @package acp
*/


if (!defined('IN_PHPBB'))
{
	exit;
}

class acp_k_quotes
{
	var $u_action;
	var $action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache;
		global $config, $k_config;
		global $SID, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		include($phpbb_root_path . 'includes/sgp_functions.'.$phpEx);

		$user->add_lang('acp/k_quotes');

		// Set up the page
		$this->tpl_name = 'acp_k_quotes';
		$this->page_title = 'ACP_K_QUOTES';

		// Set up general vars
		$action = request_var('config', '');
		$mode = request_var('mode', '');
		$action = request_var('action', '');
	
		$action = (isset($_POST['add'])) ? 'add' : ((isset($_POST['save'])) ? 'save' : ((isset($_POST['config'])) ? 'config' : $action));

		$s_hidden_fields = '';
		$quote_info = array();

		switch ($action)
		{
			case 'edit':
				$quote_id = request_var('id', 0);

				if (!$quote_id)
				{
					trigger_error($user->lang['NO_QUOTE'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$sql = 'SELECT *
					FROM ' . K_QUOTES_TABLE . "
					WHERE quote_id = " . (int)$quote_id;

				$result = $db->sql_query($sql);

				$quote_info = $db->sql_fetchrow($result);

				$db->sql_freeresult($result);

				$template->assign_vars(array(
					'S_EDIT_QUOTE'		=> true,
					'S_EDIT'			=> false,
					'U_ACTION'			=> $this->u_action,
					'U_BACK'			=> $this->u_action,
					'QUOTE'				=> (isset($quote_info['quote'])) ? $quote_info['quote'] : '',
					'AUTHOR'			=> (isset($quote_info['author'])) ? $quote_info['author'] : '',
					//'LANG'				=> (isset($quote_info['lang'])) ? $quote_info['lang'] : $user->data['user_lang'],
					'S_HIDDEN_FIELDS'	=> $s_hidden_fields)
				);

				$s_hidden_fields .= '<input type="hidden" name="quote_id" value="' . $quote_id . '" />';

			break;

			case 'add':
				$quote_info['quote'] = '';

				// remove the leading and trailing spaces from quotes //
				$temp = '';
				$len = strlen($quote_info['quote']);

				if ($len)
				{
					$quote_info['quote'][$len-1] = '';

					for ($i = 1; $i < $len; $i++)
					{
						$temp .= $quote_info['quote'][$i];
					}
					$quote_info['quote'] = $temp;
				}

				$template->assign_vars(array(
					'S_EDIT_QUOTE'		=> true,
					'S_EDIT'			=> false,
					'U_ACTION'			=> $this->u_action,
					'U_BACK'			=> $this->u_action,
					'QUOTE'				=> (isset($quote_info['quote'])) ? $quote_info['quote'] : '',
					'AUTHOR'			=> (isset($quote_info['author'])) ? $quote_info['author'] : '',
					//'LANG'				=> (isset($quote_info['lang'])) ? $quote_info['lang'] : $user->data['user_lang'],
					'S_HIDDEN_FIELDS'	=> $s_hidden_fields)
				);
				return;
			break;

			case 'save':

				$quote_id	= request_var('quote_id', 0);
				$quote		= utf8_normalize_nfc(request_var('quote', '', true));
				$author		= utf8_normalize_nfc(request_var('author', '', true));

				$quote = (trim($quote) == '') ? $quote : utf8_normalize_nfc(str_replace(' ', '&nbsp;', $quote));
				$author	= utf8_normalize_nfc(request_var('author', '', true));
				//$lang	= request_var('lang', $user->data['user_lang'], true);

				if (!$quote || !$author)
				{
					trigger_error($user->lang['ENTER_QUOTE'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				// Save quotes with a leading and trailing space to stop them from being replaced if part of another word or phrase...
				// as in URL's or links. This means all quotes must be whole words or phrases... 30 January 2009 Mike //
				// This could probably be achieved with less hassle in in preg_replace ? //

				$sql_ary = array(
					'quote'		=> ' '. $quote . ' ',
					'author'	=> $author,
					//'lang'		=> $lang,
				);

				if ($quote_id)
				{
					$db->sql_query('UPDATE ' . K_QUOTES_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE quote_id = ' . (int)$quote_id);
				}
				else
				{
					$db->sql_query('INSERT INTO ' . K_QUOTES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));
				}

				$cache->destroy('_quote');

				$log_action = ($quote_id) ? 'LOG_EDIT_QUOTES' : 'LOG_AD_QUOTES';
				add_log('admin', $log_action, $quote);

				$template->assign_var('MESSAGE', ($quote_id) ? $user->lang['QUOTE_UPDATED'] : $user->lang['QUOTE_ADDED']);

				meta_refresh(3, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_quotes");

			break;

			case 'delete':

				$quote_id = request_var('id', 0);

				if (!$quote_id)
				{
					trigger_error($user->lang['NO_QUOTE'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				if (confirm_box(true))
				{
					$sql = 'SELECT quote
						FROM ' . K_QUOTES_TABLE . "
						WHERE quote_id = " . $quote_id;

					$result = $db->sql_query($sql);

					$deleted_quote = $db->sql_fetchfield('quote');

					$db->sql_freeresult($result);

					$sql = 'DELETE FROM ' . K_QUOTES_TABLE . "
						WHERE quote_id = " . $quote_id;

					$db->sql_query($sql);

					$cache->destroy('_quotes');

					add_log('admin', 'LOG_QUOTE_DELETE', $deleted_quote);

					$template->assign_var('MESSAGE', $user->lang['QUOTE_REMOVED']);

					meta_refresh(2, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_quotes");
				}
				else
				{
					confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
						'i'			=> $id,
						'mode'		=> $mode,
						'id'		=> $quote_id,
						'action'	=> 'delete',
					)));
				}

			break;

			case 'config':
				$template->assign_var('MESSAGE', $user->lang['SWITCHING']);
				meta_refresh(1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_vars&amp;mode=config&amp;switch=k_quotes_vars.html");

			break;
		}

		$template->assign_vars(array(
			'U_ACTION'			=> $this->u_action,
			'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
		));

		$sql = 'SELECT *
			FROM ' . K_QUOTES_TABLE . '
			ORDER BY author, quote';

		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$template->assign_block_vars('quotes', array(
				'QUOTE'			=> $row['quote'],
				'QUOTES_AUTHOR'	=> $row['author'],
				'U_EDIT'		=> $this->u_action . '&amp;action=edit&amp;id=' . $row['quote_id'],
				'U_DELETE'		=> $this->u_action . '&amp;action=delete&amp;id=' . $row['quote_id'])
			);
		}
		$db->sql_freeresult($result);
	}
}
?>