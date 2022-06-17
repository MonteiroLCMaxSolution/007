<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <!--CSS-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header/header.css">
    <link rel="stylesheet" href="css/sidebar/sidebar.css">
    <?php foreach($arquivosCSS as $arquivoCSS): ?>
        <link rel="stylesheet" href="<?= $arquivoCSS ?>">
    <?php endforeach; ?>

    <!--font-awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <!-- GOOGLE FONTS Open Sans -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet"> -->
    <!--GOOGLE FONTS Roboto-->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  -->

    <!--GOOGLE FONTS Montserrat-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Open+Sans:wght@600&family=Ubuntu:wght@300;400;700&display=swap" rel="stylesheet">

    <title><?= $tituloSEO ?></title>

    <?php
    
        $corPrimariaSistema = "black";
        $corSecundariaSistema = "#ffc400";
        $corTexto = "white";
    ?>

    <style>

        /*Sistema*/

        /*Barra de rolagem*/

        body::-webkit-scrollbar-track {
            background: <?= $corPrimariaSistema ?> !important;        
        }
        body::-webkit-scrollbar-thumb {
            background-color: <?= $corSecundariaSistema ?> !important;    
        }

        aside{
            background-color: <?= $corPrimariaSistema ?> !important;
        }
        header{
            background-color: <?= $corPrimariaSistema ?> !important;
        }
        table thead tr{
            background-color: <?= $corPrimariaSistema ?> !important;
        }

        /*Editar mesa*/
        section.table div.product-single-img{
            border: 2px solid <?= $corPrimariaSistema ?>;
        }
        section.table div.product-single-content{
            background-color: <?= $corPrimariaSistema ?>;
        }

        /*Texto*/

        header div.logout-header-icon i,
        header div.dashboard-icon i,
        aside div.dashboard-close-icon i{
            color: <?= $corTexto ?> !important;
        }
        header div.logout-header-icon i:hover,
        header div.dashboard-icon i:hover,
        aside div.dashboard-close-icon i:hover{
            color: <?= $corSecundariaSistema ?> !important;
        }
        aside div.dashboard-box-title-content i,
        aside div.dashboard-box-title-arrow i{
            color: <?= $corSecundariaSistema ?> !important;
        }
        aside div.dashboard-box-item-single a{
            color: <?= $corTexto ?> !important;
            transition: .3s;
        }
        aside div.dashboard-box-item-single a:hover{
            color: <?= $corSecundariaSistema ?> !important;
        }
        table th{
            color: <?= $corTexto ?> !important;
        }
        a.home-categorie-single{
            color: <?= $corTexto ?>;
            background-color: <?= $corSecundariaSistema ?>;
        }
        b{
            color: <?= $corSecundariaSistema ?> !important;
        }

        /*Editar mesa*/
        section.table div.product-single-title h2,
        section.table div.product-single-price h3{
            color: <?= $corTexto ?>;
        }

    </style>
</head>