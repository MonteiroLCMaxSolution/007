<section class="register-form">
    <div class="center">
        <div class="section-title">
            <h2>Cadastrar Empresa</h2>
        </div><!--section-title-->
        <form action=""  class="flexbox">
            <div class="inp-single w20">
                <p>ID</p>
                <input type="text" name="" id="" disabled title="Será preenchido automaticamente">
            </div><!--inp-single-->
            <div class="inp-single w40">
                <p class="p-cnpj">CNPJ</p>
                <input type="text" name="" id="cnpj-empresa" onkeyup="validarFormulario()" placeholder="00.000.000/0000-00">
            </div><!--inp-single-->
            <div class="inp-single w40">
                <p class="p-nome">Nome / Razão social</p>
                <input type="text" name="" id="nome-empresa" onkeyup="validarFormulario()" placeholder="Empresa-x">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-fantasia">Nome Fantasia</p>
                <input type="text" name="" id="fantasia-empresa" onkeyup="validarFormulario()" placeholder="EX">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-municipal">Inscrição Municipal</p>
                <input type="text" name="" id="municipal-empresa" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-estadual">Inscrição Estadual</p>
                <input type="text" name="" id="estadual-empresa" onkeyup="validarFormulario()">
            </div><!--inp-single-->

            <div class="form-title w100">
                <h2>Endereço</h2>
            </div><!--form-title-->

            <div class="inp-single w30">
                <p class="p-cep">CEP</p>
                <input type="text" name="" id="cep-empresa" onkeyup="validarFormulario()" placeholder="00000-000">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-endereco">Endereço</p>
                <input type="text" name="" id="endereco-empresa" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w20">
                <p class="p-numero">Número</p>
                <input type="number" name="" id="numero-empresa" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w100">
                <p class="p-complemento">Complemento</p>
                <input type="text" name="" id="complemento-empresa" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w40">
                <p class="p-bairro">Bairro</p>
                <input type="text" name="" id="bairro-empresa" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w40">
                <p class="p-cidade">Cidade</p>
                <input type="text" name="" id="cidade-empresa" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w20">
                <p class="p-uf">UF</p>
                <input type="text" name="" id="uf-empresa" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="form-title w100">
                <h2 class="p-contato">Contato</h2>
            </div><!--form-title-->
            <div class="inp-single w50">
                <p class="p-telefone">Telefone</p>
                <input type="text" name="" id="telefone-empresa" onkeyup="validarFormulario()" placeholder="(00) 0000-0000">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-email">Email</p>
                <input type="text" name="" id="email-empresa" onkeyup="validarFormulario()" placeholder="email@email.com">
            </div><!--inp-single-->
            <div class="inp-single w100">
                <p class="p-site">Site</p>
                <input type="url" name="" id="site-empresa" placeholder="https://www.empresa.com" onkeyup="validarFormulario()">
            </div><!--inp-single-->

            <div class="form-title w100">
                <h2>Personalizar</h2>
            </div><!--form-title-->

            <div class="inp-single w50">
                <p>Cor Primária do Sistema</p>
                <div class="color-picker cor-primaria"></div>
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p>Cor Secundária do Sistema</p>
                <div class="color-picker cor-secundaria"></div>
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p>Cor do texto</p>
                <div class="color-picker cor-texto"></div>
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-logo">Logo</p>
                <input type="file" name="" id="logo-empresa" accept=".jpg,.jpeg,.png">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-status">Status</p>
                <select name="" id="status-empresa" onchange="validarFormulario()">
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                </select>
            </div><!--inp-single-->
            <div class="buttons-box">
                <a href="<?= INCLUDE_PATH ?>?pg=listar-empresas">Cancelar</a>
                <button type="submit" id="btn-enviar-form">Confirmar</button>
            </div><!--buttons-box-->
            <div class="clear"></div>
        </form>
        <div class="register-infos flexbox">
            <div class="register-info-single w25">
                <p>Data cadastro</p>
                <input type="text" disabled >
            </div><!--register-info-single-->
            <div class="register-info-single w25">
                <p>Usuário cadastro</p>
                <input type="text" disabled>
            </div><!--register-info-single-->
            <div class="register-info-single w25">
                <p>Última atualização</p>
                <input type="text" disabled>
            </div><!--register-info-single-->
            <div class="register-info-single w25">
                <p>Usuário última atualização</p>
                <input type="text" disabled>
            </div><!--register-info-single-->
        </div><!--register-infos-->
    </div><!--center-->
</section><!--register-form-->