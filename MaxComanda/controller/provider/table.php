<?php

$ModelProvider = 'MaxComanda/model/provider/provider-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelProvider)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelProvider = $tag . $ModelProvider;
include_once($ModelProvider);


?>

<table id="tableProvider" class="highlight centered responsive-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Cód.</th>
            <th>Nome / Razão Social</th>
            <th>Fantasia</th>
            <th>CPF / CNPJ</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $count = 1;
        while ($rowSearchProvider = $sqlSearchProvider->fetch()) {
        ?>
            <tr>
                <td><?php echo $count++;?></td>
                <td><?php echo $rowSearchProvider->id; ?></td>
                <td><?php echo $rowSearchProvider->name_razao_social; ?></td>
                <td><?php echo $rowSearchProvider->fantasia; ?></td>
                <td><?php echo $rowSearchProvider->CPF_CNPJ; ?></td>
                <td><?php echo $rowSearchProvider->status; ?></td>
                <td>
                <a class="btn-floating waves-effect waves-light green tooltipped" data-tooltip="Editar" href="?pg=data-provider&idProvider=<?php echo $rowSearchProvider->id; ?>"><i class="material-icons">edit</i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>