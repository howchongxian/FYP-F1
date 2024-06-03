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

    // Hash the new password for security
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update admin's profile in the database
    $update_query = "UPDATE user SET username=?, email=?, password=? WHERE id=?";
    $update_stmt = $connect->prepare($update_query);
    $update_stmt->bind_param("sssi", $new_username, $new_email, $hashed_password, $admin_userid);
    
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
                <input type="password" id="password" name="password" placeholder="Leave blank to keep current password">
            </div>
            <div class="input-group">
                <button type="submit" name="submit" class="btn">Save Changes</button>
                <a href="admin_profile.php" class="btn cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>

