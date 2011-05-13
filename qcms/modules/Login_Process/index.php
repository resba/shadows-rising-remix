<?php
/*
// 

File:				Game_Index Module: index.php
Objective:			so far just a simple game listing - lot more to be done in future 
Version:			Q-CMS 0.2
Author:				Maugrim The Reaper
Edited by:			Maugrim The Reaper
Date Committed:		6 October 2003
Last Date Edited:	22 October 2004

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

// at least one GET var (the dir value sent to module.php) is expected, if not maybe someone tried
// to access the module directly, without using the proper url
if(empty($_GET) && empty($_POST)) 
{
	$M_OUTPUT .= "You cannot access Modules directly - please use a valid url";
}

// possible object code
$auth = new Q_Authenticate();
$user = $auth->GrabUser($_POST['l_name']);

// check challenge/response validity for login
$authent = $auth->AuthUser($user, $_POST['response']);

if($authent == 1) 
{
	$M_SUBTITLE = "Login Success";
	$qcms_t->assign("login_name", $_SESSION['login_name']);
	$M_OUTPUT .= $qcms_t->fetch("$M_DIR/templates/login_success.tpl.html");
	
}
elseif(!empty($authent)) // otherwise authent holds a text message (probably an error)
{
	$M_SUBTITLE = "Failed Login";
	$M_OUTPUT .= $authent;
}
else 
{
	// here op was set, but contained no valid data
	$M_OUTPUT .= "Module Error: No valid data received";
}

?>