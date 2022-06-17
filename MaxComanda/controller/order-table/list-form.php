<?php
$listTables = 1;
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

<section>
    <nav style="max-height: 37px; line-height: 30px; background-color: <?php echo $_SESSION['color']; ?>">
        <div class="container">
            <div class="center pageBreadcrumb">
                <a href="index.php" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Home</a>
                <a href="#" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>"><?php echo $pageName; ?></a>
            </div>
        </div>
    </nav>
</section>

<section>
    <div class="row">
        <div class="col s12">
            <div class="card" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">

                <div class="card-content">


                    <div class="row">
						<?php
						while ($row = $SQL_list_tables->fetch()){
						if($row->status_table == "ABERTO"){
							$img_table = 'mesa-vazia.png';
						}else{
							$img_table = 'mesa-ocupada.png';
						}
						if($row->status_table == "ABERTO"){
							$cor = '#2D882D';
						}else{
							$cor = '#F8FF00';
						}
						?>
	
                        <div class="col s6 m4 l3">
                            <div class="card hoverable" style="height: 150px; background: <?php echo $cor;?>">
                                <div class="card-image">
                                   <!-- <img src="../../../MaxComanda/uploads/<?php echo $img_table;?>" style="max-height: 200px">-->
                                    <a class="btn-floating halfway-fab waves-effect waves-light green tooltipped" data-tooltip="Editar" href="?pg=order-table-form&t=<?php echo $row->id_mesa;?>&p=<?php echo $row->people;?>&uniq=<?php echo $row->uniqid;?>"><i class="material-icons">edit</i></a>
                                </div>
                                <div class="card-content">
                                    <p class="center"><b>Mesa #<?php echo $row->id_mesa;?></b></p>
									<?php
									if($row->status_table == "ABERTO"){?>
									<p>Abrir mesa</p>
									<?php }else{?>
									<p><i class="material-icons">schedule</i> Tempo: <?php echo $row->horas;?></p>
                                    <p><i class="material-icons">receipt</i> Clientes: <?php echo $row->people;?></p>
                                    <p><i class="material-icons">attach_money</i> Valor Total: R$ <?php echo number_format($row->valor_total,2,',','.');?></p>
									<?php }?>
                                    
                                </div>
                            </div>
                        </div>
						<?php } ?>

                        <!--<div class="col s6 m4 l3">
                            <div class="card hoverable">
                                <div class="card-image">
                                    <img src="../../../MaxComanda/uploads/mesa-ocupada.png" style="max-height: 200px">
                                    <a class="btn-floating halfway-fab waves-effect waves-light green" href="?pg=order-table-form"><i class="material-icons">edit</i></a>
                                </div>
                                <div class="card-content">
                                    <p class="center"><b>Mesa #2</b></p>
                                    <p><i class="material-icons">schedule</i> Início: 21:30h</p>
                                    <p><i class="material-icons">receipt</i> Comandas Vinculadas: 3</p>
                                    <p><i class="material-icons">attach_money</i> Valor Total: R$350,00</p>
                                </div>
                            </div>
                        </div>-->




                    </div> <!-- /.row -->

                </div> <!-- /.card-content -->


            </div> <!-- /.card -->
        </div> <!-- /.col -->
    </div> <!-- /.row -->
</section>