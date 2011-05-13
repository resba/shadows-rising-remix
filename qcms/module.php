<?php
/*
// 

File:				module.php
Objective:			if requested, attempts to generate the specified module page
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

require("cms.inc.php");


// CMS pages include the left-side blocks always

$OUTPUT .= $qcms_t->fetch("generic/generic_top.tpl.html");


$OUTPUT .= Parse_Blocks("left");


$OUTPUT .= $qcms_t->fetch("generic/generic_leftcenter_separator.tpl.html");


// check that module exists, then ensure it is activated on the database

db(__FILE__,__LINE__,"select * from srbase_cms_modules where directory = '$_GET[dir]'");
$my_module = dbr();

if(empty($_GET['dir']) || !is_dir("$modules_dir/$_GET[dir]") || !file_exists("$modules_dir/$_GET[dir]/index.php")) 
{
	$OUTPUT .= "Unable to load Module: Specified Module could not be located.";
}
elseif($my_module['active'] != 1 || empty($my_module) || $my_module['user_level'] < $_SESSION['permissions']['_userlevel']) 
{
	$OUTPUT .= "Unable to load Module: Either the Module is not activated, or you do not have a valid permission level to access it.";
}
else 
{
	// okay, so we can now say that module exists, and user can access it
	// when calling the module, ensure we send it all relevant data by GET and POST
	$OUTPUT .= Parse_Module($my_module);
}



// compute page execution time and close off the page
$page_execution_secs = getmicrotime() - $page_generate_start;
$page_execution_secs = number_format($page_execution_secs, 4);
$qcms_t->assign("exec_time", $page_execution_secs);

$OUTPUT .= $qcms_t->fetch("generic/generic_bottom.tpl.html");


echo($OUTPUT);

exit();

?>