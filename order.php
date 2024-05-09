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

<!DOCTYPE html>
<html>
<head>
<title>Order</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/order.css">
<!-- FancyBox -->
<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css" media="all">
<script src="js/fancybox/jquery.fancybox-1.2.1.js"></script>
<script src="js/confirm_delete.js"></script>
</head>
<body>
    <div id="container">
        <h1>Order</h1>
          <div class="product-list">
            <h2>Clothes</h2>
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
                    $totalPrice = 0;
                    $query = "SELECT * FROM shopping_cart WHERE id = '$userid'";
                    $result = mysqli_query($connect, $query);
                    while($row = mysqli_fetch_assoc($result))
                    {
                    ?>			
    
                    <tr>
                        <td><?php echo $row["product_code"];?></td>
                        <td><img src="<?php echo $row["product_img"]; ?>" alt="Product Image"></td>
                        <td><?php echo $row["product_name"];?></td>
                        <td><?php echo $row["quantity"]; ?> </td>
                        <td>
                            <?php $rowPrice = $row["product_price"]*$row["quantity"];
                            echo $rowPrice;
                            $totalPrice += $rowPrice;?>
                        </td>
                        <td><a class="del_btn" href="del_ShoppingCart.php?del=1&product_code=<?php echo urlencode($row['product_code']); ?>" 
                        onclick="return confirmation();">Delete</a>
                    </tr>
                        
                    <?php
                    
                    }		
                
                ?>
                </table>
                <h2>Tickets</h2>
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
                        <td><?php echo $row["quantity"]; ?> </td>
                        <td><?php $rowPrice = $row["ticket_price"]*$row["quantity"];
                            echo $rowPrice;
                            $totalPrice += $rowPrice;?>
                        </td>
                        <td><a class="del_btn" href="del_ShoppingCart.php?del=1&ticketID=<?php echo urlencode($row['ticketID']); ?>" 
                        onclick="return confirmation();">Delete</a></td>
                    </tr>
                    <?php
                    
                    }		
                
                ?>
                </table>
                <div class="total">
                    <h2>Total Price: <?php echo $totalPrice;?></h2>
                </div>
            </div>
            <div class="order-buttons">
                <a class="order-btn" href="shopping_cart.php">Cancel</a>
                <a class="order-btn" href="payment.php">Confirm Order</a>
              </div>
            </div>
            <!-- END Second Column -->
        <div style="clear:both; height: 40px"></div>
    </div>
</body>
</html>