<section class="list">
    <div class="center">
        <div class="section-title">
            <h2>Listar Grupo / Perfil</h2>
        </div><!--section-title-->
        <form action="" class="list">
            <input type="text" name="" id="" placeholder="Nome do produto">
            <button type="button" class="search-btn float-l">Pesquisar</button>
            <a href="<?= INCLUDE_PATH ?>?pg=cadastrar-grupos-perfil" class="new-btn float-r">Adicionar</a>
            <div class="clear"></div>
        </form>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cód.</th>
                    <th>Cód. Empresa</th>
                    <th>Nome</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>Gerente</td>
                    <td>ativo</td>
                    <td>
                        <i class="fas fa-edit i-edit" title="Editar"></i>
                        <a href="<?= INCLUDE_PATH ?>?pg=permissoes-grupos-perfil"><i class="fas fa-lock i-lock" title="Permissões"></i></a>
                    </td>
                </tr>
            </tbody>
        </table><!--table-desktop-->

    </div><!--center-->
</section><!--listar-->