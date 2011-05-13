<?php
/*
// 

File:				sitelinks.blk.php
Objective:			simple block file for generating Site Links for the cms menu 
Version:			Q-Site 0.2
Author:				Maugrim The Reaper
Edited by:			Maugrim The Reaper
Date Committed:		6 August 2004
Last Date Edited:	22 October 2004

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

$news = array();

// grab news and set vars for
db(__FILE__,__LINE__,"select * from srbase_block_news order by timestamp desc, news_id desc");

while($news_all = dbr()) {
	if(empty($news_all)) 
	{
		break;
	}
	//$news_all['title'] = "$news_all[title] - $news_all[countt]";
	$news_all['text'] = urldecode($news_all['text']);
	$news_all['footer'] = "Posted by " . $news_all['login_name'] . " on " . date("F j, Y, g:i a", $news_all['timestamp']);
	// add news to template var
	$qcms_t->assign("news", $news_all);
	// fetch a new instance of the module block template
	$this_output .= openblocktable($blockarray);
	$this_output .= $qcms_t->fetch("$blocks_dir/$blockarray[template]");
	$this_output .= closeblocktable($blockarray);
}

?>