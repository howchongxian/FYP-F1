<!DOCTYPE HTML>
<head>
<title>Concept | Elements</title>
<meta charset="utf-8">
<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="menu/css/simple_menu.css">
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen">
<!-- JS Files -->
<script src="js/jquery.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/slides/slides.min.jquery.js"></script>
<script src="js/cycle-slider/cycle.js"></script>
<script src="js/nivo-slider/jquery.nivo.slider.js"></script>
<script src="js/tabify/jquery.tabify.js"></script>
<script src="js/prettyPhoto/jquery.prettyPhoto.js"></script>
<script src="js/twitter/jquery.tweet.js"></script>
<script src="js/scrolltop/scrolltopcontrol.js"></script>
<script src="js/portfolio/filterable.js"></script>
<script src="js/modernizr/modernizr-2.0.3.js"></script>
<script src="js/easing/jquery.easing.1.3.js"></script>
<script src="js/kwicks/jquery.kwicks-1.5.1.pack.js"></script>
<script src="js/swfobject/swfobject.js"></script>
<!-- FancyBox -->
<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css" media="all">
<script src="js/fancybox/jquery.fancybox-1.2.1.js"></script>
</head>
<body>
<!-- Main Menu -->
<ol id="menu">
  <li class="active_menu_item"><a href="index.html" style="color:#FFF">Home</a>
    <!-- sub menu -->
  </li>
  <!-- end sub menu -->
  <li><a href="#">Latest</a>
    <!-- sub menu -->
    <ol>
      <li><a href="news.html">News</a></li>
      <li><a href="videos.html">Videos</a></li>
    </ol>
  </li>
  <!-- end sub menu -->
  <li><a href="#">Schedule & Results</a>
    <!-- sub menu -->
    <ol>
      <li><a href="schedule.html">Schedule</a></li>
      <li><a href="results.html">Results</a></li>
    </ol>
  </li>
  <li><a href="#">Drivers & Teams</a>
    <!-- sub menu -->
    <ol>
      <li><a href="driver.html">Drivers</a></li>
      <li><a href="team.html">Teams</a></li>
    </ol>
  </li>
  <!-- end sub menu -->
  <li><a href="product.php">Products</a>
    <!-- sub menu -->
    <ol>
      <li><a href="product.php">Products</a></li>
      <li><a href="shopping_cart.php">Shopping Cart</a></li>
    </ol>
  </li>
  <li><a href="#">About Us</a>
  <ol>
    <li><a href="about_us.html">About Us</a></li>
    <li><a href="contact.html">Contact Us</a></li>
  </ol>
  </li>

  <div id="login_button">
  <a href="login.html"><button>Login</button></a>
</div>
</ol>
<div id="container">
  <h1>Shopping Cart</h1>

  <table class="product-table" border="1" width="700px" height="100px">
                <tr>
                    <th>Product Code</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product size</th>
                    <th>Product Description</th>
                    <th>product Price</th>			
                </tr>
  </table>             

    <div class="cart-buttons">
      <button onclick="goBack()">Cancel</button>
      <button><a href="Payment.php">Buy</a></button>
    </div>
</div>

  <!-- END Second Column -->
  <div style="clear:both; height: 40px"></div>
</div>
<!-- close container -->
<div id="footer">
  <!-- First Column -->
  <div class="one-fourth">
    <h3>Useful Links</h3>
    <ul class="footer_links">
      <li><a href="#">Lorem Ipsum</a></li>
      <li><a href="#">Ellem Ciet</a></li>
      <li><a href="#">Currivitas</a></li>
      <li><a href="#">Salim Aritu</a></li>
    </ul>
  </div>
  <!-- Second Column -->
  <div class="one-fourth">
    <h3>Terms</h3>
    <ul class="footer_links">
      <li><a href="#">Lorem Ipsum</a></li>
      <li><a href="#">Ellem Ciet</a></li>
      <li><a href="#">Currivitas</a></li>
      <li><a href="#">Salim Aritu</a></li>
    </ul>
  </div>
  <!-- Third Column -->
  <div class="one-fourth">
    <h3>Information</h3>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet enim id dui tincidunt vestibulum rhoncus a felis.
    <div id="social_icons"> Theme by <a href="http://www.csstemplateheaven.com">CssTemplateHeaven</a><br>
      Photos © <a href="http://dieterschneider.net">Dieter Schneider</a> </div>
  </div>
  <!-- Fourth Column -->
  <div class="one-fourth last">
    <h3>Socialize</h3>
    <img src="img/icon_fb.png" alt=""> <img src="img/icon_twitter.png" alt=""> <img src="img/icon_in.png" alt=""> </div>
  <div style="clear:both"></div>
</div>
<!-- END footer -->
</body>
</html>