<?php

$ModelPromotion = 'MaxComanda/model/promotion/promotion-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelPromotion)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelPromotion = $tag . $ModelPromotion;
include_once($ModelPromotion);

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

if ($ROW_Perm_Register_Promotion->search == 'N' && $ROW_Perm_Register_Promotion->include == 'N' && $ROW_Perm_Register_Promotion->edit == 'N') {
    $modalPermission = $_SERVER['DOCUMENT_ROOT'] . '/MaxComanda/view/modalPermission.php';
    include_once($modalPermission);
}

?>

<section>
    <nav style="max-height: 37px; line-height: 30px; background-color: <?php echo $_SESSION['color']; ?>">
        <div class="container">
            <div class=" center pageBreadcrumb">
                <a href="index.php" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Home</a>
                <a href="?pg=promotion" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Listar Promoções</a>
                <a href="#" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>"><?php echo $pageName; ?></a>
            </div>
        </div>
    </nav>
</section>

<section>
    <div class="row">
        <div class="col s12">
            <div class="card hoverable" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">

                <div class="container">
                    <form id="formPromotion" method="POST">
                        <div class="row">
                            <div class="input-field col s4 m2 l2">
                                <input id="id" name="id" type="text" readonly value="<?php echo $list_id; ?>">
                                <label for="id">ID</label>
                            </div>

                            <div class="input-field col s8 m4 l4">
                                </br>
                                <select class="select2 browser-default" name="product" id="product" onchange="searchOldValue();validaForm()">
                                    <?php if(!empty($list_product_id)) { ?>
                                        <option value="<?php echo $list_product_id; ?>"><?php echo $list_product_name; ?></option>
                                        <?php } ?>
                                    <option value="">Selecione o produto</option>
                                    <?php while ($row = $SQL_list_products->fetch()) { ?>
                                        <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="input-field col s6 m3 l3">
                                <label for="name" class="active" id="lOldValue">Preço Atual</label>
                                <input type="text" id="old_value" name="old_value" readonly class="money" value="<?php echo $list_old_value; ?>">
                                <span class="helper-text" id="msgOldValue"></span>
                            </div>

                            <div class="input-field col s6 m3 l3">
                                <label for="name" class="active" id="lNewValue">Novo Preço</label>
                                <input type="text" id="new_value" name="new_value" class="money" value="<?php echo $list_new_value; ?>" onkeyup="validaForm()">
                                <span class="helper-text" id="msgNewValue"></span>
                            </div>

                            <div class="input-field col s12 m3 l3">
                            <label for="start_date" class="active">Data - Início</label>
                            <input type="text" class="datepicker" id="start_date" name="start_date" value="<?php if (isset($list_start_date) && $list_start_date != 0) {echo date("d/m/Y", strtotime($list_start_date));}  ?>" onchange="validaForm()">
                            <span class="helper-text" id="msgStartDate"></span>
                        </div>

                        <div class="input-field col s12 m3 l3">
                            <label for="end_date" class="active">Data - Fim</label>
                            <input type="text" class="datepicker" id="end_date" name="end_date" value="<?php if (isset($list_end_date) && $list_end_date != 0) {echo date("d/m/Y", strtotime($list_end_date));}  ?>" onchange="validaForm()">
                            <span class="helper-text" id="msgEndDate"></span>
                        </div>

                            <div class="input-field col s12 m6 l6">
                                <select id="status" name="status" onclick="validaForm()">
                                    <?php if (!empty($list_status)) { ?>
                                        <option value="<?php echo $list_status; ?>"><?php echo $list_status; ?></option>
                                    <?php } ?>
                                    <option value="Ativo">Ativo</option>
                                    <option value="Inativo">Inativo</option>
                                </select>
                                <label>Status</label>
                                <span class="helper-text" id="msgStatus"></span>
                            </div>

                        </div> <!-- .row -->

                        <div class="row">

                            <div class="input-field col s6 m6 l6">
                                <label for="date_register" class="active">Data Cadastro</label>
                                <input type="text" id="date_register" name="date_register" onkeyup="validaForm()" value="<?php if (isset($list_date_register) && $list_date_register != 0) {echo date("d/m/Y H:i:s", strtotime($list_date_register));}  ?>" readonly>
                            </div>

                            <div class="input-field col s6 m6 l6">
                                <label for="user_register" class="active">Usuário Cadastro</label>
                                <input type="text" id="user_register" name="user_register" onkeyup="validaForm()" value="<?php echo $list_user_register;  ?>" readonly>
                            </div>


                        </div> <!-- .row -->


                    </form>
                </div> <!-- .container -->


            </div> <!-- .card -->
        </div> <!-- .col -->
    </div> <!-- .row -->
</section>


<div class="fixed-action-btn">
    <a class="btn-floating btn-large green" onclick="validaForm()">
        <i class="large material-icons">mode_edit</i>
    </a>
    <ul>
        <li><a href="?pg=promotion" class="btn-floating red waves-effect waves-light tooltipped" data-position="left" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a></li>


        <?php if ((isset($_GET['idPromotion']) && $ROW_Perm_Register_Promotion->edit == 'S') || (!isset($_GET['idPromotion']) && $ROW_Perm_Register_Promotion->include == 'S')) { ?>

        <li><a class="btn-floating blue waves-effect waves-light tooltipped" data-position="left" data-tooltip="Salvar" id="btnSavePromotion" disabled onclick="savePromotion()"><i class="material-icons">done</i></a></li>

        <?php } ?>


    </ul>
</div>