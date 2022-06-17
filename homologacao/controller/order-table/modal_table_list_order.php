<?php 
$ConexaoMysql = $_POST['conect'];

if(!isset($_SESSION)){
	session_start();
}
$ModelCompany = 'MaxComanda/model/order-table/order-table-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n'){
	if (file_exists($tag.$ModelCompany)) {
		$parametro = 'n';
	} else {
		$tag = '../'.$tag;
	}
}
$ModelCompany = $tag.$ModelCompany;
include_once($ModelCompany);

?>
<div class="modal-content">
		
        <h6 class="center"><b>Pedidos da mesa</h6>
		
        <section>
            <div class="row">
                <div class="col s12 m12 l12">


                    <table class="highlight centered responsive-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Produto</th>
                                <th>Qtd</th>
                                <th>Comanda</th>
                                <th>Observação</th>
                            </tr>
                        </thead>

                        <tbody>
                            
<?php
$count = 1;
while($row = $SQL_list_product_tem->fetch()){?>
							<tr style="font-size: 9px;color: #515151">
                                <th class="center"><?php echo $count++;?></th>
                                <th class="center"><?php echo $row->name;?></th>
                                <th class="center"><?php echo $row->quantity;?></th>
                                <th class="center"><?php echo $row->order_sheet_demand;?></th>
                                <th class="center"><?php echo $row->observation;?></th>
                               
                            </tr>
<?php } ?>
                            
                        </tbody>
                    </table>


                </div>
            </div> <!-- .row -->
        </section>
    </div> <!-- .modal-content -->
 