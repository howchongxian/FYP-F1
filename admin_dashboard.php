<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/admin_dashboard.css">
</head>
<body>
<?php include 'sidebar.php'; ?>

<section class="dashboard">
   <h1 class="dashboard">Dashboard</h1>

   <div class="box-dashboard">
      <div class="box">
         <h3>Welcome!</h3>
         <p><?= htmlspecialchars($fetch_profile['username']); ?></p>
      </div>

      <div class="box">
         <?php
            $select_users = $connect->prepare("SELECT * FROM `user`");
            $select_users->execute();
            $result_users = $select_users->get_result();
            $number_of_users = $result_users->num_rows;
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>User Accounts</p>
      </div>

      <div class="box">
         <?php
            $select_products = $connect->prepare("SELECT * FROM `product`");
            $select_products->execute();
            $result_products = $select_products->get_result();
            $number_of_products = $result_products->num_rows;
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p>Products Added</p>
      </div>

      <div class="box">
         <?php
            $select_orders = $connect->prepare("SELECT * FROM `order`");
            $select_orders->execute();
            $result_orders = $select_orders->get_result();
            $number_of_orders = $result_orders->num_rows;
         ?>
         <h3><?= $number_of_orders; ?></h3>
         <p>Orders Placed</p>
      </div>

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pendings = $connect->prepare("SELECT * FROM `order` WHERE payment_status = ?");
            $status_pending = 'pending';
            $select_pendings->bind_param("s", $status_pending);
            $select_pendings->execute();
            $result_pendings = $select_pendings->get_result();
            while($fetch_pendings = $result_pendings->fetch_assoc()){
               $total_pendings += $fetch_pendings['transactionID']; // Assuming `transactionID` holds the total price
            }
         ?>
         <h3><span>RM</span><?= $total_pendings; ?><span></span></h3>
         <p>Pending Orders</p>
      </div>

      <div class="box">
         <?php
            $total_completes = 0;
            $select_completes = $connect->prepare("SELECT * FROM `order` WHERE payment_status = ?");
            $status_completed = 'completed';
            $select_completes->bind_param("s", $status_completed);
            $select_completes->execute();
            $result_completes = $select_completes->get_result();
            while($fetch_completes = $result_completes->fetch_assoc()){
               $total_completes += $fetch_completes['transactionID']; // Assuming `transactionID` holds the total price
            }
         ?>
         <h3><span>RM</span><?= $total_completes; ?><span></span></h3>
         <p>Completed Orders</p>
      </div>

      <div class="box">
         <?php
            $select_messages = $connect->prepare("SELECT * FROM `feedback`");
            $select_messages->execute();
            $result_messages = $select_messages->get_result();
            $number_of_messages = $result_messages->num_rows;
         ?>
         <h3><?= $number_of_messages; ?></h3>
         <p>Feedback</p>
      </div>
   </div>
   <canvas id="salesChart"></canvas>
</section>

<script>
let salesData = <?= json_encode($salesDataArray); ?>;
let dateLabels = <?= json_encode($dateLabelsArray); ?>;

let salesChart = new Chart(document.getElementById('salesChart'), {
   type: 'line',
   data: {
      labels: dateLabels,
      datasets: [{
         label: 'Monthly Sales Report',
         data: salesData,
         backgroundColor: 'rgba(75, 192, 192, 0.2)',
         borderColor: 'rgba(75, 192, 192, 1)',
         borderWidth: 1
      }]
   },
   options: {
      responsive: true,
      scales: {
         y: {
            beginAtZero: true,
            ticks: {
               callback: function (value) {
                  return 'RM ' + value;
               }
            }
         }
      }
   }
});
</script>

</body>
</html>
