<?php
		session_start();
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		$currentpage="account";
		include "pages.php";

?>
<?php include 'header.php';?>
<html>
	<head>
		<title>Log In</title>
		<link rel="stylesheet" href="index.css">
	</head>
<body>

<?php
	$msg = "Login";

// change the value of $dbuser and $dbpass to your username and password
	include 'connectvars.php';

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}

	if(checkAuth(0) == ""){
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    // where is the user trying to get back to, after logging in?
	    $sendBackTo = isset($_REQUEST["sendBackTo"]) ? $_REQUEST["sendBackTo"] : "mychampion.php";
			// Escape user inputs for security
			$username = mysqli_real_escape_string($conn, $_POST['username']);
			$userpassword = mysqli_real_escape_string($conn, $_POST['password']);
			$queryIn = "SELECT * FROM Sponsors where username='$username' ";
			$resultIn = mysqli_query($conn, $queryIn);
			if($row = mysqli_fetch_assoc($resultIn)){
				$salt = $row['salt'];
				$password = md5($userpassword.$salt);
				$saltSql = "SELECT * FROM Sponsors WHERE password='$password' ";
				$resultIn = mysqli_query($conn, $saltSql);
				if (mysqli_num_rows($resultIn) > 0) {
					$msg = "Login Succesful";
	        $_SESSION["username"] = $username;
	        echo "<script>location.replace(".json_encode($sendBackTo).");</script>";
				}else {
					$msg = "<h2>Can't Login</h2> Username or password doesn't match<p>";
				}
			} else {
				$msg = "<h2>Can't Login</h2> Username doesn't exist.<p>";
			}
	}
	// close connection
	mysqli_close($conn);
?>
<section>
    <h2> <?php echo $msg; ?> </h2>

<form method="post" id="addForm">
<fieldset>
	<legend>User Info:</legend>

    <p>
        <label for="Username">Username:</label>
        <input type="text" class="required" name="username" id="username">
    </p>

    <p>
        <label for="Password">Password:</label>
        <input type="text" class="required" name="password" id="password">
    </p>

</fieldset>

      <p>
        <input type = "submit"  value = "Submit" />
      </p>
</form>

<p>
  Don't have an account? Sign up <a href="signUp.php">here</a>
</p>

<?php }else{
	$username = (string)($_SESSION['username']);
	$queryIn = "SELECT wins, credits FROM Sponsors WHERE username = '$username'";
	$resultIn = mysqli_query($conn, $queryIn);
	$userdata =  mysqli_fetch_assoc($resultIn);
	echo "<div class='account'>";
	echo "<div id='username'>".$username."</div>";
	echo "<div id='stats'> <p> <bold>Stats:</bold> <br> Wins: ".$userdata['wins']." <br> credits: ".$userdata['credits']." </p> </div>";

	$queryIn = "SELECT C.name, C.arena, C.level, C.exp, C.power, C.intelligence, C.endurance FROM Champions C WHERE C.username = '$username'";
	$resultIn = mysqli_query($conn, $queryIn);
	echo "<div id='champions'>";

	echo "<h4>Champions</h4>";
	echo "<table id='championtable' border='t'><tr>";
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
	echo "</tr>";
	echo "</div>";

	echo "</div>";
	mysqli_close($conn);
}
?>
</body>
</html>
