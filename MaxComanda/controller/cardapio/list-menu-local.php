<?php

$MenuModel = $_SERVER['DOCUMENT_ROOT'] . '/MaxComanda/model/menu/menu-model.php';
include_once($MenuModel);

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL); 

include_once('menu-local-content.php'); 

include_once('footer.php');

?>
