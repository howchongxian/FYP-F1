<!DOCTYPE HTML>
<head>
<title>Contact Us</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/about_us.css">
</head>
<body>
<!-- Main Menu -->
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
  <a href="login.html"><button>Login</button></a>
</div>
</ol>
<div class="help">
  <h2>Formula 1 Website</h2>
  <p>We're here to help and answer any question you might have.We look forward to hearing from you.</p>

</div>
<div class="contact-container">
<div class="form-container">
  <h3 hre>Contact Us</h3>
  <form action="" class="contactfrm" method="post">
      <input type="text" name="UName" class="form-control mb-2" placeholder="Your Name" required>
      <input type="email" name="Email" class="form-control mb-2" placeholder="Enter Your Email..." required>
      <input type="tel" name="tel" class="form-control mb-2" placeholder="Your Phone Number..." required>
      <textarea name="msg" class="form-control mb-2" cols="30" rows="10" placeholder="Write Message Here..."></textarea>
      <input type="submit" value="Send" name="submit" class="send-button"> 
  </form>
</div>
<div class="map">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d510174.9042152937!2d101.62996509631878!3d2.5903716844016755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d1e56b9710cf4b%3A0x66b6b12b75469278!2sMultimedia%20University!5e0!3m2!1sen!2smy!4v1685189601949!5m2!1sen!2smy" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
</div>

<script>
document.getElementById('contact-form').addEventListener('submit', function(event) {
  event.preventDefault();

  var name = document.getElementById('name-input').value;
  var email = document.getElementById('email-input').value;
  var phone = document.getElementById('phone-input').value;
  var message = document.getElementById('message-input').value;

  if (name === '' || email === '' || phone === '' || message === '') {
      alert('Please fill in all fields.');
      return;
  }

  var formData = {
      name: name,
      email: email,
      phone: phone,
      message: message
  };

  // Replace '/submit-form' with the actual server-side endpoint to handle the form submission
  fetch('/submit-form', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify(formData)
  })
  .then(function(response) {
      if (response.ok) {
          alert('Form submitted successfully!');
          document.getElementById('name-input').value = '';
          document.getElementById('email-input').value = '';
          document.getElementById('phone-input').value = '';
          document.getElementById('message-input').value = '';
      } else {
          alert('Error submitting form. Please try again.');
      }
  })
  .catch(function(error) {
      console.error('Error:', error);
  });
});

</script>
</body>
</html>
<?php
include("dataconnection.php");
if(isset($_POST["submit"]))
{
    $username = $_POST["UName"];
    $email = $_POST["Email"];
    $tel = $_POST["tel"];
    $Msg = $_POST["msg"];
    
	mysqli_query($connect,"insert into contact(contact_name,contact_email,contact_tel,contact_message) values
	('$username','$email','$tel','$Msg')");
?>
<!--Alert user that was saved-->
<script type="text/javascript">
    alert("<?php echo ' Contact saved' ?>");
</script>

<?php
}
?>