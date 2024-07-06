<?php
session_start();

$user_id = $_SESSION["ID"];

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
header("Location: loginpage.php");

?> 

<html>
    <head>
        <title>User Profile</title>
        <link rel="stylesheet" type="text/css" href="userProfile.css">
        <link rel="stylesheet" type="text/css" href="navigationBar.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
        .header {background-color: #00000024;}

        .nav a {color: #1e1d1d;}

        .header .logo {color: #1e1d1d;}

        #infoBlock {height: 80px;}

        .profilePic {top:40px;}

        #nameInBlock {
         margin-top: -30px;
         margin-left: 16px;
         z-index: 99;
        }

        </style>
        
        <script>
              window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');
            if (status === 'success') {
                alert('Record updated successfully!');
            } else if (status === 'error') {
                alert('Error updating record!');
            }
        }
        </script>

    <head>
        
    <body>
        <?php
        require("config.php");
        
        $sql = "SELECT * FROM user WHERE ID='$user_id'";
        $result = mysqli_query($conn, $sql);
        $rows=mysqli_fetch_assoc($result);
        ?>

    <header class="header"> <!--For the upper side bar-->
    <a href="#" class="logo"><ion-icon name="calendar"></ion-icon>Booking</a>
      <nav class="nav"> 
        <?php
        if($_SESSION['LEVEL'] == 1) { 
            echo "<a href = main_admin.php>Home</a>";
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

    <img src="user_profile_image.jpg" id="profileImage"></img>
        <div id="infoBlock">
            <div class="profilePic"></div>
            <br><br>
            <p id="nameInBlock"><strong><?php echo $rows['username'];?></strong></p>
            <div id="detailsInBlock">

                <div id="detailsInfo"><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $rows['email'];?></div>
                <div id="detailsInfo"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $rows['contact'];?></div>
                <div id="detailsInfo"></div>
            </div> 
        </div>
            
    <div id="blockTable">
            <h3 id="title"><strong>My Profile</strong></h3>
            <span id="block"></span>
            <br>

        <table>

        <tr>
            <td><strong>ID</strong></td>
            <td><?php echo $rows['ID'];?></td>
        </tr>

        <tr>
            <td><strong>Username<strong></td>
            <td><?php echo $rows['username'];?></td>
        </tr>

        <tr>
            <td><strong>Password</strong></td>
            <td><?php echo $rows['password'];?></td>
        </tr?>

        <tr>
            <td><strong>Full Name</strong></td>
            <td><?php echo $rows['name'];?></td>
        </tr>

        <tr>
            <td><strong>Department</strong></td>
            <td><?php echo $rows['department'];?></td>
        </tr>

        <tr>
            <td><strong>Email</strong></td>
            <td><?php echo $rows['email'];?></td>
        </tr>

        <tr>
            <td><strong>Contact Number</strong></td>
            <td><?php echo $rows['contact'];?></td>
        </tr>
        </table>

    </div>

    <br><a href="update_user_form.php?id=<?php echo $rows['ID'];?>"><input type="button" value ="Edit" id="edit"></a>
    <?php
    if ($_SESSION['LEVEL'] == 1) { 
        ?>
            <a href="main_admin.php"><input type="button" value="Done" id="menu"></a>
        <?php 
        } if ($_SESSION['LEVEL'] == 2) {
        ?>
            <a href="main_space_manager.php"><input type="button" value="Done" id="menu"></a>
        <?php 
        } if ($_SESSION['LEVEL'] == 3) {
        ?>
            <a href="main_lecturer.php"><input type="button" value="Done" id="menu"></a>
        <?php 
        } ?>

        <!--For the logo use prupose-->
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        </body>
</html>
    
