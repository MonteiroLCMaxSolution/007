<?php

$ModelClient = 'MaxComanda/model/client/client-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelClient)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelClient = $tag . $ModelClient;
include_once($ModelClient);

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

if ($ROW_Perm_Register_Client->search == 'N' && $ROW_Perm_Register_Client->include == 'N' && $ROW_Perm_Register_Client->edit == 'N') {
    $modalPermission = $_SERVER['DOCUMENT_ROOT'] . '/MaxComanda/view/modalPermission.php';
    include_once($modalPermission);
}

?>
<section>
    <nav style="max-height: 37px; line-height: 30px; background-color: <?php echo $_SESSION['color']; ?>">
        <div class="container">
            <div class=" center pageBreadcrumb">
                <a href="index.php" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Home</a>
                <a href="?pg=client" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Listar Clientes</a>
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
                                <?php if (isset($_GET['idClient'])) { ?>
                                    <li class="tab col s6 m6 l6" onclick="validaForm();validaFormAddress();searchAddress('<?php echo $list_id; ?>');hideBtn()"><a href="#endereco" id="tab-endereco" style="color: black">Endereço</a></li>
                                <?php } ?>
                            </ul>
                        </div>

                        <!-- --- INFORMAÇÕES PRINCIPAIS --- -->
                        <div id="principais" class="col s12 tab-principais">
                            <div class="row">
                                <form id="formClient" enctype="multipart/form-data" method="POST">


                                    <div class="input-field col s3 m2 l2">
                                        <input id="id" name="id" type="text" readonly value="<?php echo $list_id; ?>">
                                        <label for="id">ID</label>
                                    </div>

                                    <div class="input-field col s9 m4 l3">
                                        <label for="cpf_cnpj" class="active" id="lCPFCNPJ">CPF / CNPJ</label>
                                        <input type="text" id="cpf_cnpj" name="cpf_cnpj" class="cpf_cnpj" onBlur="buscaCNPJ(this.value)" onkeyup="validaForm()" value="<?php echo $list_CPF_CNPJ; ?>" <?php if (!empty($list_CPF_CNPJ)) { ?> readonly <?php } ?>>
                                        <input type="hidden" id="type" name="type" value="<?php echo $list_type; ?>">
                                        <span class="helper-text" id="msgCPFCNPJ"></span>
                                    </div>

                                    <div class="input-field col s12 m6 l7">
                                        <label for="name_razSocial" class="active" id="lName_RazSocial">Nome / Razão Social</label>
                                        <input type="text" id="name_razSocial" name="name_razSocial" onkeyup="validaForm()" value="<?php echo $list_name_razSocial; ?>">
                                        <span class="helper-text" id="msgNameRazSocial"></span>
                                    </div>

                                    <div class="input-field col s12 m4 l4 formCNPJ">
                                        <label for="fantasia" class="active">Nome Fantasia</label>
                                        <input type="text" id="fantasia" name="fantasia" onkeyup="validaForm()" value="<?php echo $list_fantasia; ?>">
                                        <span class="helper-text" id="msgFantasia"></span>
                                    </div>

                                    <div class="input-field col s12 m4 l4 formCNPJ">
                                        <label for="insc_municipal" class="active">Inscrição Municipal</label>
                                        <input type="text" id="insc_municipal" name="insc_municipal" onkeyup="validaForm()" value="<?php echo $list_insc_municipal; ?>">
                                        <span class="helper-text" id="msgInscMunicipal"></span>
                                    </div>

                                    <div class="input-field col s12 m4 l4 formCNPJ">
                                        <label for="insc_estadual" class="active">Inscrição Estadual</label>
                                        <input type="text" id="insc_estadual" name="insc_estadual" onkeyup="validaForm()" value="<?php echo $list_insc_estadual; ?>">
                                        <span class="helper-text" id="msgInscEstadual"></span>
                                    </div>

                                    <div class="input-field col s12 m6 l4">
                                        <label for="surname" class="active" id="lSurname">Apelido</label>
                                        <input type="text" id="surname" name="surname" onkeyup="validaForm()" value="<?php echo $list_surname; ?>">
                                        <span class="helper-text" id="msgSurname"></span>
                                    </div>


                                    <div class="input-field col s12 m6 l4">
                                        <label for="email" class="active">Email</label>
                                        <input type="text" id="email" name="email" onkeyup="validaForm()" value="<?php echo $list_email; ?>">
                                        <span class="helper-text" id="msgEmail"></span>
                                    </div>

                                    <div class="input-field col s12 m6 l4">
                                        <label for="login" class="active">Login</label>
                                        <input type="text" id="login" name="login" onkeyup="validaForm()" value="<?php echo $list_login; ?>">
                                        <span class="helper-text" id="msgLogin"></span>
                                    </div>

                                    <div class="input-field col s12 m6 l4">
                                        <label for="password" class="active">Senha</label>
                                        <input type="password" id="password" name="password" onkeyup="validaForm()">
                                        <span class="helper-text" id="msgPassword"></span>
                                    </div>

                                    <div class="input-field col s4 m4 l3">
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

                                    <div class="input-field col s8 m4 l3">
                                        <label for="phone" class="active">Telefone</label>
                                        <input type="text" id="phone" name="phone" onkeyup="validaForm()" value="<?php echo $list_phone; ?>" class="phone">
                                        <span class="helper-text" id="msgPhone"></span>
                                    </div>

                                    <div class="input-field col s12 m4 l2">
                                        <label for="birthday" class="active">Data - Nascimento</label>
                                        <input type="text" class="datepicker" id="birthday" name="birthday" onclick="validaForm()" value="<?php if (isset($list_birthday) && $list_birthday != 0) {
                                                                                                                                                echo date("d/m/Y", strtotime($list_birthday));
                                                                                                                                            } ?>">
                                        <span class="helper-text" id="msgBirthday"></span>
                                    </div>


                                </form>
                            </div> <!-- .row -->
                        </div> <!-- .informações principais -->

                        <!-- --- ENDEREÇO --- -->
                        <div id="endereco" class="col s12 tab-endereco">
                            <div class="row">

                                <?php if (isset($_GET['idClient'])) { ?>


                                    <div class="col s12">
                                        <div class="card hoverable" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">

                                            <div class="card-content">
                                                <div class="row">

                                                    <form id="formClientAddress" enctype="multipart/form-data" method="POST">

                                                        <div class="input-field col s12 m4 l2">
                                                            <label for="CEP" class="active">CEP</label>
                                                            <input type="text" id="CEP" name="CEP" onkeyup="validaFormAddress()" onBlur="buscaCEP(this.value)" value="" maxlength="9">
                                                            <span class="helper-text" id="msgCEP"></span>
                                                        </div>

                                                        <div class="input-field col s9 m6 l4">
                                                            <label for="address" class="active">Endereço</label>
                                                            <input type="text" id="address" name="address" onkeyup="validaFormAddress()" value="">
                                                            <span class="helper-text" id="msgAddress"></span>
                                                        </div>

                                                        <div class="input-field col s3 m2 l2">
                                                            <label for="number" class="active">Número</label>
                                                            <input type="text" id="number" name="number" onkeyup="validaFormAddress()" value="">
                                                            <span class="helper-text" id="msgNumber"></span>
                                                        </div>

                                                        <div class="input-field col s12 m6 l4">
                                                            <label for="complement" class="active">Complemento</label>
                                                            <input type="text" id="complement" name="complement" onkeyup="validaFormAddress()" value="">
                                                            <span class="helper-text" id="msgComplement"></span>
                                                        </div>

                                                        <div class="input-field col s12 m6 l5">
                                                            <label for="neighborhood" class="active">Bairro</label>
                                                            <input type="text" id="neighborhood" name="neighborhood" onkeyup="validaFormAddress()" value="">
                                                            <span class="helper-text" id="msgNeighborhood"></span>
                                                        </div>

                                                        <div class="input-field col s9 m10 l5">
                                                            <label for="city" class="active">Cidade</label>
                                                            <input type="text" id="city" name="city" onkeyup="validaFormAddress()" value="" readonly>
                                                            <span class="helper-text" id="msgCity"></span>
                                                        </div>

                                                        <div class="input-field col s3 m2 l2">
                                                            <label for="UF" class="active">UF</label>
                                                            <input type="text" id="UF" name="UF" onkeyup="validaFormAddress()" value="" readonly>
                                                            <span class="helper-text" id="msgUF"></span>
                                                        </div>


                                                    </form>




                                                </div> <!-- .row -->



                                            </div>

                                            <?php if ($ROW_Perm_Register_Client->edit == 'S') { ?>
                                                <a class="btn-floating halfway-fab waves-effect waves-light blue tooltipped" data-tooltip="Adicionar" id="btnSaveClientAddress" onclick="addClientAddress('<?php echo $list_id; ?>')" disabled><i class="material-icons">add</i></a>
                                            <?php } ?>

                                        </div>

                                        <div class="row">
                                            <div class="col s12">
                                                <div class="card-panel hoverable" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">
                                                    <div id="listClientAddress"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>























                                <?php } ?>





                            </div> <!-- .row -->
                        </div> <!-- .endereco -->

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

                        <div class="input-field col s4 m4 l4">
                            <label for="date_register" class="active">Data Cadastro</label>
                            <input type="text" id="date_register" name="date_register" onkeyup="validaForm()" value="<?php if (isset($list_date_register) && $list_date_register != 0) {
                                                                                                                            echo date("d/m/Y H:i:s", strtotime($list_date_register));
                                                                                                                        }  ?>" readonly>
                        </div>

                        <div class="input-field col s4 m4 l4">
                            <label for="last_update" class="active">Última Atualização</label>
                            <input type="text" id="last_update" name="last_update" onkeyup="validaForm()" value="<?php if (isset($list_last_update) && $list_last_update != 0) {
                                                                                                                        echo date("d/m/Y H:i:s", strtotime($list_last_update));
                                                                                                                    } ?>" readonly>
                        </div>


                        <div class="input-field col s4 m4 l4">
                            <label for="number_access" class="active">Número de Acessos</label>
                            <input type="text" id="number_access" name="number_access" onkeyup="validaForm()" value="<?php echo $list_number_access;  ?>" readonly>
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
        <li><a href="?pg=client" class="btn-floating red waves-effect waves-light tooltipped" data-position="left" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a></li>


        <?php if ((isset($_GET['idClient']) && $ROW_Perm_Register_Client->edit == 'S') || (!isset($_GET['idClient']) && $ROW_Perm_Register_Client->include == 'S')) { ?>

            <li><a class="btn-floating blue waves-effect waves-light tooltipped" data-position="left" data-tooltip="Salvar" id="btnSaveClient" disabled onclick="saveClient()"><i class="material-icons">done</i></a></li>

        <?php } ?>

    </ul>
</div>