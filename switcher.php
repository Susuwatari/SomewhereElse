<?php include("./includes/setup.php"); ?>
<html>

<!-- META AND CSS -->
<head>
<?php include("./includes/link_meta.inc"); ?>
<title>Themes Switcher</title>
<?php include("./includes/site.css"); ?>
</head>

<!-- BODY -->
<body>
<?php include("./includes/header.php"); ?>
<?php include("./includes/menubar1.php"); ?>

<h1>Themes Switcher</h1>

<script type="text/javascript" src="jscolor/jscolor.js"></script>
<form name="colorform" action="switcher.php" method="get">
	<table align="center">
	<tr><td>Background: #</td><td><input class="color" type="text" name="bgcolor" maxlength="6" value="<?php echo $bgcolor; ?>"/></td></tr>
	<tr><td>Text: #</td><td><input class="color" type="text" name="bodycolor" maxlength="6" value="<?php echo $bodycolor; ?>"/></td></tr>
	<tr><td>Links: #</td><td><input class="color" type="text" name="linkcolor" maxlength="6" value="<?php echo $linkcolor; ?>"/></td></tr>
	<tr><td>Visited links: #</td><td><input class="color" type="text" name="visitedcolor" maxlength="6" value="<?php echo $visitedcolor; ?>"/></td></tr>
	<tr><td>Right box: #</td><td><input class="color" type="text" name="rightboxcolor" maxlength="6" value="<?php echo $rightboxcolor; ?>"/></td></tr>
	<tr><td>Left box: #</td><td><input class="color" type="text" name="leftboxcolor" maxlength="6" value="<?php echo $leftboxcolor; ?>"/></td></tr>
	<tr><td>Middle box: #</td><td><input class="color" type="text" name="middleboxcolor" maxlength="6" value="<?php echo $middleboxcolor; ?>"/></td></tr>
	<tr><td colspan="2"><input type="submit" value="Submit" /></td></tr>
	</table>
</form>
<form name="reset" action="switcher.php" method="get">
	<input type="hidden" name="bgcolor" value="03112E" />
	<input type="hidden" name="bodycolor" value="4B90C2" />
	<input type="hidden" name="linkcolor" value="128ACF" />
	<input type="hidden" name="visitedcolor" value="1079B5" />
	<input type="hidden" name="rightboxcolor" value="233040" />
	<input type="hidden" name="leftboxcolor" value="233040" />
	<input type="hidden" name="middleboxcolor" value="00213F" />
	<input type="hidden" name="unusedboxcolor" value="00213F" />
	<table align="center">
	<tr><td colspan="2"><input type="submit" value="Reset" /></td></tr>
	</table>
</form>

<?php include("./includes/menubar2.php"); ?>
</body>

</html>