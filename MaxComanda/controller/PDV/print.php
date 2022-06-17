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

$mpdfcss = 'MaxComanda/lib/custom/printer-ticket-PDV.css';
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

$id_user = anti_injection($_GET['id_user']);
$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

$id_company = anti_injection($_GET['id_company']);
$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

$directory = anti_injection($_GET['directory']);
$directory = filter_var($directory, FILTER_SANITIZE_STRING);

if (isset($_SESSION['logo']) && !empty($_SESSION['logo'])) {
    $directoryIMG = $directory;
} else {
    $directoryIMG = 'MaxComanda';
}

$imgFolder = $_SERVER['DOCUMENT_ROOT'] . '/' . $directoryIMG . '/uploads/';

if (isset($_SESSION['logo']) && !empty($_SESSION['logo'])) {
    $logo = $_SESSION['logo'];
} else {
    $logo = "logo-index.png";
}





// ------------------------ BUSCAR INFORMAÇÕES DA EMPRESA PARA LISTAR ---------------------------
$infoCompany = "SELECT name_razao_social, CPF_CNPJ FROM company WHERE id = $id_company ";
$infoCompany = $pdo->prepare($infoCompany);
$infoCompany->execute();
$rowInfoCompany = $infoCompany->fetch();
$razSocial = $rowInfoCompany->name_razao_social;
$CPF_CNPJ = $rowInfoCompany->CPF_CNPJ;



$table = anti_injection($_GET['numberTable']);
$table = filter_var($table, FILTER_SANITIZE_STRING);

$uniqID = anti_injection($_GET['uniqID']);
$uniqID = filter_var($uniqID, FILTER_SANITIZE_STRING);

$orderSheet = anti_injection($_GET['orderSheet']);
$orderSheet = filter_var($orderSheet, FILTER_SANITIZE_STRING);



if (!empty($table)) {
    // --- PEGAR O UNIQID DA MESA ---
    $listUniqID = "SELECT uniqID FROM order_items WHERE table_demand = $table AND status != 'Finalizado' LIMIT 1";
    $listUniqID = $pdo->prepare($listUniqID);
    $listUniqID->execute();
    $rowUniqID = $listUniqID->fetch();
    $uniqID = $rowUniqID->uniqID;

    // --- LISTAR COMANDAS DA MESA ---
    $listOrderSheetTable = "SELECT order_sheet_demand FROM order_items WHERE table_demand = $table AND uniqID = '$uniqID' GROUP BY order_sheet_demand ORDER BY order_sheet_demand ASC ";
    $listOrderSheetTable = $pdo->prepare($listOrderSheetTable);
    $listOrderSheetTable->execute();

    // --- LISTAR QUANTIDADE DE PESSOAS NA MESA ---
    $listPeople = "SELECT people FROM tables WHERE id = $table";
    $listPeople = $pdo->prepare($listPeople);
    $listPeople->execute();
    $rowPeople = $listPeople->fetch();
    $people = $rowPeople->people;
    if ($people < 1) {
        $people = 1;
    } else {
        $people = $people;
    }
}


if (!empty($orderSheet)) {
    // --- LISTAR COMANDA ---
    $showItems = "SELECT a.*, b.name,
            IFNULL(((a.unitary_value * a.quantity) - a.discount),0) AS total
    
            FROM order_items a
            LEFT JOIN product b ON a.product_id = b.id
        
            WHERE a.uniqID = '$uniqID' AND a.order_sheet_demand = $orderSheet";
    $showItems = $pdo->prepare($showItems);
    $showItems->execute();


    // --- LISTAR TOTAL FINAL ---
    $listTotal = "SELECT 
    
        SUM(IFNULL(((a.unitary_value * a.quantity) - a.discount),0)) AS total
    
        FROM order_items a
    
    
        WHERE a.uniqID = '$uniqID' AND a.order_sheet_demand = $orderSheet";
    $listTotal = $pdo->prepare($listTotal);
    $listTotal->execute();
    if ($rowTotalFinal = $listTotal->fetch()) {
        $totalFinal = $rowTotalFinal->total;
    }
} else {
    // --- LISTAR MESA OU PEDIDO PDV ---
    $showItems = "SELECT a.*, b.name,
            IFNULL(((a.unitary_value * a.quantity) - a.discount),0) AS total
    
            FROM order_items a
            LEFT JOIN product b ON a.product_id = b.id
        
            WHERE a.uniqID = '$uniqID'";
    $showItems = $pdo->prepare($showItems);
    $showItems->execute();


    // --- LISTAR TOTAL FINAL ---
    $listTotal = "SELECT 
    
        SUM(IFNULL(((a.unitary_value * a.quantity) - a.discount),0)) AS total
    
        FROM order_items a
    
    
        WHERE a.uniqID = '$uniqID'";
    $listTotal = $pdo->prepare($listTotal);
    $listTotal->execute();
    if ($rowTotalFinal = $listTotal->fetch()) {
        $totalFinal = $rowTotalFinal->total;
        if (isset($people)) {
            // --- CALCULAR TOTAL POR PESSOA ---
            $totalPeople = $totalFinal / $people;
        }
    }
}

if (!empty($table)) {

    // -*-*-*-*-*-*-*-*-*-*-*-*-* IMPRIMIR MESA -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*


$html = '<table class="printer-ticket">
            <thead>
                <tr>
                    <th class="title" colspan="7">
                        <img src="' . $imgFolder . 'logo/'.$logo.'" width="200px">
                    </th>
                </tr>
                <tr>
                    <th colspan="7">Data: ' . date("d/m/Y H:i:s", strtotime($dateTime)) . '</th>
                </tr>
                <tr>
                    <th colspan="7">' . utf8_decode(htmlspecialchars_decode($razSocial)) . '  / ' . $CPF_CNPJ .' </th>
                </tr>
                <tr>
                    <th colspan="3" style="left" style="font-size: 12px">
                        Mesa: ' . $table . '<br/>
                    </th>
                    <th colspan="4" style="right" style="font-size: 12px">
                        Pessoas na Mesa: ' . $people . '<br/>
                    </th>
                </tr>
                <tr>
                    <th class="ttu" colspan="7">
                        <b>' . utf8_decode(htmlspecialchars_decode('Cupom não fiscal')) . '</b>
                    </th>
                </tr>

            </thead>

            <tbody>';
$count = 0;
while ($rowOrderSheetTable = $listOrderSheetTable->fetch()) {
    

    $orderSheetTable = $rowOrderSheetTable->order_sheet_demand;

    // --- LISTAR COMANDA ---

    $showItems = "SELECT a.*,b.name,
    IFNULL(((a.unitary_value * a.quantity) - a.discount),0) AS total

    FROM order_items a
    LEFT JOIN product b ON a.product_id = b.id

    WHERE a.uniqID = '$uniqID' AND a.order_sheet_demand = $orderSheetTable";
    $showItems = $pdo->prepare($showItems);
    $showItems->execute();

    // --- LISTAR TOTAL FINAL ---
    $listTotal = "SELECT 

    SUM(IFNULL(((a.unitary_value * a.quantity) - a.discount),0)) AS total

    FROM order_items a


    WHERE a.uniqID = '$uniqID' AND a.order_sheet_demand = $orderSheetTable";
    $listTotal = $pdo->prepare($listTotal);
    $listTotal->execute();
    if ($rowTotalFinal = $listTotal->fetch()) {
        $totalOrderSheet = $rowTotalFinal->total;
    }

$html .= '      <tr>
                    <th class="ttu" colspan="7" style="font-size: 12px">
                        <b>Comanda: ' . $orderSheetTable . '</b>
                    </th>
                </tr>

                <tr class="top">
                    <td colspan="4" style="text-align: center; font-size: 14px"><b>Produto</b></td>
                    <td style="text-align: center; font-size: 14px"><b>Qtde</b></td>
                    <td style="text-align: center; font-size: 14px"><b>Vl. Un.</b></td>                    
                    <td style="text-align: right; font-size: 14px"><b>Total</b></td>
                </tr>';


while ($rowItems = $showItems->fetch()) {
    $count++;

    $orderItemID = $rowItems->id;

    // --- LISTAR SABORES DESSE REGISTRO ---
    $listSelectedFlavor = "SELECT a.flavor_id, b.name 
            FROM order_items_addition a 
            LEFT JOIN product_flavor b ON a.flavor_id = b.id
            WHERE a.order_item_id = $orderItemID AND a.flavor_id != '' ";
    $listSelectedFlavor = $pdo->prepare($listSelectedFlavor);
    $listSelectedFlavor->execute();
    $countSelectedFlavor = $listSelectedFlavor->rowCount();

    // --- LISTAR COMPLEMENTOS DESSE REGISTRO ---
    $listSelectedAddition = "SELECT a.addition_id, b.name, a.value
            FROM order_items_addition a 
            LEFT JOIN product_addition b ON a.addition_id = b.id 
            WHERE a.order_item_id = $orderItemID AND a.addition_id != '' ";
    $listSelectedAddition = $pdo->prepare($listSelectedAddition);
    $listSelectedAddition->execute();
    $countSelectedAddition = $listSelectedAddition->rowCount();

    // --- PEGAR O UNITARY_VALUE DE ORDER_ITEMS E SUBTRAIR O VALOR DOS COMPLEMENTOS, SE HOUVER ---
if($countSelectedAddition > 0){
    $sqlSumAddition = "SELECT SUM(value) as total 
    FROM order_items_addition WHERE order_item_id = $orderItemID ";
    $sqlSumAddition = $pdo->prepare($sqlSumAddition);
    $sqlSumAddition->execute();
    $sumAddition = $sqlSumAddition->fetch();
    $totalAddition = $sumAddition->total;
    $itemValue = $rowItems->unitary_value - $totalAddition;
} else{
    $itemValue = $rowItems->unitary_value;
}


$html .= '      <tr>
                    <td colspan="5" style="font-size: 12px">' . utf8_decode(htmlspecialchars_decode($rowItems->name)) .'</td>

                    <td colspan="1" style="text-align: center; font-size: 12px">R$'. number_format($itemValue, 2, ",", ""). '</td>
                    <td></td>
                </tr>

                <tr>';
if ($countSelectedFlavor > 0) {
$html .= '          <td colspan="5" style="text-align: center; font-size: 12px"> Sabor: ';

while ($rowSelectedFlavor = $listSelectedFlavor->fetch()) {
$html .= '              <li>' .       $rowSelectedFlavor->name . '</li>';
}

$html .= '          </td>';
            }

if ($countSelectedAddition > 0) {

    $html .= '      <td colspan="2" style="text-align: center; font-size: 12px"> Complementos: ';

    while ($rowSelectedAddition = $listSelectedAddition->fetch()) {
        $html .= '      <li style="text-align: right; font-size: 12px">' .  $rowSelectedAddition->name . ' - R$' . number_format($rowSelectedAddition->value, 2, ",", "") . '</li>';
    }

    $html .= '      </td>';
}
$html .= '      </tr>
            
            
                <tr>
                    <td colspan="4"></td>
                    <td style="text-align: center; font-size: 12px"><b>x' . $rowItems->quantity . '</b></td>
                    <td style="text-align: center; font-size: 12px"><b>R$' . number_format($rowItems->unitary_value, 2, ",", "") . '</b></td>                    
                    <td style="text-align: right; font-size: 12px"><b>R$' . number_format($rowItems->total, 2, ",", "") . '</b></td>
                </tr>
                
                <tr>
                    <td colspan="7" style="text-align: center"><b>**********</b></td>
                </tr>';
        }

        $html .= '


                <tr class="sup ttu p--0">
                    <td colspan="5" align="right" style="font-size: 12px">
                        <b>Total da Comanda</b>
                    </td>
                    <td colspan="2" align="right" style="font-size: 12px"><b>R$' . number_format($totalOrderSheet, 2, ",", "") . '</b></td>
                </tr>
                <tr>
                    <td colspan="7" style="border-bottom: 1px solid black;"></td>
                </tr>';
    }





$html .= '  </tbody>
            <tfoot>


                <tr>
                    <th class="ttu" colspan="7"></th>
                </tr>
        

                <tr class="sup ttu p--0 top">
                    <td colspan="4" align="left">
                        <b>Total da Mesa</b>
                    </td>

                    <td colspan="3" align="right">
                        <b>Total por Pessoa</b>
                    </td>
                </tr>



 
                <tr class="ttu">
                    <td colspan="3" align="left" style="font-size: 15px"><b>R$' . number_format($totalFinal, 2, ",", "") . '</b></td>

                    <td colspan="4" align="right" style="font-size: 15px"><b>R$' . number_format($totalPeople, 2, ",", "") . '</b></td>
                </tr>

 
 


            </tfoot>

        </table>';
} else {

    // -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*- IMPRIMIR PEDIDO OU COMANDA -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*

$html ='<table class="printer-ticket">
            <thead>
                <tr>
                    <th class="title" colspan="7">
                        <img src="' . $imgFolder . 'logo/'.$logo.'" width="200px">
                    </th>
                </tr>
                <tr>
                    <th colspan="7">Data: ' . date("d/m/Y H:i:s", strtotime($dateTime)) . '</th>
                </tr>
                <tr>
                    <th colspan="7">
                    ' . utf8_decode(htmlspecialchars_decode($razSocial)) . '  / ' . $CPF_CNPJ . '
                    </th>
                </tr>';

$html .= '      <tr>
                    <th class="ttu" colspan="7">
                        <b>' . utf8_decode(htmlspecialchars_decode('Cupom não fiscal')) . '</b>
                    </th>
                </tr>';
if (!empty($orderSheet)) {
$html .= '      <tr>
                    <th colspan="7" style="font-size: 12px">
                        <b>Comanda: ' . $orderSheet . '</b>
                    </th>
                </tr>';
        }
$html .='   </thead>

            <tbody>';
    if (!empty($orderSheet)) {
        $AND_orderSheet = " AND a.order_sheet_demand = $orderSheet";
    } else {
        $AND_orderSheet = "";
    }
    // --- LISTAR COMANDA OU PEDIDO PDV ---
    $showItems = "SELECT a.*, b.name,
IFNULL(((a.unitary_value * a.quantity) - a.discount),0) AS total

FROM order_items a
LEFT JOIN product b ON a.product_id = b.id

WHERE a.uniqID = '$uniqID' $AND_orderSheet";
    $showItems = $pdo->prepare($showItems);
    $showItems->execute();


    // --- LISTAR TOTAL FINAL ---
    $listTotal = "SELECT 

SUM(IFNULL(((a.unitary_value * a.quantity) - a.discount),0)) AS total

FROM order_items a


WHERE a.uniqID = '$uniqID' $AND_orderSheet";
    $listTotal = $pdo->prepare($listTotal);
    $listTotal->execute();
    if ($rowTotalFinal = $listTotal->fetch()) {
        $totalFinal = $rowTotalFinal->total;
    }


$html .= '      <tr class="top">
                    <td colspan="4" style="text-align: center; font-size: 14px"><b>Produto</b></td>
                    <td style="text-align: center; font-size: 14px"><b>Qtde</b></td>
                    <td style="text-align: center; font-size: 14px"><b>Vl. Un.</b></td>                    
                    <td style="text-align: right; font-size: 14px"><b>Total</b></td>
                </tr>';

    $count = 0;
    while ($rowItems = $showItems->fetch()) {
        $count++;
        $orderItemID = $rowItems->id;

        // --- LISTAR SABORES DESSE REGISTRO ---
        $listSelectedFlavor = "SELECT a.flavor_id, b.name 
        FROM order_items_addition a 
        LEFT JOIN product_flavor b ON a.flavor_id = b.id
        WHERE a.order_item_id = $orderItemID AND a.flavor_id != '' ";
        $listSelectedFlavor = $pdo->prepare($listSelectedFlavor);
        $listSelectedFlavor->execute();
        $countSelectedFlavor = $listSelectedFlavor->rowCount();

        // --- LISTAR COMPLEMENTOS DESSE REGISTRO ---
        $listSelectedAddition = "SELECT a.addition_id, b.name, a.value 
        FROM order_items_addition a 
        LEFT JOIN product_addition b ON a.addition_id = b.id 
        WHERE a.order_item_id = $orderItemID AND a.addition_id != '' ";
        $listSelectedAddition = $pdo->prepare($listSelectedAddition);
        $listSelectedAddition->execute();
        $countSelectedAddition = $listSelectedAddition->rowCount();

        // --- PEGAR O UNITARY_VALUE DE ORDER_ITEMS E SUBTRAIR O VALOR DOS COMPLEMENTOS, SE HOUVER ---
        if($countSelectedAddition > 0){
            $sqlSumAddition = "SELECT SUM(value) as total 
            FROM order_items_addition WHERE order_item_id = $orderItemID ";
            $sqlSumAddition = $pdo->prepare($sqlSumAddition);
            $sqlSumAddition->execute();
            $sumAddition = $sqlSumAddition->fetch();
            $totalAddition = $sumAddition->total;
            $itemValue = $rowItems->unitary_value - $totalAddition;
        } else{
            $itemValue = $rowItems->unitary_value;
        }


$html .= '      <tr>
                    <td colspan="5" style="font-size: 12px">' . utf8_decode(htmlspecialchars_decode($rowItems->name)) .'</td>

                    <td colspan="1" style="text-align: center; font-size: 12px">R$'. number_format($itemValue, 2, ",", ""). '</td>
                    <td></td>
                </tr>

                <tr>';
if ($countSelectedFlavor > 0) {
    $html .= '      <td colspan="5" style="text-align: center; font-size: 12px"> Sabor: ';

    while ($rowSelectedFlavor = $listSelectedFlavor->fetch()) {
        $html .= '      <li>' .       $rowSelectedFlavor->name . '</li>';
    }

    $html .= '      </td>';
}
                        
if ($countSelectedAddition > 0) {

    $html .= '      <td colspan="2" style="text-align: center; font-size: 12px"> Complementos: ';

    while ($rowSelectedAddition = $listSelectedAddition->fetch()) {
        $html .= '      <li style="text-align: right; font-size: 12px">' .  $rowSelectedAddition->name . ' - R$' . number_format($rowSelectedAddition->value, 2, ",", "") . '</li>';
    }

    $html .= '      </td>';
}
$html .= '      </tr>


                <tr>
                    <td colspan="4"></td>
                    <td style="text-align: center; font-size: 12px"><b>x' . $rowItems->quantity . '</b></td>
                    <td style="text-align: center; font-size: 12px"><b>R$' . number_format($rowItems->unitary_value, 2, ",", "") . '</b></td>                    
                    <td style="text-align: right; font-size: 12px"><b>R$' . number_format($rowItems->total, 2, ",", "") . '</b></td>
                </tr>
                
                <tr>
                    <td colspan="7" style="text-align: center"><b>**********</b></td>
                </tr>';
    }

$html .= '  </tbody>
            <tfoot>


             
                <tr>
                    <th class="ttu" colspan="7">
                    </th>
                </tr>
        

                <tr class="sup ttu p--0 top">
                    <td colspan="7" align="right">
                        <b>Total Final</b>
                    </td>
                </tr>




                <tr class="ttu">
                    <td colspan="7" align="right" style="font-size: 15px"><b>R$' . number_format($totalFinal, 2, ",", "") . '</b></td>
                </tr>






            </tfoot>

        </table>';
}



















$largura = 72;
if (!empty($table)) {
    $altura = ($count * 75) + 50;
} else {
    $altura = ($count * 50) + 50;
}
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
$mpdf->SetTitle('Cupom ' . $uniqID . '.pdf');
$arquivo = 'Cupom ' . $uniqID . '.pdf';
$mpdf->Output('Cupom ' . $uniqID . '.pdf', 'I');
$mpdf->charset_in = 'windows-1252';

exit;
