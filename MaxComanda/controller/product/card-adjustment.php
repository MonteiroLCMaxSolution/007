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


?>

<div class="card hoverable new" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>" hidden>

    <div class="card-content">
        <div class="row">

            <form id="formNewAdjustment" method="POST">










                <div class="row">

                    <div class="input-field col s12 m6 l2">
                        <select id="typeAdjustment" name="typeAdjustment" onclick="validaFormAdjustment()" onchange="validaTypeAdjustment();validaFormAdjustment()">
                            <option value="" selected>Selecione</option>
                            <option value="Entrada">Entrada</option>
                            <option value="Saída">Saída</option>
                        </select>
                        <label>Tipo de Ajuste</label>
                        <span class="helper-text" id="msgTypeAdjustment"></span>
                    </div>

                    <div class="input-field col s12 m6 l4 providerAdjustment">
                        </br>
                        <select class="select2 browser-default" name="providerIDAdjustment" id="providerIDAdjustment" onchange="validaFormAdjustment()">
                            <option value="">Selecione o Fornecedor</option>
                            <?php while ($row = $sqlProviderAdjustment->fetch()) { ?>
                                <option value="<?php echo $row->id; ?>"><?php echo $row->name_razao_social; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="input-field col s12 m6 l3">
                        <label for="quantity" class="active">Quantidade</label>
                        <input type="number" id="quantityAdjustment" name="quantityAdjustment" onkeyup="validaFormAdjustment()" value="">
                        <span class="helper-text" id="msgQuantityAdjustment"></span>
                    </div>



                    <div class="input-field col s12 m6 l3">
                        <input type="text" id="descriptionAdjustment" name="descriptionAdjustment" value="" onkeyup="validaFormAdjustment()">
                        <label for="description">Descrição</label>
                        <span class="helper-text" id="msgDescriptionAdjustment"></span>
                    </div>

                </div> <!-- .row -->



            </form>
        </div>

        <div class="row right">
            <div class="col s1 m1 l1 left">
                <a onclick="closeNewAdjustment()" class="btn-floating red waves-effect waves-light tooltipped" data-position="left" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
            </div>

            <?php if ($ROW_Perm_Register_Products->edit == 'S') { ?>
            <div class="col s1 m1 l1 right">
                <a class="btn-floating waves-effect waves-light blue tooltipped btn" data-tooltip="Salvar" onclick="saveAdjustment('<?php echo $list_uniqID; ?>')" id="btnSaveAdjustment" disabled><i class="material-icons">done</i></a>
            </div>
            <?php } ?>


        </div>

    </div>
</div>


