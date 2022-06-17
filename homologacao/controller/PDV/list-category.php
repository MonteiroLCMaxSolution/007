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
<div class="input-field col s12 center" style="margin-top:5px">
    <label for="productName">Digite o Nome do Produto</label>
    <input id="productName" type="text" onblur="searchProduct()">
    <span class="helper-text">TAB para Pesquisar</span>
</div>


<div class="col s12 center">
    <div class="row" style="margin-bottom: 5px;height: 13vh; overflow-y: scroll">
        <?php while ($rowCategory = $sqlLoadCategory->fetch()) { ?>
            <div class="col s4 center">
                <a class="waves-effect waves-light btn-small <?php echo $rowCategory->color; ?> btnCategory" onclick="listProductCategory('<?php echo $rowCategory->id; ?>')" style="margin: 3px"><?php echo $rowCategory->name; ?></a>
            </div>

        <?php } ?>
    </div>
</div>