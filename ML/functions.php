<?php
require_once 'lib/Meli/meli.php';
require_once 'configApp.php';

$action = $_POST['action'];

if (empty(session_id())) {
    session_start();
}
if ($action == "addprodduct") {

    try {



        $tipo_anuncio = $_POST["listing_type_id"];
        $pic = $_POST["pictures"];
        $titulo = $_POST["title"];
        $descricao = $_POST["desc"];
        $id_categoria = $_POST["category_id"];
        $qtd_estoque = $_POST["available_quantity"];
        $modo_compra = $_POST["buying_mode"];
        $moeda = $_POST["currency_id"];
        $condicao = $_POST["condition"];
        $site_id = $_POST["site_id"];

        $preco = $_POST["price"];
        $preco = str_replace('.', '', $preco);
        $preco = str_replace(',', '.', $preco);

        // --- CRIAR O ARRAY DE ATRIBUTOS PARA INSERIR NO ANÚNCIO ---

        $url = "https://api.mercadolibre.com/categories/$id_categoria/attributes";


        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $attributes = json_decode(curl_exec($curl), true);
        curl_close($curl);

        $attributesArray = [];
        foreach ($attributes as $key => $value) {
            $inputID = $attributes[$key]['id'];
            $valueType = $attributes[$key]['value_type'];

            if (empty($_POST[$inputID])) {
                continue;
            }

            if ($valueType == "number_unit") {
                $value = $_POST[$inputID] . " " . $_POST[$inputID . "Unit"];
            } else {
                $value = $_POST[$inputID];
            }



            $attributesArray[] = array(
                "id" => $inputID,
                "value_name" => $value
            );
        }

        // --- FIM - CRIAR O ARRAY DE ATRIBUTOS PARA INSERIR NO ANÚNCIO ---

        /*
     * Aqui setamos todas as opções que queremos do anúncio
     * Para consultar os atributos das categorias acesse o link apenas alterando o ID da Categoria
     * https://api.mercadolibre.com/categories/MLB260864/attributes
     */
        $item = array(
            "title" => $titulo,
            "category_id" => $id_categoria,
            "price" => $preco,
            "currency_id" => $moeda,
            "available_quantity" => $qtd_estoque,
            "buying_mode" => $modo_compra,
            "listing_type_id" => $tipo_anuncio,
            "condition" => $condicao,


            "sale_terms" => array(
                array(
                    "id" => "WARRANTY_TYPE",
                    "value_name" => "Garantia do vendedor"
                ),

                array(
                    "id" => "WARRANTY_TIME",
                    "value_name" => "90 dias"
                ),
            ),


            "pictures" => array(
                array(
                    "source" => $pic
                )
            ),
            "shipping" => array(
                "mode" => "me1",
                "local_pick_up" => false,
                "free_shipping" => false,
                "methods" => [],
                "dimensions" => null,
                "tags" => [],
                "logistic_type" => "default",
                "store_pick_up" => false
            ),


            "attributes" => $attributesArray

        );

        $meli = new Meli($appId, $secretKey);


        $response = $meli->post('/items', $item, array('access_token' => $_SESSION['access_token']));
        //print_r($response);

        if ($response['httpCode'] == 201) {

            // --- PEGAR O ID PARA GRAVAR A DESCRIÇÃO DO ANÚNCIO ---
            $idAnuncio = $response['body']->id;


            $url       = "https://api.mercadolibre.com/items/$idAnuncio/description?api_version=2";
            $cabecalho = array('Content-Type: application/json', 'Accept: application/json', 'Authorization: Bearer '.$_SESSION['access_token']);
            $campos    = json_encode(array('plain_text' => $descricao));

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL,            $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER,     $cabecalho);
            curl_setopt($ch, CURLOPT_POSTFIELDS,     $campos);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST,           true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  'PUT');

            $resposta = curl_exec($ch);

            curl_close($ch);



            $retorno = array('codigo' => 1, 'mensagem' => 'Anúncio Cadastrado com Sucesso!', 'log' => $resposta);
            echo json_encode($retorno);
            exit();
        } else {
            $retorno = array('codigo' => 0, 'mensagem' => 'Erro ao cadastrar Anúncio!', 'erro' => $response);
            echo json_encode($retorno);
            exit();
        }
    } catch (Exception $e) {

        $retorno = array('codigo' => 0, 'mensagem' => 'Erro ao Cadastrar Anúncio!', 'erro' => $e);
        echo json_encode($retorno);
        exit();
    }
} else if ($action == "sendanswer") {
    $question_id = $_POST["question_id"];
    $text = $_POST["text"];

    $answer = [
        "question_id" => $question_id,
        "text" => $text
    ];

    try {

        $meli = new Meli($appId, $secretKey);
        $response = $meli->post('/answers', $answer, array('access_token' => $_SESSION['access_token']));

        if (isset($response['body']->status) && isset($response['body']->error) && $response['body']->status != 200)
            throw new Exception($response['body']->message);
        print_r($response);
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
} else if ($action == "getsuggestion") {
    $title = urlencode($_POST["title"]);

    try {

        $url = "https://api.mercadolibre.com/sites/MLB/domain_discovery/search?limit=1&q=$title";


        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $resp = json_decode(curl_exec($curl), true);
        curl_close($curl);
        $category_id = $resp[0]['category_id'];
        $category_name = $resp[0]['category_name'];
        $attributes = $resp[0]['attributes'][0]['id'];

        $retorno = array('codigo' => 1, 'mensagem' => "Pesquisa Concluída com Sucesso!", 'category_id' => $category_id, 'category_name' => $category_name, 'attributes' => $attributes);
        echo json_encode($retorno);
        exit();
    } catch (Exception $e) {


        $retorno = array('codigo' => 0, 'mensagem' => "Erro ao Pesquisar Categoria. Por favor, tente novamente!", 'erro' => $e);
        echo json_encode($retorno);
        exit();
    }
}


// ** EXIBIR FORMULÁRIO DE ACORDO COM OS ATRIBUTOS NECESSÁRIOS PARA A CATEGORIA - BRUNO R. BERNAL - 26/05/2022 **

if (isset($_GET['getFormCategory'])) {

    $category = $_POST['category'];

    try {

        $url = "https://api.mercadolibre.com/categories/$category/attributes";


        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $attributes = json_decode(curl_exec($curl), true);
        curl_close($curl);
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
}

// ** FIM - EXIBIR FORMULÁRIO DE ACORDO COM OS ATRIBUTOS NECESSÁRIOS PARA A CATEGORIA - BRUNO R. BERNAL - 26/05/2022 **

// ******************** EXIBIR SUGESTÕES DE CATEGORIA NO SELECT - BRUNO R. BERNAL - 30/05/2022 ********************

if (isset($_GET['suggestCategory'])) {

    $title = urlencode($_POST["title"]);

   

    try {

        $url = "https://api.mercadolibre.com/sites/MLB/domain_discovery/search?limit=8&q=$title";


        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $retorno = json_decode(curl_exec($curl), true);
        curl_close($curl);
    } catch (Exception $e) {

        echo "Ocorreu um Erro ao buscar as Categorias. Por favor, atualize a Página e tente novamente! Erro: $e";
    }
}

// ****************** FIM - EXIBIR SUGESTÕES DE CATEGORIA NO SELECT - BRUNO R. BERNAL - 30/05/2022 ********************