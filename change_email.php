<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['userid'])) {
    header("Location: signin.php"); // Redirect to login page if not logged in
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

        // Fetch the current email address
        $userid = $_SESSION['userid'];
        $currentEmailQuery = "SELECT email FROM user WHERE id = $userid";
        $currentEmailResult = mysqli_query($connect, $currentEmailQuery);
        
        if ($currentEmailResult && mysqli_num_rows($currentEmailResult) == 1) {
            $currentEmailRow = mysqli_fetch_assoc($currentEmailResult);
            $currentEmail = $currentEmailRow['email'];

            // Check if the new email is the same as the current email
            if ($newEmail == $currentEmail) {
                $error = "The new email address cannot be the same as the old email address.";
            } else {
                // Check if the email is already registered by another user
                $checkQuery = "SELECT id FROM user WHERE email = '$newEmail' AND id != $userid";
                $result = mysqli_query($connect, $checkQuery);

                if (mysqli_num_rows($result) > 0) {
                    $error = "This email address is already registered by another user.";
                } else {
                    // Update the email in the database
                    $updateQuery = "UPDATE user SET email = '$newEmail' WHERE id = $userid";

                    if (mysqli_query($connect, $updateQuery)) {
                        // Set the success message in session and redirect to index.php
                        $_SESSION['success_message'] = "Email address updated successfully";
                        header("Location: index.php");
                        exit();
                    } else {
                        $error = "Error updating email address: " . mysqli_error($connect);
                    }
                }
            }
        } else {
            $error = "Error fetching current email address.";
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
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="new_email">New Email Address:</label><br>
            <input type="email" id="new_email" name="new_email" required><br><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
