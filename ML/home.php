<?php
session_start();
require_once 'header.php';
require 'lib/Meli/meli.php';
require 'configApp.php';

if (isset($_GET['pg'])) {
    $pg = $_GET['pg'];
} else {
    $pg = "";
}

switch ($pg) {

    case 'user'; //BRUNO R. BERNAL - 08/06/2022
        $linkPagina = 'controller/user/user.php';
        $arquivosJS = [];
        break;

    case 'add-product'; //BRUNO R. BERNAL - 08/06/2022
        $linkPagina = 'controller/product/data-form.php';
        $arquivosJS = ['js/product/product.js'];
        break;

    case 'list-products'; //BRUNO R. BERNAL - 08/06/2022
        $linkPagina = 'controller/product/list-form.php';
        $arquivosJS = ['js/product/product.js'];
        break;

    case 'list-questions'; //BRUNO R. BERNAL - 08/06/2022
        $linkPagina = 'controller/questions/list-form.php';
        $arquivosJS = ['js/questions/questions.js'];
        break;

    case 'category-suggestion'; //BRUNO R. BERNAL - 09/06/2022
        $linkPagina = 'controller/category-suggestion/list-form.php';
        $arquivosJS = ['js/category-suggestion/category-suggestion.js'];
        break;

    case 'list-orders'; //BRUNO R. BERNAL - 09/06/2022
        $linkPagina = 'controller/orders/list-orders.php';
        $arquivosJS = ['js/orders/orders.js'];
        break;

    default: //BRUNO R. BERNAL - 08/06/2022
        $linkPagina = 'controller/home/home.php';
        break;
}


include_once($linkPagina);


require_once 'js.php';

foreach ($arquivosJS as $arquivoJS) { ?>
    <script src="<?= $arquivoJS; ?>"></script>
<?php }


require_once 'footer.php';
?>