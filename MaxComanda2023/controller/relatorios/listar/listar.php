<section class="reports">
    <div class="center">
        <div class="section-title">
            <h2>Relatórios dos Caixas</h2>
        </div><!--section-title-->
        <form action="" method="post" class="flexbox">
            <div class="inp-single w50">
                <p>Caixa</p>
                <select name="" id="select-caixa-listar-relatorios">
                    <option value="" selected disabled>Selecione</option>
                    <option value="">Caixa 1</option>
                    <option value="">Caixa 2</option>
                </select>
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-status">Status</p>
                <select name="" id="select-status-listar-relatorios" onchange="validarFormulario()">
                    <option value="todos">Todos</option>
                    <option value="aberto">Aberto</option>
                    <option value="fechado">Fechado</option>
                </select>
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-data-inicio">Data - Início</p>
                <input type="text" id="data-inicio-listar-relatorios" placeholder="Selecionar data" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="inp-single w50">
                <p class="p-data-fim">Data - Fim</p>
                <input type="text" id="data-fim-listar-relatorios" placeholder="Selecionar data" onkeyup="validarFormulario()">
            </div><!--inp-single-->
            <div class="btn-single w100">
                <button type="button" id="btn-pesquisar">Pesquisar</button>
            </div><!--btn-single-->
        </form>
        <div class="results-box">
            <div class="results-title">
                <h2><b>2</b> Resultados encontrados:</h2>
            </div><!--results-title-->
            <div class="result-single">
                <div class="result-single-title result-single-open flexbox" id="btn-content2" onclick="abrirResultSingle(1)">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <h3>Caixa: 1 || Abertura: 05/04/2022 13:34:46 || Status: <b>Aberto</b> || Usuário: Kayky Costa || Valor Inicial: R$0,00</h3>
                </div><!--result-single-title-->
                <div class="result-single-content" id="content1">
                    <div class="result-single-content-title">
                        <h2>Este Caixa Ainda Está Aberto!</h2>
                    </div><!--result-single-content-title-->
                    <div class="btn-single">
                        <a href="<?= INCLUDE_PATH ?>?pg=detalhes-relatorio-caixa">Ver Detalhes</a>
                    </div><!--btn-single-->
                </div><!--result-single-content-->
            </div><!--result-single-->
            <div class="result-single">
                <div class="result-single-title result-single-locked flexbox" id="btn-content2" onclick="abrirResultSingle(2)">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <h3>Caixa: 1 || Abertura: 03/04/2022 12:34:46 || Status: <b>Fechado</b> || Usuário: Kayky Costa || Valor Inicial: R$0,00</h3>
                </div><!--result-single-title-->
                <div class="result-single-content" id="content2">
                    <div class="result-single-content-title">
                        <h2>Fechamento: 04/04/2022 09:11:49</h2>
                        <h3>Valores informados:</h3>
                    </div><!--result-single-content-title-->
                    <div class="result-single-content-box flexbox">
                        <div class="result-single-content-single w25">
                            <h2>Dinheiro</h2>
                            <h3>R$ 50,00</h3>
                        </div><!--result-single-content-single-->
                        <div class="result-single-content-single w25">
                            <h2>Crédito</h2>
                            <h3>R$ 0,00</h3>
                        </div><!--result-single-content-single-->
                        <div class="result-single-content-single w25">
                            <h2>Débito</h2>
                            <h3>R$ 0,00</h3>
                        </div><!--result-single-content-single-->
                        <div class="result-single-content-single w25">
                            <h2>PIX</h2>
                            <h3>R$ 320,00</h3>
                        </div><!--result-single-content-single-->
                    </div><!--result-single-content-box-->
                    <div class="btn-single">
                        <a href="<?= INCLUDE_PATH ?>?pg=detalhes-relatorio-caixa">Ver Detalhes</a>
                    </div><!--btn-single-->
                </div><!--result-single-content-->
            </div><!--result-single-->
        </div><!--results-box-->
    </div><!--center-->
</section><!--reports-->