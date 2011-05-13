<?php
/*
// 

File:				cms_funcs.inc.php
Objective:			cms engine functions - will be split more accurately at a later date 
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


// function to get all blocks and generate their final output from either templates, or DB stored HTML
function Parse_Blocks($situ) {
	global $qcms_t, $blocks_dir;
	if(empty($situ)) 
	{
		return; //exit if no variable passed
	}
	$my_blocks = Include_Blocks("$situ");
	$this_output = "";
	foreach($my_blocks as $key=>$blockarray) 
	{
		// for each block we open a table to create a block border - can call a template for this in a later version
		// in one exception - News - we let the block open/close block-tables and call template
		if($blockarray['file'] != "news.blk.php") 
		{
			$this_output .= openblocktable($blockarray);
		}
		// if it uses a template it must need a PHP file to feed it template variables
		if($blockarray['use_tpl'] == 1) 
		{
			if(file_exists("$blocks_dir/$blockarray[file]")) 
			{
				include_once("$blocks_dir/$blockarray[file]");
			}
			else 
			{
				$this_output .= "<div>Block File Not Found: $blockarray[file]</div>";
			}
			if(file_exists("$blocks_dir/$blockarray[template]")) 
			{
				if($blockarray['file'] != "news.blk.php") 
				{
					$this_output .= $qcms_t->fetch("$blocks_dir/$blockarray[template]");
				}
			}
			elseif(!empty($blockarray['static_html'])) 
			{
				$this_output .= $blockarray['static_html'];
			}
			else 
			{
				$this_output .= "<div>Template Not Found: $blockarray[template]</div>";
			}
			
		}
		elseif(!empty($blockarray['static_html'])) 
		{
			$this_output .= $blockarray['static_html'];
		}
		else 
		{
			$this_output .= "<div>Block Not Found: No HTML on DB. No file or template found.</div>";
		}
		// close the block table
		if($blockarray['file'] != "news.blk.php") 
		{
			$this_output .= closeblocktable($blockarray);
		}
	}
	return $this_output;
}


function Parse_Module($module) {
	global $qcms_t, $modules_dir, $CONFIG, $user;
	$M_OUTPUT = "";
	$M_SUBTITLE = "";

	// create a var holding path to module directory/module url
	$M_DIR = "$modules_dir/$module[directory]";
	$M_URL = "$CONFIG[url_prefix]/qcms/module.php?dir=" . $module['directory'];
	$qcms_t->assign("M_DIR", $M_DIR);
	$qcms_t->assign("M_URL", $M_URL);

	// the required file (and any include files called by this module) should set up all template vars
	// it should also fetch and parse the template and store within $M_OUTPUT to be added to the main $OUTPUT
	// when returned
	require_once("$modules_dir/$module[directory]/index.php");

	// all module output should now be stored to $M_OUTPUT
	// add opening table structure
	$M_OUTPUT = openmoduletable($module,$M_SUBTITLE) . $M_OUTPUT;

	// add closing table structure
	$M_OUTPUT .= closemoduletable($module);
	return $M_OUTPUT;
}


// function to generate an array of all block data at a specified position (left/center/right)
function Include_Blocks($position) {
	if(empty($position)) 
	{
		return;
	}
	$blocks = array();
	// grab data for active blocks, where userlevel is greater/equal to block user_level
	// lowest userlevel is 1, i.e. Deity || highest is 6, i.e. Visitor
	db(__FILE__,__LINE__,"select * from srbase_cms_blocks where position = '$position' and active = 1 and user_level >= {$_SESSION[permissions][_userlevel]} order by priority asc, block_id asc");
	while($blocks_array = dbr()) 
	{
		array_push($blocks, $blocks_array);
	}
	return $blocks;
}


// a simple function to check whether the CMS user is logged in or not
function ValidUser() {
	if($_SESSION['authenticated'] == "true") 
	{
		return true;
	}
	else 
	{
		return false;
	}
}

?>