<?php include("./includes/setup.php"); ?>
<html>

<!-- META AND CSS -->
<head>
<?php include("./includes/link_meta.inc"); ?>
<title>User Control Panel</title>
<?php include("./includes/site.css"); ?>
</head>

<!-- BODY -->
<body>
<?php include("./includes/header.php"); ?>
<?php include("./includes/menubar1.php"); ?>
<?php include("./includes/connectwrite.php"); ?>

<?php

//If the page has stage=login, then check their login info
if ($_GET['stage'] == "login" && !isset($_SESSION['loggedIn'])) {
	$hpass = sha1(sha1("salt").$_POST['password']);
	$email = mysql_real_escape_string($_POST['email']);
	$sql = "SELECT * FROM temp_Personal_Security WHERE Email_ID = '" . $email . "' AND Hashed_Pass = '" . $hpass . "'";
	$result = mysql_query($sql,$dbconn);
	$numresults = mysql_num_rows($result);
	$info = mysql_fetch_array($result);
	if ($numresults == 1) {
		$_SESSION['loggedIn'] = $email;
		$_SESSION['status'] = $info['User_Status'];
	}
}
//If the page has stage=logout, then clear their login info
if ($_GET['stage'] == "logout") {
	$_SESSION = array();
	session_destroy();
}

//If the user is not logged on, display a login form
if (!isset($_SESSION['loggedIn'])) {

?>
	<h1>Login</h1>
	<form name="loginform" action="controlpanel.php?stage=login" method="post">
		<table align="center">
		<tr><td>E-mail:</td><td><input type="text" name="email" /></td></tr>
		<tr><td>Password:</td><td><input type="password" name="password" /></td></tr>
		<tr><td colspan="2"><input type="submit" value="Submit" /></td></tr>
		</table>
	</form>
<?php
	//Disconnect from the database
	mysql_close($dbconn);
}

//Profile Functions - All Users
elseif ($_GET['stage'] == "useredit2") {
	$sql = "UPDATE temp_Personal_Info SET 
		Email_ID='".mysql_real_escape_string(htmlspecialchars($_POST['email']))."',
		Nickname='".mysql_real_escape_string(htmlspecialchars($_POST['nickname']))."',
		First_Name='".mysql_real_escape_string(htmlspecialchars($_POST['firstname']))."',
		Last_Name='".mysql_real_escape_string(htmlspecialchars($_POST['lastname']))."',
		Age='".mysql_real_escape_string(htmlspecialchars($_POST['age']))."',
		Location='".mysql_real_escape_string(htmlspecialchars($_POST['location']))."',
		Details='".mysql_real_escape_string(htmlspecialchars($_POST['details']))."'
		WHERE Email_ID='".$_SESSION['loggedIn']."'
	";
	//echo $sql;
	mysql_query($sql,$dbconn);
	
	$_SESSION['loggedIn'] = mysql_real_escape_string(htmlspecialchars($_POST['email']));
	?>
	<h1>Profile Editor</h1>
	<p>Profile edited successfully!</p>
	<?php
}
elseif ($_GET['stage'] == "useredit") {
	$sql = "SELECT * FROM temp_Personal_Info WHERE Email_ID = '" . $_SESSION['loggedIn'] . "'";
	$result = mysql_query($sql,$dbconn);
	$info = mysql_fetch_array($result)
?>
	<h1>Profile Editor</h1>
	<p><font size="2">Items marked with * are required</font></p>
	<form name="profileeditform" action="controlpanel.php?stage=useredit2" method="post">
		<table align="center">
		<tr><td>*Email:</td><td><input type="text" name="email" value="<?php echo $info['Email_ID']; ?>" maxlength="100" /></td></tr>
		<tr><td>Nickname:</td><td><input type="text" name="nickname" value="<?php echo stripcslashes($info['Nickname']); ?>" maxlength="100" /></td></tr>
		<tr><td>*First name:</td><td><input type="text" name="firstname" value="<?php echo stripcslashes($info['First_Name']); ?>" maxlength="50" /></td></tr>
		<tr><td>Last name:</td><td><input type="text" name="lastname" value="<?php echo stripcslashes($info['Last_Name']); ?>" maxlength="50" /></td></tr>
		<tr><td>Age:</td><td><input type="text" name="age" value="<?php echo $info['Age']; ?>" size="5" maxlength="3" /></td></tr>
		<tr><td>Location:</td><td><input type="text" name="location" value="<?php echo $info['Location']; ?>" maxlength="50" /></td></tr>
		<tr><td colspan="2"><textarea name="details" rows="25" cols="60"><?php echo stripcslashes($info['Details']); ?></textarea></td></tr>
		<tr><td colspan="2"><input type="submit" value="Submit" /></td></tr>
		</table>
	</form>
<?php
}

//News Functions - Admin
elseif ($_GET['stage'] == "newsadd" && $_SESSION['status'] == 'Admin') {
?>
	<h1>News Poster</h1>
	<form name="newsaddform" action="controlpanel.php?stage=newsadd2" method="post">
		<table align="center">
		<tr><td>Title:</td><td><input type="text" name="title" /></td></tr>
		<tr><td>Author:</td><td><input type="text" name="author" /></td></tr>
		<tr><td colspan="2"><textarea name="content" rows="25" cols="60">News content here.</textarea></td></tr>
		<tr><td colspan="2"><input type="submit" value="Submit" /></td></tr>
		</table>
	</form>
<?php
}
elseif ($_GET['stage'] == "newsadd2" && $_SESSION['status'] == 'Admin') {
	$sql = "INSERT INTO temp_News(NewsTitle,NewsAuthor,NewsContent) VALUES('" . mysql_real_escape_string($_POST['title']) . "','" . mysql_real_escape_string($_POST['author']) . "','" . mysql_real_escape_string($_POST['content']) . "')";
	mysql_query($sql,$dbconn);
?>
	<h1>News Poster</h1>
	<p>News added successfully!</p>
<?php
}
elseif ($_GET['stage'] == "newsedit" && $_SESSION['status'] == 'Admin') {
	$sql = "SELECT * FROM temp_News ORDER BY NewsTimestamp DESC";
	$result = mysql_query($sql,$dbconn);
	$numresults = mysql_num_rows($result);
	echo '<center><h1>All News</h1><table>';
	while ($row = mysql_fetch_array($result)) {
		$editID = '&title=' . stripcslashes($row['NewsTitle']) . '&timestamp=' . $row['NewsTimestamp'];
		echo '<tr><td>' . stripcslashes($row['NewsTitle']) . ' </td><td><a href="controlpanel.php?stage=newsedit2&action=edit' . $editID . '">Edit</a> </td><td><a href="controlpanel.php?stage=newsedit2&action=delete' . $editID . '" onclick="return confirm(\'Are you sure you want to delete this?\');">Delete</a></td></tr>';
	}
	echo '</table></center>';
}
elseif ($_GET['stage'] == "newsedit2" && $_GET['action'] == "edit" && $_SESSION['status'] == 'Admin') {
	$sql = "SELECT * FROM temp_News WHERE NewsTitle = '" . mysql_real_escape_string($_GET['title']) . "' AND NewsTimestamp = '" . mysql_real_escape_string($_GET['timestamp']) . "'";
	$result = mysql_query($sql,$dbconn);
	$info = mysql_fetch_array($result)
?>
	<h1>News Editor</h1>
	<form name="newseditform" action="controlpanel.php?stage=newsedit3<?php echo '&title=' . stripcslashes($info['NewsTitle']) . '&timestamp=' . $info['NewsTimestamp']; ?>" method="post">
		<table align="center">
		<tr><td>Title:</td><td><input type="text" name="title" value="<?php echo stripcslashes($info['NewsTitle']); ?>"/></td></tr>
		<tr><td>Author:</td><td><input type="text" name="author" value="<?php echo stripcslashes($info['NewsAuthor']); ?>"/></td></tr>
		<tr><td colspan="2"><textarea name="content" rows="25" cols="60"><?php echo stripcslashes($info['NewsContent']); ?></textarea></td></tr>
		<tr><td colspan="2"><input type="submit" value="Submit" /></td></tr>
		</table>
	</form>
<?php
}
elseif ($_GET['stage'] == "newsedit3" && $_SESSION['status'] == 'Admin') {
	$sql = "UPDATE temp_News SET NewsTitle = '" . mysql_real_escape_string($_POST['title']) . "', NewsAuthor = '" . mysql_real_escape_string($_POST['author']) . "', NewsContent = '" . mysql_real_escape_string($_POST['content']) . "' WHERE NewsTitle = '" . mysql_real_escape_string($_GET['title']) . "' AND NewsTimestamp = '" . mysql_real_escape_string($_GET['timestamp']) . "'";
	mysql_query($sql,$dbconn);
?>
	<h1>News Poster</h1>
	<p>News edited successfully!</p>
<?php
}
elseif ($_GET['stage'] == "newsedit2" && $_GET['action'] == "delete" && $_SESSION['status'] == 'Admin') {
	$sql = "DELETE FROM temp_News WHERE NewsTitle = '" . mysql_real_escape_string($_GET['title']) . "' AND NewsTimestamp = '" . mysql_real_escape_string($_GET['timestamp']) . "'";
	mysql_query($sql,$dbconn);
?>
	<h1>News Poster</h1>
	<p>News deleted successfully!</p>
<?php
}

//Dropbox function for when staff needs to dump a file quickly
elseif ($_GET['stage'] == "dump" && ($_SESSION['status'] == 'Admin' || $_SESSION['status'] == 'Staff')) {
	$urlhead = "/temp/";
?>
	<h1>Dump Temporary File</h1>
	<form name="dumpform" action="controlpanel.php?stage=dump2" method="post" enctype="multipart/form-data">
	<table align="center">
		<tr><td>File: </td></tr><br><tr><td colspan="2"><?php echo $urlhead; ?><input type="file" name="file"></td></tr>
		<tr><td colspan="3"><input type="submit" value="Submit" /></td></tr>
		</table>
	</form>
<?php
}
elseif ($_GET['stage'] == "dump2" && ($_SESSION['status'] == 'Admin' || $_SESSION['status'] == 'Staff')) {
	echo "<h1>Dump Temporary File</h1>";
	if ($_FILES["file"]["error"] > 0) {
		echo "<p>Error occurred with the uploaded file - please check the files manually</p>";
	}
	elseif ($_FILES["file"]["size"] > 100000000) {
		echo "<p>One/both of the uploaded files are ~100mb or greater - please upload manually if this is correct</p>";
	}
	else {
		$urlhead = "/temp/";
		move_uploaded_file($_FILES["file"]["tmp_name"],"temp/".$_FILES["file"]["name"]);
		echo "<p>File uploaded: <a href=\"".$urlhead.$_FILES["file"]["name"]."\">".$urlhead.$_FILES["file"]["name"]."</a></p>";
	}
}

//Feedback box functions
elseif ($_GET['stage'] == "feedback" && $_SESSION['status'] == 'Admin') {
	$sql = "SELECT DataEntry, DataTimestamp FROM temp_FormsData WHERE DataForm = 'Box' AND DataField = 'Contents' ORDER BY DataTimestamp DESC LIMIT 100";
	$result = mysql_query($sql,$dbconn);
	$numresults = mysql_num_rows($result);
	echo '<center><h1>Feedback Viewer (last 100)</h1><table border="0">';
	while ($row = mysql_fetch_array($result)) {
		echo '<tr height="20"></tr><tr>';
		echo '<td valign="top" width="200">'.$row['DataTimestamp'].'</td>';
		echo '<td>'.$row['DataEntry'].'</td>';
		echo '</tr>';
	}
	echo '</table></center>';
}

//Otherwise, display the control panel for their user type
else {
	//Default control panel
	if ($_SESSION['status'] == 'Regular') {
		echo '<h1>Regular CP</h1>';
		echo '<a href="./controlpanel.php?stage=useredit">Edit Profile</a><br>';
		echo '<a href="/controlpanel.php?stage=logout">Logout</a>';
	}
	//Staff control panel
	elseif ($_SESSION['status'] == 'Staff') {
		echo '<h1>Staff CP</h1>';
		echo '<a href="./controlpanel.php?stage=useredit">Edit Profile</a><br><br>';
		
		echo '<a href="./controlpanel.php?stage=dump">Dump Temporary File</a><br><br>';

		echo '<a href="/controlpanel.php?stage=logout">Logout</a>';
	}
	//Admin control panel
	elseif ($_SESSION['status'] == 'Admin') {
		echo '<h1>Admin CP</h1>';
		
		echo '<a href="./controlpanel.php?stage=useredit">Edit Profile</a><br><br>';
		
		echo '<a href="./controlpanel.php?stage=newsadd">Add News</a><br>';
		echo '<a href="./controlpanel.php?stage=newsedit">Edit News</a><br><br>';
		
		echo '<a href="./controlpanel.php?stage=dump">Dump Temporary File</a><br><br>';
		
		echo '<a href="./controlpanel.php?stage=feedback">View latest feedback</a><br><br>';

		echo '<a href="/controlpanel.php?stage=logout">Logout</a>';
	}
	//Uh...oops?
	else {
		echo '<h1>User CP - If you see this, the world is about to explode.</h1>';
		echo '<a href="/controlpanel.php?stage=logout">Logout</a>';
	}
}
?>

<?php include("./includes/menubar2.php"); ?>
</body>

</html>