<?php
// Include database connection
include("dataconnection.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve order ID and payment status from the form
    $order_id = $_POST['order_id'];
    $payment_status = $_POST['payment_status'];

    // Update the payment status in the database
    $sql = "UPDATE `order` SET `payment_status` = ? WHERE `OrderID` = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "si", $payment_status, $order_id);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect back to the orders page with a success message
        header("Location: admin_orders.php?msg=Payment status updated successfully");
        exit();
    } else {
        // Redirect back to the orders page with an error message if update fails
        header("Location: admin_orders.php?error=Failed to update payment status");
        exit();
    }
} else {
    // If the form is not submitted, redirect back to the orders page
    header("Location: admin_orders.php");
    exit();
}
?>
