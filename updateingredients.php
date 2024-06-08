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

      $sql = pg_query($db, "select * from get_ingredients('$id');");

      $row = pg_fetch_assoc($sql);

      $id = $row['id'];


    ?>
    


    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = $_POST["name"];
      $status = $_POST["status"];
      $price = $_POST["price"];
      $price = (double)$price;

      $sql = pg_query($db, "select update_ingredients('$id', '$name', '$price', '$status');");
      while ($row = pg_fetch_row($sql)) {
        session_start();
       $_SESSION['message'] = 'Successfully Updated';
       header("Location: ingredientslist.php");


       echo "<br />\n";;
    }




  }
  ?>


  <form method="post" action="">
    <div class="field">
      <label class="label">Ingredients Name</label>
      <div class="control">
        <input class="input" type="text" value="<?php echo $row['i_name']; ?>" name="name">
      </div>
    </div>

   
    <div class="field">
      <label class="label">Ingredients Price</label>
      <div class="control">
        <input class="input" type="text" value="<?php echo $row['i_price']; ?>" name="price">
      </div>
    </div>

    <div class="field">
      <label class="label">Status</label>
      <div class="control">
        <input class="radio" type="radio" name="status" value="0" <?php if ($row['i_status'] == 'f') { ?> checked <?php }  ?> > Show
        <input class="radio" type="radio" name="status" value="1" <?php if ($row['i_status'] == 't') { ?> checked <?php }  ?>> Hide
      </div>
    </div>


    <div class="field is-grouped">
      <div class="control">
        <button class="button is-link">Update</button>
      </div>
      <div class="control">
        <button class="button is-link is-light">Cancel</button>
      </div>
    </div>
  </form>



</div>
</section>
<?php include 'sections/footer.php'; ?> 
</body>
</html>



