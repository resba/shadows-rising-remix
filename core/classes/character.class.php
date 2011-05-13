<?php
/*
// 

File:				character.class.php
Objective:			main character class - manages all interactions with character data 
Version:			SR-RPG (Game Engine) 0.0.3
Author:				Maugrim The Reaper
Edited by:			Myrkul
Date Committed:		6 August 2004		
Last Date Edited:	18 November 2004

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

// todo: remove globals and switch to using var/public where needed

class Character {

	// Class Constructor - will check if character created yet
	function Character($uid) {
		global $CONFIG, $gameinstance, $moduleinstance;
		db(__FILE__,__LINE__,"select char_check from ${gameinstance}_characters where login_id = '$uid'");
		$created = dbr();
		if($created['char_check'] < 1 && $_GET['op_c'] != "create" && $_POST['op'] != "race" && $_POST['op'] != "class" && $_POST['op'] != "class2" && $_POST['op'] != "save_skills" && $_POST['op'] != "finalise") 
		{	
		echo("<script>self.location='$CONFIG[url_prefix]/core/character_create.php?op_c=create';</script>");
		}
	}

	// function to refresh the player character
	function Reload_Character($uid) {
		global $gameinstance, $moduleinstance, $char;
		db(__FILE__,__LINE__,"select * from ${gameinstance}_characters where login_id = '$uid'");
		$char_reload = dbr();
		//NOTE: char_reload deliberately does not reload the SESSION modifiers data
		// add ability bonuses to a characters attributes
		if(!empty($_SESSION['modifiers'])) 
		{
			$char->Add_Ability_Bonuses($char_reload);
		}
		// calculate a characters ability/attribute modifiers (once bonuses added to the attributes)
		$char->Calculate_Ability_Modifiers($char_reload);
		return $char_reload;
	}

	// function to deduct gold from a character
	function Take_Gold($amount = 0) {
		global $character, $gameinstance;
		if(isset($amount) && is_numeric($amount) && $amount >= 0 && $amount <= $character['gold']) 
		{
			dbn(__FILE__,__LINE__,"update ${gameinstance}_characters set gold = gold - '$amount' where login_id = '$character[login_id]'");
		}
		else 
		{
			SystemMessage(CHAR_NOT_ENOUGH_GOLD);
		}
	}

	// function to deduct gold from a character
	function Give_Gold($amount = 0) {
		global $character, $gameinstance;
		if(isset($amount) && is_numeric($amount) && $amount >= 0) 
		{
			dbn(__FILE__,__LINE__,"update ${gameinstance}_characters set gold = gold + '$amount' where login_id = '$character[login_id]'");
		}
		else 
		{
			SystemMessage(CHAR_CANNOT_GIVE_GOLD);
		}
	}


	// an alternate to Display_Backpack with a more user friendly GUI
	function Display_Backpack_Graphical($uid) {
		global $gameinstance, $moduleinstance, $sr, $nv, $ARRAYS;
		$backpack = array();
		$backpack_weight = NULL;
		// $ARRAYS contains preset arrays of values used in the game - eventually will be MODULE specific
		$positions = $ARRAYS['item_positions'];

		// first of all we need to build a list of items in the character's backpack
		db(__FILE__,__LINE__,"select distinct(type) as item_types from ${moduleinstance}_itemtypes");
		while($types = dbr())
		{
			unset($array_variable_name);
			$array_variable_name = "backpack".$types['item_types'];
			$$array_variable_name = array(); // i.e. varibale name is $backapackXXX, where XXX is item type
			db2(__FILE__,__LINE__,"select * from ${gameinstance}_backpack where login_id = '$uid' and type = '$types[item_types]' order by item_name asc, pack_id asc");
			while($backpack_items = dbr2()) 
			{
				// exit the current $backpack_items loop if current fetched row is empty
				if(empty($backpack_items)) 
				{
					break 1;
				}
				// otherwise check if items are equipped
				if($backpack_items['equipped'] > 0) 
				{
					$backpack_items['item_name_eq'] = $backpack_items['item_name']." (equipped)";
					foreach($positions as $key=>$val) {
						if($backpack_items['position'] == $val) 
						{
							// basically gives 'equipped_position'/'equipped_position_check' with pos. from array
							$var_n = "equipped_".$val;
							$var_chk = $var_n."_check";
							// --
							$sr->assign("$var_n", $backpack_items);
							$sr->assign("$var_chk", "true");

							// we need some specific changes for a double weapon, i.e. equipped = 2
							// this will create a copy entry for the left hand (in italics)
							if($backpack_items['equipped'] == 2) 
							{
								$sr->assign("equipped_weaponl_check", "true");
								$sr->assign("equipped_weaponl",$backpack_items);
								// ensure we italicise the text in the left hand position
								$sr->assign("equipped_weaponl_italics","true");
							}
							// approve an unequip link - this item is equipped so this is only action left
							$nv->approvelink("item_equip.php?op=unequip&position=" . $val);
						}
					}
				}
				else 
				{
					// otherwise this item is not equipped
					$backpack_items['item_name_eq'] = $backpack_items['item_name'];
					// approve a link to equip/use this item
					$nv->approvelink("item_equip.php?op=equip&type=" . $backpack_items['type'] . "&pack_id=" . $backpack_items['pack_id']);
					//approve a link to sell this item
					$nv->approvelink("merchant.php?sell=1&sell_" . $backpack_items['type'] . "=" . $backpack_items['pack_id']);
				}
				// push the current backpack items info to a "$backpackXXX" array, where XXX is the item type
				array_push($$array_variable_name, $backpack_items);
				// update the backpack weight by adding current items weight to total
				$backpack_weight += $backpack_items['weight'];
			}
			unset($backpack_items);
			// $template_var below will hold the item type string, i.e. "backpackweapon", "backpackarmour", etc.
			$template_var = "backpack" . $types['item_types'];
			if(empty($$array_variable_name)) 
			{
				$sr->assign("check_".$template_var, "false");
			}
			else 
			{
				$sr->assign("check_".$template_var, "true");
			}
			$sr->assign("$template_var", $$array_variable_name);
		}
		unset($types);
		unset($template_var);


		// for the graphical display, we will fetch each items details from the database and add these to a
		// javascript function in the templates which works the same as the Merchant display menu
		db(__FILE__,__LINE__,"select distinct(type) as item_types, db_postfix from ${moduleinstance}_itemtypes");
		while($types = dbr()) 
		{
			$$types['item_types'] = array();
			db2(__FILE__,__LINE__,"select distinct(item_id) from ${gameinstance}_backpack where login_id = $uid");
			while($packitems_bytype = dbr2()) 
			{
				if(empty($packitems_bytype)) 
				{
					break 1;
				}
				db3(__FILE__,__LINE__,"select * from ${moduleinstance}_items_" . $types['db_postfix'] . " where item_id = '$packitems_bytype[item_id]'");
				$packitem = dbr3();
				if(!empty($packitem)) 
				{
					array_push($$types['item_types'], $packitem);
				}
			}
			// $template_var below will hold the item type string, i.e. "weapon", "armour", etc.
			$template_var = $types['item_types'];
			if(empty($$types['item_types'])) 
			{
				$sr->assign("check_".$template_var, "false");
			}
			else 
			{
				$sr->assign("check_".$template_var, "true");
			}
			$sr->assign("$template_var", $$types['item_types']);
			
		}
		unset($types);
		//enable the item listing form in the template if items were available
		if(isset($template_var) && is_string($template_var))
		{
			$sr->assign("itemcheck", "true");
		}
		else 
		{
			$sr->assign("itemcheck", "false");
		}
		$sr->assign("backpack", $backpack);
		$sr->assign("backpack_weight", $backpack_weight);

		// NAVLINKS!!!
		// Generate the page navigation menu here - links displayed in order of defined SECTION then URL
		$nv->navlink("left", "Character", "Logout", "logout.php");
		$nv->navlink("left", "Character", "Backpack", "backpack.php?op=show");
		$nv->navlink("left", "Location", "Return to Location", "location.php");
		$sr->DisplayPage("equipmenu.tpl.html");
		//exit(); //already an exit in DisplayPage()
	}

	// this function adds all Ability bonuses to the base abilities/attributes
	function Add_Ability_Bonuses(&$character1) {
		$positions = array("head", "neck", "torso", "cloak", "weaponr", "weaponl", "ringr", "ringl", "bracer", "belt", "feet");
		$attributes = array("str", "dex", "con", "intel", "wis", "cha");
		foreach($positions as $key=>$position) {
			foreach($attributes as $key=>$attrib) {
				if(!empty($_SESSION['modifiers'][$position][$attrib])) 
				{
					$character1[$attrib] = $character1[$attrib] + $_SESSION['modifiers'][$position][$attrib];
				}
			}
		}
	}

	function Assemble_Skills($mychar) {
		$_SESSION['skills'] = array();
		$skill_array = unserialize($mychar['skills']);
		if(!empty($skill_array)) 
		{
			foreach($skill_array as $key=>$val) 
			{
				$_SESSION['skills'][$key] = $val;
			}
		}
	}

	// this function calculate modifiers gained from a character's base attributes or abilities
	function Calculate_Ability_Modifiers(&$character1) {
		global $sr;
		$ability_mods = array();
		$attributes = array("str", "dex", "con", "intel", "wis", "cha"); //switch to predefined!!!
		foreach($attributes as $key=>$attrib) 
		{
			// note that the -0.01 is a fuzz factor, it prevents PHP rounding exact halves e.g. 3.5 which
			// the round() function can round either up or down depending on whether the unit number (3) is
			// even or odd
			$ability_mods[$attrib] = round(($character1[$attrib]-10-0.01)/2);
			$_SESSION['modifiers'][$attrib] = $ability_mods[$attrib];
		}
		$sr->assign("ability_modifiers", $ability_mods);
	}

	// simple equation for an ability's modifier
	function calculate_modifier($attribute) {
		$modifier = round(($attribute - 10.01) / 2);
		return $modifier;
	}
}




class Character_Creation extends Character {
	
	// extend class automatically calls Character constructor in absence of a Character_Creation constructor

	// functions herein manage the display and processing of character creation steps

	// function to request char name and sex through a form
	function Char_Name() {
		global $sr;
		$sr->assign("location_name", "Character Creation");
		$sr->display("character_name.tpl.html");
		exit();
	}

	// function to process name and sex input, and request race choice, on data validation
	function Char_Race($uid) {
		global $sr, $gameinstance, $moduleinstance;
		//save incoming data after checking validity
		if((strcmp($_POST['char_name'],htmlspecialchars($_POST['char_name']))) || (strlen($_POST['char_name']) < 5) || (eregi("[^a-z0-9~!@#$%&*_+-=£§¥²³µ¶Þ×€ƒ™ ]",$_POST['char_name']))) 
		{
			SystemMessage(CHAR_INVALID_NAME);
		}
		//
		if($_POST['char_sex'] != "male" && $_POST['char_sex'] != "female") 
		{
			SystemMessage(CHAR_INVALID_SEX);
		}
		//save data to database
		dbn(__FILE__,__LINE__,"update ${gameinstance}_characters set name = '$_POST[char_name]', sex = '$_POST[char_sex]' where login_id = '$uid'");
		// refresh the character - also updates template variable
		unset($character);
		$character = $this->Reload_Character($uid);
		$sr->assign("character", $character);
		//display next page - race selection
		$sr->assign("location_name", "Character Creation");
		$char_races = array();
		db(__FILE__,__LINE__,"select * from ${moduleinstance}_races");
		while($races = dbr()) 
		{
			$races['modifiers'] = unserialize($races['modifiers']);
			$races['feats'] = unserialize($races['feats']);
			array_push($char_races, $races);
		}
		$sr->assign("char_races", $char_races);
		$sr->display("character_race.tpl.html");
		exit();
	}

	// function to process race input, and request class choice, on data validation
	function Char_Class($uid) {
		global $sr, $gameinstance, $moduleinstance;
		db(__FILE__,__LINE__,"select race_id, name, modifiers, feats from ${moduleinstance}_races where race_id = '$_POST[char_race]'");
		$char_race = dbr();
		if(empty($char_race)) 
		{
			SystemMessage(CHAR_INVALID_RACE);
		}
		dbn(__FILE__,__LINE__,"update ${gameinstance}_characters set race_id = '$char_race[race_id]', race_name = '$char_race[name]' where login_id = '$uid'");
		$attributes = array("str", "dex", "con", "intel", "wis", "cha"); //switch to predefined!!!
		$race_modifiers = unserialize($char_race['modifiers']);
		foreach($attributes as $key=>$attr) 
		{
			$final_attribute = 10 + $race_modifiers[$attr];
			dbn(__FILE__,__LINE__,"update ${gameinstance}_characters set {$attr} = '$final_attribute' where login_id = '$uid'");
		}
		// refresh the character - also updates template variable
		$character = $this->Reload_Character($uid);
		$sr->assign("character", $character);
		$sr->assign("location_name", "Character Creation");

		$char_classes = array();
		db(__FILE__,__LINE__,"select * from ${moduleinstance}_classes");
		while($classes = dbr()) 
		{
			array_push($char_classes, $classes);
		}
		$sr->assign("char_classes", $char_classes);
		$sr->display("character_class.tpl.html");
		exit();
	}

	// function to process class input, and finalise character data
	function Char_Set_Skills($mychar) {
		global $sr, $gameinstance, $moduleinstance;
		db(__FILE__,__LINE__,"select * from ${moduleinstance}_classes where class_id = '$_POST[char_class]'");
		$char_class = dbr();
		if(empty($char_class)) 
		{
			SystemMessage(CHAR_INVALID_CLASS);
		}
		// grab initial rank
		$class_ranks = unserialize($char_class['ranks']);
		$myrank = $class_ranks[0];
		// grab initial skill points
		$int_mod = $this->calculate_modifier($mychar['intel']);
		$ini_skill_pts = ($char_class['skill_increment'] + $int_mod) * $char_class['firstlevel_skill_multiplier'];
		/*
			lets remember that the 1st element of any array is designated '0', not '1' - see above
		*/
		dbn(__FILE__,__LINE__,"update ${gameinstance}_characters set class_id = '$char_class[class_id]', class_name = '$char_class[name]', hp = '$char_class[start_hp]', rank = '1', rank_name = '$myrank', level = '1', skill_points = '$ini_skill_pts', location = '1' where login_id = '$mychar[login_id]'");
		// refresh the character - also updates template variable
		$character = $this->Reload_Character($mychar['login_id']);
		$sr->assign("character", $character);
		$sr->assign("location_name", "Character Creation");
		// send skill details to the template
		$module_skills = array();
		db(__FILE__,__LINE__,"select * from {$moduleinstance}_skills");
		while($skills = dbr()) 
		{
			array_push($module_skills, $skills);
		}
		$sr->assign("char_skills", $module_skills);
		$sr->display("character_skills.tpl.html");
		exit();
	}


	function Char_Save_Skills($mychar) {
		global $sr, $nv, $gameinstance, $moduleinstance;
		if($_POST['skill_pts'] < 0 || $_POST['skill_pts'] > $mychar['skill_points']) 
		{
			SystemMessage("You appear to have submitted erroneous skill details - either you have clawed back too many skill points or have used up more points than you were originally allocated. Please go back and try again");
		}
		$maxskill = $mychar['level'] + 3; // max pts per skill = char level + 3 (one of those admin vars perhaps...
		// grab char's current skills if available
		if(!empty($mychar['skills'])) 
		{
			$myskills = unserialize($mychar['skills']);
		}
		else 
		{
			$myskills = array();
		}
		// filter through the skills, locate changes, and check against original and max values
		foreach($_POST as $key=>$var) 
		{
			// only check if $key corresponds to a skill value input id
			if(substr($key,0,12) != "skill_value_") 
			{
				continue 1;
			}
			$get_skill_id = explode("_", $key);
			$skill_id = $get_skill_id[2];
			// if skills for char exist - check against original values
			if(!empty($skill_id) && is_numeric($var) && $var > 0) 
			{
				db(__FILE__,__LINE__,"select skill_code from {$moduleinstance}_skills where skill_id = '$skill_id'");
				$sk = dbr();
				if(empty($sk)) 
				{
					SystemMessage("Sorry, but one of the skills upgraded does not appear to be attached to a valid skill. Please go back and try again.");
				}
				$myskillcode = $sk['skill_code'];
				if(!empty($myskills)) 
				{
					// ensure new skill level is not less than the original
					if($var < $myskills[$myskillcode]) 
					{
						SystemMessage("One of your upgraded skills has been set to a level below it's original level. This is not allowable. Please go back and try again.");
					}
					$myskills[$myskillcode] = $var;
				}
				else 
				{
					$myskills[$myskillcode] = $var;
				}
				if($myskills[$myskillcode] > $maxskill) 
				{
					SystemMessage("One of the Skills you upgraded appears to be above the maximum skill level, determined as your Character Level + 3. Please go back and try again.");
				}
			}
			else 
			{
				echo($var."-".$skill_id);
				SystemMessage("Sorry, but the details for one of your upgraded skills appears to be corrupted. Either the passed skill level is not a number, is negative or zero, or is not attached to a valid skill. Please go back and try again.");
			}
			$total_skill_points += $var;
		}
		if($total_skill_points > $mychar['skill_points']) 
		{
			SystemMessage("The total number of skill points you have utilised appear to be more than you were originally allocated for this level. Please go back and try again.");
		}
		// from the above we note that $var=0 is allowed, as is any $var= to original level.
		// save our newly upgraded skills to the database as a serialized array on the character table
		$myskills = serialize($myskills);
		dbn(__FILE__,__LINE__,"update {$gameinstance}_characters set skills = '$myskills', char_check = 1, skill_points = '$_POST[skill_pts]' where login_id = '$mychar[login_id]'");

		// approve link to location
		$nv->navlink("left", "Location", "Visit Location", "location.php");

		// refresh the character - also updates template variable
		$character = $this->Reload_Character($mychar['login_id']);
		$sr->assign("character", $character);
		$sr->assign("location_name", "Character Creation");
		$sr->display("character_final.tpl.html");
		exit();
		


		
	}
}

?>