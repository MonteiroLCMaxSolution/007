<?php
require_once '../../model/product/product-model.php';
?>

<div class="container" style="padding-top: 20px;">
    <div class="row">

        <?php if (!empty($list)) : ?>

            <!-- PAGINAÇÃO -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 text-left">
                        <button class="btn btn-secondary text-white" <?php echo $hiddenAnterior; ?> onclick="listProducts(<?php echo $oldOffset; ?>)">Página Anterior</button>
                    </div> <!-- /. col -->
                    <div class="col-lg-4 text-center">
                        <span class="form-text text-muted"><b><?php echo $total; ?></b> Anúncios Encontrados (Exibindo de <b><?php echo $pageOffset; ?></b> até <b><?php echo $pageOffsetMax; ?></b>)</span>
                    </div> <!-- /. col -->
                    <div class="col-lg-4 text-right">
                        <button class="btn btn-secondary text-white" <?php echo $hidden; ?> onclick="listProducts(<?php echo $newOffset; ?>)">Próxima Página</button>
                    </div> <!-- /. col -->
                </div> <!-- /. row -->
            </div> <!-- /. col -->


            <?php foreach ($list as $produto) : ?>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
                    <div class="card" style="text-align: center; margin-top: 10px; <?php if ($produto['status'] == "under_review") {
                                                                                        echo "background-color: #ccc";
                                                                                    } ?>">
                        <img src="<?php echo $produto['thumbnail'] ?>" class="img-thumbnail rounded mx-auto d-block" alt="imagem-produto" style="width:90px;margin-top: 10px;">

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $produto['title'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">ID: <a href="https://api.mercadolibre.com/items/<?php echo $produto['id'] ?>?access_token=<?php echo $_SESSION['access_token'] ?>"><?php echo $produto['id'] ?></a>
                            </h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Preço:
                                    R$ <?php echo number_format($produto['price'], 2, ",", ".") ?></li>
                            </ul>
                            <div style="padding: 10px;">
                                <a href="<?php echo $produto['permalink'] ?>" target="_blank" class="card-link">Mais
                                    detalhes</a>
                            </div>
                            <p>Status: <b><?php echo $arrStatus[$produto['status']]; ?></b></p>
                            <?php if ($produto['status'] == "under_review") {?>
                                <div style="padding: 10px;">
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal" onclick="listInfractions('<?php echo $produto['id']; ?>')">
                                        Ver Infrações do Anúncio
                                    </button>

                                    <small class="form-text text-muted">Atenção: Pode demorar até 24h para o ML mudar o status da publicação!</small>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

            <!-- PAGINAÇÃO -->
            <div class="col-lg-12" style="margin-top: 15px; margin-bottom: 10px">
                <div class="row">
                    <div class="col-lg-4 text-left">
                        <button class="btn btn-secondary text-white" <?php echo $hiddenAnterior; ?> onclick="listProducts(<?php echo $oldOffset; ?>)">Página Anterior</button>
                    </div> <!-- /. col -->
                    <div class="col-lg-4 text-center">
                        <span class="form-text text-muted"><b><?php echo $total; ?></b> Anúncios Encontrados (Exibindo de <b><?php echo $pageOffset; ?></b> até <b><?php echo $pageOffsetMax; ?></b>)</span>
                    </div> <!-- /. col -->
                    <div class="col-lg-4 text-right">
                        <button class="btn btn-secondary text-white" <?php echo $hidden; ?> onclick="listProducts(<?php echo $newOffset; ?>)">Próxima Página</button>
                    </div> <!-- /. col -->
                </div> <!-- /. row -->
            </div> <!-- /. col -->

        <?php else : ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nenhum anúncio por enquanto!</h5>
                    <div style="padding: 10px;">
                        <a href="add-product.php" target="_blank" class="card-link">Clique aqui para criar um
                            anúncio rápido</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="modal-content">
    </div>
  </div>
</div>