<?php 
include("dataconnection.php"); 
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Admin Sales Report</title>
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
        answer = confirm("Do you want to delete this product?");
        return answer;
    }
</script>
</head>

<body>
<?php 
include 'sidebar.php';
?>

<div id="container">
    <h1>Sales Report</h1>
    <div class="product-list">
        <table class="product-table" border="1" width="100%" height="100%">
            <tr>
                <th>Transaction ID</th>
                <th>Order ID</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Transaction Date</th>
                <th>Status</th>
            </tr>
            <?php
            $result = mysqli_query($connect, "SELECT * FROM `transaction`");
            while($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row["transactionID"]; ?></td>
                <td><?php echo $row["OrderID"]; ?></td>
                <td><?php echo $row["amount"]; ?></td>
                <td><?php echo $row["payment_method"]; ?></td>
                <td><?php echo $row["transaction_date"]; ?></td>
                <td><?php echo $row["status"]; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>
</body>
</html>
