<?php
require_once '../../lib/Meli/meli.php';

$status = $_POST['status'];

$meli = new Meli($appId, $secretKey);
$response = $meli->get('/users/me', array('access_token' => $_SESSION['access_token']));

$id_conta = $response['body']->id;

$url = 'questions/search';
$response = "";
$params = [
    'seller_id' => $id_conta,
    'status' => $status,
    'access_token' => $_SESSION['access_token'],
];
$response = $meli->get($url, $params);

//Abaixo pegamos a lista de perguntas da nossa conta
$qtd_perguntas = $response['body']->total;
$perguntas = $response['body']->questions;
/*
echo "<pre>";
print_r($perguntas);
echo "</pre>";
*/

if ($status == "ANSWERED") {
    $hidden = "hidden";
    $readonly = "readonly";
} else {
    $hidden = "";
    $readonly = "";
}

?>

<div class="row">
    <?php if (is_int($qtd_perguntas) && $qtd_perguntas > 0 && !empty($perguntas)) : ?>
        <?php foreach ($perguntas as $pergunta) : ?>
            <?php
            $product_url = "";
            $url = '/items/' . $pergunta->item_id;
            $anuncio = "";
            $anuncio = $meli->get($url, array('access_token' => $_SESSION['access_token']));
            $product_url = $anuncio['body']->permalink;
            $product = $anuncio['body']->title;

            // Manipular Datas
            $dataPergunta = explode('T', $pergunta->date_created)[0];
            $dataPergunta = explode('-', $dataPergunta);
            $dataPergunta = $dataPergunta[2] . "/" . $dataPergunta[1] . "/" . $dataPergunta[0];

            $horaPergunta = explode('T', $pergunta->date_created)[1];
            $horaPergunta = explode(":", $horaPergunta);
            $horaPergunta = $horaPergunta[0] . ":" . $horaPergunta[1];

            $dataHoraPergunta = $dataPergunta . " " . $horaPergunta;

            if ($status == "ANSWERED") {
                $dataResposta = explode('T', $pergunta->answer->date_created)[0];
                $dataResposta = explode('-', $dataResposta);
                $dataResposta = $dataResposta[2] . "/" . $dataResposta[1] . "/" . $dataResposta[0];

                $horaResposta = explode('T', $pergunta->answer->date_created)[1];
                $horaResposta = explode(":", $horaResposta);
                $horaResposta = $horaResposta[0] . ":" . $horaResposta[1];

                $dataHoraResposta = $dataResposta . " " . $horaResposta;
            } else {
                $dataHoraResposta = "";
            }




            ?>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                <div class="card" style="margin-top: 10px;">
                    <h5 class="card-header">ID Pergunta: <?php echo $pergunta->id ?></h5>

                    <div class="card-body">
                        <h5 class="card-title">Produto:
                            <a href="<?php echo $product_url ?>" target="_blank"><?php echo $product; ?></a>
                        </h5>
                        <p class="card-text">
                            <?php echo $pergunta->text ?> <small class="text-muted"><?php echo $dataHoraPergunta; ?></small>
                        </p>
                        <p class="card-text">
                            <textarea class="form-control" <?php echo $readonly; ?> id="question-<?php echo $pergunta->id ?>" style="width: 100%"><?php echo $pergunta->answer->text; ?></textarea>
                            <small class="text-muted" style="float: right"><?php echo $dataHoraResposta; ?></small>
                        </p>
                        <button <?php echo $hidden; ?> class="btn btn-primary" onclick="sendAnswer(<?php echo $pergunta->id ?>)">
                            Responder
                        </button>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    <?php else : ?>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
            <div class="card" style="text-align: center;">
                <div class="card-body">
                    <h5 class="card-title">Nenhuma pergunta para listar!</h5>
                    <div style="padding: 10px;">
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>