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

   
      	<h1 class="title">
      		Ingredients List
      	</h1>
        <a class="button is-link is-outlined" href="addingredients.php">Add Ingredients</a>
        <br><br>

        <?php 
        session_start();
        if(!empty($_SESSION['message'])) {
          $message = $_SESSION['message']; 
          ?>

            <div class="messagealert">
              <p><?php  echo $message;    ?> </p>
            </div>
          <?php 
          session_destroy();
        }
        ?>


      	<?php 
      	$sql = pg_query($db, "select * from show_ingredients()");

      	?>

      	<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
      		<tr>
      			<th>Name</th>
      			<th>Quantity</th>
      			<th>Price</th>
            <th>Provenance</th>
            <th>Supplier</th>
      			<th>Status</th>
      			<th>Action</th>

      		</tr>
      		<?php while ($row = pg_fetch_assoc($sql)) {
      			?>
      			<tr>
      				<td><?php echo $row['i_name']; ?></td>
      				<td><?php echo $row['i_quantity']; ?></td>
      				<td><?php echo $row['i_price']; ?></td>
              <td><?php echo $row['i_provenance']; ?></td>
               <td><?php echo $row['s_name']; ?></td>
      				<td>  <?php if ($row['i_status'] == 't' ) { ?> Hide  <?php } else {  ?> Show  <?php } ?> </td>
      				<td><a href="updateingredients.php?id=<?php echo $row['id']; ?>" class="button is-link is-small" style="margin: 5px 5px">Update</a>
      					<a href="deleteingredients.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this?');" class="button is-link is-danger" style="margin: 5px 5px">Delete</a>
                <?php if ($row['i_quantity'] == '0') { ?> 
                <a  href="restcokingredients.php?id=<?php echo $row['id']; ?>" class="button is-link is-small" style="margin: 5px 5px">Restcok</a>
                <?php } ?>
      				</td>
      				
      			</tr>
      		<?php } ?>
      	</table>

  


    </div>
  </section>

  <?php include 'sections/footer.php'; ?> 

  </body>
</html>



