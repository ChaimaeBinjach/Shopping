<?php

$dbName = 'mysql:host=localhost;dbname=shoppingcart';
$dbUsername = 'root';
$dbPassword = '';

$conn = new PDO($dbName, $dbUsername, $dbPassword);

function createUniqueId()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 20; $i++) {
        $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
