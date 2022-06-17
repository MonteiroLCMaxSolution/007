<?php

$ModelUser = 'MaxComanda/model/user/user-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelUser)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelUser = $tag . $ModelUser;
include_once($ModelUser);


?>

<table id="tableUser" class="highlight centered responsive-table">
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
                <td><?php echo $count++;?></td>
                <td><?php echo $rowSearchUser->id; ?></td>
                <td><?php echo $rowSearchUser->name; ?></td>
                <td><?php echo $rowSearchUser->profile; ?></td>
                <td>
                <a class="btn-floating waves-effect waves-light green tooltipped" data-tooltip="Editar" href="?pg=data-user&idUser=<?php echo $rowSearchUser->id; ?>"><i class="material-icons">edit</i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>