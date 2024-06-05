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
    <!-- FancyBox -->
    <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css" media="all">
    <script src="js/fancybox/jquery.fancybox-1.2.1.js"></script>
    <style>
        .filter-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .filter-container .search-box {
            margin-left: auto;
        }

        .filter-container .date-filters {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
        }

        .filter-container .date-filters input,
        .filter-container .date-filters select {
            margin-right: 10px;
        }

        .filter-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
    </style>
</head>

<body>
    <?php
    include 'sidebar.php';
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
                    <th>Order Date</th>
                    <th>Payment Status</th>
                </tr>
                <?php
                $search = isset($_GET['search']) ? $_GET['search'] : '';
                $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
                $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
                $group_by = isset($_GET['group_by']) ? $_GET['group_by'] : 'day';

                $query = "SELECT o.order_id, o.user_id, o.payment_method, 
                          (SELECT SUM(quantity) FROM order_items WHERE order_id = o.order_id) AS total_products, 
                          o.total_price, o.created_at, o.payment_status 
                          FROM `order_detail` o";

                $conditions = [];

                if (!empty($search)) {
                    $conditions[] = "o.payment_status LIKE '%$search%'";
                }
                if (!empty($start_date) && !empty($end_date)) {
                    $conditions[] = "o.created_at BETWEEN '$start_date' AND '$end_date'";
                }

                if (!empty($conditions)) {
                    $query .= " WHERE " . implode(' AND ', $conditions);
                }

                $query .= " ORDER BY o.order_id ASC";

                $result = mysqli_query($connect, $query);

                if (!$result) {
                    die("Query failed: " . mysqli_error($connect));
                }

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["order_id"] . "</td>";
                        echo "<td>" . $row["user_id"] . "</td>";
                        echo "<td>" . $row["payment_method"] . "</td>";
                        echo "<td>" . $row["total_products"] . "</td>";
                        echo "<td>RM" . number_format($row["total_price"], 2) . "</td>"; // Changed to RM for currency format
                        echo "<td>" . $row["created_at"] . "</td>";
                        echo "<td>" . $row["payment_status"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No sales records found.</td></tr>";
                }

                mysqli_free_result($result);
                mysqli_close($connect);
                ?>
            </table>
        </div>
    </div>
</body>

</html>
