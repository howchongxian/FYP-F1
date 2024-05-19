<?php
include("dataconnection.php"); 
session_start();

$userid = $_SESSION['userid'];

// Check if user is not logged in
if (!isset($userid)) {
    header("Location: signin.php"); // Redirect to login page if not logged in
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];
    
    // Generate a unique transaction ID (this is a simple example, you might want a more robust method)
    $transactionID = rand(100000, 999999);

    // Insert into order table
    $order_query = "INSERT INTO `order` (id, payment_method, transactionID, payment_status) VALUES (?, ?, ?, 'Pending')";
    $stmt = $connect->prepare($order_query);
    $stmt->bind_param("isi", $userid, $payment_method, $transactionID);
    $stmt->execute();
    $orderID = $stmt->insert_id; // Get the generated OrderID
    $stmt->close();

    // Retrieve the shopping cart items for the user
    $cart_query = "SELECT * FROM shopping_cart WHERE id = ?";
    $stmt = $connect->prepare($cart_query);
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();

    // Insert each cart item into the order_detail table
    while ($row = $result->fetch_assoc()) {
        $product_code = $row['product_code'];
        $quantity = $row['quantity'];
        $price = $row['product_price'];
        
        $order_detail_query = "INSERT INTO order_detail (OrderID, product_code, quantity, price) VALUES (?, ?, ?, ?)";
        $detail_stmt = $connect->prepare($order_detail_query);
        $detail_stmt->bind_param("iiid", $orderID, $product_code, $quantity, $price);
        $detail_stmt->execute();
        $detail_stmt->close();
    }

    $stmt->close();

    // Optionally, clear the shopping cart after order is placed
    $clear_cart_query = "DELETE FROM shopping_cart WHERE id = ?";
    $stmt = $connect->prepare($clear_cart_query);
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $stmt->close();

    // Redirect to a confirmation page or display a success message
    echo "Order placed successfully. Your transaction ID is: " . $transactionID;
    // header("Location: order_confirmation.php?transactionID=" . $transactionID);
    exit();
}
?>

