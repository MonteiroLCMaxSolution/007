<?php

if (!isset($_SESSION)) {
	session_start();
}
if(isset($_GET['directory'])){
	$directory = $_GET['directory'];
} else{
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


$imgFolder = $_SERVER['DOCUMENT_ROOT'] . '/' . $directory . '/uploads/';

// ******************************* GRAVAR / EDITAR PROMOÇÃO - BRUNO R. BERNAL - 02/02/2022 *****************

if (!empty($_GET['savePromotion'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$id = anti_injection($_POST['id']);
	$id = filter_var($id, FILTER_SANITIZE_STRING);

	$product = anti_injection($_POST['product']);
	$product = filter_var($product, FILTER_SANITIZE_STRING);

	$status = anti_injection($_POST['status']);
	$status = filter_var($status, FILTER_SANITIZE_STRING);

	$old_value = anti_injection($_POST['old_value']);
	$old_value = filter_var($old_value, FILTER_SANITIZE_STRING);
	$old_value = str_replace('.', '', $old_value);
	$old_value = str_replace(',', '.', $old_value);

	$new_value = anti_injection($_POST['new_value']);
	$new_value = filter_var($new_value, FILTER_SANITIZE_STRING);
	$new_value = str_replace('.', '', $new_value);
	$new_value = str_replace(',', '.', $new_value);

	$start_date = anti_injection($_POST['start_date']);
	$start_date = filter_var($start_date, FILTER_SANITIZE_STRING);
	$start_date = explode('/', $start_date);
	$start_date = $start_date[2] . '-' . $start_date[1] . '-' . $start_date[0];

	$end_date = anti_injection($_POST['end_date']);
	$end_date = filter_var($end_date, FILTER_SANITIZE_STRING);
	$end_date = explode('/', $end_date);
	$end_date = $end_date[2] . '-' . $end_date[1] . '-' . $end_date[0];

	$pdo->beginTransaction();

try {

	// --- VERIFICAR STATUS DO PRODUTO ---

    $sql_verif_status_prod = "SELECT status FROM product where id = :id AND company_id = :company_id";
    $verif_status_prod = $pdo->prepare($sql_verif_status_prod);
    $verif_status_prod->bindValue('id', $product);
    $verif_status_prod->bindValue('company_id', $id_company);
    $verif_status_prod->execute();
    $ROW_verif_status_prod = $verif_status_prod->fetch();

    if ($ROW_verif_status_prod->status == 'Inativo') {
        $retorno = array('codigo' => 0, 'mensagem' => 'Não é possivel criar uma promoção para um produto Inativo!');
        echo json_encode($retorno);
        exit();
    } else{

		// --- VERIFICAR SE JÁ EXISTE PROMOÇÃO PARA O PRODUTO ---

		$sql_verif_promo = "SELECT * FROM promotion where product_id = :product_id and cast(end_date as date) = :end_date and company_id = :company_id and status = 'Ativo'";
		$verif_promo = $pdo->prepare($sql_verif_promo);
		$verif_promo->bindValue('product_id', $product);
		$verif_promo->bindValue('end_date', $end_date);
		$verif_promo->bindValue('company_id', $id_company);
		$verif_promo->execute();

		if (!empty($verif_promo->fetch())) {
			if (empty($_POST['id'])) {
				$retorno = array('codigo' => 0, 'mensagem' => 'Produto já está em Promoção!');
				echo json_encode($retorno);
				exit();
			} else {

				$sql_upd_promotion = "UPDATE promotion SET
        product_id = :product_id,
        status = :status,
        start_date = :start_date,
        end_date = :end_date,
        old_value = :old_value,
        new_value = :new_value
        where id = :id";
            $sql_upd_promotion = $pdo->prepare($sql_upd_promotion);
            $sql_upd_promotion->bindValue('product_id', $product);
            $sql_upd_promotion->bindValue('status', $status);
            $sql_upd_promotion->bindValue('start_date', $start_date);
            $sql_upd_promotion->bindValue('end_date', $end_date);
            $sql_upd_promotion->bindValue('old_value', $old_value);
            $sql_upd_promotion->bindValue('new_value', $new_value);
            $sql_upd_promotion->bindValue('id', $id);
            $sql_upd_promotion->execute();

            // --- GRAVAR LOG ---


        $description = 'ATUALIZAR PROMOÇÃO '.$id;
        $sqlLog = "UPDATE promotion SET
        product_id = $product,
        status = $status,
        start_date = $start_date,
        end_date = $end_date,
        old_value = $old_value,
        new_value = $new_value
        where id = $id";
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

        $retorno = array('codigo' => 1, 'mensagem' => 'Dados Atualizados com Sucesso!');
        echo json_encode($retorno);
        exit();
			}
			
		} else{
			 // --------------------------------- CADASTRAR NOVA PROMOÇÃO ------------------------

			 $sqlInsertPromotion= "INSERT INTO promotion (product_id, company_id, status, start_date, end_date, old_value, new_value, user_register, date_register) VALUES (:product_id, :company_id, :status, :start_date, :end_date, :old_value, :new_value, :user_register, :date_register)";
			 $sqlInsertPromotion = $pdo->prepare($sqlInsertPromotion);
			 $sqlInsertPromotion->bindValue('product_id', $product);
			 $sqlInsertPromotion->bindValue('company_id', $id_company);
			 $sqlInsertPromotion->bindValue('status', $status);
			 $sqlInsertPromotion->bindValue('start_date', $start_date);
			 $sqlInsertPromotion->bindValue('end_date', $end_date);
			 $sqlInsertPromotion->bindValue('old_value', $old_value);
			 $sqlInsertPromotion->bindValue('new_value', $new_value);
			 $sqlInsertPromotion->bindValue('user_register', $id_user);
			 $sqlInsertPromotion->bindValue('date_register', $dateTime);
			 $sqlInsertPromotion->execute();
	 
			 // --- GRAVAR LOG ---
	 
	 
			 $description = 'CADASTRAR NOVA PROMOÇÃO';
			 $sqlLog = "INSERT INTO promotion 
			 company_id = $id_company,
			 product_id = $product,
			 status = $status,
			 start_date = $start_date,
			 end_date = $end_date,
			 old_value = $old_value,
			 new_value = $new_value,
			 user_register = $id_user,
			 date_register = $dateTime";
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
	 
			 $retorno = array('codigo' => 1, 'mensagem' => 'Promoção Cadastrada com Sucesso!');
			 echo json_encode($retorno);
			 exit();
		}

	}
/*
	$pdo->commit();

	$retorno = array('codigo' => 1, 'mensagem' => 'Sucesso!');
	echo json_encode($retorno);
	exit();*/

} catch (Exception $e) {

	$pdo->rollback();

	$retorno = array('codigo' => 0, 'mensagem' => 'Erro: '.$e);
	echo json_encode($retorno);
	exit();


}
}



// **************************** FIM - GRAVAR / EDITAR PROMOÇÃO - BRUNO R. BERNAL - 02/02/2022 ***************

// ********************** BUSCAR PREÇO ATUAL DO PRODUTO - BRUNO R. BERNAL - 02/02/2022 **************
if (isset($_GET['searchOldValue'])) {

	$product = anti_injection($_GET['product']);
	$product = filter_var($product, FILTER_SANITIZE_STRING);



	$pdo->beginTransaction();

	try {

		$searchValue = "SELECT sale_value FROM product WHERE id = :id";
		$searchValue = $pdo->prepare($searchValue);
		$searchValue->bindValue('id', $product);
		$searchValue->execute();
		$rowValue = $searchValue->fetch();
		$value = number_format($rowValue->sale_value, 2, ',', '');

		$pdo->commit();

		$retorno = array('codigo' => 1, 'mensagem' => 'Valor Atual Localizado!', 'value' => $value);
		echo json_encode($retorno);
		exit();
	} catch (Exception $e) {

		$pdo->rollback();

		$retorno = array('codigo' => 0, 'mensagem' => 'Erro: ' . $e);
		echo json_encode($retorno);
		exit();
	}
}

// ********************** BUSCAR PREÇO ATUAL DO PRODUTO - BRUNO R. BERNAL - 02/02/2022 **************

// ************************* LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 02/02/2022 **************
if (isset($_GET['idPromotion'])) {
	$sqlListData = "SELECT d.name as product_name, b.name AS name_user_register, a.* FROM promotion a 
	LEFT JOIN user b ON a.user_register = b.id
  LEFT JOIN product d ON a.product_id = d.id
	WHERE a.id = :id";
	$sqlListData = $pdo->prepare($sqlListData);
	$sqlListData->bindValue('id', $_GET['idPromotion']);
	$sqlListData->execute();
	$rowData = $sqlListData->fetch();
	$list_id = $rowData->id;
	$list_product_id = $rowData->product_id;
	$list_product_name = $rowData->product_name;
	$list_start_date = $rowData->start_date;
	$list_end_date = $rowData->end_date;
	$list_new_value = $rowData->new_value;
	$list_old_value = $rowData->old_value;
	$list_status = $rowData->status;
	$list_user_register = $rowData->name_user_register;
	$list_date_register = $rowData->date_register;
} else {
	$list_id = "";
	$list_product_id = "";
	$list_product_name = "";
	$list_start_date = "";
	$list_end_date = "";
	$list_new_value = "";
	$list_old_value = "";
	$list_status = "";
	$list_user_register = "";
	$list_date_register = "";
}


// ************************* FIM - LISTAR DADOS NO FORMULÁRIO - BRUNO R. BERNAL - 02/02/2022 **************



// ******************************* PESQUISAR PROMOÇÃO - BRUNO R. BERNAL - 02/02/2022 *******************

if (isset($_GET['searchPromotion'])) {

	$id_user = anti_injection($_GET['id_user']);
	$id_user = filter_var($id_user, FILTER_SANITIZE_STRING);

	$id_company = anti_injection($_GET['id_company']);
	$id_company = filter_var($id_company, FILTER_SANITIZE_STRING);

	$product = anti_injection($_GET['product']);
	$product = filter_var($product, FILTER_SANITIZE_STRING);
	if (!empty($product)) {
		$AND_product = "AND a.product_id = $product";
	} else {
		$AND_product = "";
	}

	$start_date = anti_injection($_GET['start_date']);
	$start_date = filter_var($start_date, FILTER_SANITIZE_STRING);
	if (!empty($start_date)) {
		$start_date = explode('/', $start_date);
		$start_date = $start_date[2] . '-' . $start_date[1] . '-' . $start_date[0];
		$AND_start_date = "AND a.start_date >= '$start_date'";
	} else {
		$AND_start_date = "";
	}

	$end_date = anti_injection($_GET['end_date']);
	$end_date = filter_var($end_date, FILTER_SANITIZE_STRING);
	if (!empty($end_date)) {
		$end_date = explode('/', $end_date);
		$end_date = $end_date[2] . '-' . $end_date[1] . '-' . $end_date[0];
		$AND_end_date = "AND a.end_date <= '$end_date'";
	} else {
		$AND_end_date = "";
	}


	$sqlSearchPromotion = "SELECT a.*, b.name AS product_name FROM promotion a 
	LEFT JOIN product b ON a.product_id = b.id
	WHERE a.company_id = $id_company $AND_product $AND_start_date $AND_end_date";
	$sqlSearchPromotion = $pdo->prepare($sqlSearchPromotion);
	$sqlSearchPromotion->execute();

	// --- GRAVAR LOG ---


	$description = 'CONSULTAR PROMOÇÃO';
	$sqlLog = "SELECT * FROM promotion WHERE company_id = $id_company $AND_product $AND_start_date $AND_end_date";
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

// ******************************* FIM - PESQUISAR PROMOÇÃO - BRUNO R. BERNAL - 02/02/2022 *******************



// ******************************* LISTAR PRODUTOS NO SELECT 2 - BRUNO R. BERNAL - 02/02/2022 ********
$SQL_list_products = "SELECT a.id, a.name FROM product a WHERE a.company_id = :company_id";
$SQL_list_products = $pdo->prepare($SQL_list_products);
$SQL_list_products->bindValue('company_id', $_SESSION['id_company']);
$SQL_list_products->execute();

// ******************************* FIM - LISTAR PRODUTOS NO SELECT 2 - BRUNO R. BERNAL - 02/02/2022 ********
