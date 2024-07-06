<?php

session_start();


if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
header("Location: loginpage.php");

if($_SESSION["LEVEL"] == 1) {
?>

<html>
    <head>
        <title>View Users Data</title>
		<link rel="stylesheet" type="text/css" href="navigationBar.css">
        <link rel="stylesheet" type="text/css" href="view_users.css">

        <script>
 
        function validate()
        {
           if( document.add.username.value == "" )
           {
             alert( "Please enter a username!" );
             document.add.username.focus() ;
             return false;
           }
           if( document.add.pword.value == "" || document.add.pword.value.length < 6 || document.add.pword.value.length > 10)
           {
             alert( "Please enter a password between 6 to 10 characters!" );
             document.add.pword.focus() ;
             return false;
           }
           if( document.add.level.value == "" || isNaN(document.add.level.value) || document.add.level.value.length != 1
           || (document.add.level.value != 1 && document.add.level.value != 2 && document.add.level.value != 3))
           {
             alert( "Please enter an integer (1 / 2 / 3) indicating user level!" );
             document.add.level.focus() ;
             return false;
           }
           return( true );
        }

        function toggleForm() {
            var form = document.getElementById("addUserForm");
            if (form.classList.contains("hidden")) {
                form.classList.remove("hidden");
            } else {
                form.classList.add("hidden");
            }
        }
        
        window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        if (status === 'success') {
            alert('Record updated successfully!');
        } else if (status === 'error') {
            alert('Error updating record!');
        } else if (status === 'deletesuccess') {
            alert('Record deleted successfully!');
        } else if (status === 'deleteerror') {
            alert('Error deleting record!');
        }
    }
        </script>

		<style>
        /* Override background color for the navigation menu */
		.container {
    	padding-top: 40px; /* Add padding to push content below header */
		}

		.container h2 {
    	margin-top: 20px; /* Add margin to separate from the container's edge */
		}

        /* Hidden class to toggle form visibility */
        .hidden {
            display: none;
        }
        
        .button {
            display: inline-block;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 15px;
            box-shadow: 0 9px #999;
        }
        .button:hover {
            background-color: #3e8e41;
        }
        .button:active {
            background-color: #3e8e41;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
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

    <div class="container">
    <h1>View Users Details</h1>

    <?php 
    require("config.php");

    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn, $sql);
    
    ?>
    <button class="add_user" onclick="toggleForm()">Add User</button>

    <div id="addUserForm" class="hidden">
        <form name="add" method="POST" action="add_user.php" onsubmit="return(validate());">
        <table border="0">
            <tr>
                <td>Username</td>
                <td><INPUT type="text" name="username" size="50"></td>
            </tr>
            <tr>
	        	<td>Password</td>
	        	<td><INPUT type="password" name="pword" size="50"></td>
	        </tr>
	        <tr>
                <td>Level</td>
                <td><INPUT type="text" name="level" size="5"></td>
            </tr>
	        <tr>
	        	<td></td><td align="left"><br/><input type="submit" name="button1" value="Submit"></td>
	        </tr>
        </table>
        </form>
    </div>

    <div class="table-responsive">
    <div class="viewUserTable">
    <?php if(mysqli_num_rows($result) > 0) {  ?>
        <table>

        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Level</th>
            <th>Name</th>
            <th>Department</th>
            <th>Email</th>
            <th>Contact</th>
            <th colspan="2">Action</th>
        </tr>

        <?php
            while($rows = mysqli_fetch_assoc($result)) {
                ?>
            <tr>
                <td><?php echo $rows['ID'];?></td>
                <td><?php echo $rows['username'];?></td>
                <td><?php echo $rows['password'];?></td>
                <td><?php echo $rows['level'];?></td>
                <td><?php echo $rows['name'];?></td>
                <td><?php echo $rows['department'];?></td>
                <td><?php echo $rows['email'];?></td>
                <td><?php echo $rows['contact'];?></td>
                <?php if($rows['level'] != 1) { ?>
                    <td><a class="button-update" href="update_user_form.php?id=<?php echo $rows['ID'];?>">Update</a></td>
                    <td><a class="button-delete" href="delete_user.php?id=<?php echo $rows['ID'];?>">Delete</a></td>
                    <?php } ?>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
        </div>
    </div>

    <?php mysqli_close($conn); ?>

<?php
} else {
    echo "<p>Wrong User Level! You are not authorized to view this page.</p>";
    if ($_SESSION["LEVEL"] == 2) {
        ?> <a href='main_space_manager.php'><button>Go back to main page</button></a> <?php
    } else if ($_SESSION["LEVEL"] == 3) {
        ?> <a href='main_lecturer.php'><button>Go back to main page</button></a><?php
    }
}
?>

    <!--For the logo use prupose-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
