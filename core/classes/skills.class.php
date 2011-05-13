<?php
/*
// 

File:				skills.class.php
Objective:			allow an interface to skill test functions when performing an action
Version:			SR-RPG (Game Engine) 0.0.5
Author:				Maugrim The Reaper
Edited by:			Maugrim The Reaper
Date Committed:		17 December 2004		
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

class Skills {

	var $gameinstance;
	var $moduleinstance;
	var $roll;

	function Skills() {
		$this->gameinstance = $GLOBALS['gameinstance'];
		$this->moduleinstance = $GLOBALS['moduleinstance'];
		$this->roll = $GLOBALS['roll'];
	}

	// a skill test compares a char's skill plus that skill's attribute modifier, against the difficulty
	// rating of the test. Difficulty ranges from 0-40 (certainty to near impossible). Some tests can only
	// be attempted if the char is actually trained in that skill - e.g. picking a lock is a specialised
	// skill
	// all skill actions are stored on the database - e.g.'s picklock, concentrate, disable trap, etc.
	function testofskill($type, $difficulty) {
		global $roll;
		db(__FILE__,__LINE__,"select a.skill_code, a.default_dc, b.use_modifier, b.notimelimit, b.untrained from {$this->moduleinstance}_skilltests a, {$this->moduleinstance}_skills b where a.type = '$type' and a.skill_code = b.skill_code");
		$mytest = dbr();
		// if skill must be trained, and char is not trained, we fail the test
		if($mytest['untrained'] != 1 && empty($_SESSION['skills'][$mytest['skill_code']])) 
		{
			return false;
		}
		// if there is no timelimit we may assume the char "takes 20", otherwise roll a d20
		// this is the random element of the skill test
		if($mytest['notimelimit'] == 1) 
		{
			$myroll = 20;
		}
		else 
		{
			$myroll = $roll->d20();
		}
		$_SESSION['dieroll'] = $myroll; //debug var for picklock test
		// if no diffulty is set, grab the default value
		if(empty($difficulty)) 
		{
			$testdifficulty = $mytest['default_dc'];
		}
		else 
		{
			$testdifficulty = $difficulty;
		}
		// grab the current skill score (=skill level + attribute modifier for skill)
		$myskillscore = $_SESSION['skills'][$mytest['skill_code']] + $_SESSION['modifiers'][$mytest['use_modifier']];
		// calculate total character score
		$myscore = $myroll + $myskillscore;
		// check against the difficulty class
		if($myscore >= $testdifficulty) 
		{
			return true;
		}
		else 
		{
			return false;
		}
	}


	// in here we'll add lots of other sections, such as skill penalties, other modifiers, etc. For the 
	// moement we'll stick with the basic test as above.


}

?>