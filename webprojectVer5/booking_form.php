<?php
session_start();

if ($_SESSION["Login"] != "YES") {
    header("Location: loginpage.php");
    exit;
}

if ($_SESSION["LEVEL"] == 3) { 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Space Booking Application</title>
    <link rel="stylesheet" href="navigationBar.css">
    <link rel="stylesheet" href="booking.css">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    
    <script>
        function validate() {
            // Check if at least one type is selected
            var types = document.getElementsByName("type");
            var typeSelected = false;
            for (var i = 0; i < types.length; i++) {
                if (types[i].checked) {
                    typeSelected = true;
                    break;
                }
            }
            if (!typeSelected) {
                alert("Please choose your booking room type!");
                return false;
            }
            
            // Check if month is selected
            if (document.booking_form.month.value == "") {
                alert("Please choose your booking month!");
                document.booking_form.month.focus();
                return false;
            }
            
            // Check if day is entered
            if (document.booking_form.day.value == "" || isNaN(document.booking_form.day.value) || document.booking_form.day.value > 31) {
                alert("Please enter a valid booking day!");
                document.booking_form.day.focus();
                return false;
            }
            
            // Check if start and end times are valid numbers and within 0000-2359 range
            var startTime = document.booking_form.start_time.value;
            var endTime = document.booking_form.end_time.value;
            if (startTime == "" || endTime == "" || isNaN(startTime) || isNaN(endTime) || 
                startTime.length != 4 || endTime.length != 4 ||
                startTime < "0800" || startTime > "2200" ||
                endTime < "0800" || endTime > "2400") {
                alert("Please enter valid booking period in the format HHMM!");
                document.booking_form.start_time.focus();
                return false;
            }
            
            // Check if at least one purpose is selected
            var purposes = document.getElementsByName("purpose");
            var purposeSelected = false;
            for (var i = 0; i < purposes.length; i++) {
                if (purposes[i].checked) {
                    purposeSelected = true;
                    break;
                }
            }
            if (!purposeSelected) {
                alert("Please choose your purpose of booking!");
                return false;
            }
            
            return true;
        }
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');
            if (status === 'success') {
                alert('Application submitted successfully!');
            } else if (status === 'error') {
                alert('Error submitting application!');
            }
        }
    </script>
    <style>
        .container {
           padding-top: 60px; /* Add padding to push content below header */
        }
    
        .container h1 {
           margin-top: 20px; /* Add margin to separate from the container's edge */
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
        <h1>SPACE BOOKING FORM</h1>
        <p>Please fill in the following information:<br><br></p>
    
        <form action="insert_booking.php" name="booking_form" method="POST" onsubmit="return validate();">
        <div class="table">
            <table style="max-width:65%;">
            <tr>
                <th>Type</th>
                <td>
                    <div style="display:flex;flex-direction:column; justify-items:center; align-items:center;">
                    <div style="display:flex; flex-direction:row;max-width:80%">
                        <div class ="lecture" style="display:flex; flex-direction:column; justify-items:center; align-items:center;">
                            <div style="margin:10px 0px 0px 0px;"><input type="radio" name="type" value="Lecture Room">Lecture Room<br><br></div>
                            <img src="lecture_room.jpg" style="max-width:60%;"><br><br>
                        </div>
                        <div style="display:flex; flex-direction:column; justify-items:center; align-items:center;">
                            <div style="margin:10px 0px 0px 0px;"><input type="radio" name="type" value="Lab">Lab<br><br></div>
                            <img src="lab_room.jpg" style="max-width:60%;">
                        </div>
                    </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>Date</th>
                <td>
                <div style="display:flex; flex-direction:column; justify-items:center; align-items:center;">
                <div style="display:flex; flex-direction:row; justify-items:center; align-items:center;">
                    2024 <div style="margin:0px 0px 0px 20px"> / </div><div style="margin:0px 20px; font-size:20px;"><select id="month" name="month">
                        <option value="jun">JUN</option>
                        <option value="jul">JUL</option>
                        <option value="aug">AUG</option>
                        <option value="sep">SEP</option>
                        <option value="oct">OCT</option>
                        <option value="nov">NOV</option>
                        <option value="dec">DEC</option>
                    </select>
                    </div>
                    / <div style="margin:0px 20px"><input type="text" name="day" size="2"></div>
                    </div>
                </div>
                </div>
                </td>
            </tr>
            <tr>
                <th>Time</th>
                <td>
                    <div style="display:flex; flex-direction:column; justify-items:center; align-items:center;">
                        <div style="display:flex; flex-direction:row; justify-items:center; align-items:center;">
                        FROM <div style="margin:0px 20px"><input type="text" name="start_time" size="4"></div>
                        TO <div style="margin:0px 20px"><input type="text" name="end_time" size="4"></div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>Purpose</th>
                <td>
                    <div style="display:flex; flex-direction:column; justify-items:center; align-items:center;">
                        <div style="display:flex; flex-direction:row; justify-items:center; align-items:center;">
                            <div style="margin:0px 20px"><input type="radio" name="purpose" value="Lecture">Lecture</div>
                            <div style="margin:0px 20px"><input type="radio" name="purpose" value="Lab">Lab</div>
                            <div style="margin:0px 20px"><input type="radio" name="purpose" value="Examination">Examination</div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        </div>
        <div style="display:flex; flex-direction:column; justify-items:center; align-items:center;">
        <div style="display:flex; flex-direction:row; justify-items:center; align-items:center;">
        <div style="margin:15px 20px "><button name="submit">Submit</button></div>
        <div style="margin:15px 20px "><a href="view_booking_report.php"><button type="button"  name="view">View Report</button></a></div>
    </div>
        </form>
        </div>
    </section>
    
	<!--For the logo use prupose-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
<?php 
} else {
    echo "<p>You do not have permission to access this page.<p>";
}
?>
