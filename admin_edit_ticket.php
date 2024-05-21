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
        header("Location: admmin_manage_ticket.php");
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

    header("Location: admin_manage_ticket.php");
    exit;
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Edit Ticket</title>
    <meta charset="utf-8">
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/product.css">
    <!-- Add the following CSS rules here or in the style.css file -->
    <style>
        input[type="text"] {
            border: 1px solid #ccc;
            padding: 5px;
            width: calc(100% - 12px); /* Adjust width to match other inputs */
            box-sizing: border-box;
            margin-top: 5px; /* Add margin to match other inputs */
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-top: 10px; /* Add margin to match other inputs */
        }
    </style>
</head>
<body>
    <div id="container">
        <h1>F1 Ticket</h1>
        <div class="product-list">
            <h2>Edit Ticket</h2>
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
        </div>
    </div>
</body>
</html>
