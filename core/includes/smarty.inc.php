<?php
/*
// 

File:				core.inc.php
Objective:			initialisation file to setup defaults for the Smarty Template Engine
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

// load Smarty library
require_once($CONFIG['gameroot']."/qlib/thirdparty/smarty/libs/Smarty.class.php");

// Quantum Star Class to preset directory paths for each new instance
// also enables reloading certain arrays into template variables

class Q_Smarty extends Smarty {

	// Class Constructor - enables setting of the theme location where templates exist
	// should be adjusted later to account for changes in themes while maintaining same qlib cache if possible

	var $gameroot;

	function Q_Smarty($theme="Shadows_Rising_Default")
	{
		$this->gameroot = $GLOBALS['CONFIG']['gameroot'];
		$this->Smarty();
		$this->template_dir = $this->gameroot . "/core/themes/$theme/templates/";
		$this->compile_dir = $this->gameroot . "/qlib/smarty_dir/templates_c/";
		$this->config_dir = $this->gameroot . "/qlib/smarty_dir/configs/";
		$this->cache_dir = $this->gameroot . "/qlib/smarty_dir/cache/";
		$this->caching = false;
		$this->assign('app_name','Shadows Rising RPG Engine');
		// standard configuration variables as set by user
		$this->assign("server_name", $GLOBALS['CONFIG']['server_name']);
		$this->assign("url_prefix", $GLOBALS['CONFIG']['url_prefix']);
		$this->assign("code_base", $GLOBALS['CONFIG']['code_base']);
		$this->assign("link_forums", $GLOBALS['CONFIG']['link_forums']);
		$this->assign("admin_mail", $GLOBALS['CONFIG']['admin_mail']);
	}

	function Reload_Location() {
		global $gameinstance, $character;
		db(__FILE__,__LINE__,"select * from ${gameinstance}_locations where loc_id = '$character[location]'");
		$locat = dbr();
		$this->assign("location", $locat);
		return $locat;
	}

	function Reload_Character() {
		global $gameinstance, $character, $char;
		db(__FILE__,__LINE__,"select * from ${gameinstance}_characters where login_id = '$character[login_id]'");
		$chartr = dbr();
		// add ability bonuses to a characters attributes
		if(!empty($_SESSION['modifiers'])) 
		{
			$char->Add_Ability_Bonuses($chartr);
		}
		// calculate a characters ability/attribute modifiers (once bonuses added to the attributes)
		$char->Calculate_Ability_Modifiers($chartr);
		$this->assign("character", $chartr);
		return $chartr;
	}

	/*	this function has a very important purpose - we use it as a small wrapper which while directly
		calling display() also grabs all template variables, and stores them on the database.
		The reasoning for this is simple - we want to prevent players doing:
								- backspacing
								- manual url editing
								- logging out, and defaulting to home page (force return to page last seen)
		This has the effect of forcing players to navigate the game using the provided links, and prevents
		backing out of combat, etc. This is just 1 piece of the anti-cheat system - expect a lot more pieces
		in the future which will all act in concert.
	*/
	
	function DisplayPage($template_name) {
		global $nv, $NAV, $page_generate_start;
		// assign the entire NAV structure to the Smarty {$navlinks} template variable
		$this->assign("navlinks", $NAV);
		// store all page data to database (mainly limited data - no html, as templates are constant)
		$nv->StoreCurrentPage($template_name);
			// compute page execution time
			$page_execution_secs = getmicrotime() - $page_generate_start;
			$page_execution_secs = number_format($page_execution_secs, 4);
			$this->assign("exec_time", $page_execution_secs);
		$this->display($template_name);
		exit();
	}
}

?>