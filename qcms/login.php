<?php
/*
// 
File:			login.php
Objective:		Process used to authenticate user for server account plus each game on server
Version:		QS 2.2 Beta
Author:			Maugrim_The_Reaper (maugrimtr@hotmail.com)
Date Committed:	5 October 2003	Date Modified:	6 October 2003

Copyright (c) 2003, 2004 by Pádraic Brady

This program is free software. You can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation.
//
*/

// In an effort to keep files more concise and easier to work with, much in-file code has migrated to includes files
require_once("cms.inc.php");


// Code controlling specific game entry checks - not used in SR

if(isset($_GET['game_db']) || isset($_POST['game_db']))
{
	$auth = new Q_Authenticate();
	$auth->AuthUserGame();
}


// Code controlling logging player into server account


// possible object code
$auth = new Q_Authenticate();
$user = $auth->GrabUser($_POST['l_name']);

// check challenge/response validity for login
$authent = $auth->AuthUser($user, $_POST['response']);


echo "<script>self.location='$CONFIG[url_prefix]/qcms/index.php';</script><noscript>You cannot login without JavaScript. Please enable Javascript, or get a browser that supports it.</noscript>";

exit();

?>