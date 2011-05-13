<?php
/*
// 

File:				print_funcs.inc.php
Objective:			general print functions, e.g. error and system messages in plain text 
Version:			SR-RPG (Game Engine) 0.0.3
Author:				Maugrim The Reaper
Edited by:			Maugrim The Reaper
Date Committed:		6 August 2004		
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

// display a system message (usually for a player error)
function SystemMessage($text="Error! Please try again or contact an Administrator.") {
	global $sr, $nv;
	$sr->assign("system_message", $text);
	$sr->assign("http_referer", $_SERVER['HTTP_REFERER']);
	//echo(basename($_SERVER['HTTP_REFERER']));
	// approve referrer as a navlink - only need the basename (no path info)
	$nv->approvelink(basename($_SERVER['HTTP_REFERER']));
	$sr->DisplayPage("system_message.tpl.html");
	exit();
}

?>