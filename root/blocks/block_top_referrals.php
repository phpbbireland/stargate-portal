<?php
/**
*	Original code and idea from the Top Referers block in the SiteStats module
*	copyright: Marc Ferran (c) 2003-2004
*	contact: http://www.phpmix.com
*
*   Ported and rewritten for PhpBB3 and Stargate Portal by: NeXur
*
* @package Stargate Portal
* @author  Martin Larsson - aka NeXur
* @begin   Thursday, 5th September, 2008
* @copyright (c) 2008 Martin Larsson - aka NeXur
* @home    http://www.phpbbireland.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @note: Do not remove this copyright. Just append yours if you modify this code,
*        this is part of the Stargate Portal copyright agreement...
*
* @version $Id: block_top_referrals.php 307 2009-01-01 16:05:35Z Michealo $
* Updated: 27 November 2008
*
*/

/**
* @ignore
*/

if ( !defined('IN_PHPBB') )
{
	exit;
}

global $k_config;

$queries = 0;
$cached_queries = 0;

// portal config values //
$num_refviews = $k_config['num_refviews'];

isset($_SERVER['HTTP_REFERER']) ? $http_referer = $_SERVER['HTTP_REFERER'] : $http_referer = '';

if($http_referer)						// Do we have any referer?
{
	$http_host = $_SERVER['HTTP_HOST'];
	$int_check = eregi($http_host, $http_referer);
	
	if(!$int_check)			// check if an internal referer?
	{
		$order   = array("http://www.", "https://www.");
		$replace = array("http://", "https://");
		$http_referer = str_replace($order, $replace, $http_referer);

		$http_url = parse_url($http_referer);
		$http_host = $http_url['host'];

		if($http_host)							// Do we have a host in the URL?
		{
			$http_time = time();
			
			$sql = 'SELECT * FROM '.K_REFERRALS_TABLE."  WHERE host = '".$http_host."'";
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

			if($row)
			{
				$sql2 = 'UPDATE '.K_REFERRALS_TABLE.
				' SET hits = '.($row['hits']+1).' , '.
					' lastvisit = '.$http_time.
				" WHERE host = '".$http_host."'";
				$db->sql_query($sql2);
			}
			else
			{
				$sql2 = 'INSERT INTO '.K_REFERRALS_TABLE.' (host, hits, firstvisit, lastvisit, enabled)' .
				" VALUES ('".$http_host."' , 1 , ".$http_time.' , '.$http_time.' , 1 )';
				$db->sql_query($sql2);
			}
		}
	}
}

$sql = 'SELECT * FROM '. K_REFERRALS_TABLE . ' WHERE enabled = 1 ORDER BY hits DESC, lastvisit DESC';
$result = $db->sql_query($sql, 600);

if( !$result )
{
	trigger_error('Could not retrieve HTTP Referalas data.', E_USER_ERROR);
}
$row = $db->sql_fetchrowset($result);

$db->sql_freeresult($result);

$ref_count = count($row);

if($ref_count < $num_refviews)
{ 
	$num_refviews = $ref_count;
}

for ($i = 0; $i < $num_refviews; $i++)
{
	$host_name = $row[$i]['host'];
	if(strlen($row[$i]['host']) > 17)
	{
		$host_name = sgp_checksize ($row[$i]['host'], 15);
	}

	$template->assign_block_vars('datarow', array(
		'S_HTTP_HOST'		=> $host_name,
		'S_HHTP_HOST_FULL'	=> $row[$i]['host'],
		'U_HTTP_HOST'		=> 'http://'.$row[$i]['host'],
		'S_HITS'		=> $row[$i]['hits']
	));
}

$template->assign_vars(array(
	'S_REF_LIMIT'	=> $num_refviews,
	'S_TOT_REF'		=> $ref_count,
	'TR_PORTAL_DEBUG'	=> sprintf($user->lang['PORTAL_DEBUG_QUERIES'], ($queries) ? $queries : '0', ($cached_queries) ? $cached_queries : '0'),
));

?>