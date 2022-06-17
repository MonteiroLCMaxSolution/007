<?php

$_SESSION['lib'] = $lib;
$_SESSION['directoryName'] = $directoryName;



$ModelCashier = 'MaxComanda/model/cashier/cashier-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelCashier)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelCashier = $tag . $ModelCashier;
include_once($ModelCashier);


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

if ($ROW_Perm_Register_Cashier->search == 'N' && $ROW_Perm_Register_Cashier->include == 'N' && $ROW_Perm_Register_Cashier->edit == 'N') {
    $modalPermission = $_SERVER['DOCUMENT_ROOT'] . '/MaxComanda/view/modalPermission.php';
    include_once($modalPermission);
}


?>
<section>
    <nav style="max-height: 37px; line-height: 30px; background-color: <?php echo $_SESSION['color']; ?>">
        <div class="container">
            <div class="center pageBreadcrumb">
                <a href="index.php" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Home</a>
                <a href="#" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>"><?php echo $pageName; ?></a>
            </div>
        </div>
    </nav>
</section>

<section>
    <div class="row">
        <div class="col s12">
            <div class="card hoverable" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">



                <div class="card-content">
                <?php if ($ROW_Perm_Register_Cashier->include == 'S') { ?>
                    <div class="row">
                        <div class="col s12 m12 l12 right">
                            <a class="btn-floating waves-effect waves-light green tooltipped right" data-tooltip="Adicionar Caixa" onclick="addCashier()"><i class="material-icons">add</i></a>
                        </div>
                    </div>
                    <?php } ?>


                    <div class="row">
                        <div class="col s12">

                            <table class="highlight centered responsive-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $count = 1;
                                    while ($rowCashier = $listCashier->fetch()) { ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td>Caixa <?php echo $rowCashier->id; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</section>








<!-- Modal QRCode -->
<div id="modalQRCodeMenu" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4 class="center">QR Code - Cardápio</h4>


        <?php

        $qrTable = "$lib/lib/qrcode/php/qr_img.php/?";
        $qrTable .= "e=H&";
        $qrTable .= "s=6&";
        $qrTable .= "t=P&";
        $qrTable .= "d=www.maxcomanda.com.br/$directoryName/cardapio/index.php";

        ?>

        <div class="center">
            <img src="<?php echo $qrTable; ?>">
        </div>


    </div>
    <div class="modal-footer">
        <a href="<?php echo $qrTable; ?>" class="waves-effect waves-green btn blue" download>Baixar QR Code</a>
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
    </div>
</div>