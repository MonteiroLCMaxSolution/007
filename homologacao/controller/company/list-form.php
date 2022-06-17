<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

$userPermissionModel = $_SESSION['server'] . '/model/permission/user-permission.php';
include_once($userPermissionModel);

if(!empty($ROW_Perm_Register_Company->search)){
if ($ROW_Perm_Register_Company->search == 'N' && $ROW_Perm_Register_Company->include == 'N' && $ROW_Perm_Register_Company->edit == 'N') {
    $modalPermission = $_SESSION['server']. '/view/modalPermission.php';
    include_once($modalPermission);
}
}

?>

<section class="list">
    <div class="center">
        <div class="section-title">
            <h2>Listar Empresas</h2>
        </div><!--section-title-->
        <form action="" class="list">
            <input type="text" id="companyName" placeholder="Nome da empresa">
            <button type="button" onclick="searchCompany()" class="search-btn float-l">Pesquisar</button>
            <?php 
			
if(!empty($ROW_Perm_Register_Company->search)){if ($ROW_Perm_Register_Company->include == 'S') { ?>
            <a href="?pg=data-company" class="new-btn float-r">Adicionar</a>
            <?php } } ?>
            <div class="clear"></div>
        </form>


        <div id="listCompany"></div>
        

    </div><!--center-->
</section><!--listar-->

