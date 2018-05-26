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
	<?php
  include 'connectvars.php';

	$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	if(!$conn){
		die('Could not connect' . mysql_error());
	}

	$query = "SELECT username, wins FROM Sponsors ORDER BY wins DESC";

	$result = mysqli_query($conn, $query);
	if(!$result){
		die("Query couldn't complete")
	}


	echo "<h1>Sponsors</h1>";
	echo "<table id='t01' border='t'><tr>"
	$fields_num = mysqli_num_rows($result);
	for($i = 0;$i < $fields_num; $i++){
		$field = mysqli_fetch_field($result);
		echo "<td><b>$field->name</b></td>";
	}
	echo "</tr>\n";

	mysqli_free_result($result);
	mysqli_close($conn);
	
?>
 </body>
</html>
<?php } ?>
