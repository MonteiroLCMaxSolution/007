<?php

$ModelTable = 'MaxComanda/model/table/table-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelTable)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelTable = $tag . $ModelTable;
include_once($ModelTable);

/*ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);*/

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
            <div class=" center pageBreadcrumb">
                <a href="index.php" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Home</a>
                <a href="?pg=table" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Listar Mesas</a>
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


                    <form id="formTable" method="POST">
                        <div class="row">

                            <div class="input-field col s12 m2 l2">
                                <input id="id" name="id" type="text" readonly value="<?php echo $list_id; ?>">
                                <label for="id">ID</label>
                            </div>

                            <div class="input-field col s10 m4 l4">
                                <select id="map" name="map" onchange="validaForm()">
                                    <?php if (!empty($list_map_id)) { ?>
                                        <option value="<?php echo $list_map_id; ?>"><?php echo $list_map_description; ?></option>
                                    <?php } ?>
                                    <option value="">Selecione</option>
                                    <?php while ($rowMap = $sqlListMap->fetch()) { ?>
                                        <option value="<?php echo $rowMap->id; ?>"><?php echo $rowMap->description; ?></option>
                                    <?php } ?>
                                </select>
                                <label>Local do Mapa</label>
                                <span class="helper-text" id="msgMap"></span>
                            </div>

                            <?php if ($ROW_Perm_Register_Table->edit == 'S') { ?>
                                <div class="col s2 m1 l1">
                                    </br>
                                    <a class="waves-effect waves-light btn modal-trigger right tooltipped" href="#modalMap" data-tooltip="Novo Local do Mapa"><i class="material-icons">add</i></a>
                                </div>
                            <?php } ?>

                            <div class="input-field col s12 m5 l5">
                                <select id="status" name="status" onchange="validaForm()">
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
        <li><a href="?pg=table" class="btn-floating red waves-effect waves-light tooltipped" data-position="left" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a></li>

        <?php if ((isset($_GET['idTable']) && $ROW_Perm_Register_Table->edit == 'S') || (!isset($_GET['idTable']) && $ROW_Perm_Register_Table->include == 'S')) { ?>

            <li><a class="btn-floating blue waves-effect waves-light tooltipped" data-position="left" data-tooltip="Salvar" id="btnSaveTable" disabled onclick="saveTable()"><i class="material-icons">done</i></a></li>

        <?php } ?>


    </ul>
</div>



<!-- Modal Mapa -->
<!-- Modal Structure -->
<div id="modalMap" class="modal bottom-sheet modal-static">
    <div class="modal-content">

        <section>
            <div class="row">
                <div class="col s12">

                    <!-- CARD LISTAR MAPA -->
                    <div class="card hoverable listMap" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">

                        <div class="card-content">

                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="row">



                                        <h5 class="center">Locais do Mapa</h5>


                                        <a class="btn-floating waves-effect waves-light green tooltipped" data-tooltip="Adicionar" onclick="newMap();validaFormMap()"><i class="material-icons">add</i></a>


                                        <a class="btn-floating waves-effect waves-light red tooltipped right" data-tooltip="Fechar" onclick="location.reload()"><i class="material-icons">close</i></a>
                                    </div>


                                    <div class="col s12 m12 l12">







                                        <div class="col s12 m12 l12">

                                            <div id="listTableMap">
                                                <?php include_once('table-map.php'); ?>
                                            </div>

                                        </div>
                                    </div>

                                </div>


                            </div>






                        </div>
                    </div>


                    <!-- CARD NOVO MAPA -->
                    <div class="card hoverable newMap" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>" hidden>

                        <div class="card-content">
                            <h5 class="center">Adicionar Local no Mapa</h5>

                            <div class="row">


                                <form id="formMap" method="POST">

                                    <div class="input-field col s12 m8 l8">
                                        <label class="active">Descrição</label>
                                        <input type="text" id="description" name="description" onkeyup="validaFormMap()">
                                        <span class="helper-text" id="msgDescription"></span>
                                    </div>

                                    <div class="input-field col s12 m4 l4">
                                        <label class="active">Andar</label>
                                        <input type="text" id="floor" name="floor" onkeyup="validaFormMap()">
                                        <span class="helper-text" id="msgFloor"></span>
                                    </div>

                                    <div class="input-field col s12 m5 l5">
                                        <label class="active">Setor</label>
                                        <input type="text" id="sector" name="sector" onkeyup="validaFormMap()">
                                        <span class="helper-text" id="msgSector"></span>
                                    </div>

                                    <div class="input-field col s8 m5 l5">
                                        <label class="active">Lado</label>
                                        <input type="text" id="side" name="side" onkeyup="validaFormMap()">
                                        <span class="helper-text" id="msgSide"></span>
                                    </div>

                                    <div class="col s2 m1 l1">
                                        <a class="btn-floating waves-effect waves-light red tooltipped right" data-tooltip="Cancelar" onclick="cancelNewMap()"><i class="material-icons">close</i></a>
                                    </div>

                                    <div class="col s2 m1 l1">
                                        <a class="btn-floating waves-effect waves-light blue tooltipped right" data-tooltip="Salvar" onclick="saveMap()" disabled id="btnSaveMap"><i class="material-icons">done</i></a>
                                    </div>

                                </form>



                            </div>

                        </div>


                    </div>
        </section>




    </div>

</div>