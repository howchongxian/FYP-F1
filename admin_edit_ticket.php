<?php
include("dataconnection.php");

if (isset($_GET['edit']) && isset($_GET['procode'])) {
    $ticketID = $_GET['procode'];
    $stmt = $connect->prepare("SELECT * FROM ticket WHERE ticketID=?");
    $stmt->bind_param("s", $ticketID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: manage_ticket.php");
        exit;
    }
}

if (isset($_POST['update'])) {
    $ticketID = $_POST['ticketID'];
    $race = $_POST['race'];
    $stand = $_POST['stand'];
    $ticket_price = $_POST['ticket_price'];

    $stmt = $connect->prepare("UPDATE ticket SET race=?, stand=?, ticket_price=? WHERE ticketID=?");
    $stmt->bind_param("ssds", $race, $stand, $ticket_price, $ticketID);
    $stmt->execute();

    header("Location: manage_product.php");
    exit;
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Edit Ticket</title>
    <meta charset="utf-8">
    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">

    <!-- Add the following CSS rules here or in the style.css file -->
    <style>
        input[type="text"] {
            border: 1px solid #ccc;
            padding: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>
    <form action="admin_edit_ticket.php?edit&procode=<?php echo $ticketID; ?>" method="post">
        <table>
            <tr>
                <td>Ticket ID:</td>
                <td><input type="text" name="ticketID" value="<?php echo $row['ticketID'];?>" readonly></td>
            </tr>
            <tr>
                <td>Race ID:</td>
                <td><input type="text" name="race" value="<?php echo $row['race'];?>"></td>
            </tr>
            <tr>
                <td>Stand:</td>
                <td><input type="text" name="stand" value="<?php echo $row['stand'];?>"></td>
            </tr>
            <tr>
                <td>Ticket Price:</td>
                <td><input type="text" name="ticket_price" value="<?php echo $row['ticket_price'];?>"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="update" value="Update Ticket"></td>
            </tr>
        </table>
    </form>
</body>
</html>
