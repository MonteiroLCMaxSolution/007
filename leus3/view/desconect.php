<?php
$_SESSION = array();
  session_destroy();
	$_SESSION['id_user'] = '';
	
	unset($_COOKIE['id_user']);
    unset($_COOKIE['main_link']);
    unset($_COOKIE['main_directory']);
    unset($_COOKIE['color']);
    unset($_COOKIE['id_company']);
    unset($_COOKIE['userProfile']);
    unset($_COOKIE['id_contract']);
    unset($_COOKIE['server']);
    unset($_COOKIE['name_user']);
    unset($_COOKIE['user_mail']);
    unset($_COOKIE['user_access']);
    unset($_COOKIE['user_last']);
    unset($_COOKIE['company_name']);
    setcookie('id_user', null, -1, '/');
    setcookie('main_link', null, -1, '/');
    setcookie('main_directory', null, -1, '/'); 
    setcookie('color', null, -1, '/'); 
    setcookie('id_company', null, -1, '/'); 
    setcookie('userProfile', null, -1, '/'); 
    setcookie('id_contract', null, -1, '/'); 
    setcookie('server', null, -1, '/'); 
    setcookie('name_user', null, -1, '/'); 
    setcookie('user_mail', null, -1, '/'); 
    setcookie('user_access', null, -1, '/'); 
    setcookie('user_last', null, -1, '/'); 
    setcookie('company_name', null, -1, '/');
	setcookie('userImage','');
	setcookie('login','');
	setcookie('logo','');
echo 'passou aqui '. $_COOKIE['name_user'];
?>