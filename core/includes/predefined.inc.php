<?php
/*
// 

File:				constants.inc.php
Objective:			List of any pre-defined constants/arrays used by a game module
Version:			SR-RPG (Game Engine) 0.0.4
Author:				Maugrim The Reaper
Edited by:			Maugrim The Reaper
Date Committed:		18 October 2004		
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
DEV: This file should form part of a Game Module - it's essentially holding all module specific data, such as possible item positions, types of die in use, and potentially a lot more configuration data for a module.
*/

// dieroll function names for use in the DieRoll class method rolldie()
define("d6", "d6");
define("d8", "d8");
define("d10", "d10");
define("d12", "d12");
define("d20", "d20");



$ARRAYS = array();

// array of all item positions possible

$ARRAYS['item_positions'] = array(
	"head",
	"weaponr",
	"weaponl",
	"ringr",
	"ringl",
	"armour",
	"bracer",
	"belt",
	"cloak"
);
$ARRAYS['attributes'] = array(
	"str",
	"dex",
	"con",
	"intel",
	"wis",
	"cha"
);


?>