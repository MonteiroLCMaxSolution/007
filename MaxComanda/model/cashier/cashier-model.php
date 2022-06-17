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

$ConexaoMysql = $_SERVER['DOCUMENT_ROOT'] . '/' . $directory . '/conexao-pdo/conexao-mysql-pdo.php';
include_once($ConexaoMysql);


date_default_timezone_set('America/Sao_Paulo');
$dateTime = date('Y-m-d H:i:s', time());


$imgFolder = $_SERVER['DOCUMENT_ROOT'] . '/' . $directory . '/uploads/';

// ************************** ADICIONAR CAIXA - BRUNO R. BERNAL - 02/02/2022 ****************************
if(isset($_GET['addCashier'])){

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$addCashier = "INSERT INTO cashier (company_id) VALUES (:company_id)";
	$addCashier = $pdo->prepare($addCashier);
	$addCashier->bindValue('company_id', $id_company);
	$addCashier->execute();

	// --- GRAVAR LOG ---


	$description = 'NOVO CAIXA CADASTRADO';
	$sqlLog = "INSERT INTO cashier (company_id) VALUES ($id_company)";
	$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
	$register_log = $pdo->prepare($SQL_register_log);
	$register_log->bindValue('id_company', $id_company);
	$register_log->bindValue('dateTime', $dateTime);
	$register_log->bindValue('action', $sqlLog);
	$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
	$register_log->bindValue('description', $description);
	$register_log->bindValue('user', $id_user);
	$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
	$register_log->execute();


	// --- FIM - GRAVAR LOG ---


}

// *********************** FIM -  ADICIONAR CAIXA - BRUNO R. BERNAL - 02/02/2022 **************************



// *********************** LISTAR CAIXAS NO FORMULÁRIO - BRUNO R. BERNAL - 02/02/2022 ********************
$listCashier = "SELECT id FROM cashier WHERE company_id = :company_id";
$listCashier = $pdo->prepare($listCashier);
$listCashier->bindValue('company_id', $_SESSION['id_company']);
$listCashier->execute();

// ********************* FIM - LISTAR CAIXAS NO FORMULÁRIO - BRUNO R. BERNAL - 02/02/2022 *******************