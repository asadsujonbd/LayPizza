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

  	$sql = pg_query($db, "select delete_supplier('$id');");

  	while ($row = pg_fetch_row($sql)) {
  		session_start();
     $_SESSION['message'] = 'Successfully Deleted';
     header("Location: supplierlist.php");


     echo "<br />\n";
   }


   ?>


 </div>
</section>
<?php include 'sections/footer.php'; ?> 
</body>
</html>



