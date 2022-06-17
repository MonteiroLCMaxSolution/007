<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (!isset($_SESSION)) {
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
<script>
    $(document).ready(function() {
        $('.tooltipped').tooltip({
            inDuration: 350,
            position: 'bottom'
        });
        $('.money').mask('#.##0,00', {reverse: true});
    });
</script>
<table id="tableAddition" class="highlight centered responsive-table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Status</th>
            <th>Valor</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>
        <?php
        while ($rowSearchAddition = $sqlSearchAddition->fetch()) {
        ?>
            <tr>
                <td>
                    <?php echo $rowSearchAddition->name; ?>
                </td>
                <td>
                    <div class="switch">
                        <label>
                            Inativo
                            <input type="checkbox" id="statusAddition<?php echo $rowSearchAddition->id; ?>" value="Ativo" <?php if($rowSearchAddition->status == 'Ativo') { ?> checked <?php } ?> onclick="validaEditAddition(<?php echo $rowSearchAddition->id; ?>)">
                            <span class="lever"></span>
                            Ativo
                        </label>
                    </div>
                </td>
                <td>
                <input type="text" id="valueAddition<?php echo $rowSearchAddition->id; ?>" value="<?php echo number_format($rowSearchAddition->value, 2, ',', '');  ?>" onkeyup="validaEditAddition(<?php echo $rowSearchAddition->id; ?>)" class="money">
                </td>
                <td>
                    <a class="btn-floating waves-effect waves-light purple tooltipped" data-tooltip="Salvar Alterações" disabled id="btnEditAddition<?php echo $rowSearchAddition->id; ?>" onclick="editAddition('<?php echo $rowSearchAddition->id; ?>')"><i class="material-icons">done</i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>