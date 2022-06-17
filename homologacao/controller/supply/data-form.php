<?php

$ModelSupply = 'MaxComanda/model/supply/supply-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelSupply)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelSupply = $tag . $ModelSupply;
include_once($ModelSupply);


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

if ($ROW_Perm_Register_Supply->search == 'N' && $ROW_Perm_Register_Supply->include == 'N' && $ROW_Perm_Register_Supply->edit == 'N') {
    $modalPermission = $_SERVER['DOCUMENT_ROOT'] . '/MaxComanda/view/modalPermission.php';
    include_once($modalPermission);
}


?>
<section>
    <nav style="max-height: 37px; line-height: 30px; background-color: <?php echo $_SESSION['color']; ?>">
        <div class="container">
            <div class=" center pageBreadcrumb">
                <a href="index.php" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Home</a>
                <a href="?pg=supply" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Listar Suprimentos</a>
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






                    <div class="row">
                        <div class="col s12">
                            <ul class="tabs">
                                <li class="tab col s6 m6 l6" onclick="validaForm();showBtn()"><a class="active" href="#principais" id="tab-principais" style="color: black">Informações Principais</a></li>
                                <?php if (isset($_GET['idSupply'])) { ?>
                                    <li class="tab col s6 m6 l6" onclick="validaForm();validaTypeAdjustment();hideBtn()"><a href="#stock" id="tab-stock" style="color: black">Estoque</a></li>
                                <?php } ?>
                            </ul>
                        </div>

                        <!-- --- INFORMAÇÕES PRINCIPAIS --- -->
                        <div id="principais" class="col s12 tab-principais">
                            <div class="row">
                                <form id="formSupply" enctype="multipart/form-data" method="POST">

                                    <div class="col s12 m12 l12 center">





                                        <div class="input-field col s12 m3 l3">
                                            <input id="id" name="id" type="text" readonly value="<?php echo $list_id; ?>">
                                            <label for="id">ID</label>
                                        </div>



                                        <div class="input-field col s12 m6 l9">
                                            <label for="name" class="active">Nome</label>
                                            <input type="text" id="name" name="name" onkeyup="validaForm()" value="<?php echo $list_name; ?>">
                                            <span class="helper-text" id="msgName"></span>
                                        </div>

                                        <div class="input-field col s12 m4 l4">
                                            <label for="cost_value" class="active">Preço de Custo</label>
                                            <input type="text" id="cost_value" name="cost_value" class="money" onkeyup="validaForm()" value="<?php echo $list_cost_value; ?>">
                                            <span class="helper-text" id="msgCostValue"></span>
                                        </div>


                                        <div class="input-field col s12 m4 l4">
                                            <label for="quantity" class="active">Quantidade Disponível</label>
                                            <input type="number" id="quantity" name="quantity" onkeyup="validaForm()" value="<?php echo $list_quantity; ?>" readonly>
                                            <span class="helper-text" id="msgQuantity"></span>
                                        </div>

                                        <div class="input-field col s12 m4 l4">
                                            <label for="minimum_stock" class="active">Estoque Mínimo</label>
                                            <input type="number" id="minimum_stock" name="minimum_stock" onkeyup="validaForm()" value="<?php echo $list_minimum_stock; ?>">
                                            <span class="helper-text" id="msgMinimumStock"></span>
                                        </div>


                                    </div>

                                </form>
                            </div> <!-- .row -->
                        </div> <!-- .informações principais -->

                        <!-- --- ESTOQUE --- -->
                        <div id="stock" class="col s12 tab-stock">
                            <div class="row">


                                <?php if (isset($_GET['idSupply'])) { ?>
                                    <h5 class="center">Movimentações de Estoque</h5>

                                    <div class="col s12">
                                        <div class="card hoverable search" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">

                                        <div class="card-content">
                                                <div class="row">

                                                    <form id="formSearchAdjustment" method="POST">

                                                        <div class="input-field col s12 m6 l2">
                                                            <select id="type" name="type" onchange="validaTypeAdjustment()">
                                                                <option value="" selected>Todos</option>
                                                                <option value="Entrada">Entrada</option>
                                                                <option value="Saída">Saída</option>
                                                            </select>
                                                            <label>Tipo de Ajuste</label>
                                                        </div>

                                                        <div class="input-field col s12 m6 l3 provider">
                                                            </br>
                                                            <select class="select2 browser-default" name="providerID" id="providerID">
                                                                <option value="">Selecione o Fornecedor</option>
                                                                <?php while ($row = $sqlProvider->fetch()) { ?>
                                                                    <option value="<?php echo $row->id; ?>"><?php echo $row->name_razao_social; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                        <div class="input-field col s12 m6 l3">
                                                            <input type="text" class="datepicker" id="registerStart" name="registerStart">
                                                            <label for="registerStart">Data (Início)</label>
                                                        </div>

                                                        <div class="input-field col s12 m6 l3">
                                                            <input type="text" class="datepicker" id="registerEnd" name="registerEnd">
                                                            <label for="registerEnd">Data (Fim)</label>
                                                        </div>




                                                        <div class="col s2 m1 l1 center">
                                                            <br />
                                                            <a class="btn-floating waves-effect waves-light blue tooltipped" data-tooltip="Pesquisar" onclick="searchAdjustment('<?php echo $list_uniqID; ?>')"><i class="material-icons">search</i></a>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>

                                            <?php if ($ROW_Perm_Register_Supply->edit == 'S') { ?>

                                            <a class="btn-floating halfway-fab waves-effect waves-light green tooltipped btn" data-tooltip="Adicionar" onclick="openNewAdjustment();validaTypeAdjustment();validaFormAdjustment()"><i class="material-icons">add</i></a>

                                            <?php } ?>

                                        </div>
                                        <?php include_once('card-adjustment.php'); ?>
                                    </div>


                                    <div class="col s12">
                                        <div class="card-panel hoverable" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">
                                            <div id="listAdjustment"></div>
                                        </div>
                                    </div>



                                <?php } ?>

                            </div> <!-- .row -->
                        </div> <!-- .stock -->

                    </div> <!-- .row -->


                </div> <!-- .container -->


            </div> <!-- .card -->

        </div> <!-- .col -->
    </div> <!-- .row -->
</section>


<section>
    <div class="row">
        <div class="col s12">
            <div class="card hoverable" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">

                <div class="container">

                    <div class="row">

                        <div class="input-field col s6 m6 l3">
                            <label for="date_register" class="active">Data Cadastro</label>
                            <input type="text" id="date_register" name="date_register" onkeyup="validaForm()" value="<?php if (isset($list_date_register) && $list_date_register != 0) {
                                                                                                                            echo date("d/m/Y H:i:s", strtotime($list_date_register));
                                                                                                                        }  ?>" readonly>
                        </div>

                        <div class="input-field col s6 m6 l3">
                            <label for="user_register" class="active">Usuário Cadastro</label>
                            <input type="text" id="user_register" name="user_register" onkeyup="validaForm()" value="<?php echo $list_user_register;  ?>" readonly>
                        </div>

                        <div class="input-field col s6 m6 l3">
                            <label for="last_update" class="active">Última Atualização</label>
                            <input type="text" id="last_update" name="last_update" onkeyup="validaForm()" value="<?php if (isset($list_last_update) && $list_last_update != 0) {
                                                                                                                        echo date("d/m/Y H:i:s", strtotime($list_last_update));
                                                                                                                    } ?>" readonly>
                        </div>

                        <div class="input-field col s6 m6 l3">
                            <label for="user_update" class="active">Usuário Última Atualização</label>
                            <input type="text" id="user_update" name="user_update" onkeyup="validaForm()" value="<?php echo $list_user_update; ?>" readonly>
                        </div>

                    </div> <!-- .row -->

                </div> <!-- .container -->
            </div> <!-- .card -->
        </div> <!-- .col -->
    </div> <!-- .row -->
</section>

<div class="fixed-action-btn actionBtn">
    <a class="btn-floating btn-large green" onclick="validaForm()">
        <i class="large material-icons">mode_edit</i>
    </a>
    <ul>
        <li><a href="?pg=supply" class="btn-floating red waves-effect waves-light tooltipped" data-position="left" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a></li>

        <?php if ((isset($_GET['idSupply']) && $ROW_Perm_Register_Supply->edit == 'S') || (!isset($_GET['idSupply']) && $ROW_Perm_Register_Supply->include == 'S')) { ?>

        <li><a class="btn-floating blue waves-effect waves-light tooltipped" data-position="left" data-tooltip="Salvar" id="btnSaveSupply" disabled onclick="saveSupply()"><i class="material-icons">done</i></a></li>

        <?php } ?>


    </ul>
</div>

