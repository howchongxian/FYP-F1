<?php 
include("dataconnection.php"); 

if(isset($_GET['product_code'])) {
    $product_code = $_GET['product_code'];
    $sql = "DELETE FROM shopping_cart WHERE product_code = '$product_code'";

    if(mysqli_query($connect, $sql)) {
        // back to current page
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Error: Failed to delete product with product_code: $product_code.";
    }

} else {
    echo "Error: Product code not provided.";
}

if(isset($_GET['ticketID'])) {
    $ticketID = $_GET['ticketID'];
    $sql = "DELETE FROM shopping_cart2 WHERE ticketID = '$ticketID'";

    if(mysqli_query($connect, $sql)) {
        // back to current page
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Error: Failed to delete ticket with ticketID: $ticketID.";
    }

} else {
    echo "Error: Ticket ID not provided.";
}

?>