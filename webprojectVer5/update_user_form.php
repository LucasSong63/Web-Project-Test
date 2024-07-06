<?php
session_start();

$user_ID = $_GET['id'];
$_SESSION["ModifyID"] = $user_ID;

if ($_SESSION["Login"] != "YES") {
    header("Location: loginpage.php");
    exit; // Ensure script stops executing after redirect
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Updating User Data</title>
        <link rel="stylesheet" type="text/css" href="update_user_form.css">
        <link rel="stylesheet" type="text/css" href="navigationBar.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
        .header {background-color: #00000024;}

        .nav a {color: #1e1d1d;}

        .header .logo {color: #1e1d1d;}

        </style>

    <script>
    function validateEmail(email) {
        var aPos = email.indexOf("@");
        var dotPos = email.lastIndexOf(".");
        if (aPos < 1 || dotPos < aPos + 2 || dotPos < 0) {
            return false;
        } else {
            return true;
        }
    }

    function validate() {
        if (document.update.username.value == "") {
            alert("Please set your username for login purpose!");
            document.update.username.focus();
            return false;
        }
        if (document.update.pword.value == "") {
            alert("Please set your password for login purpose!");
            document.update.pword.focus();
            return false;
        }
        if (document.update.fullname.value == "") {
            alert("Please provide your full name!");
            document.update.fullname.focus();
            return false;
        }
        if (document.update.department.value == "") {
            alert("Please provide your department!");
            document.update.department.focus();
            return false;
        }
        if (document.update.email.value == "") {
            alert("Please provide your Email!");
            document.update.email.focus();
            return false;
        } else if (!validateEmail(document.update.email.value)) {
            alert("Please provide a valid format Email address!");
            document.update.email.focus();
            return false;
        }
        if( document.update.contact.value == "" ||
           isNaN( document.update.contact.value ) ||
           document.update.contact.value.length < 10 )
        {
          alert( "Please provide a contact number in the format 01########." );
          document.update.contact.focus() ;
          return false;
        }
        return true;
    }
    </script>
</head>

<body>
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

    <!--<h1>Update User Data Form</h1> -->

    <?php
    require("config.php");
    
    $sql = "SELECT * FROM user WHERE id='$user_ID'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
    ?>

    <img src="user_profile_image.jpg" id="profileImage"></img>
    <div class="profilePic"></div>
    <div id="infoBlock">
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
    <form action="update_user.php" name="update" method="POST" onsubmit="return validate();">
        <table>
            <tr>
                <td><strong>ID</strong></td>
                <td><input name="ID" disabled type="text" value="<?php echo $rows['ID']; ?>"></td>
            </tr>
            <tr>
                <td><strong>Username<strong></td>
                <td><input name="username" type="text" value="<?php echo $rows['username']; ?>"></td>
            </tr>
            <tr>
                <td><strong>Password</strong></td>
                <td><input name="pword" type="password" value="<?php echo $rows['password']; ?>"></td>
            </tr>
            <tr>
                <td><strong>Full Name</strong></td>
                <td><input name="fullname" type="text" value="<?php echo $rows['name']; ?>"></td>
            </tr>
            <tr>
                <td><strong>Department</strong></td>
                <td><input name="department" type="text" value="<?php echo $rows['department']; ?>"></td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td><input name="email" type="text" value="<?php echo $rows['email']; ?>"></td>
            </tr>
            <tr>
                <td><strong>Contact Number</strong></td>
                <td><input name="contact" type="text" value="<?php echo $rows['contact']; ?>"></td>
            </tr>
        </table>
        <div class="button-container">
            <input name="update" type="submit" value="Update" id="update">
        </div>
    </form>
    </div>

    <!--For the logo use prupose-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>

<?php
mysqli_close($conn);
?>
