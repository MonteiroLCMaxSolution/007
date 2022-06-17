<?php

$ModelPDV = 'MaxComanda/model/PDV/PDV-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelPDV)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelPDV = $tag . $ModelPDV;
include_once($ModelPDV);

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


?>
<script>
    $(document).ready(function() {
        $('.modal').modal();
        M.updateTextFields();
        $('.money').mask('#.##0,00', {
            reverse: true
        });
    });
</script>
<?php if (!isset($uniqID)) { ?>
    <h5 class="center">Esta comanda ainda não possui pedidos cadastrados!</h5>

<?php } else { ?>

    <input type="text" id="uniqID" value="<?php echo $uniqID; ?>" hidden>
    <!--
<input type="text" id="numberOrderSheet" value="<?php if (isset($numberOrderSheet)) {
                                                    echo $numberOrderSheet;
                                                } ?>" hidden> -->
    <input type="text" id="total" value="<?php echo number_format($totalFinal, 2, ',', ''); ?>" hidden>

    <table class="highlight centered responsive-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Item</th>
                <th>Qtd</th>
                <th>Valor Unitário</th>
                <th>Desconto</th>
                <th>Total</th>
                <th>Editar</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $count = 1;
            while ($rowItems = $listItems->fetch()) {


            ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $rowItems->name; ?></td>
                    <td><?php echo $rowItems->quantity; ?></td>
                    <td><?php echo "R$" . number_format($rowItems->unitary_value, 2, ',', '');  ?></td>
                    <td><?php echo "R$" . number_format($rowItems->discount, 2, ',', '');  ?></td>
                    <td><?php echo "R$" . number_format($rowItems->total, 2, ',', '');  ?></td>
                    <td>
                        <a class="waves-effect waves-light btn-floating modal-trigger" href="#modalItem<?php echo $rowItems->id; ?>" onclick="modalEditItem('<?php echo $rowItems->id; ?>')">
                            <i class="material-icons">edit</i>
                        </a>
                    </td>
                </tr>

                <!-- Modal Item -->
                <div id="modalItem<?php echo $rowItems->id; ?>" class="modal modal-fixed-footer">
                    <div id="listModalEditItem<?php echo $rowItems->id; ?>"></div>
                </div>



            <?php } ?>

        </tbody>

        <tfoot>
            <tr>
                <td colspan="5" class="center"><b>Total</b></td>
                <td colspan="2"><b><?php if (isset($totalFinal)) {
                                        echo 'R$' . number_format($totalFinal, 2, ',', '');
                                    } else {
                                        echo "R$0,00";
                                    } ?></b></td>
            </tr>
        </tfoot>


    </table>

<?php } ?>