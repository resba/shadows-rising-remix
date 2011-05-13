<?php

/*
// 

File:				install.php
Objective:			Opening installation step - configuration
Version:			SR-RPG (Game Engine) 0.0.4
Author:				Maugrim The Reaper
Edited by:			Maugrim The Reaper
Date Committed:		17 August 2004		
Last Date Edited:	n/a

~~~~~~~~~~~~~~~~~~~~~~~~~
Copyright (c) 2004 by:
~~~~~~~~~~~~~~~~~~~~~~~~~
Pádraic Brady (Maugrim)
Shadows Rising Project
~~~~~~~~~~~~~~~~~~~~~~~~~
(All rights reserved)
~~~~~~~~~~~~~~~~~~~~~~~~~

This program is free software. You can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the XXX; either version 1 of the License, or (at your option) any later version.  

Note that all changes to this file, if distributed/displayed/presented in 
any way whether to associates or the general public must contain a mechanism 
to download the source code containing such changes. Removal of this notice, 
or any other copyright/credit notice displayed by default in the output to 
this source code immediately voids your rights under the Affero General Public License.

//
*/

require_once("install.inc.php");

		if($CONFIG['game_installed'] == 1 && $server_passwd != $CONFIG['adminpass']) 
		{
			$sr->assign("post_action", "install_server.php");
			$sr->display("passwd_form.tpl.html");
			exit();
		}

switch($install_step) 
{
	case "1":

		$configfile_writeable = (bool) is_writeable("../qlib/config/config.inc.php");
		$safemode_status = (bool) ini_get('safe_mode');
		$reglobals_status = (bool) ini_get('register_globals');

		// connect to database using configuration options set in previous steps
		$db = db_connect($CONFIG['database_host'], $CONFIG['database_user'], $CONFIG['database_password'], $CONFIG['database'], $CONFIG['database_persistent']);




		$warnings = array();
		$notices = array();

		if($configfile_writeable === true) 
		{
			array_push($notices, "The $app install utility has detected that the &quot;<span style=\"color: #c0c0c0;\">config.inc.php</span>&quot; configuration file is currently writeable. As noted after configuration, you should set this file's permissions to prevent unauthorised alterations or access by external users. This measure will protect the sensitive database access information, admin password, and other sensitive information from falling into the wrong hands.");
		}

		if(!empty($warnings)) 
		{
			$warning_count = count($warnings);
			$sr->assign("warning_count", $warning_count);
			$sr->assign("warning_flag", "true");
			$sr->assign("warnings", $warnings);
		}
		else
		{
			$sr->assign("warning_flag", "false");
		}
		if(!empty($notices)) 
		{
			$notice_count = count($notices);
			$sr->assign("notice_count", $notice_count);
			$sr->assign("notice_flag", "true");
			$sr->assign("notices", $notices);
		}
		else
		{
			$sr->assign("notice_flag", "false");
		}

		$sr->display("server_option_form.tpl.html");
		exit();

	
	break;

	case "2":


		// connect to database using configuration options set in previous steps
		$db = db_connect($CONFIG['database_host'], $CONFIG['database_user'], $CONFIG['database_password'], $CONFIG['database'], $CONFIG['database_persistent']);

		// NOTE: Since we need to flush each query and it's status after each request - we will fetch (rather
		// than display) the template for the opening page segment which parses the template and stores it
		// in a variable. Then we print the variable output, execute the SQL dumpfiles (which will output a 
		// tidy list of results) and finally fetch and print the closing page segment.

		if(!empty($_POST['keep_users']) && $_POST['keep_users'] == 1)
		{
			$opening_template_output = $sr->fetch("server_install_top.tpl.html");
			print($opening_template_output);
			flush();
			ExecSQL ("base_server.sql", "", "");
			ExecSQL ("module_srmodule.sql", "", "");
			ExecSQL ("game_tables.sql", "", "");
			ExecSQL ("forum_tables.sql", "", "");
			$p_md5admpass = md5($p_admpass);
			dbn(__FILE__,__LINE__,"update srbase_users_accounts set passwd = '$p_md5admpass' where login_id = 1");
			$sr->assign("new_admpass", $p_admpass);
			$closing_template_output = $sr->fetch("server_install_bottom.tpl.html");
			print($closing_template_output);
			flush();
			exit();
		}
		else
		{
			$opening_template_output = $sr->fetch("server_install_top.tpl.html");
			print($opening_template_output);
			flush();
			ExecSQL ("base_server.sql", "", "");
			ExecSQL ("base_userspecific.sql", "", "");
			ExecSQL ("module_srmodule.sql", "", "");
			ExecSQL ("forum_tables.sql", "", "");
			ExecSQL ("game_tables.sql", "", "");
			$p_md5admpass = md5($p_admpass);
			dbn(__FILE__,__LINE__,"update srbase_users_accounts set passwd = '$p_md5admpass' where login_id = 1");
			$sr->assign("new_admpass", $p_admpass);
			$closing_template_output = $sr->fetch("server_install_bottom.tpl.html");
			print($closing_template_output);
			flush();
			exit();
		}
	    

	break;


	case "3":


	break;


	case "4":


	break;

}


				////////////////////////////////
				//// Start of function list ////
				////////////////////////////////

// SplitSqlFile: A modified version of PhpMyAdmins PMA_splitSqlFile() function. Who better to turn to for handling
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
// If set, will perform a preg_replace to replace $replace with $with (for new_game.sql). This will update the loaded
// SQL file for the relevant db_name provided.

function ExecSQL ($filename, $replace, $with) {
	global $db , $CONFIG, $sr;
	$file = fopen($CONFIG['sql_path'].'/'.$CONFIG['db_type'].'/'.$filename, 'rb');
    $sql_query = fread($file, filesize($CONFIG['sql_path'].'/'.$CONFIG['db_type'].'/'.$filename));
    fclose($file);
	$pieces       = array();
	SplitSqlFile($pieces, $sql_query, '32300');
	$pieces_count = count($pieces);

	print("
		<table class=\"invisible\" style=\"text-align: left;\">
			<tr>
				<td>
					<p class=\"h3\">Running $CONFIG[db_type] -> $filename</p>
				</td>
			</tr>
	");
	flush();

	for ($i = 0; $i < $pieces_count; $i++) 
	{
		$a_sql_query = $pieces[$i];
		if(isset($replace) && isset($with) && $replace != "" && $with != "") {
			$a_sql_query = preg_replace($replace, $with, $a_sql_query);
		}
		//for non-AdoDB users, use mysql_query() plus commented-out error mesg
		$result = $db->Execute($a_sql_query); 
		if ($result == FALSE) 
		{ 
			print("
				<tr>
					<td style=\"width: 70%;\">
						" . strip_tags($a_sql_query) . ";
					</td>
					<td style=\"width: 30%;\">
						<div style=\"color: red;\">
						Query Error in Execution!<br />
						<span style=\"color: yellow;\">
						Execution Error:<br />".$db->ErrorMsg()."
						</span></div>
					</td>
				</tr>
			</table>
			");
			flush();
			exit();
		}
		else 
		{
			print("
				<tr>
					<td width=\"70%\">
						" . strip_tags($a_sql_query) . ";
					</td>
					<td style=\"width: 30%;\">
						<div style=\"color: lightgreen;\">
						Successfully Executed!
						</div>
					</td>
				</tr>
			"); 
			flush();
		}
	}
	unset($pieces);
	if($pieces_count == 0) 
	{
		print("
			</table>
			<p class=\"h3\">
			<span style=\"color: red;\">Warning!</span> The Install Utility was unable to execute any queries from &quot;$CONFIG[db_type] -> $filename&quot;. Please double check that the configuration file contains valid database details for username, password and database. Please note that the database must be created BEFORE beginning the installation of database tables.
			</p>
		");
		flush();
	}
	else 
	{
		print("
			</table>
			<p class=\"h3\">
			$pieces_count Queries successfully completed!
			</p>
		");
		flush();	
	}
}

?>