<?php
// include 'config.php';

// session_start();

// if (isset($_SESSION['admin_id'])) {
//     $admin_id = $_SESSION['admin_id'];
// } elseif (!isset($_SESSION['admin_id'])) {

//     header('location:login.php');
// }
include 'config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$admin_id = $_SESSION['admin_id'];
if (!$admin_id) {
    header('location: login.php');
    exit;
}
if (isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'img_uploaded/' . $image;

    $select_product_name = mysqli_query($conn, "SELECT * FROM `products` WHERE name ='$name'") or die('query failed');

    if (mysqli_num_rows($select_product_name) > 0) {
        $message[] = 'Product already added';
    } else {
        $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name,price, image) VALUES('$name','$price','$image' ) ") or die('query failed');

        if ($add_product_query) {
            if ($image_size > 200000) {
                $message[] = 'image size is too big';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'Produced added! Perfect.';
            }
        } else {
            $message[] = 'Unfortunately.. The product is not added!';
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
    <title>Products</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- custom admin css file link -->
    <link rel="stylesheet" href="css/admin_style.css">
</head>

<body>

    <?php
    include 'admin_header.php'; ?>
    <!-- product crud section starts -->



    <secttion class="add-product">
        <h1 class="title">Shiny products</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <h2>Add new product</h2>
            <input type="text" class="box" name="name" placeholder="Enter Product Name..." required>
            <input type="number" class="box" min="0" name="price" placeholder="Enter Product Price..." required>
            <input type="file" name="image" accept="image/jpg, image/png, image/jpeg" class="box" required>
            <input type="submit" value="add product" name="add_product" class="sub">
        </form>
    </secttion>

    <!-- product crud section ends -->







    <!-- custom admin js file link -->
    <script src="javas/admin_script.js"></script>

</body>

</html>