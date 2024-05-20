<?php 
include("dataconnection.php"); 
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Admin Orders</title>
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
    return confirm("Do you want to delete this order?");
}
</script>
</head>
<?php 
include 'sidebar.php';
?>
<body>
    <div id="container">
        <h1>F1 Product Shop - Orders</h1>
        <div class="product-list">
            <h2>Orders</h2>
            <table class="product-table" border="1" width="1000px" height="100px">
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone No.</th>
                    <th>Products</th>
                    <th>Tickets</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                    <th>Order Date</th>
                    <th colspan="2">Action</th>
                </tr>
                <?php
                
                $query = "SELECT o.order_id, o.user_id, o.name, o.address, o.phone, o.payment_method, o.payment_status, o.created_at,
                            GROUP_CONCAT(DISTINCT sc.product_code ORDER BY sc.product_code) AS product_codes,
                            GROUP_CONCAT(DISTINCT sc.product_name ORDER BY sc.product_name) AS product_names,
                            GROUP_CONCAT(DISTINCT sc.quantity ORDER BY sc.product_code) AS product_quantities,
                            GROUP_CONCAT(DISTINCT sc.product_price ORDER BY sc.product_code) AS product_prices,
                            GROUP_CONCAT(DISTINCT sc2.ticketID ORDER BY sc2.ticketID) AS ticketIDs,
                            GROUP_CONCAT(DISTINCT sc2.race ORDER BY sc2.race) AS ticket_races,
                            GROUP_CONCAT(DISTINCT sc2.quantity ORDER BY sc2.ticketID) AS ticket_quantities,
                            GROUP_CONCAT(DISTINCT sc2.ticket_price ORDER BY sc2.ticketID) AS ticket_prices
                          FROM `order_detail` o
                          LEFT JOIN `shopping_cart` sc ON o.user_id = sc.id
                          LEFT JOIN `shopping_cart2` sc2 ON o.user_id = sc2.id
                          GROUP BY o.order_id";
                $result = mysqli_query($connect, $query);

                if (!$result) {
                    die("Query failed: " . mysqli_error($connect));
                }

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["order_id"] . "</td>";
                        echo "<td>" . $row["user_id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "<td>" . $row["phone"] . "</td>";

                        // 商品详情
                        $productDetails = [];
                        $productCodes = explode(',', $row['product_codes']);
                        $productNames = explode(',', $row['product_names']);
                        $productQuantities = explode(',', $row['product_quantities']);
                        $productPrices = explode(',', $row['product_prices']);

                        for ($i = 0; $i < count($productCodes); $i++) {
                            $productDetails[] = $productCodes[$i] . " - " . $productNames[$i] . " (" . $productQuantities[$i] . " x $" . $productPrices[$i] . ")";
                        }
                        echo "<td>" . implode('<br>', $productDetails) . "</td>";

                        // 票据详情
                        $ticketDetails = [];
                        $ticketIDs = explode(',', $row['ticketIDs']);
                        $ticketRaces = explode(',', $row['ticket_races']);
                        $ticketQuantities = explode(',', $row['ticket_quantities']);
                        $ticketPrices = explode(',', $row['ticket_prices']);

                        for ($i = 0; $i < count($ticketIDs); $i++) {
                            $ticketDetails[] = $ticketIDs[$i] . " - " . $ticketRaces[$i] . " (" . $ticketQuantities[$i] . " x $" . $ticketPrices[$i] . ")";
                        }
                        echo "<td>" . implode('<br>', $ticketDetails) . "</td>";

                        echo "<td>" . $row["payment_method"] . "</td>";
                        echo "<td>" . $row["payment_status"] . "</td>";
                        echo "<td>" . $row["created_at"] . "</td>";

                        // Action buttons with options above them
                        echo "<td>";
                        echo "<form method='post' action='update_payment_status.php' style='display:inline-block;'>";
                        echo "<input type='hidden' name='order_id' value='" . $row["order_id"] . "'>";
                        echo "<select name='payment_status'>";
                        echo "<option value='Pending'" . ($row["payment_status"] == "Pending" ? " selected" : "") . ">Pending</option>";
                        echo "<option value='Completed'" . ($row["payment_status"] == "Completed" ? " selected" : "") . ">Completed</option>";
                        echo "</select><br>";
                        echo "<button type='submit'>Update</button>";
                        echo "</form>";
                        echo "<form method='post' action='admin_delete_order.php' style='display:inline-block;'>";
                        echo "<input type='hidden' name='order_id' value='" . $row["order_id"] . "'>";
                        echo "<button type='submit' onclick='return confirmation();'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>No orders found.</td></tr>";
                }

                // 释放结果集
                mysqli_free_result($result);

                // 关闭数据库连接
                mysqli_close($connect);
                ?>
            </table>
        </div>
    </div>    
</body>
</html>
