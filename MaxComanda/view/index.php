<?php
if (!isset($_SESSION)) {
  session_start();
}

$directoryName = explode('/', $_SERVER['PHP_SELF']);
$directoryName = $directoryName[1];
if ($directoryName == 'MaxComanda') {
  $lib = '..';
  $uploads = '../../../MaxComanda/uploads';
} else {
  $lib = '../../MaxComanda';
  $uploads = '../../../' . $directoryName . '/uploads';
}
$dominio = 'https://' . $_SERVER['HTTP_HOST'] . '/' . $directoryName;
$httpDirectory = $dominio;


$_SESSION['directoryName'] = $directoryName;




?>

<!DOCTYPE html>
<html lang="pt-br">
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Painel de Controle</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $lib; ?>/lib/fontawesome-free/css/all.min.css">
  <!-- Materialize CSS -->
  <link rel="stylesheet" href="<?php echo $lib; ?>/lib/materialize-v1.0.0/css/materialize.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?php echo $lib; ?>/lib/custom/style-custom.css">
  <!-- Select 2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body class="<?php echo $_SESSION['color']; ?> lighten-4">
  <input type="text" id="directory" hidden value="<?php echo $directoryName; ?>">
  <input type="text" id="http" hidden value="<?php echo $httpDirectory; ?>">
  <input type="text" id="lib" hidden value="<?php echo $lib; ?>">
  <input type="text" id="id_user" hidden value="<?php echo $_SESSION['id_user']; ?>">
  <input type="text" id="id_company" hidden value="<?php echo $_SESSION['id_company']; ?>">
  <input type="text" id="userProfile" hidden value="<?php echo $_SESSION['userProfile']; ?>">


  <?php
  if (!empty($_GET['pg'])) {
    $pg = $_GET['pg'];
  } else {
    $pg = '';
  }



  switch ($pg) {

    case 'cashier':
      $pageName = "Caixas";
      $JS = "cashier";
      $linkPage = "$lib/controller/cashier/list-form.php";
      break;

    case 'order-counter':
      $pageName = "Pedidos - Balc??o";
      $JS = "order-counter";
      $linkPage = "$lib/controller/order-counter/list-form.php";
      break;

    case 'order-kitchen':
      $pageName = "Pedidos - Cozinha";
      $JS = "order-kitchen";
      $linkPage = "$lib/controller/order-kitchen/list-form.php";
      break;

    case 'order-table':
      $pageName = "Mesas";
      $JS = "order-table";
      $linkPage = "$lib/controller/order-table/list-form.php";
      break;

    case 'order-table-form':
      $pageName = "Pedidos - Mesa";
      $JS = "order-table";
      $linkPage = "$lib/controller/order-table/data-form.php";
      break;

    case 'supply':
      $pageName = "Listar Suprimentos";
      $JS = "supply";
      $linkPage = "$lib/controller/supply/list-form.php";
      break;

    case 'data-supply':
      $pageName = "Cadastro - Suprimentos";
      $JS = "supply";
      $linkPage = "$lib/controller/supply/data-form.php";
      break;

    case 'PDV':
      $pageName = "PDV";
      $JS = "PDV";
      $linkPage = "$lib/controller/PDV/data-form.php";
      break;

    case 'location':
      $pageName = "Listar Localiza????es";
      $JS = "location";
      $linkPage = "$lib/controller/location/list-form.php";
      break;

    case 'data-location':
      $pageName = "Cadastro - Localiza????o";
      $JS = "location";
      $linkPage = "$lib/controller/location/data-form.php";
      break;

    case 'client':
      $pageName = "Listar Clientes";
      $JS = "client";
      $linkPage = "$lib/controller/client/list-form.php";
      break;

    case 'data-client':
      $pageName = "Cadastro - Cliente";
      $JS = "client";
      $linkPage = "$lib/controller/client/data-form.php";
      break;

    case 'provider':
      $pageName = "Listar Fornecedores";
      $JS = "provider";
      $linkPage = "$lib/controller/provider/list-form.php";
      break;

    case 'data-provider':
      $pageName = "Cadastro - Fornecedor";
      $JS = "provider";
      $linkPage = "$lib/controller/provider/data-form.php";
      break;

    case 'product':
      $pageName = "Listar Produtos";
      $JS = "product";
      $linkPage = "$lib/controller/product/list-form.php";
      break;

    case 'data-product':
      $pageName = "Cadastro - Produto";
      $JS = "product";
      $linkPage = "$lib/controller/product/data-form.php";
      break;

    case 'category':
      $pageName = "Listar Categorias";
      $JS = "category";
      $linkPage = "$lib/controller/category/list-form.php";
      break;

    case 'data-category':
      $pageName = "Cadastro - Categoria";
      $JS = "category";
      $linkPage = "$lib/controller/category/data-form.php";
      break;

    case 'subcategory':
      $pageName = "Listar SubCategorias";
      $JS = "subcategory";
      $linkPage = "$lib/controller/subcategory/list-form.php";
      break;

    case 'data-subcategory':
      $pageName = "Cadastro - SubCategoria";
      $JS = "subcategory";
      $linkPage = "$lib/controller/subcategory/data-form.php";
      break;

    case 'user':
      $pageName = "Listar Usu??rios";
      $JS = "user";
      $linkPage = "$lib/controller/user/list-form.php";
      break;

    case 'data-user':
      $pageName = "Cadastro - Usu??rio";
      $JS = "user";
      $linkPage = "$lib/controller/user/data-form.php";
      break;

    case 'profile':
      $pageName = "Listar Grupo / Perfil";
      $JS = "profile";
      $linkPage = "$lib/controller/profile/list-form.php";
      break;

    case 'data-profile':
      $pageName = "Cadastro - Grupo / Perfil";
      $JS = "profile";
      $linkPage = "$lib/controller/profile/data-form.php";
      break;

    case 'data-permissions':
      $pageName = "Cadastro - Permiss??es";
      $JS = "permissions";
      $linkPage = "$lib/controller/permissions/data-form.php";
      break;

    case 'company':
      $pageName = "Listar Empresas";
      $JS = "company";
      $linkPage = "$lib/controller/company/list-form.php";
      break;

    case 'data-company':
      $pageName = "Cadastro - Empresa";
      $JS = "company";
      $linkPage = "$lib/controller/company/data-form.php";
      break;

    case 'order-sheet':
      $pageName = "Listar Comandas";
      $JS = "order-sheet";
      $linkPage = "$lib/controller/order-sheet/list-form.php";
      break;

    case 'table':
      $pageName = "Listar Mesas";
      $JS = "table";
      $linkPage = "$lib/controller/table/list-form.php";
      break;

    case 'data-table':
      $pageName = "Cadastro - Mesa";
      $JS = "table";
      $linkPage = "$lib/controller/table/data-form.php";
      break;

    case 'promotion':
      $pageName = "Listar Promo????es";
      $JS = "promotion";
      $linkPage = "$lib/controller/promotion/list-form.php";
      break;

    case 'data-promotion':
      $pageName = "Cadastro - Promo????o";
      $JS = "promotion";
      $linkPage = "$lib/controller/promotion/data-form.php";
      break;

    case 'order':
      $pageName = "Listar Pedidos";
      $JS = "order";
      $linkPage = "$lib/controller/order/list-form.php";
      break;

    case 'data-order':
      $pageName = "Cadastro - Pedido";
      $JS = "order";
      $linkPage = "$lib/controller/order/data-form.php";
      break;

    case 'cardapio':
      $pageName = "Card??pio";
      $JS = "cardapio";
      $linkPage = "$lib/controller/cardapio/index.php";
      break;

    case 'delivery':
      $pageName = "Delivery";
      $JS = "delivery";
      $linkPage = "$lib/controller/delivery/index.php";
      break;



    default:
      $JS = "dashboard";
      $linkPage = "$lib/controller/dashboard/dashboard.php";
      break;
  }


  if (!isset($_SESSION['id_user']) && ($pg != 'cardapio' && $pg != 'delivery')) {
    header("Location: https://maxcomanda.com.br/" . $directoryName . "/");
  
    die();
  }


  if ($pg != 'cardapio' && $pg != 'delivery') {

    if (empty($_GET['bloq'])) {

      include_once("header.php");
    }
  }


  if($pg != 'cardapio' && $pg != 'delivery'){
  ?>



  <div class="content-wrapper">
    <?php
    include_once($linkPage);
    ?>
  </div>

  <?php
  } else{
    include_once($linkPage);
  }

  if ($pg != 'cardapio' && $pg != 'delivery') {
    if (empty($_GET['bloq'])) {

      include_once("footer.php");
    }
  }

  ?>





  <!-- JQuery -->
  <script src="<?php echo $lib; ?>/lib/jquery-3.3.1.min.js"></script>

  <!-- JQuery Mask -->
  <script src="<?php echo $lib; ?>/lib/jquery-mask.js"></script>

  <!-- Phone Mask -->
  <script src="<?php echo $lib; ?>/lib/phone-mask.js"></script>

  <!-- CPF / CNPJ Mask -->
  <script src="<?php echo $lib; ?>/lib/cpf-cnpj-mask.js"></script>

  <!-- Busca CEP -->
  <script src="<?php echo $lib; ?>/lib/buscaCEP.js"></script>

  <!-- Busca CNPJ -->
  <script src="<?php echo $lib; ?>/lib/buscaCNPJ.js"></script>

  <!-- Valida CNPJ -->
  <script src="<?php echo $lib; ?>/lib/validaCNPJ.js"></script>

  <!-- Valida CPF -->
  <script src="<?php echo $lib; ?>/lib/validaCPF.js"></script>

  <!-- Valida Email -->
  <script src="<?php echo $lib; ?>/lib/validaEmail.js"></script>

  <!-- Select 2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <!-- Materialize JS -->
  <script src="<?php echo $lib; ?>/lib/materialize-v1.0.0/js/materialize.min.js"></script>

  <!-- Materialize Custom JS -->
  <script src="<?php echo $lib; ?>/lib/custom/script-custom.js"></script>

  <!-- Fun????es JS -->
  <script src="https://maxcomanda.com.br/MaxComanda/js/<?php echo $JS; ?>/functions.js"></script>


</body>



</html>