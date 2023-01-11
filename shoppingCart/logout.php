<?php

// Include initialization file
require_once 'utils/init.php';

// If a user is logged in
if (isset($user)) {
    // Clear the 'auth' cookie
    setcookie('auth', null, -1);

    // Update the user's authentication information in the database
    $query = $pdo->prepare("UPDATE users SET auth_token = null, auth_expire = null WHERE id = ?");
    $query->execute([$user['id']]);
}

// Redirect the user to the homepage
header("Location: index.php");
