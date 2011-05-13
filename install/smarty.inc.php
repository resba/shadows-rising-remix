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
require_once("../qlib/thirdparty/smarty/libs/Smarty.class.php");

// Quantum Star Class to preset directory paths for each new instance
// also enables reloading certain arrays into template variables

class Q_Smarty extends Smarty {

	// Class Constructor - enables setting of the theme location where templates exist
	// should be adjusted later to account for changes in themes while maintaining same qlib cache if possible

	var $gameroot;

	function Q_Smarty($theme="Default")
	{
		$this->gameroot = $GLOBALS['CONFIG']['gameroot'];
		$this->Smarty();
		$this->template_dir = "themes/$theme/templates/";
		$this->compile_dir = "../qlib/smarty_dir/templates_c/";
		$this->config_dir = "../qlib/smarty_dir/configs/";
		$this->cache_dir = "../qlib/smarty_dir/cache/";
		$this->caching = false;
		$this->assign('app_name','Shadows Rising RPG Game Engine');
		// standard configuration variables as set by user
		$this->assign("server_name", $GLOBALS['CONFIG']['server_name']);
		$this->assign("url_prefix", $GLOBALS['CONFIG']['url_prefix']);
		$this->assign("code_base", $GLOBALS['CONFIG']['code_base']);
		$this->assign("link_forums", $GLOBALS['CONFIG']['link_forums']);
		$this->assign("admin_mail", $GLOBALS['CONFIG']['admin_mail']);
	}
}

?>