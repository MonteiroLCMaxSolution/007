<?php
$clientModel = $_SESSION['server'] . '/model/client/client-model.php';
include_once($clientModel);

$ModelUserPermission = $_SESSION['server'] . '/model/permission/user-permission.php';
include_once($ModelUserPermission);

if ($ROW_Perm_Register_Client->search == 'N' && $ROW_Perm_Register_Client->include == 'N' && $ROW_Perm_Register_Client->edit == 'N') {
    $modalPermission = $_SESSION['server'] . '/view/modalPermission.php';
    include_once($modalPermission);
}

?>


<section class="register-form">
    <div class="center">
        <div class="section-title">
            <h2>Informações Principais</h2>
        </div>
        <!--section-title-->
        <form id="formClient" class="flexbox">
            <div class="inp-single w20">
                <p>ID</p>
                <input type="text" value="<?php echo $list_id_sequence; ?>" readonly>
                <input type="text" name="id" id="id" value="<?php echo $list_id; ?>" readonly hidden>
            </div>
            <!--inp-single-->

            <div class="inp-single w40">
                <p id="p-cpf_cnpj">CPF / CNPJ</p>
                <input type="text" name="cpf_cnpj" id="cpf_cnpj" class="cpf_cnpj" onkeyup="validaForm();buscaCNPJ(this.value)" placeholder="Apenas Números" value="<?php echo $list_CPF_CNPJ; ?>" <?php if (!empty($list_CPF_CNPJ)) { ?> readonly <?php } ?>>
                <input hidden id="type" name="type" value="<?php echo $list_type; ?>">
            </div>
            <!--inp-single-->

            <div class="inp-single w40">
                <p id="p-name_razSocial">Nome / Razão social</p>
                <input type="text" name="name_razSocial" id="name_razSocial" onkeyup="validaForm()" value="<?php echo $list_name_razSocial; ?>">
            </div>
            <!--inp-single-->

            <div class="inp-single w33 formCNPJ">
                <p id="p-fantasia">Fantasia</p>
                <input type="text" name="fantasia" id="fantasia" onkeyup="validaForm()" value="<?php echo $list_fantasia; ?>">
            </div>
            <!--inp-single-->

            <div class="inp-single w33 formCNPJ">
                <p id="p-insc_municipal">Inscrição Municipal</p>
                <input type="text" name="insc_municipal" id="insc_municipal" onkeyup="validaForm()" value="<?php echo $list_insc_municipal; ?>">
            </div>
            <!--inp-single-->

            <div class="inp-single w33 formCNPJ">
                <p id="p-insc_estadual">Inscrição Estadual</p>
                <input type="text" name="insc_estadual" id="insc_estadual" onkeyup="validaForm()" value="<?php echo $list_insc_estadual; ?>">
            </div>
            <!--inp-single-->

            <div class="inp-single w33">
                <p id="p-surname">Apelido</p>
                <input type="text" name="surname" id="surname" onkeyup="validaForm()" value="<?php echo $list_surname; ?>">
            </div>
            <!--inp-single-->

            <div class="inp-single w33">
                <p id="p-email">Email</p>
                <input type="email" name="email" id="email" onkeyup="validaForm()" value="<?php echo $list_email; ?>">
            </div>
            <!--inp-single-->

            <div class="inp-single w33">
                <p id="p-password">Senha</p>
                <input type="password" name="password" id="password" onkeyup="validaForm()">
            </div>
            <!--inp-single-->

            <div class="inp-single w33">
                <p id="p-status">Status</p>
                <select name="status" id="status" onchange="validaForm()">
                    <option value="Ativo" <?php if ($list_status == "Ativo") {
                                                echo "selected";
                                            } ?>>Ativo</option>
                    <option value="Inativo" <?php if ($list_status == "Inativo") {
                                                echo "selected";
                                            } ?>>Inativo</option>
                </select>
            </div>
            <!--inp-single-->

            <div class="inp-single w33">
                <p id="p-phone">Telefone</p>
                <input type="text" name="phone" id="phone" class="phone" onkeyup="validaForm()" value="<?php echo $list_phone; ?>">
            </div>
            <!--inp-single-->

            <div class="inp-single w33">
                <p id="p-birthday">Data - Nascimento</p>
                <input type="date" name="birthday" id="birthday" onkeyup="validaForm()" value="<?php echo $list_birthday; ?>">
            </div>
            <!--inp-single-->



            <div class="buttons-box">
                <a href="?pg=client">Cancelar</a>
                <button type="submit" id="btnSaveClient" disabled onclick="saveClient()">Confirmar</button>
            </div>
            <!--buttons-box-->
            <div class="clear"></div>

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

    </div> <!-- /.center -->
</section> <!-- Informações Principais -->

<?php if (isset($_GET['idClient'])) { ?>
    <section class="register-form" id="sectionClientAddress">
        <div class="center">

            <div class="section-title">
                <h2>Endereços</h2>
            </div>




            <form id="formClientAddress" method="POST" class="flexbox">

                <div class="inp-single w33">
                    <p id="p-CEP">CEP</p>
                    <input type="text" name="CEP" id="CEP" onkeyup="validaFormAddress();buscaCEP('validaFormAddress')" maxlength="9">
                    <input type="text" name="idAddress" id="idAddress" readonly hidden>
                </div>
                <!--inp-single-->

                <div class="inp-single w33">
                    <p id="p-address">Endereço</p>
                    <input type="text" name="address" id="address" onkeyup="validaFormAddress()">
                </div>
                <!--inp-single-->

                <div class="inp-single w33">
                    <p id="p-number">Número</p>
                    <input type="text" name="number" id="number" onkeyup="validaFormAddress()">
                </div>
                <!--inp-single-->

                <div class="inp-single w33">
                    <p id="p-complement">Complemento</p>
                    <input type="text" name="complement" id="complement" onkeyup="validaFormAddress()">
                </div>
                <!--inp-single-->

                <div class="inp-single w33">
                    <p id="p-district">Bairro</p>
                    <input type="text" name="district" id="district" onkeyup="validaFormAddress()">
                </div>
                <!--inp-single-->

                <div class="inp-single w33">
                    <p id="p-city">Cidade</p>
                    <input type="text" name="city" id="city" onkeyup="validaFormAddress()">
                </div>
                <!--inp-single-->

                <div class="inp-single w33">
                    <p id="p-UF">UF</p>
                    <input type="text" name="UF" id="UF" onkeyup="validaFormAddress()">
                </div>
                <!--inp-single-->

                <div class="buttons-box">
                    <button type="submit" id="btnSaveClientAddress" disabled onclick="saveClientAddress()">Confirmar</button>
                </div>
                <!--buttons-box-->
                <div class="clear"></div>






            </form>

        </div> <!-- /.center -->
    </section> <!-- Endereços -->

    <section class="list">
        <div class="center">
            <div id="listClientAddress">
                <?php include_once("table-address.php"); ?>
            </div>
        </div>
    </section>


<?php } ?>





















<?php /*


<div class="inp-single w40">
    <p class="p-cpf">CPF</p>
    <input type="text" name="" id="cpf-cliente" onkeyup="validarFormulario()" placeholder="000.000.000-00">
</div>
<!--inp-single-->
<div class="inp-single w40">
    <p class="p-nome">Nome / Razão social</p>
    <input type="text" name="" id="nome-cliente" onkeyup="validarFormulario()" placeholder="João">
</div>
<!--inp-single-->
<div class="inp-single w33">
    <p class="p-fantasia">Fantasia</p>
    <input type="text" name="" id="fantasia-cliente" onkeyup="validarFormulario()">
</div>
<!--inp-single-->
<div class="inp-single w33">
    <p class="p-apelido">Apelido</p>
    <input type="text" name="" id="apelido-cliente" onkeyup="validarFormulario()" placeholder="Jô">
</div>
<!--inp-single-->
<div class="inp-single w33">
    <p class="p-nascimento">Data de Nascimento</p>
    <input type="text" name="" id="nascimento-cliente" placeholder="Selecionar data">
</div>
<!--inp-single-->
<div class="inp-single w50">
    <p class="p-municipal">Inscrição Municipal</p>
    <input type="text" name="" id="municipal-cliente" onkeyup="validarFormulario()">
</div>
<!--inp-single-->
<div class="inp-single w50">
    <p class="p-estadual">Inscrição Estadual</p>
    <input type="text" name="" id="estadual-cliente" onkeyup="validarFormulario()">
</div>
<!--inp-single-->

<div class="form-title w100">
    <h2>Contato</h2>
</div>
<!--form-title-->

<div class="inp-single w50">
    <p class="p-email">Email</p>
    <input type="text" name="" id="email-cliente" onkeyup="validarFormulario()" placeholder="email@email.com">
</div>
<!--inp-single-->
<div class="inp-single w50">
    <p class="p-telefone">Telefone</p>
    <input type="text" name="" id="telefone-cliente" onkeyup="validarFormulario()" placeholder="(00) 0000-0000">
</div>
<!--inp-single-->

<div class="form-title w100">
    <h2>Dados para login</h2>
</div>
<!--form-title-->

<div class="inp-single w50">
    <p class="p-login">Login</p>
    <input type="text" name="" id="login-cliente" placeholder="Digite seu username" onkeyup="validarFormulario()">
</div>
<!--inp-single-->
<div class="inp-single w50">
    <p class="p-senha">Senha</p>
    <input type="password" name="" id="senha-cliente" placeholder="Digite sua senha" onkeyup="validarFormulario()">
</div>
<!--inp-single-->
<div class="inp-single w50">
    <p class="p-status">Status</p>
    <select name="" id="status-cliente" onchange="validarFormulario()">
        <option value="ativo">Ativo</option>
        <option value="inativo">Inativo</option>
    </select>
</div>
<!--inp-single-->
<div class="buttons-box">
    <a href="<?= INCLUDE_PATH ?>?pg=listar-clientes">Cancelar</a>
    <button type="submit" id="btn-enviar-form">Confirmar</button>
</div>
<!--buttons-box-->
<div class="clear"></div>
</form>
<div class="register-infos flexbox">
    <div class="register-info-single w33">
        <p>Data cadastro</p>
        <input type="text" value="02/02/2022 13:36:56" disabled>
    </div>
    <!--register-info-single-->
    <div class="register-info-single w33">
        <p>Última atualização</p>
        <input type="text" value="Kayky Costa" disabled>
    </div>
    <!--register-info-single-->
    <div class="register-info-single w33">
        <p>Número acessos</p>
        <input type="text" value="4" disabled>
    </div>
    <!--register-info-single-->
</div>
<!--register-infos-->
</div>
<!--center-->
</section>
<!--register-form-->
*/
?>