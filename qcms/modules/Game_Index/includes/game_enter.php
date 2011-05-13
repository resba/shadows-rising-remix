<?php

// check that the url contains a valid value for $id (must be >0)
if(!isset($_GET['id']) || $_GET['id'] == 0) 
{
	$M_OUTPUT .= "Error! The url you used was invalid. Please try again using a valid url, or contact the local Administrator(s) for further help.";
}

db(__FILE__,__LINE__,"select * from srbase_game_index where game_id = '$_GET[id]'");
$game = dbr();

//generate the database prefix for the game tables
$gameinstance = "srbase_" . $game['module'] . "_" . $game['instance'];

//generate the database prefix for the game module tables
$moduleinstance = "srbase_" . $game['module'];
	
//add this data to user session
$_SESSION['gameinstance'] = $gameinstance;
$_SESSION['moduleinstance'] = $moduleinstance;
	
//double check player is registered on game
db(__FILE__,__LINE__,"select login_id from ${gameinstance}_characters where login_id = '$_SESSION[login_id]'");
$check_user = dbr();
if(empty($check_user)) 
{
	$M_OUTPUT .= "Error! It appears that you are not already registered in this game. You must join a game before you are granted access to enter it.";	
}
	
// set session to state user is now "in a game"
$_SESSION['ingame'] = "true";
$_SESSION['game_id'] = $game['game_id'];
$_SESSION['game'] = $game;

// redirect user to the CORE
echo "<script>self.location='$CONFIG[url_prefix]/core/location.php';</script>";

?>