<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

$ConexaoMysql = $_COOKIE['server'] . '/model/permission/user-permission.php';
include_once($ConexaoMysql);

if(!empty($ROW_Perm_Register_Company->search)){
if ($ROW_Perm_Register_Category->search == 'N' && $ROW_Perm_Register_Category->include == 'N' && $ROW_Perm_Register_Category->edit == 'N') {
    $modalPermission = $_COOKIE['server'] . '/view/modalPermission.php';
    //$modalPermission = $_SERVER['DOCUMENT_ROOT'] . '/MaxComanda/view/modalPermission.php';
    include_once($modalPermission);
}
}

?>


<section class="list">
    <div class="center">
        <div class="section-title">
            <h2>Listar Categorias</h2>
        </div>
        <!--section-title-->
        <form action="" class="list">
            <input type="text" name="categoryName" id="categoryName" placeholder="Nome da categoria">
            <button type="button" class="search-btn float-l" onclick="searchCategory()">Pesquisar</button>

            <?php if(!empty($ROW_Perm_Register_Company->search)){ if ($ROW_Perm_Register_Category->include == 'S') { ?>
                <a href="?pg=data-category" class="new-btn float-r">Adicionar</a>
            <?php } } ?>

            <div class="clear"></div>
        </form>

        <div id="listCategory"></div>



    </div>
    <!--center-->
</section>
<!--listar-->
