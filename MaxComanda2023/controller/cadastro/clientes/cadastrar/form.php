<section class="register-form">
    <div class="center">
        <div class="section-title">
            <h2>Cadastrar Cliente</h2>
        </div><!--section-title-->
        <form action=""  class="flexbox">
            <div class="inp-single w20">
                <p>ID</p>
                <input type="text" name="" id="" disabled title="Será preenchido automaticamente">
            </div><!--inp-single-->
            <div class="inp-single w40">
                <p class="p-cpf">CPF</p>
                <input type="text" name="" id="cpf-cliente" onkeyup="validarFormulario()" placeholder="000.000.000-00">
            </div><!--inp-single-->
            <div class="inp-single w40">
                <p class="p-nome">Nome / Razão social</p>
                <input type="text" name="" id="nome-cliente" onkeyup="validarFormulario()" placeholder="João">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-fantasia">Fantasia</p>
                <input type="text" name="" id="fantasia-cliente" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-apelido">Apelido</p>
                <input type="text" name="" id="apelido-cliente" onkeyup="validarFormulario()" placeholder="Jô">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-nascimento">Data de Nascimento</p>
                <input type="text" name="" id="nascimento-cliente" placeholder="Selecionar data">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-municipal">Inscrição Municipal</p>
                <input type="text" name="" id="municipal-cliente" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-estadual">Inscrição Estadual</p>
                <input type="text" name="" id="estadual-cliente" onkeyup="validarFormulario()">
            </div><!--inp-single-->

            <div class="form-title w100">
                <h2>Contato</h2>
            </div><!--form-title-->

            <div class="inp-single w50">
                <p class="p-email">Email</p>
                <input type="text" name="" id="email-cliente" onkeyup="validarFormulario()" placeholder="email@email.com">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-telefone">Telefone</p>
                <input type="text" name="" id="telefone-cliente" onkeyup="validarFormulario()" placeholder="(00) 0000-0000">
            </div><!--inp-single-->

            <div class="form-title w100">
                <h2>Dados para login</h2>
            </div><!--form-title-->

            <div class="inp-single w50">
                <p class="p-login">Login</p>
                <input type="text" name="" id="login-cliente" placeholder="Digite seu username" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-senha">Senha</p>
                <input type="password" name="" id="senha-cliente" placeholder="Digite sua senha" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-status">Status</p>
                <select name="" id="status-cliente" onchange="validarFormulario()">
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                </select>
            </div><!--inp-single-->
            <div class="buttons-box">
                <a href="<?= INCLUDE_PATH ?>?pg=listar-clientes">Cancelar</a>
                <button type="submit" id="btn-enviar-form">Confirmar</button>
            </div><!--buttons-box-->
            <div class="clear"></div>
        </form>
        <div class="register-infos flexbox">
            <div class="register-info-single w33">
                <p>Data cadastro</p>
                <input type="text" value="02/02/2022 13:36:56" disabled >
            </div><!--register-info-single-->
            <div class="register-info-single w33">
                <p>Última atualização</p>
                <input type="text" value="Kayky Costa" disabled>
            </div><!--register-info-single-->
            <div class="register-info-single w33">
                <p>Número acessos</p>
                <input type="text" value="4" disabled>
            </div><!--register-info-single-->
        </div><!--register-infos-->
    </div><!--center-->
</section><!--register-form-->