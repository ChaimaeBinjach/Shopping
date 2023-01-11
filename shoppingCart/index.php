<?php
try {
    require_once 'utils/init.php';

    // $categories = $pdo->query("SELECT name, url FROM product_categories");
} catch (Throwable $exp) {
}
?>
<!DOCTYPE html>
<html>

<head>
    <?= include_once 'includes/head.php' ?>
    <meta charset="utf-8">
    <title>$title</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>

<body>
    <?= include_once 'includes/nav.php' ?>
    <header>
        <!-- content-wrap -->
        <div class="header-container">
            <h1>Shopping Cart System</h1>
            <p class="subtitle">Fill your home with a piece of history</p>
            <!-- <nav>
                    <a href="index.php">Home</a>
                    <a href="index.php?page=products">Products</a>
                </nav> -->
            <!-- book-container -->
            <div class="link-icons">
                <a href="index.php?page=cart">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </div>
        </div>
    </header>
    <div class="products">
        <p>Products</p>
        <div class="products-card-container">
            <?php
            if ($error->type === 'db' || !isset($categories)) {
            ?>
                <p class="error">Could not load products. Please try again later.</p>
                <?php
            } else {
                foreach ($categories as $cat) {
                ?>
                    <div class="products-card">
                        <img src="<?= $cat['url'] ?>" />
                        <p><?= $cat['name'] ?></p>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <footer>
            <div class="content-wrapper">
                <p>&copy; $year, Shopping Cart System</p>
            </div>
        </footer>
</body>

</html>
EOT;
}
?>