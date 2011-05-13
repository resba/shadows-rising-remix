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
or any other copyright/credit notice displayed by default or specifically linked to 
in the output to this source code immediately voids your rights under the GNU 
General Public License.

//
*/

require_once("install.inc.php");



		if($CONFIG['game_installed'] == 1 && $server_passwd != $CONFIG['adminpass']) 
		{
			$sr->assign("post_action", "install.php");
			$sr->display("passwd_form.tpl.html");
			exit();
		}

switch($install_step) 
{
	case "1":

		$safemode_status = (bool) ini_get('safe_mode');
		$reglobals_status = (bool) ini_get('register_globals');
		$templatedir_status = (bool) is_writeable("../qlib/smarty_dir/templates_c");
		$configdir_status = (bool) is_writeable("../qlib/config");
		$mapdir_status = (bool) is_writeable("../core/maps");

		$warnings = array();
		$notices = array();

		if($safemode_status === true) 
		{
			array_push($warnings, "The $app install utility has detected that your PHP configuration has the &quot;<span style=\"color: #c0c0c0;\">safe_mode</span>&quot; directive set to ON. Although this directive provides improved security, it prevents PHP applications from writing directly to the server hard-drive. Since $app generates map images, it will be necessary to either disable &quot;safe_mode&quot; or manually generate these maps offline, and upload them to the necessary directory.");
		}
		if($reglobals_status === false) 
		{
			array_push($warnings, "The $app install utility has detected that your PHP configuration has the &quot;<span style=\"color: #c0c0c0;\">register_globals</span>&quot; directive set to OFF. It is intended to support this PHP directive for $app, however it is possible this may still cause problems in $app's pre-alpha versions. If you experience problems - please re-enable this directive.");
		}
		if($templatedir_status === false) 
		{
			// since this check is to ensure the Smarty Template engine will function - we mush print this to the 
			// browser immediately from install.inc.php - especially since the templates for the Installation 
			// Utility will not work if templates_c is not writeable! The warning generated below will also appear
			// if a cached version of the install template already exists from a previous installation
			array_push($warnings, "The $app installation utility has detected that the &quot;<span style=\"color: #c0c0c0;\">/qlib/smarty_dir/templates_c</span>&quot; is not writeable. This directory is used to store cached templates used for generating XHTML output to the user's browser. If the directory cannot be written to, these templates will not be cached, and users will receive blank output to their browsers. Please make this directory writeable before continuing the installation.");
		}
		if($configdir_status === false) 
		{
			array_push($warnings, "The $app installation utility has detected that the &quot;<span style=\"color: #c0c0c0;\">/qlib/config</span>&quot; directory is not writeable. This directory is used to store the $app configuration file. Without a configuration file $app will be unable to function. Please make this directory writeable before continuing the installation.");
		}
		//if($mapdir_status === false) 
		//{
		//	array_push($notices, "The $app installation utility has detected that the &quot;<span style=\"color: #c0c0c0;\">/core/maps</span>&quot; directory is not writeable. This directory is used to store maps generated for a game. $app will be unable to generate maps until this directory is writeable. Please make this directory writeable before generating game maps.");
		//}

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

		$v = array();
		$v['1'] = isset($CONFIG['db_type']) ? $CONFIG['db_type'] : 'mysql';
		$v['2'] = isset($CONFIG['database']) ? $CONFIG['database'] : '';
		$v['3'] = isset($CONFIG['database_user']) ? $CONFIG['database_user'] : '';
		$v['4'] = isset($CONFIG['database_password']) ? $CONFIG['database_password'] : '';
		$v['5'] = isset($CONFIG['database_host']) ? $CONFIG['database_host'] : 'localhost';
		$v['6'] = isset($CONFIG['database_port']) ? $CONFIG['database_port'] : '';
		$v['7'] = isset($CONFIG['database_persistent']) && ($CONFIG['database_persistent'] == 0) ? '' : 'checked';
		$v['8'] = isset($CONFIG['gameroot']) ? $CONFIG['gameroot'] : dirname(str_replace("install","",$_SERVER["PATH_TRANSLATED"]));
		$v['10'] = isset($CONFIG['map_path']) ? $CONFIG['map_path'] : dirname(str_replace("install","",$_SERVER["PATH_TRANSLATED"]))."/core/maps";
		$v['12'] = isset($CONFIG['sendmail']) && ($CONFIG['sendmail'] > 0) ? 'checked' : '';
		$v['13'] = isset($CONFIG['server_name']) ? $CONFIG['server_name'] : 'My Server';
		$v['14'] = isset($CONFIG['url_prefix']) ? $CONFIG['url_prefix'] : 'http://';
		$v['15'] = isset($CONFIG['code_base']) ? $CONFIG['code_base'] : $this_version;
		$v['16'] = isset($CONFIG['link_forums']) ? $CONFIG['link_forums'] : 'http://www.shadowsrising.net';
		$v['17'] = isset($CONFIG['admin_mail']) ? $CONFIG['admin_mail'] : '';
		$v['18'] = isset($CONFIG['adminpass']) ? $CONFIG['adminpass'] : '';
		$v['19'] = isset($CONFIG['var_source']) && ($CONFIG['var_source'] > 0) ? 'checked' : '';
		$v['20'] = isset($CONFIG['sql_path']) ? $CONFIG['sql_path'] : dirname(str_replace("install","",$_SERVER["PATH_TRANSLATED"]))."/sql";
		$v['21'] = isset($CONFIG['enable_gzip']) && ($CONFIG['enable_gzip'] > 0) ? 'checked' : '';
		$v['22'] = isset($CONFIG['gzip_level']) ? $CONFIG['gzip_level'] : '';

		$sr->assign("v", $v);
		$sr->assign("post_action", "install.php");
		$sr->display("config_form.tpl.html");
		exit();
	
	break;

	case "2":

			// this section attempts to remove Windows slashes and replace with forward slashes (*nix style)
			$_POST['_gameroot'] = str_replace("//","/",str_replace("\\\\","/",$_POST['_gameroot']));
			$_POST['_map_path'] = str_replace("//","/",str_replace("\\\\","/",$_POST['_map_path']));
			$_POST['_sql_path'] = str_replace("//","/",str_replace("\\\\","/",$_POST['_sql_path']));

			// this section will remove the common problem of users adding additional slashes to paths/urls
			$_POST['_gameroot'] = rtrim($_POST['_gameroot'],'/\.');
			$_POST['_map_path'] = rtrim($_POST['_map_path'],'/\.');
			$_POST['_url_prefix'] = rtrim($_POST['_url_prefix'],'/\.');
			$_POST['_sql_path'] = rtrim($_POST['_sql_path'],'/\.');

		    if ($_POST['_database'] == '')
			{
				SystemMessage("<b>Database name cannot be empty! Click <a href=\"install.php\">here</a>.</b>");
			}
			elseif ($_POST['_gameroot'] == '')
			{
				SystemMessage("<b>Game root cannot be empty! Click <a href=\"install.php\">here</a>.</b>");
			}
			elseif ($_POST['_admin_mail'] == '')
			{
				SystemMessage("<b>Admin email cannot be empty! Click <a href=\"install.php\">here</a>.</b>");
			}
			elseif ($_POST['_adminpass'] == '')
			{
				SystemMessage("<b>Admin password cannot be empty! Click <a href=\"install.php\">here</a>.</b>");
			}
			elseif ($_POST['_adminpass'] != $_POST['adminpass2'])
			{
				SystemMessage("<b>Admin passwords don't match! Click <a href=\"install.php\">here</a>.</b>");
			}
			elseif ($_POST['_map_path'] == '')
			{
				SystemMessage("<b>Map path cannot be empty! Click <a href=\"install.php\">here</a>.</b>");
			}
			elseif ($_POST['_url_prefix'] == '')
			{
				SystemMessage("<b>URL prefix cannot be empty! Click <a href=\"install.php\">here</a>.</b>");
			}
			elseif ($_POST['_code_base'] == '')
			{
				SystemMessage("<b>Code base cannot be empty! Click <a href=\"install.php\">here</a>.</b>");
			}
			elseif ($_POST['_link_forums'] == '')
			{
				SystemMessage("<b>Forum link cannot be empty! Click <a href=\"install.php\">here</a>.</b>");
			}
			else 
			{
				clearstatcache();

				if(!is_dir("$_POST[_gameroot]/qlib/config")) 
				{
					mkdir("$_POST[_gameroot]/qlib/config", 0777);
				}

				$old_time = filemtime('../qlib/config/config.inc.php');

				$fs = @fopen('../qlib/config/config.inc.php', 'w+');

				$data = '';
				$data .= "<?php\n";
				$data .= "// Automatically created configuration file. Do not change!\n\n/*********************************************************\n*        !!! Shadows Rising RPG Configuration File !!!\n*\n*   Please consider each option carefully. 80% of all\n*   start up problems for SR are caused by wrongly set\n*   configuration variables.\n*\n*   Fill out all fields !!!\n*\n**********************************************************/\n\n$"."CONFIG = array(\n";

				$data .= "\t\"var_source\"=>\"". (isset($_POST['var_source']) ? "1" : "0") . "\",\n";
				$data .= "\t\"enable_gzip\"=>\"". (isset($_POST['enable_gzip']) ? "1" : "0") . "\",\n";
				$data .= "\t\"database_persistent\"=>\"". (isset($_POST['database_persistent']) ? "1" : "0") . "\",\n";
				foreach($_POST as $key => $value)
				{
					if (substr($key, 0, 1) == '_' )
					{
						$key = substr($key, 1);
						$data .= "\t\"".$key."\"=>\"".$value."\",\n";
					}
				}
				$data .= "\t\"sendmail\"=>\"". (isset($_POST['sendmail']) ? "1" : "0") . "\",\n";
				$data .= "\t\"game_installed\"=>\"1\"" . "\n";
				$data .= ");\n";
				$data .= "error_reporting(E_ERROR | E_PARSE);" . "\n";

				//Next section removes coding colours in some editors. The code is however quite valid! - MtR

				$data .= "?>";
				@fwrite($fs, $data);
				@fclose($fs);

				clearstatcache();

				$new_time = filemtime('../qlib/config/config.inc.php');
				if ($old_time == $new_time)   //The file is not changed automatically -- error
				{
					$rawdata = rawurlencode($data);
					docheck($old_time);
				}
				else
				{
					docheck(0);
				}
			}

	break;


	case "3":

			// file to be downloaded - send content header and file contents
			header("Pragma: no-cache");
			header("Content-disposition: attachment; filename=config.inc.php");
			echo rawurldecode($_POST['rawdata']);
			die();

	break;


	case "4":

		clearstatcache();
		$new_time = filemtime('../qlib/config/config.inc.php');
		if ($_POST['time_error'] == $new_time)   //The file is not uploaded properly -- error
		{
			docheck($_POST['time_error'], 1);
		}
		else
		{
			docheck(0);
		}

	break;

}


//If the file /qlib/config/config.inc.php does not allow writing, admin gets the download form
function docheck($time_error, $failed_upload=0)
{
    global $rawdata, $sr;
    include("../qlib/config/config.inc.php");

    if (isset($CONFIG['game_installed']) && $CONFIG['game_installed'] == 1 && empty($time_error))
    {
        $sr->assign("success", "true");
		$sr->display("config_form_finish.tpl.html");
		exit();
    }
    elseif($failed_upload == 1) 
    {
    	$sr->assign("rawdata", $rawdata);
		$sr->assign("time_error", $time_error);
		$sr->assign("success", "false");
        $sr->assign("success2", "false");
		$sr->display("config_form_finish.tpl.html");
		exit();
    }
    else
    {
		$sr->assign("rawdata", $rawdata);
		$sr->assign("time_error", $time_error);
        $sr->assign("success", "false");
		$sr->display("config_form_finish.tpl.html");
		exit();
    }
}

?>