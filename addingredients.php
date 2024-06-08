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


    $supplierlist = pg_query($db, "select * from selected_supplier()");



    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = $_POST["name"];
      $quantity = $_POST["quantity"];
      $price = $_POST["price"];
      $status = $_POST["status"];
      $provenance = $_POST["provenance"];
      $supplier_id = $_POST["supplier_id"];
      
      $price = (double)$price;
      $supplier_id = (int)$supplier_id;

      $sql = pg_query($db, "select add_ingredients('$name', '$quantity', '$price', '$supplier_id', '$provenance' , '$status');");
      while ($row = pg_fetch_row($sql)) {
       session_start();
       $_SESSION['message'] = 'Successfully Added';
       header("Location: ingredientslist.php");


       echo "<br />\n";
    }

      
  }
  ?>


  <form method="post" action="">
    <div class="field">
      <label class="label">Ingredients Name</label>
      <div class="control">
        <input class="input" type="text" placeholder="Name" name="name">
      </div>
    </div>


    <div class="field">
      <label class="label">Ingredients Quantity</label>
      <div class="control">
        <input class="input" type="text" placeholder="Quantity" name="quantity">
      </div>
    </div>

    <div class="field">
      <label class="label">Ingredients Price</label>
      <div class="control">
        <input class="input" type="text" placeholder="Price" name="price">
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
    <div class="field">
      <label class="label">Provenance</label>
      <div class="control">
        <input class="input" type="text" placeholder="Provenance" name="provenance">
      </div>
    </div>

    <div class="field">
      <label class="label">Status</label>
      <div class="control">
        <input class="checkbox" type="checkbox" name="status" value="0"> Show
        <input class="checkbox" type="checkbox" name="status" value="1"> Hide
      </div>
    </div>
    <br>



    <div class="field is-grouped">
      <div class="control">
        <button class="button is-link">Submit</button>
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



