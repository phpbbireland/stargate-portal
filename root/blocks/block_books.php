<?php
/**
*
* @package Stargate Portal
* @author  Michael O'Toole - aka Michaelo
* @begin   Saturday, Jan 22, 2005
* @copyright (c) 2005-2008 phpbbireland
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you have modified it,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_books.php 336 2009-01-23 02:06:37Z Michealo $
* Generate a random image used with the books block...
* Updated: 28 January 2008
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

$queries = 0;
$cached_queries = 0;

global $phpbb_root_path;

$rand_image = get_random_image($phpbb_root_path . 'images/books', false, '');
$template->assign_vars(array(
	'BOOKSCONTENT'		=> $rand_image,
	'B_PORTAL_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
));

?>