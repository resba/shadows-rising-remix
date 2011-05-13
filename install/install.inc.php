<?php
/*
// 

File:				install.inc.php
Objective:			install init file - executes all startup procedures before accessing each PHP file in 
					Install 
Version:			SR-RPG (Game Engine) 0.0.4
Author:				Maugrim The Reaper
Edited by:			Maugrim The Reaper
Date Committed:		17 August 2004
Last Date Edited:	n/a

~~~~~~~~~~~~~~~~~~~~~~~~~
Copyright (c) 2004 by:
~~~~~~~~~~~~~~~~~~~~~~~~~
Pádraic Brady (Maugrim)
Shadows Rising Project
~~~~~~~~~~~~~~~~~~~~~~~~~
(All rights reserved)
~~~~~~~~~~~~~~~~~~~~~~~~~

This program is free software. You can redistribute it and/or modify
it under the terms of the Affero General Public License as published by
the XXX; either version 1 of the License, or (at your option) any later version.  

Note that all changes to this file, if distributed/displayed/presented in 
any way whether to associates or the general public must contain a mechanism 
to download the source code containing such changes. Removal of this notice, 
or any other copyright/credit notice displayed by default in the output to 
this source code immediately voids your rights under the Affero General Public License.

//
*/

// Start the session
session_start();
error_reporting  (E_ERROR | E_PARSE);

$this_version = "Shadows Rising RPG Game Engine 0.0.5-CVS";
$app = "Shadows Rising RPG";

// before we do anything...the Install Utility requires a working Smarty Template Engine - the main problem
// with Smarty in new installations is that the user does not make the /qlib/smarty_dir/templates_c directory
// writeable - which is required to store cached templates to cut down on processing overhead
// The main symptom of a non-writeable templates_c directory is a blank browser window with no HTML
$templatedir_status = (bool) is_writeable("../qlib/smarty_dir/templates_c");
if($templatedir_status === false) 
{
	// since this check is to ensure the Smarty Template engine will function - we mush print this to the browser immediately - especially since the templates for the Installation Utility will not work if templates_c is not writeable!
	print("The $app installation utility has detected that the &quot;/qlib/smarty_dir/templates_c&quot; is not writeable. This directory is used to store cached templates used for generating XHTML output to the user's browser. If the directory cannot be written to, these templates will not be cached, and users will receive blank output to their browsers. Please make this directory writeable before continuing the installation. <a href=\"install.php\">Retry Installation</a>");
	flush();
}

// include config file if it exists
include_once("../qlib/config/config.inc.php");



// include our standard Template (Smarty), Character and Location PHP Classes
require_once("smarty.inc.php");

if (!empty($_SESSION['server_passwd']))
{
	if($_SESSION['expire_time'] < time()) 
	{
		$_SESSION['server_passwd'] = '';
		$server_passwd = '';
	}
	else 
	{
		$server_passwd = $_SESSION['server_passwd'];
		$_SESSION['expire_time'] = time() + 600;
	}
}
elseif (empty($_POST['server_passwd']))
{
    if (!empty($_POST['_adminpass']))
    {
        $server_passwd = $_POST['_adminpass'];
		$_SESSION['server_passwd'] = $server_passwd;
		$_SESSION['expire_time'] = time() + 600;
    }
    else
    {
        $server_passwd = '';
    }
}
else
{
    $server_passwd = $_POST['server_passwd'];
	$_SESSION['server_passwd'] = $server_passwd;
	$_SESSION['expire_time'] = time() + 600;
}



//print_r($_SESSION);

if(!isset($_POST['install_step']) || empty($_POST['install_step'])) 
{
	$install_step = 1;
}
else 
{
	$install_step = $_POST['install_step'];
}

$dbs = array('mysql' => 'MySQL 3 or 4', 'postgres7' => 'PostgreSQL 7', 'mysqli' => 'MySQL 5 (experimental)');

$dbtypes = array();
foreach($dbs as $key=>$val) {
	array_push($dbtypes, array("str"=>"$key", "name"=>"$val"));
}



// Q-LIB Database Functions with AdoDB
require_once("../qlib/db_funcs.inc.php");


// a set of print functions for quick output of error or system messages, debug info, etc.
require_once("includes/print_funcs.inc.php");



// create a new template Object (using Deep Blue theme as example)
$sr = new Q_Smarty("Default");
$sr->assign("game_name", $app);
$sr->assign("this_version", $this_version);
$sr->assign("dbtypes", $dbtypes);

// load gzip output filter if enabled (but not when flushing SQL results! - gzip will prevent non-template output
// after any template is parsed using '$sr->fetch()' )
//if($CONFIG['enable_gzip'] == 1 && $_POST['install_step'] != 2) 
//{
	//$sr->load_filter("output", "gzip");	
//}

if (($CONFIG['game_installed'] && $server_passwd != $CONFIG['adminpass'] && $install_step != '1') || isset($_POST['game_installed']) || isset($_GET['game_installed']))
{
	$_SESSION['server_passwd'] = "";
    SystemMessage("You appear to have made a hacking attempt in the current file. This incident will be logged, along with your IP, and reported to the local Admin.");
}

?>