<?php
include("dataconnection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_code = $_POST["product_code"];
    $quantity = intval($_POST["quantity"]);

    $query = "UPDATE shopping_cart SET quantity = ? WHERE product_code = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("is", $quantity, $product_code);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Quantity updated";
    } else {
        echo "Failed to update quantity";
    }

    $stmt->close();
    $connect->close();
}
?>