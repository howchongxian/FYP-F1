<?php
include 'dataconnection.php';

// Fetch admin's profile details
$fetch_profile_query = $connect->prepare("SELECT * FROM `user` WHERE role = 'admin' OR role = 'superadmin'");
$fetch_profile_query->execute();
$fetch_profile = $fetch_profile_query->fetch(PDO::FETCH_ASSOC);

// Fetch admin's role
$admin_role = $fetch_profile['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
   <script src="../js/admin_script.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<?php
include 'sidebar.php'
?>
<body>

<section class="dashboard">

   <h1 class="dashboard">Dashboard</h1>

   <div class="box-dashboard">

      <div class="box">
         <h3>Welcome!</h3>
         <p><?= $fetch_profile['name']; ?></p>
      </div>

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pendings = $connect->prepare("SELECT * FROM `order` WHERE payment_status = ?");
            $select_pendings->execute(['pending']);
            if($select_pendings->rowCount() > 0){
               while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                  $total_pendings += $fetch_pendings['total_price'];
               }
            }
         ?>
         <h3><span>RM</span><?= $total_pendings; ?><span></span></h3>
         <p>Pendings Orders</p>
      </div>

      <div class="box">
         <?php
            $total_completes = 0;
            $select_completes = $connect->prepare("SELECT * FROM `order` WHERE payment_status = ?");
            $select_completes->execute(['completed']);
            if($select_completes->rowCount() > 0){
               while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                  $total_completes += $fetch_completes['total_price'];
               }
            }
         ?>
         <h3><span>RM</span><?= $total_completes; ?><span></span></h3>
         <p>Completed Orders</p>
      </div>

      <div class="box">
         <?php
            $select_orders = $connect->prepare("SELECT * FROM `order`");
            $select_orders->execute();
            $number_of_orders = $select_orders->rowCount()
         ?>
         <h3><?= $number_of_orders; ?></h3>
         <p>Orders Placed</p>
      </div>

      <div class="box">
         <?php
            $select_products = $connect->prepare("SELECT * FROM `product`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p>Products Added</p>
      </div>

      <div class="box">
         <?php
            $select_users = $connect->prepare("SELECT * FROM `user`");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>Users Accounts</p>
      </div>

      <div class="box">
         <?php
            $select_messages = $connect->prepare("SELECT * FROM `feedback`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
         ?>
         <h3><?= $number_of_messages; ?></h3>
         <p>Feedback</p>
      </div>

   </div>
   <canvas id="salesChart"></canvas>

</section>

<script>
  let salesData = <?php echo json_encode($salesDataArray); ?>;
let dateLabels = <?php echo json_encode($dateLabelsArray); ?>;

let salesChart = new Chart(document.getElementById('salesChart'), {
   type: 'line',
   data: {
      labels: dateLabels,
      datasets: [{
         label: 'Monthly Sales Report',
         data: salesData, // This is where your sales amounts are plotted
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
               callback: function (value, index, values) {
                  return 'RM ' + value; // You can format the y-axis labels as 'RM <value>'
               }
            }
         }
      }
   }
});

</script>

</body>
</html>
