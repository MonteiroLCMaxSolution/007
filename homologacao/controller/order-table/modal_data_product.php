<?php
$ConexaoMysql = $_POST[ 'conect' ];

if ( !isset( $_SESSION ) ) {
  session_start();
}
$ModelCompany = 'MaxComanda/model/order-table/order-table-model.php';

$parametro = 's';
$tag = '';
while ( $parametro != 'n' ) {
  if ( file_exists( $tag . $ModelCompany ) ) {
    $parametro = 'n';
  } else {
    $tag = '../' . $tag;
  }
}
$ModelCompany = $tag . $ModelCompany;
include_once( $ModelCompany );

?>

<div class="modal-content">
<h4 class="center"><b><?php echo $id_product.' / '.$name_product.' / R$ '.number_format($value,2,",","."); ?></b></h4>
<section>
<div class="row">
<div class="col s12 m12 l12">
	<?php 
	if($fraction >= 2){
		?>
	<p class="center">Escolha até <span id="fraction"><?php echo $fraction; ?></span> Sabor(es)</p>
	<?php
	} ?>

	<?php  if($SQL_step2->rowCount() == 0){ $select = 1;}else{ $select = 0;}?>
	
	<input value="<?php echo $select;?>" id="selected_flover" hidden="hidden">
  <label>Qtde.</label>
  <input type="number" value="" name="quantity" id="quantity"/>
</div>

	<div class="col s6 m6 l6">
		<?php  if($SQL_step2->rowCount() > 0){?>
		<label>Sabores</label>
		
		<?php } ?>

<BR />
<?php
while ( $row_passo2 = $SQL_step2->fetch() ) {
  ?>
<label>
                                    <input type="checkbox" name="checks[]" class=" checkClean" value="<?php echo $row_passo2->id; ?>" id="<?php echo $row_passo2->id; ?>" onClick="checkFlower('<?php echo $row_passo2->id; ?>')" />
                                    <span><?php echo $row_passo2->name; ?></span>
                                </label><BR/>
<?php } ?>
</div>
	
	<div class="col s6 m6 l6">
	<?php  if($SQL_passo3->rowCount() > 0){?>
<label>Complementos</label>
		
		<?php } ?>	
<BR />
<?php
while ( $row_passo3 = $SQL_passo3->fetch() ) {
  ?>
<label>
                                    <input type="checkbox" name="checksCom[]" class="checkClean" value="<?php echo $row_passo3->id; ?>"/>
                                    <span><?php echo $row_passo3->name; ?> - R$ <?php echo number_format($row_passo3->value, 2, ',', ''); ?></span>
                                </label><BR/>
<?php } ?>
</div>
	<div class="col s12 m12 l12">
<label>Observações</label>
<BR />

<label>
<textarea rows="5" id="observation" class="materialize-textarea"></textarea>
	<span></span></label>

</div>
	
	
	
	

	

	

<!-- .row -->
	
</section>
</div>
<!-- .modal-content -->
<div class="modal-footer"> <a href="#!" class="modal-close waves-effect waves-green btn-flat left">Cancelar</a> <a href="#!" class="modal-close waves-effect waves-green btn-flat right" onClick="include_temp()">Confirmar</a> </div>
<!-- .modal-footer -->