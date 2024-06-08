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
          Order List
        </h1>
        <br>

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
        $sql = pg_query($db, "select * from show_order()");


        ?>

        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
          <tr>
            <th>Pizza Size</th>
            <th>Ingredients</th>
            <th>Total Price</th>
            <th>Date and Time</th>
            <th>Action</th>
          </tr>
          <?php while ($row = pg_fetch_assoc($sql)) {
            ?>
            <tr>
              <td><?php echo $row['p_size']; ?></td>
           
              <td>
                <?php echo $row['ingredients_name']; ?>
              </td>
              <td><?php echo $row['price'] ?></td>
               <td><?php  echo date('d-m-Y h:i',strtotime($row['datetime']));  ?></td>
                <td> <a class="button is-link" id="buttond" href="delivered.php?id=<?php echo $row['id']; ?>">Deliverd</a></td>

              
              
            </tr>
          <?php } ?>
        </table>

  


    </div>
  </section>

  <?php include 'sections/footer.php'; ?> 

  </body>

</html>



