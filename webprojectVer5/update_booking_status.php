<?php
session_start();

$manage_id = $_SESSION["manage_id"];
$venue = $_POST["venue"];
if(($venue))
{
    $status = "Approved";
}
else 
{
    $status = "Rejected";
    $venue = NULL;
}
require("config.php");

$sql = "UPDATE booking SET booking_status='$status', venue='$venue' WHERE booking_ID = '$manage_id'";

if (mysqli_query($conn, $sql)) {
    echo "<h3>Record updated successfully</h3>";
    if ($_SESSION['LEVEL'] == 1) { 
        ?>
            <br><a href="main_admin.php"><input type="button" value="Back to main menu"></a>
            <?php 
        } elseif ($_SESSION['LEVEL'] == 2) {
        ?>
            <br><a href="main_space_manager.php"><input type="button" value="Back to main menu"></a>
            <?php }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
$sql = "INSERT INTO report(lecturer_id, space_type, booking_month, booking_day, start_time, end_time, purpose, booking_status, venue)
                    SELECT lecturer_id, space_type, booking_month, booking_day, start_time, end_time, purpose, booking_status, venue
                    FROM booking
                    WHERE booking_id = '$manage_id'";
  if (mysqli_query($conn, $sql)) {
      echo "<h3>Record updated successfully</h3>";
      if ($_SESSION['LEVEL'] == 1) { 
          ?>
              <br><a href="main_admin.php"><input type="button" value="Back to main menu"></a>
              <?php 
          } elseif ($_SESSION['LEVEL'] == 2) {
          ?>
              <br><a href="main_space_manager.php"><input type="button" value="Back to main menu"></a>
              <?php }
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
          
if(($venue)) {
$sql = "INSERT INTO spaces(types, booking_month, booking_day, start_time, end_time, venue)
SELECT space_type, booking_month, booking_day, start_time, end_time, venue
FROM booking
WHERE booking_id = '$manage_id'";
}

if (mysqli_query($conn, $sql)) {
    if($venue) {
        mysqli_close($conn);  
        header("Location:view_pending_booking.php?status=approve");
        exit;
    }
    else {
        mysqli_close($conn);  
        header("Location:view_pending_booking.php?status=reject");
        exit;
    }
} else {
    mysqli_close($conn);
    header("Location:view_pending_booking.php?status=error");
    exit;
    }
  mysqli_close($conn);