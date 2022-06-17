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

// ********************************** PESQUISAR PERFIL - BRUNO R. BERNAL - 17/01/2022 **********************

if (isset($_GET['searchProfile'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$profileName = anti_injection($_GET['profileName']);
	$profileName = filter_var($profileName, FILTER_SANITIZE_STRING);
	if (!empty($profileName)) {
		$WHERE_profileName = "WHERE name like '%$profileName%'";
	} else {
		$WHERE_profileName = "";
	}

	$sqlSearchProfile = "SELECT * FROM profile $WHERE_profileName";
	$sqlSearchProfile = $pdo->prepare($sqlSearchProfile);
	$sqlSearchProfile->execute();

	// --- GRAVAR LOG ---


	$description = 'CONSULTAR PERFIL';
	$sqlLog = "SELECT * FROM profile $WHERE_profileName";
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


// ******************************* FIM - PESQUISAR PERFIL - BRUNO R. BERNAL - 17/01/2022 **********************

// ********************************** LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 17/01/2022 **************

if (isset($_GET['idProfile'])) {
	$sqlListData = "SELECT b.name AS name_user_register, c.name AS name_user_update, a.* FROM profile a 
	LEFT JOIN user b ON a.user_register = b.id
	LEFT JOIN user c ON a.user_update = c.id
	WHERE a.id = :id";
	$sqlListData = $pdo->prepare($sqlListData);
	$sqlListData->bindValue('id', $_GET['idProfile']);
	$sqlListData->execute();
	$rowData = $sqlListData->fetch();
	$list_id = $rowData->id;
	$list_id_company = $rowData->id_company;
	$list_name = $rowData->name;
	$list_status = $rowData->status;
	$list_user_register = $rowData->name_user_register;
	$list_date_register = $rowData->date_register;
	$list_user_update = $rowData->name_user_update;
	$list_last_update = $rowData->last_update;
} else {
	$list_id = "";
	$list_id_company = "";
	$list_name = "";
	$list_status = "";
	$list_user_register = "";
	$list_data_register = "";
	$list_user_update = "";
	$list_last_update = "";
}



// ********************************** FIM - LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 17/01/2022 **************


// ********************************** GRAVAR / EDITAR PERFIL - BRUNO R. BERNAL - 17/01/2022 *****************

if (!empty($_GET['saveProfile'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id = anti_injection($_POST['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_POST['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);
	if (!empty($id_company)) {
		$id_company = $id_company;
	} else {
		$id_company = anti_injection($_GET['id_company']);
		$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);
	}

	$name = anti_injection($_POST['name']);
	$name = filter_var($name, FILTER_SANITIZE_STRING);

	$status = anti_injection($_POST['status']);
	$status = filter_var($status, FILTER_SANITIZE_STRING);

	$pdo->beginTransaction();

	try {

		// --- VERIFICAR SE EXISTE PERFIL COM ESTE NOME ---

		$sqlCompare = "SELECT id FROM profile WHERE name = :name AND id_company = :id_company";
		$sqlCompare = $pdo->prepare($sqlCompare);
		$sqlCompare->bindValue('name', $name);
		$sqlCompare->bindValue('id_company', $id_company);
		$sqlCompare->execute();
		if ($sqlCompare->rowCount() > 0) {
			// --------------------------------- ATUALIZAR DADOS ------------------------

			if (empty($_POST['id'])) {
				$retorno = array('codigo' => 0, 'mensagem' => "Já existe um perfil cadastrado com este Nome!");
				echo json_encode($retorno);
				exit();
			}


			$sqlUpdateProfile = 'UPDATE profile SET 
			status = :status,
			user_update = :user_update,
			last_update = :last_update
			WHERE id = :id';
			$sqlUpdateProfile = $pdo->prepare($sqlUpdateProfile);
			$sqlUpdateProfile->bindValue('status', $status);
			$sqlUpdateProfile->bindValue('user_update', $id_user);
			$sqlUpdateProfile->bindValue('last_update', $dateTime);
			$sqlUpdateProfile->bindValue('id', $id);
			$sqlUpdateProfile->execute();

			// --- GRAVAR LOG ---


			$description = 'ATUALIZAR PERFIL ' . $id;
			$sqlLog = "UPDATE profile SET 
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
			// --------------------------------- CADASTRAR NOVO PERFIL ------------------------

			$sqlInsertProfile = "INSERT INTO profile (id_company, name, status, user_register, date_register) VALUES (:id_company, :name, :status, :user_register, :date_register)";
			$sqlInsertProfile = $pdo->prepare($sqlInsertProfile);
			$sqlInsertProfile->bindValue('id_company', $id_company);
			$sqlInsertProfile->bindValue('name', $name);
			$sqlInsertProfile->bindValue('status', $status);
			$sqlInsertProfile->bindValue('user_register', $id_user);
			$sqlInsertProfile->bindValue('date_register', $dateTime);
			$sqlInsertProfile->execute();

			// --- GRAVAR LOG ---


			$description = 'CADASTRAR NOVO PERFIL';
			$sqlLog = "INSERT INTO profile 
			id_company = :$id_company,
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

			$retorno = array('codigo' => 1, 'mensagem' => 'Perfil Cadastrado com Sucesso!');
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



// ******************************** FIM - GRAVAR / EDITAR PERFIL - BRUNO R. BERNAL - 17/01/2022 *****************
