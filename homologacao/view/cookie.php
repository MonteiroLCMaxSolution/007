<?php
if (!isset($_SESSION)) {
  session_start(); 
}
$directory = explode( '/', $_SERVER[ 'PHP_SELF' ] );
$directory = $directory[ 1 ];

$expira = time() + 60*60*24*30;
setcookie('VERSION',16);
// CONFIGURAR OS SESSIONS - LEÔNIDAS MONTEIRO - 09/03/2022 
//if(empty($_COOKIE['id_user']) || empty($_SESSION['id_user']) ){
	if(!empty($_COOKIE['id_user'])){
		$_SESSION['id_user'] = $_COOKIE['id_user'];
		$_SESSION['main_link'] = $_COOKIE['main_link'];
		$_SESSION['main_directory'] = $_COOKIE['main_directory'];
		$_SESSION['color'] = $_COOKIE['color'];
		$_SESSION['id_company'] = $_COOKIE['id_company'];
		$_SESSION['userProfile'] = $_COOKIE['userProfile'];
		$_SESSION['id_contract'] = $_COOKIE['id_contract'];
		$_SESSION['server'] = $_COOKIE['server'];
		$_SESSION['name_user'] = $_COOKIE['name_user'];
		$_SESSION['user_mail'] = $_COOKIE['user_mail'];
		$_SESSION['user_access'] = $_COOKIE['user_access'];
		$_SESSION['user_last'] = $_COOKIE['user_last'];
		$_SESSION['company_name'] = $_COOKIE['company_name'];
		$_SESSION['color-text'] = $_COOKIE['color-text'];
		$_SESSION['userImage'] = $_COOKIE['userImage'];
		$_SESSION['login'] = $_COOKIE['login'];
		$_SESSION['logo'] = $_COOKIE['logo'];
		$_SESSION['directory'] = $_COOKIE['directory'];
	}else{
		setcookie('id_user', $_SESSION['id_user'], $expira, "/");
		setcookie('main_link', $_SESSION['main_link'], $expira, "/");
		setcookie('main_directory', $_SESSION['main_directory'], $expira, "/");
		setcookie('color', $_SESSION['color'], $expira, "/");
		setcookie('id_company', $_SESSION['id_company'], $expira, "/");
		setcookie('userProfile', $_SESSION['userProfile'], $expira, "/");
		setcookie('id_contract', $_SESSION['id_contract'], $expira, "/");
		setcookie('server', $_SESSION['server'], $expira, "/");
		setcookie('name_user', $_SESSION['name_user'], $expira, "/");
		setcookie('user_mail', $_SESSION['user_mail'], $expira, "/");
		setcookie('user_access', $_SESSION['user_access'], $expira, "/");
		setcookie('user_last', $_SESSION['user_last'], $expira, "/");
		setcookie('company_name', $_SESSION['company_name'], $expira, "/");
		setcookie('color-text', $_SESSION['color-text'], $expira, "/");
		setcookie('userImage', $_SESSION['userImage'], $expira, "/");
		setcookie('login', $_SESSION['login'], $expira, "/");
		setcookie('logo', $_SESSION['logo'], $expira, "/");	
		setcookie('directory', $_SESSION['directory'], $expira, "/");	
	}
//}
// .CONFIGURAR OS SESSIONS

?>