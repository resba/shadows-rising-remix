<?php

//generate the database prefix for the game tables
$gameinstance = "srbase_" . $game['module'] . "_" . $game['instance'];

//generate the database prefix for the game module tables
$moduleinstance = "srbase_" . $game['module'];

//add this data to user session
$_SESSION['gameinstance'] = $gameinstance;
$_SESSION['moduleinstance'] = $moduleinstance;
	
//double check player not already registered on game
db(__FILE__,__LINE__,"select login_id from ${gameinstance}_characters where login_id = '$_SESSION[login_id]'");
$check_user = dbr();
if(!empty($check_user)) 
{
	$M_OUTPUT .= "Error! It appears that you are already registered in this game. You can login from the Game Index and are not required to rejoin.";	
}

//add user to this game
dbn(__FILE__,__LINE__,"insert into ${gameinstance}_characters (login_id, login_name, char_check) values ('$_SESSION[login_id]', '$_SESSION[login_name]', '0')");

//Show confirmation message
$M_OUTPUT .= "Congratulations! You have joined the game \"<b>$game[name]</b>\" and can now enter the game to create your character profile before beginning to play. The Administrators wish you the best of luck!";

?>