<?php
include("dataconnection.php");

if (isset($_GET['procode'])) {
    $product_code = $_GET['procode'];
    // Determine if it's a product
    $is_product = mysqli_query($connect, "SELECT * FROM product WHERE product_code = '$product_code'");

    if (mysqli_num_rows($is_product) > 0) {
        $sql = "DELETE FROM product WHERE product_code = '$product_code'";
        if (mysqli_query($connect, $sql)) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo "Error: Failed to delete product with product_code: $product_code.";
        }
    } else {
        echo "Error: No matching product found.";
    }
} else {
    echo "Error: Product code not provided.";
}
?>
