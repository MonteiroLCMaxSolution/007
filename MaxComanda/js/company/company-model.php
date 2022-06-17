<?php

if (!isset($_SESSION)) {
	session_start();
}
if (empty($_GET['directory'])) {
	$directory = "/MaxComanda/";
} else {
	$directory = $_GET['directory'];
}

/*ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);*/


$ConexaoMysql = $_SERVER['DOCUMENT_ROOT'] . '/' . $directory . '/conexao-pdo/conexao-mysql-pdo.php';
include_once($ConexaoMysql);


date_default_timezone_set('America/Sao_Paulo');
$dateTime = date('Y-m-d H:i:s', time());


$imgFolder = $_SERVER['DOCUMENT_ROOT'] . '/' . $directory . '/uploads/';


// ********************************** PESQUISAR EMPRESA - BRUNO R. BERNAL - 16/01/2022 **********************

if(isset($_GET['searchCompany'])){

	$companyName = anti_injection($_GET['companyName']);
	$companyName = filter_var($companyName, FILTER_SANITIZE_STRING);
	if(!empty($companyName)){
		$WHERE_companyName = "WHERE name_razao_social like '%$companyName%' OR fantasia like '%$companyName%' ";
	} else{
		$WHERE_companyName = "";
	}

	$sqlSearchCompany = "SELECT * FROM company $WHERE_companyName";
	$sqlSearchCompany = $pdo->prepare($sqlSearchCompany);
	$sqlSearchCompany->execute();

	// --- GRAVAR LOG ---


	$description = 'CONSULTAR EMPRESA';
	$sqlLog = "SELECT * FROM company $WHERE_companyName";
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
	$register_log->bindValue('user', $_SESSION['user_id']);
	$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
	$register_log->execute();


	// --- FIM - GRAVAR LOG ---
}


// ******************************* FIM - PESQUISAR EMPRESA - BRUNO R. BERNAL - 16/01/2022 **********************

// ********************************** LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 15/01/2022 **************

if (isset($_GET['idCompany'])) {
	$sqlListData = "SELECT b.name AS name_user_register, c.name AS name_user_update, a.* FROM company a 
	LEFT JOIN user b ON a.user_register = b.id
	LEFT JOIN user c ON a.user_update = c.id
	WHERE a.id = :id";
	$sqlListData = $pdo->prepare($sqlListData);
	$sqlListData->bindValue('id', $_GET['idCompany']);
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
	$list_color_header = $rowData->color_header;
	$list_color_text = $rowData->color_text;
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
	$list_color_header = "";
	$list_color_text = "";
	$list_user_register = "";
	$list_data_register = "";
	$list_user_update = "";
	$list_last_update = "";
}



// ********************************** FIM - LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 15/01/2022 **************


// ********************************** GRAVAR / EDITAR EMPRESA - BRUNO R. BERNAL - 14/01/2022 *****************

if (!empty($_GET['saveCompany'])) {

	$id = anti_injection($_POST['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$bloq = anti_injection($_POST['bloq']);
	$bloq = filter_var($bloq, FILTER_SANITIZE_STRING);

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

	$logo = anti_injection($_POST['logo']);
	$logo = filter_var($logo, FILTER_SANITIZE_STRING);

	$colorHeader = $_POST['color_header'];
	$colorHeader = filter_var($colorHeader, FILTER_SANITIZE_STRING);


	$colorText = $_POST['color_text'];
	$colorText = filter_var($colorText, FILTER_SANITIZE_STRING);
	
	
	$pdo->beginTransaction();

	try {

		// --- GRAVAR IMAGEM ---

		if (!empty($_FILES['logo']['name'])) {
			$novoNome = uniqid();
			$file_extension = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$filename = $novoNome . "." . $file_extension;
			$location = $imgFolder ."logo/". $filename;

			// Valid image extensions
			$image_ext = array("jpg", "png", "jpeg");

			if (in_array($file_extension, $image_ext)) {
				// Upload file
				if (move_uploaded_file($_FILES['logo']['tmp_name'], $location)) {

					if (!empty($_POST['id'])) {


						// --- APAGAR IMAGEM ANTIGA ------

						$sqlOldImage = "SELECT logo FROM company WHERE id = :id";
						$sqlOldImage = $pdo->prepare($sqlOldImage);
						$sqlOldImage->bindValue('id', $_POST['id']);
						$sqlOldImage->execute();
						if ($sqlOldImage->rowCount() > 0) {
							$rowOldImage = $sqlOldImage->fetch();
							$oldImage = $rowOldImage->logo;

							unlink($imgFolder . $oldImage);
						}


						// --- FIM - APAGAR IMAGEM ANTIGA ---
					}
				} else {
					$retorno = array('codigo' => 0, 'mensagem' => 'Erro ao enviar imagem!');
					echo json_encode($retorno);
					exit();
				}
			} else {
				$retorno = array('codigo' => 0, 'mensagem' => 'Formato de imagem inválido!');
				echo json_encode($retorno);
				exit();
			}
		} else {
			$filename = '';
		}

		// --- FIM - GRAVAR IMAGEM ---


		// --- VERIFICAR SE EXISTE EMPRESA COM ESTE CPF / CNPJ ---

		$sqlCPFCNPJ = "SELECT id FROM company WHERE CPF_CNPJ = :CPF_CNPJ";
		$sqlCPFCNPJ = $pdo->prepare($sqlCPFCNPJ);
		$sqlCPFCNPJ->bindValue('CPF_CNPJ', $cpf_cnpj);
		$sqlCPFCNPJ->execute();
		if ($sqlCPFCNPJ->rowCount() > 0) {
			// --------------------------------- ATUALIZAR DADOS ------------------------

			if (empty($_POST['id'])) {
				$retorno = array('codigo' => 0, 'mensagem' => "Já existe uma empresa cadastrada com este CPF / CNPJ!");
				echo json_encode($retorno);
				exit();
			}


			$sqlUpdateCompany = 'UPDATE company SET 
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
			color_header = :color_header,
			color_text = :color_text,
			user_update = :user_update,
			last_update = :last_update
			WHERE id = :id';
			$sqlUpdateCompany = $pdo->prepare($sqlUpdateCompany);
			$sqlUpdateCompany->bindValue('name_razao_social', $name_razSocial);
			$sqlUpdateCompany->bindValue('fantasia', $fantasia);
			$sqlUpdateCompany->bindValue('type', $type);
			$sqlUpdateCompany->bindValue('inscricao_municipal', $insc_municipal);
			$sqlUpdateCompany->bindValue('inscricao_estadual', $insc_estadual);
			$sqlUpdateCompany->bindValue('CEP', $CEP);
			$sqlUpdateCompany->bindValue('address', $address);
			$sqlUpdateCompany->bindValue('number', $number);
			$sqlUpdateCompany->bindValue('complement', $complement);
			$sqlUpdateCompany->bindValue('neighborhood', $neighborhood);
			$sqlUpdateCompany->bindValue('city', $city);
			$sqlUpdateCompany->bindValue('UF', $UF);
			$sqlUpdateCompany->bindValue('site', $site);
			$sqlUpdateCompany->bindValue('email', $email);
			$sqlUpdateCompany->bindValue('status', $status);
			$sqlUpdateCompany->bindValue('phone', $phone);
			$sqlUpdateCompany->bindValue('color_header', $colorHeader);
			$sqlUpdateCompany->bindValue('color_text', $colorText);
			$sqlUpdateCompany->bindValue('user_update', $_SESSION['user_id']);
			$sqlUpdateCompany->bindValue('last_update', $dateTime);
			$sqlUpdateCompany->bindValue('id', $id);
			$sqlUpdateCompany->execute();


			// --- GRAVAR LOGO, SE HOUVER ---

			if (!empty($filename)) {
				$sqlUpdateLogo = "UPDATE company SET logo = :logo WHERE id = :id";
				$sqlUpdateLogo = $pdo->prepare($sqlUpdateLogo);
				$sqlUpdateLogo->bindValue('logo', $filename);
				$sqlUpdateLogo->bindValue('id', $id);
				$sqlUpdateLogo->execute();
			}

			// --- FIM - GRAVAR LOGO ---



			// --- GRAVAR LOG ---


			$description = 'ATUALIZAR DADOS EMPRESA ' . $id;
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
			color_header = $colorHeader,
			color_text = $colorText,
			user_update = " . $_SESSION['user_id'] . ",
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
			$register_log->bindValue('id_company', $_SESSION['id_company']);
			$register_log->bindValue('dateTime', $dateTime);
			$register_log->bindValue('action', $sqlLog);
			$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
			$register_log->bindValue('description', $description);
			$register_log->bindValue('user', $_SESSION['user_id']);
			$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
			$register_log->execute();


			// --- FIM - GRAVAR LOG ---


			$pdo->commit();

			$retorno = array('codigo' => 1, 'mensagem' => 'Dados Atualizados com Sucesso!');
			echo json_encode($retorno);
			exit();
		} else {
			// --------------------------------- CADASTRAR NOVA EMPRESA ------------------------

			$sqlInsertCompany = "INSERT INTO company (name_razao_social, fantasia, type, CPF_CNPJ, inscricao_municipal, inscricao_estadual, CEP, address, number, complement, neighborhood, city, UF, site, email, status, phone, color_header, color_text, user_register, date_register) VALUES (:name_razao_social, :fantasia, :type, :CPF_CNPJ, :inscricao_municipal, :inscricao_estadual, :CEP, :address, :number, :complement, :neighborhood, :city, :UF, :site, :email, :status, :phone, :color_header, :color_text, :user_register, :date_register)";
			$sqlInsertCompany = $pdo->prepare($sqlInsertCompany);
			$sqlInsertCompany->bindValue('name_razao_social', $name_razSocial);
			$sqlInsertCompany->bindValue('fantasia', $fantasia);
			$sqlInsertCompany->bindValue('type', $type);
			$sqlInsertCompany->bindValue('CPF_CNPJ', $cpf_cnpj);
			$sqlInsertCompany->bindValue('inscricao_municipal', $insc_municipal);
			$sqlInsertCompany->bindValue('inscricao_estadual', $insc_estadual);
			$sqlInsertCompany->bindValue('CEP', $CEP);
			$sqlInsertCompany->bindValue('address', $address);
			$sqlInsertCompany->bindValue('number', $number);
			$sqlInsertCompany->bindValue('complement', $complement);
			$sqlInsertCompany->bindValue('neighborhood', $neighborhood);
			$sqlInsertCompany->bindValue('city', $city);
			$sqlInsertCompany->bindValue('UF', $UF);
			$sqlInsertCompany->bindValue('site', $site);
			$sqlInsertCompany->bindValue('email', $email);
			$sqlInsertCompany->bindValue('status', $status);
			$sqlInsertCompany->bindValue('phone', $phone);
			$sqlInsertCompany->bindValue('color_header', $colorHeader);
			$sqlInsertCompany->bindValue('color_text', $colorText);
			$sqlInsertCompany->bindValue('user_register', $_SESSION['user_id']);
			$sqlInsertCompany->bindValue('date_register', $dateTime);
			$sqlInsertCompany->execute();

			// --- GRAVAR LOGO, SE HOUVER ---

			if (!empty($filename)) {
				$sqlUpdateLogo = "UPDATE company SET logo = :logo WHERE CPF_CNPJ = :CPF_CNPJ";
				$sqlUpdateLogo = $pdo->prepare($sqlUpdateLogo);
				$sqlUpdateLogo->bindValue('logo', $filename);
				$sqlUpdateLogo->bindValue('CPF_CNPJ', $cpf_cnpj);
				$sqlUpdateLogo->execute();
			}

			// --- FIM - GRAVAR LOGO ---
			


			// --- GRAVAR LOG ---


			$description = 'CADASTRAR NOVA EMPRESA';
			$sqlLog = "INSERT INTO company 
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
			color_header = $colorHeader,
			color_text = $colorText,
			user_register = " . $_SESSION['user_id'] . ",
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
			$register_log->bindValue('id_company', $_SESSION['id_company']);
			$register_log->bindValue('dateTime', $dateTime);
			$register_log->bindValue('action', $sqlLog);
			$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
			$register_log->bindValue('description', $description);
			$register_log->bindValue('user', $_SESSION['user_id']);
			$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
			$register_log->execute();


			// --- FIM - GRAVAR LOG ---
			


			$pdo->commit();
			// PEGAR A ID DA EMPRESA - LEÔNIDAS MONTEIRO - 27/01/2022
			if(!empty($bloq)){
				$SQL_id_empresa = "SELECT * FROM company a WHERE CPF_CNPJ = :CPF_CNPJ;";
				$SQL_id_empresa = $pdo->prepare($SQL_id_empresa);
				$SQL_id_empresa->bindValue('CPF_CNPJ',$cpf_cnpj);
				$SQL_id_empresa->execute();
				if($SQL_id_empresa->rowCount() > 0){
					$row = $SQL_id_empresa->fetch();
					$id_company = $row->id;
					$SQL_update_user = "UPDATE user SET id_company = :id_company where id = :id;";
					$SQL_update_user = $pdo->prepare($SQL_update_user);
					$SQL_update_user->bindValue('id_company',$id_company);
					$SQL_update_user->bindValue('id',$_SESSION['user_id']);
					$SQL_update_user->execute();
					$retorno = array('codigo' => 2, 'mensagem' => 'Empresa Cadastrada com Sucesso! Agora faça o login novamente! '.$_SESSION['user_id']);
					echo json_encode($retorno);
					exit();
				}
			}else{
				$retorno = array('codigo' => 1, 'mensagem' => $bloq);
				echo json_encode($retorno);
				exit();
				
			}
			
			// .PEGAR A ID DA EMPRESA

			
		}
	} catch (Exception $e) {

		$pdo->rollback();

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro: ' . $e);
		echo json_encode($retorno);
		exit();
	}
}



// ******************************** FIM - GRAVAR / EDITAR EMPRESA - BRUNO R. BERNAL - 14/01/2022 *****************
