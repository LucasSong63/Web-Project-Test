<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Lecturer Main Page</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="navigationBar.css">
		<link rel="stylesheet" type="text/css" href="main_page.css">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">

		<style>
        .container {
            padding-top: 60px; /* Add padding to push content below header */
        }
        .container h1 {
            margin-top: 20px; /* Add margin to separate from the container's edge */
        }
		.header
        {
			background-color : #c4c0b6d7;
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
		<h2>Welcome, Lecturer <?php echo $_SESSION["USER"];?></h2>

		<div class="card_grid">
			<a href="update_user_form.php?id=<?php echo $_SESSION['ID'];?>">
				<div class="cards">
					<img src="editProfile.png" alt="Edit Profile" />
					<div class="card_content">
						<div class="card_contentHeader">
							<h3>Edit Profile</h3>
						</div>
						<p>Edit your profile with the newsest info!</p>
					</div>
				</div>
			</a>

			<a href="booking_form.php">
				<div class="cards">
					<img src="lecturerBooking.png" alt="Booking Form" />
					<div class="card_content">
						<div class="card_contentHeader">
							<h3>Make A Booking</h3>
						</div>
						<p>Book your room now !</p>
					</div>
				</div>
			</a>

			<a href="view_booking_report.php">
				<div class="cards">
					<img src="lecturerViewReport.png" alt="View Booking Report" />
					<div class="card_content">
						<div class="card_contentHeader">
							<h3>View Booking Report</h3>
						</div>
						<p>View your booking report here !</p>
					</div>
				</div>
			</a>
		</div>
	</section>       
	
	<!--For the logo use prupose-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

	</body>
</html>