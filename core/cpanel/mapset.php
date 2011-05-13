<?php
/*
// 

File:				mapset.php
Objective:			allows admins to set any terrain map as the game map.
Version:			SR-RPG (Game Engine) 0.0.5
Author:				Maugrim The Reaper
Edited by:			Maugrim The Reaper
Date Committed:		11 December 2004		
Last Date Edited:	n.a.

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

require_once("cpanel.inc.php");


// approve a few basic links so we don't get stuck here!!!
$nv->navlink("left", "Maps", "MapGen", "mapgen.php");
$nv->navlink("left", "Maps", "MapSet", "mapset.php");
$nv->navlink("left", "Admin", "Control Panel", "$CONFIG[url_prefix]/core/cpanel.php", true);
$nv->navlink("left", "Game", "Return", "$CONFIG[url_prefix]/core/location.php", true);


// this only works on location page at the moment - eventually to add as a core.inc.php check
// test function only - for location page, will block links not present on the Menu List (i.e. Allowed Nav Links)
//$nv->ValidateRequest();



if(empty($_POST['op'])) 
{
	// display menu for mapset if no op value set
	$allmaps = array();
	db(__FILE__,__LINE__,"select * from ${moduleinstance}_maps order by name asc");
	while($maps = dbr()) 
	{
		array_push($allmaps, $maps);
	}
	$sr->assign("allmaps", $allmaps);
	$sr->DisplayPage("mapset_menu.tpl.html");
	exit();
}
elseif($_POST['op'] == "setmap") 
{
	if(!empty($_POST['mapset_sure']) && is_string($_POST['mapset_sure']) && $_POST['mapset_sure'] == "yes") 
	{
		if(!empty($_POST['mpname']) && is_string($_POST['mpname'])) 
		{
			dbn(__FILE__,__LINE__,"truncate {$gameinstance}_locations");
			dbn(__FILE__,__LINE__,"insert into {$gameinstance}_locations (mp_name, x_loc, y_loc, terrain_img, nlink, elink, slink, wlink, linked, gamestart) select mp_name, x_loc, y_loc, terrain_img, nlink, elink, slink, wlink, linked, gamestart from {$moduleinstance}_maptiles where mp_name = '{$_POST[mpname]}'");
			db(__FILE__,__LINE__,"select loc_id from {$gameinstance}_locations where gamestart = 1 limit 1");
			$ginfo = dbr();
					// workaround to set a default gamestart
					if(empty($ginfo)) 
					{
						db(__FILE__,__LINE__,"select loc_id from {$gameinstance}_locations order by loc_id asc limit 1");
						$winfo = dbr();
						dbn(__FILE__,__LINE__,"update {$gameinstance}_locations set gamestart = 1 where loc_id = {$winfo[loc_id]}");
						$ginfo = array("loc_id"=>$winfo['loc_id']);
						dbn(__FILE__,__LINE__,"update {$gameinstance}_merchants set location = {$winfo['loc_id']} where shop_id = 1");
					}
			dbn(__FILE__,__LINE__,"update {$gameinstance}_characters set location = '$ginfo[loc_id]'");
			dbn(__FILE__,__LINE__,"update srbase_game_index set mp_name = '" . $_POST['mpname'] . "' where game_id = '" . $_SESSION['game']['game_id'] . "'");
			$_SESSION['game']['mp_name'] = $_POST['mpname'];
			SystemMessage(MAP_IS_SET);
		} else { die("bad mpname sent by post"); }
	}
	else 
	{
		SystemMessage(MAPSET_SURE_NOT_SET);
	}
}









// If nothing sticks, someone passed false data to this file!
SystemMessage(EOF_BAD_REQUEST);

?>