<?php
/**
*
* @package acp Stargate Portal
* @version $Id: acp_k_resource_words.php 312 2009-01-02 02:51:12Z Michealo $
* @copyright (c) 2008 Martin Larsson - aka NeXur Michaelo
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

class acp_k_resource_words
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache , $k_cache;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		include($phpbb_root_path . 'includes/sgp_functions.'.$phpEx);

		$user->add_lang('acp/k_resource_words');
		$this->tpl_name = 'acp_k_resource_words';
		$this->page_title = 'ACP_K_RESOURCE_WORDS';
		
		$form_key = 'acp_k_resource_words';
		add_form_key($form_key);
		
		// Set up general vars
		$action = request_var('action', '');
		$action = (isset($_POST['edit'])) ? 'edit' : $action;
		$action = (isset($_POST['add'])) ? 'add' : $action;
		$action = (isset($_POST['save'])) ? 'save' : $action;
		$action = (isset($_POST['switch'])) ? 'switch' : $action;
		$action = (isset($_POST['delete'])) ? 'delete' : $action;

		// ======================================================
		//			[ MAIN PROCESS ]
		// ======================================================

/*
		$delete		= ( isset($_POST['delete']) ) ? TRUE : 0;
		$delete_all	= ( isset($_POST['deleteall']) ) ? TRUE : 0;

		$delete		= request_var('delete', 0);
		$switch		= request_var('switch', '');
*/
		$add		= request_var('add', '');


		$id_list = ( ( isset($_POST['id_list']) ) ? $_POST['id_list'] : ( (isset($_GET['id_list'])) ? $_GET['id_list'] : array()));

		switch($action)
		{
			case 'add':

				$process = true;
				$start = '{';
				$end = '}';

				$new_word = request_var('new_word', '');

				if (isset($k_config[$new_word]))
				{
					$value = (isset($k_config[$new_word])) ? $k_config[$new_word] : '';
					$table = 'k_config';
				}
				else if (isset($config[$new_word]))
				{
					$value = (isset($config[$new_word])) ? $config[$new_word] : '';
					$table = 'config';
				}
				else
				{
					$table = 'Unknown';
					$process = false;
					$template->assign_vars( array(
						'L_PROCESS_REPORT'	=> sprintf($user->lang['VAR_NOT_FOUND'], $new_word),
					));
				}

				if($process)
				{

					$template->assign_vars( array(
						'L_PROCESS_REPORT'	=> sprintf($user->lang['VAR_ADDED'], $new_word),
					));

					$start .= strtoupper($new_word) . $end;

					$sql_array = array(
						'word'	=> $start,
					);

					if (!$db->sql_query('INSERT INTO ' . K_RESOURCE_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_array)))
					{
						trigger_error($user->lang['ERROR_PORTAL_WORDS'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
					}
				}

			break;

			case 'delete':
				for ($i = 0; $i < count($id_list); $i++)
				{
					$sql = 'DELETE FROM '. K_RESOURCE_TABLE ." WHERE id = " . $id_list[$i];
					if (!$result = $db->sql_query($sql))
					{
						trigger_error($user->lang['ERROR_PORTAL_WORDS'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
					}
				}
			break;

			default:
				$template->assign_vars( array(
					'L_PROCESS_REPORT'	=> '',
				));
			break;
		}

		$sql = 'SELECT * FROM ' . K_RESOURCE_TABLE;

		if (!$result = $db->sql_query($sql))
		{
			trigger_error($user->lang['ERROR_PORTAL_WORDS'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
		}

		$a = array('{', '}');
		$b = array('','');

		$value = '';

		while ($row = $db->sql_fetchrow($result))
		{
			$name = strtolower($row['word']);
			$name = str_replace($a, $b, $name);

			if (isset($k_config[$name]))
			{
				$value = (isset($k_config[$name])) ? $k_config[$name] : '';
				$table = 'k_config';
			}
			else if (isset($config[$name]))
			{
				$value = (isset($config[$name])) ? $config[$name] : '';
				$table = 'config';
			}
			else
			{
				$table = 'Unknown';
			}

			$template->assign_block_vars('wordrow', array(
				'ID'	=> $row['id'],
				'WORD'	=> $row['word'],
				'NAME'	=> $name,
				'VALUE'	=> $value,
				'TABLE'	=> $table
			));
		}
		$db->sql_freeresult($result);

	}


}

?>
