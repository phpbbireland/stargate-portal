<?php
/**
*
* @package remove (Stargate Portal)
* @version $Id: remove_portal.php 313 2009-01-02 03:01:04Z Michealo $
* @sratred   : 31 October 2008
* @copyright : livewirestu
* @Home      : http://www.phpbbireland.com/
* @current   : 1.04
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* Remove portal from phpBB 3x installation...
* A rework of Stu's remove calendar mod by Mike (Michaelo)
* Modified by NeXur 24 November 2008 & Michaelo 19 March 2009
*
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* @version $Id: remove_portal.php 313 2009-01-02 03:01:04Z Michealo $
*
* Please obtain the latest copy form the dev site: www.stargate-portal.com
*
*/

define('IN_PHPBB', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);

include($phpbb_root_path . 'common.'.$phpEx);

// Report all errors, except notices
error_reporting(E_ALL ^ E_NOTICE);

$user->session_begin();
$auth->acl($user->data);

global $db, $lang, $template, $phpbb_root_path, $phpEx, $cache, $config, $language, $table_prefix;
$current_version = '0.4.1';
$page_title = 'Remove Stargate Portal - version: ' . $current_version;
$no_exeptions = true;
$override_style = false;

/*** EDIT THE NEXT LINE TO CONTINUE, SET $process to true ***/

$process = false;
$process = true;

/************************************************************/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" xml:lang="en-gb" lang="en-gb">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Language" content="en-gb" />
	<meta http-equiv="imagetoolbar" content="no" />
	<title><?php echo $page_title; ?></title>
	<link href="../adm/style/admin.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body class="ltr">
<div id="wrap">
	<div id="page-header">
		<h1><?php echo $page_title; ?></h1>
	</div>
	<div id="page-body">
		<div id="acp">
			<div class="panel">
				<center>
					<p><font color="#FF0000"><strong>(SGP 1.0.0)</strong></font> This is the Stargate Portal Removal Script... <font color="#FF0000"></font><br /></p>
				</center>
				<span class="corners-top"><span></span></span>
				<div id="content">
					<div id="main" class="install-body">
						<a name="maincontent"></a>

						
<?php
if(!$process)
{
	echo '<span>';
	echo '<br /><font color="#FF0000">Please <strong>BACKUP</strong> your database and config.php and keep them in a safe place before continuing...</font><br /><br />';
	echo 'Final reminder to backup your database... <br /><br /><br />';
	echo '<font color="#FF0000"><b>IMPORTANT!</b></font> If you have not done so already, please delete all file starting with:<br />acp_k_ (acp_k_*.php) from: root/includes/acp/ & root/includes/acp/info/<br /><br /><br />';
	echo 'In order to continue please edit this file, setting <b>$process</b> to true<br />( un-comment this line: <b>//$process = true;</b> )<br />';
	echo 'Once you have completed this edit and removed the files identified above refresh this page.<br /><br />';
	echo 'For updates please check <a href="http://www.phpbbireland.com/phpBB3/viewtopic.php?p=12166#p12166"> this post!</a>';
	echo '</span>';
	exit;
}

if( $user->data['is_registered'] && $auth->acl_get('a_') ) 	 
{


	// Read config data from the config file
	$data = array ('dbhost', 'dbname', 'dbuser', 'dbpasswd', 'table_prefix');
	$data = get_config_data();

	/*
	//Manual input
	// replace with your info and un-comment the following items...
	$data['dbms'] = '';
	$data['dbhost'] = 'localhost';
	$data['dbname'] = '';
	$data['dbuser'] = '';
	$data['dbpasswd'] = '';
	$data['table_prefix'] = 'phpbb_';
	*/

	echo '<span>';
	echo '<br /><b>Collecting information...</b><hr />';
	echo '<br />Database type: ['; echo $data['dbms'];
	echo ']<br />Database name: ['; echo $data['dbname'];
	echo ']<br />Admin name: ['; echo $data['dbuser'];
	echo ']<br />Password: ['; echo $data['dbpasswd'];
	echo ']<br />Table Prefix: ['; echo $data['table_prefix'];
	echo ']<br />'; 

	mysql_connect($data['dbhost'], $data['dbuser'], $data['dbpasswd']);
	$process = mysql_select_db($data['dbname']);

	if($process && $data['table_prefix'] != '')
	{
		echo '<br /><b>Connecting to database successful...</b><hr />';
		$table_prefix = $data['table_prefix'];
	}
	else
	{
		echo '<br /><font color="#FF0000"><strong>Unable to retrieve config information</strong></font>, please edit this file and add the information manually<br />You find it under //Manual input - be sure to remove beginning /* and ending */';
		exit;
	}


	// First remove old tables.
	$tables_to_drop = array('k_acronyms', 'k_cyber_quotes', 'k_cloud', 'k_quotes', 'k_blocks', 'k_blocks_config', 'k_blocks_config_vars', 'k_menus', 'k_modules', 'k_newsfeeds', 'k_referer' ,'k_styles_status', 'k_web_pages', 'k_youtube');
	foreach($tables_to_drop as $table)
	{
		$sql = "DROP TABLE IF EXISTS " . $table_prefix . $table;
		$res = mysql_query($sql);
		if($res)
		{
			echo $table_prefix . $table . " <b>table dropped, </b><br />";
		}
		else
		{
			$no_exeptions = false;
			echo $table_prefix . $table . " <b>table not found... </b><br />";   
		}
	}
	echo ' ...<br />';

	// Remove columns from core phpbb tables
	$tables_to_alter_drop = array(
		'icons'   => array(
			'icons_group',
		),
		'smilies'   => array(
			'smiley_group',
		),
		'users'	=> array(
			'profile_position',
		),

	);

	foreach($tables_to_alter_drop as $table_name => $table)
	{
		if(is_array($table))
		{
			$sql = "ALTER TABLE " . $table_prefix . $table_name;
			$msg = "<br /><b>$table_prefix$table_name Altered:</b><br />";
			foreach($table as $entry)
			{
				$sql .= "
					DROP COLUMN $entry,";
				$msg .= $table_prefix . $table_name . " => " . $entry . " <b>dropped... </b><br />";         
			}
			$sql = rtrim($sql, ',');
		}
		else
		{
			$sql = "ALTER TABLE " . $table_prefix . $table_name . "
				DROP COLUMN $table";
			$msg .= $table_prefix . $table_name . " => " . $table . " <b>dropped... </b><br />";                  
		}
		$res = mysql_query($sql);
		if($res)
		{
			echo $msg;   
		}
		else
		{
			$no_exeptions = false;
			echo "<br /><b>No entries found in " . $table_prefix . $table_name . "</b><br />";
		}
	}

	// Remove entries from core phpbb tables
	$delete_from = array(
		'config'   => array(
			array('config_name'   => 'portal_active'),
			array('config_name'   => 'portal_version'),
			array('config_name'   => 'mod_show'),
			array('config_name'   => 'portal_enabled'),
		),
	);

	foreach($delete_from as $table_name => $entries)
	{
		echo "<br /><br /><b>$table_prefix$table_name:</b>";
		if(is_array($entries))
		{
			foreach($entries as $entry)
			{
				foreach($entry as $key => $val)
				{
					$sql = "DELETE FROM " . $table_prefix . $table_name . " WHERE $key = '$val';";
					$res = mysql_query($sql);
					if($res)
					{
						echo "<br />$table_prefix$table_name.$key => $val <b>dropped, </b>";
					}
					else
					{
						$no_exeptions = false;
						echo "<br />$table_prefix$table_name.$key => $val <b>not found. </b>";
					}
				}
			}
		}
		else
		{
			$no_exeptions = false;
			echo "<b>Database entries to be deleted must be properly defined</b>";
		}
	}

	// Remove portal modules
	$sql = "SELECT parent_id, module_id, module_langname FROM " . $table_prefix . "modules
			WHERE module_langname LIKE '%ACP_K_%'";
	$res = mysql_query($sql);

	if($row = mysql_fetch_assoc($res))
	{
		echo "<br /><br /><b>" . $table_prefix. "modules Altered:</b>";
		while($row = mysql_fetch_assoc($res))
		{
			$sql2 = "DELETE FROM " . $table_prefix . "modules
					WHERE module_id = " . $row['module_id'];
			$res2 = mysql_query($sql2);

			if($res2)
			{
				echo "<br />Stargate Portal Mod sub-module " . $row['module_langname'] . " <b>removed</b>.";   
			}
			else
			{
				$no_exeptions = false;
				echo "<br /><br /><b>Stargate Portal Mod sub-module " . $row['module_langname'] . " not found</b>";
			}
		
			$sql3 = "DELETE FROM " . $table_prefix . "modules
					WHERE module_id = " . $row['parent_id'];
			$res3 = mysql_query($sql3);
			if($res3)
			{
				echo "<br />Portal Mod parent module " . $row['parent_id'] . " <b>removed</b>.";   
			}
			else
			{
				$no_exeptions = false;
				echo "<br /><b>Portal Mod parent module " . $row['parent_id'] . " not found</b>";
			}
		}
	}
	else
	{
		$no_exeptions = false;
		echo "<br /><br /><b>No portal modules found...</b><br />";
	}
	
	// Remove all permissions stuff
	$sql = "SELECT auth_option_id, auth_option FROM " . $table_prefix . "acl_options
			WHERE auth_option IN (
				'a_k_blocks',
				'a_k_config',
				'a_k_menus',
				'a_k_portal',
				'a_k_modules',
				'a_k_vars',
				'a_k_poll',
				'a_k_newsfeeds',
				'a_k_web_pages',
				'a_k_you_tube',
				'a_k_tools')";
	$res = mysql_query($sql);

	$auth_options_array = array();
	if($res)
	{
		echo "<br /><b>" . $table_prefix. "acl_options:</b>";
		while($row = mysql_fetch_assoc($res))
		{
			$auth_options_array[] = $row;
			echo $row['auth_option_id'] . ' - ' . $row['auth_option'] . "<br />";
		}
	}
	else
	{
		$no_exeptions = false;
		echo "<br /><b>Auth options not found</b>";
	}


	$auth_options_list = '';
	foreach($auth_options_array as $auth)
	{
		$auth_options_list .= "'" . $auth['auth_option_id'] . "', ";   
	}
	$auth_options_list = rtrim($auth_options_list, ', ');

	$tables = array('acl_options', 'acl_groups', 'acl_roles_data', 'acl_users');
	
	foreach($tables as $table)
	{
		$sql = "SELECT * FROM " . $table_prefix . $table . "
				WHERE auth_option_id IN ($auth_options_list)";
		$res = mysql_query($sql);
		$first_loop = true;
		if($res)
		{
			$auth_options_array[] = $row;
			$title_lengths = array();
			echo "<b>Auth options matched and removed from $table_prefix$table:</b><br />";
			echo "<table><tr>";
		
			while($row = mysql_fetch_assoc($res))
			{
				if($first_loop)
				{
					foreach($row as $key => $value)
					{
					
						echo '<td class="row1"><b>' . $key . ':</b></td>';
						$title_lengths[] = (strlen($key) +1);
					}   
					echo "</tr>";
					$first_loop = false;
				}
				else
				{
					$count = 0;
					echo "<tr>";
					foreach($row as $key => $value)
					{
						$string = sprintf('%-' . ($title_lengths[$count] + 1) . 's', $value);
						$string_ = str_replace(' ', '&nbsp;', $string);
						$len = $title_lengths[$count];
						echo '<td class="row2">';
						echo (str_replace(' ', '&nbsp;', sprintf('%-' . ($title_lengths[$count]) . 's', $value)));
						echo "</td>";
						$count++;
					}
					echo "</tr>";
				}
			}
			echo "</table>";
			$sql = "DELETE FROM " . $table_prefix . $table . "
				WHERE auth_option_id IN ($auth_options_list)";
			$res = mysql_query($sql);
		}
		else
		{
			$no_exeptions = false;
			echo "<br /><b>Auth options not found in $table_prefix$table</b>";
		}

	}

	/***/

	echo "<br /><br /><b>Resetting auto_increment values:</b>";
	$sql ="ALTER TABLE " . $table_prefix . "modules AUTO_INCREMENT =1";
	$res = mysql_query($sql);
	if($res)
	{
		echo "<br />modules table auto_increment values reset.";   
	}
	else
	{
		$no_exeptions = false;
		echo "<br /><b>modules table auto_increment values couldn´t be reset!</b>";
	}

	$sql ="ALTER TABLE " . $table_prefix . "acl_options AUTO_INCREMENT =1";
	$res = mysql_query($sql);
	if($res)
	{
		echo "<br />acl_options table auto_increment values reset.";   
	}
	else
	{
		$no_exeptions = false;
		echo "<br /><b>acl_options table auto_increment values couldn´t be reset!</b>";
	}

	$sql ="ALTER TABLE " . $table_prefix . "acl_roles AUTO_INCREMENT =1";
	$res = mysql_query($sql);
	if($res)
	{
		echo "<br />acl_roles table auto_increment values reset.";   
	}
	else
	{
		$no_exeptions = false;
		echo "<br /><b>acl_roles table auto_increment values couldn´t be reset</b>";
	}

	/**
	* Read confile, or if unable to do so, we request the user do it manually...
	*/
	echo "<br /><br /><b>config.php:</b>";
	$file = $phpbb_root_path . 'config.' .$phpEx;
	$handle = @fopen($file, "r");
	if ($handle)
	{	
		$written = true;
		// Create a lock file to indicate that there is an install in progress
		$fp = @fopen($phpbb_root_path . 'cache/install_lock', 'wb');
		if ($fp === false)
		{
			// We were unable to create the lock file - abort
			$this->p_master->error($lang['UNABLE_WRITE_LOCK'], __LINE__, __FILE__);
		}
		@fclose($fp);
		@chmod($phpbb_root_path . 'cache/install_lock', 0666);

		@chmod($phpbb_root_path . 'config.' . $phpEx, 0777);
		$config_file = $phpbb_root_path . 'config.' . $phpEx;

		// Read the config file
		$config_data = @file_get_contents($config_file);

		// append portal data
		$config_data = str_replace("@define('STARGATE', true);" . "\n" . "@define('PORTAL_INSTALLED', true);" . "\n", "@define('STARGATE', false);" . "\n", $config_data);

		if (!($fp = @fopen($phpbb_root_path . 'config.' . $phpEx, 'w')))
		{
			// Something went wrong ... so let's try another method
			$written = false;
		}

		if (!(@fwrite($fp, $config_data)))
		{
			// Something went wrong ... request admin to make chages manually
			$written = false;
		}	

		@fclose($fp);

		if ($written)
		{
			@chmod($phpbb_root_path . 'config.' . $phpEx, 0644);
			echo "<br />config.php file changed successfully!";
		}
		else
		{
			$no_exeptions = false;
			echo '<br /><br /><b>Something went wrong<br />Please manual remove the following lines from the config.php file:</b><hr />@define(\'STARGATE\', true); <br />@define(\'PORTAL_INSTALLED\', true);';
		}
	}
	else
	{
		$no_exeptions = false;
		echo '<br /><br /><b>Couldn\'t find a correct config.php file<br />Please manual remove the following lines from the config.php file:</b><hr />@define(\'STARGATE\', true); <br />@define(\'PORTAL_INSTALLED\', true);';
	}

	/**
	* Now we set default style to prosilver & override
	*/
	echo "<br /><br /><b>Setting default style to prosilver:</b>";
	$sql = "SELECT style_id, style_active FROM " . $table_prefix . "styles
		WHERE style_name LIKE 'prosilver'";
	$res = mysql_query($sql);
	$row = mysql_fetch_assoc($res);
	if (!$res)
	{
		$no_exeptions = false;
		echo "<br /><b>Could not find prosilver in styles table</b>";
	}
	else if ($row['style_active'] == 0)
	{
		$no_exeptions = false;
		echo "<br /><b>Found prosilver in styles table, but it's not installed/active!</b>";
	}
	else
	{
		$sql2 ="UPDATE " . $table_prefix . "config SET config_value = " . $row['style_id'] . " WHERE config_name = 'default_style'";
		$res2 = mysql_query($sql2);
		if($res2)
		{
			echo "<br />Prosilver has been set as default style.";   
		}
		else
		{
			$no_exeptions = false;
			echo "<br /><b>Error while trying to set Prosilver as default style.</b>";
		}

		$sql2 ="UPDATE " . $table_prefix . "config SET config_value = 1 WHERE config_name = 'override_user_style'";
		$res2 = mysql_query($sql2);
		if($res2)
		{
			$override_style = true;
			echo "<br />Override user style has been set.";   
		}
		else
		{
			$no_exeptions = false;
			echo "<br /><b>Error while trying to set override user style.</b>";
		}
	}

	/**
	* Result output
	*/
	if ($no_exeptions)
	{
		echo '<hr /><br /><strong><font color="#00FF00">Portal removal completed without any errors!...</font></strong><br />';
	}
	else
	{
		echo '<hr /><strong><font color="#FF0000">!NOTE</font>:<br />Portal removal completed with exceptions, please note as this removal script is used for all version, the exceptions above may be perfectly normal...</strong><br />';
	}
	if ($override_style)
	{
		echo '<hr /><strong><font color="#FF0000">!NOTE</font>:<br />Override user style is active!</strong><br />To reset it go to: ACP -> Board Configuration -> Board Settings -> set Override user style: <b>no</b></b>';
		echo '<br />Either do this now if you are <b>not</b> going to reinstall the portal, else reset it <b>after</b> the install...';
	}
	echo '<hr /><strong><font color="#FF0000">DO NOT FORGET</font>: to purge cache & refresh templates, themes & imagesets for all your styles!</strong> Run this: <a href="' . $phpbb_root_path . 'includes/sgp_refresh.php">SGP Refresh ALL</a>.<br />';
	echo '<br />If we have missed any entries please PM us @ <a href="http://www.phpbbireland.com"> phpBBireland <a> or post <a href="http://www.phpbbireland.com/phpBB3/viewtopic.php?p=12166#p12166"> Here</a>!<hr />';
	echo '</span>';
	?>
		<div style="float:left; position: bottom left;"><a href="<?php echo $phpbb_root_path . 'adm/index.php?sid=' . $user->session_id; ?>" title="ACP"><img src="portal_install.png" alt="ACP" border="none"> Administration Control Panel</a></div>
		<div style="float:right; position: bottom right;"><a href="index.php" title="Install main">Proceed to 1.0.0 installation <img src="portal_install.png" alt="Install main" border="none"></a></div>
	<?php
}
else
{
	echo '<span>';
	echo '<hr /><font color="#FF0000"><strong>You do not have permission to uninstall the portal!</strong></font>';
	echo '<br />Please <a href="' . $phpbb_root_path . 'ucp.php?mode=login"><strong>log in</strong></a> as an <font color="#FF0000"><strong>ADMINISTRATOR</strong></font> and <font color="#FF0000"><strong>refresh</strong></font> this page...</b><hr />';
	echo '</span>';
}
?>
					</div>
				</div>
				<span class="corners-bottom"><span></span></span>
			</div>
		</div>
	</div>
	<div id="page-footer">
		Powered by phpBB &copy; 2000, 2002, 2005, 2007 <a href="http://www.phpbb.com/">phpBB Group</a><br />
		Original removal script by <a href="http://phpbbireland.com/phpBB3/memberlist.php?mode=viewprofile&u=200">Stu (livewirestu)</a>... updates by <a href="http://phpbbireland.com/phpBB3/memberlist.php?mode=viewprofile&u=336">Martin (NeXur)</a> and <a href="http://phpbbireland.com/phpBB3/memberlist.php?mode=viewprofile&u=2">Mike (Michaelo)</a>.<br />
		&copy; 2008 <a href="http://www.phpbbireland.com/">phpBBireland</a><br />
	</div>
</div>
</body>
</html>
<?php
/**
* Get submitted data
*/
function get_config_data()
{
	return array(
		'dbms'			=> get_config('dbms'),
		'dbhost'		=> get_config('dbhost'),
		'dbport'		=> get_config('dbport'),
		'dbuser'		=> get_config('dbuser'),
		'dbpasswd'		=> get_config('dbpasswd'),
		'dbname'		=> get_config('dbname'),
		'table_prefix'	=> get_config('table_prefix'),
	);
}

function get_config($data)
{
	global $phpbb_root_path, $phpEx;
	
	$file = $phpbb_root_path . 'config.' .$phpEx;
	$handle = @fopen($file, "r");
	
	$info_db = ' ';

	if ($handle) 
	{
	    while (!feof($handle)) 
	   	{
			$buffer = fgets($handle, 2048);

		    if(strstr($buffer, $data))
       		{
        		$start = $end = $k = 0;
        		
        		for($i = 0; $i <= strlen($buffer)-2; $i++)
        		{
	        		if($buffer[$i] == "'")
	        		{
		        		$i++;
		        		if( $start == 1 )
						{
							$start = 0;
						}
			        	else
						{
			        	$start = 1;
						}
	        		}

					if( $start == 1 )
			        {
			        	$info_db[$k] = $buffer[$i];
		    	    	$k++;
	        		}
		        }
    	    }
		}
   		fclose($handle);
	}
	
	if(strstr($info_db, ";"))
	{
		$info_db = '';
	}

	// fix for some users where no data is replaced with a space... //
	if($info_db === ' ')
	{
		$info_db = '';
	}
		
	//echo $info_db; echo '<br />';
	return $info_db;
}

?>