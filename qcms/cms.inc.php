<?php
/*
// 

File:				cms.inc.php
Objective:			cms engine file - executes all startup procedures before accessing each PHP file 
Version:			Q-CMS 0.2
Author:				Maugrim The Reaper
Edited by:			Maugrim The Reaper
Date Committed:		6 August 2004
Last Date Edited:	21 October 2004

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


// the clock is ticking - :)
function getmicrotime(){ 
   list($usec, $sec) = explode(" ",microtime()); 
   return ((float)$usec + (float)$sec); 
} 
$page_generate_start = getmicrotime();


// For some standardisation: common.inc.php relates to Q-LIB only - i.e. loads the backend files
// For Q-CMS files - append to this file

//calculate path to common.inc.php
$commonpath = eregi_replace("qcms", "", dirname(__FILE__)) . "common.inc.php";
require_once($commonpath);

// display installation message if configuration file not found and exit
if(!is_array($CONFIG) || empty($CONFIG['game_installed'])) 
{
	$install_mesg = "
		<h3>Installation Required</h3><br />
			<p>
			In order to enable Shadows Rising RPG you must first run the Install Utility.<br />
			<a href=\"../install.php\">Install Now...</a>
			</p>
	";
	die($install_mesg);
}
require_once("includes/print_funcs.inc.php");
require_once("includes/cms_funcs.inc.php");
require_once("includes/smarty.inc.php");

//This section will check of user is authenticated. If "true" will check if session has expired.
//If user is not authenticated/ or not checked for such/ will return "false"

if(!empty($_SESSION['authenticated']) && $_SESSION['authenticated'] == "true") 
{
	if(!empty($_SESSION['login_id'])) 
	{
		db(__FILE__,__LINE__,"select * from srbase_users_accounts where login_id = '$_SESSION[login_id]'");
		$p_user = dbr();
		$check = new Q_AuthCheck();
		$check->Check_Auth($p_user);
	}
	else 
	{
		$_SESSION['authenticated'] = "false";
		unset($_SESSION['login_id']);
	}
}
elseif(!isset($_SESSION['authenticated'])) 
{
	$_SESSION['authenticated'] = "false";
}
else
{
	$_SESSION['authenticated'] = "false";
}

// end result - $_SESSION['authenticated'] set to either "true" or "false".
// this may now be used on a "true"/"false" if check for login status

if(($_SESSION['authenticated'] != "false" && $_SESSION['authenticated'] != "true") || empty($_SESSION['authenticated'])) 
{
	$_SESSION['authenticated'] == "false";
}

//grab user data if login status is set
// something of a iffy area - "true" permissions not yet implemented
// USER_RANK should be used as a simple text string for a user's permission/rank.
if($_SESSION['authenticated'] == "true") 
{
	db(__FILE__,__LINE__,"select * from srbase_users_accounts where login_id = '$_SESSION[login_id]'");
	$user = dbr();
	db(__FILE__,__LINE__,"select * from srbase_users_permissions where login_id = '$_SESSION[login_id]'");
	$user_perm = dbr();

	if($user_perm['deity'] == 1) 
	{
		$_userlevel = 1;
		$_rank = "Deity";
	}
	elseif($user_perm['developer'] == 1)
	{
		$_userlevel = 2;
		$_rank = "Developer";
	}
	elseif($user_perm['admin'] == 1)
	{
		$_userlevel = 3;
		$_rank = "Administrator";
	}
	elseif($user_perm['moderator'] == 1)
	{
		$_userlevel = 4;
		$_rank = "Moderator";
	}
	elseif(empty($user_perm)) 
	{
		$_userlevel = 5;
		$_rank = "Player";
	}
}
else 
{
	$_userlevel = 6;
	$_rank = "Visitor";
}
// assign permissions to the Session
$_SESSION['permissions']['_userlevel'] = $_userlevel;
$_SESSION['permissions']['_rank'] = $_rank;


$qcms_t = new Q_Smarty("Shadows_Rising_Default");


// define our Q-SITE version
$qsite_v = "Q-Site 0.2";
$qcms_t->assign("qsite_v", $qsite_v);


// define a few basic variables to use within the CMS
$blocks_dir = $CONFIG['gameroot'] . "/qcms/blocks";
$modules_dir = $CONFIG['gameroot'] . "/qcms/modules";
$pagepositions = array("left", "center", "right");
$OUTPUT = "";

?>
