<div class="modal-confirm-order">
    <div class="modal-overlay">

        <div class="modal-box-locais">
            <div class="modal-title">
                <h2>Locais do mapa</h2>
            </div>
            <div class="modal-box-table">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cód</th>
                            <th>Descrição</th>
                            <th>Andar</th>
                            <th>Setor</th>
                            <th>Lado</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>Direito</td>
                            <td>Mapa teste</td>
                            <td><input type="checkbox"></td>
                        </tr>
                    </tbody>
                </table>
            </div><!--modal-box-table-->
            <div class="btn-box flexbox w100">
                <a href="#" class="add-btn" onclick="abrirFormLocaisMapa()">Adicionar</a>
                <a href="#" class="close-btn" onclick="fecharNovoLocal()">Fechar</a>
            </div><!--btn-box-->
        </div><!--modal-box-locais-->

        <div class="modal-box-add-locais">
            <div class="modal-title">
                <h2>Adicionar Locais do mapa</h2>
            </div>
            <div class="modal-form">
                <form action="" class="flexbox w100">
                    <div class="inp-single w50">
                        <p class="p-descricao-modal">Descrição</p>
                        <input type="text" id="descricao-mesa-modal" onkeyup="validarFormModal()">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p class="p-andar-modal">Andar</p>
                        <input type="text" id="andar-mesa-modal" onkeyup="validarFormModal()">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p class="p-setor-modal">Setor</p>
                        <input type="text" id="setor-mesa-modal" onkeyup="validarFormModal()">
                    </div><!--inp-single-->
                    <div class="inp-single w50">
                        <p class="p-lado-modal">Lado</p>
                        <input type="text" id="lado-mesa-modal" onkeyup="validarFormModal()">
                    </div><!--inp-single-->
                    <div class="btn-box w100">
                        <a href="#" class="cancel-btn" onclick="fecharFormLocaisMapa()">Cancelar</a>
                        <button type="submit" id="enviar-form-modal">Confirmar</button>
                    </div><!--btn-box-->
                </form>
            </div><!--modal-form-->
        </div><!--modal-box-add-locais-->

    </div><!--modal-overlay-->
</div><!--modal-confirm-order-->

<section class="register-form">
    <div class="center">
        <div class="section-title">
            <h2>Cadastrar Mesa</h2>
        </div><!--section-title-->
        <form action=""  class="flexbox">
            <div class="inp-single w40">
                <p>ID</p>
                <input type="text" name="" id="" disabled>
            </div><!--inp-single-->
            <div class="inp-single w40">
                <p class="p-local">Local do mapa</p>
                <select name="" id="local-mesa" onchange="validarFormulario()">
                    <option disabled selected value="nulo">Selecione</option>
                    <option value="">Mesanino</option>
                    <option value="">Deck</option>
                </select>
            </div><!--inp-single-->
            <div class="btn-single w20">
                <button type="button" title="Novo local do mapa" onclick="abrirNovoLocal()">+</button>
            </div><!--btn-single-->
            <div class="inp-single w40">
                <p class="p-status">Status</p>
                <select name="" id="status-mesa" onchange="validarFormulario()">
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
