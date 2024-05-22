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
    <link rel="stylesheet" type="text/css" media="screen" href="./css/admin_style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/user.css">
    <!-- FancyBox -->
    <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css" media="all">
    <script src="js/fancybox/jquery.fancybox-1.2.1.js"></script>
    <script type="text/javascript">
        function confirmation() {
            return confirm("Do you want to delete this user?");
        }
    </script>
    <style>
        .filter-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }
    </style>
</head>
<?php
include 'sidebar.php';
?>

<body>
    <div id="manage_user">
        <h1>Admin - Manage Users</h1>
        <div class="user-list">
            <h2>Users</h2>
            <div class="filter-container">
                <!-- Search Form -->
                <form method="GET" action="">
                    <input type="text" name="search" placeholder="Search by Username" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
                    <input type="submit" value="Search">
                </form>
            </div>
            <table class="user-table" border="1" width="700px" height="100px">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th colspan="2">Action</th>
                </tr>
                <?php
                $search = isset($_GET['search']) ? $_GET['search'] : '';
                $query = "SELECT * FROM user";
                if (!empty($search)) {
                    $query .= " WHERE username LIKE '%$search%'";
                }
                $result = mysqli_query($connect, $query);
                if (!$result) {
                    die("Query failed: " . mysqli_error($connect));
                }
                while ($row = mysqli_fetch_assoc($result)) {
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