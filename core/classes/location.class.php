<?php
/*
// 

File:				location.class.php
Objective:			location class, manages all navigation between locations
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

class Location {

	var $gameinstance;
	var $moduleinstance;

	// Constructor for Location class
	function Location() {
		$this->gameinstance = $GLOBALS['gameinstance'];
		$this->moduleinstance = $GLOBALS['moduleinstance'];
	}

	// function that controls character travel between map points
	function Travel($loc) {
		global $location, $character, $gameinstance, $moduleinstance;
		db(__FILE__,__LINE__,"select nlink, elink, slink, wlink from ${gameinstance}_locations where mp_name = '" . $_SESSION['game']['mp_name'] . "' and loc_id = '$character[location]'");
		$new_loc = dbr();
		// standard validity checks
		if(empty($loc) || !is_string($loc)) 
		{
			SystemMessage(LOC_INVALID_LOCATION_VAR);
		}
		elseif($loc == $character['location']) 
		{
			SystemMessage(LOC_CHAR_ALREADY_HERE);
		}
		elseif($this->Search_TravelLinks($new_loc, $loc)) 
		{
			SystemMessage(LOC_INVALID_LOCATION);
		}

		// validity checks passed, update to Characters new location on map
		$new_loc = explode("_", $loc);
		db(__FILE__,__LINE__,"select loc_id from ${gameinstance}_locations where x_loc = '$new_loc[0]' and y_loc = '$new_loc[1]' and mp_name = '" . $_SESSION['game']['mp_name'] . "'");
		$new_char_loc = dbr();
		
		if(!empty($new_char_loc)) 
		{
			dbn(__FILE__,__LINE__,"update ${gameinstance}_characters set location = '$new_char_loc[loc_id]' where login_id = '$character[login_id]'");	
		}
		else 
		{
			SystemMessage("The location you have attempted to travel to not a valid location. This may be an internal game bug.");
		}
	}



	// function to search through links to map points, returns TRUE if $link_num is not linked to the $char_loc locations
	function Search_TravelLinks($char_loc,$link_ref) {
		if($char_loc['nlink'] == $link_ref) {
			return FALSE;
		} elseif($char_loc['elink'] == $link_ref) {
			return FALSE;
		} elseif($char_loc['slink'] == $link_ref) {
			return FALSE;
		} elseif($char_loc['wlink'] == $link_ref) {
			return FALSE;
		}
		return TRUE;
	}

	// function to fetch any available shops for a location from database and present a list if any
	function Fetch_Shops($loc) {
		global $sr, $gameinstance, $moduleinstance;
		$shops = array();
		db(__FILE__,__LINE__,"select * from ${gameinstance}_merchants where location = '$loc'");
		while($shop_list = dbr()) {
			if(empty($shop_list)) 
			{
				break 1;
			}
			else 
			{
				// add all table rows to the $shops array which is passed to the template
				array_push($shops, $shop_list);
				// try to limit DB calls by passing limited data for session storage
					// set $_SESSION['merchant']['shop_id']
				$_SESSION['merchant'][$shop_list['shop_id']] = $shop_list;
			}
		}
		//$sr->assign("shops", $shops);
		//if(!empty($shops)) 
		//{
			// the $shop_check == "true" check is used by the template to determine whether to list shops
			//$sr->assign("shop_check", "true");
		//}
		return $shops;
	}

	function Fetch_Forums($loc) {
		global $sr, $gameinstance, $db_tag;
		$forums = array();
		//NOTICE: MUST FIX BELOW SQL LINE
		db(__FILE__,__LINE__, "SELECT * FROM {$db_tag}_forum_forums WHERE cat_id=-1 and ingame={$_SESSION['game_id']} and location={$loc}");
		while( $forum_list = dbr() ) {
			if( empty($forum_list) ) {
				break 1;
			} else {
				// add all table rows to the $forums array which is passed to the template
				array_push($forums, $forum_list);
			}
		}
		return $forums;
	}

}

?>