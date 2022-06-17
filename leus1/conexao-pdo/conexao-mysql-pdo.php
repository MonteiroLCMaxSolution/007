<?php

/*ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);*/

/*---------- DADOS DO CLIENTE - LEÔNIDAS MONTEIRO - 22/07/2020 */
$clientesha1 = 'f1767d30a00bea376ad8c9d6ace664cc';
$clienteserv = '52';
/*========== DADOS DO CLIENTE - LEÕNIDAS MONTEIRO - 22/07/2020 */

//---------- CONECTAR COM A NOSSA BASE - LEÔNIDAS MONTEIRO - 22/07/2020*/
/*$host = "200.234.194.69";
$dbName = "ftplcmax_help_desk";
$userName = "ftplcmax_lcmax";
$password = "Lcmax@2019!";
$charset = 'utf8';
try{
$pdoLC = new PDO("mysql:host=$host;dbname=$dbName;charset=$charset", $userName, $password);
$pdoLC->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdoLC->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

}catch ( PDOException $e ){
    echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
}
//========== CONECTAR COM A NOSSA BASE - LEÔNIDAS MONTEIRO - 22/07/2020*/
//---------- VALIDAR CLIENTE - LEÔNIDAS MONTEIRO - 22/07/2020*/
/*$SQL_validarCliente = "SELECT b.nome AS tituloSite, b.endereco, b.numero, b.bairro, b.cidade, b.UF, b.CEP, b.fixo, a.dbHost, a.dbName, a.dbUser, a.dbPass FROM empresa_servico a 
LEFT JOIN empresa b ON a.md5 = b.md5 WHERE a.md5 = :md5 AND a.id_servico = :id_servico AND a.`status` = 'ATIVO'";
$SQL_validarCliente = $pdoLC->prepare($SQL_validarCliente);
$SQL_validarCliente->bindValue('md5',$clientesha1);
$SQL_validarCliente->bindValue('id_servico',$clienteserv);
$SQL_validarCliente->execute();
if($SQL_validarCliente->rowCount() > 0){
	$rowValidarCliente = $SQL_validarCliente->fetch();
	$dominioEndereco = $rowValidarCliente->endereco.', '.$rowValidarCliente->numero.' - '.$rowValidarCliente->bairro.' - '.$rowValidarCliente->cidade.' - '.$rowValidarCliente->UF.' - '.$rowValidarCliente->CEP;
	$dominioTelefone =  $rowValidarCliente->fixo;
	$tituloSite = $rowValidarCliente->tituloSite;*/
$chaveServidor = '';
$tituloHeaderEmail = "Rodrigo Hortifruti";
$logoMarca = 'logo_rodrigo.png';
$dominioSecundario = 'https://rodrigohortifruti.com.br/';
$emailContato = "";
$pastaSITE = '/2021';
$pastaMAXERP = '/MAXERP';
$IconEmpresa = "logo_rodrigo.png";
$NomeEmpresa = "Rodrigo Hortifruti";
$dominio = 'https://' . $_SERVER['HTTP_HOST'] . $pastaMAXERP;
$http = $dominio;
$pastaUpload = $http . '/imagens/';
$nomeDaEmpresa = "Rodrigo Hortifruti";
$linkAPP = '';
$httpSite = 'https://' . $_SERVER['HTTP_HOST'] . $pastaSITE;
$pastaSite = $httpSite;

/*pastaSITE

httpSite
	$dbHost = $rowValidarCliente->dbHost;
	$dbName = $rowValidarCliente->dbName;
	$dbUser = $rowValidarCliente->dbUser;
	$dbPass = $rowValidarCliente->dbPass;*/
/*---------- CONECTAR CLIENTE - LEÔNIDAS MONTEIRO - 22/07/2020*/
//$host = $dbHost;
//$dbName = $dbName;
//$userName = $dbUser;
//$password = $dbPass;

$host = "200.234.194.69";
$dbName = "maxcoman_max_comanda";
$userName = "maxcoman_lcmaxso";
$password = "@lcmaxsolution22!";
$charset = 'utf8';
try {
	$pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=$charset", $userName, $password);

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

	$result_conect = 'base leus';
} catch (PDOException $e) {
	echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
}
/*========== CONECTAR CLIENTE - LEÔNIDAS MONTEIRO - 22/07/2020*/
/*}else{
	echo 'Contate o administrador do site!';
}*/
/*---------- CONFIGURAÇÃO DE ENVIOS DE E-MAILS AUTENTICADOS - LEÔNIDAS MONTEIRO - 29/07/2020*/
$emailHost =  'lcmaxsolution.com.br';
$emailPort = true;  // Usar autentica��o SMTP (obrigat�rio para smtp.seudom�nio.com.br)
$emailPort = '465'; //  Usar 587 porta SMTP
$emailSMTP = 'ssl';
$emailUser = 'leonidas@lcmaxsolution.com.br'; // Usu�rio do servidor SMTP (endere�o de email)
$emailPass = '0_~TYFhpRTW?';
/*========== CONFIGURAÇÃO DE ENVIOS DE E-MAILS AUTENTICADOS - LEÔNIDAS MONTEIRO - 29/07/2020
/* Configuração do pagSeguro - Leônidas Monteiro - 15/08/2019*/
$URLjsHomologacao = 'https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js';
$URLjsProducao = 'https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js';
$chaveServidor = 'AAAAHaRgcZ0:APA91bFoiYGzVZCh817Jw6DckZMePlLx2aOtoOn4ICEC7M2TznnQ4C5tBRSOAeu6-z2kh9uxtdIem404Zq0Hn_E3WeGm1GGXkzuTtiiWCv2SDYz2G5NT3lLb7vUDGeoffyT70jnm3Wka';
$URLHomologacao = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions';
$URLProducao = 'https://ws.pagseguro.uol.com.br/v2/transactions';
$pastaPrincipalGatewayPagamento = '/gatewayPagamento/';
$emailLogaGateway =  'foxs.sbc11@gmail.com';
/* FIM - Configuração do pagSeguro - Leônidas Monteiro - 15/08/2019 */
/*geolocalização 
		$IP = $_SERVER["REMOTE_ADDR"];
		$geoID = file_get_contents('https://api.ipstack.com/'.$IP.'?access_key=9b03f9c47e44f177b6ede703e9a9bfb7');
		$geoID = json_decode($geoID);
		$cidade =  htmlspecialchars($geoID->city);
		$UFGEOID =  htmlspecialchars($geoID->region_code);
	/* .geolocalização 
*/
function anti_injection($sql)
{
	// remove palavras que contenham sintaxe sql
	$sql = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/i", "", $sql);
	$sql = trim($sql); //limpa espaços vazio
	$sql = strip_tags($sql); //tira tags html e php
	$sql = addslashes($sql); //Adiciona barras invertidas a uma string
	return $sql;
}
