<?php
include("dataconnection.php");
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Sales Report</title>
    <meta charset="utf-8">
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" media="screen" href="./css/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/product.css">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/report.css">
    <!-- FancyBox -->
    <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css" media="all">
    <script src="js/fancybox/jquery.fancybox-1.2.1.js"></script>
</head>

<body>
    <?php
    include 'admin_sidebar.php';
    ?>
    <div id="container">
        <h1>F1 Product Shop - Sales Report</h1>
        <div class="report-list">
            <h2>Sales Report</h2>
            <div class="filter-wrapper">
                <!-- Date Filter Form -->
                <form method="GET" action="" class="date-filters">
                    <input type="date" name="start_date" value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : '' ?>">
                    <input type="date" name="end_date" value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : '' ?>">
                    <select name="group_by">
                        <option value="day" <?php echo (isset($_GET['group_by']) && $_GET['group_by'] == 'day') ? 'selected' : '' ?>>Day</option>
                        <option value="month" <?php echo (isset($_GET['group_by']) && $_GET['group_by'] == 'month') ? 'selected' : '' ?>>Month</option>
                    </select>
                    <input type="submit" value="Filter">
                </form>
                <form method="POST" action="export_pdf.php" target="_blank">
                    <input type="submit" name="pdf_creator" value="Export to PDF">
                </form>
                <form method="POST" action="export_excel.php">
                    <input type="hidden" name="export_excel" value="1">
                    <input type="submit" value="Export to Excel">
                </form>

                <!-- Search Form -->
                <form method="GET" action="" class="search-box">
                    <input type="text" name="search" placeholder="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
                    <input type="submit" value="Search">
                </form>
            </div>
            <table class="report-table" border="1" width="1000px" height="100px">
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Payment Method</th>
                    <th>Total Products</th>
                    <th>Total Price</th>
                    <th>Payment Status</th>
                    <th>Order Date</th>
                </tr>
                <?php
                $search = isset($_GET['search']) ? $_GET['search'] : '';
                $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
                $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
                $group_by = isset($_GET['group_by']) ? $_GET['group_by'] : 'day';

                $query = "SELECT o.order_id, o.user_id, o.payment_method, 
                          (SELECT SUM(quantity) FROM order_items WHERE order_id = o.order_id) AS total_products, 
                          o.total_price, o.payment_status, o.created_at 
                          FROM `order_detail` o
                          WHERE o.payment_status = 'completed'";

                $conditions = [];

                if (!empty($search)) {
                    $conditions[] = "o.payment_status LIKE '%$search%'";
                }
                if (!empty($start_date) && !empty($end_date)) {
                    $conditions[] = "o.created_at BETWEEN '$start_date' AND '$end_date'";
                }

                if (!empty($conditions)) {
                    $query .= " AND " . implode(' AND ', $conditions);
                }

                $query .= " ORDER BY o.order_id ASC";

                $result = mysqli_query($connect, $query);

                if (!$result) {
                    die("Query failed: " . mysqli_error($connect));
                }

                $totalPrice = 0; // Initialize total price variable

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["order_id"] . "</td>";
                        echo "<td>" . $row["user_id"] . "</td>";
                        echo "<td>" . $row["payment_method"] . "</td>";
                        echo "<td>" . $row["total_products"] . "</td>";
                        echo "<td>RM" . number_format($row["total_price"], 2) . "</td>"; // Changed to RM for currency format
                        echo "<td>" . $row["payment_status"] . "</td>";
                        echo "<td>" . $row["created_at"] . "</td>";
                        echo "</tr>";

                        // Add the total price of this row to the total price variable
                        $totalPrice += $row["total_price"];
                    }
                } else {
                    echo "<tr><td colspan='7'>No sales records found.</td></tr>";
                }

                // Display the total price below and next to the word "Total Sales"
                echo "<tr>";
                echo "<td colspan='2' align='left'><strong>Total Sales :</strong></td>";
                echo "<td colspan='5'><strong>RM" . number_format($totalPrice, 2) . "</strong></td>"; // Adjusted for currency format
                echo "</tr>";

                mysqli_free_result($result);
                mysqli_close($connect);
                ?>
            </table>
        </div>
    </div>
</body>

</html>
