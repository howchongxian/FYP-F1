<?php
include('dataconnection.php');

if(isset($_POST['submit'])){
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $username = $_POST['username'];

    // Check if passwords match
    if($newPassword === $confirmPassword) {
        // Check if the user exists with the provided username
        $stmt = $connect->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the user's password in the database
            $stmt_update = $connect->prepare("UPDATE user SET password = ? WHERE username = ?");
            $stmt_update->bind_param("ss", $hashedPassword, $username);
            if ($stmt_update->execute()) {
                echo "<script>
                        alert('Password updated successfully');
                        window.location.href = 'signin.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Error updating password: " . $stmt_update->error . "');
                        window.location.href = 'passwordreset.php';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('User with the provided username not found');
                    window.location.href = 'passwordreset.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Passwords do not match');
                window.location.href = 'passwordreset.php';
              </script>";
    }

    $stmt->close();
    $connect->close(); // Close the database connection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" type="text/css" href="css/forgetpassword.css">
    <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
</head>
<body>
    <h1>Reset Password</h1>
    <form method="post" onsubmit="return validateForm()">
        <p>
            <label for="username">Username:</label>
            <input type="text" name="username" placeholder="Enter your username" required>
        </p>
        <p>
            <label for="new_password">New Password:</label>
            <div class="password-toggle">
                <input type="password" name="new_password" id="new_password" placeholder="Enter your new password" required>
                <span class="icon" onclick="togglePasswordVisibility('new_password')">&#128065;</span>
            </div>
        </p>
        <p>
            <label for="confirm_password">Confirm Password:</label>
            <div class="password-toggle">
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your new password" required>
                <span class="icon" onclick="togglePasswordVisibility('confirm_password')">&#128065;</span>
            </div>
        </p>
        <button type="submit" name="submit">Reset Password</button>
    </form>

    <script>
        function togglePasswordVisibility(inputId) {
            var x = document.getElementById(inputId);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function validateForm() {
            var newPassword = document.getElementById('new_password').value;
            if (newPassword.length < 8) {
                alert('Password must be at least 8 characters long');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
