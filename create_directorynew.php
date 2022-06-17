
<?php

if(!empty($_GET['create_directory'])){
	$directory = $_GET['directory'];
	$sha1_service = $_GET['sha1_service'];
	$dbHost = $_GET['dbHost'];
	$dbName = $_GET['dbName'];
	$dbUser = $_GET['dbUser'];
	$dbPass = $_GET['dbPass'];
	
	
	$indexLogin = '<!DOCTYPE html>
<html lang="pt-br">
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="../MaxComanda/lib/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../MaxComanda/lib/materialize-v1.0.0/css/materialize.css">
  <link rel="stylesheet" href="../MaxComanda/lib/custom/style-custom.css">
 </head>
<style>
  #login-page {
    position: relative;
    top: 50%;
    transform: translateY(-50%);
  }
</style>
<body ng-app="mainModule" ng-controller="mainController" class="orange lighten-2">
  <div id="login-page" class="row">
    <div class="col s10 m6 l6 xl4 push-s1 push-m3 push-l3 push-xl4 card-panel">
      <h4 class="center"><a class="orange-text"><b>MA<i class="material-icons icon-food" style="font-size: 37px; font-weight: bold">
              restaurant_menu</i></b>Comanda</a></h4>
      <form class="login-form">
        <div class="row">
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">mail_outline</i>
            <input class="validate" id="email" type="email">
            <label for="email" data-error="wrong" data-success="right">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">lock_outline</i>
            <input id="password" type="password">
            <label for="password">Senha</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <a href="view/" class="btn waves-effect waves-light col s12 orange">Entrar</a>
          </div>
        </div>

      </form>
    </div>
  </div>
  <script src="../MaxComanda/lib/jquery-3.3.1.min.js"></script>
  <script src="../MaxComanda/lib/materialize-v1.0.0/js/materialize.js"></script>
  <script src="../MaxComanda/lib/custom/script-custom.js"></script>
</body>
</html>';
	
	$indexView = '<?php
$_SESSION["color"] = "orange";
$_SESSION["userName"] = "Nome do usuário";
$_SESSION["userEmail"] = "teste@teste.com";

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
  <link rel="stylesheet" href="../../MaxComanda/lib/fontawesome-free/css/all.min.css">
  <!-- Materialize CSS -->
  <link rel="stylesheet" href="../../MaxComanda/lib/materialize-v1.0.0/css/materialize.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="../../MaxComanda/lib/custom/style-custom.css">
</head>

<body>



  <?php
  if (!empty($_GET["pg"])) {
    $pg = $_GET["pg"];
  } else {
    $pg = "";
  }



  switch ($pg) {

    case "client":
      $pageName = "Listar Clientes";
      $JS = "client";
      $linkPage = "../../MaxComanda/controller/client/list-form.php";
      break;

    case "data-client":
      $pageName = "Cadastro - Cliente";
      $JS = "client";
      $linkPage = "../../MaxComanda/controller/client/data-form.php";
      break;

    case "provider":
      $pageName = "Listar Fornecedores";
      $JS = "provider";
      $linkPage = "../../MaxComanda/controller/provider/list-form.php";
      break;

    case "data-provider":
      $pageName = "Cadastro - Fornecedor";
      $JS = "provider";
      $linkPage = "../../MaxComanda/controller/provider/data-form.php";
      break;

    case "product":
      $pageName = "Listar Produtos";
      $JS = "product";
      $linkPage = "../../MaxComanda/controller/product/list-form.php";
      break;

    case "data-product":
      $pageName = "Cadastro - Produto";
      $JS = "product";
      $linkPage = "../../MaxComanda/controller/product/data-form.php";
      break;

    case "category":
      $pageName = "Listar Categorias";
      $JS = "category";
      $linkPage = "../../MaxComanda/controller/category/list-form.php";
      break;

    case "data-category":
      $pageName = "Cadastro - Categoria";
      $JS = "category";
      $linkPage = "../../MaxComanda/controller/category/data-form.php";
      break;

    case "subcategory":
      $pageName = "Listar SubCategorias";
      $JS = "subcategory";
      $linkPage = "../../MaxComanda/controller/subcategory/list-form.php";
      break;

    case "data-subcategory":
      $pageName = "Cadastro - SubCategoria";
      $JS = "subcategory";
      $linkPage = "../../MaxComanda/controller/subcategory/data-form.php";
      break;

    case "user":
      $pageName = "Listar Usuários";
      $JS = "user";
      $linkPage = "../../MaxComanda/controller/user/list-form.php";
      break;

    case "data-user":
      $pageName = "Cadastro - Usuário";
      $JS = "user";
      $linkPage = "../../MaxComanda/controller/user/data-form.php";
      break;

    case "profile":
      $pageName = "Listar Grupo / Perfil";
      $JS = "profile";
      $linkPage = "../../MaxComanda/controller/profile/list-form.php";
      break;

    case "data-profile":
      $pageName = "Cadastro - Grupo / Perfil";
      $JS = "profile";
      $linkPage = "../../MaxComanda/controller/profile/data-form.php";
      break;

    case "company":
      $pageName = "Listar Empresas";
      $JS = "company";
      $linkPage = "../../MaxComanda/controller/company/list-form.php";
      break;

    case "data-company":
      $pageName = "Cadastro - Empresa";
      $JS = "company";
      $linkPage = "../../MaxComanda/controller/company/data-form.php";
      break;

    case "order-sheet":
      $pageName = "Listar Comandas";
      $JS = "order-sheet";
      $linkPage = "../../MaxComanda/controller/order-sheet/list-form.php";
      break;

    case "data-order-sheet":
      $pageName = "Cadastro - Comanda";
      $JS = "order-sheet";
      $linkPage = "../controller/order-sheet/data-form.php";
      break;

    case "table":
      $pageName = "Listar Mesas";
      $JS = "table";
      $linkPage = "../../MaxComanda/controller/table/list-form.php";
      break;

    case "data-table":
      $pageName = "Cadastro - Mesa";
      $JS = "table";
      $linkPage = "../../MaxComanda/controller/table/data-form.php";
      break;

    case "promotion":
      $pageName = "Listar Promoções";
      $JS = "promotion";
      $linkPage = "../../MaxComanda/controller/promotion/list-form.php";
      break;

    case "data-promotion":
      $pageName = "Cadastro - Promoção";
      $JS = "promotion";
      $linkPage = "../../MaxComanda/controller/promotion/data-form.php";
      break;

    case "order":
      $pageName = "Listar Pedidos";
      $JS = "order";
      $linkPage = "../../MaxComanda/controller/order/list-form.php";
      break;

    case "data-order":
      $pageName = "Cadastro - Pedido";
      $JS = "order";
      $linkPage = "../../MaxComanda/controller/order/data-form.php";
      break;



    default:
      $JS = "dashboard";
      $linkPage = "../../MaxComanda/controller/dashboard/dashboard.php";
      break;
  }





  include_once("../../MaxComanda/view/header.php");
  ?>
  <div class="content-wrapper">
    <?php
    include_once($linkPage);
    ?>
  </div>
  <?php

  include_once("../../MaxComanda/view/footer.php");
  ?>





  <!-- JQuery -->
  <script src="../../MaxComanda/lib/jquery-3.3.1.min.js"></script>

  <!-- Materialize JS -->
  <script src="../../MaxComanda/lib/materialize-v1.0.0/js/materialize.min.js"></script>

  <!-- Materialize Custom JS -->
  <script src="../../MaxComanda/lib/custom/script-custom.js"></script>

  <!-- Funções JS -->
  <script src="../js/<?php echo $JS; ?>/functions.js"></script>

</body>



</html>';
	
	$conexao = '<?php

$host = '.$dbHost.';
$dbName = '.$dbName.';
$userName = '.$dbUser.';
$password = '.$dbPass.';
$charset = "utf8";
try {
	$pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=$charset", $userName, $password);

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $e) {
	echo "Erro ao conectar com o MySQL: " . $e->getMessage();
}

/*---------- CONFIGURAÇÃO DE ENVIOS DE E-MAILS AUTENTICADOS - LEÔNIDAS MONTEIRO - 29/07/2020*/
$emailHost =  "lcmaxsolution.com.br";
$emailPort = true;  // Usar autentica��o SMTP (obrigat�rio para smtp.seudom�nio.com.br)
$emailPort = "465"; //  Usar 587 porta SMTP
$emailSMTP = "ssl";
$emailUser = "leonidas@lcmaxsolution.com.br"; // Usu�rio do servidor SMTP (endere�o de email)
$emailPass = "0_~TYFhpRTW?";
/*========== CONFIGURAÇÃO DE ENVIOS DE E-MAILS AUTENTICADOS - LEÔNIDAS MONTEIRO - 29/07/2020*/

function anti_injection($sql)
{
	// remove palavras que contenham sintaxe sql
	$sql = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/i", "", $sql);
	$sql = trim($sql); //limpa espaços vazio
	$sql = strip_tags($sql); //tira tags html e php
	$sql = addslashes($sql); //Adiciona barras invertidas a uma string
	return $sql;
}
';
$indexCardapio = '<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/MaxComanda/cardapio/index.php");
?>';
	
	mkdir($directory,0777, true);
mkdir($directory.'/view',0777,true);
mkdir($directory.'/conexao-pdo',0777,true);
mkdir($directory.'/cardapio',0777,true);
mkdir($directory.'/uploads',0777,true);
mkdir($directory.'/uploads/logo',0777,true);
mkdir($directory.'/uploads/productImg',0777,true);
mkdir($directory.'/uploads/userImage',0777,true);




$fp = fopen($directory."/index.php","wb");
fwrite($fp,$indexLogin);
fclose($fp);

$fp = fopen($directory."/cardapio/index.php","wb");
fwrite($fp,$indexCardapio);
fclose($fp);

$fp = fopen($directory."/view/index.php","wb");
fwrite($fp,$indexView);
fclose($fp);

$fp = fopen($directory."/conexao-pdo/conexao-mysql-pdo.php","wb");
fwrite($fp,$conexao);
fclose($fp);
	
}


?>





<?php

if(!empty($_GET['create_directory'])){
	$directory = $_GET['directory'];
	$sha1_service = $_GET['sha1_service'];
	$dbHost = $_GET['dbHost'];
	$dbName = $_GET['dbName'];
	$dbUser = $_GET['dbUser'];
	$dbPass = $_GET['dbPass'];
	
	
	$indexLogin = '<?php
$clientService = "c94f21e96bf804c7c037c055c3dcc2e732929a03";
$directory = explode("/",$_SERVER["PHP_SELF"]);
$directory = $directory[1];
?>
<div id="divLogado" hidden="hidden">
<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/MaxComanda/index.php");
?>
</div>
<div id="divNegado" hidden="hidden">
	Acesso Negado
</div>
<script src="../MaxComanda/lib/jquery-3.3.1.min.js"></script>
<script src="../js/ws/ws.js"></script>
<script>
	payment_status("<?php echo $clientService;?>");
</script>';
	
	$indexView = '<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/MaxComanda/view/index.php");
?>';
	
	$conexao = '<?php
$host = "'.$dbHost.'";
$dbName = "'.$dbName.'";
$userName = "'.$dbUser.'";
$password = "'.$dbPass.'";
$charset = "utf8";
try {
	$pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=$charset", $userName, $password);

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

	//echo "achou dados no base help2";
} catch (PDOException $e) {
	echo "Erro ao conectar com o MySQL: " . $e->getMessage();
}

function anti_injection($sql)
{
	// remove palavras que contenham sintaxe sql
	$sql = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/i", "", $sql);
	$sql = trim($sql); //limpa espaços vazio
	$sql = strip_tags($sql); //tira tags html e php
	$sql = addslashes($sql); //Adiciona barras invertidas a uma string
	return $sql;
}
?>';	
}

mkdir($directory,0777, true);
mkdir($directory.'/view',0777,true);
mkdir($directory.'/conexao-pdo',0777,true);

$fp = fopen($directory."/index.php","wb");
fwrite($fp,$indexLogin);
fclose($fp);


$fp = fopen($directory."/view/index.php","wb");
fwrite($fp,$indexView);
fclose($fp);

$fp = fopen($directory."/conexao-pdo/conexao-mysql-pdo.php","wb");
fwrite($fp,$conexao);
fclose($fp);
?>
Diretórios criados com sucesso!