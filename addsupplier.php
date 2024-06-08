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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = $_POST["name"];
      $address = $_POST["address"];
      $status = $_POST["status"];

      $sql = pg_query($db, "select add_supplier('$name', '$address', '$status');");
      while ($row = pg_fetch_row($sql)) {

        session_start();
       $_SESSION['message'] = 'Successfully Added';
       header("Location: supplierlist.php");


       echo "<br />\n";
     }

   }
   ?>


   <form method="post" action="">
    <div class="field">
      <label class="label">Supplier Name</label>
      <div class="control">
        <input class="input" type="text" placeholder="Name" name="name">
      </div>
    </div>

    <div class="field">
      <label class="label">Supplier Address</label>
      <div class="control">
        <input class="input" type="text" placeholder="Address" name="address">
      </div>
    </div>
    <div class="field">
      <label class="label">Status</label>
      <div class="control">
        <input class="checkbox" type="checkbox" name="status" value="0"> Show
        <input class="checkbox" type="checkbox" name="status" value="1"> Hide
      </div>
    </div>
    <div class="field is-grouped">
      <div class="control">
        <button class="button is-link">Submit</button>
      </div>

    </div>
  </form>



</div>
</section>
<?php include 'sections/footer.php'; ?> 
</body>
</html>



