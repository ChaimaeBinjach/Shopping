<?php
    try {
        require_once 'utils/init.php';

        $categories = $pdo->query("SELECT name, url FROM product_categories");
    } catch (Throwable $exp) { }
?>

<!DOCTYPE html>
<html>
    <?= include_once 'includes/head.php' ?>
    <body>
        <?= include_once 'includes/nav.php' ?>

        <div class="header-container">
            <p class="title">ANTIQUARIAN SHOP</p>
            <p class="subtitle">Fill your home with a piece of history</p>
        </div>

        <div class="book-container">
            <div class="ellipse"></div>
            <div class="left-col">
                <div class="inverse-transform">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque non eros arcu. Quisque ultricies imperdiet diam sed consectetur. Ut feugiat condimentum auctor. Nam porttitor tempor quam, a dictum velit fringilla non. Quisque orci ex, aliquam id augue eget, ultricies condimentum lorem. Nulla congue, dolor pulvinar maximus viverra, ipsum lectus aliquam orci, nec varius sem nisi at est. Aliquam maximus nec urna sit amet consequat. Proin quis orci rhoncus, ultricies justo at, aliquam odio. Aliquam placerat sem eu ex pulvinar volutpat. Vestibulum condimentum sit amet turpis et ullamcorper. Vestibulum odio nisi, vehicula non nisi ac, dictum tristique diam. Morbi commodo, elit in maximus porttitor, est erat malesuada orci, vitae viverra felis nisl a est.</p>
                    <p>Vestibulum sed nulla at nisi hendrerit placerat. Aliquam feugiat scelerisque risus sit amet vulputate. Nam nec lorem ac nisi sagittis dignissim. Aenean vestibulum ex vitae vulputate facilisis. Nullam gravida interdum ante, sed scelerisque mauris efficitur quis. Aenean eu magna sit amet libero pharetra aliquam in vel dolor. Curabitur a interdum nisl.</p>
                </div>
            </div>
            <div class="right-col">
                <div class="inverse-transform">
                    <img src="assets/book-right-img.png" />
                </div>
            </div>
        </div>

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
        </div>
    </body>
</html>
