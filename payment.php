<?php
session_start();
$userid = $_SESSION['userid'];

if(!isset($_SESSION['userid'])) {
  header("Location: signin.php"); // Redirect to login page if not logged in
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  document.querySelectorAll('input[name="payment-method"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        var cardInfoDiv = document.getElementById('credit-card-info');
        if (this.value === 'credit-card') {
            cardInfoDiv.style.display = 'contents';
        } else {
            cardInfoDiv.style.display = 'none';
        }
    });
});
</script>
</head>
<body>

<div id="container">
  <h1>Payment</h1>
  
  <form id="paymentForm" method="post" action="confirm_order.php">
    <label for="name">Your Name:</label>
    <input type="text" id="name" required>

    <label for="phone">Phone Number:</label>
    <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Exp: 012-345-6789" required>

    <label for="address">Address:</label>
    <input type="address" id="address" placeholder="Exp: NoXX, Jalan xxxxx, Taman xxxxxx, 83000 Batu Pahat, Johor">

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
        <div id="credit-card-info" style="display:none;">
          <label for="card-number">Card Number:</label>
          <input type="text" id="card-number" name="card-number" placeholder="1234 5678 9012 3456" pattern="\d{4}\s?\d{4}\s?\d{4}\s?\d{4}" required>
        </div>
      </div>
    </div>

    <button class="py_btn" type="button" onclick="document.getElementById('paymentForm').submit();">Confirm Payment</button>
  </form>

  <!-- END Second Column -->
  <div style="clear:both; height: 40px"></div>
</div>

</body>
</html>