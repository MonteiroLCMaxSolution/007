<?php
if ( !isset( $_SESSION ) ) {
  session_start();
}
if ( !empty( $_COOKIE[ 'server' ] ) ) {
  $_SESSION[ 'server' ] = $_COOKIE[ 'server' ];
}


$ConexaoMysql = $_SESSION[ 'server' ] . '/conexao-pdo/conexao-mysql-pdo.php';
include_once( $ConexaoMysql );

date_default_timezone_set( 'America/Sao_Paulo' );
$dataLocal = date( 'Y-m-d H:i:s');

// LISTAR AS EMPRESAS DA PASTA ABERTA - MONTEIRO - 29/05/2022
$SQL_list_company = "SELECT distinct b.id, b.name_razao_social FROM user a
INNER JOIN company b ON a.id_contract = b.id_contract
WHERE a.folder  = :folder;";
$SQL_list_company = $pdo->prepare($SQL_list_company);
$SQL_list_company->bindValue('folder',$directory);
$SQL_list_company->execute();
// FIM - LISTAR AS EMPRESAS DA PASTA ABERTA - MONTEIRO - 29/05/2022
?>