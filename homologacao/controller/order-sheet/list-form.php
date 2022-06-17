<?php
if (!isset($_SESSION)) {
    session_start();
}

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


$orderSheetModel = $_COOKIE['server'] . '/model/order-sheet/order-sheet-model.php';
include_once($orderSheetModel);

$ModelUserPermission = $_COOKIE['server'] . '/model/permission/user-permission.php';
include_once($ModelUserPermission);

if(!empty($ROW_Perm_Register_Company->search)){
if ($ROW_Perm_Register_Cashier->search == 'N' && $ROW_Perm_Register_Cashier->include == 'N' && $ROW_Perm_Register_Cashier->edit == 'N') {
    $modalPermission = $_COOKIE['server'] . '/view/modalPermission.php';
    include_once($modalPermission);
}
}


?>



<section class="list">
    <div class="center">
        <div class="section-title">
            <h2>Listar Comandas</h2>
        </div>
        <!--section-title-->
        <div class="buttons-box">
            <div class="button-box-single">
                <?php if(!empty($ROW_Perm_Register_Company->search)){
	if ($ROW_Perm_Register_OrderSheet->include == 'S') { ?>
                    <a onclick="addOrderSheet()">Adicionar</a>
                <?php }
}?>
            </div>
            <!--button-box-single-->
        </div>
        <!--buttons-box-->


        <div id="listOrderSheet">
            <?php include_once("table.php"); ?>
        </div>


    </div>
    <!--center-->
</section>
<!--list-->