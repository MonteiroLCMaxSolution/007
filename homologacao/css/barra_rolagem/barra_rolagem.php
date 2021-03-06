<style>

    /*Sistema*/

    /*Barra de rolagem*/

    ::-webkit-scrollbar-track {
        background: <?= $corPrimariaSistema ?> !important;        
    }
    ::-webkit-scrollbar-thumb {
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

    /*Editar mesa / pdv*/
    section.table div.product-single-img,
    section.pdv div.product-single-img{
        border: 2px solid <?= $corPrimariaSistema ?>;
    }
    section.table div.product-single-content,
    section.pdv div.product-single-content{
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

    /*Editar mesa / pdv*/
    section.table div.product-single-title h2,
    section.table div.product-single-price h3,
    section.pdv div.product-single-title h2,
    section.pdv div.product-single-title h3{
        color: <?= $corTexto ?>;
    }

    /*pdv*/
    section.pdv div.pdv-add-cart-icon,
    section.pdv div.pdv-painel-comanda div.partial-payment div.btn-single button,
    section.pdv div.pdv-painel-comanda-table table td i,
    section.pdv div.pdv-painel-mesa-table table td i{
        background-color: <?= $corSecundariaSistema ?>;
    }

</style>