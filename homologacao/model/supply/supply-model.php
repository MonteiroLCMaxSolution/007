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


		$description = 'MOVIMENTAÇÃO DE SUPRIMENTO';
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

// ******************************* PESQUISAR MOVIMENTAÇÃO DE SUPRIMENTOS - BRUNO R. BERNAL - 19/01/2022 ********************

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


	$description = 'CONSULTAR MOVIMENTAÇÃO DE SUPRIMENTOS';
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


// ********************************** GRAVAR / EDITAR SUPRIMENTO - BRUNO R. BERNAL - 18/01/2022 *****************

if (!empty($_GET['saveSupply'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id = anti_injection($_POST['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$name = anti_injection($_POST['name']);
	$name = filter_var($name, FILTER_SANITIZE_STRING);

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

	$uniqID = uniqid();


	$pdo->beginTransaction();

	try {

		// --- VERIFICAR SE EXISTE SUPRIMENTO COM ESTE NOME NA EMPRESA ---

		$sqlCompare = "SELECT id FROM supply WHERE name = :name AND company_id = :id_company";
		$sqlCompare = $pdo->prepare($sqlCompare);
		$sqlCompare->bindValue('name', $name);
		$sqlCompare->bindValue('id_company', $id_company);
		$sqlCompare->execute();
		if ($sqlCompare->rowCount() > 0) {
			// --------------------------------- ATUALIZAR DADOS ------------------------

			if (empty($_POST['id'])) {
				$retorno = array('codigo' => 0, 'mensagem' => "Já existe um suprimento cadastrado com este Nome!");
				echo json_encode($retorno);
				exit();
			}


			$sqlUpdateSupply = 'UPDATE supply SET 
			name = :name,
			cost_value = :cost_value,
			minimum_stock = :minimum_stock,
			user_update = :user_update,
			last_update = :last_update
			WHERE id = :id';
			$sqlUpdateSupply = $pdo->prepare($sqlUpdateSupply);
			$sqlUpdateSupply->bindValue('name', $name);
			$sqlUpdateSupply->bindValue('cost_value', $cost_value);
			$sqlUpdateSupply->bindValue('minimum_stock', $minimum_stock);
			$sqlUpdateSupply->bindValue('user_update', $id_user);
			$sqlUpdateSupply->bindValue('last_update', $dateTime);
			$sqlUpdateSupply->bindValue('id', $id);
			$sqlUpdateSupply->execute();

			// --- GRAVAR LOG ---


			$description = 'ATUALIZAR SUPRIMENTO ' . $id;
			$sqlLog = "UPDATE supply SET 
			name = $name,
			cost_value = $cost_value,
			minimum_stock = $minimum_stock,
			user_update = $id_user,
			last_update = $dateTime,
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

			$retorno = array('codigo' => 1, 'mensagem' => 'Dados Atualizados com Sucesso!', 'pg' => "supply");
			echo json_encode($retorno);
			exit();
		} else {
			// --------------------------------- CADASTRAR NOVO SUPRIMENTO ------------------------

			$sqlInsertSupply = "INSERT INTO supply (company_id, name, cost_value, minimum_stock, user_register, date_register, uniqID) VALUES (:company_id, :name, :cost_value, :minimum_stock, :user_register, :date_register, :uniqID)";
			$sqlInsertSupply = $pdo->prepare($sqlInsertSupply);
			$sqlInsertSupply->bindValue('company_id', $id_company);
			$sqlInsertSupply->bindValue('name', $name);
			$sqlInsertSupply->bindValue('cost_value', $cost_value);
			$sqlInsertSupply->bindValue('minimum_stock', $minimum_stock);
			$sqlInsertSupply->bindValue('user_register', $id_user);
			$sqlInsertSupply->bindValue('date_register', $dateTime);
			$sqlInsertSupply->bindValue('uniqID', $uniqID);
			$sqlInsertSupply->execute();

			// --- GRAVAR LOG ---


			$description = 'CADASTRAR NOVO SUPRIMENTO';
			$sqlLog = "INSERT INTO supply SET 
			company_id = $id_company,
			name = $name,
			cost_value = $cost_value,
			minimum_stock = $minimum_stock,
			user_update = $id_user,
			uniqID = $uniqID";
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

			$sqlSelectID = "SELECT id FROM supply WHERE name = :name AND company_id = :id_company";
			$sqlSelectID = $pdo->prepare($sqlSelectID);
			$sqlSelectID->bindValue('name', $name);
			$sqlSelectID->bindValue('id_company', $id_company);
			$sqlSelectID->execute();
			$rowID = $sqlSelectID->fetch();
			$id = $rowID->id;

			$retorno = array('codigo' => 1, 'mensagem' => 'Suprimento Cadastrado com Sucesso!', 'pg' => "supply");
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



// ******************************** FIM - GRAVAR / EDITAR SUPRIMENTO - BRUNO R. BERNAL - 18/01/2022 *****************

// ********************************* LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 ******************
$sqlProvider = "SELECT id, name_razao_social FROM provider WHERE status = 'Ativo' ";
$sqlProvider = $pdo->prepare($sqlProvider);
$sqlProvider->execute();

$sqlProviderAdjustment = "SELECT id, name_razao_social FROM provider WHERE status = 'Ativo' ";
$sqlProviderAdjustment = $pdo->prepare($sqlProviderAdjustment);
$sqlProviderAdjustment->execute();

if (isset($_GET['idSupply'])) {
	$sqlListData = "SELECT  b.name AS name_user_register, c.name AS name_user_update, a.*, 
	((SELECT IFNULL((SELECT SUM(d.quantity) FROM stock_adjustment d 
	WHERE d.uniqID = (SELECT e.uniqID FROM supply e WHERE e.id = a.id) 
	AND d.TYPE = 'Entrada'),0) AS 'Entradas')
	-
	(SELECT IFNULL((SELECT SUM(f.quantity) FROM stock_adjustment f 
	WHERE f.uniqID = (SELECT g.uniqID FROM supply g WHERE g.id = a.id) 
	AND f.TYPE = 'Saída'),0) AS 'Saídas')) AS 'quantity' 
	FROM supply a 
		LEFT JOIN user b ON a.user_register = b.id
		LEFT JOIN user c ON a.user_update = c.id
		WHERE a.id = :id";
	$sqlListData = $pdo->prepare($sqlListData);
	$sqlListData->bindValue('id', $_GET['idSupply']);
	$sqlListData->execute();
	$rowData = $sqlListData->fetch();
	$list_id = $rowData->id;
	$list_uniqID = $rowData->uniqID;
	$list_name = $rowData->name;
	$list_cost_value = number_format($rowData->cost_value, 2, '.', '');
	$list_minimum_stock = $rowData->minimum_stock;
	$list_user_register = $rowData->name_user_register;
	$list_date_register = $rowData->date_register;
	$list_user_update = $rowData->name_user_update;
	$list_last_update = $rowData->last_update;
	$list_quantity = $rowData->quantity;
} else {
	$list_id = "";
	$list_uniqID = "";
	$list_name = "";
	$list_cost_value = "";
	$list_minimum_stock = "";
	$list_user_register = "";
	$list_date_register = "";
	$list_user_update = "";
	$list_last_update = "";
	$list_quantity = "";
}




// ********************************* FIM - LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 ******************




// ********************************** PESQUISAR SUPRIMENTOS - BRUNO R. BERNAL - 18/01/2022 **********************

if (isset($_GET['searchSupply'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$supplyName = anti_injection($_GET['supplyName']);
	$supplyName = filter_var($supplyName, FILTER_SANITIZE_STRING);
	if (!empty($supplyName)) {
		$AND_supplyName = "AND a.name like '%$supplyName%'";
	} else {
		$AND_supplyName = "";
	}

	$sqlSearchSupply = "SELECT  a.*, 




	((SELECT IFNULL((SELECT SUM(d.quantity) FROM stock_adjustment d 
		WHERE d.uniqID = (SELECT e.uniqID FROM supply e WHERE e.id = a.id) 
		AND d.TYPE = 'Entrada'),0) AS 'Entradas')
		-
		(SELECT IFNULL((SELECT SUM(f.quantity) FROM stock_adjustment f 
		WHERE f.uniqID = (SELECT g.uniqID FROM supply g WHERE g.id = a.id) 
		AND f.TYPE = 'Saída'),0) AS 'Saídas')) AS 'quantity'
	
	
	
		FROM supply a 
	WHERE a.company_id = $id_company 
	$AND_supplyName";
	$sqlSearchSupply = $pdo->prepare($sqlSearchSupply);
	$sqlSearchSupply->execute();

	// --- GRAVAR LOG ---


	$description = 'CONSULTAR SUPRIMENTOS';
	$sqlLog = "SELECT * FROM supply $AND_supplyName";
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


// ******************************* FIM - PESQUISAR SUPRIMENTOS - BRUNO R. BERNAL - 18/01/2022 **********************
