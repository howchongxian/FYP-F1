<?php
include("dataconnection.php"); 
session_start();
$userid = $_SESSION['userid'];

// Check if user is not logged in
if(!isset($_SESSION['userid'])) {
  header("Location: login.php"); // Redirect to login page if not logged in
  exit();
}

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
<script src="js/confirm_delete.js"></script>
<script>
function increment(productCode) {
  const quantitySpan = document.getElementById(`quantity-${productCode}`);
  let currentQuantity = parseInt(quantitySpan.textContent);

  if (currentQuantity < 5) {
    currentQuantity += 1; // Increment the quantity

    updateQuantity(productCode, currentQuantity); // Update database
  }
}

function decrement(productCode) {
  const quantitySpan = document.getElementById(`quantity-${productCode}`);
  let currentQuantity = parseInt(quantitySpan.textContent);

  if (currentQuantity > 1) {
    currentQuantity -= 1; // Decrement the quantity

    updateQuantity(productCode, currentQuantity); // Update database
  }
}

function updateQuantity(productCode, newQuantity) {
  $.ajax({
    url: "update_quantity.php",
    type: "POST",
    data: { product_code: productCode, quantity: newQuantity },
    success: function(response) {
      console.log("Quantity updated:", response);
      document.getElementById(`quantity-${productCode}`).textContent = newQuantity;
    },
    error: function(xhr, status, error) {
      console.error("Error updating quantity:", status, error);
    }
  });
}

function increment2(ticketid) {
  const quantitySpan = document.getElementById(`quantity-${ticketid}`);
  let currentQuantity = parseInt(quantitySpan.textContent);

  if (currentQuantity < 5) {
    currentQuantity += 1; // Increment the quantity

    updateQuantity2(ticketid, currentQuantity); // Update database
  }
}

function decrement2(ticketid) {
  const quantitySpan = document.getElementById(`quantity-${ticketid}`);
  let currentQuantity = parseInt(quantitySpan.textContent);

  if (currentQuantity > 1) {
    currentQuantity -= 1; // Decrement the quantity

    updateQuantity2(ticketid, currentQuantity); // Update database
  }
}

function updateQuantity2(ticketid, newQuantity) {
  $.ajax({
    url: "update_quantity.php",
    type: "POST",
    data: { ticketID: ticketid, quantity: newQuantity },
    success: function(response) {
      console.log("Quantity updated:", response);
      document.getElementById(`quantity-${ticketid}`).textContent = newQuantity;
    },
    error: function(xhr, status, error) {
      console.error("Error updating quantity:", status, error);
    }
  });
}
</script>
</head>
<body>
<!-- Main Menu -->
<ol id="menu">
  <li class="active_menu_item"><a href="index.php" style="color:#FFF">Home</a>
    <!-- sub menu -->
  </li>
  <!-- end sub menu -->
  <li><a href="#">Latest</a>
    <!-- sub menu -->
    <ol>
      <li><a href="news.php">News</a></li>
      <li><a href="videos.php">Videos</a></li>
    </ol>
  </li>
  <!-- end sub menu -->
  <li><a href="#">Schedule & Result</a>
    <!-- sub menu -->
    <ol>
      <li><a href="schedule.php">Schedule</a></li>
      <li><a href="results.php">Results</a></li>
    </ol>
  </li>
  <li><a href="#">Drivers & Teams</a>
    <!-- sub menu -->
    <ol>
      <li><a href="driver.php">Drivers</a></li>
      <li><a href="team.php">Teams</a></li>
    </ol>
  </li>
  <!-- end sub menu -->
  <li><a href="#">Shop</a>
    <!-- sub menu -->
    <ol>
      <li><a href="product.php">Products</a></li>
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
</ol>
<div id="container">
  <h1>Shopping Cart</h1>

  <table class="product-table" border="1" width="700px" height="100px">
                <tr>
                    <th>Product Code</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Product Price</th>	
                    <th>Action</th>		
                </tr>

                <?php
                
                $query = "SELECT * FROM shopping_cart WHERE id = '$userid'";
                $result = mysqli_query($connect, $query);
                while($row = mysqli_fetch_assoc($result))
                    {
                    ?>			
    
                    <tr>
                        <td><?php echo $row["product_code"];?></td>
                        <td><img src="<?php echo $row["product_img"]; ?>" alt="Product Image"></td>
                        <td><?php echo $row["product_name"];?></td>
                        <td>
                          <div class="qty">
                            <button class="min" onclick="decrement('<?php echo $row['product_code']; ?>')">-</button>
                            <span id="quantity-<?php echo $row['product_code']; ?>"><?php echo $row["quantity"]; ?></span>
                            <button class="plus" onclick="increment('<?php echo $row['product_code']; ?>')">+</button>
                          </div>
                        </td>
                        <td><?php echo $row["product_price"]/**$row["quantity"]*/;?></td>
                        <td><a class="del_btn" href="del_ShoppingCart.php?del=1&product_code=<?php echo urlencode($row['product_code']); ?>" 
                        onclick="return confirmation();">Delete</a>
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
                    <th>Ticket Price</th>	
                    <th>Action</th>		
                </tr>

                <?php
                
                $query = "SELECT * FROM shopping_cart2 WHERE id = '$userid'";
                $result = mysqli_query($connect, $query);
                while($row = mysqli_fetch_assoc($result))
                    {
                    ?>			
    
                    <tr>
                        <td><?php echo $row["ticketID"];?></td>
                        <td><?php echo $row["race"];?></td>
                        <td>
                          <div class="qty">
                            <button class="min" onclick="decrement2('<?php echo $row['ticketID']; ?>')">-</button>
                            <span id="quantity-<?php echo $row['ticketID']; ?>"><?php echo $row["quantity"]; ?></span>
                            <button class="plus" onclick="increment2('<?php echo $row['ticketID']; ?>')">+</button>
                          </div>
                        </td>
                        <td><?php echo $row["ticket_price"]/**$row["quantity"]*/;?></td>
                        <td><a class="del_btn" href="del_ShoppingCart.php?del=1&ticketID=<?php echo urlencode($row['ticketID']); ?>" 
                        onclick="return confirmation();">Delete</a></td>
                    </tr>
                    <?php
                    
                    }		
                
                ?>
  </table>

    <div class="cart-buttons">
      <a class="sc_btn" href="product.php">Cancel</a>
      <a class="sc_btn" href="order.php">Check Out</a>
    </div>
</div>

  <!-- END Second Column -->
  <div style="clear:both; height: 40px"></div>
</div>
</body>
</html>