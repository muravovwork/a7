<div class="th-hero-wrapper hero-3" id="hero" data-bg-src="assets/img/hero/hero.jpg">
    <div class="container">
        <div class="row gy-5 justify-content-center">
            <div class="col-12">
                <div class="hero-style3 text-center">
                    <h1 class="hero-title text-white">
                        A7 АРЕНДА
                    </h1>
                    <form class="property-search-form" action="property-list.php">
                        <label>Недвижимость</label>
                        <div class="form-group">
                            <i class="far fa-search"></i>
                            <input class="form-control" type="text" placeholder="Введите город">
                        </div>
                        <select class="form-select">
                            <option value="category" selected="selected">Тип</option>
                            <option value="luxury">Аренда</option>
                            <option value="commercial">Покупка</option>
                        </select>
                        <select class="form-select">
                            <option value="offer_type" selected="selected">Сортировать</option>
                            <option value="popularity">Популярность</option>
                            <option value="rating">Рейтинг</option>
                            <option value="date">Дата</option>
                        </select>
                        <button class="th-btn" type="submit"><i class="far fa-search"></i> Найти</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!--======== / Hero Section ========-->
<!--==============================
Property Area 2
==============================-->
<section class="space overflow-hidden" id="property-sec">
    <div class="sec-bg-shape2-1 spin shape-mockup d-xl-block d-none" data-top="40%" data-right="1%">
        <img src="./././assets/img/shape/section_shape_2_1.jpg" alt="img">
    </div>
    <div class="sec-bg-shape2-3 jump shape-mockup d-xl-block d-none" data-bottom="35%" data-left="0%">
        <img src="./././assets/img/shape/section_shape_2_3.jpg" alt="img">
    </div>
    <div class="container-fluid p-0">
        <div class="slider-area project-slider2">
            <div class="swiper th-slider" id="projectSlider2" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"3"}}}'>
                <div class="swiper-wrapper">
                    
                </div>
            </div>
            <button data-slider-prev="#projectSlider2" class="slider-arrow slider-prev"><img src="assets/img/icon/arrow-left.svg" alt="img"></button>
        </div>
    <div class="container th-container2" >
            <div class="tab-pane fade show active" id="rent-tab-pane" role="tabpanel" aria-labelledby="rent-tab" tabindex="0">
                <div class="slider-area property-slider2 slider-drag-wrap">
                    <div class="swiper th-slider" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"},"1500":{"slidesPerView":"4"}},"spaceBetween":"32","grabCursor":"true","slideToClickedSlide":"true"}'>
                        <div class="swiper-wrapper" id="products-container"> </div>
                    </div>
                </div>
            </div>
    </div>
</section>

