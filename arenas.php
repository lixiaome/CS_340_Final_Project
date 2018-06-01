<?php
		session_start();
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		$currentpage="Arenas";
		include "pages.php";
    include "header.php";
		include "connectvars.php";
?>
<html>
	<head>
		<title>Arenas</title>
		<link rel="stylesheet" href="index.css">
		 <script src="arenaHandler.js"></script>
	</head>

<body>
  <?php
	function display($sqltable){
		echo "<table id='t01' border='t'><tr>";
		$fields_num = mysqli_num_fields($sqltable);
		for($i = 0;$i < $fields_num; $i++){
			$field = mysqli_fetch_field($sqltable);
			echo "<td><b>$field->name</b></td>";
		}
		echo "</tr>\n";
		while($row = mysqli_fetch_row($sqltable)) {
			echo "<tr>";
			foreach($row as $cell){
				echo "<td>$cell</td>";
			}
			echo "</tr>\n";
		}
	}


	$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	if (checkAuth(true) != "") {
	if(!isset($_GET['arena'])){
				$arenas = mysqli_query($conn,"SELECT * FROM Arena");
				if(mysqli_num_rows($arenas) > 0 ){
					while($row = mysqli_fetch_row($arenas)){
						echo "<div class=arena>";
						echo "<h3>".$row[0]."</h3>";
						echo "<h3>".$row[1]."</h3>";
						echo "<h3>".$row[2]."</h3>";
						echo "<input type='button' onclick=\"window.location.href='arenas.php?arena=".$row[0]."'\" name='$row[0]' value='View'/>";
						echo "</div>";
					}
				}
				mysqli_free_result($arenas);
	} else {
		$var = $_GET['arena'];
		$query = "SELECT * FROM Events WHERE arena = '$var'";

		$result = mysqli_query($conn, $query);
		if(!$result){
			die("Query couldn't complete");
		}
		echo "<h1>Events</h1>";
		display($result);

		$query = "SELECT * FROM Champions WHERE arena = '$var'";

		$result = mysqli_query($conn, $query);
		if(!$result){
			die("Query couldn't complete");
		}

		echo "<h1>Champions</h1>";
		display($result);
	}

		mysqli_close($conn);

	?>
 </body>
</html>
<?php } ?>
