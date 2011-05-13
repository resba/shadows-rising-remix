<?php
/*
// 

File:				dieroll.class.php
Objective:			a simple set of functions simulating die rolls
Version:			SR-RPG (Game Engine) 0.0.4
Author:				Maugrim The Reaper
Edited by:			Maugrim The Reaper
Date Committed:		15 October 2004		
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

class DieRoll {

	// it's not actually required (since PHP 4.2.0) but we'll seed just in case
	function DieRoll() {
		list($usec, $sec) = explode(' ', microtime()); 
		$seed = (float) $sec + ((float) $usec * 100000); 
		mt_srand($seed);
	}

	// simulate 6-sided dieroll
	function d6() {
		return mt_rand(1,6);
	}

	// simulate 8-sided dieroll
	function d8() {
		return mt_rand(1,8);
	}

	// simulate 10-sided dieroll
	function d10() {
		return mt_rand(1,10);
	}

	// simulate 12-sided dieroll
	function d12() {
		return mt_rand(1,12);
	}

	// simulate 20-sided dieroll
	function d20() {
		return mt_rand(1,20);
	}

	// simulate percent dieroll (rarely used)
	// returns % as a fraction, i.e. 5% will be returned as 0.05
	function dpercent() {
		$num = mt_rand(1,100);
		$num = $num / 100;
		return $num;
	}

	// use to sum multiple rolls of a die type, e.g. add 4 rolls of a 6 sided die = rolldie(4, d6)
	// $dietype can be passed through the d6->d20 constants
	function rolldie($numrolls, $dietype) {
		$result = 0;
		for($i=0; $i<$numrolls; $i++) {
			// $dietype contains the dieroll function name
			// appending () ensures the function is executed even if not called explicitly
			$result += $this->$dietype();
		}
		return $result;
	}

}

?>