<?php
/*
// 

File:				cpanel.php
Objective:			Display main cpanel page
Version:			SR-RPG (Game Engine) 0.0.3
Author:				Maugrim The Reaper
Edited by:			Maugrim The Reaper
Date Committed:		13 August 2004		
Last Date Edited:	10 December 2004

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

$nv->navlink("left", "Maps", "MapGen", "cpanel/mapgen.php", true);
$nv->navlink("left", "Maps", "MapSet", "cpanel/mapset.php", true);
$nv->navlink("left", "Admin", "Control Panel", "cpanel.php");
$nv->navlink("left", "Game", "Return", "location.php");


$sr->DisplayPage("cpanel.tpl.html");


/*
insert into srbase_srmodule_srrpg_locations (mp_name, x_loc, y_loc, terrain_img, nlink, elink, slink, wlink, linked, gamestart) select mp_name, x_loc, y_loc, terrain_img, nlink, elink, slink, wlink, linked, gamestart from srbase_srmodule_maptiles where mp_name = 'default';
*/

?>