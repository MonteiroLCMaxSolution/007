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
		
        <h4 class="center"><b>Deseja confirmar o Pedido?</b></h4>
		
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
                                <th>Excluir</th>
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
                                <th class="center"><span onClick="delProductTem('<?php echo $row->id;?>')"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M6.5 1.75a.25.25 0 01.25-.25h2.5a.25.25 0 01.25.25V3h-3V1.75zm4.5 0V3h2.25a.75.75 0 010 1.5H2.75a.75.75 0 010-1.5H5V1.75C5 .784 5.784 0 6.75 0h2.5C10.216 0 11 .784 11 1.75zM4.496 6.675a.75.75 0 10-1.492.15l.66 6.6A1.75 1.75 0 005.405 15h5.19c.9 0 1.652-.681 1.741-1.576l.66-6.6a.75.75 0 00-1.492-.149l-.66 6.6a.25.25 0 01-.249.225h-5.19a.25.25 0 01-.249-.225l-.66-6.6z"></path></svg></span></th>
                            </tr>
<?php } ?>
                            
                        </tbody>
                    </table>


                </div>
            </div> <!-- .row -->
        </section>
    </div> <!-- .modal-content -->
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat left">Cancelar</a>
        <a href="#!" class="modal-close waves-effect waves-green btn-flat right" onClick="btnSaveProduct()">Confirmar</a>
    </div> <!-- .modal-footer -->