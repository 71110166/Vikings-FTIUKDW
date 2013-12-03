<?php

/*
 *  @file: fn_dbc.php
 *  @desc: Mysql connection helper
 *
 **/

// db config:
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', 'admin');
define('DBNAME', 'pweb');


# @desc: fungsi untuk melakukan koneksi ke db.
function fnOpenDB(&$dbconn)
{
	$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	if ($dbconn->connect_errno)
		exit('Unable to connect to MYSQL: (' . $dbconn->connect_errno . ') ' . $dbconn->connect_error);
}




# @desc: fungsi untuk menutup koneksi db
function fnCloseDB(&$dbconn)
{
	if ($dbconn != NULL)
		$dbconn->close();

	unset($dbconn);
}




?>