</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<?php include 'sections/head.php'; ?> 
  <title>LayPizza</title>
</head>
<body>

 <?php include 'sections/nav.php'; ?> 
 <?php include 'sections/db.php'; ?> 

 <section class="section">
  <div class="container">


   <?php 

   if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }

  $sql = pg_query($db, "select * from get_pizza('$id');");


  $row = pg_fetch_assoc($sql);


  $id = $row['id'];

  ?>
  

  <?php 
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $size = $_POST["size"];
    $price = $_POST["price"];
    $price = (double)$price;

    $sql = pg_query($db, "select update_pizza('$id','$size', '$price');");
    while ($row = pg_fetch_row($sql)) {

      session_start();
      $_SESSION['message'] = 'Successfully Updated';
      header("Location: pizzalist.php");


      echo "<br />\n";
    }




  }
  ?>


  <form method="post" action="">
    <div class="field">
      <label class="label">Pizza Size</label>
      <div class="control">
        <input class="input" type="text" value="<?php echo $row['p_size']; ?>" name="size">
      </div>
    </div>

    <div class="field">
      <label class="label">Pizza Price</label>
      <div class="control">
        <input class="input" type="text" value="<?php echo $row['p_price']; ?>" name="price">
      </div>
    </div>

    <div class="field is-grouped">
      <div class="control">
        <button class="button is-link">Update</button>
      </div>
    </div>
  </form>



</div>
</section>
<?php include 'sections/footer.php'; ?> 
</body>
</html>



