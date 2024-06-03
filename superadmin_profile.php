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

// Close database connection
$stmt->close();
$connect->close();
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Superadmin Profile</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" media="screen" href="css/profile.css">
</head>

<?php include 'superadmin_sidebar.php'; ?>

<body>
    <div id="container">
        <h1>Superadmin Profile</h1>
        <div class="profile-info">
            <p><strong>Username:</strong> <?php echo $superadmin['username']; ?></p>
            <p><strong>Email:</strong> <?php echo $superadmin['email']; ?></p>
            <a href="superadmin_edit_profile.php" class="edit-btn">Edit Profile</a>
        </div>
    </div>
</body>

</html>
