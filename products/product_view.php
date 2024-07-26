<?php
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/db.php';

$productId = $_GET['id'];

$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$productId]);
$product = $stmt->fetch();

if ($product):
?>
<link rel="stylesheet" href="/assets/css/cart_popup.css">
<link rel="stylesheet" href="/assets/css/product_view.css">
<div class="product">
    <div class="product-item">
        <h3><?php echo $product['name']; ?></h3>
        <p><?php echo $product['description']; ?></p>
        <p>Price: $<?php echo $product['price']; ?></p>
        <p>Created At: <?php echo $product['created_at']; ?></p>
        <form action="/cart/add.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" max="20" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
</div>
<button onclick="history.back()">Back to products</button>

<?php
else:
    echo "Product not found.";
endif;

include __DIR__ . '/../includes/footer.php';
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[action="/cart/add.php"]');
    const cartButton = document.querySelector('#cart-container button');
    const cartContainer = document.querySelector('#cart-popup');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(form);

        fetch('/cart/add.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Update cart item count
            document.getElementById('cart-item-count').innerText = data.cartItemCount;

            // Show updated cart items
            updateCartPopup(data.cartItems);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    // Show cart popup
    cartButton.addEventListener('click', function() {
        cartContainer.classList.toggle('visible');
    });

    // Function to update cart items in the popup
    function updateCartPopup(items) {
        const cartContent = cartContainer.querySelector('.cart-items');
        cartContent.innerHTML = ''; // Clear previous content

        items.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.classList.add('cart-item');
            itemElement.innerHTML = `
                <p>${item.name}</p>
                <p>Quantity: ${item.quantity}</p>
                <p>Price: $${item.price}</p>
                <button class="remove-item" data-id="${item.id}">Remove</button>
            `;
            cartContent.appendChild(itemElement);
        });
    }
});
</script>