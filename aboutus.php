<?php
		session_start();
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		$currentpage="Aboutus";
		include "pages.php";
        include "header.php";
?>
<html>
	<head>
		<title>About Us</title>
		<link rel="stylesheet" href="index.css">
	</head>
<body>
  <p class="aboutus">This website is the final project for CS 340 Spring18. Created by Group 15:<br>Jared Tence<br>Kaiyuan Fan<br>Xiaomeng Li<br>Nickoli Londura
</p>

 </body>
</html>
