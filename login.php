<!DOCTYPE html>
<!-- Add Part Info to Table Part -->
<?php
		$currentpage="Login";
		include "pages.php";
		
?>
<html>
	<head>
		<title>Login Up</title>
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

// Escape user inputs for security
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$queryIn = "SELECT * FROM HW1 where username='$username' ";
		$resultIn = mysqli_query($conn, $queryIn);
		if($row = mysqli_fetch_assoc($resultIn)){
			$salt = $row['salt'];
			$saltedpassword = md5($password);
			$saltSql = "SELECT * FROM HW1 WHERE password='$saltedpassword' ";
			//$queryIn = "SELECT * FROM HW1 WHERE username='$username' and password='$password' ";
			$resultIn = mysqli_query($conn, $saltSql);
			if (mysqli_num_rows($resultIn) > 0) {
				$msg = "Login Succesful";
			}else {		
				$msg = "<h2>Can't Login</h2> Username or password doesn't match<p>";
			}	
		} else {		
			$msg = "<h2>Can't Login</h2> Username or password doesn't match<p>";
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
</body>
</html>
