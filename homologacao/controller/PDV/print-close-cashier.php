<?php

use Mpdf\Mpdf;

$mpdf = 'MaxComanda/lib/mpdf8/vendor/autoload.php';
$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $mpdf)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$mpdf = $tag . $mpdf;
include_once($mpdf);

$mpdfcss = 'MaxComanda/lib/custom/printer-ticket-close-cashier.css';
$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $mpdfcss)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$mpdfcss = $tag . $mpdfcss;

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


$count = 0;

$html = '<table class="printer-ticket">
            <thead>
                <tr>
                    <th class="title" colspan="6">
                        <img src="' . $imgFolder . 'logo/'.$logo.'" width="200px">
                    </th>
                </tr>
                <tr>
                    <th colspan="6">' . utf8_decode(htmlspecialchars_decode($razSocial)) . '  / ' . $CPF_CNPJ .' </th>
                </tr>
                <tr>
                    <th class="ttu" colspan="6">
                        <b>' . utf8_decode(htmlspecialchars_decode('Relatório de Fechamento de Caixa')) . '</b>
                    </th>
                </tr>
                <tr>
                    <th class="ttu" colspan="6">
                        <b>' . utf8_decode(htmlspecialchars_decode("Usuário(a): $userName")) .'</b>
                    </th>
                </tr>

                <tr>
                    <th colspan="3">Abertura:</th>
                    <th colspan="3">Fechamento:</th>
                </tr>

                <tr>
                    <th colspan="3">' . date("d/m/Y H:i", strtotime($dateTimeOpening)) . '</th>
                    <th colspan="3">' . date("d/m/Y H:i", strtotime($dateTime)) . '</th>
                </tr>

            </thead>
            <tbody>
                <tr>
                    <th class="ttu border-bottom-solid text-center" colspan="6">
                        <b>Caixa Inicial: R$'.number_format($moneyCashier, 2, ",", "").'</b>
                    </th>
                </tr>

                <tr>
                    <th colspan="6">
                        <b>Pagamentos - Pedidos (+):</b>
                    </th>
                </tr>

                <tr>

                    <th><b>Pedido</b></th>

                    <th><b>'.utf8_decode(htmlspecialchars_decode('Crédito')).'</b></th>

                    <th><b>'.utf8_decode(htmlspecialchars_decode('Débito')).'</b></th>

                    <th><b>PIX</b></th>

                    <th><b>Dinheiro</b></th>

                    <th><b>Total</b></th>

                </tr>';

                while($rowPayment = $payment->fetch()){
                    $count++;
                    $orderID = $rowPayment->order_id;
                    if($rowPayment->credit > 0){
                        $credit = 'R$'.number_format($rowPayment->credit, 2, ",", "");
                    } else{
                        $credit = '-';
                    }

                    if($rowPayment->debit > 0){
                        $debit = 'R$'.number_format($rowPayment->debit, 2, ",", "");
                    } else{
                        $debit = '-';
                    }
                    
                    if($rowPayment->money > 0){
                        $money = 'R$'.number_format($rowPayment->money, 2, ",", "");
                    } else{
                        $money = '-';
                    }

                    if($rowPayment->PIX > 0){
                        $PIX = 'R$'.number_format($rowPayment->PIX, 2, ",", "");
                    } else{
                        $PIX = '-';
                    }

                    $totalOrder = ($rowPayment->credit + $rowPayment->debit + $rowPayment->money + $rowPayment->PIX);

$html .='       <tr>

                    <th>'.$orderID.'</th>

                    <th>'.$credit.'</th>

                    <th>'.$debit.'</th>

                    <th>'.$PIX.'</th>

                    <th>'.$money.'</th>

                    <th>R$'.number_format($totalOrder, 2, ",", "").'</th>

                </tr>';
                }
$html .='       <tr>

                    <th><b>Total Geral </b></th>

                    <th>R$'.number_format($totalCredit, 2, ",", "").'</th>

                    <th>R$'.number_format($totalDebit, 2, ",", "").'</th>

                    <th>R$'.number_format($totalPIX, 2, ",", "").'</th>

                    <th>R$'.number_format($totalMoney, 2, ",", "").'</th>

                    <th><b>R$'.number_format($totalOrders, 2, ",", "").'</b></th>

                </tr>

                <tr>
                    <th colspan="6" class="border-bottom-solid"></th>
                </tr>';
                if($totalWithdraw > 0){

$html .='       <tr>
                    <th colspan="6">
                        <b>Retiradas do Caixa (-):</b>
                    </th>
                </tr>

                <tr>

                    <th colspan="4" style="text-align: left"><b>'.utf8_decode(htmlspecialchars_decode('Descrição')).'</b></th>

                    <th colspan="1"><b>Caixa Destino</b></th>

                    <th colspan="1"><b>Valor</b></th>                 

                </tr>';
                while($rowWithdraw = $withdrawMoney->fetch()){
                    $count++;
                    $value = 'R$'.number_format($rowWithdraw->value, 2, ",", "");
                    $description = $rowWithdraw->description;
                    if($rowWithdraw->cashier_id_destiny == 0){
                        $cashierDestiny = '-';
                    } else{
                        $cashierDestiny = $rowWithdraw->cashier_id_destiny;
                    }

$html .='       <tr>
                    <th colspan="4" style="text-align: left">'.utf8_decode(htmlspecialchars_decode("$description")).'</th>

                    <th colspan="1">'.$cashierDestiny.'</th>

                    <th colspan="1">'.$value.'</th>

                </tr>';
                }

$html .='       <tr>

                    <th colspan="3"><b>Total - Retiradas</b></th>

                    <th colspan="3"><b>R$'.number_format($totalWithdraw, 2, ",", "").'</b></th>

                </tr>

                <tr>
                    <th colspan="6" class="border-bottom-solid"></th>
                </tr>';
                }

                if($countReceivedTransfer > 0){

$html .='       <tr>
                    <th colspan="6">
                        <b>'.utf8_decode(htmlspecialchars_decode('Transferências de Outros Caixas (+)')).'</b>
                    </th>
                </tr>

                <tr>
                    <th colspan="4" style="text-align: left"><b>'.utf8_decode(htmlspecialchars_decode('Descrição')).'</b></th>

                    <th colspan="1"><b>Caixa Origem</b></th>

                    <th colspan="1"><b>Valor</b></th>                 

                </tr>';
                while($rowReceivedTransfer = $receivedTransfer->fetch()){
                    $count++;
                    $value = 'R$'.number_format($rowReceivedTransfer->value, 2, ",", "");
                    $description = $rowReceivedTransfer->description;
                    $cashierOrigin = $rowReceivedTransfer->cashier_id;
                    

$html .='       <tr>
                    <th colspan="4" style="text-align: left">'.utf8_decode(htmlspecialchars_decode("$description")).'</th>

                    <th colspan="1">'.$cashierOrigin.'</th>

                    <th colspan="1">'.$value.'</th>                  

                </tr>';
                }

$html .='       <tr>

                    <th colspan="3"><b>Total - Recebimentos:</b></th>

                    <th colspan="3"><b>R$'.number_format($totalReceivedTransfer, 2, ",", "").'</b></th>

                </tr>

                <tr>
                    <th colspan="6" class="border-bottom-solid"></th>
                </tr>';
                }



$html .='   </tbody>
            <tfoot>

                <tr>
                    <th colspan="6" style="font-size: 18px">
                        <b>Totais do Caixa</b>
                    </th>
                </tr>

                <tr>
                    <th colspan="3" style="font-size: 16px"><b>Dinheiro</b></th>

                    <th colspan="3" style="font-size: 16px"><b>'.utf8_decode(htmlspecialchars_decode("Crédito")).'</b></th>
                </tr>

                <tr>
                    <th colspan="3" style="font-size: 14px">R$'.number_format($cashierMoney, 2, ",", "").'</th>

                    <th colspan="3" style="font-size: 14px">R$'.number_format($totalCredit, 2, ",", "").'</th>
                </tr>

                <tr>

                    <th colspan="3" style="font-size: 16px"><b>'.utf8_decode(htmlspecialchars_decode("Débito")).'</b></th>

                    <th colspan="3" style="font-size: 16px"><b>PIX</b></th>
                </tr>

                <tr>

                    <th colspan="3" style="font-size: 14px">R$'.number_format($totalDebit, 2, ",", "").'</th>

                    <th colspan="3" style="font-size: 14px">R$'.number_format($totalPIX, 2, ",", "").'</th>
                </tr>

                <tr>
                    <th colspan="6" style="font-size: 16px"><b>Total Final</b></th>
                </tr>

                <tr>
                    <th colspan="6" style="font-size: 14px">R$'.number_format($totalFinal, 2, ",", "").'</th>
                </tr>

            </tfoot>
         </table>';



$largura = 72;
$altura = ($count * 30) + 130;
$margin_left = 3;
$margin_right = 1;
$margin_top = 1;
$margin_bottom = 1;
$margin_header = 1;
$margin_footer = 1;

$mpdf = new Mpdf([
    'mode' => 'utf-8',
    'format' => [$largura, $altura],
    'margin_left' => $margin_left,
    'margin_right' => $margin_right,
    'margin_top' => $margin_top,
    'margin_bottom' => $margin_bottom,
    'margin_header' => $margin_header,
    'margin_footer' => $margin_footer
]);

$mpdf->SetDisplayMode('fullpage');
$html = utf8_encode($html);
$stylesheet = file_get_contents($mpdfcss);
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);
$mpdf->SetTitle('Fechamento de Caixa.pdf');
$arquivo = 'Fechamento de Caixa.pdf';
$mpdf->Output('Fechamento de Caixa.pdf', 'I');
$mpdf->charset_in = 'windows-1252';

exit;


?>