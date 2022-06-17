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


// ********************************** PESQUISAR CATEGORIA - BRUNO R. BERNAL - 18/01/2022 **********************

if (isset($_GET['searchCategory'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$categoryName = anti_injection($_GET['categoryName']);
	$categoryName = filter_var($categoryName, FILTER_SANITIZE_STRING);

	$id_contract = anti_injection($_GET['id_contract']);
	$id_contract = filter_var($id_contract, FILTER_SANITIZE_STRING);


	$sqlSearchCategory = "SELECT a.* FROM category a WHERE a.id_contract = :id_contract AND a.id_company = :id_company AND a.name LIKE :name";
	$sqlSearchCategory = $pdo->prepare($sqlSearchCategory);
	$sqlSearchCategory->bindValue('id_contract',$id_contract);
	$sqlSearchCategory->bindValue('id_company',$id_company);
	$sqlSearchCategory->bindValue('name','%'.$categoryName.'%');
	$sqlSearchCategory->execute();


	// --- GRAVAR LOG ---
	$description = 'CONSULTAR CATEGORIA';
	$sqlLog = "SELECT * FROM category a WHERE a.id_contract = $id_contract AND a.id_company = $id_company AND a.name LIKE '%$categoryName%'";
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
}


// ********************** FIM - PESQUISAR CATEGORIA - BRUNO R. BERNAL - 18/01/2022 **********************

// *************************** LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 17/01/2022 **************

if (isset($_GET['idCategory'])) {
	$sqlListData = "SELECT b.name AS name_user_register, c.name AS name_user_update, a.* FROM category a 
	LEFT JOIN user b ON a.user_register = b.id
	LEFT JOIN user c ON a.user_update = c.id
	WHERE a.id = :id";
	$sqlListData = $pdo->prepare($sqlListData);
	$sqlListData->bindValue('id', $_GET['idCategory']);
	$sqlListData->execute();
	$rowData = $sqlListData->fetch();


	$list_id = $rowData->id;
	$list_id_sequence = $rowData->id_sequence;
	$list_name = $rowData->name;
	$list_status = $rowData->status;
	$list_user_register = $rowData->name_user_register;
	$list_date_register = $rowData->date_register;
	$list_user_update = $rowData->name_user_update;
	$list_last_update = $rowData->last_update;
} else {
	$list_id_sequence = "";
	$list_id = "";
	$list_name = "";
	$list_status = "";
	$list_user_register = "";
	$list_data_register = "";
	$list_user_update = "";
	$list_last_update = "";
}



// *********************** FIM - LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 **************


// *************************** GRAVAR / EDITAR CATEGORIA - BRUNO R. BERNAL - 17/01/2022 *****************

if (!empty($_GET['saveCategory'])) {

	$id = anti_injection($_POST['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$name = anti_injection($_POST['name']);
	$name = filter_var($name, FILTER_SANITIZE_STRING);

	$status = anti_injection($_POST['status']);
	$status = filter_var($status, FILTER_SANITIZE_STRING);

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id_contract = anti_injection($_GET['id_contract']);
	$id_contract = filter_var($id_contract, FILTER_SANITIZE_STRING);


	$pdo->beginTransaction();

	try {


		if (!empty($id)) {
			// --------------------------------- ATUALIZAR DADOS ------------------------


			$sqlUpdateCategory = 'UPDATE category SET 
			name = :name,
			status = :status,
			user_update = :user_update,
			last_update = :last_update
			WHERE id = :id';
			$sqlUpdateCategory = $pdo->prepare($sqlUpdateCategory);
			$sqlUpdateCategory->bindValue('name', $name);
			$sqlUpdateCategory->bindValue('status', $status);
			$sqlUpdateCategory->bindValue('user_update', $id_user);
			$sqlUpdateCategory->bindValue('last_update', $dateTime);
			$sqlUpdateCategory->bindValue('id', $id);
			$sqlUpdateCategory->execute();

			// --- GRAVAR LOG ---


			$description = 'ATUALIZAR CATEGORIA ' . $id;
			$sqlLog = "UPDATE category SET 
			name = $name,
			status = $status,
			user_update = $id_user,
			last_update = $dateTime
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

			$retorno = array('codigo' => 1, 'mensagem' => 'Dados Atualizados com Sucesso!');
			echo json_encode($retorno);
			exit();
		} else {
			// --------------------------------- CADASTRAR NOVA CATEGORIA ------------------------

			// --- BUSCAR ID_SEQUENCE ---
			$sqlLastID = "SELECT max(id_sequence) as id_sequence FROM category WHERE id_company = :id_company AND id_contract = :id_contract";
			$sqlLastID = $pdo->prepare($sqlLastID);
			$sqlLastID->bindValue("id_company",$id_company);
			$sqlLastID->bindValue("id_contract",$id_contract);
			$sqlLastID->execute();
			$lastID = $sqlLastID->fetch();
			$lastID = $lastID->id_sequence;
			if(!empty($lastID)){
				$id_sequence = intval($lastID)+1;
			}else{
				$id_sequence = 1;
			}

			// --- FIM - BUSCAR ID_SEQUENCE ---

			$sqlInsertCategory = "INSERT INTO category (id_sequence, id_company, name, status, user_register, date_register, id_contract) VALUES (:id_sequence, :id_company, :name, :status, :user_register, :date_register, :id_contract)";
			$sqlInsertCategory = $pdo->prepare($sqlInsertCategory);
			$sqlInsertCategory->bindValue('id_sequence', $id_sequence);
			$sqlInsertCategory->bindValue('id_company', $id_company);
			$sqlInsertCategory->bindValue('name', $name);
			$sqlInsertCategory->bindValue('status', $status);
			$sqlInsertCategory->bindValue('user_register', $id_user);
			$sqlInsertCategory->bindValue('date_register', $dateTime);
			$sqlInsertCategory->bindValue('id_contract', $id_contract);
			$sqlInsertCategory->execute();

			// --- GRAVAR LOG ---


			$description = 'CADASTRAR NOVA CATEGORIA';
			$sqlLog = "INSERT INTO category 
			id_sequence = $id_sequence,
			id_company = $id_company,
			name = $name,
			status = $status,
			user_register = $id_user,
			date_register = $dateTime";
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

			$retorno = array('codigo' => 1, 'mensagem' => 'Categoria Cadastrada com Sucesso!');
			echo json_encode($retorno);
			exit();
		}
	} catch (Exception $e) {

		$pdo->rollback();

		// --- GRAVAR LOG ---


		$description = 'ERRO AO CADASTRAR/EDITAR CATEGORIA';
		$sqlLog = $e;
		$SQL_register_log = "INSERT INTO logs(id_company,id_contract, dateTime,action,IP,description,user,origin)VALUES(
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

		$retorno = array('codigo' => 0, 'mensagem' => 'Não foi possível Gravar/Atualizar Categoria. Por favor tente novamente!');
		echo json_encode($retorno);
		exit();
	}
}



// ******************** FIM - GRAVAR / EDITAR CATEGORIA - BRUNO R. BERNAL - 18/01/2022 *****************
