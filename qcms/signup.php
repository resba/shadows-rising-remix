<?
/*
// 
File:			signup.php
Objective:		Process to sign up new players to server
Version:		QS 2.2 Beta
Author:			Maugrim_The_Reaper (maugrimtr@hotmail.com)
Date Committed:	5 October 2003	Date Modified:	24 April 2004

Copyright (c) 2003, 2004 by Pádraic Brady

This program is free software. You can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation.
//
*/

require_once("cms.inc.php");
//require_once("includes/auth.inc.php");

//$db = db_connect($database_host, $database_user, $database_password, $database, $database_persistent);

$_POST['l_name'] = trim($_POST['l_name']);

$validate = new Q_ValidateSignup();
$validate->ValidateSignup($_POST['l_name'], $_POST['first_name'], $_POST['last_name'], $_POST['passwd'], $_POST['passwd_verify'], $_POST['email_address'], $_POST['email_address_verify'], $_POST['disc']);

$encrypt_passwd = md5($_POST['passwd']);

if($_POST['aim'])
{
	$aim_show=1;
} 
else 
{
	$aim_show=0;
}

if($_POST['icq'])
{
	$icq_show=1;
} 
else 
{
	$icq_show=0;
}

$signed_up = time();

if ($sendmail == 1)
{
	$auth = $validate->make_confirmation_code();
}


dbn(__FILE__,__LINE__,"insert into ${db_tag}_users_accounts (login_name, passwd, auth, signed_up, first_name, last_name, email_address, aim, icq, msn, yim, country) values('$_POST[l_name]', '$encrypt_passwd', '$auth', '$signed_up', '$_POST[first_name]', '$_POST[last_name]', '$_POST[email_address]', '$_POST[aim]', '$_POST[icq]', '$_POST[msn]', '$_POST[yim]', '$_POST[country]')");
$login_id = db_insert_id();
db(__FILE__,__LINE__,"select configvalue FROM ${db_tag}_forum_config where configname='defaultusergroup' and ingame=0 limit 1");
$row = dbr();
dbn(__FILE__,__LINE__,"insert into ${db_tag}_forum_group_users (group_id, user_id, group_leader) VALUES ({$login_id}, {$row['configvalue']}, 0)");
unset($row);


if ($sendmail == 1)
{
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: $CONFIG[server_name] <$CONFIG[admin_mail]>\r\n";
	mail($_POST['email_address'], "Quantum Star SE Authorisation Code","A new account has been created on ${url_prefix} for you. \nFrom this account you may join games on the server. \nYour login name is $_POST[l_name]. \nYour Authorization code is $auth. \nYou will need it to log in the first time. \nWelcome to the Server.", $headers);
}

//insert_history($_POST['l_name'],"Created Account");

// print the page header and top table
Print_CMS_Header("Shadows Rising :: Account Created", "style01.css");

echo "Congratulations, your account has been set up.";
if ($sendMail == 1) 
{
	echo "<br>An Authorisation code has been sent to you via email. &nbsp;You will need it the first time you log in.";
}
echo "<br><a href=\"". $CONFIG['url_prefix'] ."/qcms/index.php\">Click Here</a> to return to the login page.";

print_footer();
?>