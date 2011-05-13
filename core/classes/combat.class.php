<?php
/*
// 

File:				combat.class.php
Objective:			combat engine utilising Prometheus SRD rules
Version:			SR-RPG (Game Engine) 0.0.4
Author:				Maugrim The Reaper
Edited by:			Maugrim The Reaper
Date Committed:		15 October 2004		
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

/*

Combat Summary
==============

A combat round under the following rules is extremely simple

1. Determine whether Character hits the Creature opponent
2. Compute the Damage a Successfull hit causes
3. Apply the Damage.

1. Determine whether Character hits the Creature opponent
---------------------------------------------------------

a) we first calculate the creature's AC (Armour Class), i.e. a measure of how hard a creature is to hit. This is calculated as:
	Armour Base (10) + Armour Bonus (DB Value) + DEX Modifier (DB Value)
	where:
			-Base is a predetermined value, generally 10 (lower to make game more challenging - potent. Game Var)
			-Bonus comes from Armour/Equip, generally given a single value for creatures (simpler)
			-DEX Modifier - generally equals [ (DEX-10)/2 ] (other mods done in same way)
b) to hit the creature, the character must match the creature's AC score with an Attack Roll. The AR score is computed as:
	1d20 (RAND 1->20) + Attack Bonus
	where:
			-1d20 is a random number between 1 and 20 (scoring a 20 gives a CRITICAL HIT) (weapon critical range ignored for the moment - depending on weapon could be 19-20, 18-20, etc)
			-Attack Bonus equals [ Base Attack + STR Modifier ]
			-Base Attack is preset to 1, but will eventually equal Base Attack of the character's class at their current level once we implement classes properly in 0.0.5 or later. 

2. Compute the Damage a Successfull hit causes
----------------------------------------------

Damage is computed by reference to a characters weapons. Currently all weapons are deemed to do damage equal to 1d6, i.e. a random number between 1 and 6, and is computed by weapon as follows:
	DOUBLE WEAPON: 1D6 + (1.5 * STR Modifier)
	ON-HAND WEAPON: 1D6 + (1.0 * STR Modifier)
	OFF-HAND WEAPON: 1D6 + (0.5 * STR Modifier)
		where:
			DOUBLE is a weapon held in both hands, ON-HAND is a weapon held in the right hand, and OFF-HAND is a second weapon held in the left hand. Generally double/twin weapons give a multiplier of 1.5 where a single weapon provides a multiplier of 1 (unless a DOUBLE, e.g. two-ended weapon like a staff). In the future, using a double/two weapons will impose a penalty to balance the multiplier increase - this will be mitigated by certain SKILLS/FEATS once these are implemented.
				For this simplified combat system we ignore that using a DOUBLE or additional weapon actually should count as an extra attack, with a separate success check. Rather if first attack is a success, we assume second is also - and vice versa in event of a failure.

3. Apply the Damage.
--------------------

Damage is taken against the creatures "health", if this goes below zero - the character wins. 

Additionally, scoring a 20 on a d20 roll when calculating the Attack Roll (see above) will give an opportunity to score a CRITICAL HIT. Whether this becomes a critical hit depends on whether a SECOND Armour Class/Attack Roll is won by the player. If the second roll is won by the character - damage will normally be doubled (sometimes tripled - depends on weapon - though this simplified system ignore weapon ranges). If the character loses the second AR/AC test - they will still do normal damage. (note: we are also ignoring that any score of 20 from a d20 all is an automatic success - will implement this, and all the other steps/factors ignored in the simple combat system at a later date.)

The process for creatures attacking the character is essentially the same - :)


Development Notes:
-system as a whole is simplified (more detail to add)
-some values are explicitly given, where in future they would be calculated
-most calcs use attribute modifiers, a modifier is a value calculated from an attribute value such as STR/DEX,
e.g. if STR = 12, STR modifier = (STR-10)/2, i.e. 1 OR if STR = 6, modifier = (6-10)/2 = -2
An attribute of 10 is considered average (gives a 0 modifier), i.e. what a normal character would have.
-as noted throughout above - some steps are intentionally ignored to keep this combat implementation simple
-all weapons regardless of stats will do d6() (between 1 and 6) damage - to be finished

*/

class Combat {

	var $gameinstance;
	var $moduleinstance;

	// Constructor for Combat class
	function Combat() {
		$this->gameinstance = $GLOBALS['gameinstance'];
		$this->moduleinstance = $GLOBALS['moduleinstance'];
	}

	// function to determine who attacks who first
	function Check_Initiative_Char() {
		global $roll;
		$init = $roll->d20() + $_SESSION['modifiers']['dex'];
		return $init;
	}

	// check a creatures initiative - we assume a crtr's dex mod = 1
	function Check_Initiative_Creat() {
		global $roll;
		$init = $roll->d20() + 1;
		return $init;
	}

	// function to compute Armour Class of a Character
	// Armour Bonus is Zero until Armour is implemented
	function Compute_ArmourClass_Char() {
		$arm_bonus = 0;
		$ac = 10 + $arm_bonus + $_SESSION['modifiers']['dex'];
		return $ac;
	}

	// function to compute a characters attack bonus added to attack roll
	// attack bonus is given depending on char's class - we assume 1
	function Compute_AttackBonus_Char() {
		$att_bonus = 1;
		$ab = $att_bonus + $_SESSION['modifiers']['str'];
		return $ab;
	}

	// compute the char's final attack roll (to see whether they damage target)
	function Compute_AttackRoll_Char($ab) {
		global $roll;
		$_SESSION['_combat']['critical'] = "false";
		$ar = $roll->d20();
		// a direct hit on 20 after a roll may mean a critical hit of a second check results in a hit
		if($ar >= 20) 
		{
			$_SESSION['_combat']['critical'] = "true";
		}
		$ar += $ab;
		return $ar;
	}

	// compute creature's armour class
	function Compute_ArmourClass_Creat($creature) {
		$acc = 10 + $creature['armour_class'] + round(($creature['dex']-10-0.01)/2);
		return $acc;
	}

	// compute creatures attack bonus - we assume base attack bonus is 1
	function Compute_AttackBonus_Creat($creature) {
		$abc = 1 + round(($creature['str']-10-0.01)/2);
	}

	// compute creatures attack roll
	function Compute_AttackRoll_Creat($abc) {
		global $roll;
		$arc = $roll->d20() + $abc;
		return $arc;
	}

}


// this class deals specifically with player combat against a creature - later will add player v player
class Creature_Combat extends Combat {
	
	// calculate success of a character attack
	// for brevity, instead of calculating for each attack in a double-attack scenario (i.e. using a double
	// or two single-handed weapons at same time) we simply assume second attack has same outcome as original
	// To be updated in 0.0.5 or later
	function Character_Attack($character, $creature) {
		global $roll;
		$enemy = array(); $player = array();
		$enemy['ac'] = $this->Compute_ArmourClass_Creat($creature);
		$player['ab'] = $this->Compute_AttackBonus_Char();
		$player['ar'] = $this->Compute_AttackRoll_Char($player['ab']);
		if($_SESSION['_combat']['critical'] == "true") 
		{
			// this may be a critical hit if success again
			$player['ar2'] = $this->Compute_AttackRoll_Char($player['ab']);
		}
		if($player['ar'] >= $enemy['ac']) 
		{
			if(!empty($player['ar2']) && $player['ar2'] >= $enemy['ac']) 
			{
				// player scores a critical hit!!!
				return 2;
			}
			else 
			{
				// player scores a normal hit
				return 1;
			}
		}
		else 
		{
			// otherwise the player misses!
			return 0;
		}
	}

	// compute the success of a creature attack
	// simple version without using creature attributes or items
	function Creature_Attack($character, $creature) {
		global $roll;
		$enemy = array(); 
		$player = array();
		$player['ac'] = $this->Compute_ArmourClass_Char();
		$enemy['ab'] = $this->Compute_AttackBonus_Char();
		$enemy['ar'] = $this->Compute_AttackRoll_Char($player['ab']);
		if($enemy['ar'] >= $player['ac']) 
		{
			// enemy ar (attack roll) is greater than player ac (armour class) = enemy hits
			return 1;
		}
		else 
		{
			// otherwise the enemy misses!
			return 0;
		}
	}

	function Damage_Creature($character, $critical=0) {
		global $roll, $gameinstance, $moduleinstance;
		// step 1 - what weapons are being used?
		$positions = array("weaponr", "weaponl");
		$damage = 0;
		db3(__FILE__,__LINE__,"select * from ${gameinstance}_backpack where login_id = '$character[login_id]' and type = 'weapon' and equipped > 0");
		// step 2 - compute damage by weapon, ensuring we apply offhand/double weapon adjustments
		while($weapon = dbr3()) 
		{
			db2(__FILE__,__LINE__,"select max_damage, min_critical, max_critical, critical_multiplier from ${moduleinstance}_items_weapons where item_id = '$weapon[item_id]'");
			$curr_weapon = dbr2();
			$multiplier = 1;
			if($critical == 1) 
			{
				$multiplier = $curr_weapon['critical_multiplier'];
			}
			// REM: weapons can either be double, or single. Doubles are held in both hands, and allow two
			// attacks (with the second evoking a 0.5 penalty to STR). Singles are used normally, unless a 
			// second single weapon is held in the other "off" hand (this second weapon also evokes a penalty)
			if($weapon['position'] == "weaponr" && $weapon['handle'] == "double") 
			{
				// double weapons, full damage and 1.5 str mod (i.e. simulated use of both ends with a 0.5 penalty against STR on the second strike)
				$damage += $roll->rolldie($multiplier,d6) + round(1.5 * $_SESSION['modifiers']['str']);
			}
			elseif($weapon['position'] == "weaponr" && $weapon['handle'] == "single") 
			{
				// right hand is consider the "on" hand - full damage, no penalties
				$damage += $roll->rolldie($multiplier,d6) + $_SESSION['modifiers']['str'];
			}
			elseif($weapon['position'] == "weaponl" && $weapon['handle'] == "single") 
			{
				// left hand is the "off" hand (i.e. carrying two weapons - penalise by .5 str modifier
				$damage += $roll->rolldie($multiplier,d6) + round(0.5 * $_SESSION['modifiers']['str']);
			}
			$damage = $damage * $multiplier;
			//elseif(empty($weapon)) 
			//{
				//break; // no weapon equipped
			//}
		}
		if($damage > 0) 
		{
			if($damage >= $_SESSION['_combat']['creature']['health']) 
			{
				// the creature is dead!
				$_SESSION['_combat']['creature']['health'] = 0;
			}
			else 
			{
				$_SESSION['_combat']['creature']['health'] -= $damage;
			}
		}

		// now we have completed the attack, we'll send back some relevant stats
		$stats = array(
			"damage"=>"$damage",
			"critical"=>"$critical"
		);
		return $stats;
	}


	function Damage_Character($character, $creature) {
		global $roll, $gameinstance;
		// we're skipping a little here and making all creature attacks give 1 damage
		// we're also not harming the player :) - essentially they are invulnerable for now

		//dbn(__FILE__,__LINE__,"update ${gameinstance}_characters set hp = hp - 1 where login_id = '$character[login_id]'");
		// now we have completed the attack, we'll send back some relevant stats
		$stats = array(
			"damage"=>"1",
			"critical"=>"0"
		);
		return $stats;
	}


}

?>