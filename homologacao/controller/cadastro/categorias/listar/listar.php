<section class="list">
    <div class="center">
        <div class="section-title">
            <h2>Listar Categorias</h2>
        </div><!--section-title-->
        <form action="" class="list">
            <input type="text" name="" id="" placeholder="Nome da categoria">
            <button type="button" class="search-btn float-l">Pesquisar</button>
            <a href="<?= INCLUDE_PATH ?>?pg=cadastrar-categoria" class="new-btn float-r">Adicionar</a>
            <div class="clear"></div>
        </form>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cód.</th>
                    <th>Nome</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>15</td>
                    <td>banana</td>
                    <td>ativo</td>
                    <td><i class="fas fa-edit i-edit" title="Editar"></i></td>
                </tr>
            </tbody>
        </table>

    </div><!--center-->
</section><!--listar-->