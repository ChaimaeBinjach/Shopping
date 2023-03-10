<?php
// session_start();
// assuming $user_id is stored in a session variable
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}


if (isset($message)) {
    foreach ($message as $message) {
        echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
    }
}

?>

<header class="header">

    <div class="header2">
        <div class="flex">
            <a href="index.php" class="logo"><span>Shiny</span>Shop </a>
            <nav class="navbar">
                <a href="index.php">Home</a>
                <?php if (!isset($_SESSION['user_id'])) { ?>
                    <a href="login.php">Sign in </a>
                    <a href="register.php"> Sign up</a>
                <?php } ?>
                <?php
                if (isset($_SESSION['user_type'])) { ?>
                    <a href="shop.php">Shop</a>
                    <a href="orders.php">Orders</a>
                    <!-- <a href="about.php">About</a> -->
                    <a href="contact.php">Contact</a>
                    <?php
                    if (isset($_SESSION['user_type'])) {
                        if ($_SESSION['user_type'] === 'admin') { ?>
                            <a href="admin_page.php">Admin</a>
                    <?php }
                    } ?>
            </nav>
            <div class="icons">
                <!-- <div id="menu-btn" class="fas fa-bars"></div> -->
                <a href="search_page.php" class="fas fa-search"></a>

                <!-- <div id="user-btn" class="fas fa-user"></div> -->
                <?php
                    $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                    // $cart_rows_number = mysqli_num_rows($select_cart_number); 
                ?>
                <a href="cart.php"> <i class="fas fa-shopping-cart"></i> </a>
                <a href="logout.php" class="delete-btn">Logout</a>
            </div>
            <div class="user-box">
                <a href="logout.php" class="delete-btn">Logout</a>
            </div>
        <?php } ?>

        </div>
    </div>

</header>