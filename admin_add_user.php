<?php include("dataconnection.php");?>

<!DOCTYPE HTML>
<html>
<head>
<title>Add New User</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
<link rel="stylesheet" type="text/css" media="screen" href="./assets/css/product.css">
</head>
<body>
    <div id="container">
        <h1>Add New User</h1>
        <div class="product-list">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
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
                        <td colspan="2"><input type="submit" name="submit" value="Add User"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Using prepared statements for security
        $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: user.php?msg=New record created successfully");
            exit();
        } else {
            echo "Failed: " . mysqli_error($connect);
        }

        mysqli_stmt_close($stmt);
    }
   ?>
</body>
</html>