<?php

$ModelUser = 'MaxComanda/model/user/user-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelUser)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelUser = $tag . $ModelUser;
include_once($ModelUser);

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

if ($ROW_Perm_System_User->search == 'N' && $ROW_Perm_System_User->include == 'N' && $ROW_Perm_System_User->edit == 'N' && $_GET['idUser'] != $_SESSION['id_user']) {
    $modalPermission = $_SERVER['DOCUMENT_ROOT'] . '/MaxComanda/view/modalPermission.php';
    include_once($modalPermission);
}


?>

<section>
    <nav style="max-height: 37px; line-height: 30px; background-color: <?php echo $_SESSION['color']; ?>">
        <div class="container">
            <div class=" center pageBreadcrumb">
                <a href="index.php" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Home</a>
                <a href="?pg=user" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Listar Usuários</a>
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
                    <form id="formUser" enctype="multipart/form-data" method="POST">





                        <div class="row">
                            <div class="col s12">
                                <ul class="tabs">
                                    <li class="tab col s6 m6 l3" onclick="validaForm()"><a class="active" href="#principais" id="tab-principais" style="color: black">Informações Principais</a></li>
                                    <li class="tab col s6 m6 l3" onclick="validaForm()"><a href="#endereco" id="tab-endereco" style="color: black">Endereço / Contato</a></li>

                                    <?php if ($ROW_Perm_System_User->include == 'S' || $ROW_Perm_System_User->edit == 'S') { ?>

                                    <li class="tab col s6 m6 l3" onclick="validaForm()"><a href="#adicionais" id="tab-adicionais" style="color: black">Informações Adicionais</a></li>

                                    <li class="tab col s6 m6 l3" onclick="validaForm()"><a href="#delivery" id="tab-delivery" style="color: black">Delivery</a></li>

                                    <?php } ?>


                                </ul>
                            </div>

                            <!-- --- INFORMAÇÕES PRINCIPAIS --- -->
                            <div id="principais" class="col s12 tab-principais">
                                <div class="row">

                                    <div class="col s6 m3 l2 center">

                                        <?php if (!empty($list_img)) { ?>
                                            <img class="circle" src="../../<?php echo $directoryName; ?>/uploads/userImage/<?php echo $list_img; ?>" style="height: 75px">
                                        <?php } else { ?>
                                            <label>Foto</label>
                                        <?php } ?>
                                    </div>

                                    <div class="input-field col s6 m2 l2">
                                        <input id="id" name="id" type="text" readonly value="<?php echo $list_id; ?>">
                                        <label for="id">ID</label>
                                    </div>

                                    <div class="input-field col s12 m7 l3">
                                        <label for="cpf" class="active" id="lCPF">CPF</label>
                                        <input type="text" id="cpf" name="cpf" class="CPF" maxlength="14" onkeyup="validaForm()" value="<?php echo $list_CPF; ?>" <?php if (!empty($list_CPF)) { ?> readonly <?php } ?>>
                                        <span class="helper-text" id="msgCPF"></span>
                                    </div>

                                    <div class="input-field col s12 m6 l5">
                                        <label for="name" class="active" id="lName">Nome</label>
                                        <input type="text" id="name" name="name" onkeyup="validaForm()" value="<?php echo $list_name; ?>">
                                        <span class="helper-text" id="msgName"></span>
                                    </div>

                                    <div class="input-field col s12 m6 l4">
                                        <label for="surname" class="active" id="lSurname">Apelido</label>
                                        <input type="text" id="surname" name="surname" onkeyup="validaForm()" value="<?php echo $list_surname; ?>">
                                        <span class="helper-text" id="msgSurname"></span>
                                    </div>

                                    

                                    <div class="input-field col s12 m6 l3" <?php if ($ROW_Perm_System_Permission->include == 'N' || $ROW_Perm_System_Permission->edit == 'N') { ?> hidden <?php } ?>>
                                        <select id="profile" name="profile" onchange="validaForm()">
                                            <?php if (!empty($list_profile)) { ?>
                                                <option value="<?php echo $list_profile; ?>"><?php echo $list_profile_name; ?></option>
                                            <?php } ?>
                                            <option value="">Selecione</option>
                                            <?php while ($list_Profile = $sqlListProfile->fetch()) { ?>
                                                <option value="<?php echo $list_Profile->id; ?>"><?php echo $list_Profile->name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label>Perfil</label>
                                        <span class="helper-text" id="msgProfile"></span>
                                    </div>


                                    <div class="input-field col s12 m6 l5">
                                        <label for="email" class="active">Email</label>
                                        <input type="text" id="email" name="email" onkeyup="validaForm()" value="<?php echo $list_email; ?>">
                                        <span class="helper-text" id="msgEmail"></span>
                                    </div>
                                    <!--
                                            <div class="input-field col s12 m6 l3">
                                                <label for="login" class="active">Login</label>
                                                <input type="text" id="login" name="login" onkeyup="validaForm()" value="<?php echo $list_login; ?>">
                                                <span class="helper-text" id="msgLogin"></span>
                                            </div>
                                                    -->

                                    <div class="input-field col s12 m6 l3">
                                        <label for="password" class="active">Senha</label>
                                        <input type="password" id="password" name="password" onkeyup="validaForm()">
                                        <span class="helper-text" id="msgPassword"></span>
                                    </div>

                                    <div class="input-field col s12 m6 l3">
                                        <select id="status" onchange="validaForm()">
                                            <?php if (!empty($list_status)) { ?>
                                                <option value="<?php echo $list_status; ?>"><?php echo $list_status; ?></option>
                                            <?php } ?>
                                            <option value="Ativo">Ativo</option>
                                            <option value="Inativo">Inativo</option>
                                        </select>
                                        <label>Status</label>
                                        <span class="helper-text" id="msgStatus"></span>
                                    </div>

                                    <div class="file-field col s12 m12 l6">
                                        <div class="btn">
                                            <span>Imagem - Perfil</span>
                                            <input type="file" id="img" name="img">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text">
                                        </div>
                                    </div>



                                </div> <!-- .row -->
                            </div> <!-- .informações principais -->

                            <!-- --- ENDEREÇO --- -->
                            <div id="endereco" class="col s12 tab-endereco">
                                <div class="row">

                                    <div class="input-field col s12 m4 l2">
                                        <label for="CEP" class="active">CEP</label>
                                        <input type="text" id="CEP" name="CEP" onkeyup="validaForm()" onBlur="buscaCEP(this.value)" value="<?php echo $list_CEP; ?>" maxlength="9">
                                        <span class="helper-text" id="msgCEP"></span>
                                    </div>

                                    <div class="input-field col s9 m6 l4">
                                        <label for="address" class="active">Endereço</label>
                                        <input type="text" id="address" name="address" onkeyup="validaForm()" value="<?php echo $list_address; ?>">
                                        <span class="helper-text" id="msgAddress"></span>
                                    </div>

                                    <div class="input-field col s3 m2 l2">
                                        <label for="number" class="active">Número</label>
                                        <input type="text" id="number" name="number" onkeyup="validaForm()" value="<?php echo $list_number; ?>">
                                        <span class="helper-text" id="msgNumber"></span>
                                    </div>

                                    <div class="input-field col s12 m6 l4">
                                        <label for="complement" class="active">Complemento</label>
                                        <input type="text" id="complement" name="complement" onkeyup="validaForm()" value="<?php echo $list_complement; ?>">
                                        <span class="helper-text" id="msgComplement"></span>
                                    </div>

                                    <div class="input-field col s12 m6 l4">
                                        <label for="neighborhood" class="active">Bairro</label>
                                        <input type="text" id="neighborhood" name="neighborhood" onkeyup="validaForm()" value="<?php echo $list_neighborhood; ?>">
                                        <span class="helper-text" id="msgNeighborhood"></span>
                                    </div>

                                    <div class="input-field col s9 m5 l4">
                                        <label for="city" class="active">Cidade</label>
                                        <input type="text" id="city" name="city" onkeyup="validaForm()" value="<?php echo $list_city; ?>" readonly>
                                        <span class="helper-text" id="msgCity"></span>
                                    </div>

                                    <div class="input-field col s3 m2 l1">
                                        <label for="UF" class="active">UF</label>
                                        <input type="text" id="UF" name="UF" onkeyup="validaForm()" value="<?php echo $list_UF; ?>" readonly>
                                        <span class="helper-text" id="msgUF"></span>
                                    </div>

                                    <div class="input-field col s12 m5 l3">
                                        <label for="phone" class="active">Telefone</label>
                                        <input type="text" id="phone" name="phone" onkeyup="validaForm()" value="<?php echo $list_phone; ?>" class="phone">
                                        <span class="helper-text" id="msgPhone"></span>
                                    </div>

                                </div> <!-- .row -->
                            </div> <!-- .endereco -->

                            <!-- --- INFORMAÇÕES ADICIONAIS --- -->
                            <div id="adicionais" class="col s12">
                                <div class="row">

                                    <div class="input-field col s6 m4 l4">
                                        <label for="wage" class="active">Salário</label>
                                        <input type="text" class="money" id="wage" name="wage" onkeyup="validaForm()" value="<?php echo $list_wage; ?>">
                                        <span class="helper-text" id="msgWage"></span>
                                    </div>

                                    <div class="input-field col s6 m4 l4">
                                        <label for="comission" class="active">Comissão</label>
                                        <input type="text" class="money" id="comission" name="comission" onkeyup="validaForm()" value="<?php echo $list_comission; ?>">
                                        <span class="helper-text" id="msgComission"></span>
                                    </div>

                                    <div class="input-field col s12 m4 l4">
                                        <select id="comission_status" name="comission_status" onchange="validaForm()">
                                            <?php if (!empty($list_comission_status)) { ?>
                                                <option value="<?php echo $list_comission_status; ?>"><?php echo $list_comission_status; ?></option>
                                            <?php } ?>
                                            <option value="">Selecione</option>
                                            <option value="Ativo">Ativo</option>
                                            <option value="Inativo">Inativo</option>
                                        </select>
                                        <label>Status da Comissão</label>
                                        <span class="helper-text" id="msgComissionStatus"></span>
                                    </div>

                                    <div class="input-field col s12 m4 l4">
                                        <label for="payday" class="active">Dia de Pagamento</label>
                                        <input type="number" required min="1" max="31" id="payday" name="payday" onkeyup="validaForm()" value="<?php echo $list_payday; ?>">
                                        <span class="helper-text" id="msgPayday"></span>
                                    </div>

                                    <div class="input-field col s12 m4 l4">
                                        <label for="admission_date" class="active">Data - Contratação</label>
                                        <input type="text" class="datepicker" id="admission_date" name="admission_date" onclick="validaForm()" value="<?php if (isset($list_admission_date) && $list_admission_date != 0) {
                                                                                                                                                            echo date("d/m/Y", strtotime($list_admission_date));
                                                                                                                                                        }  ?>">
                                        <span class="helper-text" id="msgAdmissionDate"></span>
                                    </div>

                                    <div class="input-field col s12 m4 l4">
                                        <label for="resignation_date" class="active">Data - Demissão</label>
                                        <input type="text" class="datepicker" id="resignation_date" name="resignation_date" onclick="validaForm()" value="<?php if (isset($list_resignation_date) && $list_resignation_date != 0) {
                                                                                                                                                                echo date("d/m/Y", strtotime($list_resignation_date));
                                                                                                                                                            }  ?>">
                                        <span class="helper-text" id="msgResignationDate"></span>
                                    </div>

                                </div> <!-- .row -->
                            </div> <!-- .adicionais -->

                            <!-- --- DELIVERY --- -->
                            <div id="delivery" class="col s12">
                                <div class="row">

                                    <div class="input-field col s12 m4 l4">
                                        <label for="CNH" class="active">CNH</label>
                                        <input type="text" id="CNH" name="CNH" onkeyup="validaForm()" value="<?php echo $list_CNH; ?>">
                                        <span class="helper-text" id="msgCNH"></span>
                                    </div>

                                    <div class="input-field col s12 m4 l4">
                                        <label for="CNH_expiration" class="active">Validade da CNH</label>
                                        <input type="text" class="datepicker" id="CNH_expiration" name="CNH_expiration" onclick="validaForm()" value="<?php if (isset($list_CNH_expiration) && $list_CNH_expiration != 0) {
                                                                                                                                                            echo date("d/m/Y", strtotime($list_CNH_expiration));
                                                                                                                                                        }  ?>">
                                        <span class="helper-text" id="msgCNH_expiration"></span>
                                    </div>

                                    <div class="input-field col s12 m4 l4">
                                        <label for="vehicle_license" class="active">Placa do Veículo</label>
                                        <input type="text" id="vehicle_license" name="vehicle_license" onkeyup="validaForm()" value="<?php echo $list_vehicle_license; ?>">
                                        <span class="helper-text" id="msgVehicleLicense"></span>
                                    </div>

                                    <div class="input-field col s12 m8 l8">
                                        <label for="vehicle_owner" class="active">Proprietário do Veículo</label>
                                        <input type="text" id="vehicle_owner" name="vehicle_owner" onkeyup="validaForm()" value="<?php echo $list_vehicle_owner; ?>">
                                        <span class="helper-text" id="msgVehicleOwner"></span>
                                    </div>

                                    <div class="input-field col s12 m4 l4">
                                        <label for="km_value" class="active">Valor KM Rodado</label>
                                        <input type="text" class="money" id="km_value" name="km_value" onkeyup="validaForm()" value="<?php echo $list_km_value; ?>">
                                        <span class="helper-text" id="msgKMValue"></span>
                                    </div>

                                </div> <!-- .row -->
                            </div> <!-- .delivery -->
                        </div> <!-- .row -->











                    </form>
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

                        <div class="input-field col s6 m2 l2">
                            <label for="date_register" class="active">Data Cadastro</label>
                            <input type="text" id="date_register" name="date_register" onkeyup="validaForm()" value="<?php if (isset($list_date_register) && $list_date_register != 0) {
                                                                                                                            echo date("d/m/Y H:i:s", strtotime($list_date_register));
                                                                                                                        }  ?>" readonly>
                        </div>

                        <div class="input-field col s6 m3 l3">
                            <label for="user_register" class="active">Usuário Cadastro</label>
                            <input type="text" id="user_register" name="user_register" onkeyup="validaForm()" value="<?php echo $list_user_register;  ?>" readonly>
                        </div>

                        <div class="input-field col s6 m2 l2">
                            <label for="last_update" class="active">Última Atualização</label>
                            <input type="text" id="last_update" name="last_update" onkeyup="validaForm()" value="<?php if (isset($list_last_update) && $list_last_update != 0) {
                                                                                                                        echo date("d/m/Y H:i:s", strtotime($list_last_update));
                                                                                                                    } ?>" readonly>
                        </div>

                        <div class="input-field col s6 m3 l3">
                            <label for="user_update" class="active">Usuário Última Atualização</label>
                            <input type="text" id="user_update" name="user_update" onkeyup="validaForm()" value="<?php echo $list_user_update; ?>" readonly>
                        </div>

                        <div class="input-field col s12 m2 l2">
                            <label for="number_access" class="active">Número de Acessos</label>
                            <input type="text" id="number_access" name="number_access" onkeyup="validaForm()" value="<?php echo $list_number_access;  ?>" readonly>
                        </div>

                    </div> <!-- .row -->

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
        <li><a href="?pg=user" class="btn-floating red waves-effect waves-light tooltipped" data-position="left" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a></li>
        <li><a class="btn-floating blue waves-effect waves-light tooltipped" data-position="left" data-tooltip="Salvar" id="btnSaveUser" disabled onclick="saveUser()"><i class="material-icons">done</i></a></li>
    </ul>
</div>