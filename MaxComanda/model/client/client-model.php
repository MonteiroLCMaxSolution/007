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


// ********** DELETAR ENDEREÇO CLIENTE - BRUNO R. BERNAL - 18/01/2022 ***********

if (!empty($_GET['deleteClientAddress'])) {
	try {

		$id_user = anti_injection($_GET['id_user']);
		$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

		$id_company = anti_injection($_GET['id_company']);
		$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

		$id = anti_injection($_POST['id']);
		$id = filter_var($id, FILTER_SANITIZE_STRING);

		$client_id = anti_injection($_POST['client_id']);
		$client_id = filter_var($client_id, FILTER_SANITIZE_STRING);


		$sqlDeleteAddress = "DELETE FROM client_delivery_address 
		where id = :id";
		$sqlDeleteAddress = $pdo->prepare($sqlDeleteAddress);
		$sqlDeleteAddress->bindValue('id', $id);
		$sqlDeleteAddress->execute();


		// --- GRAVAR LOG ---


		$description = "DELETAR ENDEREÇO $id DO CLIENTE $client_id";
		$sqlLog = "DELETE FROM client_delivery_address 
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
		$register_log->bindValue('id_company', $id_company);
		$register_log->bindValue('dateTime', $dateTime);
		$register_log->bindValue('action', $sqlLog);
		$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
		$register_log->bindValue('description', $description);
		$register_log->bindValue('user', $id_user);
		$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
		$register_log->execute();


		// --- FIM - GRAVAR LOG ---


		$sqlSearchClientAddress = "SELECT * FROM client_delivery_address WHERE client_id = :client_id";
		$sqlSearchClientAddress = $pdo->prepare($sqlSearchClientAddress);
		$sqlSearchClientAddress->bindValue('client_id', $client_id);
		$sqlSearchClientAddress->execute();
	} catch (Exception $e) {






		// --- GRAVAR LOG ---


		$description = "ERRO AO DELETAR ENDEREÇO $id DO CLIENTE $client_id";
		$sqlLog = "DELETE FROM client_delivery_address 
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
		$register_log->bindValue('id_company', $id_company);
		$register_log->bindValue('dateTime', $dateTime);
		$register_log->bindValue('action', $sqlLog);
		$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
		$register_log->bindValue('description', $description);
		$register_log->bindValue('user', $id_user);
		$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
		$register_log->execute();


		// --- FIM - GRAVAR LOG ---

		$sqlSearchClientAddress = "SELECT * FROM client_delivery_address WHERE client_id = :client_id";
		$sqlSearchClientAddress = $pdo->prepare($sqlSearchClientAddress);
		$sqlSearchClientAddress->bindValue('client_id', $client_id);
		$sqlSearchClientAddress->execute();
	}
}



// ********** FIM - DELETAR ENDEREÇO CLIENTE - BRUNO R. BERNAL - 18/01/2022 ***********



// **************************** GRAVAR ENDEREÇO CLIENTE - BRUNO R. BERNAL - 18/01/2022 *****************

if (isset($_GET['editClientAddress'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$client_id = anti_injection($_GET['client_id']);
	$client_id = filter_var($client_id, FILTER_SANITIZE_STRING);

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$CEP = anti_injection($_GET['CEP']);
	$CEP = filter_var($CEP, FILTER_SANITIZE_STRING);

	$address = anti_injection($_GET['address']);
	$address = filter_var($address, FILTER_SANITIZE_STRING);

	$number = anti_injection($_GET['number']);
	$number = filter_var($number, FILTER_SANITIZE_STRING);

	$complement = anti_injection($_GET['complement']);
	$complement = filter_var($complement, FILTER_SANITIZE_STRING);

	$neighborhood = anti_injection($_GET['neighborhood']);
	$neighborhood = filter_var($neighborhood, FILTER_SANITIZE_STRING);

	$city = anti_injection($_GET['city']);
	$city = filter_var($city, FILTER_SANITIZE_STRING);

	$UF = anti_injection($_GET['UF']);
	$UF = filter_var($UF, FILTER_SANITIZE_STRING);


	$updateAddress = "UPDATE client_delivery_address SET 
		CEP = :CEP,
		address = :address,
		number = :number,
		complement = :complement,
		neighborhood = :neighborhood,
		city = :city,
		UF = :UF,
		last_update = :last_update
		WHERE id = :id";
	$updateAddress = $pdo->prepare($updateAddress);
	$updateAddress->bindValue('id', $id);
	$updateAddress->bindValue('CEP', $CEP);
	$updateAddress->bindValue('address', $address);
	$updateAddress->bindValue('number', $number);
	$updateAddress->bindValue('complement', $complement);
	$updateAddress->bindValue('neighborhood', $neighborhood);
	$updateAddress->bindValue('city', $city);
	$updateAddress->bindValue('UF', $UF);
	$updateAddress->bindValue('last_update', $dateTime);
	$updateAddress->execute();

	// --- GRAVAR LOG ---


	$description = 'ATUALIZAR DADOS ENDEREÇO CLIENTE ' . $client_id;
	$sqlLog = "UPDATE client_delivery_address SET 
	CEP = $CEP,
	address = $address,
	number = $number,
	complement = $complement,
	neighborhood = $neighborhood,
	city = $city,
	UF = $UF,
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


	$sqlSearchClientAddress = "SELECT * FROM client_delivery_address WHERE client_id = :client_id";
	$sqlSearchClientAddress = $pdo->prepare($sqlSearchClientAddress);
	$sqlSearchClientAddress->bindValue('client_id', $client_id);
	$sqlSearchClientAddress->execute();
}


// ********************************** GRAVAR ENDEREÇO CLIENTE - BRUNO R. BERNAL - 18/01/2022 *****************

// ********************************** LISTAR ENDEREÇOS CLIENTE - BRUNO R. BERNAL - 18/01/2022 *****************

if (isset($_GET['searchClientAddress'])) {

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);


	$sqlSearchClientAddress = "SELECT * FROM client_delivery_address WHERE client_id = :id";
	$sqlSearchClientAddress = $pdo->prepare($sqlSearchClientAddress);
	$sqlSearchClientAddress->bindValue('id', $id);
	$sqlSearchClientAddress->execute();
}


// ********************************** LISTAR ENDEREÇOS CLIENTE - BRUNO R. BERNAL - 18/01/2022 *****************

// ********************************** GRAVAR ENDEREÇO CLIENTE - BRUNO R. BERNAL - 18/01/2022 *****************

if (isset($_GET['saveClientAddress'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$CEP = anti_injection($_POST['CEP']);
	$CEP = filter_var($CEP, FILTER_SANITIZE_STRING);

	$address = anti_injection($_POST['address']);
	$address = filter_var($address, FILTER_SANITIZE_STRING);

	$number = anti_injection($_POST['number']);
	$number = filter_var($number, FILTER_SANITIZE_STRING);

	$complement = anti_injection($_POST['complement']);
	$complement = filter_var($complement, FILTER_SANITIZE_STRING);

	$neighborhood = anti_injection($_POST['neighborhood']);
	$neighborhood = filter_var($neighborhood, FILTER_SANITIZE_STRING);

	$city = anti_injection($_POST['city']);
	$city = filter_var($city, FILTER_SANITIZE_STRING);

	$UF = anti_injection($_POST['UF']);
	$UF = filter_var($UF, FILTER_SANITIZE_STRING);


	$insertAddress = "INSERT INTO client_delivery_address (client_id, CEP, address, number, complement, neighborhood, city, UF, last_update) VALUES (:client_id, :CEP, :address, :number, :complement, :neighborhood, :city, :UF, :last_update)";
	$insertAddress = $pdo->prepare($insertAddress);
	$insertAddress->bindValue('client_id', $id);
	$insertAddress->bindValue('CEP', $CEP);
	$insertAddress->bindValue('address', $address);
	$insertAddress->bindValue('number', $number);
	$insertAddress->bindValue('complement', $complement);
	$insertAddress->bindValue('neighborhood', $neighborhood);
	$insertAddress->bindValue('city', $city);
	$insertAddress->bindValue('UF', $UF);
	$insertAddress->bindValue('last_update', $dateTime);
	$insertAddress->execute();

	// --- GRAVAR LOG ---


	$description = 'CADASTRAR NOVO ENDEREÇO PARA O CLIENTE ' . $id;
	$sqlLog = "INSERT INTO client_delivery_address SET 
	CEP = $CEP,
	address = $address,
	number = $number,
	complement = $complement,
	neighborhood = $neighborhood,
	city = $city,
	UF = $UF,
	last_update = $dateTime,
	client_id = $id";
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


	$sqlSearchClientAddress = "SELECT * FROM client_delivery_address WHERE client_id = :id";
	$sqlSearchClientAddress = $pdo->prepare($sqlSearchClientAddress);
	$sqlSearchClientAddress->bindValue('id', $id);
	$sqlSearchClientAddress->execute();
}


// ********************************** GRAVAR ENDEREÇO CLIENTE - BRUNO R. BERNAL - 18/01/2022 *****************



// ********************************** LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 **************

if (isset($_GET['idClient'])) {
	$sqlListData = "SELECT * FROM client 
	WHERE id = :id";
	$sqlListData = $pdo->prepare($sqlListData);
	$sqlListData->bindValue('id', $_GET['idClient']);
	$sqlListData->execute();
	$rowData = $sqlListData->fetch();
	$list_id = $rowData->id;
	$list_name_razSocial = $rowData->name_razao_social;
	$list_type = $rowData->type;
	$list_surname = $rowData->surname;
	$list_CPF_CNPJ = $rowData->CPF_CNPJ;
	$list_fantasia = $rowData->fantasia;
	$list_insc_municipal = $rowData->inscricao_municipal;
	$list_insc_estadual = $rowData->inscricao_estadual;
	$list_email = $rowData->email;
	$list_login = $rowData->login;
	$list_status = $rowData->status;
	$list_phone = $rowData->phone;
	$list_birthday = $rowData->birthday;
	$list_number_access = $rowData->number_access;
	$list_date_register = $rowData->date_register;
	$list_last_update = $rowData->last_update;
} else {
	$list_id = "";
	$list_name_razSocial = "";
	$list_type = "";
	$list_surname = "";
	$list_CPF_CNPJ = "";
	$list_fantasia = "";
	$list_insc_municipal = "";
	$list_insc_estadual = "";
	$list_email = "";
	$list_login = "";
	$list_status = "";
	$list_phone = "";
	$list_birthday = "";
	$list_number_access = "";
	$list_date_register = "";
	$list_last_update = "";
}



// ********************************** FIM - LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 **************

// ********************************** GRAVAR / EDITAR CLIENTE - BRUNO R. BERNAL - 18/01/2022 *****************

if (!empty($_GET['saveClient'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id = anti_injection($_POST['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$cpf_cnpj = anti_injection($_POST['cpf_cnpj']);
	$cpf_cnpj = filter_var($cpf_cnpj, FILTER_SANITIZE_STRING);

	$type = anti_injection($_POST['type']);
	$type = filter_var($type, FILTER_SANITIZE_STRING);

	$name_razSocial = anti_injection($_POST['name_razSocial']);
	$name_razSocial = filter_var($name_razSocial, FILTER_SANITIZE_STRING);

	$fantasia = anti_injection($_POST['fantasia']);
	$fantasia = filter_var($fantasia, FILTER_SANITIZE_STRING);

	$insc_municipal = anti_injection($_POST['insc_municipal']);
	$insc_municipal = filter_var($insc_municipal, FILTER_SANITIZE_STRING);

	$insc_estadual = anti_injection($_POST['insc_estadual']);
	$insc_estadual = filter_var($insc_estadual, FILTER_SANITIZE_STRING);

	$surname = anti_injection($_POST['surname']);
	$surname = filter_var($surname, FILTER_SANITIZE_STRING);

	$phone = anti_injection($_POST['phone']);
	$phone = filter_var($phone, FILTER_SANITIZE_STRING);

	$email = anti_injection($_POST['email']);
	$email = filter_var($email, FILTER_SANITIZE_STRING);

	$login = anti_injection($_POST['login']);
	$login = filter_var($login, FILTER_SANITIZE_STRING);

	$password = anti_injection($_POST['password']);
	$password = filter_var($password, FILTER_SANITIZE_STRING);

	$status = anti_injection($_POST['status']);
	$status = filter_var($status, FILTER_SANITIZE_STRING);

	$birthday = anti_injection($_POST['birthday']);
	$birthday = filter_var($birthday, FILTER_SANITIZE_STRING);
	if (!empty($birthday)) {

		$birthday = $birthday;
		$birthday = explode('/', $birthday);
		$birthday = $birthday[2] . '-' . $birthday[1] . '-' . $birthday[0];
	} else {
		$birthday = NULL;
	}


	$pdo->beginTransaction();

	try {

		// --- VERIFICAR SE EXISTE CLIENTE COM ESTE CPF / CNPJ ---

		$sqlCPF_CNPJ = "SELECT id FROM client WHERE CPF_CNPJ = :CPF_CNPJ";
		$sqlCPF_CNPJ = $pdo->prepare($sqlCPF_CNPJ);
		$sqlCPF_CNPJ->bindValue('CPF_CNPJ', $cpf_cnpj);
		$sqlCPF_CNPJ->execute();
		if ($sqlCPF_CNPJ->rowCount() > 0) {
			// --------------------------------- ATUALIZAR DADOS ------------------------
/*
			if (empty($_POST['id'])) {
				$retorno = array('codigo' => 0, 'mensagem' => "Já existe um cliente cadastrado com este CPF / CNPJ!");
				echo json_encode($retorno);
				exit();
			}
*/

			// --- VERIFICAR SE JÁ EXISTE O EMAIL ---


			$SQL_email = "SELECT email FROM client WHERE email = :email and CPF_CNPJ != :CPF_CNPJ";
			$SQL_email = $pdo->prepare($SQL_email);
			$SQL_email->bindValue('email', $email);
			$SQL_email->bindValue('CPF_CNPJ', $cpf_cnpj);
			$SQL_email->execute();
			if ($SQL_email->rowCount() > 0) {

				$retorno = array('codigo' => 0, 'mensagem' => 'Este Email já está cadastrado em outro Cliente!');
				echo json_encode($retorno);
				exit();
			}


			// --- FIM - VERIFICAR SE JÁ EXISTE O EMAIL ---

			// --- VERIFICAR SE JÁ EXISTE O LOGIN ---


			$SQL_login = "SELECT login FROM client WHERE login = :login and CPF_CNPJ != :CPF_CNPJ";
			$SQL_login = $pdo->prepare($SQL_login);
			$SQL_login->bindValue('login', $login);
			$SQL_login->bindValue('CPF_CNPJ', $CPF_CNPJ);
			$SQL_login->execute();
			if ($SQL_login->rowCount() > 0) {

				$retorno = array('codigo' => 0, 'mensagem' => 'Este Login já está cadastrado em outro Cliente!');
				echo json_encode($retorno);
				exit();
			}


			// --- FIM - VERIFICAR SE JÁ EXISTE O LOGIN ---

			$sqlUpdateClient = 'UPDATE client SET 
			name_razao_social = :name_razao_social,
			fantasia = :fantasia,
			inscricao_municipal = :insc_municipal,
			inscricao_estadual = :insc_estadual,
      		surname = :surname,
			email = :email,
			status = :status,
			phone = :phone,
      		login = :login,     
      		birthday = :birthday,
			last_update = :last_update
			WHERE id = :id';
			$sqlUpdateClient = $pdo->prepare($sqlUpdateClient);
			$sqlUpdateClient->bindValue('name_razao_social', $name_razSocial);
			$sqlUpdateClient->bindValue('fantasia', $fantasia);
			$sqlUpdateClient->bindValue('insc_municipal', $insc_municipal);
			$sqlUpdateClient->bindValue('insc_estadual', $insc_estadual);
			$sqlUpdateClient->bindValue('surname', $surname);
			$sqlUpdateClient->bindValue('email', $email);
			$sqlUpdateClient->bindValue('status', $status);
			$sqlUpdateClient->bindValue('phone', $phone);
			$sqlUpdateClient->bindValue('login', $login);
			$sqlUpdateClient->bindValue('birthday', $birthday);
			$sqlUpdateClient->bindValue('last_update', $dateTime);
			$sqlUpdateClient->bindValue('id', $id);
			$sqlUpdateClient->execute();


			// --- ATUALIZAR SENHA SE HOUVER ---
			if (!empty($_POST['password'])) {
				$newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

				$updPassword = 'UPDATE client SET password = :newPassword WHERE CPF_CNPJ = :CPF_CNPJ';
				$updPassword = $pdo->prepare($updPassword);
				$updPassword->bindValue('newPassword', $newPassword);
				$updPassword->bindValue('CPF_CNPJ', $cpf_cnpj);
				$updPassword->execute();
			}

			// --- FIM - ATUALIZAR SENHA ---



			// --- GRAVAR LOG ---


			$description = 'ATUALIZAR DADOS CLIENTE ' . $id;
			$sqlLog = "UPDATE client SET 
			name_razao_social = $name_razSocial,
			fantasia = $fantasia,
			inscricao_municipal = $insc_municipal,
			inscricao_estadual = $insc_estadual,
      		surname = $surname,
			email = $email,
			status = $status,
			phone = $phone,
      		login = $login,     
      		birthday = $birthday,
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

			$retorno = array('codigo' => 1, 'mensagem' => 'Dados Atualizados com Sucesso!', 'pg' => 'client');
			echo json_encode($retorno);
			exit();
		} else {
			// --------------------------------- CADASTRAR NOVO CLIENTE ------------------------

			// --- VERIFICAR SE JÁ EXISTE O EMAIL ---


			$SQL_email = "SELECT * FROM client WHERE email = :email";
			$SQL_email = $pdo->prepare($SQL_email);
			$SQL_email->bindValue('email', $email);
			$SQL_email->execute();
			if ($SQL_email->rowCount() > 0) {

				$retorno = array('codigo' => 0, 'mensagem' => 'Este email já está cadastrado');
				echo json_encode($retorno);
				exit();
			}


			// --- FIM - VERIFICAR SE JÁ EXISTE O EMAIL ---

			// --- VERIFICAR SE JÁ EXISTE O LOGIN ---


			$SQL_login = "SELECT login FROM client WHERE login = :login";
			$SQL_login = $pdo->prepare($SQL_login);
			$SQL_login->bindValue('login', $login);
			$SQL_login->execute();
			if ($SQL_login->rowCount() > 0) {

				$retorno = array('codigo' => 0, 'mensagem' => 'Este Login já está cadastrado em outro Cliente!');
				echo json_encode($retorno);
				exit();
			}


			// --- FIM - VERIFICAR SE JÁ EXISTE O LOGIN ---


			// --- VERIFICAR SE EXISTE SENHA ---

			if (!empty($_POST['password'])) {
				$password = $_POST['password'];
				$password = password_hash($password, PASSWORD_DEFAULT);
			} else {
				$retorno = array('codigo' => 0, 'mensagem' => 'Digite uma Senha!');
				echo json_encode($retorno);
				exit();
			}

			// --- FIM - VERIFICAR SE EXISTE SENHA ---

			$sqlInsertClient = "INSERT INTO client (name_razao_social, surname, CPF_CNPJ, type, fantasia, inscricao_municipal, inscricao_estadual, birthday, phone, email, date_register, status, login, password) VALUES (:name_razSocial, :surname, :CPF_CNPJ, :type, :fantasia, :insc_municipal, :insc_estadual, :birthday, :phone, :email, :date_register, :status, :login, :password)";
			$sqlInsertClient = $pdo->prepare($sqlInsertClient);
			$sqlInsertClient->bindValue('name_razSocial', $name_razSocial);
			$sqlInsertClient->bindValue('surname', $surname);
			$sqlInsertClient->bindValue('CPF_CNPJ', $cpf_cnpj);
			$sqlInsertClient->bindValue('type', $type);
			$sqlInsertClient->bindValue('fantasia', $fantasia);
			$sqlInsertClient->bindValue('insc_municipal', $insc_municipal);
			$sqlInsertClient->bindValue('insc_estadual', $insc_estadual);
			$sqlInsertClient->bindValue('birthday', $birthday);
			$sqlInsertClient->bindValue('phone', $phone);
			$sqlInsertClient->bindValue('email', $email);
			$sqlInsertClient->bindValue('date_register', $dateTime);
			$sqlInsertClient->bindValue('status', $status);
			$sqlInsertClient->bindValue('login', $login);
			$sqlInsertClient->bindValue('password', $password);
			$sqlInsertClient->execute();


			// --- GRAVAR LOG ---


			$description = 'CADASTRAR NOVO CLIENTE';
			$sqlLog = "INSERT INTO cliente 
			name_razao_social = $name_razSocial,
			CPF_CNPJ = $cpf_cnpj,
			type = $type,
			fantasia = $fantasia,
			inscricao_municipal = $insc_municipal,
			inscricao_estadual = $insc_estadual,
      		surname = $surname,
			email = $email,
			status = $status,
			phone = $phone,
      		login = $login,     
      		birthday = $birthday,
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

			$sqlID = "SELECT id FROM client WHERE CPF_CNPJ = :CPF_CNPJ";
			$sqlID = $pdo->prepare($sqlID);
			$sqlID->bindValue('CPF_CNPJ', $cpf_cnpj);
			$sqlID->execute();
			$rowID = $sqlID->fetch();
			$id = $rowID->id;

			$retorno = array('codigo' => 1, 'mensagem' => 'Cliente Cadastrado com Sucesso!', 'pg' => "data-client&idClient=$id#endereco");
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



// ******************************** FIM - GRAVAR / EDITAR CLIENTE - BRUNO R. BERNAL - 18/01/2022 *****************


// ********************************** PESQUISAR CLIENTE - BRUNO R. BERNAL - 18/01/2022 **********************

if (isset($_GET['searchClient'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$clientName = anti_injection($_GET['clientName']);
	$clientName = filter_var($clientName, FILTER_SANITIZE_STRING);
	if (!empty($clientName)) {
		$WHERE_clientName = "WHERE name like '%$clientName%' ";
	} else {
		$WHERE_clientName = "";
	}

	$sqlSearchClient = "SELECT * FROM client $WHERE_clientName";
	$sqlSearchClient = $pdo->prepare($sqlSearchClient);
	$sqlSearchClient->execute();

	// --- GRAVAR LOG ---


	$description = 'CONSULTAR CLIENTE';
	$sqlLog = "SELECT * FROM client $WHERE_clientName";
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


// ******************************* FIM - PESQUISAR CLIENTE - BRUNO R. BERNAL - 18/01/2022 **********************
