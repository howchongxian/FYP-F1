<?php
include_once "dataconnection.php";

session_start(); // Start the session if not already started

// Check if the user is logged in
if (!isset($_SESSION['userId'])) {
    echo "User not logged in.";
    exit;
}

// Retrieve the user ID from the session
$userId = $_SESSION['userId'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST["newUsername"];

    if (strlen($newUsername) < 3) {
        echo "Username must be at least 3 characters long.";
        exit;
    }

    // Update the existing username in the database
    $sql = "UPDATE `user` SET `username`='$newUsername' WHERE `id`='$userId'";
    if (mysqli_query($connect, $sql)) {
        echo "Username updated successfully to: " . $newUsername;
    } else {
        echo "Error updating username: " . mysqli_error($connect);
    }

    mysqli_close($connect);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Username</title>
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
  <style>
    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    input[type="text"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
    }

    button {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
<div class="container">
    <h2>Edit Username</h2>
    <form id="editUsernameForm" method="POST" action="edit-username.php">
      <label for="newUsername">New Username:</label>
      <input type="text" id="newUsername" name="newUsername" required>
      <button type="submit" name="submit">Submit</button>
    </form>
  </div>
  <script>
    document.getElementById('editUsernameForm').addEventListener('submit', function(event) {
      const newUsernameInput = document.getElementById('newUsername');
      if (!isValidUsername(newUsernameInput.value)) {
        alert('Please enter a valid username.');
        event.preventDefault();
      }
    });

    function isValidUsername(username) {
      // Example validation: minimum length of 3 characters
      return username.length >= 3;
    }
  </script>
</body>
</html>
