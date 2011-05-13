<?php
/*
// 

File:				generic.inc.php
Objective:			generic functions - those too small, or insignificant enough not to warrant separate files
Version:			SR-RPG (Game Engine) 0.0.4
Author:				Maugrim The Reaper
Edited by:			Maugrim The Reaper
Date Committed:		21 October 2004		
Last Date Edited:	n/a

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


// function to redirect user to another page - while adding new page to allowed navlinks
// this should replace all in-file echo()'ed javascript redirects once we ensure it works
function redirect($location="logout.php") {
	global $sr, $nv, $CONFIG;
	$nv->approvelink($location);
	$sr->assign("redirect_location", $location);
	// store page info - used only to reconstruct a link to the redirect page if the below javascript redirect is
	// prevented due to the target url not being an allowed navlink - should never happen if all works well
	$nv->StoreCurrentPage("redirect.tpl.html");
	echo "<script>self.location='" . $CONFIG['url_prefix'] . "/core/" . $location . "';</script><noscript>This game will not operate effectively unless you enable javascript. To complete this redirect please click <a href='" . $CONFIG['url_prefix'] . "/core/" . $location . "'>HERE</a></noscript>";
}

function e_rand($min=false,$max=false){
	if ($min===false) return @mt_rand();
	$min = round($min);
	if ($max===false) return @mt_rand($min);
	$max = round($max);
	if ($min==$max) return $min;
	if ($min==0 && $max==0) return 0;
	if ($min<$max){
		return @mt_rand($min,$max);
	}else if($min>$max){
		return @mt_rand($max,$min);
	}
}

function r_rand($min=false,$max=false){
	if ($min===false) return mt_rand();
	$min*=1000;
	if ($max===false) return (mt_rand($min)/1000);
	$max*=1000;
	if ($min==$max) return ($min/1000);
	if ($min==0 && $max==0) return 0;
	if ($min<$max){
		return (@mt_rand($min,$max)/1000);
	}else if($min>$max){
		return (@mt_rand($max,$min)/1000);
	}
}

?>