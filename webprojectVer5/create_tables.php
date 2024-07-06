<?php
require("config.php");
require("functions.php");

// Create user table
$userTableSQL = "CREATE TABLE user(
    ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(12) NOT NULL,
    level int(3) NOT NULL,
    name VARCHAR(100),
    department VARCHAR(50),
    email VARCHAR(100),
    contact VARCHAR(15),
    first_login BOOLEAN DEFAULT TRUE
)";
createTable($conn, $userTableSQL, "user");

// Insert records into user table
$userRecordsSQL = "INSERT INTO user (username, password, level)
VALUES ('Alice', 'admin1', 1);";
$userRecordsSQL .= "INSERT INTO user (username, password, level)
VALUES ('Chong', 'admin2', 1);";
$userRecordsSQL .= "INSERT INTO user (username, password, level)
VALUES ('Leena', 'manager1', 2);";
$userRecordsSQL .= "INSERT INTO user (username, password, level)
VALUES ('Paul', 'manager2', 2);";
$userRecordsSQL .= "INSERT INTO user (username, password, level)
VALUES ('Othman', 'lecturer1', 3);";
$userRecordsSQL .= "INSERT INTO user (username, password, level)
VALUES ('Fatimah', 'lecturer2', 3);";
insertRecords($conn, $userRecordsSQL);

// Create booking table
$bookingTableSQL = "CREATE TABLE booking(
    booking_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    lecturer_id INT(6) NOT NULL,
    space_type VARCHAR(20) NOT NULL,
    booking_month VARCHAR(3) NOT NULL,
    booking_day VARCHAR(2) NOT NULL,
    start_time VARCHAR(4) NOT NULL,
    end_time VARCHAR(4) NOT NULL,
    purpose VARCHAR(15) NOT NULL,
    booking_status VARCHAR(10) NOT NULL,
    venue VARCHAR(15)
)";
createTable($conn, $bookingTableSQL, "booking");

// Insert records into booking table
$bookingRecordsSQL = "INSERT INTO booking (lecturer_id, space_type, booking_month, booking_day, start_time, end_time, purpose, booking_status, venue)
VALUES ('5', 'Lab', 'JUN', '17', '2000', '2200', 'Lab', 'Rejected', 'N28,PMO');";
$bookingRecordsSQL .= "INSERT INTO booking (lecturer_id, space_type, booking_month, booking_day, start_time, end_time, purpose, booking_status, venue)
VALUES ('5', 'Lecture Room', 'JUN', '23', '0800', '1100', 'Lecture', 'Approved', 'N28,BK7');";
$bookingRecordsSQL .= "INSERT INTO booking (lecturer_id, space_type, booking_month, booking_day, start_time, end_time, purpose, booking_status, venue)
VALUES ('6', 'Lab', 'JUN', '23', '1000', '1300', 'Lecture', 'Approved', 'N28,BK5');";
$bookingRecordsSQL .= "INSERT INTO booking (lecturer_id, space_type, booking_month, booking_day, start_time, end_time, purpose, booking_status)
VALUES ('5', 'Lecture Room', 'JUN', '24', '1000', '1300', 'Lecture', 'Pending');";
$bookingRecordsSQL .= "INSERT INTO booking (lecturer_id, space_type, booking_month, booking_day, start_time, end_time, purpose, booking_status)
VALUES ('5', 'Lab', 'JUN', '25', '2000', '2200', 'Examination', 'Pending');";
$bookingRecordsSQL .= "INSERT INTO booking (lecturer_id, space_type, booking_month, booking_day, start_time, end_time, purpose, booking_status)
VALUES ('6', 'Lecture Room', 'JUN', '23', '0800', '1100', 'Lecture', 'Pending');";
$bookingRecordsSQL .= "INSERT INTO booking (lecturer_id, space_type, booking_month, booking_day, start_time, end_time, purpose, booking_status)
VALUES ('6', 'Lecture Room', 'JUN', '23', '1400', '1600', 'Lab', 'Pending');";
$bookingRecordsSQL .= "INSERT INTO booking (lecturer_id, space_type, booking_month, booking_day, start_time, end_time, purpose, booking_status)
VALUES ('6', 'Lab', 'JUN', '27', '1100', '1300', 'Lab', 'Pending');";
insertRecords($conn, $bookingRecordsSQL);

// Create report table
$reportTableSQL = "CREATE TABLE report(
    report_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    lecturer_id INT(6) NOT NULL,
    space_type VARCHAR(20) NOT NULL,
    booking_month VARCHAR(3) NOT NULL,
    booking_day VARCHAR(2) NOT NULL,
    start_time VARCHAR(4) NOT NULL,
    end_time VARCHAR(4) NOT NULL,
    purpose VARCHAR(15) NOT NULL,
    booking_status VARCHAR(10) NOT NULL,
    venue VARCHAR(15)
)";
createTable($conn, $reportTableSQL, "report");

// Insert records into report table
$reportRecordsSQL = "INSERT INTO report (lecturer_id, space_type, booking_month, booking_day, start_time, end_time, purpose, booking_status, venue)
VALUES ('5', 'Lab', 'JUN', '17', '2000', '2200', 'Lab', 'Rejected', 'N28,PMO');";
$reportRecordsSQL .= "INSERT INTO report (lecturer_id, space_type, booking_month, booking_day, start_time, end_time, purpose, booking_status, venue)
VALUES ('5', 'Lecture Room', 'JUN', '23', '0800', '1100', 'Lecture', 'Approved', 'N28,BK7');";
$reportRecordsSQL .= "INSERT INTO report (lecturer_id, space_type, booking_month, booking_day, start_time, end_time, purpose, booking_status, venue)
VALUES ('6', 'Lab', 'JUN', '23', '1000', '1300', 'Lecture', 'Approved', 'N28,BK5');";
insertRecords($conn, $reportRecordsSQL);

// Create spaces table
$spacesTableSQL = "CREATE TABLE spaces(
    space_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    types VARCHAR(20) NOT NULL,
    booking_month VARCHAR(3) NOT NULL,
    booking_day VARCHAR(2) NOT NULL,
    start_time VARCHAR(4) NOT NULL,
    end_time VARCHAR(4) NOT NULL,
    venue VARCHAR(15) NOT NULL
)";
createTable($conn, $spacesTableSQL, "spaces");

// Insert records into spaces table
$spacesRecordsSQL = "INSERT INTO spaces (types, booking_month, booking_day, start_time, end_time, venue)
VALUES ('Lecture Room', 'JUN', '23', '0800', '1100', 'N28,BK7');";
$spacesRecordsSQL .= "INSERT INTO spaces (types, booking_month, booking_day, start_time, end_time, venue)
VALUES ('Lab', 'JUN', '23', '1000', '1300','N28,BK5');";
insertRecords($conn, $spacesRecordsSQL);

?> <a href="loginpage.php"><input type="button" value="Go to login page"></a> <?php

// Close the connection
mysqli_close($conn);

?>
