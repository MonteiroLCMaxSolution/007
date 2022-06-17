<div class="pdv-modal modal-fechar-caixa">
    <div class="pdv-modal-overlay">
        <div class="pdv-modal-box">
            <div class="pdv-modal-title">
                <h2>Caixa 2</h2>
                <h3>Informe os Totais para Fechar o Caixa</h3>
            </div><!--pdv-modal-title-->
            <div class="pdv-modal-form">
                <form action="" class="flexbox">
                    <div class="inp-single w50">
                        <p>Total em Dinheiro</p>
                        <input type="text" placeholder="R$">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Total em Cartão de Crédito</p>
                        <input type="text" placeholder="R$">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Total em Cartão de Débito</p>
                        <input type="text" placeholder="R$">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Total em PIX</p>
                        <input type="text" placeholder="R$">
                    </div><!--inp-single-->
                </form>
            </div><!--pdv-modal-form-->
            <div class="btn-box flexbox">
                <div class="btn-single btn-cancel w33">
                    <a href="#" onclick="cancelFecharCaixa()">Cancelar</a>
                </div><!--btn-single-->
                <div class="btn-single btn-report w33">
                    <a href="">Relatório</a>
                </div><!--btn-single-->
                <div class="btn-single btn-confirm w33">
                    <a href="">Fechar caixa</a>
                </div><!--btn-single-->
            </div><!--btn-box-->
        </div><!--pdv-modal-box-->
    </div><!--pdv-modal-overlay-->
</div><!--pdv-modal-->

<div class="pdv-modal modal-finalizar-pedido">
    <div class="pdv-modal-overlay">
        <div class="pdv-modal-box">
            <div class="pdv-modal-title">
                <h2>Caixa 2</h2>
                <h1>Valor total: <b>R$ 100,00</b></h1>
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

<div class="pdv-modal modal-retirar-dinheiro">
    <div class="pdv-modal-overlay">
        <div class="pdv-modal-box">
            <div class="pdv-modal-title">
                <h2>Informe o Valor, Motivo e o Caixa de Destino</h2>
                <h3>(em caso de transferência)</h3>
            </div><!--pdv-modal-title-->
            <div class="pdv-modal-form">
                <form action="" class="flexbox">
                    <div class="inp-single w50">
                        <p>Valor</p>
                        <input type="text" placeholder="R$">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Motivo</p>
                        <input type="text" placeholder="Informe o motivo da transferência">
                    </div><!--inp-single-->
                    <div class="inp-single w100">
                        <p>Destino</p>
                        <select name="" id="">
                            <option value="">Não é uma transferência</option>
                            <option value="">Transferir para o caixa 1</option>
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
                    <a href="">Salvar</a>
                </div><!--btn-single-->
            </div><!--btn-box-->
        </div><!--pdv-modal-box-->
    </div><!--pdv-modal-overlay-->
</div><!--pdv-modal-->

<div class="pdv-modal modal-editar-produto">
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

