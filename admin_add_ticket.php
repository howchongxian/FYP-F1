<?php 
include("dataconnection.php"); 
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Add Ticket</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/product.css">
</head>
<body>
    <div id="container">
        <h1>F1 Ticket</h1>
        <div class="ticket-list">
            <h2>Add Ticket</h2>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <table>
                    <tr>
                        <td>Ticket ID:</td>
                        <td><input type="text" name="ticketID" required></td>
                    </tr>
                    <tr>
                        <td>Race:</td>
                        <td><input type="text" name="race" required></td>
                    </tr>
                    <tr>
                        <td>Stand:</td>
                        <td><input type="text" name="stand" required></td>
                    </tr>
                    <tr>
                        <td>Ticket Price:</td>
                        <td><input type="number" name="ticket_price" required></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="submit" value="Add Ticket"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $ticketID = $_POST['ticketID'];
        $race = $_POST['race'];
        $stand = $_POST['stand'];
        $ticket_price = $_POST['ticket_price'];

        // Check for duplicate ticket ID
        $query = "SELECT * FROM ticket WHERE ticketID='$ticketID'";
        $result = mysqli_query($connect, $query);
        
        if (mysqli_num_rows($result) == 0) {
            // Insert into ticket table
            $query = "INSERT INTO ticket (ticketID, race, stand, ticket_price) VALUES ('$ticketID', '$race', '$stand', '$ticket_price')";
            if (mysqli_query($connect, $query)) {
                header("Location: admin_manage_product.php");
                exit;
            } else {
                echo "Error: " . mysqli_error($connect);
            }
        } else {
            echo "Error: Duplicate ticket ID.";
        }
    }
   ?>
</body>
</html>
