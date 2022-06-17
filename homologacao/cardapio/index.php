<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/plugins/checkbox/jquery.checkradios.min.css">
    <link rel="stylesheet" href="cardapio.css">
    <script src="https://kit.fontawesome.com/d8d09d30c4.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Open+Sans:wght@600&family=Ubuntu:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Cardápio</title>
</head>
<body>

    <?php
        // Modais
        require_once('modal/welcome-modal.php');
        require_once('modal/cart-modal.php');
        require_once('modal/product-modal.php');
        require_once('modal/edit-product-modal.php');
        require_once('modal/confirm-modal.php');
        require_once('modal/finished-modal.php');
    ?>

    <header>
        <div class="center flexbox">
            <div class="box-logo-header w50">
                <div class="logo-header" style="background-image: url('../images/will.png');"></div><!--logo-header-->
            </div><!--box-logo-header-->
            <div class="infos-header w50">
                <div class="infos-header-status">
                    Aberto
                </div><!--infos-header-status-->
                <div class="infos-header-contact">
                    <div class="whatsapp-contact flexbox">
                        <a href="https://api.whatsapp.com/send/?phone=5511930791534&text&app_absent=0" target="_BLANK">
                            <i class="fa-brands fa-whatsapp"></i>
                            (11) 93079-1534
                        </a>
                    </div><!--whatsapp-contact-->
                    <div class="phone-contact flexbox">
                        <a href="#">
                            <i class="fa-solid fa-phone"></i>
                            (11) 96036-8530
                        </a>
                    </div><!--phone-contact-->
                </div><!--infos-header-contact-->
            </div><!--infos-header-->
        </div><!--center-->
    </header>
    <main>
        <div class="center">
            <div class="restaurant-name">
                <h2>LC Max Alimentos</h2>
            </div><!--restaurant-name-->
            <div class="search-box flexbox">
                <input type="search" placeholder="Buscar no cardápio">
                <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </div><!--search-box-->
            <div class="categories-box flexbox">
                <div class="category-single" onclick="openProductsContainer()">
                    Sobremesas
                </div><!--category-single-->
                <div class="category-single" onclick="openProductsContainer()">
                    Salgados
                </div><!--category-single-->
                <div class="category-single" onclick="openProductsContainer()">
                    Bebidas
                </div><!--category-single-->
                <div class="category-single" onclick="openProductsContainer()">
                    Acompanhamentos
                </div><!--category-single-->
                <div class="category-single" onclick="openProductsContainer()">
                    Congelados
                </div><!--category-single-->
            </div><!--categories-box-->

            <div class="select-category">
                <h2>Selecione uma categoria acima para listar nossos produtos</h2>
            </div><!--select-category-->

            <div class="products-container">
                <div class="products-container-title">
                    <h2>Bebidas</h2>
                </div><!--products-box-title-->
                <div class="products-box flexbox">

                    <div class="product-single w50">
                        <div class="product-single-content flexbox" onclick="openProductModal()">
                            <div class="product-single-img">
                                <img src="../images/coca.jpg" alt="">
                            </div><!--product-single-img-->
                            <div class="product-single-infos">
                                <div class="product-single-title">
                                    Coca-cola 350ml
                                </div><!--product-single-title-->
                                <div class="product-single-price">
                                    <h3>A partir de</h3>
                                    R$ 7,00
                                </div><!--product-single-price-->
                            </div><!--product-single-infos-->
                        </div><!--product-single-content-->
                    </div><!--product-single-->

                    <div class="product-single w50">
                        <div class="product-single-content flexbox" onclick="openProductModal()">
                            <div class="product-single-img">
                                <img src="../images/coca4.jpg" alt="">
                            </div><!--product-single-img-->
                            <div class="product-single-infos">
                                <div class="product-single-title">
                                    Coca-cola 350ml
                                </div><!--product-single-title-->
                                <div class="product-single-price">
                                    <h3>a partir de</h3>
                                    R$ 7,00
                                </div><!--product-single-price-->
                            </div><!--product-single-infos-->
                        </div><!--product-single-content-->
                    </div><!--product-single-->

                    <div class="product-single w50">
                        <div class="product-single-content flexbox" onclick="openProductModal()">
                            <div class="product-single-img">
                                <img src="../images/coca2.jpeg" alt="">
                            </div><!--product-single-img-->
                            <div class="product-single-infos">
                                <div class="product-single-title">
                                    Coca-cola 350ml
                                </div><!--product-single-title-->
                                <div class="product-single-price">
                                    <h3>A partir de</h3>
                                    R$ 7,00 
                                </div><!--product-single-price-->
                            </div><!--product-single-infos-->
                        </div><!--product-single-content-->
                    </div><!--product-single-->

                    <div class="product-single w50">
                        <div class="product-single-content flexbox" onclick="openProductModal()">
                            <div class="product-single-img">
                                <img src="../images/coca.jpg" alt="">
                            </div><!--product-single-img-->
                            <div class="product-single-infos">
                                <div class="product-single-title">
                                    Coca-cola 350ml
                                </div><!--product-single-title-->
                                <div class="product-single-price">
                                    <h3>A partir de</h3>
                                    R$ 7,00
                                </div><!--product-single-price-->
                            </div><!--product-single-infos-->
                        </div><!--product-single-content-->
                    </div><!--product-single-->

                    <div class="product-single w50">
                        <div class="product-single-content flexbox" onclick="openProductModal()">
                            <div class="product-single-img">
                                <img src="../images/coca3.jpg" alt="">
                            </div><!--product-single-img-->
                            <div class="product-single-infos">
                                <div class="product-single-title">
                                    Coca-cola 350ml
                                </div><!--product-single-title-->
                                <div class="product-single-price">
                                    <h3>A partir de</h3>
                                    R$ 7,00
                                </div><!--product-single-price-->
                            </div><!--product-single-infos-->
                        </div><!--product-single-content-->
                    </div><!--product-single-->

                    <div class="product-single w50">
                        <div class="product-single-content flexbox" onclick="openProductModal()">
                            <div class="product-single-img">
                                <img src="../images/coca2.jpeg" alt="">
                            </div><!--product-single-img-->
                            <div class="product-single-infos">
                                <div class="product-single-title">
                                    Coca-cola 350ml
                                </div><!--product-single-title-->
                                <div class="product-single-price">
                                    <h3>a partir de</h3>
                                    R$ 7,00
                                </div><!--product-single-price-->
                            </div><!--product-single-infos-->
                        </div><!--product-single-content-->
                    </div><!--product-single-->
                    
                </div><!--products-box-->
            </div><!--products-container-->

            <div class="address">
                <div class="adress-title">
                    <h2><i class="fa-solid fa-location-dot"></i> Onde estamos</h2>
                </div><!--adress-title-->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.1973529954835!2d-46.6564943!3d-23.5613545!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce59c8da0aa315%3A0xd59f9431f2c9776a!2sAv.%20Paulista%2C%20S%C3%A3o%20Paulo%20-%20SP!5e0!3m2!1spt-BR!2sbr!4v1654118657357!5m2!1spt-BR!2sbr" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <!-- <a href="">
                    <i class="fa-solid fa-location-dot"></i>
                    Rua blabla - Vila nsei - SP, 09856-100, Brasil
                </a> -->
            </div><!--address-->

        </div><!--center-->
    </main>
    <div class="cart-icon">
        <div class="cart-icon-content" onclick="openCartModal()">
            <div class="cart-number">
                <h3>3</h3>
            </div><!--cart-number-->
            <i class="fa-solid fa-cart-shopping"></i>
        </div><!--cart-icon-content-->
    </div><!--cart-icon-->
    <footer class="flexbox">
        <div class="footer-infos">
            Copyright ©<?= date('Y'); ?> <a href="#">LC MAX SOLUTION</a>. All rights reserved
        </div><!--footer-infos-->
        <div class="footer-version">
            Versão 1.0.0
        </div><!--footer-version-->
    </footer>
    <script src="../js/plugins/jquery.min.js"></script>

    <!-- CHECKBOX PLUGIN-->
    <script src="../js/plugins/checkbox/jquery.checkradios.min.js"></script>

    <script src="cardapio.js"></script>
</body>
</html>