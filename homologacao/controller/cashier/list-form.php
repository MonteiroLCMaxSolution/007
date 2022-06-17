<?php

if (!isset($_SESSION)) {
    session_start();
}

$directory = explode('/', $_SERVER['PHP_SELF']);
$directory = $directory[1];

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


$ConexaoMysql = $_COOKIE['server'] . '/model/cashier/cashier-model.php';
include_once($ConexaoMysql);

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
            <h2>Listar Caixas</h2>
        </div>
        <!--section-title-->
        <div class="buttons-box">
            <?php if(!empty($ROW_Perm_Register_Company->search)){
	if ($ROW_Perm_Register_Cashier->include == 'S') { ?>
                <div class="button-box-single">
                    <a href="#" onclick="addCashier()">Adicionar Caixa</a>
                </div>
                <!--button-box-single-->
            <?php } } ?>
        </div>
        <!--buttons-box-->
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                if ($listCashier->rowCount() > 0) {
                    while ($rowCashier = $listCashier->fetch()) { ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td>Caixa <?php echo $rowCashier->number_cashier; ?></td>
                        </tr>
                <?php }
                }
                ?>
            </tbody>
        </table>
    </div>
    <!--center-->
</section>
<!--list-->