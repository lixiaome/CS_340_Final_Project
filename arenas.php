<!DOCTYPE html>
<!-- Arenas -->
<?php
		$currentpage="Arenas";
		include "pages.php";
        include "header.php";
?>
<html>
	<head>
		<title>Arenas</title>
		<link rel="stylesheet" href="index.css">
	</head>
<?php 
	if (checkAuth(true) != "") {
?>
<body>
  <?php echo 'Arena applicaiton should goes here'; ?> 

 </body>
</html>
<?php } ?>