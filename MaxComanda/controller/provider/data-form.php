<?php

$ModelProvider = 'MaxComanda/model/provider/provider-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
  if (file_exists($tag . $ModelProvider)) {
    $parametro = 'n';
  } else {
    $tag = '../' . $tag;
  }
}
$ModelProvider = $tag . $ModelProvider;
include_once($ModelProvider);

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

if ($ROW_Perm_Register_Provider->search == 'N' && $ROW_Perm_Register_Provider->include == 'N' && $ROW_Perm_Register_Provider->edit == 'N') {
  $modalPermission = $_SERVER['DOCUMENT_ROOT'] . '/MaxComanda/view/modalPermission.php';
  include_once($modalPermission);
}


?>
<section>
  <nav style="max-height: 37px; line-height: 30px; background-color: <?php echo $_SESSION['color']; ?>">
    <div class="container">
      <div class=" center pageBreadcrumb">
        <a href="index.php" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Home</a>
        <a href="?pg=provider" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Listar Fornecedores</a>
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
          <form id="formProvider" enctype="multipart/form-data" method="POST">
            <div class="row">
              <div class="input-field col s2 m2 l2">
                <input id="id" name="id" type="text" readonly value="<?php echo $list_id; ?>">
                <label for="id">ID</label>
              </div>

              <div class="input-field col s10 m4 l3">
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

              <div class="input-field col s4 m4 l2">
                <label for="CEP" class="active">CEP</label>
                <input type="text" id="CEP" name="CEP" onkeyup="validaForm()" onBlur="buscaCEP(this.value)" value="<?php echo $list_CEP; ?>" maxlength="9">
                <span class="helper-text" id="msgCEP"></span>
              </div>

              <div class="input-field col s8 m8 l5">
                <label for="address" class="active">Endereço</label>
                <input type="text" id="address" name="address" onkeyup="validaForm()" value="<?php echo $list_address; ?>">
                <span class="helper-text" id="msgAddress"></span>
              </div>

              <div class="input-field col s3 m3 l2">
                <label for="number" class="active">Número</label>
                <input type="text" id="number" name="number" onkeyup="validaForm()" value="<?php echo $list_number; ?>">
                <span class="helper-text" id="msgNumber"></span>
              </div>

              <div class="input-field col s9 m9 l3">
                <label for="complement" class="active">Complemento</label>
                <input type="text" id="complement" name="complement" onkeyup="validaForm()" value="<?php echo $list_complement; ?>">
                <span class="helper-text" id="msgComplement"></span>
              </div>

              <div class="input-field col s12 m5 l5">
                <label for="neighborhood" class="active">Bairro</label>
                <input type="text" id="neighborhood" name="neighborhood" onkeyup="validaForm()" value="<?php echo $list_neighborhood; ?>">
                <span class="helper-text" id="msgNeighborhood"></span>
              </div>

              <div class="input-field col s9 m5 l5">
                <label for="city" class="active">Cidade</label>
                <input type="text" id="city" name="city" onkeyup="validaForm()" value="<?php echo $list_city; ?>" readonly>
                <span class="helper-text" id="msgCity"></span>
              </div>

              <div class="input-field col s3 m2 l2">
                <label for="UF" class="active">UF</label>
                <input type="text" id="UF" name="UF" onkeyup="validaForm()" value="<?php echo $list_UF; ?>" readonly>
                <span class="helper-text" id="msgUF"></span>
              </div>

              <div class="input-field col s12 m6 l3">
                <label for="phone" class="active">Telefone</label>
                <input type="text" id="phone" name="phone" onkeyup="validaForm()" value="<?php echo $list_phone; ?>" class="phone">
                <span class="helper-text" id="msgPhone"></span>
              </div>

              <div class="input-field col s12 m6 l3">
                <label for="contact" class="active" id="lContact">Contato</label>
                <input type="text" id="contact" name="contact" onkeyup="validaForm()" value="<?php echo $list_contact; ?>">
                <span class="helper-text" id="msgContact"></span>
              </div>

              <div class="input-field col s12 m5 l6">
                <label for="email" class="active">Email</label>
                <input type="text" id="email" name="email" onkeyup="validaForm()" value="<?php echo $list_email; ?>">
                <span class="helper-text" id="msgEmail"></span>
              </div>

              <div class="input-field col s12 m5 l9">
                <label for="site" class="active">Site</label>
                <input type="text" id="site" name="site" onkeyup="validaForm()" value="<?php echo $list_site; ?>">
                <span class="helper-text" id="msgSite"></span>
              </div>

              <div class="input-field col s12 m2 l3">
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
                <input type="text" id="date_register" name="date_register" onkeyup="validaForm()" value="<?php if (isset($list_date_register) && $list_date_register != 0) {echo date("d/m/Y H:i:s", strtotime($list_date_register));}  ?>" readonly>
              </div>

              <div class="input-field col s6 m6 l3">
                <label for="user_register" class="active">Usuário Cadastro</label>
                <input type="text" id="user_register" name="user_register" onkeyup="validaForm()" value="<?php echo $list_user_register;  ?>" readonly>
              </div>

              <div class="input-field col s6 m6 l3">
                <label for="last_update" class="active">Última Atualização</label>
                <input type="text" id="last_update" name="last_update" onkeyup="validaForm()" value="<?php if (isset($list_last_update) && $list_last_update != 0) {echo date("d/m/Y H:i:s", strtotime($list_last_update));} ?>" readonly>
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
    <li><a href="?pg=provider" class="btn-floating red waves-effect waves-light tooltipped" data-position="left" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a></li>

    <?php if ((isset($_GET['idProvider']) && $ROW_Perm_Register_Provider->edit == 'S') || (!isset($_GET['idProvider']) && $ROW_Perm_Register_Provider->include == 'S')) { ?>

    <li><a class="btn-floating blue waves-effect waves-light tooltipped" data-position="left" data-tooltip="Salvar" id="btnSaveProvider" disabled onclick="saveProvider()"><i class="material-icons">done</i></a></li>

    <?php } ?>


  </ul>
</div>