<?php
include("dataconnection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $payment_status = $_POST['payment_status'];

    $query = "UPDATE order_detail SET payment_status = ? WHERE order_id = ?";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, 'si', $payment_status, $order_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Payment status updated successfully.";
    } else {
        echo "Error updating payment status: " . mysqli_error($connect);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connect);

    header("Location: admin_order_detail.php");
    exit();
} else {
    echo "Invalid request method.";
}
?>
