<?php

// copyright (c) 2004 programmermatt, shadowsrising project

// governed by the GNU General Public License

// All rights reserved

//EDIT: disabled debug messages prior to 0.0.5b version issue to sf.net





// Start the session
session_start();


/*

TODO:
Test propagation system with several configurations
Write SET function
Write group propagation
Optimize, optimize, optimize!
Write Global individual user perms

Currently the code is really redundant and sloppy. I would really like it if someone
came up with a better idea for testing individual levels for conflicts.
I am thinking of switching to a style where each item is on it's own level so each
item gets checked in order. This would bring up ease a lot, but the trouble would be 
deciding which level goes over which.

*/



class Q_PERM
{
	function Q_PERM(){
		//initialization

	}

	var $forumperm;
	var $gameperm;

	//note: all the functions follow a similar general format, so explainations
	//are given for only the first occurence of a style of function
	//return values are also only listed in the first occurence

	//this function returns an array with all the permissions for that forum
	//and also stores them in $_SESSION['forum_perm'] as a cacheing systems
	//it is recommended that the returned arrary is used over $_SESSION
	//as a security percaution. It also, as an added feature, stores it in
	//the class variable '$forumperm'. This allows three methods of access:
	// returned array, $_SESSION['forum_perm'] and $perm->forumperm['']
	function forum_get( $forumid ) {
		//Return Values
		//1. array
		//2. false
		//check the session cache so we can skip a bunch of queries
		if( $_SESSION['forum_perm']['forumid'] == $forumid ) {
			//restoring cache
			//echo "Debug: Restoring Cache.<br>";
			$this->forumperm = $_SESSION['forum_perm'];
			return $_SESSION['forum_perm'];
		}

		global $db_tag;

		$finalperm = array();
		$finalperm['forumid'] = $forumid;

		////////////////////////////////////////////////////
		//first, grab ALL global permissions to apply!!!! //
		////////////////////////////////////////////////////

		//grab the default user scheme.
		db2(__FILE__,__LINE__,"select perm_option,perm_setting from {$db_tag}_forum_perm_users where user_id=0 and forum_id=0");
		while( $row = dbr2() ) {
			$defaultuser[$row[perm_option]] = $row[perm_setting];
		}

		//grab the default user group; NOTE: this may be obsoleted as it is basically the same as above.
		db3(__FILE__,__LINE__,"select perm_option,perm_setting from {$db_tag}_forum_perm_groups where group_id=0 and forum_id=0");
		while( $row = dbr3() ) {
			$defaultgroup[$row[perm_option]] = $row[perm_setting];
		}

		foreach( $defaultgroup as $k=>$v ) {

			if( $defaultuser[$k] != $defaultgroup[$k] && $defaultuser[$k] !=0 && $defaultgroup[$k] != -1 ){
				//if the two perms aren't the same, the userperm isn't 'Unset' and the global is not 'No'
				$finalperm[$k] = $defaultuser[$k];
			} elseif( $defaultuser[$k] != $defaultgroup[$k] && $defaultuser[$k] == 0 && $defaultgroup[$k] != 0 ) {
				//if the permissions aren't equal, userperm is 'Unset', and globaluser isn't set to 'Unset'
				$finalperm[$k] = $defaultgroup[$k];
			} elseif ( $defaultuser[$k] != $defaultgroup[$k] && $defaultuser[$k] != 0 && $defaultgroup[$k] == 0 ) {
				//if the permissions aren't equal, userperms is NOT 'unset' and global is 'unset
				$finalperm[$k] = $defaultuser[$k];
			} elseif ( $defaultuser[$k] == $defaultgroup[$k] && $defaultuser[$k] != 0 ) {
				//if they are the same and not 'unset'
				$finalperm[$k] = $defaultuser[$k];
			} elseif ( $defaultuser[$k] == 0 && $defaultgroup[$k] == 0 ){
				//both unset, let drop through
				//but this is the first level, lets set something
				$finalperm[$k] = 0;
			} else {
				//not sure this should occur. but ignore anything and debug it
				//echo "Perm Debug: Else condition entered in User Permissions Section:".__LINE__;
			}
		}

		/////////////////////////////////////////////////////
		// second grab all user permissions that user might
		// in the respective forum
		/////////////////////////////////////////////////////

		//global user permission
		db2(__FILE__,__LINE__,"select perm_option,perm_setting from {$db_tag}_forum_perm_users where user_id='{$_SESSION['login_id']}' and forum_id='{$forumid}'");
		while( $row = dbr2() ) {
			$userpermsglobal[$row[perm_option]] = $row[perm_setting];
		}

		//individual forums
		db4(__FILE__,__LINE__,"select perm_option,perm_setting from {$db_tag}_forum_perm_users where user_id='{$_SESSION['login_id']}' and forum_id='{$forumid}'");
		while( $row = dbr4() ) {
			$userperms[$row[perm_option]] = $row[perm_setting];
		}

		foreach( $userpermsglobal as $k=>$v ) {
			//echo "here";
			if( $userperms[$k] != $userpermsglobal[$k] && $userperms[$k] !=0 && $userpermsglobal[$k] != -1 && $finalperm[$k] != -1 ){
				//if the two perms aren't the same, the userperm isn't 'Unset' and the global is not 'No'
				$finalperm[$k] = $userperms[$k];
			} elseif( $userperms[$k] != $userpermsglobal[$k] && $userperms[$k] == 0 && $userpermsglobal[$k] != 0 && $finalperm[$k] != -1 ) {
				//if the permissions aren't equal, userperm is 'Unset', and globaluser isn't set to 'Unset'
				$finalperm[$k] = $userpermsglobal[$k];
			} elseif ( $userperms[$k] != $userpermsglobal[$k] && $userperms[$k] != 0 && $userpermsglobal[$k] == 0 && $finalperm[$k] != -1 ) {
				//if the permissions aren't equal, userperms is NOT 'unset' and global is 'unset
				$finalperm[$k] = $userperms[$k];
			} elseif ( $userperms[$k] == $userpermsglobal[$k] && $userperms[$k] != 0 && $finalperm[$k] != -1 ) {
				//if they are the same and not 'unset'
				$finalperm[$k] = $userperms[$k];
			} elseif ( $userperms[$k] == 0 && $userpermsglobal[$k] == 0 && $finalperm[$k] != -1 ){
				//both unset, let drop through
			} else {
				//not sure this should occur. but ignore anything and debug it
				//echo "Perm Debug: Else condition entered in User Permissions Section:".__LINE__;
			}
		}

		/////////////////////////////////////////////////////
		// Finally the group permissions that user might have
		// for that forum.
		/////////////////////////////////////////////////////

		//this is more complex and not implemented right now, cylcic group searching/propagating isn't easy
		//and is low priority
		//Description of this section: Find all user groups this person belongs to. Cycle through them all apply
		//policy that is given in each.

		$_SESSION['forum_perm'] = $finalperm;
		return $finalperm;
	}

	//a nice function in the case 1 permission needs to get checked.
	//database intensive as the cache is skipped due to the purpose of this
	//function. only use if a double-check is needed
	function forum_can( $perm, $forumid, $userid, $usecache=false) {
		//Return Values
		//1. true
		//2. false
		//Defaults to false in case of an error
		if( $usecache ) {
			if( $_SESSION[$perm] ) {
				return true;
			} else {
				return false;
			}
		}
		global $db_tag;

		$finalperm = array();
		$finalperm['forumid'] = $forumid;

		////////////////////////////////////////////////////
		//first, grab ALL global permissions to apply!!!! //
		////////////////////////////////////////////////////

		//grab the default user scheme.
		db2(__FILE__,__LINE__,"select perm_option,perm_setting from {$db_tag}_forum_perm_users where user_id=0 and forum_id=0 and perm_option='{$perm}'");
		while( $row = dbr2() ) {
			$defaultuser[$row[perm_option]] = $row[perm_setting];
		}

		//grab the default user group; NOTE: this may be obsoleted as it is basically the same as above.
		db3(__FILE__,__LINE__,"select perm_option,perm_setting from {$db_tag}_forum_perm_groups where group_id=0 and forum_id=0 and perm_option='{$perm}'");
		while( $row = dbr3() ) {
			$defaultgroup[$row[perm_option]] = $row[perm_setting];
		}

		foreach( $defaultgroup as $k=>$v ) {

			if( $defaultuser[$k] != $defaultgroup[$k] && $defaultuser[$k] !=0 && $defaultgroup[$k] != -1 ){
				//if the two perms aren't the same, the userperm isn't 'Unset' and the global is not 'No'
				$finalperm[$k] = $defaultuser[$k];
			} elseif( $defaultuser[$k] != $defaultgroup[$k] && $defaultuser[$k] == 0 && $defaultgroup[$k] != 0 ) {
				//if the permissions aren't equal, userperm is 'Unset', and globaluser isn't set to 'Unset'
				$finalperm[$k] = $defaultgroup[$k];
			} elseif ( $defaultuser[$k] != $defaultgroup[$k] && $defaultuser[$k] != 0 && $defaultgroup[$k] == 0 ) {
				//if the permissions aren't equal, userperms is NOT 'unset' and global is 'unset
				$finalperm[$k] = $defaultuser[$k];
			} elseif ( $defaultuser[$k] == $defaultgroup[$k] && $defaultuser[$k] != 0 ) {
				//if they are the same and not 'unset'
				$finalperm[$k] = $defaultuser[$k];
			} elseif ( $defaultuser[$k] == 0 && $defaultgroup[$k] == 0 ){
				//both unset, let drop through
				//but this is the first level, lets set something
				$finalperm[$k] = 0;
			} else {
				//not sure this should occur. but ignore anything and debug it
				//echo "Perm Debug: Else condition entered in User Permissions Section:".__LINE__;
			}
		}

		/////////////////////////////////////////////////////
		// second grab all user permissions that user might
		// in the respective forum
		/////////////////////////////////////////////////////

		//global user permission
		db2(__FILE__,__LINE__,"select perm_option,perm_setting from {$db_tag}_forum_perm_users where user_id='{$_SESSION['login_id']}' and forum_id='{$forumid}' and perm_option='{$perm}'");
		while( $row = dbr2() ) {
			$userpermsglobal[$row[perm_option]] = $row[perm_setting];
		}

		//individual forums
		db4(__FILE__,__LINE__,"select perm_option,perm_setting from {$db_tag}_forum_perm_users where user_id='{$_SESSION['login_id']}' and forum_id='{$forumid}' and perm_option='{$perm}'");
		while( $row = dbr4() ) {
			$userperms[$row[perm_option]] = $row[perm_setting];
		}

		foreach( $userpermsglobal as $k=>$v ) {
			//echo "here";
			if( $userperms[$k] != $userpermsglobal[$k] && $userperms[$k] !=0 && $userpermsglobal[$k] != -1 && $finalperm[$k] != -1 ){
				//if the two perms aren't the same, the userperm isn't 'Unset' and the global is not 'No'
				$finalperm[$k] = $userperms[$k];
			} elseif( $userperms[$k] != $userpermsglobal[$k] && $userperms[$k] == 0 && $userpermsglobal[$k] != 0 && $finalperm[$k] != -1 ) {
				//if the permissions aren't equal, userperm is 'Unset', and globaluser isn't set to 'Unset'
				$finalperm[$k] = $userpermsglobal[$k];
			} elseif ( $userperms[$k] != $userpermsglobal[$k] && $userperms[$k] != 0 && $userpermsglobal[$k] == 0 && $finalperm[$k] != -1 ) {
				//if the permissions aren't equal, userperms is NOT 'unset' and global is 'unset
				$finalperm[$k] = $userperms[$k];
			} elseif ( $userperms[$k] == $userpermsglobal[$k] && $userperms[$k] != 0 && $finalperm[$k] != -1 ) {
				//if they are the same and not 'unset'
				$finalperm[$k] = $userperms[$k];
			} elseif ( $userperms[$k] == 0 && $userpermsglobal[$k] == 0 && $finalperm[$k] != -1 ){
				//both unset, let drop through
			} else {
				//not sure this should occur. but ignore anything and debug it
				//echo "Perm Debug: Else condition entered in User Permissions Section:".__LINE__;
			}
		}

		/////////////////////////////////////////////////////
		// Finally the group permissions that user might have
		// for that forum.
		/////////////////////////////////////////////////////

		//this is more complex and not implemented right now, cylcic group searching/propagating isn't easy
		//and is low priority
		//Description of this section: Find all user groups this person belongs to. Cycle through them all apply
		//policy that is given in each.

		$_SESSION['forum_perm'] = $finalperm;
		return $finalperm;

	}

	//sets a value in the permissino table for said forum with
	//said value. value can only be -1, 0, 1
	function forum_user_set( $perm, $value, $forumid, $userid) {
		//Return Values:
		//1. true		Sucess
		//2. false		Failure
		//ALL CHECKING FOR PERMISSION TO PREFORM THIS ACTION SHOULD BE CONDUCTED OUTSIDE
		//OF THIS FUNCTION CURRENTLY
		global $db_tag;
		dbn(__FILE__,__LINE__,"Update {$db_tag}_forum_perm_users SET perm_setting='{$value}' WHERE forum_id='{$forumid}' and perm_option='{$perm}'");
	}

	//sets a value in the permissino table for said forum with
	//said value. value can only be -1, 0, 1
	function forum_group_set( $perm, $value, $forumid, $groupid) {
		//Return Values:
		//1. true		Sucess
		//2. false		Failure
		global $db_tag;
		dbn(__FILE__,__LINE__,"Update {$db_tag}_forum_perm_users SET perm_setting='{$value}' WHERE forum_id='{$forumid}' and perm_option='{$perm}'");
	}

	//destroys the current permission set for the forum permissin loaded
	//it is recommend that this is called every time the page is loaded, but set
	//cache=false so the cache remains intact
	function forum_destroy( $cache = true ){
		//echo "Debug: Destroying forum permissions.<br>";
		if( $cache ){
			$_SESSION['forum_perm'] = array();
		}
	}

	
	
	////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
	// So begins the game section of the code, which will be different from the above code//
	// due to a different... i dunno													  //
	////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
	
	
	function game_get( $gameid ) {

	}

	function game_can( $perm, $gameid ) {

	}

	function game_set( $perm, $value, $forumid ) {

	}

	//call when leaving game!!!
	Function game_destroy( $cache = true ) {

	}



	Function cms_get(){

	}

	Function cms_can( $perm ) {

	}

	Function cms_set( $perm, $value ) {

	}

	Function cms_destroy( $cache = true ) {

	}


}


?>