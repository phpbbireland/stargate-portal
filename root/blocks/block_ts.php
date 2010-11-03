<?php

/***************************************************************************
 *                        block_Team_speak.php
 *                            -------------------
 *   begin                : Saturday, Jan 21, 2005
 *   copyright            : (C) 2005 Michaelo - Michael O'Toole
 *   website              : http://www.phpbbireland.com
 *   email                : admin@phpbbireland.com
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	exit;
}

$queries = $cached_queries = 0;

$template->assign_vars(array(
	'USER_NAME' => $user->data['username'],
	'CONNECT'	=> $k_config['teamspeak_connection'],
	'PASSWORD'	=> $k_config['teamspeak_pass'],
	'IP'		=> '',
	'TS_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0', ($total_queries) ? $total_queries : '0'),
));

?>