<?php
include("dataconnection.php");

if(isset($_GET['del']) && isset($_GET['procode'])) {
    $procode = $_GET['procode'];

    // Perform deletion based on the product code
    $query = "DELETE FROM product WHERE product_code = '$procode'";
    $result = mysqli_query($connect, $query);

    // Check if deletion was successful
    if($result) {
        echo "<script>alert('Product deleted successfully');</script>";
        echo "<script>window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('Failed to delete product');</script>";
        echo "<script>window.location.href='admin.php';</script>";
    }
} else {
    // Redirect to admin page if del or procode parameters are not set
    header("Location: admin.php");
    exit();
}
?>
