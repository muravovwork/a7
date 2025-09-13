document.addEventListener('DOMContentLoaded', function() {
    const productContainer = document.getElementById('product-container');
    const urlParams = new URLSearchParams(window.location.search);

    let currentPage = 1;
    let id = urlParams.get('id');
    // Загрузка товаров при загрузке страницы
    loadProduct();


    function loadProduct() {
        // Ваш API endpoint
        const apiUrl = `http://api.indigo-test.ru/property-details/` + id;

        fetch(apiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Ошибка загрузки товаров');
                }
                return response.json();
            })
            .then(data => {
                if (data.product) {
                    renderProduct(data.product);
                    currentPage++;
                } else {

                    showError('123');
                }
            })
    }


    function renderProduct(product) {
        productContainer.innerHTML = (`
                             <img src="${product.image}" alt="${product.id}">
                `);
    }
});