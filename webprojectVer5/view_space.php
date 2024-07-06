<?php
session_start();

$type = isset($_GET['type']) ? $_GET['type'] : '';
$month = isset($_GET['month']) ? $_GET['month'] : 'JUN';
$day = isset($_GET['day']) ? $_GET['day'] : '';
$time_slot = isset($_GET['time_slot']) ? $_GET['time_slot'] : '';

if ($_SESSION["Login"] != "YES") {
    header("Location: loginpage.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="booking.css">
    <link rel="stylesheet" href="navigationBar.css">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Viewing Space Availability</title>
    <script>
        function handleStatusChange() {
            var type = document.getElementById("type").value;
            var month = document.getElementById("month").value;
            var day = document.getElementById("day").value;
            var time_slot = document.getElementById("time_slot").value;
            window.location.href = "view_space.php?type=" + type + "&month=" + month + "&day=" + day + "&time_slot=" + time_slot;
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
    <h1>View Space Availability</h1>
    <p>You can sort the space booking information by space type, month, day, and time slot.<br> 
        The order of the list is based on the approved order.
    </p>

    <?php
    require("config.php");

    $sql = "SELECT * FROM spaces WHERE 1=1";

    if ($type) {
        $sql .= " AND types = '$type'";
    }
    if ($month) {
        $sql .= " AND booking_month LIKE '$month'";
    }
    if ($day) {
        $sql .= " AND booking_day LIKE '$day'";
    }
    if ($time_slot) {
        $sql .= " AND '$time_slot' BETWEEN start_time AND end_time";
    }

    $sql .= " ORDER BY space_ID";

    echo "<!-- SQL Query: $sql -->"; // Debugging: Print the SQL query

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        exit;
    }
    ?>
    <form name="sort_spaces" method="GET">
    <div class="table" >
        <table style="width:80%;">
            <tr>
                <th>Type :
                    <select id="type" name="type" onchange="handleStatusChange()">
                        <option value="">All</option>
                        <option value="Lecture Room" <?php if($type == "Lecture Room") echo "selected";?>>Lecture Room</option>
                        <option value="Lab" <?php if($type == "Lab") echo "selected";?>>Lab</option>
                    </select>
                </th>
                <th>Month :
                    <select id="month" name="month" onchange="handleStatusChange()">
                        <option value="JUN" <?php if($month == "JUN") echo "selected";?>>JUN</option>
                        <option value="JUL" <?php if($month == "JUL") echo "selected";?>>JUL</option>
                        <option value="AUG" <?php if($month == "AUG") echo "selected";?>>AUG</option>
                        <option value="SEP" <?php if($month == "SEP") echo "selected";?>>SEP</option>
                        <option value="OCT" <?php if($month == "OCT") echo "selected";?>>OCT</option>
                        <option value="NOV" <?php if($month == "NOV") echo "selected";?>>NOV</option>
                        <option value="DEC" <?php if($month == "DEC") echo "selected";?>>DEC</option>
                    </select>
                </th>
                <th>Day :
                    <input type="text" id="day" name="day" maxlength="2" size="2" value="<?php echo $day; ?>" onchange="handleStatusChange()">
                </th>
                <th>Time Slot (#HHMM) :
                    <input type="text" id="time_slot" name="time_slot" maxlength="4" size="4" value="<?php echo $time_slot; ?>" onchange="handleStatusChange()">
                </th>
                <th>Venue</th>
            </tr>
            <?php 
            if(mysqli_num_rows($result) > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $rows['types'];?></td>
                    <td><?php echo $rows['booking_month'];?></td>
                    <td><?php echo $rows['booking_day'];?></td>
                    <td><?php echo "FROM " . $rows['start_time'] . " TO " . $rows['end_time']; ?></td>
                    <td><?php echo $rows['venue'];?></td>
                </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5"><h3>There are no records to show</h3></td>
                </tr>
                <?php
            }
            ?>
        </table>
        </div>
    </form>
    <div class="table">
    <a href="view_pending_booking.php"><button style="width:150%;">Back</button></a>
    </div>
    </section>
    <?php
    mysqli_close($conn);
    ?>
    
	<!--For the logo use prupose-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
