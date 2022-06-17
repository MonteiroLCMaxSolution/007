
<?php

if(!empty($_GET['create_directory'])){
	$directory = $_GET['directory'];
	$sha1_service = $_GET['sha1_service'];
	$dbHost = '200.234.194.69';//$_GET['dbHost'];
	$dbName = 'maxcoman_base1';//$_GET['dbName'];
	$dbUser = 'maxcoman_base1';//$_GET['dbUser'];
	$dbPass = '@lcmaxsolution2022';//$_GET['dbPass'];
	
	
	$indexLogin = '<?php
$clientService = "c94f21e96bf804c7c037c055c3dcc2e732929a03";
$directory = explode("/",$_SERVER["PHP_SELF"]);
$directory = $directory[1];
?>
<div id="divLogado" hidden="hidden">
<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/MaxComanda/index.php");
?>
</div>
<div id="divNegado" hidden="hidden">
	Acesso Negado
</div>
<script src="../MaxComanda/lib/jquery-3.3.1.min.js"></script>
<script src="../js/ws/ws.js"></script>
<script>
	payment_status("<?php echo $clientService;?>");
</script>';
	
	$indexView = '<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/MaxComanda/view/index.php");
?>';
	
	$indexCardapio = '<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/MaxComanda/Cardapio/index.php");
?>';
	
	$conexao = '<?php
$host = "'.$dbHost.'";
$dbName = "'.$dbName.'";
$userName = "'.$dbUser.'";
$password = "'.$dbPass.'";
$charset = "utf8";
try {
	$pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=$charset", $userName, $password);

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

	//echo "achou dados no base help2";
} catch (PDOException $e) {
	echo "Erro ao conectar com o MySQL: " . $e->getMessage();
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
?>';	
}

mkdir($directory,0755, true);
mkdir($directory.'/view',0755,true);
mkdir($directory.'/conexao-pdo',0755,true);
mkdir($directory.'/cardapio',0755,true);
mkdir($directory.'/uploads',0755,true);
mkdir($directory.'/uploads/logo',0755,true);
mkdir($directory.'/uploads/productImg',0755,true);
mkdir($directory.'/uploads/userImage',0755,true);

$fp = fopen($directory."/index.php","wb");
fwrite($fp,$indexLogin);
fclose($fp);


$fp = fopen($directory."/cardapio/index.php","wb");
fwrite($fp,$indexCardapio);
fclose($fp);

$fp = fopen($directory."/view/index.php","wb");
fwrite($fp,$indexView);
fclose($fp);

$fp = fopen($directory."/conexao-pdo/conexao-mysql-pdo.php","wb");
fwrite($fp,$conexao);
fclose($fp);
?>