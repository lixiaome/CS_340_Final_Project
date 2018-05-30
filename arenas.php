<?php
		session_start();
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
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
