<?php include("./includes/setup.php"); ?>
<html>

<!-- META AND CSS -->
<head>
<?php include("./includes/link_meta.inc"); ?>
<title>Template</title>
<?php include("./includes/site.css"); ?>
</head>

<!-- BODY -->
<body>
<?php include("./includes/header.php"); ?>
<?php include("./includes/menubar1.php"); ?>

<h1>News</h1>
<hr>

<?php include("./includes/connectread.php"); ?>

<?php

$sql = "SELECT * FROM temp_News ORDER BY NewsTimestamp DESC LIMIT 10";
$result = mysql_query($sql,$dbconn);
$numresults = mysql_num_rows($result);
while ($row = mysql_fetch_array($result)) {
	echo '<h2>' . stripcslashes($row['NewsTitle']) . '</h2>';
	echo '<b>Posted by ' . $row['NewsAuthor'] . ' - ' . date("m/d/Y",strtotime($row['NewsTimestamp'])) . '</b>';
	echo '<p align="left">' . stripcslashes($row['NewsContent']) . '</p>';
	echo '<hr>';
}

//If there exists older news, link to it
$sql = "SELECT * FROM temp_News ORDER BY NewsTimestamp DESC LIMIT 10 OFFSET ".($start+10);
$result = mysql_query($sql,$dbconn);
$numresult = mysql_num_rows($result);
if ($numresult > 0) {
	?>
	<h3><a href="/oldnews.php?s=<?php echo($start + 10); ?>">Older -></a></h3>
	<?php
}

//Disconnect from the database
	mysql_close($dbconn);
?>
		
<?php include("./includes/menubar2.php"); ?>
</body>

</html>