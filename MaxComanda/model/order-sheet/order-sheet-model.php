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

/*ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);*/


$ConexaoMysql = $_SERVER['DOCUMENT_ROOT'] . '/' . $directory . '/conexao-pdo/conexao-mysql-pdo.php';
include_once($ConexaoMysql);


date_default_timezone_set('America/Sao_Paulo');
$dateTime = date('Y-m-d H:i:s', time());


$imgFolder = $_SERVER['DOCUMENT_ROOT'] . '/' . $directory . '/uploads/';

// ********************************** MUDAR STATUS DA COMANDA - BRUNO R. BERNAL - 21/01/2022 **********************

if (isset($_GET['statusOrderSheet'])) {


	$pdo->beginTransaction();

try {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$status = anti_injection($_GET['statusOrderSheet']);
	$status = filter_var($status, FILTER_SANITIZE_STRING);

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);


	$sqlUpdOrderSheet = "UPDATE order_sheet SET
	status = :status
	WHERE id = :id";
	$sqlUpdOrderSheet = $pdo->prepare($sqlUpdOrderSheet);
	$sqlUpdOrderSheet->bindValue('status',$status);
	$sqlUpdOrderSheet->bindValue('id',$id);
	$sqlUpdOrderSheet->execute();

	// --- GRAVAR LOG ---


	$description = 'MUDAR STATUS DA COMANDA';
	$sqlLog = "UPDATE order_sheet SET
	status = $status
	WHERE id = $id";
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

	

	$pdo->commit();
	exit();

} catch (Exception $e) {

	$pdo->rollback();

	// --- GRAVAR LOG ---


	$description = 'ERRO AO MUDAR STATUS DA COMANDA';
	$sqlLog = $e;
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

	exit();
}

	

	

}


// *************************** FIM - MUDAR STATUS DA COMANDA - BRUNO R. BERNAL - 21/01/2022 **********************

// ********************************** ADICIONAR COMANDA - BRUNO R. BERNAL - 21/01/2022 **********************

if (isset($_GET['addOrderSheet'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$sqlAddOrderSheet = "INSERT INTO order_sheet (company_id, status, user_register, date_register) VALUES (:company_id, :status, :user_register, :date_register)";
	$sqlAddOrderSheet = $pdo->prepare($sqlAddOrderSheet);
	$sqlAddOrderSheet->bindValue('company_id',$id_company);
	$sqlAddOrderSheet->bindValue('status','Ativo');
	$sqlAddOrderSheet->bindValue('user_register',$id_user);
	$sqlAddOrderSheet->bindValue('date_register',$dateTime);
	$sqlAddOrderSheet->execute();

	// --- GRAVAR LOG ---


	$description = 'ADICIONAR COMANDA';
	$sqlLog = "INSERT INTO order_sheet SET
	company_id = $id_company,
	status = 'Ativo',
	user_register = $id_user,
	date_register = $dateTime";
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


// ******************************* FIM - ADICIONAR COMANDA - BRUNO R. BERNAL - 21/01/2022 **********************

// ********************************** PESQUISAR COMANDA - BRUNO R. BERNAL - 21/01/2022 **********************

if (isset($_GET['listOrderSheet'])) {


	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$sqlSearchOrderSheet = "SELECT * FROM order_sheet WHERE company_id = $id_company ORDER BY status";
	$sqlSearchOrderSheet = $pdo->prepare($sqlSearchOrderSheet);
	$sqlSearchOrderSheet->execute();

}


// ******************************* FIM - PESQUISAR COMANDA - BRUNO R. BERNAL - 21/01/2022 **********************

?>