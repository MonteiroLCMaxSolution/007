<?php

$ModelSubcategory = 'MaxComanda/model/subcategory/subcategory-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
  if (file_exists($tag . $ModelSubcategory)) {
    $parametro = 'n';
  } else {
    $tag = '../' . $tag;
  }
}
$ModelSubcategory = $tag . $ModelSubcategory;
include_once($ModelSubcategory);

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

if ($ROW_Perm_Register_Subcategory->search == 'N' && $ROW_Perm_Register_Subcategory->include == 'N' && $ROW_Perm_Register_Subcategory->edit == 'N') {
    $modalPermission = $_SERVER['DOCUMENT_ROOT'] . '/MaxComanda/view/modalPermission.php';
    include_once($modalPermission);
}


?>
<section>
  <nav style="max-height: 37px; line-height: 30px; background-color: <?php echo $_SESSION['color']; ?>">
    <div class="container">
      <div class=" center pageBreadcrumb">
        <a href="index.php" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Home</a>
        <a href="?pg=subcategory" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Listar SubCategorias</a>
        <a href="#" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>"><?php echo $pageName; ?></a>
      </div>
    </div>
  </nav>
  <section>

    <section>
      <div class="row">
        <div class="col s12">
          <div class="card hoverable" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">

            <div class="container">
              <form id="formSubcategory" method="POST">
                <div class="row">
                  <div class="input-field col s4 m3 l2">
                    <input id="id" name="id" type="text" readonly value="<?php echo $list_id; ?>">
                    <label for="id">ID</label>
                  </div>

                  <div class="input-field col s8 m9 l3">
                    <select id="category" name="category" onchange="validaForm()">
                      <?php if (!empty($list_category_id)) { ?>
                        <option value="<?php echo $list_category_id; ?>"><?php echo $list_category_name; ?></option>
                      <?php } ?>
                      <option value="">Selecione</option>
                      <?php while ($list_Category = $sqlListCategory->fetch()) { ?>
                        <option value="<?php echo $list_Category->id; ?>"><?php echo $list_Category->name; ?></option>
                      <?php } ?>
                    </select>
                    <label>Categoria</label>
                    <span class="helper-text" id="msgCategory"></span>
                  </div>

                  <div class="input-field col s12 m4 l4">
                    <label for="name" class="active" id="lSubcategoryName">Nome da Subcategoria</label>
                    <input type="text" id="name" name="name" onkeyup="validaForm()" value="<?php echo $list_name; ?>" data-length="25" class="count" maxlength="25">
                    <span class="helper-text" id="msgName"></span>
                  </div>

                  <div class="input-field col s12 m4 l3">
                    <select id="status" name="status" onclick="validaForm()">
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
        <li><a href="?pg=subcategory" class="btn-floating red waves-effect waves-light tooltipped" data-position="left" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a></li>


        <?php if ((isset($_GET['idSubcategory']) && $ROW_Perm_Register_Subcategory->edit == 'S') || (!isset($_GET['idSubcategory']) && $ROW_Perm_Register_Subcategory->include == 'S')) { ?>

        <li><a class="btn-floating blue waves-effect waves-light tooltipped" data-position="left" data-tooltip="Salvar" id="btnSaveSubcategory" disabled onclick="saveSubcategory()"><i class="material-icons">done</i></a></li>

        <?php } ?>


      </ul>
    </div>