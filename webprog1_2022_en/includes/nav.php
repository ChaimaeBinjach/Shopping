

<nav class="navbar">
    <div class="link-container">
        <a href="./">
            <img class="nav-logo" src="assets/nav-logo.png" />
        </a>
        <div class="links-right">
            <a href="#">Products</a>
            <a href="login.php">Log in</a>
            <a href="logout.php">Log out</a>
            <a href="#"><?= isset($user) ? $user['fname'].' '.$user['lname'] : 'Guest' ?></a>
        </div>
    </div>
    <img class="nav-tail" src="assets/nav-tail.svg" />
</nav>