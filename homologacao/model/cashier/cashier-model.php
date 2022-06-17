<?php

if (!isset($_SESSION)) {
    session_start();
}

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

$ConexaoMysql = $_COOKIE['server'].'/conexao-pdo/conexao-mysql-pdo.php';
include_once($ConexaoMysql);


date_default_timezone_set('America/Sao_Paulo');
$dateTime = date('Y-m-d H:i:s', time());

// ************************** ADICIONAR CAIXA - BRUNO R. BERNAL - 02/02/2022 ****************************
if(isset($_GET['addCashier'])){

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id_contract = anti_injection($_GET['id_contract']);
	$id_contract = filter_var($id_contract, FILTER_SANITIZE_STRING);
	
	$SQL_number_cashier = "SELECT number_cashier FROM cashier WHERE company_id = :company_id and id_contract = :id_contract;";
	$SQL_number_cashier = $pdo->prepare($SQL_number_cashier);
	$SQL_number_cashier->bindValue('company_id',$id_company);
	$SQL_number_cashier->bindValue('id_contract',$id_contract);
	$SQL_number_cashier->execute();
	$number_cashier = intval($SQL_number_cashier->rowCount()) + 1;
	

	$addCashier = "INSERT INTO cashier (company_id,id_contract,number_cashier) VALUES (:company_id,:id_contract,:number_cashier)";
	$addCashier = $pdo->prepare($addCashier);
	$addCashier->bindValue('company_id', $id_company);
	$addCashier->bindValue('id_contract', $id_contract);
	$addCashier->bindValue('number_cashier', $number_cashier);
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
	$register_log->bindValue('IP', $_SERVER['REMOTE_ADDR']);
	$register_log->bindValue('description', $description);
	$register_log->bindValue('user', $id_user);
	$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
	$register_log->execute();


	// --- FIM - GRAVAR LOG ---


}

// *********************** FIM -  ADICIONAR CAIXA - BRUNO R. BERNAL - 02/02/2022 **************************



// *********************** LISTAR CAIXAS NO FORMULÁRIO - BRUNO R. BERNAL - 02/02/2022 ********************
$listCashier = "SELECT id, number_cashier FROM cashier WHERE company_id = :company_id AND id_contract = :id_contract";
$listCashier = $pdo->prepare($listCashier);
$listCashier->bindValue('company_id', $_SESSION['id_company']);
$listCashier->bindValue('id_contract', $_SESSION['id_contract']);
$listCashier->execute();

// ********************* FIM - LISTAR CAIXAS NO FORMULÁRIO - BRUNO R. BERNAL - 02/02/2022 *******************