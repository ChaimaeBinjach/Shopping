<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_id'])) {
    header('location: login.php');
    exit;
}

if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image'];
    $image_size = $image['size'];
    $image_tmp_name = $image['tmp_name'];
    $image_folder = 'img_uploaded/';
    $allowed_ext = array('jpg', 'jpeg', 'png');
    $img_ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    if (!in_array($img_ext, $allowed_ext)) {
        $message[] = 'Invalid image file type';
    } elseif ($image_size > 20000000) {
        $message[] = 'image size is too big';
    } else {
        $select_product_name = mysqli_query($conn, "SELECT * FROM `products` WHERE name ='$name'") or die('query failed');
        if (mysqli_num_rows($select_product_name) > 0) {
            $message[] = 'Product already added';
        } else {
            $image_name = md5(time() . rand()) . '.' . $img_ext;
            $image_folder .= $image_name;
            if (move_uploaded_file($image_tmp_name, $image_folder)) {
                $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name,price, image) VALUES('$name','$price','$image_name' ) ") or die('query failed');
                if ($add_product_query) {
                    $message[] = 'Product added! Perfect.';
                } else {
                    $message[] = 'error while adding product';
                }
            } else {
                $message[] = 'error while uploading image';
            }
        }
    }
}
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
    unlink('img_uploaded/' . $fetch_delete_image['image']);
    mysqli_query($conn, "DELETE FROM `products` WHERE id ='$delete_id'") or die('query failed');
    header('location:admin_products.php');
}
if (isset($_POST['update_product'])) {

    $update_p_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_price = $_POST['update_price'];

    mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price' WHERE id = '$update_p_id'") or die('query failed');

    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_folder = 'img_uploaded/' . $update_image;
    $update_old_image = $_POST['update_old_image'];

    if (!empty($update_image)) {
        if ($update_image_size > 20000000) {
            $message[] = 'image file size is too large';
        } else {
            mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
            move_uploaded_file($update_image_tmp_name, $update_folder);
            unlink('img_uploaded/' . $update_old_image);
        }
    }

    header('location:admin_products.php');
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

    <!-- show products -->
    <section class="show-products">

        <div class="box-container">

            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                    <div class="box">
                        <img src="img_uploaded/<?php echo $fetch_products['image']; ?>" alt="">
                        <div class="name"><?php echo $fetch_products['name']; ?></div>
                        <div class="price"><?php echo $fetch_products['price']; ?>€</div>
                        <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-sub">update</a>
                        <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-sub" onclick="return confirm('are you sure you want to delete it?');">delete</a>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </section>

    <section class="edit-product-form">

        <?php
        if (isset($_GET['update'])) {
            $update_id = mysqli_real_escape_string($conn, $_GET['update']);
            $update_query = "SELECT * FROM `products` WHERE id = '$update_id'";
            $result = mysqli_query($conn, $update_query);

            if (!$result) {
                die("query failed: " . mysqli_error($conn));
            } elseif (mysqli_num_rows($result) > 0) {
                while ($fetch_update = mysqli_fetch_assoc($result)) {
        ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
                        <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
                        <img src="img_uploaded/<?php echo $fetch_update['image']; ?>" alt="">
                        <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="Enter product name">
                        <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="Enter product price">
                        <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
                        <input type="submit" value="update" name="update_product" class="sub">
                        <input type="reset" value="cancel" id="close-update" class="option-sub">
                    </form>
        <?php
                }
            }
        } else {
            echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
        }
        ?>


    </section>





    <!-- custom admin js file link -->
    <script src="javas/admin_script.js"></script>

</body>

</html>