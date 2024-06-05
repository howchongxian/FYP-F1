<?php
include('dataconnection.php');

if(isset($_POST['submit'])){
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $token = $_POST['token'];

    if($newPassword === $confirmPassword) {
        // Validate the token
        $stmt = $connect->prepare("SELECT email, token_expiry FROM user WHERE reset_token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $email = $row['email'];
            $expiry = $row['token_expiry'];

            // Check if the token is expired
            if (strtotime($expiry) > time()) {
                // Hash the new password
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Update the user's password in the database
                $stmt_update = $connect->prepare("UPDATE user SET password = ?, reset_token = NULL, token_expiry = NULL WHERE email = ?");
                $stmt_update->bind_param("ss", $hashedPassword, $email);
                if ($stmt_update->execute()) {
                    echo "<script>
                            alert('Password updated successfully');
                            window.location.href = 'signin.php';
                          </script>";
                } else {
                    echo "<script>
                            alert('Error updating password: " . $stmt_update->error . "');
                            window.location.href = 'passwordreset.php?token=$token';
                          </script>";
                }
            } else {
                echo "<script>
                        alert('The reset link has expired');
                        window.location.href = 'passwordreset.php';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Invalid token');
                    window.location.href = 'passwordreset.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Passwords do not match');
                window.location.href = 'passwordreset.php?token=$token';
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
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
        <label for="new_password">New Password:</label>
            <div class="password-toggle">
                <input type="password" name="new_password" id="new_password" placeholder="Enter your new password" required>
                <span class="icon" onclick="togglePasswordVisibility('new_password')">&#128065;</span>
            </div>
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
            var confirmPassword = document.getElementById('confirm_password').value;

            if (newPassword.length < 8) {
                alert('Password must be at least 8 characters long');
                return false;
            }

            if (newPassword !== confirmPassword) {
                alert('Passwords do not match');
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
