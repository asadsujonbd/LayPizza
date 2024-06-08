<?php 
include 'sections/db.php';


if (isset($_GET['id'])) {
  $id = $_GET['id'];
}

$deliverd = 'Yes';


$sql = pg_query($db, "select update_delivered('$id', '$deliverd');");
while ($row = pg_fetch_row($sql)) {
  session_start();
  $_SESSION['message'] = 'Successfully Deliverd';
  header("Location: orderlist.php");


  echo "<br />\n";;
}



?>