<div class="confirm-modal">
    <div class="confirm-modal-content">
        <div class="confirm-modal-form">
            <div class="confirm-modal-back">
                <a href="#" onclick="closeConfirmModalForm()"><i class="fa-solid fa-arrow-left"></i> Voltar ao cardápio</a>
            </div><!--confirm-modal-back-->
            <div class="confirm-modal-title">
                <h2>Por favor informe os dados abaixo para prosseguir</h2>
            </div><!--confirm-modal-title-->
            <form class="flexbox" action="">
                <div class="inp-single w50">
                    <p>Nome</p>
                    <input type="text">
                </div><!--inp-single-->
                <div class="inp-single w50">
                    <p>Celular - Whatsapp</p>
                    <input type="text">
                </div><!--inp-single-->

                <div class="payment-container w100">
                    <div class="payment-title">
                        <h2>Formas de pagamento:</h2>
                    </div><!--payment-title-->
                    <div class="payment-total">
                        <h3>Valor total: <b>R$ 35,00</b></h2>
                    </div><!--payment-total-->
                    <div class="payment-box">
                        <label onclick="openMoneyInput(1)">
                            <input type="radio" name="payment" id="">
                            Dinheiro
                        </label>
                        <label onclick="openMoneyInput(0)">
                            <input type="radio" name="payment" id="">
                            PIX
                        </label>
                    </div><!--payment-box-->
                    <div class="inp-money w50">
                        <p>Troco para</p>
                        <input type="number" placeholder="R$">
                    </div><!--inp-money-->
                </div><!--payment-container-->
            </form>
            <div class="btn-single">
                <a href="#" onclick="openConfirmModalFinish()">Continuar Pedido</a>
            </div><!--btn-single-->
        </div><!--confirm-modal-form-->
        <div class="confirm-modal-finish">
            <div class="confirm-modal-back">
                <a href="#" onclick="closeConfirmModalFinish()"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
            </div><!--confirm-modal-back-->
            <div class="confirm-modal-title">
                <h2>Deseja finalizar o pedido ?</h2>
            </div><!--confirm-modal-title-->
            <div class="confirm-modal-infos">

                <div class="confirm-modal-infos-box">
                    <div class="confirm-modal-infos-title">
                        <h2>Dados pessoais</h2>
                    </div><!--conform-modal-infos-title-->
                    <div class="confirm-modal-info-single">
                        <h3>Nome: <b>Kayky</b></h3>
                    </div><!--confirm-modal-info-single-->
                    <div class="confirm-modal-info-single">
                        <h3>Celular: <b>(11) 96054-3456</b></h3>
                    </div><!--confirm-modal-info-single-->
                </div><!--confirm-modal-infos-box-->

                <div class="confirm-modal-infos-box">
                    <div class="confirm-modal-infos-title">
                        <h2>Endereço de entrega</h2>
                    </div><!--conform-modal-infos-title-->
                    <div class="confirm-modal-info-single">
                        <h3>CEP: <b>00000-000</b></h3>
                    </div><!--confirm-modal-info-single-->
                    <div class="confirm-modal-info-single">
                        <h3>Endereço: <b>Rua lorem ipum dolor</b></h3>
                    </div><!--confirm-modal-info-single-->
                    <div class="confirm-modal-info-single">
                        <h3>Número: <b>34</b></h3>
                    </div><!--confirm-modal-info-single-->
                    <div class="confirm-modal-info-single">
                        <h3>Bairro: <b>Assunção</b></h3>
                    </div><!--confirm-modal-info-single-->
                    <div class="confirm-modal-info-single">
                        <h3>Cidade: <b>São Bernardo do Campo</b></h3>
                    </div><!--confirm-modal-info-single-->
                    <div class="confirm-modal-info-single">
                        <h3>UF: <b>SP</b></h3>
                    </div><!--confirm-modal-info-single-->
                    <div class="confirm-modal-info-single">
                        <h3>Ponto de referência: <b>Hospital assunção</b></h3>
                    </div><!--confirm-modal-info-single-->
                    <div class="confirm-modal-info-single">
                        <h3>Complemento: <b></b></h3>
                    </div><!--confirm-modal-info-single-->
                </div><!--confirm-modal-infos-box-->

                <div class="confirm-modal-infos-box">
                    <div class="confirm-modal-infos-title">
                        <h2>Nosso endereço</h2>
                    </div><!--conform-modal-infos-title-->
                    <div class="confirm-modal-info-single">
                        <h3>CEP: <b>77700-000</b></h3>
                    </div><!--confirm-modal-info-single-->
                    <div class="confirm-modal-info-single">
                        <h3>Endereço: <b>rua qualquer coisa</b></h3>
                    </div><!--confirm-modal-info-single-->
                    <div class="confirm-modal-info-single">
                        <h3>Número: <b>890</b></h3>
                    </div><!--confirm-modal-info-single-->
                    <div class="confirm-modal-info-single">
                        <h3>Bairro: <b>Bandeirantes</b></h3>
                    </div><!--confirm-modal-info-single-->
                    <div class="confirm-modal-info-single">
                        <h3>Cidade: <b>São Bernardo do Campo</b></h3>
                    </div><!--confirm-modal-info-single-->
                    <div class="confirm-modal-info-single">
                        <h3>UF: <b>SP</b></h3>
                    </div><!--confirm-modal-info-single-->
                    <div class="confirm-modal-info-single">
                        <h3>Ponto de referência: <b></b></h3>
                    </div><!--confirm-modal-info-single-->
                    <div class="confirm-modal-info-single">
                        <h3>Complemento: <b></b></h3>
                    </div><!--confirm-modal-info-single-->
                </div><!--confirm-modal-infos-box-->

                <div class="confirm-modal-infos-box">
                    <div class="confirm-modal-infos-title">
                        <h2>
                            Forma de pagamento
                        </h2>
                    </div><!--conform-modal-infos-title-->
                    <div class="confirm-modal-info-single">
                        <h3>Valor total: <b>R$ 35,00</b></h3>
                    </div><!--confirm-modal-info-single-->
                    <div class="confirm-modal-info-single">
                        <h3><b>Dinheiro</b></h3>
                    </div><!--confirm-modal-info-single-->
                    <div class="confirm-modal-info-single">
                        <h3>Troco para: <b>R$ 50,00</b></h3>
                    </div><!--confirm-modal-info-single-->
                </div><!--confirm-modal-infos-box-->

            </div><!--confirm-modal-infos-->
            <div class="btn-box flexbox">
                <a href="#" id="cancel-order" onclick="cancelConfirmModal()">Cancelar pedido</a>
                <a href="#" id="finish-order" onclick="openFinishedModal()">Finalizar pedido</a>
            </div><!--btn-box-->
        </div><!--confirm-modal-finish-->
    </div><!--confirm-modal-content-->
</div><!--confirm-modal-->