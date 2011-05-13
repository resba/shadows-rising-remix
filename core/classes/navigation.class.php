<?php
/*
// 

File:				navigation.class.php
Objective:			standard navigation generating function for all nav links to ensure user can only navigate to
					pages directly linked from the current page
Version:			SR-RPG (Game Engine) 0.0.4
Author:				Maugrim The Reaper
Edited by:			Maugrim The Reaper
Date Committed:		19 October 2004		
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

class Navigation {

	// stores a) current page uri b) current template c) current template vars d) available NAV links
	// basically will enable a reconstruction of any page, if a user attempts to request a uri
	// not available from the current page's available navlinks (menu links)

	function StoreCurrentPage($template_name) {
		global $gameinstance, $sr;
		// basename ensures we store only the file & arguments - not all the directory information
		$thisuri = basename($_SERVER['REQUEST_URI']);
		$tpl_vars = $sr->get_template_vars();
		// we set the array character value of curr_template_vars to "" - otherwise the data just grows exponentially!
		$tpl_vars['character']['curr_template_vars'] = "";
		$serialized_vars = addslashes(serialize($tpl_vars));
		$serialized_nav = addslashes(serialize($_SESSION['allowed_navs']));
		$_SESSION['allowed_navs'] = array(); // once stored empty the nav list in the session
		dbn(__FILE__,__LINE__,"update ${gameinstance}_characters set curr_request_uri = '$thisuri', curr_template_page = '$template_name', curr_template_vars = '$serialized_vars', curr_allowed_navs = '$serialized_nav' where login_id = $_SESSION[login_id]");
	}

	// this will add a navigation link at the given position, within a navigation menu section,
	// with the given title and url values. navlink() should be called in order of where links will appear
	// in the url list of each menu section. Top Menu has no section, just a straight list.

	// sections are generated dynamically - just pass a new $section as an argument, and it will be created
	function navlink($position="left", $section="Other", $title="notitle", $url="javascript:void();", $force_link=false) {
		global $NAV;
		// check for empty links
		if(empty($url)) {return;}
		// position=left - equates to the main left menu on each page
		if($force_link === true) 
		{
			$url_segments = explode("/", $url);
			$url_amended = array_pop($url_segments);
		}
		if($position == "left") 
		{
			if(empty($NAV['left'][$section]) || !is_array($NAV['left'][$section])) 
			{
				// each 'details' of a section will hold an array of all links in that section
				$NAV['left'][$section] = array("name"=>"$section","details"=>array());
			}
			array_push($NAV['left'][$section]['details'], array("title"=>$title,"url"=>$url));
		}
		elseif($position == "top") // the top menu - not intending to use this except rarely 
		{
			array_push($NAV['top'], array("title"=>$title, "url"=>$url));
		}
		// add all allowed navs to the session - this is then stored on database - see $sr->DisplayPage()
		// each time a user requests a page, we can compare that request to a list of allowed navs
		// this will mean we can block most manual inputted urls, and doped urls (i.e. with extra arguments)
		if(!is_array($_SESSION['allowed_navs'])) 
		{
			$_SESSION['allowed_navs'] = array();
		}
		if(!empty($url_amended)) $url = $url_amended;
		array_push($_SESSION['allowed_navs'], $url);
	}

	// this function adds any passed url portion to the approved list - usually since the url is not
	// present on the navigation menu, but was declared in the body of the page.
	function approvelink($url) {
		if(empty($url)) {return;}
		array_push($_SESSION['allowed_navs'], $url);
		return;
	}


	// this function takes the user request and compares to the database stored list of allowed navlinks
	// should the user have requested a page NOT on that list (or a page on the list, but using different
	// arguments) we will reconstruct the players last page transparently
	// net effect is that users will be forced to use links on the nav - which will prevent most data doping
	// of urls, backspacing (hopefully), and similar forms of cheating

	function ValidateRequest() {
		global $character;
		// we use $character rather than $_SESSION, as this function should be called either directly from 
		// core.inc.php, or in a file directly after the core.inc.php file is included - i.e. soon after
		// $character array is generated from the database with most recent data.
		$_SESSION['allowed_navs'] = array();
		$allowed_navlist = unserialize(stripslashes($character['curr_allowed_navs']));
		$this_request = basename($_SERVER['REQUEST_URI']);
		//echo("$this_request<br>");
		foreach($allowed_navlist as $key=>$val) 
		{
			if($this_request == $val) 
			{
				// we've matched the user request to an allowed navlist item - so we exit with no action
				return;
			}	
		}
		// at this stage the above foreach loop could not find the current request listed as an allowed nav
		// this is a problem, and we therefore must throw the user back to the original page, by reconstructing
		// that original page
		echo("DEBUG: REQUEST IS NOT AN ALLOWED-NAV-LINK -> PRIOR PAGE RECONSTRUCTED");
		$this->ReconstructPreviousPage();
	}


	// this takes all the prior page info from the database (in $character) and rebuilds that entire
	// page - usually evoked because a user has requested a page not on the ALLOWED NAV LINKs list so
	// must be returned to prior page, without any game functions being used
	// This will also likely occur after a login, in the event the user logged out/ session expired
	// while in combat - no escaping those Creatures :)
	function ReconstructPreviousPage() {
		global $character, $sr, $gameinstance;
		$previous_template_vars = unserialize($character['curr_template_vars']);
		// clear all prior assigned variables
		$sr->clear_all_assign();
		//echo("<br>Starting...<br>");
		//print_array($character);
		//echo("<br>...Mid...<br>");
		//print_r($previous_template_vars);
		//echo("<br>...Ending<br>");
		foreach($previous_template_vars as $key=>$variable) 
		{
			$sr->assign("$key", $variable);
		}
		$sr->display($character['curr_template_page']);
		exit();
	}

}

?>