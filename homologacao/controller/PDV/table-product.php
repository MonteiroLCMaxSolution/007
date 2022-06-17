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
        $('.tooltipped').tooltip({
            inDuration: 350,
            position: 'bottom'
        });
        $('.modal-static').modal({
            dismissible: false,
        });
        M.updateTextFields();
    });
</script>
<?php

while ($rowProduct = $sqlLoadProduct->fetch()) {
    if ($rowProduct->defineStock == 'S' && $rowProduct->stock < 1) {
        continue;
    }
    $product_id = $rowProduct->id;
?>


    <div class="col s12 m4">
        <div class="card">
            <div class="card-image">
                <?php if ($rowProduct->image != "no_img") { ?>
                    <img src="../../<?php echo $_SESSION['directoryName']; ?>/uploads/productImg/<?php echo $rowProduct->image; ?>" style="max-height: 100px" class="responsive-img">
                <?php } else { ?>
                    <img src="../../../MaxComanda/uploads/no_image.png" style="max-height: 100px" class="responsive-img">
                <?php } ?>
                <a class="btn-floating halfway-fab waves-effect waves-light <?php echo $rowProduct->category_color; ?> modal-trigger" href="#modalAddProduct<?php echo $product_id; ?>" onclick="modalAddItemPDVTemp('<?php echo $product_id; ?>')"><i class="material-icons">add_shopping_cart</i></a>
            </div>
            <div class="card-content center <?php if (!empty($rowProduct->value_promotion)) { ?> yellow accent-2 <?php } ?>">
                <p><?php echo $rowProduct->name; ?></p>
                <?php if (!empty($rowProduct->value_promotion)) { ?>
                    <p><b>R$<?php echo number_format($rowProduct->value_promotion, 2, ',', ''); ?></b></p>
                <?php } else { ?>
                    <p><b>R$<?php echo number_format($rowProduct->sale_value, 2, ',', ''); ?></b></p>
                <?php } ?>



                <?php if ($rowProduct->defineStock == 'S') { ?>
                    <p>Qtde: <?php echo $rowProduct->stock; ?></p>
                <?php } else { ?>
                    <p>Qtde: - </p>
                <?php } ?>
            </div>
        </div>
    </div>




    <!-- Modal Add Item PDV -->
    <div id="modalAddProduct<?php echo $product_id; ?>" class="modal modal-static modal-fixed-footer">
        <div id="listModalAddItem<?php echo $product_id; ?>"></div>
    </div>





<?php  } ?>