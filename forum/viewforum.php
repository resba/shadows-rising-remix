<?php
/*
//
File:			viewforum.php
Description:	Look at forums
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

//create menu options
//dev note: Only works with the core component now.
if( _INGAME_ ) {
	$nv->navlink("left","Actions","New Topic", "post.php?postmode=topic&f=".$_GET['f'].""._LINKEND_);
}


if( _INGAME_ ) {
	db(__FILE__,__LINE__,"SELECT * FROM {$db_tag}_forum_forums WHERE location='".$character['location']."' && forum_id='".$_GET['f']."'");
} else {
	db(__FILE__,__LINE__,"SELECT * FROM {$db_tag}_forum_forums WHERE forum_id='".$_GET['f']."'");
}

//no forum found!
if( affected_rows() < 1 ){
	//assign nav links and show location start thing.
	$smarty->assign("navlinks", $NAV);
	$smarty->display($smarty_header);
	$smarty->display("forum/forumnotfound.tpl.html");
	$smarty->display($smarty_footer);
	exit();
}

$f_forum = dbr();
$smarty->assign("forum_name", $f_forum['forum_name']);
$smarty->assign("forum_id", $f_forum['forum_id']);

db(__FILE__,__LINE__,"SELECT * FROM {$db_tag}_forum_topics WHERE forum_id='".$f_forum['forum_id']."'");

while( $v = dbr() ) {
	//get user who made the topic
	if(_INGAME_){
		db3(__FILE__,__LINE__,"SELECT name, login_id FROM {$gameinstance}_characters  WHERE login_id='{$v['topic_starter']}' LIMIT 1");
	}else{
		db3(__FILE__,__LINE__,"SELECT login_name, login_id FROM {$db_tag}_users_accounts WHERE login_id='{$v['topic_starter']}' LIMIT 1");
	}
	$starter = dbr3();

	//get last post information
	db(__FILE__,__LINE__,"SELECT u.login_id, u.login_name, p.post_time, p.post_title "
	."FROM {$db_tag}_forum_posts p, {$db_tag}_users_accounts u "
	."WHERE p.post_poster=u.login_id AND p.topic_id=".$v['topic_id']." ORDER BY p.post_time DESC LIMIT 1");
	$lastpost = dbr();

	if( _INGAME_ ) {
		$smarty->append("topics", array( "topic_id"=> $v['topic_id'], "topic_name"=>$v['topic_title'] ,
		"starter"=>$starter['name'], "starter_id"=>$starter['login_id'], "lastposttime"=>$lastpost['post_time'],
		"lastpostuser"=>$lastpost['login_name'], "lastposteruserid"=>$lastpost['login_id'], "totalposts"=>$v['topic_posts'] ) );
	} else {
		$smarty->append("topics", array( "topic_id"=> $v['topic_id'], "topic_name"=>$v['topic_title'] ,
		"starter"=>$starter['login_name'], "starter_id"=>$starter['login_id'], "lastposttime"=>$lastpost['post_time'],
		"lastpostuser"=>$lastpost['login_name'], "lastposteruserid"=>$lastpost['login_id'], "totalposts"=>$v['topic_posts'] ) );
	}
}


/*
This part draws the page
*/



//assign nav links and show location start thing.
$smarty->assign("navlinks", $NAV);
$smarty->display($smarty_header);

//this should be the same no matter where we are coming from
$smarty->display("forum/viewforum.tpl.html");

$smarty->display($smarty_footer);
?>