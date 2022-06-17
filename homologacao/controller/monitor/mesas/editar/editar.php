<div class="modal-confirm-order">
    <div class="modal-overlay">
        <div class="modal-box">
            <div class="modal-title">
                <h2>Deseja confirmar o Pedido?</h2>
            </div>
            <div class="modal-box-table">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produto</th>
                            <th>Qtd</th>
                            <th>Comanda</th>
                            <th>Observação</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Coxinha</td>
                            <td>2</td>
                            <td>4</td>
                            <td></td>
                            <td><i class="fas fa-trash-alt"></i></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Coxinha</td>
                            <td>2</td>
                            <td>4</td>
                            <td></td>
                            <td><i class="fas fa-trash-alt"></i></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Coxinha</td>
                            <td>2</td>
                            <td>4</td>
                            <td></td>
                            <td><i class="fas fa-trash-alt"></i></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Coxinha</td>
                            <td>2</td>
                            <td>4</td>
                            <td></td>
                            <td><i class="fas fa-trash-alt"></i></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Coxinha</td>
                            <td>2</td>
                            <td>4</td>
                            <td></td>
                            <td><i class="fas fa-trash-alt"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div><!--modal-box-table-->
            <div class="btn-box">
                <a href="#" class="cancel-btn" onclick="fecharFinalizarPedido()">Cancelar</a>
                <a href="#" class="confirm-btn">Confirmar</a>
            </div><!--btn-box-->
        </div><!--modal-box-->
    </div><!--modal-overlay-->
</div><!--modal-confirm-order-->


<div class="modal-add-product">
    <div class="modal-overlay">
        <div class="modal-box">
            <div class="modal-title">
                <h2>14 / Cerveja / R$ 7,00</h2>
            </div><!--modal-title-->
            <form action="" class="flexbox">
                <div class="inp-single w50">
                    <p>Quantidade</p>
                    <div class="quantidade-box flexbox">
                        <div class="quantidade-button qnt-l" onclick="alterarQuantidade(-1, this)" >-</div>
                        <input type="number" name="quantidade-produto" id="quantidade-carrinho-table"  min="1" max="5" value="1" required>
                        <div class="quantidade-button qnt-r" onclick="alterarQuantidade(1, this)" >+</div>
                    </div><!--quantidade-box-->
                </div><!--inp-single-->
                <div class="inp-single w50">
                    <p>Observações</p>
                    <input type="text">
                </div><!--inp-single-->
                <div class="checkbox-container w50">
                    <div class="checkbox-container-title">
                        <h2>Sabores Disponíveis</h2>
                        <h3>Escolha até 2 sabor(es)</h3>
                    </div><!--checkbox-container-title-->
                    <div class="checkbox-container-content">
                        <label for="sabor1">
                            <input type="checkbox" name="" id="sabor1">
                            sabor 1
                        </label>
                        <label for="sabor2">
                            <input type="checkbox" name="" id="sabor2">
                            sabor 2
                        </label>
                        <label for="sabor3">
                            <input type="checkbox" name="" id="sabor3">
                            sabor 3
                        </label>
                    </div><!--checkbox-container-content-->
                </div><!--checkbox-container-->
                <div class="checkbox-container w50">
                    <div class="checkbox-container-title">
                        <h2>Complementos Disponíveis</h2>
                    </div><!--checkbox-container-title-->
                    <div class="checkbox-container-content">
                        <label for="complemento1">
                            <input type="checkbox" name="" id="complemento1">
                            complemento 1
                        </label>
                        <label for="complemento2">
                            <input type="checkbox" name="" id="complemento2">
                            complemento 2
                        </label>
                        <label for="complemento3">
                            <input type="checkbox" name="" id="complemento3">
                            complemento 3
                        </label>
                    </div><!--checkbox-container-content-->
                </div><!--checkbox-container-->
                <div class="total-price-modal w100">
                    <h2>Total: <b>R$ 7,00</b></h2>
                </div><!--total-price-modal-->
                <div class="btn-box w100">
                    <a href="#" onclick="fecharModalAddProduct()">Cancelar</a>
                    <button type="submit" id="btn-enviar-form" disabled>Adicionar</button>
                </div><!--buttons-box-->
            </form>
        </div><!--modal-box-->
    </div><!--modal-overlay-->
</div><!--modal-add-product-->

<section class="table">
    <div class="center">
        <div class="section-title">
            <h2>Editar mesa <b>#1</b></h2>
            <h3>Garçom: <b>Kayky</b></h3>
        </div><!--section-title-->

        <div class="infos-table flexbox">
            <div class="inp-single w33">
                <p>Mesa</p>
                <input type="text" value="1" disabled>
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p>Pessoas</p>
                <input type="number" value="1">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-comanda">Comanda</p>
                <input type="number">
            </div><!--inp-single-->
        </div><!--infos-table-->

        <div class="section-title">
            <h2>Adicionar produto</h2>
        </div><!--section-title-->

        <div class="box-products flexbox">
            <div class="product-single w25" onclick="abrirModalAddProduct()">
                <div class="product-single-img">
                    <img src="images/heineken.jpg" alt="">
                </div><!--product-single-img-->
                <div class="product-single-content">
                    <div class="product-single-title">
                        <h2>Heineken</h2>
                    </div><!--product-single-title-->
                    <div class="product-single-price">
                        <h3>R$ 7,00</h3>
                    </div><!--product-single-price-->
                </div><!--product-single-content-->
            </div><!--product-single-->

            <div class="product-single w25" onclick="abrirModalAddProduct()">
                <div class="product-single-img">
                    <img src="images/heineken2.jpg" alt="">
                </div><!--product-single-img-->
                <div class="product-single-content">
                    <div class="product-single-title">
                        <h2>Heineken</h2>
                    </div><!--product-single-title-->
                    <div class="product-single-price">
                        <h3>R$ 23,00</h3>
                    </div><!--product-single-price-->
                </div><!--product-single-content-->
            </div><!--product-single-->

            <div class="product-single w25" onclick="abrirModalAddProduct()">
                <div class="product-single-img">
                    <img src="images/heineken.jpg" alt="">
                </div><!--product-single-img-->
                <div class="product-single-content">
                    <div class="product-single-title">
                        <h2>Heineken</h2>
                    </div><!--product-single-title-->
                    <div class="product-single-price">
                        <h3>R$ 7,00</h3>
                    </div><!--product-single-price-->
                </div><!--product-single-content-->
            </div><!--product-single-->

            <div class="product-single w25" onclick="abrirModalAddProduct()">
                <div class="product-single-img">
                    <img src="images/heineken2.jpg" alt="">
                </div><!--product-single-img-->
                <div class="product-single-content">
                    <div class="product-single-title">
                        <h2>Heineken</h2>
                    </div><!--product-single-title-->
                    <div class="product-single-price">
                        <h3>R$ 23,00</h3>
                    </div><!--product-single-price-->
                </div><!--product-single-content-->
            </div><!--product-single-->
        </div><!--box-products-->

        <div class="box-categories flexbox">
            <div class="categorie-single w25" onclick="abrirBoxProducts()">
                <h2>Bebidas</h2>
            </div><!--categorie-single-->
            <div class="categorie-single w25" onclick="abrirBoxProducts()">
                <h2>Salgados</h2>
            </div><!--categorie-single-->
            <div class="categorie-single w25" onclick="abrirBoxProducts()">
                <h2>Doces</h2>
            </div><!--categorie-single-->
            <div class="categorie-single w25" onclick="abrirBoxProducts()">
                <h2>Congelados</h2>
            </div><!--categorie-single-->
        </div><!--box-categories-->

        <div class="btn-box w100">
            <a href="#" class="finish-btn float-r" onclick="finalizarPedido()">Finalizar pedido</a>
            <div class="clear"></div>
        </div><!--btn-box-->

        <table class="w100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Produto</th>
                    <th>Qtd</th>
                    <th>Comanda</th>
                    <th>Mesa - Entrega</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Coxinha</td>
                    <td>1</td>
                    <td>3</td>
                    <td>1</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div><!--center-->
</section><!--table->