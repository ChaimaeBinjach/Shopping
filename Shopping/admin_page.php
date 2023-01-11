<?php
include 'config.php';

session_start();
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:login.php');
}
// include 'config.php';

// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }
// $admin_id = $_SESSION['admin_id'];
// if (!$admin_id) {
//     header('location: login.php');
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- custom admin css file link -->
    <link rel="stylesheet" href="css/admin_style.css">
</head>

<body>

    <?php
    include 'admin_header.php';

    ?>
</body>

</html>