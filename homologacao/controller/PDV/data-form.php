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

if ($ROW_Perm_Orders_PDV->full_permission == 'N') {
    $modalPermission = $_SERVER['DOCUMENT_ROOT'] . '/MaxComanda/view/modalPermission.php';
    include_once($modalPermission);
} else{


?>
<script src="<?php echo $lib; ?>/lib/jquery-3.3.1.min.js"></script>
<script src="<?php echo $lib; ?>/lib/jquery-mask.js"></script>
<script src="<?php echo $lib; ?>/js/<?php echo $JS; ?>/functions.js"></script>
<script src="<?php echo $lib; ?>/lib/materialize-v1.0.0/js/materialize.min.js"></script>


<script>
    $(document).ready(function() {
        loadCategory();
        verifyCashier();
        listAvailableCashier();
    });
</script>

<?php } ?>

<section>

    <div class="row">




        <div class="col s5">
            <div class="col s12" style="height: 55px">
                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <label>Caixa Aberto</label>
                        <input type="number" id="cashier" name="cashier" value="" readonly>
                    </div>
                    <div class="input-field col s12 m6 l6">
                        <label>Atendente</label>
                        <input type="text" id="userName" value="<?php echo $_SESSION['name_user']; ?>" readonly>
                    </div>

                </div>
            </div>



            <div class="card-panel hoverable col s12" style="height: 65vh; overflow-y: scroll; border-top: 3px solid <?php echo $_SESSION['color']; ?>; padding-top: 10px">



                <div class="row" style="margin-bottom: -5px; margin-top: -15px">




                    <div class="input-field col s4">
                        <label>Exibir Comanda</label>
                        <input type="number" id="orderSheet" onBlur="showOrderSheet()">
                        <span class="helper-text">TAB para Pesquisar</span>
                    </div>


                    <div class="input-field col s4">
                        <label>Exibir Mesa</label>
                        <input type="number" id="numberTable" onBlur="showTable()">
                        <span class="helper-text">TAB para Pesquisar</span>
                    </div>

                    <div class="col s2">
                        </br>
                        <a class="waves-effect waves-light btn tooltipped" data-tooltip="Imprimir" onclick="print()">
                            <i class="material-icons">print</i>
                        </a>
                    </div>

                    <div class="col s2">
                        </br>
                        <a class="waves-effect waves-light btn red tooltipped modal-trigger" href="#modalWithdraw" data-tooltip="Retirar Dinheiro do Caixa" onclick="listAvailableCashierWithdraw()">
                            <i class="material-icons">attach_money</i>
                        </a>
                    </div>










                </div>

                <div id="listPDV" class="col s12 m12 l12">
                    <h6 class="center">Escolha uma Categoria e Selecione um Produto -></h6>
                </div>



            </div>
            <div style="margin-top:-5px">
                <div class="row">
                    <div class="col s4 left">
                        <a class="waves-effect waves-light btn-large red left" onclick="modalCloseCashier()">
                            Fechar Caixa
                        </a>
                    </div>

                    <div class="col s4 center">
                        <a class=" waves-effect waves-light btn-large blue center" href="?pg=PDV">
                            Novo Pedido
                        </a>
                    </div>


                    <div class="col s4 right">
                        <a class=" waves-effect waves-light btn-large green right" disabled id="btnModalCloseOrder" onclick="modalCloseOrder()">
                            Finalizar
                        </a>
                    </div>
                </div>
            </div>




        </div>

        <div class="col s7 right">
            <div class="card-panel hoverable" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>; padding: 5px">
                <div class="row" style="margin-bottom: -5px">
                    <div id="listCategory"></div>
                </div>
            </div>
        </div>





        <div class="col s7 right" style="height: 50vh; overflow-y: scroll">
            <div id="listProduct"></div>
        </div>


    </div>
</section>


<!-- Modal Caixa Aberto -->
<div id="modalCloseCashier" class="modal modal-static modal-fixed-footer">
    <div id="closeCashier"></div>
</div>



<!-- Modal Abrir Caixa -->
<div id="modalOpenCashier" class="modal modal-static modal-fixed-footer">
    <div id="openCashier"></div>
</div>

<!-- Modal Fechar Pedido -->
<div id="modalCloseOrder" class="modal modal-fixed-footer modal-static">
    <div id="closeOrder"></div>
</div>

<!-- Modal Retirar Dinheiro -->
<div id="modalWithdraw" class="modal modal-fixed-footer">
    <div id="withdraw"></div>
</div>