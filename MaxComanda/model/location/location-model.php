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


$imgFolder = $_SERVER['DOCUMENT_ROOT'] . '/' . $directory . '/uploads/logo/';

// ********************************** PESQUISAR LOCALIZAÇÃO - BRUNO R. BERNAL - 18/01/2022 **********************

if(isset($_GET['searchLocation'])){

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$locationName = anti_injection($_GET['locationName']);
	$locationName = filter_var($locationName, FILTER_SANITIZE_STRING);
	if(!empty($locationName)){
		$WHERE_locationName = "WHERE name like '%$locationName%'";
	} else{
		$WHERE_locationName = "";
	}

	$sqlSearchLocation = "SELECT * FROM location_product $WHERE_locationName";
	$sqlSearchLocation = $pdo->prepare($sqlSearchLocation);
	$sqlSearchLocation->execute();

	// --- GRAVAR LOG ---


	$description = 'CONSULTAR LOCAL DO PRODUTO';
	$sqlLog = "SELECT * FROM location_product $WHERE_locationName";
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


// ******************************* FIM - PESQUISAR LOCALIZAÇÃO - BRUNO R. BERNAL - 18/01/2022 **********************

// ********************************** LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 **************

if (isset($_GET['idLocation'])) {
	$sqlListData = "SELECT b.name AS name_user_register, c.name AS name_user_update, a.* FROM location_product a 
	LEFT JOIN user b ON a.user_register = b.id
	LEFT JOIN user c ON a.user_update = c.id
	WHERE a.id = :id";
	$sqlListData = $pdo->prepare($sqlListData);
	$sqlListData->bindValue('id', $_GET['idLocation']);
	$sqlListData->execute();
	$rowData = $sqlListData->fetch();
	$list_id = $rowData->id;
	$list_name = $rowData->name;
	$list_status = $rowData->status;
	$list_user_register = $rowData->name_user_register;
	$list_date_register = $rowData->date_register;
	$list_user_update = $rowData->name_user_update;
	$list_last_update = $rowData->last_update;
} else {
	$list_id = "";
	$list_name = "";
	$list_status = "";
	$list_user_register = "";
	$list_data_register = "";
	$list_user_update = "";
	$list_last_update = "";
}



// ********************************** FIM - LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 **************


// ********************************** GRAVAR / EDITAR CATEGORIA - BRUNO R. BERNAL - 18/01/2022 *****************

if (!empty($_GET['saveLocation'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id = anti_injection($_POST['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$name = anti_injection($_POST['name']);
	$name = filter_var($name, FILTER_SANITIZE_STRING);

	$status = anti_injection($_POST['status']);
	$status = filter_var($status, FILTER_SANITIZE_STRING);

	$pdo->beginTransaction();

	try {

		// --- VERIFICAR SE EXISTE LOCALIZAÇÃO COM ESTE NOME ---

		$sqlCompare = "SELECT id FROM location_product WHERE name = :name";
		$sqlCompare = $pdo->prepare($sqlCompare);
		$sqlCompare->bindValue('name', $name);
		$sqlCompare->execute();
		if ($sqlCompare->rowCount() > 0) {
			// --------------------------------- ATUALIZAR DADOS ------------------------

			if (empty($_POST['id'])) {
				$retorno = array('codigo' => 0, 'mensagem' => "Já existe uma localização cadastrada com este Nome!");
				echo json_encode($retorno);
				exit();
			}


			$sqlUpdateLocation = 'UPDATE location_product SET 
			status = :status,
			user_update = :user_update,
			last_update = :last_update
			WHERE id = :id';
			$sqlUpdateLocation = $pdo->prepare($sqlUpdateLocation);
			$sqlUpdateLocation->bindValue('status', $status);
			$sqlUpdateLocation->bindValue('user_update', $id_user);
			$sqlUpdateLocation->bindValue('last_update', $dateTime);
			$sqlUpdateLocation->bindValue('id', $id);
			$sqlUpdateLocation->execute();

			// --- GRAVAR LOG ---


			$description = 'ATUALIZAR LOCALIZAÇÃO ' . $id;
			$sqlLog = "UPDATE location_product SET 
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

			$retorno = array('codigo' => 1, 'mensagem' => 'Dados Atualizados com Sucesso!');
			echo json_encode($retorno);
			exit();
		} else {
			// --------------------------------- CADASTRAR NOVA LOCALIZAÇÃO ------------------------

			$sqlInsertLocation = "INSERT INTO location_product (name, status, user_register, date_register) VALUES (:name, :status, :user_register, :date_register)";
			$sqlInsertLocation = $pdo->prepare($sqlInsertLocation);
			$sqlInsertLocation->bindValue('name', $name);
			$sqlInsertLocation->bindValue('status', $status);
			$sqlInsertLocation->bindValue('user_register', $id_user);
			$sqlInsertLocation->bindValue('date_register', $dateTime);
			$sqlInsertLocation->execute();

			// --- GRAVAR LOG ---


			$description = 'CADASTRAR NOVA LOCALIZAÇÃO';
			$sqlLog = "INSERT INTO location_product 
			name = $name,
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

			$retorno = array('codigo' => 1, 'mensagem' => 'Localização Cadastrada com Sucesso!');
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



// ******************************** FIM - GRAVAR / EDITAR LOCALIZAÇÃO - BRUNO R. BERNAL - 18/01/2022 *****************



?>