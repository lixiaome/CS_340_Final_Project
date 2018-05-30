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
  <?php echo "We can view About us without Login"; ?>

 </body>
</html>
