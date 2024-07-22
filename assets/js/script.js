document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('item_name');
    const resultsDiv = document.getElementById('results');
    let lastQuery = '';


    function performSearch(query) {
        fetch('/products/search.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'query=' + encodeURIComponent(query)
        })
        .then(response => response.text())
        .then(data => {
            resultsDiv.innerHTML = data;
            resultsDiv.style.display = 'block'; 
        });
    }


    searchInput.addEventListener('keyup', function() {
        const query = searchInput.value;
        if (query.length > 0) {
            performSearch(query);
            lastQuery = query; 
        } else {
            resultsDiv.innerHTML = 0;
            lastQuery = 0;
            resultsDiv.style.display = 'none'; 
        }
    });


    document.addEventListener('click', function(event) {
        if (!document.querySelector('.search-container').contains(event.target)) {
            resultsDiv.style.display = 'none';
        }
    });

    searchInput.addEventListener('focus', function() {
        if (lastQuery.length > 0) {
            performSearch(lastQuery);
        }
    });
});

// Load cart content into the popup
document.addEventListener('DOMContentLoaded', function() {
    var cartButton = document.getElementById('cart-button');
    var cartPopup = document.getElementById('cart-popup');
    var closePopup = document.getElementById('close-popup');
    var cartOverlay = document.getElementById('cartOverlay');

    function openCartPopup() {
        fetch('auth_check.php')
            .then(response => response.json())
            .then(data => {
                if (data.authenticated) {
                    fetch('/cart/view.php')
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('cart-content').innerHTML = html;
                            cartOverlay.style.display = 'block';
                            cartPopup.style.display = 'flex';
                        });
                } else {
                    window.location.href = '/main/login.php'; 
                }
            })
            .catch(error => console.error('Error:', error));
    }

    cartButton.addEventListener('click', function() {
        openCartPopup();
    });

    closePopup.addEventListener('click', function() {
        cartPopup.style.display = 'none';
        cartOverlay.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === cartOverlay) {
            cartPopup.style.display = 'none';
            cartOverlay.style.display = 'none';
        }
    });
});