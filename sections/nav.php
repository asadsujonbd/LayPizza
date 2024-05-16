<nav class="navbar" role="navigation" aria-label="main navigation" style="background: #f14668;">
  <div class="navbar-brand">
    <a class="navbar-item" href="/laypizza/index.php">
      <h1 style=" color: #CEF0D4; font-family: 'Rouge Script', cursive; font-weight: bold; text-shadow: 1px 1px 2px #082b34; font-style: italic; ">LayPizza</h1>
    </a>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>
  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      
      <?php if (basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'index') {   ?>
            <a class="navbar-item" href="order.php">  Order Now  </a>
            <a class="navbar-item" href="orderlist.php">  Pizza Baker  </a>
      <?php }
       elseif (basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'order' or basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'confirm') {   ?>
               <a class="navbar-item" href="/laypizza/index.php">
        Home
      </a>
     
      <?php } else { ?>
            <a class="navbar-item" href="orderlist.php">  Order List  </a>
            <a class="navbar-item" href="pizzalist.php">  Pizza  </a>
            <a class="navbar-item" href="ingredientslist.php">  Ingredients  </a>
            <a class="navbar-item" href="supplierlist.php">  Supplier  </a>

      <?php }  ?>

   
    </div>
  </div>
</nav>

