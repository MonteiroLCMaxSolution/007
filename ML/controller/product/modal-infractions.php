<?php
require_once '../../model/product/product-model.php';
?>

<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Infrações do Anúncio: <?php echo $itemID; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div style="background: #ccc">
    <h4 class="text-center"><b>Infração:</b></h4>
    <p class="text-center"><?php echo $motivo; ?></p>
    </div>
    <h4 class="text-center"><b>Solução:</b></h4>
    <p class="text-center"><?php echo $solucao; ?></p>

    <p><small class="form-text text-muted text-right">Criado em: <?php echo $dataHoraInfracao; ?></small></p>

    

    <small class="form-text text-muted text-center">Atenção: Pode demorar até 24h para o ML mudar o status da publicação!</small>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
    <a href="https://www.mercadolivre.com.br/anuncios/<?php echo $id_anuncio; ?>/modificar/" target="_blank" class="btn btn-primary">Corrigir Anúncio</a>
</div>