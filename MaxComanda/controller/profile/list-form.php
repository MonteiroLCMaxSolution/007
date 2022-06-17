<?php

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
                <a href="#" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>"><?php echo $pageName; ?></a>
            </div>
        </div>
    </nav>
</section>

<section>
    <div class="row">
        <div class="col s12">
            <div class="card hoverable" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">

                <div class="card-content">
                    <div class="row">
                        <div class="input-field col s10">
                            <input id="profileName" type="text">
                            <label for="profileName">Nome do Perfil</label>
                            <span class="helper-text">Pesquise pelo Nome</span>
                        </div>
                        <div class="col s1 left">
                            <br />
                            <a class="btn-floating waves-effect waves-light blue tooltipped" data-tooltip="Pesquisar" onclick="searchProfile()"><i class="material-icons">search</i></a>
                        </div>
                    </div>

                </div>

                <?php if ($ROW_Perm_System_Permission->include == 'S') { ?>

                <a href="?pg=data-profile" class="btn-floating halfway-fab waves-effect waves-light green tooltipped" data-tooltip="Adicionar"><i class="material-icons">add</i></a>

                <?php } ?>

            </div>
        </div>
    </div>
</section>

<section>
    <div class="row">
        <div class="col s12">
            <div class="card-panel hoverable" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">
                <div id="listProfile"></div>
            </div>
        </div>
    </div>
</section>