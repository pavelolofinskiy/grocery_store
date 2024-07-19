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

document.addEventListener('DOMContentLoaded', function() {
    const searchContainer = document.querySelector('.input-form');
    const overlay = document.getElementById('overlay');

    searchContainer.addEventListener('focusin', function() {
        overlay.classList.add('active');
        searchContainer.classList.remove('focus-without');
        searchContainer.classList.add('focus-within');
    });

    searchContainer.addEventListener('focusout', function() {
        overlay.classList.remove('active');
        searchContainer.classList.remove('focus-within');
        searchContainer.classList.add('focus-without');
    });

});

