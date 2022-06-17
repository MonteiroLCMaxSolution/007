<section class="register-form">
    <div class="center">
        <div class="section-title">
            <h2>Cadastrar Promoção</h2>
        </div><!--section-title-->
        <form action=""  class="flexbox">
            <div class="inp-single w50">
                <p>ID</p>
                <input type="text" name="" id="" disabled title="Será preenchido automaticamente">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-produto">Produto</p>
                <select name="" id="produto-promocao" onchange="validarFormulario()">
                    <option selected disabled value="nulo">Selecione o produto</option>
                    <option value="salgado">Cerveja</option>
                    <option value="suco">Coxinha</option>
                </select>
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-data-inicio">Data - Início</p>
                <input type="text" name="" id="data-inicio-promocao" placeholder="Selecionar data" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-data-fim">Data - Fim</p>
                <input type="text" name="" id="data-fim-promocao" placeholder="Selecionar data" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-status">Status</p>
                <select name="" id="status-promocao" onchange="validarFormulario()">
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                </select>
            </div><!--inp-single-->
            <div class="buttons-box">
                <a href="<?= INCLUDE_PATH ?>?pg=listar-promocao">Cancelar</a>
                <button type="submit" id="btn-enviar-form">Confirmar</button>
            </div><!--buttons-box-->
            <div class="clear"></div>
        </form>
        <div class="register-infos flexbox">
            <div class="register-info-single w50">
                <p>Data cadastro</p>
                <input type="text" disabled >
            </div><!--register-info-single-->
            <div class="register-info-single w50">
                <p>Usuário cadastro</p>
                <input type="text" disabled>
            </div><!--register-info-single-->
        </div><!--register-infos-->
    </div><!--center-->
</section><!--register-form-->