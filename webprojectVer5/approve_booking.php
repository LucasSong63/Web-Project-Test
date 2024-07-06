<?php
session_start();

$manage_id = $_GET["id"];
$_SESSION["manage_id"] = $manage_id;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="navigationBar.css">
    <link rel="stylesheet" href="booking.css">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Approving Space Booking Application</title>
    <script>
        function validate() {
            if (document.update_status.venue.value == "") {
                alert("Please enter the venue assigned to this booking!");
                document.update_status.venue.focus();
                return false;
            }
            return true;
        }
    </script>
    <style>
        .container {
            padding-top: 60px; /* Add padding to push content below header */
        }
        .container h1 {
            margin-top: 20px; /* Add margin to separate from the container's edge */
        }
        body::before {
            background-image: url("lecture_hall.jpg");
        }
    </style>
</head>

<body>
<header class="header"> <!--For the upper side bar-->
    <a href="#" class="logo"><ion-icon name="calendar"></ion-icon>Booking</a>
    <nav class="nav">
        <?php 
        if ($_SESSION['LEVEL'] == 1) { 
            echo "<a href='main_admin.php'>Home</a>";
        } else if ($_SESSION['LEVEL'] == 2) { 
            echo "<a href='main_space_manager.php'>Home</a>";
        } else if ($_SESSION['LEVEL'] == 3) { 
            echo "<a href='main_lecturer.php'>Home</a>";
        } ?>
        <a href="user_profile.php">Profile</a>
        <a href="logout.php">Log Out</a>
    </nav>
</header>
<section class="container">
    <h1>APPROVE BOOKING APPLICATION</h1>
    <p>Please fill in the venue assigned to this application, then click 'Confirm' to submit.</p>
    <?php
    require("config.php");

    $sql = "SELECT * FROM booking WHERE booking_ID = '$manage_id'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) { ?>
        <form action="update_booking_status.php" name="update_status" method="POST" onsubmit="return validate();">
        <div class="table">
            <table style="max-width:80%"> 
                <tr>
                    <th>Lecturer ID</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Purpose</th>
                    <th>Status</th>
                    <th>Venue</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td><?php echo $_SESSION['ID']; ?></td>
                    <td><?php echo $rows['space_type']; ?></td>
                    <td><?php echo "2024/ " . $rows['booking_month'] . " / " . $rows['booking_day']; ?></td>
                    <td><?php echo "FROM " . $rows['start_time'] . " TO " . $rows['end_time']; ?></td>
                    <td><?php echo $rows['purpose']; ?></td>
                    <td><input type="text" disabled name="status" id="status" value="Approved" size="10"></td>
                    <td><input type="text" name="venue" id="venue" size="10"></td>
                    <td><button type="submit">Confirm</button></td>
                </tr>
            </table>
        </div>
        </form>
    <?php } else { ?>
        <h3 class="empty">There are no records to show</h3>
    <?php } 
    mysqli_close($conn);
    ?>
</section>

	<!--For the logo use prupose-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
