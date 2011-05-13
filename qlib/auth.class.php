<?php

/*
// 
File:			auth.class.php
Objective:		Authentication Class using sessions
Version:		QS 2.3.0 Alpha
Author:			Maugrim_The_Reaper (maugrimtr@hotmail.com)
Date Committed:	15 May 2004	
Date Modified:	n/a

Copyright (c) 2004 by Pádraic Brady

This program is free software. You can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation.
//
*/

// need to remove any QS specific sections as they're no longer required

/*

This file contains three Classes:

1. Q_Authenticate - for user authentication to server and each game
2. Q_AuthCheck - extends Q_Authenticate and verifies user is authenticate for each page request
3. Q_ValidateSignup - validates all new signups, adds new user to DB, and send auth code to email if required

This file is based on the original Solar Empire login process with the following differences

1. Instead of Cookies, the file uses PHP Sessions to store data
2. The login process code is in Classes
3. All PHP Redirects have been changed to javascript self.location commands

The only constructor used simply pre-initialises certain variables as global scope.

*/

mt_srand((double)microtime()*1000000);

class Q_Authenticate 
{
	var $auth_code;
	var $url_prefix;
	var $code_base;
	var $gameroot;
	var $sendmail;


	// Class Constructor - initialize globals
	function Q_Authenticate() {
		if(!empty($GLOBALS['CONFIG']['auth_code'])) 
		{
			$this->auth_code = $GLOBALS['CONFIG']['auth_code'];
		}
		$this->url_prefix = $GLOBALS['CONFIG']['url_prefix'];
		$this->code_base = $GLOBALS['CONFIG']['code_base'];
		$this->gameroot = $GLOBALS['CONFIG']['gameroot'];
		$this->sendmail = $GLOBALS['CONFIG']['sendmail'];
	}

	// method to obtain information used in authenticate process
	function GrabUser($login_name) 
	{
		db(__FILE__,__LINE__,"select login_id,login_name,last_login,auth,passwd from srbase_users_accounts where login_name = '$login_name'");
		$user = dbr();
		return $user;
	}
	
	// method to run authenticate process on user
	function AuthUser($user, $response)
	{
		global $_sid;
		//calculate the expected response from login form
		unset($final_result);
		// grab challenge string generated for current session id in login_form.php
		db(__FILE__,__LINE__,"select challenge from srbase_challenge_record where sessid = '$_sid' order by chal_id desc");
		$chall = dbr();
		$chal = $chall['challenge'];
		$expected_response = md5(strtolower($user['login_name']).":".$user['passwd'].":".$chal);

		if(empty($_POST['response'])) 
		{
			$returntext = "<b>Shadows Rising requires that your browser have javascript enabled. Without javascript the secure challenge/response login process cannot operate, and other in-game functions cannot operate effectively.</b>";
			return $returntext;
		}
		elseif($_POST['response'] != $expected_response) 
		{
			$returntext = "response not right => $expected_response => $_POST[response]";
			$final_result = FALSE;
		}
		elseif($_POST['response'] == $expected_response) 
		{
			$final_result = TRUE;
		}
		else 
		{
			$final_result = FALSE;
		}
		if (!isset($user) || !is_array($user) || $final_result === FALSE) 
		{
			//wrong password/username combo detected
			$returntext =  "Either this user does not exist on the server, or else you have entered an incorrect username/password combination. Please try again or sign up for a free account.";
			return $returntext;
		}
		elseif ($user['last_login'] == 0 && $this->sendmail == 1 && $user['login_id'] != 1) 
		{
			//auth code set as required
			if(!isset($this->auth_code) || $this->auth_code != $user['auth']) 
			{
				print_header("Authorisation Code Required");
				$rs = "";
				if(!isset($this->auth_code))
				{
					echo "<br><center><table cellspacing=\"0\" cellpadding=\"0\" width=\"60%\"><tr><td>Please enter the Authorisation Code that was sent to your email address:<br><br>";
				} 
				else 
				{
					echo "<br><center><table cellspacing=\"0\" cellpadding=\"0\" width=\"60%\"><tr><td>Authorisation Code did not match. Please check that the Authorisation code you use is that one sent to your email account for this server. Please try again:<br><br>";
				}
				echo "<form name=\"get_var_form\" action=\"$this->url_prefix/login.php\" method=\"post\">"
				."<input type=\"hidden\" name=\"l_name\" value=\"$user[login_name]\"><input type=\"hidden\" name=\"passwd\" value=\"$passwd\">"
				."<input type=\"text\" name=\"auth_code\" value=\"$this->auth_code\" size=\"20\"><br>"
				."<input type=\"submit\" value=\"Submit\"></form></td></tr></table></center>";
				print_footer();
				exit();
			}
		}
		else //tests are passed, login user and set the cookie
		{

			//DEV: Note that $session is not a PHP Session ID - just Moriarty trying his best to confuse people :)
			srand((double)microtime()*1000000);
			$session = mt_rand(0,getrandmax());

			// session data
			$_SESSION['login_id'] = $user['login_id'];
			$_SESSION['login_name'] = $user['login_name'];
			$_SESSION['session_id'] = $session;
			$_SESSION['authenticated'] = "true";

			// login_name cookie value
			SetCookie("login_name",0);
			SetCookie("login_name","$_SESSION[login_name]",time()+2592000);

			$last_ip = $_SERVER['REMOTE_ADDR'];
			if($user['last_login'] != 0) 
			{
				$today = time();
			} 
			else 
			{
				$today = 0;
			}
			$expire = time() + 600;
			dbn(__FILE__,__LINE__,"update srbase_users_accounts set last_login = ".time().", session_id = '$session', session_exp = '$expire', last_ip = '$last_ip', login_count = login_count + 1 where login_id = '$user[login_id]'");
		}
		//insert_history($user['login_id'],"Logged Into GameList");
		return 1;
	}


	// method to authenticate user to a specific game
	function AuthUserGame() {
		if(isset($_GET['game_db'])) 
		{
			$db_name = $_GET['game_db'];
		}
		elseif(isset($_POST['game_db'])) 
		{
			$db_name = $_POST['game_db'];
		}
		if($_SESSION['login_id'] == 1 && !isset($_POST['nd_ad_log'])) //admin login method.
		{ //DEV: defunct - permissions are active since Nov 04 or earlier
			//session data
			$_SESSION['db_name'] = $db_name;

			print_header("Admin Login");
			db(__FILE__,__LINE__,"select name from se_games where db_name = '$db_name'");
			$game_name = dbr();
			echo "<br><center><table cellspacing=\"0\" cellpadding=\"0\" width=\"60%\"><tr><td>"
			."Game: <b class=b1>$game_name[0]</b><br><br>"
			."<br>Hi, $game_name[0] Admin!<br><br>If you would be so kind as to enter your game's Admin password below, you may continue your tyrannical reign in no time:<br><br>"
			."<form name=\"admin_login_form\" action=\"$this->url_prefix/login.php\" method=POST>"
			."<input type=\"password\" name=\"entered_ad_pass\" size=\"10\">"
			."<input type=\"hidden\" name=\"game_db\" value=\"$db_name\">"
			."<input type=\"hidden\" name=\"session_id\" value=\"$_SESSION[session_id]\">"
			."<input type=\"hidden\" name=\"nd_ad_log\" value=\"1\">"
			." - <input type=\"submit\" value=\"Login\"></form>"
			."<script> document.admin_login_form.entered_ad_pass.focus(); </script>"
			."</td></tr></table></center>";
			include_once("themes/Blue_Tempest/footer.php");
			exit;
		} 
		elseif(isset($_POST['nd_ad_log']))
		{ 
			//second step of admin logging in.
			db(__FILE__,__LINE__,"select admin_pw from se_games where db_name = '$_POST[game_db]'");
			$ad_pass = dbr();
			if($ad_pass['admin_pw'] != $_POST['entered_ad_pass'])
			{
				//wrong admin pass for game.
				print_header("Login Error");
				echo "<br><center><table cellspacing=\"0\" cellpadding=\"0\" width=\"60%\"><tr><td>The Administration password entered for this game is incorrect. Please try again or contact the Server's Operator.<br><br><a href=\"javascript:history.back()\">Try to log in again.</a></td></tr></table></center>";
				//insert_history($_SESSION['login_id'],"Bad login attempt into game: $_POST[game_db]");
				include_once("themes/Blue_Tempest/footer.php");
				exit;
			} 
			else 
			{ 
				//correct admin login.
				//session data
				$_SESSION['db_name'] = $db_name;

				dbn(__FILE__,__LINE__,"update ${db_name}_users set game_login_count = game_login_count + 1 where login_id = '$_SESSION[login_id]'");
				dbn(__FILE__,__LINE__,"update se_games set session_id = '".$_SESSION['session_id']."' where db_name = '$db_name'");
				//insert_history($_SESSION['login_id'],"Logged Into Game");
				//Header("Location: ".$url_prefix."/location.php");
				echo "<script>self.location='$this->url_prefix/location.php';</script><noscript>You cannot login without JavaScript. Please enable Javascript, or get a browser that supports it.</noscript>";
			}
		} 
		else 
		{ //normal player logging into game
			if(isset($_GET['game_db'])) 
			{
				$db_name = $_GET['game_db'];
			}
			elseif(isset($_POST['game_db'])) 
			{
				$db_name = $_POST['game_db'];
			}
			else 
			{
				echo("Error setting $"."db_name on line ".__LINE__." of ".__FILE__."."); exit();
			}
			db(__FILE__,__LINE__,"select game_login_count, banned_time, banned_reason from ${db_name}_users where login_id = '".$_SESSION['login_id']."'");
			$login_req_vars = dbr();
			if(($login_req_vars['banned_time'] > time() || $login_req_vars['banned_time'] == -1) && $_SESSION['login_id'] > 5)
			{ 
				//determine if player has been banned from the game.
				print_header("Banned");
				$rs = "<br><br>Back to <a href=\"$this->url_prefix/game_listing.php\">Game List</a>";
				if($login_req_vars['banned_time'] > time())
				{
					echo "The <b class=b1>Admin</b> of this game has banned you from it, until <b>".date( "D jS M - H:i",$login_req_vars['banned_time'])."</b> or until the admin releases the ban.<br>During this period your fleets/planets are susceptable to the normal wiles of the game.<br><br>The reason given by the admin was:<br><br> $login_req_vars[banned_reason]";
				} 
				elseif($login_req_vars['banned_time'] < 0)
				{
					echo "The <b class=b1>Admin</b> has banned you from the game until it resets, whenever that may be, or until the Admin releases the ban.<br><br>The reason given by the admin was:<br><br> $login_req_vars[banned_reason]";
				}

				//session data
				unset($_SESSION['db_name']);

				include_once("themes/Blue_Tempest/footer.php");
				exit;
			}

			//session data
			$_SESSION['db_name'] = $db_name;

			insert_history($_SESSION['login_id'],"Logged In");

			if($login_req_vars[0] > 0 || $_SESSION['login_id'] == 1)
			{ 
				//logged in before, or admin
				dbn(__FILE__,__LINE__,"update ${db_name}_users set game_login_count = game_login_count + 1 where login_id = '".$_SESSION['login_id']."'");

				//Update score
				//score_func($_SESSION['login_id'],0,$_SESSION['db_name']);

				//Header("Location: ".$this->url_prefix."/location.php?db_name=$_SESSION[db_name]");
				echo "<script>self.location='$this->url_prefix/location.php?db_name=$_SESSION[db_name]';</script><noscript>You cannot login without JavaScript. Please enable Javascript, or get a browser that supports it.</noscript>";
				exit;
			} 
			else 
			{ 
				//PLAYER'S first ship.
				print_header("Welcome to Quantum Star SE");
				echo "Welcome to <b class=b1>Quantum Star SE</b>."
				."<br><br>Please enter a name for your first ship:"
				."<form action=\"$this->url_prefix/ship_build.php\" method=\"POST\">"
				."<input name=\"ship_name\" size=\"10\"> Enter Ship Name"
				."<br><br>Please enter a nickname for your first Fleet:<br><br><input name=\"fleet_name\" size=\"10\" maxlength=\"10\"> Enter Primary Fleet Callsign"
				."<input type=\"hidden\" name=\"db_name\" value=\"$_SESSION[db_name]\">"
				."<input type=\"hidden\" name=\"session_id\" value=\"$_SESSION[session_id]\">"
				."<br><br><input type=\"submit\" value=\"Submit\"></form>";
				$rs = "";
				include_once("themes/Blue_Tempest/footer.php");
				exit();
			}
		}
	}
}

class Q_AuthCheck extends Q_Authenticate
{

	// note to the confused - session id for admin stored in se_games - time to shake my head and get perms integrated
	// auth time limit is unnecessary with the right backup - more to rewrite

	// method to check user authorisation
	function Check_Auth($user) {
		if(($_SESSION['session_id'] == 0) || ($_SESSION['session_id'] != $user['session_id']) || ($user['session_exp'] < time())) 
		{
			//user session expired;
			echo("bad login line 301 auth.class.php");
			//return "false"; //disable for in game check
			//$_SESSION[] = "false";

			//delete session data and close
			$_SESSION = array();
			session_destroy();

			//Header("Location: ".$this->url_prefix."/index.php");
			echo "<script>self.location='$this->url_prefix/qcms/index.php';</script><noscript>You cannot login without JavaScript. Please enable Javascript, or get a browser that supports it.</noscript>";
			
			//exit;
		} 
		elseif($user['session_exp'] - 1200 - time() < -20) 
		{ 
			//players get 20 mins in-activty (? - why not an hour then)
			// update session_exp
			$next_exp = time() + 1200;
			dbn(__FILE__,__LINE__,"update srbase_users_accounts set session_exp = '$next_exp' where login_id = $user[login_id]");
			//return "true";
		}
	}

	// method to check user authority is current
	function Check_Auth_2($user) {
		if($user['login_id'] == 1 && !preg_match("/game_listing\.php/",$_SERVER['PHP_SELF'])){
			if(($_SESSION['session_id'] == 0) || ($_SESSION['session_id'] != $user['session_id']) || ($user['session_exp'] < time())) 
			{
				//user session expired;

				//delete session data and close
				$_SESSION = array();
				session_destroy();

				Return FALSE;
				exit;
			} 
			else 
			{ 
				//admins are only allowed 10 mins innactivity
				$next_exp = time() + 600;
				dbn(__FILE__,__LINE__,"update user_accounts set session_exp = '$next_exp' where login_id = $user[login_id]");
				Return TRUE;
			}
		} 
		elseif(($_SESSION['session_id'] == 0) || ($_SESSION['session_id'] != $user['session_id']) || ($user['session_exp'] < time())) 
		{
			//user session expired;

			//delete session data and close
			$_SESSION = array();
			session_destroy();

			Return FALSE;
			exit;
		} 
		elseif($user['session_exp'] - 1200 - time() < 0) 
		{ 
			//players get 20 mins in-activty
			// update session expiration timeframe
			$next_exp = time() + 1200;
			dbn(__FILE__,__LINE__,"update user_accounts set session_exp = '$next_exp' where login_id = $user[login_id]");
			Return TRUE;
		}
	}

}




class Q_ValidateSignup {

	var $game;

	//Class constructor to initialise global vars
	function Q_ValidateSignup() {
		$this->game = $GLOBALS['game'];
	}

	// function to run a series of checks on reg form input
	function ValidateSignup($l_name, $first_name, $last_name, $passwd, $passwd_verify, $email_address, $email_address_verify, $disc) 
	{
		if(!isset($l_name)) 
		{
			$returntext = "You need to enter a Login Name."
			."<br><br><a href=javascript:history.back()>Back to Sign-up Form</a>";
			return $returntext;
		}

		if((strcmp($l_name,htmlspecialchars($l_name))) || (strlen($l_name) < 3) || (eregi("[^a-z0-9~!@#$%&*_+-=£§¥²³µ¶Þ×€ƒ™ ]",$l_name))) 
		{
			$returntext = "Invalid login name. No slashes, no spaces and minimum of three characters."
			."<br><br><a href=javascript:history.back()>Back to Sign-up Form</a>";
			return $returntext;
		}

		if(!isset($first_name)) 
		{
			$returntext = "You need to enter a first name."
			."<br><br><a href=javascript:history.back()>Back to Sign-up Form</a>";
			return $returntext;
		}

		if(!isset($last_name)) 
		{
			$returntext = "You need to enter a last name."
			."<br><br><a href=javascript:history.back()>Back to Sign-up Form</a>";
			return $returntext;
		}

		if(!isset($passwd) || !isset($passwd_verify)) 
		{
			$returntext = "You must enter a password. Please return to the Sign-Up Form and try again:"
			."<br><br><a href=javascript:history.back()>Back to Sign-up Form</a>";
			return $returntext;
		}

		if($passwd == $l_name) 
		{
			$returntext = "What a good idea. Using your login name as the pass.<br>Use a different password."
			."<br><br><a href=javascript:history.back()>Back to Sign-up Form</a>";
			return $returntext;
		}

		if($passwd != $passwd_verify) 
		{
			$returntext = "The passwords you entered did not match."
			."<br><br><a href=javascript:history.back()>Back to Sign-up Form</a>";
			return $returntext;
		}

		if(strlen($passwd) < 5) 
		{
			$returntext = "Passwords must be at least five characters."
			."<br><br><a href=javascript:history.back()>Back to Sign-up Form</a>";
			return $returntext;
		}


		if(!isset($email_address)) 
		{
			$returntext = "You need to Enter an Email Address."
			."<br><br><a href=javascript:history.back()>Back to Sign-up Form</a>";
			return $returntext;
		}
		elseif($this->is_valid_email($email_address) == "FALSE")
		{
			$returntext = "Please Enter a Valid Email Address"
			."<br><br><a href=javascript:history.back()>Back to Sign-up Form</a>";
			return $returntext;
		}

		$login_name = $l_name;

		db(__FILE__,__LINE__,"select login_id from srbase_users_accounts where login_name = '$login_name'");
		$user = dbr();
		if($user) 
		{
			$returntext = "Login name already taken"
			."<br><br><a href=javascript:history.back()>Back to Sign-up Form</a>";
			return $returntext;
		}

		if($email_address != $email_address_verify) 
		{
			$returntext = "The email addresses you entered did not match."
			."<br><br><a href=javascript:history.back()>Back to Sign-up Form</a>";
			return $returntext;
		}

		$email_address = strtok($email_address," ,");

		// check for existing email_address 
		db(__FILE__,__LINE__,"select login_id from srbase_users_accounts where email_address = '$email_address'");
		$user = dbr();
		if($user) 
		{
			$returntext = "There is already an account with that email address"
			."<br><br><a href=javascript:history.back()>Back to Sign-up Form</a>";
			return $returntext;
		}

		if($disc != 1) 
		{
			$returntext = "You must agree to the Server Rules & Disclaimer!"
			."<br><br><a href=javascript:history.back()>Back to Sign-up Form</a>";
			return $returntext;
		}
	}

	// function to generate an authorisation code
	function make_confirmation_code() 
	{
		$chars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHUJKLMNOPQRSTUVWXYZ';
		$retval='';
		for ($i=0 ; $i<12 ; $i++) 
		{
			$retval .= substr($chars,mt_rand(0,strlen($chars)-1),1);
		}
		return $retval;
	}

	// function to check email is valid
	function is_valid_email($email) 
	{
		return preg_match('/^([a-z0-9\-_\.\&]+)@([a-z0-9\-]+\.)+[a-z]+$/',$email);
	}

}

?>