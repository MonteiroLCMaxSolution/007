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

// ********************************** GRAVAR / EDITAR FORNECEDOR - BRUNO R. BERNAL - 18/01/2022 *****************

if (!empty($_GET['saveProvider'])) {

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

	$phone = anti_injection($_POST['phone']);
	$phone = filter_var($phone, FILTER_SANITIZE_STRING);

	$email = anti_injection($_POST['email']);
	$email = filter_var($email, FILTER_SANITIZE_STRING);

	$site = anti_injection($_POST['site']);
	$site = filter_var($site, FILTER_SANITIZE_STRING);

	$status = anti_injection($_POST['status']);
	$status = filter_var($status, FILTER_SANITIZE_STRING);

	$contact = anti_injection($_POST['contact']);
	$contact = filter_var($contact, FILTER_SANITIZE_STRING);



	$pdo->beginTransaction();

	try {


		// --- VERIFICAR SE EXISTE FOENECEDOR COM ESTE CPF / CNPJ ---

		$sqlCPFCNPJ = "SELECT id FROM provider WHERE CPF_CNPJ = :CPF_CNPJ";
		$sqlCPFCNPJ = $pdo->prepare($sqlCPFCNPJ);
		$sqlCPFCNPJ->bindValue('CPF_CNPJ', $cpf_cnpj);
		$sqlCPFCNPJ->execute();
		if ($sqlCPFCNPJ->rowCount() > 0) {
			// --------------------------------- ATUALIZAR DADOS ------------------------

			if (empty($_POST['id'])) {
				$retorno = array('codigo' => 0, 'mensagem' => "Já existe um fornecedor cadastrado com este CPF / CNPJ!");
				echo json_encode($retorno);
				exit();
			}


			$sqlUpdateProvider = 'UPDATE provider SET 
			name_razao_social = :name_razao_social,
			fantasia = :fantasia,
			type = :type,
			inscricao_municipal = :inscricao_municipal,
			inscricao_estadual = :inscricao_estadual,
			CEP = :CEP,
			address = :address,
			number = :number,
			complement = :complement,
			neighborhood = :neighborhood,
			city = :city,
			UF = :UF,
			site = :site,
			email = :email,
			status = :status,
			phone = :phone,
			contact = :contact,
			user_update = :user_update,
			last_update = :last_update
			WHERE id = :id';
			$sqlUpdateProvider = $pdo->prepare($sqlUpdateProvider);
			$sqlUpdateProvider->bindValue('name_razao_social', $name_razSocial);
			$sqlUpdateProvider->bindValue('fantasia', $fantasia);
			$sqlUpdateProvider->bindValue('type', $type);
			$sqlUpdateProvider->bindValue('inscricao_municipal', $insc_municipal);
			$sqlUpdateProvider->bindValue('inscricao_estadual', $insc_estadual);
			$sqlUpdateProvider->bindValue('CEP', $CEP);
			$sqlUpdateProvider->bindValue('address', $address);
			$sqlUpdateProvider->bindValue('number', $number);
			$sqlUpdateProvider->bindValue('complement', $complement);
			$sqlUpdateProvider->bindValue('neighborhood', $neighborhood);
			$sqlUpdateProvider->bindValue('city', $city);
			$sqlUpdateProvider->bindValue('UF', $UF);
			$sqlUpdateProvider->bindValue('site', $site);
			$sqlUpdateProvider->bindValue('email', $email);
			$sqlUpdateProvider->bindValue('status', $status);
			$sqlUpdateProvider->bindValue('phone', $phone);
			$sqlUpdateProvider->bindValue('contact', $contact);
			$sqlUpdateProvider->bindValue('user_update', $id_user);
			$sqlUpdateProvider->bindValue('last_update', $dateTime);
			$sqlUpdateProvider->bindValue('id', $id);
			$sqlUpdateProvider->execute();


			// --- GRAVAR LOG ---


			$description = 'ATUALIZAR DADOS FORNECEDOR ' . $id;
			$sqlLog = "UPDATE company SET 
			name_razao_social = :$name_razSocial,
			fantasia = $fantasia,
			type = $type,
			inscricao_municipal = $insc_municipal,
			inscricao_estadual = $insc_estadual,
			CEP = $CEP,
			address = $address,
			number = $number,
			complement = $complement,
			neighborhood = $neighborhood,
			city = $city,
			UF = $UF,
			site = $site,
			email = $email,
			status = $status,
			phone = $phone,
			contact = $contact,
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
			// --------------------------------- CADASTRAR NOVO FORNECEDOR ------------------------

			$sqlInsertProvider = "INSERT INTO provider (name_razao_social, fantasia, type, CPF_CNPJ, inscricao_municipal, inscricao_estadual, CEP, address, number, complement, neighborhood, city, UF, site, email, status, phone, contact, user_register, date_register) VALUES (:name_razao_social, :fantasia, :type, :CPF_CNPJ, :inscricao_municipal, :inscricao_estadual, :CEP, :address, :number, :complement, :neighborhood, :city, :UF, :site, :email, :status, :phone, :contact, :user_register, :date_register)";
			$sqlInsertProvider = $pdo->prepare($sqlInsertProvider);
			$sqlInsertProvider->bindValue('name_razao_social', $name_razSocial);
			$sqlInsertProvider->bindValue('fantasia', $fantasia);
			$sqlInsertProvider->bindValue('type', $type);
			$sqlInsertProvider->bindValue('CPF_CNPJ', $cpf_cnpj);
			$sqlInsertProvider->bindValue('inscricao_municipal', $insc_municipal);
			$sqlInsertProvider->bindValue('inscricao_estadual', $insc_estadual);
			$sqlInsertProvider->bindValue('CEP', $CEP);
			$sqlInsertProvider->bindValue('address', $address);
			$sqlInsertProvider->bindValue('number', $number);
			$sqlInsertProvider->bindValue('complement', $complement);
			$sqlInsertProvider->bindValue('neighborhood', $neighborhood);
			$sqlInsertProvider->bindValue('city', $city);
			$sqlInsertProvider->bindValue('UF', $UF);
			$sqlInsertProvider->bindValue('site', $site);
			$sqlInsertProvider->bindValue('email', $email);
			$sqlInsertProvider->bindValue('status', $status);
			$sqlInsertProvider->bindValue('phone', $phone);
			$sqlInsertProvider->bindValue('contact', $contact);
			$sqlInsertProvider->bindValue('user_register', $id_user);
			$sqlInsertProvider->bindValue('date_register', $dateTime);
			$sqlInsertProvider->execute();

			// --- GRAVAR LOG ---


			$description = 'CADASTRAR NOVO FORNECEDOR';
			$sqlLog = "INSERT INTO provider 
			name_razao_social = :$name_razSocial,
			fantasia = $fantasia,
			type = $type,
			cpf_cnpj = $cpf_cnpj, 
			inscricao_municipal = $insc_municipal,
			inscricao_estadual = $insc_estadual,
			CEP = $CEP,
			address = $address,
			number = $number,
			complement = $complement,
			neighborhood = $neighborhood,
			city = $city,
			UF = $UF,
			site = $site,
			email = $email,
			status = $status,
			phone = $phone,
			contact = $contact,
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

			$retorno = array('codigo' => 1, 'mensagem' => 'Fornecedor Cadastrado com Sucesso!');
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



// ******************************** FIM - GRAVAR / EDITAR FORNECEDOR - BRUNO R. BERNAL - 18/01/2022 *****************

// ********************************** LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 **************

if (isset($_GET['idProvider'])) {
	$sqlListData = "SELECT b.name AS name_user_register, c.name AS name_user_update, a.* FROM provider a 
	LEFT JOIN user b ON a.user_register = b.id
	LEFT JOIN user c ON a.user_update = c.id
	WHERE a.id = :id";
	$sqlListData = $pdo->prepare($sqlListData);
	$sqlListData->bindValue('id', $_GET['idProvider']);
	$sqlListData->execute();
	$rowData = $sqlListData->fetch();
	$list_id = $rowData->id;
	$list_name_razSocial = $rowData->name_razao_social;
	$list_fantasia = $rowData->fantasia;
	$list_insc_municipal = $rowData->inscricao_municipal;
	$list_insc_estadual = $rowData->inscricao_estadual;
	$list_type = $rowData->type;
	$list_CPF_CNPJ = $rowData->CPF_CNPJ;
	$list_CEP = $rowData->CEP;
	$list_address = $rowData->address;
	$list_number = $rowData->number;
	$list_complement = $rowData->complement;
	$list_neighborhood = $rowData->neighborhood;
	$list_city = $rowData->city;
	$list_UF = $rowData->UF;
	$list_site = $rowData->site;
	$list_email = $rowData->email;
	$list_status = $rowData->status;
	$list_phone = $rowData->phone;
	$list_contact = $rowData->contact;
	$list_user_register = $rowData->name_user_register;
	$list_date_register = $rowData->date_register;
	$list_user_update = $rowData->name_user_update;
	$list_last_update = $rowData->last_update;
} else {
	$list_id = "";
	$list_name_razSocial = "";
	$list_fantasia = "";
	$list_insc_municipal = "";
	$list_insc_estadual = "";
	$list_type = "";
	$list_CPF_CNPJ = "";
	$list_CEP = "";
	$list_address = "";
	$list_number = "";
	$list_complement = "";
	$list_neighborhood = "";
	$list_city = "";
	$list_UF = "";
	$list_site = "";
	$list_email = "";
	$list_status = "";
	$list_phone = "";
	$list_contact = "";
	$list_user_register = "";
	$list_data_register = "";
	$list_user_update = "";
	$list_last_update = "";
}



// ********************************** FIM - LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 **************


// ********************************** PESQUISAR FORNECEDOR - BRUNO R. BERNAL - 18/01/2022 **********************

if(isset($_GET['searchProvider'])){

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$providerName = anti_injection($_GET['providerName']);
	$providerName = filter_var($providerName, FILTER_SANITIZE_STRING);
	if(!empty($providerName)){
		$WHERE_providerName = "WHERE name_razao_social like '%$providerName%' OR fantasia like '%$providerName%' ";
	} else{
		$WHERE_providerName = "";
	}

	$sqlSearchProvider = "SELECT * FROM provider $WHERE_providerName";
	$sqlSearchProvider = $pdo->prepare($sqlSearchProvider);
	$sqlSearchProvider->execute();

	// --- GRAVAR LOG ---


	$description = 'CONSULTAR FORNECEDOR';
	$sqlLog = "SELECT * FROM provider $WHERE_providerName";
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


// ******************************* FIM - PESQUISAR FORNECEDOR - BRUNO R. BERNAL - 18/01/2022 **********************

?>