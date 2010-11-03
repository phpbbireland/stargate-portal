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
* @version $Id: get_mp3_files.php 297 2009-14-30 20:44:30Z Mike $
* Updated:
*
*/

/**
* @ignore
*/

/*
if (!defined('IN_PHPBB'))
{
	exit;
}
*/

$filter = ".mp3";
$directory = "music";

// read through the directory and filter files to an array
@$d = dir($directory);
if ($d) 
{ 
	while($entry=$d->read()) 
	{  
		$ps = strpos(strtolower($entry), $filter);
		if (!($ps === false)) {  
			$items[] = $entry; 
		} 
	}
	$d->close();
	sort($items);
}

// Format: xspf format Add an xml header and the opening tags .. 
header("content-type:text/xml;charset=utf-8");

echo "<?xml version='1.0' encoding='UTF-8' ?>\n";
echo "<playlist version='1' xmlns='http://xspf.org/ns/0/'>\n";
echo "	<title>PHP Generated Playlist</title>\n";
echo "	<info>http://www.jeroenwijering.com/</info>\n";
echo "	<trackList>\n";


for($i=0; $i<sizeof($items); $i++) 
{
	echo "		<track>\n";
	echo "			<annotation>".($i+1).". ".$items[$i]."</annotation>\n";
	echo "			<location>mp3/".$directory.'/'.$items[$i]."</location>\n";
	echo "			<info></info>\n";
	echo "		</track>\n";
}
 
// Add closing tags
echo "	</trackList>\n";
echo "</playlist>\n";

?>