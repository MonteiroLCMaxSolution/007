<?php
$clientService = 'c94f21e96bf804c7c037c055c3dcc2e732929a04';
$directory = explode('/',$_SERVER['PHP_SELF']);
$directory = $directory[1];
/*$MaxComanda = "MaxComanda";
$MaxComanda_delirery = "MaxComanda_delirery";
$MaxComanda_fiscal = "MaxComanda_fiscal";*/

?>

<div id="divLogado" hidden="hidden">
	<div id="module"></div>
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/homologacao/index.php');
?>
</div>
<div id="divNegado" hidden="hidden">
	Acesso Negado
</div>
<script src="../homologacao/lib/jquery-3.3.1.min.js"></script>
<script src="../js/ws/ws.js"></script>
<script>
	alert('chamou validar pagamento');
	payment_status('<?php echo $clientService;?>','<?php echo $directory;?>');
</script>