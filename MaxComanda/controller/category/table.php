<?php

$ModelCategory = 'MaxComanda/model/category/category-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelCategory)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelCategory = $tag . $ModelCategory;
include_once($ModelCategory);


?>

<script>
$(document).ready(function(){
    $('.tooltipped').tooltip({
		inDuration: 350,
		position: 'bottom'
	});
  });
</script>

<table id="tableCategory" class="highlight centered responsive-table">
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
                <td><?php echo $rowSearchCategory->id; ?></td>
                <td><?php echo $rowSearchCategory->name; ?></td>
                <td><?php echo $rowSearchCategory->status; ?></td>
                <td>
                    <a class="btn-floating waves-effect waves-light green tooltipped" data-tooltip="Editar" href="?pg=data-category&idCategory=<?php echo $rowSearchCategory->id; ?>"><i class="material-icons">edit</i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>