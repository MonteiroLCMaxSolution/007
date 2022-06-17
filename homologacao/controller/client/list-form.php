<?php
$userPermissionModel = $_COOKIE['server'] . '/model/permission/user-permission.php';
include_once($userPermissionModel);

if(!empty($ROW_Perm_Register_Company->search)){
if ($ROW_Perm_Register_Client->search == 'N' && $ROW_Perm_Register_Client->include == 'N' && $ROW_Perm_Register_Client->edit == 'N') {

    $modalPermission = $_COOKIE['server'] . '/view/modalPermission.php';
    include_once($modalPermission);
}
}

?>


<section class="list">
    <div class="center">
        <div class="section-title">
            <h2>Listar Clientes</h2>
        </div>
        <!--section-title-->
        <form action="" class="list">
            <input type="text" id="clientName" placeholder="Nome do(a) cliente">
            <button type="button" class="search-btn float-l" onclick="searchClient()">Pesquisar</button>

            <?php 
			if(!empty($ROW_Perm_Register_Company->search)){
				if ($ROW_Perm_Register_Client->include == 'S') { ?>
                <a href="?pg=data-client" class="new-btn float-r">Adicionar</a>
            <?php }
			}
			?>
            <div class="clear"></div>
        </form>

        <div id="listClient"></div>

    </div>
    <!--center-->
</section>
<!--listar-->

