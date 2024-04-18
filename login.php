<!DOCTYPE HTML>
<head>
<title>Login</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/login.css">
<!-- Contact Form -->
<link href="contact-form/css/style.css" media="screen" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
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
          <li><a href="contact.html">Contact Us</a></li>
        </ol>
        </li>
      
        <div id="login_button">
        <a href="login.php"><button>Login</button></a>
      </div>
      </ol>
      
    <div class="loginbox">
        <img src="images/avatar.png" class="avatar" style="margin-top:90px">
        <h1>Login Here</h1>
        <?php if(isset($_GET['error'])){ ?>
            <p style="color:red;" class="error"><?php echo $_GET['error'];?></p>
        <?php } ?>
        <form id="loginForm" method="post" action="loginsystem.php">        
            <p>Username</p>
            <input type="text" name="username" id="username" placeholder="Enter Username">
            <p>Password</p>
            <div class="password-input">
                <input type="password" name="password" id="password" placeholder="Enter Password" required>
                <span class="toggle-password" onclick="togglePasswordVisibility('password')">
                    <i class="uil uil-eye"></i>
                </span>
            </div>
            <input type="submit" value="Login" name="submit">
            <a href="" id="forgetPasswordLink" onclick="showAlert()">Forget Password? </a><br>
            <a href="signup.php">Don't have an account?</a>
        </form>
    </div>


</body>
</html>

<script>
    function togglePasswordVisibility(fieldId){
    var passwordInput = document.getElementById(fieldId);
    var toggleIcon = passwordInput.nextElementSibling.querySelector("i");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("uil-eye");
        toggleIcon.classList.add("uil-eye-slash");
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("uil-eye-slash");
        toggleIcon.classList.add("uil-eye");
    }
}

    function showAlert() {
        alert("We Have Send Code To Your Email. Pls Check");
}
</script>
</body>