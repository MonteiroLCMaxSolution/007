<?php

$ModelOrderSheet = 'MaxComanda/model/order-sheet/order-sheet-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelOrderSheet)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelOrderSheet = $tag . $ModelOrderSheet;
include_once($ModelOrderSheet);

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);




?>

<script>
$(document).ready(function(){
    $('.tooltipped').tooltip({
		inDuration: 350,
		position: 'bottom'
	});

    $('.modal').modal();
  });
</script>

<table id="tableOrderSheet" class="highlight centered responsive-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Cód.</th>
            <th>Status</th>
           <!-- <th>QR Code</th> -->
        </tr>
    </thead>

    <tbody>
        <?php
        $count = 1;
        while ($rowSearchOrderSheet = $sqlSearchOrderSheet->fetch()) {
        ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $rowSearchOrderSheet->id; ?></td>
                <td>
                    <div class="switch">
                        <label>
                            Inativo
                            <input type="checkbox" id="status<?php echo $rowSearchOrderSheet->id; ?>" value="S" <?php if ($rowSearchOrderSheet->status == "Ativo") { ?> checked <?php } ?> onclick="statusOrderSheet('<?php echo $rowSearchOrderSheet->id; ?>')">
                            <span class="lever"></span>
                            Ativo
                        </label>
                    </div>
                </td>
               <!-- <td>
                    <a class="waves-effect waves-light btn-floating modal-trigger blue tooltipped" data-tooltip="Gerar QR Code" href="#modalQRCodeOrderSheet<?php echo $rowSearchOrderSheet->id; ?>">
                        <i class="material-icons">qr_code_scanner</i>
                    </a>
                </td> -->


            </tr>

            <!-- Modal QRCode 
            <div id="modalQRCodeOrderSheet<?php echo $rowSearchOrderSheet->id; ?>" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <h4 class="center">QR Code - Comanda <?php echo $rowSearchOrderSheet->id; ?></h4>

                    


                    <?php
                   $qrOrderSheet = $_SESSION['lib']."/lib/qrcode/php/qr_img.php/?";
                   $qrOrderSheet .= "e=H&";
                   $qrOrderSheet .= "s=6&";
                   $qrOrderSheet .= "t=P&";
                   $qrOrderSheet .= "d=www.maxcomanda.com.br/".$_SESSION['directoryName']."/view/?pg=cardapio";
              

                    ?>

                    <div class="center">
                        <img src="<?php echo $qrOrderSheet; ?>">
                    </div>


                </div>
                <div class="modal-footer">
                    <a href="<?php echo $qrOrderSheet; ?>" class="waves-effect waves-green btn blue" download>Baixar QR Code</a>
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div> -->

        <?php } ?>
    </tbody>
</table>