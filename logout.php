<!DOCTYPE html>
<?php
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

$_SESSION["username"] = "";

?>


<p>You are logged out.</p>


</body>

</html>