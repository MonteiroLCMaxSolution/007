<?php

$ConexaoMysql = $_COOKIE['server'] . '/model/user/user-model.php';
include_once($ConexaoMysql);
?>


<table id="tableUser">
    <thead>
        <tr>
            <th>#</th>
            <th>Cód.</th>
            <th>Nome</th>
            <th>Perfil</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 1;
        while ($rowSearchUser = $sqlSearchUser->fetch()) {
        ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $rowSearchUser->id_user; ?></td>
                <td><?php echo $rowSearchUser->name; ?></td>
                <td><?php echo $rowSearchUser->profile_name; ?></td>
                <td>
                    <a href="?pg=data-user&idUser=<?php echo $rowSearchUser->id; ?>"><i class="fas fa-edit i-edit" title="Editar"></i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
