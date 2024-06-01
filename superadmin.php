<?php
session_start();
if (!isset($_SESSION['superadmin_userid'])) {
    header("Location: signin.php");
    exit();
}
include("dataconnection.php");

// Fetch all users
$query = "SELECT * FROM user";
$result = mysqli_query($connect, $query);
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Superadmin Dashboard</title>
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" media="screen" href="./css/admin_style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/user.css">
    <style>
        .filter-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }
    </style>
</head>
<?php
include ('superadmin_sidebar.php')
?>
<body>
    <div id="manage_user">
        <h1>Superadmin Dashboard</h1>
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
                    <th>Role</th>
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
                    $disableEditDelete = $row['role'] == 'superadmin' ? ' disabled' : '';
                ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["role"]; ?></td>
                        <td><a href="superadmin_edit_user.php?edit&id=<?php echo $row['id']; ?>"<?php echo $disableEditDelete; ?>>Edit</a></td>
                        <td><a href="superadmin_delete_user.php?del&id=<?php echo $row['id']; ?>"<?php echo $disableEditDelete; ?> onclick="return confirmation();">Delete</a></td>
                    </tr>
                <?php
                }
                ?>
            </table>
            <div class="edit-buttons">
                <a class="add_btn" href="superadmin_add_user.php">Add User /</a>
                <a class="add_btn" href="superadmin_add_admin.php">Add Admin</a>
            </div>
        </div>
    </div>
</body>
</html>
