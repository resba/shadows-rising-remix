<?php
/*
// 
File:				common.inc.php
Objective:			This file holds functions and include calls essential to all php script for Shadows Rising
Version:			SR Alpha
Author:				Maugrim The Reaper
Date Committed:		15 May 2004		
Last Date Edited:	20 December 2004 (maugrim)

~~~~~~~~~~~~~~~~~~~~~~~~~
Copyright (c) 2004 by:
~~~~~~~~~~~~~~~~~~~~~~~~~
Pádraic Brady (Maugrim)
Programmermatt
Shadows Rising Project
~~~~~~~~~~~~~~~~~~~~~~~~~
(All rights reserved)
~~~~~~~~~~~~~~~~~~~~~~~~~

This program is free software. You can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the FSF; either version 1 of the License, or (at your option) any later version.  

//
*/

// NOTE: this array is fed by a statement at the top of all files. Basically it will hold all files used in the execution of a particular function. This array of filename is used by the translation system to determine what sets of translations to use (translations are set up for each file separately, rather than calling all at once).
$FILE_LIST = array();

// a small config var - sets the base database tag for the game we are attached to
$db_tag = "srbase"; //qsbase for QS

// Configuration file
require_once("qlib/config/config.inc.php");
// Q-LIB Authentication Class
require_once("qlib/auth.class.php");
// Q-LIB Database Functions with AdoDB
require_once("qlib/db_funcs.inc.php");
// Q-LIB Permission System 
/*
NOTE:Session Start moved here.                                                    <-session start movement
*/
require_once("qlib/permissions.php");



// this section checks passed session vars
if(!isset($_SESSION['login_name']))
{
	$login_name = "";
}
else
{
	$login_name = $_SESSION['login_name'];
}
if(!isset($_SESSION['login_id']))
{
	$login_id = "";
}
else
{
	$login_id = $_SESSION['login_id'];
}
if(!isset($_SESSION['session_id']))
{
	$session_id = "";
}
else
{
	$session_id = $_SESSION['session_id'];
}


// DEPRECATED
if(!isset($_SESSION['db_name']))
{
	$db_name = "";
}
else
{
	$db_name = $_SESSION['db_name'];
}

// connect to the database
// Note that $CONFIG is not superglobal - just a custom array for configuration variables

$db = db_connect($CONFIG['database_host'], $CONFIG['database_user'], $CONFIG['database_password'], $CONFIG['database'], $CONFIG['database_persistent']);

//initialize the perm object
$perm = new Q_PERM();

$perm->forum_destroy(true);

// debug message disabeld for 0.0.5b release

//print_array($perm->forum_get(1));






/*
DEV: move to within the actual connection function in db_funcs.inc.php - maybe check if the resulting resource $db is valid? Reminds me to implement the alternate LIMIT function for SR. Using LIMIT explicitly in our sql queries may not always be valid on all databases. ADODB provides a fully compatible alternative.
*/

//lets check and see if the database connection succeded
//if anyone knows a better way to do this, please feel free to implement it
if( dbc(__FILE__,__LINE__,"SELECT * FROM {$db_tag}_users_accounts LIMIT 1") ){
	//normal
}else {
	ob_clean();
	echo "An error has occured connecting to the database";
	die();
}


?>