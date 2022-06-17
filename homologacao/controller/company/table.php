<?php


ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

$ModelCompany = $_COOKIE['server'] . '/model/company/company-model.php';
include_once($ModelCompany);
?>



<table id="tableCompany">
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
                <td><?php echo $count++; ?></td>
                <td><?php echo $rowSearchCompany->id_sequence; ?></td>
                <td><?php echo $rowSearchCompany->name_razao_social; ?></td>
                <td><?php echo $rowSearchCompany->fantasia; ?></td>
                <td><?php echo $rowSearchCompany->CPF_CNPJ; ?></td>
                <td>
                    <a href="?pg=data-company&idCompany=<?php echo $rowSearchCompany->id; ?>">
                        <i class="fas fa-edit i-edit" title="Editar"></i>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

