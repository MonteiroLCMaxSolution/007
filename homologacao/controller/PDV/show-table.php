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
        M.updateTextFields();
        $('.money').mask('#.##0,00', {
            reverse: true
        });
    });
</script>
<?php if (!isset($tableUniqID)) { ?>
    <h5 class="center">Esta mesa não está cadastrada ou ainda não possui comandas vinculadas!</h5>

<?php } else { ?>

    <input type="text" id="uniqID" value="<?php if (isset($tableUniqID)) {
                                                echo $tableUniqID;
                                            } ?>" hidden>
    <input type="text" id="total" value="<?php if(isset($totalTable)) { echo number_format($totalTable, 2, ',', ''); } else { echo 'undefined'; } ?>" hidden>
    <div class="row">

        <div class="col s12 m12 l12">



            <table class="highlight centered responsive-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Comanda</th>
                        <th>Valor Total</th>
                        <th>Editar</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $count = 1;
                    while ($rowTable = $showTable->fetch()) {


                    ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo $rowTable->order_sheet_demand; ?></td>
                            <td><?php echo "R$" . number_format($rowTable->total, 2, ',', '');  ?></td>
                            <td>
                                <a class="waves-effect waves-light btn-floating" onclick="showOrderSheetbyTable('<?php echo $rowTable->order_sheet_demand; ?>')">
                                    <i class="material-icons">edit</i>
                                </a>
                            </td>
                        </tr>




                    <?php } ?>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="center"><b>Total</b></td>
                        <td colspan="2" class="center"><b><?php if (isset($totalTable)) {
                                                                echo 'R$' . number_format($totalTable, 2, ',', '');
                                                            } else {
                                                                echo "R$0,00";
                                                            } ?></b></td>
                    </tr>
                </tfoot>
            </table>


        </div>

    </div>

<?php } ?>