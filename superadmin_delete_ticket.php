<?php
include("dataconnection.php");

// Check if the ticket ID is provided in the URL
if(isset($_GET['del']) && isset($_GET['ticket_search'])) {
    // Retrieve the ticket ID from the URL
    $ticketID = $_GET['ticket_search'];
    
    // Delete the ticket from the database
    $query = "DELETE FROM ticket WHERE ticketID = $ticketID";
    $result = mysqli_query($connect, $query);
    
    if($result) {
        // Ticket deleted successfully, redirect to the admin page
        header("Location: admin_manage_product.php");
        exit();
    } else {
        // Error occurred while deleting the ticket
        echo "Error deleting ticket: " . mysqli_error($connect);
    }
} else {
    // Ticket ID not provided in the URL
    echo "Ticket ID not provided";
}
?>
