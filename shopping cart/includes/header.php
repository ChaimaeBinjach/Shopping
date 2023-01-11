<header class="header">
   <div class="container flex">
      <a href="#" class="logo">Shiny</a>

      <nav class="navbar">
         <a href="add_product.php">Add product</a>
         <a href="view_products.php">View products</a>
         <a href="orders.php">My orders</a>
         <a href="login.php">Login</a>
         <a href="logout.php">Logout</a>
         <a href="register.php">Register</a>
         <?php
         $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $count_cart_items->execute([$user_id]);
         $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="index.php" class="cart-btn">cart<span><?= $total_cart_items; ?></span></a>
      </nav>

      <div id="menu-btn" class="fas fa-bars"></div>
   </div>
</header>