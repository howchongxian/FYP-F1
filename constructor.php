<?php include("dataconnection.php"); ?>
<!DOCTYPE HTML>
<head>
<title>Constructor Champion</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/constructor.css">
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

<h1>2024 F1 Constructor Standings</h1>
    <table id="constructor-standings">
        <thead>
            <tr>
                <th>Pos</th>
                <th>Team</th>
                <th>Pts</th>
            </tr>
        </thead>
        <tbody>
            <!-- Standings will be inserted here by JavaScript -->
        </tbody>
    </table>
    <script>
        const standings = [
            { pos: 1, team: 'RED BULL RACING HONDA RBPT', pts: 301, url: 'https://www.formula1.com/en/results.html/2024/team/red_bull_racing_honda_rbpt.html' },
            { pos: 2, team: 'FERRARI', pts: 252, url: 'https://www.formula1.com/en/results.html/2024/team/ferrari.html' },
            { pos: 3, team: 'MCLAREN MERCEDES', pts: 212, url: 'https://www.formula1.com/en/results.html/2024/team/mclaren_mercedes.html' },
            { pos: 4, team: 'MERCEDES', pts: 124, url: 'https://www.formula1.com/en/results.html/2024/team/mercedes.html' },
            { pos: 5, team: 'ASTON MARTIN ARAMCO MERCEDES', pts: 58, url: 'https://www.formula1.com/en/results.html/2024/team/aston_martin_aramco_mercedes.html' },
        ];

        function populateStandings() {
            const tbody = document.querySelector('#constructor-standings tbody');
            standings.forEach(team => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${team.pos}</td>
                    <td class="team-link" data-url="${team.url}">${team.team}</td>
                    <td>${team.pts}</td>
                `;
                tbody.appendChild(row);
            });

            document.querySelectorAll('.team-link').forEach(link => {
                link.addEventListener('click', function() {
                    const url = this.getAttribute('data-url');
                    window.location.href = url;
                });
            });
        }

        document.addEventListener('DOMContentLoaded', populateStandings);
    </script>
</body>
</html>