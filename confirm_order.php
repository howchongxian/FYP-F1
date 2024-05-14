<?php
include 'dataconnection.php';

// 当用户点击"Confirm Payment"按钮时
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 获取用户输入的信息
    $name = $_POST['name'];
    $address = $_POST['address'];
    $paymentMethod = $_POST['payment-method'];

    // 获取购物车中的产品信息
    $userId = $_SESSION['userid'];
    $cartQuery = "SELECT * FROM shopping_cart WHERE id = '$userId'";
    $cartResult = mysqli_query($connect, $cartQuery);

    // 插入订单记录到order表中
    $paymentStatus = 'Pending'; // 假设初始状态为"Pending"
    $orderQuery = "INSERT INTO `order` (id, payment_method, payment_status) VALUES ('$userId', '$paymentMethod', '$paymentStatus')";
    mysqli_query($connect, $orderQuery);
    $orderId = mysqli_insert_id($connect); // 获取新插入订单的ID

    // 将订单详细信息插入到order_details表中
    while ($row = mysqli_fetch_assoc($cartResult)) {
        $productCode = $row['product_code'];
        $productName = $row['product_name'];
        $quantity = $row['quantity'];
        $price = $row['product_price'];

        $orderDetailsQuery = "INSERT INTO order_details (order_id, product_code, product_name, quantity, price) VALUES ('$orderId', '$productCode', '$productName', '$quantity', '$price')";
        mysqli_query($connect, $orderDetailsQuery);
    }

    // 清空购物车
    $clearCartQuery = "DELETE FROM shopping_cart WHERE id = '$userId'";
    mysqli_query($connect, $clearCartQuery);

    // 重定向到成功页面或执行其他操作
    header('Location: payment.php');
    exit();
}
?>