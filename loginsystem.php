<?php
session_start();

// Database connection
$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "f1";

$connect = mysqli_connect($sname, $uname, $password, $db_name);

if (!$connect) {
    echo "Connection failed";
    exit(); // Exit if connection fails
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform query to check if username exists
    $query = "SELECT * FROM user WHERE username=?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user['password'])) {
            if ($user['role'] == 'admin') {
                $_SESSION['admin_userid'] = $user['id'];
                header("Location: admin_dashboard.php"); // Redirect admin to admin panel
                exit();
            } elseif ($user['role'] == 'superadmin') {
                $_SESSION['superadmin_userid'] = $user['id'];
                header("Location: superadmin.php"); // Redirect super admin to super admin panel
                exit();
            } else {
                $_SESSION['userid'] = $user['id'];
                header("Location: index.php"); // Redirect regular user to index.php
                exit();
            }
        } else {
            $error = "Invalid username or password";
            header("Location: login.php?error=" . urlencode($error)); // Redirect to login.php with error message
            exit();
        }
    } else {
        $error = "Invalid username or password";
        header("Location: login.php?error=" . urlencode($error)); // Redirect to login.php with error message
        exit();
    }
} else {
    // If user accessed loginsystem.php directly without submitting the form
    header("Location: login.php"); // Redirect to login.php
    exit();
}
