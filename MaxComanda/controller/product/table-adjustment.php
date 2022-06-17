<?php

$ModelProduct = 'MaxComanda/model/product/product-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelProduct)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelProduct = $tag . $ModelProduct;
include_once($ModelProduct);

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

?>

<script>
    $(document).ready(function() {
        M.updateTextFields();
        $(".modal").modal();
        $('.tooltipped').tooltip({
            inDuration: 350,
            position: 'bottom'
        });
    });
</script>



<table id="tableAdjustment" class="highlight centered responsive-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Cód.</th>
            <th>Fornecedor</th>
            <th>Quantidade</th>
            <th>Data Registro</th>
            <th>Tipo</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>
        <?php

        $count = 1;
        while ($rowSearchAdjustment = $sqlSearchAdjustment->fetch()) {
        ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $rowSearchAdjustment->id; ?></td>
                <td><?php echo $rowSearchAdjustment->provider_name; ?></td>
                <td><?php echo $rowSearchAdjustment->quantity; ?></td>
                <td><?php echo date("d/m/Y", strtotime($rowSearchAdjustment->date_register)); ?></td>
                <td><?php echo $rowSearchAdjustment->type; ?></td>
                <td>
                    <a class="btn-floating waves-effect waves-light green tooltipped modal-trigger" data-target="modalSeeAdjustment<?php echo $rowSearchAdjustment->id; ?>" data-tooltip="Ver Detalhes"><i class="material-icons">task_alt</i></a>
                </td>
            </tr>


            <!-- Modal para Visualizar Detalhes da Movimentação -->
            <div id="modalSeeAdjustment<?php echo $rowSearchAdjustment->id; ?>" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <h5 class="center">Detalhes da Movimentação #<?php echo $rowSearchAdjustment->id; ?></h5>


                    <div class="row">

                        <div class="input-field col s6 m6 l6">
                            <label class="active">Tipo da Movimentação</label>
                            <input type="text" value="<?php echo $rowSearchAdjustment->type; ?>" readonly>
                        </div>

                        <?php if ($rowSearchAdjustment->type == "Entrada") { ?>
                            <div class="input-field col s6 m6 6">
                                <input type="number" value="<?php echo $rowSearchAdjustment->provider_id; ?>" readonly>
                                <label>ID Fornecedor</label>
                            </div>

                            <div class="input-field col s12 m12 l12">
                                <input type="text" readonly value="<?php echo $rowSearchAdjustment->provider_name; ?>">
                                <label>Fornecedor</label>
                            </div>

                            <div class="input-field col s12 m12 l12">
                                <label class="active">Quantidade</label>
                                <input type="number" value="<?php echo $rowSearchAdjustment->quantity; ?>" readonly>
                            </div>

                        <?php } else { ?>
                            <div class="input-field col s6 m6 l6">
                                <label class="active">Quantidade</label>
                                <input type="number" value="<?php echo $rowSearchAdjustment->quantity; ?>" readonly>
                            </div>
                        <?php } ?>

                        <div class="input-field col s12 m12 l12">
                            <textarea class="materialize-textarea"><?php echo $rowSearchAdjustment->description; ?></textarea>
                            <label>Descrição</label>
                        </div>
                    </div> <!-- .row -->

                    <div class="row">

                        <div class="input-field col s6 m6 l6">
                            <label class="active">Data Cadastro</label>
                            <input type="text" value="<?php if (isset($rowSearchAdjustment->date_register) && $rowSearchAdjustment->date_register != 0) {
                                                            echo date("d/m/Y H:i:s", strtotime($rowSearchAdjustment->date_register));
                                                        }  ?>" readonly>
                        </div>

                        <div class="input-field col s6 m6 l6">
                            <label class="active">Usuário Cadastro</label>
                            <input type="text" value="<?php echo $rowSearchAdjustment->user_register_name;  ?>" readonly>
                        </div>

                    </div> <!-- .row -->

                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
            </div>




        <?php } ?>
    </tbody>
</table>