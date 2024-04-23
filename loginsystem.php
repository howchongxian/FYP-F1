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

    if(mysqli_num_rows($result) == 1) {
        // Username and password match
        $user = mysqli_fetch_assoc($result);
        $_SESSION['userid'] = $user['id']; // Assuming 'id' is the primary key of the 'user' table
        header("Location: index.php"); // Redirect to index.php
        exit(); // Stop further execution
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
?>