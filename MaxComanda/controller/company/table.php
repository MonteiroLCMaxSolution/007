<?php

$ModelCompany = 'MaxComanda/model/company/company-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelCompany)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelCompany = $tag . $ModelCompany;
include_once($ModelCompany);

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


?>

<table id="tableCompany" class="highlight centered responsive-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Cód.</th>
            <th>Nome / Razão Social</th>
            <th>Fantasia</th>
            <th>CPF / CNPJ</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $count = 1;
        while ($rowSearchCompany = $sqlSearchCompany->fetch()) {
        ?>
            <tr>
                <td><?php echo $count++;?></td>
                <td><?php echo $rowSearchCompany->id; ?></td>
                <td><?php echo $rowSearchCompany->name_razao_social; ?></td>
                <td><?php echo $rowSearchCompany->fantasia; ?></td>
                <td><?php echo $rowSearchCompany->CPF_CNPJ; ?></td>
                <td>
                <a class="btn-floating waves-effect waves-light green tooltipped" data-tooltip="Editar" href="?pg=data-company&idCompany=<?php echo $rowSearchCompany->id; ?>"><i class="material-icons">edit</i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>