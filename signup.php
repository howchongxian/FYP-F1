<?php
include('dataconnection.php');
if(isset($_POST["submit"]))
{
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password= $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    
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
            echo "<script>setTimeout(function(){ window.location.href = 'home.php'; }, 1000);</script>";
        }
        else{
            echo "<script>alert('Password Does Not Match!');</script>";
        }
    }
    // After successful login
    if ($login_successful) {
    header("Location: profile.php");
    exit();
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
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/signup.css">
<!-- Contact Form -->
<link href="contact-form/css/style.css" media="screen" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
<!-- JS Files -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="js/jquery.tools.min.js"></script>
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
        <img src="images/avatar.png" class="avatar" style="margin-top:90px">
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
<script>
        
    function togglePasswordVisibility(fieldId) {
    var passwordInput = document.getElementById(fieldId);
    var toggleIcon = passwordInput.nextElementSibling.querySelector("i");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("uil-eye");
        toggleIcon.classList.add("uil-eye-slash");
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("uil-eye-slash");
        toggleIcon.classList.add("uil-eye");
    }
}

        // Create account button click event
        var createBtn = document.querySelector('.input-field.button input[type="button"]');
        createBtn.addEventListener('click', function() {
            // Get form values
            var username = document.querySelector('.input-field input[type="text"][placeholder="Username"]').value;
            var email = document.querySelector('.input-field input[type="text"][placeholder="Email"]').value;
            var password = document.getElementById('createPw').value;
            var confirmPassword = document.getElementById('confirmPw').value;
            var rememberMe = document.getElementById('sigCheck').checked;

            // Validate form data
            if (username.trim() === '') {
                alert('Please enter a username.');
                return;
            }

            if (email.trim() === '') {
                alert('Please enter an email.');
                return;
            }

            if (password.trim() === '') {
                alert('Please enter a password.');
                return;
            }

            if (password !== confirmPassword) {
                alert('Password and confirm password must match.');
                return;
            }

            // Perform further actions (e.g., submit the form)

            // Optional: Remember me functionality
            if (rememberMe) {
                // Implement remember me logic here
            }
        });

        // Redirect to login page
        var loginLink = document.querySelector('.login-signup .signin-text');
        loginLink.addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = "login.html";
        });
    </script>
</html>