<?php

$userModel = $_COOKIE['server'].'/model/user/user-model.php';
include_once($userModel);

$ModelUserPermission = $_COOKIE['server'].'/model/permission/user-permission.php';
include_once($ModelUserPermission);
if(!empty($ROW_Perm_Register_Company->search)){
if ($ROW_Perm_System_User->search == 'N' && $ROW_Perm_System_User->include == 'N' && $ROW_Perm_System_User->edit == 'N') {
    $modalPermission = $_COOKIE['server'] . '/view/modalPermission.php';
    include_once($modalPermission);
}
}
?>



<section class="list">
    <div class="center">
        <div class="section-title">
            <h2>Listar Usuários</h2>
        </div><!--section-title-->
        <form action="" class="list">
            <input type="text" name="userName" id="userName" placeholder="Nome do Usuário">
            <button type="button" class="search-btn float-l" onclick="searchUser()">Pesquisar</button>

            <?php if(!empty($ROW_Perm_Register_Company->search)){
	if ($ROW_Perm_System_User->include == 'S') { ?>
            <a href="?pg=data-user" class="new-btn float-r">Adicionar</a>
            <?php }
}?>
            <div class="clear"></div>
        </form>

        <div id="listUser"></div>


    </div><!--center-->
</section><!--listar-->

