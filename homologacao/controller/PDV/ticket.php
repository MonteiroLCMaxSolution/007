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

<?php if (!empty($table)) {
    while ($rowOrderSheetTable = $listOrderSheetTable->fetch()) {
        $orderSheetTable = $rowOrderSheetTable->order_sheet_demand;
        

        // --- LISTAR COMANDA ---

        $showItems = "SELECT a.*,b.name,
		IFNULL(((a.unitary_value * a.quantity) - a.discount),0) AS total

		FROM order_items a
        LEFT JOIN product b ON a.product_id = b.id
	
		WHERE a.uniqID = '$uniqID' AND a.order_sheet_demand = $orderSheetTable";
        $showItems = $pdo->prepare($showItems);
        $showItems->execute();

        // --- LISTAR TOTAL FINAL ---
        $listTotal = "SELECT 

        SUM(IFNULL(((a.unitary_value * a.quantity) - a.discount),0)) AS total
    
        FROM order_items a
    
    
        WHERE a.uniqID = '$uniqID' AND a.order_sheet_demand = $orderSheetTable";
        $listTotal = $pdo->prepare($listTotal);
        $listTotal->execute();
        if ($rowTotalFinal = $listTotal->fetch()) {
            $totalOrderSheet = $rowTotalFinal->total;
        }


?>

        <h4 class="center">Comanda <?php echo $orderSheetTable; ?></h4>

        <table class="centered">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qtd</th>
                    <th>Valor Unitário</th>
                    <th>Desconto</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>

                <?php while ($rowItems = $showItems->fetch()) { ?>
                    <tr>
                        <th><?php echo $rowItems->name; ?></th>
                        <th>x<?php echo $rowItems->quantity; ?></th>
                        <th><?php echo "R$" . number_format($rowItems->unitary_value, 2, ',', '');  ?></th>
                        <th><?php echo "R$" . number_format($rowItems->discount, 2, ',', '');  ?></th>
                        <th><?php echo "R$" . number_format($rowItems->total, 2, ',', '');  ?></th>
                    </tr>

                <?php } ?>

            </tbody>
            <tfoot>
                <th colspan="3">Total da Comanda</th>
                <th colspan="2"><?php echo "R$" . number_format($totalOrderSheet, 2, ',', '');  ?></th>
            </tfoot>




        </table>

    <?php } ?>
    <h4>Total da Mesa: <?php echo "R$" . number_format($totalFinal, 2, ',', '');  ?></h4>
<?php } else { ?>

    <table class="centered">
        <thead>
            <tr>
                <th>Item</th>
                <th>Qtd</th>
                <th>Valor Unitário</th>
                <th>Desconto</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>

            <?php while ($rowItems = $showItems->fetch()) { ?>
                <tr>
                    <th><?php echo $rowItems->name; ?></th>
                    <th>x<?php echo $rowItems->quantity; ?></th>
                    <th><?php echo "R$" . number_format($rowItems->unitary_value, 2, ',', '');  ?></th>
                    <th><?php echo "R$" . number_format($rowItems->discount, 2, ',', '');  ?></th>
                    <th><?php echo "R$" . number_format($rowItems->total, 2, ',', '');  ?></th>
                </tr>

            <?php } ?>

        </tbody>

        <tfoot>
            <th colspan="3">Total Final</th>
            <th colspan="2"><?php echo "R$" . number_format($totalFinal, 2, ',', '');  ?></th>
        </tfoot>


    </table>


<?php } ?>