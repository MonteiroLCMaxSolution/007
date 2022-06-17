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

// ********************************** PESQUISAR SUBCATEGORIA - BRUNO R. BERNAL - 18/01/2022 **********************

if(isset($_GET['searchSubcategory'])){

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$subcategoryName = anti_injection($_GET['subcategoryName']);
	$subcategoryName = filter_var($subcategoryName, FILTER_SANITIZE_STRING);
	if(!empty($subcategoryName)){
		$WHERE_subcategoryName = "WHERE name like '%$subcategoryName%'";
	} else{
		$WHERE_subcategoryName = "";
	}

	$sqlSearchSubcategory = "SELECT b.name as category_name, a.* FROM subcategory a 
	LEFT JOIN category b ON a.category_id = b.id 
	$WHERE_subcategoryName";
	$sqlSearchSubcategory = $pdo->prepare($sqlSearchSubcategory);
	$sqlSearchSubcategory->execute();

	// --- GRAVAR LOG ---


	$description = 'CONSULTAR SUBCATEGORIA';
	$sqlLog = "SELECT * FROM subcategory $WHERE_subcategoryName";
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


// ******************************* FIM - PESQUISAR SUBCATEGORIA - BRUNO R. BERNAL - 18/01/2022 **********************

// ********************************** LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 **************


$sqlListCategory = "SELECT id, name FROM category";
$sqlListCategory = $pdo->prepare($sqlListCategory);
$sqlListCategory->execute();

if (isset($_GET['idSubcategory'])) {
	$sqlListData = "SELECT d.name as name_category, b.name AS name_user_register, c.name AS name_user_update, a.* FROM subcategory a 
	LEFT JOIN user b ON a.user_register = b.id
	LEFT JOIN user c ON a.user_update = c.id
	LEFT JOIN category d ON a.category_id = d.id
	WHERE a.id = :id";
	$sqlListData = $pdo->prepare($sqlListData);
	$sqlListData->bindValue('id', $_GET['idSubcategory']);
	$sqlListData->execute();
	$rowData = $sqlListData->fetch();
	$list_id = $rowData->id;
	$list_name = $rowData->name;
	$list_status = $rowData->status;
	$list_user_register = $rowData->name_user_register;
	$list_date_register = $rowData->date_register;
	$list_user_update = $rowData->name_user_update;
	$list_last_update = $rowData->last_update;
	$list_category_id = $rowData->category_id;
	$list_category_name = $rowData->name_category;
} else {
	$list_id = "";
	$list_name = "";
	$list_status = "";
	$list_user_register = "";
	$list_data_register = "";
	$list_user_update = "";
	$list_last_update = "";
	$list_category_id = "";
	$list_category_name = "";
	
}



// ********************************** FIM - LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 **************


// ********************************** GRAVAR / EDITAR SUBCATEGORIA - BRUNO R. BERNAL - 18/01/2022 *****************

if (!empty($_GET['saveSubcategory'])) {

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

	$category = anti_injection($_POST['category']);
	$category = filter_var($category, FILTER_SANITIZE_STRING);

	$pdo->beginTransaction();

	try {

		if (!empty($id)) {
			// --------------------------------- ATUALIZAR DADOS ------------------------

			


			$sqlUpdateSubcategory = 'UPDATE subcategory SET 
			name = :name,
			status = :status,
			category_id = :category,
			user_update = :user_update,
			last_update = :last_update
			WHERE id = :id';
			$sqlUpdateSubcategory = $pdo->prepare($sqlUpdateSubcategory);
			$sqlUpdateSubcategory->bindValue('name', $name);
			$sqlUpdateSubcategory->bindValue('status', $status);
			$sqlUpdateSubcategory->bindValue('category', $category);
			$sqlUpdateSubcategory->bindValue('user_update', $id_user);
			$sqlUpdateSubcategory->bindValue('last_update', $dateTime);
			$sqlUpdateSubcategory->bindValue('id', $id);
			$sqlUpdateSubcategory->execute();

			// --- GRAVAR LOG ---


			$description = 'ATUALIZAR SUBCATEGORIA ' . $id;
			$sqlLog = "UPDATE subcategory SET
			name = $name, 
			category_id = $category, 
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
			// --------------------------------- CADASTRAR NOVA SUBCATEGORIA ------------------------

			$sqlInsertSubcategory = "INSERT INTO subcategory (category_id, name, status, user_register, date_register) VALUES (:category, :name, :status, :user_register, :date_register)";
			$sqlInsertSubcategory = $pdo->prepare($sqlInsertSubcategory);
			$sqlInsertSubcategory->bindValue('category', $category);
			$sqlInsertSubcategory->bindValue('name', $name);
			$sqlInsertSubcategory->bindValue('status', $status);
			$sqlInsertSubcategory->bindValue('user_register', $id_user);
			$sqlInsertSubcategory->bindValue('date_register', $dateTime);
			$sqlInsertSubcategory->execute();

			// --- GRAVAR LOG ---


			$description = 'CADASTRAR NOVA SUBCATEGORIA';
			$sqlLog = "INSERT INTO subcategory 
			category_id = $category,
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

			$retorno = array('codigo' => 1, 'mensagem' => 'Subcategoria Cadastrada com Sucesso!');
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



// ******************************** FIM - GRAVAR / EDITAR SUBCATEGORIA - BRUNO R. BERNAL - 18/01/2022 *****************



?>