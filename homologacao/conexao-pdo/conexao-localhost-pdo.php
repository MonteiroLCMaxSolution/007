<?php

$Config = 'conexao-pdo/config.php';
$parametro = 's';
$tag = '';
while ($parametro != 'n'){
	if (file_exists($tag.$Config)) {
		$parametro = 'n';
	} else {
		$tag = '../'.$tag;
	}
}
$Config = $tag.$Config;
include_once($Config);

$host = "localhost";
$dbName = "max_comanda";
$userName = "root";
$password = "";
$charset = 'utf8';

try {
	$pdoLocalHost = new PDO("mysql:host=$host;dbname=$dbName;charset=$charset", $userName, $password);

	$pdoLocalHost->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdoLocalHost->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $e) {
	echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
}

function anti_injection($sql)
{
	// remove palavras que contenham sintaxe sql
	$sql = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/i", "", $sql);
	$sql = trim($sql); //limpa espaços vazio
	$sql = strip_tags($sql); //tira tags html e php
	$sql = addslashes($sql); //Adiciona barras invertidas a uma string
	return $sql;
}


?>
