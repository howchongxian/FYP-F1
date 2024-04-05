<?php include("dataconnection.php"); ?>

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
    <ol>
      <li><a href="nivo.html">Nivo Slider</a></li>
      <li><a href="ei-slider.html">EI Slider</a></li>
      <li><a href="fullscreen-gallery.html">Fullscreen Slider</a></li>
      <li><a href="image-frontpage.html">Static Image</a></li>
    </ol>
  </li>
  <!-- end sub menu -->
  <li><a href="#">Pages</a>
    <!-- sub menu -->
    <ol>
      <li><a href="magazine.html">Magazine</a></li>
      <li><a href="blog.html">Blog</a></li>
      <li><a href="full-width.html">Full Width Page</a></li>
      <li><a href="columns.html">Columns</a></li>
    </ol>
  </li>
  <!-- end sub menu -->
  <li><a href="elements.html">Elements</a></li>
  <li><a href="#">Galleries</a>
    <!-- sub menu -->
    <ol>
      <li><a href="gallery-simple.html">Simple</a></li>
      <li><a href="portfolio.html">Filterable</a></li>
      <li><a href="gallery-fader.html">Fade Scroll</a></li>
      <li><a href="video.html">Video</a></li>
      <li class="last"><a href="photogrid.html">PhotoGrid</a></li>
    </ol>
  </li>
  <!-- end sub menu -->
  <li><a href="contact.html">Contact</a></li>
</ol>
<div id="container">
  <div id="site_title"><a href="index.html"><img src="img/logo.png" alt=""></a></div>
  <h1>Feedback</h1>

  <div class="feedback-form">
    <form action="comment.php" method="post">
        <label for="feedback"><br><br>Your Feedback:</label>
        <textarea id="feedback" name="feedback" required></textarea>

        <input type="submit" value="Submit Feedback">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $feedback = $_POST['feedback'];

        // 插入数据到数据库
        $sql = "INSERT INTO feedback (feedback) VALUES ('$feedback')";
        if ($connect->query($sql) === TRUE) {
            echo "Submitted Feedback";
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    }
    ?>
</div>

    <div class="feedback-list">
            <table class="feedback-table" border="1" width="700px" height="100px">
                <tr>
                    <th>Feedback No.</th>
                    <th>Feedback</th>
                </tr>
    
                <?php
                
                $result = mysqli_query($connect, "select * from feedback");	
                while($row = mysqli_fetch_assoc($result))
                    {
                        
                    ?>			
    
                    <tr>
                        <td><?php echo $row["feedback_no."];?></td>
                        <td><?php echo $row["feedback"]; ?></td>
                    </tr>
                    <?php
                    
                    }		
                
                ?>
    
                
            </table>
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