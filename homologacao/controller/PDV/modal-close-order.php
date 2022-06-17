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
        M.updateTextFields();
        $('.money').mask('#.##0,00', {
            reverse: true
        });
    });
</script>

<?php if($totalOrder == 'undefined') { ?>
    <div class="modal-content">
    <h5 class="center">Não foi possível encontrar valores para serem fechados!</h5>

    </div>


    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Voltar</a>
    </div>

    <?php } else{ ?>
        



<div class="modal-content">
        <h4 class="center">Fechar Pedido</h4>
        <h5 class="center">Valor Total: R$<?php echo number_format($totalOrder, 2, ',', ''); ?></h5>

        <div class="input-field col s12 m6 l6 center" hidden>
            <label for="totalValue" class="active">Troco</label>
            <input type="text" id="totalValue" name="totalValue" class="money" value="<?php echo $totalOrder; ?>">
        </div>

        
        <p class="center" hidden>Deseja inserir o CPF / CNPJ do cliente?</p>

        <div class="input-field col s12 m6 l6 center" hidden>
            <label for="cpf_cnpj" id="lcpf_cnpj" class="active">CPF / CNPJ</label>
            <input type="text" id="cpf_cnpj" name="cpf_cnpj" onkeyup="validaFormCPF()" class="cpf_cnpj">
            <span class="helper-text" id="msgcpf_cnpj"></span>
        </div>

        <p class="center">Informe o valor Pago:</p>

        <div class="row">

        <div class="input-field col s12 m6 l6 center">
            <label for="paymentMoney" class="active">Dinheiro</label>
            <input type="text" id="paymentMoney" name="paymentMoney" class="money" onkeyup="calcChange()">
        </div>

        <div class="input-field col s12 m6 l6 center">
            <label for="paymentCredit" class="active">Crédito</label>
            <input type="text" id="paymentCredit" name="paymentCredit" class="money" onkeyup="calcChange()">
        </div>
        
        <div class="input-field col s12 m6 l6 center">
            <label for="paymentDebit" class="active">Débito</label>
            <input type="text" id="paymentDebit" name="paymentDebit" class="money" onkeyup="calcChange()">
        </div>

        <div class="input-field col s12 m6 l6 center">
            <label for="paymentPIX" class="active">PIX</label>
            <input type="text" id="paymentPIX" name="paymentPIX" class="money" onkeyup="calcChange()">
        </div>

        <div class="input-field col s12 m6 l6 center">
            <label for="paymentDiscount" class="active">Desconto</label>
            <input type="text" id="paymentDiscount" name="paymentDiscount" class="money" readonly>
        </div>

        <div class="input-field col s12 m6 l6 center">
            <label for="paymentChange" class="active">Troco</label>
            <input type="text" id="paymentChange" name="paymentChange" class="money" readonly>
        </div>

        </div>

    </div>


    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
        <a class="modal-close waves-effect waves-green btn-flat" id="btnCloseOrder" onclick="closeOrder()">Fechar Pedido</a>
    </div>

    <?php } ?>