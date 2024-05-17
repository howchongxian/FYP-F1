<?php include("dataconnection.php"); ?>

<!DOCTYPE HTML>
<html>
<head>
<title>Shop</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/product.css">
<!-- FancyBox -->
<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css" media="all">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/confirmation.js"></script>
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
  <li><a href="schedule_result.php">Schedule & Result</a></li>
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
</ol>
<div id="product_shop">
  <h1>F1 Product Shop</h1>
    <div class="product-list">
      <h2>Wears</h2>
            <table class="product-table" border="1" width="700px" height="100px">
                <tr>
                    <th>Product Code</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Product size</th>
                    <th>Product Description</th>
                    <th>product Price</th>			
                    <th>Action</th>
                </tr>
    
                <?php
                
                $result = mysqli_query($connect, "select * from product");	
                while($row = mysqli_fetch_assoc($result))
                    {
                        
                    ?>			
    
                    <tr>
                        <td><?php echo $row["product_code"];?></td>
                        <td><img src="<?php echo $row["product_img"]; ?>" alt="Product Image"></td>
                        <td><?php echo $row["product_name"];?></td>
                        <td><?php echo $row["category"];?></td>
                        <td><?php echo $row["product_size"];?></td>
                        <td><?php echo $row["description"];?></td>
                        <td><?php echo $row["product_price"];?></td>
                        <td><a class="product-btn" href="add_ShoppingCart.php?product_code=<?php echo $row['product_code']; ?>
                          &product_img=<?php echo $row['product_img']; ?>
                          &product_name=<?php echo $row['product_name']; ?>
                          &product_price=<?php echo $row['product_price']; ?>" onclick="return addCart();">Add to Shopping Cart</a><!--add cart confirm need-->
                        </td>
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