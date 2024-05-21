<?php include("dataconnection.php"); ?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Add New User</title>
    <meta charset="utf-8">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
</head>

<body>
    <div id="container">
        <h1>Add New User</h1>
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

        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Default role
        $role = 'user';

        // Check for duplicate username or email
        $check_sql = "SELECT * FROM user WHERE username=? OR email=?";
        $stmt = mysqli_prepare($connect, $check_sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Username or Email has already been registered.');</script>";
        } else {
            // Insert new user into the database
            $sql = "INSERT INTO user (username, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($connect, $sql);
            mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashed_password, $role);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: user.php?msg=New record created successfully");
                exit();
            } else {
                echo "Failed: " . mysqli_error($connect);
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_stmt_close($stmt);
    }
    ?>
</body>

</html>