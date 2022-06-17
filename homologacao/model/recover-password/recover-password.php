<?php

if ( !isset( $_SESSION ) ) {
  session_start();
}
/*if ( !empty( $_COOKIE[ 'server' ] ) ) {
  $_SESSION[ 'server' ] = $_COOKIE[ 'server' ];
}*/


$ConexaoMysql = $_SESSION[ 'server' ] . '/conexao-pdo/conexao-mysql-pdo.php';
include_once( $ConexaoMysql );

date_default_timezone_set( 'America/Sao_Paulo' );
$dataLocal = date( 'Y-m-d H:i:s' );

// ALTERAR A SENHA DO USUÁRIO - MONTEIRO - 17/05/2022
if(!empty($_GET['confirmNewPassword'])){
	$recover = $_GET['recover'];
	$password = password_hash($_GET['confirmNewPassword'], PASSWORD_DEFAULT);
	
	$pdo->beginTransaction();
	try{		
		$SQL_user = "SELECT id, id_contract,name, id_company,email FROM user WHERE  key_password = :key_password;";
		$SQL_user = $pdo->prepare($SQL_user);
		$SQL_user->bindValue('key_password',$recover);
		$SQL_user->execute();
		if($SQL_user->rowCount() > 0){
			$row_user = $SQL_user->fetch();
			$id_contract = $row_user->id_contract;
			$id_company = $row_user->id_company;
			$user_email = $row_user->email;
			$user_name = $row_user->name;
			$id_user =  $row_user->id;
			
			$SQL_up_user = "UPDATE user SET password = :password, key_password = :data WHERE key_password = :key_password;";
			$SQL_up_user = $pdo->prepare($SQL_up_user);
			$SQL_up_user->bindValue('password',$password);
			$SQL_up_user->bindValue('data',$dataLocal);
			$SQL_up_user->bindValue('key_password',$recover);
			$SQL_up_user->execute();
			$msg = "Senha alterada com sucesso!";
			$cod = 2;
			$title = 'USUÁRIO RECUPEROU A SENHA';
			$description = 'USUÁRIO: '.$user_name.' USOU A CHAVE: '.$recover.', PARA RECUPERAR A SENHA: '.$_GET['confirmNewPassword'];
		}else{
			$id_contract = '';
			$id_company = '';
			$user_email = '';
			$user_name = '';
			$id_user = '';
			$msg = "Sua senha já foi alterado com esse token!";
			$cod = 1;
			
			$title = 'ERROR AO RECUPERAR A SENHA';
			$description = 'USUÁRIO USOU A CHAVE INVÁLIDA: '.$recover.', PARA RECUPERAR A SENHA';
		}
		// GRAVAR LOG_USER - MONTEIRO - 17/05/2022
	$SQL_insert_log_user = "INSERT INTO log_user(id_company,id_contract,id_user,data_register,mail,IP,title,description)VALUES(:id_company,:id_contract,:id_user,:data_register,:mail,:IP,:title,:description);";
	$SQL_insert_log_user = $pdo->prepare($SQL_insert_log_user);
	$SQL_insert_log_user->bindValue('id_company',$id_company);
	$SQL_insert_log_user->bindValue('id_contract',$id_contract);
	$SQL_insert_log_user->bindValue('id_user',$id_user);
	$SQL_insert_log_user->bindValue('data_register',$dataLocal);
	$SQL_insert_log_user->bindValue('mail',$user_email);
	$SQL_insert_log_user->bindValue('IP',$_SERVER[ 'REMOTE_ADDR' ]);
	$SQL_insert_log_user->bindValue('title',$title);
	$SQL_insert_log_user->bindValue('description',$description);
	$SQL_insert_log_user->execute();	
// FIM - GRAVAR LOG_USER
		$pdo->commit();
	}catch (Exception $e) {
		$pdo->rollback();
		$msg =$e;
		$cod = 1;
	}
	$result = array('cod' => $cod,'msg' => $msg);
	echo json_encode($result);
	exit();
}

// FIM ALTERAR A SENHA DO USUÁRIO

// RESGATAR OS DADOS DO EMAIL QUE O USUÁRIO DESEJA RECUPERAR - MONTEIRO - 16/05/2022
if ( !empty( $_GET[ 'recover_password' ] ) ) {

  $id = $_GET[ 'recover_password' ];
  $SQL_data_user = "SELECT a.id,a.id_company, a.id_contract, a.name,a.email, a.folder, a.CPF, b.name_razao_social  FROM user a INNER JOIN company b ON a.id_company = b.id WHERE a.id = :id AND a.`status` = 'ATIVO';";
  $SQL_data_user = $pdo->prepare( $SQL_data_user );
  $SQL_data_user->bindValue( 'id', $id );
  $SQL_data_user->execute();
  if ( $SQL_data_user->rowCount() > 0 ) {
    $row_data_user = $SQL_data_user->fetch();
    $user_name = $row_data_user->name;
    $user_email = $row_data_user->email;
    $user_folder = $row_data_user->folder;
    $key_password = md5($row_data_user->CPF);
	  $id_company = $row_data_user->id_company;
	  $id_contract = $row_data_user->id_contract;

    $SQL_up_user = "UPDATE user SET key_password = :key_password WHERE id = :id;";
    $SQL_up_user = $pdo->prepare( $SQL_up_user );
    $SQL_up_user->bindValue( 'key_password', $key_password );
    $SQL_up_user->bindValue( 'id', $id );
    $SQL_up_user->execute();
	  
	  $title = "ENVIOU E-MAIL PARA RECUPERAR A SENHA!";
	  $description = "id_company: ".$id_company.",id_user: ".$id.", data: ".$dataLocal.", e-mail: ".$user_email.", title: ".$title;
	  
	  
  } else {
    $user_name = '';
    $user_folder = '';
    $key_password = '';
	  $id_company = '';
	  $id_contract = '';
	  $user_email = '';
	  $title = "USUÁRIO NÃO ENCONTRADO";
	  $description = "ID INFORMADO: ".$id;
  }
	
	
// GRAVAR LOG_USER - MONTEIRO - 17/05/2022
	$SQL_insert_log_user = "INSERT INTO log_user(id_company,id_contract,id_user,data_register,mail,IP,title,description)VALUES(:id_company,:id_contract,:id_user,:data_register,:mail,:IP,:title,:description);";
	$SQL_insert_log_user = $pdo->prepare($SQL_insert_log_user);
	$SQL_insert_log_user->bindValue('id_company',$id_company);
	$SQL_insert_log_user->bindValue('id_contract',$id_contract);
	$SQL_insert_log_user->bindValue('id_user',$id);
	$SQL_insert_log_user->bindValue('data_register',$dataLocal);
	$SQL_insert_log_user->bindValue('mail',$user_email);
	$SQL_insert_log_user->bindValue('IP',$_SERVER[ 'REMOTE_ADDR' ]);
	$SQL_insert_log_user->bindValue('title',$title);
	$SQL_insert_log_user->bindValue('description',$description);
	$SQL_insert_log_user->execute();	
// FIM - GRAVAR LOG_USER


}
// FIM - RESGATAR OS DADOS DO EMAIL QUE O USUÁRIO DESEJA RECUPERAR

// LISTAR OS EMAILS CADASTRADOS NO SISTEMA QUE ESTÃO COM STATUS ATIVO - MONTEIRO - 13/05/2022
if ( !empty( $_GET[ 'recover_mail' ] ) ) {
  $folder = $_GET[ 'directory' ];
  $email = $_GET[ 'recover_mail' ];
  $SQL_list_mail = "SELECT a.id, a.name, a.folder, a.CPF, b.name_razao_social FROM user a INNER JOIN company b ON a.id_company = b.id WHERE a.email = :email and a.folder = :folder AND a.`status` = 'ATIVO';";
  $SQL_list_mail = $pdo->prepare( $SQL_list_mail );
  $SQL_list_mail->bindValue( 'email', $email );
  $SQL_list_mail->bindValue( 'folder', $folder );
  $SQL_list_mail->execute();
}
// FIM - LISTAR OS EMAILS CADASTRADOS NO SISTEMA QUE ESTÃO COM STATUS ATIVO 
?>