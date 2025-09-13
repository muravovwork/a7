document.addEventListener('DOMContentLoaded', function() {
    const productsContainer = document.getElementById('news-container');
    const loadMoreContainer = document.getElementById('load-more-container');
    const loadMoreBtn = document.getElementById('load-more-btn');

    let currentPage = 1;
    let isLoading = false;
    let hasMore = true;

    // Загрузка товаров при загрузке страницы
    loadProducts();

    // Загрузка при прокрутке (опционально)
    //window.addEventListener('scroll', handleScroll);

    // Кнопка "Загрузить еще"
    loadMoreBtn.addEventListener('click', loadMoreProducts);

    function loadProducts() {
        if (isLoading || !hasMore) return;

        isLoading = true;
        showLoading();

        // Ваш API endpoint
        const apiUrl = `http://api.indigo-test.ru/api/news?page=1&limit=10`;

        fetch(apiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Ошибка загрузки карточек');
                }
                return response.json();
            })
            .then(data => {
                if (data.data) {
                    renderProducts(data.data);
                    currentPage++;
                } else {
                    showNoProducts();
                }
            })
            .catch(error => {
                showError(error.message);
            })
            .finally(() => {
                isLoading = false;
                hideLoading();
            });
    }

    function loadMoreProducts() {
        loadProducts();
    }

    function handleScroll() {
        // Загрузка при достижении низа страницы
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 500) {
            loadProducts();
        }
    }

    function renderProducts(products) {
        const productsHTML = products.map(news => `
                              <div class="swiper-slide">
                        <div class="blog-card style1">
                            <div class="blog-img">
                                <a href="blog-details.html">
                                    <img src="${news.imageUrl}" alt="blog image">
                                </a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <a href="blog.html">${news.createdAt}</a>
                                </div>
                                <h3 class="box-title"><a href="blog-details.html">${news.title}</a></h3>
                                <br>
                                <a href="blog-details.html" class="th-btn style-border2 th-btn-icon">Подробнее</a>
                            </div>
                        </div>
                    </div>
                     

                `).join('');

        // Убираем спиннер загрузки при первой загрузке
        if (currentPage === 1) {
            productsContainer.innerHTML = productsHTML;
        } else {
            productsContainer.insertAdjacentHTML('beforeend', productsHTML);
        }
    }

    function formatPrice(price) {
        return new Intl.NumberFormat('ru-RU').format(price);
    }

    function showLoading() {
        if (currentPage === 1) {
            productsContainer.innerHTML = `
                        <div class="loading-spinner">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Загрузка...</span>
                            </div>
                        </div>
                    `;
        } else {
            loadMoreBtn.disabled = true;
            loadMoreBtn.innerHTML = `
                        <span class="spinner-border spinner-border-sm" role="status"></span>
                        Загрузка...
                    `;
        }
    }

    function hideLoading() {
        loadMoreBtn.disabled = false;
        loadMoreBtn.textContent = 'Загрузить еще';
    }

    function showError(message) {
        productsContainer.innerHTML = `
                    <div class="col-12">
                        <div class="error-message">
                            <i class="bi bi-exclamation-triangle-fill" style="font-size: 2rem;"></i>
                            <p class="mt-2">${message}</p>
                            <button class="btn btn-primary mt-2" onclick="location.reload()">
                                Попробовать снова
                            </button>
                        </div>
                    </div>
                `;
    }

    function showNoProducts() {
        if (currentPage === 1) {
            productsContainer.innerHTML = `
                        <div class="col-12">
                            <div class="text-center py-5">
                                <p class="text-muted">Товары не найдены</p>
                            </div>
                        </div>
                    `;
        }
        hasMore = false;
        loadMoreContainer.classList.add('d-none');
    }
});