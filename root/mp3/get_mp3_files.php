<?php
define('IN_PHPBB', true);
if (!defined('IN_PHPBB'))
{
	exit;
}

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