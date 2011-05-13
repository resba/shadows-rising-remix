<?php
/*
//

File:				location.php
Objective:			manages display of locations, shops, navigation and encounters
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


// this only works on location page at the moment - eventually to add as a core.inc.php check
// test function only - for location page, will block links not present on the Menu List (i.e. Allowed Nav Links)
//ProgrammerMatt: Malfunctioning. Don't know anything about validation so I won't touch it.
//$nv->ValidateRequest();

require_once("includes/location.inc.php");


// generate links to other map points
//$ADODB_FETCH_MODE = 2; // will force return of only associative array

$map_point = array();



// this section detemines the North/East/South/West positions of other locations linked to from our current location
// There really is a use for all those (x,y) coordinate graphs we did in school for quadratic equations :)
// note that in images, the coordinate (0,0) is situated at top left of the full-map image.


db(__FILE__,__LINE__,"select nlink, elink, slink, wlink from ${gameinstance}_locations where mp_name = '" . $_SESSION['game']['mp_name'] . "' and loc_id = '$character[location]'");
$char_loc = dbr();

//print_r($character); echo("<br>");
//print_r($char_loc); echo("<br>");
//print_r($_SESSION); echo("<br>");
//exit;

if(!empty($char_loc['nlink'])) 
{
	$sr->assign("map_point_north", array("loc_id"=>$char_loc['nlink'], "loc_pos"=>"North"));
	$sr->assign("nlink_valid","true");
}
else 
{
	$sr->assign("map_point_north", array("loc_id"=>"", "loc_pos"=>""));
	$sr->assign("nlink_valid","false");
}
if(!empty($char_loc['elink'])) 
{
	$sr->assign("map_point_east", array("loc_id"=>$char_loc['elink'], "loc_pos"=>"East"));
	$sr->assign("elink_valid","true");
}
else 
{
	$sr->assign("map_point_east", array("loc_id"=>"", "loc_pos"=>""));
	$sr->assign("elink_valid","false");
}
if(!empty($char_loc['slink'])) 
{
	$sr->assign("map_point_south", array("loc_id"=>$char_loc['slink'], "loc_pos"=>"South"));
	$sr->assign("slink_valid","true");
}
else 
{
	$sr->assign("map_point_south", array("loc_id"=>"", "loc_pos"=>""));
	$sr->assign("slink_valid","false");
}
if(!empty($char_loc['wlink'])) 
{
	$sr->assign("map_point_west", array("loc_id"=>$char_loc['wlink'], "loc_pos"=>"West"));
	$sr->assign("wlink_valid","true");
}
else 
{
	$sr->assign("map_point_west", array("loc_id"=>"", "loc_pos"=>""));
	$sr->assign("wlink_valid","false");
}





// fetch any shops available, we will use this at EOF to build a set of navlinks to each Merchant
$shop_list = $loc->Fetch_Shops($character['location']);
$forum_list = $loc->Fetch_Forums($character['location']);


// generate the terrain map - 9 tiles for map

/*
Format:
|01|02|03|04|05|
|06|07|08|09|10|
|11|12|13|14|15|
*/

db(__FILE__,__LINE__,"select x_loc, y_loc from ${gameinstance}_locations where mp_name = '" . $_SESSION['game']['mp_name'] . "' and loc_id = '$character[location]'");
$this_tile = dbr();

$tile_1 = array(); 
// grabbing the tiles just involves offsetting the current x,y to determine the surrounding tiles
$tile_1['x_loc'] = $this_tile['x_loc'] - 2;
$tile_1['y_loc'] = $this_tile['y_loc'] - 1;
$tile_2 = array();
$tile_2['x_loc'] = $this_tile['x_loc'] - 1;
$tile_2['y_loc'] = $this_tile['y_loc'] - 1;
$tile_3 = array();
$tile_3['x_loc'] = $this_tile['x_loc'];
$tile_3['y_loc'] = $this_tile['y_loc'] - 1;
$tile_4 = array();
$tile_4['x_loc'] = $this_tile['x_loc'] + 1;
$tile_4['y_loc'] = $this_tile['y_loc'] - 1;
$tile_5 = array();
$tile_5['x_loc'] = $this_tile['x_loc'] + 2;
$tile_5['y_loc'] = $this_tile['y_loc'] - 1;
$tile_6 = array();
$tile_6['x_loc'] = $this_tile['x_loc'] - 2;
$tile_6['y_loc'] = $this_tile['y_loc'];
$tile_7 = array();
$tile_7['x_loc'] = $this_tile['x_loc'] - 1;
$tile_7['y_loc'] = $this_tile['y_loc'];
$tile_8 = array();
$tile_8['x_loc'] = $this_tile['x_loc'];
$tile_8['y_loc'] = $this_tile['y_loc'];
$tile_9 = array();
$tile_9['x_loc'] = $this_tile['x_loc'] + 1;
$tile_9['y_loc'] = $this_tile['y_loc'];
$tile_10 = array();
$tile_10['x_loc'] = $this_tile['x_loc'] + 2;
$tile_10['y_loc'] = $this_tile['y_loc'];
$tile_11 = array();
$tile_11['x_loc'] = $this_tile['x_loc'] - 2;
$tile_11['y_loc'] = $this_tile['y_loc'] + 1;
$tile_12 = array();
$tile_12['x_loc'] = $this_tile['x_loc'] - 1;
$tile_12['y_loc'] = $this_tile['y_loc'] + 1;
$tile_13 = array();
$tile_13['x_loc'] = $this_tile['x_loc'];
$tile_13['y_loc'] = $this_tile['y_loc'] + 1;
$tile_14 = array();
$tile_14['x_loc'] = $this_tile['x_loc'] + 1;
$tile_14['y_loc'] = $this_tile['y_loc'] + 1;
$tile_15 = array();
$tile_15['x_loc'] = $this_tile['x_loc'] + 2;
$tile_15['y_loc'] = $this_tile['y_loc'] + 1;


$ct = 0;
$map_img = array();
$map_array = array($tile_1, $tile_2, $tile_3, $tile_4, $tile_5, $tile_6, $tile_7, $tile_8, $tile_9, $tile_10, $tile_11, $tile_12, $tile_12, $tile_14, $tile_15);

foreach($map_array as $key=>$val) 
{
	$ct++;
	db(__FILE__,__LINE__,"select terrain_img from ${gameinstance}_locations where x_loc = '$val[x_loc]' and y_loc = '$val[y_loc]' and mp_name = '" . $_SESSION['game']['mp_name'] . "'");
	$this_img = dbr();
	if(empty($this_img)) 
	{
		$map_img[$ct] = "selected.gif";
	}
	else 
	{
		$map_img[$ct] = $this_img['terrain_img'];	
	}
}


db(__FILE__,__LINE__,"select nlink, elink, slink, wlink from ${gameinstance}_locations where mp_name = '" . $_SESSION['game']['mp_name'] . "' and loc_id = '$character[location]'");
$char_loc = dbr();

if(!empty($char_loc['nlink'])) 
{
	$sr->assign("map_point_north", array("loc_id"=>$char_loc['nlink'], "loc_pos"=>"North"));
}
else 
{
	$sr->assign("map_point_north", array("loc_id"=>"", "loc_pos"=>""));
}
if(!empty($char_loc['elink'])) 
{
	$sr->assign("map_point_east", array("loc_id"=>$char_loc['elink'], "loc_pos"=>"East"));
}
else 
{
	$sr->assign("map_point_east", array("loc_id"=>"", "loc_pos"=>""));
}
if(!empty($char_loc['slink'])) 
{
	$sr->assign("map_point_south", array("loc_id"=>$char_loc['slink'], "loc_pos"=>"South"));
}
else 
{
	$sr->assign("map_point_south", array("loc_id"=>"", "loc_pos"=>""));
}
if(!empty($char_loc['wlink'])) 
{
	$sr->assign("map_point_west", array("loc_id"=>$char_loc['wlink'], "loc_pos"=>"West"));
}
else 
{
	$sr->assign("map_point_west", array("loc_id"=>"", "loc_pos"=>""));
}



$sr->assign("map_img", $map_img);


// fetch any shops available, we will use this at EOF to build a set of navlinks to each Merchant
$shop_list = $loc->Fetch_Shops($character['location']);
$forum_list = $loc->Fetch_Forums($character['location']);


// generate the terrain map - 15 tiles for map

/*
Format:
|01|02|03|04|05|
|06|07|08|09|10|
|11|12|13|14|15|
*/

db(__FILE__,__LINE__,"select x_loc, y_loc from ${gameinstance}_locations where mp_name = '" . $_SESSION['game']['mp_name'] . "' and loc_id = '$character[location]'");
$this_tile = dbr();

$tile_1 = array(); 
// grabbing the tiles just involves offsetting the current x,y to determine the surrounding tiles
$tile_1['x_loc'] = $this_tile['x_loc'] - 2;
$tile_1['y_loc'] = $this_tile['y_loc'] - 1;
$tile_2 = array();
$tile_2['x_loc'] = $this_tile['x_loc'] - 1;
$tile_2['y_loc'] = $this_tile['y_loc'] - 1;
$tile_3 = array();
$tile_3['x_loc'] = $this_tile['x_loc'];
$tile_3['y_loc'] = $this_tile['y_loc'] - 1;
$tile_4 = array();
$tile_4['x_loc'] = $this_tile['x_loc'] + 1;
$tile_4['y_loc'] = $this_tile['y_loc'] - 1;
$tile_5 = array();
$tile_5['x_loc'] = $this_tile['x_loc'] + 2;
$tile_5['y_loc'] = $this_tile['y_loc'] - 1;
$tile_6 = array();
$tile_6['x_loc'] = $this_tile['x_loc'] - 2;
$tile_6['y_loc'] = $this_tile['y_loc'];
$tile_7 = array();
$tile_7['x_loc'] = $this_tile['x_loc'] - 1;
$tile_7['y_loc'] = $this_tile['y_loc'];
$tile_8 = array();
$tile_8['x_loc'] = $this_tile['x_loc'];
$tile_8['y_loc'] = $this_tile['y_loc'];
$tile_9 = array();
$tile_9['x_loc'] = $this_tile['x_loc'] + 1;
$tile_9['y_loc'] = $this_tile['y_loc'];
$tile_10 = array();
$tile_10['x_loc'] = $this_tile['x_loc'] + 2;
$tile_10['y_loc'] = $this_tile['y_loc'];
$tile_11 = array();
$tile_11['x_loc'] = $this_tile['x_loc'] - 2;
$tile_11['y_loc'] = $this_tile['y_loc'] + 1;
$tile_12 = array();
$tile_12['x_loc'] = $this_tile['x_loc'] - 1;
$tile_12['y_loc'] = $this_tile['y_loc'] + 1;
$tile_13 = array();
$tile_13['x_loc'] = $this_tile['x_loc'];
$tile_13['y_loc'] = $this_tile['y_loc'] + 1;
$tile_14 = array();
$tile_14['x_loc'] = $this_tile['x_loc'] + 1;
$tile_14['y_loc'] = $this_tile['y_loc'] + 1;
$tile_15 = array();
$tile_15['x_loc'] = $this_tile['x_loc'] + 2;
$tile_15['y_loc'] = $this_tile['y_loc'] + 1;


$ct = 0;
$map_img = array();
$map_array = array($tile_1, $tile_2, $tile_3, $tile_4, $tile_5, $tile_6, $tile_7, $tile_8, $tile_9, $tile_10, $tile_11, $tile_12, $tile_12, $tile_14, $tile_15);

foreach($map_array as $key=>$val) 
{
	$ct++;
	db(__FILE__,__LINE__,"select terrain_img from ${gameinstance}_locations where x_loc = '$val[x_loc]' and y_loc = '$val[y_loc]' and mp_name = '" . $_SESSION['game']['mp_name'] . "'");
	$this_img = dbr();
	if(empty($this_img)) 
	{
		$map_img[$ct] = "selected.gif";
	}
	else 
	{
		$map_img[$ct] = $this_img['terrain_img'];	
	}
}

$sr->assign("map_img", $map_img);



// NAVLINKS!!!
// Generate the page navigation menu here - links displayed in order of defined SECTION then URL
$nv->navlink("left", "Character", "Logout", "logout.php");
$nv->navlink("left", "Character", "Backpack", "backpack.php?op=show");
$nv->navlink("left", "Location", "Refresh Page", "location.php");
if(!empty($shop_list))
{
	foreach($shop_list as $key=>$values)
	{
		$nv->navlink("left", "Facilities", $values['name'], "merchant.php?id=" . $values['shop_id']);
	}
}
if(!empty($forum_list)){
	foreach($forum_list as $key=>$value){
		$nv->navlink("left", "Forums", $value['forum_name'], "../forum/viewforum.php?ingame=1&f=".$value['forum_id']);
	}
}

// at this point all our navlinks have been added to the approved navs list - so what about other page
// links, not on the menu, that should nonetheless be approved? These should be very rare - mainly any
// manual url we add to the body of the page directed to a game page.
// NOTE: links not directed to SR CORE do not need approval!

// with approvelink() we only pass the page name, and any GET data to be passed
// in location.php, this will mean the links to other locations

if(!empty($char_loc['nlink']))
{
	$nv->navlink("left", "Travel", "North", "location.php?loc=" . $char_loc['nlink']);
}
if(!empty($char_loc['elink']))
{
	$nv->navlink("left", "Travel", "East", "location.php?loc=" . $char_loc['elink']);
}
if(!empty($char_loc['slink']))
{
	$nv->navlink("left", "Travel", "South", "location.php?loc=" . $char_loc['slink']);
}
if(!empty($char_loc['wlink']))
{
	$nv->navlink("left", "Travel", "West", "location.php?loc=" . $char_loc['wlink']);
}

// add link to control panel
if($_SESSION['permissions']['_userlevel'] < 4) 
{
	$nv->navlink("left", "Admin", "Control Panel", "cpanel.php");
}

// can probably also call these after an in-page link is defined - save listing them all here


// approve additional link to Combat a Giant Kangaroo (a combat test linked from location pages)
$nv->approvelink("combat.php?cid=1");
$nv->approvelink("location.php?skilltest=1");


// an overlay across $sr->display(), allows some additional work such as storing page info
// enables greater control over page access to players - and is required when using the NAVLINK menu system
$sr->DisplayPage("location.tpl.html");

?>