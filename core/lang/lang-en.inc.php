<?php
/*
// 

File:				lang-en.inc.php
Objective:			store translatable text used directly within the code, e.g. error messages, 
					debug hints, etc.
Version:			SR-RPG (Game Engine) 0.0.3
Author:				Maugrim The Reaper
Edited by:			Myrkul
Date Committed:		15 November 2004
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

/*
CORE/ITEM_EQUIP.PHP
*/
define("ITEM_ALL_HANDS_EQUIPPED",
"At the present time both of your character's hands appear to be equipped with two weapons, a weapon and shield, or perhaps a single double/two-handed weapon. You cannot equip additional weapons until you free at least one hand.");
define("ITEM_ALL_RINGS_EQUIPPED",
"At the present time both of your character's ring-fingers appear to be equipped with rings. You cannot equip additional rings until you free at least one ring-finger.");
if(!empty($_GET['type'])) {
	define("ITEM_ALREADY_EQUIPPED",
	"At the present time you already have an item of type &quot;" . $_GET['type'] . "&quot; equipped for your character. You cannot equip additional items of this type until you unequip the currently equipped item of this type.");
} else {
	define("ITEM_ALREADY_EQUIPPED",
	"At the present time you already have an item of this type equipped for your character. You cannot equip additional items of this type until you unequip the currently equipped item of this type.");
}
define("ITEM_RIGHT_HAND_EQUIPPED",
"Your right is currently equipped with a weapon. Because of this you are unable to equip any double or two-handed weapons. If you wish to equip this weapon, you must first unequip any other weapon your right hand is currently holding.");
define("ITEM_EQUIPPED",
"The following item has been equipped for your character:");
define("ITEM_UNEQUIPPED",
"The item in the following position has been unequipped:");

/*
CORE/CPANEL/MAPGEN.PHP
*/
define("MAPGEN_INVALID_DIMENSIONS",
"One or both of the map dimensions you specified are invalid! Please go back and try again.");
define("MAPGEN_INVALID_MAPNAME",
"The map name has either not been set, or is less than 4 characters in length. Please return and try again.");
define("MAPGEN_MAPNAME_ALREADY_USED",
"The map name you specified is already in use, please return and choose another.");
define("MAPGEN_MAPNAME_NOT_FOUND",
"An unknown Map name was passed - ");

/*
CORE/CPANEL/MAPSET.PHP
*/
define("MAPSET_SURE_NOT_SET",
"It does not appear that you confirmed your choice. Please return to <a href=\"mapset.php\">MapSet</a> and be sure to confirm your choice before submitting the form.");
define("MAP_IS_SET",
"The chosen map has been set to be the current game's default.");

/*
CORE/MERCHANT.PHP
*/
define("ITEMS_PURCHASED",
"The items you chose have been purchased. Thanks for using the Shadows Rising Merchant Services!");
define("ITEMS_SOLD",
"The items you chose have been sold. Thanks for using the Shadows Rising Merchant Services!");

/*
CORE/CHARACTER_CREATE.PHP
*/
define("CHAR_ALREADY_EXISTS",
"This character already exists. You will need to create a different character, or delete the character already associated with your user account.");

/*
CORE/CLASSES/CHARACTER.CLASS.PHP
*/
define("CHAR_NOT_ENOUGH_GOLD",
"A request to reduce this character's money has failed. This may be due to the character having insufficient money, or invalid data being passed to a function controlling money. Please report this incident to the local Administrator.");
define("CHAR_CANNOT_GIVE_GOLD",
"A request to increase this character's money has failed. This may be due to invalid data being passed to a function controlling money. Please report this incident to the local Administrator.");
define("CHAR_BACKPACK_EMPTY",
"Your character has no items in their backpack, and so there is nothing to view.");
define("CHAR_INVALID_NAME",
"Character Name has invalid symbols or characters, or may be less than 5 characters in length!");
define("CHAR_INVALID_SEX",
"Characters must be either Male or Female - the inputted option is neither!");
define("CHAR_INVALID_RACE",
"You did not choose a valid race for your character!");
define("CHAR_INVALID_CLASS",
"You did not choose a valid Class for your character!");

/*
CORE/CLASSES/LOCATION.CLASS.PHP
*/
define("LOC_INVALID_LOCATION_VAR",
"An invalid variable has been passed as part of the URI for Travelling between Map Points. Please select a valid URI from the Travel menu on the Location page.");
define("LOC_CHAR_ALREADY_HERE",
"An invalid variable has been passed as part of the URI for Travelling between Map Points. You are unable to Travel to the selected map point as your Character is already there. This may have resulted from refreshing a page, or double clicking a Travel URI.");
define("LOC_INVALID_LOCATION",
"The selected URI (clicked or typed into browser) does not lead to a Map Point linked to your Character's current location. As such you cannot Travel to the chosen Location and must use a valid URI from the Location page.");

/*
CORE/CLASSES/MERCHANT.CLASS.PHP
*/
define("MERCHANT_CHAR_NO_AFFORD",
"Sorry, but you cannot afford one or more of these items!");
define("MERCHANT_CHAR_ITEM_NOT_EXIST",
"You do not possess the item you are attempting to sell!");
define("MERCHANT_INVALID_ITEM",
"The item in question does not exist.");
define("MERCHANT_CHAR_ITEM_EQUIPPED",
"The item you are trying to sell is equipped. You cannot sell equipped items. Unequip it and try again.");


/*
CORE/CPANEL/CPANEL.INC.PHP
*/
define("CPANEL_INSUFFICIENT_PERMISSIONS",
"You do not have sufficient user permissions to access the Control Panel for the Shadows Rising RPG Game Engine");

/*
CORE/INCLUDES/SECURITY.INC.PHP
*/
define("SECURITY_SQL_INJECTION",
"Sorry, this server does not accept SQL Injections...");
define("SECURITY_XSS_GET",
"Invalid HTML detected in url!");
define("SECURITY_XSS_POST",
"Invalid HTML detected in form data!");
define("SECURITY_POSSIBLE_DOS",
"You trying to bring my site down?");
define("SECURITY_EMAIL_HARVESTER",
"Harvesters are not welcome here...");
define("SECURITY_OPEN_PROXY",
"Sorry but the Administrator has disabled access to Open Proxies which may be used to mask/misdirect the IP of hackers/scriptkiddies.");

/*
GENERIC EOF BAD GET/POST REQUEST
*/
define("EOF_BAD_REQUEST",
"Error! No data has been passed to this file, or false/doped/corrupt data was passed instead. Please follow all links directly from valid urls. Please note that altering the url to files, may be interpreted as an attempt to cheat - an occurance that may at the Administrator(s) discretion result in the banning of your Account and/or deletion of your Character.<br /><br />On the other hand this may be the result of a bug in the Game Engine or an associated Module. In this case you should report the bug either to the local Administrator, or the Forums at the <a href=\"http://www.shadowsrising.net\">Shadows Rising RPG</a> website.");

?>