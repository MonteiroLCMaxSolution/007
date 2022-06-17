<?php

$ModelPromotion = 'MaxComanda/model/promotion/promotion-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelPromotion)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelPromotion = $tag . $ModelPromotion;
include_once($ModelPromotion);

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


?>

<script>
$(document).ready(function(){
    $('.tooltipped').tooltip({
		inDuration: 350,
		position: 'bottom'
	});
  });
</script>

<table id="tablePromotion" class="highlight centered responsive-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Cód.</th>
            <th>Produto</th>
            <th>Status</th>
            <th>Data Início</th>
            <th>Data Fim</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $count = 1;
        while ($rowSearchPromotion = $sqlSearchPromotion->fetch()) {
        ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $rowSearchPromotion->id; ?></td>
                <td><?php echo $rowSearchPromotion->product_name; ?></td>
                <td><?php echo $rowSearchPromotion->status; ?></td>
                <td><?php echo date("d/m/Y", strtotime($rowSearchPromotion->start_date)); ?></td>
                <td><?php echo date("d/m/Y", strtotime($rowSearchPromotion->end_date)); ?></td>
                <td>
                    <a class="btn-floating waves-effect waves-light green tooltipped" data-tooltip="Editar" href="?pg=data-promotion&idPromotion=<?php echo $rowSearchPromotion->id; ?>"><i class="material-icons">edit</i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>