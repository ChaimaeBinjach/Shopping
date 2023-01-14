<?php
include 'config.php';

session_start();
$user_id= $_SESSION['user_id'];
if(!isset($user_id)){
    header('location:login.php');
}
// include 'config.php';
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }


// $user_id = $_SESSION['user_id'];
// if (!$user_id) {
//     header('location:login.php');
//     exit;
// }
