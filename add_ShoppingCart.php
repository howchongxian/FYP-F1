<?php
include("dataconnection.php");
session_start();

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
    
    if (isset($_GET['product_code']) && isset($_GET['product_name']) && isset($_GET['product_price']) && isset($_GET['product_img'])) {
        $productCode = $_GET['product_code'];
        $productImg = $_GET['product_img'];
        $productName = $_GET['product_name'];
        $productPrice = (float)$_GET['product_price'];

        // Check if the product is already in the shopping cart
        $query = "SELECT * FROM shopping_cart WHERE id = '$userid' AND product_code = '$productCode'";
        $result = mysqli_query($connect, $query);

        if (mysqli_num_rows($result) > 0) {
            // If the product is already in the cart, increase the quantity
            $update = "UPDATE shopping_cart SET quantity = quantity + 1 WHERE id = '$userid' AND product_code = '$productCode'";
            mysqli_query($connect, $update);
        } else {
            // Add product to cart
            $insert = "INSERT INTO shopping_cart (id, product_code, product_img, product_name, quantity, product_price) 
                        VALUES ('$userid', '$productCode', '$productImg', '$productName', 1, $productPrice)";
            mysqli_query($connect, $insert);
        }

        header("Location: product.php"); // Redirect to shopping cart
    } else {
        echo "Missing required parameters.";
    }

    if (isset($_GET['ticketID']) && isset($_GET['race']) && isset($_GET['ticket_price'])) {
        $ticketID = $_GET['ticketID'];
        $race = $_GET['race'];
        $ticketPrice = (float)$_GET['ticket_price'];

        // Check if the product is already in the shopping cart
        $query = "SELECT * FROM shopping_cart2 WHERE id = '$userid' AND ticketID = '$ticketID'";
        $result = mysqli_query($connect, $query);

        if (mysqli_num_rows($result) > 0) {
            // If the product is already in the cart, increase the quantity
            $update = "UPDATE shopping_cart2 SET quantity = quantity + 1 WHERE id = '$userid' AND ticketID = '$ticketID'";
            mysqli_query($connect, $update);
        } else {
            // Add product to cart
            $insert = "INSERT INTO shopping_cart2 (id, ticketID, race, quantity, ticket_price) 
                        VALUES ('$userid', '$ticketID', '$race', 1, $ticketPrice)";
            mysqli_query($connect, $insert);
        }

        header("Location: ticket.php"); 
    } else {
        echo "Missing required parameters.";
    }
} else {
echo "You must be logged in to add items to the shopping cart.";
}
?>