<?php
include('dataconnection.php');

if(isset($_POST['submit'])){
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $email = $_POST['email'];

    // Check if passwords match
    if($newPassword === $confirmPassword) {
        // Check if the user exists with the provided email
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = $connect->query($sql);
        
        if ($result->num_rows > 0) {
            // Update the user's password in the database
            $sql_update = "UPDATE user SET password = '$newPassword' WHERE email = '$email'";
            if ($connect->query($sql_update) === TRUE) {
                echo "Password updated successfully";
            } else {
                echo "Error updating password: " . $connect->error;
            }
        } else {
            echo "User with the provided email not found";
        }
    } else {
        echo "Passwords do not match";
    }

    $connect->close(); // Close the database connection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
            <input type="password" name="new_password" placeholder="Enter your new password" required>
        </p>
        <p>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" placeholder="Confirm your new password" required>
        </p>
        <button type="submit" name="submit">Reset Password</button>
    </form>
</body>
</html>
