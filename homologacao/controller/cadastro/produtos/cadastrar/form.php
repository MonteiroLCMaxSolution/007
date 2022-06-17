<div class="page-title">
    <h1>Cadastrar Produto</h1>
</div><!--section-title-->
<section class="register-form">
    <div class="center">
        <div class="section-title">
            <h2>Informações principais</h2>
        </div><!--section-title-->
        <form action="" class="flexbox">
            <div class="inp-single w20">
                <p>Id</p>
                <input type="text" disabled>
            </div><!--inp-single-->
            <div class="inp-single w40">
                <p class="p-local">Local</p>
                <select name="" id="select-local-produto" class="select-local" onchange="validarFormulario()">
                    <option selected disabled value="nulo">Selecionar Local</option>
                    <option value="">teste</option>
                    <option value="">cozinha</option>
                    <option value="">salao</option>
                </select>
            </div><!--inp-single-->
            <div class="inp-single w40">
                <p class="p-subcategoria">Subcategoria</p>
                <select name="" id="select-subcategoria-produto" class="select-subcategoria" onchange="validarFormulario()">
                    <option selected disabled value="nulo">Selecionar SubCategoria</option>
                    <option value="">salgado</option>
                    <option value="">suco</option>
                    <option value="">cerveja</option>
                </select>
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-nome">Nome</p>
                <input type="text" id="nome-produto" onkeyup="validarFormulario()" placeholder="Coxinha">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-descricao">Descrição</p>
                <input type="text" id="descricao-produto" onkeyup="validarFormulario()" placeholder="Coxinha crocante por fora e macia por dentro">
            </div><!--inp-single-->
            <div class="inp-single w100">
                <p class="p-fracionar-sabores">Fracionar em quantos sabores?</p>
                <input type="number" id="fracionar-sabores-produto" onkeyup="validarFormulario()" placeholder="2">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-preco-custo">Preço de custo</p>
                <input type="number" id="preco-custo-produto" onkeyup="validarFormulario()" placeholder="R$">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-preco-venda">Preço de venda</p>
                <input type="number" id="preco-venda-produto" onkeyup="validarFormulario()" placeholder="R$">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-estoque-minimo">Estoque mínimo</p>
                <input type="number" id="estoque-minimo-produto" onkeyup="validarFormulario()" placeholder="15">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p>Quantidade disponível</p>
                <input type="number" disabled>
            </div><!--inp-single-->

            <div class="check-box w100">
                <div class="check-single w100 bg-gray">
                    <span class="float-l">Vai para a cozinha</span>
                    <input class="float-r" type="checkbox" name="" id="">
                    <div class="clear"></div>
                </div><!--inp-single-->
                <div class="check-single w100">
                    <span class="float-l">Inserir no cardápio local</span>
                    <input class="float-r" type="checkbox" name="" id="">
                    <div class="clear"></div>
                </div><!--inp-single-->
                <div class="check-single w100 bg-gray">
                    <span class="float-l">Inserir no cardápio delivery</span>
                    <input class="float-r" type="checkbox" name="" id="">
                    <div class="clear"></div>
                </div><!--inp-single-->
                <div class="check-single w100">
                    <span class="float-l">Servir de manhã</span>
                    <input class="float-r" type="checkbox" name="" id="">
                    <div class="clear"></div>
                </div><!--inp-single-->
                <div class="check-single w100 bg-gray">
                    <span class="float-l">Servir à tarde</span>
                    <input class="float-r" type="checkbox" name="" id="">
                    <div class="clear"></div>
                </div><!--inp-single-->
                <div class="check-single w100">
                    <span class="float-l">Servir à noite</span>
                    <input class="float-r" type="checkbox" name="" id="">
                    <div class="clear"></div>
                </div><!--inp-single-->
            </div><!--check-box-->

            <div class="buttons-box">
                <a href="<?= INCLUDE_PATH ?>?pg=listar-fornecedores">Cancelar</a>
                <button class="float-r" type="submit" id="btn-enviar-form">Confirmar</button>
                <div class="clear"></div>
            </div><!--buttons-box-->
        </form>
    </div><!--center-->
</section><!--register-form-->

<section class="flavors">
    <div class="center">
        <div class="section-title">
            <h2>Sabores</h2>
        </div><!--section-title-->

        <form action="" class="search-flavors flexbox">
            <div class="inp-single w33">
                <p class="p-nome-add-sabor">Nome</p>
                <input type="text" id="nome-add-sabor" onkeyup="validarAddSabores()" placeholder="Frango">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-descricao-add-sabor">Descrição</p>
                <input type="text" id="descricao-add-sabor" onkeyup="validarAddSabores()" placeholder="Frango defumado">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-status-add-sabor">Status</p>
                <select name="" id="select-status-add-sabor" onchange="validarAddSabores()">
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                </select>
            </div><!--inp-single-->
            <div class="btn-single">
                <button type="button" id="btn-enviar-add-sabor">Enviar</button>
            </div><!--btn-single-->
        </form><!--search-flavors-->

        <form action="" class="edit-flavors flexbox">
            <div class="inp-single w33">
                <p class="p-nome-edit-sabor">Nome</p>
                <input type="text" id="nome-edit-sabor" onkeyup="validarEditSabores()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-descricao-edit-sabor">Descrição</p>
                <input type="text" id="descricao-edit-sabor" onkeyup="validarEditSabores()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-status-edit-sabor">Status</p>
                <select name="" id="select-status-edit-sabor" onchange="validarEditSabores()">
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                </select>
            </div><!--inp-single-->
            <div class="btn-box w100">
                <button type="button" class="cancel-btn" id="btn-cancel-edit-sabor">Cancelar</button>
                <button type="button" class="save-btn" id="btn-salvar-edit-sabor">Salvar</button>
            </div><!--btn-box-->
        </form><!--edit-flavors-->

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Frango</td>
                    <td>Desfiado</td>
                    <td>Ativo</td>
                    <td><i class="fas fa-edit btn-open-edit-sabor"></i></td>
                </tr>
            </tbody>
        </table>
    </div><!--center-->
</section><!--flavors-->

<section class="add-ons">
    <div class="center">
        <div class="section-title">
            <h2>Complementos</h2>
        </div><!--section-title-->
        <form action="" class="search-add-ons flexbox">
            <div class="inp-single w33">
                <p class="p-nome-add-complemento">Nome</p>
                <input type="text" id="nome-add-complemento" onkeyup="validarAddComplementos()" placeholder="Mostarda">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-preco-add-complemento">Preço</p>
                <input type="number" id="preco-add-complemento" onkeyup="validarAddComplementos()" placeholder="R$">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-status-add-complemento">Status</p>
                <select name="" id="select-status-add-complemento" onchange="validarAddComplementos()">
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                </select>
            </div><!--inp-single-->
            <div class="btn-single">
                <button type="button" id="btn-enviar-add-complemento">Enviar</button>
            </div><!--btn-single-->
        </form>

        <form action="" class="edit-add-ons flexbox">
            <div class="inp-single w33">
                <p class="p-nome-edit-complemento">Nome</p>
                <input type="text" id="nome-edit-complemento" onkeyup="validarEditComplementos()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-preco-edit-complemento">Preço</p>
                <input type="number" id="preco-edit-complemento" onkeyup="validarEditComplementos()">
            </div><!--inp-single-->
            <div class="inp-single w33">
                <p class="p-status-edit-complemento">Status</p>
                <select name="" id="select-status-edit-complemento" onchange="validarEditComplementos()">
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                </select>
            </div><!--inp-single-->
            <div class="btn-box w100">
                <button type="button" class="cancel-btn" id="btn-cancel-edit-complemento">Cancelar</button>
                <button type="button" class="save-btn" id="btn-salvar-edit-complemento">Salvar</button>
            </div><!--btn-box-->
        </form>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Mostarda</td>
                    <td>R$ 2,00</td>
                    <td>Ativo</td>
                    <td><i class="fas fa-edit btn-open-edit-complemento"></i></td>
                </tr>
            </tbody>
        </table>
    </div><!--center-->
</section><!--add-ons-->

<section class="select-images">
    <div class="center">
        <div class="section-title">
            <h2>Imagens</h2>
        </div><!--section-title-->
        <form action="">
            <div class="inp-single float-l">
                <p class="p-img-imagem">Imagem</p>
                <input type="file" src="" alt="" id="imagem-add-img" accept=".jpg,.jpeg,.png">
            </div>
            <div class="btn-single float-r">
                <button type="button" id="btn-add-imagem">Enviar</button>
            </div><!--btn-single-->
            <div class="clear"></div>
        </form>
        <div class="images-box flexbox">
            <div class="image-single w33">
                <img src="images/logo-max-comanda.png" alt="">
                <div class="image-single-actions">
                    <div class="inp-single">
                        <p>Imagem principal ?</p>
                        <input type="radio" name="img-produto" class="">
                    </div><!--inp-single-->
                    <div class="delete-image-button">
                        <a href="#">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div><!--delete-image-button-->
                </div><!--image-single-actions-->
            </div><!--image-single-->
            <div class="image-single w33">
                <img src="images/logo-max-comanda.png" alt="">
                <div class="image-single-actions">
                    <div class="inp-single">
                        <p>Imagem principal ?</p>
                        <input type="radio" name="img-produto" class="">
                    </div><!--inp-single-->
                    <div class="delete-image-button">
                        <a href="#">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div><!--delete-image-button-->
                </div><!--image-single-actions-->
            </div><!--image-single-->
            <div class="image-single w33">
                <img src="images/logo-max-comanda.png" alt="">
                <div class="image-single-actions">
                    <div class="inp-single">
                        <p>Imagem principal ?</p>
                        <input type="radio" name="img-produto" class="">
                    </div><!--inp-single-->
                    <div class="delete-image-button">
                        <a href="#">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div><!--delete-image-button-->
                </div><!--image-single-actions-->
            </div><!--image-single-->
        </div><!--images-box-->
    </div><!--center-->
</section><!--select-images-->

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
                <button type="button" class="add-btn float-r" id="btn-add-exit">Adicionar</button>
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
                <button type="button" class="add-btn float-r" id="btn-add-entrance">Adicionar</button>
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
</section><!--stock-movements-->
