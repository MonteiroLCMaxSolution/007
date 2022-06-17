<?php
$ConexaoMysql = $_COOKIE['server'] . '/model/category/category-model.php';
include_once($ConexaoMysql);

$ModelUserPermission = $_COOKIE['server'] . '/model/permission/user-permission.php';
include_once($ModelUserPermission);

if ($ROW_Perm_Register_Category->search == 'N' && $ROW_Perm_Register_Category->include == 'N' && $ROW_Perm_Register_Category->edit == 'N') {
  $modalPermission = $_COOKIE['server'] . '/view/modalPermission.php';
  include_once($modalPermission);
}


?>

<script>
  function countText(input) {
    var length = input.value.length;
    $("#count").html(length);
  }
</script>

<section class="register-form">
  <div class="center">
    <div class="section-title">
      <h2>Cadastrar Categoria</h2>
    </div>
    <!--section-title-->
    <form id="formCategory" class="flexbox">
      <div class="inp-single w20">
        <p>ID</p>
        <input type="text" readonly value="<?php echo $list_id_sequence; ?>">
        <input id="id" name="id" hidden type="text" readonly value="<?php echo $list_id; ?>">
      </div>
      <!--inp-single-->
      <div class="inp-single w40">
        <p id="p-name">Nome da Categoria</p>
        <input type="text" id="name" name="name" onkeyup="countText(this);validaForm()" value="<?php echo $list_name; ?>" maxlength="25">
        <small><span id="count"><?php echo strlen($list_name); ?></span>/25</small>
      </div>
      <!--inp-single-->
      <div class="inp-single w40">
        <p id="p-status">Status</p>
        <select id="status" name="status" onchange="validaForm()">
          <option value="Ativo" <?php if ($list_status == "Ativo") {
                                  echo "selected";
                                } ?>>Ativo</option>
          <option value="Inativo" <?php if ($list_status == "Inativo") {
                                    echo "selected";
                                  } ?>>Inativo</option>
        </select>
      </div>
      <!--inp-single-->
      <div class="buttons-box">
        <a href="?pg=category">Cancelar</a>

        <?php if ((isset($_GET['idCategory']) && $ROW_Perm_Register_Category->edit == 'S') || (!isset($_GET['idCategory']) && $ROW_Perm_Register_Category->include == 'S')) { ?>

          <button type="submit" id="btnSaveCategory" disabled onclick="saveCategory()">Salvar</button>

        <?php } ?>



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
  </div>
  <!--center-->
</section>
<!--register-form-->