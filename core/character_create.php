<?php
/*
// 

File:				character_create.php
Objective:			Create a character profile and statistics
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


	db(__FILE__,__LINE__,"select char_check from ${gameinstance}_characters where login_id = '$user[login_id]'");
	$created = dbr();
	if($created['char_check'] >= 1) 
	{
		SystemMessage(CHAR_ALREADY_EXISTS);
	}


$char_create = new Character_Creation($user['login_id']);


if($_GET['op_c'] == "create") 
{
	// display the character sex and name form
	$char_create->Char_Name();
}


if($_POST['op'] == "race") 
{
	// process form data for name and sex, then display race choice form
	$char_create->Char_Race($user['login_id']);
}


if($_POST['op'] == "class") 
{
	// process form data for race, then display class choice form
	$char_create->Char_Class($user['login_id']);
}

if($_POST['op'] == "class2") 
{
	// process class data, and finalise character
	db(__FILE__,__LINE__,"select * from {$gameinstance}_characters where login_id = '$user[login_id]'");
	$mychar = dbr();
	$char_create->Char_Set_Skills($mychar);
}

if($_POST['op'] == "save_skills") 
{
	db(__FILE__,__LINE__,"select * from {$gameinstance}_characters where login_id = '$user[login_id]'");
	$mychar = dbr();
	$char_create->Char_Save_Skills($mychar);
}


// If nothing sticks, someone passed false data to this file!
SystemMessage(EOF_BAD_REQUEST);

?>