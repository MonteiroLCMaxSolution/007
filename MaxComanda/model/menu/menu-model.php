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


$imgFolder = $_SERVER['DOCUMENT_ROOT'] . '/' . $directory . '/uploads/';

// ************************* LISTAR MENU LOCAL - BRUNO R. BERNAL - 15/02/2022 ******************************

if(isset($_GET['listMenuLocal'])){

    $idCompany = anti_injection($_GET['idCompany']);
	$idCompany = filter_var($idCompany, FILTER_SANITIZE_STRING);

    $_SESSION['idCompany'] = $idCompany;

    // --- LISTAR CATEGORIAS QUE TENHA PRODUTOS CADASTRADOS NESSA EMPRESA ---
    $sqlListCategory = "SELECT c.id, c.name AS category_name, c.color
    FROM product a
    LEFT JOIN subcategory b ON a.subcategory_id = b.id
    LEFT JOIN category c ON b.category_id = c.id
    WHERE a.company_id = $idCompany AND c.status = 'Ativo'
    GROUP BY c.name";
    $sqlListCategory = $pdo->prepare($sqlListCategory);
    $sqlListCategory->execute();
    $numberCategory = $sqlListCategory->rowCount();
    while($listCategory = $sqlListCategory->fetch()){
        $categoryName[] = $listCategory->category_name;
        $categoryColor[] = $listCategory->color;
        $categoryID[] = $listCategory->id;
    }
    

    $sqlDataCompany = "SELECT fantasia, CEP, address, number, neighborhood, city, UF, phone, color_header, color_text, logo FROM company WHERE id = $idCompany";
    $sqlDataCompany = $pdo->prepare($sqlDataCompany);
    $sqlDataCompany->execute();
    $dataCompany = $sqlDataCompany->fetch();
    $fantasia = $dataCompany->fantasia;
    $CEP = $dataCompany->CEP;
    $address = $dataCompany->address;
    $number = $dataCompany->number;
    $neighborhood = $dataCompany->neighborhood;
    $city = $dataCompany->city;
    $UF = $dataCompany->UF;
    $phone = $dataCompany->phone;
    $color_header = $dataCompany->color_header;
    $color_text = $dataCompany->color_text;
    $logo = $dataCompany->logo;
    
}

// ****************** FIM - LISTAR MENU LOCAL - BRUNO R. BERNAL - 15/02/2022 ******************************

// ********************************** LISTAR CATEGORIAS - BRUNO R. BERNAL - 14/02/2022 ********************
$sqlLoadCategory = "SELECT * FROM category WHERE status = 'Ativo' ";
$sqlLoadCategory = $pdo->prepare($sqlLoadCategory);
$sqlLoadCategory->execute();

// ********************************** FIM - LISTAR CATEGORIAS - BRUNO R. BERNAL - 14/02/2022 ******************

// ******************************** LISTAR INFORMAÇÕES DA EMPRESA - BRUNO R. BERNAL - 15/02/2022 ************

    // --- VERIFICAR SE EXISTE MAIS DE UMA EMPRESA CADASTRADA, SE HOUVER, ABRIR MODAL PARA O CLIENTE SELECIONAR EM QUAL ENDEREÇO ELE ESTÁ ---
    $searchCompany = "SELECT id, fantasia, CEP, address, number, neighborhood, city, UF FROM company";
    $searchCompany = $pdo->prepare($searchCompany);
    $searchCompany->execute();

// ***************************** FIM - LISTAR INFORMAÇÕES DA EMPRESA - BRUNO R. BERNAL - 15/02/2022 ************
