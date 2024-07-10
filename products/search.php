<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets\css\main.css">
</head>

<?php
include '../includes/header.php';
include '../includes/db.php';



$productName = $_GET['name'];


$sql = "SELECT * FROM products WHERE name = ?";
$stmt = $pdo->prepare($sql);
$smtp->execute([$productName]);
$product = $stmt->fetch();




?>