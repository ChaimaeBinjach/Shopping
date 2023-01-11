<?php

try {
    require_once 'utils/init.php';
} catch (Throwable $exp) {
}

if (isset($user)) {
    setcookie('auth', null, -1);
    $query = $pdo->prepare("UPDATE users SET auth_token = null, auth_expire = null WHERE id = ?");
    $query->execute([$user['id']]);
}

header("Location: index.php");