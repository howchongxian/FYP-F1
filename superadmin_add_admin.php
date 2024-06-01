<?php
session_start();
if (!isset($_SESSION['superadmin_userid'])) {
    header("Location: signin.php");
    exit();
}
include("dataconnection.php");

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert new admin into the database
    $sql = "INSERT INTO user (username, email, password, role) VALUES (?, ?, ?, 'admin')";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed_password);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: superadmin.php?msg=Admin added successfully");
        exit();
    } else {
        echo "Failed: " . mysqli_error($connect);
    }

    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Add Admin</title>
    <meta charset="utf-8">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
</head>
<body>
    <div id="container">
        <h1>Add New Admin</h1>
        <div class="product-list">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <table>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" required></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type="email" name="email" required></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" required></td>
                    </tr>
                    <tr>
                        <td colspan="2"><button type="submit" name="submit">Add Admin</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>
