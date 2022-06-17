<?php

$ModelClient = 'MaxComanda/model/client/client-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelClient)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelClient = $tag . $ModelClient;
include_once($ModelClient);


?>

<table id="tableClient" class="highlight centered responsive-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Cód.</th>
            <th>Nome</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $count = 1;
        while ($rowSearchClient = $sqlSearchClient->fetch()) {
        ?>
            <tr>
                <td><?php echo $count++;?></td>
                <td><?php echo $rowSearchClient->id; ?></td>
                <td><?php echo $rowSearchClient->name_razao_social; ?></td>
                <td><?php echo $rowSearchClient->status; ?></td>
                <td>
                <a class="btn-floating waves-effect waves-light green tooltipped" data-tooltip="Editar" href="?pg=data-client&idClient=<?php echo $rowSearchClient->id; ?>"><i class="material-icons">edit</i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>