<?php
include "dataconnection.php";
$id = $_GET["id"];
$sql = "DELETE FROM `user` WHERE id = $id";
$result = mysqli_query($connect, $sql);

if ($result) {
  header("Location: superadmin.php?msg=Data deleted successfully");
} else {
  echo "Failed: superadmin.php " . mysqli_error($connect);
}
