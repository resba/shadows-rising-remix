<?php

////////////////////////////////////////////////////////////////////////////////////////////
// Filename : create_game.php															  //
// Purpose : Add/Delete QS games														  //
// Author : Maugrim The Reaper															  //
// Date : 21 October 2003																  //
// Version : 2.2.2																		  //	
//																						  //
// This code is freely available to the public on the condition that the GPL license	  //
// attached to the PHPMyAdmin function is respected and this notice is not deleted or	  //
// unjustifiably modified.																  //
////////////////////////////////////////////////////////////////////////////////////////////

error_reporting  (E_ERROR | E_PARSE);

if ((!isset($_POST['server_passwd'])) || ($_POST['server_passwd'] =='')) //check config based passwd
{
    if (isset($_POST['_adminpass']))
    {
        $server_passwd = $_POST['_adminpass'];
    }
    else
    {
        $server_passwd = '';
    }
}
else
{
    $server_passwd = $_POST['server_passwd'];
}

if ((!isset($_POST['step'])) || ($_POST['step'] =='')) //check all incoming form vars
{
    $step = "1";
}
else
{
    $step = $_POST['step'];
}

if ((!isset($_POST['data'])) || ($_POST['data'] ==''))
{
    $_POST['data'] = "";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $local_charset; ?>">
  <meta http-equiv="Pragma" content="no-cache">
  <link rel="stylesheet" href="styles/style1.css" type="text/css">
  <title>Shadows Rising RPG Game Engine Game Management Utility</title>
 </head>
<body id="default_body">

<div align="center"><b><h1>Shadows Rising RPG Game Engine Game Management Utility</h1></b></div>

<?php

$dbs = array('mysql' => 'MySQL', 'postgres' => 'PostgreSQL ver &lt; 7', 'postgres7' => 'PostgreSQL ver 7 and up');

$showit = 1;
$adminpass = ''; 
include ("qlib/config/config.inc.php");

if (($CONFIG['game_installed'] == 1 && $_POST['server_passwd'] != $CONFIG['adminpass'] && $step !='1') || isset($_POST['game_installed']) || isset($_GET['game_installed']))
{
    echo "<B>Hacking attempt</B>";
    include ("footer.php");
    die();
}



switch($step)
{
case "1": //check the pass, ask if delete/add game

        echo "<br />";

        if ($_POST['server_passwd'] != $CONFIG['adminpass'])  
        {
            echo "In order to add/delete games you must enter the server password: ";
            echo "<form action=\"create_game.php\" method=\"post\"><input type=password name=server_passwd value=\"\">&nbsp;";
            echo "<input type=submit value=\"Submit\"></form>";
            $showit = 0;
        }

		if ($showit == 1)     // Preparing values for the form
        {
			
			echo "<form action=\"create_game.php\" method=\"post\"><div align=\"center\"><table cellspacing=0 cellpadding=3 width=75%><tr><td>"

			."Choose below which action you wish to make: ";

			echo "<br /><br />Create a Game&nbsp;&nbsp;&nbsp;<input type=radio name=step value=\"2\">";
			echo "<br /><br />Delete a Game&nbsp;&nbsp;&nbsp;<input type=radio name=step value=\"3\">";
            echo "<input type=hidden name=\"server_passwd\" value=\"$server_passwd\">";
			
			echo "<br /><br /><input type=submit value=\"Submit\"></form>";


			echo "</td></tr></table></div>";
		
		}
    
    echo "<br /><br />";
break;


case "2": //ask details for new game

			
	echo "<form action=\"create_game.php\" method=\"post\"><div align=\"center\"><table cellspacing=0 cellpadding=3 width=75%><tr><td>"

	."<small>Other options can later be set from the game's internal Admin Menu.</small><br /><br />Please enter the game details below: ";

	echo "<br /><br /><table cellspacing=0 cellpadding=3 width=100%>";

	echo "<tr><td width=1% nowrap>Name of Game:<td width=10></td><td align=left nowrap><input type=text size=50 name=_name value=\"\"></td></tr>";
	echo "<tr><td width=1% nowrap>Game database prefix:<td width=10></td><td align=left nowrap><input type=text size=50 name=_dbname value=\"\"></td></tr>";
	echo "<tr><td width=1% nowrap>Admin name:<td width=10></td><td align=left nowrap><input type=text size=50 name=_adname value=\"\"></td></tr>";
	echo "<tr><td width=1% nowrap>Admin password:<td width=10></td><td align=left nowrap><input type=password size=50 name=_adpass value=\"\"></td></tr>";
	echo "<tr><td width=1% nowrap>Admin email:<td width=10></td><td align=left nowrap><input type=text size=50 name=_email value=\"\"></td></tr>";
	echo "<tr><td width=1% nowrap>Game length (days):<td width=10></td><td align=left nowrap><input type=text size=2 name=_length value=\"30\"></td></tr>";
	echo "<tr><td width=1% nowrap>No. of *Daily* Maints per day:<td width=10></td><td align=left nowrap><input type=text size=2 name=_maints value=\"3\"> - The daily_maint.php maint should be run 3 times daily. The hourly_maint.php maint should be run twice per hour.</td></tr>";
	echo "<tr><td width=1% nowrap>Hide Game?<td width=10></td><td align=left nowrap>Yes:<input type=radio name=_status value=\"0\">&nbsp;&nbsp;&nbsp;No:<input type=radio name=_status value=\"1\" checked></td></tr>";

	echo "</table><br />";

	echo "<input type=hidden name=\"step\" value=\"4\">";
    echo "<input type=hidden name=\"server_passwd\" value=\"$server_passwd\">";
			
	echo "<br /><br /><input type=submit value=\"Submit\"></form>";

	echo "</td></tr></table></div>";
    
    echo "<br /><br />";
break;



case "3": //ask game to delete


	echo "<form action=\"create_game.php\" method=\"post\"><div align=\"center\"><table cellspacing=0 cellpadding=2 width=75%><tr><td>";
	echo "Please choose which game you wish to delete. Deleting this game will all the game tables and game data from the database. If you only wish to reset the game, you can do this from the in-game Administration menu.<br /><br />";

	/*if($database_persistent == 1) 
	{
		$link = mysql_pconnect($database_host, $database_user, $database_password);
	}
	else
	{
		$link = mysql_connect($database_host, $database_user, $database_password);
	}
	mysql_select_db(__FILE__,__LINE__,$database);*/

	include_once("includes/db_funcs.inc.php");
	$db = db_connect($database_host, $database_user, $database_password, $database, 0);
	
	echo "<table cellspacing=0 cellpadding=2 style=\"border : thin solid #444444;\" width=70%>";
	echo "<tr><th valign=top colspan=5 style=\"background-color: #444444; border-bottom: thin solid #444444\">";
	echo "Game Listing</th></tr>"; //1

	db2(__FILE__,__LINE__,"SELECT game_id, name, db_name, paused, status FROM se_games");
	

	while ($game_stat = dbr2()){
		$p_sed = "";
		if($game_stat['paused'] == 1){
			$p_sed = "<td style=\"border-right: thin solid #444444;\">Paused</td>";
		} else {
			db(__FILE__,__LINE__,"select value from ${game_stat['db_name']}_db_vars where name = 'sudden_death'");
			$sd = dbr();

			if($sd['value'] == 1){
				$p_sed = "<td style=\"border-right: thin solid #444444;\">Sudden Death</td>";
			} else {
				$p_sed = "<td style=\"border-right: thin solid #444444;\">In Progress</td>";
			}
		}
		if($game_stat['status'] == 0) {
			$p_sed = "<td style=\"border-right: thin solid #444444\">Offline</td>";
		}
		echo "<tr><td style=\"border-right: thin solid #444444;\">$game_stat[name]</td>".$p_sed."<td style=\"border-right: thin solid #444444;\"><input type=radio name=_gamedel value=$game_stat[game_id]></td></tr>";

	}
	
	echo "</table><br />";

	echo "<input type=hidden name=\"step\" value=\"5\">";
    echo "<input type=hidden name=\"server_passwd\" value=\"$server_passwd\">";
			
	echo "<br /><br /><input type=submit value=\"Delete\"></form>";

	echo "</td></tr></table></div>";
    
    echo "<br /><br />";


break;



case "4": // add new game to se_game, create game tables


	echo "<div align=\"center\"><table cellspacing=0 cellpadding=2 width=75%><tr><td>";
	echo "<h2>Installing New Game...</h2>";

	#if($database_persistent == 1) 
	#{
	#	$link = mysql_pconnect($database_host, $database_user, $database_password);
	#}
	#else
	#{
	#	$link = mysql_connect($database_host, $database_user, $database_password);
	#}
	#mysql_select_db(__FILE__,__LINE__,$database);

	include_once("includes/db_funcs.inc.php");
	$db = db_connect($database_host, $database_user, $database_password, $database, 0);

	ExecSQL("new_game.sql", "/QUANTUM/", $_dbname); //need to change for non-QS default prefix

	if($var_source == 0) //create the db_vars file if required, located in db_name maps folder for want of a better loc
	{
		if(!is_dir("$map_path/$_dbname")) 
		{
			mkdir("$map_path/$_dbname");
		}
		
		db2(__FILE__,__LINE__,"select name,value from ${_dbname}_db_vars order by name");
		$file_loc = "$map_path/$_dbname/db_vars.inc.php";
		$stream = @fopen($file_loc, "w");
		if(empty($stream)) 
		{
			echo "Unable to create db_vars.inc.php in the specified location.<p>Ensure you have set the necassary permissions, and that the sub-directory $_dbname does exist in the Maps directory.";
			exit;
		} 
		elseif (!is_writable($file_loc)) 
		{
			echo "Unable to write to the specified file for some reason. Ensure permissions are valid.";
			exit;
		}
		$output_str = "<?php\n//Database: $db_name, ".date("F j, Y, g:i:s a")."\n\n";
		while($db_var = dbr2()) 
		{
			$output_str .= "\$$db_var[name] = '$db_var[value]';\n";
		}
		if(!fwrite($stream, $output_str."?>")) //stupid end php tag ends code colouring again...:)
		{
			echo "For some reason the db_vars.inc.php could not be written to. Ensure permissions are valid.";
		}
		else 
		{
			echo "<h3>Variables successfully created for Database <b>$_dbname</b></h3>";
		}
	}

	dbn(__FILE__,__LINE__,"INSERT INTO se_games (name, db_name, admin_name, admin_pw, admin_email, game_length_days, day_maint_cnt, status) VALUES ('$_name', '$_dbname', '$_adname', '$_adpass', '$_email', '$_length', '$_maints', '$_status')");

	echo "<h3>Game added to game listing!</h3>";

	echo "Your new game has now been added to the Game listing. All tables required to run the game have been installed. To log in and prepare the game for your users, login in as Admin and use the game specific password you specified in the game options part of this process.";

	echo "<br /><br /><a href=\"create_game.php\" target=\"_self\">Return to Create Game menu</a><br /><br /><a href=\"game_listing.php\" target=\"_self\">View Game Listing</a></td></tr></table>";


break;



case "5": // delete game se_games, delete game tables


	echo "<div align=\"center\"><table cellspacing=0 cellpadding=2 width=75%><tr><td>";
	echo "<h2>Deleting Game...</h2>";

	include_once("includes/config/config.inc.php");
	include_once("includes/db_funcs.inc.php");
	$db = db_connect($database_host, $database_user, $database_password, $database, 0);


	db(__FILE__,__LINE__,"SELECT * FROM se_games	WHERE game_id = '$_gamedel'");
	$del_dbname = dbr();

	
	// Important - section relies on db_name not similar to any other table names - so use a specific db_name!
	$lisstt = list_db_tables($database);
	$f = 0;

	// Following improvement over the original code ruling table deletion credited
	// to Karrade (http://www.karrade.net/) - 31 Oct 2003

	foreach ($lisstt as $t){
	   if (strpos(" $t", $del_dbname['db_name']."_") == 1){
	         dbn(__FILE__,__LINE__,"DROP TABLE $t");
	         echo "$t has been dropped from the database<br />";
	   }
	}

	/*while($lisstt) 
	{
		if(empty($lisstt[$f])) 
		{
			break;
		}
		elseif(ereg($del_dbname['db_name'],$lisstt[$f])) 
		{
			dbn(__FILE__,__LINE__,"DROP TABLE $lisstt[$f]");
			echo "$lisstt[$f] has been dropped from the database<br />";
			$f++;
		}
		else 
		{
			$f++;
			next;
		}
	}*/

	dbn(__FILE__,__LINE__,"DELETE FROM se_games WHERE game_id = '$_gamedel'");

	$map_del_txt = clear_images("$map_path/$del_dbname[db_name]");
	echo $map_del_txt;

	echo "<h3>The Game has been deleted!</h3>";

	echo "The game you chose has now been deleted. You should check all maps were deleted from your filesystem correctly, also the game folder will need to be manually deleted unless you plan on using it again. You may return to the Game Management menu to delete another game or create a replacement game as if you so choose. Thank you for using the Quantum Star Game Managment Utility!";

	echo "<br /><br /><a href=\"create_game.php\" target=\"_self\">Return to Game Management menu</a><br /><br /><a href=\"game_listing.php\" target=\"_self\">View Game Listing</a></td></tr></table>";


break;

}


include ("footer.php");


				

				////////////////////////////////
				//// Start of function list ////
				////////////////////////////////

// SplitSqlFile: A modified version of PhpMyAdmin's PMA_splitSqlFile() function. Who better to turn to for handling
// SQL files?? Released under the GNU GENERAL PUBLIC LICENSE.


    function SplitSqlFile(&$ret, $sql, $release)
    {
        $sql          = trim($sql);
        $sql_len      = strlen($sql);
        $char         = '';
        $string_start = '';
        $in_string    = FALSE;
        $time0        = time();
        for ($i = 0; $i < $sql_len; ++$i) {
            $char = $sql[$i];
            if ($in_string) {
                for (;;) {
                    $i         = strpos($sql, $string_start, $i);
                    if (!$i) {
                        $ret[] = $sql;
                        return TRUE;
                    }
                    else if ($string_start == '`' || $sql[$i-1] != '\\') {
                        $string_start      = '';
                        $in_string         = FALSE;
                        break;
                    }
                    else {
                        $j                     = 2;
                        $escaped_backslash     = FALSE;
                        while ($i-$j > 0 && $sql[$i-$j] == '\\') {
                            $escaped_backslash = !$escaped_backslash;
                            $j++;
                        }
                        if ($escaped_backslash) {
                            $string_start  = '';
                            $in_string     = FALSE;
                            break;
                        }
                        else {
                            $i++;
                        }
                    }
                }
            }
            else if ($char == ';') {
                $ret[]      = substr($sql, 0, $i);
                $sql        = ltrim(substr($sql, min($i + 1, $sql_len)));
                $sql_len    = strlen($sql);
                if ($sql_len) {
                    $i      = -1;
                } else {
                    return TRUE;
                }
            }
            else if (($char == '"') || ($char == '\'') || ($char == '`')) {
                $in_string    = TRUE;
                $string_start = $char;
            }
            else if ($char == '#'
                     || ($char == ' ' && $i > 1 && $sql[$i-2] . $sql[$i-1] == '--')) {
                $start_of_comment = (($sql[$i] == '#') ? $i : $i-2);
                $end_of_comment   = (strpos(' ' . $sql, "\012", $i+2))
                                  ? strpos(' ' . $sql, "\012", $i+2)
                                  : strpos(' ' . $sql, "\015", $i+2);
                if (!$end_of_comment) {
                    if ($start_of_comment > 0) {
                        $ret[]    = trim(substr($sql, 0, $start_of_comment));
                    }
                    return TRUE;
                } else {
                    $sql          = substr($sql, 0, $start_of_comment)
                                  . ltrim(substr($sql, $end_of_comment));
                    $sql_len      = strlen($sql);
                    $i--;
                }
            }
            else if ($release < 32270
                     && ($char == '!' && $i > 1  && $sql[$i-2] . $sql[$i-1] == '/*')) {
                $sql[$i] = ' ';
            }
            $time1     = time();
            if ($time1 >= $time0 + 30) {
                $time0 = $time1;
                header('X-pmaPing: Pong');
            }
        }
        if (!empty($sql) && ereg('[^[:space:]]+', $sql)) {
            $ret[] = $sql;
        }
    
        return TRUE;
    }


// Overall exec function for SQL files - Maugrim The Reaper 21 Aug 2003
// If set, will perform a preg_replace to replace $replace with $with (for new_game.sql)

function ExecSQL ($filename, $replace, $with) 
{
	global $database,$sql_path,$code_base,$db,$db_type;
	$file = fopen($sql_path.'/'.$db_type.'/'.$filename, 'rb');
    $sql_query = fread($file, filesize($sql_path.'/'.$db_type.'/'.$filename));
    fclose($file);
	if(isset($replace) && isset($with)) 
	{ //preg_replace on new_game.sql
		$sql_query = preg_replace($replace, $with, $sql_query);
	}
	$pieces = array();
	SplitSqlFile($pieces, $sql_query, '32300');
	$pieces_count = count($pieces);
	echo "<h2>Running $db_type -> $filename</h2><table width=100%>";
	for ($i = 0; $i < $pieces_count; $i++) 
	{
		$a_sql_query = $pieces[$i];

		//for non-AdoDB users, use mysql_query() plus commented-out error mesg & success mesg
		$result = $db->Execute($a_sql_query); 
		if ($result == FALSE) 
		{ 
			print  "<tr><td width=80%>".strip_tags($a_sql_query).";</td><td width=5></td><td width=1% nowrap><font color=red>Query Error in Execution!</font><br /><font color=yellow>Execution Error:<br />".$db->ErrorMsg()."</font></td></tr>"; 
			flush();
			exit;
		}
		else 
		{
			print  "<tr><td width=80%>".strip_tags($a_sql_query).";</td><td width=5></td><td width=1% nowrap><font color=blue>Successfully Executed!</font></td></tr>"; flush();
		}
		#if ($result == FALSE) //the non_Adodb mesg
		#{
		#	echo "Database Failure.<br /><br />Query:<br />$a_sql_query<br /><br /> MySQL Error Num:<br />".mysql_errno()."<br /><br />Mysql Error:<br />".mysql_error();
		#	require_once("footer.php");
		#	exit;
		#}
		#print  "<tr><td width=80%>".strip_tags($a_sql_query).";</td><td width=5></td><td width=1% nowrap><font #color=blue>Successfully Executed!</font></td></tr>"; flush();
	}
	unset($pieces);
	echo "</table><h2>$pieces_count Queries successfully completed!</h2>";
}


// function to delete images from the maps folder for game being deleted
function clear_images($path) 
{
	$dir = opendir($path);
	$message .= "<p>";
	while($filename = readdir($dir)) 
	{
		if(eregi("\\.png$", $filename)) 
		{
			unlink("$path/$filename");
			$message .= "<br />$path/$filename - deleted";
		}
	}
	$message .= "</p>";
	closedir($dir);
	Return $message;
}

?>