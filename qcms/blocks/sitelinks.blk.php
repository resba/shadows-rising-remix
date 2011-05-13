<?php
/*
// 

File:				sitelinks.blk.php
Objective:			simple block file for generating Site Links for the cms menu 
Version:			Q-Site 0.2
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

$cats = array();

// select only those categories current user should be allowed access
db(__FILE__,__LINE__,"select * from srbase_cms_categories where active = 1 and user_level  >= " . $_SESSION['permissions']['_userlevel'] . " order by priority asc");
while($mycats = dbr()) 
{
	$links = array(); //setup an empty $links array

	// we now grab all active modules to display in this menu category
	db2(__FILE__,__LINE__,"select directory, title from srbase_cms_modules where active = 1 and addonmenu = 1 and category = '$mycats[title]' and user_level >= " . $_SESSION['permissions']['_userlevel']);
	while($module_array = dbr2()) {
		array_push($links, array("name"=>"$module_array[title]", "href"=>"module.php?dir=$module_array[directory]"));
	}

	// Now we loop through links in the sitelinks database table and add parsed output to template var
	// these links may have been manually added to external sites, or small internal pages too small to package as a module
	db2(__FILE__,__LINE__,"select name, href from srbase_block_sitelinks where category = '$mycats[title]' order by link_id asc");
	while($link_array = dbr2()) {
		array_push($links, $link_array);
	}

	if(!empty($links)) //only setup this category if it contains links!
	{
		// now pass all category info to a template var
		$cats[$mycats['title']] = array();
		array_push($cats[$mycats['title']], $links);
	}
}


// $links is an array in the sitelinks template - included in a template section and repeated for all links
$qcms_t->assign("categories", $cats);

?>