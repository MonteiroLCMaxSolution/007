<?php

$ModelTable = 'MaxComanda/model/table/table-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelTable)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelTable = $tag . $ModelTable;
include_once($ModelTable);

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);




?>

<table id="tableTable" class="highlight centered responsive-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Cód.</th>
            <th>Local / Mapa</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $count = 1;
        while ($rowSearchTable = $sqlSearchTable->fetch()) {
        ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $rowSearchTable->id; ?></td>
                <td><?php echo $rowSearchTable->description; ?></td>
                <td><?php echo $rowSearchTable->status; ?></td>
                <td>
                    <a class="btn-floating waves-effect waves-light green tooltipped" data-tooltip="Editar" href="?pg=data-table&idTable=<?php echo $rowSearchTable->id; ?>"><i class="material-icons">edit</i></a>
                </td>
            </tr>

        <?php } ?>
    </tbody>
</table>