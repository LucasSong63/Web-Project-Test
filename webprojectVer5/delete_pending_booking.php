<?php

session_start();

if ($_SESSION["Login"] != "YES") 
header("Location: login.php");

$manage_id = $_GET['id'];

require("config.php");

$sql = "DELETE FROM booking WHERE booking_ID = '$manage_id'";

$result = mysqli_query($conn, $sql);

if (mysqli_query($conn, $sql)) { 
  if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header("Location:view_booking_report.php?deletes=success");
    exit;
  } else {
      mysqli_close($conn);
      header("Location: view_booking_report.php?deletes=error");
      exit;
    }	
  }
  else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
mysqli_close($conn);

?>