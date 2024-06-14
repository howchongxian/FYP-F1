<?php 
include("dataconnection.php"); 
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Add New User</title>
    <meta charset="utf-8">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // Password visibility toggler function
        function togglePasswordVisibility(fieldId) {
            var passwordInput = document.getElementById(fieldId);
            var toggleIcon = passwordInput.nextElementSibling.querySelector("i");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }

        // Function to validate password length
        function validatePasswordLength(password) {
            return password.length >= 8;
        }

        // Update password strength indicator
        function updatePasswordStrengthIndicator(password) {
            var strengthIndicator = document.getElementById("passwordStrengthIndicator");
            if (validatePasswordLength(password)) {
                strengthIndicator.textContent = "Strong";
                strengthIndicator.style.color = "green";
            } else if (password.length >= 6) {
                strengthIndicator.textContent = "Medium";
                strengthIndicator.style.color = "orange";
            } else {
                strengthIndicator.textContent = "Weak";
                strengthIndicator.style.color = "red";
            }
        }

        $(document).ready(function() {
            $("#password").keyup(function() {
                var password = $(this).val();
                updatePasswordStrengthIndicator(password);
            });

            // Password visibility toggle
            $(".toggle-password").click(function() {
                var fieldId = $(this).prev("input").attr("id");
                togglePasswordVisibility(fieldId);
            });
        });
    </script>
</head>

<body>
    <div id="container">
        <h1>Add New User</h1>
        <div class="product-list">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <table>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" required></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type="email" name="email" required></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td>
                            <div class="password-container">
                                <input type="password" name="password" id="password" required>
                                <span class="toggle-password">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                            <p>Password Strength: <span id="passwordStrengthIndicator" class="password-strength"></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="submit" value="Add User"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validate password length
        if (strlen($password) < 8) {
            echo "<script>alert('Password must be at least 8 characters long.');</script>";
        } else {
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Default role
            $role = 'user';

            // Check for duplicate username or email
            $check_sql = "SELECT * FROM user WHERE username=? OR email=?";
            $stmt = mysqli_prepare($connect, $check_sql);
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('Username or Email has already been registered.');</script>";
            } else {
                // Insert new user into the database
                $sql = "INSERT INTO user (username, email, password, role) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($connect, $sql);
                mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashed_password, $role);

                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>window.location.href='superadmin.php?msg=New record created successfully';</script>";
                    exit();
                } else {
                    echo "Failed: " . mysqli_error($connect);
                }

                mysqli_stmt_close($stmt);
            }

            mysqli_stmt_close($stmt);
        }
    }
    ?>
</body>

</html>
