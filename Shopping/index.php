<?php

include 'config.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if (isset($_POST['add_to_cart'])) {

        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if (mysqli_num_rows($check_cart_numbers) > 0) {
            $message[] = 'The product has been added to your cart!';
        } else {
            mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
            $message[] = 'product added to cart!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>
    <section class="home">

        <div class="content">
            <h3>Welcome To <span>Shiny</span> Shop.</h3>
            <!-- <p>There are many little ways to enlarge your world. Love of books is the best of all.</p> -->
            <!-- <a href="about.php" class="white-btn">discover more</a> -->
            <div class="image">
                <img src="images/home.jpg" alt="">
            </div>
        </div>

    </section>
    <section class="home-contact">

        <div class="content">
            <h3>Do you have any question?</h3>
            <p>Whenever you have a question, don't hesitate to contact us and we'll get back to you as soon as possible </p>
            <a href="contact.php" class="white-btn">contact us</a>
        </div>

    </section>





    <?php include 'footer.php'; ?>

    <script src="js/general_script.js"></script>
</body>

</html>