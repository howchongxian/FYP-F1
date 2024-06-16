<?php
session_start();

if(!isset($_SESSION['userid'])) {
  header("Location: signin.php"); // Redirect to login page if not logged in
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $userid = $_SESSION['userid'];
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $payment_method = $_POST['payment-method'];
  $card_number = isset($_POST['card-number']) ? $_POST['card-number'] : null;
  $payment_status = 'pending'; // Initial payment status

  // Database connection
  $conn = new mysqli($sname, $uname, $password, $db_name);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Prepare and bind
  $stmt = $conn->prepare("INSERT INTO order_detail (user_id, name, address, phone, payment_method, card_number, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("issssss", $userid, $name, $address, $phone, $payment_method, $card_number, $payment_status);

  if ($stmt->execute()) {
      echo "New record created successfully";
      header("Location: order_success.php");
      exit();
  } else {
      echo "Error: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
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
<script src="js/credit-card-validation.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const paymentMethods = document.querySelectorAll('input[name="payment-method"]');
    const creditCardInfo = document.getElementById('credit-card-info');

    paymentMethods.forEach(method => {
        method.addEventListener('change', function () {
            if (this.value === 'credit-card') {
                creditCardInfo.style.display = 'contents';
            } else {
                creditCardInfo.style.display = 'none';
            }
        });
    });
});

    function toggleCardInfo() {
        var cardInfo = document.getElementById('credit-card-info');
        var creditCard = document.getElementById('credit-card');
        if (creditCard.checked) {
            cardInfo.style.display = 'contents';
            document.form1.text1.focus();  // Focus on the credit card input field when visible
        } else {
            cardInfo.style.display = 'none';
        }
    }
</script>
</head>
<body>

<div id="container">
  <h1>Payment</h1>
  
  <form id="paymentForm" method="post" action="confirm_order.php" onsubmit="return validatePayment(event)">
    <label for="name">Your Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="phone">Phone Number:</label>
    <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}[0-9]{4}" placeholder="Exp: 012-3456789" required>

    <label for="address">Address:</label>
    <input type="address" id="address" name="address" placeholder="Exp: NoXX, Jalan xxxxx, Taman xxxxxx, 83000 Batu Pahat, Johor">

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
          <input type="text" id="card-number" name="card-number" placeholder="1234567890123456" pattern="\d{4}\s?\d{4}\s?\d{4}\s?\d{4}">
          <label for="exMonth">Expiry Month:</label>
          <input type="number" id="exMonth" name="exMonth" min="1" max="12" placeholder="MM">
          <label for="exYear">Expiry Year:</label>
          <input type="number" id="exYear" name="exYear" placeholder="YYYY">
        </div>
      </div>
    </div>

    <button class="py_btn" type="button" onclick="validatePayment(event);">Confirm Payment</button>
  </form>

  <!-- END Second Column -->
  <div style="clear:both; height: 40px"></div>
</div>

</body>
</html>