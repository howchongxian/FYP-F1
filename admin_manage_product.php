<?php 
include("dataconnection.php"); 
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Admin</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="./css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
<link rel="stylesheet" type="text/css" media="screen" href="./css/product.css">
<!-- FancyBox -->
<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css" media="all">
<script src="js/fancybox/jquery.fancybox-1.2.1.js"></script>
<script type="text/javascript">
function confirmation() {
    return confirm("Do you want to delete this product?");
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
include 'admin_sidebar.php'
?>
<body>
    <div id="product_shop">
        <h1>F1 Product Shop</h1>
        <div class="product-list">
            <h2>Wears</h2>
            <div class="filter-container">
                <!-- Search Form -->
                <form method="GET" action="">
                    <input type="text" name="search" placeholder="Search Pro Code or Name" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
                    <input type="submit" value="Search">
                </form>
            </div>
            <table class="product-table" border="1" width="700px" height="100px">
                <tr>
                    <th>Product Code</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Product Size</th>
                    <th>Product Description</th>
                    <th>Product Price</th>            
                    <th colspan="2">Action</th>
                </tr>
                <?php
                $search = isset($_GET['search']) ? $_GET['search'] : '';
                $query = "SELECT * FROM product";
                if (!empty($search)) {
                    $query .= " WHERE product_code LIKE '%$search%' OR product_name LIKE '%$search%' OR category LIKE '%$search%'";
                }
                $result = mysqli_query($connect, $query);
                if (!$result) {
                    die("Query failed: " . mysqli_error($connect));
                }
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row["product_code"]; ?></td>
                    <td><img src="<?php echo 'images/product/'.$row["product_img"]; ?>" alt="Product Image" width="100"></td>
                    <td><?php echo $row["product_name"]; ?></td>
                    <td><?php echo $row["category"];?></td>
                    <td><?php echo $row["product_size"]; ?></td>
                    <td><?php echo $row["description"]; ?></td>
                    <td><?php echo $row["product_price"]; ?></td>
                    <td><a href="admin_edit_product.php?edit&procode=<?php echo $row['product_code']; ?>">Edit</a></td>
                    <td><a href="admin_delete_product.php?del&procode=<?php echo $row['product_code']; ?>" onclick="return confirmation();">Delete</a></td>
                </tr>
                <?php
                }
                ?>
            </table>

            <h2>Tickets</h2>
            <div class="filter-container">
                <!-- Search Form for Tickets -->
                <form method="GET" action="">
                    <input type="text" name="ticket_search" placeholder="Search by Race" value="<?php echo isset($_GET['ticket_search']) ? $_GET['ticket_search'] : '' ?>">
                    <input type="submit" value="Search">
                </form>
            </div>
            <table class="product-table" border="1" width="700px" height="100px">
                <tr>
                    <th>Ticket ID</th>
                    <th>Race</th>
                    <th>Stand</th>
                    <th>Ticket Price</th>
                    <th colspan="2">Action</th>
                </tr>
                <?php
                $ticket_search = isset($_GET['ticket_search']) ? $_GET['ticket_search'] : '';
                $ticket_query = "SELECT * FROM ticket";
                if (!empty($ticket_search)) {
                    $ticket_query .= " WHERE race LIKE '%$ticket_search%'";
                }
                $ticket_result = mysqli_query($connect, $ticket_query);
                if (!$ticket_result) {
                    die("Query failed: " . mysqli_error($connect));
                }
                while ($row = mysqli_fetch_assoc($ticket_result)) {
                ?>
                <tr>
                    <td><?php echo $row["ticketID"]; ?></td>
                    <td><?php echo $row["race"]; ?></td>
                    <td><?php echo $row["stand"]; ?></td>
                    <td><?php echo $row["ticket_price"]; ?></td>
                    <td><a href="admin_edit_ticket.php?edit&procode=<?php echo $row['ticketID']; ?>">Edit</a></td>
                    <td><a href="admin_delete_ticket.php?del&ticket_search=<?php echo $row['ticketID']; ?>" onclick="return confirmation();">Delete</a></td>
                </tr>
                <?php
                }
                ?>
            </table>

            <div class="edit-buttons">
                <!--<a class="edit_btn" href=".php">Cancel</a>-->
                <a class="edit_btn" href="admin_add_product.php">Add Product /</a>
                <a class="edit_btn" href="admin_add_ticket.php">Add Ticket</a>
            </div>
        </div>
    </div>    
</body>
</html>
