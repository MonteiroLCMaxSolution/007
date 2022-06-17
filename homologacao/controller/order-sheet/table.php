<?php

$ModelOrderSheet = $_SESSION['server'] . '/model/order-sheet/order-sheet-model.php';
include_once($ModelOrderSheet);

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

?>

<table id="tableOrderSheet">
    <thead>
        <tr>
            <th>#</th>
            <th>Cód</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 1;
        while ($rowSearchOrderSheet = $sqlSearchOrderSheet->fetch()) {
        ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $rowSearchOrderSheet->number_order_sheet; ?></td>
                <td>
                    
                       
                            Inativo
                            <input type="checkbox" class="form-check-input" id="status<?php echo $rowSearchOrderSheet->id; ?>" value="S" <?php if ($rowSearchOrderSheet->status == "Ativo") { ?> checked <?php } ?> onchange="statusOrderSheet('<?php echo $rowSearchOrderSheet->id; ?>')">
                            Ativo
                        
                </td>
            </tr>



        <?php } ?>
    </tbody>
</table>

