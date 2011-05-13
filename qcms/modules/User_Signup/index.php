<?php
/*
// 

File:				User_Signup Module: index.php
Objective:			simple user signup module 
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

// at least one GET var (the dir value sent to module.php) is expected, if not maybe someone tried
// to access the module directly, without using the proper url
if(empty($_GET) && empty($_POST)) 
{
	$M_OUTPUT .= "You cannot access Modules directly - please use a valid url";
}



// why would a registered user try to signup? beats me...:)
if($_SESSION['authenticated'] == "true") 
{
	$M_OUTPUT .= "You are already logged into your account. You don't need to signup again!";
}
elseif(empty($_GET['op'])) 
{
	// if empty output the default page, in this case a signup form
	$M_OUTPUT .= $qcms_t->fetch("$modules_dir/$module[directory]/templates/signup_form.tpl.html");
}
elseif($_GET['op'] == "signup") 
{
	// now we perform the actual signup - this also output to $M_OUTPUT the results page
	require_once("includes/signup.php");
}

else 
{
	$M_OUTPUT .= "Still nothing to do - feed me data!";
}


?>