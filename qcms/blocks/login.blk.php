<?php

// REM: the only thing a block file is does is gather data, assign template variables
// the external block code will automatically grab and parse the actual template for the block

$sessionvalid = "";

//echo($_sid); exit();

if($_SESSION['authenticated'] == "true") 
{
	$qcms_t->assign("sessionvalid", "true");
	$qcms_t->assign("username", $_SESSION['login_name']);
}
elseif((empty($_SESSION['authenticated']) || $_SESSION['authenticated'] == "false") && $_SESSION['authenticated'] != "true" && isset($_sid)) 
{
	// generate a challenge string and delete older challenges/challanges from same session stored on database
	$challenge = md5(uniqid(mt_rand(), true));
	$delay = time() - 300;
	db(__FILE__,__LINE__,"delete from srbase_challenge_record where sessid = '$_sid' or timestamp <= '$delay'");
	db(__FILE__,__LINE__,"insert into srbase_challenge_record (sessid, challenge, timestamp) values ('$_sid' ,'$challenge', '".time()."')");
	$qcms_t->assign("sessionvalid", "false");
	$qcms_t->assign("cookie_value_loginname", $_COOKIE['login_name']);
	$qcms_t->assign("challenge", $challenge);
}

$count_users_limit = time() - 600;
db(__FILE__,__LINE__,"select count(login_id) as onlineusers from srbase_users_accounts where session_exp > '$count_users_limit'");
$dat = dbr();
$qcms_t->assign("users_online", $dat['onlineusers']);



?>