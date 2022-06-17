<div class="welcome-modal">
    <div class="welcome-modal-content">
        <div class="welcome-modal-home">
            <div class="welcome-modal-title">
                <h1>Bem-vindo(a)</h1>
                <h3>Para acessar nosso cardápio, selecione o tipo de pedido que deseja</h3>
            </div><!--welcome-modal-title-->
            <div class="welcome-modal-home-box flexbox">
                <div class="welcome-modal-home-single w50" onclick="openWithdrawModal()">
                    <h2>Retirar na loja</h2>
                </div><!--wecome-modal-home-single-->
                <div class="welcome-modal-home-single w50" onclick="openDeliveryModal()">
                    <h2>Delivery</h2>
                </div><!--wecome-modal-home-single-->
            </div><!--welcome-modal-home-box-->
        </div><!--welcome-modal-home-->
        <div class="welcome-modal-withdraw">
            <div class="welcome-modal-back">
                <a href="#" onclick="closeWithdrawModal()"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
            </div><!--welcome-modal-back-->
            <div class="welcome-modal-title">
                <h2>Retirada</h2>
                <h4>Selecione uma loja abaixo para ter acesso ao nosso cardápio</h4>
            </div><!--welcome-modal-title-->
            <div class="welcome-modal-withdraw-form">
                <form action="">
                    <div class="inp-single">
                        <p>Empresa</p>
                        <select name="" id="">
                            <option disabled selected value="">Selecione</option>
                            <option value="">Loja1</option>
                        </select>
                        <div class="btn-single">
                            <a href="#" onclick="openMenu()">Ver cardápio</a>
                        </div><!--btn-single-->
                    </div><!--inp-single-->
                </form>
            </div><!--welcome-modal-withdraw-form-->
        </div><!--welcome-modal-withdraw-->
        <div class="welcome-modal-delivery">
        <div class="welcome-modal-back">
                <a href="#" onclick="closeDeliveryModal()"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
            </div><!--welcome-modal-back-->
            <div class="welcome-modal-title">
                <h2>Delivery</h2>
                <h4>Preencha os campos abaixo para ter acesso ao nosso cardápio</h4>
            </div><!--welcome-modal-title-->
            <div class="welcome-modal-delivery-form">
                <form action="" class="flexbox">
                    <div class="inp-single w50">
                        <p>CEP</p>
                        <input type="text">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Endereço</p>
                        <input type="text">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Número</p>
                        <input type="text">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Bairro</p>
                        <input type="text">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Cidade</p>
                        <input type="text">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>UF</p>
                        <input type="text">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Ponto de referência</p>
                        <input type="text">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p>Complemento</p>
                        <input type="text">
                    </div><!--inp-single-->
                    <div class="w100" id="formSelectCompany"></div><!--form-select-company-->
                    <div class="btn-box flexbox">
                        <a href="#">Ver lojas</a>
                        <a href="#" onclick="openMenu()">Ver cardápio</a>
                    </div><!--btn-box-->
                </form>
            </div><!--welcome-modal-delivery-form-->
        </div><!--welcome-modal-delivery-->
    </div><!--welcome-modal-content-->
</div><!--welcome-modal-->