document.addEventListener('DOMContentLoaded', function() {
    const productContainer = document.getElementById('property-container');
    const urlParams = new URLSearchParams(window.location.search);

    let currentPage = 1;
    let id = urlParams.get('id');
    // Загрузка товаров при загрузке страницы
    loadProduct();


    function loadProduct() {
        // Ваш API endpoint
        const apiUrl = `http://api.indigo-test.ru/api/properties/` + id;
        fetch(apiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Ошибка загрузки товаров');
                }
                return response.json();
            })
            .then(data => {
                if (data.data) {
                    renderProduct(data.data);
                    currentPage++;
                } else {

                    showError('123');
                }
            })
    }


    function renderProduct(property) {
        console.log(property);
        productContainer.innerHTML = (`
                            <div class="slider-area property-slider1">
                <div class="swiper th-slider mb-4" id="propertySlider" data-slider-options='{"effect":"fade","loop":true,"thumbs":{"swiper":".property-thumb-slider"},"autoplayDisableOnInteraction":"true"}'>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="property-slider-img">
                                <img src="${property.images}" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper th-slider property-thumb-slider" data-slider-options='{"effect":"slide","loop":true,"breakpoints":{"0":{"slidesPerView":2},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"3"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}},"autoplayDisableOnInteraction":"true"}'>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="property-slider-img">
                                <img src="${property.images}" alt="Image" width="300">
                            </div>
                        </div>
                    </div>
                </div>

                <button data-slider-prev="#propertySlider" class="slider-arrow style3 slider-prev"><img src="assets/img/icon/arrow-left.svg" alt="icon"></button>
                <button data-slider-next="#propertySlider" class="slider-arrow style3 slider-next"><img src="assets/img/icon/arrow-right.svg" alt="icon"></button>
            </div>
            <div class="row gx-30">
                <div class="col-xxl-8 col-lg-7">
                    <div class="property-page-single">
                        <div class="page-content">
                            <div class="property-meta mb-30">
                                <img src="assets/img/icon/calendar.svg" alt="img">05 Jun, 2024
                            </div>
                            <h2 class="page-title">${property.title}</h2>
                            <p class="mb-30">${property.description}</p>
                            <h2 class="page-title mb-20">Property Overview</h2>
                            <ul class="property-grid-list">
                                <li>
                                    <div class="property-grid-list-icon">
                                        <img src="assets/img/icon/property-single-icon1-1.svg" alt="img">
                                    </div>
                                    <div class="property-grid-list-details">
                                        <h4 class="property-grid-list-title">ID.</h4>
                                        <p class="property-grid-list-text">#${property.id}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-grid-list-icon">
                                        <img src="assets/img/icon/property-single-icon1-2.svg" alt="img">
                                    </div>
                                    <div class="property-grid-list-details">
                                        <h4 class="property-grid-list-title">Тип</h4>
                                        <p class="property-grid-list-text"> ${property.type}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-grid-list-icon">
                                        <img src="assets/img/icon/property-single-icon1-3.svg" alt="img">
                                    </div>
                                    <div class="property-grid-list-details">
                                        <h4 class="property-grid-list-title">Площадь</h4>
                                        <p class="property-grid-list-text">${property.area} ${property.areaUnit}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="property-grid-list-icon">
                                        <img src="assets/img/icon/property-single-icon1-4.svg" alt="img">
                                    </div>
                                    <div class="property-grid-list-details">
                                        <h4 class="property-grid-list-title">Город</h4>
                                        <p class="property-grid-list-text">${property.city} </p>
                                    </div>
                                </li>


                            </ul>


                            <div class="row align-items-center justify-content-between">
                                <div class="col-lg-auto">
                                    <h3 class="page-title mt-50 mb-30">Floor Plan</h3>
                                </div>
                                <div class="col-lg-auto">
                                    <ul class="nav nav-tabs property-tab mt-50" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="floor-tab1" data-bs-toggle="tab" data-bs-target="#floor-tab1-pane" type="button" role="tab" aria-controls="floor-tab1-pane" aria-selected="true">First Floor</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="floor-tab2" data-bs-toggle="tab" data-bs-target="#floor-tab2-pane" type="button" role="tab" aria-controls="floor-tab2-pane" aria-selected="false">Second Floor</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="floor-tab3" data-bs-toggle="tab" data-bs-target="#floor-tab3-pane" type="button" role="tab" aria-controls="floor-tab3-pane" aria-selected="false">Third Floor</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="floor-tab4" data-bs-toggle="tab" data-bs-target="#floor-tab4-pane" type="button" role="tab" aria-controls="floor-tab4-pane" aria-selected="false">Top Garden </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="floor-tab1-pane" role="tabpanel" aria-labelledby="floor-tab1" tabindex="0">
                                    <div class="property-grid-plan">
                                        <div class="property-grid-thumb">
                                            <img src="assets/img/property/property_inner_10.jpg" alt="img">
                                        </div>
                                        <div class="property-grid-details">
                                            <h4 class="property-grid-title">First Floor </h4>
                                            <p class="property-grid-text">doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="floor-tab2-pane" role="tabpanel" aria-labelledby="floor-tab2" tabindex="0">
                                    <div class="property-grid-plan">
                                        <div class="property-grid-thumb">
                                            <img src="assets/img/property/property_inner_10.jpg" alt="img">
                                        </div>
                                        <div class="property-grid-details">
                                            <h4 class="property-grid-title">Second Floor </h4>
                                            <p class="property-grid-text">doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="floor-tab3-pane" role="tabpanel" aria-labelledby="floor-tab3" tabindex="0">
                                    <div class="property-grid-plan">
                                        <div class="property-grid-thumb">
                                            <img src="assets/img/property/property_inner_10.jpg" alt="img">
                                        </div>
                                        <div class="property-grid-details">
                                            <h4 class="property-grid-title">Third Floor </h4>
                                            <p class="property-grid-text">doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="floor-tab4-pane" role="tabpanel" aria-labelledby="floor-tab4" tabindex="0">
                                    <div class="property-grid-plan">
                                        <div class="property-grid-thumb">
                                            <img src="assets/img/property/property_inner_10.jpg" alt="img">
                                        </div>
                                        <div class="property-grid-details">
                                            <h4 class="property-grid-title">Top Garden </h4>
                                            <p class="property-grid-text">doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                `);
    }
});