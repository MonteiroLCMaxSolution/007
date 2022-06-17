<section class="register-form">
    <div class="center">
        <div class="section-title">
            <h2>Cadastrar SubCategoria</h2>
        </div><!--section-title-->
        <form action=""  class="flexbox">
            <div class="inp-single w50">
                <p>ID</p>
                <input type="text" name="" id="" disabled title="Será preenchido automaticamente">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-categoria">Categoria</p>
                <select name="" id="categoria-subcategorias" onchange="validarFormulario()">
                    <option selected disabled value="nulo">Selecione a categoria</option>
                    <option value="salgado">Salgado</option>
                    <option value="suco">Suco</option>
                </select>
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-nome">Nome</p>
                <input type="text" name="" id="nome-subcategorias" placeholder="Nome da Subcategoria" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-status">Status</p>
                <select name="" id="status-subcategorias">
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                </select>
            </div><!--inp-single-->
            <div class="buttons-box">
                <a href="<?= INCLUDE_PATH ?>?pg=listar-subcategorias">Cancelar</a>
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
