<?php 

	//We must start our session before anything else!
	session_start();

	//Set colors from cookies, sessions, or defaults, in that order
	if (isset($_COOKIE['bgcolor'])) { $bgcolor = $_COOKIE['bgcolor']; }
	else if (isset($_SESSION['bgcolor'])) { $bgcolor = $_SESSION['bgcolor']; }
	else { $bgcolor = "03112E"; }
	
	if (isset($_COOKIE['bodycolor'])) { $bodycolor = $_COOKIE['bodycolor']; }
	else if (isset($_SESSION['bodycolor'])) { $bodycolor = $_SESSION['bodycolor']; }
	else { $bodycolor = "4B90C2"; }
	
	if (isset($_COOKIE['linkcolor'])) { $linkcolor = $_COOKIE['linkcolor']; }
	else if (isset($_SESSION['linkcolor'])) { $linkcolor = $_SESSION['linkcolor']; }
	else { $linkcolor = "128ACF"; }
	
	if (isset($_COOKIE['visitedcolor'])) { $visitedcolor = $_COOKIE['visitedcolor']; }
	else if (isset($_SESSION['visitedcolor'])) { $visitedcolor = $_SESSION['visitedcolor']; }
	else { $visitedcolor = "1079B5"; }
	
	if (isset($_COOKIE['rightboxcolor'])) { $rightboxcolor = $_COOKIE['rightboxcolor']; }
	else if (isset($_SESSION['rightboxcolor'])) { $rightboxcolor = $_SESSION['rightboxcolor']; }
	else { $rightboxcolor = "233040"; }
	
	if (isset($_COOKIE['leftboxcolor'])) { $leftboxcolor = $_COOKIE['leftboxcolor']; }
	else if (isset($_SESSION['leftboxcolor'])) { $leftboxcolor = $_SESSION['leftboxcolor']; }
	else { $leftboxcolor = "233040"; }
	
	if (isset($_COOKIE['middleboxcolor'])) { $middleboxcolor = $_COOKIE['middleboxcolor']; }
	else if (isset($_SESSION['middleboxcolor'])) { $middleboxcolor = $_SESSION['middleboxcolor']; }
	else { $middleboxcolor = "00213F"; }
	
	if (isset($_COOKIE['unusedboxcolor'])) { $unusedboxcolor = $_COOKIE['unusedboxcolor']; }
	else if (isset($_SESSION['unusedboxcolor'])) { $unusedboxcolor = $_SESSION['unusedboxcolor']; }
	else { $unusedboxcolor = "00213F"; }
	
	//If we are having colors swapped, update everything accordingly
	if (ctype_alnum($_GET['bgcolor'])) {
		$bgcolor = $_GET['bgcolor'];
		setcookie("bgcolor",$bgcolor,time()+3153600);
		$_SESSION['bgcolor'] = $bgcolor;
	}
	if (ctype_alnum($_GET['bodycolor'])) {
		$bodycolor = $_GET['bodycolor'];
		setcookie("bodycolor",$bodycolor,time()+3153600);
		$_SESSION['bodycolor'] = $bodycolor;
	}
	if (ctype_alnum($_GET['linkcolor'])) {
		$linkcolor = $_GET['linkcolor'];
		setcookie("linkcolor",$linkcolor,time()+3153600);
		$_SESSION['linkcolor'] = $linkcolor;
	}
	if (ctype_alnum($_GET['visitedcolor'])) {
		$visitedcolor = $_GET['visitedcolor'];
		setcookie("visitedcolor",$visitedcolor,time()+3153600);
		$_SESSION['visitedcolor'] = $visitedcolor;
	}
	if (ctype_alnum($_GET['rightboxcolor'])) {
		$rightboxcolor = $_GET['rightboxcolor'];
		setcookie("rightboxcolor",$rightboxcolor,time()+3153600);
		$_SESSION['rightboxcolor'] = $rightboxcolor;
	}
	if (ctype_alnum($_GET['leftboxcolor'])) {
		$leftboxcolor = $_GET['leftboxcolor'];
		setcookie("leftboxcolor",$leftboxcolor,time()+3153600);
		$_SESSION['leftboxcolor'] = $leftboxcolor;
	}
	if (ctype_alnum($_GET['middleboxcolor'])) {
		$middleboxcolor = $_GET['middleboxcolor'];
		setcookie("middleboxcolor",$middleboxcolor,time()+3153600);
		$_SESSION['middleboxcolor'] = $middleboxcolor;
	}
	if (ctype_alnum($_GET['unusedboxcolor'])) {
		$unusedboxcolor = $_GET['unusedboxcolor'];
		setcookie("unusedboxcolor",$unusedboxcolor,time()+3153600);
		$_SESSION['unusedboxcolor'] = $unusedboxcolor;
	}
?>