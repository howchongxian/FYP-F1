<?php
session_start();

// Database connection
$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "f1";

$connect = mysqli_connect($sname, $uname, $password, $db_name);

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform query to check if username exists
    $query = "SELECT * FROM user WHERE username=?";
    $stmt = $connect->prepare($query);
    if (!$stmt) {
        die("Prepare failed: " . $connect->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user['password'])) {
            if ($user['role'] == 'admin') {
                $_SESSION['admin_userid'] = $user['id'];
                header("Location: admin_dashboard.php");
                exit();
            } elseif ($user['role'] == 'superadmin') {
                $_SESSION['superadmin_userid'] = $user['id'];
                header("Location: superadmin_dashboard.php");
                exit();
            } else {
                $_SESSION['userid'] = $user['id'];
                header("Location: index.php");
                exit();
            }
        } else {
            $error = "Incorrect password";
            echo "<script>alert('Incorrect password'); window.location.href='signin.php';</script>";
            exit();
        }
    } else {
        $error = "Invalid username or password";
        echo "<script>alert('Invalid username or password'); window.location.href='signin.php';</script>";
        exit();
    }
} else {
    // If user accessed loginsystem.php directly without submitting the form
    header("Location: signin.php");
    exit();
}
?>