<?php

if (!isset($_SESSION)) {
	session_start();
}
if (isset($_GET['directory'])) {
	$directory = $_GET['directory'];
} else {
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


// **************************** GRAVAR / EDITAR - BRUNO R. BERNAL - 17/01/2022 **************************

if (isset($_GET['savePermission'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$idPermission = anti_injection($_GET['idPermission']);
	$idPermission = filter_var($idPermission, FILTER_SANITIZE_STRING);

	$full_permission = anti_injection($_GET['full_permission']);
	$full_permission = filter_var($full_permission, FILTER_SANITIZE_STRING);

	$search = anti_injection($_GET['search']);
	$search = filter_var($search, FILTER_SANITIZE_STRING);

	$include = anti_injection($_GET['include']);
	$include = filter_var($include, FILTER_SANITIZE_STRING);

	$edit = anti_injection($_GET['edit']);
	$edit = filter_var($edit, FILTER_SANITIZE_STRING);


	$pdo->beginTransaction();

	try {

		$sql_update_permissions = "UPDATE permission SET 
				full_permission = :full_permission,
				search = :search,
				include = :include,
				edit = :edit
				WHERE id = :id";
		$sql_update_permissions = $pdo->prepare($sql_update_permissions);
		$sql_update_permissions->bindValue('full_permission', $full_permission);
		$sql_update_permissions->bindValue('search', $search);
		$sql_update_permissions->bindValue('include', $include);
		$sql_update_permissions->bindValue('edit', $edit);
		$sql_update_permissions->bindValue('id', $idPermission);
		$sql_update_permissions->execute();


		// --- GRAVAR LOG ---


		$description = 'ALTERAR PERMISSÕES DO PERFIL '.$idPermission;
		$sqlLog = "update permission set 
		full_permission = $full_permission,
		search = $search,
		include = $include,
		edit = $edit,
		where id = $idPermission";
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

		$retorno = array('codigo' => 1, 'mensagem' => 'Permissões Atualizadas com Sucesso!');
		echo json_encode($retorno);
		exit();
	} catch (Exception $e) {

		$pdo->rollback();

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro: ' . $e);
		echo json_encode($retorno);
		exit();
	}
}


// **************************** FIM - GRAVAR / EDITAR - BRUNO R. BERNAL - 17/01/2022 **************************

//*************************** LISTAR PERMISSOES DO PERFIL *******************************************
if (!empty($_GET['idCompany']) && !empty($_GET['idProfilePermission'])) {

	$idCompany = anti_injection($_GET['idCompany']);
	$idCompany = filter_var($idCompany, FILTER_SANITIZE_STRING);

	$idProfilePermission = anti_injection($_GET['idProfilePermission']);
	$idProfilePermission = filter_var($idProfilePermission, FILTER_SANITIZE_STRING);

	//**************************** INSERIR PERMISSOES DO CODIGO PERFIL *************************************
	$sqlProfile = 'SELECT * FROM permission WHERE id_profile = 0 and menu NOT IN 
(SELECT menu FROM permission WHERE id_company = :id_company AND id_profile= :id_profile)';
	$searchProfile = $pdo->prepare($sqlProfile);
	$searchProfile->bindValue('id_company', $idCompany);
	$searchProfile->bindValue('id_profile', $idProfilePermission);
	$searchProfile->execute();

	while ($listPermission = $searchProfile->fetch()) {

		//************************GRAVA AS PERMISSOES ***********************************
		$sql_insert_permissions = "insert into permission(id_company,id_profile,menu,full_permission,search,include,edit)values(
					:id_company,
					:id_profile,
					:menu,
					:full_permission,
					:search,
					:include,
					:edit)";

		$insert_permissions = $pdo->prepare($sql_insert_permissions);
		$insert_permissions->bindValue('id_company', $_SESSION['id_company']);
		$insert_permissions->bindValue('id_profile', $idProfilePermission);
		$insert_permissions->bindValue('menu', $listPermission->menu);
		$insert_permissions->bindValue('full_permission', $listPermission->full_permission);
		$insert_permissions->bindValue('search', $listPermission->search);
		$insert_permissions->bindValue('include', $listPermission->include);
		$insert_permissions->bindValue('edit', $listPermission->edit);
		$insert_permissions->execute();

		// ---GRAVAR LOG ---

		$description = 'INCLUIR PERMISSÃO';
		$sqlLog = "insert into permission(id_company = " . $_SESSION['id_company'] . ", 
		id_profile = $idProfilePermission, 
		menu = $listPermission->menu, 
		full_permission = $listPermission->full_permission, 
		search = $listPermission->search, 
		include = $listPermission->include, 
		edit = $listPermission->edit)";
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




	$sql = 'SELECT * FROM permission WHERE id_profile = :id_profile and id_company = :id_company';
	$listPermission = $pdo->prepare($sql);
	$listPermission->bindValue('id_profile', $idProfilePermission);
	$listPermission->bindValue('id_company', $idCompany);
	$listPermission->execute();
	//$exibir_permissoes = $consultaEditar->fetch();

	// --- LISTAR NOME DO PERFIL ---
	$listNameProfile = 'SELECT name FROM profile WHERE id = :id';
	$listNameProfile = $pdo->prepare($listNameProfile);
	$listNameProfile->bindValue('id', $_GET['idProfilePermission']);
	$listNameProfile->execute();
	$rowNameProfile = $listNameProfile->fetch();
	$nameProfile = $rowNameProfile->name;
}

//*************************** FIM - LISTAR PERMISSOES DO PERFIL *******************************************
