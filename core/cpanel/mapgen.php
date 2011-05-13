<?php
/*
// 

File:				mapgen.php
Objective:			starting point for users to design and generate terrain maps 
Version:			SR-RPG (Game Engine) 0.0.5
Author:				Maugrim The Reaper
Edited by:			Maugrim The Reaper
Date Committed:		29 October 2004		
Last Date Edited:	30 October 2004

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
$nv->navlink("left", "Admin", "Control Panel", "../cpanel.php", true);
$nv->navlink("left", "Game", "Return", "../location.php", true);


// this only works on location page at the moment - eventually to add as a core.inc.php check
// test function only - for location page, will block links not present on the Menu List (i.e. Allowed Nav Links)
//$nv->ValidateRequest();



if(empty($_GET['op']) && empty($_POST['op'])) 
{
	// display menu for mapgen if no op value set
	$allmaps = array();
	db(__FILE__,__LINE__,"select * from ${moduleinstance}_maps order by name asc");
	while($maps = dbr()) 
	{
		array_push($allmaps, $maps);
	}
	$sr->assign("allmaps", $allmaps);
	$sr->DisplayPage("mapgen_menu.tpl.html");
	exit();
}
elseif($_GET['op'] == "newmap") 
{
	$sr->DisplayPage("mapgen_newmap_details.tpl.html");
}
elseif($_POST['op'] == "save_details") 
{
	if((empty($_POST['mp_height']) || !is_numeric($_POST['mp_height'])) || (empty($_POST['mp_width']) || !is_numeric($_POST['mp_width']))) 
	{
		SystemMessage(MAPGEN_INVALID_DIMENSIONS);
	}
	elseif(empty($_POST['mp_name']) || strlen($_POST['mp_name']) < 4) 
	{
		SystemMessage(MAPGEN_INVALID_MAPNAME);
	}
	db(__FILE__,__LINE__,"select name from ${moduleinstance}_maps where name = '$_POST[mp_name]'");
	$unique_name = dbr();
	if(!empty($unique_name)) 
	{
		SystemMessage(MAPGEN_MAPNAME_ALREADY_USED);
	}
	// all checks passed, save the data to a new map on DB - maps are deemed Module specific
	$num_tiles = $_POST['mp_height'] * $_POST['mp_width']; //i.e. area of box defined by dimensions
	dbn(__FILE__,__LINE__,"insert into ${moduleinstance}_maps (name, height, width, num_tiles) values ('$_POST[mp_name]', '$_POST[mp_height]', '$_POST[mp_width]', '$num_tiles')");
	
	// save data to user SESSION - use to grab this map details in later stages.
	$_SESSION['mapgen'] = array("name"=>$_POST['mp_name'], "height"=>$_POST['mp_height'], "width"=>$_POST['mp_width'], "num_tiles"=>$num_tiles);

	$tile_table_output = "";

	// now generate a simple array of the map points, used to construct a starting map grid, and store to DB
	// this is an extremely simple process...
	for($i=1; $i<=$_POST['mp_height']; $i++) 
	{
		$tile_table_output .= "<tr>\n";
		for($j=1; $j<=$_POST['mp_width']; $j++) 
		{
			$this_tile_x = $j; // $j denotes x (column) coordinate on a grid of all tiles
			$this_tile_y = $i; // $i denotes y (row) coordinate on a grid of all tiles
			// save the coordinates to a new set of tile-entries on srbase_srmodule_maptiles, using
			// the map name as a unique identified for each entry (so we can segregate maps even using one table)
			dbn(__FILE__,__LINE__,"insert into ${moduleinstance}_maptiles (mp_name, x_loc, y_loc) values ('$_POST[mp_name]', '$this_tile_x', '$this_tile_y')");

			// NOTE: this cannot be done effectively using templates - so we define the tile-space table cell here

			// for javascript modification - tile_j_i refers to the tile <input>, img_j_i to the tile <img>
			// we can use javascript to update the values of each attribute of these tags - see merchant.php and
			// associated templates for an example.
				$tile_id = "tile_" . $j . "_" . $i;
				$img_id = "img_" . $j . "_" . $i;
			$tile_table_output .= "<td><img src=\"" . $CONFIG['url_prefix'] . "/core/images/terrain/no_terrain.gif\" alt=\"No Terrain\" id=\"$img_id\" onclick=\"javascript:changeTerrainImage('$img_id', 'no_terrain.gif')\" /><input type=\"hidden\" name=\"$tile_id\" value=\"\" id=\"$tile_id\" /></td>\n";
		}
		$tile_table_output .= "</tr>\n";
	}

	// link all tiles to each other to construct valid paths a user may take across terrain
	db(__FILE__,__LINE__,"select * from ${moduleinstance}_maptiles where mp_name = '$_POST[mp_name]'");
	while($link_maps = dbr()) 
	{
		// clear all arrays
		$nlink = array();
		$elink = array();
		$slink = array();
		$wlink = array();

		// grab adjacent tile coordinates for north, east, south and west
		// remove any adjacent tiles which obviously do not exist within our range of tile-positions

		// these are offset tile coordinates where x/y position is one more or less
		// the other coordinate is identical to the current tile
		$nlink['y'] = $link_maps['y_loc'] - 1;
		$elink['x'] = $link_maps['x_loc'] + 1;
		$slink['y'] = $link_maps['y_loc'] + 1;
		$wlink['x'] = $link_maps['x_loc'] - 1;

		// invalid position checks
		if($nlink['y'] <= 0 || $nlink['y'] > $_POST['mp_height']) // Y(height) is 0 or higher than actual mp_height
		{
			$nlink = array();
		}
		if($elink['x'] <= 0 || $nlink['x'] > $_POST['mp_width']) // X(width) is 0 or higher than actual mp_width
		{
			$elink = array();
		}
		if($slink['y'] <= 0 || $slink['y'] > $_POST['mp_height']) // Y(height) is 0 or higher than actual mp_height
		{
			$slink = array();
		}
		if($wlink['x'] <= 0 || $nlink['x'] > $_POST['mp_width']) // X(width) is 0 or higher than actual mp_width
		{
			$wlink = array();
		}

		// write only those pathways/links to DB where array was not invalidated and reset
		$sql_query = "update {$moduleinstance}_maptiles set ";
		if(!empty($nlink)) 
		{
			$sql_query .= "nlink = '" . $link_maps['x_loc'] . "_" . $nlink['y'] . "', ";
		}
		if(!empty($elink)) 
		{
			$sql_query .= "elink = '" . $elink['x'] . "_" . $link_maps['y_loc'] . "', ";
		}
		if(!empty($slink)) 
		{
			$sql_query .= "slink = '" . $link_maps['x_loc'] . "_" . $slink['y'] . "', ";
		}
		if(!empty($wlink)) 
		{
			$sql_query .= "wlink = '" . $wlink['x'] . "_" . $link_maps['y_loc'] . "', ";
		}
		$sql_query .= "linked = 1 where mp_name = '$_POST[mp_name]' and x_loc = '$link_maps[x_loc]' and y_loc = '$link_maps[y_loc]'";
		dbn(__FILE__,__LINE__,$sql_query);
	}

	$sr->assign("mp_name", $_POST['mp_name']);
	$sr->assign("mp_height", $_POST['mp_height']);
	$sr->assign("mp_width", $_POST['mp_width']);
	$sr->assign("mp_num_tiles", $num_tiles);
	$sr->assign("tile_table_output", $tile_table_output);
	
	$sr->DisplayPage("mapgen_newmap_editpage.tpl.html");
	exit();

}
elseif($_GET['op'] == "edit_savedmap" && !empty($_GET['name'])) 
{
	db(__FILE__,__LINE__,"select * from ${moduleinstance}_maps where name = '$_GET[name]'");
	$ed_map = dbr();
	
	$sr->assign("mp_name", $ed_map['name']);
	$sr->assign("mp_height", $ed_map['height']);
	$sr->assign("mp_width", $ed_map['width']);
	$sr->assign("mp_num_tiles", $ed_map['num_tiles']);

	$alltiles = array();
	$this_tile_output = "";

	// the order of x_loc and y_loc is important
	db(__FILE__,__LINE__,"select * from ${moduleinstance}_maptiles where mp_name = '$_GET[name]' order by x_loc asc, y_loc asc");
	while($mtiles = dbr()) 
	{
		// here we do a little re-arranging so we can reference an array of all tile using their coordinates
		$array_name = $mtiles["x_loc"] . "_" . $mtiles['y_loc'];
		$alltiles[$array_name] = $mtiles;
	}

	// now re-construct the original table (using same process as previously
	for($i=1; $i<=$ed_map['height']; $i++) 
	{
		$tile_table_output .= "<tr>\n";
		for($j=1; $j<=$ed_map['width']; $j++) 
		{
			$this_tile_x = $j; // $j denotes x (column) coordinate on a grid of all tiles
			$this_tile_y = $i; // $i denotes y (row) coordinate on a grid of all tiles

			$this_array_ref = $this_tile_x . "_" . $this_tile_y;
				$this_tile = $alltiles[$this_array_ref];

				$tile_id = $j . "_" . $i;
				$img_id = "img_" . $j . "_" . $i;
				$div_id = "div_" . $j . "_" . $i;
			$tile_table_output .= "<td><img src=\"" . $CONFIG['url_prefix'] . "/core/images/terrain/" . $this_tile['terrain_img'] . "\" alt=\"" . $this_tile['terrain_img'] . "\" id=\"$img_id\" onclick=\"javascript:changeTerrainImage('$img_id', '" . $this_tile['terrain_img'] . "', '$div_id', '$tile_id')\" /><div id=\"$div_id\" style=\"display: inline;\"></div></td>\n";
		}
		$tile_table_output .= "</tr>\n";
	}

	$sr->assign("tile_table_output", $tile_table_output);

	$sr->DisplayPage("mapgen_newmap_editpage.tpl.html");
	exit();
}
elseif($_POST['op'] == "save_tilechanges" && !empty($_POST['name'])) 
{
	db(__FILE__,__LINE__,"select * from ${moduleinstance}_maps where name = '$_POST[name]'");
	$ed_map = dbr();
	if(empty($ed_map)) 
	{
		SystemMessage(MAPGEN_MAPNAME_NOT_FOUND);
	}
	// for each array value in changedtiles (this holds all x_y values of tiles) we separate out the 
	// x,y coordinates, and use this data to change the tiles terrain image on DB - finally we reload
	// the editing page
	foreach($_POST['changedtiles'] as $key=>$val)
	{
		$coords = explode("_",$val);
		dbn(__FILE__,__LINE__,"update ${moduleinstance}_maptiles set terrain_img = '$_POST[tile_img]' where x_loc = '$coords[0]' and y_loc = '$coords[1]' and mp_name = '$_POST[name]'");
	}
	
	$sr->assign("mp_name", $ed_map['name']);
	$sr->assign("mp_height", $ed_map['height']);
	$sr->assign("mp_width", $ed_map['width']);
	$sr->assign("mp_num_tiles", $ed_map['num_tiles']);

	$alltiles = array();
	$this_tile_output = "";

	// the order of x_loc and y_loc is important
	db(__FILE__,__LINE__,"select * from ${moduleinstance}_maptiles where mp_name = '$_POST[name]' order by x_loc asc, y_loc asc");
	while($mtiles = dbr()) 
	{
		// here we do a little re-arranging so we can reference an array of all tile using their coordinates
		$array_name = $mtiles["x_loc"] . "_" . $mtiles['y_loc'];
		$alltiles[$array_name] = $mtiles;
	}

	// now re-construct the original table (using same process as previously
	for($i=1; $i<=$ed_map['height']; $i++) 
	{
		$tile_table_output .= "<tr>\n";
		for($j=1; $j<=$ed_map['width']; $j++) 
		{
			$this_tile_x = $j; // $j denotes x (column) coordinate on a grid of all tiles
			$this_tile_y = $i; // $i denotes y (row) coordinate on a grid of all tiles

			$this_array_ref = $this_tile_x . "_" . $this_tile_y;
				$this_tile = $alltiles[$this_array_ref];

				$tile_id = $j . "_" . $i;
				$img_id = "img_" . $j . "_" . $i;
				$div_id = "div_" . $j . "_" . $i;
			$tile_table_output .= "<td><img src=\"" . $CONFIG['url_prefix'] . "/core/images/terrain/" . $this_tile['terrain_img'] . "\" alt=\"" . $this_tile['terrain_img'] . "\" id=\"$img_id\" onclick=\"javascript:changeTerrainImage('$img_id', '" . $this_tile['terrain_img'] . "', '$div_id', '$tile_id')\" /><div id=\"$div_id\"></div></td>\n";
		}
		$tile_table_output .= "</tr>\n";
	}

	$sr->assign("tile_table_output", $tile_table_output);

	$sr->DisplayPage("mapgen_newmap_editpage.tpl.html");
	exit();


}









// If nothing sticks, someone passed false data to this file!
SystemMessage("Error! No data has been passed to this file, or false/doped data was passed instead. Please follow all links directly from valid urls. Please note that altering the url to files, may be interpreted as an attempt to cheat - an occurance that may at the Administrator(s) discretion result in the banning of your Account and/or deletion of your Character.");

?>