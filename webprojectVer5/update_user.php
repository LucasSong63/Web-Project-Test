<?php
session_start();

if($_SESSION["Login"] != "YES") header("Location: loginpage.php");

    $user_ID = $_SESSION["ModifyID"];
    $username = $_POST["username"];
    $pword = $_POST["pword"];
    $fullname = $_POST["fullname"];
    $department = $_POST["department"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];

    require("config.php");

    $sql = "UPDATE user SET username='$username', password='$pword', name='$fullname', department='$department', 
    email = '$email', contact = '$contact', first_login = false WHERE id='$user_ID'";

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    if (($_SESSION['LEVEL'] == 1) && ($_SESSION['ID'] != $user_ID)) {
        header("Location:view_users.php?status=success");
    }
    else {
            header("Location:user_profile.php?status=success");
        }
    exit;
} else {
        mysqli_close($conn);
        if($_SESSION['LEVEL'] == 1)
        {
            header("Location:view_users.php?status=error");
        }
        else {
            header("Location:user_profile.php?status=error");
        }
        exit;
    }		

mysqli_close($conn);
?>