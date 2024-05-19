<?php include("dataconnection.php"); ?>
<!DOCTYPE HTML>
<head>
<title>Driver</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/driver.css">
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
<!-- Main Menu -->
<ol id="menu">
  <li class="active_menu_item"><a href="index.php" style="color:#FFF">Home</a>
    <!-- sub menu -->
  </li>
  <!-- end sub menu -->
  <li><a href="#">Latest</a>
    <ol>
      <li><a href="news.php">News</a></li>
      <li><a href="videos.php">Videos</a></li>
    </ol>
  </li>
  <li><a href="schedule_result.php">Schedule & Result</a></li>
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

<div class="container">
    <div class="column" id="driver1">
        <a href="https://www.formula1.com/en/drivers/max-verstappen.html">
            <p class="rank">1</p>
            <img src="drivers/MaxVers.jpg" alt="Driver 1">
            <p>Max Verstappen</p>
            <p>1</p>
            <p>161 PTS</p>
        </a>
    </div>
    <div class="column" id="driver2">
        <p class="rank">2</p>
        <a href="https://www.formula1.com/en/drivers/charles-leclerc.html">
            <img src="drivers/Leclerc.jpg" alt="Driver 2">
            <p>Charles Leclerc</p>
            <p>16</p>
            <p>113 PTS</p>
        </a>
    </div>
    <div class="column" id="driver3">
        <a href="https://formula1.com/en/drivers/sergio-perez.html">
            <p class="rank">3</p>
            <img src="drivers/Perez.jpg" alt="Driver 3">
            <p>Sergio Perez</p>
            <p>11</p>
            <p>107 PTS</p>
        </a>
    </div>
    <div class="column" id="driver4">
        <a href="https://www.formula1.com/en/drivers/lando-norris.html">
            <p class="rank">4</p>
            <img src="drivers/Norris.jpg" alt="Driver 4">
            <p>Lando Norris</p>
            <p>4</p>
            <p>101 PTS</p>
        </a>
    </div>
    <div class="column" id="driver5">
        <a href="https://www.formula1.com/en/drivers/carlos-sainz.html">
            <p class="rank">5</p>
            <img src="drivers/Sainz.jpg" alt="Driver 5">
            <p>Carlos Sainz</p>
            <p>55</p>
            <p>93 PTS</p>
        </a>
    </div>
    <div class="column" id="driver6">
        <a href="https://www.formula1.com/en/drivers/oscar-piastri.html">
            <p class="rank">6</p>
            <img src="drivers/Piastri.jpg" alt="Driver 6">
            <p>Oscar Piastri</p>
            <p>81</p>
            <p>53 PTS</p>
        </a>
    </div>
    <div class="column" id="driver7">
        <a href="https://www.formula1.com/en/drivers/george-russell.html">
            <p class="rank">7</p>
            <img src="drivers/Russel.jpg" alt="Driver 7">
            <p>George Russell</p>
            <p>63</p>
            <p>44 PTS</p>
        </a>
    </div>
    <div class="column" id="driver8">
        <a href="https://www.formula1.com/en/drivers/lewis-hamilton.html">
            <p class="rank">8</p>
            <img src="drivers/Hamilton.jpg" alt="Driver 8">
            <p>Lewis Hamilton</p>
            <p>44</p>
            <p>35 PTS</p>
        </a>
    </div>
    <div class="column" id="driver9">
        <a href="https://www.formula1.com/en/drivers/fernando-alonso.html">
            <p class="rank">9</p>
            <img src="drivers/Alonso.jpg" alt="Driver 9">
            <p>Fernando Alonso</p>
            <p>14</p>
            <p>33 PTS</p>
        </a>
    </div>
    <div class="column" id="driver10">
        <a href="https://www.formula1.com/en/drivers/lance-stroll.html">
            <p class="rank">10</p>
            <img src="drivers/Stroll.jpg" alt="Driver 10">
            <p>Lance Stroll</p>
            <p>18</p>
            <p>11 PTS</p>
        </a>
    </div>
</div>
<script>
    // Get all driver columns
const columns = document.querySelectorAll('.column');

// Add hover effect for each column
columns.forEach(column => {
    column.addEventListener('mouseenter', () => {
        column.style.transform = 'scale(1.1)';
        column.style.borderColor = '#ff5733';
    });

    column.addEventListener('mouseleave', () => {
        column.style.transform = 'scale(1)';
        column.style.borderColor = '#ccc';
    });
});
</script>
</body>
</html>