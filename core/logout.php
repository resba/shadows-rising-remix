<?php
/*
// 

File:				logout.php
Objective:			simple file to effect logout of a player and delete all session data 
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

ob_start(); //begin buffering of output - probably not require for SR since using javascript redirects

require_once("core.inc.php");

$_SESSION = array();
session_destroy();

// do not replace using redirect() - this redirects to a non-game page
echo "<script>self.location='$CONFIG[url_prefix]/qcms/index.php';</script><noscript>You cannot login without JavaScript. Please enable Javascript, or get a browser that supports it.</noscript>";

ob_end_flush(); //output buffer to browser

exit();
?>
