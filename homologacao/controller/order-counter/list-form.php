<?php

if (!isset($_SESSION)) {
    session_start();
}
$ModelOrderCounter = 'MaxComanda/model/order-counter/order-counter-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelOrderCounter)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelOrderCounter = $tag . $ModelOrderCounter;
include_once($ModelOrderCounter);

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

$ModelUserPermission = 'MaxComanda/model/permission/user-permission.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelUserPermission)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelUserPermission = $tag . $ModelUserPermission;
include_once($ModelUserPermission);

if ($ROW_Perm_Monitor_Counter->search == 'N' && $ROW_Perm_Monitor_Counter->include == 'N' && $ROW_Perm_Monitor_Counter->edit == 'N') {
    $modalPermission = $_SERVER['DOCUMENT_ROOT'] . '/MaxComanda/view/modalPermission.php';
    include_once($modalPermission);
}

?>

<script>
    setTimeout(function() {
        window.location.reload(1);
    }, 30000);
</script>

<section>
    <nav style="max-height: 37px; line-height: 30px; background-color: <?php echo $_SESSION['color']; ?>">
        <div class="container">
            <div class="center pageBreadcrumb">
                <a href="index.php" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Home</a>
                <a href="#" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>"><?php echo $pageName; ?></a>
            </div>
        </div>
    </nav>
</section>

</section>
<div class="row">



    <?php
    $count = 0;
    while ($rowUniqID = $listUniqID->fetch()) {
        $orderUniqID = $rowUniqID->uniqID;
        $tableDelivery = $rowUniqID->table_delivery;
        if (!empty($tableDelivery)) {
            $AND_table_delivery = "AND a.table_delivery = '$tableDelivery'";
        } else {
            $AND_table_delivery = "";
        }
        $count++;


    ?>




        <div class="col s12 m6 l6">
            <div class="card hoverable" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">
                <div class="card-header">
                    <?php if (!empty($tableDelivery)) { ?>
                        <h4 class="center">Mesa #<?php echo $tableDelivery; ?></h4>
                    <?php } else { ?>
                        <h4 class="center">Balcão</h4>
                    <?php } ?>
                </div>
                <div class="card-content">


                    <table class="highlight centered responsive-table">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Sabor</th>
                                <th>Complementos</th>
                                <th>Quantidade</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php

                            $listItems = "SELECT a.id, a.quantity, a.table_delivery, a.observation, a.table_demand, b.name 
                                FROM order_items a 
                                LEFT JOIN product b ON a.product_id = b.id 
                                WHERE a.uniqID = '$orderUniqID' $AND_table_delivery AND a.counter_status = 'Aguardando' AND a.temp = 2 ";
                            $listItems = $pdo->prepare($listItems);
                            $listItems->execute();
                            while ($rowItems = $listItems->fetch()) {
                                $orderItemID = $rowItems->id;

                                // --- LISTAR SABORES DESSE REGISTRO ---
                                $listSelectedFlavor = "SELECT a.flavor_id, b.name 
                                FROM order_items_addition a 
                                LEFT JOIN product_flavor b ON a.flavor_id = b.id
                                WHERE a.order_item_id = $orderItemID AND a.flavor_id != '' ";
                                $listSelectedFlavor = $pdo->prepare($listSelectedFlavor);
                                $listSelectedFlavor->execute();

                                // --- LISTAR COMPLEMENTOS DESSE REGISTRO ---
                                $listSelectedAddition = "SELECT a.addition_id, b.name 
                                FROM order_items_addition a 
                                LEFT JOIN product_addition b ON a.addition_id = b.id 
                                WHERE a.order_item_id = $orderItemID AND a.addition_id != '' ";
                                $listSelectedAddition = $pdo->prepare($listSelectedAddition);
                                $listSelectedAddition->execute();

                            ?>
                                <tr>
                                    <td><?php echo $rowItems->name; ?></td>
                                    <td>
                                        <ul>
                                            <?php while ($rowSelectedFlavor = $listSelectedFlavor->fetch()) { ?>
                                                <li><?php echo $rowSelectedFlavor->name; ?></li>
                                            <?php } ?>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            <?php while ($rowSelectedAddition = $listSelectedAddition->fetch()) { ?>
                                                <li><?php echo $rowSelectedAddition->name; ?></li>
                                            <?php } ?>
                                        </ul>
                                    </td>
                                    <td><b>x<?php echo $rowItems->quantity; ?></b></td>
                                    <td>
                                        <?php if (!empty($rowItems->observation)) { ?>
                                            <a class="btn-floating btn waves-effect waves-light orange tooltipped modal-trigger" data-tooltip="Ver Detalhes" href="#observation<?php echo $rowItems->id; ?>"><i class="material-icons">error_outline</i></a>
                                        <?php } ?>


                                        <?php if ($ROW_Perm_Monitor_Counter->edit == 'S') { ?>

                                            <a class="btn-floating btn waves-effect waves-light blue tooltipped" data-tooltip="Pedido Pronto" onclick="deliverOrder('<?php echo $rowItems->id; ?>')"><i class="material-icons">done</i></a>

                                        <?php } ?>


                                    </td>

                                    <!-- Modal Observações do Pedido -->
                                    <div id="observation<?php echo $rowItems->id; ?>" class="modal bottom-sheet">
                                        <div class="modal-content">
                                            <h4 class="center"><?php echo $rowItems->quantity; ?>x <?php echo $rowItems->name; ?></h4>
                                            <p class="center"><?php echo $rowItems->observation; ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
                                        </div>
                                    </div>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>






                </div>
            </div>
        </div>

    <?php
    }
    ?>








</div>
</section>