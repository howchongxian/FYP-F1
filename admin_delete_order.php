<?php
// Include database connection
include("dataconnection.php");

// Check if order ID is provided and it's a valid number
if (isset($_GET['order_id']) && is_numeric($_GET['order_id'])) {
    // Retrieve order ID from the URL parameter
    $order_id = $_GET['order_id'];

    // Delete the order from the database
    $sql = "DELETE FROM `order` WHERE `OrderID` = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "i", $order_id);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect back to the orders page with a success message
        header("Location: admin_view_orders.php?msg=Order deleted successfully");
        exit();
    } else {
        // Redirect back to the orders page with an error message if deletion fails
        header("Location: admin_view_orders.php?error=Failed to delete order");
        exit();
    }
} else {
    // If order ID is not provided or invalid, redirect back to the orders page
    header("Location: admin_view_orders.php");
    exit();
}
?>
