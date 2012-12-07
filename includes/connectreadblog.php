<?php
//Connect to the database
$dbconn = mysql_connect("localhost","temp_blogread","asdfasdf");
if (!$dbconn) {
	die('Could not connect to the database: ' . mysql_error());
}
mysql_select_db("temp_blog", $dbconn);
?>