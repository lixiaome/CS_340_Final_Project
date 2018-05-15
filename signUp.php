<!DOCTYPE html>
<!-- Add Part Info to Table Part -->
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
		$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
		$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
		$emailAddress = mysqli_real_escape_string($conn, $_POST['emailAddress']);
		$age = mysqli_real_escape_string($conn, $_POST['age']);		
		$salt = md5('$firstname');
		$userpassword = mysqli_real_escape_string($conn, $_POST['password1']);
		$msg = $userpassword + $salt;
		$password = md5($userpassword);
		$queryIn = "SELECT * FROM HW1 where username='$username' ";
		$resultIn = mysqli_query($conn, $queryIn);
		
// See if pid is already in the table
		if (mysqli_num_rows($resultIn)> 0) {
			$msg ="<h2>Can't Add to Table</h2> There is already a user with that username $username<p>";
		} else {		
			
			$query = "INSERT INTO HW1 (username, firstname, lastname, emailAddress, password, age, salt) VALUES ('$username', '$firstname', '$lastname', '$emailAddress', '$password', '$age', '$salt')";
			
			if(mysqli_query($conn, $query)){
			//$msg =  "Record added successfully.<p>";
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
        <label for="First Name">First Name:</label>
        <input type="text" class="required" name="firstname" id="firstname">
    </p>

    <p>
        <label for="Last Name">Last Name:</label>
        <input type="text" class="required" name="lastname" id="lastname">
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
        <label for="Password">Password:</label>
        <input type="text" class="required" name="password1" id="password2">
    </p>


    <p>
        <label for="Age">Age:</label>
        <input type="number" min=1 max = 99999 class="required" name="age" id="age" title="age should be numeric">
    </p>

</fieldset>

      <p>
        <input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
      </p>
</form>
</body>
</html>
