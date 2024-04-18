<?php include("dataconnection.php"); ?>
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
  <li class="active_menu_item"><a href="index.html" style="color:#FFF">Home</a>
  </li>
  <li><a href="#">Latest</a>
    <ol>
      <li><a href="news.html">News</a></li>
      <li><a href="videos.html">Videos</a></li>
    </ol>
  </li>
    <li><a href="schedule_result.html">Schedule & Result</a></li>
  <li><a href="#">Drivers & Teams</a>
    <ol>
      <li><a href="driver.html">Drivers</a></li>
      <li><a href="team.html">Teams</a></li>
    </ol>
  </li>
  <li><a href="#">Shop</a>
    <ol>
      <li><a href="product.php">Products</a></li>
      <li><a href="shopping_cart.php">Shopping Cart</a></li>
      <li><a href="feedback.php">Feedback</a></li>
    </ol>
  </li>
  <li><a href="#">About Us</a>
  <ol>
    <li><a href="about_us.html">About Us</a></li>
    <li><a href="contact.php">Contact Us</a></li>
  </ol>
  </li>

  <div id="login_button">
  <a href="login.php"><button>Login</button></a>
</div>
</ol>

<div class="news-container">
  <div class="news-card">
      <img src="images/Power_Rankings_2024.jpg" alt="F1 News 1" width="100%">
      <h3>POWER RANKINGS: Which drivers stood out and impressed our judges at the Japanese Grand Prix weekend?</h3>
      <p>Max Verstappen bounced back in exemplary fashion in Japan, storming to victory as Red Bull secured their third 1-2 result of the 2024 season. But who else on the grid impressed over the weekend in Suzuka? Scroll down to check out the latest Power Rankings leaderboard.</p>
      <a href="https://formula1.com/en/latest/article/power-rankings-which-drivers-stood-out-and-impressed-our-judges-at-the.4GJjSIQDyWjnlPKiP9YU5N" target="_blank">Read More</a>
  </div>

  <div class="news-card">
      <img src="images/Bottas.jpg" alt="F1 News 2" width="100%">
      <h3>Bottas pleased with Kick Sauber’s pace progress as Zhou rues ‘disappointing start of the year’ after Japan DNF</h3>
      <p>There were mixed emotions for the Kick Sauber team at the Japanese Grand Prix, with Valtteri Bottas taking the positives from the squad’s improvement in pace while Zhou Guanyu was left disappointed after having to retire with a mechanical problem.</p>
      <a href="https://www.formula1.com/en/latest/article/bottas-pleased-with-kick-saubers-pace-progress-as-zhou-rues-disappointing.7lCT8c3LGHO72EEvyDwXr6" target="_blank">Read More</a>
  </div>

  <div class="news-card">
    <img src="images/perez.jpg" alt="F1 News 2" width="100%">
    <h3>Perez expects decision on Red Bull future to be made 'within next month'</h3>
    <p>Sergio Perez expects his Red Bull and F1 future to be clarified within the next month, with the Mexican out of contract next year.</p>
    <a href="https://www.formula1.com/en/latest/article/perez-expects-decision-on-red-bull-future-to-be-made-within-next-month.4f3CISx1VFIFMzF4qnm5Yy" target="_blank">Read More</a>
  </div>

  <div class="news-card">
    <img src="images/Palmer-Ricciardo.jpg" alt="F1 News 2" width="100%">
    <h3>PALMER: This season was meant to be an audition for a Red Bull return, but is Ricciardo now under pressure at RB?</h3>
    <p>Four races into the year and it hasn’t been the start of the season Daniel Ricciardo hoped for, or indeed the season the Red Bull bosses had expected from the Aussie.</p>
    <a href="https://www.formula1.com/en/latest/article/palmer-this-season-was-meant-to-be-an-audition-for-a-red-bull-return-but-is.6jprLk73kxbHzklagZ8eMM" target="_blank">Read More</a>
  </div>
</div>

<a href="news.html">
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

<a href="videos.html">
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