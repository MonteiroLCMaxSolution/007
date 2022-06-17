<div class="details-modal">
    <div class="details-modal-overlay">
        <div class="details-modal-box">
            <div class="details-modal-title">
                <h2>Detalhes do Pedido <b>10</b></h2>
                <h3>04/04/2022 08:38:09 - Mesa <b>2</b></h3>
            </div><!--pdv-modal-title-->
            <div class="details-modal-table">
                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Sabor</th>
                            <th>Complemento</th>
                            <th>Valor Unitário</th>
                            <th>Quantidade</th>
                            <th>Desconto</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Pizza brotinho</td>
                            <td>Moda da casa</td>
                            <td>Bacon - R$ 2,00</td>
                            <td>R$ 25,00</td>
                            <td>1</td>
                            <td>R$ 0,00</td>
                            <td>R$ 27,00</td>
                        </tr>
                        <tr>
                            <td>Pizza brotinho</td>
                            <td>Moda da casa</td>
                            <td>Bacon - R$ 2,00</td>
                            <td>R$ 25,00</td>
                            <td>1</td>
                            <td>R$ 0,00</td>
                            <td>R$ 27,00</td>
                        </tr>
                        <tr>
                            <td>Pizza brotinho</td>
                            <td>Moda da casa</td>
                            <td>Bacon - R$ 2,00</td>
                            <td>R$ 25,00</td>
                            <td>1</td>
                            <td>R$ 0,00</td>
                            <td>R$ 27,00</td>
                        </tr>
                    </tbody>
                </table>
                <div class="details-modal-table-infos">
                    <div class="total-pedido">
                        <h2>Total do Pedido: <b>R$ 27,00</b></h2>
                    </div><!--total-pedido-->
                    <div class="desconto-caixa">
                        <h2>Desconto Aplicado no Caixa: <b>R$ 0,00</b></h2>
                    </div><!--desconto-caixa-->
                    <div class="total-pagamento">
                        <h2>Total do pagamento: <b>R$ 27,00</b></h2>
                    </div><!--total-pagamento-->
                </div><!--details-modal-table-infos-->
            </div><!--details-modal-table-->
            <div class="btn-single w100">
                <a href="#" id="close-modal" onclick="closeModal()">Fechar</a>
            </div><!--btn-single-->
        </div><!--details-modal-box-->
    </div><!--details-modal-overlay-->
</div><!--details-modal-->

<section class="details">
    <div class="center">
        <div class="section-title">
            <h2>Relatório do caixa 1</h2>
        </div><!--section--title-->

        <div class="details-infos">
            <ul>
                <li>Status: <b>Aberto</b></li>
                <li>Caixa Inicial: <b>R$ 0,00</b></li>
                <li>Usuário: <b>Kayky Costa</b></li>
                <li>Abertura: <b>05/04/2022 21:48:05</b></li>
                <li>Fechamento: <b>05/04/2022 21:48:25</b></li>
            </ul>
        </div><!--details-infos-->

        <div class="details-box">
            <div class="detail-single">
                <div class="detail-single-title payment-title flexbox" id="btn-pagamento-pedidos">
                    <i class="fas fa-hand-holding-usd"></i>
                    <h2>Pagamento de pedidos</h2>
                </div><!--detail-single-title-->
                <div class="detail-single-table" id="table-pagamento-pedidos">
                    <table>
                        <thead>
                            <tr>
                                <th>Nº Pedido</th>
                                <th>Data / Hora</th>
                                <th>Tipo</th>
                                <th>Crédito</th>
                                <th>Débito</th>
                                <th>Pix</th>
                                <th>Dinheiro</th>
                                <th class="total">Total</th>
                                <th>Detalhes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>78</td>
                                <td>30/03/2022 10:20:38</td>
                                <td>PDV</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>R$ 130,00</td>
                                <td class="total">R$ 130,00</td>
                                <td><i class="fas fa-info-circle" id="open-modal" onclick="openModal()"></i></td>
                            </tr>
                            <tr>
                                <td>Totais</td>
                                <td>-</td>
                                <td>-</td>
                                <td class="total-option">-</td>
                                <td class="total-option">-</td>
                                <td class="total-option">-</td>
                                <td class="total-option">R$ 130,00</td>
                                <td class="total-master">R$ 130,00</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div><!--detail-single-table-->
            </div><!--detail-single-->
            <div class="detail-single">
                <div class="detail-single-title total-title flexbox" id="btn-totais-pedidos">
                    <i class="fas fa-dollar-sign"></i>
                    <h2>Totais</h2>
                </div><!--detail-single-title-->
                <div class="detail-single-box flexbox" id="box-totais-pedidos">
                    <div class="detail-single-box-single w50">
                        <div class="detail-single-box-single-title">
                            <h2>Totais informados</h2>
                            <h3>Saldo final</h3>
                        </div><!--detail-single-box-single-title-->
                        <div class="detail-single-box-single-content">
                            <ul>
                                <li>Dinheiro: <b>R$ 0,00</b></li>
                                <li>Pix: <b>R$ 0,00</b></li>
                                <li>Débito: <b>R$ 0,00</b></li>
                                <li>Crédito: <b>R$ 0,00</b></li>
                            </ul>
                        </div><!--detail-single-box-single-content-->
                    </div><!--detail-single-box-single-->
                    <div class="detail-single-box-single w50">
                        <div class="detail-single-box-single-title">
                            <h2>Totais do Sistema</h2>
                            <h3>Saldo final</h3>
                        </div><!--detail-single-box-single-title-->
                        <div class="detail-single-box-single-content">
                            <ul>
                                <li>Dinheiro: <b>R$ 0,00</b></li>
                                <li>Pix: <b>R$ 0,00</b></li>
                                <li>Débito: <b>R$ 0,00</b></li>
                                <li>Crédito: <b>R$ 0,00</b></li>
                            </ul>
                        </div><!--detail-single-box-single-content-->
                    </div><!--detail-single-box-single-->
                </div><!--detail-single-box-->
            </div><!--detail-single-->
        </div><!--details-box-->
    </div><!--center-->
</section><!--details-->