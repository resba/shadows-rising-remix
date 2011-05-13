<?php
/*
// 

File:				print_funcs.inc.php
Objective:			general print functions for generating output
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


// simple functions to open/close a table to hold a block/module

function openblocktable($blockarray) {
	$opent = "
		<table cellspacing=\"0\" class=\"block\">
			<tr>
	";
	// only show title if block option enabled
	if($blockarray['showtitle'] == 1) 
	{
		$opent .= "			
				<th>
					$blockarray[title]
					<br /><br />
				</th>
			</tr>
			<tr>
		";
	}
	$opent .= "			
				<td style=\"width: 100%;\">
	";
	return $opent;
}

function closeblocktable() {
	$closet = "
				</td>
			</tr>
		</table>
		<br />
	";
	return $closet;
}

function openmoduletable($modulearray, $modulesubtitle="") {
	$opent = "
		<table cellspacing=\"0\" class=\"module\">
			<tr>
	";
	// only show title if block option enabled
	if($modulearray['showtitle'] == 1) 
	{
		$opent .= "			
				<th>
					$modulearray[title]
		";
		if(!empty($modulesubtitle)) 
		{
			$opent .= "&nbsp;&nbsp;&nbsp;::&nbsp;&nbsp;&nbsp;" . $modulesubtitle;
		}
		$opent .= "
				</th>
			</tr>
		</table><br />
		<table cellspacing=\"0\" class=\"module\">
			<tr>
		";
	}
	$opent .= "			
				<td style=\"width: 100%;\">
	";
	return $opent;
}

function closemoduletable() {
	$closet = "
				</td>
			</tr>
		</table>
		<br />
	";
	return $closet;
}

function Print_AuthorName($login_id) {
	db3(__FILE__,__LINE__,"select login_name from srbase_users_accounts where login_id = '$login_id'");
	$lg_name = dbr3();
	if(empty($lg_name)) 
	{
		return "Anonymous";
	}
	else 
	{
		return "$lg_name[login_name]";
	}
}

// function for cleaning text before storage on database
// Mode 1 allows html, Mode 0 disables all html except newlines - Mode 1 is default
function PrepareText_ForDatabase($text, $mode=1) {
	$text = $text."\n";
	$text = stripslashes(stripslashes($text));
	if($mode == 0) 
	{
		$text = htmlspecialchars($text, ENT_QUOTES);	
	}
	$text = preg_replace("/\n/","<br />",$text);
	$text = preg_replace("/\[\]\]/","]",$text);
	$text = preg_replace("/\[\[\]/","[",$text);
	return $text;
}













/*

	DEPRECATED FUNCTIONS

*/



// general print functions - will later be ported to templates so html is separate from PHP
// most of these to be made obsolete shortly

function print_header($title="Shadows Rising") {
	$text = "
		<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
		<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"en\">
		<head>
		<title> ".$title." </title>
		<meta http-equiv=\"content-type\" content=\"text/html; charset=ISO-8859-1\" />
		<meta name=\"Generator\" content=\"EditPlus\" />
		<meta name=\"Author\" content=\"The Open-Source Shadows Rising project\" />
		<meta name=\"Keywords\" content=\"\" />
		<meta name=\"Description\" content=\"Server signup page for a Shadows Rising game.\" />
		<link rel=\"stylesheet\" href=\"themes/Shadows_Rising_Default/style01.css\" type=\"text/css\" />
		</head>
		<!-- All tags styled through CSS rather than inline tags. See linked to CSS file. !-->
		<body class=\"default\">
	";
	print($text); flush();
}

function print_footer() {
	global $CONFIG;
	$text = "
		<br /><br /><br />
		<br /><br /><br />
		<br /><br />
		<div align=\"center\">
		<table class=\"default\">
			<tr>
				<td>
					<a href=\"http://shadows.quantum-star.com/\" target=\"_blank\">Shadows Rising Game Engine</a> &copy; Copyright 2004 Shadows Rising, Individual Authors<br />
				</td>
			</tr>
		</table>
			<br />
			<br />
			<br />
			<br />
		</div>
		<div style=\"text-align: left;\">
		<table class=\"default\" style=\"border: 0px\">
			<tr>
				<td>
					<a href=\"http://validator.w3.org/check/referer\"><img src=\"images/standards/valid-xhtml10.png\" alt=\"Valid XHTML 1.0!\" height=\"31\" width=\"88\" style=\"border: 0px\" /></a>
				</td>
				<td>
					<a href=\"http://jigsaw.w3.org/css-validator\"><img src=\"images/standards/vcss.png\" alt=\"Valid CSS 1/2!\" height=\"31\" width=\"88\" style=\"border: 0px\" /></a>
				</td>
			</tr>
			<tr>
				<td colspan=\"2\" style=\"text-align: left;\">
					This Page Is Valid XHTML 1.0 Transitional!<br />
					This Page Uses Valid CSS!
				</td>
			</tr>
		</table>
		</div>
	";
	if($CONFIG['debug_mode'] == 1) 
	{
		$text .= Print_DebugInfo();	
	}
	$text .= "
		</body>
		</html>
	";
	print($text); flush();
}

function print_fullpage($title, $heading, $output) {
	print_header($title);
	$open_table = "<div align=\"center\"><table class=\"internal\" width=\"500\" style=\"background-color: #222222\"><tr><td>";
	$close_table = "</td></tr></table></div>";
	print($heading); flush();
	print($open_table); flush();
	print($output); flush();
	print($close_table); flush();
	print_footer();
	exit();
}

// function that can be used to create a viable input form. Adds hidden vars.
function get_confirm($heading,$page_name,$qs_text) {
	global $url_prefix, $success_str;
	$text = "<form method=\"post\" action=\"$page_name\" name=\"get_conf_form\">";
	$text .= "<div align=\"center\">$qs_text<br /><br />";
	while (list($var, $value) = each($_GET)) {
		$text .= "<input type=\"hidden\" name=\"$var\" value=\"$value\" />";
	}
	while (list($var, $value) = each($_POST)) {
		$text .= "<input type=\"hidden\" name=\"$var\" value=\"$value\" />";
	}
	$text .= "<input type=\"hidden\" name=\"sure\" value=\"yes\" />";
	$text .= "<input type=\"submit\" name=\"submit\" value=\"Yes\" /> <input type=\"Button\" width=\"30\" value=\"No\" onclick=\"javascript: history.back()\" /> </form>";
	$text .= "<script>document.get_conf_form.submit.focus(); </script>";
	$text .= "<br /><br /><a href=\"location.php\">Return to Location</a><br /><br /><a href=\"index.php\">Return to Home</a></div>";
	print_fullpage($heading,$success_str,$text);
}






function Print_CMS_Header($title,$style="style01.css") {
	$header_text = "
		<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
		<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"en\">
		<head>
		<title> $title </title>
		<meta http-equiv=\"content-type\" content=\"text/html; charset=ISO-8859-1\" />
		<meta name=\"Author\" content=\"The Open-Source Shadows Rising project\" />
		<meta name=\"Keywords\" content=\"\" />
		<meta name=\"Description\" content=\"Server homepage for a Shadows Rising game.\" />
		<link rel=\"stylesheet\" href=\"themes/Shadows_Rising_Default/" . $style . "\" type=\"text/css\" />
		</head>

		<!-- All tags styled through CSS rather than inline tags. See linked to CSS file. !-->
	";
	print($header_text); flush();
}

function Print_DebugInfo() {
	global $DEBUG;
	if(!empty($DEBUG)) 
	{
		$text = "
			<br /><br /><br />
			<br /><br /><br />
			<br /><br /><br />
			<div align=\"center\">
			<table class=\"default\">
				<tr>
		";
		foreach($DEBUG as $key=>$val) {
			$text .= "
					<td style=\"border: solid 1px red;\">
						$key: $val
					</td>
			";
		}
		$text .= "
				</tr>
			</table>
			</div>
		";
	}
	else 
	{
		$text = "";
	}
	return $text;
}

function List_Ranks($user_rank) {
	$output = "<ul style=\"text-align: left;\">";
	foreach($user_rank as $key=>$val) {
		$output .= "<li>$val</li>";
	}
	$output .= "</ul>";
	return $output;
}

?>