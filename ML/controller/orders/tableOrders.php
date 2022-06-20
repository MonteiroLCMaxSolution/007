<?php

require_once '../../lib/Meli/meli.php';
//require '../configApp.php';
$status = $_POST['status'];


$meli = new Meli($appId, $secretKey);
$response = $meli->get('/users/me', array('access_token' => $_SESSION['access_token']));

$id_conta = $response['body']->id;

$url = "orders/search/$status";
$response = "";
$params = [
    'seller' => $id_conta,
    //    'status' => 'paid',
    'access_token' => $_SESSION['access_token'],
    //    'limit' => 25
];
$response = $meli->get($url, $params);
$vendas = $response['body']->results;



?>




                    <?php foreach ($vendas as $venda) :
                        $taxa = 0.00;
                        foreach ($venda->order_items as $key => $value) {
                            $taxa = $taxa + ($venda->order_items[$key]->sale_fee * $venda->order_items[$key]->quantity);
                        }
                        $receber = $venda->total_amount - $taxa;
                    ?>
                        <tr>
                            <th scope="row"><?php echo $venda->id ?></th>
                            <td><?php echo $venda->status ?></td>
                            <td><?php echo "R$ " . number_format($venda->total_amount, 2, ',', '.') ?></td>
                            <td><?php echo "R$ " . number_format($taxa, 2, ',', '.') ?></td>
                            <td><b><?php echo "R$ " . number_format($receber, 2, ',', '.') ?></b></td>
                            <td><?php echo date_format(date_create($venda->date_created), 'd/m/Y H:i:s') ?></td>
                            <td>
                                <a href="https://api.mercadolibre.com/orders/<?php echo $venda->id ?>?access_token=<?php echo $_SESSION['access_token'] ?>" target="_blank">+Detalhes</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                


    
