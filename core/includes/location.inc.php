<?php
/*
// 

File:				location.inc.php
Objective:			simple include file for /core/location.php which detects all Travel requests
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

// check for incoming Travel URI variable "integer loc"
if(isset($_GET['loc']) && $_GET['loc'] > 0) 
{
	// update location and return our new set of tiles for the location terrain map in an array
	$terrain_tiles = $loc->Travel($_GET['loc']);

	//refresh the character and location for any changes - required for travelling
	// DEV: these functions should be in the $loc/$char objects rather than in the Templating class...
	$character = $sr->Reload_Character();
	$location = $sr->Reload_Location();

	// now that we've travelled, let's assume that we have encountered a creature
	// we need an encounter system here - working on the planning now
	// for the moment let's take a 1 in 3 chance of attacking a GK
	if(mt_rand(0,3) == 3 && $_SESSION['_userlevel'] > 3) 
	{
		redirect("combat.php?cid=1");
	}
}

if(isset($_GET['skilltest']) && $_GET['skilltest'] == 1)
{
		$result = $skill->testofskill("picklock", 15);
		if($result === false) 
		{
			$output = "Picklock attempt failed.";
			$_SESSION['reset_test'] = 1;
			$output .= "<br /><br />Die Roll: ".$_SESSION['dieroll']."<br />Skill Lvl: ".$_SESSION['skills']['picklock']."<br />Modifier: ".$_SESSION['modifiers']['dex']."<br /><br />Difficulty: 15";
		}
		else 
		{
			$output = "Picklock attempt succeeded.";
			$_SESSION['reset_test'] = 1;
			$output .= "<br /><br />Die Roll: ".$_SESSION['dieroll']."<br />Skill Lvl: ".$_SESSION['skills']['picklock']."<br />Modifier: ".$_SESSION['modifiers']['dex']."<br /><br />Difficulty: 15";
		}
		$sr->assign("test_result", $output);
}
else 
{
	$output = "<a href=\"$CONFIG[url_prefix]/core/location.php?skilltest=1\">Pick Lock</a>";
	$sr->assign("test_result", $output);
}

?>