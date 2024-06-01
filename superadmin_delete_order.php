<?php
include("dataconnection.php");

if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Start a transaction
    mysqli_begin_transaction($connect);

    try {
        // Delete related rows in the order_items table
        $query_items = "DELETE FROM order_items WHERE order_id = ?";
        $stmt_items = mysqli_prepare($connect, $query_items);
        mysqli_stmt_bind_param($stmt_items, 'i', $order_id);

        if (!mysqli_stmt_execute($stmt_items)) {
            throw new Exception("Error deleting related order items: " . mysqli_error($connect));
        }

        mysqli_stmt_close($stmt_items);

        // Delete related rows in the order_tickets table
        $query_tickets = "DELETE FROM order_tickets WHERE order_id = ?";
        $stmt_tickets = mysqli_prepare($connect, $query_tickets);
        mysqli_stmt_bind_param($stmt_tickets, 'i', $order_id);

        if (!mysqli_stmt_execute($stmt_tickets)) {
            throw new Exception("Error deleting related order tickets: " . mysqli_error($connect));
        }

        mysqli_stmt_close($stmt_tickets);

        // Delete the order in the order_detail table
        $query_order = "DELETE FROM order_detail WHERE order_id = ?";
        $stmt_order = mysqli_prepare($connect, $query_order);
        mysqli_stmt_bind_param($stmt_order, 'i', $order_id);

        if (!mysqli_stmt_execute($stmt_order)) {
            throw new Exception("Error deleting order: " . mysqli_error($connect));
        }

        mysqli_stmt_close($stmt_order);

        // Commit the transaction
        mysqli_commit($connect);

        echo "Order deleted successfully.";

    } catch (Exception $e) {
        // Rollback the transaction in case of error
        mysqli_rollback($connect);
        echo $e->getMessage();
    }

    mysqli_close($connect);

    // Redirect back to the admin orders page
    header("Location: superadmin_order_detail.php");
    exit();
} else {
    echo "Invalid request method.";
}
?>
