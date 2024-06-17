<!DOCTYPE HTML>
<head>
<title>Contact Us</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/about_us.css">
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
<div class="help">
  <h2>Formula 1 Website</h2>
  <p>We're here to help and answer any question you might have. We look forward to hearing from you.</p>
</div>
<div class="contact-container">
<div class="form-container">
  <h3>Contact Us</h3>
  <form id="contact-form" class="contactfrm" method="post" action="contact.php">
      <input type="text" id="name-input" name="UName" class="form-control mb-2" placeholder="Your Name" required>
      <input type="email" id="email-input" name="Email" class="form-control mb-2" placeholder="Enter Your Email..." required>
      <input type="tel" id="phone-input" name="tel" class="form-control mb-2" placeholder="Your Phone Number..." required>
      <textarea id="message-input" name="msg" class="form-control mb-2" cols="30" rows="10" placeholder="Write Message Here..."></textarea>
      <input type="submit" value="Send" name="submit" class="send-button"> 
  </form>
</div>
<div class="map">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d510174.9042152937!2d101.62996509631878!3d2.5903716844016755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d1e56b9710cf4b%3A0x66b6b12b75469278!2sMultimedia%20University!5e0!3m2!1sen!2smy!4v1685189601949!5m2!1sen!2smy" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
</div>
</body>
</html>
<?php
include("dataconnection.php");

if(isset($_POST["submit"])) {
    $username = mysqli_real_escape_string($connect, $_POST["UName"]);
    $email = mysqli_real_escape_string($connect, $_POST["Email"]);
    $tel = mysqli_real_escape_string($connect, $_POST["tel"]);
    $Msg = mysqli_real_escape_string($connect, $_POST["msg"]);
    
    $sql = "INSERT INTO contact (contact_name, contact_email, contact_tel, contact_message) VALUES ('$username', '$email', '$tel', '$Msg')";
    
    if(mysqli_query($connect, $sql)) {
        echo "<script type='text/javascript'>alert('Contact saved');</script>";
    } else {
        echo "<script type='text/javascript'>alert('Error: " . mysqli_error($connect) . "');</script>";
    }
}
?>
