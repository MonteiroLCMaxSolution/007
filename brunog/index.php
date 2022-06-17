<?php
$clientService = 'b7017d52c9f423d0666e48149ce976093feb16e5';
$directory = explode('/',$_SERVER['PHP_SELF']);
$directory = $directory[1];
/*$MaxComanda = "MaxComanda";
$MaxComanda_delirery = "MaxComanda_delirery";
$MaxComanda_fiscal = "MaxComanda_fiscal";*/

?>

<div id="divLogado" hidden="hidden">
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
	payment_status('<?php echo $clientService;?>');
</script>