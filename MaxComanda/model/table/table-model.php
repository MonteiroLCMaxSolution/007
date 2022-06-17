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

// ********************************** GRAVAR MESA - BRUNO R. BERNAL - 21/01/2022 *****************

if (!empty($_GET['saveTable'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id = anti_injection($_POST['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$map = anti_injection($_POST['map']);
	$map = filter_var($map, FILTER_SANITIZE_STRING);

	$status = anti_injection($_POST['status']);
	$status = filter_var($status, FILTER_SANITIZE_STRING);



	$pdo->beginTransaction();

	try {

		// --- VERIFICAR SE EXISTE ID PARA ATUALIZAR OU SE NÃO EXISTE PARA GRAVAR ---

		if (!empty($_POST['id'])) {
			// --------------------------------- ATUALIZAR DADOS ------------------------

			$sqlUpdateTable = "UPDATE tables SET
			map_id = :map_id,
			status = :status,
			user_update = :user_update,
			last_update = :last_update
			WHERE id = :id";
			$sqlUpdateTable = $pdo->prepare($sqlUpdateTable);
			$sqlUpdateTable->bindValue('map_id', $map);
			$sqlUpdateTable->bindValue('status', $status);
			$sqlUpdateTable->bindValue('user_update', $id_user);
			$sqlUpdateTable->bindValue('last_update', $dateTime);
			$sqlUpdateTable->bindValue('id', $id);
			$sqlUpdateTable->execute();


			// --- GRAVAR LOG ---


			$description = 'ATUALIZAR MESA';
			$sqlLog = "UPDATE tables SET
			map_id = $map,
			status = $status,
			user_update = $id_user,
			last_update = $dateTime
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

			$retorno = array('codigo' => 1, 'mensagem' => 'Mesa Atualizada com Sucesso!');
			echo json_encode($retorno);
			exit();
		} else {
			// --------------------------------- CADASTRAR NOVA MESA ------------------------

			$sqlInsertTable = "INSERT INTO tables (company_id, map_id, status, user_register, date_register) VALUES (:company_id, :map_id, :status, :user_register, :date_register)";
			$sqlInsertTable = $pdo->prepare($sqlInsertTable);
			$sqlInsertTable->bindValue('company_id', $id_company);
			$sqlInsertTable->bindValue('map_id', $map);
			$sqlInsertTable->bindValue('status', $status);
			$sqlInsertTable->bindValue('user_register', $id_user);
			$sqlInsertTable->bindValue('date_register', $dateTime);
			$sqlInsertTable->execute();

			// --- GRAVAR LOG ---


			$description = 'CADASTRAR NOVA MESA';
			$sqlLog = "INSERT INTO tables 
			company_id = :$id_company,
			map_id = $map,
			status = $status,
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

			
			

			$pdo->commit();	

			$retorno = array('codigo' => 1, 'mensagem' => 'Mesa Cadastrada com Sucesso!');
			echo json_encode($retorno);
			exit();
		}
	} catch (Exception $e) {

		$pdo->rollback();

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro: ' . $e);
		echo json_encode($retorno);
		exit();
	}
}



// ******************************** FIM - GRAVAR MESA - BRUNO R. BERNAL - 21/01/2022 *****************

// ************************************ MUDAR STATUS DO MAPA - BRUNO R. BERNAL - 21/01/2022 *****************

if (isset($_GET['statusMap'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$status = anti_injection($_GET['status']);
	$status = filter_var($status, FILTER_SANITIZE_STRING);

	$pdo->beginTransaction();

	try {

		$sqlStatusMap = "UPDATE table_map SET status = :status WHERE id = :id";
		$sqlStatusMap = $pdo->prepare($sqlStatusMap);
		$sqlStatusMap->bindValue('status', $status);
		$sqlStatusMap->bindValue('id', $id);
		$sqlStatusMap->execute();

		// --- GRAVAR LOG ---


		$description = 'MUDAR STATUS DO MAPA';
		$sqlLog = "UPDATE table_map SET status = $status WHERE id = $id";
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

		$retorno = array('codigo' => 1, 'mensagem' => 'Atualizado com Sucesso!');
		echo json_encode($retorno);
		exit();
	} catch (Exception $e) {

		$pdo->rollback();

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro: ' . $e);
		echo json_encode($retorno);
		exit();
	}
}



// ************************************ FIM - MUDAR STATUS DO MAPA - BRUNO R. BERNAL - 21/01/2022 *****************

// ********************************* LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 21/01/2022 *************

$sqlListMap = "SELECT id, description FROM table_map WHERE company_id = " . $_SESSION['id_company'] . " AND status = 'Ativo'";
$sqlListMap = $pdo->prepare($sqlListMap);
$sqlListMap->execute();


if (isset($_GET['idTable'])) {
	$sqlListData = "SELECT d.description as map_description, b.name AS name_user_register, c.name AS name_user_update, a.* FROM tables a 
	LEFT JOIN user b ON a.user_register = b.id
	LEFT JOIN user c ON a.user_update = c.id
	LEFT JOIN table_map d ON a.map_id = d.id
	WHERE a.id = :id";
	$sqlListData = $pdo->prepare($sqlListData);
	$sqlListData->bindValue('id', $_GET['idTable']);
	$sqlListData->execute();
	$rowData = $sqlListData->fetch();
	$list_id = $rowData->id;
	$list_map_id = $rowData->map_id;
	$list_map_description = $rowData->map_description;
	$list_status = $rowData->status;
	$list_user_register = $rowData->name_user_register;
	$list_date_register = $rowData->date_register;
	$list_user_update = $rowData->name_user_update;
	$list_last_update = $rowData->last_update;
} else {
	$list_id = "";
	$list_map_id = "";
	$list_map_description = "";
	$list_status = "";
	$list_user_register = "";
	$list_date_register = "";
	$list_user_update = "";
	$list_last_update = "";
}




// ********************************* FIM - LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 21/01/2022 *************



// ********************************** GRAVAR MAPA - BRUNO R. BERNAL - 21/01/2022 *****************

if (!empty($_GET['saveMap'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$floor = anti_injection($_POST['floor']);
	$floor = filter_var($floor, FILTER_SANITIZE_STRING);

	$sector = anti_injection($_POST['sector']);
	$sector = filter_var($sector, FILTER_SANITIZE_STRING);

	$side = anti_injection($_POST['side']);
	$side = filter_var($side, FILTER_SANITIZE_STRING);

	$description = anti_injection($_POST['description']);
	$description = filter_var($description, FILTER_SANITIZE_STRING);

	$status = "Ativo";


	$pdo->beginTransaction();

	try {

		// --- VERIFICAR SE EXISTE MAPA COM ESSA DESCRIÇÃO ---

		$sqlCompare = "SELECT id FROM table_map WHERE description = :description AND company_id = :company_id";
		$sqlCompare = $pdo->prepare($sqlCompare);
		$sqlCompare->bindValue('description', $description);
		$sqlCompare->bindValue('company_id', $id_company);
		$sqlCompare->execute();
		if ($sqlCompare->rowCount() > 0) {

			$retorno = array('codigo' => 0, 'mensagem' => "Já existe um local cadastrado com esta Descrição!");
			echo json_encode($retorno);
			exit();
		} else {
			// --------------------------------- CADASTRAR NOVO LOCAL ------------------------

			$sqlInsertMap = "INSERT INTO table_map (company_id, floor, sector, side, description, status, user_register, date_register) VALUES (:company_id, :floor, :sector, :side, :description, :status, :user_register, :date_register)";
			$sqlInsertMap = $pdo->prepare($sqlInsertMap);
			$sqlInsertMap->bindValue('company_id', $id_company);
			$sqlInsertMap->bindValue('floor', $floor);
			$sqlInsertMap->bindValue('sector', $sector);
			$sqlInsertMap->bindValue('side', $side);
			$sqlInsertMap->bindValue('description', $description);
			$sqlInsertMap->bindValue('status', $status);
			$sqlInsertMap->bindValue('user_register', $id_user);
			$sqlInsertMap->bindValue('date_register', $dateTime);
			$sqlInsertMap->execute();

			// --- GRAVAR LOG ---


			$description = 'CADASTRAR NOVO MAPA';
			$sqlLog = "INSERT INTO table_map 
			company_id = :$id_company,
			floor = $floor,
			sector = $sector,
			side = $side,
			description = $description,
			status = $status,
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


			$pdo->commit();

			$retorno = array('codigo' => 1, 'mensagem' => 'Mapa Cadastrado com Sucesso!');
			echo json_encode($retorno);
			exit();
		}
	} catch (Exception $e) {

		$pdo->rollback();

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro: ' . $e);
		echo json_encode($retorno);
		exit();
	}
}



// ******************************** FIM - GRAVAR MAPA - BRUNO R. BERNAL - 21/01/2022 *****************

// ********************************** PESQUISAR LOCAL NO MAPA - BRUNO R. BERNAL - 21/01/2022 **********************

if (isset($_GET['pg']) && $_GET['pg'] == 'data-table') {

	$sqlSearchMap = "SELECT * FROM table_map WHERE company_id = " . $_SESSION['id_company'];
	$sqlSearchMap = $pdo->prepare($sqlSearchMap);
	$sqlSearchMap->execute();

	// --- GRAVAR LOG ---


	$description = 'CONSULTAR MAPA DE MESAS';
	$sqlLog = "SELECT * FROM table_map WHERE company_id = " . $_SESSION['id_company'];
	$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
	$register_log = $pdo->prepare($SQL_register_log);
	$register_log->bindValue('id_company', $_SESSION['id_company']);
	$register_log->bindValue('dateTime', $dateTime);
	$register_log->bindValue('action', $sqlLog);
	$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
	$register_log->bindValue('description', $description);
	$register_log->bindValue('user', $_SESSION['id_user']);
	$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
	$register_log->execute();


	// --- FIM - GRAVAR LOG ---
}


// *************************** FIM - PESQUISAR LOCAL NO MAPA - BRUNO R. BERNAL - 21/01/2022 **********************


// ********************************** PESQUISAR MESA - BRUNO R. BERNAL - 21/01/2022 **********************

if (isset($_GET['listTable'])) {

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$sqlSearchTable = "SELECT a.*, b.description FROM tables a 
	LEFT JOIN table_map b ON a.map_id = b.id
	WHERE a.company_id = $id_company ORDER BY a.status";
	$sqlSearchTable = $pdo->prepare($sqlSearchTable);
	$sqlSearchTable->execute();

}


// ******************************* FIM - PESQUISAR MESA - BRUNO R. BERNAL - 21/01/2022 **********************
