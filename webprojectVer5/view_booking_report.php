<?php
session_start();

$user_ID = $_SESSION["ID"];
$status = isset($_GET['status']) ? $_GET['status'] : 'All';

if ($_SESSION["Login"] != "YES") {
    header("Location: loginpage.php");
    exit;
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="navigationBar.css">
    <link rel="stylesheet" href="booking.css">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Viewing Space Booking Report</title>
    
    <script>
        function handleStatusChange() {
            var status = document.getElementById("status").value;
            window.location.href = "view_booking_report.php?status=" + status;
        }
        
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const deletes = urlParams.get('deletes');
            if (deletes === 'success') {
                alert('Record deleted successfully!');
            } else if (deletes === 'error') {
                alert('Error deleting record!');
            }
        }

    </script>

    <style>
        .container {
           padding-top: 60px; /* Add padding to push content below header */
        }
    
        .container h1 {
           margin-top: 30px; /* Add margin to separate from the container's edge */
        }

        p {
            margin: 0px 0px 30px 110px;
            font-size: 20px;
            color: #f8f6e8;
        }
     </style>
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
    <section class = "container">
    <h1>VIEW BOOKING REPORT</h1>
    <p>These are the details of each booking.
        <?php if($_SESSION['LEVEL'] == 3) { ?>
            You can click 'Delete' to delete your pending application.
        <?php } ?>
    </p>

    <?php
    require("config.php");

    if ($_SESSION["LEVEL"] == 3) {
        if ($status == "All") {
            $sql = "SELECT * FROM booking WHERE lecturer_id = $user_ID ORDER BY booking_ID DESC";
        } else {
            $sql = "SELECT * FROM booking WHERE lecturer_id = $user_ID AND booking_status = '$status' ORDER BY booking_ID DESC";
        }
    } else {
        $sql = "SELECT r.*, u.username FROM report r JOIN user u ON r.lecturer_id = u.ID ORDER BY r.lecturer_id";
    }

    $result = mysqli_query($conn, $sql);

    ?>
    <form name="sort_booking" method="POST">
    <div class="table">
        <table style="max-width:85%;">
            <tr>
                <?php if($_SESSION['LEVEL'] != 3) { ?>
                    <th>Lecturer Name</th>
                <?php } ?>
                <th>Type</th>
                <th>Date</th>
                <th>Time</th>
                <th>Purpose</th> 
                <th>Status 
                    <?php if ($_SESSION["LEVEL"] == 3) { ?>
                        <select id="status" name="status" onchange="handleStatusChange()">
                            <option value="All" <?php if ($status == "All") echo "selected"; ?>>All</option>
                            <option value="Pending" <?php if ($status == "Pending") echo "selected"; ?>>Pending</option>
                            <option value="Approved" <?php if ($status == "Approved") echo "selected"; ?>>Approved</option>
                            <option value="Rejected" <?php if ($status == "Rejected") echo "selected"; ?>>Rejected</option>
                        </select>
                    <?php } ?>
                </th>
                <th>Venue (if any)</th>
                <?php if ($_SESSION["LEVEL"] == 3) { ?>
                <th>Action (if any)</th>
                <?php } ?>
            </tr>
            <?php
            if (mysqli_num_rows($result) > 0) { 
                while ($rows = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                <?php if($_SESSION['LEVEL'] != 3) { ?>
                    <td><?php echo $rows['username']; ?></td>
                    <?php } ?>
                    <td><?php echo $rows['space_type']; ?></td>
                    <td><?php echo "2024 / " . $rows['booking_month'] . " / " . $rows['booking_day']; ?></td>
                    <td><?php echo "FROM " . $rows['start_time'] . " TO " . $rows['end_time']; ?></td>
                    <td><?php echo $rows['purpose']; ?></td>
                    <td><?php echo $rows['booking_status']; ?></td>
                    <td><?php echo $rows['venue']; ?></td>
                    <?php if ($_SESSION["LEVEL"] == 3 && $rows['booking_status'] == 'Pending') { ?>
                        <td><a href="delete_pending_booking.php?id=<?php echo $rows['booking_ID'] ?>" class="button">Delete</a></td>
                    <?php } ?>
                </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="7"><h3>There are no records to show</h3></td>
                </tr>
                <?php
            }
            ?>
        </table>
        </div>
    </form>
    </div>
    <?php
    mysqli_close($conn);
    ?>
    
	<!--For the logo use prupose-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
