<?php
/*
// 

File:				format_textinput.inc.php
Objective:			A collection of functions for formatting/parsing text input. Parsing of BBCode is
					contained in parse_bbcode.inc.php. Detection/Cleaning of XSS is contained elsewhere.
Version:			Q-Site 0.3
Author:				Maugrim The Reaper
Edited by:			Maugrim The Reaper
Date Committed:		8 December 2004		
Last Date Edited:	n/a

~~~~~~~~~~~~~~~~~~~~~~~~~
Copyright (c) 2004 by:
~~~~~~~~~~~~~~~~~~~~~~~~~
Pádraic Brady (Maugrim)
~~~~~~~~~~~~~~~~~~~~~~~~~
(All rights reserved)
~~~~~~~~~~~~~~~~~~~~~~~~~

This program is free software. You can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the XXX; either version 1 of the License, or (at your option) any later version.  

Removal of this notice, or any other copyright/credit notice displayed by default in the output to 
this source code immediately voids your rights under the GNU General Public License.

//
*/

// function to replace html breaks into newlines regardless of html/xhtml standard utilised
function br2nl( $data ) {
	return preg_replace( '!<br.*>!iU', "\n", $data );
}

// function to replace newlines with xhtml compliant <pre> preformatted tags
// also wraps all lines to a maximum char length
// suitable for maintaining user's format if required
function nl2br_pre($string, $wrap=40) {
	$string = nl2br($string);
	preg_match_all("/<pre[^>]*?>(.|\n)*?<\/pre>/", $string, $pre1);
	for ($x = 0; $x < count($pre1[0]); $x++) {
		$pre2[$x] = preg_replace("/\s*<br[^>]*?>\s*/", "", $pre1[0][$x]);
		$pre2[$x] = preg_replace("/([^\n]{".$wrap."})(?!<\/pre>)(?!\n)/", "$1\n", $pre2[$x]);
		$pre1[0][$x] = "/".preg_quote($pre1[0][$x], "/")."/";
	}
	return preg_replace($pre1[0], $pre2, $string);
}

// function to convert all newlines into standard xhtml paragraphs, capable of detecting prior tags to
// ensure correct order of <p> and </p>. Assumes by default text contains html breaks.
function nl2paragraph($pee, $br = 1) {
	$pee = $pee . "\n"; // just to make things a little easier, pad the end
    $pee = preg_replace('|<br />\s*<br />|', "\n\n", $pee);
    $pee = preg_replace('!(<(?:table|ul|ol|li|pre|form|blockquote|h[1-6])[^>]*>)!', "\n$1", $pee); // Space things out a little
    $pee = preg_replace('!(</(?:table|ul|ol|li|pre|form|blockquote|h[1-6])>)!', "$1\n", $pee); // Space things out a little
    $pee = preg_replace("/(\r\n|\r)/", "\n", $pee); // cross-platform newlines
    $pee = preg_replace("/\n\n+/", "\n\n", $pee); // take care of duplicates
    $pee = preg_replace('/\n?(.+?)(?:\n\s*\n|\z)/s', "\t<p>$1</p>\n", $pee); // make paragraphs, including one at the end
    $pee = preg_replace('|<p>\s*?</p>|', '', $pee); // under certain strange conditions it could create a P of entirely whitespace
    $pee = preg_replace("|<p>(<li.+?)</p>|", "$1", $pee); // problem with nested lists
    $pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
    $pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);
    $pee = preg_replace('!<p>\s*(</?(?:table|tr|td|th|div|ul|ol|li|pre|select|form|blockquote|p|h[1-6])[^>]*>)!', "$1", $pee);
    $pee = preg_replace('!(</?(?:table|tr|td|th|div|ul|ol|li|pre|select|form|blockquote|p|h[1-6])[^>]*>)\s*</p>!', "$1", $pee);
    if ($br) $pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee); // optionally make line breaks
    $pee = preg_replace('!(</?(?:table|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|blockquote|p|h[1-6])[^>]*>)\s*<br />!', "$1", $pee);
    $pee = preg_replace('!<br />(\s*</?(?:p|li|div|th|pre|td|ul|ol)>)!', '$1', $pee);
    $pee = preg_replace('/&([^#])(?![a-z]{1,8};)/', '&#038;$1', $pee);

    return $pee;
}

// tidy little function for bracketed defined acronyms if required. Auto replacemn




?>