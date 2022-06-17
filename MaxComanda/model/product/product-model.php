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


$imgFolder = $_SERVER['DOCUMENT_ROOT'] . "/" . $directory . "/uploads/";
/*
$imgFolder = $directory . '/uploads/';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
  if (file_exists($tag . $imgFolder)) {
    $parametro = 'n';
  } else {
    $tag = '../' . $tag;
  }
}
$imgFolder = $tag . $imgFolder;*/
//echo $imgFolder;

// ********************************** EDITAR COMPLEMENTO - BRUNO R. BERNAL - 10/02/2022 **********************

if (isset($_GET['editAddition'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$status = anti_injection($_GET['status']);
	$status = filter_var($status, FILTER_SANITIZE_STRING);

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$value = anti_injection($_GET['value']);
	$value = filter_var($value, FILTER_SANITIZE_STRING);
	if (!empty($value)) {
		$value = $value;
		$value = str_replace('.', '', $value);
		$value = str_replace(',', '.', $value);
	} else {
		$value = 0.00;
	}


	$pdo->beginTransaction();

	try {

			// --- EDITAR COMPLEMENTO ---
			$updAddition = "UPDATE product_addition SET status = :status, value = :value WHERE id = :id";
			$updAddition = $pdo->prepare($updAddition);
			$updAddition->bindValue('status', $status);
			$updAddition->bindValue('value', $value);
			$updAddition->bindValue('id', $id);
			$updAddition->execute();

			// --- GRAVAR LOG ---


			$description = 'EDITAR COMPLEMENTO';
			$sqlLog = "UPDATE product_flavor SET status = $status, value = $value WHERE id = $id";
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

			$retorno = array('codigo' => 1, 'mensagem' => 'Complemento Atualizado com Sucesso!');
			echo json_encode($retorno);
			exit();
		
	} catch (Exception $e) {

		$pdo->rollback();

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro: ' . $e);
		echo json_encode($retorno);
		exit();
	}
}


// ******************************* FIM - EDITAR COMPLEMENTO - BRUNO R. BERNAL - 10/02/2022 **********************

// ********************************** GRAVAR COMPLEMENTO - BRUNO R. BERNAL - 10/02/2022 **********************

if (isset($_GET['saveAddition'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$name = anti_injection($_POST['nameAddition']);
	$name = filter_var($name, FILTER_SANITIZE_STRING);

	$id = anti_injection($_GET['product_id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$value = anti_injection($_POST['valueAddition']);
	$value = filter_var($value, FILTER_SANITIZE_STRING);
	if (!empty($value)) {
		$value = $value;
		$value = str_replace('.', '', $value);
		$value = str_replace(',', '.', $value);
	} else {
		$value = 0.00;
	}


	$pdo->beginTransaction();

	try {

		// --- VERIFICAR SE JÁ EXISTE COMPLEMENTO COM ESSE NOME CADASTRADO PARA ESTE PRODUTO ---
		$verifyFlavor = "SELECT id FROM product_addition WHERE name = :name AND product_id = :product_id";
		$verifyFlavor = $pdo->prepare($verifyFlavor);
		$verifyFlavor->bindValue('name', $name);
		$verifyFlavor->bindValue('product_id', $id);
		$verifyFlavor->execute();
		if ($rowFlavor = $verifyFlavor->fetch()) {

			$retorno = array('codigo' => 0, 'mensagem' => 'Já existe um Complemento Cadastrado com este nome para este produto');
			echo json_encode($retorno);
			exit();
		} else {
			// --- GRAVAR SABOR ---
			$addFlavor = "INSERT INTO product_addition (product_id, name,status,value) VALUES (:product_id, :name, :status, :value)";
			$addFlavor = $pdo->prepare($addFlavor);
			$addFlavor->bindValue('product_id', $id);
			$addFlavor->bindValue('name', $name);
			$addFlavor->bindValue('status', 'Ativo');
			$addFlavor->bindValue('value', $value);
			$addFlavor->execute();

			// --- GRAVAR LOG ---


			$description = 'CADASTRAR COMPLEMENTO';
			$sqlLog = "INSERT INTO product_addition (product_id, name, status, value) VALUES ($id, $name, 'Ativo', $value)";
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

			$retorno = array('codigo' => 1, 'mensagem' => 'Complemento Registrado com Sucesso!');
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


// ******************************* FIM - GRAVAR COMPLEMENTO - BRUNO R. BERNAL - 10/02/2022 **********************

// ********************************** LISTAR COMPLEMENTOS - BRUNO R. BERNAL - 10/02/2022 **********************

if (isset($_GET['listAddition'])) {

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);


	$sqlSearchAddition = "SELECT * FROM product_addition WHERE product_id = $id";
	$sqlSearchAddition = $pdo->prepare($sqlSearchAddition);
	$sqlSearchAddition->execute();


}


// ******************************* FIM - LISTAR COMPLEMENTOS - BRUNO R. BERNAL - 10/02/2022 **********************

// ********************************** EDITAR SABOR - BRUNO R. BERNAL - 10/02/2022 **********************

if (isset($_GET['editFlavor'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$status = anti_injection($_GET['status']);
	$status = filter_var($status, FILTER_SANITIZE_STRING);

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$description = anti_injection($_GET['description']);
	$description = filter_var($description, FILTER_SANITIZE_STRING);


	$pdo->beginTransaction();

	try {

			// --- EDITAR SABOR ---
			$updFlavor = "UPDATE product_flavor SET status = :status, description = :description WHERE id = :id";
			$updFlavor = $pdo->prepare($updFlavor);
			$updFlavor->bindValue('status', $status);
			$updFlavor->bindValue('description', $description);
			$updFlavor->bindValue('id', $id);
			$updFlavor->execute();

			// --- GRAVAR LOG ---


			$description = 'EDITAR SABOR';
			$sqlLog = "UPDATE product_flavor SET status = $status, description = $description WHERE id = $id";
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

			$retorno = array('codigo' => 1, 'mensagem' => 'Sabor Atualizado com Sucesso!');
			echo json_encode($retorno);
			exit();
		
	} catch (Exception $e) {

		$pdo->rollback();

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro: ' . $e);
		echo json_encode($retorno);
		exit();
	}
}


// ******************************* FIM - EDITAR SABOR - BRUNO R. BERNAL - 10/02/2022 **********************

// ********************************** GRAVAR SABOR - BRUNO R. BERNAL - 10/02/2022 **********************

if (isset($_GET['saveFlavor'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$name = anti_injection($_POST['nameFlavor']);
	$name = filter_var($name, FILTER_SANITIZE_STRING);

	$id = anti_injection($_GET['product_id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$description = anti_injection($_POST['descriptionFlavor']);
	$description = filter_var($description, FILTER_SANITIZE_STRING);


	$pdo->beginTransaction();

	try {

		// --- VERIFICAR SE JÁ EXISTE SABOR COM ESSE NOME CADASTRADO PARA ESTE PRODUTO ---
		$verifyFlavor = "SELECT id FROM product_flavor WHERE name = :name AND product_id = :product_id";
		$verifyFlavor = $pdo->prepare($verifyFlavor);
		$verifyFlavor->bindValue('name', $name);
		$verifyFlavor->bindValue('product_id', $id);
		$verifyFlavor->execute();
		if ($rowFlavor = $verifyFlavor->fetch()) {

			$retorno = array('codigo' => 0, 'mensagem' => 'Já existe um Sabor Cadastrado com este nome para este produto');
			echo json_encode($retorno);
			exit();
		} else {
			// --- GRAVAR SABOR ---
			$addFlavor = "INSERT INTO product_flavor (product_id, name, description,status) VALUES (:product_id, :name, :description, :status)";
			$addFlavor = $pdo->prepare($addFlavor);
			$addFlavor->bindValue('product_id', $id);
			$addFlavor->bindValue('name', $name);
			$addFlavor->bindValue('description', $description);
			$addFlavor->bindValue('status', 'Ativo');
			$addFlavor->execute();

			// --- GRAVAR LOG ---


			$description = 'CADASTRAR SABOR';
			$sqlLog = "INSERT INTO product_flavor (product_id, name, description, status) VALUES ($id, $name, $description, 'Ativo')";
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

			$retorno = array('codigo' => 1, 'mensagem' => 'Sabor Registrado com Sucesso!');
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


// ******************************* FIM - GRAVAR SABOR - BRUNO R. BERNAL - 10/02/2022 **********************

// ********************************** LISTAR SABORES - BRUNO R. BERNAL - 10/02/2022 **********************

if (isset($_GET['listFlavor'])) {

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);


	$sqlSearchFlavor = "SELECT * FROM product_flavor WHERE product_id = $id";
	$sqlSearchFlavor = $pdo->prepare($sqlSearchFlavor);
	$sqlSearchFlavor->execute();

	
}


// ******************************* FIM - LISTAR SABORES - BRUNO R. BERNAL - 10/02/2022 **********************


// ********************************** GRAVAR / EDITAR ENTRADA - BRUNO R. BERNAL - 20/01/2022 *****************

if (!empty($_GET['saveAdjustment'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$providerID = anti_injection($_POST['providerIDAdjustment']);
	$providerID = filter_var($providerID, FILTER_SANITIZE_STRING);

	$uniqID = anti_injection($_GET['uniqID']);
	$uniqID = filter_var($uniqID, FILTER_SANITIZE_STRING);

	$quantity = anti_injection($_POST['quantityAdjustment']);
	$quantity = filter_var($quantity, FILTER_SANITIZE_STRING);

	$description = anti_injection($_POST['descriptionAdjustment']);
	$description = filter_var($description, FILTER_SANITIZE_STRING);

	$typeAdjustment = anti_injection($_POST['typeAdjustment']);
	$typeAdjustment = filter_var($typeAdjustment, FILTER_SANITIZE_STRING);




	$pdo->beginTransaction();

	try {

		// --------------------------------- LANÇAR ENTRADA DOS PRODUTOS ------------------------

		$sqlInsertAdjustment = "INSERT INTO stock_adjustment (uniqID, company_id, provider_id, quantity, user_register, date_register,description, type) VALUES (:uniqID, :company_id, :provider_id, :quantity, :user_register, :date_register, :description, :type)";
		$sqlInsertAdjustment = $pdo->prepare($sqlInsertAdjustment);
		$sqlInsertAdjustment->bindValue('uniqID', $uniqID);
		$sqlInsertAdjustment->bindValue('company_id', $id_company);
		$sqlInsertAdjustment->bindValue('provider_id', $providerID);
		$sqlInsertAdjustment->bindValue('quantity', $quantity);
		$sqlInsertAdjustment->bindValue('user_register', $id_user);
		$sqlInsertAdjustment->bindValue('date_register', $dateTime);
		$sqlInsertAdjustment->bindValue('description', $description);
		$sqlInsertAdjustment->bindValue('type', $typeAdjustment);
		$sqlInsertAdjustment->execute();

		// --------------------------------- FIM - LANÇAR ENTRADA DOS PRODUTOS ------------------------

		// --- GRAVAR LOG ---


		$description = 'MOVIMENTAÇÃO DE PRODUTO';
		$sqlLog = "INSERT INTO stock_adjustment SET 
			uniqID = $uniqID,
			company_id = $id_company,
			provider_id = $providerID,
			description = $description,
			quantity = $quantity,
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

		$retorno = array('codigo' => 1, 'mensagem' => 'Movimentação Registrada com Sucesso!');
		echo json_encode($retorno);
		exit();
	} catch (Exception $e) {

		$pdo->rollback();

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro: ' . $e);
		echo json_encode($retorno);
		exit();
	}
}



// ******************************** FIM - GRAVAR / EDITAR ENTRADA - BRUNO R. BERNAL - 20/01/2022 *****************

// ******************************* PESQUISAR MOVIMENTAÇÃO DE PRODUTOS - BRUNO R. BERNAL - 19/01/2022 ********************

if (isset($_GET['searchAdjustment'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$uniqID = anti_injection($_GET['uniqID']);
	$uniqID = filter_var($uniqID, FILTER_SANITIZE_STRING);

	$providerID = anti_injection($_POST['providerID']);
	$providerID = filter_var($providerID, FILTER_SANITIZE_STRING);
	if (!empty($providerID)) {
		$AND_providerID = " AND a.provider_id = $providerID ";
	} else {
		$AND_providerID = "";
	}

	$type = anti_injection($_POST['type']);
	$type = filter_var($type, FILTER_SANITIZE_STRING);
	if (!empty($type)) {
		$AND_type = " AND a.type = '$type' ";
	} else {
		$AND_type = "";
	}


	$registerStart = anti_injection($_POST['registerStart']);
	$registerStart = filter_var($registerStart, FILTER_SANITIZE_STRING);
	if (!empty($registerStart)) {
		$registerStart = $registerStart;
		$registerStart = explode('/', $registerStart);
		$registerStart = $registerStart[2] . '-' . $registerStart[1] . '-' . $registerStart[0];
		$AND_registerStart = " AND a.date_register >= '$registerStart'";
	} else {
		$AND_registerStart = "";
	}

	$registerEnd = anti_injection($_POST['registerEnd']);
	$registerEnd = filter_var($registerEnd, FILTER_SANITIZE_STRING);
	if (!empty($registerEnd)) {
		$registerEnd = $registerEnd;
		$registerEnd = explode('/', $registerEnd);
		$registerEnd = $registerEnd[2] . '-' . $registerEnd[1] . '-' . $registerEnd[0];
		$AND_registerEnd = " AND a.date_register <= '$registerEnd 23:59:59'";
	} else {
		$AND_registerEnd = "";
	}




	$sqlSearchAdjustment = "SELECT c.name as user_register_name, b.name_razao_social as provider_name, a.* FROM stock_adjustment a 
	LEFT JOIN provider b ON a.provider_id = b.id 
	LEFT JOIN user c ON a.user_register = c.id 
	WHERE a.company_id = $id_company AND a.uniqID = '$uniqID' $AND_providerID $AND_type $AND_registerStart $AND_registerEnd";
	$sqlSearchAdjustment = $pdo->prepare($sqlSearchAdjustment);
	$sqlSearchAdjustment->execute();

	// --- GRAVAR LOG ---


	$description = 'CONSULTAR MOVIMENTAÇÃO DE PRODUTOS';
	$sqlLog = "SELECT * FROM stock_adjustment WHERE company_id = $id_company AND uniqID = $uniqID $AND_providerID $AND_type $AND_registerStart $AND_registerEnd";
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


// ************************ FIM - PESQUISAR MOVIMENTAÇÃO DE PRODUTOS - BRUNO R. BERNAL - 19/01/2022 ********************

// ******************************* SELECIONAR FORNECEDOR NO MODAL - BRUNO R. BERNAL - 19/01/2022 ***************
/*
if (isset($_GET['selectProvider'])) {

	$id = anti_injection($_GET['providerID']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$pdo->beginTransaction();

	try {

		$sqlSelectProvider = "SELECT id, name_razao_social FROM provider WHERE id = :id";
		$sqlSelectProvider = $pdo->prepare($sqlSelectProvider);
		$sqlSelectProvider->bindValue('id', $id);
		$sqlSelectProvider->execute();

		if ($rowProvider = $sqlSelectProvider->fetch()) {
			$provider_id = $rowProvider->id;
			$provider_name = $rowProvider->name_razao_social;




			$retorno = array('codigo' => 1, 'mensagem' => 'Fornecedor Selecionado!', 'name' => $provider_name, 'id' => $provider_id);
			echo json_encode($retorno);
			exit();
		} else {

			$retorno = array('codigo' => 0, 'mensagem' => 'Fornecedor não Encontrado!');
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
*/
// ******************************* FIM - SELECIONAR FORNECEDOR NO MODAL - BRUNO R. BERNAL - 19/01/2022 ***************

// ******************************** PESQUISAR FORNECEDOR NO MODAL - BRUNO R. BERNAL - 19/01/2022 ********************
/*
if (isset($_GET['searchProvider'])) {

	$providerName = anti_injection($_GET['providerName']);
	$providerName = filter_var($providerName, FILTER_SANITIZE_STRING);
	if (!empty($providerName)) {
		$AND_providerName = "AND name_razao_social like '%$providerName%' OR fantasia like '%$providerName%' ";
	} else {
		$AND_providerName = "";
	}

	$sqlSearchProvider = "SELECT * FROM provider WHERE status = 'Ativo' $AND_providerName";
	$sqlSearchProvider = $pdo->prepare($sqlSearchProvider);
	$sqlSearchProvider->execute();

	// --- GRAVAR LOG ---


	$description = 'CONSULTAR FORNECEDOR';
	$sqlLog = "SELECT * FROM provider WHERE status = 'Ativo' $AND_providerName";
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

*/
// **************************** FIM - PESQUISAR FORNECEDOR NO MODAL - BRUNO R. BERNAL - 19/01/2022 ******************

// ******************************* SELECIONAR FORNECEDOR NO MODAL - BRUNO R. BERNAL - 19/01/2022 ***************
/*
if (isset($_GET['selectProvider'])) {

	$id = anti_injection($_GET['providerID']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$pdo->beginTransaction();

	try {

		$sqlSelectProvider = "SELECT id, name_razao_social FROM provider WHERE id = :id";
		$sqlSelectProvider = $pdo->prepare($sqlSelectProvider);
		$sqlSelectProvider->bindValue('id', $id);
		$sqlSelectProvider->execute();

		if ($rowProvider = $sqlSelectProvider->fetch()) {
			$provider_id = $rowProvider->id;
			$provider_name = $rowProvider->name_razao_social;




			$retorno = array('codigo' => 1, 'mensagem' => 'Fornecedor Selecionado!', 'name' => $provider_name, 'id' => $provider_id);
			echo json_encode($retorno);
			exit();
		} else {

			$retorno = array('codigo' => 0, 'mensagem' => 'Fornecedor não Encontrado!');
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
*/
// ******************************* FIM - SELECIONAR FORNECEDOR NO MODAL - BRUNO R. BERNAL - 19/01/2022 ***************

// ************************ DELETAR IMAGEM DO PRODUTO - BRUNO R. BERNAL - 19/01/2022 *****************************

if (!empty($_GET['deleteProductImg'])) {
	try {

		$directory = anti_injection($_GET['directory']);
		$directory = filter_var($directory, FILTER_SANITIZE_STRING);

		$imgFolder = $_SERVER['DOCUMENT_ROOT'] . "/" . $directory . "/uploads/";

		$id_user = anti_injection($_GET['id_user']);
		$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

		$id_company = anti_injection($_GET['id_company']);
		$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

		$id = anti_injection($_POST['id']);
		$id = filter_var($id, FILTER_SANITIZE_STRING);

		$product_id = anti_injection($_POST['product_id']);
		$product_id = filter_var($product_id, FILTER_SANITIZE_STRING);

		$sqlImgName = "SELECT img FROM product_img WHERE id = :id";
		$sqlImgName = $pdo->prepare($sqlImgName);
		$sqlImgName->bindValue('id', $id);
		$sqlImgName->execute();
		$rowImgName = $sqlImgName->fetch();
		$imgName = $rowImgName->img;

		unlink($imgFolder . "productImg/" . $imgName);


		$sqlDeleteImg = "DELETE FROM product_img 
		where id = :id";
		$sqlDeleteImg = $pdo->prepare($sqlDeleteImg);
		$sqlDeleteImg->bindValue('id', $id);
		$sqlDeleteImg->execute();


		// --- GRAVAR LOG ---


		$description = "DELETAR IMAGEM $id DO PRODUTO $product_id";
		$sqlLog = "DELETE FROM product_img 
	where id = $id";
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


		$sqlSearchProductImg = "SELECT id, id_product, img, main_img FROM product_img WHERE id_product = :id_product";
		$sqlSearchProductImg = $pdo->prepare($sqlSearchProductImg);
		$sqlSearchProductImg->bindValue('id_product', $product_id);
		$sqlSearchProductImg->execute();
	} catch (Exception $e) {






		// --- GRAVAR LOG ---


		$description = "ERRO AO DELETAR IMAGEM $id DO PRODUTO $client_id";
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

		$sqlSearchProductImg = "SELECT id, id_product, img, main_img FROM product_img WHERE id_product = :id_product";
		$sqlSearchProductImg = $pdo->prepare($sqlSearchProductImg);
		$sqlSearchProductImg->bindValue('id_product', $product_id);
		$sqlSearchProductImg->execute();
	}
}



// *********************** FIM - DELETAR IMAGEM DO PRODUTO - BRUNO R. BERNAL - 19/01/2022 *********************

// *********************************** DEFINIR IMAGEM PRINCIPAL - BRUNO R. BERNAL - 19/01/2022 ***************


if (isset($_GET['mainImg'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$id_product = anti_injection($_GET['id_product']);
	$id_product = filter_var($id_product, FILTER_SANITIZE_STRING);

	$mainImg = "UPDATE product_img SET 
	main_img = 'S',
	user_update = :user_update,
	last_update = :last_update
	WHERE id = :id";
	$mainImg = $pdo->prepare($mainImg);
	$mainImg->bindValue('id', $id);
	$mainImg->bindValue('user_update', $id_user);
	$mainImg->bindValue('last_update', $dateTime);
	$mainImg->execute();

	// --- DEFINIR AS OUTRAS IMAGENS COMO 'N' ---

	$sqlImg = "UPDATE product_img SET
	main_img = 'N',
	user_update = :user_update,
	last_update = :last_update
	WHERE id != :id AND id_product = :id_product";
	$sqlImg = $pdo->prepare($sqlImg);
	$sqlImg->bindValue('id', $id);
	$sqlImg->bindValue('id_product', $id_product);
	$sqlImg->bindValue('user_update', $id_user);
	$sqlImg->bindValue('last_update', $dateTime);
	$sqlImg->execute();



	// --- FIM - DEFINIR AS OUTRAS IMAGENS COMO 'N' ---



	// --- GRAVAR LOG ---


	$description = 'DEFINIR IMAGEM PADRÃO DO PRODUTO ' . $id_product;
	$sqlLog = "UPDATE product_img SET 
	main_img = S
	user_register = $id_user,
	date_register = $dateTime
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







	$sqlSearchProductImg = "SELECT id, id_product, img, main_img FROM product_img WHERE id_product = :id_product";
	$sqlSearchProductImg = $pdo->prepare($sqlSearchProductImg);
	$sqlSearchProductImg->bindValue('id_product', $id_product);
	$sqlSearchProductImg->execute();
}





// *********************************** FIM - DEFINIR IMAGEM PRINCIPAL - BRUNO R. BERNAL - 19/01/2022 ***************


// ***************************** LISTAR IMAGENS - BRUNO R. BERNAL - 19/01/2022 *************************

if (isset($_GET['listProductImg'])) {

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$sqlSearchProductImg = "SELECT id, id_product, img, main_img FROM product_img WHERE id_product = :id_product";
	$sqlSearchProductImg = $pdo->prepare($sqlSearchProductImg);
	$sqlSearchProductImg->bindValue('id_product', $id);
	$sqlSearchProductImg->execute();
}


// ***************************** FIM - LISTAR IMAGENS - BRUNO R. BERNAL - 19/01/2022 *************************


// *********************** ENVIAR IMAGENS DOS PRODUTOS - BRUNO R. BERNAL - 19/01/2022 ***********************


if (isset($_GET['sendProductImg'])) {

	$directory = anti_injection($_GET['directory']);
	$directory = filter_var($directory, FILTER_SANITIZE_STRING);

	$imgFolder = $_SERVER['DOCUMENT_ROOT'] . "/" . $directory . "/uploads/";

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	// --- GRAVAR IMAGEM ---

	if (!empty($_FILES['productImg']['name'])) {
		$novoNome = uniqid();
		$file_extension = pathinfo($_FILES['productImg']['name'], PATHINFO_EXTENSION);
		$file_extension = strtolower($file_extension);
		$filename = $novoNome . "." . $file_extension;
		$location = $imgFolder . "productImg/" . $filename;

		// Valid image extensions
		$image_ext = array("jpg", "png", "jpeg");

		if (in_array($file_extension, $image_ext)) {



			if (move_uploaded_file($_FILES['productImg']['tmp_name'], $location)) {



				// --- GRAVAR IMAGEM NA TABELA ---

				$sqlProductImg = "INSERT INTO product_img (id_product, img, main_img, user_register, date_register) VALUES (:id_product, :img, :main_img, :user_register, :date_register)";
				$sqlProductImg = $pdo->prepare($sqlProductImg);
				$sqlProductImg->bindValue('id_product', $id);
				$sqlProductImg->bindValue('img', $filename);
				$sqlProductImg->bindValue('main_img', "N");
				$sqlProductImg->bindValue('user_register', $id_user);
				$sqlProductImg->bindValue('date_register', $dateTime);
				$sqlProductImg->execute();

				// --- GRAVAR IMAGEM NA TABELA ---

				// --- GRAVAR LOG ---


				$description = 'ADICIONAR IMAGEM AO PRODUTO ' . $id;
				$sqlLog = "INSERT INTO product_img SET 
			id_product = $id,
			img = $filename,
			main_img = N
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

?>
				<script>
					showAlert("Imagem Enviada com Sucesso!", 'green', 3000);
				</script>
			<?php


			} else {
			?>
				<script>
					showAlert("Erro ao Enviar Imagem!", 'red', 3000);
				</script>
			<?php
			}
		} else {
			?>
			<script>
				showAlert("Formato de Imagem Inválido!", 'red', 3000);
			</script>
		<?php
		}
	} else {
		?>
		<script>
			showAlert("Nenhuma Imagem Encontrada!", 'red', 3000);
		</script>
<?php
	}

	// --- FIM - GRAVAR IMAGEM ---

	$sqlSearchProductImg = "SELECT id, id_product, img, main_img FROM product_img WHERE id_product = :id_product";
	$sqlSearchProductImg = $pdo->prepare($sqlSearchProductImg);
	$sqlSearchProductImg->bindValue('id_product', $id);
	$sqlSearchProductImg->execute();
}

// *********************** FIM - ENVIAR IMAGENS DOS PRODUTOS - BRUNO R. BERNAL - 19/01/2022 ***********************



// ********************************** GRAVAR / EDITAR PRODUTO - BRUNO R. BERNAL - 18/01/2022 *****************

if (!empty($_GET['saveProduct'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id = anti_injection($_POST['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$location = anti_injection($_POST['location']);
	$location = filter_var($location, FILTER_SANITIZE_STRING);

	$subcategory = anti_injection($_POST['subcategory']);
	$subcategory = filter_var($subcategory, FILTER_SANITIZE_STRING);

	$name = anti_injection($_POST['name']);
	$name = filter_var($name, FILTER_SANITIZE_STRING);

	$sale_value = anti_injection($_POST['sale_value']);
	$sale_value = filter_var($sale_value, FILTER_SANITIZE_STRING);
	if (!empty($sale_value)) {
		$sale_value = $sale_value;
		$sale_value = str_replace('.', '', $sale_value);
		$sale_value = str_replace(',', '.', $sale_value);
	}

	$cost_value = anti_injection($_POST['cost_value']);
	$cost_value = filter_var($cost_value, FILTER_SANITIZE_STRING);
	if (!empty($cost_value)) {
		$cost_value = $cost_value;
		$cost_value = str_replace('.', '', $cost_value);
		$cost_value = str_replace(',', '.', $cost_value);
	} else {
		$cost_value = 0.00;
	}

	$minimum_stock = anti_injection($_POST['minimum_stock']);
	$minimum_stock = filter_var($minimum_stock, FILTER_SANITIZE_STRING);

	$local_menu = anti_injection($_GET['local_menu']);
	$local_menu = filter_var($local_menu, FILTER_SANITIZE_STRING);

	$online_menu = anti_injection($_GET['online_menu']);
	$online_menu = filter_var($online_menu, FILTER_SANITIZE_STRING);

	$morning = anti_injection($_GET['morning']);
	$morning = filter_var($morning, FILTER_SANITIZE_STRING);

	$afternoon = anti_injection($_GET['afternoon']);
	$afternoon = filter_var($afternoon, FILTER_SANITIZE_STRING);

	$night = anti_injection($_GET['night']);
	$night = filter_var($night, FILTER_SANITIZE_STRING);

	$defineStock = anti_injection($_GET['defineStock']);
	$defineStock = filter_var($defineStock, FILTER_SANITIZE_STRING);

	$status = anti_injection($_GET['status']);
	$status = filter_var($status, FILTER_SANITIZE_STRING);

	$kitchen = anti_injection($_GET['kitchen']);
	$kitchen = filter_var($kitchen, FILTER_SANITIZE_STRING);

	$description = anti_injection($_POST['description']);
	$description = filter_var($description, FILTER_SANITIZE_STRING);

	$fraction = anti_injection($_POST['fraction']);
	$fraction = filter_var($fraction, FILTER_SANITIZE_STRING);

	$uniqID = uniqid();


	$pdo->beginTransaction();

	try {

		// --- VERIFICAR SE EXISTE PRODUTO COM ESTE NOME NA EMPRESA ---

		$sqlCompare = "SELECT id FROM product WHERE name = :name AND company_id = :id_company";
		$sqlCompare = $pdo->prepare($sqlCompare);
		$sqlCompare->bindValue('name', $name);
		$sqlCompare->bindValue('id_company', $id_company);
		$sqlCompare->execute();
		if ($sqlCompare->rowCount() > 0) {
			// --------------------------------- ATUALIZAR DADOS ------------------------


			$sqlUpdateProduct = 'UPDATE product SET 
			location_id = :location,
			subcategory_id = :subcategory,
			name = :name,
			sale_value = :sale_value,
			cost_value = :cost_value,
			minimum_stock = :minimum_stock,
			local_menu = :local_menu,
			online_menu = :online_menu,
			user_update = :user_update,
			last_update = :last_update,
			morning = :morning,
			afternoon = :afternoon,
			night = :night,
			defineStock = :defineStock,
			status = :status,
			kitchen = :kitchen,
			fraction = :fraction,
			description = :description
			WHERE id = :id';
			$sqlUpdateProduct = $pdo->prepare($sqlUpdateProduct);
			$sqlUpdateProduct->bindValue('location', $location);
			$sqlUpdateProduct->bindValue('subcategory', $subcategory);
			$sqlUpdateProduct->bindValue('name', $name);
			$sqlUpdateProduct->bindValue('sale_value', $sale_value);
			$sqlUpdateProduct->bindValue('cost_value', $cost_value);
			$sqlUpdateProduct->bindValue('minimum_stock', $minimum_stock);
			$sqlUpdateProduct->bindValue('local_menu', $local_menu);
			$sqlUpdateProduct->bindValue('online_menu', $online_menu);
			$sqlUpdateProduct->bindValue('user_update', $id_user);
			$sqlUpdateProduct->bindValue('last_update', $dateTime);
			$sqlUpdateProduct->bindValue('morning', $morning);
			$sqlUpdateProduct->bindValue('afternoon', $afternoon);
			$sqlUpdateProduct->bindValue('night', $night);
			$sqlUpdateProduct->bindValue('defineStock', $defineStock);
			$sqlUpdateProduct->bindValue('status', $status);
			$sqlUpdateProduct->bindValue('kitchen', $kitchen);
			$sqlUpdateProduct->bindValue('fraction', $fraction);
			$sqlUpdateProduct->bindValue('description', $description);
			$sqlUpdateProduct->bindValue('id', $id);
			$sqlUpdateProduct->execute();

			// --- GRAVAR LOG ---


			$description = 'ATUALIZAR PRODUTO ' . $id;
			$sqlLog = "UPDATE product SET 
			location_id = $location,
			subcategory_id = $subcategory,
			name = $name,
			sale_value = $sale_value,
			cost_value = $cost_value,
			minimum_stock = $minimum_stock,
			local_menu = $local_menu,
			online_menu = $online_menu,
			user_update = $id_user,
			last_update = $dateTime,
			morning = $morning,
			afternoon = $afternoon,
			night = $night,
			defineStock = $defineStock,
			status = $status,
			kitchen = $kitchen,
			fraction = $fraction,
			description = $description
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

			$retorno = array('codigo' => 1, 'mensagem' => 'Dados Atualizados com Sucesso!', 'pg' => "product");
			echo json_encode($retorno);
			exit();
		} else {
			// --------------------------------- CADASTRAR NOVO PRODUTO ------------------------

			$sqlInsertProduct = "INSERT INTO product (company_id, name, sale_value, cost_value, minimum_stock, local_menu, online_menu, subcategory_id, location_id, user_register, date_register, morning, afternoon, night, defineStock, uniqID, status, kitchen, fraction, description) VALUES (:company_id, :name, :sale_value, :cost_value, :minimum_stock, :local_menu, :online_menu, :subcategory_id, :location_id, :user_register, :date_register, :morning, :afternoon, :night, :defineStock, :uniqID, :status, :kitchen, :fraction, :description)";
			$sqlInsertProduct = $pdo->prepare($sqlInsertProduct);
			$sqlInsertProduct->bindValue('company_id', $id_company);
			$sqlInsertProduct->bindValue('name', $name);
			$sqlInsertProduct->bindValue('sale_value', $sale_value);
			$sqlInsertProduct->bindValue('cost_value', $cost_value);
			$sqlInsertProduct->bindValue('minimum_stock', $minimum_stock);
			$sqlInsertProduct->bindValue('local_menu', $local_menu);
			$sqlInsertProduct->bindValue('online_menu', $online_menu);
			$sqlInsertProduct->bindValue('subcategory_id', $subcategory);
			$sqlInsertProduct->bindValue('location_id', $location);
			$sqlInsertProduct->bindValue('user_register', $id_user);
			$sqlInsertProduct->bindValue('date_register', $dateTime);
			$sqlInsertProduct->bindValue('morning', $morning);
			$sqlInsertProduct->bindValue('afternoon', $afternoon);
			$sqlInsertProduct->bindValue('night', $night);
			$sqlInsertProduct->bindValue('defineStock', $defineStock);
			$sqlInsertProduct->bindValue('uniqID', $uniqID);
			$sqlInsertProduct->bindValue('status', $status);
			$sqlInsertProduct->bindValue('kitchen', $kitchen);
			$sqlInsertProduct->bindValue('fraction', $fraction);
			$sqlInsertProduct->bindValue('description', $description);
			$sqlInsertProduct->execute();

			// --- GRAVAR LOG ---


			$description = 'CADASTRAR NOVO PRODUTO';
			$sqlLog = "INSERT INTO product SET 
			company_id = $id_company,
			location_id = $location,
			subcategory_id = $subcategory,
			name = $name,
			sale_value = $sale_value,
			cost_value = $cost_value,
			minimum_stock = $minimum_stock,
			local_menu = $local_menu,
			online_menu = $online_menu,
			user_update = $id_user,
			last_update = $dateTime,
			morning = $morning,
			afternoon = $afternoon,
			night = $night,
			defineStock = $defineStock,
			status = $status,
			uniqID = $uniqID,
			kitchen = $kitchen,
			fraction = $fraction,
			description = $description";
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

			$sqlSelectID = "SELECT id FROM product WHERE name = :name AND company_id = :id_company";
			$sqlSelectID = $pdo->prepare($sqlSelectID);
			$sqlSelectID->bindValue('name', $name);
			$sqlSelectID->bindValue('id_company', $id_company);
			$sqlSelectID->execute();
			$rowID = $sqlSelectID->fetch();
			$id = $rowID->id;

			$retorno = array('codigo' => 1, 'mensagem' => 'Produto Cadastrado com Sucesso!', 'pg' => "data-product&idProduct=$id#images");
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



// ******************************** FIM - GRAVAR / EDITAR PRODUTO - BRUNO R. BERNAL - 18/01/2022 *****************

// ********************************* LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 ******************

$sqlCompany = "SELECT id, name_razao_social FROM company";
$sqlCompany = $pdo->prepare($sqlCompany);
$sqlCompany->execute();

$sqlLocation = "SELECT id, name FROM location_product WHERE status = 'Ativo' ";
$sqlLocation = $pdo->prepare($sqlLocation);
$sqlLocation->execute();

$sqlSubcategory = "SELECT id, name FROM subcategory WHERE status = 'Ativo' ";
$sqlSubcategory = $pdo->prepare($sqlSubcategory);
$sqlSubcategory->execute();

$sqlProvider = "SELECT id, name_razao_social FROM provider WHERE status = 'Ativo' ";
$sqlProvider = $pdo->prepare($sqlProvider);
$sqlProvider->execute();

$sqlProviderAdjustment = "SELECT id, name_razao_social FROM provider WHERE status = 'Ativo' ";
$sqlProviderAdjustment = $pdo->prepare($sqlProviderAdjustment);
$sqlProviderAdjustment->execute();

if (isset($_GET['idProduct'])) {
	$sqlListData = "SELECT f.name as subcategory_name, 
	e.name as location_name, 
	d.name_razao_social as company_name, 
	b.name AS name_user_register, 
	c.name AS name_user_update, 
	a.*,
	((SELECT IFNULL((SELECT SUM(g.quantity) FROM stock_adjustment g 
	WHERE g.uniqID = (SELECT h.uniqID FROM product h WHERE h.id = a.id) 
	AND g.TYPE = 'Entrada'),0) AS 'Entradas')
	-
	(SELECT IFNULL((SELECT SUM(i.quantity) FROM stock_adjustment i 
	WHERE i.uniqID = (SELECT j.uniqID FROM product j WHERE j.id = a.id) 
	AND i.TYPE = 'Saída'),0) AS 'Saídas')
	-
	(SELECT IFNULL((SELECT SUM(k.quantity) FROM order_items k 
	WHERE k.product_id = a.id ),0) AS 'Pedidos')
	
	) AS 'total' 
	FROM product a 
		LEFT JOIN user b ON a.user_register = b.id
		LEFT JOIN user c ON a.user_update = c.id
		LEFT JOIN company d ON a.company_id = d.id
		LEFT JOIN location_product e ON a.location_id = e.id
		LEFT JOIN subcategory f ON a.subcategory_id = f.id
		WHERE a.id = :id";
	$sqlListData = $pdo->prepare($sqlListData);
	$sqlListData->bindValue('id', $_GET['idProduct']);
	$sqlListData->execute();
	$rowData = $sqlListData->fetch();
	$list_id = $rowData->id;
	$list_uniqID = $rowData->uniqID;
	$list_name = $rowData->name;
	$list_sale_value = number_format($rowData->sale_value, 2, '.', '');
	$list_cost_value = number_format($rowData->cost_value, 2, '.', '');
	$list_minimum_stock = $rowData->minimum_stock;
	$list_local_menu = $rowData->local_menu;
	$list_online_menu = $rowData->online_menu;
	$list_user_register = $rowData->name_user_register;
	$list_date_register = $rowData->date_register;
	$list_user_update = $rowData->name_user_update;
	$list_last_update = $rowData->last_update;
	$list_company_id = $rowData->company_id;
	$list_company_name = $rowData->company_name;
	$list_location_id = $rowData->location_id;
	$list_location_name = $rowData->location_name;
	$list_subcategory_id = $rowData->subcategory_id;
	$list_subcategory_name = $rowData->subcategory_name;
	$list_morning = $rowData->morning;
	$list_afternoon = $rowData->afternoon;
	$list_night = $rowData->night;
	$list_defineStock = $rowData->defineStock;
	$list_quantity = $rowData->total;
	$list_status = $rowData->status;
	$list_kitchen = $rowData->kitchen;
	$list_description = $rowData->description;
	$list_fraction = $rowData->fraction;

	$sqlListImg = "SELECT img FROM product_img WHERE id_product = :id_product ORDER BY main_img DESC LIMIT 1";
	$sqlListImg = $pdo->prepare($sqlListImg);
	$sqlListImg->bindValue('id_product', $_GET['idProduct']);
	$sqlListImg->execute();
	if ($rowImg = $sqlListImg->fetch()) {
		$list_img = $rowImg->img;
	} else {
		$list_img = "";
	}
} else {
	$list_id = "";
	$list_uniqID = "";
	$list_name = "";
	$list_sale_value = "";
	$list_cost_value = "";
	$list_minimum_stock = "";
	$list_local_menu = "";
	$list_online_menu = "";
	$list_user_register = "";
	$list_date_register = "";
	$list_user_update = "";
	$list_last_update = "";
	$list_company_id = "";
	$list_company_name = "";
	$list_location_id = "";
	$list_location_name = "";
	$list_subcategory_id = "";
	$list_subcategory_name = "";
	$list_img = "";
	$list_morning = "";
	$list_afternoon = "";
	$list_night = "";
	$list_defineStock = "";
	$list_quantity = "";
	$list_status = "";
	$list_kitchen = "";
	$list_description = "";
	$list_fraction = "";
}




// ********************************* FIM - LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 ******************




// ********************************** PESQUISAR PRODUTO - BRUNO R. BERNAL - 18/01/2022 **********************

if (isset($_GET['searchProduct'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$productName = anti_injection($_GET['productName']);
	$productName = filter_var($productName, FILTER_SANITIZE_STRING);
	if (!empty($productName)) {
		$AND_productName = "AND a.name like '%$productName%'";
	} else {
		$AND_productName = "";
	}

	$sqlSearchProduct = "SELECT c.name_razao_social as company_name, b.name as subcategory_name, a.*, 
	((SELECT IFNULL((SELECT SUM(g.quantity) FROM stock_adjustment g 
WHERE g.uniqID = (SELECT h.uniqID FROM product h WHERE h.id = a.id) 
AND g.TYPE = 'Entrada'),0) AS 'Entradas')
-
(SELECT IFNULL((SELECT SUM(i.quantity) FROM stock_adjustment i 
WHERE i.uniqID = (SELECT j.uniqID FROM product j WHERE j.id = a.id) 
AND i.TYPE = 'Saída'),0) AS 'Saídas')
-
(SELECT IFNULL((SELECT SUM(k.quantity) FROM order_items k 
WHERE k.product_id = a.id ),0) AS 'Pedidos')

) AS 'total'
	FROM product a 
	LEFT JOIN subcategory b ON a.subcategory_id = b.id 
	LEFT JOIN company c ON a.company_id = c.id
	WHERE a.company_id = $id_company 
	$AND_productName";
	$sqlSearchProduct = $pdo->prepare($sqlSearchProduct);
	$sqlSearchProduct->execute();

	// --- GRAVAR LOG ---


	$description = 'CONSULTAR PRODUTO';
	$sqlLog = "SELECT * FROM product $AND_productName";
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


// ******************************* FIM - PESQUISAR PRODUTO - BRUNO R. BERNAL - 18/01/2022 **********************
