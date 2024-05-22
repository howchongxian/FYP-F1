<?php
include('dataconnection.php');

if(isset($_POST['submit'])){
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $email = $_POST['email'];

    // Check if passwords match
    if($newPassword === $confirmPassword) {
        // Check if the user exists with the provided email
        $stmt = $connect->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the user's password in the database
            $stmt_update = $connect->prepare("UPDATE user SET password = ? WHERE email = ?");
            $stmt_update->bind_param("ss", $hashedPassword, $email);
            if ($stmt_update->execute()) {
                echo "Password updated successfully";
            } else {
                echo "Error updating password: " . $stmt_update->error;
            }
        } else {
            echo "User with the provided email not found";
        }
    } else {
        echo "Passwords do not match";
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
    <link rel="stylesheet" type="text/css" href="css/forgot_password.css">
    <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
</head>
<body>
<h1>Reset Password</h1>
    <form method="post">
        <p>
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Enter your email address" required>
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
    </script>
</body>
</html>
