<?php 
include("dataconnection.php"); 

if(isset($_GET['product_code'])) {
    $product_code = $_GET['product_code'];
    $sql = "DELETE FROM product WHERE product_code = '$product_code'";

    if(mysqli_query($connect, $sql)) {
        // 如果成功执行查询，返回上一页
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
    $sql = "DELETE FROM ticket WHERE ticketID = '$ticketID'";

    if(mysqli_query($connect, $sql)) {
        // 如果成功执行查询，返回上一页
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Error: Failed to delete ticket with ticketID: $ticketID.";
    }

} else {
    echo "Error: Ticket ID not provided.";
}

?>