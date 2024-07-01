<?php
session_start();

// Check if user is not logged in
if(!isset($_SESSION['userid'])) {
    header("Location: signin.php"); // Redirect to login page if not logged in
    exit();
}
?>
<!DOCTYPE HTML>
<head>
<title>index</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/index.css">
<link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
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
<div class="news-container">
  <div class="news-card">
      <img src="images/Ver&Norris.jpg" alt="F1 News 1" width="100%">
      <h3>‘I feel let down’ – Norris says Verstappen ‘in the wrong’ as both drivers give their take on Austria clash</h3>
      <p>Lando Norris and Max Verstappen have each had their say on their dramatic late-race collision while battling for the lead of the Austrian Grand Prix, with an unhappy Norris suggesting that it is down to Verstappen to approach him in terms of discussing the incident.</p>
      <a href="https://www.formula1.com/en/latest/article/i-feel-let-down-norris-says-verstappen-in-the-wrong-as-both-drivers-give.3YMA6QdZk5Ih4dKRK2nelR" target="_blank">Read More</a>
  </div>

  <div class="news-container">
  <div class="news-card">
    <img src="images/sainz.jpg" alt="F1 News 2" width="100%">
    <h3>Sainz happy with ‘bonus’ podium in Austria while Leclerc reflects on first-lap clash with Piastri and Perez</h3>
    <p>Ferrari endured mixed fortunes in the Austrian Grand Prix, with Carlos Sainz benefiting from the drama up ahead to claim a surprise podium while Charles Leclerc faced a difficult Sunday, having been caught up in a first-lap incident that damaged his front wing.</p>
    <a href="https://www.formula1.com/en/latest/article/sainz-happy-with-bonus-podium-in-austria-while-leclerc-reflects-on-first-lap.5ZTTeOIGnAgKLnfsx6bziR" target="_blank">Read More</a>
  </div>

<div class="news-container">
  <div class="news-card">
    <img src="images/Power_Rankings_2024.jpg" alt="F1 News 3" width="100%">
    <h3>POWER RANKINGS: Which drivers stood out and impressed our judges at the Japanese Grand Prix weekend?</h3>
    <p>Max Verstappen bounced back in exemplary fashion in Japan, storming to victory as Red Bull secured their third 1-2 result of the 2024 season. But who else on the grid impressed over the weekend in Suzuka? Scroll down to check out the latest Power Rankings leaderboard.</p>
    <a href="https://formula1.com/en/latest/article/power-rankings-which-drivers-stood-out-and-impressed-our-judges-at-the.4GJjSIQDyWjnlPKiP9YU5N" target="_blank">Read More</a>
  </div>

  <div class="news-card">
    <img src="images/perez.jpg" alt="F1 News 4" width="100%">
    <h3>Perez expects decision on Red Bull future to be made 'within next month'</h3>
    <p>Sergio Perez expects his Red Bull and F1 future to be clarified within the next month, with the Mexican out of contract next year.</p>
    <a href="https://www.formula1.com/en/latest/article/perez-expects-decision-on-red-bull-future-to-be-made-within-next-month.4f3CISx1VFIFMzF4qnm5Yy" target="_blank">Read More</a>
  </div>

<a href="news.php">
  <button id="more-news-button">More News</button>
</a>

<div class="video-container">
  <div class="video-card">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/7EP9p8NIJx8?si=guC8lEb6yC9-64E8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
      <h3>Race Highlights | Formula 1 Japanese Grand Prix 2024</h3>
      <a href="https://youtu.be/7EP9p8NIJx8?si=f3h_7lXLvwzENxs5" target="_blank">Watch on YouTube</a>
  </div>

  <div class="video-card">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/T3ulO7DjKjc?si=ewhtgBKuhOX-ssn6" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
      <h3>Race Highlights | Formula 1 Australian Grand Prix 2024</h3>
      <a href="https://youtu.be/T3ulO7DjKjc?si=zlLM5VtY0hXCzIHR" target="_blank">Watch on YouTube</a>
  </div>

  <div class="video-card">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/VAxQq4RLvTg?si=HdSCXsVlPejGY4vD" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
      <h3>Race Highlights | Formula 1 Saudi Arabian Grand Prix 2024</h3>
      <a href="https://youtu.be/VAxQq4RLvTg?si=rvf1cyzlK7aOEw3u" target="_blank">Watch on YouTube</a>
  </div>
</div>

<a href="videos.php">
  <button id="more-videos-button">More Videos</button>
</a>

<a href="schedule_result.html">
  <section>
      <h2>Upcoming Races</h2>
      <ul>
          <li><span class="grand-prix">FORMULA 1 LENOVO CHINESE GRAND PRIX 2024</span><br><span class="date">19-21 April 2024</span></li>
          <li><span class="grand-prix">FORMULA 1 CRYPTO.COM MIAMI GRAND PRIX 2024</span><br><span class="date">4-6 May 2024</span></li>
          <li><span class="grand-prix">FORMULA 1 MSC CRUISES GRAN PREMIO DEL MADE IN ITALY E DELL'EMILIA-ROMAGNA 2024</span><br><span class="date">17-19 May 2024</span></li>
          <li><span class="grand-prix">FORMULA 1 GRAND PRIX DE MONACO 2024</span><br><span class="date">24-26 May 2024</span></li>
      </ul>
  </section>
</a>

</body>
</html>