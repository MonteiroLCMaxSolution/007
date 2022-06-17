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



<div class="modal-content">
    <h4 class="center"><?php echo $product_name; ?></h4>
    <input type="text" id="idOrderItem<?php echo $orderItemID; ?>" value="<?php echo $orderItemID; ?>" hidden>

    <form method="POST" id="formItemPDV<?php echo $orderItemID; ?>">
        <div class="row">
            
            <div class="col s12 m12 l12">
                <div class="row">

                    <div class="input-field col s12 m6 l6">
                        <label>Observações</label>
                        <input type="text" id="observation<?php echo $orderItemID; ?>" value="<?php echo $observation; ?>">
                    </div>

                    <div class="input-field col s6 m3 l3">
                        <label>Quantidade</label>
                        <input type="number" id="quantity<?php echo $orderItemID; ?>" value="<?php echo $quantity; ?>" <?php if ($kitchen_status == "Finalizado" || $counter_status == "Entregue") { ?> readonly <?php } ?> onchange="calcQuantityEdit('<?php echo $orderItemID; ?>')">
                    </div>

                    <div class="input-field col s6 m3 l3" hidden>
                        <input type="text" id="total<?php echo $orderItemID; ?>" value="<?php echo number_format($unitary_value, 2, ',', ''); ?>" readonly>
                        <label for="total<?php echo $orderItemID; ?>">Total Unitário</label>
                    </div>

                    <div class="input-field col s6 m3 l3">
                        <input type="text" id="totalFinal<?php echo $orderItemID; ?>" value="<?php echo number_format($totalFinal, 2, ',', ''); ?>" readonly>
                        <label for="totalFinal<?php echo $orderItemID; ?>">Total Final</label>
                    </div>

                </div>
            </div>


            <div class="col s12 m6 l6">
                <div class="row">
                    <h5 class="center">Sabores Disponíveis:</h5>

                    <?php

                    while ($rowFlavor = $listFlavor->fetch()) {
                        $flavorID = $rowFlavor->id;

                        // --- LISTAR SABORES SELECIONADOS ---
                        $selectedFlavor = "SELECT flavor_id FROM order_items_addition WHERE order_item_id = $orderItemID AND flavor_id = $flavorID ";
                        $selectedFlavor = $pdo->prepare($selectedFlavor);
                        $selectedFlavor->execute();
                        if ($rowSelectedFlavor = $selectedFlavor->fetch()) {
                            $flavorSelected = 'S';
                        } else {
                            $flavorSelected = 'N';
                        }


                    ?>


                        <div class="col s12 m12 l12">
                            <label>
                                <input type="checkbox" id="flavor<?php echo $rowFlavor->id . $orderItemID; ?>" onclick="selectFlavor('<?php echo $rowFlavor->id; ?>','<?php echo $product_id; ?>','<?php echo $orderItemID; ?>')" <?php if ($flavorSelected == 'S') { ?> checked <?php } ?> <?php if ($kitchen_status == "Finalizado" || $counter_status == "Entregue") { ?> disabled <?php } ?> />
                                <span><?php echo $rowFlavor->name; ?></span>
                            </label>
                        </div>


                    <?php } ?>
                </div>
            </div>

            <div class="col s12 m6 l6">
                <h5 class="center">Complementos Disponíveis:</h5>
                <div class="row">


                    <?php

                    while ($rowAddition = $listAddition->fetch()) {
                        $additionID = $rowAddition->id;

                        // --- LISTAR COMPLEMENTOS SELECIONADOS ---
                        $selectedAddition = "SELECT addition_id FROM order_items_addition WHERE order_item_id = $orderItemID AND addition_id = $additionID ";
                        $selectedAddition = $pdo->prepare($selectedAddition);
                        $selectedAddition->execute();
                        if ($rowSelectedAddition = $selectedAddition->fetch()) {
                            $additionSelected = 'S';
                        } else {
                            $additionSelected = 'N';
                        }

                    ?>
                        <div class="col s12 m12 l12">
                            <label>
                                <input type="checkbox" id="addition<?php echo $rowAddition->id . $orderItemID; ?>" onclick="selectAddition('<?php echo $rowAddition->id; ?>','<?php echo $product_id; ?>','<?php echo $orderItemID; ?>')" <?php if ($additionSelected == 'S') { ?> checked <?php } ?> <?php if ($kitchen_status == "Finalizado" || $counter_status == "Entregue") { ?> disabled <?php } ?> />
                                <span><?php echo $rowAddition->name; ?> - R$<?php echo number_format($rowAddition->value, 2, ',', ''); ?></span>
                            </label>
                        </div>


                    <?php } ?>



                </div>
            </div>



        </div>
    </form>




</div>
<div class="modal-footer">


    <div class="col s4 m4 l4">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat left">Fechar</a>
    </div>

    <div class="col s4 m4 l4 center">
        <a class="waves-effect waves-green btn-flat" onclick="deleteItemPDV('<?php echo $orderItemID; ?>')">Remover Item</a>
    </div>

    <div class="col s4 m4 l4">
        <a class="waves-effect waves-green btn-flat right" onclick="changeItem('<?php echo $orderItemID; ?>')">Alterar</a>
    </div>






</div>