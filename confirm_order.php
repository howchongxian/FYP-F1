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
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment-method'];
    $payment_status = 'Pending'; // Hardcoded as 'Pending' for initial status
    //$card_number = isset($_POST['card-number']) ? $_POST['card-number'] : null;
    $orderDate = date('Y-m-d H:i:s'); // Assuming you want to use the current date and time

    // Validate required fields
    if (empty($name) || empty($phone) || empty($address) || empty($payment_method)) {
        die('Please fill in all required fields.');
    }

    $total_price = 0;

    // Retrieve the shopping cart items for the user
    $cart_query = "SELECT * FROM shopping_cart WHERE id = ?";
    $stmt = $connect->prepare($cart_query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    if ($stmt->error) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $total_price += $row['product_price'] * $row['quantity'];
    }

    $stmt->close();

    $cart2_query = "SELECT * FROM shopping_cart2 WHERE id = ?";
    $stmt = $connect->prepare($cart2_query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    if ($stmt->error) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $total_price += $row['ticket_price'] * $row['quantity'];
    }
    $stmt->close();

    // Insert into order_detail table
    $order_query = "INSERT INTO `order_detail` (user_id, name, address, phone, payment_method, total_price, payment_status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connect->prepare($order_query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }
    $stmt->bind_param("issssdss", $userid, $name, $address, $phone, $payment_method, $total_price, $payment_status, $orderDate);
    $stmt->execute();
    if ($stmt->error) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }
    $orderID = $stmt->insert_id; // Get the generated OrderID
    $stmt->close();

    // Retrieve the shopping cart items for the user
    $cart_query = "SELECT * FROM shopping_cart WHERE id = ?";
    $stmt = $connect->prepare($cart_query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    if ($stmt->error) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }
    $result = $stmt->get_result();

    // Insert each cart item into the order_items table
    $order_detail_query = "INSERT INTO order_items (order_id, product_code, quantity, price) VALUES (?, ?, ?, ?)";
    $detail_stmt = $connect->prepare($order_detail_query);
    if ($detail_stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }
    while ($row = $result->fetch_assoc()) {
        $product_code = $row['product_code'];
        $quantity = $row['quantity'];
        $price = $row['product_price'];
        
        $detail_stmt->bind_param("isid", $orderID, $product_code, $quantity, $price);
        $detail_stmt->execute();
        if ($detail_stmt->error) {
            die('Execute failed: ' . htmlspecialchars($detail_stmt->error));
        }
    }
    $detail_stmt->close();

    // Optionally, clear the shopping cart after order is placed
    $clear_cart_query = "DELETE FROM shopping_cart WHERE id = ?";
    $stmt = $connect->prepare($clear_cart_query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    if ($stmt->error) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }
    $stmt->close();

     // Retrieve the shopping cart2 items for the user (tickets)
    $cart2_query = "SELECT * FROM shopping_cart2 WHERE id = ?";
    $stmt = $connect->prepare($cart2_query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    if ($stmt->error) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }
    $result = $stmt->get_result();

    // Insert each cart2 item into the order_tickets table
    $order_ticket_query = "INSERT INTO order_tickets (order_id, ticketID, race, quantity, price) VALUES (?, ?, ?, ?, ?)";
    $ticket_stmt = $connect->prepare($order_ticket_query);
    if ($ticket_stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }
    while ($row = $result->fetch_assoc()) {
        $ticketID = $row['ticketID'];
        $race = $row['race'];
        $quantity = $row['quantity'];
        $ticket_price = $row['ticket_price'];
        
        $ticket_stmt->bind_param("issid", $orderID, $ticketID, $race, $quantity, $ticket_price);
        $ticket_stmt->execute();
        if ($ticket_stmt->error) {
            die('Execute failed: ' . htmlspecialchars($ticket_stmt->error));
        }
    }
    $ticket_stmt->close();

    // Optionally, clear the shopping cart2 after order is placed
    $clear_cart2_query = "DELETE FROM shopping_cart2 WHERE id = ?";
    $stmt = $connect->prepare($clear_cart2_query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connect->error));
    }
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    if ($stmt->error) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }
    $stmt->close();


    // Redirect to a confirmation page or display a success message
    echo "Order placed successfully.";
    // header("Location: order_confirmation.php?orderID=" . $orderID);
    exit();
}
?>
<!--add ticket
