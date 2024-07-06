<?php
session_start();
?>

<html>
	<head>
		<title>Admin Main Page</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="navigationBar.css">
		<link rel="stylesheet" type="text/css" href="main_page.css">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">

		<style>
        /* Override background color for the navigation menu */
        .header {
            background-color : #c4c0b6d7;
        }

		.container {
    	padding-top: 60px; /* Add padding to push content below header */
		}

		.container h2 {
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
		<h2>Welcome, Admin <?php echo $_SESSION["USER"];?></h2>
		<div class="card_grid">

			<a href="update_user_form.php?id=<?php echo $_SESSION['ID'];?>">
				<div class="cards">
					<img src="add.png" alt="Edit Profile" />
					<div class="card_content">
						<div class="card_contentHeader">
							<h3>Edit Profile</h3>
						</div>
						<p>Edit your profile with the newsest info!</p>
					</div>
				</div>
			</a>


			<a href="view_users.php">
				<div class="cards">
					<img src="viewUsers.png" alt="View Users" />
					<div class="card_content">
						<div class="card_contentHeader">
							<h3>View User</h3>
						</div>
						<p>View all users at here !</p>
					</div>
				</div>
			</a>

			<a href="view_pending_booking.php">
				<div class="cards">
					<img src="booking.png" alt="View Pending Booking" />
					<div class="card_content">
						<div class="card_contentHeader">
							<h3>View and Manage Bookings</h3>
						</div>
						<p>Let's view & manage the bookings !</p>
					</div>
				</div>
			</a>

			<a href="view_booking_report.php">
				<div class="cards">
					<img src="report.png" alt="View Booking Report" />
					<div class="card_content">
						<div class="card_contentHeader">
							<h3>View all bookings</h3>
						</div>
						<p>Click here to view all bookings !</p>
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