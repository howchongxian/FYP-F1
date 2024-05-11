<?php
include('dataconnection.php');

// Function to validate password length
function validatePasswordLength($password) {
    return strlen($password) >= 8;
}

if(isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    // Validate password length
    if(!validatePasswordLength($password)) {
        echo "<script>alert('Password must be at least 8 characters long. Please try again.');</script>";
    } else {
        $duplicate = mysqli_query($connect,"SELECT * FROM user WHERE username='$username' OR email='$email'");
        if(mysqli_num_rows($duplicate) > 0){
            echo "<script>alert('Username or Email Has Already Registered');</script>";
        }
        else{
            if($password == $confirmpassword){
                $query = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
                mysqli_query($connect, $query);
                echo "<script>alert('Registration Successful');</script>";
                // Redirect to home page after 2 seconds
                echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 1000);</script>";
            }
            else{
                echo "<script>alert('Password Does Not Match!');</script>";
            }
        }
    }
}
?>

<!DOCTYPE HTML>
<head>
<title>Sign up</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" href="css/register.css">
<!-- JS Files -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="js/jquery.tools.min.js"></script>
<script src="js/register.js"></script>
<script>
$(function () {
    $("#prod_nav ul").tabs("#panes > div", {
        effect: 'fade',
        fadeOutSpeed: 400
    });
});
</script>
<script>
$(document).ready(function () {
    $(".pane-list li").click(function () {
        window.location = $(this).find("a").attr("href");
        return false;
    });
});
</script>
</head>
<body>

    <div class="loginbox">
        <img src="images/avatar.png" class="avatar" >
        <h1>Sign Up</h1>
        <form id="loginForm" method="post">
            <p>Username</p>
            <input type="text" name="username" id="username" placeholder="Enter Username" required>
            <p>Email</p>
            <input type="email" name="email" id="email" placeholder="Enter Email" required>
            <p>Password</p>
        <div class="password-container">
            <input type="password" name="password" id="password" placeholder="Enter Password" required>
            <span class="toggle-password" onclick="togglePasswordVisibility('password')">
                <i class="uil uil-eye"></i>
            </span>
        </div>
        <p>Password Strength: <span id="passwordStrengthIndicator" class="password-strength"></span></p>
        <p>Confirm Password</p>
        <div class="password-container">
            <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" required>
            <span class="toggle-password" onclick="togglePasswordVisibility('confirmpassword')">
                <i class="uil uil-eye"></i>
            </span>
        </div>
            <input type="submit" value="Signup" name="submit">
            <div class="signup">
            <span class="text">Have a member?
            <a href="login.php" class="text signin-text">Sign in now</a>
            </span>
            </div>
        </form>
    </div>
</body>
</html>