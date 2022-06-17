<?php

$ModelPermission = 'MaxComanda/model/permission/permission-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
  if (file_exists($tag . $ModelPermission)) {
    $parametro = 'n';
  } else {
    $tag = '../' . $tag;
  }
}
$ModelPermission = $tag . $ModelPermission;
include_once($ModelPermission);

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


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

if ($ROW_Perm_System_Permission->search == 'N' && $ROW_Perm_System_Permission->include == 'N' && $ROW_Perm_System_Permission->edit == 'N') {
    $modalPermission = $_SERVER['DOCUMENT_ROOT'] . '/MaxComanda/view/modalPermission.php';
    include_once($modalPermission);
}




?>

<section>
  <nav style="max-height: 37px; line-height: 30px; background-color: <?php echo $_SESSION['color']; ?>">
    <div class="container">
      <div class="center pageBreadcrumb">
        <a href="index.php" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Home</a>
        <a href="?pg=profile" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Listar Grupo / Perfil</a>
        <a href="#" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>"><?php echo $pageName; ?></a>
      </div>
    </div>
  </nav>
  <section>


    <section>
      <h5>Permissões para o Perfil: <?php echo $nameProfile; ?></h5>
      <div class="row">
        <div class="col s12">
          <div class="card hoverable" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">

            <div class="container">


              <table id="tableProfile" class="highlight centered responsive-table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Menu</th>
                    <th>Permissão Total</th>
                    <th>Consultar</th>
                    <th>Incluir</th>
                    <th>Editar</th>
                    <th>Ação</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  $cont = 1;
                  while ($rowPermission = $listPermission->fetch()) {

                  ?>
                    <form id="formPermission<?php echo $rowPermission->id; ?>" method="POST">

                      <tr>
                        <td><?php echo $cont; ?></td>
                        <td><?php echo $rowPermission->menu; ?></td>
                        <td>
                          <div class="switch">
                            <label>
                              Não
                              <input type="checkbox" id="full_permission<?php echo $rowPermission->id; ?>" name="full_permission<?php echo $rowPermission->id; ?>" value="S" <?php if ($rowPermission->full_permission == "S") { ?> checked <?php } ?> onclick="fullPermission('<?php echo $rowPermission->id; ?>');unlockBtn('<?php echo $rowPermission->id; ?>')">
                              <span class="lever"></span>
                              Sim
                            </label>
                          </div>
                        </td>
                        <td>
                          <p>
                            <label>
                              <input type="checkbox" <?php if ($rowPermission->search == "S") { ?> checked <?php } ?> id="search<?php echo $rowPermission->id; ?>" name="search<?php echo $rowPermission->id; ?>" value="S" onclick="unlockBtn('<?php echo $rowPermission->id; ?>');verifypermission('<?php echo $rowPermission->id; ?>')" />
                              <span>Consultar</span>
                            </label>
                          </p>
                        </td>
                        <td>
                          <p>
                            <label>
                              <input type="checkbox" <?php if ($rowPermission->include == "S") { ?> checked <?php } ?> id="include<?php echo $rowPermission->id; ?>" name="include<?php echo $rowPermission->id; ?>" value="S" onclick="unlockBtn('<?php echo $rowPermission->id; ?>');verifypermission('<?php echo $rowPermission->id; ?>')" />
                              <span>Incluir</span>
                            </label>
                          </p>
                        </td>
                        <td>
                          <p>
                            <label>
                              <input type="checkbox" <?php if ($rowPermission->edit == "S") { ?> checked <?php } ?> id="edit<?php echo $rowPermission->id; ?>" name="edit<?php echo $rowPermission->id; ?>" value="S" onclick="unlockBtn('<?php echo $rowPermission->id; ?>');verifypermission('<?php echo $rowPermission->id; ?>')" />
                              <span>Editar</span>
                            </label>
                          </p>
                        </td>
                        <td>


                        <?php if ($ROW_Perm_System_Permission->include == 'S' || $ROW_Perm_System_Permission->edit == 'S') { ?>

                          <a class="btn-floating waves-effect waves-light blue tooltipped" data-tooltip="Salvar" disabled id="btnSavePermission<?php echo $rowPermission->id; ?>" name="btnSavePermission<?php echo $rowPermission->id; ?>" onclick="savePermission('<?php echo $rowPermission->id; ?>')"><i class="material-icons">done</i></a>

                          <?php } ?>


                        </td>
                      </tr>
                    </form>
                  <?php
                    $cont++;
                  } ?>


                </tbody>
              </table>



            </div> <!-- .container -->


          </div> <!-- .card -->
        </div> <!-- .col -->
      </div> <!-- .row -->
    </section>