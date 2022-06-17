<?php

if ( !isset( $_SESSION ) ) {
  session_start();
}
if(isset($_POST['conect'])){
	$ConexaoMysql = $_POST['conect'];
}else{
	$directory = explode('/', $_SERVER['PHP_SELF']);
	$directory = $directory[1];
	$ConexaoMysql = $_SERVER['DOCUMENT_ROOT'] . '/' . $directory . '/conexao-pdo/conexao-mysql-pdo.php';
}

ini_set( 'display_errors', 1 );
ini_set( 'display_startup_erros', 1 );
error_reporting( E_ALL );
include_once( $ConexaoMysql );

date_default_timezone_set( 'America/Sao_Paulo' );
$dataLocal = date( 'Y-m-d H:i:s', time() );
$dateTime = date( 'Y-m-d H:i:s', time() );

if(!empty($_GET['dataProducts'])){
	$uniqid = anti_injection($_POST['uniqid']);
	$uniqid = filter_var($uniqid,FILTER_SANITIZE_STRING);
	
	$id_product = anti_injection($_POST['id_product']);
	 $id_product = filter_var($id_product,FILTER_SANITIZE_STRING);
	
	 $id_product = explode('|',$id_product);
	 $id_product = $id_product[0];
	
	$SQL_passo1 = "SELECT a.id, a.name, a.sale_value, a.fraction FROM product a WHERE a.id = :id;";
	$SQL_passo1 = $pdo->prepare($SQL_passo1);
	$SQL_passo1->bindValue('id',$id_product);
	$SQL_passo1->execute();
	if($SQL_passo1->rowCount() > 0){
		$row_passo1 = $SQL_passo1->fetch();
		$id_product = $row_passo1->id;
		$name_product = $row_passo1->name;
		$value = $row_passo1->sale_value;
		$fraction = $row_passo1->fraction;
	}
	
	$SQL_step2 = "SELECT b.id,b.name FROM product a inner JOIN product_flavor b ON a.id = b.product_id WHERE a.id = :id";
	$SQL_step2 = $pdo->prepare($SQL_step2);
	$SQL_step2->bindValue('id',$id_product);
	$SQL_step2->execute();
	
	$SQL_passo3 = "SELECT a.name, a.id, a.value FROM product_addition a WHERE a.product_id = :id";
	$SQL_passo3 = $pdo->prepare($SQL_passo3);
	$SQL_passo3->bindValue('id',$id_product);
	$SQL_passo3->execute();	
}


// CONVERTER O PEDIDO TEMPORARIO EM PEDIDO NORMAL - LEÔNIDAS MONTEIRO 
if ( !empty( $_GET[ 'btnSaveProduct' ] ) ) {
  $uniqid = anti_injection( $_POST[ 'uniqid' ] );
  $uniqid = filter_var( $uniqid, FILTER_SANITIZE_STRING );


  $table = anti_injection( $_POST[ 'table' ] );
  $table = filter_var( $table, FILTER_SANITIZE_STRING );
	
  $people = anti_injection($_POST['people']);
  $people = filter_var($people, FILTER_SANITIZE_STRING);
	if($people == 0){
		$people = 1;
	}
	
  $SQL_convert = "SELECT a.id, a.table_delivery, a.table_demand, a.order_sheet_demand, a.waiter,
(SELECT ifnull(SUM(p.value),0) FROM order_items_addition p

WHERE p.order_item_id = a.id) AS complements,
(IFNULL(c.new_value,b.sale_value) + (SELECT ifnull(SUM(p.value),0) FROM order_items_addition p

WHERE p.order_item_id = a.id)) AS sale_value,

 a.quantity, if(b.kitchen = 'S','AGUARDANDO',NULL) AS kitchen_status, if(b.kitchen = 'N','AGUARDANDO',NULL) AS counter_status FROM order_items a
INNER JOIN product b ON a.product_id = b.id
LEFT JOIN promotion c ON a.product_id = c.product_id AND a.company_id = c.company_id AND CAST(NOW() AS DATE) BETWEEN CAST(c.start_date AS DATE) AND CAST(c.end_date AS DATE)

WHERE a.uniqID = :uniqID AND a.temp = '1';";
  $SQL_convert = $pdo->prepare( $SQL_convert );
  $SQL_convert->bindValue( 'uniqID', $uniqid );
  $SQL_convert->execute();
  while ( $row = $SQL_convert->fetch() ) {
    $ID = $row->id;
    $table_delivery = $row->table_delivery;
    $sale_value = $row->sale_value;
    $quantity = $row->quantity;
    $kitchen_status = $row->kitchen_status;
    $counter_status = $row->counter_status;
    $SQL_edt_temp = "UPDATE order_items SET kitchen_status = :kitchen_status,counter_status = :counter_status,company_id = :company_id,temp = :temp,unitary_value = :unitary_value,status = 'Aguardando' WHERE id = :id;";
    $SQL_edt_temp = $pdo->prepare( $SQL_edt_temp );
    $SQL_edt_temp->bindValue( 'kitchen_status', $kitchen_status );
    $SQL_edt_temp->bindValue( 'counter_status', $counter_status );
    $SQL_edt_temp->bindValue( 'company_id', $_SESSION[ 'id_company' ] );
    $SQL_edt_temp->bindValue( 'temp', 2 );
    $SQL_edt_temp->bindValue( 'unitary_value', $sale_value );
    $SQL_edt_temp->bindValue( 'id', $ID );
    $SQL_edt_temp->execute();

  }
  $SQL_table = "SELECT id FROM tables where id = :id and company_id = :company_id and status_table = :status_table";
  $SQL_table = $pdo->prepare( $SQL_table );
  $SQL_table->bindValue( 'id', $table );
  $SQL_table->bindValue( 'company_id', $_SESSION[ 'id_company' ] );
  $SQL_table->bindValue( 'status_table', 'ABERTO' );
  $SQL_table->execute();
  if ( $SQL_table->rowCount() > 0 ) {
    $SQL_edt_tab = "UPDATE tables SET uniqID = :uniqID, status_table = 'OCUPADO',last_update = :last_update,people = :people WHERE id = :id; ";
    $SQL_edt_tab = $pdo->prepare( $SQL_edt_tab );
    $SQL_edt_tab->bindValue( 'uniqID', $uniqid );
    $SQL_edt_tab->bindValue( 'last_update', $dataLocal );
    $SQL_edt_tab->bindValue( 'people', $people );
    $SQL_edt_tab->bindValue( 'id', $table );
    $SQL_edt_tab->execute();
  } else{
	$SQL_edt_tab = "UPDATE tables SET people = :people WHERE id = :id; ";
    $SQL_edt_tab = $pdo->prepare( $SQL_edt_tab );
    $SQL_edt_tab->bindValue( 'people', $people );
    $SQL_edt_tab->bindValue( 'id', $table );
    $SQL_edt_tab->execute();
  }

}
// .CONVERTERO PEDIDO TEMPORARIO EM PEDIDO NORMAL

if ( !empty( $listTables ) ) {
  $SQL_list_tables = "SELECT a.id AS id_mesa,SEC_TO_TIME(TIME_TO_SEC(a.last_update) - TIME_TO_SEC(NOW())) AS horas,(SELECT COUNT(*) FROM order_items y WHERE y.uniqID = a.uniqID) AS comandas,
a.status_table,
(SELECT SUM(y.unitary_value * y.quantity - y.discount)  FROM order_items y WHERE y.uniqID = a.uniqID) AS valor_total, ifnull(a.people,0) AS people FROM tables a
left JOIN order_items b ON a.uniqID = b.uniqID

WHERE a.`status` = 'Ativo' AND a.company_id = :company_id GROUP BY a.id;";
  $SQL_list_tables = $pdo->prepare( $SQL_list_tables );
  $SQL_list_tables->bindValue( 'company_id', $_SESSION[ 'id_company' ] );
  $SQL_list_tables->execute();

}
if ( !empty( $listProduct ) ) {
  $SQL_list_products = "SELECT a.id, a.name, a.minimum_stock FROM product a

 WHERE a.company_id = :company_id AND a.status = 'Ativo' AND a.defineStock = 'N' OR a.defineStock <> 'N' AND
 ((SELECT SUM(p.quantity) FROM stock_adjustment p WHERE p.uniqID = a.uniqID) - (SELECT SUM(o.quantity) FROM order_items o WHERE o.product_id = a.id)) > 0;";
  $SQL_list_products = $pdo->prepare( $SQL_list_products );
  $SQL_list_products->bindValue( 'company_id', $_SESSION[ 'id_company' ] );
  $SQL_list_products->execute();
}
// DADOS DA MESA SELECIONADA - LEÔNIDAS MONTEIRO - 30/01/2022
if ( !empty( $_GET[ 't' ] ) ) {
  $id = $_GET[ 't' ];

  // verificar a uniqID da mesa
  $SQL_uniqID_table = "SELECT a.id, ifnull(a.uniqID,LEFT(UUID(), 8)) AS uniqID FROM tables a WHERE a.id = :id AND a.company_id = :company_id;";
  $SQL_uniqID_table = $pdo->prepare( $SQL_uniqID_table );
  $SQL_uniqID_table->bindValue( 'id', $id );
  $SQL_uniqID_table->bindValue( 'company_id', $_SESSION[ 'id_company' ] );
  $SQL_uniqID_table->execute();
  if ( $SQL_uniqID_table->rowCount() > 0 ) {
    $row_uniqID_table = $SQL_uniqID_table->fetch();
    $uniqID = $row_uniqID_table->uniqID;
  }
}

// DADOS DA MESA SELECIONADA
//*************************************************************
// REGISTRAR TEMPORARIAMENTE OS PEDIDOS - LEÔNIDAS MONTEIRO - 31/01/2022
if ( !empty( $_GET[ 'include_temp' ] ) ) {
	
	
  $table = anti_injection( $_POST[ 'table' ] );
  $table = filter_var( $table, FILTER_SANITIZE_STRING );

  $uniqid = anti_injection( $_POST[ 'uniqid' ] );
  $uniqid = filter_var( $uniqid, FILTER_SANITIZE_STRING );


  $waiter = anti_injection( $_POST[ 'waiter' ] );
  $waiter = filter_var( $waiter, FILTER_SANITIZE_STRING );


  $id_product = anti_injection( $_POST[ 'id_product' ] );
  $id_product = filter_var( $id_product, FILTER_SANITIZE_STRING );


  $quantity = anti_injection( $_POST[ 'quantity' ] );
  $quantity = filter_var( $quantity, FILTER_SANITIZE_STRING );


  $order_sheet = anti_injection( $_POST[ 'order_sheet' ] );
  $order_sheet = filter_var( $order_sheet, FILTER_SANITIZE_STRING );


  $observation = anti_injection( $_POST[ 'observation' ] );
  $observation = filter_var( $observation, FILTER_SANITIZE_STRING );
	
	if(isset($_POST['flovers'])){
		$flovers = anti_injection( $_POST['flovers']);
		$flovers = filter_var( $flovers, FILTER_SANITIZE_STRING);
	}else{
		$flovers = '';
	}
	
	if(isset($_POST['complement'])){
		$complement = anti_injection($_POST['complement']);
	$complement = filter_var($complement, FILTER_SANITIZE_STRING);
	}else{
		$complement = '';
	}
	
  	
	
	
	
	

  $pdo->beginTransaction();

try {
	
	

		$SQL_insert = "INSERT INTO order_items(table_delivery,table_demand,uniqID,waiter,product_id,quantity,order_sheet_demand,observation,dateTime,temp)VALUES(:table_delivery,:table_demand,:uniqID,:waiter,:product_id,:quantity,:order_sheet_demand,:observation,:dateTime,:temp);";
		$SQL_insert = $pdo->prepare($SQL_insert);
		$SQL_insert->bindValue('table_delivery',$table);
		$SQL_insert->bindValue('table_demand',$table);
		$SQL_insert->bindValue('uniqID',$uniqid);
		$SQL_insert->bindValue('waiter',$waiter);
		$SQL_insert->bindValue('product_id',$id_product);
		$SQL_insert->bindValue('quantity',$quantity);
		$SQL_insert->bindValue('order_sheet_demand',$order_sheet);
		$SQL_insert->bindValue('observation',$observation);
		$SQL_insert->bindValue('dateTime',$dateTime);
		$SQL_insert->bindValue('temp',1);
		$SQL_insert->execute();
	
		$SQL = "SELECT id FROM order_items WHERE uniqid = :uniqid ORDER BY id desc;";
		$SQL = $pdo->prepare($SQL);
		$SQL->bindValue('uniqid',$uniqid);
		$SQL->execute();
		if($SQL->rowCount() > 0){
			$row = $SQL->fetch();
			$id_order = $row->id;
		}
	/*	 
	if(!empty($id_order)){}
		$flovers = $flovers;
	$flovers = explode(',',$flovers);
	$count =  count($flovers);
	$countStart = 0;
	while($count != $countStart){
		$result = $flovers[$countStart];
		$countStart++;
		$SQL_insert_flovers = "INSERT INTO order_items_addition(product_id,flavor_id,order_item_id)VALUES(:product_id,:flavor_id,:order_item_id);";
		$SQL_insert_flovers = $pdo->prepare($SQL_insert_flovers);
		$SQL_insert_flovers->bindValue('product_id',$id_product);
		$SQL_insert_flovers->bindValue('flavor_id',$result);
		$SQL_insert_flovers->bindValue('order_item_id',$id_order);
		$SQL_insert_flovers->execute();		
	}
}*/
	if(!empty($id_order)){
		if($flovers != ''){
			$flovers = $flovers;
		$flovers = explode(',',$flovers);
		$count =  count($flovers);
		$countStart = 0;
		while($count != $countStart){
			$result = $flovers[$countStart];
			$countStart++;
			$SQL_insert_flovers = "INSERT INTO order_items_addition(product_id,flavor_id,order_item_id)VALUES(:product_id,:flavor_id,:order_item_id);";
			$SQL_insert_flovers = $pdo->prepare($SQL_insert_flovers);
			$SQL_insert_flovers->bindValue('product_id',$id_product);
			$SQL_insert_flovers->bindValue('flavor_id',$result);
			$SQL_insert_flovers->bindValue('order_item_id',$id_order);
			$SQL_insert_flovers->execute();		
		}
		}
		if ($complement != ''){
			$complement = explode(',',$complement);
		$count =  count($complement);
		$countStart = 0;
		while($count != $countStart){
			$result = $complement[$countStart];
			$countStart++;
			$SQL = "SELECT a.value FROM product_addition a WHERE a.id = :id;";
			$SQL = $pdo->prepare($SQL);
			$SQL->bindValue('id',$result);
			$SQL->execute();
			if($SQL->rowCount() > 0){
				$row = $SQL->fetch();
				$valueComplement = $row->value;
			}
			$SQL_insert_complement = "INSERT INTO order_items_addition(product_id,addition_id,value,order_item_id)VALUES(:product_id,:addition_id,:value,:order_item_id);";
			$SQL_insert_complement = $pdo->prepare($SQL_insert_complement);
			$SQL_insert_complement->bindValue('product_id',$id_product);
			$SQL_insert_complement->bindValue('addition_id',$result);
			$SQL_insert_complement->bindValue('value',$valueComplement);
			$SQL_insert_complement->bindValue('order_item_id',$id_order);
			$SQL_insert_complement->execute();
		}
		}
		
		
		
	}
	

		$pdo->commit();
		
		$retorno = array( 'codigo' => 1, 'message' => 'Produto incluido com sucesso!' );
  		echo json_encode( $retorno );
  		exit();
	}catch ( Exception $querys ) {

    $pdo->rollback();

		$retorno = array( 'codigo' => 0, 'message' => "Erro ao salvar!" );
  		echo json_encode( $retorno );
  		exit();

	}
	
  
}

// .REGISTRAR TEMPORARIAMENTE OS PEDIDOS
// LISTAR PRODUTOS TEMPORARIAMENTE - LEÔNIDAS MONTEIRO - 2022
if(!empty($_GET['listProducts'])){
	
	$uniqid = anti_injection( $_POST[ 'uniqid' ] );
  	$uniqid = filter_var( $uniqid, FILTER_SANITIZE_STRING );
	
	$SQL_list_product_tem = "SELECT a.id, a.product_id, b.name, a.quantity, a.observation, a.order_sheet_demand FROM order_items a
INNER JOIN product b ON a.product_id = b.id WHERE a.uniqID = :uniqID AND a.temp = '1';";
	$SQL_list_product_tem = $pdo->prepare($SQL_list_product_tem);
	$SQL_list_product_tem->bindValue('uniqID',$uniqid);
	$SQL_list_product_tem->execute();
}

// .LISTAR PRODUTOS TEMPORARIAMENTE
// LISTAR PRODUTOS - LEÔNIDAS MONTEIRO -
if(!empty($_GET['list_ordem_items'])){
	
	$uniqid = anti_injection( $_POST[ 'uniqid' ] );
  	$uniqid = filter_var( $uniqid, FILTER_SANITIZE_STRING );
	
	$SQL_list_product_tem = "SELECT a.id, a.product_id, b.name, a.quantity, a.observation, a.order_sheet_demand FROM order_items a
INNER JOIN product b ON a.product_id = b.id WHERE a.uniqID = :uniqID AND a.temp = '2';";
	$SQL_list_product_tem = $pdo->prepare($SQL_list_product_tem);
	$SQL_list_product_tem->bindValue('uniqID',$uniqid);
	$SQL_list_product_tem->execute();
}

// .LISTAR PRODUTOS 



// DELETAR O PRODUTO TEMPORARIAMENTE - LEÔNIDAS MONTEIRO - 01/02/2022
	if(!empty($_GET['delProductTem'])){
		$temp = anti_injection($_GET['temp']);
		$temp = filter_var($temp,FILTER_SANITIZE_STRING);
		
		$SQL_del_temp = "DELETE FROM order_items WHERE id = :id;";
		$SQL_del_temp = $pdo->prepare($SQL_del_temp);
		$SQL_del_temp->bindValue('id', $temp);
		$SQL_del_temp->execute();
		
		
		$retorno = array( 'codigo' => 0, 'message' => "Produto excluido com sucesso!" );
  		echo json_encode( $retorno );
  		exit();
	}
// .DELETAR O PRODUTO TEMPORARIAMENTE 

?>