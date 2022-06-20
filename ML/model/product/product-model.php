<?php
require_once '../../lib/Meli/meli.php';
require_once '../../configApp.php';

// ***************************************** CONSULTAR ANÚNCIOS - BRUNO R. BERNAL - 13/06/2022 ****************

if (isset($_GET['searchProduct'])) {

    $name = $_POST['name'];
    $status = $_POST['status'];
    $limit = $_POST['itensPorPagina'];

    if (isset($_GET['offset'])) {
        $offset = $_GET['offset'];
    } else {
        $offset = 0;
    }

    $arrStatus = [
        "active" => "Ativo",
        "inactive" => "Inativo",
        "paused" => "Pausado",
        "closed" => "Fechado",
        "under_review" => "Inativo para Revisar",
        "payment_required" => "Pagamento Pendente"
    ];


    $meli = new Meli($appId, $secretKey);
    $response = $meli->get('/users/me', array('access_token' => $_SESSION['access_token']));

    $id_conta = $response['body']->id;

    $params = [
        'access_token' => $_SESSION['access_token'],
        "q" => $name,
        "status" => $status,
        "limit" => $limit,
        "offset" => $offset
    ];



    $url = '/users/' . $id_conta . "/items/search";
    $response = "";
    $response = $meli->get($url, $params);



    //Abaixo pegamos a lista de IDs dos anúncios da nossa conta
    $anuncios = $response['body']->results;



    // --- TRATAR A PAGINAÇÃO ---
    $total = $response['body']->paging->total;


    if ($total > $limit && $offset < ($total - $limit)) {
        $newOffset = $offset + $limit;
        $hidden = "";
    } else {
        $hidden = "hidden";
    }

    if ($offset == 0) {
        $hiddenAnterior = "hidden";
        $pageOffset = 1;
    } else {
        $hiddenAnterior = "";
        $oldOffset = $offset - $limit;
        $pageOffset = $offset + 1;
    }

    if (($offset + $limit) <= $total) {
        $pageOffsetMax = $offset + $limit;
    } else {
        $pageOffsetMax = $total;
    }

    // --- FIM - TRATAR A PAGINAÇÃO ---





    $list = array();
    //Aqui verificamos se a lista de anúncios não veio vazia
    if (!empty($anuncios) && is_array($anuncios)) {
        //Vai pegar informações de cada anúncio separadamente no ML
        foreach ($anuncios as $anuncio) {
            $produto = array();
            $url = '/items/' . $anuncio;
            $response = "";
            $response = $meli->get($url, array('access_token' => $_SESSION['access_token']));


            //Aqui pegamos as informações que queremos de cada anúncio e jogamos para um array $produto
            if ($response['body']->id) {
                $produto = [
                    "id" => $response['body']->id,
                    "title" => $response['body']->title,
                    "thumbnail" => $response['body']->thumbnail,
                    "price" => $response['body']->price,
                    "permalink" => $response['body']->permalink,
                    "status" => $response['body']->status,
                    "sub_status" => $response['body']->sub_status,
                ];
            }

            //Aqui adicionamos o array produto a lista de produtos que exibiremos no frontend
            if (!empty($produto)) $list[] = $produto;
        }
    }
}




// ****************************************** FIM - CONSULTAR ANÚNCIOS - BRUNO R. BERNAL - 13/06/2022 ****************


// ******************** LISTAR INFRAÇÕES DO ANÚNCIO NO MODAL - BRUNO R. BERNAL - 20/06/2022 ************

if (isset($_GET['searchInfractions'])) {

    $id_anuncio = $_POST['id_anuncio'];


    $meli = new Meli($appId, $secretKey);
    $response = $meli->get('/users/me', array('access_token' => $_SESSION['access_token']));

    $id_conta = $response['body']->id;


    // --- Listar Infração ---
    $params = [
        'access_token' => $_SESSION['access_token'],
        'language' => 'PT',
        'related_item_id' => $id_anuncio
    ];



    $url = "/moderations/infractions/$id_conta";
    $response = "";
    $response = $meli->get($url, $params);

    $motivo = $response['body']->infractions[0]->reason;
    $solucao = $response['body']->infractions[0]->remedy;
    $itemID = $response['body']->infractions[0]->related_item_id;
    

    // --- TRATAR DATA DE CRIAÇÃO DA INFRAÇÃO ---
    $dateCreated = $response['body']->infractions[0]->date_created;


    $dataInfracao = explode('T', $dateCreated)[0];
    $dataInfracao = explode('-', $dataInfracao);
    $dataInfracao = $dataInfracao[2] . "/" . $dataInfracao[1] . "/" . $dataInfracao[0];

    $horaInfracao = explode('T', $dateCreated)[1];
    $horaInfracao = explode(":", $horaInfracao);
    $horaInfracao = $horaInfracao[0] . ":" . $horaInfracao[1];

    $dataHoraInfracao = $dataInfracao . " às " . $horaInfracao;

    // --- FIM - TRATAR DATA DE CRIAÇÃO DA INFRAÇÃO ---


    // --- FIM - Listar Infração ---

}

// ******************** FIM - LISTAR INFRAÇÕES DO ANÚNCIO NO MODAL - BRUNO R. BERNAL - 20/06/2022 ************