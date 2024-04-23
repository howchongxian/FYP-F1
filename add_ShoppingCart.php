<?php
include("dataconnection.php");

session_start();
$userid = $_SESSION['userid'];

if (isset($_GET['product_code'])) {
    $product_code = $_GET['product_code'];
    $query = "SELECT * FROM product WHERE product_code = '$product_code'";
    $result = mysqli_query($connect, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $price = $row['product_price'];
        $add_query = "INSERT INTO shopping_cart (userid, product_code, price) VALUES ('$userid', '$product_code', '$price')";
        mysqli_query($connect, $add_query);
    }
}

if (isset($_GET['ticketID'])) {
    $ticketID = $_GET['ticketID'];
    $query = "SELECT * FROM ticket WHERE ticketID = '$ticketID'";
    $result = mysqli_query($connect, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $price = $row['ticket_price'];
        $add_query = "INSERT INTO shopping_cart (userid, ticketID, price) VALUES ('$userid', '$ticketID', '$price')";
        mysqli_query($connect, $add_query);
    }
}

header("Location: shopping_cart.php");
exit;
?>
