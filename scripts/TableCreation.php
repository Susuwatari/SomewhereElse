<?php
/*
** Script to create all the tables
*/

//Connect to the database
$dbconn = mysql_connect("localhost","temp_admin","asdfasdf");
if (!$dbconn) {
	die('Could not connect to the database: ' . mysql_error());
}

//Select the database to edit
mysql_select_db("temp_site", $dbconn);
///*
//Create tables
$sql = "CREATE TABLE temp_Personal_Info(
	Email_ID VARCHAR(100),
	Nickname VARCHAR(100),
	First_Name VARCHAR(50) NOT NULL,
	Last_Name VARCHAR(50),
	Age INT UNSIGNED,
	Details TEXT,
	Location VARCHAR(100),
	PRIMARY KEY(Email_ID)
)";
mysql_query($sql,$dbconn);
$sql = "CREATE TABLE temp_Personal_Security(
	Email_ID VARCHAR(100),
	Hashed_Pass VARCHAR(255) NOT NULL,
	User_Status VARCHAR(100) DEFAULT 'Regular',
	PRIMARY KEY(Email_ID),
	FOREIGN KEY (Email_ID) REFERENCES temp_Personal_Info(Email_ID)
)";
mysql_query($sql,$dbconn);

$sql = "CREATE TABLE temp_News(
	NewsTitle VARCHAR(255) NOT NULL,
	NewsAuthor VARCHAR(150) DEFAULT 'Staff',
	NewsContent LONGTEXT,
	NewsTimestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)";

$sql = "CREATE TABLE temp_Forms(
	FormTitle VARCHAR(255),
	FormActive SMALLINT DEFAULT 0,
	PRIMARY KEY(FormTitle)
)";
mysql_query($sql,$dbconn);
$sql = "CREATE TABLE temp_FormsFields(
	FieldForm VARCHAR(255),
	FieldName VARCHAR(255),
	FOREIGN KEY (FieldForm) REFERENCES temp_Forms(FormTitle),
	PRIMARY KEY(FieldForm,FieldName)
)";
mysql_query($sql,$dbconn);
$sql = "CREATE TABLE temp_FormsData(
	DataForm VARCHAR(255),
	DataField VARCHAR(255),
	DataEntry TEXT NOT NULL,
	DataSubmitter VARCHAR(255) DEFAULT NULL,
	DataTimestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (DataForm) REFERENCES temp_FormsFields(FormTitle),
	FOREIGN KEY (DataField) REFERENCES temp_FormsFields(FieldName)
)";
mysql_query($sql,$dbconn);

//Disconnect from the database
mysql_close($dbconn);

?>