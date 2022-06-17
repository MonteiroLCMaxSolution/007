<?php

//setcookie( 'usuario', 'Fulano' );
if ( !isset( $_SESSION ) ) {
  session_start();
}
/*
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
*/


$ConexaoMysql = $_SESSION[ 'server' ] . '/conexao-pdo/conexao-mysql-pdo.php';
include_once( $ConexaoMysql );

date_default_timezone_set( 'America/Sao_Paulo' );
$dataLocal = date( 'Y-m-d H:i:s' );
$dateTime = date( 'Y-m-d H:i:s' );
if ( isset( $_POST[ 'directory' ] ) ) {
  $_SESSION[ 'directory' ] = $_POST[ 'directory' ];
  $imgFolder = $_SERVER[ 'DOCUMENT_ROOT' ] . '/' . $_POST[ 'directory' ] . '/uploads/';
  //$_SESSION[ 'main_directory' ] = $_POST[ 'main_directory' ];
}

if ( !empty( $_GET[ 'data-user' ] ) ) {
  $sqlListProfile = "SELECT a.* FROM profile a WHERE a.id_company = :id_company AND a.id_contract = :id_contract AND a.status = 'Ativo'";
  $sqlListProfile = $pdo->prepare( $sqlListProfile );
  $sqlListProfile->bindValue( 'id_company', $_COOKIE[ 'id_company' ] );
  $sqlListProfile->bindValue( 'id_contract', $_COOKIE[ 'id_contract' ] );
  $sqlListProfile->execute();

  // ******* LISTAR EMPRESAS PARA QUE O USUÁRIO POSSA DUPLICAR O CADASTRO - BRUNO R. BERNAL - 26/05/2022 - *******

  $SQL_list_company = "SELECT a.id, upper(a.name_razao_social) AS name FROM company a WHERE a.id_contract = :id_contract AND a.status = 'ATIVO';";
  $SQL_list_company = $pdo->prepare( $SQL_list_company );
  $SQL_list_company->bindValue( 'id_contract', $_SESSION[ 'id_contract' ] );
  $SQL_list_company->execute();

  // **** FIM - LISTAR EMPRESAS PARA QUE O USUÁRIO POSSA DUPLICAR O CADASTRO - BRUNO R. BERNAL - 26/05/2022 - ****
}
 $SQL_list_company = "SELECT a.id, upper(a.name_razao_social) AS name FROM company a WHERE a.id_contract = :id_contract AND a.status = 'ATIVO';";
  $SQL_list_company = $pdo->prepare( $SQL_list_company );
  $SQL_list_company->bindValue( 'id_contract', $_SESSION[ 'id_contract' ] );
  $SQL_list_company->execute();

if ($_GET[ 'pg' ]== 'data-user' ) {
	// ******* LISTAR EMPRESAS PARA QUE O USUÁRIO POSSA DUPLICAR O CADASTRO - BRUNO R. BERNAL - 26/05/2022 - *******

  $SQL_listCompany = "SELECT a.id, upper(a.name_razao_social) AS name,a.id_sequence FROM company a WHERE a.id_contract = :id_contract AND a.status = 'ATIVO';";
  $SQL_listCompany = $pdo->prepare( $SQL_listCompany );
  $SQL_listCompany->bindValue( 'id_contract', $_COOKIE[ 'id_contract' ] );
  $SQL_listCompany->execute();

  // **** FIM - LISTAR EMPRESAS PARA QUE O USUÁRIO POSSA DUPLICAR O CADASTRO - BRUNO R. BERNAL - 26/05/2022 - ****
}

if ( isset( $_GET[ 'logout' ] ) ) {

  $_SESSION = array();
  session_destroy();
  $_SESSION[ 'id_user' ] = '';
  unset( $_COOKIE[ 'id_user' ] );
  unset( $_COOKIE[ 'main_link' ] );
  unset( $_COOKIE[ 'main_directory' ] );
  unset( $_COOKIE[ 'color' ] );
  unset( $_COOKIE[ 'id_company' ] );
  unset( $_COOKIE[ 'userProfile' ] );
  unset( $_COOKIE[ 'id_contract' ] );
  unset( $_COOKIE[ 'server' ] );
  unset( $_COOKIE[ 'name_user' ] );
  unset( $_COOKIE[ 'user_mail' ] );
  unset( $_COOKIE[ 'user_access' ] );
  unset( $_COOKIE[ 'user_last' ] );
  unset( $_COOKIE[ 'company_name' ] );
  setcookie( 'id_user', null, -1, '/' );
  setcookie( 'main_link', null, -1, '/' );
  setcookie( 'main_directory', null, -1, '/' );
  setcookie( 'color', null, -1, '/' );
  setcookie( 'id_company', null, -1, '/' );
  setcookie( 'userProfile', null, -1, '/' );
  setcookie( 'id_contract', null, -1, '/' );
  setcookie( 'server', null, -1, '/' );
  setcookie( 'name_user', null, -1, '/' );
  setcookie( 'user_mail', null, -1, '/' );
  setcookie( 'user_access', null, -1, '/' );
  setcookie( 'user_last', null, -1, '/' );
  setcookie( 'company_name', null, -1, '/' );
  setcookie( 'userImage', null, -1, '/' );
  setcookie( 'login', null, -1, '/' );
  setcookie( 'logo', null, -1, '/' );
}

// ******************************* FIM -  LOGOUT - BRUNO R. BERNAL - 04/02/2022 *********************

// ********************************** PESQUISAR USUÁRIO - BRUNO R. BERNAL - 16/01/2022 **********************

if ( isset( $_GET[ 'searchUser' ] ) ) {


  try {

    $id_user = anti_injection( $_POST[ 'id_user' ] );
    $id_user = filter_var( $id_user, FILTER_SANITIZE_STRING );

    $id_company = anti_injection( $_POST[ 'id_company' ] );
    $id_company = filter_var( $id_company, FILTER_SANITIZE_STRING );

    $id_contract = anti_injection( $_POST[ 'id_contract' ] );
    $id_contract = filter_var( $id_contract, FILTER_SANITIZE_STRING );

    $userName = anti_injection( $_POST[ 'userName' ] );
    $userName = filter_var( $userName, FILTER_SANITIZE_STRING );
    if ( !empty( $userName ) ) {
      $AND_userName = "AND name like '%$userName%' ";
    } else {
      $AND_userName = "";
    }

    $sqlSearchUser = "SELECT * FROM user  WHERE id_contract = $id_contract.$AND_userName";
    $sqlSearchUser = $pdo->prepare( $sqlSearchUser );
    $sqlSearchUser->execute();

    // --- GRAVAR LOG ---


    $description = 'CONSULTAR USUÁRIO';
    $sqlLog = "SELECT * FROM user  WHERE id_contract = $id_contract.$AND_userName";
    $SQL_register_log = "INSERT INTO logs(id_company,id_contract,dateTime,action,IP,description,user,origin)VALUES(
	:id_company,
	:id_contract,
	:dateTime,
	:action,
	:IP,
	:description,
	:user,
	:origin)";
    $register_log = $pdo->prepare( $SQL_register_log );
    $register_log->bindValue( 'id_company', $id_company );
    $register_log->bindValue( 'id_contract', $id_contract );
    $register_log->bindValue( 'dateTime', $dataLocal );
    $register_log->bindValue( 'action', $sqlLog );
    $register_log->bindValue( 'IP', $_SERVER[ 'REMOTE_ADDR' ] );
    $register_log->bindValue( 'description', $description );
    $register_log->bindValue( 'user', $id_user );
    $register_log->bindValue( 'origin', $_SERVER[ 'HTTP_REFERER' ] );
    $register_log->execute();


    // --- FIM - GRAVAR LOG ---


  } catch ( Exception $e ) {

    // --- GRAVAR LOG ---


    $description = 'ERRO AO CONSULTAR USUÁRIO';
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
    $register_log = $pdo->prepare( $SQL_register_log );
    $register_log->bindValue( 'id_company', $id_company );
    $register_log->bindValue( 'id_contract', $id_contract );
    $register_log->bindValue( 'dateTime', $dataLocal );
    $register_log->bindValue( 'action', $sqlLog );
    $register_log->bindValue( 'IP', $_SERVER[ 'REMOTE_ADDR' ] );
    $register_log->bindValue( 'description', $description );
    $register_log->bindValue( 'user', $id_user );
    $register_log->bindValue( 'origin', $_SERVER[ 'HTTP_REFERER' ] );
    $register_log->execute();


    // --- FIM - GRAVAR LOG ---


  }
}


// ******************************* FIM - PESQUISAR USUÁRIO - BRUNO R. BERNAL - 16/01/2022 **********************

if ( isset( $_GET[ 'pg' ] ) && $_GET[ 'pg' ] == 'data-user' ) {
  // --- LISTAR PERFIS NO SELECT ---
  $sqlListProfile = "SELECT a.* FROM profile a WHERE a.id_company = :id_company AND a.id_contract = :id_contract AND a.status = 'Ativo'";
  $sqlListProfile = $pdo->prepare( $sqlListProfile );
  $sqlListProfile->bindValue( 'id_company', $_COOKIE[ 'id_company' ] );
  $sqlListProfile->bindValue( 'id_contract', $_COOKIE[ 'id_contract' ] );
  $sqlListProfile->execute();
}


if ( isset( $_GET[ 'idUser' ] ) ) {

  // --- LISTAR EMPRESAS ONDE O USUÁRIO ESTÁ CADASTRADO ---
  $listUserCompany = "SELECT id_company FROM user_company WHERE id_user = :id_user AND status = 'Ativo' ";
  $listUserCompany = $pdo->prepare( $listUserCompany );
  $listUserCompany->bindValue( 'id_user', $_GET[ 'idUser' ] );
  $listUserCompany->execute();
  $arrayCompany = [];


  while ( $rowUserCompany = $listUserCompany->fetch() ) {
    $arrayCompany[] = $rowUserCompany->id_company;
  }


  $sqlListData = "SELECT d.name as profile_name, b.name AS name_user_register, c.name AS name_user_update,a.name as name_user, a.* FROM user a 
	LEFT JOIN user b ON a.user_register = b.id
	LEFT JOIN user c ON a.user_update = c.id
  LEFT JOIN profile d ON a.profile = d.id
	WHERE a.id = :id AND  a.id_contract = :id_contract";
  $sqlListData = $pdo->prepare( $sqlListData );
  $sqlListData->bindValue( 'id', $_GET[ 'idUser' ] );
  $sqlListData->bindValue( 'id_contract', $_COOKIE[ 'id_contract' ] );
  $sqlListData->execute();
  $rowData = $sqlListData->fetch();
  $password = $rowData->password;
  $list_idUser = $rowData->id_user;
  $list_id_user = $rowData->id;
  $list_user_name = $rowData->name_user;
  $list_surname = $rowData->surname;
  $list_CPF = $rowData->CPF;
  $list_CEP = $rowData->CEP;
  $list_address = $rowData->address;
  $list_number = $rowData->number;
  $list_complement = $rowData->complement;
  $list_district = $rowData->district;
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
  $list_user_registers = $rowData->name_user_register;
  $list_date_register = $rowData->date_register;
  $list_user_update = $rowData->name_user_update;
  $list_last_update = $rowData->last_update;
  $list_profile_name = $rowData->profile_name;
  $list_imgs = $rowData->img;
} else {
  $password = "";
  $list_id_user = "";
  $list_idUser = "";
  $list_id = "";
  $list_user_name = "";
  $list_surname = "";
  $list_CPF = "";
  $list_CEP = "";
  $list_address = "";
  $list_number = "";
  $list_complement = "";
  $list_district = "";
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
  $list_user_registers = "";
  $list_comission_status = "";
  $list_number_access = "";
  $list_user_register = "";
  $list_date_register = "";
  $list_user_update = "";
  $list_last_update = "";
  $list_profile_name = "";
  $list_imgs = "";
}


// *********************** FIM - EXIBIR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 20/05/2022 ********************

// ********************************** GRAVAR / EDITAR USUÁRIO - BRUNO R. BERNAL - 20/05/2022 *****************
if ( !empty( $_GET[ 'saveUser' ] ) ) {

  $pdo->beginTransaction();

  try {

    $id_contract = anti_injection( $_POST[ 'id_contract' ] );
    $id_contract = filter_var( $id_contract, FILTER_SANITIZE_STRING );

    $directory = anti_injection( $_POST[ 'directory' ] );
    $directory = filter_var( $directory, FILTER_SANITIZE_STRING );

    $id = anti_injection( $_POST[ 'id' ] );
    $id = filter_var( $id, FILTER_SANITIZE_STRING );

    $id_company = anti_injection( $_POST[ 'id_company' ] );
    $id_company = filter_var( $id_company, FILTER_SANITIZE_STRING );

    $id_user = anti_injection( $_POST[ 'id_user' ] );
    $id_user = filter_var( $id_user, FILTER_SANITIZE_STRING );

    $cpf = anti_injection( $_POST[ 'cpf' ] );
    $cpf = filter_var( $cpf, FILTER_SANITIZE_STRING );

    $name = anti_injection( $_POST[ 'name' ] );
    $name = filter_var( $name, FILTER_SANITIZE_STRING );

    $surname = anti_injection( $_POST[ 'surname' ] );
    $surname = filter_var( $surname, FILTER_SANITIZE_STRING );

    $CEP = anti_injection( $_POST[ 'CEP' ] );
    $CEP = filter_var( $CEP, FILTER_SANITIZE_STRING );

    $address = anti_injection( $_POST[ 'address' ] );
    $address = filter_var( $address, FILTER_SANITIZE_STRING );

    $number = anti_injection( $_POST[ 'number' ] );
    $number = filter_var( $number, FILTER_SANITIZE_STRING );

    $complement = anti_injection( $_POST[ 'complement' ] );
    $complement = filter_var( $complement, FILTER_SANITIZE_STRING );

    $district = anti_injection( $_POST[ 'district' ] );
    $district = filter_var( $district, FILTER_SANITIZE_STRING );

    $city = anti_injection( $_POST[ 'city' ] );
    $city = filter_var( $city, FILTER_SANITIZE_STRING );

    $UF = anti_injection( $_POST[ 'UF' ] );
    $UF = filter_var( $UF, FILTER_SANITIZE_STRING );

    $phone = anti_injection( $_POST[ 'phone' ] );
    $phone = filter_var( $phone, FILTER_SANITIZE_STRING );

    $email = anti_injection( $_POST[ 'email' ] );
    $email = filter_var( $email, FILTER_SANITIZE_STRING );

    $status = anti_injection( $_POST[ 'status' ] );
    $status = filter_var( $status, FILTER_SANITIZE_STRING );

    $profile = anti_injection( $_POST[ 'profile' ] );
    $profile = filter_var( $profile, FILTER_SANITIZE_STRING );

    $password = anti_injection( $_POST[ 'password' ] );
    $password = filter_var( $password, FILTER_SANITIZE_STRING );

    $comission = anti_injection( $_POST[ 'comission' ] );
    $comission = filter_var( $comission, FILTER_SANITIZE_STRING );
    if ( !empty( $comission ) ) {
      $comission = $comission;
      $comission = str_replace( '.', '', $comission );
      $comission = str_replace( ',', '.', $comission );
    } else {
      $comission = 0.0;
    }

    $comission_status = anti_injection( $_POST[ 'comission_status' ] );
    $comission_status = filter_var( $comission_status, FILTER_SANITIZE_STRING );

    $payday = anti_injection( $_POST[ 'payday' ] );
    $payday = filter_var( $payday, FILTER_SANITIZE_STRING );

    $admission_date = anti_injection( $_POST[ 'admission_date' ] );
    $admission_date = filter_var( $admission_date, FILTER_SANITIZE_STRING );

    $resignation_date = anti_injection( $_POST[ 'resignation_date' ] );
    $resignation_date = filter_var( $resignation_date, FILTER_SANITIZE_STRING );

    $CNH = anti_injection( $_POST[ 'CNH' ] );
    $CNH = filter_var( $CNH, FILTER_SANITIZE_STRING );

    $payday = anti_injection( $_POST[ 'payday' ] );
    $payday = filter_var( $payday, FILTER_SANITIZE_STRING );

    $CNH_expiration = anti_injection( $_POST[ 'CNH_expiration' ] );
    $CNH_expiration = filter_var( $CNH_expiration, FILTER_SANITIZE_STRING );

    $vehicle_license = anti_injection( $_POST[ 'vehicle_license' ] );
    $vehicle_license = filter_var( $vehicle_license, FILTER_SANITIZE_STRING );

    $vehicle_owner = anti_injection( $_POST[ 'vehicle_owner' ] );
    $vehicle_owner = filter_var( $vehicle_owner, FILTER_SANITIZE_STRING );

    $km_value = anti_injection( $_POST[ 'km_value' ] );
    $km_value = filter_var( $km_value, FILTER_SANITIZE_STRING );
    if ( !empty( $km_value ) ) {
      $km_value = $km_value;
      $km_value = str_replace( '.', '', $km_value );
      $km_value = str_replace( ',', '.', $km_value );
    } else {
      $km_value = 0.0;
    }

    $wage = anti_injection( $_POST[ 'wage' ] );
    $wage = filter_var( $wage, FILTER_SANITIZE_STRING );
    if ( !empty( $wage ) ) {
      $wage = $wage;
      $wage = str_replace( '.', '', $wage );
      $wage = str_replace( ',', '.', $wage );
    } else {
      $wage = 0.0;
    }

    $company = anti_injection( $_POST[ 'company' ] );
    $company = filter_var( $company, FILTER_SANITIZE_STRING );


    // ******* VERIFICA O ID_USER ATUAL - MONTEIRO - 28/04/2022 *******
    $SQL_id_user_atual = "SELECT COUNT(*) as total FROM user a WHERE a.id_contract = :id_contract;";
    $SQL_id_user_atual = $pdo->prepare( $SQL_id_user_atual );
    $SQL_id_user_atual->bindValue( 'id_contract', $id_contract );
    $SQL_id_user_atual->execute();
    if ( $SQL_id_user_atual->rowCount() > 0 ) {
      $rowUser = $SQL_id_user_atual->fetch();
      $countIDUser = intval( $rowUser->total ) + 1;
    } else {
      $countIDUser = 1;
    }
    // ******* FIM VERIFICA O ID_USER ATUAL *******

    // --- GRAVAR IMAGEM ---

    if ( !empty( $_FILES[ 'img' ][ 'name' ] ) ) {
      $novoNome = uniqid();
      $file_extension = pathinfo( $_FILES[ 'img' ][ 'name' ], PATHINFO_EXTENSION );
      $file_extension = strtolower( $file_extension );
      $filename = $novoNome . "." . $file_extension;
      $location = $imgFolder . "userImage/" . $filename;

      // Valid image extensions
      $image_ext = array( "jpg", "png", "jpeg" );

      if ( in_array( $file_extension, $image_ext ) ) {
        // Upload file
        if ( move_uploaded_file( $_FILES[ 'img' ][ 'tmp_name' ], $location ) ) {

          if ( !empty( $id ) ) {


            // --- APAGAR IMAGEM ANTIGA ------

            $sqlOldImage = "SELECT img FROM user WHERE id = :id";
            $sqlOldImage = $pdo->prepare( $sqlOldImage );
            $sqlOldImage->bindValue( 'id', $id );
            $sqlOldImage->execute();
            if ( $sqlOldImage->rowCount() > 0 ) {
              $rowOldImage = $sqlOldImage->fetch();
              $oldImage = $rowOldImage->img;

              if ( !empty( $oldImage ) ) {
                unlink( $imgFolder . "userImage/" . $oldImage );
              }
            }


            // --- FIM - APAGAR IMAGEM ANTIGA ---
          }
        } else {
          $retorno = array( 'codigo' => 0, 'mensagem' => 'Erro ao enviar imagem!' );
          echo json_encode( $retorno );
          exit();
        }
      } else {
        $retorno = array( 'codigo' => 0, 'mensagem' => 'Formato de imagem inválido!' );
        echo json_encode( $retorno );
        exit();
      }
    } else {
      $filename = '';
    }

    // --- FIM - GRAVAR IMAGEM ---

    // --- VERIFICAR SE EXISTE USUÁRIO COM ESTE CPF COM O ID_CONTRACT ---

    $sqlCPF = "SELECT id FROM user WHERE CPF = :CPF AND id_contract = :id_contract";
    $sqlCPF = $pdo->prepare( $sqlCPF );
    $sqlCPF->bindValue( 'id_contract', $id_contract );
    $sqlCPF->bindValue( 'CPF', $cpf );
    $sqlCPF->execute();
    if ( $sqlCPF->rowCount() > 0 ) {
      // --------------------------------- ATUALIZAR DADOS ------------------------

      // --- VERIFICAR SE JÁ EXISTE O EMAIL ---


      $SQL_email = "SELECT email FROM user WHERE email = :email and CPF != :CPF";
      $SQL_email = $pdo->prepare( $SQL_email );
      $SQL_email->bindValue( 'email', $email );
      $SQL_email->bindValue( 'CPF', $cpf );
      $SQL_email->execute();
      if ( $SQL_email->rowCount() > 0 ) {

        $retorno = array( 'codigo' => 0, 'mensagem' => 'Este Email já está cadastrado em outro Usuário!' );
        echo json_encode( $retorno );
        exit();
      }


      // --- FIM - VERIFICAR SE JÁ EXISTE O EMAIL ---

      // --- ATUALIZAR FOTO, SE HOUVER ---

      if ( !empty( $filename ) ) {
        $SQL_up_img = 'UPDATE user SET img = :img WHERE id = :id';
        $SQL_up_img = $pdo->prepare( $SQL_up_img );
        $SQL_up_img->bindValue( 'img', $filename );
        $SQL_up_img->bindValue( 'id', $id );
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
			district = :district,
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
      $sqlUpdateUser = $pdo->prepare( $sqlUpdateUser );
      $sqlUpdateUser->bindValue( 'name', $name );
      $sqlUpdateUser->bindValue( 'surname', $surname );
      $sqlUpdateUser->bindValue( 'CEP', $CEP );
      $sqlUpdateUser->bindValue( 'address', $address );
      $sqlUpdateUser->bindValue( 'number', $number );
      $sqlUpdateUser->bindValue( 'complement', $complement );
      $sqlUpdateUser->bindValue( 'district', $district );
      $sqlUpdateUser->bindValue( 'city', $city );
      $sqlUpdateUser->bindValue( 'UF', $UF );
      $sqlUpdateUser->bindValue( 'email', $email );
      $sqlUpdateUser->bindValue( 'status', $status );
      $sqlUpdateUser->bindValue( 'phone', $phone );
      $sqlUpdateUser->bindValue( 'profile', $profile );
      $sqlUpdateUser->bindValue( 'wage', $wage );
      $sqlUpdateUser->bindValue( 'comission', $comission );
      $sqlUpdateUser->bindValue( 'comission_status', $comission_status );
      $sqlUpdateUser->bindValue( 'payday', $payday );
      $sqlUpdateUser->bindValue( 'admission_date', $admission_date );
      $sqlUpdateUser->bindValue( 'resignation_date', $resignation_date );
      $sqlUpdateUser->bindValue( 'CNH', $CNH );
      $sqlUpdateUser->bindValue( 'CNH_expiration', $CNH_expiration );
      $sqlUpdateUser->bindValue( 'vehicle_license', $vehicle_license );
      $sqlUpdateUser->bindValue( 'vehicle_owner', $vehicle_owner );
      $sqlUpdateUser->bindValue( 'km_value', $km_value );
      $sqlUpdateUser->bindValue( 'user_update', $id_user );
      $sqlUpdateUser->bindValue( 'last_update', $dateTime );
      $sqlUpdateUser->bindValue( 'id', $id );
      $sqlUpdateUser->execute();

      // --- ATUALIZAR SENHA SE HOUVER ---
      if ( !empty( $password ) ) {
        $newPassword = password_hash( $password, PASSWORD_DEFAULT );

        $updPassword = 'UPDATE user SET password = :newPassword WHERE id = :id';
        $updPassword = $pdo->prepare( $updPassword );
        $updPassword->bindValue( 'newPassword', $newPassword );
        $updPassword->bindValue( 'id', $id );
        $updPassword->execute();
      } else {
        $newPassword = "";
      }

      // --- FIM - ATUALIZAR SENHA ---


      // --- GRAVAR LOG ---


      $description = 'ATUALIZAR DADOS USUÁRIO ' . $id;
      $sqlLog = "UPDATE user SET 
			name = $name,
      		surname = $surname,
			CEP = $CEP,
			address = $address,
			number = $number,
			complement = $complement,
			district = $district,
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
			last_update = $dateTime,
			password = $newPassword,
			img = $filename
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
      $register_log = $pdo->prepare( $SQL_register_log );
      $register_log->bindValue( 'id_company', $id_company );
      $register_log->bindValue( 'id_contract', $id_contract );
      $register_log->bindValue( 'dateTime', $dateTime );
      $register_log->bindValue( 'action', $sqlLog );
      $register_log->bindValue( 'IP', $_SERVER[ 'REMOTE_ADDR' ] );
      $register_log->bindValue( 'description', $description );
      $register_log->bindValue( 'user', $id_user );
      $register_log->bindValue( 'origin', $_SERVER[ 'HTTP_REFERER' ] );
      $register_log->execute();


      // --- FIM - GRAVAR LOG ---

      $pdo->commit();

      $retorno = array( 'codigo' => 1, 'mensagem' => 'Dados Atualizados com Sucesso!' );
      echo json_encode( $retorno );
      exit();
    } else {
      // --------------------------------- CADASTRAR NOVO USUÁRIO ------------------------

      // --- VERIFICAR SE JÁ EXISTE O EMAIL ---


      $SQL_email = "SELECT * FROM user WHERE email = :email";
      $SQL_email = $pdo->prepare( $SQL_email );
      $SQL_email->bindValue( 'email', $email );
      $SQL_email->execute();
      if ( $SQL_email->rowCount() > 0 ) {

        $retorno = array( 'codigo' => 0, 'mensagem' => 'Este email já está cadastrado' );
        echo json_encode( $retorno );
        exit();
      }


      // --- FIM - VERIFICAR SE JÁ EXISTE O EMAIL ---

      // --- VERIFICAR SE EXISTE SENHA ---

      if ( !empty( $password ) ) {
        $password = password_hash( $password, PASSWORD_DEFAULT );
      } else {
        $retorno = array( 'codigo' => 0, 'mensagem' => 'Digite uma Senha!' );
        echo json_encode( $retorno );
        exit();
      }

      // --- FIM - VERIFICAR SE EXISTE SENHA ---

      $sqlInsertUser = "INSERT INTO user (id_user,folder,name, surname, CPF, CEP, address, number, complement, district, city, UF, email, status, phone, user_register, date_register, profile, password,  wage, comission, comission_status, payday, admission_date, resignation_date, CNH, CNH_expiration, vehicle_license_plate, vehicle_owner, km_value_traveled, img, id_contract) VALUES (:id_user,:folder,:name, :surname, :CPF, :CEP, :address, :number, :complement, :district, :city, :UF, :email, :status, :phone, :user_register, :date_register, :profile, :password, :wage, :comission, :comission_status, :payday, :admission_date, :resignation_date, :CNH, :CNH_expiration, :vehicle_license_plate, :vehicle_owner, :km_value_traveled, :img, :id_contract)";
      $sqlInsertUser = $pdo->prepare( $sqlInsertUser );
      $sqlInsertUser->bindValue( 'id_user', $countIDUser );
      $sqlInsertUser->bindValue( 'folder', $directory );
      $sqlInsertUser->bindValue( 'name', $name );
      $sqlInsertUser->bindValue( 'surname', $surname );
      $sqlInsertUser->bindValue( 'CPF', $cpf );
      $sqlInsertUser->bindValue( 'CEP', $CEP );
      $sqlInsertUser->bindValue( 'address', $address );
      $sqlInsertUser->bindValue( 'number', $number );
      $sqlInsertUser->bindValue( 'complement', $complement );
      $sqlInsertUser->bindValue( 'district', $district );
      $sqlInsertUser->bindValue( 'city', $city );
      $sqlInsertUser->bindValue( 'UF', $UF );
      $sqlInsertUser->bindValue( 'email', $email );
      $sqlInsertUser->bindValue( 'status', $status );
      $sqlInsertUser->bindValue( 'phone', $phone );
      $sqlInsertUser->bindValue( 'user_register', $id_user );
      $sqlInsertUser->bindValue( 'date_register', $dateTime );
      $sqlInsertUser->bindValue( 'profile', $profile );
      $sqlInsertUser->bindValue( 'password', $password );
      $sqlInsertUser->bindValue( 'wage', $wage );
      $sqlInsertUser->bindValue( 'comission', $comission );
      $sqlInsertUser->bindValue( 'comission_status', $comission_status );
      $sqlInsertUser->bindValue( 'payday', $payday );
      $sqlInsertUser->bindValue( 'admission_date', $admission_date );
      $sqlInsertUser->bindValue( 'resignation_date', $resignation_date );
      $sqlInsertUser->bindValue( 'CNH', $CNH );
      $sqlInsertUser->bindValue( 'CNH_expiration', $CNH_expiration );
      $sqlInsertUser->bindValue( 'vehicle_license_plate', $vehicle_license );
      $sqlInsertUser->bindValue( 'vehicle_owner', $vehicle_owner );
      $sqlInsertUser->bindValue( 'km_value_traveled', $km_value );
      $sqlInsertUser->bindValue( 'img', $filename );
      $sqlInsertUser->bindValue( 'id_contract', $id_contract );
      $sqlInsertUser->execute();

      // --- BUSCAR ID DO USUÁRIO PARA GRAVAR NA TABELA USER_COMPANY ---
      $sqlLastID = "SELECT id FROM user WHERE CPF = :CPF AND id_contract = :id_contract";
      $sqlLastID = $pdo->prepare( $sqlLastID );
      $sqlLastID->bindValue( 'id_contract', $id_contract );
      $sqlLastID->bindValue( 'CPF', $cpf );
      $sqlLastID->execute();
      $rowLastID = $sqlLastID->fetch();
      $lastID = $rowLastID->id;

      // --- GRAVAR NA TABELA USER_COMPANY ---
      if ( !empty( $company ) ) {
        $companyArr = explode( ',', $company );
        $count = count( $companyArr );
        $countStart = 0;
        while ( $count != $countStart ) {
          $companyID = $companyArr[ $countStart ];
          $sqlAddUserCompany = "INSERT INTO user_company(id_user,id_company,status,folder)VALUES(:id_user,:id_company,:status,:folder);";
          $sqlAddUserCompany = $pdo->prepare( $sqlAddUserCompany );
          $sqlAddUserCompany->bindValue( 'id_user', $lastID );
          $sqlAddUserCompany->bindValue( 'id_company', $companyID );
          $sqlAddUserCompany->bindValue( 'status', "Ativo" );
          $sqlAddUserCompany->bindValue( 'status', $_COOKIE['directory'] );
          $sqlAddUserCompany->execute();
          $countStart++;
        }
      }

      // --- GRAVAR NA TABELA USER_COMPANY ---

      // --- GRAVAR LOG ---


      $description = 'CADASTRAR NOVO USUÁRIO';
      $sqlLog = "INSERT INTO user 
			id_user = $countIDUser,
			folder = $directory,
			name = $name,
      		surname = $surname
			CPF = $cpf, 
			CEP = $CEP,
			address = $address,
			number = $number,
			complement = $complement,
			district = $district,
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
			date_register = $dateTime,
			img = $filename,
			id_contract = $id_contract
			company = $company";
      $SQL_register_log = "INSERT INTO logs(id_company,id_contract,dateTime,action,IP,description,user,origin)VALUES(
		:id_company,
		:id_contract,
		:dateTime,
		:action,
		:IP,
		:description,
		:user,
		:origin)";
      $register_log = $pdo->prepare( $SQL_register_log );
      $register_log->bindValue( 'id_company', $id_company );
      $register_log->bindValue( 'id_contract', $id_contract );
      $register_log->bindValue( 'dateTime', $dateTime );
      $register_log->bindValue( 'action', $sqlLog );
      $register_log->bindValue( 'IP', $_SERVER[ 'REMOTE_ADDR' ] );
      $register_log->bindValue( 'description', $description );
      $register_log->bindValue( 'user', $id_user );
      $register_log->bindValue( 'origin', $_SERVER[ 'HTTP_REFERER' ] );
      $register_log->execute();


      // --- FIM - GRAVAR LOG ---

      $pdo->commit();

      $retorno = array( 'codigo' => 1, 'mensagem' => 'Usuário Cadastrado com Sucesso!' );
      echo json_encode( $retorno );
      exit();
    }
  } catch ( Exception $e ) {

    $pdo->rollback();

    // --- GRAVAR LOG ---


    $description = "Erro ao Registrar Dados do Usuário!";
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
    $register_log = $pdo->prepare( $SQL_register_log );
    $register_log->bindValue( 'id_company', $id_company );
    $register_log->bindValue( 'id_contract', $id_contract );
    $register_log->bindValue( 'dateTime', $dateTime );
    $register_log->bindValue( 'action', $sqlLog );
    $register_log->bindValue( 'IP', $_SERVER[ 'REMOTE_ADDR' ] );
    $register_log->bindValue( 'description', $description );
    $register_log->bindValue( 'user', $id_user );
    $register_log->bindValue( 'origin', $_SERVER[ 'HTTP_REFERER' ] );
    $register_log->execute();


    // --- FIM - GRAVAR LOG ---


    $retorno = array( 'codigo' => 0, 'mensagem' => 'Erro ao Registrar Dados do Usuário!' );
    echo json_encode( $retorno );
    exit();
  }
}

// **************************** FIM - GRAVAR / EDITAR USUÁRIO - BRUNO R. BERNAL - 20/05/2022 *****************


// **************** ALTERAR EMPRESAS ONDE O USUÁRIO ESTÁ CADASTRADO - BRUNO R. BERNAL - 20/05/2022 *************

if ( isset( $_GET[ 'registerCompany' ] ) ) {

  $pdo->beginTransaction();

  try {

    $id_user = anti_injection( $_POST[ 'id_user' ] );
    $id_user = filter_var( $id_user, FILTER_SANITIZE_STRING );

    $id_company = anti_injection( $_POST[ 'id_company' ] );
    $id_company = filter_var( $id_company, FILTER_SANITIZE_STRING );

    $company = anti_injection( $_POST[ 'company' ] );
    $company = filter_var( $company, FILTER_SANITIZE_STRING );

    $checked = anti_injection( $_POST[ 'checked' ] );
    $checked = filter_var( $checked, FILTER_SANITIZE_STRING );
    if ( $checked == 'true' ) {
      $status = "Ativo";
    } else {
      $status = "Inativo";
    }

    $id_contract = anti_injection( $_POST[ 'id_contract' ] );
    $id_contract = filter_var( $id_contract, FILTER_SANITIZE_STRING );

    $id = anti_injection( $_POST[ 'id' ] );
    $id = filter_var( $id, FILTER_SANITIZE_STRING );


    // --- VERIFICAR SE EXISTE O REGISTRO NA TABELA ---
    $verify = "SELECT id FROM user_company WHERE id_user = :id_user AND id_company = :id_company";
    $verify = $pdo->prepare( $verify );
    $verify->bindValue( 'id_user', $id );
    $verify->bindValue( 'id_company', $company );
    $verify->execute();
    if ( $row = $verify->fetch() ) {


      // --- ATUALIZAR TABELA USER_COMPANY ---
      $updUserCompany = "UPDATE user_company SET 
		status = :status
		WHERE id_user = :id_user AND id_company = :id_company";
      $updUserCompany = $pdo->prepare( $updUserCompany );
      $updUserCompany->bindValue( 'status', $status );
      $updUserCompany->bindValue( 'id_user', $id );
      $updUserCompany->bindValue( 'id_company', $company );
      $updUserCompany->execute();

      // --- GRAVAR LOG ---


      $description = "ALTERAR ACESSO DO USUÁRIO $id NA EMPRESA $company";
      $sqlLog = "UPDATE user_company SET 
		status = $status
		WHERE id_user = $id AND id_company = $company";
      $SQL_register_log = "INSERT INTO logs(id_company,id_contract,dateTime,action,IP,description,user,origin)VALUES(
	:id_company,
	:id_contract,
	:dateTime,
	:action,
	:IP,
	:description,
	:user,
	:origin)";
      $register_log = $pdo->prepare( $SQL_register_log );
      $register_log->bindValue( 'id_company', $id_company );
      $register_log->bindValue( 'id_contract', $id_contract );
      $register_log->bindValue( 'dateTime', $dateTime );
      $register_log->bindValue( 'action', $sqlLog );
      $register_log->bindValue( 'IP', $_SERVER[ 'REMOTE_ADDR' ] );
      $register_log->bindValue( 'description', $description );
      $register_log->bindValue( 'user', $id_user );
      $register_log->bindValue( 'origin', $_SERVER[ 'HTTP_REFERER' ] );
      $register_log->execute();


      // --- FIM - GRAVAR LOG ---


      $pdo->commit();

      $retorno = array( 'codigo' => 1, 'mensagem' => 'Alteração Realizada com Sucesso!' );
      echo json_encode( $retorno );
      exit();
    } else {
      // --- CRIAR O REGISTRO NA TABELA ---
      $addUserCompany = "INSERT INTO user_company (status, id_user, id_company,folder) VALUES (:status, :id_user, :id_company,:folder)";
      $addUserCompany = $pdo->prepare( $addUserCompany );
      $addUserCompany->bindValue( 'status', $status );
      $addUserCompany->bindValue( 'id_user', $id );
      $addUserCompany->bindValue( 'id_company', $company );
      $addUserCompany->bindValue( 'folder', $_COOKIE['directory'] );
      $addUserCompany->execute();


      // --- GRAVAR LOG ---


      $description = "CADASTRAR ACESSO DO USUÁRIO $id NA EMPRESA $company";
      $sqlLog = "INSERT INTO user_company SET 
		status = $status
		WHERE id_user = $id AND id_company = $company";
      $SQL_register_log = "INSERT INTO logs(id_company,id_contract,dateTime,action,IP,description,user,origin)VALUES(
	:id_company,
	:id_contract,
	:dateTime,
	:action,
	:IP,
	:description,
	:user,
	:origin)";
      $register_log = $pdo->prepare( $SQL_register_log );
      $register_log->bindValue( 'id_company', $id_company );
      $register_log->bindValue( 'id_contract', $id_contract );
      $register_log->bindValue( 'dateTime', $dateTime );
      $register_log->bindValue( 'action', $sqlLog );
      $register_log->bindValue( 'IP', $_SERVER[ 'REMOTE_ADDR' ] );
      $register_log->bindValue( 'description', $description );
      $register_log->bindValue( 'user', $id_user );
      $register_log->bindValue( 'origin', $_SERVER[ 'HTTP_REFERER' ] );
      $register_log->execute();


      // --- FIM - GRAVAR LOG ---


      $pdo->commit();

      $retorno = array( 'codigo' => 1, 'mensagem' => 'Registro Realizado com Sucesso!' );
      echo json_encode( $retorno );
      exit();
    }
  } catch ( Exception $e ) {

    $pdo->rollback();

    // --- GRAVAR LOG ---


    $description = "ERRO AO ALTERAR ACESSO DO USUÁRIO $id NA EMPRESA $company";
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
    $register_log = $pdo->prepare( $SQL_register_log );
    $register_log->bindValue( 'id_company', $id_company );
    $register_log->bindValue( 'id_contract', $id_contract );
    $register_log->bindValue( 'dateTime', $dateTime );
    $register_log->bindValue( 'action', $sqlLog );
    $register_log->bindValue( 'IP', $_SERVER[ 'REMOTE_ADDR' ] );
    $register_log->bindValue( 'description', $description );
    $register_log->bindValue( 'user', $id_user );
    $register_log->bindValue( 'origin', $_SERVER[ 'HTTP_REFERER' ] );
    $register_log->execute();


    // --- FIM - GRAVAR LOG ---

    $retorno = array( 'codigo' => 0, 'mensagem' => "Erro ao Alterar Acesso do Usuário $id na Empresa $company" );
    echo json_encode( $retorno );
    exit();
  }
}

// ************ FIM - ALTERAR EMPRESAS ONDE O USUÁRIO ESTÁ CADASTRADO - BRUNO R. BERNAL - 20/05/2022 ***********


if ( !empty( $_GET[ 'access' ] ) ) {
  $login = $_POST[ 'login' ];
  $password = $_POST[ 'password' ];
  $folder = $_POST[ 'folder' ];
  $_SESSION[ 'module' ] = $_POST[ 'module' ];
  $company = $_POST[ 'company' ];
  if ( $company == 0 ) {
    $company = '';
  }
  if ( $login == '' ) {
    $return = array( 'code' => 1, 'message' => 'Informe seu login!' );
    echo json_encode( $return );
    exit();
  }
  if ( $password == '' ) {
    $return = array( 'code' => 1, 'message' => 'Informe sua senha!' );
    echo json_encode( $return );
    exit();
  }
  if ( $company == '' ) {
    $SQL = "SELECT b.`status`, a.id,a.password, b.id_company,b.folder,a.id_user AS user_id,a.number_access AS user_access, a.name AS user_name, a.email AS user_mail,a.last_access AS user_last, a.id_contract AS id_contract, c.name_razao_social  AS company_name, c.color_header, c.color_text, c.logo, a.img as img_user FROM user a
INNER JOIN user_company b ON a.id = b.id_user
LEFT JOIN company c ON b.id_company = c.id
WHERE a.email = :email AND b.folder = :folder OR a.login = :email AND b.folder = :folder;";
    $SQL_data_user = $pdo->prepare( $SQL );
    $SQL_data_user->bindValue( 'folder', $folder );
    $SQL_data_user->bindValue( 'email', $login );
    $SQL_data_user->execute();
    if ( $SQL_data_user->rowCount() > 0 ) {
	 $array = array($SQL_data_user);
      $row = $SQL_data_user->fetch();
      $status = $row->status;
      $folderBD = $row->folder;
      if ( $status == "Ativo" ) {
        if ( password_verify( $password, $row->password ) ) {
          $user_id = $row->user_id;
          $number_access = intval( $row->user_access ) + 1;
          $user_name = $row->user_name;
          $user_mail = $row->user_mail;
          $user_access = $row->user_access;
          $user_last = $row->user_last;
          $company_id = $row->id_company;
          $company_name = $row->company_name;
          $color = $row->color_header;
          $color_text = $row->color_text;
          $user_img = $row->img;
          $user_profile = $row->profile;
          $logo = $row->logo;
          $img_user = $row->img_user; //06/06/2022 - MONTEIRO
          $id_contract = $row->id_contract;
          $_SESSION[ 'id_contract' ] = $row->id_contract;
          $_SESSION[ 'id_user' ] = $user_id;
          //$_SESSION[ 'name_user' ] = 'testes';
          $_SESSION[ 'nameUser' ] = 'testes';
			
          $_SESSION[ 'user_mail' ] = $user_mail;
          $_SESSION[ 'user_access' ] = $user_access;
          $_SESSION[ 'user_last' ] = $user_last;
          $_SESSION[ 'id_company' ] = $company_id;
          $_SESSION[ 'company_name' ] = $company_name;
          $_SESSION[ 'color' ] = $color;
          $_SESSION[ 'color-text' ] = $color_text;
          $_SESSION[ 'userImage' ] = $user_img;
          $_SESSION[ 'userProfile' ] = $user_profile;
          $_SESSION[ 'login' ] = 1;
          $_SESSION[ 'logo' ] = $logo;
          $_SESSION[ 'img_user' ] = 'testes';
			//06/06/2022 - MONTEIRO
          // EDITAR O ÚLTIMO ACESSO - LEÔNIDAS MONTEIRO - 05/03/2022
          $SQL_edt_user = 'UPDATE user SET number_access = :number_access, last_access = :last_access WHERE id =:id;';
          $SQL_edt_user = $pdo->prepare( $SQL_edt_user );
          $SQL_edt_user->bindValue( 'number_access', $number_access );
          $SQL_edt_user->bindValue( 'last_access', $dataLocal );
          $SQL_edt_user->bindValue( 'id', $user_id );
          $SQL_edt_user->execute();


          $title = "PRIMEIRO ACESSO!";
          $description = $login . ", COM SEU PRIMEIRO ACESSO AO SISTEMA:";
          $mail = $_SESSION[ 'user_mail' ];
          $title = 'É necessário informar os dados de sua empresa!';
          $code = "1";
          $description = "USUÁRIO COM EMAIL/LOGIN: " . $login . ", USANDO A SENHA:" . $password . ", REALIZOU SEU PRIMEIRO ACESSO!";
        } else {
          $title = 'SENHA INVÁLIDA!';
          $code = "1";
          $description = "USUÁRIO COM EMAIL/LOGIN: " . $login . ", USANDO A SENHA:" . $password . ", TENTOU ACESSAR O SISTEMA COM SENHA INVÁLIDA!";
        }
      } else {
        $title = 'ACESSO COM STATUS INATIVO!';
        $code = "1";
        $description = "USUÁRIO COM EMAIL/LOGIN: " . $login . ", USANDO A SENHA:" . $password . ", ESTÁ COM ACESSO INATIVO AO SISTEMA";
      }
    } else {
      $title = 'E-mail não encontrado na nossa Base de Dados';
      $code = "1";
      $description = "USUÁRIO COM EMAIL/LOGIN: " . $login . ", USANDO A SENHA:" . $password . ", NÃO FOI ENCONTRADO NA BASE DE DADOS!";
    }


    $return = array( 'code' => $code, 'message' => $title, "id_contract" => $id_contract, "user_id" => $user_id, "user_name" => $user_name, "user_mail" => $user_mail, "user_access" => $user_access, "user_last" => $user_last, "company_id" => $company_id, "company_name" => $company_id, 'user_id' => $user_id );
    echo json_encode( $return );
    exit();


  } else {
    $SQL = "SELECT b.`status`, a.id,a.password, b.id_company,a.profile AS user_profile,b.folder,a.id_user AS user_id,a.number_access AS user_access, a.name AS user_name, a.email AS user_mail,a.last_access AS user_last, a.id_contract AS id_contract, c.name_razao_social  AS company_name, c.color_header, c.color_text, c.logo, a.img FROM user a
INNER JOIN user_company b ON a.id = b.id_user
LEFT JOIN company c ON b.id_company = c.id
WHERE a.email = :email AND b.folder = :folder AND b.id_company = :id_company OR a.login = :email AND b.folder = :folder AND b.id_company = :id_company;";


    $SQL_data_user = $pdo->prepare( $SQL );
    $SQL_data_user->bindValue( 'folder', $folder );
    $SQL_data_user->bindValue( 'email', $login );
    $SQL_data_user->bindValue( 'id_company', $company );
    $SQL_data_user->execute();
    // PASSO 2 - VERIFICAR SE EXISTE O EMAIL CADASTRADO - MONTEIRO - 30/05/2022
    if ( $SQL_data_user->rowCount() > 0 ) {
      $row = $SQL_data_user->fetch();
      $status = $row->status;
      $folderBD = $row->folder;
      if ( $status == "Ativo" ) {
        if ( password_verify( $password, $row->password ) ) {
          $user_id = $row->user_id;
          $number_access = intval( $row->user_access ) + 1;
          $user_name = $row->user_name;
          $user_mail = $row->user_mail;
          $user_access = $row->user_access;
          $user_last = $row->user_last;
          $company_id = $row->id_company;
          $company_name = $row->company_name;
          $color = $row->color_header;
          $color_text = $row->color_text;
          $user_img = $row->img;
          $user_profile = $row->user_profile;
          $logo = $row->logo;
          $id_contract = $row->id_contract;
          $_SESSION[ 'id_contract' ] = $row->id_contract;
          $_SESSION[ 'id_user' ] = $user_id;
          $_SESSION[ 'name_user' ] = $user_name;
          $_SESSION[ 'user_mail' ] = $user_mail;
          $_SESSION[ 'user_access' ] = $user_access;
          $_SESSION[ 'user_last' ] = $user_last;
          $_SESSION[ 'id_company' ] = $company_id;
          $_SESSION[ 'company_name' ] = $company_name;
          $_SESSION[ 'color' ] = $color;
          $_SESSION[ 'color-text' ] = $color_text;
          $_SESSION[ 'userImage' ] = $user_img;
          $_SESSION[ 'userProfile' ] = $user_profile;
          $_SESSION[ 'login' ] = 1;
          $_SESSION[ 'logo' ] = $logo;
          // EDITAR O ÚLTIMO ACESSO - LEÔNIDAS MONTEIRO - 05/03/2022
          $SQL_edt_user = 'UPDATE user SET number_access = :number_access, last_access = :last_access WHERE id =:id;';
          $SQL_edt_user = $pdo->prepare( $SQL_edt_user );
          $SQL_edt_user->bindValue( 'number_access', $number_access );
          $SQL_edt_user->bindValue( 'last_access', $dataLocal );
          $SQL_edt_user->bindValue( 'id', $user_id );
          $title = "ACESSO PERMITIDO!";
          $description = $login . ", COM ACESSO AO SISTEMA:";
          $mail = $_SESSION[ 'user_mail' ];

          $return = array( 'code' => 2, 'message' => "Acesso Permitido!  Acesso: " . $user_access, "id_contract" => $id_contract, "user_id" => $user_id, "user_name" => $user_name, "user_mail" => $user_mail, "user_access" => $user_access, "user_last" => $user_last, "company_id" => $company_id, "company_name" => $company_id, 'user_id' => $user_id );
          echo json_encode( $return );
        } else {
          $SQL_edt_user->execute();
          $result = array( 'code' => '1', 'message' => 'Senha parece ser inválida!' );
          echo json_encode( $result );
        }
      } else {
        $result = array( 'code' => '1', 'message' => 'Verifique com a sua gerência a permissão para uso do sistema!' );
        echo json_encode( $result );
      }
    } else {
      $return = array( 'code' => 1, 'message' => $company ); //'E-mail não autorizado para a empresa informada!'
      echo json_encode( $return );
    }
  }
  /* LOG_USER - LEÔNIDAS MONTEIRO - 05/03/2022 */
  $SQL_log_user = "INSERT INTO log_user(id_company,id_contract,id_user,data_register,mail,IP,title,description)VALUE(:id_company,:id_contract,:id_user,:data_register,:mail,:IP,:title,:description);";
  $SQL_log_user = $pdo->prepare( $SQL_log_user );
  $SQL_log_user->bindValue( 'id_company', $_SESSION[ 'id_company' ] );
  $SQL_log_user->bindValue( 'id_contract', $_SESSION[ 'id_contract' ] );
  $SQL_log_user->bindValue( 'id_user', $_SESSION[ 'id_user' ] );
  $SQL_log_user->bindValue( 'data_register', $dataLocal );
  $SQL_log_user->bindValue( 'mail', $mail );
  $SQL_log_user->bindValue( 'IP', $_SERVER[ 'REMOTE_ADDR' ] );
  $SQL_log_user->bindValue( 'title', $title );
  $SQL_log_user->bindValue( 'description', $description );
  $SQL_log_user->execute();

  /* .LOG_USER - LEÔNIDAS MONTEIRO - 05/03/2022 */
}