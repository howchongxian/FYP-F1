<?php
include("dataconnection.php");

if (isset($_POST['export_excel'])) {
    $filename = "sales_report_" . date('Y-m-d') . ".xls"; // Using .xls extension for Excel compatibility

    // Set header content type
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");

    // Fetch data from database
    $query = "SELECT o.order_id, o.user_id, o.payment_method, 
              (SELECT SUM(quantity) FROM order_items WHERE order_id = o.order_id) AS total_product_quantity, 
              (SELECT SUM(quantity) FROM order_tickets WHERE order_id = o.order_id) AS total_ticket_quantity, 
              o.total_price, o.created_at, o.payment_status 
              FROM `order_detail` o
              WHERE o.payment_status = 'completed'";

    $result = mysqli_query($connect, $query);

    // Start Excel HTML table
    echo "<table border='1'>";
    echo "<tr><th>Order ID</th><th>User ID</th><th>Payment Method</th><th>Total Products</th><th>Total Price</th><th>Order Date</th><th>Payment Status</th></tr>";

    // Output data rows
    while ($row = mysqli_fetch_assoc($result)) {
        $total_products = $row['total_product_quantity'] + $row['total_ticket_quantity']; // Calculate total products
        echo "<tr>";
        echo "<td>" . $row["order_id"] . "</td>";
        echo "<td>" . $row["user_id"] . "</td>";
        echo "<td>" . $row["payment_method"] . "</td>";
        echo "<td>" . $total_products . "</td>"; // Output total products
        echo "<td>" . $row["total_price"] . "</td>";
        echo "<td>" . $row["created_at"] . "</td>";
        echo "<td>" . $row["payment_status"] . "</td>";
        echo "</tr>";
    }

    // End Excel HTML table
    echo "</table>";

    mysqli_free_result($result);

    // Calculate and display total sales separately
    $total_sales_query = "SELECT SUM(total_price) AS total_sales FROM `order_detail` WHERE payment_status = 'completed'";
    $total_sales_result = mysqli_query($connect, $total_sales_query);
    $total_sales_row = mysqli_fetch_assoc($total_sales_result);
    $total_sales = $total_sales_row['total_sales'];

    echo "<div><strong>Total Sales:</strong> RM" . number_format($total_sales, 2) . "</div>";

    // Close the mysqli connection
    mysqli_close($connect);

    exit;
} else {
    // Handle invalid access
    header("HTTP/1.1 403 Forbidden");
    exit("Invalid access.");
}
?>
