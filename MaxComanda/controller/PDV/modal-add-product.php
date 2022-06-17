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
    <input type="text" class="idOrderItem<?php echo $product_id; ?>" hidden>
    <input type="number" class="selectedFlavor<?php echo $product_id; ?>" value="0" hidden>
    <input type="number" class="fraction<?php echo $product_id; ?>" value="<?php echo $product_fraction; ?>" hidden>


    <div class="row">

        <div class="col s12 m12 l12">
            <div class="row">

                <div class="input-field col s12 m6 l6">
                    <input class="observation<?php echo $product_id; ?>" type="text">
                    <label for="observation<?php echo $product_id; ?>">Observações</label>
                </div>

                <div class="input-field col s6 m3 l3">
                    <input class="quantity<?php echo $product_id; ?>" type="number" value="1" onchange="calcQuantity('<?php echo $product_id; ?>')">
                    <label for="quantity<?php echo $product_id; ?>">Quantidade</label>
                </div>

                <div class="input-field col s6 m3 l3" hidden>
                    <input type="text" class="total<?php echo $product_id; ?>" value="<?php echo number_format($sale_value, 2, ',', ''); ?>" readonly>
                    <label for="total<?php echo $product_id; ?>">Total Unitário</label>
                </div>

                <div class="input-field col s6 m3 l3">
                    <input type="text" class="totalFinal<?php echo $product_id; ?>" value="<?php echo number_format($sale_value, 2, ',', ''); ?>" readonly>
                    <label for="total<?php echo $product_id; ?>">Total Final</label>
                </div>

            </div>
        </div>


        <div class="col s12 m6 l6">
            <div class="row">
                <h5 class="center">Sabores Disponíveis:</h5>
                <?php if ($product_fraction > 0) { ?>
                    <p class="center">Escolha até <?php echo $product_fraction; ?> Sabor(es)</p>
                <?php } ?>

                <?php
                while ($rowFlavor = $listFlavor->fetch()) {
                ?>
                    <div class="col s12 m12 l12">
                        <label>
                            <input type="checkbox" class="flavor<?php echo $rowFlavor->id; ?>" value="<?php echo $rowFlavor->id; ?>" onclick="selectFlavorNew('<?php echo $product_id; ?>','<?php echo $rowFlavor->id; ?>')" name="flavor<?php echo $product_id; ?>[]" />
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
                ?>
                    <div class="col s12 m12 l12">
                        <label>
                            <input type="checkbox" class="addition<?php echo $rowAddition->id; ?>" value="<?php echo $rowAddition->id; ?>" onclick="selectAdditionNew('<?php echo $rowAddition->id; ?>','<?php echo $product_id; ?>')" name="addition<?php echo $product_id; ?>[]" />

                            <span><?php echo $rowAddition->name; ?> - R$<?php echo number_format($rowAddition->value, 2, ',', ''); ?></span>
                        </label>
                        <input type="text" class="additionValue<?php echo $rowAddition->id; ?>" value="<?php echo number_format($rowAddition->value, 2, ',', ''); ?>" hidden>
                    </div>


                <?php } ?>



            </div>
        </div>




    </div> <!-- /.row -->


</div>
<div class="modal-footer">
    <a class="modal-close waves-effect waves-green btn-flat left" onclick="">Cancelar</a>

    <a class="waves-effect waves-green btn-flat right" onclick="addItemPDV('<?php echo $product_id; ?>')" id="btnAddItemPDV<?php echo $product_id; ?>">Salvar</a>
</div>