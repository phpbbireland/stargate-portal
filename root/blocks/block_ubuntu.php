<?php
/**
*
* @package Stargate Portal
* @author  Tyler (Prosk8er)
* @begin   4/14/10
* @copyright (c) 2005-2010 Got Skills Lounge
* @home    http://gotskillslounge.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* @version $Id: block_ubuntu.php 0 2011-08-12 22:12:30Z Prosk8er $
*
*/

/**
* @ignore
*/
 if (!defined('IN_PHPBB'))
{
    exit;
}
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';

// assign some data to variables //
$ubuntu_countdown = '<a href="http://www.ubuntu.com/"><img src="http://www.ubuntu.com/countdown/banner1.png" width="180" height="150" alt="The next version of Ubuntu is coming soon"></a>';
$ubuntu_text = "Click a image below to download";
$ubuntu_desktop = '<a href="http://www.ubuntu.com/business/desktop/overview">' . '<img src="' . $phpbb_root_path . 'images/ubuntu_desktop.png' . '" alt="Get Ubuntu desktop" /></a>';
$ubuntu_server = '<a href="http://www.ubuntu.com/business/server/overview">' . '<img src="' . $phpbb_root_path . 'images/ubuntu_server.png' . '" alt="Get Ubuntu server" /></a>';

    $template->assign_vars(array(
        'UBUNTU_COUNTDOWN' => $ubuntu_countdown,
        'UBUNTU_TEXT'      => $ubuntu_text,
        'UBUNTU_DESKTOP'   => $ubuntu_desktop,
        'UBUNTU_SERVER'    => $ubuntu_server,
    ));

?>