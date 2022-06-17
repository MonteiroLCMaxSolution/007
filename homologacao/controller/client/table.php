<?php
$clientModel = $_COOKIE['server'].'/model/client/client-model.php';
include_once($clientModel);
?>

<table id="tableClient">
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
                <a href="?pg=data-client&idClient=<?php echo $rowSearchClient->id; ?>"><i class="fas fa-edit i-edit"></i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>