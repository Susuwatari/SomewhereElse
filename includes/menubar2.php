</div></div></div></div>
</td>
	<?php
		function flux($color, $steps) {
			$rhex = substr($color,0,2);
			$ghex = substr($color,2,2);
			$bhex = substr($color,4,2);

			$r = hexdec($rhex);
			$g = hexdec($ghex);
			$b = hexdec($bhex);

			$r = max(0,min(255,$r + $steps));
			$g = max(0,min(255,$g + $steps));  
			$b = max(0,min(255,$b + $steps));

			return dechex($r).dechex($g).dechex($b);
		}
	?>
		<td align="center" valign="top">
			<div id="bluebox">
			<div id="bluebox1">
			<div id="bluebox2">
			<div id="bluebox3">
				<table align="center">
					<?php include("./includes/connectreadblog.php"); ?>
					<tr><td><b><font size="4" color="<?php echo flux($rightboxcolor,+100); ?>">Somewhere</font></b></td></tr>
					<tr height="5"></tr>
					<tr><td><b><u><font color="<?php echo flux($linkcolor,-100); ?>">Latest Posts</font></u></b></td></tr>
					<?php
						$sql = "SELECT * FROM temp_posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC LIMIT 5;";
						$result = mysql_query($sql,$dbconn);
						$numresults = mysql_num_rows($result);
						while ($row = mysql_fetch_array($result)) {
							$wptitle = $row['post_title'];
							$wplink = '/blog/'.$row['post_name'];
							date_default_timezone_set('EST');
							$wpdate = date("F d, Y",strtotime($row['post_date']));
							echo '<tr><td><font size="2"><b style="white-space:nowrap;">'.$wpdate.'</b><br><a href="'.$wplink.'" title="'.$wptitle.'" target="_blank">'.$wptitle.'</a></font></td></tr>';
						}
					?>
				</table>
			</div></div></div></div>
			<br><br>
			<!-- 
			<div id="bluebox">
			<div id="bluebox1">
			<div id="bluebox2">
			<div id="bluebox3">
				<table align="center">
					
				</table>
			</div></div></div></div>
			<br><br>
			-->
			<div id="bluebox">
			<div id="bluebox1">
			<div id="bluebox2">
			<div id="bluebox3">
				<table align="center" border="0" cellspacing="0" cellpadding="1">
					<tr><td colspan="2"><b><font size="3" color="<?php echo flux($rightboxcolor,+100); ?>">Themes</font></b></td></tr>
					<tr><td width="60" height="20"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?bgcolor=03112E&bodycolor=4B90C2&linkcolor=128ACF&visitedcolor=1079B5&rightboxcolor=233040&leftboxcolor=233040&middleboxcolor=00213F"><img src="/images/themes/darkbluetheme.png" /></a></td><td width="60" height="20"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?bgcolor=29394F&bodycolor=63BEFF&linkcolor=00D5E0&visitedcolor=00B3BD&rightboxcolor=1162f8&leftboxcolor=002f84&middleboxcolor=465f80"><img src="/images/themes/lightbluetheme.png" /></a></td></tr>
					<tr><td colspan="2"><b><font size="1" color="<?php echo flux($rightboxcolor,-50); ?>"><a href="/switcher.php">Customize</a></font></b></td></tr>
				</table>
			</div></div></div></div>
		</td>
	</tr>
	<tr>
		<td align="center" valign="top">

		</td>
		<td align="center" valign="top">
			
		</td>
	</tr>
	<!-- End Content Boxes -->
	<!-- FOOTER -->
	<?php 
		if ((include "./includes/footer.php") != 1) {
			include("../includes/footer.php");
		}
	?>
</table>
<!-- End site table -->