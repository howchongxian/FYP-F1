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
<script src="js/fancybox/jquery.fancybox-1.2.1.js"></script>
<script src="js/confirm_delete.js"></script>
<!--<script>
  document.querySelectorAll('.plus').forEach(function(btn) {
    btn.addEventListener('click', function() {
        console.log("Plus button clicked!"); 
    });
  });

  document.querySelectorAll('.min').forEach(function(btn) {
    btn.addEventListener('click', function() {
        console.log("Minus button clicked!"); 
    });
  });

  function increment(btn) {
    const productId = btn.getAttribute("data-product-id");
    const quantityElement = btn.nextElementSibling;
    let quantity = parseInt(quantityElement.textContent);

    quantity += 1; // increase qty

    updateQuantity(productId, quantity); // use Ajax update server data
}

function decrement(btn) {
    const productId = btn.getAttribute("data-product-id");
    const quantityElement = btn.previousElementSibling;
    let quantity = parseInt(quantityElement.textContent);

    if (quantity > 1) { // quantity no lower than 1
        quantity -= 1; // decrease qty

        updateQuantity(productId, quantity); // use Ajax update server data
    }
}

function updateQuantity(productId, quantity) {
    $.ajax({
        url: "update_quantity.php",
        type: "POST",
        data: {
            product_code: productId,
            quantity: quantity
        },
        success: function(response) {
            console.log("Quantity updated:", response);
        },
        error: function(xhr, status, error) {
            console.error("Error updating quantity:", status, error);
        }
    });
}
</script>-->
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
                            <a class="min" onclick="decrement(this)" ><</a>
                            <span class="quantity"><?php echo $row["quantity"]; ?></span>
                            <a class="plus" href="add_ShoppingCart.php?product_code=<?php echo $row['product_code']; ?>
                              &product_img=<?php echo $row['product_img']; ?>
                              &product_name=<?php echo $row['product_name']; ?>
                              &product_price=<?php echo $row['product_price']; ?>">></a>
                          </div>
                        </td>
                        <td><?php echo $row["product_price"]*$row["quantity"];?></td>
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
                          <div class="qty" >
                            <a class="min" data-product-id="<?php echo $row['ticketID']; ?>" onclick="/*decrement(this)*/"><</a>
                            <span class="quantity"><?php echo $row["quantity"]; ?></span>
                            <a class="plus" href="add_ShoppingCart.php?ticketID=<?php echo $row['ticketID']; ?>
                              &race=<?php echo $row['race']; ?>
                              &ticket_price=<?php echo $row['ticket_price']; ?>">></a>
                          </div>
                        </td>
                        <td><?php echo $row["ticket_price"]*$row["quantity"];?></td>
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