<html>
<head>
	<title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="loginpage.css">
    <link rel="stylesheet" type="text/css" href="navigationBar.css">

	<script>

    <?php
    session_start();
    require('config.php');

    // Fetch all usernames and passwords from the database
    $sql = "SELECT username, password FROM user";
    $result = mysqli_query($conn, $sql);

    // Initialize an associative array to map usernames to passwords
    $userPasswordMap = array();

    // Populate the array with data from the database
    while($row = mysqli_fetch_assoc($result)) {
        $userPasswordMap[$row['username']] = $row['password'];
    }

    mysqli_close($conn);

    echo "var userPasswordMap = " . json_encode($userPasswordMap) . ";";
    ?>    

	function validate(){ 

		var username = document.loginForm.username.value;
        var password = document.loginForm.password.value;

        // Check if the username field is empty
        if (username == "") {
            alert("Please enter your username!");
            document.loginForm.username.focus();
            return false;
        }
        // Check if the password field is empty
        if (password == "") {
            alert("Please enter your password!");
            document.loginForm.password.focus();
            return false;
        }

        // Check if the username exists
        if (!(username in userPasswordMap)) {
            alert("Your username is invalid!");
            document.loginForm.username.focus();
            return false;
        }

        // Check if the password is correct for the given username
        if (userPasswordMap[username] !== password) {
            alert("Your password is incorrect for the given username!");
            document.loginForm.password.focus();
            return false;
        }

	    return (true);
	  }
	</script>
</head>

<body>
    <header class="header"> <!--For the upper side bar-->
    <a href="#" class="logo"><ion-icon name="calendar"></ion-icon>Booking</a>
    <nav class="nav"> 
        <a href = "main_admin.php">Home</a>
        <a href = "user_profile.php">Profile</a>
        <a href = "logout.php">Log Out</a>
    </nav>
	</header>

    <section class="home">
        <div class="content">
            <h2>Reserve. Teach. Achieve.</h2>
            <p>Unleash the potential of your teaching environment. Easily book the perfect classroom for your needs, ensuring a seamless and efficient educational experience. Whether you are organizing a seminar, guest speaker, or teaching a course, booking a room here is fast, easy, and efficient. Step into a space where knowledge and convenience come together to make your teaching journey flourish. Book your room now and pave the way for success!</p>
        </div>

        <div class="wrapper-login">
            <h2>User Login</h2>
            <br>

            <form name="loginForm" method="post" action="check_login.php" onsubmit="return(validate());">
                <!--Username-->
                <div class="input-box">
                    <span class="icon"><ion-icon name="people"></ion-icon></span>
                    <input type="text" name="username">
                    <label>Username</label>
                </div>

                <!--Password-->
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password">
                    <label>Password</label>
                </div>

                <!--Submit-->
                <button type="submit" class="btn" value="login">Login</button>

                <!--Reset-->
                <div class="reset">
                <input type="reset" class="resett" value="Clear Login Form"></input>
                </div>
            </form>
        </div>
    </section>

    <!--For the logo use prupose-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>