<!DOCTYPE html>
<?php
		session_start();
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		$currentpage="Logout";
		include "pages.php";
		include 'header.php';
?>
<html>
	<head>
		<h2>Logout</h2>
		<link rel="stylesheet" href="index.css">
	</head>
<body>



<?php
session_destroy()
?>


<p class="white">You are logged out.</p>


</body>

</html>
