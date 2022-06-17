<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
$ConexaoMysql = $_COOKIE['server'] . '/model/category/category-model.php';
include_once($ConexaoMysql);

?>

<table>
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
        while ($rowSearchCategory = $sqlSearchCategory->fetch()) {
        ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $rowSearchCategory->id_sequence; ?></td>
                <td><?php echo $rowSearchCategory->name; ?></td>
                <td><?php echo $rowSearchCategory->status; ?></td>
                <td>
                    <a href="?pg=data-category&idCategory=<?php echo $rowSearchCategory->id; ?>">
                    <i class="fas fa-edit i-edit"></i>
                </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

