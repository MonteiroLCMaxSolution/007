<?php

$_SESSION['lib'] = $lib;
$_SESSION['directoryName'] = $directoryName;



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

if ($ROW_Perm_Register_Table->search == 'N' && $ROW_Perm_Register_Table->include == 'N' && $ROW_Perm_Register_Table->edit == 'N') {
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
                    <div class="row">
                        <div class="col s12 m4 l4 left">
                            <a class="waves-effect waves-light btn modal-trigger blue tooltipped" data-tooltip="Gerar QR Code" href="#modalQRCodeMenu">
                                QR Code - Cardápio
                            </a>
                        </div>

                        <div class="col s12 m4 l4 center">
                            <h5>Mesas Cadastradas</h5>
                        </div>

                        <?php if ($ROW_Perm_Register_Table->include == 'S') { ?>
                            <div class="col s12 m4 l4 right">
                                <a href="?pg=data-table" class="btn-floating waves-effect waves-light green tooltipped right" data-tooltip="Adicionar Mesa"><i class="material-icons">add</i></a>
                            </div>
                        <?php } ?>



                    </div>



                    <script src="<?php echo $lib; ?>/lib/jquery-3.3.1.min.js"></script>
                    <script>
                        $(window).on("load", function() {
                            listTable();
                        });
                    </script>


                    <div class="row">
                        <div class="col s12">

                            <div id="listTable">

                            </div>

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
        $qrTable .= "d=www.maxcomanda.com.br/$directoryName/view/?pg=cardapio";

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