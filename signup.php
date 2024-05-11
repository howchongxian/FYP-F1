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
            echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 1000);</script>";
        }
        else{
            echo "<script>alert('Password Does Not Match!');</script>";
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
<link rel="stylesheet" href="css/signup.css">
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
        <p>Password Strength: <span id="password-strength"></span></p>
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
            <a href="signin.php" class="text signin-text">Sign in now</a>
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
        });

        function checkPasswordStrength(password) {
        var strength = 0;
        // Check length
        if (password.length >= 8) {
            strength += 1;
        }
        // Check for lowercase letters
        if (password.match(/[a-z]/)) {
            strength += 1;
        }
        // Check for uppercase letters
        if (password.match(/[A-Z]/)) {
            strength += 1;
        }
        // Check for numbers
        if (password.match(/[0-9]/)) {
            strength += 1;
        }
        // Check for special characters
        if (password.match(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/)) {
            strength += 1;
        }
        return strength;
    }

    // Function to update password strength UI
    function updatePasswordStrength(password) {
        var strength = checkPasswordStrength(password);
        var strengthIndicator = document.getElementById("password-strength");

        // You can customize this based on your UI
        switch (strength) {
            case 0:
                strengthIndicator.innerHTML = "Very Weak";
                break;
            case 1:
                strengthIndicator.innerHTML = "Weak";
                break;
            case 2:
                strengthIndicator.innerHTML = "Medium";
                break;
            case 3:
                strengthIndicator.innerHTML = "Strong";
                break;
            case 4:
                strengthIndicator.innerHTML = "Very Strong";
                break;
            default:
                strengthIndicator.innerHTML = "";
                break;
        }
    }

    // Add an event listener to the password field to call the function when the value changes
    document.getElementById("password").addEventListener("input", function() {
        updatePasswordStrength(this.value);
    });

        // Redirect to login page
        var loginLink = document.querySelector('.login-signup .signin-text');
        loginLink.addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = "login.php";
        });
    </script>
</html>