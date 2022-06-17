<section class="register-form">
    <div class="center">
        <div class="section-title">
            <h1>Cadastrar Suprimentos</h1>
            <h2>Informações principais</h2>
        </div><!--section-title-->
        <form action="" class="flexbox">
            <div class="inp-single w30">
                <p>Id</p>
                <input type="text" disabled>
            </div><!--inp-single-->
            <div class="inp-single w70">
                <p class="p-nome">Nome</p>
                <input type="text" id="nome-suprimento" onkeyup="validarFormulario()" placeholder="Farinha">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-preco">Preço de custo</p>
                <input type="number" id="preco-suprimento" onkeyup="validarFormulario()" placeholder="R$">
            </div><!--inp-single-->
            <div class="w60 inp-single w33">
                <p>Quantidade disponível</p>
                <input type="number" disabled>
            </div><!--inp-single-->
            <div class="w60 inp-single w33">
                <p class="p-estoque-minimo">Estoque mínimo</p>
                <input type="number" id="estoque-minimo-suprimento" onkeyup="validarFormulario()" placeholder="15">
            </div><!--inp-single-->

            <div class="buttons-box">
                <a href="<?= INCLUDE_PATH ?>?pg=listar-suprimentos">Cancelar</a>
                <button class="" type="submit" id="btn-enviar-form">Confirmar</button>
            </div><!--buttons-box-->
        </form>
    </div><!--center-->
</section><!--register-form-->

<section class="stock-movements">
    <div class="center">
        <div class="section-title">
            <h2>Movimentações de Estoque</h2>
        </div><!--section-title-->

        <form action="" class="all-exit flexbox">
            <div class="inp-single w33">
                <p>Tipo de ajuste</p>
                <select name="" id="select-all-exit" onchange="mudarListagem()">
                    <option value="todos">Todos</option>
                    <option value="entrada">Entrada</option>
                    <option value="saida">Saída</option>
                </select>
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-data-inicio">Data - Início</p>
                <input type="text" name="" id="data-inicio-all-exit" placeholder="Selecionar Data"
                onkeyup="validarAllExit()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-data-fim">Data - Fim</p>
                <input type="text" name="" id="data-fim-all-exit" placeholder="Selecionar Data" onkeyup="validarAllExit()">
            </div><!--inp-single-->
            <div class="btn-box w100">
                <button type="button" class="search-btn float-l" id="pesquisar-all-exit">Pesquisar</button>
                <button type="button" class="float-r" id="btn-add-exit">Adicionar</button>
                <div class="clear"></div>
            </div><!--btn-single-->
        </form><!--all-exit-->

        <form action="" class="add-exit flexbox">
            <div class="inp-single w33">
                <p>Tipo de ajuste</p>
                <select name="" id="select-add-exit" onchange="mudarListagem2()">
                    <option value="saida">Saída</option>
                    <option value="entrada">Entrada</option>
                </select>
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-quantidade">Quantidade</p>
                <input type="number" name="" id="quantidade-add-exit" onkeyup="validarAddExit()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-descricao">Descrição</p>
                <input type="text" name="" id="descricao-add-exit" onkeyup="validarAddExit()">
            </div><!--inp-single-->
            <div class="btn-box w100">
                <button type="button" class="cancel-btn" id="btn-cancel-exit">Cancelar</button>
                <button type="submit" class="save-btn" id="btn-salvar-exit">Salvar</button>
            </div><!--btn-box-->
        </form><!--add-all-exit-->

        <form action="" class="entrance flexbox">
            <div class="inp-single w50">
                <p>Tipo de ajuste</p>
                <select name="" id="select-entrance" onchange="mudarListagem()">
                    <option value="todos">Todos</option>
                    <option selected value="entrada">Entrada</option>
                    <option value="saida">Saída</option>
                </select>
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-fornecedor">Fornecedor</p>
                <select name="" class="select-fornecedor" id="select-fornecedor-entrance" onchange="validarEntrance()">
                    <option disabled selected value="nulo">Selecione o fornecedor</option>
                    <option value="1">Fornecedor 1</option>
                    <option value="2">Fornecedor 2</option>
                    <option value="3">Fornecedor 3</option>
                </select>
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-data-inicio-entrance">Data - Início</p>
                <input type="text" name="" id="data-inicio-entrance" placeholder="Selecionar Data" onkeyup="validarEntrance()">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-data-fim-entrance">Data - Fim</p>
                <input type="text" name="" id="data-fim-entrance" placeholder="Selecionar Data" onkeyup="validarEntrance()">
            </div><!--inp-single-->
            <div class="btn-box w100">
                <button type="button" class="search-btn float-l" id="pesquisar-entrance">Pesquisar</button>
                <button type="button" class="float-r" id="btn-add-entrance">Adicionar</button>
                <div class="clear"></div>
            </div><!--btn-single-->
        </form><!--entrance-->

        <form action="" class="add-entrance flexbox">
            <div class="inp-single w50">
                <p>Tipo de ajuste</p>
                <select name="" id="select-add-entrance" onchange="mudarListagem2()">
                    <option selected value="entrada">Entrada</option>
                    <option value="saida">Saída</option>
                </select>
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-fornecedor-add-entrance">Fornecedor</p>
                <select name="" class="select-fornecedor" id="select-fornecedor-add-entrance" onchange="validarAddEntrance()">
                    <option selected disabled value="nulo">Selecione o fornecedor</option>
                    <option value="1">Fornecedor 1</option>
                    <option value="2">Fornecedor 2</option>
                    <option value="3">Fornecedor 3</option>
                </select>
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-quantidade-add-entrance">Quantidade</p>
                <input type="number" name="" id="quantidade-add-entrance" placeholder="" onkeyup="validarAddEntrance()">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-descricao-add-entrance">Descrição</p>
                <input type="text" name="" id="descricao-add-entrance" placeholder="" onkeyup="validarAddEntrance()">
            </div><!--inp-single-->
            <div class="btn-box w100">
                <button type="button" class="cancel-btn" id="btn-cancel-entrance">Cancelar</button>
                <button type="submit" class="save-btn" id="btn-salvar-entrance">Salvar</button>
            </div><!--btn-box-->
        </form><!--add-entrance-->

        <table id="table-all-exit-entrance">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cód.</th>
                    <th>Fornecedor</th>
                    <th>Quantidade</th>
                    <th>Data Registro</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>15</td>
                    <td>Fornecedor 1</td>
                    <td>8</td>
                    <td>17/03/2022</td>
                    <td>Entrada</td>
                </tr>
            </tbody>
        </table>

        <div class="register-infos flexbox">
            <div class="register-info-single w25">
                <p>Data cadastro</p>
                <input type="text" value="02/02/2022 13:36:56" disabled >
            </div><!--register-info-single-->
            <div class="register-info-single w25">
                <p>Usuário cadastro</p>
                <input type="text" value="Kayky Costa" disabled>
            </div><!--register-info-single-->
            <div class="register-info-single w25">
                <p>Última atualização</p>
                <input type="text" value="20/03/2022 15:41:34" disabled>
            </div><!--register-info-single-->
            <div class="register-info-single w25">
                <p>Usuário última atualização</p>
                <input type="text" value="Kayky Costa" disabled>
            </div><!--register-info-single-->
        </div><!--register-infos-->

    </div><!--center-->
</section><!--stock-movements-->