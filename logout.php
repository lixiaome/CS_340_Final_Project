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
		<title>Logout</title>
		<link rel="stylesheet" href="index.css">
	</head>
<body>



<?php
session_destroy()
?>


<p>You are logged out.</p>


</body>

</html>
