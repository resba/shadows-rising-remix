<?php
/*
// 

File:				core.inc.php
Objective:			manage merchant display, buying, selling, etc.
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

class Merchant {

	var $gameinstance;
	var $moduleinstance;
	var $character;

	// Constructor for Merchant class
	function Merchant() {
		$this->gameinstance = $GLOBALS['gameinstance'];
		$this->moduleinstance = $GLOBALS['moduleinstance'];
	}

	//function to grab all items this Merchant sells and assign all template variables

	//DEV: causes all merchants to show all items - no limits on type - to be fixed!!!
	// for now just exclude _drugs and add a sepciality check

	function Fetch_Items($merchant, $level) {
		global $gameinstance, $moduleinstance, $sr, $nv;
		if($merchant['shop_id'] == 1) 
		{
			db(__FILE__,__LINE__,"select distinct(type) as item_types, db_postfix from ${moduleinstance}_itemtypes where type != 'drug'");
		}
		else 
		{
			db(__FILE__,__LINE__,"select distinct(type) as item_types, db_postfix from ${moduleinstance}_itemtypes where type = '$merchant[item_type]'");
		}
		$valid_item_types = unserialize($merchant['item_types']);
		foreach($valid_item_types as $key=>$val) 
		{
			db(__FILE__,__LINE__,"select type as item_types, db_postfix from {$moduleinstance}_itemtypes where type = '$val'");
			$types = dbr();
			
		//}
		//while($types = dbr()) {
			
			// select only items merchant sells and where the item level is equal to or less than the player character level
			$$types['item_types'] = array();
			db2(__FILE__,__LINE__,"select * from ${moduleinstance}_items_" . $types['db_postfix']);
			while($merch_items = dbr2()) 
			{
				if(empty($merch_items)) 
				{
					break 1; //if no items of type - break loop
				}
				array_push($$types['item_types'], $merch_items);
				// fetched items are generally up for sale - therefore approve all potential purchase links
				$nv->approvelink("merchant.php?purchase=1&purchase_" . $types['item_types'] . "=" . $merch_items['item_id']);
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
		//enable the item listing form in the template if items were available
		if(isset($template_var) && is_string($template_var))
		{
			$sr->assign("itemcheck", "true");
		}
		else 
		{
			$sr->assign("itemcheck", "false");
		}
	}


	// functions to perform the act of purchasing items
	function Purchase_Weapon($itemid) {
		global $moduleinstance, $gameinstance, $character, $char;
		db(__FILE__,__LINE__,"select * from ${moduleinstance}_items_weapons where item_id = '$itemid'");
		$item = dbr();
		if($item['cost'] > $character['gold']) 
		{
			SystemMessage(MERCHANT_CHAR_NO_AFFORD);
		}
		dbn(__FILE__,__LINE__,"insert into ${gameinstance}_backpack (login_id, item_id, item_name, type, level, weight, handle, cost) values ('$character[login_id]', '$item[item_id]', '$item[name]', '$item[type]', '$item[level]', '$item[weight]', '$item[handle]', '$item[cost]')");
		$char->Take_Gold($item['cost']);
	}

	function Purchase_Ring($itemid) {
		global $moduleinstance, $gameinstance, $character, $char;
		db(__FILE__,__LINE__,"select * from ${moduleinstance}_items_rings where item_id = '$itemid'");
		$item = dbr();
		if($item['cost'] > $character['gold'])
		{
			SystemMessage(MERCHANT_CHAR_NO_AFFORD);
		}
		dbn(__FILE__,__LINE__,"insert into ${gameinstance}_backpack (login_id, item_id, item_name, type, level, weight, cost) values ('$character[login_id]', '$item[item_id]', '$item[name]', '$item[type]', '$item[level]', '$item[weight]', '$item[cost]')");
		$char->Take_Gold($item['cost']);
	}

	function Purchase_Belt($itemid) {
		global $moduleinstance, $gameinstance, $character, $char;
		db(__FILE__,__LINE__,"select * from ${moduleinstance}_items_belts where item_id = '$itemid'");
		$item = dbr();
		if($item['cost'] > $character['gold'])
		{
			SystemMessage(MERCHANT_CHAR_NO_AFFORD);
		}
		dbn(__FILE__,__LINE__,"insert into ${gameinstance}_backpack (login_id, item_id, item_name, type, level, weight, cost) values ('$character[login_id]', '$item[item_id]', '$item[name]', '$item[type]', '$item[level]', '$item[weight]', '$item[cost]')");
		$char->Take_Gold($item['cost']);
	}

	function Purchase_Bracer($itemid) {
		global $moduleinstance, $gameinstance, $character, $char;
		db(__FILE__,__LINE__,"select * from ${moduleinstance}_items_bracers where item_id = '$itemid'");
		$item = dbr();
		if($item['cost'] > $character['gold'])
		{
			SystemMessage(MERCHANT_CHAR_NO_AFFORD);
		}
		dbn(__FILE__,__LINE__,"insert into ${gameinstance}_backpack (login_id, item_id, item_name, type, level, weight, cost) values ('$character[login_id]', '$item[item_id]', '$item[name]', '$item[type]', '$item[level]', '$item[weight]', '$item[cost]')");
		$char->Take_Gold($item['cost']);
	}

	function Purchase_Cloak($itemid) {
		global $moduleinstance, $gameinstance, $character, $char;
		db(__FILE__,__LINE__,"select * from ${moduleinstance}_items_cloaks where item_id = '$itemid'");
		$item = dbr();
		if($item['cost'] > $character['gold'])
		{
			SystemMessage(MERCHANT_CHAR_NO_AFFORD);
		}
		dbn(__FILE__,__LINE__,"insert into ${gameinstance}_backpack (login_id, item_id, item_name, type, level, weight, cost) values ('$character[login_id]', '$item[item_id]', '$item[name]', '$item[type]', '$item[level]', '$item[weight]', '$item[cost]')");
		$char->Take_Gold($item['cost']);
	}

	// functions to perform the act of selling items (from player to merchant)
	function Sell_Weapon($packid) {
		global $moduleinstance, $gameinstance, $character, $char;
		//Check to see if player has the item, then if it is equipped
		db(__FILE__,__LINE__,"select * from ${gameinstance}_backpack where login_id = '$character[login_id]' and pack_id = '$packid'");
		$item = dbr();
		if(($item['pack_id'] != $packid) || ($item['login_id'] != $character[login_id]))
		{
			SystemMessage(MERCHANT_CHAR_ITEM_NOT_EXIST);

	    } elseif($item['equipped'] == 1) 
		{
			SystemMessage(MERCHANT_CHAR_ITEM_EQUIPPED);
		}
		//Check to see if the item even exists
		db2(__FILE__,__LINE__,"select * from ${moduleinstance}_items_weapons where item_id = '$item[item_id]'");
		$itemexists = dbr2();
		if(empty($itemexists['item_id']))
		{
			SystemMessage(MERCHANT_INVALID_ITEM);
		}
		//Delete the item from the players backpack
		dbn(__FILE__,__LINE__,"delete from ${gameinstance}_backpack where (login_id = '$character[login_id]') && (pack_id = '$packid')");
		$percentdeduction = rand(15,25) * .01;
		$total = $item['cost'] - ($item['cost'] * $percentdeduction);
		$char->Give_Gold($total);
	}
	function Sell_Ring($packid) {
		global $moduleinstance, $gameinstance, $character, $char;
		//Check to see if player has the item, then if it is equipped
		db(__FILE__,__LINE__,"select * from ${gameinstance}_backpack where login_id = '$character[login_id]' and pack_id = '$packid'");
		$item = dbr();
		if(($item['pack_id'] != $packid) || ($item['login_id'] != $character[login_id]) )
		{
			SystemMessage(MERCHANT_CHAR_ITEM_NOT_EXIST);

	    } elseif($item['equipped'] == 1) 
		{
			SystemMessage(MERCHANT_CHAR_ITEM_EQUIPPED);
		}
		//Check to see if the item even exists
		db2(__FILE__,__LINE__,"select * from ${moduleinstance}_items_rings where item_id = '$item[item_id]'");
		$itemexists = dbr2();
		if(empty($itemexists['item_id']))
		{
			SystemMessage(MERCHANT_INVALID_ITEM);
		}
		//Delete the item from the players backpack
		dbn(__FILE__,__LINE__,"delete from ${gameinstance}_backpack where (login_id = '$character[login_id]') && (pack_id = '$packid')");
		$percentdeduction = rand(15,25) * .01;
		$total = $item['cost'] - ($item['cost'] * $percentdeduction);
		$char->Give_Gold($total);
	}
	function Sell_Bracer($packid) {
		global $moduleinstance, $gameinstance, $character, $char;
		//Check to see if player has the item, then if it is equipped
		db(__FILE__,__LINE__,"select * from ${gameinstance}_backpack where login_id = '$character[login_id]' and pack_id = '$packid'");
		$item = dbr();
		if(($item['pack_id'] != $packid) || ($item['login_id'] != $character[login_id]) )
		{
			SystemMessage(MERCHANT_CHAR_ITEM_NOT_EXIST);

	    } elseif($item['equipped'] == 1) 
		{
			SystemMessage(MERCHANT_CHAR_ITEM_EQUIPPED);
		}
		//Check to see if the item even exists
		db2(__FILE__,__LINE__,"select * from ${moduleinstance}_items_bracers where item_id = '$item[item_id]'");
		$itemexists = dbr2();
		if(empty($itemexists['item_id']))
		{
			SystemMessage(MERCHANT_INVALID_ITEM);
		}
		//Delete the item from the players backpack
		dbn(__FILE__,__LINE__,"delete from ${gameinstance}_backpack where (login_id = '$character[login_id]') && (pack_id = '$packid')");
		$percentdeduction = rand(15,25) * .01;
		$total = $item['cost'] - ($item['cost'] * $percentdeduction);
		$char->Give_Gold($total);
	}
	function Sell_Cloak($packid) {
		global $moduleinstance, $gameinstance, $character, $char;
		//Check to see if player has the item, then if it is equipped
		db(__FILE__,__LINE__,"select * from ${gameinstance}_backpack where login_id = '$character[login_id]' and pack_id = '$packid'");
		$item = dbr();
		if(($item['pack_id'] != $packid) || ($item['login_id'] != $character[login_id]) )
		{
			SystemMessage(MERCHANT_CHAR_ITEM_NOT_EXIST);

	    } elseif($item['equipped'] == 1) 
		{
			SystemMessage(MERCHANT_CHAR_ITEM_EQUIPPED);
		}
		//Check to see if the item even exists
		db2(__FILE__,__LINE__,"select * from ${moduleinstance}_items_cloaks where item_id = '$item[item_id]'");
		$itemexists = dbr2();
		if(empty($itemexists['item_id']))
		{
			SystemMessage(MERCHANT_INVALID_ITEM);
		}
		//Delete the item from the players backpack
		dbn(__FILE__,__LINE__,"delete from ${gameinstance}_backpack where (login_id = '$character[login_id]') && (pack_id = '$packid')");
		$percentdeduction = rand(15,25) * .01;
		$total = $item['cost'] - ($item['cost'] * $percentdeduction);
		$char->Give_Gold($total);
	}
	function Sell_Belt($packid) {
		global $moduleinstance, $gameinstance, $character, $char;
		//Check to see if player has the item, then if it is equipped
		db(__FILE__,__LINE__,"select * from ${gameinstance}_backpack where login_id = '$character[login_id]' and pack_id = '$packid'");
		$item = dbr();
		if(($item['pack_id'] != $packid) || ($item['login_id'] != $character[login_id]) )
		{
			SystemMessage(MERCHANT_CHAR_ITEM_NOT_EXIST);

	    } elseif($item['equipped'] == 1) 
		{
			SystemMessage(MERCHANT_CHAR_ITEM_EQUIPPED);
		}
		//Check to see if the item even exists
		db2(__FILE__,__LINE__,"select * from ${moduleinstance}_items_belts where item_id = '$item[item_id]'");
		$itemexists = dbr2();
		if(empty($itemexists['item_id']))
		{
			SystemMessage(MERCHANT_INVALID_ITEM);
		}
		//Delete the item from the players backpack
		dbn(__FILE__,__LINE__,"delete from ${gameinstance}_backpack where (login_id = '$character[login_id]') && (pack_id = '$packid')");
		$percentdeduction = rand(15,25) * .01;
		$total = $item['cost'] - ($item['cost'] * $percentdeduction);
		$char->Give_Gold($total);
	}


}

?>