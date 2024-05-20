<?php 
include("dataconnection.php"); 

// 查询订单记录及订单详情（商品和票据）
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

// 输出表头
echo "<table border='1'>";
echo "<tr><th>Order ID</th>
<th>User ID</th>
<th>Name</th>
<th>Address</th>
<th>Phone No.</th>
<th>Products</th>
<th>Tickets</th>
<th>Payment Method</th>
<th>Payment Status</th>
<th>Order Date</th></tr>";

// 显示订单记录
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
        echo "</tr>";
    }
    echo "</table>";
}/* else {
    echo "No orders found.";
}*/

// 释放结果集
mysqli_free_result($result);

// 关闭数据库连接
mysqli_close($connect);
?>
