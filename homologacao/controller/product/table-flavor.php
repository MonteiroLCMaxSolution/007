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
        M.textareaAutoResize($('.materialize-textarea'));
    });
</script>
<table id="tableFlavor" class="highlight centered responsive-table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>
        <?php
        while ($rowSearchFlavor = $sqlSearchFlavor->fetch()) {
        ?>
            <tr>
                <td>
                    <?php echo $rowSearchFlavor->name; ?>
                </td>
                <td>
                    <textarea id="descriptionFlavor<?php echo $rowSearchFlavor->id; ?>" class="materialize-textarea" onkeyup="validaEditFlavor(<?php echo $rowSearchFlavor->id; ?>)"><?php echo $rowSearchFlavor->description; ?></textarea>
                </td>
                <td>
                    <div class="switch">
                        <label>
                            Inativo
                            <input type="checkbox" id="statusFlavor<?php echo $rowSearchFlavor->id; ?>" value="Ativo" <?php if($rowSearchFlavor->status == 'Ativo') { ?> checked <?php } ?> onclick="validaEditFlavor(<?php echo $rowSearchFlavor->id; ?>)">
                            <span class="lever"></span>
                            Ativo
                        </label>
                    </div>
                </td>
                <td>
                    <a class="btn-floating waves-effect waves-light purple tooltipped" data-tooltip="Salvar Alterações" disabled id="btnEditFlavor<?php echo $rowSearchFlavor->id; ?>" onclick="editFlavor('<?php echo $rowSearchFlavor->id; ?>')"><i class="material-icons">done</i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>