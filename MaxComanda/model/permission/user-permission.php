<?php

if (!isset($_SESSION)) {
    session_start();
}
if(isset($_GET['directory'])){
	$directory = $_GET['directory'];
} else{
	$directory = explode('/', $_SERVER['PHP_SELF']);
	$directory = $directory[1];
}

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

$ConexaoMysql = '/home/maxcomanda/public_html/' . $directory . '/conexao-pdo/conexao-mysql-pdo.php';
include_once($ConexaoMysql);

date_default_timezone_set('America/Sao_Paulo');
$dataLocal = date('Y-m-d H:i:s', time());

$dateTime = date('Y-m-d H:i:s', time());

$imgFolder = $_SERVER['DOCUMENT_ROOT'] . '/' . $directory . '/uploads/';



// -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* MENU CADASTRO -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*

$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_Register = $pdo->prepare($sql);
$Perm_Register->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_Register->bindValue('id_company', $_SESSION['id_company']);
$Perm_Register->bindValue('menu', 'MENU CADASTRO');
$Perm_Register->execute();
$ROW_Perm_Register = $Perm_Register->fetch();

$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_Register_Products = $pdo->prepare($sql);
$Perm_Register_Products->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_Register_Products->bindValue('id_company', $_SESSION['id_company']);
$Perm_Register_Products->bindValue('menu', 'MENU CADASTRO PRODUTOS');
$Perm_Register_Products->execute();
$ROW_Perm_Register_Products = $Perm_Register_Products->fetch();

$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_Register_Supply = $pdo->prepare($sql);
$Perm_Register_Supply->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_Register_Supply->bindValue('id_company', $_SESSION['id_company']);
$Perm_Register_Supply->bindValue('menu', 'MENU CADASTRO SUPRIMENTOS');
$Perm_Register_Supply->execute();
$ROW_Perm_Register_Supply = $Perm_Register_Supply->fetch();

$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_Register_Location = $pdo->prepare($sql);
$Perm_Register_Location->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_Register_Location->bindValue('id_company', $_SESSION['id_company']);
$Perm_Register_Location->bindValue('menu', 'MENU CADASTRO LOCAIS DOS PRODUTOS');
$Perm_Register_Location->execute();
$ROW_Perm_Register_Location = $Perm_Register_Location->fetch();

$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_Register_Location = $pdo->prepare($sql);
$Perm_Register_Location->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_Register_Location->bindValue('id_company', $_SESSION['id_company']);
$Perm_Register_Location->bindValue('menu', 'MENU CADASTRO LOCAIS DOS PRODUTOS');
$Perm_Register_Location->execute();
$ROW_Perm_Register_Location = $Perm_Register_Location->fetch();

$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_Register_Promotion = $pdo->prepare($sql);
$Perm_Register_Promotion->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_Register_Promotion->bindValue('id_company', $_SESSION['id_company']);
$Perm_Register_Promotion->bindValue('menu', 'MENU CADASTRO PROMOÇÃO');
$Perm_Register_Promotion->execute();
$ROW_Perm_Register_Promotion = $Perm_Register_Promotion->fetch();

$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_Register_Category = $pdo->prepare($sql);
$Perm_Register_Category->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_Register_Category->bindValue('id_company', $_SESSION['id_company']);
$Perm_Register_Category->bindValue('menu', 'MENU CADASTRO CATEGORIAS');
$Perm_Register_Category->execute();
$ROW_Perm_Register_Category = $Perm_Register_Category->fetch();

$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_Register_Subcategory = $pdo->prepare($sql);
$Perm_Register_Subcategory->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_Register_Subcategory->bindValue('id_company', $_SESSION['id_company']);
$Perm_Register_Subcategory->bindValue('menu', 'MENU CADASTRO SUBCATEGORIAS');
$Perm_Register_Subcategory->execute();
$ROW_Perm_Register_Subcategory = $Perm_Register_Subcategory->fetch();

$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_Register_Client = $pdo->prepare($sql);
$Perm_Register_Client->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_Register_Client->bindValue('id_company', $_SESSION['id_company']);
$Perm_Register_Client->bindValue('menu', 'MENU CADASTRO CLIENTES');
$Perm_Register_Client->execute();
$ROW_Perm_Register_Client = $Perm_Register_Client->fetch();

$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_Register_Provider = $pdo->prepare($sql);
$Perm_Register_Provider->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_Register_Provider->bindValue('id_company', $_SESSION['id_company']);
$Perm_Register_Provider->bindValue('menu', 'MENU CADASTRO FORNECEDORES');
$Perm_Register_Provider->execute();
$ROW_Perm_Register_Provider = $Perm_Register_Provider->fetch();

$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_Register_Company = $pdo->prepare($sql);
$Perm_Register_Company->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_Register_Company->bindValue('id_company', $_SESSION['id_company']);
$Perm_Register_Company->bindValue('menu', 'MENU CADASTRO EMPRESAS');
$Perm_Register_Company->execute();
$ROW_Perm_Register_Company = $Perm_Register_Company->fetch();

$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_Register_OrderSheet = $pdo->prepare($sql);
$Perm_Register_OrderSheet->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_Register_OrderSheet->bindValue('id_company', $_SESSION['id_company']);
$Perm_Register_OrderSheet->bindValue('menu', 'MENU CADASTRO COMANDAS');
$Perm_Register_OrderSheet->execute();
$ROW_Perm_Register_OrderSheet = $Perm_Register_OrderSheet->fetch();

$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_Register_Table = $pdo->prepare($sql);
$Perm_Register_Table->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_Register_Table->bindValue('id_company', $_SESSION['id_company']);
$Perm_Register_Table->bindValue('menu', 'MENU CADASTRO MESAS');
$Perm_Register_Table->execute();
$ROW_Perm_Register_Table = $Perm_Register_Table->fetch();

$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_Register_Cashier = $pdo->prepare($sql);
$Perm_Register_Cashier->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_Register_Cashier->bindValue('id_company', $_SESSION['id_company']);
$Perm_Register_Cashier->bindValue('menu', 'MENU CADASTRO CAIXAS');
$Perm_Register_Cashier->execute();
$ROW_Perm_Register_Cashier = $Perm_Register_Cashier->fetch();








// -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* MENU PEDIDOS -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*





$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_Orders = $pdo->prepare($sql);
$Perm_Orders->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_Orders->bindValue('id_company', $_SESSION['id_company']);
$Perm_Orders->bindValue('menu', 'MENU PEDIDOS');
$Perm_Orders->execute();
$ROW_Perm_Orders = $Perm_Orders->fetch();

$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_Orders_PDV = $pdo->prepare($sql);
$Perm_Orders_PDV->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_Orders_PDV->bindValue('id_company', $_SESSION['id_company']);
$Perm_Orders_PDV->bindValue('menu', 'MENU PEDIDOS PDV');
$Perm_Orders_PDV->execute();
$ROW_Perm_Orders_PDV = $Perm_Orders_PDV->fetch();




// -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* MENU MONITOR -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*





$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_Monitor = $pdo->prepare($sql);
$Perm_Monitor->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_Monitor->bindValue('id_company', $_SESSION['id_company']);
$Perm_Monitor->bindValue('menu', 'MENU MONITOR');
$Perm_Monitor->execute();
$ROW_Perm_Monitor = $Perm_Monitor->fetch();

$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_Monitor_Table = $pdo->prepare($sql);
$Perm_Monitor_Table->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_Monitor_Table->bindValue('id_company', $_SESSION['id_company']);
$Perm_Monitor_Table->bindValue('menu', 'MENU MONITOR MESAS');
$Perm_Monitor_Table->execute();
$ROW_Perm_Monitor_Table = $Perm_Monitor_Table->fetch();

$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_Monitor_Kitchen = $pdo->prepare($sql);
$Perm_Monitor_Kitchen->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_Monitor_Kitchen->bindValue('id_company', $_SESSION['id_company']);
$Perm_Monitor_Kitchen->bindValue('menu', 'MENU MONITOR COZINHA');
$Perm_Monitor_Kitchen->execute();
$ROW_Perm_Monitor_Kitchen = $Perm_Monitor_Kitchen->fetch();

$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_Monitor_Counter = $pdo->prepare($sql);
$Perm_Monitor_Counter->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_Monitor_Counter->bindValue('id_company', $_SESSION['id_company']);
$Perm_Monitor_Counter->bindValue('menu', 'MENU MONITOR BALCÃO');
$Perm_Monitor_Counter->execute();
$ROW_Perm_Monitor_Counter = $Perm_Monitor_Counter->fetch();






// -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* MENU SISTEMA -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*





$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_System = $pdo->prepare($sql);
$Perm_System->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_System->bindValue('id_company', $_SESSION['id_company']);
$Perm_System->bindValue('menu', 'MENU SISTEMA');
$Perm_System->execute();
$ROW_Perm_System = $Perm_System->fetch();

$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_System_User = $pdo->prepare($sql);
$Perm_System_User->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_System_User->bindValue('id_company', $_SESSION['id_company']);
$Perm_System_User->bindValue('menu', 'MENU SISTEMA USUÁRIOS');
$Perm_System_User->execute();
$ROW_Perm_System_User = $Perm_System_User->fetch();

$sql = "SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company and menu like :menu";
$Perm_System_Permission = $pdo->prepare($sql);
$Perm_System_Permission->bindValue('id_profile', $_SESSION['userProfile']);
$Perm_System_Permission->bindValue('id_company', $_SESSION['id_company']);
$Perm_System_Permission->bindValue('menu', 'MENU SISTEMA PERMISSÕES');
$Perm_System_Permission->execute();
$ROW_Perm_System_Permission = $Perm_System_Permission->fetch();