<?php
/*
// 

File:				backpack.php
Objective:			Display a characters backpack with item descriptions and options to equip/unequip/use items
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

require_once("core.inc.php");

//remove once added to security.inc.php
$nv->ValidateRequest();

if(!empty($_GET['op']) && $_GET['op'] == "show") 
{
	//$char->Display_Backpack($character['login_id']);
	$char->Display_Backpack_Graphical($character['login_id']);
}


// If nothing sticks, someone passed false data to this file!
SystemMessage(EOF_BAD_REQUEST);


?>