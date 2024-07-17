<link rel="stylesheet" type="text/css" href="/assets/css/header.css">

<?php
include '../includes/db.php';


$query = $_POST['query'];

$sql = "SELECT id, name FROM products WHERE name LIKE ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(['%' . $query . '%']);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


foreach ($results as $result) {
    echo '<div class="result-item"><a href="/products/product_view.php?id=' . $result['id'] . '">' . htmlspecialchars($result['name']) . '</a></div>';
}

?>
