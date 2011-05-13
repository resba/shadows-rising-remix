<?php

$gameindex = array();

db3(__FILE__,__LINE__,"select * from srbase_game_index where hidden = 0 order by game_id asc");
while($game = dbr3()) {
	$game['start_date'] = date($game['start_date']);
	$game['player_count'] = dbc(__FILE__,__LINE__,"select * from srbase_{$game['module']}_{$game['instance']}_characters");
	$game['location_count'] = dbc(__FILE__,__LINE__,"select * from srbase_{$game['module']}_{$game['instance']}_locations");
	$game['paused'] = $game['paused'];
	$game['type'] = $game['module'];
	if(ValidUser()) 
	{
		$game['showlink'] = "true";
		db(__FILE__,__LINE__,"select login_id from srbase_{$game['module']}_{$game['instance']}_characters where login_id = '$_SESSION[login_id]'");
		$gamecheck = dbr();
		if(empty($gamecheck))
		{
			$game['link'] = $CONFIG['url_prefix'] . "/qcms/module.php?dir=Game_Index&amp;op=join&amp;id=" . $game['game_id'];
			$game['link_name'] = "Join Game";
		}
		else 
		{
			$game['link'] = $CONFIG['url_prefix'] . "/qcms/module.php?dir=Game_Index&amp;op=enter&amp;id=" . $game['game_id'];
			$game['link_name'] = "Enter Game";
		}
	}
	else 
	{
		$game['showlink'] = "false";
	}
	array_push($gameindex, $game);
}

$qcms_t->assign("gameindex", $gameindex);

$M_OUTPUT .= $qcms_t->fetch("$modules_dir/$module[directory]/templates/game_listing.tpl.html");

?>