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

// ********************************** PESQUISAR CATEGORIA - BRUNO R. BERNAL - 18/01/2022 **********************

if (isset($_GET['searchCategory'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$categoryName = anti_injection($_GET['categoryName']);
	$categoryName = filter_var($categoryName, FILTER_SANITIZE_STRING);

	if (!empty($categoryName)) {
		$WHERE_categoryName = "WHERE name like '%$categoryName%'";
	} else {
		$WHERE_categoryName = "";
	}

	$sqlSearchCategory = "SELECT * FROM category $WHERE_categoryName";
	$sqlSearchCategory = $pdo->prepare($sqlSearchCategory);
	$sqlSearchCategory->execute();

	// --- GRAVAR LOG ---


	$description = 'CONSULTAR CATEGORIA';
	$sqlLog = "SELECT * FROM category $WHERE_categoryName";
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

	// --- GERAR COR ALEATORIAMENTE ---
	function random_color($start = 0x000000, $end = 0xFFFFFF)
	{
		return sprintf('#%06x', mt_rand($start, $end));
	}
	$color = random_color();


	$color = array('red darken-1', 'red', 'red darken-4', 'red accent-3', 'purple', 'purple darken-4', 'deep-purple lighten-2', 'indigo darken-1', 'indigo darken-4', 'light-blue', 'cyan darken-4', 'teal darken-4', 'green', 'green darken-3', 'light-green darken-4', 'lime darken-4', 'yellow darken-3', 'orange darken-4', 'orange', 'deep-orange darken-1', 'brown lighten-1', 'grey darken-3', 'grey darken-4', 'blue-grey darken-2', 'black');
	$color = $color[array_rand($color)];



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
			// --------------------------------- CADASTRAR NOVA CATEGORIA ------------------------

			$sqlInsertCategory = "INSERT INTO category (name, status, user_register, date_register,color) VALUES (:name, :status, :user_register, :date_register, :color)";
			$sqlInsertCategory = $pdo->prepare($sqlInsertCategory);
			$sqlInsertCategory->bindValue('name', $name);
			$sqlInsertCategory->bindValue('status', $status);
			$sqlInsertCategory->bindValue('user_register', $id_user);
			$sqlInsertCategory->bindValue('date_register', $dateTime);
			$sqlInsertCategory->bindValue('color', $color);
			$sqlInsertCategory->execute();

			// --- GRAVAR LOG ---


			$description = 'CADASTRAR NOVA CATEGORIA';
			$sqlLog = "INSERT INTO category 
			name = $name,
			status = $status,
			user_register = $id_user,
			date_register = $dateTime,
			color = $color";
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

			$retorno = array('codigo' => 1, 'mensagem' => 'Categoria Cadastrada com Sucesso!');
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



// ******************** FIM - GRAVAR / EDITAR CATEGORIA - BRUNO R. BERNAL - 18/01/2022 *****************
