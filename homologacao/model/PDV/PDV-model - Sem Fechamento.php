<?php

if (!isset($_SESSION)) {
	session_start();
}
if (empty($_GET['directory'])) {
	$directory = "/MaxComanda/";
} else {
	$directory = $_GET['directory'];
}

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


$ConexaoMysql = $_SERVER['DOCUMENT_ROOT'] . '/' . $directory . '/conexao-pdo/conexao-mysql-pdo.php';
include_once($ConexaoMysql);


date_default_timezone_set('America/Sao_Paulo');
$dateTime = date('Y-m-d H:i:s', time());
$date = date('Y-m-d', time());


$imgFolder = $_SERVER['DOCUMENT_ROOT'] . '/' . $directory . '/uploads/logo/';

// ********************************* MODAL PARA FECHAR MESA - BRUNO R. BERNAL - 29/01/2022 *****************
if(isset($_GET['modalCloseOrderTable'])){

	$value = anti_injection($_GET['value']);
	$value = filter_var($value, FILTER_SANITIZE_STRING);
	$value = str_replace('.', '', $value);
	$value = str_replace(',', '.', $value);

	
		$totalOrder = number_format($value, 2, '.', '');
	

}

// *********************** FIM - MODAL PARA FECHAR MESA - BRUNO R. BERNAL - 29/01/2022 ********************

// ****************************  LISTAR TOTAL PARA FECHAR 0 PEDIDO - BRUNO R. BERNAL - 28/01/2022 ************
if (isset($_GET['modalCloseOrder'])) {

	$uniqID = anti_injection($_GET['uniqID']);
	$uniqID = filter_var($uniqID, FILTER_SANITIZE_STRING);


	$listTotalOrder = "SELECT a.*,
		SUM(IFNULL(((a.unitary_value * a.quantity) - a.discount),0)) AS total

		 FROM order_items a

		WHERE a.uniqID = '$uniqID' GROUP BY a.uniqID";
	$listTotalOrder = $pdo->prepare($listTotalOrder);
	$listTotalOrder->execute();
	if ($rowTotalOrder = $listTotalOrder->fetch()) {
		$totalOrder = $rowTotalOrder->total;
	}
}
// **************************  FIM - LISTAR TOTAL PARA FECHAR 0 PEDIDO - BRUNO R. BERNAL - 28/01/2022 ***********

// ********************************* LISTAR PEDIDOS DA MESA- BRUNO R. BERNAL - 28/01/2022 *****************

if (isset($_GET['showTable'])) {

	$table = anti_injection($_GET['table']);
	$table = filter_var($table, FILTER_SANITIZE_STRING);

	$pdo->beginTransaction();

	try {

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
			$tableUniqID = $rowTotalTable->uniqID;
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
	$numberOrderSheet = $id;
}

// ****************************** FIM - EXIBIR COMANDA - BRUNO R. BERNAL - 28/01/2022 *********************


// *********************************** GERAR PEDIDO - BRUNO R. BERNAL - 27/01/2022 **************************

if (isset($_GET['closeOrder'])) {

	$uniqID = anti_injection($_GET['uniqID']);
	$uniqID = filter_var($uniqID, FILTER_SANITIZE_STRING);

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

		// --- ATUALIZAR STATUS DA TABELA ORDER_ITEMS PARA 'AGUARDANDO PAGAMENTO' ---
		$updStatus = "UPDATE order_items SET status = 'Finalizado' WHERE uniqID = :uniqID";
		$updStatus = $pdo->prepare($updStatus);
		$updStatus->bindValue('uniqID', $uniqID);
		$updStatus->execute();

		// --- GERAR PEDIDO COM O UNIQID ---
		$addOrder = "INSERT INTO orders (uniqID, type, dateTime, discount) VALUES (:uniqID, :type, :dateTime, :discount)";
		$addOrder = $pdo->prepare($addOrder);
		$addOrder->bindValue('uniqID', $uniqID);
		$addOrder->bindValue('type', 'PDV');
		$addOrder->bindValue('dateTime', $dateTime);
		$addOrder->bindValue('discount', $discount);
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
		$paymentOrder = "INSERT INTO payment (cashier_id,order_uniqID, credit, debit, money, PIX, dateTime, origin)  VALUES (:cashier_id,:order_uniqID, :credit, :debit, :money, :PIX, :dateTime, :origin)";
		$paymentOrder = $pdo->prepare($paymentOrder);
		$paymentOrder->bindValue('cashier_id', $cashier);
		$paymentOrder->bindValue('order_uniqID', $uniqID);
		$paymentOrder->bindValue('credit', $credit);
		$paymentOrder->bindValue('debit', $debit);
		$paymentOrder->bindValue('money', $money);
		$paymentOrder->bindValue('PIX', $PIX);
		$paymentOrder->bindValue('dateTime', $dateTime);
		$paymentOrder->bindValue('origin', 'PDV');
		$paymentOrder->execute();




		// --- GRAVAR LOG ---

		$description = 'FECHAR PEDIDO NO PDV';
		$sqlLog = "INSERT INTO orders SET uniqID = $uniqID, type = 'PDV', client_cpf_cnpj = $cpf_cnpj 
		INSERT INTO payment (cashier_id,order_uniqID, credit, debit, money, PIX, dateTime, origin)  VALUES ($cashier,$uniqID, $credit, $debit, $money, $PIX, $dateTime, $origin)";
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

// ***************************** FIM - GERAR PEDIDO - BRUNO R. BERNAL - 27/01/2022 ***********************

// **************************** DELETAR ITEM - BRUNO R. BERNAL - 27/01/2022 ***********************

if (isset($_GET['deleteItem'])) {

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

// ******************************** FIM - DELETAR ITEM - BRUNO R. BERNAL - 27/01/2022 *****************


// ************************* ALTERAR INFORMAÇÕES DO ITEM - BRUNO R. BERNAL - 27/01/2022 **************

if (isset($_GET['changeItem'])) {

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$quantity = anti_injection($_GET['quantity']);
	$quantity = filter_var($quantity, FILTER_SANITIZE_STRING);

	$discount = anti_injection($_GET['discount']);
	$discount = filter_var($discount, FILTER_SANITIZE_STRING);
	$discount = str_replace('.', '', $discount);
	$discount = str_replace(',', '.', $discount);

	$observation = anti_injection($_GET['observation']);
	$observation = filter_var($observation, FILTER_SANITIZE_STRING);

	$uniqID = anti_injection($_GET['uniqID']);
	$uniqID = filter_var($uniqID, FILTER_SANITIZE_STRING);

	$changeItem = "UPDATE order_items SET quantity = :quantity, discount = :discount, observation = :observation WHERE id = :id";
	$changeItem = $pdo->prepare($changeItem);
	$changeItem->bindValue('quantity', $quantity);
	$changeItem->bindValue('discount', $discount);
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
	$sqlLog = "UPDATE order_items SET quantity = $quantity, discount = $discount, observation = $observation WHERE id = $id";
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

// ************************* FIM - ALTERAR INFORMAÇÕES DO ITEM - BRUNO R. BERNAL - 27/01/2022 **************

// ****************** LISTAR RELATÓRIO DO CAIXA ABERTO NO MESMO DIA - BRUNO R. BERNAL - 26/01/2022 ***************
if (isset($_GET['relatoryCashier'])) {

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
		AND a.id_user = " . $_SESSION['id_user'];
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
		$cashierMoney = $moneyCashier + $totalMoney + $totalReceivedTransfer; // Caixa Inicial + Entradas em Dinheiro
		$totalFinal = $cashierMoney + $totalCredit + $totalDebit + $totalPIX - $totalWithdraw;
	}

	// --- LISTAR MOVIMENTAÇÕES DO CAIXA ---

	// --- RETIRADAS ---
	$withdrawMoney = "SELECT a.* FROM withdraw_money a 
		WHERE a.cashier_id = '$id' AND a.dateTime BETWEEN '$dateTimeOpening' AND NOW()";
	$withdrawMoney = $pdo->prepare($withdrawMoney);
	$withdrawMoney->execute();

	// --- PAGAMENTOS ---
	$payment = "SELECT e.id AS 'order_id', a.* FROM payment a
	LEFT JOIN orders e ON e.uniqID = a.order_uniqID 
		WHERE a.cashier_id = $id		
		AND a.dateTime BETWEEN '$dateTimeOpening' AND NOW()";
	$payment = $pdo->prepare($payment);
	$payment->execute();
}
// ************** FIM -  LISTAR RELATÓRIO DO CAIXA ABERTO NO MESMO DIA - BRUNO R. BERNAL - 26/01/2022 ***********

// ********************* ABRIR CAIXA - BRUNO R. BERNAL - 26/01/2022 *********************************
if (isset($_GET['openCashier'])) {

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
			$cashierOpening->bindValue('id_user', $_SESSION['id_user']);
			$cashierOpening->bindValue('cashier_id', $id);
			$cashierOpening->bindValue('start_money', $money);
			$cashierOpening->bindValue('dateTime', $dateTime);
			$cashierOpening->bindValue('status', 'Aberto');
			$cashierOpening->execute();

			// --- GRAVAR LOG ---


			$description = 'ABRIR CAIXA ' . $id;
			$sqlLog = "Usuário " . $_SESSION['id_user'] . " abriu o caixa $id com o valor $money";
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
	$listAvailableCashier = "SELECT a.* FROM cashier a
	WHERE a.id NOT IN (SELECT b.cashier_id FROM cashier_opening b WHERE b.status = 'Aberto') AND a.company_id = " . $_SESSION['id_company'];
	$listAvailableCashier = $pdo->prepare($listAvailableCashier);
	$listAvailableCashier->execute();
}
// ******************** FIM - LISTAR CAIXAS DISPONÍVEIS - BRUNO R. BERNAL - 16/01/2022 *********************

// ****************** FECHAR O CAIXA - BRUNO R. BERNAL - 26/01/2022 **********************************

if (isset($_GET['closeCashier'])) {

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
		$register_log->bindValue('id_company', $_SESSION['id_company']);
		$register_log->bindValue('dateTime', $dateTime);
		$register_log->bindValue('action', $sqlLog);
		$register_log->bindValue('IP', $_SERVER['SERVER_ADDR']);
		$register_log->bindValue('description', $description);
		$register_log->bindValue('user', $_SESSION['id_user']);
		$register_log->bindValue('origin', $_SERVER['HTTP_REFERER']);
		$register_log->execute();


		// --- FIM - GRAVAR LOG ---

		// --- DELETAR DA TABELA ORDER_ITEMS TUDO QUE NÃO TIVER PEDIDO VINCULADO COM AQUELE CAIXA ---
		$cleanOrderItems = "DELETE FROM order_items WHERE status = 'Aguardando' AND cashier_id = :cashier_id";
		$cleanOrderItems = $pdo->prepare($cleanOrderItems);
		$cleanOrderItems->bindValue('cashier_id', $id);
		$cleanOrderItems->execute();

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

	$sqlVerifyOpening = "SELECT a.cashier_id FROM cashier_opening a WHERE a.STATUS = 'Aberto' AND a.id_user = '$id' AND CAST(a.dateTime AS DATE) < CAST(NOW() AS DATE)";
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

// ******************* ADICIONAR ITENS AO PDV - BRUNO R. BERNAL - 25/01/2022 **********************************

if (isset($_GET['addItemPDV'])) {

	$id = anti_injection($_GET['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	if (!empty($_GET['numberOrderSheet'])) {
		$orderSheet = anti_injection($_GET['numberOrderSheet']);
		$orderSheet = filter_var($orderSheet, FILTER_SANITIZE_STRING);
	} else{
		$orderSheet = "";
	}


	if ($_GET['uniqID'] == "") {
		$uniqID = uniqid();
	} else {
		$uniqID = anti_injection($_GET['uniqID']);
		$uniqID = filter_var($uniqID, FILTER_SANITIZE_STRING);
	}

	$cashierID = anti_injection($_GET['cashierID']);
	$cashierID = filter_var($cashierID, FILTER_SANITIZE_STRING);

	// --- VERIFICAR SE JÁ EXISTE MESA VINCULADA EM ALGUM ITEM DESSE UNIQID, SE EXISTIR, UTILIZAR ESSA INFORMAÇÃO PARA INSERIR O ITEM ---
	$searchTable = "SELECT table_demand FROM order_items WHERE uniqID = :uniqID";
	$searchTable = $pdo->prepare($searchTable);
	$searchTable->bindValue('uniqID', $uniqID);
	$searchTable->execute();
	if ($rowTable = $searchTable->fetch()) {
		$table = $rowTable->table_demand;
	} else {
		$table = "";
	}



	// --- VERIFICAR SE JÁ EXISTE ESSE ITEM NA TABELA ORDER_ITEMS ---

	$verifyItem = "SELECT quantity FROM order_items WHERE uniqID = :uniqID AND product_id = :product_id";
	$verifyItem = $pdo->prepare($verifyItem);
	$verifyItem->bindValue('uniqID', $uniqID);
	$verifyItem->bindValue('product_id', $id);
	$verifyItem->execute();
	if ($rowItem = $verifyItem->fetch()) {
		$oldQtd = $rowItem->quantity;
		$newQuantity = $oldQtd + 1;

		$updItem = "UPDATE order_items SET quantity = :quantity WHERE uniqID = :uniqID AND product_id = :product_id";
		$updItem = $pdo->prepare($updItem);
		$updItem->bindValue('uniqID', $uniqID);
		$updItem->bindValue('product_id', $id);
		$updItem->bindValue('quantity', $newQuantity);
		$updItem->execute();



		

		// --- GRAVAR LOG ---

		$description = 'ADICIONAR ITEM AO PDV';
		$sqlLog = "UPDATE order_items SET quantity = $newQuantity WHERE uniqID = $uniqID AND product_id = $id";
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

	} else {

		// --- GRAVAR ITEM NA TABELA ORDER_ITEMS ---

		// --- BUSCAR VALOR UNITÁRIO ---
		$valueItem = "SELECT sale_value FROM product where id = :product_id";
		$valueItem = $pdo->prepare($valueItem);
		$valueItem->bindValue('product_id', $id);
		$valueItem->execute();
		$rowValue = $valueItem->fetch();
		$value = $rowValue->sale_value;

		$addItem = "INSERT INTO order_items (uniqID, product_id, unitary_value, quantity,status, cashier_id, order_sheet_demand, company_id, table_demand) VALUES (:uniqID, :product_id, :unitary_value, :quantity, :status, :cashier_id, :order_sheet_demand, :company_id, :table_demand)";
		$addItem = $pdo->prepare($addItem);
		$addItem->bindValue('uniqID', $uniqID);
		$addItem->bindValue('product_id', $id);
		$addItem->bindValue('unitary_value', $value);
		$addItem->bindValue('quantity', 1);
		$addItem->bindValue('status', 'Aguardando');
		$addItem->bindValue('cashier_id', $cashierID);
		$addItem->bindValue('order_sheet_demand', $orderSheet);
		$addItem->bindValue('table_demand', $table);
		$addItem->bindValue('company_id', $_SESSION['id_company']);
		$addItem->execute();


		// --- GRAVAR LOG ---


		$description = 'ADICIONAR ITEM AO PDV';
		$sqlLog = "Item adicionado - product_id = $id, uniqID= $uniqID, quantity= 1, order_sheet_demand= $orderSheet, table_demand= $table, company_id= ".$_SESSION['id_company'];
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


	if($orderSheet == ""){
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
} else{

	//--- LISTAR ---
	$listItems = "SELECT a.*,
		IFNULL(((a.unitary_value * a.quantity) - a.discount),0) AS total,
		b.name
		 FROM order_items a
		 LEFT JOIN product b ON a.product_id = b.id
		WHERE a.order_sheet_demand = '$orderSheet' AND a.status != 'Finalizado'";
	$listItems = $pdo->prepare($listItems);
	$listItems->execute();

	// --- LISTAR TOTAL FINAL ---
	$listTotal = "SELECT a.*,
		SUM(IFNULL(((a.unitary_value * a.quantity) - a.discount),0)) AS total

		 FROM order_items a

		WHERE a.order_sheet_demand = '$orderSheet' AND a.status != 'Finalizado' GROUP BY a.order_sheet_demand";
	$listTotal = $pdo->prepare($listTotal);
	$listTotal->execute();
	if ($rowTotalFinal = $listTotal->fetch()) {
		$totalFinal = $rowTotalFinal->total;
		$uniqID = $rowTotalFinal->uniqID;
		$orderSheet = $rowTotalFinal->order_sheet_demand;
	}

}




}

// ***************** FIM - ADICIONAR ITENS AO PDV - BRUNO R. BERNAL - 25/01/2022 ********************************

// ********************************** PESQUISAR PRODUTOS - BRUNO R. BERNAL - 25/01/2022 **********************

if (isset($_GET['loadProductCategory'])) {

	$id = anti_injection($_GET['idCategory']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$sqlLoadProduct = "SELECT a.id, a.uniqID, a.name AS name, a.sale_value, c.name AS category, c.color AS category_color,

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
	
	WHERE c.id = (SELECT d.category_id FROM subcategory d WHERE d.category_id = :id)
	AND a.company_id = " . $_SESSION['id_company'];
	$sqlLoadProduct = $pdo->prepare($sqlLoadProduct);
	$sqlLoadProduct->bindValue('id', $id);
	$sqlLoadProduct->execute();
}

if (isset($_GET['loadProductName'])) {

	$name_id = anti_injection($_GET['name']);
	$name_id = filter_var($name_id, FILTER_SANITIZE_STRING);

	$sqlLoadProduct = "SELECT a.id, a.uniqID, a.name AS name, a.sale_value, c.name AS category, c.color AS category_color,

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
	
	WHERE a.name like :name OR a.id = :id AND
	c.id = (SELECT d.category_id FROM subcategory d WHERE d.category_id = :id)
	AND a.company_id = " . $_SESSION['id_company'];
	$sqlLoadProduct = $pdo->prepare($sqlLoadProduct);
	$sqlLoadProduct->bindValue('name', "%$name_id%");
	$sqlLoadProduct->bindValue('id', $name_id);
	$sqlLoadProduct->execute();
}


// ******************************* FIM - PESQUISAR PRODUTOS - BRUNO R. BERNAL - 25/01/2022 **********************


// ********************************** PESQUISAR CATEGORIA - BRUNO R. BERNAL - 25/01/2022 **********************

if (isset($_GET['loadCategory'])) {

	$sqlLoadCategory = "SELECT * FROM category";
	$sqlLoadCategory = $pdo->prepare($sqlLoadCategory);
	$sqlLoadCategory->execute();
}


// ******************************* FIM - PESQUISAR CATEGORIA - BRUNO R. BERNAL - 25/01/2022 **********************
