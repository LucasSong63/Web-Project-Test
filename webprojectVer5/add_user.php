<?php
session_start(); // Start up your PHP Session

// If the user is not logged in send him/her to the login form
if ($_SESSION["Login"] != "YES") 
header("Location: loginpage.php");

if ($_SESSION["LEVEL"] == 1) { 

	 $username = $_POST["username"];
	 $password = $_POST["pword"];
	 $level = $_POST["level"];

	 require ("config.php");
	 
	 $sql = "INSERT INTO user(username, password, LEVEL) VALUES ('$username','$password','$level')" ;
	 if (mysqli_query($conn, $sql)) {
		header("Location:view_users.php");
	} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
	 mysqli_close($conn);
	 
// If the user is not correct level
} else {
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";

}
 
?>