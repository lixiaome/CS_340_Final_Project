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
					$msg = "<h2>Can't Login <br> Username or password doesn't match</h2> <p>";
				}
			} else {
				$msg = "<h2>Can't Login <br> Username doesn't exist.</h2><p>";
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

<p class = "white">
  Don't have an account? Sign up <a href="signUp.php">here</a>
</p>

<?php }else{
	$username = (string)($_SESSION['username']);
	$queryIn = "SELECT wins, credits, cNum FROM Sponsors WHERE username = '$username'";
	$resultIn = mysqli_query($conn, $queryIn); 

    echo "<h3>$username</h3>";
	echo "<table id='t01' border='t'><tr>";
	$fields_num = mysqli_num_fields($resultIn);
	for($i = 0;$i < $fields_num; $i++){
		$field = mysqli_fetch_field($resultIn);
		echo "<td><b>$field->name</b></td>";
	}
	echo "</tr>\n";
	while($row = mysqli_fetch_row($resultIn)) {
		echo "<tr>";
		foreach($row as $cell){
			echo "<td>$cell</td>";
		}
		echo "</tr>\n";
	}

	$queryIn = "SELECT C.name, C.arena, C.level, C.exp, C.power, C.intelligence, C.endurance FROM Champions C WHERE C.username = '$username'";
	$resultIn2 = mysqli_query($conn, $queryIn);
	echo "<table id='t01' border='t'><tr>";
	$fields_num = mysqli_num_fields($resultIn2);
	for($i = 0;$i < $fields_num; $i++){
		$field = mysqli_fetch_field($resultIn2);
		echo "<td><b>$field->name</b></td>";
	}
	echo "</tr>\n";
	while($row = mysqli_fetch_row($resultIn2)) {
		echo "<tr>";
		foreach($row as $cell){
			echo "<td>$cell</td>";
		}
		echo "</tr>\n";
	}
	mysqli_close($conn);
}
?>
</body>
</html>
