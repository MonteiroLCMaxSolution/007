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

// ************* LISTAR UNIQID PARA PUXAR OS PEDIDOS NA TELA DA COZINHA - BRUNO R. BERNAL - 31/01/2022 *****

$listUniqID = "SELECT uniqID, table_delivery FROM order_items WHERE kitchen_status = 'Aguardando' GROUP BY table_delivery";
$listUniqID = $pdo->prepare($listUniqID);
$listUniqID->execute();

// ************* FIM - LISTAR UNIQID PARA PUXAR OS PEDIDOS NA TELA DA COZINHA - BRUNO R. BERNAL - 31/01/2022 *****


// **************************** FINALIZAR PEDIDO - BRUNO R. BERNAL - 31/01/2022 ***************************
if(isset($_GET['finishOrder'])){

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$pdo->beginTransaction();

try {

	// --- MUDAR O STATUS NA TABELA ORDER_ITEMS ---
	$finishOrder = "UPDATE order_items SET kitchen_status = 'Finalizado', counter_status = 'Aguardando' WHERE id = :id";
	$finishOrder = $pdo->prepare($finishOrder);
	$finishOrder->bindValue('id',$id);
	$finishOrder->execute();

	// --- GRAVAR LOG ---

	$description = 'ITEM FINALIZADO PELA COZINHA';
	$sqlLog = "UPDATE order_items SET kitchen_status = 'Finalizado', counter_status = 'Aguardando' WHERE id = $id";
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


} catch (Exception $e) {

	$pdo->rollback();

	// --- GRAVAR LOG ---

	$description = 'ERRO AO FINALIZAR ITEM PELA COZINHA';
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

	
}

	


}
// **************************** FIM - FINALIZAR PEDIDO - BRUNO R. BERNAL - 31/01/2022 ***************************


?>