class CardsLoader {
    constructor(containerId, apiUrl) {
        this.container = document.getElementById(containerId);
        this.apiUrl = apiUrl;
        this.currentPage = 1;
        this.isLoading = false;
        this.hasMore = true;

        this.init();
    }

    init() {
        this.loadCards();
        this.setupInfiniteScroll();
    }

    async loadCards() {
        if (this.isLoading || !this.hasMore) return;

        this.isLoading = true;
        this.showLoader();

        try {
            const response = await fetch(`${this.apiUrl}?page=${this.currentPage}&limit=12`);
            const data = await response.json();

            if (data.success) {
                this.renderCards(data.data);
                this.currentPage++;
                this.hasMore = data.pagination.current_page < data.pagination.total_pages;
            }
        } catch (error) {
            console.error('Ошибка загрузки:', error);
        } finally {
            this.isLoading = false;
            this.hideLoader();
        }
    }

    renderCards(cards) {
        const fragment = document.createDocumentFragment();

        cards.forEach(card => {
            const cardElement = this.createCardElement(card);
            fragment.appendChild(cardElement);
        });

        this.container.appendChild(fragment);
    }

    createCardElement(card) {
        const cardDiv = document.createElement('div');
        cardDiv.className = 'col-md-6 col-xl-4';
        cardDiv.innerHTML = `
                            <div class="property-card2">
                                <div class="property-card-thumb img-shine">
                                    <img src="${card.images}" alt="img">
                                </div>
                                <div class="property-card-details">
                                    <div class="media-left">
                                        <h4 class="property-card-title"><a href="property-details.php?id=${card.id}">${card.title}</a></h4>
                                        <h5 class="property-card-price">Площадь: ${card.area} ${card.areaUnit}</h5>
                                        <p class="property-card-location">${card.city}, ${card.address}</p>
                                    </div>
                                    <div class="btn-wrap">
                                        <a href="property-details.php?id=${card.id}" class="th-btn style-border2 th-btn-icon">Подробнее</a>
                                    </div>
                                </div>
                            </div>
        `;

        // Добавляем обработчик клика
        cardDiv.addEventListener('click', () => this.openCardDetail(card.id));

        return cardDiv;
    }

    getImageUrl(imagePath) {
        if (!imagePath) return '/images/placeholder.jpg';
        if (imagePath.startsWith('http')) return imagePath;
        return `/api/images/${imagePath}`;
    }

    formatPrice(price) {
        return new Intl.NumberFormat('ru-RU').format(price);
    }

    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    setupInfiniteScroll() {
        window.addEventListener('scroll', () => {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 500) {
                this.loadCards();
            }
        });
    }

    showLoader() {
        // Показываем индикатор загрузки
    }

    hideLoader() {
        // Скрываем индикатор загрузки
    }

    openCardDetail(cardId) {
        // Открываем детальную страницу
        window.location.href = `property-details.php?id=${cardId}`;
    }
}

// Использование
const cardsLoader = new CardsLoader('cards-container', 'http://api.indigo-test.ru/api/properties');