<?php

if (!isset($_SESSION)) {
    session_start();
}

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

$ConexaoMysql = $_SESSION[ 'server' ] . '/conexao-pdo/conexao-mysql-pdo.php';
include_once($ConexaoMysql);

date_default_timezone_set('America/Sao_Paulo');
$dateTime = date('Y-m-d H:i:s', time());


if (isset($_POST['directory'])) {
	$imgFolder = $_SERVER['DOCUMENT_ROOT'] . '/' . $_POST['directory'] . '/uploads/';
}
// ******* DELL REGISTRO PM DOS HORARIOS - MONTEIRO - 10/06/2022
if(!empty($_GET['dellBox'])){
	$period = anti_injection($_POST['period']);
	$period = filter_var($period, FILTER_SANITIZE_STRING);
	
	$sha1 = anti_injection($_POST['sha1']);
	$sha1 = filter_var($sha1, FILTER_SANITIZE_STRING);
	
	$day = anti_injection($_POST['day']);
	$day = filter_var($day, FILTER_SANITIZE_STRING);
	
	$pdo->beginTransaction();
	try{
	
	$SQL_DELL = "DELETE FROM company_opening_hours WHERE sha1 = :sha1 AND period = :period AND day = :day;";
	$SQL_DELL = $pdo->prepare($SQL_DELL);
	$SQL_DELL->bindValue('sha1', $sha1);
	$SQL_DELL->bindValue('period',$period);
	$SQL_DELL->bindValue('day',$day);
	$SQL_DELL->execute();
	$pdo->commit();
	$code = "2";
	$msg = "Registro deletado com sucesso!";
	}catch(Exception $e){
		$pdo->rollback();
		$code = "1";
		$msg = "Erro: ".$e;
	}
	
	$result = array('code' =>$code,"msg" => $msg);
	echo json_encode($result);
	exit();
	
}
// ******* FIM - DELL REGISTRO PM DOS HORARIOS
// ******* CRUD TABELA company_opening_hours - MONTEIRO - 09/06/2022
if(!empty($_GET['updateHors'])){
	
	$period = anti_injection($_POST['period']);
	$period = filter_var($period, FILTER_SANITIZE_STRING);
	
	$sha1 = anti_injection($_POST['sha1']);
	$sha1 = filter_var($sha1, FILTER_SANITIZE_STRING);
	
	$day = anti_injection($_POST['day']);
	$day = filter_var($day, FILTER_SANITIZE_STRING);
	
	
	$open = anti_injection($_POST['open']);
	$open = filter_var($open, FILTER_SANITIZE_STRING);
	
	$close = anti_injection($_POST['close']);
	$close = filter_var($close, FILTER_SANITIZE_STRING);
	
	$status = anti_injection($_POST['status']);
	$status = filter_var($status, FILTER_SANITIZE_STRING);
	
	$folder = anti_injection($_POST['folder']);
	$folder = filter_var($folder, FILTER_SANITIZE_STRING);
	
	$SQL = "SELECT a.id FROM company_opening_hours a
WHERE a.period = :period AND a.sha1 = :sha1 AND a.day = :day AND a.folder = :folder;";
	$SQL = $pdo->prepare($SQL);
	$SQL->bindValue("period",$period);
	$SQL->bindValue("sha1",$sha1);
	$SQL->bindValue("day",$day);
	$SQL->bindValue("folder",$folder);
	$SQL->execute();
	if($SQL->rowCount() > 0){
		$row_id = $SQL->fetch();
		$id = $row_id->id;
		$pdo->beginTransaction();
		try{
		$SQL_update = "UPDATE company_opening_hours SET status = :status, open = :open, close = :close WHERE id = :id;";
		$SQL_update = $pdo->prepare($SQL_update);
		$SQL_update->bindValue('status',$status);
		$SQL_update->bindValue('open',$open);
		$SQL_update->bindValue('close',$close);
		$SQL_update->bindValue('id',$id);
		$SQL_update->execute();
		$code = 2;
		$msg = "Hora de funcionamento, EDITADO!";
			$pdo->commit();
		}catch(Exception $e){
			$pdo->rollback();
		}	
	}else{
		$pdo->beginTransaction();
		try{
			$SQL_insert = "INSERT INTO company_opening_hours(period,sha1,day,open,close,status,folder,date_record)VALUES(:period,:sha1,:day,:open,:close,:status,:folder,:date_record);";
			$SQL_insert = $pdo->prepare($SQL_insert);
			$SQL_insert->bindValue("period",$period);
			$SQL_insert->bindValue("sha1",$sha1);
			$SQL_insert->bindValue("day",$day);
			$SQL_insert->bindValue("open",$open);
			$SQL_insert->bindValue("close",$close);
			$SQL_insert->bindValue("status",$status);
			$SQL_insert->bindValue("folder",$folder);
			$SQL_insert->bindValue("date_record",$dateTime);
			$SQL_insert->execute();
			$pdo->commit();
			$code = 2;
			$msg = "Hora de funcionamento, registrado!";	
		}catch(Exception $e){
			$code = 1;
			$msg = $e;
		}
		
			
	}
	
	$result = array('code' => $code,"msg" =>$msg);
	echo json_encode($result);
	exit();
}
// ******* FIM - CRUD TABELA company_opening_hours

// ********************************** PESQUISAR EMPRESA - BRUNO R. BERNAL - 16/01/2022 **********************

if (isset($_GET['searchCompany'])) {

	$id_user = anti_injection($_POST['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_POST['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id_contract = anti_injection($_POST['id_contract']);
	$id_contract = filter_var($id_contract, FILTER_SANITIZE_STRING);


	$pdo->beginTransaction();

	try {

		$companyName = anti_injection($_POST['companyName']);
		$companyName = filter_var($companyName, FILTER_SANITIZE_STRING);
		if (!empty($companyName)) {
			$WHERE_companyName = "WHERE name_razao_social like '%$companyName%' ";
		} else {
			$WHERE_companyName = "";
		}

		$sqlSearchCompany = "SELECT a.* FROM company a WHERE a.id_contract = :id_contract AND a.name_razao_social LIKE :nome";
		$sqlSearchCompany = $pdo->prepare($sqlSearchCompany);
		$sqlSearchCompany->bindValue('id_contract',$id_contract);
		$sqlSearchCompany->bindValue('nome','%'.$companyName.'%');
		$sqlSearchCompany->execute();

		// --- GRAVAR LOG ---


		$description = 'CONSULTAR EMPRESA';
		$sqlLog = "SELECT a.* FROM company a WHERE a.id_contract = $id_contract AND a.name_razao_social LIKE '%$companyName%'";
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
	} catch (Exception $e) {

		$pdo->rollback();

		// --- GRAVAR LOG ---


		$description = 'ERRO AO CONSULTAR EMPRESA';
		$sqlLog = $e;
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
}


// ******************************* FIM - PESQUISAR EMPRESA - BRUNO R. BERNAL - 16/01/2022 **********************

// ********************************** LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 15/01/2022 **************

if (isset($_GET['idCompany'])) {
	$sqlListData = "SELECT a.sha1 as sha1_company, b.name AS name_user_register, c.name AS name_user_update, a.* FROM company a 
	LEFT JOIN user b ON a.user_register = b.id
	LEFT JOIN user c ON a.user_update = c.id
	WHERE a.id = :id";
	$sqlListData = $pdo->prepare($sqlListData);
	$sqlListData->bindValue('id', $_GET['idCompany']);
	$sqlListData->execute();
	$rowData = $sqlListData->fetch();
	$list_id_sequence = $rowData->id_sequence;
	$list_id = $rowData->id;
	$sha1 = $rowData->sha1_company;
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
	$list_district = $rowData->district;
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
	// ******* LISTAR OS HORÁRIOS DE FUNCIONAMENTO - MONTEIRO - 13/06/2022
		$SQL_list_hours_company = "SELECT a.period, a.`sha1`, a.`day`, DATE_FORMAT(a.`open`, '%H:%i') AS open, DATE_FORMAT(a.`close`, '%H:%i') AS close, a.`status` FROM company_opening_hours a WHERE a.`sha1` = :sha1";
		$SQL_list_hours_company = $pdo->prepare($SQL_list_hours_company);
		$SQL_list_hours_company->bindValue('sha1',$sha1);
		$SQL_list_hours_company->execute();
	
		while($row_list_hours_company = $SQL_list_hours_company->fetch()){
			if($row_list_hours_company->day == 'Domingo' && $row_list_hours_company->period == 'AM'){
				$domAMI = $row_list_hours_company->open;
				$domAMF = $row_list_hours_company->close;
				$domsta = $row_list_hours_company->status;
			}
			if($row_list_hours_company->day == 'Segunda' && $row_list_hours_company->period == 'AM'){
				$segAMI = $row_list_hours_company->open;
				$segAMF = $row_list_hours_company->close;
				$segsta = $row_list_hours_company->status;
			}
			if($row_list_hours_company->day == 'Terça' && $row_list_hours_company->period == 'AM'){
				$terAMI = $row_list_hours_company->open;
				$terAMF = $row_list_hours_company->close;
				$tersta = $row_list_hours_company->status;
			}
			if($row_list_hours_company->day == 'Quarta' && $row_list_hours_company->period == 'AM'){
				$quaAMI = $row_list_hours_company->open;
				$quaAMF = $row_list_hours_company->close;
				$quasta = $row_list_hours_company->status;
			}
			if($row_list_hours_company->day == 'Quinta' && $row_list_hours_company->period == 'AM'){
				$quiAMI = $row_list_hours_company->open;
				$quiAMF = $row_list_hours_company->close;
				$quista = $row_list_hours_company->status;
			}
			if($row_list_hours_company->day == 'Sexta' && $row_list_hours_company->period == 'AM'){
				$sexAMI = $row_list_hours_company->open;
				$sexAMF = $row_list_hours_company->close;
				$sexsta = $row_list_hours_company->status;
			}
			if($row_list_hours_company->day == 'Sabado' && $row_list_hours_company->period == 'AM'){
				$sabAMI = $row_list_hours_company->open;
				$sabAMF = $row_list_hours_company->close;
				$sabsta = $row_list_hours_company->status;
			}
			
			if($row_list_hours_company->day == 'Domingo' && $row_list_hours_company->period == 'PM'){
				$domPMI = $row_list_hours_company->open;
				$domPMF = $row_list_hours_company->close;
			}
			if($row_list_hours_company->day == 'Segunda' && $row_list_hours_company->period == 'PM'){
				$segPMI = $row_list_hours_company->open;
				$segPMF = $row_list_hours_company->close;
			}
			if($row_list_hours_company->day == 'Terça' && $row_list_hours_company->period == 'PM'){
				$terPMI = $row_list_hours_company->open;
				$terPMF = $row_list_hours_company->close;
			}
			if($row_list_hours_company->day == 'Quarta' && $row_list_hours_company->period == 'PM'){
				$quaPMI = $row_list_hours_company->open;
				$quaPMF = $row_list_hours_company->close;
			}
			if($row_list_hours_company->day == 'Quinta' && $row_list_hours_company->period == 'PM'){
				$quiPMI = $row_list_hours_company->open;
				$quiPMF = $row_list_hours_company->close;
			}
			if($row_list_hours_company->day == 'Sexta' && $row_list_hours_company->period == 'PM'){
				$sexPMI = $row_list_hours_company->open;
				$sexPMF = $row_list_hours_company->close;
			}
			if($row_list_hours_company->day == 'Sabado' && $row_list_hours_company->period == 'PM'){
				$sabPMI = $row_list_hours_company->open;
				$sabPMF = $row_list_hours_company->close;
			}
		}
	// ******* FIM - LISTAR OS HORÁRIOS DE FUNCIONAMENTO
} else {
	$list_id_sequence = "";
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
	$list_district = "";
	$list_city = "";
	$list_UF = "";
	$list_site = "";
	$list_email = "";
	$list_status = "";
	$list_phone = "";
	$list_color_header = "#000000";
	$list_color_text = "#ffc400";
	$list_user_register = "";
	$list_data_register = "";
	$list_user_update = "";
	$list_last_update = "";
}



// ********************************** FIM - LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 15/01/2022 **************


// ********************************** GRAVAR / EDITAR EMPRESA - BRUNO R. BERNAL - 14/01/2022 *****************

if (!empty($_GET['saveCompany'])) {

	$bloq = anti_injection($_POST['bloq']);
	$bloq = filter_var($bloq, FILTER_SANITIZE_STRING);

	$id_user = anti_injection($_POST['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_POST['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id_contract = $_POST['id_contract'];
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

	$phone = anti_injection($_POST['phone']);
	$phone = filter_var($phone, FILTER_SANITIZE_STRING);

	$email = anti_injection($_POST['email']);
	$email = filter_var($email, FILTER_SANITIZE_STRING);

	$site = anti_injection($_POST['site']);
	$site = filter_var($site, FILTER_SANITIZE_STRING);

	$status = anti_injection($_POST['status']);
	$status = filter_var($status, FILTER_SANITIZE_STRING);

	$colorHeader = $_POST['color_header'];
	$colorHeader = filter_var($colorHeader, FILTER_SANITIZE_STRING);

	$colorText = $_POST['color_text'];
	$colorText = filter_var($colorText, FILTER_SANITIZE_STRING);
	
	$delivery_status = $_POST['delivery_status'];
	$delivery_status = filter_var($delivery_status, FILTER_SANITIZE_STRING);
	
	$delivery_start = $_POST['delivery_start'];
	$delivery_start = filter_var($delivery_start, FILTER_SANITIZE_STRING);
	
	$delivery_end = $_POST['delivery_end'];
	$delivery_end = filter_var($delivery_end, FILTER_SANITIZE_STRING);
	
	$km_delivery = $_POST['km_delivery'];
	$km_delivery = filter_var($km_delivery, FILTER_SANITIZE_STRING);
	
	$sha1 = $_POST['sha1'];
	$sha1 = filter_var($sha1, FILTER_SANITIZE_STRING);
	
	//******* VERIFICAR A SEQUÊNCIA DO ID DA EMPRESA - MONTEIRO - 02/05/2022 - *******
	$SQL_seq_id = "SELECT (COUNT(*) + 1) AS total FROM company a WHERE a.id_contract = :id_contract;";
	$SQL_seq_id = $pdo->prepare($SQL_seq_id);
	$SQL_seq_id->bindValue('id_contract',$id_contract);
	$SQL_seq_id->execute();
	if($SQL_seq_id->rowCount() > 0){
		$row_seq_id = $SQL_seq_id->fetch();
		$id_sequence = $row_seq_id->total;
	}else{
		$id_sequence = 1;
	}
	//******* FIM, VERIFICAR A SEQUÊNCIA DO ID DA EMPRESA - *******
	
	$pdo->beginTransaction();
	try {
		if (!empty($_FILES['logo']['name'])){
			$novoNome = uniqid();
			$file_extension = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$filename = $novoNome . "." . $file_extension;
			$location = $imgFolder . "logo/" . $filename;

			// Valid image extensions
			$image_ext = array("jpg", "png", "jpeg","JPG", "PNG", "JPEG");

			if (in_array($file_extension, $image_ext)) {

				
				// Upload file
				if (move_uploaded_file($_FILES['logo']['tmp_name'], $location)) {
					
					

					if (!empty($id)) {


						// --- APAGAR IMAGEM ANTIGA ------

						$sqlOldImageCompany = "SELECT logo FROM company WHERE id = :id";
						$sqlOldImageCompany = $pdo->prepare($sqlOldImageCompany);
						$sqlOldImageCompany->bindValue('id', $id);
						$sqlOldImageCompany->execute();
						$rowOldImageCompany = $sqlOldImageCompany->fetch();
						$oldImageCompany = $rowOldImageCompany->logo;
						if (!empty($oldImageCompany)) {
							
							unlink($imgFolder . "logo/" . $oldImageCompany);

							
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
			
			
		}else{
			$filename = '';
		}
		
		$sqlCPFCNPJ = "SELECT id FROM company WHERE CPF_CNPJ = :CPF_CNPJ";
		$sqlCPFCNPJ = $pdo->prepare($sqlCPFCNPJ);
		$sqlCPFCNPJ->bindValue('CPF_CNPJ', $cpf_cnpj);
		$sqlCPFCNPJ->execute();
		if ($sqlCPFCNPJ->rowCount() > 0){
			// --------------------------------- ATUALIZAR DADOS ------------------------

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
			district = :district,
			city = :city,
			UF = :UF,
			site = :site,
			email = :email,
			status = :status,
			phone = :phone,
			color_header = :color_header,
			color_text = :color_text,
			user_update = :user_update,
			last_update = :last_update,
			delivery_status = :delivery_status,
			delivery_start = :delivery_start,
			delivery_end = :delivery_end,
			km_delivery = :km_delivery
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
			$sqlUpdateCompany->bindValue('district', $district);
			$sqlUpdateCompany->bindValue('city', $city);
			$sqlUpdateCompany->bindValue('UF', $UF);
			$sqlUpdateCompany->bindValue('site', $site);
			$sqlUpdateCompany->bindValue('email', $email);
			$sqlUpdateCompany->bindValue('status', $status);
			$sqlUpdateCompany->bindValue('phone', $phone);
			$sqlUpdateCompany->bindValue('color_header', $colorHeader);
			$sqlUpdateCompany->bindValue('color_text', $colorText);
			$sqlUpdateCompany->bindValue('user_update', $id_user);
			$sqlUpdateCompany->bindValue('last_update', $dateTime);
			$sqlUpdateCompany->bindValue('delivery_status', $delivery_status);
			$sqlUpdateCompany->bindValue('delivery_start', $delivery_start);
			$sqlUpdateCompany->bindValue('delivery_end', $delivery_end);
			$sqlUpdateCompany->bindValue('km_delivery', $km_delivery);
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
			$sqlLog = "PDATE company SET 
			name_razao_social = $name_razSocial,
			fantasia = $fantasia,
			type = $type,
			inscricao_municipal = $insc_municipal,
			inscricao_estadual = $insc_estadual,
			CEP = $CEP,
			address = $address,
			number = $number,
			complement = $complement,
			district = $district,
			city = $city,
			UF = $UF,
			site = $site,
			email = $email,
			status = $status,
			phone = $phone,
			color_header = $colorHeader,
			color_text = $colorText,
			user_update = $id_user,
			last_update = $dateTime,
			delivery_status = $delivery_status,
			delivery_start = $delivery_start,
			delivery_end = $delivery_end,
			km_delivery = $km_delivery			
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
		}else{
			$sqlInsertCompany = "INSERT INTO company (name_razao_social, fantasia, type, CPF_CNPJ, inscricao_municipal, inscricao_estadual, CEP, address, number, complement, district, city, UF, site, email, status, phone, color_header, color_text, user_register, date_register, id_contract,id_sequence, logo,sha1,delivery_status,delivery_start,delivery_end,km_delivery) VALUES (:name_razao_social, :fantasia, :type, :CPF_CNPJ, :inscricao_municipal, :inscricao_estadual, :CEP, :address, :number, :complement, :district, :city, :UF, :site, :email, :status, :phone, :color_header, :color_text, :user_register, :date_register, :id_contract,:id_sequence, :logo,:sha1,:delivery_status,:delivery_start,:delivery_end,:km_delivery)";
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
			$sqlInsertCompany->bindValue('district', $district);
			$sqlInsertCompany->bindValue('city', $city);
			$sqlInsertCompany->bindValue('UF', $UF);
			$sqlInsertCompany->bindValue('site', $site);
			$sqlInsertCompany->bindValue('email', $email);
			$sqlInsertCompany->bindValue('status', $status);
			$sqlInsertCompany->bindValue('phone', $phone);
			$sqlInsertCompany->bindValue('color_header', $colorHeader);
			$sqlInsertCompany->bindValue('color_text', $colorText);
			$sqlInsertCompany->bindValue('user_register', $id_user);
			$sqlInsertCompany->bindValue('date_register', $dateTime);
			$sqlInsertCompany->bindValue('id_contract', $id_contract);
			$sqlInsertCompany->bindValue('id_sequence', $id_sequence);
			$sqlInsertCompany->bindValue('logo', $filename);
			$sqlInsertCompany->bindValue('sha1', $sha1);
			$sqlInsertCompany->bindValue('delivery_status', $delivery_status);
			$sqlInsertCompany->bindValue('delivery_start', $delivery_start);
			$sqlInsertCompany->bindValue('delivery_end', $delivery_end);
			$sqlInsertCompany->bindValue('km_delivery', $km_delivery);
			$sqlInsertCompany->execute();
			
			/*if (!empty($bloq)) {
				$SQL_id_empresa = "SELECT a.id FROM company a WHERE a.CPF_CNPJ = :CPF_CNPJ;";
				$SQL_id_empresa = $pdo->prepare($SQL_id_empresa);
				$SQL_id_empresa->bindValue('CPF_CNPJ', $cpf_cnpj);
				$SQL_id_empresa->execute();
				if ($SQL_id_empresa->rowCount() > 0) {
					$row = $SQL_id_empresa->fetch();
					$id_company = $row->id;
					$SQL_update_user = "UPDATE user SET id_company = :id_company where id = :id;";
					$SQL_update_user = $pdo->prepare($SQL_update_user);
					$SQL_update_user->bindValue('id_company', $id_company);
					$SQL_update_user->bindValue('id', $_SESSION['id_user']);
					$SQL_update_user->execute();
					//******* EDITAR A TABELA USER_COMPANY - MONTEIRO - 03/06/2022
						$SQL_update = "UPDATE user_company SET id_company = :id_company WHERE id_user = :id_user AND folder = :folder;";
						$SQL_update = $pdo->prepare($SQL_update);
						$SQL_update->bindValue('id_company',$id_company);
						$SQL_update->bindValue('id_user',$_SESSION['id_user']);
						$SQL_update->bindValue('folder',$_SESSION[ 'directory' ]);
						$SQL_update->execute();
					//******* FIM - EDITAR A TABELA USER_COMPANY
					$retorno = array('codigo' => 2, 'mensagem' => $directory.' Empresa Cadastrada com Sucesso! Agora faça o login novamente! ');
					echo json_encode($retorno);
					exit();
				}
			} else {
				$retorno = array('codigo' => 1, 'mensagem' => $bloq);
				echo json_encode($retorno);
				exit();
			}*/
			$pdo->commit();
			if (!empty($bloq)){
				$SQL_id_empresa = "SELECT a.id FROM company a WHERE a.CPF_CNPJ = :CPF_CNPJ;";
				$SQL_id_empresa = $pdo->prepare($SQL_id_empresa);
				$SQL_id_empresa->bindValue('CPF_CNPJ', $cpf_cnpj);
				$SQL_id_empresa->execute();
				if ($SQL_id_empresa->rowCount() > 0){
					$row = $SQL_id_empresa->fetch();
					$id_company = $row->id;
					$SQL_update_user = "UPDATE user SET id_company = :id_company where id = :id;";
					$SQL_update_user = $pdo->prepare($SQL_update_user);
					$SQL_update_user->bindValue('id_company', $id_company);
					$SQL_update_user->bindValue('id', $_SESSION['id_user']);
					$SQL_update_user->execute();
					
					//******* EDITAR A TABELA USER_COMPANY - MONTEIRO - 03/06/2022
						$SQL_update = "UPDATE user_company SET id_company = :id_company WHERE id_user = :id_user AND folder = :folder;";
						$SQL_update = $pdo->prepare($SQL_update);
						$SQL_update->bindValue('id_company',$id_company);
						$SQL_update->bindValue('id_user',$_SESSION['id_user']);
						$SQL_update->bindValue('folder',$_SESSION[ 'directory' ]);
						$SQL_update->execute();
					//******* FIM - EDITAR A TABELA USER_COMPANY
					
					$retorno = array('codigo' => 2, 'mensagem' => $_SESSION[ 'directory' ].' Empresa Cadastrada com Sucesso! Agora faça o login novamente! ');
					echo json_encode($retorno);
					exit();
				}else{
					$retorno = array('codigo' => 0, 'mensagem' => 'não achou ');
					echo json_encode($retorno);
					exit();
				}
				
				
			}else{
				$retorno = array('codigo' => 0, 'mensagem' => 'blog não preenchido');
				echo json_encode($retorno);
				exit();
			}
			
			
		}
		
		
		
		
		
	}catch (Exception $e) {

		$pdo->rollback();

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro: ' . $e);
		echo json_encode($retorno);
		exit();
	}
	
	
}



// ******************************** FIM - GRAVAR / EDITAR EMPRESA - BRUNO R. BERNAL - 14/01/2022 *****************
