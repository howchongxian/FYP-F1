<?php
include("dataconnection.php");
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Admin Feedback</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" media="screen" href="css/admin_feedback.css">
</head>
<?php include 'admin_sidebar.php'; ?>

<body>
    <div id="container">
        <h1>Feedback</h1>
        <div class="feedback-list">
            <table class="feedback-table" border="1" width="700px" height="100px">
                <tr>
                    <th>Feedback No.</th>
                    <th>Feedback</th>
                </tr>
                <?php
                $result = mysqli_query($connect, "SELECT * FROM feedback");
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $row["feedback_no."]; ?></td>
                        <td><?php echo $row["feedback"]; ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>