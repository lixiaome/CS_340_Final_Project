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
		 <script type = "text/javascript" src="arenaHandler.js"></script>
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
			echo "</table>";
	}


	$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	if (checkAuth(true) != "") {
	if(!isset($_GET['arena'])){
				$arenas = mysqli_query($conn,"SELECT * FROM Arena");
				echo "<div class=arena-container>";
				if(mysqli_num_rows($arenas) > 0 ){
					while($row = mysqli_fetch_row($arenas)){
						echo "<div class='arena'>";
						echo "<div class='arena-contents' id='name'>".$row[0]."</div>";
						echo "<div class='arena-contents' id='weather'> <bold>Weather:</bold> ".$row[1]."</div>";
						echo "<div class='arena-contents' id='cNum'> <bol>Champions:</bold> ".$row[2]."</div>";
						echo "<input class='arena-contents' id='aview-button' type='button' onclick=\"window.location.href='arenas.php?arena=".$row[0]."'\" name='$row[0]' value='View'/>";
						echo "</div>";
					}
				}
				echo "</div>";
				mysqli_free_result($arenas);
	} else {
		if(checkAuth(false) != ""){
			$username = $_SESSION['username'];
			$queryIn = "SELECT C.cID, C.name, C.level, C.exp, C.power, C.intelligence, C.endurance FROM Champions C WHERE C.username = '$username' AND C.arena IS NULL AND C.alive = 1";
			$resultIn = mysqli_query($conn, $queryIn);
			echo "<table id='t01' border='t'><tr>";
			while($row = mysqli_fetch_row($resultIn)) {
				echo "<tr>";
				foreach($row as $cell){
					echo "<td>$cell</td>";
				}
				echo "</tr>\n";
			}
					echo "</table>";
		}

		$var = $_GET['arena'];
		

		
		echo "<h1>Champions</h1>";
		
		$query = "SELECT username,name,alive FROM Champions WHERE arena = '$var'";

		$result = mysqli_query($conn, $query);
		if(!$result){
			die("Query couldn't complete");
		}
		display($result);
		
	}

	

	
	?>
	<h1>Events</h1>
	<textarea cols = 85 rows = 25 readonly id = 'displayEvents'></textarea>
	<br><input type = button value = 'START' onclick = areaStart()>
	<div hidden>
		<?php

			$query = "SELECT numChampions FROM Arena WHERE name = '$var'";
			$result = mysqli_query($conn, $query);
			if(!$result){
				die("Query couldn't complete");
			}
			$num = mysqli_fetch_row($result);
			echo "<input type = 'number' id = 'numChams' readonly value = $num[0]>";
		}
		mysqli_close($conn);
		?>
	</div>
	
 </body>
</html>
