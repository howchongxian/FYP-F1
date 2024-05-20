<?php 
include("dataconnection.php"); 
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Admin - Manage Users</title>
    <meta charset="utf-8">
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/admin_style.css">
    <!-- FancyBox -->
    <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css" media="all">
    <script src="js/fancybox/jquery.fancybox-1.2.1.js"></script>
    <script type="text/javascript">
        function confirmation() {
            return confirm("Do you want to delete this user?");
        }
    </script>
</head>
<?php 
include 'sidebar.php';
?>
<body>
    <div id="container">
        <h1>Admin - Manage Users</h1>
        <div class="user-list">
            <h2>Users</h2>
            <table class="user-table" border="1" width="700px" height="100px">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th colspan="2">Action</th>
                </tr>
                <?php
                $result = mysqli_query($connect, "SELECT * FROM user");
                while($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["username"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["password"]; ?></td>
                    <td><a href="admin_edit_user.php?edit&id=<?php echo $row['id']; ?>">Edit</a></td>
                    <td><a href="admin_delete_user.php?del&id=<?php echo $row['id']; ?>" onclick="return confirmation();">Delete</a></td>
                </tr>
                <?php
                }
                ?>
            </table>
            <div class="edit-buttons">
                <a class="add_btn" href="admin_add_user.php">Add User</a>
            </div>
        </div>
    </div>
</body>
</html>
