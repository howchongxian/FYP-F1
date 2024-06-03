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

// Close database connection
$stmt->close();
$connect->close();
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Admin Profile</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" media="screen" href="css/profile.css">
</head>

<?php include 'sidebar.php'; ?>

<body>
    <div id="container">
        <h1>Admin Profile</h1>
        <div class="profile-info">
            <p><strong>Username:</strong> <?php echo $admin['username']; ?></p>
            <p><strong>Email:</strong> <?php echo $admin['email']; ?></p>
            <a href="admin_edit_profile.php" class="edit-btn">Edit Profile</a>
        </div>
    </div>
</body>

</html>
