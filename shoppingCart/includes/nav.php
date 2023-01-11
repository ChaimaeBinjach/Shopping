<!-- This code defines the structure and content of the navigation bar for the website. The navigation bar has the following elements:

A logo that, when clicked, takes the user back to the home page (index.php).
Links to various pages on the site: products, login, logout, and the user's name/email (if they are logged in).
The navigation bar is responsive and adjusts its layout on smaller screens. -->

<nav class="navbar">
    <div class="container flex">
        <a href="./" class="logo">
            <!-- <img class="nav-logo" src="assets/nav-logo.png" /> -->
        </a>
        <div class="nav-links">
            <a href="#">Products</a>
            <?php if (isset($user)) : ?>
                <a href="logout.php">Log out</a>
                <a href="#"><?= $user['fullname'] . ' ' . $user['email'] ?></a>
            <?php else : ?>
                <a href="login.php">Log in</a>
                <a href="#">Guest</a>
            <?php endif; ?>
        </div>
    </div>
    <!-- <img class="nav-tail" src="assets/nav-tail.svg" /> -->
</nav>