<?php
		session_start();
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
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
		die("Query couldn't complete");
	}


	echo "<h1>Leaderboards</h1>";
	echo "<table id='t01' border='t'><tr>";
	$fields_num = mysqli_num_fields($result);
	echo "<td><b>Rank</b></td>";
	for($i = 0;$i < $fields_num; $i++){
		$field = mysqli_fetch_field($result);
		echo "<td><b>$field->name</b></td>";
	}
	echo "</tr>\n";
	$rank = 1;
	while($row = mysqli_fetch_row($result)) {
		echo "<tr>";
		echo "<td>$rank</td>";
		foreach($row as $cell){
			echo "<td>$cell</td>";
		}
		echo "</tr>\n";
		$rank += 1;
	}

	mysqli_free_result($result);
	mysqli_close($conn);

?>
 </body>
</html>
<?php } ?>
