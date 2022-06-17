<?php 
if (!isset($_SESSION)) {
	session_start();
}
$_SESSION['main_directory'] = 'homologacao'; 										// PASTA PRINCIPAL
$_SESSION['main_link']= 'https://'.$_SERVER['SERVER_NAME'].'/'.$main_directory; 	// LINK PRINCIPAL
$_SESSION['server_name'] = 'https://'.$_SERVER['SERVER_NAME'].'/';					// DOMÍNIO
$_SESSION['server'] = __DIR__;	
$_SESSION['VERSION']= '12';

setcookie('main_directory','homologacao');
setcookie('main_link','https://'.$_SERVER['SERVER_NAME'].'/'.$main_directory);
setcookie('server_name','https://'.$_SERVER['SERVER_NAME'].'/');
setcookie('server',__DIR__);
setcookie('VERSION','12');


// DIRETÓRIO DO SERVIDOR
?>
