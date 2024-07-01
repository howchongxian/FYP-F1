<?php include("dataconnection.php"); ?>
<!DOCTYPE HTML>
<head>
<title>index</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/team.css">
<link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
<!-- Contact Form -->
<link href="contact-form/css/style.css" media="screen" rel="stylesheet" type="text/css">
<!-- JS Files -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="js/jquery.tools.min.js"></script>
<script>
$(function () {
    $("#prod_nav ul").tabs("#panes > div", {
        effect: 'fade',
        fadeOutSpeed: 400
    });
});
</script>
<script>
$(document).ready(function () {
    $(".pane-list li").click(function () {
        window.location = $(this).find("a").attr("href");
        return false;
    });
});
</script>
</head>
<body>
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
<div class="container">
  <div class="team-column" onclick="redirectToPage('https://www.formula1.com/en/teams/Red-Bull-Racing.html')">
    <h2>Red Bull Racing</h2>
    <p>355 PTS</p>
    <div class="driver">
        <img src="drivers/MaxVers.jpg" alt="Driver 1">
        <p>Max Verstappen</p>
    </div>
    <div class="driver">
        <img src="drivers/Perez.jpg" alt="Driver 2">
        <p>Sergio Perez</p>
    </div>
    <img src="images/teams/red_bull.png" alt="Team 1 Car">
</div>

<div class="team-column" onclick="redirectToPage('https://www.formula1.com/en/teams/Ferrari.html')">
  <h2>Ferarri</h2>
  <p>291 PTS</p>
  <div class="driver">
      <img src="drivers/Leclerc.jpg" alt="Driver 3">
      <p>Charles Leclerc</p>
  </div>
  <div class="driver">
      <img src="drivers/Sainz.jpg" alt="Driver 4">
      <p>Charlos Sainz</p>
  </div>
  <img src="images/teams/ferarri.png" alt="Team 2 Car">
</div>

<div class="team-column" onclick="redirectToPage('https://www.formula1.com/en/teams/McLaren.html')">
  <h2>McLaren</h2>
  <p>268 PTS</p>
  <div class="driver">
      <img src="drivers/Norris.jpg" alt="Driver 5">
      <p>Lando Norris</p>
  </div>
  <div class="driver">
      <img src="drivers/Piastri.jpg" alt="Driver 6">
      <p>Oscar Piastri</p>
  </div>
  <img src="images/teams/mclaren.png" alt="Team 3 Car">
</div>

<div class="team-column" onclick="redirectToPage('https://www.formula1.com/en/teams/Mercedes.html')">
  <h2>Mercedes</h2>
  <p>196 PTS</p>
  <div class="driver">
      <img src="drivers/Hamilton.jpg" alt="Driver 7">
      <p>Lewis Hamilton</p>
  </div>
  <div class="driver">
      <img src="drivers/Russel.jpg" alt="Driver 8">
      <p>George Russell</p>
  </div>
  <img src="images/teams/mercedes.png" alt="Team 4 Car">
</div>

<div class="team-column" onclick="redirectToPage('https://www.formula1.com/en/teams/Aston-Martin.html')">
  <h2>Aston Martin</h2>
  <p>58 PTS</p>
  <div class="driver">
      <img src="drivers/Alonso.jpg" alt="Driver 9">
      <p>Fernando Alonso</p>
  </div>
  <div class="driver">
      <img src="drivers/Stroll.jpg" alt="Driver 10">
      <p>Lance Stroll</p>
  </div>
  <img src="images/teams/aston_martin.png" alt="Team 5 Car">
</div>
<script>
  function redirectToPage(url) {
    window.location.href = url;
  }
  document.addEventListener("DOMContentLoaded", function() {
    const teamColumns = document.querySelectorAll('.team-column');
    teamColumns.forEach(column => {
    column.addEventListener('mouseenter', () => {
    column.style.transform = 'scale(1.05)';
    column.style.boxShadow = '0 0 20px rgba(0,0,0,0.1)';
  });

  column.addEventListener('mouseleave', () => {
    column.style.transform = 'scale(1)';
    column.style.boxShadow = 'none';
  });
});
});
</script>
</body>
</html>