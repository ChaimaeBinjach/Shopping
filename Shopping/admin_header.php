<?php
if (isset($message) && count($message) > 0) {
    foreach ($message as $message) {
        echo '<div class="message">
            <span>' . $message . '</span>
            <i class ="time" onclick="this.parentElement.remove();"></i>
          </div>';
    }
}
?>
<header class="header">

    <div class="flex">

        <a href="admin_page.php" class="logo">Admin<span>Shiny</span></a>
        <nav class="navbar">
            <a href="admin_page.php">Home</a>
            <a href="admin_products.php">Products</a>
            <a href="admin_contacts.php">Messages</a>
            <a href="admin_users.php">Users</a>
            <a href="admin_orders.php">Orders</a>

        </nav>
        <div class="icons">
            <div id="menubtn" class="fasfa-bars"></div>
            <div id="userbtn" class="fa fa-user"></div>
        </div>

        <div class="account-box">
            <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>

        </div>

    </div>


</header>