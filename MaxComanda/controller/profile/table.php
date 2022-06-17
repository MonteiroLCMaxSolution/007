<?php

$ModelProfile = 'MaxComanda/model/profile/profile-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelProfile)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelProfile = $tag . $ModelProfile;
include_once($ModelProfile);


?>

<script>
$(document).ready(function(){
    $('.tooltipped').tooltip({
		inDuration: 350,
		position: 'bottom'
	});
  });
</script>

<table id="tableProfile" class="highlight centered responsive-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Cód.</th>
            <th>Cód. Empresa</th>
            <th>Nome</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $count = 1;
        while ($rowSearchProfile = $sqlSearchProfile->fetch()) {
        ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $rowSearchProfile->id; ?></td>
                <td><?php echo $rowSearchProfile->id_company; ?></td>
                <td><?php echo $rowSearchProfile->name; ?></td>
                <td><?php echo $rowSearchProfile->status; ?></td>
                <td>
                    <a class="btn-floating waves-effect waves-light green tooltipped" data-tooltip="Editar" href="?pg=data-profile&idProfile=<?php echo $rowSearchProfile->id; ?>"><i class="material-icons">edit</i></a>
                    <a class="btn-floating waves-effect waves-light blue tooltipped" data-tooltip="Permissões" href="?pg=data-permissions&idProfilePermission=<?php echo $rowSearchProfile->id; ?>&idCompany=<?php echo $rowSearchProfile->id_company; ?>"><i class="material-icons">lock</i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>