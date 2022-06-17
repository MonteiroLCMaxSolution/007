<?php

if (!isset($_SESSION)) {
	session_start();
}
if (isset($_GET['directory'])) {
	$directory = $_GET['directory'];
} else {
	$directory = explode('/', $_SERVER['PHP_SELF']);
	$directory = $directory[1];
}

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


$ConexaoMysql = $_SERVER['DOCUMENT_ROOT'] . '/' . $directory . '/conexao-pdo/conexao-mysql-pdo.php';
include_once($ConexaoMysql);


date_default_timezone_set('America/Sao_Paulo');
$dateTime = date('Y-m-d H:i:s', time());
$date = date('Y-m-d', time());


$imgFolder = $_SERVER['DOCUMENT_ROOT'] . '/' . $directory . '/uploads/';

// ************** RELATÓRIO DE FECHAMENTO DE CAIXA - BRUNO R. BERNAL - 17/02/2022 *********************

if (isset($_GET['pdfCloseCashier'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$directory = anti_injection($_GET['directory']);
	$directory = filter_var($directory, FILTER_SANITIZE_STRING);

	$cashierID = anti_injection($_GET['cashierID']);
	$cashierID = filter_var($cashierID, FILTER_SANITIZE_STRING);

	$userName = anti_injection($_GET['userName']);
	$userName = filter_var($userName, FILTER_SANITIZE_STRING);

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

	// --- VERIFICAR QUANTO TEM QUE TER NO CAIXA ---

	$totalCashier = "SELECT a.start_money AS money_cashier, a.cashier_id AS 'idCashier' ,  a.dateTime,

	IFNULL((
	SELECT SUM(b.money) 
	FROM  payment b 
	WHERE b.dateTime BETWEEN a.dateTime AND NOW() 
	AND b.cashier_id = a.cashier_id
	),0) AS 'money_payment',
	
	IFNULL((
	SELECT SUM(c.credit) 
	FROM  payment c 
	WHERE c.dateTime BETWEEN a.dateTime AND NOW()  
	AND c.cashier_id = a.cashier_id
	),0) AS 'credit',
	
	IFNULL((
	SELECT SUM(d.debit) 
	FROM  payment d 
	WHERE d.dateTime BETWEEN a.dateTime AND NOW()  
	AND d.cashier_id = a.cashier_id
	),0) AS 'debit',
	
	IFNULL((
	SELECT SUM(e.PIX) 
	FROM  payment e 
	WHERE e.dateTime BETWEEN a.dateTime AND NOW()  
	AND e.cashier_id = a.cashier_id
	),0) AS 'PIX',
	
	IFNULL((
	SELECT SUM(f.value) 
	FROM  withdraw_money f 
	WHERE f.dateTime BETWEEN a.dateTime AND NOW()  
	AND f.cashier_id = a.cashier_id
	),0) AS 'retiradas',

	IFNULL((
	SELECT SUM(f.value) 
	FROM  withdraw_money f 
	WHERE f.dateTime BETWEEN a.dateTime AND NOW()  
	AND f.cashier_id_destiny = a.cashier_id
	),0) AS 'received_transfer'
	
	FROM cashier_opening a 
	
	WHERE a.status = 'Aberto' 
		AND a.id_user = $id_user";
	$totalCashier = $pdo->prepare($totalCashier);
	$totalCashier->execute();
	if ($listTotalCashier = $totalCashier->fetch()) {
		$dateTimeOpening = $listTotalCashier->dateTime;
		$moneyCashier = $listTotalCashier->money_cashier;
		$totalMoney = $listTotalCashier->money_payment;
		$totalCredit = $listTotalCashier->credit;
		$totalDebit = $listTotalCashier->debit;
		$totalPIX = $listTotalCashier->PIX;
		$totalWithdraw = $listTotalCashier->retiradas;
		$totalReceivedTransfer = $listTotalCashier->received_transfer;
		$cashierMoney = ($moneyCashier + $totalMoney + $totalReceivedTransfer) - $totalWithdraw; // Caixa Inicial + Entradas em Dinheiro - Retiradas em Dinheiro
		$totalFinal = $cashierMoney + $totalCredit + $totalDebit + $totalPIX;
		$totalOrders = $totalCredit + $totalDebit + $totalPIX + $totalMoney;
	}

	// --- LISTAR MOVIMENTAÇÕES DO CAIXA ---

		// --- RETIRADAS ---
		$withdrawMoney = "SELECT a.* FROM withdraw_money a 
			WHERE a.cashier_id = '$cashierID' AND a.dateTime BETWEEN '$dateTimeOpening' AND NOW()";
		$withdrawMoney = $pdo->prepare($withdrawMoney);
		$withdrawMoney->execute();

		// --- TRANSFERÊNCIAS RECEBIDAS ---
		$receivedTransfer = "SELECT a.* FROM withdraw_money a 
			WHERE a.cashier_id_destiny = '$cashierID' AND a.dateTime BETWEEN '$dateTimeOpening' AND NOW()";
		$receivedTransfer = $pdo->prepare($receivedTransfer);
		$receivedTransfer->execute();
		$countReceivedTransfer = $receivedTransfer->rowCount();

		// --- PAGAMENTOS ---
		$payment = "SELECT e.id AS 'order_id', a.* FROM payment a
		LEFT JOIN orders e ON e.payment_uniqID = a.payment_uniqID 
			WHERE a.cashier_id = $cashierID		
			AND a.dateTime BETWEEN '$dateTimeOpening' AND NOW()";
		$payment = $pdo->prepare($payment);
		$payment->execute();
}

// ************** FIM - RELATÓRIO DE FECHAMENTO DE CAIXA - BRUNO R. BERNAL - 17/02/2022 *********************

// ************** LISTAR DADOS DO PRODUTO NO MODAL EDIT ITEM PDV - BRUNO R. BERNAL - 15/02/2022 *********

if (isset($_GET['modalEditItemPDV'])) {

	$orderItemID = anti_injection($_GET['orderItemID']);
	$orderItemID = filter_var($orderItemID, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);


	$sqlShowItem = "SELECT a.*, b.name

	FROM order_items a
	LEFT JOIN product b ON a.product_id = b.id
	
	WHERE a.id = $orderItemID ";
	$sqlShowItem = $pdo->prepare($sqlShowItem);
	$sqlShowItem->execute();
	$showItem = $sqlShowItem->fetch();
	$product_name = $showItem->name;
	$product_id = $showItem->product_id;
	$kitchen_status = $showItem->kitchen_status;
	$counter_status = $showItem->counter_status;
	$quantity = $showItem->quantity;
	$observation = $showItem->observation;
	$unitary_value = $showItem->unitary_value;
	$discount = $showItem->discount;


	$totalFinal = ($unitary_value * $quantity) - $discount;


	$listFlavor = "SELECT * FROM product_flavor WHERE product_id = $product_id AND status = 'Ativo' ";
	$listFlavor = $pdo->prepare($listFlavor);
	$listFlavor->execute();


	$listAddition = "SELECT * FROM product_addition WHERE product_id = $product_id AND status = 'Ativo' ";
	$listAddition = $pdo->prepare($listAddition);
	$listAddition->execute();
}


// ************** FIM - LISTAR DADOS DO PRODUTO NO MODAL EDIT ITEM PDV - BRUNO R. BERNAL - 15/02/2022 *********

// ************** LISTAR DADOS DO PRODUTO NO MODAL ADD ITEM PDV - BRUNO R. BERNAL - 15/02/2022 *********

if (isset($_GET['modalAddItemPDVTemp'])) {

	$product_id = anti_injection($_GET['product_id']);
	$product_id = filter_var($product_id, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);


	$sqlShowProduct = "SELECT a.uniqID, a.name AS name, a.sale_value, a.defineStock, i.new_value AS value_promotion, a.fraction

	FROM product a

	LEFT JOIN promotion i ON i.product_id = a.id AND CAST(NOW() AS DATE) BETWEEN i.start_date AND i.end_date AND i.status = 'Ativo'
	
	WHERE a.id = $product_id 
	AND a.company_id = $id_company
	AND a.status = 'Ativo' ";
	$sqlShowProduct = $pdo->prepare($sqlShowProduct);
	$sqlShowProduct->execute();
	$showProduct = $sqlShowProduct->fetch();
	$sale_value = $showProduct->sale_value;
	$value_promotion = $showProduct->value_promotion;
	$product_fraction = $showProduct->fraction;
	$product_name = $showProduct->name;



	$listFlavor = "SELECT * FROM product_flavor WHERE product_id = $product_id AND status = 'Ativo' ";
	$listFlavor = $pdo->prepare($listFlavor);
	$listFlavor->execute();


	$listAddition = "SELECT * FROM product_addition WHERE product_id = $product_id AND status = 'Ativo' ";
	$listAddition = $pdo->prepare($listAddition);
	$listAddition->execute();
}


// ************** FIM - LISTAR DADOS DO PRODUTO NO MODAL ADD ITEM PDV - BRUNO R. BERNAL - 15/02/2022 *********

// ************************** REMOVER ITEM PDV - BRUNO R. BERNAL - 11/02/2022 **************************

if (isset($_GET['deleteItemPDV'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$orderItemID = anti_injection($_GET['orderItemID']);
	$orderItemID = filter_var($orderItemID, FILTER_SANITIZE_STRING);

	$pdo->beginTransaction();

	try {

		// --- REMOVER REGISTROS NA TABELA ORDER_ITEMS_ADDITION ---
		$removeAddition = "DELETE FROM order_items_addition WHERE order_item_id = $orderItemID";
		$removeAddition = $pdo->prepare($removeAddition);
		$removeAddition->execute();

		// --- REMOVER REGISTRO DA TABELA ORDER_ITEMS ---
		$removeOrderItem = "DELETE FROM order_items WHERE id = $orderItemID";
		$removeOrderItem = $pdo->prepare($removeOrderItem);
		$removeOrderItem->execute();

		// --- GRAVAR LOG ---

		$description = 'REMOVER PEDIDO TEMP ' . $orderItemID;
		$sqlLog = "DELETE FROM order_items WHERE id = $orderItemID  /  DELETE FROM order_items_addition WHERE order_item_id = $orderItemID";
		$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
		$register_log = $pdo->prepare($SQL_register_log);
		$register_log->bindValue('id_company', $id_company);
		$register_log->bindValue('dateTime', $dateTime);
		$register_log->bindValue('action', $sqlLog);
		$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
		$register_log->bindValue('description', $description);
		$register_log->bindValue('user', $id_user);
		$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
		$register_log->execute();

		// --- FIM - GRAVAR LOG ---

		$pdo->commit();

		$retorno = array('codigo' => 1, 'mensagem' => 'Sucesso!');
		echo json_encode($retorno);
		exit();
	} catch (Exception $e) {

		$pdo->rollback();

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro: ' . $e);
		echo json_encode($retorno);
		exit();
	}
}

// ************************* FIM - REMOVER ITEM PDV - BRUNO R. BERNAL - 11/02/2022 ************************

// ************************* LISTAR PEDIDO DE BALCÃO - BRUNO R. BERNAL - 10/02/2022 **********************
if (isset($_GET['listPDV'])) {

	$uniqID = anti_injection($_GET['uniqID']);
	$uniqID = filter_var($uniqID, FILTER_SANITIZE_STRING);

	//--- LISTAR ---
	$listItems = "SELECT a.*,
	IFNULL(((a.unitary_value * a.quantity) - a.discount),0) AS total,
	b.name
	 FROM order_items a
	 LEFT JOIN product b ON a.product_id = b.id
	WHERE a.uniqID = '$uniqID'";
	$listItems = $pdo->prepare($listItems);
	$listItems->execute();

	// --- LISTAR TOTAL FINAL ---
	$listTotal = "SELECT a.*,
	SUM(IFNULL(((a.unitary_value * a.quantity) - a.discount),0)) AS total

	 FROM order_items a

	WHERE a.uniqID = '$uniqID' GROUP BY a.order_sheet_demand";
	$listTotal = $pdo->prepare($listTotal);
	$listTotal->execute();
	if ($rowTotalFinal = $listTotal->fetch()) {
		$totalFinal = $rowTotalFinal->total;
	}
}

// ************************* FIM - LISTAR PEDIDO DE BALCÃO - BRUNO R. BERNAL - 10/02/2022 **********************



// ************************** REMOVER COMPLEMENTO - BRUNO R. BERNAL - 10/02/2022 **************************

if (isset($_GET['removeAddition'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$orderItemID = anti_injection($_GET['orderItemID']);
	$orderItemID = filter_var($orderItemID, FILTER_SANITIZE_STRING);

	$product_id = anti_injection($_GET['product_id']);
	$product_id = filter_var($product_id, FILTER_SANITIZE_STRING);

	$addition_id = anti_injection($_GET['addition_id']);
	$addition_id = filter_var($addition_id, FILTER_SANITIZE_STRING);

	$value = anti_injection($_GET['value']);
	$value = filter_var($value, FILTER_SANITIZE_STRING);
	$value = str_replace(',', '.', $value);


	$pdo->beginTransaction();

	try {

		// --- SUBTRAIR VALOR DA TABELA ORDER_ITEMS ---
		$sqlAdditionValue = "SELECT value FROM product_addition WHERE id = $addition_id";
		$sqlAdditionValue = $pdo->prepare($sqlAdditionValue);
		$sqlAdditionValue->execute();
		$rowAdditionValue = $sqlAdditionValue->fetch();
		$additionValue = $rowAdditionValue->value;
		$newVadditionValuealue = str_replace('.', '', $additionValue);
		$additionValue = str_replace(',', '.', $additionValue);

		$newValue = $value - $additionValue;


		// --- REMOVER COMPLEMENTO NA TABELA ORDER_ITEMS_ADDITION ---
		$removeAddition = "DELETE FROM order_items_addition WHERE order_item_id = $orderItemID AND addition_id = $addition_id";
		$removeAddition = $pdo->prepare($removeAddition);
		$removeAddition->execute();

		// --- ATUALIZAR VALOR DO UNITARY_VALUE DA TABELA ORDER_ITEMS ---
		$updValue = "UPDATE order_items SET unitary_value = $newValue WHERE id = $orderItemID";
		$updValue = $pdo->prepare($updValue);
		$updValue->execute();


		// --- GRAVAR LOG ---

		$description = 'REMOVER COMPLEMENTO DO PEDIDO ' . $orderItemID;
		$sqlLog = "DELETE FROM order_items_addition WHERE order_item_id = $orderItemID AND addition_id = $addition_id   /   UPDATE order_items SET unitary_value = $newValue WHERE id = $orderItemID";
		$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
		$register_log = $pdo->prepare($SQL_register_log);
		$register_log->bindValue('id_company', $id_company);
		$register_log->bindValue('dateTime', $dateTime);
		$register_log->bindValue('action', $sqlLog);
		$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
		$register_log->bindValue('description', $description);
		$register_log->bindValue('user', $id_user);
		$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
		$register_log->execute();

		// --- FIM - GRAVAR LOG ---


		$pdo->commit();

		$newValue = str_replace('.', ',', $newValue);

		$retorno = array('codigo' => 1, 'mensagem' => 'Sucesso!', 'value' => $newValue);
		echo json_encode($retorno);
		exit();
	} catch (Exception $e) {

		$pdo->rollback();

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro: ' . $e);
		echo json_encode($retorno);
		exit();
	}
}

// ************************* FIM - REMOVER COMPLEMENTO - BRUNO R. BERNAL - 10/02/2022 ************************

// ************************** ADICIONAR COMPLEMENTO - BRUNO R. BERNAL - 10/02/2022 **************************

if (isset($_GET['addAddition'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$orderItemID = anti_injection($_GET['orderItemID']);
	$orderItemID = filter_var($orderItemID, FILTER_SANITIZE_STRING);

	$product_id = anti_injection($_GET['product_id']);
	$product_id = filter_var($product_id, FILTER_SANITIZE_STRING);

	$addition_id = anti_injection($_GET['addition_id']);
	$addition_id = filter_var($addition_id, FILTER_SANITIZE_STRING);

	$value = anti_injection($_GET['value']);
	$value = filter_var($value, FILTER_SANITIZE_STRING);
	$value = str_replace(',', '.', $value);


	$pdo->beginTransaction();

	try {

		// --- SOMAR VALOR INFORMADO NA TABELA ORDER_ITEMS COM O VALOR DO COMPLEMENTO ---
		$sqlAdditionValue = "SELECT value FROM product_addition WHERE id = $addition_id";
		$sqlAdditionValue = $pdo->prepare($sqlAdditionValue);
		$sqlAdditionValue->execute();
		$rowAdditionValue = $sqlAdditionValue->fetch();
		$additionValue = $rowAdditionValue->value;
		$newVadditionValuealue = str_replace('.', '', $additionValue);
		$additionValue = str_replace(',', '.', $additionValue);

		$newValue = $value + $additionValue;


		// --- GRAVAR COMPLEMENTO NA TABELA ORDER_ITEMS_ADDITION ---
		$addAddition = "INSERT INTO order_items_addition (product_id, addition_id, order_item_id, value) VALUES (:product_id, :addition_id, :order_item_id, :value)";
		$addAddition = $pdo->prepare($addAddition);
		$addAddition->bindValue('product_id', $product_id);
		$addAddition->bindValue('addition_id', $addition_id);
		$addAddition->bindValue('order_item_id', $orderItemID);
		$addAddition->bindValue('value', $additionValue);
		$addAddition->execute();

		// --- SOMAR VALOR DO COMPLEMENTO AO UNITARY_VALUE DA TABELA ORDER_ITEMS ---
		$updValue = "UPDATE order_items SET unitary_value = $newValue WHERE id = $orderItemID";
		$updValue = $pdo->prepare($updValue);
		$updValue->execute();


		// --- GRAVAR LOG ---

		$description = 'ADICIONAR COMPLEMENTO AO PEDIDO ' . $orderItemID;
		$sqlLog = "INSERT INTO order_items_addition (product_id, addition_id, order_item_id, value) VALUES ($product_id, $addition_id, $orderItemID, $additionValue)   /   UPDATE order_items SET unitary_value = $newValue WHERE id = $orderItemID";
		$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
		$register_log = $pdo->prepare($SQL_register_log);
		$register_log->bindValue('id_company', $id_company);
		$register_log->bindValue('dateTime', $dateTime);
		$register_log->bindValue('action', $sqlLog);
		$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
		$register_log->bindValue('description', $description);
		$register_log->bindValue('user', $id_user);
		$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
		$register_log->execute();

		// --- FIM - GRAVAR LOG ---


		$pdo->commit();

		$newValue = str_replace('.', ',', $newValue);

		$retorno = array('codigo' => 1, 'mensagem' => 'Sucesso!', 'value' => $newValue);
		echo json_encode($retorno);
		exit();
	} catch (Exception $e) {

		$pdo->rollback();

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro: ' . $e);
		echo json_encode($retorno);
		exit();
	}
}

// ************************* FIM - ADICIONAR COMPLEMENTO - BRUNO R. BERNAL - 10/02/2022 ************************

// ************************** REMOVER ITEM TEMP - BRUNO R. BERNAL - 10/02/2022 **************************

if (isset($_GET['deleteItemTemp'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$orderItemID = anti_injection($_GET['orderItemID']);
	$orderItemID = filter_var($orderItemID, FILTER_SANITIZE_STRING);

	$pdo->beginTransaction();

	try {

		// --- REMOVER REGISTROS NA TABELA ORDER_ITEMS_ADDITION ---
		$removeAddition = "DELETE FROM order_items_addition WHERE order_item_id = $orderItemID";
		$removeAddition = $pdo->prepare($removeAddition);
		$removeAddition->execute();

		// --- REMOVER REGISTRO DA TABELA ORDER_ITEMS ---
		$removeOrderItem = "DELETE FROM order_items WHERE id = $orderItemID";
		$removeOrderItem = $pdo->prepare($removeOrderItem);
		$removeOrderItem->execute();

		// --- GRAVAR LOG ---

		$description = 'REMOVER PEDIDO TEMP ' . $orderItemID;
		$sqlLog = "DELETE FROM order_items WHERE id = $orderItemID  /  DELETE FROM order_items_addition WHERE order_item_id = $orderItemID";
		$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
		$register_log = $pdo->prepare($SQL_register_log);
		$register_log->bindValue('id_company', $id_company);
		$register_log->bindValue('dateTime', $dateTime);
		$register_log->bindValue('action', $sqlLog);
		$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
		$register_log->bindValue('description', $description);
		$register_log->bindValue('user', $id_user);
		$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
		$register_log->execute();

		// --- FIM - GRAVAR LOG ---

		$pdo->commit();

		$retorno = array('codigo' => 1, 'mensagem' => 'Sucesso!');
		echo json_encode($retorno);
		exit();
	} catch (Exception $e) {

		$pdo->rollback();

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro: ' . $e);
		echo json_encode($retorno);
		exit();
	}
}

// ************************* FIM - REMOVER ITEM TEMP - BRUNO R. BERNAL - 10/02/2022 ************************

// ************************** REMOVER SABORES - BRUNO R. BERNAL - 10/02/2022 **************************

if (isset($_GET['removeFlavor'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$orderItemID = anti_injection($_GET['orderItemID']);
	$orderItemID = filter_var($orderItemID, FILTER_SANITIZE_STRING);

	$product_id = anti_injection($_GET['product_id']);
	$product_id = filter_var($product_id, FILTER_SANITIZE_STRING);

	$flavor_id = anti_injection($_GET['flavor_id']);
	$flavor_id = filter_var($flavor_id, FILTER_SANITIZE_STRING);

	$pdo->beginTransaction();

	try {

		// --- REMOVER SABOR NA TABELA ORDER_ITEMS_ADDITION ---
		$removeFlavor = "DELETE FROM order_items_addition WHERE order_item_id = $orderItemID AND flavor_id = $flavor_id";
		$removeFlavor = $pdo->prepare($removeFlavor);
		$removeFlavor->execute();


		// --- GRAVAR LOG ---

		$description = 'REMOVER SABOR DO PEDIDO ' . $orderItemID;
		$sqlLog = "DELETE FROM order_items_addition WHERE order_item_id = $orderItemID AND flavor_id = $flavor_id";
		$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
		$register_log = $pdo->prepare($SQL_register_log);
		$register_log->bindValue('id_company', $id_company);
		$register_log->bindValue('dateTime', $dateTime);
		$register_log->bindValue('action', $sqlLog);
		$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
		$register_log->bindValue('description', $description);
		$register_log->bindValue('user', $id_user);
		$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
		$register_log->execute();

		// --- FIM - GRAVAR LOG ---

		$pdo->commit();

		$retorno = array('codigo' => 1, 'mensagem' => 'Sucesso!');
		echo json_encode($retorno);
		exit();
	} catch (Exception $e) {

		$pdo->rollback();

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro: ' . $e);
		echo json_encode($retorno);
		exit();
	}
}

// ************************* FIM - REMOVER SABORES - BRUNO R. BERNAL - 10/02/2022 ************************

// ************************** ADICIONAR SABORES - BRUNO R. BERNAL - 10/02/2022 **************************

if (isset($_GET['addFlavor'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$orderItemID = anti_injection($_GET['orderItemID']);
	$orderItemID = filter_var($orderItemID, FILTER_SANITIZE_STRING);

	$product_id = anti_injection($_GET['product_id']);
	$product_id = filter_var($product_id, FILTER_SANITIZE_STRING);

	$flavor_id = anti_injection($_GET['flavor_id']);
	$flavor_id = filter_var($flavor_id, FILTER_SANITIZE_STRING);

	$pdo->beginTransaction();

	try {

		// --- VERIFICAR QUANTOS SABORES FORAM INSERIDOS NESSE REGISTRO E SE PODE INSERIR MAIS UM ---
		$countFlavor = "SELECT COUNT(id) as totalFlavor FROM order_items_addition WHERE order_item_id = $orderItemID AND flavor_id != ''";
		$countFlavor = $pdo->prepare($countFlavor);
		$countFlavor->execute();
		$rowFlavor = $countFlavor->fetch();
		$totalFlavor = $rowFlavor->totalFlavor;

		$selectFraction = "SELECT fraction FROM product WHERE id = $product_id";
		$selectFraction = $pdo->prepare($selectFraction);
		$selectFraction->execute();
		$rowFraction = $selectFraction->fetch();
		$fraction = $rowFraction->fraction;

		if ($fraction <= $totalFlavor) {
			$retorno = array('codigo' => 0, 'mensagem' => 'Limite de Sabores Selecionados Atingido!');
			echo json_encode($retorno);
			exit();
		} else {
			// --- GRAVAR SABOR NA TABELA ORDER_ITEMS_ADDITION ---
			$addFlavor = "INSERT INTO order_items_addition (product_id, flavor_id, order_item_id) VALUES (:product_id, :flavor_id, :order_item_id)";
			$addFlavor = $pdo->prepare($addFlavor);
			$addFlavor->bindValue('product_id', $product_id);
			$addFlavor->bindValue('flavor_id', $flavor_id);
			$addFlavor->bindValue('order_item_id', $orderItemID);
			$addFlavor->execute();


			// --- GRAVAR LOG ---

			$description = 'ADICIONAR SABOR AO PEDIDO ' . $orderItemID;
			$sqlLog = "INSERT INTO order_items_addition (product_id, flavor_id, order_item_id) VALUES ($product_id, $flavor_id, $orderItemID)";
			$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
			$register_log = $pdo->prepare($SQL_register_log);
			$register_log->bindValue('id_company', $id_company);
			$register_log->bindValue('dateTime', $dateTime);
			$register_log->bindValue('action', $sqlLog);
			$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
			$register_log->bindValue('description', $description);
			$register_log->bindValue('user', $id_user);
			$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
			$register_log->execute();

			// --- FIM - GRAVAR LOG ---

			$pdo->commit();

			$retorno = array('codigo' => 1, 'mensagem' => 'Sucesso!');
			echo json_encode($retorno);
			exit();
		}
	} catch (Exception $e) {

		$pdo->rollback();

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro: ' . $e);
		echo json_encode($retorno);
		exit();
	}
}

// ************************* FIM - ADICIONAR SABORES - BRUNO R. BERNAL - 10/02/2022 ************************

// *************************** IMPRESSÃO DO CUPOM - BRUNO R. BERNAL - 03/02/2022 *******************
/*
if (isset($_GET['print'])) {

	$table = anti_injection($_GET['table']);
	$table = filter_var($table, FILTER_SANITIZE_STRING);

	$uniqID = anti_injection($_GET['uniqID']);
	$uniqID = filter_var($uniqID, FILTER_SANITIZE_STRING);

	$orderSheet = anti_injection($_GET['orderSheet']);
	$orderSheet = filter_var($orderSheet, FILTER_SANITIZE_STRING);


	$pdo->beginTransaction();

try {

	if(!empty($table)){
	// --- LISTAR COMANDAS DA MESA ---
	$listOrderSheetTable = "SELECT order_sheet_demand FROM order_items WHERE table_demand = $table AND uniqID = '$uniqID' ";
	$listOrderSheetTable = $pdo->prepare($listOrderSheetTable);
	$listOrderSheetTable->execute();
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
		}
	}
	

	$pdo->commit();

	

} catch (Exception $e) {

	$pdo->rollback();

	// --- GRAVAR LOG ---

	$description = 'ERRO';
	$sqlLog = $e;
	$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
	$register_log = $pdo->prepare($SQL_register_log);
	$register_log->bindValue('id_company', $_SESSION['id_company']);
	$register_log->bindValue('dateTime', $dateTime);
	$register_log->bindValue('action', $sqlLog);
	$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
	$register_log->bindValue('description', $description);
	$register_log->bindValue('user', $_SESSION['id_user']);
	$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
	$register_log->execute();

	// --- FIM - GRAVAR LOG ---

	
}

	
}

*/
// *************************** FIM - IMPRESSÃO DO CUPOM - BRUNO R. BERNAL - 03/02/2022 *******************


// ******************************** RETIRAR DINHEIRO DO CAIXA - BRUNO R. BERNAL - 01/02/2022 ************

if (isset($_GET['withdraw'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$cashierOrigin = anti_injection($_GET['cashier_origin']);
	$cashierOrigin = filter_var($cashierOrigin, FILTER_SANITIZE_STRING);

	$cashierDestiny = anti_injection($_GET['cashier_destiny']);
	$cashierDestiny = filter_var($cashierDestiny, FILTER_SANITIZE_STRING);

	$value = anti_injection($_GET['value']);
	$value = filter_var($value, FILTER_SANITIZE_STRING);
	$value = str_replace('.', '', $value);
	$value = str_replace(',', '.', $value);

	$description = anti_injection($_GET['description']);
	$description = filter_var($description, FILTER_SANITIZE_STRING);

	$pdo->beginTransaction();

	try {

		$addWithdraw = "INSERT INTO withdraw_money (cashier_id, cashier_id_destiny, value, description, user, dateTime) VALUES (:cashier_id, :cashier_id_destiny, :value, :description, :user, :dateTime)";
		$addWithdraw = $pdo->prepare($addWithdraw);
		$addWithdraw->bindValue('cashier_id', $cashierOrigin);
		$addWithdraw->bindValue('cashier_id_destiny', $cashierDestiny);
		$addWithdraw->bindValue('value', $value);
		$addWithdraw->bindValue('description', $description);
		$addWithdraw->bindValue('user', $id_user);
		$addWithdraw->bindValue('dateTime', $dateTime);
		$addWithdraw->execute();


		$pdo->commit();

		$retorno = array('codigo' => 1, 'mensagem' => 'Lançamento Registrado com Sucesso!');
		echo json_encode($retorno);
		exit();
	} catch (Exception $e) {

		$pdo->rollback();



		// --- GRAVAR LOG ---

		$description = 'ERRO AO RETIRAR DINHEIRO DO CAIXA ' . $cashierOrigin;
		$sqlLog = $e;
		$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
		$register_log = $pdo->prepare($SQL_register_log);
		$register_log->bindValue('id_company', $id_company);
		$register_log->bindValue('dateTime', $dateTime);
		$register_log->bindValue('action', $sqlLog);
		$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
		$register_log->bindValue('description', $description);
		$register_log->bindValue('user', $id_user);
		$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
		$register_log->execute();

		// --- FIM - GRAVAR LOG ---

		$retorno = array('codigo' => 0, 'mensagem' => 'Não foi possível concluir a movimentação');
		echo json_encode($retorno);
		exit();
	}
}

// ***************************** FIM - RETIRAR DINHEIRO DO CAIXA - BRUNO R. BERNAL - 01/02/2022 ************

// ****************************  LISTAR TOTAL PARA FECHAR 0 PEDIDO - BRUNO R. BERNAL - 28/01/2022 ************
if (isset($_GET['modalCloseOrder'])) {

	$totalOrder = anti_injection($_GET['total']);
	$totalOrder = filter_var($totalOrder, FILTER_SANITIZE_STRING);
	$totalOrder = str_replace('.', '', $totalOrder);
	$totalOrder = str_replace(',', '.', $totalOrder);
}
// **************************  FIM - LISTAR TOTAL PARA FECHAR 0 PEDIDO - BRUNO R. BERNAL - 28/01/2022 ***********

// ********************************* LISTAR PEDIDOS DA MESA- BRUNO R. BERNAL - 28/01/2022 *****************

if (isset($_GET['showTable'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$table = anti_injection($_GET['table']);
	$table = filter_var($table, FILTER_SANITIZE_STRING);

	$pdo->beginTransaction();

	try {

		// --- DELETAR REGISTROS QUE TIVEREM TEMP = 1 PARA ESTA MESA ---
		$selectTemp = "SELECT id FROM order_items WHERE temp = 1 AND table_demand = '$table' AND status != 'Finalizado' ";
		$selectTemp = $pdo->prepare($selectTemp);
		$selectTemp->execute();
		while ($rowTemp = $selectTemp->fetch()) {
			$idTemp = $rowTemp->id;

			// --- DELETAR REGISTROS DA TABELA ORDER_ITEMS_ADDITION ---
			$delAddition = "DELETE FROM order_items_addition WHERE order_item_id = $idTemp";
			$delAddition = $pdo->prepare($delAddition);
			$delAddition->execute();

			// --- DELETAR REGISTROS DA TABELA ORDER_ITEMS ---
			$delOrderItem = "DELETE FROM order_items WHERE id = $idTemp AND temp = 1";
			$delOrderItem = $pdo->prepare($delOrderItem);
			$delOrderItem->execute();
		}



		// --- VERIFICAR SE A MESA ESTÁ ABERTA ---
		$verifyTable = "SELECT status_table, uniqID FROM tables WHERE id = :id";
		$verifyTable = $pdo->prepare($verifyTable);
		$verifyTable->bindValue('id', $table);
		$verifyTable->execute();
		if ($rowTable = $verifyTable->fetch()) {
			$statusTable = $rowTable->status_table;
			$tableUniqID = $rowTable->uniqID;
		} else {
			$statusTable = "Não Existe";
		}

		// --- LISTAR MESA ---
		$showTable = "SELECT a.*,

	SUM(IFNULL(((a.unitary_value * a.quantity) - a.discount),0)) AS total

	FROM order_items a

	WHERE a.table_demand = '$table' AND a.status != 'Finalizado' GROUP BY a.order_sheet_demand";
		$showTable = $pdo->prepare($showTable);
		$showTable->execute();

		// --- LISTAR VALOR TOTAL DA MESA ---
		$showTotalTable = "SELECT a.*,

	SUM(IFNULL(((a.unitary_value * a.quantity) - a.discount),0)) AS total

	FROM order_items a

	WHERE a.table_demand = '$table' AND a.status != 'Finalizado' GROUP BY a.table_demand";
		$showTotalTable = $pdo->prepare($showTotalTable);
		$showTotalTable->execute();
		if ($rowTotalTable = $showTotalTable->fetch()) {
			$totalTable = $rowTotalTable->total;
		}


		$pdo->commit();
	} catch (Exception $e) {

		$pdo->rollback();

		// --- GRAVAR LOG ---

		$description = 'ERRO AO LISTAR MESA';
		$sqlLog = $e;
		$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
		$register_log = $pdo->prepare($SQL_register_log);
		$register_log->bindValue('id_company', $id_company);
		$register_log->bindValue('dateTime', $dateTime);
		$register_log->bindValue('action', $sqlLog);
		$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
		$register_log->bindValue('description', $description);
		$register_log->bindValue('user', $id_user);
		$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
		$register_log->execute();

		// --- FIM - GRAVAR LOG ---


	}
}

// *********************** FIM - LISTAR PEDIDOS DA MESA - BRUNO R. BERNAL - 28/01/2022 ********************

// ************************************ EXIBIR COMANDA - BRUNO R. BERNAL - 28/01/2022 ************************

if (isset($_GET['showOrderSheet'])) {


	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);


	//--- LISTAR ---
	$listItems = "SELECT a.*,
		IFNULL(((a.unitary_value * a.quantity) - a.discount),0) AS total,
		b.name
		 FROM order_items a
		 LEFT JOIN product b ON a.product_id = b.id
		WHERE a.order_sheet_demand = $id AND a.status != 'Finalizado'";
	$listItems = $pdo->prepare($listItems);
	$listItems->execute();

	// --- LISTAR TOTAL FINAL ---
	$listTotal = "SELECT a.*,
		SUM(IFNULL(((a.unitary_value * a.quantity) - a.discount),0)) AS total

		 FROM order_items a

		WHERE a.order_sheet_demand = $id AND a.status != 'Finalizado' GROUP BY a.order_sheet_demand";
	$listTotal = $pdo->prepare($listTotal);
	$listTotal->execute();
	if ($rowTotalFinal = $listTotal->fetch()) {
		$totalFinal = $rowTotalFinal->total;
		$uniqID = $rowTotalFinal->uniqID;
	}
	//$numberOrderSheet = $id;
}

// ****************************** FIM - EXIBIR COMANDA - BRUNO R. BERNAL - 28/01/2022 *********************


// *********************************** GERAR PEDIDO - BRUNO R. BERNAL - 27/01/2022 **************************

if (isset($_GET['closeOrder'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$payment_uniqID = uniqid();

	$uniqID = anti_injection($_GET['uniqID']);
	$uniqID = filter_var($uniqID, FILTER_SANITIZE_STRING);

	$orderSheet = anti_injection($_GET['orderSheet']);
	$orderSheet = filter_var($orderSheet, FILTER_SANITIZE_STRING);
	// --- SE FOR DIFERENTE DE VAZIO, ENTÃO O FECHAMENTO SERÁ DA COMANDA

	$numberTable = anti_injection($_GET['numberTable']);
	$numberTable = filter_var($numberTable, FILTER_SANITIZE_STRING);
	// --- SE FOR DIFERENTE DE VAZIO, ENTÃO O FECHAMENTO SERÁ DA MESA

	$cpf_cnpj = anti_injection($_GET['cpf_cnpj']);
	$cpf_cnpj = filter_var($cpf_cnpj, FILTER_SANITIZE_STRING);

	$money = anti_injection($_GET['money']);
	$money = filter_var($money, FILTER_SANITIZE_STRING);
	$money = str_replace('.', '', $money);
	$money = str_replace(',', '.', $money);

	$credit = anti_injection($_GET['credit']);
	$credit = filter_var($credit, FILTER_SANITIZE_STRING);
	$credit = str_replace('.', '', $credit);
	$credit = str_replace(',', '.', $credit);

	$debit = anti_injection($_GET['debit']);
	$debit = filter_var($debit, FILTER_SANITIZE_STRING);
	$debit = str_replace('.', '', $debit);
	$debit = str_replace(',', '.', $debit);

	$PIX = anti_injection($_GET['PIX']);
	$PIX = filter_var($PIX, FILTER_SANITIZE_STRING);
	$PIX = str_replace('.', '', $PIX);
	$PIX = str_replace(',', '.', $PIX);

	$discount = anti_injection($_GET['discount']);
	$discount = filter_var($discount, FILTER_SANITIZE_STRING);
	$discount = str_replace('.', '', $discount);
	$discount = str_replace(',', '.', $discount);

	$cashier = anti_injection($_GET['cashier']);
	$cashier = filter_var($cashier, FILTER_SANITIZE_STRING);

	$pdo->beginTransaction();

	try {

		if (empty($numberTable) && empty($orderSheet)) {

			// -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* FECHAR PEDIDO PDV -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*

			// --- ATUALIZAR STATUS DA TABELA ORDER_ITEMS PARA 'Finalizado' ---
			$updStatus = "UPDATE order_items SET status = 'Finalizado', payment_uniqID = :payment_uniqID, temp = 2 WHERE uniqID = :uniqID";
			$updStatus = $pdo->prepare($updStatus);
			$updStatus->bindValue('uniqID', $uniqID);
			$updStatus->bindValue('payment_uniqID', $payment_uniqID);
			$updStatus->execute();

			// --- GERAR PEDIDO COM O UNIQID ---
			$addOrder = "INSERT INTO orders (type, dateTime, discount, payment_uniqID) VALUES (:type, :dateTime, :discount, :payment_uniqID)";
			$addOrder = $pdo->prepare($addOrder);
			$addOrder->bindValue('type', 'PDV');
			$addOrder->bindValue('dateTime', $dateTime);
			$addOrder->bindValue('discount', $discount);
			$addOrder->bindValue('payment_uniqID', $payment_uniqID);
			$addOrder->execute();

			if (!empty($cpf_cnpj)) {
				// --- VERIFICAR SE O CLIENTE POSSUI CADASTRO PARA PEGAR O ID ---
				$verifyCPFCNPJ = "SELECT id FROM client WHERE CPF_CNPJ = :CPF_CNPJ";
				$verifyCPFCNPJ = $pdo->prepare($verifyCPFCNPJ);
				$verifyCPFCNPJ->bindValue('CPF_CNPJ', $cpf_cnpj);
				$verifyCPFCNPJ->execute();
				if ($rowCPFCNPJ = $verifyCPFCNPJ->fetch()) {
					$id = $rowCPFCNPJ->id;

					// --- ATUALIZAR CLIENT_ID NA TABELA ORDER_ITEMS ---
					$updID = "UPDATE order_items SET client_id = :client_id WHERE uniqID = :uniqID";
					$updID = $pdo->prepare($updID);
					$updID->bindValue('client_id', $id);
					$updID->bindValue('uniqID', $uniqID);
					$updID->execute();

					// --- ATUALIZAR CLIENT_ID NA TABELA ORDERS ---
					$updIDOrders = "UPDATE orders SET client_id = :client_id, client_cpf_cnpj = :client_cpf_cnpj WHERE uniqID = :uniqID";
					$updIDOrders = $pdo->prepare($updIDOrders);
					$updIDOrders->bindValue('client_id', $id);
					$updIDOrders->bindValue('client_cpf_cnpj', $cpf_cnpj);
					$updIDOrders->bindValue('uniqID', $uniqID);
					$updIDOrders->execute();
				} else {
					// --- SE NÃO FOR UM USUÁRIO CADASTRADO, ATUALIZA APENAS O CPF / CNPJ NA TABELA ORDERS ---
					$updCPFCNPJ = "UPDATE orders SET client_cpf_cnpj = :client_cpf_cnpj WHERE uniqID = :uniqID";
					$updCPFCNPJ = $pdo->prepare($updCPFCNPJ);
					$updCPFCNPJ->bindValue('client_cpf_cnpj', $cpf_cnpj);
					$updCPFCNPJ->bindValue('uniqID', $uniqID);
					$updCPFCNPJ->execute();
				}
			}

			// --- REGISTRAR O PAGAMENTO ---
			$paymentOrder = "INSERT INTO payment (cashier_id,payment_uniqID, credit, debit, money, PIX, dateTime, origin)  VALUES (:cashier_id,:payment_uniqID, :credit, :debit, :money, :PIX, :dateTime, :origin)";
			$paymentOrder = $pdo->prepare($paymentOrder);
			$paymentOrder->bindValue('cashier_id', $cashier);
			$paymentOrder->bindValue('payment_uniqID', $payment_uniqID);
			$paymentOrder->bindValue('credit', $credit);
			$paymentOrder->bindValue('debit', $debit);
			$paymentOrder->bindValue('money', $money);
			$paymentOrder->bindValue('PIX', $PIX);
			$paymentOrder->bindValue('dateTime', $dateTime);
			$paymentOrder->bindValue('origin', 'PDV');
			$paymentOrder->execute();




			// --- GRAVAR LOG ---

			$description = 'FECHAR PEDIDO NO PDV';
			$sqlLog = "INSERT INTO orders SET payment_uniqID = $payment_uniqID, type = 'PDV', client_cpf_cnpj = $cpf_cnpj 
		INSERT INTO payment (cashier_id,payment_uniqID, credit, debit, money, PIX, dateTime, origin)  VALUES ($cashier,$payment_uniqID, $credit, $debit, $money, $PIX, $dateTime, $origin)";
			$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
			$register_log = $pdo->prepare($SQL_register_log);
			$register_log->bindValue('id_company', $id_company);
			$register_log->bindValue('dateTime', $dateTime);
			$register_log->bindValue('action', $sqlLog);
			$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
			$register_log->bindValue('description', $description);
			$register_log->bindValue('user', $id_user);
			$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
			$register_log->execute();

			// --- FIM - GRAVAR LOG ---

		} else if (!empty($numberTable)) {
			// -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* FECHAR PEDIDO MESA -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*




			// --- ATUALIZAR STATUS DA TABELA ORDER_ITEMS PARA 'Finalizado' ---
			$updStatus = "UPDATE order_items SET status = 'Finalizado', payment_uniqID = :payment_uniqID WHERE uniqID = :uniqID AND  status != 'Finalizado' ";
			$updStatus = $pdo->prepare($updStatus);
			$updStatus->bindValue('uniqID', $uniqID);
			$updStatus->bindValue('payment_uniqID', $payment_uniqID);
			$updStatus->execute();

			// --- GERAR PEDIDO COM O UNIQID ---
			$addOrder = "INSERT INTO orders (type, dateTime, discount, payment_uniqID) VALUES (:type, :dateTime, :discount, :payment_uniqID)";
			$addOrder = $pdo->prepare($addOrder);
			$addOrder->bindValue('type', 'Mesa');
			$addOrder->bindValue('dateTime', $dateTime);
			$addOrder->bindValue('discount', $discount);
			$addOrder->bindValue('payment_uniqID', $payment_uniqID);
			$addOrder->execute();

			if (!empty($cpf_cnpj)) {
				// --- VERIFICAR SE O CLIENTE POSSUI CADASTRO PARA PEGAR O ID ---
				$verifyCPFCNPJ = "SELECT id FROM client WHERE CPF_CNPJ = :CPF_CNPJ";
				$verifyCPFCNPJ = $pdo->prepare($verifyCPFCNPJ);
				$verifyCPFCNPJ->bindValue('CPF_CNPJ', $cpf_cnpj);
				$verifyCPFCNPJ->execute();
				if ($rowCPFCNPJ = $verifyCPFCNPJ->fetch()) {
					$id = $rowCPFCNPJ->id;

					// --- ATUALIZAR CLIENT_ID NA TABELA ORDER_ITEMS ---
					$updID = "UPDATE order_items SET client_id = :client_id WHERE payment_uniqID = :payment_uniqID";
					$updID = $pdo->prepare($updID);
					$updID->bindValue('client_id', $id);
					$updID->bindValue('payment_uniqID', $payment_uniqID);
					$updID->execute();

					// --- ATUALIZAR CLIENT_ID NA TABELA ORDERS ---
					$updIDOrders = "UPDATE orders SET client_id = :client_id, client_cpf_cnpj = :client_cpf_cnpj WHERE payment_uniqID = :payment_uniqID";
					$updIDOrders = $pdo->prepare($updIDOrders);
					$updIDOrders->bindValue('client_id', $id);
					$updIDOrders->bindValue('client_cpf_cnpj', $cpf_cnpj);
					$updIDOrders->bindValue('payment_uniqID', $payment_uniqID);
					$updIDOrders->execute();
				} else {
					// --- SE NÃO FOR UM USUÁRIO CADASTRADO, ATUALIZA APENAS O CPF / CNPJ NA TABELA ORDERS ---
					$updCPFCNPJ = "UPDATE orders SET client_cpf_cnpj = :client_cpf_cnpj WHERE payment_uniqID = :payment_uniqID";
					$updCPFCNPJ = $pdo->prepare($updCPFCNPJ);
					$updCPFCNPJ->bindValue('client_cpf_cnpj', $cpf_cnpj);
					$updCPFCNPJ->bindValue('payment_uniqID', $payment_uniqID);
					$updCPFCNPJ->execute();
				}
			}

			// --- REGISTRAR O PAGAMENTO ---
			$paymentOrder = "INSERT INTO payment (cashier_id,payment_uniqID, credit, debit, money, PIX, dateTime, origin, table_id)  VALUES (:cashier_id,:payment_uniqID, :credit, :debit, :money, :PIX, :dateTime, :origin, :table_id)";
			$paymentOrder = $pdo->prepare($paymentOrder);
			$paymentOrder->bindValue('cashier_id', $cashier);
			$paymentOrder->bindValue('payment_uniqID', $payment_uniqID);
			$paymentOrder->bindValue('credit', $credit);
			$paymentOrder->bindValue('debit', $debit);
			$paymentOrder->bindValue('money', $money);
			$paymentOrder->bindValue('PIX', $PIX);
			$paymentOrder->bindValue('dateTime', $dateTime);
			$paymentOrder->bindValue('origin', 'Mesa');
			$paymentOrder->bindValue('table_id', $numberTable);
			$paymentOrder->execute();


			// --- MUDAR STATUS DA MESA E APAGAR O UNIQID ---
			$updStatusTable = "UPDATE tables SET status_table = 'ABERTO', uniqID = NULL, people = NULL WHERE id = $numberTable";
			$updStatusTable = $pdo->prepare($updStatusTable);
			$updStatusTable->execute();




			// --- GRAVAR LOG ---

			$description = 'FECHAR PEDIDO DA MESA ' . $numberTable;
			$sqlLog = "INSERT INTO orders SET payment_uniqID = $payment_uniqID, type = 'Mesa', client_cpf_cnpj = $cpf_cnpj 
		INSERT INTO payment (cashier_id,payment_uniqID, credit, debit, money, PIX, dateTime, origin, table_id)  VALUES ($cashier,$payment_uniqID, $credit, $debit, $money, $PIX, $dateTime, 'Mesa', $numberTable)";
			$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
			$register_log = $pdo->prepare($SQL_register_log);
			$register_log->bindValue('id_company', $id_company);
			$register_log->bindValue('dateTime', $dateTime);
			$register_log->bindValue('action', $sqlLog);
			$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
			$register_log->bindValue('description', $description);
			$register_log->bindValue('user', $id_user);
			$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
			$register_log->execute();

			// --- FIM - GRAVAR LOG ---




		} else if (!empty($orderSheet)) {

			// -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* FECHAR PEDIDO COMANDA -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*




			// --- ATUALIZAR STATUS DA TABELA ORDER_ITEMS PARA 'Finalizado' ---
			$updStatus = "UPDATE order_items SET status = 'Finalizado', payment_uniqID = :payment_uniqID WHERE uniqID = :uniqID AND  order_sheet_demand = :order_sheet_demand";
			$updStatus = $pdo->prepare($updStatus);
			$updStatus->bindValue('uniqID', $uniqID);
			$updStatus->bindValue('order_sheet_demand', $orderSheet);
			$updStatus->bindValue('payment_uniqID', $payment_uniqID);
			$updStatus->execute();

			// --- GERAR PEDIDO COM O UNIQID ---
			$addOrder = "INSERT INTO orders (type, dateTime, discount, payment_uniqID) VALUES (:type, :dateTime, :discount, :payment_uniqID)";
			$addOrder = $pdo->prepare($addOrder);
			$addOrder->bindValue('type', 'Comanda');
			$addOrder->bindValue('dateTime', $dateTime);
			$addOrder->bindValue('discount', $discount);
			$addOrder->bindValue('payment_uniqID', $payment_uniqID);
			$addOrder->execute();

			if (!empty($cpf_cnpj)) {
				// --- VERIFICAR SE O CLIENTE POSSUI CADASTRO PARA PEGAR O ID ---
				$verifyCPFCNPJ = "SELECT id FROM client WHERE CPF_CNPJ = :CPF_CNPJ";
				$verifyCPFCNPJ = $pdo->prepare($verifyCPFCNPJ);
				$verifyCPFCNPJ->bindValue('CPF_CNPJ', $cpf_cnpj);
				$verifyCPFCNPJ->execute();
				if ($rowCPFCNPJ = $verifyCPFCNPJ->fetch()) {
					$id = $rowCPFCNPJ->id;

					// --- ATUALIZAR CLIENT_ID NA TABELA ORDER_ITEMS ---
					$updID = "UPDATE order_items SET client_id = :client_id WHERE payment_uniqID = :payment_uniqID";
					$updID = $pdo->prepare($updID);
					$updID->bindValue('client_id', $id);
					$updID->bindValue('payment_uniqID', $payment_uniqID);
					$updID->execute();

					// --- ATUALIZAR CLIENT_ID NA TABELA ORDERS ---
					$updIDOrders = "UPDATE orders SET client_id = :client_id, client_cpf_cnpj = :client_cpf_cnpj WHERE payment_uniqID = :payment_uniqID";
					$updIDOrders = $pdo->prepare($updIDOrders);
					$updIDOrders->bindValue('client_id', $id);
					$updIDOrders->bindValue('client_cpf_cnpj', $cpf_cnpj);
					$updIDOrders->bindValue('payment_uniqID', $payment_uniqID);
					$updIDOrders->execute();
				} else {
					// --- SE NÃO FOR UM USUÁRIO CADASTRADO, ATUALIZA APENAS O CPF / CNPJ NA TABELA ORDERS ---
					$updCPFCNPJ = "UPDATE orders SET client_cpf_cnpj = :client_cpf_cnpj WHERE payment_uniqID = :payment_uniqID";
					$updCPFCNPJ = $pdo->prepare($updCPFCNPJ);
					$updCPFCNPJ->bindValue('client_cpf_cnpj', $cpf_cnpj);
					$updCPFCNPJ->bindValue('payment_uniqID', $payment_uniqID);
					$updCPFCNPJ->execute();
				}
			}

			// --- REGISTRAR O PAGAMENTO ---
			$paymentOrder = "INSERT INTO payment (cashier_id,payment_uniqID, credit, debit, money, PIX, dateTime, origin, order_sheet_id)  VALUES (:cashier_id,:payment_uniqID, :credit, :debit, :money, :PIX, :dateTime, :origin, :order_sheet_id)";
			$paymentOrder = $pdo->prepare($paymentOrder);
			$paymentOrder->bindValue('cashier_id', $cashier);
			$paymentOrder->bindValue('payment_uniqID', $payment_uniqID);
			$paymentOrder->bindValue('credit', $credit);
			$paymentOrder->bindValue('debit', $debit);
			$paymentOrder->bindValue('money', $money);
			$paymentOrder->bindValue('PIX', $PIX);
			$paymentOrder->bindValue('dateTime', $dateTime);
			$paymentOrder->bindValue('origin', 'Comanda');
			$paymentOrder->bindValue('order_sheet_id', $orderSheet);
			$paymentOrder->execute();


			// --- VERIFICAR SE EXISTEM MAIS COMANDAS CADASTRADAS NA MESA DESTA, SE NÃO EXISTIR, FECHAR MESA ---
			$listTables = "SELECT table_demand FROM order_items WHERE uniqID = '$uniqID' AND order_sheet_demand != $orderSheet AND status != 'Finalizado' ";
			$listTables = $pdo->prepare($listTables);
			$listTables->execute();
			if ($rowTables = $listTables->fetch()) {
				// --- SE EXISTIR MAIS COMANDAS NESSA MESA, NÃO FECHAR A MESA AINDA ---
			} else {
				// --- SE NÃO EXISTIR MAIS COMANDAS NESSA MESA, FECHAR A MESA ---

				// --- MUDAR STATUS DA MESA E APAGAR O UNIQID ---
				$updStatusTable = "UPDATE tables SET status_table = 'ABERTO', uniqID = NULL, people = NULL WHERE uniqID = '$uniqID'";
				$updStatusTable = $pdo->prepare($updStatusTable);
				$updStatusTable->execute();
			}



			// --- GRAVAR LOG ---

			$description = 'FECHAR PEDIDO DA COMANDA ' . $orderSheet;
			$sqlLog = "INSERT INTO orders SET payment_uniqID = $payment_uniqID, type = 'Comanda', client_cpf_cnpj = $cpf_cnpj 
		INSERT INTO payment (cashier_id,payment_uniqID, credit, debit, money, PIX, dateTime, origin, order_sheet_id)  VALUES ($cashier,$payment_uniqID, $credit, $debit, $money, $PIX, $dateTime, $origin, $orderSheet)";
			$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
			$register_log = $pdo->prepare($SQL_register_log);
			$register_log->bindValue('id_company', $id_company);
			$register_log->bindValue('dateTime', $dateTime);
			$register_log->bindValue('action', $sqlLog);
			$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
			$register_log->bindValue('description', $description);
			$register_log->bindValue('user', $id_user);
			$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
			$register_log->execute();

			// --- FIM - GRAVAR LOG ---

		}


		$pdo->commit();
	} catch (Exception $e) {

		$pdo->rollback();

		// --- GRAVAR LOG ---

		$description = 'ERRO AO FECHAR PEDIDO NO PDV';
		$sqlLog = $e;
		$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
		$register_log = $pdo->prepare($SQL_register_log);
		$register_log->bindValue('id_company', $id_company);
		$register_log->bindValue('dateTime', $dateTime);
		$register_log->bindValue('action', $sqlLog);
		$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
		$register_log->bindValue('description', $description);
		$register_log->bindValue('user', $id_user);
		$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
		$register_log->execute();

		// --- FIM - GRAVAR LOG ---


	}
}

// ***************************** FIM - GERAR PEDIDO - BRUNO R. BERNAL - 27/01/2022 ***********************

// **************************** DELETAR ITEM - BRUNO R. BERNAL - 27/01/2022 ***********************

if (isset($_GET['deleteItem'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$uniqID = anti_injection($_GET['uniqID']);
	$uniqID = filter_var($uniqID, FILTER_SANITIZE_STRING);

	$delItem = "DELETE FROM order_items WHERE id = :id";
	$delItem = $pdo->prepare($delItem);
	$delItem->bindValue('id', $id);
	$delItem->execute();

	//--- LISTAR ---
	$listItems = "SELECT a.*,
		IFNULL(((a.unitary_value * a.quantity) - a.discount),0) AS total,
		b.name
		 FROM order_items a
		 LEFT JOIN product b ON a.product_id = b.id
		WHERE a.uniqID = '$uniqID'";
	$listItems = $pdo->prepare($listItems);
	$listItems->execute();

	// --- LISTAR TOTAL FINAL ---
	$listTotal = "SELECT a.*,
		SUM(IFNULL(((a.unitary_value * a.quantity) - a.discount),0)) AS total

		 FROM order_items a

		WHERE a.uniqID = '$uniqID' GROUP BY a.order_sheet_demand";
	$listTotal = $pdo->prepare($listTotal);
	$listTotal->execute();
	if ($rowTotalFinal = $listTotal->fetch()) {
		$totalFinal = $rowTotalFinal->total;
	}

	// --- GRAVAR LOG ---

	$description = 'DELETAR ITEM NO PDV';
	$sqlLog = "DELETE FROM order_items WHERE id = $id";
	$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
	$register_log = $pdo->prepare($SQL_register_log);
	$register_log->bindValue('id_company', $id_company);
	$register_log->bindValue('dateTime', $dateTime);
	$register_log->bindValue('action', $sqlLog);
	$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
	$register_log->bindValue('description', $description);
	$register_log->bindValue('user', $id_user);
	$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
	$register_log->execute();

	// --- FIM - GRAVAR LOG ---

}

// ******************************** FIM - DELETAR ITEM - BRUNO R. BERNAL - 27/01/2022 *****************


// ************************* ALTERAR INFORMAÇÕES DO ITEM - BRUNO R. BERNAL - 27/01/2022 **************

if (isset($_GET['changeItem'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$quantity = anti_injection($_GET['quantity']);
	$quantity = filter_var($quantity, FILTER_SANITIZE_STRING);

	$observation = anti_injection($_GET['observation']);
	$observation = filter_var($observation, FILTER_SANITIZE_STRING);

	$uniqID = anti_injection($_GET['uniqID']);
	$uniqID = filter_var($uniqID, FILTER_SANITIZE_STRING);

	$changeItem = "UPDATE order_items SET quantity = :quantity, observation = :observation WHERE id = :id";
	$changeItem = $pdo->prepare($changeItem);
	$changeItem->bindValue('quantity', $quantity);
	$changeItem->bindValue('observation', $observation);
	$changeItem->bindValue('id', $id);
	$changeItem->execute();

	//--- LISTAR ---
	$listItems = "SELECT a.*,
		IFNULL(((a.unitary_value * a.quantity) - a.discount),0) AS total,
		b.name
		 FROM order_items a
		 LEFT JOIN product b ON a.product_id = b.id
		WHERE a.uniqID = '$uniqID'";
	$listItems = $pdo->prepare($listItems);
	$listItems->execute();

	// --- LISTAR TOTAL FINAL ---
	$listTotal = "SELECT a.*,
		SUM(IFNULL(((a.unitary_value * a.quantity) - a.discount),0)) AS total

		 FROM order_items a

		WHERE a.uniqID = '$uniqID' GROUP BY a.order_sheet_demand";
	$listTotal = $pdo->prepare($listTotal);
	$listTotal->execute();
	if ($rowTotalFinal = $listTotal->fetch()) {
		$totalFinal = $rowTotalFinal->total;
	}

	// --- GRAVAR LOG ---

	$description = 'ALTERAR ITEM NO PDV';
	$sqlLog = "UPDATE order_items SET quantity = $quantity, observation = $observation WHERE id = $id";
	$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
	$register_log = $pdo->prepare($SQL_register_log);
	$register_log->bindValue('id_company', $id_company);
	$register_log->bindValue('dateTime', $dateTime);
	$register_log->bindValue('action', $sqlLog);
	$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
	$register_log->bindValue('description', $description);
	$register_log->bindValue('user', $id_user);
	$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
	$register_log->execute();

	// --- FIM - GRAVAR LOG ---

}

// ************************* FIM - ALTERAR INFORMAÇÕES DO ITEM - BRUNO R. BERNAL - 27/01/2022 **************

// ****************** LISTAR RELATÓRIO DO CAIXA ABERTO NO MESMO DIA - BRUNO R. BERNAL - 26/01/2022 ***************
if (isset($_GET['relatoryCashier'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	// --- VERIFICAR QUANTO TEM QUE TER NO CAIXA ---

	$totalCashier = "SELECT a.start_money AS money_cashier, a.cashier_id AS 'idCashier' ,  a.dateTime,

	IFNULL((
	SELECT SUM(b.money) 
	FROM  payment b 
	WHERE b.dateTime BETWEEN a.dateTime AND NOW() 
	AND b.cashier_id = a.cashier_id
	),0) AS 'money_payment',
	
	IFNULL((
	SELECT SUM(c.credit) 
	FROM  payment c 
	WHERE c.dateTime BETWEEN a.dateTime AND NOW()  
	AND c.cashier_id = a.cashier_id
	),0) AS 'credit',
	
	IFNULL((
	SELECT SUM(d.debit) 
	FROM  payment d 
	WHERE d.dateTime BETWEEN a.dateTime AND NOW()  
	AND d.cashier_id = a.cashier_id
	),0) AS 'debit',
	
	IFNULL((
	SELECT SUM(e.PIX) 
	FROM  payment e 
	WHERE e.dateTime BETWEEN a.dateTime AND NOW()  
	AND e.cashier_id = a.cashier_id
	),0) AS 'PIX',
	
	IFNULL((
	SELECT SUM(f.value) 
	FROM  withdraw_money f 
	WHERE f.dateTime BETWEEN a.dateTime AND NOW()  
	AND f.cashier_id = a.cashier_id
	),0) AS 'retiradas',

	IFNULL((
	SELECT SUM(f.value) 
	FROM  withdraw_money f 
	WHERE f.dateTime BETWEEN a.dateTime AND NOW()  
	AND f.cashier_id_destiny = a.cashier_id
	),0) AS 'received_transfer'
	
	FROM cashier_opening a 
	
	WHERE a.status = 'Aberto' 
		AND a.id_user = $id_user";
	$totalCashier = $pdo->prepare($totalCashier);
	$totalCashier->execute();
	if ($listTotalCashier = $totalCashier->fetch()) {
		$dateTimeOpening = $listTotalCashier->dateTime;
		$idCashier = $listTotalCashier->idCashier;
		$moneyCashier = $listTotalCashier->money_cashier;
		$totalMoney = $listTotalCashier->money_payment;
		$totalCredit = $listTotalCashier->credit;
		$totalDebit = $listTotalCashier->debit;
		$totalPIX = $listTotalCashier->PIX;
		$totalWithdraw = $listTotalCashier->retiradas;
		$totalReceivedTransfer = $listTotalCashier->received_transfer;
		$cashierMoney = $moneyCashier + $totalMoney + $totalReceivedTransfer - $totalWithdraw; // Caixa Inicial + Entradas em Dinheiro - Retiradas em Dinheiro
		$totalFinal = $cashierMoney + $totalCredit + $totalDebit + $totalPIX;
	}

	// --- LISTAR MOVIMENTAÇÕES DO CAIXA ---

	// --- RETIRADAS ---
	$withdrawMoney = "SELECT a.* FROM withdraw_money a 
		WHERE a.cashier_id = '$id' AND a.dateTime BETWEEN '$dateTimeOpening' AND NOW()";
	$withdrawMoney = $pdo->prepare($withdrawMoney);
	$withdrawMoney->execute();

	// --- PAGAMENTOS ---
	$payment = "SELECT e.id AS 'order_id', a.* FROM payment a
	LEFT JOIN orders e ON e.payment_uniqID = a.payment_uniqID 
		WHERE a.cashier_id = $id		
		AND a.dateTime BETWEEN '$dateTimeOpening' AND NOW()";
	$payment = $pdo->prepare($payment);
	$payment->execute();
}
// ************** FIM -  LISTAR RELATÓRIO DO CAIXA ABERTO NO MESMO DIA - BRUNO R. BERNAL - 26/01/2022 ***********

// ********************* ABRIR CAIXA - BRUNO R. BERNAL - 26/01/2022 *********************************
if (isset($_GET['openCashier'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id = anti_injection($_GET['cashierNumber']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$money = anti_injection($_GET['change_money']);
	$money = filter_var($money, FILTER_SANITIZE_STRING);
	$money = str_replace('.', '', $money);
	$money = str_replace(',', '.', $money);


	$pdo->beginTransaction();

	try {

		// --- VERIFICAR SE O CAIXA JÁ ESTÁ ABERTO ---
		$verifyCashier = "SELECT id FROM cashier_opening WHERE cashier_id = $id AND status = 'Aberto'";
		$verifyCashier = $pdo->prepare($verifyCashier);
		$verifyCashier->execute();
		if ($rowCashier = $verifyCashier->fetch()) {



			$retorno = array('codigo' => 0, 'mensagem' => 'Este caixa já está aberto!');
			echo json_encode($retorno);
			exit();
		} else {

			// --- GRAVAR NA TABELA CASHIER OPENING ---
			$cashierOpening = "INSERT INTO cashier_opening (id_user, cashier_id, start_money, dateTime, status) VALUES (:id_user, :cashier_id, :start_money, :dateTime, :status)";
			$cashierOpening = $pdo->prepare($cashierOpening);
			$cashierOpening->bindValue('id_user', $id_user);
			$cashierOpening->bindValue('cashier_id', $id);
			$cashierOpening->bindValue('start_money', $money);
			$cashierOpening->bindValue('dateTime', $dateTime);
			$cashierOpening->bindValue('status', 'Aberto');
			$cashierOpening->execute();

			// --- GRAVAR LOG ---


			$description = 'ABRIR CAIXA ' . $id;
			$sqlLog = "Usuário $id_user abriu o caixa $id com o valor $money";
			$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
			$register_log = $pdo->prepare($SQL_register_log);
			$register_log->bindValue('id_company', $id_company);
			$register_log->bindValue('dateTime', $dateTime);
			$register_log->bindValue('action', $sqlLog);
			$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
			$register_log->bindValue('description', $description);
			$register_log->bindValue('user', $id_user);
			$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
			$register_log->execute();


			// --- FIM - GRAVAR LOG ---

			$pdo->commit();

			$retorno = array('codigo' => 1, 'mensagem' => 'Caixa Aberto com Sucesso!');
			echo json_encode($retorno);
			exit();
		}
	} catch (Exception $e) {

		$pdo->rollback();

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro: ' . $e);
		echo json_encode($retorno);
		exit();
	}
}
// ********************* FIM - ABRIR CAIXA - BRUNO R. BERNAL - 26/01/2022 *********************************

// ******************** LISTAR CAIXAS DISPONÍVEIS - BRUNO R. BERNAL - 16/01/2022 *********************
if (isset($_GET['listAvailableCashier'])) {

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$listAvailableCashier = "SELECT a.* FROM cashier a
	WHERE a.id NOT IN (SELECT b.cashier_id FROM cashier_opening b WHERE b.status = 'Aberto') AND a.company_id = $id_company";
	$listAvailableCashier = $pdo->prepare($listAvailableCashier);
	$listAvailableCashier->execute();
}


if (isset($_GET['listAvailableCashierWithdraw'])) {

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$cashier = anti_injection($_GET['cashier']);
	$cashier = filter_var($cashier, FILTER_SANITIZE_STRING);


	$listAvailableCashier = "SELECT a.* FROM cashier a
	WHERE a.id IN (SELECT b.cashier_id FROM cashier_opening b WHERE b.status = 'Aberto' AND b.cashier_id != $cashier) AND a.company_id = $id_company";
	$listAvailableCashier = $pdo->prepare($listAvailableCashier);
	$listAvailableCashier->execute();
}



// ******************** FIM - LISTAR CAIXAS DISPONÍVEIS - BRUNO R. BERNAL - 16/01/2022 *********************

// ****************** FECHAR O CAIXA - BRUNO R. BERNAL - 26/01/2022 **********************************

if (isset($_GET['closeCashier'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$money = anti_injection($_POST['totalMoney']);
	$money = filter_var($money, FILTER_SANITIZE_STRING);
	$money = str_replace('.', '', $money);
	$money = str_replace(',', '.', $money);

	$credit = anti_injection($_POST['totalCredit']);
	$credit = filter_var($credit, FILTER_SANITIZE_STRING);
	$credit = str_replace('.', '', $credit);
	$credit = str_replace(',', '.', $credit);

	$debit = anti_injection($_POST['totalDebit']);
	$debit = filter_var($debit, FILTER_SANITIZE_STRING);
	$debit = str_replace('.', '', $debit);
	$debit = str_replace(',', '.', $debit);

	$PIX = anti_injection($_POST['totalPIX']);
	$PIX = filter_var($PIX, FILTER_SANITIZE_STRING);
	$PIX = str_replace('.', '', $PIX);
	$PIX = str_replace(',', '.', $PIX);

	$pdo->beginTransaction();

	try {

		$closeCashier = "UPDATE cashier_opening a SET a.status = 'Fechado', a.dateTime_close = NOW(), money = :money, credit = :credit, debit = :debit, PIX = :PIX WHERE a.cashier_id = $id AND a.status = 'Aberto'";
		$closeCashier = $pdo->prepare($closeCashier);
		$closeCashier->bindValue('money', $money);
		$closeCashier->bindValue('credit', $credit);
		$closeCashier->bindValue('debit', $debit);
		$closeCashier->bindValue('PIX', $PIX);
		$closeCashier->execute();

		// --- GRAVAR LOG ---


		$description = 'FECHAR CAIXA ' . $id;
		$sqlLog = "UPDATE cashier_opening a SET a.status = 'Fechado', a.dateTime_close = NOW(), money = $money, credit = $credit, debit = $debit, PIX = $PIX WHERE a.cashier_id = $id AND a.status = 'Aberto'";
		$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
		$register_log = $pdo->prepare($SQL_register_log);
		$register_log->bindValue('id_company', $id_company);
		$register_log->bindValue('dateTime', $dateTime);
		$register_log->bindValue('action', $sqlLog);
		$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
		$register_log->bindValue('description', $description);
		$register_log->bindValue('user', $id_user);
		$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
		$register_log->execute();


		// --- FIM - GRAVAR LOG ---

		// --- DELETAR DA TABELA ORDER_ITEMS TUDO QUE NÃO TIVER PEDIDO VINCULADO COM AQUELE CAIXA ---
		$findTempPDV = "SELECT id FROM order_items WHERE status = 'Aguardando' AND cashier_id = :cashier_id AND temp != 2";
		$findTempPDV = $pdo->prepare($findTempPDV);
		$findTempPDV->bindValue('cashier_id', $id);
		$findTempPDV->execute();

		while ($rowTempPDV = $findTempPDV->fetch()) {
			$itemID = $rowTempPDV->id;

			$cleanOrderItems = "DELETE FROM order_items WHERE id = :id";
			$cleanOrderItems = $pdo->prepare($cleanOrderItems);
			$cleanOrderItems->bindValue('id', $itemID);
			$cleanOrderItems->execute();

			$cleanAddition = "DELETE FROM order_items_addition WHERE order_item_id = :id";
			$cleanAddition = $pdo->prepare($cleanAddition);
			$cleanAddition->bindValue('id', $itemID);
			$cleanAddition->execute();
		}




		$pdo->commit();

		$retorno = array('codigo' => 1, 'mensagem' => 'Caixa Fechado com Sucesso!');
		echo json_encode($retorno);
		exit();
	} catch (Exception $e) {

		$pdo->rollback();

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro: ' . $e);
		echo json_encode($retorno);
		exit();
	}
}

// ****************** FIM - FECHAR O CAIXA - BRUNO R. BERNAL - 26/01/2022 **********************************

// ******************* VERIFICAR SE O CAIXA ESTÁ ABERTO - BRUNO R. BERNAL - 26/01/2022 ****************


if (isset($_GET['verifyCashier'])) {



	$id = anti_injection($_SESSION['id_user']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);




	// --- VERIFICAR SE EXISTE ALGUM CAIXA ABERTO PARA ESSE USUÁRIO NO DIA ANTERIOR ---

	$sqlVerifyOpening = "SELECT a.cashier_id FROM cashier_opening a WHERE a.STATUS = 'Aberto' AND a.id_user = '$id' AND CAST(a.dateTime AS DATE) < CAST(NOW() AS DATE) AND CAST(NOW() AS TIME) < '05:00:00' ";
	$sqlVerifyOpening = $pdo->prepare($sqlVerifyOpening);
	$sqlVerifyOpening->execute();
	if ($rowCashierOpening = $sqlVerifyOpening->fetch()) {
		$cashier_id = $rowCashierOpening->cashier_id;



		$retorno = array('codigo' => 1, 'mensagem' => 'É necessário fechar o caixa do dia anterior', 'id' => $cashier_id);
		echo json_encode($retorno);
		exit();
	} else {

		// --- VERIFICAR SE O CAIXA ESTÁ ABERTO NA DATA DE HOJE ---
		$sqlVerifyOpeningToday = "SELECT a.cashier_id FROM cashier_opening a WHERE a.STATUS = 'Aberto' AND a.id_user = '$id' AND CAST(a.dateTime AS DATE) = CAST(NOW() AS DATE)";
		$sqlVerifyOpeningToday = $pdo->prepare($sqlVerifyOpeningToday);
		$sqlVerifyOpeningToday->execute();
		if ($rowCashierOpeningToday = $sqlVerifyOpeningToday->fetch()) {
			$cashier_id = $rowCashierOpeningToday->cashier_id;



			$retorno = array('codigo' => 3, 'mensagem' => 'Bem-Vindo (a) de Volta!', 'id' => $cashier_id);
			echo json_encode($retorno);
			exit();
		} else {
			$retorno = array('codigo' => 2, 'mensagem' => 'É necessário abrir o caixa');
			echo json_encode($retorno);
			exit();
		}
	}
}

// ******************* FIM - VERIFICAR SE O CAIXA ESTÁ ABERTO - BRUNO R. BERNAL - 26/01/2022 ****************

// ***************** ADICIONAR ITENS AO PDV - BRUNO R. BERNAL - 25/01/2022 **********************************

if (isset($_GET['addItemPDVTemp'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);


	// --- VERIFICAR SE O PRODUTO VAI PARA A COZINHA PARA GERAR O KITCHEN_STATUS ---
	$verifyStatus = "SELECT kitchen FROM product WHERE id = $id";
	$verifyStatus = $pdo->prepare($verifyStatus);
	$verifyStatus->execute();
	$rowStatus = $verifyStatus->fetch();
	$kitchen = $rowStatus->kitchen;
	if ($kitchen == 'S') {
		$kitchenStatus = 'Aguardando';
		$counterStatus = NULL;
	} else {
		$kitchenStatus = NULL;
		$counterStatus = 'Aguardando';
	}

	if (!empty($_GET['numberOrderSheet'])) {
		$orderSheet = anti_injection($_GET['numberOrderSheet']);
		$orderSheet = filter_var($orderSheet, FILTER_SANITIZE_STRING);
		//$AND_orderSheet = "AND order_sheet_demand = $orderSheet";
	} else {
		$orderSheet = "";
		//$AND_orderSheet = "";
	}


	$cashierID = anti_injection($_GET['cashierID']);
	$cashierID = filter_var($cashierID, FILTER_SANITIZE_STRING);

	$value = anti_injection($_GET['value']);
	$value = filter_var($value, FILTER_SANITIZE_STRING);
	$value = str_replace('.', '', $value);
	$value = str_replace(',', '.', $value);



	$pdo->beginTransaction();

	try {


		// --- GERAR REGISTRO EM ORDER_ITEMS ---
		$addItemPDVTemp = "INSERT INTO order_items (product_id, order_sheet_demand, kitchen_status, counter_status, status, cashier_id, dateTime, company_id, temp, unitary_value) VALUES (:product_id, :order_sheet_demand, :kitchen_status, :counter_status, :status, :cashier_id, :dateTime, :company_id, :temp, :unitary_value)";
		$addItemPDVTemp = $pdo->prepare($addItemPDVTemp);
		$addItemPDVTemp->bindValue('product_id', $id);
		$addItemPDVTemp->bindValue('order_sheet_demand', $orderSheet);
		$addItemPDVTemp->bindValue('kitchen_status', $kitchenStatus);
		$addItemPDVTemp->bindValue('counter_status', $counterStatus);
		$addItemPDVTemp->bindValue('status', 'Aguardando');
		$addItemPDVTemp->bindValue('cashier_id', $cashierID);
		$addItemPDVTemp->bindValue('dateTime', $dateTime);
		$addItemPDVTemp->bindValue('company_id', $id_company);
		$addItemPDVTemp->bindValue('temp', 1);
		$addItemPDVTemp->bindValue('unitary_value', $value);
		$addItemPDVTemp->execute();


		// --- GRAVAR LOG ---


		$description = 'ADICIONAR ITEM AO PDV - TEMP';
		$sqlLog = "INSERT INTO order_items (product_id, order_sheet_demand, kitchen_status, counter_status, status, cashier_id, dateTime, company_id, temp, unitary_value) VALUES ($id, $orderSheet, $kitchenStatus, $counterStatus, 'Aguardando', $cashierID, $dateTime, $id_company, 1, $value)";
		$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
		$register_log = $pdo->prepare($SQL_register_log);
		$register_log->bindValue('id_company', $id_company);
		$register_log->bindValue('dateTime', $dateTime);
		$register_log->bindValue('action', $sqlLog);
		$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
		$register_log->bindValue('description', $description);
		$register_log->bindValue('user', $id_user);
		$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
		$register_log->execute();


		// --- FIM - GRAVAR LOG ---


		// --- PEGAR ID DO REGISTRO PARA ABRIR O MODAL ---
		$searchOrderItemID = "SELECT id FROM order_items WHERE temp = :temp AND product_id = :product_id AND cashier_id = :cashier_id";
		$searchOrderItemID = $pdo->prepare($searchOrderItemID);
		$searchOrderItemID->bindValue('temp', 1);
		$searchOrderItemID->bindValue('product_id', $id);
		$searchOrderItemID->bindValue('cashier_id', $cashierID);
		$searchOrderItemID->execute();
		if ($rowOrderItemID = $searchOrderItemID->fetch()) {
			$order_item_id = $rowOrderItemID->id;
		}


		$pdo->commit();


		$retorno = array('codigo' => 1, 'mensagem' => 'Sucesso!', 'order_item_id' => $order_item_id);
		echo json_encode($retorno);
		exit();
	} catch (Exception $e) {

		$pdo->rollback();

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro: ' . $e);
		echo json_encode($retorno);
		exit();
	}
}



if (isset($_GET['addItemPDV'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	if ($_GET['uniqID'] == "") {
		$uniqID = uniqid();
	} else {
		$uniqID = anti_injection($_GET['uniqID']);
		$uniqID = filter_var($uniqID, FILTER_SANITIZE_STRING);
	}

	$quantity = anti_injection($_GET['quantity']);
	$quantity = filter_var($quantity, FILTER_SANITIZE_STRING);

	$observation = anti_injection($_GET['observation']);
	$observation = filter_var($observation, FILTER_SANITIZE_STRING);

	$cashierID = anti_injection($_GET['cashier_id']);
	$cashierID = filter_var($cashierID, FILTER_SANITIZE_STRING);

	$total = anti_injection($_GET['total']);
	$total = filter_var($total, FILTER_SANITIZE_STRING);
	$total = str_replace('.', '', $total);
	$total = str_replace(',', '.', $total);

	$orderSheet = anti_injection($_GET['orderSheet']);
	$orderSheet = filter_var($orderSheet, FILTER_SANITIZE_STRING);
	if (empty($orderSheet)) {
		$temp = 1;
	} else {
		$temp = 2;
	}

	$flavor = anti_injection($_GET['flavor']);
	$flavor = filter_var($flavor, FILTER_SANITIZE_STRING);
	$flavor = explode(",", $flavor);
	$totalFlavor = count($flavor);

	$addition = anti_injection($_GET['addition']);
	$addition = filter_var($addition, FILTER_SANITIZE_STRING);
	$addition = explode(",", $addition);
	$totalAddition = count($addition);

	$pdo->beginTransaction();

	try {



		// --- VERIFICAR SE O ITEM DEFINE ESTOQUE E SE POSSUI ESTOQUE SUFICIENTE ---
		$sqlLoadStock = "SELECT a.defineStock, a.kitchen,

	
	(
		(SELECT IFNULL((SELECT SUM(e.quantity) FROM stock_adjustment e 
		WHERE e.uniqID = a.uniqID
		AND e.TYPE = 'Entrada'),0) AS 'Entradas')
		-
		(SELECT IFNULL((SELECT SUM(g.quantity) FROM stock_adjustment g 
		WHERE g.uniqID = a.uniqID
		AND g.TYPE = 'Saída'),0) AS 'Saídas')
		-
		(SELECT IFNULL((SELECT SUM(f.quantity) FROM order_items f 
		WHERE f.product_id = a.id ),0) AS 'Pedidos')
		
	) AS 'stock' 
	
	
	FROM product a
	
	INNER JOIN subcategory b ON a.subcategory_id = b.id
	INNER JOIN category c ON c.id = b.category_id
	
	WHERE a.id = :id";
		$sqlLoadStock = $pdo->prepare($sqlLoadStock);
		$sqlLoadStock->bindValue('id', $id);
		$sqlLoadStock->execute();
		$rowStock = $sqlLoadStock->fetch();
		$defineStock = $rowStock->defineStock;
		$stock = $rowStock->stock;
		$kitchen = $rowStock->kitchen;


		if ($defineStock == "S" && $stock < $quantity) {
			$retorno = array('codigo' => 0, 'mensagem' => 'Quantidade Indisponível!');
			echo json_encode($retorno);
			exit();
		}

		// --- DEFINIR STATUS DA COZINHA E STATUS DO BALCÃO ---
		if ($kitchen == 'N') {
			$kitchenStatus = "";
			$counterStatus = "Aguardando";
		} else {
			$kitchenStatus = "Aguardando";
			$counterStatus = "";
		}

		// --- VERIFICAR SE JÁ EXISTE MESA VINCULADA EM ALGUM ITEM DESSE UNIQID, SE EXISTIR, UTILIZAR ESSA INFORMAÇÃO PARA INSERIR O ITEM ---
		$searchTable = "SELECT table_demand FROM order_items WHERE uniqID = :uniqID LIMIT 1";
		$searchTable = $pdo->prepare($searchTable);
		$searchTable->bindValue('uniqID', $uniqID);
		$searchTable->execute();
		if ($rowTable = $searchTable->fetch()) {
			$table = $rowTable->table_demand;
		} else {
			$table = "";
		}


		// --- GRAVAR INFORMAÇÕES NA TABELA ORDER_ITEMS ---
		$sqlAddItemPDV = "INSERT INTO order_items (uniqID, product_id, table_delivery, table_demand, order_sheet_demand, unitary_value, quantity, kitchen_status, counter_status, status, cashier_id, observation, dateTime, company_id, temp) VALUES (:uniqID, :product_id, :table_delivery, :table_demand, :order_sheet_demand, :unitary_value, :quantity, :kitchen_status, :counter_status, :status, :cashier_id, :observation, :dateTime, :company_id, :temp)";
		$sqlAddItemPDV = $pdo->prepare($sqlAddItemPDV);
		$sqlAddItemPDV->bindValue('uniqID', $uniqID);
		$sqlAddItemPDV->bindValue('product_id', $id);
		$sqlAddItemPDV->bindValue('table_delivery', $table);
		$sqlAddItemPDV->bindValue('table_demand', $table);
		$sqlAddItemPDV->bindValue('order_sheet_demand', $orderSheet);
		$sqlAddItemPDV->bindValue('unitary_value', $total);
		$sqlAddItemPDV->bindValue('quantity', $quantity);
		$sqlAddItemPDV->bindValue('kitchen_status', $kitchenStatus);
		$sqlAddItemPDV->bindValue('counter_status', $counterStatus);
		$sqlAddItemPDV->bindValue('status', "Aguardando");
		$sqlAddItemPDV->bindValue('cashier_id', $cashierID);
		$sqlAddItemPDV->bindValue('observation', $observation);
		$sqlAddItemPDV->bindValue('dateTime', $dateTime);
		$sqlAddItemPDV->bindValue('company_id', $id_company);
		$sqlAddItemPDV->bindValue('temp', $temp);
		$sqlAddItemPDV->execute();


		// --- GRAVAR LOG ---


		$description = 'ADICIONAR ITEM AO PDV';
		$sqlLog = "INSERT INTO order_items (uniqID, product_id, table_delivery, table_demand, order_sheet_demand, unitary_value, quantity, kitchen_status, counter_status, status, cashier_id, observation, dateTime, company_id, temp) VALUES ($uniqID, $id, $table, $table, $orderSheet, $total, $quantity, $kitchenStatus, $counterStatus, 'Aguardando', $cashierID, $observation, $dateTime, $id_company, $temp)";
		$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
		$register_log = $pdo->prepare($SQL_register_log);
		$register_log->bindValue('id_company', $id_company);
		$register_log->bindValue('dateTime', $dateTime);
		$register_log->bindValue('action', $sqlLog);
		$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
		$register_log->bindValue('description', $description);
		$register_log->bindValue('user', $id_user);
		$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
		$register_log->execute();


		// --- FIM - GRAVAR LOG ---


		// --- BUSCAR O ID DO REGISTRO RECÉM CRIADO PARA SALVAR OS SABORES E COMPLEMENTOS ---
		$findID = "SELECT id FROM order_items WHERE uniqID = '$uniqID' AND cashier_id = '$cashierID' ORDER BY id DESC LIMIT 1";
		$findID = $pdo->prepare($findID);
		$findID->execute();
		$rowID = $findID->fetch();
		$orderItemID = $rowID->id;


		$paramFlavor = 0;
		while ($paramFlavor <= $totalFlavor) {

			if (!empty($flavor[$paramFlavor])) {

				// --- SALVAR SABOR ---
				$addFlavor = "INSERT INTO order_items_addition (product_id, flavor_id, order_item_id) VALUES (:product_id, :flavor_id, :order_item_id)";
				$addFlavor = $pdo->prepare($addFlavor);
				$addFlavor->bindValue('product_id', $id);
				$addFlavor->bindValue('flavor_id', $flavor[$paramFlavor]);
				$addFlavor->bindValue('order_item_id', $orderItemID);
				$addFlavor->execute();

				// --- GRAVAR LOG ---


				$description = 'SELECIONAR SABOR - PDV';
				$sqlLog = "INSERT INTO order_items_addition (product_id, flavor_id, order_item_id) VALUES ($id, $flavor[$paramFlavor], $orderItemID)";
				$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
				$register_log = $pdo->prepare($SQL_register_log);
				$register_log->bindValue('id_company', $id_company);
				$register_log->bindValue('dateTime', $dateTime);
				$register_log->bindValue('action', $sqlLog);
				$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
				$register_log->bindValue('description', $description);
				$register_log->bindValue('user', $id_user);
				$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
				$register_log->execute();


				// --- FIM - GRAVAR LOG ---

				$paramFlavor++;
			} else {
				$paramFlavor++;
			}
		}



		$paramAddition = 0;
		while ($paramAddition <= $totalAddition) {

			if (!empty($addition[$paramAddition])) {

				// --- SELECIONAR O VALOR ATUAL DO COMPLEMENTO ---
				$findValue = "SELECT value FROM product_addition WHERE id = :id";
				$findValue = $pdo->prepare($findValue);
				$findValue->bindValue('id', $addition[$paramAddition]);
				$findValue->execute();
				$rowValue = $findValue->fetch();
				$additionValue = $rowValue->value;



				// --- SALVAR COMPLEMENTO ---
				$addAddition = "INSERT INTO order_items_addition (product_id, addition_id, order_item_id, value) VALUES (:product_id, :addition_id, :order_item_id, :value)";
				$addAddition = $pdo->prepare($addAddition);
				$addAddition->bindValue('product_id', $id);
				$addAddition->bindValue('addition_id', $addition[$paramAddition]);
				$addAddition->bindValue('order_item_id', $orderItemID);
				$addAddition->bindValue('value', $additionValue);
				$addAddition->execute();

				// --- GRAVAR LOG ---


				$description = 'SELECIONAR COMPLEMENTO - PDV';
				$sqlLog = "INSERT INTO order_items_addition (product_id, addition_id, order_item_id, value) VALUES ($id, $addition[$paramAddition], $orderItemID, $additionValue)";
				$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
				$register_log = $pdo->prepare($SQL_register_log);
				$register_log->bindValue('id_company', $id_company);
				$register_log->bindValue('dateTime', $dateTime);
				$register_log->bindValue('action', $sqlLog);
				$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
				$register_log->bindValue('description', $description);
				$register_log->bindValue('user', $id_user);
				$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
				$register_log->execute();


				// --- FIM - GRAVAR LOG ---




				$paramAddition++;
			} else {
				$paramAddition++;
			}
		}




		$pdo->commit();

		$retorno = array('codigo' => 1, 'mensagem' => 'Sucesso!', 'uniqID' => $uniqID);
		echo json_encode($retorno);
		exit();
	} catch (Exception $e) {

		$pdo->rollback();

		// --- GRAVAR LOG ---


		$description = 'ERRO AO ADICIONAR ITEM AO PDV';
		$sqlLog = $e;
		$SQL_register_log = "INSERT INTO logs(id_company,dateTime,action,IP,description,user,origin)VALUES(
:id_company,
:dateTime,
:action,
:IP,
:description,
:user,
:origin)";
		$register_log = $pdo->prepare($SQL_register_log);
		$register_log->bindValue('id_company', $id_company);
		$register_log->bindValue('dateTime', $dateTime);
		$register_log->bindValue('action', $sqlLog);
		$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
		$register_log->bindValue('description', $description);
		$register_log->bindValue('user', $id_user);
		$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
		$register_log->execute();


		// --- FIM - GRAVAR LOG ---


		$retorno = array('codigo' => 0, 'mensagem' => $e);
		echo json_encode($retorno);
		exit();
	}
}

// ***************** FIM - ADICIONAR ITENS AO PDV - BRUNO R. BERNAL - 25/01/2022 ******************************

// ********************************** PESQUISAR PRODUTOS - BRUNO R. BERNAL - 25/01/2022 **********************

if (isset($_GET['loadProductCategory'])) {

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id = anti_injection($_GET['idCategory']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$sqlLoadProduct = "SELECT a.id, a.uniqID, a.name AS name, a.sale_value, c.name AS category, c.color AS category_color, a.defineStock, i.new_value AS value_promotion, a.fraction,

	IFNULL((SELECT h.img FROM product_img h
	
	WHERE h.id_product = a.id AND h.main_img = 'S'),'no_img') AS image, 
	
	(
		(SELECT IFNULL((SELECT SUM(e.quantity) FROM stock_adjustment e 
		WHERE e.uniqID = a.uniqID
		AND e.TYPE = 'Entrada'),0) AS 'Entradas')
		-
		(SELECT IFNULL((SELECT SUM(g.quantity) FROM stock_adjustment g 
		WHERE g.uniqID = a.uniqID
		AND g.TYPE = 'Saída'),0) AS 'Saídas')
		-
		(SELECT IFNULL((SELECT SUM(f.quantity) FROM order_items f 
		WHERE f.product_id = a.id ),0) AS 'Pedidos')
		
	) AS 'stock' 
	
	
	FROM product a
	
	INNER JOIN subcategory b ON a.subcategory_id = b.id
	INNER JOIN category c ON c.id = b.category_id
	LEFT JOIN promotion i ON i.product_id = a.id AND CAST(NOW() AS DATE) BETWEEN i.start_date AND i.end_date AND i.status = 'Ativo'
	
	WHERE c.id = (SELECT d.category_id FROM subcategory d WHERE d.category_id = :id LIMIT 1)
	AND a.company_id = $id_company
	AND a.status = 'Ativo' ";
	$sqlLoadProduct = $pdo->prepare($sqlLoadProduct);
	$sqlLoadProduct->bindValue('id', $id);
	$sqlLoadProduct->execute();
}

if (isset($_GET['loadProductName'])) {

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$name = anti_injection($_GET['name']);
	$name = filter_var($name, FILTER_SANITIZE_STRING);

	$sqlLoadProduct = "SELECT a.id, a.uniqID, a.name AS name, a.sale_value, c.name AS category, c.color AS category_color, a.defineStock, a.fraction,
	i.new_value AS value_promotion,

	IFNULL((SELECT h.img FROM product_img h
	
	WHERE h.id_product = a.id AND h.main_img = 'S'),'no_img') AS image, 
	
	(
		(SELECT IFNULL((SELECT SUM(e.quantity) FROM stock_adjustment e 
		WHERE e.uniqID = a.uniqID
		AND e.TYPE = 'Entrada'),0) AS 'Entradas')
		-
		(SELECT IFNULL((SELECT SUM(g.quantity) FROM stock_adjustment g 
		WHERE g.uniqID = a.uniqID
		AND g.TYPE = 'Saída'),0) AS 'Saídas')
		-
		(SELECT IFNULL((SELECT SUM(f.quantity) FROM order_items f 
		WHERE f.product_id = a.id ),0) AS 'Pedidos')
		
	) AS 'stock' 
	
	
	FROM product a
	
	INNER JOIN subcategory b ON a.subcategory_id = b.id
	INNER JOIN category c ON c.id = b.category_id
	LEFT JOIN promotion i ON i.product_id = a.id AND CAST(NOW() AS DATE) BETWEEN i.start_date AND i.end_date AND i.status = 'Ativo'
	
	WHERE a.name like :name
	AND a.company_id = $id_company
	AND a.status = 'Ativo' ";
	$sqlLoadProduct = $pdo->prepare($sqlLoadProduct);
	$sqlLoadProduct->bindValue('name', "%$name%");
	$sqlLoadProduct->execute();
}


// ******************************* FIM - PESQUISAR PRODUTOS - BRUNO R. BERNAL - 25/01/2022 **********************


// ********************************** PESQUISAR CATEGORIA - BRUNO R. BERNAL - 25/01/2022 **********************

if (isset($_GET['loadCategory'])) {

	$sqlLoadCategory = "SELECT * FROM category WHERE status = 'Ativo' ";
	$sqlLoadCategory = $pdo->prepare($sqlLoadCategory);
	$sqlLoadCategory->execute();
}


// ******************************* FIM - PESQUISAR CATEGORIA - BRUNO R. BERNAL - 25/01/2022 **********************
