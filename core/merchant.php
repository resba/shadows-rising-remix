<?php
/*
// 

File:				merchant.php
Objective:			Display a merchant and manage associated selling/buying and item data 
Version:			SR-RPG (Game Engine) 0.0.3
Author:				Maugrim The Reaper
Edited by:			Myrkul
Date Committed:		2 August 2004		
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

require_once("core.inc.php");

//remove once added to security.inc.php
$nv->ValidateRequest();

require_once("classes/merchant.class.php");

$mer = new Merchant();

if(!empty($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] >= 1) 
{
	// retrieve the merchant being visited from the session
	$merchant = $_SESSION['merchant'][$_GET['id']];

	$mer->Fetch_Items($merchant, $character['level']);

	// delete this session data now it's used (i.e. set to an empty array)
	$_SESSION['merchant'] = array();

	// NAVLINKS!!!
	// Generate the page navigation menu here - links displayed in order of defined SECTION then URL
	$nv->navlink("left", "Character", "Logout", "logout.php");
	$nv->navlink("left", "Character", "Backpack", "backpack.php?op=show");
	$nv->navlink("left", "Location", "Return to Location", "location.php");
	// item purchase links were approved during $mer->Fetch_Items()
	$sr->DisplayPage("merchant.tpl.html");
	exit();
}

//Player is purchasing items
if(!empty($_GET['purchase']) && is_numeric($_GET['purchase']) && $_GET['purchase'] == 1) 
{
	if(!empty($_GET['purchase_weapon']) && is_numeric($_GET['purchase_weapon']) && $_GET['purchase_weapon'] > 0) 
	{
		$mer->Purchase_Weapon($_GET['purchase_weapon']);
	}
	elseif(!empty($_GET['purchase_ring']) && is_numeric($_GET['purchase_ring']) && $_GET['purchase_ring'] > 0) 
	{
		$mer->Purchase_Ring($_GET['purchase_ring']);
	}
	elseif(!empty($_GET['purchase_belt']) && is_numeric($_GET['purchase_belt']) && $_GET['purchase_belt'] > 0) 
	{
		$mer->Purchase_Belt($_GET['purchase_belt']);
	}
	elseif(!empty($_GET['purchase_bracer']) && is_numeric($_GET['purchase_bracer']) && $_GET['purchase_bracer'] > 0) 
	{
		$mer->Purchase_Bracer($_GET['purchase_bracer']);
	}
	elseif(!empty($_GET['purchase_cloak']) && is_numeric($_GET['purchase_cloak']) && $_GET['purchase_cloak'] > 0) 
	{
		$mer->Purchase_Cloak($_GET['purchase_cloak']);
	}
	elseif(!empty($_GET['purchase_drug']) && is_numeric($_GET['purchase_drug']) && $_GET['purchase_drug'] > 0) 
	{
		$mer->Purchase_Drug($_GET['purchase_drug']);
	}
	else 
	{
		SystemMessage(EOF_BAD_REQUEST);
	}
	
	// reload character data to update for changes
	$character = $sr->Reload_Character();

	// show system message of purchase result
	SystemMessage(ITEMS_PURCHASED);
}

//Player is selling items
if(!empty($_GET['sell']) && is_numeric($_GET['sell']) && $_GET['sell'] == 1) 
{
	if(!empty($_GET['sell_weapon']) && is_numeric($_GET['sell_weapon']) && $_GET['sell_weapon'] > 0) 
	{
		$mer->Sell_Weapon($_GET['sell_weapon']);
	}
	elseif(!empty($_GET['sell_ring']) && is_numeric($_GET['sell_ring']) && $_GET['sell_ring'] > 0) 
	{
		$mer->Sell_Ring($_GET['sell_ring']);
	}
	elseif(!empty($_GET['sell_belt']) && is_numeric($_GET['sell_belt']) && $_GET['sell_belt'] > 0) 
	{
		$mer->Sell_Belt($_GET['sell_belt']);
	}
	elseif(!empty($_GET['sell_bracer']) && is_numeric($_GET['sell_bracer']) && $_GET['sell_bracer'] > 0) 
	{
		$mer->Sell_Bracer($_GET['sell_bracer']);
	}
	elseif(!empty($_GET['sell_cloak']) && is_numeric($_GET['sell_cloak']) && $_GET['sell_cloak'] > 0) 
	{
		$mer->Sell_Cloak($_GET['sell_cloak']);
	}
	else 
	{
		SystemMessage(EOF_BAD_REQUEST);
	}
	
	// reload character data to update for changes
	$character = $sr->Reload_Character();

	// show system message of purchase result
	SystemMessage(ITEMS_SOLD);
}


// If nothing sticks, someone passed false data to this file!
SystemMessage(EOF_BAD_REQUEST);


?>