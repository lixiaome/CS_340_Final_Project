<!DOCTYPE html>
<!-- Create new account -->
<?php
		$currentpage="Sign Up";
		include "pages.php";
		
?>
<html>
	<head>
		<title>Sign Up</title>
		<link rel="stylesheet" href="index.css">
		<script type = "text/javascript"  src = "formVerify.js" > </script> 
	</head>
<body>


<?php
	include "header.php";
	$msg = "Sign up!";
// change the value of $dbuser and $dbpass to your username and password
	include 'connectvars.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Escape user inputs for security
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$emailAddress = mysqli_real_escape_string($conn, $_POST['emailAddress']);
		$userpassword = mysqli_real_escape_string($conn, $_POST['password1']);
        //create random salt 
        $salt = mcrypt_create_iv(12, MCRYPT_DEV_URANDOM);
		$password = md5('$userpassword$salt');
		$queryIn = "SELECT * FROM Sponsors where username='$username' ";
		$resultIn = mysqli_query($conn, $queryIn);
        // See if username is already in the table
		if (mysqli_num_rows($resultIn)> 0) {
			$msg ="<h2>Can't Add to Table</h2> There is already a user with that username $username<p>";
		} else {          
			$query = "INSERT INTO Sponsors (username, email, salt, password) VALUES ('$username',  '$emailAddress','$salt', '$password')";
			if(mysqli_query($conn, $query)){
			//$msg =  "Account is created<p></p>";
            echo '<p>Account is created...You may now <a href="account.php">log in...</a></p>';
			} else{
			echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
			}
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
        <label for="Email Address">Email:</label>
        <input type="text" class="required" name="emailAddress" id="emailAddress">
    </p>

    <p>
        <label for="Password">Password:</label>
        <input type="text" class="required" name="password1" id="password1">
    </p>

    <p>
        <label for="Password">Confirm Password:</label>
        <input type="text" class="required" name="password1" id="password2">
    </p>

</fieldset>

      <p>
        <input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
      </p>
</form>
</body>
</html>
