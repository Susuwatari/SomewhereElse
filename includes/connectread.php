<?php
//Connect to the database
$dbconn = mysql_connect("localhost","temp_read","asdfasdf");
if (!$dbconn) {
	die('Could not connect to the database: ' . mysql_error());
}
mysql_select_db("temp_site", $dbconn);
?>