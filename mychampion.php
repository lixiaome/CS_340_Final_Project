<?php
		session_start();
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		$currentpage="My Champions";
		include "pages.php";
        include "header.php";
?>
<html>
	<head>
		<title>My Champions</title>
		<link rel="stylesheet" href="index.css">
		<script type = "text/javascript"  src = "championHandler.js" > </script>
	</head>
<?php
	if (checkAuth(true) != "") {
?>
<body>
  <?php
	include 'connectvars.php';

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	
	$username = (string)($_SESSION['username']);
	$queryIn = "SELECT wins, credits FROM Sponsors WHERE username = '$username'";
	$resultIn = mysqli_query($conn, $queryIn);
	$userdata =  mysqli_fetch_assoc($resultIn);
	echo "<div class='account'>";
	echo "<div id='username'>".$username."</div>";
	echo "<div id='stats'> <p> <bold>Stats:</bold> <br> Wins: ".$userdata['wins']." <br> credits: ".$userdata['credits']." </p> </div>";


	echo "<div class='champions'>";

	$queryIn = "SELECT C.name, C.arena, C.level, C.exp, C.power, C.intelligence, C.endurance FROM Champions C WHERE C.username = '$username'";
	$resultIn = mysqli_query($conn, $queryIn);
	echo "<div id='champions'>";

	echo "<h4>Champions</h4>";
	echo "<table id='championtable' border='t'><tr>";
	echo "<table id='t01' border='t'><tr>";
	$fields_num = mysqli_num_fields($resultIn);
	for($i = 0;$i < $fields_num; $i++){
		$field = mysqli_fetch_field($resultIn);
		echo "<td><b>$field->name</b></td>";
	}
	echo "<tr>";
	while($row = mysqli_fetch_assoc($resultIn)){
		echo "<div class='champion'>";
		echo "<td>".$row['name']."</td>";
		echo "<td>".(isset($row['arena']) ? $row['arena'] : "relaxing")."</td>";
		echo "<td>".$row['level']."</td>";
		echo "<td>".$row['exp']."</td>";
		echo "<td>".$row['power']."</td>";
		echo "<td>".$row['intelligence']."</td>";
		echo "<td>".$row['endurance']."</td>";
		echo "</div>";
	}
	echo "</table>";
	echo "</table>";
	echo "</tr>";
	echo "</div>";

	echo "</div>";
	mysqli_close($conn);

?>
	<div class = 'newChams'>
	<form method="post" id="addCham">
	<fieldset>
		<legend>Add Champions:</legend>
		<table id='addChamtable' border='t'>
		<tr>
		<td>
			<label for="cName">Champion Name</label>
		</td>

		<td>
			<label for="level">level</label>
		</td>
		<td>
			<label for="power">power</label>
		</td>
		<td>
			<label for="intelligence">intelligence</label>
		</td>
		<td>
			<label for="endurance">endurance</label>
		</td>		
		</tr>
		<tr>
		<td>
			<input type="text" class="required" name="cName" id="cName" placeholder = "Input Champion's Name">
		</td>

		<td>
			<input type="number" class="required" name="level" id="level" min = 1 value = 1 onchange = REroll()>
		</td>
		<td>
			<input type="number" class="required" name="power" id="power" readonly>
		</td>
		<td>
			<input type="number" class="required" name="intelligence" id="intelligence" readonly>
		</td>
		<td>
			<input type="number" class="required" name="endurance" id="endurance" readonly>
		</td>

		</tr>
		</table>
	</fieldset>
		<label for="cost">cost</label>
		<input type="number" class="required" name="cost" id="cost" readonly>
		  <p>
			<input type = "submit"  value = "Submit" />
			<input type = "button" value = "Reroll" onclick = REroll()>
		  </p>
	</form>
	</div>
 </body>

</html>
<?php } ?>
