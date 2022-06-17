<?php

if (!isset($_SESSION)) {
	session_start();
}

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
$ConexaoMysql = $_COOKIE['server'] . '/conexao-pdo/conexao-mysql-pdo.php';
include_once($ConexaoMysql);

date_default_timezone_set('America/Sao_Paulo');
$dateTime = date('Y-m-d H:i:s', time());


// ************************ LISTAR COMANDAS NA TABELA - BRUNO R. BERNAL - 16/05/2022 ************************

$sqlSearchOrderSheet = "SELECT * FROM order_sheet WHERE company_id = :company_id AND id_contract = :id_contract ORDER BY STATUS ";
$sqlSearchOrderSheet = $pdo->prepare($sqlSearchOrderSheet);
$sqlSearchOrderSheet->bindValue('company_id', $_COOKIE['id_company']);
$sqlSearchOrderSheet->bindValue('id_contract', $_COOKIE['id_contract']);
$sqlSearchOrderSheet->execute();


// ********************* FIM - LISTAR COMANDAS NA TABELA - BRUNO R. BERNAL - 16/05/2022 ************************



// ****************************** MUDAR STATUS DA COMANDA - BRUNO R. BERNAL - 21/01/2022 **********************

if (isset($_GET['statusOrderSheet'])) {


	$pdo->beginTransaction();

	try {

		$id_user = anti_injection($_POST['id_user']);
		$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

		$id_company = anti_injection($_POST['id_company']);
		$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

		$id_contract = anti_injection($_POST['id_contract']);
		$id_contract = filter_var($id_contract, FILTER_SANITIZE_STRING);

		$status = anti_injection($_GET['statusOrderSheet']);
		$status = filter_var($status, FILTER_SANITIZE_STRING);

		$id = anti_injection($_POST['id']);
		$id = filter_var($id, FILTER_SANITIZE_STRING);


		$sqlUpdOrderSheet = "UPDATE order_sheet SET
	status = :status
	WHERE id = :id";
		$sqlUpdOrderSheet = $pdo->prepare($sqlUpdOrderSheet);
		$sqlUpdOrderSheet->bindValue('status', $status);
		$sqlUpdOrderSheet->bindValue('id', $id);
		$sqlUpdOrderSheet->execute();

		// --- GRAVAR LOG ---

		$description = 'MUDAR STATUS DA COMANDA';
		$sqlLog = "UPDATE order_sheet SET
	status = $status
	WHERE id = $id";
		$SQL_register_log = "INSERT INTO logs(id_company,id_contract,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:id_contract,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
		$register_log = $pdo->prepare($SQL_register_log);
		$register_log->bindValue('id_company', $id_company);
		$register_log->bindValue('id_contract', $id_contract);
		$register_log->bindValue('dateTime', $dateTime);
		$register_log->bindValue('action', $sqlLog);
		$register_log->bindValue('IP', $_SERVER['REMOTE_ADDR']);
		$register_log->bindValue('description', $description);
		$register_log->bindValue('user', $id_user);
		$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
		$register_log->execute();


		// --- FIM - GRAVAR LOG ---



		$pdo->commit();
		$retorno = array('codigo' => 1, 'mensagem' => 'Status Atualizado com Sucesso!');
		echo json_encode($retorno);
		exit();
	} catch (Exception $e) {

		$pdo->rollback();

		// --- GRAVAR LOG ---


		$description = 'ERRO AO MUDAR STATUS DA COMANDA';
		$sqlLog = $e;
		$SQL_register_log = "INSERT INTO logs(id_company,id_contract,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:id_contract,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
		$register_log = $pdo->prepare($SQL_register_log);
		$register_log->bindValue('id_company', $id_company);
		$register_log->bindValue('id_contract', $id_contract);
		$register_log->bindValue('dateTime', $dateTime);
		$register_log->bindValue('action', $sqlLog);
		$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
		$register_log->bindValue('description', $description);
		$register_log->bindValue('user', $id_user);
		$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
		$register_log->execute();


		// --- FIM - GRAVAR LOG ---

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro ao Atualizar Status da Comanda!');
		echo json_encode($retorno);
		exit();
	}
}


// ************************ FIM - MUDAR STATUS DA COMANDA - BRUNO R. BERNAL - 21/01/2022 **********************

// ********************************** ADICIONAR COMANDA - BRUNO R. BERNAL - 21/01/2022 **********************

if (isset($_GET['addOrderSheet'])) {

	$pdo->beginTransaction();

	try {

		$id_user = anti_injection($_POST['id_user']);
		$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

		$id_company = anti_injection($_POST['id_company']);
		$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

		$id_contract = anti_injection($_POST['id_contract']);
		$id_contract = filter_var($id_contract, FILTER_SANITIZE_STRING);

		/* NUMBER ORDER SHEET OF CONTRACT - LEÔNIDAS MONTEIRO - 09/03/2022*/
		$SQL_number_order_sheet = "SELECT number_order_sheet FROM order_sheet WHERE company_id = :company_id AND id_contract = :id_contract;";
		$SQL_number_order_sheet = $pdo->prepare($SQL_number_order_sheet);
		$SQL_number_order_sheet->bindValue('company_id', $id_company);
		$SQL_number_order_sheet->bindValue('id_contract', $id_contract);
		$SQL_number_order_sheet->execute();
		$number_order_sheet = intval($SQL_number_order_sheet->rowCount()) + 1;
		/* .NUMBER ORDER SHEET OF CONTRACT */

		$sqlAddOrderSheet = "INSERT INTO order_sheet (company_id, status, user_register, date_register,id_contract,number_order_sheet) VALUES (:company_id, :status, :user_register, :date_register,:id_contract,:number_order_sheet)";
		$sqlAddOrderSheet = $pdo->prepare($sqlAddOrderSheet);
		$sqlAddOrderSheet->bindValue('company_id', $id_company);
		$sqlAddOrderSheet->bindValue('status', 'Ativo');
		$sqlAddOrderSheet->bindValue('user_register', $id_user);
		$sqlAddOrderSheet->bindValue('date_register', $dateTime);
		$sqlAddOrderSheet->bindValue('id_contract', $id_contract);
		$sqlAddOrderSheet->bindValue('number_order_sheet', $number_order_sheet);
		$sqlAddOrderSheet->execute();

		// --- GRAVAR LOG ---


		$description = 'ADICIONAR COMANDA';
		$sqlLog = "INSERT INTO order_sheet SET
	company_id = $id_company,
	id_contract = $id_contract,
	status = 'Ativo',
	user_register = $id_user,
	date_register = $dateTime,
	number_order_sheet = $number_order_sheet";
		$SQL_register_log = "INSERT INTO logs(id_company,id_contract,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:id_contract,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
		$register_log = $pdo->prepare($SQL_register_log);
		$register_log->bindValue('id_company', $id_company);
		$register_log->bindValue('id_contract', $id_contract);
		$register_log->bindValue('dateTime', $dateTime);
		$register_log->bindValue('action', $sqlLog);
		$register_log->bindValue('IP', $_SERVER['REMOTE_ADDR']);
		$register_log->bindValue('description', $description);
		$register_log->bindValue('user', $id_user);
		$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
		$register_log->execute();


		// --- FIM - GRAVAR LOG ---

		$pdo->commit();

		$retorno = array('codigo' => 1, 'mensagem' => 'Comanda Inserida com Sucesso!');
		echo json_encode($retorno);
		exit();
	} catch (Exception $e) {

		$pdo->rollback();

		// --- GRAVAR LOG ---


		$description = 'ERRO AO ADICIONAR COMANDA';
		$sqlLog = $e;
		$SQL_register_log = "INSERT INTO logs(id_company,id_contract,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:id_contract,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
		$register_log = $pdo->prepare($SQL_register_log);
		$register_log->bindValue('id_company', $id_company);
		$register_log->bindValue('id_contract', $id_contract);
		$register_log->bindValue('dateTime', $dateTime);
		$register_log->bindValue('action', $sqlLog);
		$register_log->bindValue('IP', $_SERVER['REMOTE_ADDR']);
		$register_log->bindValue('description', $description);
		$register_log->bindValue('user', $id_user);
		$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
		$register_log->execute();


		// --- FIM - GRAVAR LOG ---

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro ao Adicionar Comanda!');
		echo json_encode($retorno);
		exit();
	}
}


// ******************************* FIM - ADICIONAR COMANDA - BRUNO R. BERNAL - 21/01/2022 **********************

// ********************************** PESQUISAR COMANDA - BRUNO R. BERNAL - 21/01/2022 **********************

if (isset($_GET['listOrderSheet'])) {

	$id_company = anti_injection($_POST['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id_contract = anti_injection($_POST['id_contract']);
	$id_contract = filter_var($id_contract, FILTER_SANITIZE_STRING);

	$sqlSearchOrderSheet = "SELECT * FROM order_sheet WHERE company_id = :company_id AND id_contract = :id_contract ORDER BY STATUS ";
	$sqlSearchOrderSheet = $pdo->prepare($sqlSearchOrderSheet);
	$sqlSearchOrderSheet->bindValue('company_id', $id_company);
	$sqlSearchOrderSheet->bindValue('id_contract', $id_contract);
	$sqlSearchOrderSheet->execute();
}


// ******************************* FIM - PESQUISAR COMANDA - BRUNO R. BERNAL - 21/01/2022 **********************
