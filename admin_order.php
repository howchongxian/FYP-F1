<?php 
include("dataconnection.php"); 
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Admin - View Orders</title>
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

function confirmation()
{
    answer = confirm("Do you want to delete this order?");
    return answer;
}

</script>
</head>
<?php 
include 'sidebar.php'
?>
<body>
    <div id="container">
        <h1>Orders</h1>
        <div class="product-list">
            <table class="product-table" border="1" width="800px">
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Payment Method</th>
                    <th>Transaction ID</th>
                    <th>Payment Status</th>
                    <th>Actions</th>
                </tr>
                <?php
                $result = mysqli_query($connect, "SELECT * FROM `order`");
                while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row["OrderID"];?></td>
                        <td><?php echo $row["id"];?></td>
                        <td><?php echo $row["payment_method"];?></td>
                        <td><?php echo $row["transactionID"];?></td>
                        <td>
                            <form action="update_payment_status.php" method="post">
                                <input type="hidden" name="order_id" value="<?php echo $row["OrderID"];?>">
                                <select name="payment_status">
                                    <option value="Pending" <?php if($row["payment_status"] == "Pending") echo "selected"; ?>>Pending</option>
                                    <option value="Completed" <?php if($row["payment_status"] == "Completed") echo "selected"; ?>>Completed</option>
                                </select>
                                <button type="submit">Update</button>
                            </form>
                        </td>
                        <td>
                            <a href="admin_delete_order.php?order_id=<?php echo $row["OrderID"];?>" onclick="return confirmation();">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>    
</body>
</html>
