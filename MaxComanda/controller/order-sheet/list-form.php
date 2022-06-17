<?php

$_SESSION['lib'] = $lib;



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

if ($ROW_Perm_Register_OrderSheet->search == 'N' && $ROW_Perm_Register_OrderSheet->include == 'N' && $ROW_Perm_Register_OrderSheet->edit == 'N') {
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

                        <div class="col s12 m4 l4 push-s4 push-l4 center">
                            <h5>Comandas Cadastradas</h5>
                        </div>
                        <?php if ($ROW_Perm_Register_OrderSheet->include == 'S') { ?>
                        <div class="col s12 m4 l4 right">
                            <a class="btn-floating waves-effect waves-light green tooltipped right" onclick="addOrderSheet()" data-tooltip="Adicionar Comanda"><i class="material-icons">add</i></a>
                        </div>
                        <?php } ?>



                    </div>


                    <script src="<?php echo $lib; ?>/lib/jquery-3.3.1.min.js"></script>
                    <script>
                        $(window).on("load", function() {
                            listOrderSheet();
                        });
                    </script>


                    <div class="row">
                        <div class="col s12">

                            <div id="listOrderSheet">

                            </div>

                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</section>