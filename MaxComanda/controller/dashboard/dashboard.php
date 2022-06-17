<?php

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
<section>
    <div class="row">

        <?php if ($ROW_Perm_Orders_PDV->search == 'S' || $ROW_Perm_Orders_PDV->include == 'S' || $ROW_Perm_Orders_PDV->edit == 'S') { ?>
            <div class="col s12 m6 l4">

                <a class="waves-effect waves-light btn-large orange" href="?pg=PDV" style="width: 100%; margin-bottom: 5px">
                    PDV
                </a>

            </div> <!-- /.col -->
        <?php } ?>

        <?php if ($ROW_Perm_Monitor_Table->search == 'S' || $ROW_Perm_Monitor_Table->include == 'S' || $ROW_Perm_Monitor_Table->edit == 'S') { ?>
            <div class="col s12 m6 l4">
                <a class="waves-effect waves-light btn-large blue" href="?pg=order-table" style="width: 100%; margin-bottom: 5px">
                    Pedidos - Mesa
                </a>
            </div> <!-- /.col -->
        <?php } ?>

        <?php if ($ROW_Perm_Monitor_Kitchen->search == 'S' || $ROW_Perm_Monitor_Kitchen->include == 'S' || $ROW_Perm_Monitor_Kitchen->edit == 'S') { ?>
            <div class="col s12 m6 l4">
                <a class="waves-effect waves-light btn-large purple" href="?pg=order-kitchen" style="width: 100%; margin-bottom: 5px">
                    Pedidos - Cozinha
                </a>
            </div> <!-- /.col -->
        <?php } ?>

        <?php if ($ROW_Perm_Monitor_Counter->search == 'S' || $ROW_Perm_Monitor_Counter->include == 'S' || $ROW_Perm_Monitor_Counter->edit == 'S') { ?>
            <div class="col s12 m6 l4">
                <a class="waves-effect waves-light btn-large gray" href="?pg=order-counter" style="width: 100%; margin-bottom: 5px">
                    Pedidos - Balcão
                </a>
            </div> <!-- /.col -->
        <?php } ?>

        <?php if ($ROW_Perm_Register_Products->search == 'S' || $ROW_Perm_Register_Products->include == 'S' || $ROW_Perm_Register_Products->edit == 'S') { ?>
            <div class="col s12 m6 l4">
                <a class="waves-effect waves-light btn-large green" href="?pg=product" style="width: 100%; margin-bottom: 5px">
                    Cadastro de Produtos
                </a>
            </div> <!-- /.col -->
        <?php } ?>

    </div> <!-- /.row -->
</section>