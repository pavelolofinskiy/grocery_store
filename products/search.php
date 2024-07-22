<link rel="stylesheet" type="text/css" href="/assets/css/header.css">

<?php
include __DIR__ . '/../includes/db.php';


$query = $_POST['query'];

$sql = "SELECT id, name FROM products WHERE name LIKE ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(['%' . $query . '%']);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


if (empty($results)) {
    echo '<div class="result-item"><a href="/products/list.php"> No results found. Go to products page. </a></div>';
} else {
    foreach ($results as $result) {
        echo '<div class="result-item"><a href="/products/product_view.php?id=' . $result['id'] . '">' . htmlspecialchars($result['name']) . '</a></div>';
    }
}
?>
