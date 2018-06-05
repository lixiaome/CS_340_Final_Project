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
		}
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
