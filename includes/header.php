<!-- Header -->

<!-- Start site table -->
<table align="center" border="0" cellpadding="5">
<tr>
<td valign="bottom">
</td>

<td align="center">

<!-- Logo -->
<a href="/index.php" border="0"><img src="/images/banners/Banner.png"></a>

<!-- Temporary Announcements -->
<?php /*
<?php if ($bodycolor == "FFFFFF") { echo '<font color="'.$middleboxcolor.'">'; } ?>
<p><b>You can put announcements below the banner with this - the following snippet is useful to adjust to high contrast color schemes where the bg and body colors are the same: <a href="http://template.tmp" <?php if ($linkcolor == $bgcolor || $visitedcolor == $bgcolor) { echo 'class="override"'; } ?> >Link</a>!</b></p>
<?php if ($bodycolor == "FFFFFF") { echo '</font>'; } ?>
*/ ?>
<p><font color="<?php echo $bgcolor; ?>"></font></p>

</td>

<td valign="bottom">
<?php 
	if (!isset($_SESSION['loggedIn'])) {
		//echo '<a href="/controlpanel.php"><b>User Login</b></a><br><br>';
	}
	else {
		echo '<a href="/controlpanel.php"><b>Control Panel</b></a>';
	}
?>
</td>