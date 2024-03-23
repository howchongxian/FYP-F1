<?php


$connect = mysqli_connect("localhost", "root", "", "f1");

if(!$connect)
{
  die("Connection failed: " .mysqli_connect_error());
}

?>

<?php
  $sname = "localhost";
  $uname = "root";
  $password = "";

  $db_name = "f1";

  $connect = mysqli_connect($sname,$uname,$password,$db_name);

  if(!$connect)
  {
    echo "Connection failed";
  }
?>