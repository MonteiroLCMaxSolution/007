<?php

$ModelSupply = 'MaxComanda/model/supply/supply-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelSupply)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelSupply = $tag . $ModelSupply;
include_once($ModelSupply);

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


?>

<table id="tableSupply" class="highlight centered responsive-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Cód.</th>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $count = 1;
        while ($rowSearchSupply = $sqlSearchSupply->fetch()) {
        ?>
            <tr>
                <td><?php echo $count++;?></td>
                <td><?php echo $rowSearchSupply->id; ?></td>
                <td><?php echo $rowSearchSupply->name; ?></td>
                <td><?php echo $rowSearchSupply->quantity; ?></td>
                <td>
                <a class="btn-floating waves-effect waves-light green tooltipped" data-tooltip="Editar" href="?pg=data-supply&idSupply=<?php echo $rowSearchSupply->id; ?>"><i class="material-icons">edit</i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>