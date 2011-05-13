<?php
/*
//
File:			post.php
Description:	Posting compnent of forum system
Version:		SR Alpha
Author:			ProgrammerMatt
Date Committed:	11 November 2004
Date Modified:	n/a

Shadows Rising is an Open Source Project released under GNU License.
Copyright (c) 2004 by Pádraic Brady

This program is free software. You can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation.
//
*/

//modes: topic, reply

require("common.php");

if( !isset($_REQUEST['postmode']) ) {
	$smarty->assign("mode", "nopostmode");
} elseif( $_REQUEST['postmode'] == "topic" ) {
	if( !isset($_POST['post']) ) {
		$smarty->assign("mode", "newpost");
	}
} elseif( $_REQUEST['postmode'] == "reply" ) {
	if( !isset($_POST['post'] ) ) {
		$smarty->assign("mode", "newpost");	
	}
} else {
	$smarty->assign("mode", "invalidpostmode");
}
//assign nav links and show location start thing.
$smarty->assign("navlinks", $NAV);
$smarty->display($smarty_header);

//this should be the same no matter where we are coming from
$smarty->display("forum/post.tpl.html");

$smarty->display($smarty_footer);
?>