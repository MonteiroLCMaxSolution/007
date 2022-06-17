<?php

$ModelPDV = 'MaxComanda/model/PDV/PDV-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelPDV)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelPDV = $tag . $ModelPDV;
include_once($ModelPDV);

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


?>

<script>
    $(document).ready(function() {
        $('select').formSelect();
        $('.money').mask('#.##0,00', {reverse: true});
        M.updateTextFields();
    });
</script>

<div class="modal-content">
    <h4 class="center">Selecione um Caixa e informe um valor para começar</h4>

        <div class="input-field col s12 m12 l12">
            <label for="change_money" class="active">Caixa Inicial</label>
            <input type="text" id="change_money" name="change_money" class="money" onkeyup="validaForm()" value="">
            <span class="helper-text" id="msgChangeMoney"></span>
        </div>


        <div class="input-field col s12">
        <label id="msgCashierNumber"></label>
            <select id="cashierNumber" name="cashierNumber" onchange="validaForm()">
                <?php while ($rowAvailableCashier = $listAvailableCashier->fetch()) { ?>
                    <option value="<?php echo $rowAvailableCashier->id; ?>"><?php echo $rowAvailableCashier->id; ?></option>
                <?php } ?>
            </select>
            <span class="helper-text">Caixas Disponíveis</span>
        </div>





</div>
<div class="modal-footer">
    <a class="waves-effect waves-green btn-flat" disabled id="btnOpenCashier" onclick="openCashier()">Abrir Caixa</a>
</div>