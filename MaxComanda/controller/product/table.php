<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
if(!isset($_SESSION)){
	session_start();
}

$ModelProduct = 'MaxComanda/model/product/product-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelProduct)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelProduct = $tag . $ModelProduct;
include_once($ModelProduct);


?>

<table id="tableProduct" class="highlight centered responsive-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Cód.</th>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Subcategoria</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $count = 1;
        while ($rowSearchProduct = $sqlSearchProduct->fetch()) {
        ?>
            <tr>
                <td><?php echo $count++;?></td>
                <td><?php echo $rowSearchProduct->id; ?></td>
                <td><?php echo $rowSearchProduct->name; ?></td>
                <td><?php if($rowSearchProduct->defineStock == 'S') { echo $rowSearchProduct->total; } else{ echo '-';} ?></td>
                <td><?php echo $rowSearchProduct->subcategory_name; ?></td>
                <td>
                <a class="btn-floating waves-effect waves-light green tooltipped" data-tooltip="Editar" href="?pg=data-product&idProduct=<?php echo $rowSearchProduct->id; ?>"><i class="material-icons">edit</i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>