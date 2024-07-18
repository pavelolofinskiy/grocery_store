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
            resultsDiv.innerHTML = '';
            lastQuery = '';
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