<?php
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
	var $cmsperm;

	//this is a private function that takes all input on a certain level
	//and checks it for permsetting
	function perm_prop( $perms, $prevperms ) {
		//i want to pass $prevperms by reference, how do you do that in PHP?
		//it would also be nice to have this handle a dynamic ammount of $perms stored in an array
		//any ideas along this line would be nice :)
		if( count($perms) == 0 ){
			return $prevperms;
		}
		//make sure if the below doesn't touch something, it falls through
		$newperm = $prevperms;
		foreach( $perms as $k=>$v ) {

			if( $perms[$k] != $prevperms[$k] && $perms[$k] !=0 && $prevperms[$k] != -1 ){
				//if the two perms aren't the same, the levelperm isn't 'Unset' and the prev is not 'No'
				$newperm[$k] = $perms[$k];
			} elseif( $perms[$k] != $prevperms[$k] && $perms[$k] == 0 && $prevperms[$k] != 0 ) {
				//if the permissions aren't equal, levelperm is 'Unset', and prev isn't set to 'Unset'
				$newperm[$k] = $prevperms[$k];
			} elseif ( $perms[$k] != $prevperms[$k] && $perms[$k] != 0 && $prevperms[$k] == 0 ) {
				//if the permissions aren't equal, levelperm is NOT 'unset' and prev is 'unset
				$newperm[$k] = $perms[$k];
			} elseif ( $perms[$k] == $prevperms[$k] && $perms[$k] != 0 ) {
				//if they are the same and not 'unset'
				$newperm[$k] = $perms[$k];
			} elseif ( $perms[$k] == 0 && $prevperms[$k] == 0 ){
				//both unset, let drop through
			} elseif ( $prevperms[$k] == -1 ) {
				//no overrides all currently.
				$newperm[$k] = -1;
			} else {
				//not sure this should occur. but ignore anything and debug it
				echo "Perm Debug: Else condition entered in User Permissions Section:".__LINE__;
			}
		}

		return $newperm;
	}



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
		if( !isset($_SESSION['login_id']) ) {
			//annoymous user.
			return array();
		}
		if( $_SESSION['forum_perm']['forumid'] == $forumid ) {
			//restoring cache
			echo "Debug: Restoring Cache.<br>";
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
		$finalperm = $this->perm_prop($defaultuser, $finalperm);

		//grab the default user group; NOTE: this may be obsoleted as it is basically the same as above.
		db3(__FILE__,__LINE__,"select perm_option,perm_setting from {$db_tag}_forum_perm_groups where group_id=0 and forum_id=0");
		while( $row = dbr3() ) {
			$defaultgroup[$row[perm_option]] = $row[perm_setting];
		}
		$finalperm = $this->perm_prop($defaultgroup, $finalperm);


		/////////////////////////////////////////////////////
		// second grab all user permissions that user might
		// in the respective forum
		/////////////////////////////////////////////////////

		//global user permission
		db2(__FILE__,__LINE__,"select perm_option,perm_setting from {$db_tag}_forum_perm_users where user_id='{$_SESSION['login_id']}' and forum_id='{$forumid}'");
		while( $row = dbr2() ) {
			$userpermsglobal[$row[perm_option]] = $row[perm_setting];
		}
		$finalperm = $this->perm_prop($userpermsglobal, $finalperm);

		//individual forums
		db4(__FILE__,__LINE__,"select perm_option,perm_setting from {$db_tag}_forum_perm_users where user_id='{$_SESSION['login_id']}' and forum_id='{$forumid}'");
		while( $row = dbr4() ) {
			$userperms[$row[perm_option]] = $row[perm_setting];
		}
		$finalperm = $this->perm_prop($userperms, $finalperm);


		/////////////////////////////////////////////////////
		// Finally the group permissions that user might have
		// for that forum.
		/////////////////////////////////////////////////////

		db(__FILE__,__LINE__,"select group_id from {$db_tag}_group_users where user_id={$_SESSION['login_id']}");
		while( $row = dbr() ){
			$usergroups[] = $row;
		}

		foreach ( $usergroups as $k=>$v ) {
			db2(__FILE__,__LINE__,"select perm_option, perm_setting from "
			."{$db_tag}_forum_perm_groups "
			."where group_id={$usergroups[$k][group_id]} and forum_id={$forumid}");
			while( $row = dbr2() ){
				$usergroupperms[$row[perm_option]] = $row[perm_setting];
			}
			$finalperm = $this->perm_prop($usergroupperms, $finalperm);
			unset($usergroupperms);
		}

		/* OBSOLETE, but used as reference for future plans above.
		db(__FILE__,__LINE__,"select p.perm_option,p.perm_setting from "
		."{$db_tag}_forum_perm_groups p, {$db_tag}_group_users u "
		."where u.user_id={$_SESSION['login_id']} and p.group_id=u.group_id and p.forum_id={$forumid} ");
		while( $row = dbr() ) {
		$debuginfo[] = $row;
		}
		print_array($debuginfo);
		*/
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
		echo "Debug: Destroying forum permissions.<br>";
		if( $cache ){
			$_SESSION['forum_perm'] = array();
		}
		$this->forumperm = array();
	}


	////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
	// So begins the game section of the code, which will be different from the above code//
	// due to a different... i dunno													  //
	////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////


	function game_get( $gameid ) {

	}

	function game_user_set( $perm, $value, $forumid, $gameid ) {

	}
	
	function game_group_set( $perm, $value, $groupid, $gameid ) {
		
	}

	//call when leaving game!!!
	Function game_destroy( $cache = true ) {

	}



	Function cms_get(){
		//Return Values
		//1. array
		//2. false
		//check the session cache so we can skip a bunch of queries
		if( !isset($_SESSION['login_id']) ) {
			//annoymous user.
			return array();
		}
		if( $_SESSION['cms_perm']['forumid'] == $forumid ) {
			//restoring cache
			echo "Debug: Restoring Cache.<br>";
			$this->forumperm = $_SESSION['cms_perm'];
			return $_SESSION['forum_perm'];
		}

		global $db_tag;

		$finalperm = array();

		////////////////////////////////////////////////////
		//first, grab ALL global permissions to apply!!!! //
		////////////////////////////////////////////////////

		//grab the default user scheme.
		db2(__FILE__,__LINE__,"select perm_option,perm_setting from {$db_tag}_cms_perm_users where user_id=0");
		while( $row = dbr2() ) {
			$defaultuser[$row[perm_option]] = $row[perm_setting];
		}
		$finalperm = $this->perm_prop($defaultuser, $finalperm);

		//grab the default user group; NOTE: this may be obsoleted as it is basically the same as above.
		db3(__FILE__,__LINE__,"select perm_option,perm_setting from {$db_tag}_cms_perm_groups where group_id=0");
		while( $row = dbr3() ) {
			$defaultgroup[$row[perm_option]] = $row[perm_setting];
		}
		$finalperm = $this->perm_prop($defaultgroup, $finalperm);


		/////////////////////////////////////////////////////
		// second grab all user permissions that user might
		// in the respective forum
		/////////////////////////////////////////////////////

		//global user permission
		db2(__FILE__,__LINE__,"select perm_option,perm_setting from {$db_tag}_cms_perm_users where user_id='{$_SESSION['login_id']}'");
		while( $row = dbr2() ) {
			$userpermsglobal[$row[perm_option]] = $row[perm_setting];
		}
		$finalperm = $this->perm_prop($userpermsglobal, $finalperm);

		//individual forums
		db4(__FILE__,__LINE__,"select perm_option,perm_setting from {$db_tag}_cms_perm_users where user_id='{$_SESSION['login_id']}'");
		while( $row = dbr4() ) {
			$userperms[$row[perm_option]] = $row[perm_setting];
		}
		$finalperm = $this->perm_prop($userperms, $finalperm);


		/////////////////////////////////////////////////////
		// Finally the group permissions that user might have
		// for that forum.
		/////////////////////////////////////////////////////

		db(__FILE__,__LINE__,"select group_id from {$db_tag}_group_users where user_id={$_SESSION['login_id']}");
		while( $row = dbr() ){
			$usergroups[] = $row;
		}

		foreach ( $usergroups as $k=>$v ) {
			db2(__FILE__,__LINE__,"select perm_option, perm_setting from "
			."{$db_tag}_cms_perm_groups "
			."where group_id={$usergroups[$k][group_id]}");
			while( $row = dbr2() ){
				$usergroupperms[$row[perm_option]] = $row[perm_setting];
			}
			$finalperm = $this->perm_prop($usergroupperms, $finalperm);
			unset($usergroupperms);
		}

		/* OBSOLETE, but used as reference for future plans above.
		db(__FILE__,__LINE__,"select p.perm_option,p.perm_setting from "
		."{$db_tag}_forum_perm_groups p, {$db_tag}_group_users u "
		."where u.user_id={$_SESSION['login_id']} and p.group_id=u.group_id and p.forum_id={$forumid} ");
		while( $row = dbr() ) {
		$debuginfo[] = $row;
		}
		print_array($debuginfo);
		*/
		$_SESSION['cms_perm'] = $finalperm;
		return $finalperm;
	}


	Function cms_user_set( $perm, $value, $userid ) {
		global $db_tag;
		dbn(__FILE__,__LINE__,"Update {$db_tag}_cms_perm_users SET perm_setting='{$value}' WHERE user_id='{$userid}' and perm_option='{$perm}'");
	
	}

	Function cms_group_set( $perm, $value, $groupid ) {
		global $db_tag;
		dbn(__FILE__,__LINE__,"Update {$db_tag}_cms_perm_groups SET perm_setting='{$value}' WHERE group_id='{$groupid}' and perm_option='{$perm}'");
	
	}

	Function cms_destroy( $cache = true ) {
		if( $cache ){
			$_SESSION['cms_perm'] = array();
			
		}
		$this->cmsperm = array();
	}


}


?>