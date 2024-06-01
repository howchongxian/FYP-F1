<?php
include "dataconnection.php";
$id = $_GET["id"];

// Fetch the user details including the role
$sql = "SELECT * FROM `user` WHERE id = ?";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

// Check if the user is not an admin
if ($row['role'] !== 'admin') {
    // Display a message or redirect the user
    header("Location: superadmin.php?msg=Cannot edit user");
    exit();
}

if (isset($_POST["submit"])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Using prepared statements for security
    $sql = "UPDATE `user` SET `username`=?, `email`=?, `password`=? WHERE id = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $username, $email, $hashed_password, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: superadmin.php?msg=Data updated successfully");
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
    <title>Edit User</title>
    <meta charset="utf-8">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
    <!-- Add the following CSS rules here or in the style.css file -->
    <style>
        .container {
            margin-top: 50px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .btn {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div id="container">
        <h1>Edit User Information</h1>
        <div class="product-list">
            <form action="" method="post">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Username:</label>
                        <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($row['username']); ?>">
                    </div>
                    <div class="col">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($row['email']); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-success" name="submit">Update</button>
                        <a href="superadmin.php" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
