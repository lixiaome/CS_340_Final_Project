<!DOCTYPE html>
<!-- My Champions -->
<?php
		$currentpage="My Champions";
		include "pages.php";
        include "header.php";
?>
<html>
	<head>
		<title>My Champions</title>
		<link rel="stylesheet" href="index.css">
	</head>
<?php 
	if (checkAuth(true) != "") {
?>
<body>
  <?php echo 'champion list should display here'; ?> 
 </body>

</html>
<?php } ?>