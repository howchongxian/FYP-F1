<?php include("dataconnection.php"); ?>

<!DOCTYPE HTML>
<head>
<title>Admin</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/product.css">
<!-- FancyBox -->
<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css" media="all">
<script src="js/fancybox/jquery.fancybox-1.2.1.js"></script>
<script type="text/javascript">

function confirmation()
{
	answer = confirm("Do you want to delete this product?");
	return answer;
}

</script>
</head>
<body>
    <div id="container">
        <h1>F1 Product Shop</h1>
          <div class="product-list">
            <h2>Clothes</h2>
                <table class="product-table" border="1" width="700px" height="100px">
                    <tr>
                        <th>Product Code</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product size</th>
                        <th>Product Description</th>
                        <th>product Price</th>			
                        <th colspan="2">Action</th>
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
                        <td><?php echo $row["product_size"];?></td>
                        <td><?php echo $row["description"];?></td>
                        <td>£<?php echo $row["product_price"];?></td>
                        <td><a href="edit_proudct.php?edit&procode=<?php echo $row['product_code']; ?>">Edit</a></td>
                        <td><a href="delete.php?del&procode=<?php echo $row['product_code']; ?>" onclick="return confirmation();">Delete</a></td>
                    </tr>
                    <?php
                    
                    }		
                
                ?>
            
                </table>
            <h2>Tickets</h2>
                <table class="product-table" border="1" width="700px" height="100px">
                    <tr>
                        <th>Ticket ID</th>
                        <th>Race ID</th>
                        <th>Stand</th>
                        <th>Ticket Price</th>
                        <th colspan="2">Action</th>
                    </tr>
                    <?php
                
                    $result = mysqli_query($connect, "select * from ticket");	
                    while($row = mysqli_fetch_assoc($result))
                    {
                        
                    ?>			
    
                    <tr>
                        <td><?php echo $row["ticketID"];?></td>
                        <td><?php echo $row["raceID"];?></td>
                        <td><?php echo $row["stand"];?></td>
                        <td>£<?php echo $row["ticket_price"];?></td>
                        <td><a href="edit_product.php?edit&procode=<?php echo $row['ticketID']; ?>">Edit</a></td>
                        <td><a href="delete.php?del&procode=<?php echo $row['ticketID']; ?>" onclick="return confirmation();">Delete</a></td>
                    </tr>
                    <?php
                    
                    }		
                
                ?>
                </table>
        </div>
    </div>    