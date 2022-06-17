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
        $('.money').mask('#.##0,00', {
            reverse: true
        });
        M.updateTextFields();
    });
</script>

<div class="modal-content">
    <h4 class="center">Informe o Valor, Motivo e o Caixa de Destino (em caso de transferência)!</h4>

    <div class="input-field col s12 m12 l12">
        <label for="value" class="active">Valor</label>
        <input type="text" id="value" name="value" class="money" onkeyup="validaFormWithdraw()" value="">
        <span class="helper-text" id="msgValue"></span>
    </div>

    <div class="input-field col s12 m12 l12">
        <label for="reason" class="active">Motivo</label>
        <input type="text" id="reason" name="reason" onkeyup="validaFormWithdraw()" value="">
        <span class="helper-text" id="msgReason"></span>
    </div>


    <div class="input-field col s12">
        <label id="msgCashierDestiny"></label>
        <select id="cashier_destiny" name="cashier_destiny" onchange="validaFormWithdraw()">
        <option value="">Não é uma Transferência</option>
            <?php while ($rowAvailableCashier = $listAvailableCashier->fetch()) { ?>
                <option value="<?php echo $rowAvailableCashier->id; ?>">Transferir para o Caixa <?php echo $rowAvailableCashier->id; ?></option>
            <?php } ?>
        </select>
        <span class="helper-text">Caixa Destino</span>
    </div>





</div>
<div class="modal-footer">
    <a href="#!" class="modal-close waves-effect waves-green btn-flat left">Cancelar</a>
    <a class="waves-effect waves-green btn-flat right" disabled id="btnWithdraw" onclick="withdraw()" disabled>Salvar</a>
</div>