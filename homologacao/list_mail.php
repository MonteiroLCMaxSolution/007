<?php

if (!isset($_SESSION)) {
    session_start();
}

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
$ConexaoMysql = $_SESSION['server'].'/model/recover-password/recover-password.php';
include_once($ConexaoMysql);
/*

date_default_timezone_set('America/Sao_Paulo');
$dateTime = date('Y-m-d H:i:s', time());

// a.id, a.name, a.folder, a.CPF, b.name_razao_social 
?>
<div class="recuperar-senha-result-title">
  <h2>Conta(s) vinculada(s) à esse email:</h2>
</div>
*/

while($row_list_mail = $SQL_list_mail->fetch()){

?>
<div class="recuperar-senha-result-single">
  <h3>Nome: <b><?php echo $row_list_mail->name;?></b></h3>
  <h3>Empresa: <b><?php echo $row_list_mail->name_razao_social;?></b></h5>
  <h3>CPF: <b><?php echo $row_list_mail->CPF;?></b></h5>
  <h3>Loja: <b><?php echo $row_list_mail->folder;?></b></h5>
  <a href="javascript: recover_password('<?php echo $row_list_mail->id;?>')">Recuperar senha</a>
</div>
<?php	
}
?>