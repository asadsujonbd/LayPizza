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
   $sql = pg_query($db, "select * from show_pizza()");
   $ingredientslist = pg_query($db, "select * from selected_ingredients()");


   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pizza_id = $_POST["pizza_id"];
    $ingredients_id =  implode ( "', '", $_POST['ingredients_id'] );
    

    
    




    $sql = pg_query($db, "select orders($pizza_id,  array['$ingredients_id'] );");


    if ($sql) {
      header("Location: /amd/confirm.php");
   }




 }

 ?>

 <form method="post" action="" id="myForm">

  <div class="columns">
    <div class="column">
      <h1 class="title">
        Order Pizza
      </h1>

      <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <tr>
          <th>Size</th>
          <th>Price</th>
          <th>Add</th>

        </tr>
        <?php while ($row = pg_fetch_assoc($sql)) {
          ?>
          <tr>
            <td class="p_size<?php echo $row['id']; ?>"><?php echo $row['p_size']; ?></td>
           
            <td class="p_price<?php echo $row['id']; ?>"><?php echo $row['p_price']; ?></td>
            <td>  <input type="checkbox" class="pchecked" name="pizza_id" value="<?php echo $row['id']; ?>"> 

            </td>

          </tr>
        <?php } ?>
      </table>

    </div>

    <div class="column">
      <h1 class="title">
        Add Ingredients
      </h1>

      <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <tr>
          <th>Ingredients Name</th>
          <th>Provenance</th>
          <th>Price</th>
          <th>Action</th>

        </tr>
        <?php while ($row = pg_fetch_assoc($ingredientslist)) { ?>
          <tr>
            <td class="i_name<?php echo $row['id']; ?>"><?php echo $row['i_name']; ?></td>
            <td class="i_provenance<?php echo $row['id']; ?>"><?php echo $row['i_provenance']; ?></td>
            <td class="i_price<?php echo $row['id']; ?>"><?php echo $row['i_price']; ?></td>
            <td>
              Add <input type="checkbox" name="ingredients_id[]" class="ichecked" value="<?php echo $row['id']; ?>"> 
            </td>
          </tr>
        <?php } ?>
      </table>

      <div class="field is-grouped">
        <div class="control">
          <button class="button is-link addorder">Order</button>
        </div>

      </div>

    </div>
  </div>



</form>



<div class="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Your Order Deatils</p>
      <button class="delete cancelorder" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
       <h1>Pizza Size : <span class="psize"></span> </h1> 
      <br>
      <h1> Ingredients : <span class="iname"></span> </h1>
      <br>
      <h1> Total Price : <span class="tprice"></span> </h1> 
      <br>
    </section>
    <footer class="modal-card-foot">
      <button class="button is-success confirmorder">Confirm</button>
      <button class="button cancelorder">Cancel</button>
    </footer>
  </div>
</div>




</div>
</section>

<?php include 'sections/footer.php'; ?> 

</body>
</html>


 <script type="text/javascript">
    $(document).ready(function() {
        
        $(".addorder").click(function(event) {  

            event.preventDefault();
            $('.modal').addClass("is-active");

        });


        $(".cancelorder").click(function(event) {  
            event.preventDefault();
            $('.modal').removeClass("is-active");     
        });

         $(".confirmorder").click(function(event) {  
         
            $("#myForm").submit();    
        });


    });
  </script>


  <script type="text/javascript">
    $(document).ready(function() {
      
      $(document).on('click', '.pchecked', function() {      
        $('.pchecked').not(this).prop('checked', false);      
      });

      })
  </script>

   <script type="text/javascript">
    $(document).ready(function() {

      var totalprice = 0;
      var i_name = "";
        
        $(".pchecked").change(function(){ 
        if( $(this).is(":checked") ){ 
            var val = $(this).val();
            var size = $(".p_size"+val).html();
            $(".psize").html(size)

          
            var price = $(".p_price"+val).html();
            totalprice = parseFloat(price);
            $(".tprice").html(totalprice)
          
          }
        });


       

        $(".ichecked").change(function(){ 

          if( $(this).is(":checked") ){ 
            var val = $(this).val();
            var name = $(".i_name"+val).html();
            $(".iname").html(name)

            var tprice = $(".i_price"+val).html();
            totalprice = totalprice + parseFloat(tprice)

            $(".tprice").html(totalprice)
            
             i_name =  name.concat(", ").concat(i_name);




          }


          i_name = i_name.replace(/,(?=\s*$)/, '');

          $(".iname").html(i_name)


        });


        


    });
  </script>