<?php 
include("dataconnection.php");

if(isset($_GET['product_code'])) {
    
    $product_code = $_GET['product_code'];
    $sql = "DELETE FROM products WHERE product_code = '$product_code'";
    
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
} else {
    echo "Error: Product code not provided.";
}

if(isset($_GET['ticketID'])) {
    
    $ticketID = $_GET['ticketID'];
    $sql = "DELETE FROM products WHERE product_code = '$ticketID'";
    
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
} else {
    echo "Error: Ticket ID not provided.";
}
?>