<?php
/*
// 

File:				cpanel.inc.php
Objective:			The main control panel for the Shadows Rising RPG Game Engine 
Version:			SR-RPG (Game Engine) 0.0.3
Author:				Maugrim The Reaper
Edited by:			Maugrim The Reaper
Date Committed:		13 August 2004
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

// the clock is ticking - :)
function getmicrotime(){ 
   list($usec, $sec) = explode(" ",microtime()); 
   return ((float)$usec + (float)$sec); 
} 
$page_generate_start = getmicrotime();


// For some standardisation: common.inc.php relates to Q-LIB only - i.e. loads the backend files
// common.inc.php is located in the base directory



//calculate path to common.inc.php - avoids use of relative paths as undependable
//$commonpath = str_replace("core\cpanel", "", dirname(__FILE__)) . "common.inc.php";
require_once("../../common.inc.php");
//require_once($commonpath);


// a set of print functions for quick output of error or system messages, debug info, etc.
require_once("$CONFIG[gameroot]/core/includes/print_funcs.inc.php");


//This section will check of user is authenticated. If "true" will check if session has expired.
//If user is not authenticated/ or not checked for such/ will return "false"

if($_SESSION['authenticated'] == "true" && isset($_SESSION['authenticated'])) 
{
	if(isset($_SESSION['login_id']) && $_SESSION['login_id'] != 0) 
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
// redirect user to CMS if authenticated val (after all these somewhat paranoid checks) is false
if($_SESSION['authenticated'] == "false") 
{
	// do not replace with redirect() - this leads to non-game page
	echo("<script>self.location='$CONFIG[url_prefix]/qcms/index.php';</script>");
}



//grab user data if login status is set - $user contains user account (not character) data
// something of a iffy area - "true" permissions not yet implemented
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

// ensure this user has permission to access the Control Panel

if($_userlevel > 3) 
{
	SystemMessage(CPANEL_INSUFFICIENT_PERMISSIONS);
	exit();
}


// a value for game_id should also have been added to the session when the game was entered
// if this or the ingame check fail send back to the CMS front page
if(empty($_SESSION['game_id']) || empty($_SESSION['ingame']) || $_SESSION['ingame'] != "true") 
{
	$_SESSION['ingame'] == "false";
	echo("<script>self.location='$CONFIG[url_prefix]/qcms/index.php';</script>");
}
else 
{
	$moduleinstance = $_SESSION['moduleinstance'];
	$gameinstance = $_SESSION['gameinstance'];
}


// include any predefined, or initiated variables and arrays and generic functions
require_once("$CONFIG[gameroot]/core/includes/predefined.inc.php");
require_once("$CONFIG[gameroot]/core/includes/generic.inc.php");

// include our standard Template (Smarty) Class
require_once("$CONFIG[gameroot]/core/includes/smarty.inc.php");
require_once("$CONFIG[gameroot]/core/classes/navigation.class.php");

// create a new template Object - for cpanel we use an identical default.
$sr = new Q_Smarty("Deep_Blue");
$sr->assign("game_name", "Shadows Rising RPG");
$sr->assign("authenticated", $_SESSION['authenticated']);
if(empty($user_rank)) 
{
	$user_rank = array("Player");
}
$sr->assign("user_rank", $user_rank);
$sr->assign("userlevel", $_userlevel);



// load gzip output filter if enabled
// for future reference if required - disable this when intending to send continuous output to browser (rather
// than caching output and sending everything only at the end of script execution).
if($CONFIG['enable_gzip'] == 1 && empty($nooutputbuffer)) 
{
	$sr->load_filter("output", "gzip");	
}


// basic navigation array setup
// not sure whether we need the top menu - may be useful later for displaying MessageBox/Forum/AdminNotices, etc.
$NAV = array(
	"left"=>array(),
	"top"=>array()
);
// where left and top are positions - left holds an array of Sections (which each is an array of links)
// top simply holds an array of links - no sections as it is a single line nav menu.
$nv = new Navigation();
$_SESSION['allowed_navs'] = array(); //probably run from with ValidateRequest() but here for now



// load language file for system message translations if any
require_once("$CONFIG[gameroot]/core/lang/lang-en.inc.php");

require_once("$CONFIG[gameroot]/core/includes/security.inc.php");

?>