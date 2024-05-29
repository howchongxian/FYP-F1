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
<title>Order History</title>
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
    <div id="container">
        <h1>Order Records</h1>
          <div class="product-list">
                <table class="product-table" border="1" width="700px" height="100px">
                    <tr>
                        <th>Order ID</th>
                        <th>Products</th>
                        <th>Tickets</th>
                        <th>Total Price</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                        <th>Order Date</th>
                    <!--<th>Action</th>-->
                    </tr>
                    <?php
                     $query = "SELECT o.order_id, o.payment_method, o.payment_status, o.created_at, o.total_price,
                     GROUP_CONCAT(DISTINCT oi.product_code ORDER BY oi.product_code) AS product_codes,
                     GROUP_CONCAT(DISTINCT p.product_name ORDER BY oi.product_code) AS product_names,
                     GROUP_CONCAT(DISTINCT oi.quantity ORDER BY oi.product_code) AS product_quantities,
                     GROUP_CONCAT(DISTINCT oi.price ORDER BY oi.product_code) AS product_prices,
                     GROUP_CONCAT(DISTINCT ot.ticketID ORDER BY ot.ticketID) AS ticketIDs,
                     GROUP_CONCAT(DISTINCT t.race ORDER BY ot.ticketID) AS ticket_races,
                     GROUP_CONCAT(DISTINCT ot.quantity ORDER BY ot.ticketID) AS ticket_quantities,
                     GROUP_CONCAT(DISTINCT ot.price ORDER BY ot.ticketID) AS ticket_prices
                     FROM `order_detail` o
                     LEFT JOIN `order_items` oi ON o.order_id = oi.order_id
                     LEFT JOIN `product` p ON oi.product_code = p.product_code
                     LEFT JOIN `order_tickets` ot ON o.order_id = ot.order_id
                     LEFT JOIN `ticket` t ON ot.ticketID = t.ticketID
                     WHERE o.user_id = '$userid'";

                    if (!empty($start_date)) {
                        $query .= " AND o.created_at >= '$start_date'";
                    }
                    if (!empty($end_date)) {
                        $query .= " AND o.created_at <= '$end_date'";
                    }
                    if (!empty($search_payment)) {
                        $query .= " AND (o.payment_method LIKE '%$search_payment%' OR o.payment_status LIKE '%$search_payment%')";
                    }

                    $query .= " GROUP BY o.order_id";
                    $result = mysqli_query($connect, $query);
                    if (!$result) {
                        die("Query failed: " . mysqli_error($connect));
                    }
    
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["order_id"] . "</td>";
    
                            // product details
                            $productDetails = [];
                            $productCodes = explode(',', $row['product_codes']);
                            $productNames = explode(',', $row['product_names']);
                            $productQuantities = explode(',', $row['product_quantities']);
                            $productPrices = explode(',', $row['product_prices']);
    
                            for ($i = 0; $i < count($productCodes); $i++) {
                                $productDetails[] = $productCodes[$i] . " - " . $productNames[$i] . " (" . $productQuantities[$i] . " x " . $productPrices[$i] . ")";
                            }
                            echo "<td>" . implode('<br>', $productDetails) . "</td>";
    
                            // ticket details
                            $ticketDetails = [];
                            $ticketIDs = explode(',', $row['ticketIDs']);
                            $ticketRaces = explode(',', $row['ticket_races']);
                            $ticketQuantities = explode(',', $row['ticket_quantities']);
                            $ticketPrices = explode(',', $row['ticket_prices']);
    
                            for ($i = 0; $i < count($ticketIDs); $i++) {
                                $ticketDetails[] = $ticketIDs[$i] . " - " . $ticketRaces[$i] . " (" . $ticketQuantities[$i] . " x " . $ticketPrices[$i] . ")";
                            }
                            echo "<td>" . implode('<br>', $ticketDetails) . "</td>";
    
                            // Display total price
                            echo "<td>RM" . number_format($row["total_price"], 2) . "</td>";
    
                            echo "<td>" . $row["payment_method"] . "</td>";
                            echo "<td>" . $row["payment_status"] . "</td>";
                            echo "<td>" . $row["created_at"] . "</td>";
                    }
                }
                
                ?>
                </table>
                <!--<div class="total">
                    <h2>Total Price: <?php echo $totalPrice;?></h2>
                </div>-->
            </div>
    </div>
  </form>
</div>


  <!-- END Second Column -->
  <div style="clear:both; height: 40px"></div>
</div>
</body>
</html>