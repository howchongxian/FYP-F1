<?php
include("dataconnection.php");
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Admin Orders</title>
    <meta charset="utf-8">
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" media="screen" href="./css/admin_style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/product.css">
    <!-- FancyBox -->
    <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css" media="all">
    <script src="js/fancybox/jquery.fancybox-1.2.1.js"></script>
    <script type="text/javascript">
        function confirmation() {
            return confirm("Do you want to delete this order?");
        }
    </script>
    <style>
        .filter-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .filter-container form {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .filter-container form .date-filter {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .filter-container form .search-filter {
            display: flex;
            gap: 10px;
            align-items: center;
        }
    </style>
</head>
<?php
include 'admin_sidebar.php';
?>

<body>
    <div id="admin_product">
        <h1>F1 Product Shop - Orders</h1>
        <div class="product-list">
            <h2>Orders</h2>
            <div class="filter-container">
                <!-- Date Filter Form -->
                <form method="GET" action="">
                    <div class="date-filter">
                        <label for="start_date">Start Date:</label>
                        <input type="date" name="start_date" id="start_date" value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : '' ?>">
                        <label for="end_date">End Date:</label>
                        <input type="date" name="end_date" id="end_date" value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : '' ?>">
                        <input type="submit" value="Filter">
                    </div>
                </form>
            </div>
            <table class="product-table" border="1" width="1000px" height="100px">
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone No.</th>
                    <th>Products</th>
                    <th>Tickets</th>
                    <th>Total Price</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
                <?php

                $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
                $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
                $search_payment = isset($_GET['search_payment']) ? $_GET['search_payment'] : '';

                $query = "SELECT o.order_id, o.user_id, o.name, o.address, o.phone, o.payment_method, o.payment_status, o.created_at, o.total_price,
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
                WHERE 1=1";

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
                        echo "<td>" . $row["user_id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "<td>" . $row["phone"] . "</td>";

                        // product details
                        $productDetails = [];
                        $productCodes = explode(',', $row['product_codes']);
                        $productNames = explode(',', $row['product_names']);
                        $productQuantities = explode(',', $row['product_quantities']);
                        $productPrices = explode(',', $row['product_prices']);

                        for ($i = 0; $i < count($productCodes); $i++) {
                            if (isset($productCodes[$i], $productNames[$i], $productQuantities[$i], $productPrices[$i])) {
                                $productDetails[] = $productCodes[$i] . " - " . $productNames[$i] . " (" . $productQuantities[$i] . " x " . $productPrices[$i] . ")";
                            }
                        }
                        echo "<td>" . implode('<br>', $productDetails) . "</td>";

                        // ticket details
                        $ticketDetails = [];
                        $ticketIDs = explode(',', $row['ticketIDs']);
                        $ticketRaces = explode(',', $row['ticket_races']);
                        $ticketQuantities = explode(',', $row['ticket_quantities']);
                        $ticketPrices = explode(',', $row['ticket_prices']);

                        for ($i = 0; $i < count($ticketIDs); $i++) {
                            if (isset($ticketIDs[$i], $ticketRaces[$i], $ticketQuantities[$i], $ticketPrices[$i])) {
                                $ticketDetails[] = $ticketIDs[$i] . " - " . $ticketRaces[$i] . " (" . $ticketQuantities[$i] . " x " . $ticketPrices[$i] . ")";
                            }
                        }
                        echo "<td>" . implode('<br>', $ticketDetails) . "</td>";

                        // Display total price
                        echo "<td>RM" . number_format($row["total_price"], 2) . "</td>";

                        echo "<td>" . $row["payment_method"] . "</td>";
                        echo "<td>" . $row["payment_status"] . "</td>";
                        echo "<td>" . $row["created_at"] . "</td>";

                        // Delete button
                        echo "<td>";
                        echo "<form method='post' action='admin_delete_order.php' style='display:inline-block;'>";
                        echo "<input type='hidden' name='order_id' value='" . $row["order_id"] . "'>";
                        echo "<button type='submit' onclick='return confirmation();'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>No orders found.</td></tr>";
                }

                mysqli_free_result($result);

                mysqli_close($connect);
                ?>
            </table>
        </div>
    </div>
</body>

</html>
