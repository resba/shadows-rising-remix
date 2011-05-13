<?php
/*
//
File:			viewtopic.php
Description:	Views topics
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

require("common.php");


//fist, make sure they are in the right location for viewing in this forum... if they are ingame
//this also checks to make sure the topic exists
if( _INGAME_ ) {
	db(__FILE__,__LINE__,"SELECT t.topic_id FROM {$db_tag}_forum_topics t, {$db_tag}_forum_forums f, {$gameinstance}_characters u "
	. "WHERE f.location=u.location AND t.topic_id=".$_GET['t']." AND t.forum_id=f.forum_id");
	if( affected_rows() != 1 ){
		//assign nav links and show location start thing.
		$smarty->assign("navlinks", $NAV);
		$smarty->display($smarty_header);
		//this should be the same no matter where we are coming from
		$smarty->display("forum/topicnotfound.tpl.html");
		$smarty->display($smarty_footer);
		exit;
	}
	//create menu items
	db(__FILE__,__LINE__,"SELECT forum_id FROM {$db_tag}_forum_topics WHERE topic_id=".$_GET['t']);
	$row = dbr();
	$nv->navlink("left","Actions","Back to forum", "viewforum.php?f={$row['forum_id']}");
	$nv->navlink("left","Actions","Post Reply", "post.php?postmode=reply&t=".$_GET['t']);
}


db(__FILE__,__LINE__,"SELECT f.forum_name, f.forum_id, t.topic_title, t.topic_id FROM {$db_tag}_forum_forums f, {$db_tag}_forum_topics t WHERE f.forum_id=t.forum_id AND t.topic_id=".$_GET['t']);
$row = dbr();
//db2(__FILE__,__LINE__,"SELECT topic_title FROM {$db_tag}_forum_topics WHERE topic_id=".$_GET['t']);
//$row2 = dbr2();

$smarty->assign("forum_name", $row['forum_name']);
$smarty->assign("forum_id", $row['forum_id']);
$smarty->assign("topic_name", $row['topic_title']);
$smarty->assign("topic_id", $row['topic_id']);
if( _INGAME_ ){
	db(__FILE__,__LINE__,"SELECT p.post_title, p.post_message, p.post_time, c.login_name, c.name, c.login_id, u.aim, u.msn, u.yim, u.icq, u.email_address, c.forum_www, c.forum_signature "
	." FROM {$db_tag}_forum_posts p, {$gameinstance}_characters c, {$db_tag}_users_accounts u "
	."WHERE topic_id='".$_GET['t']."' AND p.post_poster=c.login_id AND u.login_id=c.login_id ORDER BY post_time ASC");
}else {
	//NEEDS REVISION
	db(__FILE__,__LINE__,"SELECT p.post_title, p.post_message, p.post_time, u.login_name, u.login_id FROM {$db_tag}_forum_posts p, {$db_tag}_users_accounts u "
	."WHERE topic_id='".$_GET['t']."' AND p.post_poster=u.login_id ORDER BY post_time ASC");
}
$post = array();
while( $row = dbr() ) {
	$smarty->append("post", $row);
	//array_push($post, array("title"=>$row['post_title'],"user_name"=>$row['login_name'],
	//"user_id"=>$row['login_id'],"message"=>$row['post_message'], "posted"=>$row['post_time'] ));
}
//$smarty->assign("post", $post);

/*
This part draws the page
*/


//assign nav links and show location start thing.
$smarty->assign("navlinks", $NAV);
$smarty->display($smarty_header);

//this should be the same no matter where we are coming from
$smarty->display("forum/viewtopic.tpl.html");

$smarty->display($smarty_footer);
?>