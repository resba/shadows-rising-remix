<?php
/*
// 

File:				Game_Index Module: index.php
Objective:			so far just a simple game listing - lot more to be done in future 
Version:			Q-CMS 0.2
Author:				Maugrim The Reaper
Edited by:			Maugrim The Reaper
Date Committed:		6 August 2004
Last Date Edited:	21 October 2004

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

// at least one GET var (the dir value sent to module.php) is expected, if not maybe someone tried
// to access the module directly, without using the proper url
if(empty($_GET) && empty($_POST)) 
{
	$M_OUTPUT .= "You cannot access Modules directly - please use a valid url";
}


// first grab the details of all games
// at present we only support one SR game
db(__FILE__,__LINE__,"select * from srbase_game_index where game_id = 1");
$game = dbr();

// DEV: this listing will capture all registered SR and QS games eventually


if(empty($_GET['op']) && empty($_POST['op'])) 
{
	// no op value, so we display the default page
	require_once("includes/game_listing.php");
}
elseif($_GET['op'] == "join") 
{
	// show join game confirmation
	require_once("includes/game_join.php");
}
elseif($_POST['op'] == "do_join") 
{
	// actually commit the join request to database
	require_once("includes/game_dojoin.php");
}
elseif($_GET['op'] == "enter") 
{
	// enter a game;
	require_once("includes/game_enter.php");
}
else 
{
	// here op was set, but contained no valid data
	$M_OUTPUT .= "Module Error: No valid data received";
}


?>