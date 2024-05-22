<?php
// Include your database connection file
include 'dataconnection.php';

// Assume $fetch_profile is defined and contains user profile data
$fetch_profile = array(
  'username' => 'Admin' // Example username
);

// Initialize variable to store real username
$real_username = '';

// Fetch real username from the database
if (isset($fetch_profile['username'])) {
    $username = $fetch_profile['username'];
    // Perform a database query to get the real username based on $username
    $query = "SELECT * FROM `user` WHERE `username` = '$username'";
    $result = mysqli_query($connect, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $real_username = $row['username'];
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>Admin</title>
  <link rel="stylesheet" type="text/css" media="screen" href="css/admin_sidebar.css">
  <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus icon'></i>
      <div class="logo_name">Admin Panel</div>
      <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list">
      <li>
        <a href="admin_dashboard.php">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
      <li>
        <a href="user.php">
          <i class='bx bxs-user-detail'></i>
          <span class="links_name">User</span>
        </a>
        <span class="tooltip">User</span>
      </li>
      <li>
        <a href="admin_manage_product.php">
          <i class='bx bx-purchase-tag-alt'></i>
          <span class="links_name">Product</span>
        </a>
        <span class="tooltip">Product</span>
      </li>
      <li>
        <a href="admin_order_detail.php">
          <i class='bx bx-cart'></i>
          <span class="links_name">Orders</span>
        </a>
        <span class="tooltip">Orders</span>
      </li>
      <li>
        <a href="sales_report.php">
          <i class='bx bxs-report'></i>
          <span class="links_name">Sales Report</span>
        </a>
        <span class="tooltip">Sales Report</span>
      </li>
      <li>
        <a href="admin_feedback.php">
          <i class='bx bx-message-dots'></i>
          <span class="links_name">Feedback</span>
        </a>
        <span class="tooltip">Feedback</span>
      </li>
      <li class="logout">
        <a href="logout.php">
          <i class='bx bx-log-out' id="log_out"></i>
          <span class="links_name">Log Out</span>
        </a>
        <span class="tooltip">Log Out</span>
      </li>
    </ul>
  </div>
  <section class="dashboard"></section>

  <script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let dashboardSection = document.querySelector(".dashboard");

    closeBtn.addEventListener("click", () => {
      sidebar.classList.toggle("open");
      menuBtnChange(); // Call the function to change button icon
      adjustContentMargin(); // Call the function to adjust content margin
    });

    // Function to change sidebar button icon
    function menuBtnChange() {
      if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
      } else {
        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      }
    }

    // Function to adjust content margin when sidebar opens/closes
    function adjustContentMargin() {
      if (sidebar.classList.contains("open")) {
        dashboardSection.style.marginLeft = "250px"; // Adjust sidebar width accordingly
      } else {
        dashboardSection.style.marginLeft = "0";
      }
    }
  </script>
</body>

</html>
