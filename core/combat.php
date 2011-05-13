<?php
/*
// 

File:				combat.php
Objective:			combat management file
Version:			SR-RPG (Game Engine) 0.0.4
Author:				Maugrim The Reaper
Edited by:			Maugrim The Reaper
Date Committed:		14 November 2004	
Last Date Edited:	n/a

~~~~~~~~~~~~~~~~~~~~~~~~~
Copyright (c) 2004 by:
~~~~~~~~~~~~~~~~~~~~~~~~~
PÃƒÆ’Ã‚Â¡draic Brady (Maugrim)
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

$nooutputbuffer = 0;

require_once("core.inc.php");

//remove once added to security.inc.php
$nv->ValidateRequest();

require_once("classes/combat.class.php");

$combat = new Creature_Combat(); //we'll use pvp on another specialised file

// ensure $cid is set - i.e. id of creature we are fighting
if(empty($_GET['cid'])) 
{
	SystemMessage(EOF_BAD_REQUEST);
}

$player = array();
$enemy = array();

// step 1 - who are we fighting?

db(__FILE__,__LINE__,"select * from ${moduleinstance}_creatures where creature_id = '$_GET[cid]'");
$creature = dbr();
// Needs Correct Code Input
// db243(__FILE__,__LINE__,"select * from ${moduleinstance}_characters where character_id = '$_SESSION[example_Id]'");
// $character = db243r();

// renew the _combat array only if array is empty (i.e. we are not already fighting)
if(empty($_SESSION['_combat']) || !is_array($_SESSION['_combat'])) 
{
	$_SESSION['_combat'] = array();
	$_SESSION['_combat']['creature'] = $creature;
//        $_SESSION['_combat']['character'] = $character;
}
$sr->assign("creature",$creature);
// $sr->assign("character",$character;

// step 2 - who attacks first? - to be tested

//$_SESSION['combat']['init'] = "true";

$player['init'] = $combat->Check_Initiative_Char();
$enemy['init'] = $combat->Check_Initiative_Creat();

if($player['init'] > $enemy['init']) 
{
//	 player attacks first
	$_SESSION['combat']['init'] = "true";
}
else 
{
	// enemy attacks first
	$_SESSION['combat']['init'] = "false";
}

// step 3 - setup the attack loop
// attack loops a certain number of times determined by another variable passed to this script - $auto_rounds

if(empty($_GET['auto_rounds'])) 
{
	$counter = 1;
}
else 
{
	$counter = $_GET['auto_rounds'];
}

// REM: All creature data is stored in SESSION data during combat (nothing written to DB)

// open an array to store the variables/arrays of each combat round iteration
$template_combat_vars = array();

for($i=0; $i<$counter; $i++) 
{
		// player gets first attack in the combat rounds
		$result_char = $combat->Character_Attack($character, $creature);
		$result_creat = $combat->Creature_Attack($character, $creature);
		if($result_char == 0) 
		{
			// character is successful and will do damage
			$char_stats = $combat->Damage_Creature($character);
		}
		elseif($result_char == 1) 
		{
			// character is successfull and has scored a critical hit
			$char_stats = $combat->Damage_Creature($character, 0);
		}
		else 
		{
			// character misses :(
			$char_stats = array("nohit"=>"true");
		}
		// creature may now counter-attack (if it's still alive!)
		if($result_creat == 1 && $_SESSION['_combat']['creature']['health'] > 0) 
		{
			// creature scores a hit
			$creat_stats = $combat->Damage_Character($character);
		}
		elseif($result_creat == 0 && $_SESSION['_combat']['creature']['health'] > 0) 
		{
			// creature misses!
			$creat_stats = array("nohit"=>"true");
		}
		else 
		{
			// it now appears that the creature is dead - there is rejoicing across the land...:)
			$char_stats['victory'] = "true";
			$exp_award = $roll->d8();
			$cash_award = $roll->d8();
			dbn(__FILE__,__LINE__,"update ${gameinstance}_characters set gold = gold + $cash_award, exp = exp + $exp_award where login_id = '$character[login_id]'");
		}
		// finally we should check whether the player is alive!!!
		if($character['hp'] <= 0) 
		{
			// player has been killed in action
			$char_stats['defeat'] = "true";
		}

		// reload character info for accuracy
		$character = $sr->Reload_Character();

		// new array iteration using $i - store current combat vars for use in template
		$template_combat_vars[$i] = array(
			"exp_award"=>$exp_award,
			"cash_award"=>$cash_award,
			"char_stats"=>$char_stats,
			"creat_stats"=>$creat_stats,
			"creat_health"=>$_SESSION['_combat']['creature']['health'],
			"char_health"=>$character[hp],
		);

		if($char_stats['defeat'] == "true" || $char_stats['victory'] == "true") 
		{
			// delete the combat details - either way combat is over!
			$_SESSION['_combat'] = array();
			$_SESSION['charhp'] = array();
			// add start new fight navlink
			$nv->navlink("left", "Combat", "Fight Again?", "combat.php?cid=$creature[creature_id]");
                        $nv->navlink("left", "Location", "Return to Map", "location.php");
			break; 
		}
}

// after iteration has run - check if defeat/vistory occured - must check outside loop or below navlinks will
// accumulate and show a dozen identical links
// add continue combat navlinks
if($char_stats['defeat'] != "true" && $char_stats['victory'] != "true")
{
	$nv->navlink("left", "Combat", "Fight (1 round)", "combat.php?cid=$creature[creature_id]");
	$nv->navlink("left", "Combat", "Fight (5 rounds)", "combat.php?cid=$creature[creature_id]&auto_rounds=5");
}

$sr->assign("template_combat_vars", $template_combat_vars);
$sr->assign("char_stats",$char_stats);

// NAVLINKS!!!
// Generate the page navigation menu here - links displayed in order of defined SECTION then URL
$nv->navlink("left", "Character", "Backpack", "backpack.php?op=show");
$nv->navlink("left", "Account", "Logout", "logout.php");

$sr->DisplayPage("combat.tpl.html");

exit();

?>