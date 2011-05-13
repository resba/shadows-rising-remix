<?php
/*
// 

File:				Admin_News_Submit Module: index.php
Objective:			allows an Admin to post new news items to main page
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

// at least one GET var (the dir value sent to module.php) is expected, if not maybe someone tried
// to access the module directly, without using the proper url
if(empty($_GET) && empty($_POST)) 
{
	$M_OUTPUT .= "You cannot access Modules directly - please use a valid url";
}

if(empty($_GET['op']) && empty($_POST['op'])) 
{
	// no op value set - show default page
	// set a subtitle to use on this section of the module
	$M_SUBTITLE = "Create News Item";
	$M_OUTPUT .= $qcms_t->fetch("$M_DIR/templates/news_post.tpl.html");
}
elseif($_POST['op'] == "preview") 
{
	$M_SUBTITLE = "Preview News Item";
	$_POST['n_text'] = urlencode(PrepareText_ForDatabase($_POST['n_text']));
	$news_text .= urldecode($_POST['n_text']);
	$qcms_t->assign("news_text", $news_text);
	$qcms_t->assign("n_text", $_POST['n_text']);
	$qcms_t->assign("n_title", $_POST['n_title']);
	if(empty($news_text)) 
	{
		$M_OUTPUT .= "You need to actually enter Text in order to post a news item! Use your browser's backbutton to return to the Post News page.";
	}
	elseif(empty($_POST['n_title'])) 
	{
		$M_OUTPUT .= "You need to actually enter a Title in order to post a news item! Use your browser's backbutton to return to the Post News page.";
	}
	else 
	{
		$M_OUTPUT .= $qcms_t->fetch("$M_DIR/templates/news_preview.tpl.html");
	}
}
elseif($_POST['op'] == "save") 
{
	$M_SUBTITLE = "Save Confirmation";
	if(empty($user['login_name'])) 
	{
		$user['login_name'] = "Anonymous";
	}
	dbn(__FILE__,__LINE__,"insert into srbase_block_news (login_id, login_name, timestamp, title, text, active) values ('$user[login_id]','$user[login_name]','".time()."','$_POST[n_title]','".$_POST['n_text']."','1')");
	$M_OUTPUT .= "<div>Your news item has been successfully saved, and should appear shortly within the News Block on the Home page.</div>";
}
else 
{
	// here op was set, but contained no valid data
	$M_OUTPUT .= "Module Error: No valid data received";
}


?>