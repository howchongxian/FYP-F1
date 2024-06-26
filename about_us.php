<?php include("dataconnection.php"); ?>
<!DOCTYPE HTML>
<head>
<title>about us</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/about_us.css">
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
<div class="about-us">
    <div class="container">
        <div class="row">
            <div class="flex">
                <h2>About Us</h2>
                <h3>Discover Our Story</h3>
                <p>Welcome to Formula 1 Website, your ultimate destination for everything Formula One! Our platform is designed to bring you the latest news, captivating stories and thrilling race highlights from the world of Formula 1. 
                    Driven by our love for speed, technology and competition, we aim to provide fans with a comprehensive and engaging experience. Whether you're a seasoned fan or a newcomer to the sport, we've got something for everyone.
                    From race previews and reviews to in-depth features on teams, drivers and the latest developments in the sport, we cover it all.
                    But we're more than just a news site. We're a community of passionate fans who live and breathe Formula 1. Join us as we dive into the heart of the action, celebrating the thrill of racing and the spirit of competition that defines Formula 1.
                    Join us on this exhilarating journey as we explore the world of Formula 1 together!
                </p>
            </div>
            <div class="flex">
                <img src="images/everything-f1.jpg">
            </div>
        </div>
    </div>
</div>

<!--Our Team-->
<hr class="line">
<div class="our">
    <h2>Meet Our Team</h2>
</div>
<div class="team">
    <div class="card">
        <div class="content">
            <div class="imgBx">
                <img src="images/chongxian.jpg" >
            </div>
            <div class="contentBx">
                <h4>How Chong Xian</h4>
                <h5>1211210949</h5>
                <h5>Director</h5>
            </div>
            <div class="sci">
                <a href="https://instagram.com/chongxian930"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="content">
            <div class="imgBx">
                <img src="images/samuel.jpg">
            </div>
            <div class="contentBx">
                <h4>Samuel Fung Wen Kai</h4>
                <h5>1211110578</h5>
                <h5>Manager</h5>
            </div>
            <div class="sci">
                <a href="https://www.instagram.com/samuel_fg12?igsh=ZzdpOWxkZmFnbGJj"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="content">
            <div class="imgBx">
                <img src="images/shawn.jpg" >
            </div>
            <div class="contentBx">
                <h4>Shawn Koh En Wee</h4>
                <h5>1211211185</h5>
                <h5>Developer</h5>
            </div>
            <div class="sci">
                <a href="https://www.instagram.com/shawnkohenwee/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>

</div>
</body>
</html>