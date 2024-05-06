<?php
include("dataconnection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_code = intval($_POST["product_code"]); // make sure product_code is int
    $quantity = intval($_POST["quantity"]); // make sure quantity is int

    $query = "UPDATE shopping_cart SET quantity = ? WHERE product_code = ?";
    $stmt = $connect->prepare($query);

    if ($stmt) {
        $stmt->bind_param("ii", $quantity, $product_code); 
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Quantity updated";
        } else {
            echo "Failed to update quantity";
        }

        $stmt->close();
    } else {
        echo "Failed to prepare statement.";
    }
}
?>