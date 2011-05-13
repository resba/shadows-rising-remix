<?php
/*
// 

File:				item_equip.php
Objective:			Manages the equipping/unequipping of items, and bonuses/modifers that result
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

if(!empty($_GET['op']) && !is_numeric($_GET['op'])) 
{
	if($_GET['op'] == "equip" && !empty($_GET['type']) && !is_numeric($_GET['type']) && !empty($_GET['pack_id']) && is_numeric($_GET['pack_id'])) 
	{
		// since there may be two equipped weapons/rings we need to use some custom checks for these
		if($_GET['type'] == "weapon") 
		{
			// characters can equip two of a weapon or ring type - one per hand
			// by default let's assume player will equip the right hand first
			db(__FILE__,__LINE__,"select pack_id, handle from ${gameinstance}_backpack where position = 'weaponr' and equipped > 0 and login_id = $character[login_id]");
			$weapon_right_chk = dbr();
			if(empty($weapon_right_chk)) 
			{
				$can_equip_weaponr = true;
			}
			elseif($weapon_right_chk['handle'] == "double") 
			{
				$can_equip_anyweapon = false;
			}
			else
			{
				$can_equip_weaponr = false;
			}

			// check left hand next
			// if right hand weapon is a double or two-handed weapon, then left will also be occupied
			// only check left hand if right hand weapon is not a double

			if($can_equip_anyweapon !== false) 
			{
				db(__FILE__,__LINE__,"select pack_id from ${gameinstance}_backpack where position = 'weaponl' and equipped = 1 and login_id = $character[login_id]");
				$weapon_left_chk = dbr();
				if(empty($weapon_left_chk)) 
				{
					$can_equip_weaponl = true;
				}
				else 
				{
					$can_equip_weaponl = false;
				}
			}
			if(($can_equip_weaponr === false && $can_equip_weaponl === false) || $can_equip_anyweapon === false) 
			{
				SystemMessage(ITEM_ALL_HANDS_EQUIPPED);
			}
		}
		elseif($_GET['type'] == "ring") 
		{
			// characters can equip two of a weapon or ring type - one per hand
			// by default let's assume player will equip the right hand first
			db(__FILE__,__LINE__,"select pack_id from ${gameinstance}_backpack where position = 'ringr' and equipped = 1 and login_id = $character[login_id]");
			$ring_right_chk = dbr();
			if(empty($ring_right_chk)) 
			{
				$can_equip_ringr = true;
			}
			else 
			{
				$can_equip_ringr = false;
			}
			// check left ring-finger next
			db(__FILE__,__LINE__,"select pack_id from ${gameinstance}_backpack where position = 'ringl' and equipped = 1 and login_id = $character[login_id]");
			$ring_left_chk = dbr();
			if(empty($ring_left_chk)) 
			{
				$can_equip_ringl = true;
			}
			else 
			{
				$can_equip_ringl = false;
			}
			if($can_equip_ringr === false && $can_equip_ringl === false) 
			{
				SystemMessage(ITEM_ALL_RINGS_EQUIPPED);
			}
		}
		else 
		{
			db(__FILE__,__LINE__,"select pack_id from ${gameinstance}_backpack where position = '$_GET[type]' and equipped = 1 and login_id = $character[login_id]");
			$other_equip_chk = dbr();
			if(empty($other_equip_chk)) 
			{
				$can_equip_item = true;
			}
			else 
			{
				$can_equip_item = false;
				SystemMessage(ITEM_ALREADY_EQUIPPED);
			}
		}

		// at this stage we have determined there is nothing to stop us equipping the item
		// so let's equip it!

		// fetch details of the item to equip
		db(__FILE__,__LINE__,"select * from ${gameinstance}_backpack where pack_id = $_GET[pack_id] and login_id = $character[login_id]");
		$equip_item = dbr();
		// alter the equipped and position fields on the database to show it is now equipped
		// ensure we use a valid and available position
		if($_GET['type'] == "weapon") 
		{
			if($can_equip_weaponr === true) 
			{
				$sql_position = "weaponr";
			}
			elseif($can_equip_weaponl === true) 
			{
				$sql_position = "weaponl";

				// we have to make an additional check here. Assuming that the right hand is holding a weapon -
				// if the weapon we want to equip the left hand with is a double weapon - we cannot equip it
				// remember in this sceneario, the right hand is already equipped - so we cannot equip the left
				// with any double/two-handed weapon
				if($equip_item['handle'] == "double") 
				{
					SystemMessage(ITEM_RIGHT_HAND_EQUIPPED);
				}
			}
		}
		elseif($_GET['type'] == "ring") 
		{
			if($can_equip_ringr === true) 
			{
				$sql_position = "ringr";
			}
			elseif($can_equip_ringl === true) 
			{
				$sql_position = "ringl";
			}
		}
		else 
		{
			// since its not a weapon or ring - just use the item type as the position
			$sql_position = $_GET['type'];
		}

		// well after all that fiddling because of our weapons and rings, finally update the database and change
		// the equipped and position fields to reflect the newly equipped item
		dbn(__FILE__,__LINE__,"update ${gameinstance}_backpack set equipped = 1, position = '$sql_position' where pack_id = '$_GET[pack_id]' and login_id = '$character[login_id]'");
		// we'll also create a shadow entry for double or two-handed weapons to indicate both hands are full
		if($equip_item['handle'] == "double") 
		{
			// basically for double weapons we set equipped = 2. We can check for this value when displaying
			// the backpack, and create an italics font entry in the left hand position indicating a double
			// weapon is occupying both hands
			dbn(__FILE__,__LINE__,"update ${gameinstance}_backpack set equipped = 2 where pack_id = '$_GET[pack_id]' and login_id = '$character[login_id]'");
		}

		// now that the item is equipped, we need to take account of all the modifiers it adds to a character's 
		// attributes, skills and feats - attributes only are implemented at present.
		// since this is going to data re-used on all page requests, we'll add it to the player's session data to
		// avoid countless database fetches
		
		// first up - double check if the array $_SESSION['modifiers'] exists - if not will need to declare it
		if(empty($_SESSION['modifiers'])) 
		{
			$_SESSION['modifiers'] == array();
		}

		// NOTE: only "active" or "used" modifiers are present in this array (cuts down on array size)

		// 1. Set up any modifiers, in this case damage/criticals, from weapons (if a weapon was equipped)

		if($_GET['type'] == "weapon") 
		{
			db(__FILE__,__LINE__,"select max_damage, min_critical, max_critical, critical_multiplier from ${moduleinstance}_items_weapons where item_id = '$equip_item[item_id]'");
			$weapdata = dbr();
			// clear out any pre-existing weapon data for this item position
			$_SESSION['modifiers'][$sql_position] = array();
			// insert the updated modifier information using a simple foreach loop
			foreach($weapdata as $key=>$val) 
			{
				$_SESSION['modifiers'][$sql_position][$key] = $val;
			}
		}

		// 2. Set up any Attribute modifiers from all other items (Armour is not yet implemented)

		if($_GET['type'] != "weapon") 
		{
			//DEV: attribute array will be setup within each Ruleset Module's configuration file
			$attribute_array = array("str", "dex", "con", "int", "wis", "cha");
			// fetch the item details regarding modifiers depending on type, and whether item gives an attribute mod
			// DEV: need to change table names from items to a singular not plural of item types!!!
			db(__FILE__,__LINE__,"select effect_type, effect_amount from ${moduleinstance}_items_${_GET[type]}s where item_id = '$equip_item[item_id]' and effect = 'attribute'");
			$itemdata = dbr();
			// if this item has no attribute modifier to give player, this fetched array will be empty
			if(!empty($itemdata)) 
			{
				foreach($attribute_array as $key=>$attribute) 
				{
					// loop through the available attribute until a match is found - then update the session array
					if($itemdata['effect_type'] == $attribute) 
					{
						// this array seems complex but it equates to something like:
						// $_SESSION['modifiers']['belt']['str'] = 2;
						// i.e. there is an item in the belt position giving a +2 bonus to the strength attribute
						// empty prior data first
						$_SESSION['modifiers'][$sql_position][$attribute] = array();
						$_SESSION['modifiers'][$sql_position][$attribute] = $itemdata['effect_amount'];
					}
				}	
			}
		}

		// to account for changes, we also store the modifier array on the database - to be looked up on next login
		// to do this we store the array after "serializing" it

		$modifier_array = serialize($_SESSION['modifiers']);
		dbn(__FILE__,__LINE__,"update ${gameinstance}_characters set modifiers = '$modifier_array' where login_id = '$character[login_id]'");

		SystemMessage(ITEM_EQUIPPED . " &quot;$equip_item[item_name]&quot;.");

		// that's pretty much it, a bit long but it covers everything. The session data will remain valid until a
		// player either logs out or times out. After a fresh login, this data will be fetched from the database
		// and placed back into the same session arrays.	
	}
	elseif($_GET['op'] == "unequip" && !empty($_GET['position']) && !is_numeric($_GET['position']))
	{
		// Unlike the above - unequipping an item is a far simpler task :)
		dbn(__FILE__,__LINE__,"update ${gameinstance}_backpack set equipped = 0, position = 'backpack' where position = '$_GET[position]' and login_id = '$character[login_id]'");
		// finally empty the session data for that position
		$_SESSION['modifiers'][$_GET['position']] = array();

		// and update the database field for the new modifier serialized array
		$modifier_array = serialize($_SESSION['modifiers']);
		dbn(__FILE__,__LINE__,"update ${gameinstance}_characters set modifiers = '$modifier_array' where login_id = $character[login_id]");

		SystemMessage(ITEM_UNEQUIPPED . "&quot;$_GET[position]&quot;.");
	}
}



// NOTE: since this file requires little output to be sent to the player, we will send these small
// messages using the SystemMessage() function. This function still calls upon Smarty to display a simple
// template with the message included - but saves us the overhead of coding template functions directly
// for just simple text. As a result we don't need any $sr->display() reference here.



// If nothing sticks, someone passed false data to this file!
SystemMessage(EOF_BAD_REQUEST);

?>