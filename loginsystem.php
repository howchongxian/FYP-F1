<?php
session_start();

// Database connection
$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "f1";

$connect = mysqli_connect($sname,$uname,$password,$db_name);

if(!$connect) {
    echo "Connection failed";
    exit(); // Exit if connection fails
}

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform query to check if username and password match
    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($connect, $query);

    if($result && mysqli_num_rows($result) == 1) {
        // Username and password match
        $user = mysqli_fetch_assoc($result);
        if ($user) {
            if ($user['role'] == 'admin') {
                $_SESSION['admin_userid'] = $user['id'];
                header("Location: admin.php"); // Redirect admin to admin panel
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
        }
    } else {
        // Username and password do not match
        $error = "Invalid username or password";
        header("Location: login.php?error=" . urlencode($error)); // Redirect to login.php with error message
        exit();
    }
} else {
    // If user accessed loginsystem.php directly without submitting the form
    header("Location: login.php"); // Redirect to login.php
    exit();
}
