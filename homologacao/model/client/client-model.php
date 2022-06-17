<?php

if (!isset($_SESSION)) {
	session_start();
}

/*ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);*/

$ConexaoMysql = $_SESSION['server'] . '/conexao-pdo/conexao-mysql-pdo.php';
include_once($ConexaoMysql);

date_default_timezone_set('America/Sao_Paulo');
$dateTime = date('Y-m-d H:i:s', time());

// **************** ATUALIZAR TABELA DE ENDEREÇOS - BRUNO R. BERNAL - 12/05/2022 **************************

if (isset($_GET['updateAddressTable'])) {

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$sqlSearchClientAddress = "SELECT * FROM client_delivery_address WHERE client_id = :client_id";
	$sqlSearchClientAddress = $pdo->prepare($sqlSearchClientAddress);
	$sqlSearchClientAddress->bindValue('client_id', $id);
	$sqlSearchClientAddress->execute();
}

// **************** FIM - ATUALIZAR TABELA DE ENDEREÇOS - BRUNO R. BERNAL - 12/05/2022 **************************


// *********************** DELETAR ENDEREÇO CLIENTE - BRUNO R. BERNAL - 18/01/2022 *****************************

if (!empty($_GET['deleteClientAddress'])) {

	$pdo->beginTransaction();
	try {

		$id_user = anti_injection($_GET['id_user']);
		$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

		$id_contract = anti_injection($_GET['id_contract']);
		$id_contract = filter_var($id_contract, FILTER_SANITIZE_STRING);

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

		$retorno = array('codigo' => 1, 'mensagem' => 'Endereço Deletado com Sucesso!');
		echo json_encode($retorno);
		exit();
	} catch (Exception $e) {

		$pdo->rollback();




		// --- GRAVAR LOG ---


		$description = "ERRO AO DELETAR ENDEREÇO $id DO CLIENTE $client_id";
		$sqlLog = "DELETE FROM client_delivery_address 
	where id = $id";
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

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro ao Deletar Endereço!');
		echo json_encode($retorno);
		exit();
	}
}



// ************************ FIM - DELETAR ENDEREÇO CLIENTE - BRUNO R. BERNAL - 18/01/2022 **********************

// **************************** GRAVAR / EDITAR ENDEREÇO CLIENTE - BRUNO R. BERNAL - 18/01/2022 *****************

if (isset($_GET['saveClientAddress'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$idAddress = anti_injection($_POST['idAddress']);
	$idAddress = filter_var($idAddress, FILTER_SANITIZE_STRING);

	$id_contract = anti_injection($_POST['id_contract']);
	$id_contract = filter_var($id_contract, FILTER_SANITIZE_STRING);

	$CEP = anti_injection($_POST['CEP']);
	$CEP = filter_var($CEP, FILTER_SANITIZE_STRING);

	$address = anti_injection($_POST['address']);
	$address = filter_var($address, FILTER_SANITIZE_STRING);

	$number = anti_injection($_POST['number']);
	$number = filter_var($number, FILTER_SANITIZE_STRING);

	$complement = anti_injection($_POST['complement']);
	$complement = filter_var($complement, FILTER_SANITIZE_STRING);

	$district = anti_injection($_POST['district']);
	$district = filter_var($district, FILTER_SANITIZE_STRING);

	$city = anti_injection($_POST['city']);
	$city = filter_var($city, FILTER_SANITIZE_STRING);

	$UF = anti_injection($_POST['UF']);
	$UF = filter_var($UF, FILTER_SANITIZE_STRING);

	$pdo->beginTransaction();

	try {

		if (!empty($idAddress)) {
			// --- ATUALIZAR ENDEREÇO ---

			$updAddress = "UPDATE client_delivery_address SET 
			CEP = :CEP,
			address = :address,
			number = :number,
			complement = :complement,
			district = :district,
			city = :city,
			UF = :UF,
			last_update = :last_update
			WHERE id = :id";
			$updAddress = $pdo->prepare($updAddress);
			$updAddress->bindValue('CEP', $CEP);
			$updAddress->bindValue('address', $address);
			$updAddress->bindValue('number', $number);
			$updAddress->bindValue('complement', $complement);
			$updAddress->bindValue('district', $district);
			$updAddress->bindValue('city', $city);
			$updAddress->bindValue('UF', $UF);
			$updAddress->bindValue('last_update', $dateTime);
			$updAddress->bindValue('id', $idAddress);
			$updAddress->execute();

			// --- GRAVAR LOG ---


			$description = 'ATUALIZAR ENDEREÇO DO CLIENTE ' . $id;
			$sqlLog = "UPDATE client_delivery_address SET 
	CEP = $CEP,
	address = $address,
	number = $number,
	complement = $complement,
	district = $district,
	city = $city,
	UF = $UF,
	last_update = $dateTime
	WHERE id = $idAddress";
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

			$retorno = array('codigo' => 1, 'mensagem' => 'Endereço Atualizado com Sucesso!');
			echo json_encode($retorno);
			exit();
		} else {
			// --- GRAVAR NOVO ENDEREÇO ---

			$insertAddress = "INSERT INTO client_delivery_address (client_id, CEP, address, number, complement, district, city, UF, last_update) VALUES (:client_id, :CEP, :address, :number, :complement, :district, :city, :UF, :last_update)";
			$insertAddress = $pdo->prepare($insertAddress);
			$insertAddress->bindValue('client_id', $id);
			$insertAddress->bindValue('CEP', $CEP);
			$insertAddress->bindValue('address', $address);
			$insertAddress->bindValue('number', $number);
			$insertAddress->bindValue('complement', $complement);
			$insertAddress->bindValue('district', $district);
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
	district = $district,
	city = $city,
	UF = $UF,
	last_update = $dateTime,
	client_id = $id";
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

			$retorno = array('codigo' => 1, 'mensagem' => 'Endereço Cadastrado com Sucesso!');
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


// ********************************** GRAVAR ENDEREÇO CLIENTE - BRUNO R. BERNAL - 18/01/2022 *****************



// ********************************** LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 **************

if (isset($_GET['idClient'])) {
	$sqlListData = "SELECT a.*, b.name as user_register, c.name as user_update 
	FROM client a
	LEFT JOIN user b ON b.id = a.user_register
	LEFT JOIN user c ON c.id = a.user_update
	WHERE a.id = :id";
	$sqlListData = $pdo->prepare($sqlListData);
	$sqlListData->bindValue('id', $_GET['idClient']);
	$sqlListData->execute();
	$rowData = $sqlListData->fetch();
	$list_id = $rowData->id;
	$list_id_sequence = $rowData->id_sequence;
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
	$list_user_register = $rowData->user_register;
	$list_user_update = $rowData->user_update;
	$list_last_update = $rowData->last_update;

	$sqlSearchClientAddress = "SELECT * FROM client_delivery_address WHERE client_id = :id";
	$sqlSearchClientAddress = $pdo->prepare($sqlSearchClientAddress);
	$sqlSearchClientAddress->bindValue('id', $_GET['idClient']);
	$sqlSearchClientAddress->execute();
} else {
	$list_id = "";
	$list_id_sequence = "";
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
	$list_user_register = "";
	$list_user_update = "";
	$list_last_update = "";
}



// ***************************** FIM - LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 **************

// ********************************** GRAVAR / EDITAR CLIENTE - BRUNO R. BERNAL - 18/01/2022 *****************

if (!empty($_GET['saveClient'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id_contract = anti_injection($_GET['id_contract']);
	$id_contract = filter_var($id_contract, FILTER_SANITIZE_STRING);

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


	$pdo->beginTransaction();

	try {

		// --- VERIFICAR SE EXISTE CLIENTE COM ESTE CPF / CNPJ ---

		$sqlCPF_CNPJ = "SELECT id FROM client WHERE CPF_CNPJ = :CPF_CNPJ AND id_contract = :id_contract AND id_company = :id_company";
		$sqlCPF_CNPJ = $pdo->prepare($sqlCPF_CNPJ);
		$sqlCPF_CNPJ->bindValue('CPF_CNPJ', $cpf_cnpj);
		$sqlCPF_CNPJ->bindValue('id_contract', $id_contract);
		$sqlCPF_CNPJ->bindValue('id_company', $id_company);
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


			$SQL_email = "SELECT email FROM client WHERE email = :email AND CPF_CNPJ != :CPF_CNPJ AND id_contract = :id_contract AND id_company = :id_company";
			$SQL_email = $pdo->prepare($SQL_email);
			$SQL_email->bindValue('email', $email);
			$SQL_email->bindValue('CPF_CNPJ', $cpf_cnpj);
			$SQL_email->bindValue('id_contract', $id_contract);
			$SQL_email->bindValue('id_company', $id_company);
			$SQL_email->execute();
			if ($SQL_email->rowCount() > 0) {

				$retorno = array('codigo' => 0, 'mensagem' => 'Este Email já está cadastrado em outro Cliente!');
				echo json_encode($retorno);
				exit();
			}


			// --- FIM - VERIFICAR SE JÁ EXISTE O EMAIL ---

			$sqlUpdateClient = 'UPDATE client SET 
			name_razao_social = :name_razao_social,
			fantasia = :fantasia,
			inscricao_municipal = :insc_municipal,
			inscricao_estadual = :insc_estadual,
      		surname = :surname,
			email = :email,
			status = :status,
			phone = :phone,    
      		birthday = :birthday,
			last_update = :last_update,
			user_update = :user_update
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
			$sqlUpdateClient->bindValue('birthday', $birthday);
			$sqlUpdateClient->bindValue('last_update', $dateTime);
			$sqlUpdateClient->bindValue('user_update', $id_user);
			$sqlUpdateClient->bindValue('id', $id);
			$sqlUpdateClient->execute();


			// --- ATUALIZAR SENHA SE HOUVER ---
			if (!empty($_POST['password'])) {
				$newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

				$updPassword = 'UPDATE client SET password = :newPassword WHERE id = :id';
				$updPassword = $pdo->prepare($updPassword);
				$updPassword->bindValue('newPassword', $newPassword);
				$updPassword->bindValue('id', $id);
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
      		birthday = $birthday,
			last_update = $dateTime,
			user_update = $id_user
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

			$retorno = array('codigo' => 1, 'mensagem' => 'Dados Atualizados com Sucesso!', 'pg' => 'client');
			echo json_encode($retorno);
			exit();
		} else {
			// --------------------------------- CADASTRAR NOVO CLIENTE ------------------------

			// --- VERIFICAR SE JÁ EXISTE O EMAIL ---


			$SQL_email = "SELECT * FROM client WHERE email = :email AND id_contract = :id_contract AND id_company = :id_company";
			$SQL_email = $pdo->prepare($SQL_email);
			$SQL_email->bindValue('email', $email);
			$SQL_email->bindValue('id_contract', $id_contract);
			$SQL_email->bindValue('id_company', $id_company);
			$SQL_email->execute();
			if ($SQL_email->rowCount() > 0) {

				$retorno = array('codigo' => 0, 'mensagem' => 'Este email já está cadastrado');
				echo json_encode($retorno);
				exit();
			}


			// --- FIM - VERIFICAR SE JÁ EXISTE O EMAIL ---


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

			// --- BUSCAR ÚLTIMO ID_SEQUENCE ---
			$sqlLastID = "SELECT max(id_sequence) as id_sequence FROM client WHERE id_company = :id_company AND id_contract = :id_contract";
			$sqlLastID = $pdo->prepare($sqlLastID);
			$sqlLastID->bindValue('id_company', $id_company);
			$sqlLastID->bindValue("id_contract", $id_contract);
			$lastID = $sqlLastID->fetch();
			if (!empty($lastID->id_sequence)) {
				$id_sequence = intval($lastID->id_sequence) + 1;
			} else {
				$id_sequence = 1;
			}
			// --- FIM - BUSCAR ÚLTIMO ID_SEQUENCE ---

			$sqlInsertClient = "INSERT INTO client (id_company, id_sequence, user_register, name_razao_social, surname, CPF_CNPJ, type, fantasia, inscricao_municipal, inscricao_estadual, birthday, phone, email, date_register, status, password,id_contract) VALUES (:id_company, :id_sequence, :user_register, :name_razSocial, :surname, :CPF_CNPJ, :type, :fantasia, :insc_municipal, :insc_estadual, :birthday, :phone, :email, :date_register, :status, :password,:id_contract)";
			$sqlInsertClient = $pdo->prepare($sqlInsertClient);
			$sqlInsertClient->bindValue('id_company', $id_company);
			$sqlInsertClient->bindValue('id_sequence', $id_sequence);
			$sqlInsertClient->bindValue('user_register', $id_user);
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
			$sqlInsertClient->bindValue('password', $password);
			$sqlInsertClient->bindValue('id_contract', $id_contract);
			$sqlInsertClient->execute();


			// --- GRAVAR LOG ---


			$description = 'CADASTRAR NOVO CLIENTE';
			$sqlLog = "INSERT INTO cliente 
			id_company = $id_company,
			id_sequence = $id_sequence,
			user_register = $id_user,
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
      		birthday = $birthday,
			date_register = $dateTime";
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




			$pdo->commit();

			$sqlID = "SELECT id FROM client WHERE CPF_CNPJ = :CPF_CNPJ AND id_company = :id_company AND id_contract = :id_contract";
			$sqlID = $pdo->prepare($sqlID);
			$sqlID->bindValue('CPF_CNPJ', $cpf_cnpj);
			$sqlID->bindValue('id_company', $id_company);
			$sqlID->bindValue('id_contract', $id_contract);
			$sqlID->execute();
			$rowID = $sqlID->fetch();
			$id = $rowID->id;

			$retorno = array('codigo' => 1, 'mensagem' => 'Cliente Cadastrado com Sucesso!', 'pg' => "data-client&idClient=$id#formClientAddress");
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



// ***************************** FIM - GRAVAR / EDITAR CLIENTE - BRUNO R. BERNAL - 18/01/2022 *****************


// ********************************** PESQUISAR CLIENTE - BRUNO R. BERNAL - 18/01/2022 **********************

if (isset($_GET['searchClient'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$clientName = anti_injection($_GET['clientName']);
	$clientName = filter_var($clientName, FILTER_SANITIZE_STRING);

	$id_contract = anti_injection($_GET['id_contract']);
	$id_contract = filter_var($id_contract, FILTER_SANITIZE_STRING);
	if (!empty($clientName)) {
		$WHERE_clientName = "WHERE name like '%$clientName%' ";
	} else {
		$WHERE_clientName = "";
	}

	$sqlSearchClient = "SELECT * FROM client where id_contract = :id_contract AND name_razao_social like :name";
	$sqlSearchClient = $pdo->prepare($sqlSearchClient);
	$sqlSearchClient->bindValue('id_contract', $id_contract);
	$sqlSearchClient->bindValue('name', '%' . $clientName . '%');
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
	$register_log->bindValue('IP', $_SERVER['REMOTE_ADDR']);
	$register_log->bindValue('description', $description);
	$register_log->bindValue('user', $id_user);
	$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
	$register_log->execute();


	// --- FIM - GRAVAR LOG ---
}


// ******************************* FIM - PESQUISAR CLIENTE - BRUNO R. BERNAL - 18/01/2022 **********************
