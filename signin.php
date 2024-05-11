<!DOCTYPE HTML>
<head>
<title>Login</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>

<!-- CSS Files -->
<link rel="stylesheet" href="css/signin.css">
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
    <div class="loginbox">
        <img src="images/avatar.png" class="avatar">
        <h1>Sign In</h1>
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
            <a href="forgot_password.php">Forgot password?</a><br>
            <a href="register.php">Don't have an account?</a>
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
</script>
</body>