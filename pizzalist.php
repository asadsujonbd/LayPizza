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
      		Pizza List
      	</h1>
        <a class="button is-link is-outlined" href="addpizza.php">Add</a>
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
      	$sql = pg_query($db, "select * from show_pizza()");

      


      	?>

      	<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
      		<tr>
      			<th>Size</th>
            <th>Price</th>
      			<th>Action</th>

      		</tr>
      		<?php while ($row = pg_fetch_assoc($sql)) {
      			?>
      			<tr>
      				<td><?php echo $row['p_size']; ?></td>
      				<td><?php echo $row['p_price'] ?></td>
      				<td><a href="updatepizza.php?id=<?php echo $row['id']; ?>" class="button is-link is-small" style="margin: 5px 5px">Update</a>
      					<a href="deletepizza.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this?');" class="button is-link is-danger" style="margin: 5px 5px">Delete</a>
      				</td>
      				
      			</tr>
      		<?php } ?>
      	</table>

  


    </div>
  </section>

  <?php include 'sections/footer.php'; ?> 


 

  </body>


 </html>
