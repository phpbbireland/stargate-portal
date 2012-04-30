<?php
/**
*
* @package acp Stargate Portal
* @version $Id: acp_k_cloud.php 305 2009-01-01 16:03:23Z Michealo $
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

class acp_k_cloud
{

	var $u_action;
	var $action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache;
		global $config, $SID, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$user->add_lang('acp/k_cloud');
		$this->tpl_name = 'acp_k_cloud';
		$this->page_title = 'ACP_CLOUD';

		$form_key = 'acp_k_cloud';
		add_form_key($form_key);

		$s_hidden_fields = '';

		$tag_id = '';

		$mode			= request_var('mode', '');
		$tag_id			= request_var('tag_id', '');
		$action			= request_var('config', '');
		//$cloud_group	= request_var('cloud_group', '');

		$action = (isset($_POST['add_tag'])) ? 'add' : ((isset($_POST['save'])) ? 'save' : ((isset($_POST['config'])) ? 'config' : $action));

		switch ($action)
		{
			case 'config':
				$template->assign_vars(array(
					'MESSAGE'	=> $user->lang['SWITCHING'],
				));

				meta_refresh(1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_vars&amp;mode=config&amp;switch=k_cloud_vars.html");
			break;

			case 'add':
				$mode = '';
				meta_refresh(0, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_cloud&amp;mode=add");
			break;

			default:
		}

		$submit = (isset($_POST['submit'])) ? true : false;

		if (!$action && $mode == 'browse');
		{
			get_cloud_data();
		}

		if ($submit && !check_form_key($form_key))
		{
			$submit = false;
			$mode = '';
			trigger_error($user->lang['FORM_INVALID'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
		}

		$template->assign_vars(array(
			'U_BACK'	=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_cloud",
			'U_ADD'		=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_cloud&amp;mode=add",
			'U_EDIT'	=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_cloud&amp;mode=edit" . '&amp;tag_id=' . $tag_id,
			'U_DELETE'	=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_cloud&amp;mode=delete" . '&amp;tag_id=' . $tag_id,
			'U_BROWSE'	=> "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_cloud&amp;mode=browse",
			'U_SWATCH1'	=> append_sid("{$phpbb_admin_path}swatch2.$phpEx", 'form=acp_k_cloud&amp;name=colour'),
			'U_SWATCH2'	=> append_sid("{$phpbb_admin_path}swatch2.$phpEx", 'form=acp_k_cloud&amp;name=colour2'),
			'U_SWATCH3'	=> append_sid("{$phpbb_admin_path}swatch2.$phpEx", 'form=acp_k_cloud&amp;name=hcolour'),
			'S_OPTION'	=> 'browse',
		));

		switch ($mode)
		{
			case 'edit':
			{
				if ($submit)
				{
					$tag_id		= request_var('tag_id', '');
					$is_active	= request_var('is_active', '');
					$tag		= request_var('tag', '');
					$link		= request_var('link', '');
					$rel		= request_var('rel', '');
					$font_size	= request_var('font_size', '');
					$colour		= request_var('colour', '');
					$colour2	= request_var('colour2', '');
					$hcolour	= request_var('hcolour', '');
					$text		= utf8_normalize_nfc(request_var('text', '', true));

					$colour = str_replace("#", "", $colour);
					$colour2  = str_replace("#", "", $colour2);
					$hcolour  = str_replace("#", "", $hcolour);

					$sql_ary = array(
						'tag_id'	=> $tag_id,
						'is_active'	=> $is_active,
						'tag'		=> $tag,
						'link'		=> $link,
						'rel'		=> $rel,
						'font_size'	=> $font_size,
						'colour'	=> $colour,
						'colour2'	=> $colour2,
						'hcolour'	=> $hcolour,
						'text'		=> $text,
					);

					$sql = 'UPDATE ' . K_CLOUD_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . " WHERE tag_id = $tag_id";

					if (!$result = $db->sql_query($sql))
					{
						trigger_error($user->lang['ERROR_PORTAL_CLOUD'] . basename(dirname(__FILE__)) . '/' . basename(__FILE__) . ', line ' . __LINE__);
					}

					$cache->destroy('sql', K_CLOUD_TABLE);

					$template->assign_vars(array(
						'MESSAGE' => $user->lang['DATA_IS_BEING_SAVED'] . '</font><br />',
						'S_OPTION' => 'save',
					));

					meta_refresh(1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_cloud&amp;mode=browse");
					break;
				}

				get_tag_item($tag_id);

				$template->assign_var('S_OPTION', 'edit');
				break;
			}

			case 'delete':
			{
				if (!$tag_id)
				{
					trigger_error($user->lang['MUST_SELECT_VALID_CLOUD_DATA'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				if (confirm_box(true))
				{
					/*
					$sql = 'SELECT tag_id
						FROM ' . K_CLOUD_TABLE . '
						WHERE tag_id = ' . $tag_id;
					$result = $db->sql_query($sql);
					*/
					//$tag_id = (int) $db->sql_fetchfield('tag_id');
					//$db->sql_freeresult($result);
					//$colour2 .= ' Tag ';

					$sql = 'DELETE FROM ' . K_CLOUD_TABLE . '
						WHERE tag_id = ' . $tag_id;
					$db->sql_query($sql);

					$template->assign_vars(array(
						'MESSAGE'	=>  $user->lang['DELETING'] . $tag_id . '</font><br />',
						'S_OPTION'	=> 'delete',
					));

					$cache->destroy('sql', K_CLOUD_TABLE);

					meta_refresh(1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_cloud&amp;mode=browse");
					break;
				}
				else
				{
					confirm_box(false, $user->lang['CONFIRM_OPERATION_CLOUD'], build_hidden_fields(array(
						'i'			=> $id,
						'mode'		=> $mode,
						'action'	=> 'delete',
					)));
				}

				$template->assign_vars(array('MESSAGE' => $user->lang['ACTION_CANCELLED']));

				meta_refresh(1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_cloud&amp;mode=browse");
				break;
			}


			case 'add':
			{
				if ($submit)
				{
					//$tag_id		=request_var('tag_id', '');
					$is_active	= request_var('is_active', '');
					$tag		= request_var('tag', '');
					$link		= request_var('link', '');
					$rel		= request_var('rel', '');
					$font_size	= request_var('font_size', '');
					$colour		= request_var('colour', '');
					$colour2	= request_var('colour2', '');
					$hcolour	= request_var('hcolour', '');
					$text		= utf8_normalize_nfc(request_var('text', '', true));

					if (strstr($link, $user->lang['NONE']))
					{
						$link = '';
					}

					$colour = str_replace("#", "", $colour);
					$colour2  = str_replace("#", "", $colour2);
					$hcolour  = str_replace("#", "", $hcolour);

	               $sql_array = array(
                       'is_active'		=> $is_active,
                       'tag'			=> $tag,
                       'link'			=> $link,
                       'rel'			=> $rel,
                       'font_size'		=> $font_size,
                       'colour'			=> $colour,
                       'colour2'		=> $colour2,
                       'hcolour'		=> $hcolour,
                       'text'			=> $text,
                    );

					$db->sql_query('INSERT INTO ' . K_CLOUD_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_array));

					$cache->destroy('sql', K_CLOUD_TABLE);

					meta_refresh(1, "{$phpbb_root_path}adm/index.$phpEx$SID&amp;i=k_cloud&amp;mode=browse");

					$template->assign_vars(array(
						'L_MENU_REPORT' => $user->lang['TAG_CREATED'],
					));

					break;
				}
				else
				{
					get_tag_item(0);
					$template->assign_var('S_OPTION', 'add');
					$mode = 'add';
					break;
				}
			}
			case 'config':
				//get_cloud_data();
				break;

			case 'default':
				//get_cloud_data();
		}

		$template->assign_vars(array(
			'U_ACTION'			=> $this->u_action,
			'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
			)
		);
		//$template->assign_vars(array('U_ACTION' => $u_action));
	}
}

function get_cloud_data()
{
	global $db, $template;//, $s_hidden_fields;

	$sql = 'SELECT *
		FROM ' . K_CLOUD_TABLE ;

	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$template->assign_block_vars('clouds', array(
			'TAG_ID'		=> $row['tag_id'],
			'TAG_IS_ACTIVE'	=> $row['is_active'],
			'TAG'			=> $row['tag'],
			'TAG_LINK'		=> $row['link'],
			'TAG_REL'		=> $row['rel'],
			'TAG_FONT_SIZE'	=> $row['font_size'],
			'TAG_COLOUR'	=> $row['colour'],
			'TAG_COLOUR2'	=> $row['colour2'],
			'TAG_HCOLOUR'	=> $row['hcolour'],
			'TAG_TEXT'		=> $row['text'],
			//'S_HIDDEN_FIELDS'	=> $s_hidden_fields
		));
	}
	$db->sql_freeresult($result);
}
function get_tag_item($id)
{
	global $db, $template;//, $s_hidden_fields;
	$copy = false;

	if ($id == 0) // used for copying a tag //
	{
		$copy = true;
		$sql = 'SELECT *
			FROM ' . K_CLOUD_TABLE . '
				WHERE tag_id = 1';
	}
	else
	{
		$sql = 'SELECT *
			FROM ' . K_CLOUD_TABLE . '
				WHERE tag_id = ' . $id;
	}

	$result = $db->sql_query($sql);

	if ($result = $db->sql_query($sql))
	{
		$row = $db->sql_fetchrow($result);
	}

	$template->assign_vars(array(
		'TAG_ID'		=> (!$copy) ? $row['tag_id'] : '',
		'TAG_IS_ACTIVE'	=> $row['is_active'],
		'TAG'			=> $row['tag'],
		'TAG_LINK'		=> $row['link'],
		'TAG_REL'		=> $row['rel'],
		'TAG_FONT_SIZE'	=> $row['font_size'],
		'TAG_COLOUR'	=> $row['colour'],
		'TAG_COLOUR2'	=> $row['colour2'],
		'TAG_HCOLOUR'	=> $row['hcolour'],
		'TAG_TEXT'		=> (!$copy) ?  $row['text'] : '',
	));

	$db->sql_freeresult($result);
}

?>