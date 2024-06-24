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
    { grandPrix: 'FORMULA 1 LENOVO CHINESE GRAND PRIX 2024', date: '19-21 Apr 2024', winner: 'Max Verstappen', points: '25', detailsURL: 'https://www.formula1.com/en/results.html/2024/races/1233/china/race-result.html' },
    { grandPrix: 'FORMULA 1 CRYPTO.COM MIAMI GRAND PRIX 2024', date: '4-6 May 2024', winner: 'Lando Norris', points: '25', detailsURL: 'https://www.formula1.com/en/results.html/2024/races/1234/miami/race-result.html' },
    { grandPrix: 'FORMULA 1 ITALY E DELL EMILIA-ROMAGNA 2024', date: '17-19 May 2024', winner: 'Max Verstappen', points: '25', detailsURL: 'https://www.formula1.com/en/results.html/2024/races/1235/italy/race-result.html' },
    { grandPrix: 'FORMULA 1 GRAND PRIX DE MONACO 2024', date: '24-26 May 2024', winner: 'Charles Leclerc', points: '25', detailsURL: 'https://www.formula1.com/en/results.html/2024/races/1236/monaco/race-result.html' },
    { grandPrix: 'FORMULA 1 GRAND PRIX DU CANADA 2024', date: '8-10 Jun 2024', winner: 'Max Verstappen', points: '25', detailsURL: 'https://www.formula1.com/en/results.html/2024/races/1237/canada/race-result.html' },
    { grandPrix: 'FORMULA 1 ARAMCO GRAN PREMIO DE ESPAÑA 2024', date: '21-23 Jun 2024', winner: 'Max Verstappen', points: '25', detailsURL: 'https://www.formula1.com/en/results.html/2024/races/1238/spain/race-result.html' },
    { grandPrix: 'FORMULA 1 QATAR AIRWAYS AUSTRIAN GRAND PRIX 2024', date: '28-30 Jun 2024', winner: 'Upcoming', points: '', detailsURL: 'https://www.formula1.com/en/racing/2024/Austria.html' },
    { grandPrix: 'FORMULA 1 QATAR AIRWAYS BRITISH GRAND PRIX 2024', date: '5-7 Jul 2024', winner: 'Upcoming', points: '', detailsURL: 'https://www.formula1.com/en/racing/2024/great-britain' },
    { grandPrix: 'FORMULA 1 HUNGARIAN GRAND PRIX 2024', date: '19-21 Jul 2024', winner: 'Upcoming', points: '', detailsURL: 'https://www.formula1.com/en/racing/2024/hungary' },
    { grandPrix: 'FORMULA 1 ROLEX BELGIAN GRAND PRIX 2024', date: '26-28 Jul 2024', winner: 'Upcoming', points: '', detailsURL: 'https://www.formula1.com/en/racing/2024/belgium' },
    { grandPrix: 'FORMULA 1 HEINEKEN DUTCH GRAND PRIX 2024', date: '23-25 Aug 2024', winner: 'Upcoming', points: '', detailsURL: 'https://www.formula1.com/en/racing/2024/netherlands' },
    { grandPrix: 'FORMULA 1 PIRELLI GRAN PREMIO D’ITALIA 2024', date: '30 Aug-1 Sep 2024', winner: 'Upcoming', points: '', detailsURL: 'https://www.formula1.com/en/racing/2024/italy' },
    { grandPrix: 'FORMULA 1 QATAR AIRWAYS AZERBAIJAN GRAND PRIX 2024', date: '13-15 Sep 2024', winner: 'Upcoming', points: '', detailsURL: 'https://www.formula1.com/en/racing/2024/azerbaijan' },
    { grandPrix: 'FORMULA 1 SINGAPORE AIRLINES SINGAPORE GRAND PRIX 2024', date: '20-22 Sep 2024', winner: 'Upcoming', points: '', detailsURL: 'https://www.formula1.com/en/racing/2024/singapore' },
    { grandPrix: 'FORMULA 1 PIRELLI UNITED STATES GRAND PRIX 2024', date: '18-20 Oct 2024', winner: 'Upcoming', points: '', detailsURL: 'https://www.formula1.com/en/racing/2024/united-states' },
    { grandPrix: 'FORMULA 1 GRAN PREMIO DE LA CIUDAD DE MÉXICO 2024', date: '25-27 Oct 2024', winner: 'Upcoming', points: '', detailsURL: 'https://www.formula1.com/en/racing/2024/mexico' },
    { grandPrix: 'FORMULA 1 LENOVO GRANDE PRÊMIO DE SÃO PAULO 2024', date: '1-3 Nov 2024', winner: 'Upcoming', points: '', detailsURL: 'https://www.formula1.com/en/racing/2024/brazil' },
    { grandPrix: 'FORMULA 1 HEINEKEN SILVER LAS VEGAS GRAND PRIX 2024', date: '21-23 Nov 2024', winner: 'Upcoming', points: '', detailsURL: 'https://www.formula1.com/en/racing/2024/las-vegas' },
    { grandPrix: 'FORMULA 1 QATAR AIRWAYS QATAR GRAND PRIX 2024', date: '29 Nov-1 Dec 2024', winner: 'Upcoming', points: '', detailsURL: 'https://www.formula1.com/en/racing/2024/qatar' },
    { grandPrix: 'FORMULA 1 ETIHAD AIRWAYS ABU DHABI GRAND PRIX 2024', date: '6-8 Dec 2024', winner: 'Upcoming', points: '', detailsURL: 'https://www.formula1.com/en/racing/2024/united-arab-emirates' },
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