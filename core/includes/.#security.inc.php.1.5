<?php
/*
// 

File:				security.inc.php
Objective:			Basically any functions/code segments required to ensure security and prevent cheats
					can be appended here. This file is included into core.inc.php and forms part of Q-Site.
Version:			Q-Site 0.3
Author:				Maugrim The Reaper
Edited by:			Maugrim The Reaper
Date Committed:		18 October 2004		
Last Date Edited:	11 November 2004

~~~~~~~~~~~~~~~~~~~~~~~~~
Copyright (c) 2004 by:
~~~~~~~~~~~~~~~~~~~~~~~~~
Pádraic Brady (Maugrim)
Shadows Rising Project
~~~~~~~~~~~~~~~~~~~~~~~~~
(All rights reserved)
~~~~~~~~~~~~~~~~~~~~~~~~~

This program is free software. You can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the XXX; either version 1 of the License, or (at your option) any later version.  

Removal of this notice, or any other copyright/credit notice displayed by default in the output to 
this source code immediately voids your rights under the Affero General Public License.

//
*/


// --- Require KSES ---

require_once("$CONFIG[gameroot]/qlib/thirdparty/kses/kses.php");

// define all allowed html - all other html submitted by user should be through BBCode. We're lenient on a few
// common presentation tags, and their attributes only.
$kses_allowed_html = array(
	"b"=>array(),
	"i"=>array(),
	"em"=>array(),
	"u"=>array(),
	"a"=>array(
		"href"=>1,
		"title"=>1
	),
	"br"=>array(),
	"p"=>array(
		"align"=>1
	),
	"div"=>array(
		"align"=>1
	)
);


// --- SETUP ---

$query_string = $_SERVER['QUERY_STRING'];
$query_stringBase64 = base64_decode($_SERVER['QUERY_STRING']);
$http_useragent = $_SERVER['HTTP_USER_AGENT'];


// --- GENERIC ---

// Allow only urls that are pre-approved. This essentially prevents all url tampering.
//$nv->ValidateRequest();


// this prevents the SESSION id being passed by url - a potential vulnerability
ini_set('session.use_trans_sid','0');


// Please note most of the below is a hit or miss affair - consider these all to be experimental test measures against common security issues. All are taken from a collection of sources released under the GPL 



// --- SQL INJECTIONS ---

/*
Not sure of the extent additional protection is required - GET is closed off by forcing approved links
For logging purposes however...
*/

// UNION check
if (stristr($query_string,'%20union%20') || stristr($query_string,'*/union/*') || stristr($query_string,' union ') || stristr($query_stringBase64,'%20union%20') || stristr($query_stringBase64,'*/union/*') || stristr($query_stringBase64,' union ')) {
    echo(SECURITY_SQL_INJECTION);
	exit();
}

// CLIKE check
if (stristr($query_string,'/*') OR stristr($query_stringBase64,'/*')) {
    echo(SECURITY_SQL_INJECTION);
	exit();
}



// --- CROSS SITE SCRIPTING (XSS) ---

foreach($_GET as $key=>$val) 
{
	if(get_magic_quotes_gpc()) 
	{
		$val = stripslashes($val);
	}
	$val = kses($val, $kses_allowed_html);
}
foreach($_POST as $key=>$val) 
{
	if(get_magic_quotes_gpc()) 
	{
		$val = stripslashes($val);
	}
	$val = kses($val, $kses_allowed_html);
}



// the above will filter non-allowed html  -  need to add a detection method to display a warning also




// --- DOS ATTACKS ---

if(empty($_SERVER['HTTP_USER_AGENT']) || $http_useragent == "-") 
{
	echo(SECURITY_POSSIBLE_DOS);
	exit();
}


// --- Harvesters ---

/*
Nobody likes harvesters...:)
*/



// this requires a predefined array of known Harvesters
$filename = $CONFIG['gameroot'] . "/core/includes/harvester_list.inc";
$harvesters = file_get_contents($filename);



$harvester_array = explode("\n", $harvesters);



for ($i=0; $i < count($harvester_array); $i++) 
{
	$harvest = $harvester_array[$i];
	if (eregi("($harvest)", $http_useragent) && $harvest != "") 
	{
		echo("Harvesters are not welcome here...");
		exit();
	}
}



?>