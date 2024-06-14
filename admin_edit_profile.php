<?php
session_start();

// Database connection
include "dataconnection.php";

// Check if user is logged in as admin
if (!isset($_SESSION['admin_userid'])) {
    header("Location: signin.php"); // Redirect to signin page if not logged in
    exit();
}

// Fetch admin information from the database
$admin_userid = $_SESSION['admin_userid'];
$query = "SELECT id, username, email FROM user WHERE id=?";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $admin_userid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $admin = $result->fetch_assoc();
} else {
    // Handle error: Admin not found
    echo "Admin not found";
    $stmt->close();
    $connect->close();
    exit();
}

// Handle form submission for updating admin profile
if (isset($_POST['submit'])) {
    // Retrieve form data
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password']; // Assuming you also allow changing password

    // Validate password length
    function validatePasswordLength($password) {
        return strlen($password) >= 8;
    }

    if ($new_password != "") {
        if (!validatePasswordLength($new_password)) {
            // Redirect to profile page with error message
            header("Location: admin_profile.php?error=Password must be at least 8 characters long");
            exit();
        }
        
        // Hash the new password for security
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update admin's profile in the database with password
        $update_query = "UPDATE user SET username=?, email=?, password=? WHERE id=?";
        $update_stmt = $connect->prepare($update_query);
        $update_stmt->bind_param("sssi", $new_username, $new_email, $hashed_password, $admin_userid);
    } else {
        // Update admin's profile in the database without password
        $update_query = "UPDATE user SET username=?, email=? WHERE id=?";
        $update_stmt = $connect->prepare($update_query);
        $update_stmt->bind_param("ssi", $new_username, $new_email, $admin_userid);
    }

    if ($update_stmt->execute()) {
        // Redirect to profile page with success message
        header("Location: admin_profile.php?msg=Profile updated successfully");
        exit();
    } else {
        // Redirect to profile page with error message
        header("Location: admin_profile.php?error=Failed to update profile");
        exit();
    }
}

// Close database connection
$stmt->close();
$connect->close();
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Edit Admin Profile</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" media="screen" href="css/profile.css">
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

<?php include 'sidebar.php'; ?>

<body>
    <div id="container">
        <h1>Edit Admin Profile</h1>
        <form action="" method="post">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $admin['username']; ?>" required>
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $admin['email']; ?>" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Leave blank to keep current password">
                    <span class="toggle-password">
                        <i class="fa fa-eye"></i>
                    </span>
                </div>
                <p>Password Strength: <span id="passwordStrengthIndicator" class="password-strength"></span></p>
            </div>
            <div class="input-group">
                <button type="submit" name="submit" class="btn">Save Changes</button>
                <a href="admin_profile.php" class="btn cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>
