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
	die("Hacking attempt");
}
//$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';


$template->assign_vars(array(
	'USER_NAME' => $user->data['username'],
	'USER_NAME' => 'michaelo',
	'CONNECT'	=> $k_config['teamspeak_connection'],
	'PASSWORD'	=> $k_config['teamspeak_pass'],
	'IP'		=> '',
));

?>