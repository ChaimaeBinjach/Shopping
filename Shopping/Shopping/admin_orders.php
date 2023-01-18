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
if (isset($_POST['update_order'])) {

    $order_update_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];
    mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
    $message[] = 'We have updated your payment status!';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_orders.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- custom admin css file link -->
    <link rel="stylesheet" href="css/admin_style.css">
</head>

<body>

    <?php include 'admin_header.php'; ?>

    <section class="orders">

        <h1 class="title">Orders placed : </h1>

        <div class="box-container">
            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die(mysqli_error($conn));
            if (mysqli_num_rows($select_orders) > 0) {
                while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
            ?>
                    <div class="box">
                        <p> user id : <span><?= $fetch_orders['user_id'] ?></span> </p>
                        <p> placed on : <span><?= $fetch_orders['placed_on'] ?></span> </p>
                        <p> name : <span><?= $fetch_orders['name'] ?></span> </p>
                        <p> number : <span><?= $fetch_orders['number'] ?></span> </p>
                        <p> email : <span><?= $fetch_orders['email'] ?></span> </p>
                        <p> address : <span><?= $fetch_orders['address'] ?></span> </p>
                        <p> total products : <span><?= $fetch_orders['total_products'] ?></span> </p>
                        <p> total price : <span><?= $fetch_orders['total_price'] ?>€</span> </p>
                        <p> payment method : <span><?= $fetch_orders['method'] ?></span> </p>
                        <form action="" method="post">
                            <input type="hidden" name="order_id" value="<?= $fetch_orders['id'] ?>">
                            <select name="update_payment">
                                <option value="" selected disabled><?= $fetch_orders['payment_status'] ?></option>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                            <input type="submit" value="update" name="update_order" class="option-sub">
                            <a href="admin_orders.php?delete=<?= $fetch_orders['id'] ?>" onclick="return confirm('are you you want to delete this order?');" class="delete-sub">delete</a>
                        </form>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty"> Orders have not yet been placed, unfortunately!</p>';
            }
            ?>

        </div>

    </section>

    <!-- custom admin js file link -->
    <script src="javas/admin_script.js"></script>

</body>

</html>