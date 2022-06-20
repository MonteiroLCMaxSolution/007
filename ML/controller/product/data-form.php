<input class="formCategory required" id="token" name="token" value="<?php echo $_SESSION['access_token'] ?>" hidden>
<div class="container" style="padding-top: 20px;">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-center"><b>Cadastro de anúncio</b></h1>
                    <small class="form-text text-muted text-center">
                        Preencha todos os campos obrigatórios para liberar o botão "Cadastrar"!
                    </small>
                    <div class="bootstrap-iso">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <form method="post" id="product">
                                        <div class="form-group">
                                            <label class="control-label" for="title">
                                                T&iacute;tulo do an&uacute;ncio
                                            </label>
                                            <input class="form-control required formCategory" onkeyup="validaForm()" required id="title" name="title" type="text" value="" placeholder="ex: Relógio teste - não ofertar" onblur="getSuggestion()" />
                                        </div>

                                        <div id="selectCategory"></div>

                                        <div class="form-group">
                                            <label class="control-label" for="desc">
                                                Descrição do anúncio
                                            </label>
                                            <textarea class="form-control required formCategory" onkeyup="validaForm()" required id="desc" name="desc"></textarea>
                                        </div>


                                        <label class="control-label" for="listing_type_id">
                                            Selecione o tipo de anúncio
                                        </label>
                                        <div class="input-group mb-3">
                                            <select class="select form-control formCategory" id="listing_type_id" name="listing_type_id">
                                                <option value="free">
                                                    Grátis
                                                </option>
                                                <option value="gold_special">
                                                    Clássico
                                                </option>
                                                <option value="gold_pro">
                                                    Premium
                                                </option>
                                            </select>
                                            <div class="input-group-append">
                                                <a class="btn btn-primary" href="https://www.mercadolivre.com.br/ajuda/quanto-custa-vender-um-produto_1338" target="_blank" style="width: 100%">Consultar Taxas no Mercado Livre</a>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="pictures">
                                                URL da imagem
                                            </label>
                                            <input class="form-control formCategory required" id="pictures" name="pictures" placeholder="ex: http://domain.com/my-image.jpg" type="text" value="" />
                                        </div>




                                        <div class="form-group">
                                            <label class="control-label" for="available_quantity">
                                                Quantidade em estoque
                                            </label>
                                            <input class="form-control required formCategory" onkeyup="validaForm()" required id="available_quantity" name="available_quantity" type="number" value="" />
                                        </div>
                                        <div class="form-group" hidden>
                                            <label class="control-label" for="condition">
                                                Modo da compra
                                            </label>
                                            <select class="select form-control formCategory" id="buying_mode" name="buying_mode">
                                                <option value="buy_it_now" selected>
                                                    buy_it_now
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group" hidden>
                                            <label class="control-label" for="condition">
                                                Moeda
                                            </label>
                                            <select class="select form-control formCategory" id="currency_id" name="currency_id">
                                                <option value="BRL" selected>
                                                    BRL
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="condition">
                                                Condi&ccedil;&atilde;o do produto
                                            </label>
                                            <select class="select form-control formCategory" id="condition" name="condition">
                                                <option value="new" selected>
                                                    Novo
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group" hidden>
                                            <label class="control-label" for="site_id">
                                                ID do site
                                            </label>
                                            <select class="select form-control formCategory" id="site_id" name="site_id">
                                                <option value="MLB" selected>
                                                    MLB
                                                </option>
                                            </select>
                                            <small id="siteHelp" class="form-text text-muted">
                                                MLB (Mercado Livre Brasil)
                                            </small>
                                        </div>

                                        <label class="control-label" for="price">Preço</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#modalComporPreco">Compor Preço</button>
                                            </div>
                                            <input class="form-control required formCategory money" onkeyup="validaForm()" required id="price" name="price" type="text" />
                                        </div>

                                        <div id="formCategory"></div>


                                        <div class="form-group">
                                            <div>
                                                <button class="btn btn-primary btn-lg btn-block" disabled id="addprod" type="button">
                                                    Cadastrar
                                                </button>
                                            </div>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal Compor Preço -->
<div class="modal fade bd-example-modal-lg" id="modalComporPreco" tabindex="-1" role="dialog" aria-labelledby="modalComporPrecoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalComporPrecoLabel">Compor Preço do Anúncio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">

                    <div class="col-lg-6">


                        <label class="control-label">
                            Qual Lucro deseja ter na Venda?
                        </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select class="form-control" id="tipo_lucro" onchange="compPreco()">
                                <option value="porcentagem">Porcentagem (%)</option>
                                <option value="valor">Valor (R$)</option>
                                </select>
                            </div>
                            <input class="form-control money" id="lucro" type="text" onkeyup="compPreco()" />
                        </div>

                    </div> <!-- /. col -->

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">
                                <b>(R$)</b> Qual o Custo do Item?
                            </label>
                            <input class="form-control money" id="custo" type="text" onkeyup="compPreco()" />
                        </div>
                    </div> <!-- /. col -->

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">
                                <b>(R$)</b> Qual o Custo da Embalagem?
                            </label>
                            <input class="form-control money" id="custo_embalagem" type="text" onkeyup="compPreco()" />
                        </div>
                    </div> <!-- /. col -->

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">
                                <b>(R$)</b> Possui Outros Custos?
                            </label>
                            <input class="form-control money" id="outros_custos" type="text" onkeyup="compPreco()" />
                        </div>
                    </div> <!-- /. col -->

                    <div class="col-lg-12">
                        <label class="control-label">
                            <b>(%)</b> Taxa - MarketPlace
                        </label>
                        <div class="input-group mb-3">
                            <input class="form-control money" id="taxa_marketplace" type="text" onkeyup="compPreco()" />
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="https://www.mercadolivre.com.br/ajuda/quanto-custa-vender-um-produto_1338" target="_blank" style="width: 100%">Consultar Taxas no Mercado Livre</a>
                            </div>
                        </div>
                    </div> <!-- /. col -->

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">
                                <b>(%)</b> Taxa - Impostos
                            </label>
                            <input class="form-control money" id="taxa_impostos" type="text" onkeyup="compPreco()" />
                        </div>
                    </div> <!-- /. col -->

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">
                                <b>(%)</b> Outras Taxas de Venda
                            </label>
                            <input class="form-control money" id="outras_taxas" type="text" onkeyup="compPreco()" />
                        </div>
                    </div> <!-- /. col -->

                </div> <!-- /. row -->


                <h4 class="text-center">Seu Anúncio deverá ser de: <b>R$<span id="result">0,00</span></b></h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="confirmPreco()">Aplicar</button>
            </div>
        </div>
    </div>
</div>