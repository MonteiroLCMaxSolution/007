<?php
require_once('../../functions.php');
if ($retorno != array()) {
?>
    <div class="form-group">
        <label class="control-label" for="category_id">
            ID da categoria
        </label>
        <select class="form-control required formCategory" id="category_id" name="category_id" onchange="validaForm();getFormCategory()">
            <?php

            foreach ($retorno as $key => $value) {
                $categoryID = $retorno[$key]['category_id'];
                $categoryName = $retorno[$key]['category_name'];
                $domainName = $retorno[$key]['domain_name'];
            ?>


                <option value="<?php echo $categoryID; ?>"><?php echo $categoryID . " - " . $domainName . " > " . $categoryName; ?></option>


            <?php } ?>

        </select>


        <small id="catHelp" class="form-text text-muted">
            Escolha a sua categoria em https://api.mercadolibre.com/sites/MLB/categories
        </small>
    </div>
<?php } else { ?>
    <h5 clas="text-center">Não encontramos Categorias relacionadas a este título de Anúncio. Por favor, digite outro título para procurar Sugestões!</h5>
    <input class="required" id="category_id" name="category_id" value="" hidden>
<?php } ?>