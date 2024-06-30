<?php
session_start();
include "dataconnection.php";

if (!isset($_SESSION['superadmin_userid'])) {
    header("Location: signin.php");
    exit();
}

$id = $_GET["id"];
$superadmin_userid = $_SESSION['superadmin_userid'];

// Fetch the user details including the role
$sql = "SELECT * FROM `user` WHERE id = ?";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

// Check if the user is not an admin and not the superadmin itself
if ($row['role'] !== 'admin' && $row['id'] !== $superadmin_userid) {
    // Display a message or redirect the user
    header("Location: superadmin.php?msg=Cannot edit user");
    exit();
}

if (isset($_POST["submit"])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate password length
    function validatePasswordLength($password) {
        return strlen($password) >= 8;
    }

    // Check if the password meets the length requirement
    if (!validatePasswordLength($password)) {
        $error = "Password must be at least 8 characters long.";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check for duplicate username or email
        $check_sql = "SELECT * FROM user WHERE (username=? OR email=?) AND id != ?";
        $stmt = mysqli_prepare($connect, $check_sql);
        mysqli_stmt_bind_param($stmt, "ssi", $username, $email, $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $error = "Username or Email has already been registered.";
        } else {
            // Using prepared statements for security
            $sql = "UPDATE `user` SET `username`=?, `email`=?, `password`=? WHERE id = ?";
            $stmt = mysqli_prepare($connect, $sql);
            mysqli_stmt_bind_param($stmt, "sssi", $username, $email, $hashed_password, $id);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: superadmin.php?msg=Data updated successfully");
                exit();
            } else {
                $error = "Failed: " . mysqli_error($connect);
            }

            mysqli_stmt_close($stmt);
        }
    }
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Edit Admin</title>
    <meta charset="utf-8">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Add the following CSS rules here or in the style.css file -->
    <style>
        .container {
            margin-top: 50px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .btn {
            margin-right: 10px;
        }

        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 10px;
            cursor: pointer;
        }

        .password-strength {
            margin-top: 5px;
        }
    </style>
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
        <h1>Edit Admin Information</h1>
        <div class="product-list">
            <?php if (isset($error)) { ?>
                <p style="color:red;" class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php } ?>
            <form action="" method="post">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Username:</label>
                        <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required>
                    </div>
                    <div class="col">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Password:</label>
                        <div class="password-container">
                            <input type="password" class="form-control" name="password" id="password" required>
                            <span class="toggle-password">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                        <p>Password Strength: <span id="passwordStrengthIndicator" class="password-strength"></span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-success" name="submit">Update</button>
                        <a href="superadmin.php" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
