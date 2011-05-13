<?php
/*
// 

File:				index.php
Objective:			The CMS homepage - where it all starts out :)
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


// grab our include files - cms.inc includes everything we may need
require_once("cms.inc.php");


// how simple does it get? :) - see the include files for the underlying engine
// since the page layout is constant, we can use generic page starts/ends, and column separators

/*
$OUTPUT is made equal to "" (i.e. empty string) at the bottom of cms.inc.php file
*/

$OUTPUT .= $qcms_t->fetch("generic/generic_top.tpl.html");


$OUTPUT .= Parse_Blocks("left");


$OUTPUT .= $qcms_t->fetch("generic/generic_leftcenter_separator.tpl.html");


$OUTPUT .= Parse_Blocks("center");


$OUTPUT .= $qcms_t->fetch("generic/generic_centerright_separator.tpl.html");


$OUTPUT .= Parse_Blocks("right");

// compute page execution time and close off the page
$page_execution_secs = getmicrotime() - $page_generate_start;
$page_execution_secs = number_format($page_execution_secs, 4);
$qcms_t->assign("exec_time", $page_execution_secs);

$OUTPUT .= $qcms_t->fetch("generic/generic_bottom.tpl.html");


echo($OUTPUT);

exit();

?>