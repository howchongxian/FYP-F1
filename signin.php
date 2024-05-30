<!DOCTYPE HTML>
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- CSS Files -->
    <link rel="stylesheet" href="css/signin.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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

        // Check for error parameter and show alert
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('error')) {
            alert(urlParams.get('error'));
        }
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
                    <i class="fas fa-eye"></i>
                </span>
            </div>
            <input type="submit" value="Login" name="submit">
            <a href="forgot_password.php">Forgot password?</a><br>
            <a href="register.php">Don't have an account?</a>
        </form>
    </div>

    <script>
        function togglePasswordVisibility(fieldId){
            var passwordInput = document.getElementById(fieldId);
            var toggleIcon = passwordInput.nextElementSibling.querySelector("i");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
