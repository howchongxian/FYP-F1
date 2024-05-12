<?php 
include("dataconnection.php"); 

// 查询订单记录及订单详情
$query = "SELECT o.OrderID, o.id, o.payment_method, o.transactionID, o.payment_status,
            GROUP_CONCAT(DISTINCT sc.product_code ORDER BY sc.product_code) AS product_codes,
            GROUP_CONCAT(DISTINCT sc.product_name ORDER BY sc.product_name) AS product_names,
            GROUP_CONCAT(DISTINCT sc.quantity ORDER BY sc.product_code) AS quantities,
            GROUP_CONCAT(DISTINCT sc.product_price ORDER BY sc.product_code) AS prices
          FROM `order` o
          JOIN `shopping_cart` sc ON o.id = sc.id
          GROUP BY o.OrderID";
$result = mysqli_query($connect, $query);


// 输出表头
echo "<table>";
echo "<tr><th>Order ID</th>
<th>User ID</th>
<th>Product Code</th>
<th>Product Name</th>
<th>Quantity</th>
<th>Price</th>
<th>Payment Method</th>
<th>Transaction ID</th>
<th>Payment Status</th></tr>";
// 显示订单记录
if (mysqli_num_rows($result) > 0) {

    // 输出订单信息
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["OrderID"] . "</td>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["product_code"] . "</td>";
        echo "<td>" . $row["product_name"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "<td>" . $row["product_price"] . "</td>";
        echo "<td>" . $row["payment_method"] . "</td>";
        echo "<td>" . $row["transactionID"] . "</td>";
        echo "<td>" . $row["payment_status"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} /*else {
    echo "No orders found.";
}*/

// 查询订单记录及订单详情
$query = "SELECT o.OrderID, o.id, o.payment_method, o.transactionID, o.payment_status,
            GROUP_CONCAT(DISTINCT sc2.ticketID ORDER BY sc2.ticketID) AS ticketIDs,
            GROUP_CONCAT(DISTINCT sc2.race ORDER BY sc2.race) AS races,
            GROUP_CONCAT(DISTINCT sc2.quantity ORDER BY sc2.ticketID) AS quantities,
            GROUP_CONCAT(DISTINCT sc2.ticket_price ORDER BY sc2.ticketID) AS prices
          FROM `order` o
          JOIN `shopping_cart2` sc2 ON o.id = sc2.id
          GROUP BY o.OrderID";
$result = mysqli_query($connect, $query);


// 输出表头
echo "<table>";
echo "<tr><th>Order ID</th>
<th>User ID</th>
<th>Ticket ID</th>
<th>Race</th>
<th>Quantity</th>
<th>Price</th>
<th>Payment Method</th>
<th>Transaction ID</th>
<th>Payment Status</th></tr>";
// 显示订单记录
if (mysqli_num_rows($result) > 0) {

    // 输出订单信息
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["OrderID"] . "</td>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["ticketID"] . "</td>";
        echo "<td>" . $row["race"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "<td>" . $row["ticket_price"] . "</td>";
        echo "<td>" . $row["payment_method"] . "</td>";
        echo "<td>" . $row["transactionID"] . "</td>";
        echo "<td>" . $row["payment_status"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

// 释放结果集
mysqli_free_result($result);

// 关闭数据库连接
mysqli_close($connect);