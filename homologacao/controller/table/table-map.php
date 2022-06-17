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

/*ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);*/


?>

<table id="tableMap" class="highlight centered responsive-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Cód.</th>
            <th>Descrição</th>
            <th>Andar</th>
            <th>Setor</th>
            <th>Lado</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $count = 1;
        while ($rowSearchMap = $sqlSearchMap->fetch()) {
        ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $rowSearchMap->id; ?></td>
                <td><?php echo $rowSearchMap->floor; ?></td>
                <td><?php echo $rowSearchMap->sector; ?></td>
                <td><?php echo $rowSearchMap->side; ?></td>
                <td><?php echo $rowSearchMap->description; ?></td>
                <td>

                    <div class="switch">
                        <label>
                            Inativo
                            <input type="checkbox" id="status<?php echo $rowSearchMap->id; ?>" value="S" <?php if ($rowSearchMap->status == "Ativo") { ?> checked <?php } ?> onclick="statusMap('<?php echo $rowSearchMap->id; ?>')">
                            <span class="lever"></span>
                            Ativo
                        </label>
                    </div>

                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>