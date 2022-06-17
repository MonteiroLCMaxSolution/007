<section class="register-form">
    <div class="center">
        <div class="section-title">
            <h1>Cadastrar Grupo / Perfil</h1>
        </div><!--section-title-->
        <form action="" class="flexbox">

            <div class="inp-single w50">
                <p>ID</p>
                <input disabled type="text">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p>ID Empresa</p>
                <input disabled type="text">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-nome-perfil">Nome do perfil</p>
                <input type="text" id="nome-perfil-grupo-perfil" onkeyup="validarFormulario()" placeholder="Garçom">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-status">Status</p>
                <select name="" id="select-status-grupo-perfil" onchange="validarFormulario()">
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                </select>
            </div><!--inp-single-->

            <div class="btn-box w100">
                <a href="<?= INCLUDE_PATH?>?pg=listar-grupos-perfil" type="button" class="cancel-btn">Cancelar</a>
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