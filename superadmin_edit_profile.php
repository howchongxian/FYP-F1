<?php
session_start();

// Database connection
include "dataconnection.php";

// Check if user is logged in as superadmin
if (!isset($_SESSION['superadmin_userid'])) {
    header("Location: signin.php"); // Redirect to signin page if not logged in
    exit();
}

// Fetch superadmin information from the database
$superadmin_userid = $_SESSION['superadmin_userid'];
$query = "SELECT id, username, email FROM user WHERE id=?";
$stmt = $connect->prepare($query);
$stmt->bind_param("i", $superadmin_userid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $superadmin = $result->fetch_assoc();
} else {
    // Handle error: Superadmin not found
    echo "Superadmin not found";
    $stmt->close();
    $connect->close();
    exit();
}

// Handle form submission for updating superadmin profile
if (isset($_POST['submit'])) {
    // Retrieve form data
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password']; // Assuming you also allow changing password

    // Hash the new password for security
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update superadmin's profile in the database
    $update_query = "UPDATE user SET username=?, email=?, password=? WHERE id=?";
    $update_stmt = $connect->prepare($update_query);
    $update_stmt->bind_param("sssi", $new_username, $new_email, $hashed_password, $superadmin_userid);
    
    if ($update_stmt->execute()) {
        // Redirect to profile page with success message
        header("Location: superadmin_profile.php?msg=Profile updated successfully");
        exit();
    } else {
        // Redirect to profile page with error message
        header("Location: superadmin_profile.php?error=Failed to update profile");
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
    <title>Edit Superadmin Profile</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" media="screen" href="css/profile.css">
</head>

<?php include 'superadmin_sidebar.php'; ?>

<body>
    <div id="container">
        <h1>Edit Superadmin Profile</h1>
        <form action="" method="post">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $superadmin['username']; ?>" required>
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $superadmin['email']; ?>" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Leave blank to keep current password">
            </div>
            <div class="input-group">
                <button type="submit" name="submit" class="btn">Save Changes</button>
                <a href="superadmin_profile.php" class="btn cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>
