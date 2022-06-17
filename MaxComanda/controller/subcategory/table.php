<?php

$ModelSubcategory = 'MaxComanda/model/subcategory/subcategory-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelSubcategory)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelSubcategory = $tag . $ModelSubcategory;
include_once($ModelSubcategory);


?>



<script>
$(document).ready(function(){
    $('.tooltipped').tooltip({
		inDuration: 350,
		position: 'bottom'
	});
  });
</script>

<table id="tableSubcategory" class="highlight centered responsive-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Cód.</th>
            <th>Categoria</th>
            <th>Nome</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $count = 1;
        while ($rowSearchSubcategory = $sqlSearchSubcategory->fetch()) {
        ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $rowSearchSubcategory->id; ?></td>
                <td><?php echo $rowSearchSubcategory->category_name; ?></td>
                <td><?php echo $rowSearchSubcategory->name; ?></td>
                <td><?php echo $rowSearchSubcategory->status; ?></td>
                <td>
                    <a class="btn-floating waves-effect waves-light green tooltipped" data-tooltip="Editar" href="?pg=data-subcategory&idSubcategory=<?php echo $rowSearchSubcategory->id; ?>"><i class="material-icons">edit</i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>