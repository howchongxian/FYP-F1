<?php
include("dataconnection.php"); 
session_start();
// Check if user is not logged in
if(!isset($_SESSION['userid'])) {
    header("Location: signin.php"); // Redirect to login page if not logged in
    exit();
}
$userid = $_SESSION['userid'];

$conn = new mysqli($sname, $uname, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if product size data is submitted
if (isset($_POST['product_size']) && isset($_POST['quantity'])) {
    $product_sizes = $_POST['product_size'];
    $quantities = $_POST['quantity'];

    // Iterate over the size values entered by the user
    foreach ($product_sizes as $product_code => $size) {
        // Sanitize user input
        $size = $conn->real_escape_string($size);
        $product_code = $conn->real_escape_string($product_code);

        // Build SQL statement
        $sql = "UPDATE shopping_cart SET product_size = '$size' WHERE product_code = '$product_code' AND id = '$userid'";

        // Execute SQL statement
        if ($conn->query($sql) === TRUE) {
            echo "Product size updated successfully for product code: $product_code<br>";
        } else {
            echo "Error updating record: " . $conn->error . "<br>";
        }
    }

    foreach ($quantities as $product_code => $quantity) {
        // Sanitize user input
        $quantity = $conn->real_escape_string($quantity);
        $product_code = $conn->real_escape_string($product_code);

        // Build SQL statement
        $sql = "UPDATE shopping_cart SET quantity = '$quantity' WHERE product_code = '$product_code' AND id = '$userid'";

        // Execute SQL statement
        if ($conn->query($sql) === TRUE) {
            echo "Product quantity updated successfully for product code: $product_code<br>";
        } else {
            echo "Error updating record: " . $conn->error . "<br>";
        }
    }
} 

if (isset($_POST['ticket_quantity'])) {
    $ticket_quantities = $_POST['ticket_quantity'];

    foreach ($ticket_quantities as $ticketID => $quantity) {
        // Sanitize user input
        $quantity = $conn->real_escape_string($quantity);
        $ticketID = $conn->real_escape_string($ticketID);

        // Build SQL statement
        $sql = "UPDATE shopping_cart2 SET quantity = '$quantity' WHERE ticketID = '$ticketID' AND id = '$userid'";

        // Execute SQL statement
        if ($conn->query($sql) === TRUE) {
            echo "Ticket quantity updated successfully for product code: $ticketID<br>";
        } else {
            echo "Error updating record: " . $conn->error . "<br>";
        }
    }
} 

$conn->close();

header("Location: order.php");
exit();
?>