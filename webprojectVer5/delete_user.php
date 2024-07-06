<?php
// Start up your PHP Session
session_start();
// If the user is not logged in send him/her to the login form
if ($_SESSION["Login"] != "YES") 
header("Location: login.php");
 
if ($_SESSION["LEVEL"] == 1) { 

		 $ID = $_GET["id"];
 
	     require ("config.php");

	     $sql = "DELETE FROM user WHERE id = $ID" ;

	     $result = mysqli_query($conn, $sql);

	      if (mysqli_query($conn, $sql)) {
			mysqli_close($conn);
			header("Location:view_users.php?status=deletesuccess");
			exit;
		} else {
				mysqli_close($conn);
				header("Location: view_users.php?status=deleteerror");
				exit;
			}				
		    
// If the user is not correct level
} else {
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";

    if ($_SESSION["LEVEL"] == 2) {
        echo "<p><a href='main_space_manager.php'>Go back to main page</a></p>";
    } else if ($_SESSION["LEVEL"] == 3) {
        echo "<p><a href='main_lecturer.php'>Go back to main page</a></p>";
    }
    echo "<p><a href='logout.php'>Log out</a></p>";
}
 
?>