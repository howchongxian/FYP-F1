<?php include("dataconnection.php"); ?>
<!DOCTYPE HTML>
<head>
<title>index</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/schedule.css">
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

<h2>Formula 1 Schedule and Results</h2>

<table id="schedule">
  <tr>
    <th>Grand Prix</th>
    <th>Date</th>
    <th>Race Winner</th>
    <th>Points</th>
    <th>Action</th>
  </tr>
</table>

<script>
  // Sample data - replace it with your actual data
  const races = [
    { grandPrix: 'FORMULA 1 GULF AIR BAHRAIN GRAND PRIX 2024', date: '29 Feb - 2 Mar 2024', winner: 'Max Verstappen', points: '26', detailsURL: 'https://www.formula1.com/en/results.html/2024/races/1229/bahrain/race-result.html' },
    { grandPrix: 'FORMULA 1 STC SAUDI ARABIAN GRAND PRIX 2024', date: '7-9 Mar 2024', winner: 'Max Verstappen', points: '25', detailsURL: 'https://www.formula1.com/en/results.html/2024/races/1230/saudi-arabia/race-result.html' },
    { grandPrix: 'FORMULA 1 ROLEX AUSTRALIAN GRAND PRIX 2024', date: '22-24 Mar 2024', winner: 'Carlos Sainz', points: '25', detailsURL: 'https://example.com/chinese-grand-prix-details' },
    { grandPrix: 'FORMULA 1 MSC CRUISES JAPANESE GRAND PRIX 2024', date: '5-7 Apr 2024', winner: 'Max Verstappen', points: '26', detailsURL: 'https://www.formula1.com/en/results.html/2024/races/1232/japan/race-result.html' },
    { grandPrix: 'FORMULA 1 LENOVO CHINESE GRAND PRIX 2024', date: '19-21 Apr 2024', winner: 'Upcoming', points: '', detailsURL: 'https://www.formula1.com/en/racing/2024/China.html' },
    { grandPrix: 'FORMULA 1 CRYPTO.COM MIAMI GRAND PRIX 2024', date: '4-6 May 2024', winner: 'Upcoming', points: '', detailsURL: 'https://www.formula1.com/en/racing/2024/Miami.html' },
    { grandPrix: 'FORMULA 1 ITALY E DELL EMILIA-ROMAGNA 2024', date: '17-19 May 2024', winner: 'Upcoming', points: '', detailsURL: 'https://www.formula1.com/en/racing/2024/EmiliaRomagna.html' },
    { grandPrix: 'FORMULA 1 GRAND PRIX DE MONACO 2024', date: '24-26 May 2024', winner: 'Upcoming', points: '', detailsURL: 'https://www.formula1.com/en/racing/2024/Monaco.html' },
  ];

  const scheduleTable = document.getElementById('schedule');

  races.forEach(race => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${race.grandPrix}</td>
      <td>${race.date}</td>
      <td>${race.winner === 'Upcoming' ? '<span class="upcoming">Upcoming</span>' : race.winner}</td>
      <td>${race.points}</td>
      <td><a class="details-btn" href="${race.detailsURL}" target="_blank">View Details</a></td>
    `;
    scheduleTable.appendChild(row);
  });
</script>
</body>
</html>