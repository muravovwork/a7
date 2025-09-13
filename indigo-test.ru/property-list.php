<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <?php require_once('src/common/head.php'); ?>
</head>

<body class="bg-light">
    <!--********************************
   		Code Start From Here
	******************************** -->

    <!--==============================
     Preloader
    ==============================-->
    <?php require_once('src/common/preloader.php'); ?>

    <!--==============================
    Mobile Menu
    ============================== -->
    <?php require_once('src/common/mobile-menu.php'); ?>

    <!--==============================
    Sidemenu
    ============================== -->
    <?php require_once('src/common/sidemenu.php'); ?>

    <!--==============================
     Header Area
    ==============================-->
    <?php require_once('src/common/header.php'); ?>

  <!--==============================
    Property Page Area
    ==============================-->
    <section class="space-top space-extra-bottom">
        <div class="container">
            <div class="tab-content">
                    <div class="container">
                        <div class="row gy-5 justify-content-center">
                            <div class="col-12">
                                    <form class="property-search-form" action="property-list.php" method="get">
                                        <label>Недвижимость</label>
                                        <div class="form-group">
                                            <i class="far fa-search"></i>
                                            <select id="street" name="street" required
                                                    data-url="/api/streets"
                                                    data-search-param="query">
                                                <option value="">Выберите улицу...</option>
                                                <!-- Опции будут добавлены через JavaScript -->
                                            </select>
                                            <div class="loading-indicator" style="display: none;">
                                                <div class="spinner"></div>
                                                <span>Загрузка...</span>
                                            </div>
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
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade active show" id="tab-list" role="tabpanel" aria-labelledby="tab-shop-list">
                        <div class="row gy-40" id="cards-container">
                        </div>
                    </div>
                </div>

        </div>
    </section>

   <!--==============================
	Footer Area
    ==============================-->
    <?php require_once('src/common/footer.php'); ?>

    <!--********************************
			Code End  Here
	******************************** -->

    <!-- Scroll To Top -->
    <div class="scroll-top">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
        </svg>
    </div>

    <!--==============================
    All Js File
============================== -->
    <!-- Jquery -->
    <script src="assets/js/vendor/jquery-3.7.1.min.js"></script>
    <!-- Swiper Js -->
    <script src="assets/js/swiper-bundle.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Magnific Popup -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Counter Up -->
    <script src="assets/js/jquery.counterup.min.js"></script>
    <!-- Range Slider -->
    <script src="assets/js/jquery-ui.min.js"></script>
    <!-- Isotope Filter -->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <!-- Gsap -->
    <script src="assets/js/gsap.min.js"></script>

    <!-- Main Js File -->
    <script src="assets/js/main.js"></script>

    <!-- Hero -->
    <script src="assets/js/property-list.js"></script>




</body>

</html>