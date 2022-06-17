<section class="list">
    <div class="center">
        <div class="section-title">
            <h2>Listar Promoções</h2>
        </div><!--section-title-->
        <form action="" class="list">
            <select name="" id="">
                <option selected disabled>Selecione o produto</option>
                <option value="cerveja">Cerveja</option>
                <option value="cerveja">Refrigerante</option>
                <option value="cerveja">Coxinha</option>
            </select>
            <div class="date-inputs-box flexbox">
                <div class="date-input-single w50">
                    <p>Data - Início</p>
                    <input type="text" name="" id="start-date-list" placeholder="Selecionar Data">
                </div><!--date-inputs-single-->
                <div class="date-input-single w50">
                    <p>Data - Fim</p>
                    <input type="text" name="" id="end-date-list" placeholder="Selecionar Data">
                </div><!--date-inputs-single-->
            </div><!--date-inputs-box-->
            <button type="button" class="search-btn float-l">Pesquisar</button>
            <a href="<?= INCLUDE_PATH ?>?pg=cadastrar-promocao" class="new-btn float-r">Adicionar</a>
            <div class="clear"></div>
        </form>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cód.</th>
                    <th>Produto</th>
                    <th>Status</th>
                    <th>Data Início</th>
                    <th>Data Fim</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>4</td>
                    <td>Cerveja</td>
                    <td>Ativo</td>
                    <td>20/03/2022</td>
                    <td>23/03/2022</td>
                    <td><i class="fas fa-edit i-edit" title="Editar"></i></td>
                </tr>
            </tbody>
        </table>

    </div><!--center-->
</section><!--listar-->