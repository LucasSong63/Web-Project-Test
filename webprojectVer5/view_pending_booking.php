<?php
session_start();

if ($_SESSION["Login"] != "YES") {
    header("Location: loginpage.php");
    exit; // Ensure the script stops executing after the redirect
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="navigationBar.css">
    <link rel="stylesheet" href="booking.css">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Managing Pending Application</title>
    <style>
        .container {
           padding-top: 60px; /* Add padding to push content below header */
        }
    
        .container h1 {
           margin-top: 30px; /* Add margin to separate from the container's edge */
        }
        body::before {
            background-image: url("lecture_hall.jpg");
        }
     </style>
     <script>
     window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');
            if (status === 'approve') {
                alert('Application approved successfully!');
            } else if (status === 'reject') {
                alert('Application rejected successfully!');
            } else if (status === 'error') {
                alert('Error updating application!');
            }
        }
    </script>
</head>
<body>
<header class="header"> <!--For the upper side bar-->
    <a href="#" class="logo"><ion-icon name="calendar"></ion-icon>Booking</a>
      <nav class="nav">
        <?php 
        if($_SESSION['LEVEL'] == 1) { 
            echo "<a href = main_admin.php >Home</a>";
        }
        else if($_SESSION['LEVEL'] == 2) { 
            echo "<a href = main_space_manager.php>Home</a>";
        }
        else if($_SESSION['LEVEL'] == 3) { 
            echo "<a href = main_lecturer.php>Home</a>";
        } ?>
            <a href = "user_profile.php">Profile</a>
        <a href = "logout.php">Log Out</a>
      </nav>
 </header>
 <section class="container">
    <h1>MANAGE PENDING APPLICATION</h1>
    <p>You are allowed to approve or reject the space booking application.<br>
        The system will prompt you to fill in the venue assigned if you choose 'Approve'. Click on 'Check Availability' to check for available space.</p>
    <?php
    require("config.php");

    if ($_SESSION["LEVEL"] != 3) {
        $sql = "SELECT * FROM booking WHERE booking_status = 'Pending'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) { ?>
            <div class="table">
            <table style="max-width:85%;">
                <tr>
                    <th>Lecturer ID</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Purpose</th>
                    <th>Status</th>
                    <th><a href="view_space.php"><button class="space" name="space"><strong>Check Availability<strong></button></a></th>
                </tr>

                <?php 
                while ($rows = mysqli_fetch_assoc($result)) { ?>    
                    <tr>
                        <td><?php echo $rows['lecturer_id'] ?></td>
                        <td><?php echo $rows['space_type']; ?></td>
                        <td><?php echo "2024 / " . $rows['booking_month'] . " / " . $rows['booking_day']; ?></td>
                        <td><?php echo "FROM " . $rows['start_time'] . " TO " . $rows['end_time']; ?></td>
                        <td><?php echo $rows['purpose']; ?></td>
                        <td><?php echo $rows['booking_status']; ?></td>
                        <td>
                            <div class="buttons">
                            <a href="approve_booking.php?id=<?php echo $rows['booking_ID']; ?>"><button name="Approve">Approve</button></a> 
                            <a href="reject_booking.php?id=<?php echo $rows['booking_ID']; ?>"><button name="Reject">Reject</button></a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            </div>
        <?php 
        } else {  ?>
        <div class="empty"><h3>There are no records to show</h3></div>
        <?php mysqli_close($conn);
    } 
    } else {
        echo "<p>You do not have permission to view this page.</p>";
    }
    ?>
</section>

	<!--For the logo use prupose-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
