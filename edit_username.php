<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['userid'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Database connection
include_once('dataconnection.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST['new_username'];

    // Validate username (add more validation if needed)
    if (empty($newUsername)) {
        $error = "Username is required";
    } else {
        // Sanitize the input to prevent SQL injection
        $newUsername = mysqli_real_escape_string($connect, $newUsername);

        // Update the username in the database
        $userid = $_SESSION['userid'];
        $updateQuery = "UPDATE user SET username = '$newUsername' WHERE id = $userid";

        if (mysqli_query($connect, $updateQuery)) {
            $success = "Username updated successfully";
        } else {
            $error = "Error updating username: " . mysqli_error($connect);
        }
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Edit Username</title>
    <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/change_username.css">
</head>
<body>
    <div class="container">
        <h2>Edit Username</h2>
        <?php
        if (isset($error)) {
            echo '<div class="message error">' . $error . '</div>';
        } elseif (isset($success)) {
            echo '<div class="message success">' . $success . '</div>';
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="new_username">New Username:</label><br>
            <input type="text" id="new_username" name="new_username"><br><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
