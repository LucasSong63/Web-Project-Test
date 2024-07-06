<?php 
session_start();
 
require('config.php');

// username and password sent from form
$myusername=$_POST["username"];
$mypassword=$_POST["password"];

$sql="SELECT * FROM user WHERE username='$myusername' and password='$mypassword'";

$result = mysqli_query($conn, $sql);

$rows=mysqli_fetch_assoc($result);

$user_name=$rows["username"];
$user_id=$rows["ID"];
$user_level=$rows["level"];
$user_first_login=$rows["first_login"];
	
// mysqli_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

    // Add user information to the session (global session variables)		
    $_SESSION["Login"] = "YES";
    $_SESSION["USER"] = $user_name;
    $_SESSION["ID"] = $user_id;
    $_SESSION["LEVEL"] =$user_level;

    if($user_first_login){
        //Redirect to a page where the user can enter their personal information
        header("Location: update_user_form.php?id=".$rows['ID']);
        exit();
    }
    else{

        switch($user_level){
            case 1:
                header("Location: main_admin.php");
                break;
            case 2:
                header("Location: main_space_manager.php");
                break;
            case 3:
                header("Location: main_lecturer.php");
                break;
            default:
                echo "Invalid user level.";
                break;
        }
        exit();
    }

} 
else { //if wrong username and password
    
    $_SESSION["Login"] = "NO";
    header("Location: loginpage.php");
}

mysqli_close($conn);

?>