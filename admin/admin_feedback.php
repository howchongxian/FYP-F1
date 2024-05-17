<?php
include("dataconnection.php");

// Query to retrieve all feedback
$result = mysqli_query($connect, "SELECT * FROM feedback");
?>

<!DOCTYPE HTML>
<head>
    <title>Admin Feedback</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="screen" href="./assets/css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" media="screen" href="./assets/css/style.css">
</head>
<?php
include"includes/sidebar.php"
?>
<body>
    <!-- Admin Header -->
    <div id="admin-header">
        <h1>Feedback</h1>
    </div>

    <!-- Feedback List -->
    <div class="feedback-list">
        <table class="feedback-table" border="1" width="700px" height="100px">
            <tr>
                <th>Feedback No.</th>
                <th>Feedback</th>
            </tr>

            <?php
            // Display feedback
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row["feedback_no."];?></td>
                <td><?php echo $row["feedback"]; ?></td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>
</html>
