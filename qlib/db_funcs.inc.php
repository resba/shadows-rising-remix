<?php
/*
// 
File:			db_funcs.inc.php
Objective:		collection of database functions to incorporate a database abstraction layer (AdoDB)
Version:		QS 2.2 Beta
Author:			Maugrim_The_Reaper (maugrimtr@hotmail.com)
Date Committed:	12 October 2003		Date Modified:	15 October 2003

Copyright (c) 2003, 2004 by Pádraic Brady

This program is free software. You can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation.
//
*/

/* Should be no reason for this...
include_once("config/config.inc.php");
*/

/*

The functions are aimed at being tranparently ported into QS to replace the original
Solar-Empire MySQL based functions. Functions overlay the ADOdb abstraction layer and are
formatted to operate identical to the original SE functions with four differences:

1.	Arrays are returned as both Associative and Numbered. Where Associative only is
	required, declare $ADODB_FETCH_MODE = 2; prior to calling the db() function - this
	replaces the Generic SE function call as dbr(1);.
2.	The initial connection function uses a new $db_type variable to set the database
	type. SE only supported MySQL with the native PHP MySQL functions. Note that QS has
	yet to be extensively tested on alternative database servers like PostGreSQL or MSQL, 
	but some testing has shown compatibility with PostGre to an extent.
3.	Error messages are formatted under two titles depending on function used. db() returns
	a Selection error message, dbn() an Execution error message. Other errors are external
	to the database functions and may result from mis-referenced include file locations.
4.	The connection function db_connect() accepts a $database_persistent variable to enable
	persistent connections for supported databases. The function will also automatically select
	the database using the config variable, and requires no additional function call

If you have tested QS, or an SE version incorporating this function set and AdoDB please
let us know what the results were on the forums at http://www.quantum-star.com/

*/

/*
Nov 15 2003 UPDATE: Additional function input vars added so the correct filename and linenumber
of all errors are reported - the correct information is given irrespective of whether the error
occured within an include or parent file. Additional functions added to cover mysql equivalents in
PHP. Additions rely on database functions passing the constants __LINE__ and __FILE__. To be 
updated in QS v2.1.30.
*/

// Find base directory!!! - deprecated - replaced with absolute path
// Prevents incidental referencing of adodb folder from the parent file where db_funcs.inc.php is included/required




// IMPORTANT

// USE
$var_adodb_path = "thirdparty/adodb/adodb.inc.php";

//OR
//$var_adodb_path = "/path/to/srdirectory/qlib/thirdparty/adodb/adodb.inc.php";




// NOTE: Above may cause diffculties if Maintenances run using a PHP execute command rather than a url passed to Lynx. Fix by changing the above line to the full filepath.

// include the ADOdb Library for PHP
// enables use of multiple database types

include_once($var_adodb_path);

$ADODB_FETCH_MODE = 2; //returns Associative array only (do not rely on numbering unless you first declare this variable as 3 in the file under use)

$ADODB_COUNTRECS = false; // this stops record counting - which should boost AdoDB performance




// function for connecting to a database server and specific database
function db_connect($database_host, $database_user, $database_password, $database, $database_persistent)
{
	global $CONFIG;
	$db = &ADONewConnection($CONFIG['db_type']);
	//print_r($db); echo("<br /><br />");
	$db->autoRollback = true; // rollback advised in PHP Manual (default is FALSE)
	// use postgres7 usual connection through single host parameter
	if($CONFIG['db_type'] == "postgres7") 
	{
		$db->PConnect("host=$database_host port=$CONFIG[database_port] dbname=$database");
	}
	elseif($database_persistent == 1) 
	{
		$db->PConnect($database_host, $database_user, $database_password, $database);
	}
	else
	{
		$db->Connect($database_host, $database_user, $database_password, $database);
	}
	return $db;
}




// function 1 to return auto_increment value from prior insert (no 2 or 3 equiv provided!)
// I can only remember one usage in the code, but who knows...

//DEV: this function fails miserably on some servers - maybe it needs more options passed
function db_insert_id() 
{
	global $db, $query;
	$insert_id = $db->Insert_ID();
	return $insert_id;
}


// function 1 for querying database (always use dbn() for any structure altering changes to the database)
function db($filename=__FILE__,$linenum=__LINE__,$string) 
{
	global $query, $db, $ADODB_FETCH_MODE;
	$string = Force_DBMS_Compat($string);
	$query = $db->Execute($string);
	if ($query == false) 
	{ 
        print '<h3>SQL SELECT [ db() ] Query Error:</h3><p>'.$db->ErrorMsg().'</p><p><h3>Query:</h3></p><p>'.$string.'</p><p><h3>File:</h3></p><p>'.$filename.'<br />Line Number: <b>'.$linenum.'</b></p>';
		exit();
	} 
}

// function 1 for fetching result arrays
function dbr() 
{
	global $query, $db, $ADODB_FETCH_MODE;
	$fetched = $query->fields;
	$query->MoveNext();
	return $fetched;
}

// function 2 for querying database
function db2($filename=__FILE__,$linenum=__LINE__,$string) 
{
	global $query2, $db, $ADODB_FETCH_MODE;
	$string = Force_DBMS_Compat($string);
	$query2 = $db->Execute($string);
	if ($query2 == false) 
	{ 
        print 'SQL SELECT [ db2() ] Query Error:<p>'.$db->ErrorMsg().'</p><p>Query:</p><p>'.$string.'</p><p>File:</p><p>'.$filename.' --> <b>'.$linenum.'</b></p>';
		exit();
	} 
}

// function 2 for fetching result arrays
function dbr2() 
{
	global $query2, $db, $ADODB_FETCH_MODE;
	$fetched2 = $query2->fields;
	$query2->MoveNext();
	return $fetched2;
}

// function 3 for querying database
function db3($filename=__FILE__,$linenum=__LINE__,$string)
{
	global $query3, $db, $ADODB_FETCH_MODE;
	$string = Force_DBMS_Compat($string);
	$query3 = $db->Execute($string);
	if ($query3 == false) 
	{ 
        print 'SQL SELECT [ db3() ] Query Error:<p>'.$db->ErrorMsg().'</p><p>Query:</p><p>'.$string.'</p><p>File:</p><p>'.$filename.' --> <b>'.$linenum.'</b></p>';
		exit();
	} 
}

// function 3 for fetching result arrays
function dbr3() 
{
	global $query3, $db, $ADODB_FETCH_MODE;
	$fetched3 = $query3->fields;
	$query3->MoveNext();
	return $fetched3;
}

// function 4 for querying database (always use dbn() for any structure altering changes to the database)
function db4($filename=__FILE__,$linenum=__LINE__,$string) 
{
	global $query4, $db, $ADODB_FETCH_MODE;
	$string = Force_DBMS_Compat($string);
	$query4 = $db->Execute($string);
	if ($query4 == false) 
	{ 
        print '<h3>SQL SELECT [ db() ] Query Error:</h3><p>'.$db->ErrorMsg().'</p><p><h3>Query:</h3></p><p>'.$string.'</p><p><h3>File:</h3></p><p>'.$filename.'<br />Line Number: <b>'.$linenum.'</b></p>';
		exit();
	} 
}

// function 1 for fetching result arrays
function dbr4() 
{
	global $query4, $db, $ADODB_FETCH_MODE;
	$fetched4 = $query4->fields;
	$query4->MoveNext();
	return $fetched4;
}

// function to carry out database queried inserts/alterations
function dbn($filename=__FILE__,$linenum=__LINE__,$string) 
{
	global $db;
	$string = Force_DBMS_Compat($string);
	$dbn_result = &$db->Execute($string);
	if ($dbn_result == false) 
	{ 
        print 'SQL UPDATE|ALTER|INSERT [ dbn() ] Query Error:<p>'.$db->ErrorMsg().'</p><p>Query:</p><p>'.$string.'</p><p>File:</p><p>'.$filename.' --> <b>'.$linenum.'</b></p>';
		exit();
	}
}

//function to get direct counts from query
function dbc($filename=__FILE__,$linenum=__LINE__,$string) {
	global $db;
	$string = Force_DBMS_Compat($string);
	$dbc_result = &$db->Execute($string);
	if ($dbc_result == false) 
	{ 
        print 'SQL RECORD COUNT [ dbc() ] Query Error:<p>'.$db->ErrorMsg().'</p><p>Query:</p><p>'.$string.'</p><p>File:</p><p>'.$filename.' --> <b>'.$linenum.'</b></p>';
		exit();
	}
	return $db->Affected_Rows();
}

// function to return number of rows affected by query
function affected_rows() {
	global $db, $dbn_result;
	$affect_rws = $db->Affected_Rows();
	return $affect_rws;
}

//function to replace use of mysql_num_rows()
function record_count($query) {
	global $db;
	$rec_count = $query->RecordCount();
	return $rec_count;
}


//function to provide list of database tables
function list_db_tables($database) {
	global $db;
	$lisstt = $db->MetaTables('TABLES');
	return $lisstt;
}


// debugging function to print arrays
function print_array($array) 
{
	if(gettype($array)=="array") 
	{
		echo "<ul>";
		while (list($index, $subarray) = each($array) ) 
		{
			echo "<li>$index <code>=&gt;</code> ";
			print_array($subarray);
			echo "</li>";
		}
		echo "</ul>";
	} 
	else
	{
		echo $array;
	}
}


// this function is a ham-fisted approach to forcing compatibility between mysql oriented queries dating from Solar Empire and the more generic SQL statements QS uses which are compatible with both MySQL 4 and PostgreSQL 7.4. Thankfully it is a short list...:)

function Force_DBMS_Compat($string) {
	// replace '&&' with 'and'
	$string = ereg_replace("[&]+[&]","and",$string);
	// replace '||' with 'or'
	$string = ereg_replace("[|]+[|]","or",$string);
	return $string;
}

?>