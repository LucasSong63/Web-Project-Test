<?php
session_start();


$lecturer_id = $_SESSION["ID"];
$space_type = $_POST["type"];
$booking_month = $_POST["month"];
$booking_day = $_POST["day"];
$start_time = $_POST["start_time"];
$end_time = $_POST["end_time"];
$purpose = $_POST["purpose"];
$status = "Pending";

$booking_month = strtoupper($booking_month);

require("config.php");
$sql = "INSERT INTO booking(lecturer_id, space_type, booking_month, booking_day, start_time, end_time, purpose, booking_status) VALUES ('$lecturer_id', '$space_type', '$booking_month', '$booking_day', '$start_time', '$end_time', '$purpose', '$status')";

if(mysqli_query($conn,$sql)) {
  header("Location:booking_form.php?status=success");
  exit;
} else  {
    echo "Error: " .sql. "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
