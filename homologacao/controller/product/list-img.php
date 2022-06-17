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

$directoryName = explode('/', $_SERVER['PHP_SELF']);
$directoryName = $directoryName[1];


?>


<?php
$count = 1;
while ($rowSearchProductImg = $sqlSearchProductImg->fetch()) {
?>



        <div class="col s12 m6 l4">
            <div class="card">
                <div class="card-image">
                    <img src="../../<?php echo $_SESSION['directoryName']; ?>/uploads/productImg/<?php echo $rowSearchProductImg->img; ?>" height="200px">
                    <a class="btn-floating halfway-fab waves-effect waves-light red" onclick="deleteProductImg('<?php echo $rowSearchProductImg->id; ?>','<?php echo $rowSearchProductImg->id_product; ?>')"><i class="material-icons">delete</i></a>
                </div>
                <div class="card-content center">
                    <p>Imagem Principal?</p>
                    <p>
                    <div class="switch">
                        <label>
                            Não
                            <input type="checkbox" id="product_img<?php echo $rowSearchProductImg->id; ?>" name="product_img<?php echo $rowSearchProductImg->id; ?>" value="S" <?php if ($rowSearchProductImg->main_img == "S") { ?> checked <?php } ?> onclick="mainImg('<?php echo $rowSearchProductImg->id; ?>','<?php echo $rowSearchProductImg->id_product; ?>')">
                            <span class="lever"></span>
                            Sim
                        </label>
                    </div>
                    </p>
                </div>
            </div>
        </div>





<?php } ?>