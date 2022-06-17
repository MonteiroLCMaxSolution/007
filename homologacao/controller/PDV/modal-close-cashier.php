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
        $('.money').mask('#.##0,00', {
            reverse: true
        });
        M.updateTextFields();
    });
</script>


<div class="modal-content">
    <input type="text" id="compareMoney" value="<?php echo number_format($cashierMoney, 2, ',', ''); ?>" hidden>
    <input type="text" id="compareCredit" value="<?php echo number_format($totalCredit, 2, ',', ''); ?>" hidden>
    <input type="text" id="compareDebit" value="<?php echo number_format($totalDebit, 2, ',', ''); ?>" hidden>
    <input type="text" id="comparePIX" value="<?php echo number_format($totalPIX, 2, ',', ''); ?>" hidden>
    <h4 class="center">Caixa <?php echo $idCashier; ?></h4>
    <h5 class="center">Informe os Totais para Fechar o Caixa</h5>

    <form method="POST" id="formCloseCashier">
        <div class="row">


            <div class="input-field col s12 m6 l6">
                <label for="totalMoney" class="active">Total em Dinheiro</label>
                <input type="text" id="totalMoney" name="totalMoney" class="money" onkeyup="validaFormCloseCashier()" value="">
                <span class="helper-text" id="msgTotalMoney"></span>
            </div>

            <div class="input-field col s12 m6 l6">
                <label for="totalCredit" class="active">Total em Cartão de Crédito</label>
                <input type="text" id="totalCredit" name="totalCredit" class="money" onkeyup="validaFormCloseCashier()" value="">
                <span class="helper-text" id="msgTotalCredit"></span>
            </div>

            <div class="input-field col s12 m6 l6">
                <label for="totalDebit" class="active">Total em Cartão de Débito</label>
                <input type="text" id="totalDebit" name="totalDebit" class="money" onkeyup="validaFormCloseCashier()" value="">
                <span class="helper-text" id="msgTotalDebit"></span>
            </div>

            <div class="input-field col s12 m6 l6">
                <label for="totalPIX" class="active">Total em PIX</label>
                <input type="text" id="totalPIX" name="totalPIX" class="money" onkeyup="validaFormCloseCashier()" value="">
                <span class="helper-text" id="msgTotalPIX"></span>
            </div>



        </div>
    </form>

</div>
<div class="modal-footer">
    <div class="row">
        <div class="col s4 m4 l4 center">
            <a class="waves-effect waves-green btn-flat" href="?pg=dashboard">Página Inicial</a>
        </div>
        <div class="col s4 m4 l4 center">
            <a class="waves-effect waves-green btn-flat" onclick="printCloseCashier('<?php echo $idCashier; ?>')">Imprimir Relatório</a>
        </div>
        <div class="col s4 m4 l4 center">
            <a class="waves-effect waves-green btn-flat" onclick="closeCashier('<?php echo $idCashier; ?>')" disabled id="btnCloseCashier">Fechar Caixa</a>
        </div>
    </div>
</div>