<!DOCTYPE html>
<!-- Leaderboard -->
<?php
		$currentpage="Leaderboard";
		include "pages.php";
        include "header.php";
?>
<html>
	<head>
		<title>Leaderboard</title>
		<link rel="stylesheet" href="index.css">
	</head>
<?php 
	if (checkAuth(true) != "") {
?>
<body>
  <?php echo 'Leaderboard should display here'; ?> 

 </body>
</html>
<?php } ?>