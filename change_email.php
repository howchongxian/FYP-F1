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
    $newEmail = $_POST['new_email'];

    // Validate email address
    if (empty($newEmail)) {
        $error = "Email address is required";
    } elseif (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address format";
    } else {
        // Sanitize the input to prevent SQL injection
        $newEmail = mysqli_real_escape_string($connect, $newEmail);

        // Update the email in the database
        $userid = $_SESSION['userid'];
        $updateQuery = "UPDATE user SET email = '$newEmail' WHERE id = $userid";

        if (mysqli_query($connect, $updateQuery)) {
            $success = "Email address updated successfully";
        } else {
            $error = "Error updating email address: " . mysqli_error($connect);
        }
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Change Email</title>
    <link rel="stylesheet" type="text/css" href="css/change_email.css">
    <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
</head>
<body>
    <div class="container">
        <h2>Change Email</h2>
        <?php
        if (isset($error)) {
            echo '<div style="color: red;">' . $error . '</div>';
        } elseif (isset($success)) {
            echo '<div style="color: green;">' . $success . '</div>';
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="new_email">New Email Address:</label><br>
            <input type="email" id="new_email" name="new_email"><br><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>