<?php
include("dataconnection.php");
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Admin Contact Us</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" media="screen" href="css/admin_contact.css">
</head>
<?php include 'superadmin_sidebar.php'; ?>

<body>
    <div id="container">
        <h1>Contact Us Messages</h1>
        <div class="contact-list">
            <table class="contact-table" border="1" width="700px" height="100px">
                <tr>
                    <th>Contact Code</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Message</th>
                </tr>
                <?php
                $result = mysqli_query($connect, "SELECT * FROM contact");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td><?php echo $row["contact_code"]; ?></td>
                            <td><?php echo $row["contact_name"]; ?></td>
                            <td><?php echo $row["contact_email"]; ?></td>
                            <td><?php echo $row["contact_tel"]; ?></td>
                            <td><?php echo $row["contact_message"]; ?></td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>No messages found.</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>
