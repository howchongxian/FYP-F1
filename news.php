<?php include("dataconnection.php"); ?>
<!DOCTYPE HTML>
<head>
<title>News</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/index.css">

</head>
<body>
  <ol id="menu">
    <li class="active_menu_item"><a href="index.php" style="color:#FFF">Home</a>
      <!-- sub menu -->
    </li>
    <!-- end sub menu -->
    <li><a href="#">Latest</a>
      <!-- sub menu -->
      <ol>
        <li><a href="news.php">News</a></li>
        <li><a href="videos.php">Videos</a></li>
      </ol>
    </li>
    <!-- end sub menu -->
    <li><a href="schedule_result.php">Schedule & Result</a></li>
    <li><a href="#">Drivers & Teams</a>
      <!-- sub menu -->
      <ol>
        <li><a href="driver.php">Drivers</a></li>
        <li><a href="team.php">Teams</a></li>
      </ol>
    </li>
    <!-- end sub menu -->
    <li><a href="#">Shop</a>
      <!-- sub menu -->
      <ol>
        <li><a href="product.php">Products</a></li>
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
  
    <div id="login_button">
    <a href="login.php"><button>Login</button></a>
  </div>
  </ol>

  <h1>F1 Latest News</h1>
  <div class="news-container">
    <div class="news-card">
      <img src="images/Palmer-Ricciardo.jpg" alt="F1 News 1" width="100%">
      <h3>PALMER: This season was meant to be an audition for a Red Bull return, but is Ricciardo now under pressure at RB?</h3>
      <p>Four races into the year and it hasn’t been the start of the season Daniel Ricciardo hoped for, or indeed the season the Red Bull bosses had expected from the Aussie.</p>
      <div class="read-more">
        <a href="https://www.formula1.com/en/latest/article/palmer-this-season-was-meant-to-be-an-audition-for-a-red-bull-return-but-is.6jprLk73kxbHzklagZ8eMM" target="_blank">Read More</a>
      </div>
    </div>

    <div class="news-card">
      <img src="images/PABLO_MONTOYA.jpg" alt="F1 News 2" width="100%">
      <h3>BEYOND THE GRID LEGENDS: Juan Pablo Montoya’s race for the 2003 championship</h3>
      <p>Seven-time Grand Prix winner Juan Pablo Montoya joins Tom Clarkson for the first episode of Beyond The Grid’s LEGENDS episodes.</p>
      <div class="read-more">
          <a href="https://www.formula1.com/en/latest/article/beyond-the-grid-legends-juan-pablo-montoyas-race-for-the-2003-championship.pg1Mnxbgseok3aMEoG56N" target="_blank">Read More</a>
      </div>
  </div>

    <div class="news-card">
      <img src="images/Power_Rankings_2024.jpg" alt="F1 News 3" width="100%">
      <h3>POWER RANKINGS: Which drivers stood out and impressed our judges at the Japanese Grand Prix weekend?</h3>
      <p>Max Verstappen bounced back in exemplary fashion in Japan, storming to victory as Red Bull secured their third 1-2 result of the 2024 season. But who else on the grid impressed over the weekend in Suzuka? Scroll down to check out the latest Power Rankings leaderboard.</p>
      <div class="read-more">
          <a href="https://formula1.com/en/latest/article/power-rankings-which-drivers-stood-out-and-impressed-our-judges-at-the.4GJjSIQDyWjnlPKiP9YU5N" target="_blank">Read More</a>
      </div>
  </div>
  
    <div class="news-card">
        <img src="images/Bottas.jpg" alt="F1 News 4" width="100%">
        <h3>Bottas pleased with Kick Sauber’s pace progress as Zhou rues ‘disappointing start of the year’ after Japan DNF</h3>
        <p>There were mixed emotions for the Kick Sauber team at the Japanese Grand Prix, with Valtteri Bottas taking the positives from the squad’s improvement in pace while Zhou Guanyu was left disappointed after having to retire with a mechanical problem.</p>
        <div class="read-more">
          <a href="https://www.formula1.com/en/latest/article/bottas-pleased-with-kick-saubers-pace-progress-as-zhou-rues-disappointing.7lCT8c3LGHO72EEvyDwXr6" target="_blank">Read More</a>
        </div>
    </div>
  
    <div class="news-card">
      <img src="images/perez.jpg" alt="F1 News 5" width="100%">
      <h3>Perez expects decision on Red Bull future to be made 'within next month'</h3>
      <p>Sergio Perez expects his Red Bull and F1 future to be clarified within the next month, with the Mexican out of contract next year.</p>
      <div class="read-more">
        <a href="https://www.formula1.com/en/latest/article/perez-expects-decision-on-red-bull-future-to-be-made-within-next-month.4f3CISx1VFIFMzF4qnm5Yy" target="_blank">Read More</a>
      </div>
    </div>
  
    <div class="news-card">
      <img src="images/Tech_Weekly_Japan.jpg" alt="F1 News 6" width="100%">
      <h3>TECH WEEKLY: The incredibly intricate cooling details so crucial to the Red Bull RB20’s concept</h3>
      <p>Red Bull’s modification to the cooling inlet/outlet arrangement in Suzuka brought the focus very much on a key aspect of the car’s concept.</p>
      <div class="read-more">
        <a href="https://www.formula1.com/en/latest/article/tech-weekly-the-incredibly-intricate-cooling-details-so-crucial-to-the-red-bull-rb20.48WSljdsrv7h2tohEMN9Rz" target="_blank">Read More</a>
      </div>
    </div>

    <div class="news-card">
      <img src="images/Alpine_Japanese.jpg" alt="F1 News 7" width="100%">
      <h3>Contact with Ocon on Lap 1 at Suzuka was ‘game over’ for Alpine, says Gasly</h3>
      <p>Alpine's troubled start to the season continued in Japan where again they failed to trouble the scorers – and to make matters worse their two drivers made contact with each other on the opening lap which damaged both cars.</p>
      <div class="read-more">
        <a href="https://www.formula1.com/en/latest/article/contact-with-ocon-on-lap-1-at-suzuka-was-game-over-for-alpine-says-gasly.5qozlzwWNc65J4UPbca474" target="_blank">Read More</a>
      </div>
    </div>

    <div class="news-card">
      <img src="images/hamilton_ferrari.jpg" alt="F1 News 8" width="100%">
      <h3>‘The stars aligned’ – Hamilton reveals the key factors behind his shock Ferrari switch</h3>
      <p>Lewis Hamilton has given a further insight into his decision to sign with Ferrari for 2025, with the Briton shedding light on what changed following the signing of his contract with Mercedes last summer.</p>
      <div class="read-more">
        <a href="https://www.formula1.com/en/latest/article/the-stars-aligned-hamilton-reveals-the-key-factors-behind-his-shock-ferrari.2vJRwYdyFN1J3vyTUqZMFr" target="_blank">Read More</a>
      </div>
    </div>

  </div>
</body>
</html>