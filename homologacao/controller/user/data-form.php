<?php


$ModelUserPermission = $_COOKIE['server'] . '/model/permission/user-permission.php';
include_once($ModelUserPermission);

$userModel = $_COOKIE['server'] . '/model/user/user-model.php';
include_once($userModel);
if(isset($ROW_Perm_System_User->search)){
if ($ROW_Perm_System_User->search == 'N' && $ROW_Perm_System_User->include == 'N' && $ROW_Perm_System_User->edit == 'N' && $_GET['idUser'] != $_SESSION['id_user']) {
    $modalPermission = $_COOKIE['server'] . '/view/modalPermission.php';
    include_once($modalPermission);
}
}



?>

<section class="register-form">
    <div class="center">
        <div class="section-title">
            <h1>Cadastro de Usuário</h1>
        </div>
        <!--section-title-->
        <form id="formUser" class="flexbox">

            <div class="form-title w100">
                <h2>Informações principais</h2>
            </div>
            <!--form-title-->

            <div class="w100">
                <h5>Cadastrar na(s) Empresa(s):</h5>
                <?php
				if(!empty($_GET['idUser'])){
				while ($rowCompany = $SQL_list_company->fetch()) { 
                    
                    if(in_array($rowCompany->id,$arrayCompany)){ 
                        $checked = "checked";
                     } else{
                         $checked = "";
                     }
                    ?>
                    <div class="w40">
                        <input type="checkbox" name="company[]" id="<?php echo $rowCompany->id; ?>" value="<?php echo $rowCompany->id; ?>" <?php if(isset($_GET['idUser'])){ ?> onchange="registerCompany(this.value) <?php }?>" <?php echo $checked;  ?>>
                        <label><?php echo $rowCompany->name; ?></label>
                    </div>
                <?php 
				}
				}?>
            </div>


            <div class="inp-single w20">
                <p>ID</p>
                <input type="text" name="id" id="id" readonly hidden value="<?php echo $list_id_user; ?>">
                <input type="text" readonly value="<?php echo $list_idUser; ?>">
            </div>
            <!--inp-single-->
            <div class="inp-single w40">
                <p id="p-cpf">CPF</p>
                <input type="text" id="cpf" name="cpf" class="CPF" maxlength="14" onkeyup="validaForm()" value="<?php echo $list_CPF; ?>" <?php if (!empty($list_CPF)) { ?> readonly <?php } ?>>
            </div>
            <!--inp-single-->
            <div class="inp-single w40">
                <p id="p-name">Nome</p>
                <input type="text" id="name" name="name" onkeyup="validaForm()" value="<?php echo $list_user_name; ?>">
            </div>
            <!--inp-single-->
            <div class="inp-single w33">
                <p id="p-surname">Apelido</p>
                <input type="text" id="surname" name="surname" onkeyup="validaForm()" value="<?php echo $list_surname; ?>">
            </div>
            <!--inp-single-->
            <div class="inp-single w33">
                <p id="p-profile">Perfil</p>
                <select id="profile" name="profile" onchange="validaForm()">
                    <option value="">Selecione</option>
                    <?php while ($rowProfile = $sqlListProfile->fetch()) { ?>
                        <option value="<?php echo $rowProfile->id; ?>" <?php if ($list_profile == $rowProfile->id) {
                                                                            echo 'selected';
                                                                        } ?>><?php echo $rowProfile->name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <!--inp-single-->
            <div class="inp-single w33">
                <p id="p-email">Email</p>
                <input type="email" id="email" name="email" onkeyup="validaForm()" value="<?php echo $list_email; ?>">
            </div>
            <!--inp-single-->

            <div class="inp-single w33">
                <p id="p-password">Senha</p>
                <input type="password" id="password" name="password" onkeyup="validaForm()">
            </div>
            <!--inp-single-->

            <div class="inp-single w33">
                <p id="p-status">Status</p>
                <select id="status" name="status" onchange="validaForm()">
                    <option value="Ativo" <?php if ($list_status == "Ativo") {
                                                echo 'selected';
                                            } ?>>Ativo</option>
                    <option value="Inativo" <?php if ($list_status == "Inativo") {
                                                echo 'selected';
                                            } ?>>Inativo</option>
                </select>
            </div>
            <!--inp-single-->

            <div class="inp-single w33">
                <p id="p-phone">Telefone</p>
                <input type="text" id="phone" name="phone" onkeyup="validaForm()" value="<?php echo $list_phone; ?>" class="phone">
            </div>
            <!--inp-single-->

            <div class="inp-single w100">
                <p>Imagem - Perfil</p>
                <input type="file" id="img" name="img" accept=".jpg,.jpeg,.png" onchange="validaForm()">
            </div>
            <!--inp-single-->

            <div class="form-title w100">
                <h2>Endereço</h2>
            </div>
            <!--form-title-->

            <div class="inp-single w20">
                <p id="p-CEP">CEP</p>
                <input type="text" id="CEP" name="CEP" onkeyup="validaForm();buscaCEP(this.value,'validaForm')" value="<?php echo $list_CEP; ?>" maxlength="9">
            </div>
            <!--inp-single-->
            <div class="inp-single w30">
                <p id="p-address">Endereço</p>
                <input type="text" id="address" name="address" onkeyup="validaForm()" value="<?php echo $list_address; ?>">
            </div>
            <!--inp-single-->
            <div class="inp-single w20">
                <p id="p-number">Número</p>
                <input type="text" id="number" name="number" onkeyup="validaForm()" value="<?php echo $list_number; ?>">
            </div>
            <!--inp-single-->
            <div class="inp-single w30">
                <p id="p-complement">Complemento</p>
                <input type="text" id="complement" name="complement" onkeyup="validaForm()" value="<?php echo $list_complement; ?>">
            </div>
            <!--inp-single-->
            <div class="inp-single w40">
                <p id="p-district">Bairro</p>
                <input type="text" id="district" name="district" onkeyup="validaForm()" value="<?php echo $list_district; ?>">
            </div>
            <!--inp-single-->
            <div class="inp-single w40">
                <p id="p-city">Cidade</p>
                <input type="text" id="city" name="city" onkeyup="validaForm()" value="<?php echo $list_city; ?>">
            </div>
            <!--inp-single-->
            <div class="inp-single w20">
                <p id="p-UF">UF</p>
                <input type="text" id="UF" name="UF" onkeyup="validaForm()" value="<?php echo $list_UF; ?>">
            </div>
            <!--inp-single-->

            <div class="form-title w100">
                <h2>Informações adicionais</h2>
            </div>
            <!--form-title-->

            <div class="inp-single w33">
                <p id="p-wage">Salário</p>
                <input type="text" class="money" id="wage" name="wage" onkeyup="validaForm()" value="<?php echo $list_wage; ?>">
            </div>
            <!--inp-single-->
            <div class="inp-single w33">
                <p id="p-comission">Comissão</p>
                <input type="text" class="money" id="comission" name="comission" onkeyup="validaForm()" value="<?php echo $list_comission; ?>">
            </div>
            <!--inp-single-->
            <div class="inp-single w33">
                <p id="p-comission_status">Status - Comissão</p>
                <select id="comission_status" name="comission_status" onchange="validaForm()">
                    <option value="">Selecione</option>
                    <option value="Ativo" <?php if ($list_comission_status == "Ativo") {
                                                echo 'selected';
                                            } ?>>Ativo</option>
                    <option value="Inativo" <?php if ($list_comission_status == "Inativo") {
                                                echo 'selected';
                                            } ?>>Inativo</option>
                </select>
            </div>
            <!--inp-single-->
            <div class="inp-single w33">
                <p id="p-payday">Dia de pagamento</p>
                <input type="number" min="1" max="31" id="payday" name="payday" onkeyup="validaForm()" value="<?php echo $list_payday; ?>">
            </div>
            <!--inp-single-->
            <div class="inp-single w33">
                <p id="p-admission_date">Data - Contratação</p>
                <input type="date" id="admission_date" name="admission_date" onclick="validaForm()" value="<?php echo $list_admission_date; ?>">
            </div>
            <!--inp-single-->
            <div class="inp-single w33">
                <p class="p-resignation_date">Data - Demissão</p>
                <input type="date" id="resignation_date" name="resignation_date" onclick="validaForm()" value="<?php echo $list_resignation_date; ?>">
            </div>
            <!--inp-single-->

            <div class="form-title w100">
                <h2>Delivery</h2>
            </div>
            <!--form-title-->

            <div class="inp-single w33">
                <p class="p-CNH">CNH</p>
                <input type="text" id="CNH" name="CNH" onkeyup="validaForm()" value="<?php echo $list_CNH; ?>">
            </div>
            <!--inp-single-->
            <div class="inp-single w33">
                <p class="p-CNH_expiration">Validade CNH</p>
                <input type="date" id="CNH_expiration" name="CNH_expiration" onclick="validaForm()" value="<?php echo $list_CNH_expiration; ?>">
            </div>
            <!--inp-single-->
            <div class="inp-single w33">
                <p class="p-vehicle_license">Placa do veículo</p>
                <input type="text" id="vehicle_license" name="vehicle_license" onkeyup="validaForm()" value="<?php echo $list_vehicle_license; ?>">
            </div>
            <!--inp-single-->
            <div class="inp-single w50">
                <p class="p-vehicle_owner">Proprietário do veículo</p>
                <input type="text" id="vehicle_owner" name="vehicle_owner" onkeyup="validaForm()" value="<?php echo $list_vehicle_owner; ?>">
            </div>
            <!--inp-single-->
            <div class="inp-single w50">
                <p class="p-km_value">Valor KM Rodado</p>
                <input type="text" class="money" id="km_value" name="km_value" onkeyup="validaForm()" value="<?php echo $list_km_value; ?>">
            </div>
            <!--inp-single-->

            <div class="btn-box w100">
                <a href="?pg=user" type="button" class="cancel-btn">Cancelar</a>
                <button type="submit" id="btnSaveUser" disabled onclick="saveUser()">Confirmar</button>
            </div>
            <!--btn-box-->
        </form>

        <div class="register-infos flexbox">
            <div class="register-info-single w25">
                <p>Data cadastro</p>
                <input type="text" value="<?php if (isset($list_date_register) && $list_date_register != 0) {
                                                echo date("d/m/Y H:i:s", strtotime($list_date_register));
                                            }  ?>" readonly>
            </div>
            <!--register-info-single-->
            <div class="register-info-single w25">
                <p>Usuário cadastro</p>
                <input type="text" value="<?php echo $list_user_register;  ?>" readonly>
            </div>
            <!--register-info-single-->
            <div class="register-info-single w25">
                <p>Última atualização</p>
                <input type="text" value="<?php if (isset($list_last_update) && $list_last_update != 0) {
                                                echo date("d/m/Y H:i:s", strtotime($list_last_update));
                                            } ?>" readonly>
            </div>
            <!--register-info-single-->
            <div class="register-info-single w25">
                <p>Usuário última atualização</p>
                <input type="text" value="<?php echo $list_user_update; ?>" readonly>
            </div>
            <!--register-info-single-->
        </div>
        <!--register-infos-->
    </div>
    <!--center-->
</section>
<!--register-form-->