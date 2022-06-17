<div class="pdv-modal modal-retirar-dinheiro">
    <div class="pdv-modal-overlay">
        <div class="pdv-modal-box">
            <div class="pdv-modal-title">
                <h2>Informe o Valor, Motivo e o Caixa de Destino (em caso de transferência)!</h2>
            </div><!--pdv-modal-title-->
            <div class="pdv-modal-form">
                <form action="" class="flexbox">
                    <div class="inp-single w100">
                        <p>Valor</p>
                        <input type="text" placeholder="R$">
                    </div><!--inp-single-->
                    <div class="inp-single w100">
                        <p>Motivo</p>
                        <input type="text">
                    </div><!--inp-single-->
                    <div class="inp-single w100">
                        <p>Caixa destino</p>
                        <select name="" id="">
                            <option value="">Não é uma transferência</option>
                            <option value="">Transferir para o caixa 1</option>
                            <option value="">Transferir para o caixa 3</option>
                        </select>
                    </div><!--inp-single-->
                </form>
            </div><!--pdv-modal-form-->
            <div class="btn-box flexbox">
                <div class="btn-single btn-cancel w50">
                    <a href="#" onclick="cancelRetirarDinheiro()">Cancelar</a>
                </div><!--btn-single-->
                <div class="btn-single btn-confirm w50">
                    <a href="">Salvar</a>
                </div><!--btn-single-->
            </div><!--btn-box-->
        </div><!--pdv-modal-box-->
    </div><!--pdv-modal-overlay-->
</div><!--pdv-modal modal-retirar-dinheiro-->

<div class="pdv-modal modal-editar-produto">
    <div class="pdv-modal-overlay">
        <div class="pdv-modal-box">
            <div class="pdv-modal-title">
                <h2>Editar: X-BACON</h2>
            </div><!--pdv-modal-title-->
            <div class="pdv-modal-form">
                <form action="" class="flexbox">
                    <div class="inp-single w50">
                        <p>Quantidade</p>
                        <input type="number" value="1" min="1">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Observações</p>
                        <input type="text" placeholder="">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Desconto total</p>
                        <input type="text" placeholder="R$">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Valor final</p>
                        <input type="text" disabled>
                    </div><!--inp-single-->
                    <div class="checkbox-container w50">
                        <div class="checkbox-container-title">
                            <h2>Sabores Disponíveis:</h2>
                            <h3>Escolha até 2 sabore(s)</h3>
                        </div><!--checkbox-container-title-->
                        <div class="checkbox-container-content">
                            <label for="sabor1">
                                <input type="checkbox">
                                Frango
                            </label>
                            <label for="sabor1">
                                <input type="checkbox">
                                Carne
                            </label>
                            <label for="sabor1">
                                <input type="checkbox">
                                Queijo
                            </label>
                        </div>
                    </div><!--checkbox-container-->
                    <div class="checkbox-container w50">
                        <div class="checkbox-container-title">
                            <h2>Complementos Disponíveis:</h2>
                        </div><!--checkbox-container-title-->
                        <div class="checkbox-container-content">
                            <label class="w100">
                                <input type="checkbox">
                                Ketchup - R$ 2,00
                            </label>
                            <label for="sabor1" class="w100">
                                <input type="checkbox">
                                Mostarda - R$ 2,50
                            </label>
                            <label for="sabor1 w100">
                                <input type="checkbox">
                                Maionese - R$ 3,00
                            </label>
                        </div>
                    </div><!--checkbox-container-->
                </form>
            </div><!--pdv-modal-form-->
            <div class="btn-box flexbox">
                <div class="btn-single btn-cancel w33">
                    <a href="#" onclick="cancelEditarProduto()">Cancelar</a>
                </div><!--btn-single-->
                <div class="btn-single btn-remove-item w33">
                    <a href="">Remover item</a>
                </div><!--btn-single-->
                <div class="btn-single btn-confirm w33">
                    <a href="">Alterar</a>
                </div><!--btn-single-->
            </div><!--btn-box-->
        </div><!--pdv-modal-box-->
    </div><!--pdv-modal-overlay-->
</div><!--pdv-modal-->

<div class="pdv-modal modal-fechar-caixa">
    <div class="pdv-modal-overlay">
        <div class="pdv-modal-box">
            <div class="pdv-modal-title">
                <h2>Caixa <b>2</b></h2>
                <h3>Informe os Totais para Fechar o Caixa</h3>
            </div><!--pdv-modal-title-->
            <div class="pdv-modal-form">
                <form action="" class="flexbox">
                    <div class="inp-single w50">
                        <p>Dinheiro</p>
                        <input type="text" placeholder="R$">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Crédito</p>
                        <input type="text" placeholder="R$">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Débito</p>
                        <input type="text" placeholder="R$">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>PIX</p>
                        <input type="text" placeholder="R$">
                    </div><!--inp-single-->
                </form>
            </div><!--pdv-modal-form-->
            <div class="btn-box flexbox">
                <div class="btn-single btn-cancel w33">
                    <a href="#" onclick="cancelFecharCaixa()">Cancelar</a>
                </div><!--btn-single-->
                <div class="btn-single btn-relatorio w33">
                    <a href="#">Relatório</a>
                </div><!--btn-single-->
                <div class="btn-single btn-confirm w33">
                    <a href="">Fechar Caixa</a>
                </div><!--btn-single-->
            </div><!--btn-box-->
        </div><!--pdv-modal-box-->
    </div><!--pdv-modal-overlay-->
</div><!--pdv-modal-->

<div class="pdv-modal modal-finalizar-pedido">
    <div class="pdv-modal-overlay">
        <div class="pdv-modal-box">
            <div class="pdv-modal-title">
                <h2>Caixa <b>2</b></h2>
                <h1>Valor total: <b>R$ 100,00</b></h1>
                <h3>Informe os Totais para Fechar o Pedido</h3>
            </div><!--pdv-modal-title-->
            <div class="pdv-modal-form">
                <form action="" class="flexbox">
                    <div class="inp-single w50">
                        <p>Dinheiro</p>
                        <input type="text" placeholder="R$">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Crédito</p>
                        <input type="text" placeholder="R$">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Débito</p>
                        <input type="text" placeholder="R$">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>PIX</p>
                        <input type="text" placeholder="R$">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Desconto</p>
                        <input type="text" placeholder="R$">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Troco</p>
                        <input type="text" placeholder="R$">
                    </div><!--inp-single-->
                </form>
            </div><!--pdv-modal-form-->
            <div class="btn-box flexbox">
                <div class="btn-single btn-cancel w50">
                    <a href="#" onclick="cancelFinalizarCaixa()">Cancelar</a>
                </div><!--btn-single-->
                <div class="btn-single btn-confirm w50">
                    <a href="">Finalizar</a>
                </div><!--btn-single-->
            </div><!--btn-box-->
        </div><!--pdv-modal-box-->
    </div><!--pdv-modal-overlay-->
</div><!--pdv-modal-->

<div class="pdv-modal modal-adicionar-produto">
    <div class="pdv-modal-overlay">
        <div class="pdv-modal-box">
            <div class="pdv-modal-title">
                <h2>Coxinha</h2>
            </div><!--pdv-modal-title-->
            <div class="pdv-modal-form">
                <form action="" class="flexbox">
                    <div class="inp-single w50">
                        <p>Quantidade</p>
                        <input type="number" value="1" min="1">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Observações</p>
                        <input type="text" placeholder="">
                    </div><!--inp-single-->
                    <div class="inp-single w100">
                        <p>Valor final</p>
                        <input type="text" disabled>
                    </div><!--inp-single-->
                    <div class="checkbox-container w50">
                        <div class="checkbox-container-title">
                            <h2>Sabores Disponíveis:</h2>
                            <h3>Escolha até 2 sabore(s)</h3>
                        </div><!--checkbox-container-title-->
                        <div class="checkbox-container-content">
                            <label for="sabor1">
                                <input type="checkbox">
                                Frango
                            </label>
                            <label for="sabor1">
                                <input type="checkbox">
                                Carne
                            </label>
                            <label for="sabor1">
                                <input type="checkbox">
                                Queijo
                            </label>
                        </div>
                    </div><!--checkbox-container-->
                    <div class="checkbox-container w50">
                        <div class="checkbox-container-title">
                            <h2>Complementos Disponíveis:</h2>
                        </div><!--checkbox-container-title-->
                        <div class="checkbox-container-content">
                            <label class="w100">
                                <input type="checkbox">
                                Ketchup - R$ 2,00
                            </label>
                            <label for="sabor1" class="w100">
                                <input type="checkbox">
                                Mostarda - R$ 2,50
                            </label>
                            <label for="sabor1 w100">
                                <input type="checkbox">
                                Maionese - R$ 3,00
                            </label>
                        </div>
                    </div><!--checkbox-container-->
                </form>
            </div><!--pdv-modal-form-->
            <div class="btn-box flexbox">
                <div class="btn-single btn-cancel w50">
                    <a href="#" onclick="cancelAdicionarProduto()">Cancelar</a>
                </div><!--btn-single-->
                <div class="btn-single btn-confirm w50">
                    <a href="">Adicionar</a>
                </div><!--btn-single-->
            </div><!--btn-box-->
        </div><!--pdv-modal-box-->
    </div><!--pdv-modal-overlay-->
</div><!--pdv-modal-->

<section class="pdv">
    <div class="flexbox">
        <div class="pdv-add-cart-header w100">
            <div class="float-r">
                <div class="pdv-add-cart-icon">
                    <i class="fas fa-border-all" onclick="abrirPdvContainer()"></i>
                </div><!--pdv-add-cart-icon-->
            </div>
            <div class="clear"></div>
        </div><!--pdv-add-cart-header-->
        <div class="pdv-painel">
            <div class="pdv-painel-content">
                <div class="pdv-painel-infos flexbox">
                    <div class="inp-single w50">
                        <p>Caixa aberto</p>
                        <input type="text" value="2" disabled>
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Atendente</p>
                        <input type="text" value="Kayky" disabled>
                    </div><!--inp-single-->
                </div><!--pdv-painel-infos-->
                <div class="pdv-painel-header">
                    <div class="inp-box flexbox">
                        <div class="inp-single w50">
                            <p>Comanda</p>
                            <input type="number">
                        </div><!--inp-single-->
                        <div class="inp-single w50">
                            <p>Mesa</p>
                            <input type="number">
                        </div><!--inp-single-->
                    </div><!--inp-box-->
                    <div class="btn-box flexbox flexbox">
                        <div class="btn-single w50">
                            <a href="#"><button class="btn-imprimir">Imprimir</button></a>
                        </div><!--btn-single-->
                        <div class="btn-single w50">
                            <button class="btn-retirar-dinheiro" onclick="retirarDinheiro()">Retirar Dinheiro</button>
                        </div><!--btn-single-->
                    </div><!--btn-box-->
                </div><!--pdv-painel-header-->

                <div class="pdv-painel-comanda">
                    <div class="partial-payment flexbox">
                        <div class="partial-payment-title w100">
                            <h3>Comanda <b>3</b></h3>
                        </div><!--partial-payment-title-->
                        <div class="inp-single w50">
                            <p>Pagamento parcial</p>
                            <input type="number" placeholder="R$">
                        </div><!--inp-single-->
                        <div class="inp-single w50">
                            <p>Forma de pagamento</p>
                            <select name="" id="">
                                <option disabled selected value="nulo">Selecione</option>
                                <option value="">Dinheiro</option>
                                <option value="">Pix</option>
                                <option value="">Cartão de Crédito</option>
                                <option value="">Cartão de Débito</option>
                            </select>
                        </div><!--inp-single-->
                        <div class="btn-single w100">
                            <a href="#"><button>Confirmar</button></a>
                        </div><!--btn-single-->
                    </div><!--partial-payment-->
                    <div class="pdv-painel-comanda-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item</th>
                                    <th>Qtd</th>
                                    <th>Valor Unitário</th>
                                    <th>Desconto</th>
                                    <th>Total</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Batidinha</td>
                                    <td>2</td>
                                    <td>R$15,99</td>
                                    <td>R$0,00</td>
                                    <td>R$31,98</td>
                                    <td><i class="fa-solid fa-pencil" onclick="editarProduto()"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!--pdv-painel-comanda-table-->
                    <div class="partial-comanda-title">
                        <h3>Pagamento parcial: R$ 31,98</h3>
                    </div><!--partial-title-->
                    <div class="total-comanda-title">
                        <h2>Total: <b>R$ 31,98</b></h2>
                    </div><!--total-title-->
                </div><!--pdv-painel-comanda-->

                <div class="pdv-painel-mesa">
                    <div class="pdv-painel-mesa-title">
                        <h2>Mesa: <b>1</b></h2>
                    </div><!--pdv-painel-mesa-title-->
                    <div class="pdv-painel-mesa-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Comanda</th>
                                    <th>Valor total</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>R$10,00</td>
                                    <td><i class="fa-solid fa-pencil" onclick="editarComanda()"></i></th>
                                </tr>
                            </tbody>
                        </table>
                    </div><!--pdv-painel-mesa-table-->
                    <div class="total-mesa-title">
                        <h2>Total: <b>R$ 10,00</b></h2>
                    </div><!--total-mesa-title-->
                </div><!--pdv-painel-mesa-->
            </div><!--pdv-painel-content-->
            <div class="pdv-painel-btn-box flexbox">
                <div class="btn-single w33">
                    <button class="btn-fechar-caixa" onclick="fecharCaixa()">Fechar Caixa</button>
                </div><!--btn-single-->
                <div class="btn-single w33">
                    <button class="btn-novo-pedido">Novo Pedido</button>
                </div><!--btn-single-->
                <div class="btn-single w33">
                    <button class="btn-finalizar-caixa" onclick="finalizarCaixa()">Finalizar</button>
                </div><!--btn-single-->
            </div><!--pdv-painel-btn-box-->
        </div><!--pdv-painel-->
        <div class="pdv-container w100">
            <div class="products-box flexbox w100">
                <div class="product-single w33" onclick="adicionarProduto()">
                    <div class="product-single-img">
                        <img src="<?= INCLUDE_HOMOLOGACAO ?>images/heineken.jpg" alt="">
                    </div><!--product-single-img-->
                    <div class="product-single-content">
                        <div class="product-single-title">
                            <h2>Heineken 330ml</h2>
                        </div><!--product-single-title-->
                        <div class="product-single-price">
                            <h3>R$ 7,00</h3>
                        </div><!--product-single-price-->
                    </div><!--product-single-content-->
                </div><!--product-single-->
                <div class="product-single w33" onclick="adicionarProduto()">
                    <div class="product-single-img">
                        <img src="<?= INCLUDE_HOMOLOGACAO ?>images/heineken.jpg" alt="">
                    </div><!--product-single-img-->
                    <div class="product-single-content">
                        <div class="product-single-title">
                            <h2>Heineken 330ml</h2>
                        </div><!--product-single-title-->
                        <div class="product-single-price">
                            <h3>R$ 7,00</h3>
                        </div><!--product-single-price-->
                    </div><!--product-single-content-->
                </div><!--product-single-->
                <div class="product-single w33" onclick="adicionarProduto()">
                    <div class="product-single-img">
                        <img src="<?= INCLUDE_HOMOLOGACAO ?>images/heineken.jpg" alt="">
                    </div><!--product-single-img-->
                    <div class="product-single-content">
                        <div class="product-single-title">
                            <h2>Heineken 330ml</h2>
                        </div><!--product-single-title-->
                        <div class="product-single-price">
                            <h3>R$ 7,00</h3>
                        </div><!--product-single-price-->
                    </div><!--product-single-content-->
                </div><!--product-single-->
                <div class="product-single w33" onclick="adicionarProduto()">
                    <div class="product-single-img">
                        <img src="<?= INCLUDE_HOMOLOGACAO ?>images/heineken.jpg" alt="">
                    </div><!--product-single-img-->
                    <div class="product-single-content">
                        <div class="product-single-title">
                            <h2>Heineken 330ml</h2>
                        </div><!--product-single-title-->
                        <div class="product-single-price">
                            <h3>R$ 7,00</h3>
                        </div><!--product-single-price-->
                    </div><!--product-single-content-->
                </div><!--product-single-->
                <div class="product-single w33" onclick="adicionarProduto()">
                    <div class="product-single-img">
                        <img src="<?= INCLUDE_HOMOLOGACAO ?>images/heineken.jpg" alt="">
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
                <div class="product-single w33" onclick="adicionarProduto()">
                    <div class="product-single-img">
                        <img src="<?= INCLUDE_HOMOLOGACAO ?>images/heineken.jpg" alt="">
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
            </div><!--products-box-->
            <div class="categories-box flexbox w100">
                <div class="categorie-single w25">
                    <h2>Pizzas</h2>
                </div><!--categorie-single-->
                <div class="categorie-single w25">
                    <h2>Sucos</h2>
                </div><!--categorie-single-->
                <div class="categorie-single w25">
                    <h2>Salgados</h2>
                </div><!--categorie-single-->
                <div class="categorie-single w25">
                    <h2>Cervejas</h2>
                </div><!--categorie-single-->
                <div class="categorie-single w25">
                    <h2>Sorvetes</h2>
                </div><!--categorie-single-->
            </div><!--categories-box-->
        </div><!--container-->
    </div><!--flexbox-->
</section>