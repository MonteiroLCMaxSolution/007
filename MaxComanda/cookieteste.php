<?php
session_start();
$value = date('d/m/Y H:i:s');
if(empty($_COOKIE['CookieTeste'])){
	setcookie("CookieTeste", $value);	
}
echo $_COOKIE['CookieTeste'];
?>