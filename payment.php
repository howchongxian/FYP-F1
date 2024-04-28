<?php
session_start();
$userid = $_SESSION['userid'];

if(!isset($_SESSION['userid'])) {
  header("Location: login.php"); // Redirect to login page if not logged in
  exit();
}
?>

<!DOCTYPE HTML>
<head>
<title>Payment</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
<link rel="stylesheet" type="text/css" media="screen" href="css\payment.css">
<!-- FancyBox -->
<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css" media="all">
<script src="js/fancybox/jquery.fancybox-1.2.1.js"></script>
</head>
<body>

<div id="container">
  <h1>Payment</h1>
  
  <form>
    <label for="name">Your Name:</label>
    <input type="text" id="name" required>

    <label for="address">Address:</label>
    <input type="address" id="address" required>

    <label for="payment-method"><br>Payment Method:</label>
    <div class="payment-methods">
      <div class="payment-method">
        <input type="radio" name="payment-method" id="paypal" value="paypal" required>
        <img src="images/payment/paypal.png" alt="PayPal">
        <label for="paypal">PayPal</label>
      </div>
      <div class="payment-method">
        <input type="radio" name="payment-method" id="Touch'n Go" value="Touch'n Go" required>
        <img src="images/payment/tng.jpg" alt="Touch'n Go">
        <label for="paypal">Touch'n Go</label>
      </div>
      <div class="payment-method">
        <input type="radio" name="payment-method" id="credit-card" value="credit-card" required>
        <img src="images/payment/CreditCard.jpg" alt="Credit Card">
        <label for="credit-card">Credit Card/Debit Card</label>
      </div>
    </div>

    <input type="submit" value="Confirm Payment">
  </form>

  <!-- END Second Column -->
  <div style="clear:both; height: 40px"></div>
</div>

</body>
</html>