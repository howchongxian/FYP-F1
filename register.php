<?php
include('dataconnection.php');

// Function to validate password length
function validatePasswordLength($password) {
    return strlen($password) >= 8;
}

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    // Validate password length
    if (!validatePasswordLength($password)) {
        $error = "Password must be at least 8 characters long.";
    } else {
        // Check for duplicate username or email
        $stmt = $connect->prepare("SELECT * FROM user WHERE username=? OR email=?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Username or Email has already been registered.";
        } else {
            // Check if passwords match
            if ($password === $confirmpassword) {
                // Hash the password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                // Insert new user into database with role 'user'
                $stmt = $connect->prepare("INSERT INTO user (username, email, password, role) VALUES (?, ?, ?, 'user')");
                $stmt->bind_param("sss", $username, $email, $hashedPassword);
                if ($stmt->execute()) {
                    header("Location: index.php?success=Registration successful");
                    exit();
                } else {
                    $error = "Registration failed. Please try again.";
                }
            } else {
                $error = "Passwords do not match.";
            }
        }
    }
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/signup.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
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
        <img src="images/avatar.png" class="avatar" alt="User Avatar">
        <h1>Sign Up</h1>
        <?php if (isset($error)) { ?>
            <p style="color:red;" class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php } ?>
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
                <span class="text">Already a member?
                <a href="signin.php" class="text signin-text">Sign in now</a>
                </span>
            </div>
        </form>
    </div>

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

        // Password strength indicator (simple example)
        document.getElementById('password').addEventListener('input', function () {
            var strengthIndicator = document.getElementById('passwordStrengthIndicator');
            var password = this.value;
            if (password.length >= 8) {
                strengthIndicator.textContent = 'Strong';
                strengthIndicator.style.color = 'green';
            } else {
                strengthIndicator.textContent = 'Weak';
                strengthIndicator.style.color = 'red';
            }
        });
    </script>
</body>
</html>
