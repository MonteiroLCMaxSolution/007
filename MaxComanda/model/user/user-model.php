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
$ConexaoMysql = '/home/maxcomanda/public_html/' . $directory . '/conexao-pdo/conexao-mysql-pdo.php';
include_once($ConexaoMysql);

date_default_timezone_set('America/Sao_Paulo');
$dataLocal = date('Y-m-d H:i:s', time());

$dateTime = date('Y-m-d H:i:s', time());

$imgFolder = $_SERVER['DOCUMENT_ROOT'] . '/' . $directory . '/uploads/';



// ******************************* LOGOUT - BRUNO R. BERNAL - 04/02/2022 *************************

if (isset($_GET['logout'])) {
	$_SESSION = array();
	session_destroy();
}

// ******************************* FIM -  LOGOUT - BRUNO R. BERNAL - 04/02/2022 *********************




// **************************************************** LOGIN *****************************************

if (!empty($_GET['access'])) {
	$login = $_GET['login'];
	$password = $_GET['password'];
	if ($login == '') {
		$return = array('code' => 1, 'message' => 'Informe seu login!');
		echo json_encode($return);
		exit();
	}
	if ($password == '') {
		$return = array('code' => 1, 'message' => 'Informe sua senha!');
		echo json_encode($return);
		exit();
	}
	if (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
		$return = array('code' => 1, 'message' => 'email invalido!');
		echo json_encode($return);
		exit();
	}
	$SQL_login = "SELECT a.profile, a.img, a.`status`,a.password, a.id AS user_id, a.name AS user_name, a.email AS user_mail, a.number_access AS user_access, a.last_access AS user_last, a.id_company AS company_id, b.name_razao_social AS company_name, b.color_header, b.color_text, b.logo FROM user a LEFT JOIN company b ON a.id_company = b.id WHERE a.email = :email;";
	$SQL_login = $pdo->prepare($SQL_login);
	$SQL_login->bindValue('email', $login);
	$SQL_login->execute();
	if ($SQL_login->rowCount() > 0) {
		$row = $SQL_login->fetch();
		$status = $row->status;
		if ($status == "Ativo") {
			if (password_verify($password, $row->password)) {
				$user_id = $row->user_id;
				$user_name = $row->user_name;
				$user_mail = $row->user_mail;
				$user_access = $row->user_access;
				$user_last = $row->user_last;
				$company_id = $row->company_id;
				$company_name = $row->company_name;
				$color = $row->color_header;
				$color_text = $row->color_text;
				$user_img = $row->img;
				$user_profile = $row->profile;
				$logo = $row->logo;
				$_SESSION['id_user'] = $user_id;
				$_SESSION['name_user'] = $user_name;
				$_SESSION['user_mail'] = $user_mail;
				$_SESSION['user_access'] = $user_access;
				$_SESSION['user_last'] = $user_last;
				$_SESSION['id_company'] = $company_id;
				$_SESSION['company_name'] = $company_name;
				$_SESSION['color'] = $color;
				$_SESSION['color-text'] = $color_text;
				$_SESSION['userImage'] = $user_img;
				$_SESSION['userProfile'] = $user_profile;
				$_SESSION['login'] = 1;
				$_SESSION['logo'] = $logo;
				if ($row->company_name != '') {
					$return = array('code' => 2, 'message' => "Acesso Permitido!", "user_id" => $user_id, "user_name" => $user_name, "user_mail" => $user_mail, "user_access" => $user_access, "user_last" => $user_last, "company_id" => $company_id, "company_name" => $company_id, 'user_id' => $user_id);
					echo json_encode($return);
					exit();
				} else {
					$return = array('code' => 1, 'message' => "É necessário informar os dados de sua empresa!", "user_id" => $user_id, "user_name" => $user_name, "user_mail" => $user_mail, "user_access" => $user_access, "user_last" => $user_last, "company_id" => $company_id, "company_name" => $company_id, 'user_id' => $user_id);
					echo json_encode($return);
					exit();
				}
			} else {
				$return = array('code' => 2, 'message' => "Senha inválida!");
				echo json_encode($return);
				exit();
			}
		} else {
			$return = array('code' => 2, 'message' => "Verifique sua permissão junto a sua Gerencia!");
			echo json_encode($return);
			exit();
		}
	} else {
		$return = array('code' => 1, 'message' => "E-mail não encontrado");
		echo json_encode($return);
		exit();
	}
}

// **************************************** FIM - LOGIN ******************************************************

// ********************************** GRAVAR / EDITAR USUÁRIO - BRUNO R. BERNAL - 17/01/2022 *****************

if (!empty($_GET['saveUser'])) {

	$directory = anti_injection($_GET['directory']);
	$directory = filter_var($directory, FILTER_SANITIZE_STRING);

	$imgFolder = $_SERVER['DOCUMENT_ROOT'] . "/" . $directory . "/uploads/";

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$company_id = anti_injection($_GET['company_id']);
	$company_id = filter_var($company_id, FILTER_SANITIZE_STRING);

	$id = anti_injection($_POST['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_POST['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$cpf = anti_injection($_POST['cpf']);
	$cpf = filter_var($cpf, FILTER_SANITIZE_STRING);

	$name = anti_injection($_POST['name']);
	$name = filter_var($name, FILTER_SANITIZE_STRING);

	$surname = anti_injection($_POST['surname']);
	$surname = filter_var($surname, FILTER_SANITIZE_STRING);

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

	$status = anti_injection($_POST['status']);
	$status = filter_var($status, FILTER_SANITIZE_STRING);

	$profile = anti_injection($_POST['profile']);
	$profile = filter_var($profile, FILTER_SANITIZE_STRING);

	// $login = anti_injection($_POST['login']);
	//	$login = filter_var($login, FILTER_SANITIZE_STRING);

	$password = anti_injection($_POST['password']);
	$password = filter_var($password, FILTER_SANITIZE_STRING);

	$comission = anti_injection($_POST['comission']);
	$comission = filter_var($comission, FILTER_SANITIZE_STRING);
	if (!empty($comission)) {
		$comission = $comission;
		$comission = str_replace('.', '', $comission);
		$comission = str_replace(',', '.', $comission);
	} else {
		$comission = 0.0;
	}

	$comission_status = anti_injection($_POST['comission_status']);
	$comission_status = filter_var($comission_status, FILTER_SANITIZE_STRING);

	$payday = anti_injection($_POST['payday']);
	$payday = filter_var($payday, FILTER_SANITIZE_STRING);

	$admission_date = anti_injection($_POST['admission_date']);
	$admission_date = filter_var($admission_date, FILTER_SANITIZE_STRING);
	if (!empty($admission_date)) {

		$admission_date = $admission_date;
		$admission_date = explode('/', $admission_date);
		$admission_date = $admission_date[2] . '-' . $admission_date[1] . '-' . $admission_date[0];
	} else {
		$admission_date = NULL;
	}

	$resignation_date = anti_injection($_POST['resignation_date']);
	$resignation_date = filter_var($resignation_date, FILTER_SANITIZE_STRING);
	if (!empty($resignation_date)) {

		$resignation_date = $resignation_date;
		$resignation_date = explode('/', $resignation_date);
		$resignation_date = $resignation_date[2] . '-' . $resignation_date[1] . '-' . $resignation_date[0];
	} else {
		$resignation_date = NULL;
	}

	$CNH = anti_injection($_POST['CNH']);
	$CNH = filter_var($CNH, FILTER_SANITIZE_STRING);

	$payday = anti_injection($_POST['payday']);
	$payday = filter_var($payday, FILTER_SANITIZE_STRING);

	$CNH_expiration = anti_injection($_POST['CNH_expiration']);
	$CNH_expiration = filter_var($CNH_expiration, FILTER_SANITIZE_STRING);
	if (!empty($CNH_expiration)) {

		$CNH_expiration = $CNH_expiration;
		$CNH_expiration = explode('/', $CNH_expiration);
		$CNH_expiration = $CNH_expiration[2] . '-' . $CNH_expiration[1] . '-' . $CNH_expiration[0];
	} else {
		$CNH_expiration = NULL;
	}

	$vehicle_license = anti_injection($_POST['vehicle_license']);
	$vehicle_license = filter_var($vehicle_license, FILTER_SANITIZE_STRING);

	$vehicle_owner = anti_injection($_POST['vehicle_owner']);
	$vehicle_owner = filter_var($vehicle_owner, FILTER_SANITIZE_STRING);

	$km_value = anti_injection($_POST['km_value']);
	$km_value = filter_var($km_value, FILTER_SANITIZE_STRING);
	if (!empty($km_value)) {
		$km_value = $km_value;
		$km_value = str_replace('.', '', $km_value);
		$km_value = str_replace(',', '.', $km_value);
	} else {
		$km_value = 0.0;
	}

	$wage = anti_injection($_POST['wage']);
	$wage = filter_var($wage, FILTER_SANITIZE_STRING);
	if (!empty($wage)) {
		$wage = $wage;
		$wage = str_replace('.', '', $wage);
		$wage = str_replace(',', '.', $wage);
	} else {
		$wage = 0.0;
	}




	$pdo->beginTransaction();

	try {

		// --- GRAVAR IMAGEM ---

		if (!empty($_FILES['img']['name'])) {
			$novoNome = uniqid();
			$file_extension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
			$file_extension = strtolower($file_extension);
			$filename = $novoNome . "." . $file_extension;
			$location = $imgFolder . "userImage/" . $filename;

			// Valid image extensions
			$image_ext = array("jpg", "png", "jpeg");

			if (in_array($file_extension, $image_ext)) {
				// Upload file
				if (move_uploaded_file($_FILES['img']['tmp_name'], $location)) {

					if (!empty($id)) {


						// --- APAGAR IMAGEM ANTIGA ------

						$sqlOldImage = "SELECT img FROM user WHERE id = :id";
						$sqlOldImage = $pdo->prepare($sqlOldImage);
						$sqlOldImage->bindValue('id', $id);
						$sqlOldImage->execute();
						if ($sqlOldImage->rowCount() > 0) {
							$rowOldImage = $sqlOldImage->fetch();
							$oldImage = $rowOldImage->img;

							unlink($imgFolder . "userImage/" . $oldImage);
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


		// --- VERIFICAR SE EXISTE USUÁRIO COM ESTE CPF ---

		$sqlCPF = "SELECT id FROM user WHERE CPF = :CPF AND id_company = :id_company";
		$sqlCPF = $pdo->prepare($sqlCPF);
		$sqlCPF->bindValue('id_company', $id_company);
		$sqlCPF->bindValue('CPF', $cpf);
		$sqlCPF->execute();
		if ($sqlCPF->rowCount() > 0) {
			// --------------------------------- ATUALIZAR DADOS ------------------------

			if (empty($_POST['id'])) {
				$retorno = array('codigo' => 0, 'mensagem' => "Já existe um usuário cadastrado com este CPF!");
				echo json_encode($retorno);
				exit();
			}


			// --- VERIFICAR SE JÁ EXISTE O EMAIL ---


			$SQL_email = "SELECT email FROM user WHERE email = :email and CPF != :CPF";
			$SQL_email = $pdo->prepare($SQL_email);
			$SQL_email->bindValue('email', $email);
			$SQL_email->bindValue('CPF', $cpf);
			$SQL_email->execute();
			if ($SQL_email->rowCount() > 0) {

				$retorno = array('codigo' => 0, 'mensagem' => 'Este Email já está cadastrado em outro Usuário!');
				echo json_encode($retorno);
				exit();
			}


			// --- FIM - VERIFICAR SE JÁ EXISTE O EMAIL ---

			// --- VERIFICAR SE JÁ EXISTE O LOGIN ---

			/*
			$SQL_login = "SELECT login FROM user WHERE login = :login and CPF != :CPF";
			$SQL_login = $pdo->prepare($SQL_login);
			$SQL_login->bindValue('login', $login);
			$SQL_login->bindValue('CPF', $CPF);
			$SQL_login->execute();
			if ($SQL_login->rowCount() > 0) {

				$retorno = array('codigo' => 0, 'mensagem' => 'Este Login já está cadastrado em outro Usuário!');
				echo json_encode($retorno);
				exit();
			}

*/
			// --- FIM - VERIFICAR SE JÁ EXISTE O LOGIN ---

			// --- ATUALIZAR FOTO, SE HOUVER ---

			if (!empty($filename)) {
				$SQL_up_img = 'UPDATE user SET img = :img WHERE id = :id';
				$SQL_up_img = $pdo->prepare($SQL_up_img);
				$SQL_up_img->bindValue('img', $filename);
				$SQL_up_img->bindValue('id', $id);
				$SQL_up_img->execute();
			}

			// --- FIM - ATUALIZAR FOTO ---


			$sqlUpdateUser = 'UPDATE user SET 
			name = :name,
      surname = :surname,
			CEP = :CEP,
			address = :address,
			number = :number,
			complement = :complement,
			neighborhood = :neighborhood,
			city = :city,
			UF = :UF,
			email = :email,
			status = :status,
			phone = :phone,
      profile = :profile,
      wage = :wage,
      comission = :comission,
      comission_status = :comission_status,
      payday = :payday,
      admission_date = :admission_date,
      resignation_date = :resignation_date,
      CNH = :CNH,
      CNH_expiration = :CNH_expiration,
      vehicle_license_plate = :vehicle_license,
      vehicle_owner = :vehicle_owner,
      km_value_traveled = :km_value,
			user_update = :user_update,
			last_update = :last_update
			WHERE id = :id';
			$sqlUpdateUser = $pdo->prepare($sqlUpdateUser);
			$sqlUpdateUser->bindValue('name', $name);
			$sqlUpdateUser->bindValue('surname', $surname);
			$sqlUpdateUser->bindValue('CEP', $CEP);
			$sqlUpdateUser->bindValue('address', $address);
			$sqlUpdateUser->bindValue('number', $number);
			$sqlUpdateUser->bindValue('complement', $complement);
			$sqlUpdateUser->bindValue('neighborhood', $neighborhood);
			$sqlUpdateUser->bindValue('city', $city);
			$sqlUpdateUser->bindValue('UF', $UF);
			$sqlUpdateUser->bindValue('email', $email);
			$sqlUpdateUser->bindValue('status', $status);
			$sqlUpdateUser->bindValue('phone', $phone);
			$sqlUpdateUser->bindValue('profile', $profile);
			$sqlUpdateUser->bindValue('wage', $wage);
			$sqlUpdateUser->bindValue('comission', $comission);
			$sqlUpdateUser->bindValue('comission_status', $comission_status);
			$sqlUpdateUser->bindValue('payday', $payday);
			$sqlUpdateUser->bindValue('admission_date', $admission_date);
			$sqlUpdateUser->bindValue('resignation_date', $resignation_date);
			$sqlUpdateUser->bindValue('CNH', $CNH);
			$sqlUpdateUser->bindValue('CNH_expiration', $CNH_expiration);
			$sqlUpdateUser->bindValue('vehicle_license', $vehicle_license);
			$sqlUpdateUser->bindValue('vehicle_owner', $vehicle_owner);
			$sqlUpdateUser->bindValue('km_value', $km_value);
			$sqlUpdateUser->bindValue('user_update', $id_user);
			$sqlUpdateUser->bindValue('last_update', $dateTime);
			$sqlUpdateUser->bindValue('id', $id);
			$sqlUpdateUser->execute();


			// --- ATUALIZAR SENHA SE HOUVER ---
			if (!empty($_POST['password'])) {
				$newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

				$updPassword = 'UPDATE user SET password = :newPassword WHERE CPF = :CPF';
				$updPassword = $pdo->prepare($updPassword);
				$updPassword->bindValue('newPassword', $newPassword);
				$updPassword->bindValue('CPF', $cpf);
				$updPassword->execute();
			}

			// --- FIM - ATUALIZAR SENHA ---



			// --- GRAVAR LOG ---


			$description = 'ATUALIZAR DADOS USUÁRIO ' . $id;
			$sqlLog = "UPDATE user SET 
			name = :$name,
      surname = $surname,
			CEP = $CEP,
			address = $address,
			number = $number,
			complement = $complement,
			neighborhood = $neighborhood,
			city = $city,
			UF = $UF,
			email = $email,
			status = $status,
			phone = $phone,
			profile = $profile,
      wage = $wage,
      comission = $comission,
      comission_status = $comission_status,
      payday = $payday,
      admission_date = $admission_date,
      resignation_date = $resignation_date,
      CNH = $CNH,
      CNH_expiration = $CNH_expiration,
      vehicle_license_plate = $vehicle_license,
      vehicle_owner = $vehicle_owner,
      km_value_traveled = $km_value,
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
			$register_log->bindValue('id_company', $company_id);
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
			// --------------------------------- CADASTRAR NOVO USUÁRIO ------------------------

			// --- VERIFICAR SE JÁ EXISTE O EMAIL ---


			$SQL_email = "SELECT * FROM user WHERE email = :email";
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

			/*
			$SQL_login = "SELECT login FROM user WHERE login = :login";
			$SQL_login = $pdo->prepare($SQL_login);
			$SQL_login->bindValue('login', $login);
			$SQL_login->execute();
			if ($SQL_login->rowCount() > 0) {

				$retorno = array('codigo' => 0, 'mensagem' => 'Este Login já está cadastrado em outro Usuário!');
				echo json_encode($retorno);
				exit();
			}
*/

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

			$sqlInsertUser = "INSERT INTO user (name, surname, CPF, CEP, address, number, complement, neighborhood, city, UF, email, status, phone, user_register, date_register, id_company, profile, password,  wage, comission, comission_status, payday, admission_date, resignation_date, CNH, CNH_expiration, vehicle_license_plate, vehicle_owner, km_value_traveled) VALUES (:name, :surname, :CPF, :CEP, :address, :number, :complement, :neighborhood, :city, :UF, :email, :status, :phone, :user_register, :date_register, :id_company, :profile, :password, :wage, :comission, :comission_status, :payday, :admission_date, :resignation_date, :CNH, :CNH_expiration, :vehicle_license_plate, :vehicle_owner, :km_value_traveled)";
			$sqlInsertUser = $pdo->prepare($sqlInsertUser);
			$sqlInsertUser->bindValue('name', $name);
			$sqlInsertUser->bindValue('surname', $surname);
			$sqlInsertUser->bindValue('CPF', $cpf);
			$sqlInsertUser->bindValue('CEP', $CEP);
			$sqlInsertUser->bindValue('address', $address);
			$sqlInsertUser->bindValue('number', $number);
			$sqlInsertUser->bindValue('complement', $complement);
			$sqlInsertUser->bindValue('neighborhood', $neighborhood);
			$sqlInsertUser->bindValue('city', $city);
			$sqlInsertUser->bindValue('UF', $UF);
			$sqlInsertUser->bindValue('email', $email);
			$sqlInsertUser->bindValue('status', $status);
			$sqlInsertUser->bindValue('phone', $phone);
			$sqlInsertUser->bindValue('user_register', $id_user);
			$sqlInsertUser->bindValue('date_register', $dateTime);
			$sqlInsertUser->bindValue('id_company', $company_id);
			$sqlInsertUser->bindValue('profile', $profile);
			$sqlInsertUser->bindValue('password', $password);
			$sqlInsertUser->bindValue('wage', $wage);
			$sqlInsertUser->bindValue('comission', $comission);
			$sqlInsertUser->bindValue('comission_status', $comission_status);
			$sqlInsertUser->bindValue('payday', $payday);
			$sqlInsertUser->bindValue('admission_date', $admission_date);
			$sqlInsertUser->bindValue('resignation_date', $resignation_date);
			$sqlInsertUser->bindValue('CNH', $CNH);
			$sqlInsertUser->bindValue('CNH_expiration', $CNH_expiration);
			$sqlInsertUser->bindValue('vehicle_license_plate', $vehicle_license);
			$sqlInsertUser->bindValue('vehicle_owner', $vehicle_owner);
			$sqlInsertUser->bindValue('km_value_traveled', $km_value);
			$sqlInsertUser->execute();

			// --- ATUALIZAR FOTO, SE HOUVER ---

			if (!empty($filename)) {
				$SQL_up_img = 'UPDATE user SET img = :img WHERE CPF = :CPF';
				$SQL_up_img = $pdo->prepare($SQL_up_img);
				$SQL_up_img->bindValue('img', $filename);
				$SQL_up_img->bindValue('CPF', $cpf);
				$SQL_up_img->execute();
			}

			// --- FIM - ATUALIZAR FOTO ---


			// --- GRAVAR LOG ---


			$description = 'CADASTRAR NOVO USUÁRIO';
			$sqlLog = "INSERT INTO user 
      id_company = :id_company,
			name = :$name,
      surname = $surname
			CPF = $cpf, 
			CEP = $CEP,
			address = $address,
			number = $number,
			complement = $complement,
			neighborhood = $neighborhood,
			city = $city,
			UF = $UF,
			email = $email,
			status = $status,
			phone = $phone,
      profile = $profile,
      wage = $wage,
      comission = $comission,
      comission_status = $comission_status,
      payday = $payday,
      admission_date = $admission_date,
      resignation_date = $resignation_date,
      CNH = $CNH,
      CNH_expiration = $CNH_expiration,
      vehicle_license_plate = $vehicle_license,
      vehicle_owner = $vehicle_owner,
      km_value_traveled = $km_value,
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
			$register_log->bindValue('id_company', $company_id);
			$register_log->bindValue('dateTime', $dateTime);
			$register_log->bindValue('action', $sqlLog);
			$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
			$register_log->bindValue('description', $description);
			$register_log->bindValue('user', $id_user);
			$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
			$register_log->execute();


			// --- FIM - GRAVAR LOG ---


			$pdo->commit();

			$retorno = array('codigo' => 1, 'mensagem' => 'Usuário Cadastrado com Sucesso!');
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



// ******************************** FIM - GRAVAR / EDITAR USUÁRIO - BRUNO R. BERNAL - 17/01/2022 *****************




// ********************************** LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 17/01/2022 **************

$sqlListProfile = "SELECT id, name FROM profile WHERE id_company = :id_company AND status = 'Ativo' ";
$sqlListProfile = $pdo->prepare($sqlListProfile);
$sqlListProfile->bindValue('id_company', $_SESSION['id_company']);
$sqlListProfile->execute();

if (isset($_GET['idUser'])) {
	$sqlListData = "SELECT d.name as profile_name, b.name AS name_user_register, c.name AS name_user_update, a.* FROM user a 
	LEFT JOIN user b ON a.user_register = b.id
	LEFT JOIN user c ON a.user_update = c.id
  LEFT JOIN profile d ON a.profile = d.id
	WHERE a.id = :id";
	$sqlListData = $pdo->prepare($sqlListData);
	$sqlListData->bindValue('id', $_GET['idUser']);
	$sqlListData->execute();
	$rowData = $sqlListData->fetch();
	$list_id = $rowData->id;
	$list_id_company = $rowData->id_company;
	$list_name = $rowData->name;
	$list_surname = $rowData->surname;
	$list_CPF = $rowData->CPF;
	$list_CEP = $rowData->CEP;
	$list_address = $rowData->address;
	$list_number = $rowData->number;
	$list_complement = $rowData->complement;
	$list_neighborhood = $rowData->neighborhood;
	$list_city = $rowData->city;
	$list_UF = $rowData->UF;
	$list_email = $rowData->email;
	$list_status = $rowData->status;
	$list_phone = $rowData->phone;
	$list_profile = $rowData->profile;
	$list_wage = $rowData->wage;
	$list_comission = $rowData->comission;
	$list_payday = $rowData->payday;
	$list_CNH = $rowData->CNH;
	$list_vehicle_license = $rowData->vehicle_license_plate;
	$list_vehicle_owner = $rowData->vehicle_owner;
	$list_km_value = $rowData->km_value_traveled;
	$list_CNH_expiration = $rowData->CNH_expiration;
	$list_admission_date = $rowData->admission_date;
	$list_resignation_date = $rowData->resignation_date;
	$list_comission_status = $rowData->comission_status;
	$list_number_access = $rowData->number_access;
	$list_user_register = $rowData->name_user_register;
	$list_date_register = $rowData->date_register;
	$list_user_update = $rowData->name_user_update;
	$list_last_update = $rowData->last_update;
	$list_profile_name = $rowData->profile_name;
	$list_img = $rowData->img;
} else {
	$list_id = "";
	$list_id_company = "";
	$list_name = "";
	$list_surname = "";
	$list_CPF = "";
	$list_CEP = "";
	$list_address = "";
	$list_number = "";
	$list_complement = "";
	$list_neighborhood = "";
	$list_city = "";
	$list_UF = "";
	$list_email = "";
	$list_status = "";
	$list_phone = "";
	$list_profile = "";
	$list_wage = "";
	$list_comission = "";
	$list_payday = "";
	$list_CNH = "";
	$list_vehicle_license = "";
	$list_vehicle_owner = "";
	$list_km_value = "";
	$list_CNH_expiration = "";
	$list_admission_date = "";
	$list_resignation_date = "";
	$list_comission_status = "";
	$list_number_access = "";
	$list_user_register = "";
	$list_date_register = "";
	$list_user_update = "";
	$list_last_update = "";
	$list_profile_name = "";
	$list_img = "";
}



// ********************************** FIM - LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 17/01/2022 **************

// ********************************** PESQUISAR USUÁRIO - BRUNO R. BERNAL - 16/01/2022 **********************

if (isset($_GET['searchUser'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$userName = anti_injection($_GET['userName']);
	$userName = filter_var($userName, FILTER_SANITIZE_STRING);
	if (!empty($userName)) {
		$AND_userName = "AND name like '%$userName%' ";
	} else {
		$AND_userName = "";
	}

	$sqlSearchUser = "SELECT * FROM user  WHERE id_company = $id_company $AND_userName";
	$sqlSearchUser = $pdo->prepare($sqlSearchUser);
	$sqlSearchUser->execute();

	// --- GRAVAR LOG ---


	$description = 'CONSULTAR USUÁRIO';
	$sqlLog = "SELECT * FROM user  WHERE id_company = $id_company $AND_userName";
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


// ******************************* FIM - PESQUISAR USUÁRIO - BRUNO R. BERNAL - 16/01/2022 **********************
