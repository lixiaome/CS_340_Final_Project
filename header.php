<header> 
		Battle Royal - <em>Welcome <span id="username"><?php echo $username;?></span>!</em>
</header>
<nav>
<ul>
<?php
session_start(); 
function currentUrl() {
	$pageURL = 'http';
	if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["SCRIPT_NAME"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"];
	}
	// FYI: You could also append the query string if that was important to you
	return $pageURL;
}

// returns the user's uid if logged in
// or returns "" <-- in this case, pass $redirectIfNeeded = true to force login
function checkAuth($redirectIfNeeded) {
	// is the user already logged in?
	if (isset($_SESSION["username"]) && $_SESSION["username"] != "") {
		// yes, already logged in
		return $_SESSION["username"];
	} else if ($redirectIfNeeded) {
		// user is not logged in and needs to do so
		// send to the login page

		// pass the current URL so that we can come back here after login
		$currentUrl = currentUrl();
		// rawurlencode converts the string so it's safe to pass as a URL GET parameter
		$urlOfLogin = "account.php?sendBackTo=".rawurlencode($currentUrl)."&cb=".microtime(true);

		// use a JavaScript redirect; FYI, there's also an http header (Location:) that 
		//    can be used to redirect, but that MUST be sent before any HTML, and this 
		//    function (checkAuth) might be called after some HTML is sent
		echo "<script>location.replace('$urlOfLogin');</script>";
		return "";
	} else {
		// user is not logged in, but whoever called this function doesn't care
		return "";
	}
}
		foreach ($content as $page => $location){
			echo "<li><a href='$location?user=".$username."' ".($page==$currentpage?" class='active'":"").">".$page."</a></li>";			
		}
		?>
		</ul>

	</nav>
