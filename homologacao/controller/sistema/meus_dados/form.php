<section class="register-form">
    <div class="center">
        <div class="section-title">
            <h1>Meus dados</h1>
        </div><!--section-title-->
        <form action="" class="flexbox">

            <div class="form-title w100">
                <h2>Informações principais</h2>
            </div><!--form-title-->

            <div class="inp-single w20">
                <p>Id</p>
                <input type="text">
            </div><!--inp-single-->
            <div class="inp-single w40">
                <p class="p-cpf">CPF</p>
                <input type="text" id="cpf-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w40">
                <p class="p-nome">Nome</p>
                <input type="text" id="nome-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-apelido">Apelido</p>
                <input type="text" id="apelido-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-perfil">Perfil</p>
                <select name="" id="select-perfil-meus-dados" onchange="validarFormulario()">
                    <option selected disabled value="nulo">Selecione</option>
                    <option value="">Gerente</option>
                    <option value="">Garçom</option>
                    <option value="">Atendente</option>
                </select>
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-email">Email</p>
                <input type="email" id="email-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-telefone">Telefone</p>
                <input type="text" name="" id="telefone-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-senha">Senha</p>
                <input type="text" id="senha-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-status">Status</p>
                <select name="" id="select-status-meus-dados" onchange="validarFormulario()">
                    <option value="">Ativo</option>
                    <option value="">Inativo</option>
                </select>
            </div><!--inp-single-->
            <div class="inp-single w100">
                <p class="p-imagem">Imagem</p>
                <input type="file" id="imagem-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->

            <div class="form-title w100">
                <h2>Endereço</h2>
            </div><!--form-title-->

            <div class="inp-single w20">
                <p class="p-cep">CEP</p>
                <input type="text" name="" id="cep-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w30">
                <p class="p-endereco">Endereço</p>
                <input type="text" name="" id="endereco-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w20">
                <p class="p-numero">Número</p>
                <input type="text" name="" id="numero-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w30">
                <p class="p-complemento">Complemento</p>
                <input type="text" name="" id="complemento-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w40">
                <p class="p-bairro">Bairro</p>
                <input type="text" name="" id="bairro-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w40">
                <p class="p-cidade">Cidade</p>
                <input type="text" name="" id="cidade-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w20">
                <p class="p-uf">UF</p>
                <input type="text" name="" id="uf-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->

            <div class="form-title w100">
                <h2>Informações adicionais</h2>
            </div><!--form-title-->

            <div class="inp-single w33">
                <p class="p-salario">Salário</p>
                <input type="text" id="salario-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-comissao">Comissão</p>
                <input type="text" id="comissao-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-status-comissao">Status da Comissão</p>
                <select name="" id="select-status-comissao" onchange="validarFormulario()">
                    <option value="">Ativo</option>
                    <option value="">Inativo</option>
                </select>
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-dia-pagamento">Dia de pagamento</p>
                <input type="text" id="dia-pagamento-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-data-contratacao">Data - Contratação</p>
                <input type="text" placeholder="Selecionar Data" id="data-contratacao-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-data-demissao">Data - Demissão</p>
                <input type="text" placeholder="Selecionar Data" id="data-demissao-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->

            <div class="form-title w100">
                <h2>Delivery</h2>
            </div><!--form-title-->

            <div class="inp-single w33">
                <p class="p-cnh">CNH</p>
                <input type="text" id="cnh-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-validade-cnh">Validade CNH</p>
                <input type="text" id="validade-cnh-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-placa-veiculo">Placa do veículo</p>
                <input type="text" id="placa-veiculo-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-proprietario-veiculo">Proprietário do veículo</p>
                <input type="text" id="proprietario-veiculo-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-valor-km">Valor KM Rodado</p>
                <input type="text" id="valor-km-meus-dados" onkeyup="validarFormulario()">
            </div><!--inp-single-->

            <div class="btn-box w100">
                <a href="<?= INCLUDE_PATH?>" type="button" class="cancel-btn">Cancelar</a>
                <button type="submit" class="" id="btn-enviar-form">Confirmar</button>
            </div><!--btn-box-->
        </form>

        <div class="register-infos flexbox">
            <div class="register-info-single w20">
                <p>Data cadastro</p>
                <input type="text" disabled >
            </div><!--register-info-single-->
            <div class="register-info-single w20">
                <p>Usuário cadastro</p>
                <input type="text" disabled>
            </div><!--register-info-single-->
            <div class="register-info-single w20">
                <p>Última atualização</p>
                <input type="text" disabled>
            </div><!--register-info-single-->
            <div class="register-info-single w20">
                <p>Usuário última atualização</p>
                <input type="text" disabled>
            </div><!--register-info-single-->
            <div class="register-info-single w20">
                <p>Número acessos</p>
                <input type="text" disabled>
            </div><!--register-info-single-->
        </div><!--register-infos-->
    </div><!--center-->
</section><!--register-form-->