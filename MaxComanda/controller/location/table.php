<?php

$ModelLocation = 'MaxComanda/model/location/location-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelLocation)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelLocation = $tag . $ModelLocation;
include_once($ModelLocation);

?>

<script>
$(document).ready(function(){
    $('.tooltipped').tooltip({
		inDuration: 350,
		position: 'bottom'
	});
  });
</script>

<table id="tableLocation" class="highlight centered responsive-table">
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
        while ($rowSearchLocation = $sqlSearchLocation->fetch()) {
        ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $rowSearchLocation->id; ?></td>
                <td><?php echo $rowSearchLocation->name; ?></td>
                <td><?php echo $rowSearchLocation->status; ?></td>
                <td>
                    <a class="btn-floating waves-effect waves-light green tooltipped" data-tooltip="Editar" href="?pg=data-location&idLocation=<?php echo $rowSearchLocation->id; ?>"><i class="material-icons">edit</i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>