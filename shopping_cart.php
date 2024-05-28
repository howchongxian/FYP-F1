<?php
include("dataconnection.php"); 
session_start();

// Check if user is not logged in
if(!isset($_SESSION['userid'])) {
  header("Location: signin.php"); // Redirect to login page if not logged in
  exit();
}

$userid = $_SESSION['userid'];
?>

<!DOCTYPE HTML>
<head>
<title>Shopping Cart</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/shopping_cart.css">
<!-- FancyBox -->
<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css" media="all">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/confirmation.js"></script>
<script>
function updateQuantity(productCode, newQuantity) {
  $.ajax({
    url: "update_quantity.php",
    type: "POST",
    data: { product_code: productCode, quantity: newQuantity },
    success: function(response) {
      console.log("Quantity updated:", response);
      document.getElementById(`quantity-${productCode}`).value = newQuantity;
    },
    error: function(xhr, status, error) {
      console.error("Error updating quantity:", status, error);
    }
  });
}

function updateQuantity2(ticketid, newQuantity) {
  $.ajax({
    url: "update_quantity.php",
    type: "POST",
    data: { ticketID: ticketid, quantity: newQuantity },
    success: function(response) {
      console.log("Quantity updated:", response);
      document.getElementById(`quantity-${ticketid}`).value = newQuantity;
    },
    error: function(xhr, status, error) {
      console.error("Error updating quantity:", status, error);
    }
  });
}

document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('input[name^="quantity["]').forEach(input => {
    input.addEventListener('change', (event) => {
      const productCode = event.target.id.split('-')[1]; // get product_code
      let newQuantity = parseInt(event.target.value);
      
      // limit quantity between 1 to 5
      if (newQuantity < 1) newQuantity = 1;
      if (newQuantity > 5) newQuantity = 5;

      updateQuantity(productCode, newQuantity); // update database
    });
  });

  document.querySelectorAll('input[name^="ticket_quantity["]').forEach(input => {
    input.addEventListener('change', (event) => {
      const ticketID = event.target.id.split('-')[1]; // get ticketID
      let newQuantity = parseInt(event.target.value);
      
      // limit quantity between 1 to 5
      if (newQuantity < 1) newQuantity = 1;
      if (newQuantity > 5) newQuantity = 5;

      updateQuantity2(ticketID, newQuantity); // update database
    });
  });
});
</script>
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
  <h1>Shopping Cart</h1>
  <form id="shoppingCartForm" method="post" action="process_cart.php">
    <table class="product-table" border="1" width="700px" height="100px">
      <tr>
        <th>Product Code</th>
        <th>Product Image</th>
        <th>Product Name</th>
        <th>Product Size</th>
        <th>Quantity</th>
        <th>Product Price per 1</th>  
        <th>Action</th>     
      </tr>

      <?php
      $query = "SELECT * FROM shopping_cart WHERE id = '$userid'";
      $result = mysqli_query($connect, $query);
      while($row = mysqli_fetch_assoc($result)) {
      ?>            
      <tr>
        <td><?php echo $row["product_code"];?></td>
        <td><img src="<?php echo $row["product_img"]; ?>" alt="Product Image"></td>
        <td><?php echo $row["product_name"];?></td>
        <td>
          <input type="text" name="product_size[<?php echo $row['product_code']; ?>]" placeholder="Required" required>
        </td>
        <td>
          <div class="qty">
            <input type="number" name="quantity[<?php echo $row['product_code']; ?>]" id="quantity-<?php echo $row['product_code']; ?>" value="<?php echo $row["quantity"]; ?>" min="1" max="5">
          </div>
        </td>
        <td><?php echo $row["product_price"];?></td>
        <td>
          <a class="del_btn" href="del_ShoppingCart.php?del=1&product_code=<?php echo urlencode($row['product_code']); ?>" onclick="return confirmation();">Delete</a>
        </td>
      </tr>
      <?php
      }       
      ?>
    </table>
    <table class="ticket-table" border="1" width="700px" height="100px">
      <tr>
        <th>Ticket ID</th>
        <th>Race</th>
        <th>Quantity</th>
        <th>Ticket Price per 1</th>  
        <th>Action</th>     
      </tr>

      <?php
      $query = "SELECT * FROM shopping_cart2 WHERE id = '$userid'";
      $result = mysqli_query($connect, $query);
      while($row = mysqli_fetch_assoc($result)) {
      ?>            
      <tr>
        <td><?php echo $row["ticketID"];?></td>
        <td><?php echo $row["race"];?></td>
        <td>
          <div class="qty">
            <input type="number" name="ticket_quantity[<?php echo $row['ticketID']; ?>]" id="ticket_quantity-<?php echo $row['ticketID']; ?>" value="<?php echo $row["quantity"]; ?>" min="1" max="5">
          </div>
        </td>
        <td><?php echo $row["ticket_price"];?></td>
        <td>
          <a class="del_btn" href="del_ShoppingCart.php?del=1&ticketID=<?php echo urlencode($row['ticketID']); ?>" onclick="return confirmation();">Delete</a>
        </td>
      </tr>
      <?php
      }       
      ?>
    </table>

    <div class="cart-buttons">
      <a class="sc_btn" href="product.php">Back to Shop</a>
      <a class="sc_btn" href="ticket.php">Back to Ticket</a>
      <button class="sc_btn" type="button" onclick="document.getElementById('shoppingCartForm').submit();">Check Out</button>
    </div>
  </form>
</div>


  <!-- END Second Column -->
  <div style="clear:both; height: 40px"></div>
</div>
</body>
</html>