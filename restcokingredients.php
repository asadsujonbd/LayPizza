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



    ?>
    


    <?php 
     $supplierlist = pg_query($db, "select * from selected_supplier()");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $quantity = $_POST["quantity"];
      $provenance = $_POST["provenance"];
      $supplier_id = $_POST["supplier_id"];

      $sql = pg_query($db, "select restock_ingredients('$id', '$quantity', '$provenance', '$supplier_id');");
      while ($row = pg_fetch_row($sql)) {
       session_start();
       $_SESSION['message'] = 'Successfully Restcok';
       header("Location: ingredientslist.php");


       echo "<br />\n";
    }




  }
  ?>


  <form method="post" action="">
   
    <div class="field">
      <label class="label">Restcok quantity</label>
      <div class="control">
        <input class="input" type="text" placeholder="Quantity"  name="quantity">
      </div>
    </div>

     <div class="field">
      <label class="label">Provenance</label>
      <div class="control">
        <input class="input" type="text" placeholder="Provenance" name="provenance" >
      </div>
    </div>

    <div class="field">
      <label class="label">Supplier</label>
      <div class="control">
        <select class="input" name="supplier_id">
          <option selected disabled="">Select Supplier</option>
          <?php while ($row = pg_fetch_assoc($supplierlist)) { ?>
          <option value="<?php  echo $row['id'] ?>"> <?php  echo $row['s_name'] ?> </option>
          <?php } ?>
        </select>
      </div>
    </div>



    <div class="field is-grouped">
      <div class="control">
        <button class="button is-link">Restcok</button>
      </div>
   
    </div>
  </form>



</div>
</section>
<?php include 'sections/footer.php'; ?> 
</body>
</html>



