<?php

// check that the url contains a valid value for $id (must be >0)
	
if(empty($_GET['id'])) 
{
	$M_OUTOUT .= "Error! The url you used was invalid. Please try again using a valid url, or contact the local Administrator(s) for further help.";
}
db(__FILE__,__LINE__,"select * from srbase_game_index where game_id = '$_GET[id]'");
$game = dbr();

//pass data in session
$_SESSION['game_id'] = $game['game_id'];

$qcms_t->assign("game", $game);

$M_OUTPUT .= $qcms_t->fetch("$M_DIR/templates/game_joinconfirm.tpl.html");

?>