<!DOCTYPE html>
<!-- Log in -->
<?php
		$currentpage="account";
		include "pages.php";

?>
<html>
	<head>
		<title>Log In</title>
		<link rel="stylesheet" href="index.css">
		<!-- <script type = "text/javascript"  src = "formVerify.js" > </script> -->
	</head>
<body>


<?php
	include "header.php";
	$msg = "Login";

// change the value of $dbuser and $dbpass to your username and password
	include 'connectvars.php';

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
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
			$password = md5('$userpassword$salt');
			$saltSql = "SELECT * FROM Sponsors WHERE password='$password' ";
			$resultIn = mysqli_query($conn, $saltSql);
			if (mysqli_num_rows($resultIn) > 0) {
				$msg = "Login Succesful";
                $_SESSION["username"] = $username;
                echo "<script>location.replace(".json_encode($sendBackTo).");
                </script>";

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

</body>
</html>
