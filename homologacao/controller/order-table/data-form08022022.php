<?php 
if(!isset($_SESSION)){
	session_start();
}
$listProduct = '1';
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
$ConexaoMysql = $ConexaoMysql;

$ModelUserPermission = 'MaxComanda/model/permission/user-permission.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelUserPermission)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelUserPermission = $tag . $ModelUserPermission;
include_once($ModelUserPermission);

if ($ROW_Perm_Monitor_Table->search == 'N' && $ROW_Perm_Monitor_Table->include == 'N' && $ROW_Perm_Monitor_Table->edit == 'N') {
   echo  $modalPermission = $_SERVER['DOCUMENT_ROOT'] . '/MaxComanda/view/modalPermission.php';
    include_once($modalPermission);
}


?>
<body onLoad="list_ordem_items('<?php echo $uniqID;?>')">
<input  value="<?php echo $uniqID;?>" id="uniqid">
<input hidden="hidden" value="<?php echo $ConexaoMysql;?>" id="conect">
<section>
    <nav style="max-height: 37px; line-height: 30px; background-color: <?php echo $_SESSION['color']; ?>">
        <div class="container">
            <div class=" center pageBreadcrumb">
                <a href="index.php" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Home</a>
                <a href="?pg=order-table" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Listar Mesas</a>
                <a href="#" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>"><?php echo $pageName; ?></a>
            </div>
        </div>
    </nav>
</sectionn
><section>
    <div class="row">
        <div class="col s12">
            <div class="card hoverable" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">

                <div class="container">
					<div class="input-field col s12 m2 l2">
                                <input id="table" name="table" type="number" value="<?php echo $_GET['t'];?>" readonly>
                                <label for="tabl">Mesa</label>
                            </div>
					<div class="input-field col s12 m2 l2">
                                <input id="people" name="people" type="number" value="<?php echo $_GET['p'];?>" >
                                <label for="people">Pessoas</label>
                            </div>
					<div class="input-field col s12 m8 l8">
                                <input id="waiter" name="waiter" type="text" value="<?php echo $_SESSION['id_user'].'/'.$_SESSION['name_user'];?>" readonly>
                                <label for="waiter">Garçon</label>
                            </div>
				</div>
			</div>		
		</div>
	</div>
</section>
<section>
    <div class="row">
        <div class="col s12">
            <div class="card hoverable" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">

                <div class="container">


                    
                        <div class="row">

							<form id="form_tem">
                            <div class="input-field col s12 m8 l8" id="product" name="product">
                                </br>
                                <select class="select2 browser-default product" name="product" id="id_produto">
                                    <option value="">Selecione o produto</option>
									<?php while($row = $SQL_list_products->fetch()){?>
									<option value="<?php echo $row->id;?>|<?php echo $row->minimum_stock;?>"><?php echo $row->name;?> - <?php echo $row->id;?></option>
									<?php } ?>
                                </select>
                            </div>



                            <div class="input-field col s12 m2 l2">
                                <input id="quantity" name="quantity" type="number" value="" onKeyUp="minStock()">
                                <label for="quantity">Quantidade</label>
                            </div>

                            <div class="input-field col s12 m2 l2">
                                <input id="order-sheet" name="order-sheet" type="number" value="">
                                <label for="order-sheet">Comanda</label>
                            </div>

                            <div class="input-field col s12 m12 l12">
                                <input id="observation" name="observation" type="text" value="">
                                <label for="observation">Observação</label>
                            </div>
							
							</form>
							

                            <?php if ($ROW_Perm_Monitor_Table->include == 'S' || $ROW_Perm_Monitor_Table->edit == 'S') { ?>


							<div class="col s6 m6 l6" style="text-align: end; padding: 10px">
								<button class="waves-effect waves-light btn"  onClick="include_temp()" id="btn_salve">Incluir Produto</button>
							</div>
							<div class="col s6 m6 l6"  style="text-align: end; padding: 10px">
								<a class="waves-effect waves-light btn modal-trigger" href="#modalConfirmOrder" onClick="listProduct('<?php echo $uniqID;?>')">Finalizar Pedidos</a>
							</div>

                            <?php } ?>



                            




                        </div> <!-- .row -->

                    
                </div> <!-- .container -->


            </div> <!-- .card -->
        </div> <!-- .col -->
    </div> <!-- .row -->
</section>
<section>
    <div class="row">
        <div class="col s12">
            <div class="card hoverable" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">

                <div class="container">


                    
                        <div class="row">
							<div id="list_order_items"></div>
					
                        </div> <!-- .row -->

                    
                </div> <!-- .container -->


            </div> <!-- .card -->
        </div> <!-- .col -->
    </div> <!-- .row -->
</section>


<div class="fixed-action-btn">
    <a class="btn-floating btn-large green" onclick="">
        <i class="large material-icons">mode_edit</i>
    </a>
    <ul>
        <li><a href="?pg=order-table" class="btn-floating red waves-effect waves-light tooltipped" data-position="left" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a></li>
        <li><a class="btn-floating blue waves-effect waves-light tooltipped" data-position="left" data-tooltip="Salvar" id="btnSaveOrderTable" onclick=""><i class="material-icons">done</i></a></li>
    </ul>
</div>



<!-- Modal de Confirmação -->
<div id="modalConfirmOrder" class="modal modal-fixed-footer modal-static">
    <div id="listProductTemp"></div>
	
</div> <!-- .modal -->
</body>