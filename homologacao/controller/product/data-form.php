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

if ($ROW_Perm_Register_Products->search == 'N' && $ROW_Perm_Register_Products->include == 'N' && $ROW_Perm_Register_Products->edit == 'N') {
    $modalPermission = $_SERVER['DOCUMENT_ROOT'] . '/MaxComanda/view/modalPermission.php';
    include_once($modalPermission);
}


?>
<section>
    <nav style="max-height: 37px; line-height: 30px; background-color: <?php echo $_SESSION['color']; ?>">
        <div class="container">
            <div class=" center pageBreadcrumb">
                <a href="index.php" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Home</a>
                <a href="?pg=product" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Listar Produtos</a>
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
                                <li class="tab col s4 m4 l4" onclick="validaForm();showBtn()"><a class="active" href="#principais" id="tab-principais" style="color: black">Informações Principais</a></li>
                                <?php if (isset($_GET['idProduct'])) { ?>
                                    <li class="tab col s4 m4 l4" onclick="validaForm();listProductImg('<?php echo $list_id; ?>');hideBtn()"><a href="#images" id="tab-images" style="color: black">Imagens</a></li>

                                    <li class="tab col s4 m4 l4" onclick="validaForm();validaTypeAdjustment();hideBtn()"><a href="#stock" id="tab-stock" style="color: black">Estoque</a></li>
                                <?php } ?>
                            </ul>
                        </div>

                        <!-- --- INFORMAÇÕES PRINCIPAIS --- -->
                        <div id="principais" class="col s12 tab-principais">
                            <div class="row">
                                <form id="formProduct" enctype="multipart/form-data" method="POST">



                                    <?php if (!empty($list_img)) { ?>
                                        <div class="col s12 m5 l4 center">
                                            <div class="card">
                                                <div class="card-image">
                                                    <img src="../../<?php echo $_SESSION['directoryName']; ?>/uploads/productImg/<?php echo $list_img; ?>" height="250px">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 m7 l8 center">
                                        <?php } else { ?>
                                            <div class="col s12 m12 l12 center">
                                            <?php } ?>




                                            <div class="input-field col s4 m2 l3">
                                                <input id="id" name="id" type="text" readonly value="<?php echo $list_id; ?>">
                                                <label for="id">ID</label>
                                            </div>

                                            <div class="input-field col s8 m5 l4">
                                                <select id="location" name="location" onchange="validaForm()">
                                                    <?php if (isset($_GET['idProduct'])) { ?>
                                                        <option value="<?php echo $list_location_id; ?>"><?php echo $list_location_name; ?></option>
                                                    <?php } ?>
                                                    <option value="">Selecione</option>
                                                    <?php while ($rowLocation = $sqlLocation->fetch()) { ?>
                                                        <option value="<?php echo $rowLocation->id; ?>"><?php echo $rowLocation->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label>Local</label>
                                                <span class="helper-text" id="msgLocation"></span>
                                            </div>

                                            <div class="input-field col s12 m5 l5">
                                                <select id="subcategory" name="subcategory" onchange="validaForm()">
                                                    <?php if (isset($_GET['idProduct'])) { ?>
                                                        <option value="<?php echo $list_subcategory_id; ?>" selected><?php echo $list_subcategory_name; ?></option>
                                                    <?php } ?>
                                                    <option value="">Selecione</option>
                                                    <?php while ($rowSubcategory = $sqlSubcategory->fetch()) { ?>
                                                        <option value="<?php echo $rowSubcategory->id; ?>"><?php echo $rowSubcategory->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label>SubCategoria</label>
                                                <span class="helper-text" id="msgSubcategory"></span>
                                            </div>


                                            <div class="input-field col s12 m5 l6">
                                                <label for="name" class="active">Nome</label>
                                                <input type="text" id="name" name="name" onkeyup="validaForm()" value="<?php echo $list_name; ?>" data-length="30" class="count" maxlength="30">
                                                <span class="helper-text" id="msgName"></span>
                                            </div>

                                            <div class="col s6 m1 l2">
                                                <label class="active">Status</label>
                                                <div class="switch">
                                                    <label>
                                                        Inativo
                                                        <input type="checkbox" id="status" name="status" value="Ativo" <?php if ($list_status == "Ativo" || !isset($_GET['idProduct'])) { ?> checked <?php } ?> onclick="validaForm()">
                                                        <span class="lever"></span>
                                                        Ativo
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="input-field col s6 m3 l2">
                                                <label for="sale_value" class="active">Preço de Venda</label>
                                                <input type="text" id="sale_value" name="sale_value" class="money" onkeyup="validaForm()" value="<?php echo $list_sale_value; ?>">
                                                <span class="helper-text" id="msgSaleValue"></span>
                                            </div>

                                            <div class="input-field col s6 m3 l2">
                                                <label for="cost_value" class="active">Preço de Custo</label>
                                                <input type="text" id="cost_value" name="cost_value" class="money" onkeyup="validaForm()" value="<?php echo $list_cost_value; ?>">
                                                <span class="helper-text" id="msgCostValue"></span>
                                            </div>

                                            <div class="col s6 m4 l4">
                                                <label class="active">Definir Estoque?</label>
                                                <div class="switch">
                                                    <label>
                                                        Não
                                                        <input type="checkbox" id="defineStock" name="defineStock" value="S" <?php if ($list_defineStock == "S" || !isset($_GET['idProduct'])) { ?> checked <?php } ?> onclick="validaForm()">
                                                        <span class="lever"></span>
                                                        Sim
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="input-field col s6 m4 l4 stock">
                                                <label for="quantity" class="active">Quantidade Disponível</label>
                                                <input type="number" id="quantity" name="quantity" onkeyup="validaForm()" value="<?php echo $list_quantity; ?>" readonly>
                                                <span class="helper-text" id="msgQuantity"></span>
                                            </div>

                                            <div class="input-field col s6 m4 l4 stock">
                                                <label for="minimum_stock" class="active">Estoque Mínimo</label>
                                                <input type="number" id="minimum_stock" name="minimum_stock" onkeyup="validaForm()" value="<?php echo $list_minimum_stock; ?>">
                                                <span class="helper-text" id="msgMinimumStock"></span>
                                            </div>


                                            </div>

                                            <?php if (!empty($list_img)) { ?>

                                                <div class="col s12 m7 l8 right">

                                                <?php } else { ?>
                                                    <div class="col s12 m12 l12 center">
                                                    <?php } ?>

                                                    <div class="col s6 m6 l4 center">
                                                        <label>
                                                            <input type="checkbox" <?php if ($list_local_menu == "S" || !isset($_GET['idProduct'])) { ?> checked <?php } ?> id="local_menu" name="local_menu" value="S" onclick="validaForm()" />
                                                            <span>Inserir no Cardápio Local?</span>
                                                        </label>
                                                    </div>

                                                    <div class="col s6 m6 l4 center">
                                                        <label>
                                                            <input type="checkbox" <?php if ($list_online_menu == "S" || !isset($_GET['idProduct'])) { ?> checked <?php } ?> id="online_menu" name="online_menu" value="S" onclick="validaForm()" />
                                                            <span>Inserir no Cardápio Delivery?</span>
                                                        </label>
                                                    </div>

                                                    <div class="col s6 m6 l4 center" style="margin-top: -10px">
                                                        <label class="active">Vai para a Cozinha?</label>
                                                        <div class="switch">
                                                            <label>
                                                                Não
                                                                <input type="checkbox" id="kitchen" name="kitchen" value="S" <?php if ($list_kitchen == "S") { ?> checked <?php } ?> onclick="validaForm()">
                                                                <span class="lever"></span>
                                                                Sim
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col s6 m6 l4">
                                                        </br>
                                                        <label>
                                                            <input type="checkbox" <?php if ($list_morning == "S" || !isset($_GET['idProduct'])) { ?> checked <?php } ?> id="morning" name="morning" value="S" onclick="validaForm()" />
                                                            <span>Servir de Manhã</span>
                                                        </label>
                                                    </div>

                                                    <div class="col s6 m6 l4">
                                                        </br>
                                                        <label>
                                                            <input type="checkbox" <?php if ($list_afternoon == "S" || !isset($_GET['idProduct'])) { ?> checked <?php } ?> id="afternoon" name="afternoon" value="S" onclick="validaForm()" />
                                                            <span>Servir à Tarde</span>
                                                        </label>
                                                    </div>

                                                    <div class="col s6 m6 l4">
                                                        </br>
                                                        <label>
                                                            <input type="checkbox" <?php if ($list_night == "S" || !isset($_GET['idProduct'])) { ?> checked <?php } ?> id="night" name="night" value="S" onclick="validaForm()" />
                                                            <span>Servir à Noite</span>
                                                        </label>
                                                    </div>

                                                    <div class="input-field col s12 m6 l6">
                                                        <label for="description" class="active">Descrição</label>
                                                        <input type="text" id="description" name="description" onkeyup="validaForm()" value="<?php echo $list_description; ?>">
                                                        <span class="helper-text" id="msgDescription"></span>
                                                    </div>

                                                    <div class="input-field col s12 m6 l6">
                                                        <label for="fraction" class="active">Fracionar em quantos Sabores?</label>
                                                        <input type="number" id="fraction" name="fraction" onkeyup="validaForm()" value="<?php echo $list_fraction; ?>">
                                                        <span class="helper-text" id="msgFraction"></span>
                                                    </div>



                                                    </div>




                                </form>
                            </div> <!-- .row -->
                        </div> <!-- .informações principais -->

                        <!-- --- IMAGENS --- -->
                        <div id="images" class="col s12 tab-images">
                            <div class="row">

                                <?php if (isset($_GET['idProduct'])) { ?>

                                    <form id="formProductImg" enctype="multipart/form-data" method="POST">

                                        <div class="col s10 m10 l10">
                                            <div class="file-field input-field">
                                                <div class="btn">
                                                    <span>Enviar Imagem</span>
                                                    <input type="file" id="productImg" name="productImg">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text">
                                                </div>
                                            </div>
                                        </div>


                                        <?php if ($ROW_Perm_Register_Products->edit == 'S') { ?>

                                            <div class="col s2 m2 l2 center">
                                                </br>
                                                <a class="btn-floating blue waves-effect waves-light tooltipped" data-position="left" data-tooltip="Enviar" id="btnSaveProductImg" onclick="sendProductImg('<?php echo $list_id; ?>')"><i class="material-icons">send</i></a>
                                            </div>

                                        <?php } ?>

                                    </form>

                                    <div class="col s12 m12 l12">
                                        <div class="row">

                                            <div id="listProductImg"></div>

                                        </div>

                                    </div>



                                <?php } ?>
                            </div> <!-- .row -->
                        </div> <!-- .images -->


                        <!-- --- ESTOQUE --- -->
                        <div id="stock" class="col s12 tab-stock">
                            <div class="row">


                                <?php if (isset($_GET['idProduct'])) { ?>
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

                                            <a class="btn-floating halfway-fab waves-effect waves-light green tooltipped btn" data-tooltip="Adicionar" onclick="openNewAdjustment();validaTypeAdjustment();validaFormAdjustment()"><i class="material-icons">add</i></a>

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

<?php if (isset($_GET['idProduct'])) { ?>
    <script src="<?php echo $lib; ?>/lib/jquery-3.3.1.min.js"></script>
    <script src="<?php echo $lib; ?>/lib/jquery-mask.js"></script>
    <script src="<?php echo $lib; ?>/js/<?php echo $JS; ?>/functions.js"></script>
    <script src="<?php echo $lib; ?>/lib/materialize-v1.0.0/js/materialize.min.js"></script>
    <script>
        $(document).ready(function() {
            listFlavor();
            listAddition();
        });
    </script>

    <section>



        <div class="row">

            <div class="col s12 m6 l6">
                <div class="card hoverable" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">
                    <div class="container">
                        <h5 class="center">Sabores</h5>

                        <div class="row">
                            <form method="POST" id="formFlavor">

                                <div class="input-field col s10 m10 l10">
                                    <label for="nameFlavor" class="active">Nome</label>
                                    <input type="text" id="nameFlavor" name="nameFlavor" value="" onkeyup="validaFormFlavor()" data-length="25" class="count" maxlength="25">
                                    <span class="helper-text" id="msgNameFlavor"></span>
                                </div>

                                <div class="col s2 m2 l2 center">
                                    <a class="btn-floating blue waves-effect waves-light tooltipped" data-position="left" data-tooltip="Salvar" id="btnSaveFlavor" disabled onclick="saveFlavor()"><i class="material-icons">send</i></a>
                                </div>


                                <div class="input-field col s12 m12 l12">
                                    <label for="descriptionFlavor" class="active">Descrição</label>
                                    <input type="text" id="descriptionFlavor" name="descriptionFlavor" value="" onkeyup="validaFormFlavor()">
                                    <span class="helper-text" id="msgDescriptionFlavor"></span>
                                </div>


                            </form>
                            <div class="col s12 m12 l12">
                                <div id="listFlavor"></div>
                            </div>
                        </div> <!-- .row -->

                    </div> <!-- .container -->
                </div> <!-- .card -->

            </div> <!-- .col -->


            <div class="col s12 m6 l6">
                <div class="card hoverable" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">
                    <div class="container">
                        <h5 class="center">Complementos</h5>
                        <div class="row">

                            <form method="POST" id="formAddition">

                                <div class="input-field col s6 m8 l8">
                                    <label for="nameAddition" class="active">Nome</label>
                                    <input type="text" id="nameAddition" name="nameAddition" value="" onkeyup="validaFormAddition()" data-length="25" class="count" maxlength="25">
                                    <span class="helper-text" id="msgNameAddition"></span>
                                </div>

                                <div class="input-field col s3 m2 l2">
                                    <label for="valueAddition" class="active">Valor</label>
                                    <input type="text" id="valueAddition" name="valueAddition" value="" onkeyup="validaFormAddition()" class="money">
                                    <span class="helper-text" id="msgValueAddition"></span>
                                </div>

                                <div class="col s3 m2 l2 center">
                                    <a class="btn-floating blue waves-effect waves-light tooltipped" data-position="left" data-tooltip="Salvar" id="btnSaveAddition" disabled onclick="saveAddition()"><i class="material-icons">send</i></a>
                                </div>


                            </form>
                            <div class="col s12 m12 l12">
                                <div id="listAddition"></div>
                            </div>

                        </div> <!-- .row -->

                    </div> <!-- .container -->
                </div> <!-- .card -->

            </div> <!-- .col -->

        </div> <!-- .row -->



    </section>
<?php } ?>

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
        <li><a href="?pg=product" class="btn-floating red waves-effect waves-light tooltipped" data-position="left" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a></li>

        <?php if ((isset($_GET['idProduct']) && $ROW_Perm_Register_Products->edit == 'S') || (!isset($_GET['idProduct']) && $ROW_Perm_Register_Products->include == 'S')) { ?>

            <li><a class="btn-floating blue waves-effect waves-light tooltipped" data-position="left" data-tooltip="Salvar" id="btnSaveProduct" disabled onclick="saveProduct()"><i class="material-icons">done</i></a></li>

        <?php } ?>


    </ul>
</div>