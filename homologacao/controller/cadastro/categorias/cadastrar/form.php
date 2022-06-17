<section class="register-form">
    <div class="center">
        <div class="section-title">
            <h2>Cadastrar Categoria</h2>
        </div><!--section-title-->
        <form action=""  class="flexbox">
            <div class="inp-single w20">
                <p>ID</p>
                <input type="text" name="" id="" disabled>
            </div><!--inp-single-->
            <div class="inp-single w40">
                <p class="p-nome">Nome</p>
                <input type="text" name="" id="nome-categoria" placeholder="Nome da Categoria" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w40">
                <p class="p-status">Status</p>
                <select name="" id="status-categoria" onchange="validarFormulario()">
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                </select>
            </div><!--inp-single-->
            <div class="buttons-box">
                <a href="<?= INCLUDE_PATH ?>?pg=listar-categorias">Cancelar</a>
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
