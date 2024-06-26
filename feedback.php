<?php include("dataconnection.php"); ?>

<!DOCTYPE HTML>
<head>
<title>Feedback</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/feedback.css">
<!-- FancyBox -->
<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css" media="all">
<script src="js/fancybox/jquery.fancybox-1.2.1.js"></script>
</head>
<body>
<!-- Main Menu -->
<ol id="menu">
  <li class="active_menu_item"><a href="index.php" style="color:#FFF">Home</a>
  </li>
  <li><a href="#">Latest</a>
    <ol>
      <li><a href="news.php">News</a></li>
      <li><a href="videos.php">Videos</a></li>
    </ol>
  </li>
  <li><a href="schedule_result.php">Schedule & Result</a>
    <ol>
      <li><a href="constructor.php">Constructor Standings</a></li>
    </ol>
  </li>
  <li><a href="#">Drivers & Teams</a>
    <ol>
      <li><a href="driver.php">Drivers</a></li>
      <li><a href="team.php">Teams</a></li>
    </ol>
  </li>
  <li><a href="#">Shop</a>
    <ol>
      <li><a href="product.php">Products</a></li>
      <li><a href="ticket.php">Tickets</a></li>
      <li><a href="shopping_cart.php">Shopping Cart</a></li>
      <li><a href="order_history.php">Order Records</a></li>
      <li><a href="feedback.php">Feedback</a></li>
    </ol>
  </li>
  <li><a href="#">About Us</a>
  <ol>
    <li><a href="about_us.php">About Us</a></li>
    <li><a href="contact.php">Contact Us</a></li>
  </ol>
  </li>
  <li><a href="#">user</a>
  <ol>
    <li><a href="edit_username.php">Edit Username</a></li>
    <li><a href="change_email.php">Change Email</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ol>
  </li>
</ol>
<div id="container">
  <h1>Feedback</h1>

  <div class="feedback-form">
    <form action="feedback.php" method="post">
        <label for="feedback"><br><br>Your Feedback:</label>
        <textarea id="feedback" name="feedback" required></textarea>

        <input type="submit" value="Submit Feedback">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $feedback = mysqli_real_escape_string($connect, $_POST['feedback']);

        // insert data
        $sql = "INSERT INTO feedback (feedback) VALUES ('$feedback')";
        if ($connect->query($sql) === TRUE) {
            echo "Submitted Feedback";
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    }
    ?>
</div>

    <div class="feedback-list">
            <table class="feedback-table" border="1" width="700px" height="100px">
                <tr>
                    <th>Feedback No.</th>
                    <th>Feedback</th>
                </tr>
    
                <?php
                
                $result = mysqli_query($connect, "SELECT * FROM feedback");	
                while($row = mysqli_fetch_assoc($result)) {
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
  <!-- END Second Column -->
  <div style="clear:both; height: 40px"></div>
</div>
</body>
</html>
