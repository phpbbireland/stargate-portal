<?php

/***************************************************************************
 *                        block_follow_us.php
 *                            -------------------
 *   begin                : Friday, Aug 27, 2010
 *   copyright            : (C) 2010 Prosk8er - Tyler
 *   website              : http://www.gotskillslounge.com
 *   email                : prosk8er@gotskillslounge.com
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

/**
* @ignore
*/
 if (!defined('IN_PHPBB'))
{
    exit;
}
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';

// assign some data to variables //
$facebook = 'http://www.facebook.com/';
$twitter = 'http://www.twitter.com/';
$steam = 'http://steamcommunity.com/groups/';
$xfire = 'http://www.xfire.com/communities/';

    $template->assign_vars(array(
        'FACEBOOK'           => $facebook,
        'TWITTER'            => $twitter,
        'STEAM'              => $steam,
        'XFIRE'              => $xfire,
    ));

?>