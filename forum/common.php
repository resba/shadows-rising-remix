<?php
/*
//
File:			common.php
Description:	Commmon Stuff for all forums
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
session_start();
//is this an ingame thing or main?
if( $_SESSION['ingame'] ){
	define("_INGAME_", true);
} else {
	define("_INGAME_", false);
}


//include files and show headers
if( _INGAME_ ) {
	include("../core/core.inc.php");
	$smarty = $sr;
	$smarty->assign("ingame", true);
	/*
	This section of code sets a bunch of vars to reflect that this is an 'in-game' forum
	*/
	$nv->navlink("left", "Navigation", "Back to location", "../core/location.php");
	$smarty_header = "location_top.tpl.html";
	$smarty_footer = "location_bottom.tpl.html";
} else {
	include("../qcms/cms.inc.php");
	$smarty = $qcms_t;
	$smarty->assign("ingame", false);

	//get user info. if we were ingame we could use $character var.
	db(__FILE__,__LINE__, "SELECT * FROM {$db_tag}_users_accounts WHERE login_id='".$user['login_id']."'");
	$f_user = dbr();

	/*
	This section of code sets a bunch of vars to reflect that this is an 'global' forum
	*/
	$smarty_header = "forum/header.tpl.html";
	$smarty_footer = "forum/footer.tpl.html";

}

$user_db = "{$db_tag}_users_accounts";
$forum_db = "{$db_tag}_forum_forums";
$topics_db = "{$db_tag}_forum_topics";
$posts_db = "{$db_tag}_forum_posts";
$privmsgs_db = "{$db_tag}_forum_privmsgs";
$permusers_db = "{$db_tag}_forum_perm_users";
$permgropus_db = "{$db_tag}_forum_perm_groups";
$permforums_db = "{$db_tag}_forum_perm_forums";
$cat_db = "{$db_tag}_forum_categories";
$groups_db = "{$db_tag}_forum_groups";
$groups_users_db = "{$db_tag}_forum_group_users";
$config_db = "{$db_tag}_forum_config";



?>