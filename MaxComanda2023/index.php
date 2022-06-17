<?php

include('model/config.php');

if (!empty($_GET['pg'])) {
    $pg = $_GET['pg'];
} else {
    $pg = '';
}
switch ($pg):

    // CADASTRO

    case 'listar-caixas':
        $tituloSEO = 'Listar Caixas';
        $linkPagina = 'controller/cadastro/caixas/listar/listar.php';
        $arquivosCSS = ['css/cadastro/caixas/caixas.css'];
        $arquivosJS = [];
    break;

    case 'listar-categorias':
        $tituloSEO = 'Listar Categorias';
        $linkPagina = 'controller/cadastro/categorias/listar/listar.php';
        $arquivosCSS = ['css/cadastro/categorias/listar/listar.css'];
        $arquivosJS = [];
    break;
    
    case 'cadastrar-categoria':
        $tituloSEO = 'Cadastrar Categoria';
        $linkPagina = 'controller/cadastro/categorias/cadastrar/form.php';
        $arquivosCSS = ['css/plugins/select2/select2.css','css/cadastro/categorias/cadastrar/cadastrar.css'];
        $arquivosJS = ['js/plugins/select2/select2.js','js/cadastro/categorias/formulario/validacao.js'];
        break;

    case 'listar-clientes':
        $tituloSEO = 'Listar Clientes';
        $linkPagina = 'controller/cadastro/clientes/listar/listar.php';
        $arquivosCSS = ['css/cadastro/clientes/listar/listar.css'];
        $arquivosJS = [];
    break;

    case 'cadastrar-cliente':
        $tituloSEO = 'Cadastrar Clientes';
        $linkPagina = 'controller/cadastro/clientes/cadastrar/form.php';
        $arquivosCSS = ['css/plugins/calendario/mc-calendar.min.css','css/plugins/select2/select2.css','css/cadastro/clientes/cadastrar/cadastrar.css'];
        $arquivosJS = ['js/plugins/mask/jquery.mask.min.js','js/plugins/calendario/mc-calendar.min.js','js/plugins/select2/select2.js','js/cadastro/clientes/formulario/validacao.js'];
    break;

    case 'listar-comandas':
        $tituloSEO = 'Listar Comandas';
        $linkPagina = 'controller/cadastro/comandas/listar/listar.php';
        $arquivosCSS = ['css/plugins/switcher/switcher.css','css/cadastro/comandas/comandas.css'];
        $arquivosJS = ['js/plugins/switcher/switcher.min.js','js/cadastro/comandas/comandas.js'];
    break;
    
    case 'listar-empresas':
        $tituloSEO = 'Listar Empresas';
        $linkPagina = 'controller/cadastro/empresas/listar/listar.php';
        $arquivosCSS = ['css/cadastro/empresas/listar/listar.css'];
        $arquivosJS = [];
    break;

    case 'cadastrar-empresa':
        $tituloSEO = 'Cadastrar Empresas';
        $linkPagina = 'controller/cadastro/empresas/cadastrar/form.php';
        $arquivosCSS = ['css/plugins/color-picker/colorPick.min.css','css/plugins/select2/select2.css','css/cadastro/empresas/cadastrar/cadastrar.css'];
        $arquivosJS = ['js/plugins/mask/jquery.mask.min.js','js/plugins/color-picker/colorPick.min.js','js/plugins/select2/select2.js','js/cadastro/empresas/formulario/validacao.js'];
    break;

    case 'listar-fornecedores':
        $tituloSEO = 'Listar Fornecedores';
        $linkPagina = 'controller/cadastro/fornecedores/listar/listar.php';
        $arquivosCSS = ['css/cadastro/fornecedores/listar/listar.css'];
        $arquivosJS = [];
    break;

    case 'cadastrar-fornecedor':
        $tituloSEO = 'Cadastrar Fornecedor';
        $linkPagina = 'controller/cadastro/fornecedores/cadastrar/form.php';
        $arquivosCSS = ['css/plugins/select2/select2.css','css/cadastro/fornecedores/cadastrar/cadastrar.css'];
        $arquivosJS = ['js/plugins/mask/jquery.mask.min.js','js/plugins/select2/select2.js','js/cadastro/fornecedores/formulario/validacao.js'];
    break;

    case 'listar-locais-produtos':
        $tituloSEO = 'Listar Localizações';
        $linkPagina = 'controller/cadastro/locais_produtos/listar/listar.php';
        $arquivosCSS = ['css/cadastro/locais_produtos/listar/listar.css'];
        $arquivosJS = [];
    break;

    case 'cadastrar-local-produto':
        $tituloSEO = 'Cadastrar Localizações';
        $linkPagina = 'controller/cadastro/locais_produtos/cadastrar/form.php';
        $arquivosCSS = ['css/plugins/select2/select2.css','css/cadastro/locais_produtos/cadastrar/cadastrar.css'];
        $arquivosJS = ['js/plugins/select2/select2.js','js/cadastro/locais_produtos/formulario/validacao.js'];
    break;

    case 'listar-mesas':
        $tituloSEO = 'Listar Mesas';
        $linkPagina = 'controller/cadastro/mesas/listar/listar.php';
        $arquivosCSS = ['css/cadastro/mesas/listar/listar.css'];
        $arquivosJS = [];
    break;

    case 'cadastrar-mesa':
        $tituloSEO = 'Cadastrar Mesas';
        $linkPagina = 'controller/cadastro/mesas/cadastrar/form.php';
        $arquivosCSS = ['css/plugins/switcher/switcher.css','css/cadastro/mesas/cadastrar/cadastrar.css'];
        $arquivosJS = ['js/plugins/switcher/switcher.min.js','js/cadastro/mesas/formulario/validacao.js'];
    break;

    case 'listar-produtos':
        $tituloSEO = 'Listar Produtos';
        $linkPagina = 'controller/cadastro/produtos/listar/listar.php';
        $arquivosCSS = ['css/cadastro/produtos/listar/listar.css'];
        $arquivosJS = [];
    break;

    case 'cadastrar-produto':
        $tituloSEO = 'Cadastrar Produtos';
        $linkPagina = 'controller/cadastro/produtos/cadastrar/form.php';
        $arquivosCSS = ['css/plugins/switcher/switcher.css','css/plugins/calendario/mc-calendar.min.css','css/plugins/select2/select2.css','css/cadastro/produtos/cadastrar/cadastrar.css'];
        $arquivosJS = ['js/plugins/mask/jquery.mask.min.js','js/plugins/switcher/switcher.min.js','js/plugins/calendario/mc-calendar.min.js','js/plugins/select2/select2.js','js/cadastro/produtos/formulario/validacao.js'];
    break;

    case 'listar-promocao':
        $tituloSEO = 'Listar Promoção';
        $linkPagina = 'controller/cadastro/promocao/listar/listar.php';
        $arquivosCSS = ['css/plugins/calendario/mc-calendar.min.css','css/plugins/select2/select2.css','css/cadastro/promocao/listar/listar.css'];
        $arquivosJS = ['js/plugins/calendario/mc-calendar.min.js','js/plugins/select2/select2.js', 'js/cadastro/promocao/listar/listar.js'];
    break;

    case 'cadastrar-promocao':
        $tituloSEO = 'Cadastrar Promoção';
        $linkPagina = 'controller/cadastro/promocao/cadastrar/form.php';
        $arquivosCSS = ['css/plugins/calendario/mc-calendar.min.css','css/plugins/select2/select2.css','css/plugins/select2/select2.css','css/cadastro/promocao/cadastrar/cadastrar.css'];
        $arquivosJS = ['js/plugins/mask/jquery.mask.min.js','js/plugins/calendario/mc-calendar.min.js','js/plugins/select2/select2.js','js/cadastro/promocao/formulario/validacao.js'];
    break;
    
    case 'listar-subcategorias':
        $tituloSEO = 'Listar SubCategorias';
        $linkPagina = 'controller/cadastro/subcategorias/listar/listar.php';
        $arquivosCSS = ['css/cadastro/subcategorias/listar/listar.css'];
        $arquivosJS = [];
    break;

    case 'cadastrar-subcategorias':
        $tituloSEO = 'Listar SubCategorias';
        $linkPagina = 'controller/cadastro/subcategorias/cadastrar/form.php';
        $arquivosCSS = ['css/plugins/select2/select2.css','css/cadastro/subcategorias/cadastrar/cadastrar.css'];
        $arquivosJS = ['js/plugins/select2/select2.js','js/cadastro/subcategorias/formulario/validacao.js'];
    break;

    case 'listar-suprimentos':
        $tituloSEO = 'Listar Suprimentos';
        $linkPagina = 'controller/cadastro/suprimentos/listar/listar.php';
        $arquivosCSS = ['css/cadastro/suprimentos/listar/listar.css'];
        $arquivosJS = [];
    break;

    case 'cadastrar-suprimento':
        $tituloSEO = 'Cadastrar Suprimentos';
        $linkPagina = 'controller/cadastro/suprimentos/cadastrar/form.php';
        $arquivosCSS = ['css/plugins/calendario/mc-calendar.min.css','css/plugins/select2/select2.css','css/cadastro/suprimentos/cadastrar/cadastrar.css'];
        $arquivosJS = ['js/plugins/mask/jquery.mask.min.js','js/plugins/calendario/mc-calendar.min.js','js/plugins/select2/select2.js','js/cadastro/suprimentos/formulario/validacao.js'];
    break;

    // PRODUTOS

    case 'pdv':
        $tituloSEO = 'PDV';
        $linkPagina = 'controller/pedidos/pdv.php';
        $arquivosCSS = ['css/pedidos/pdv.css'];
        $arquivosJS = ['js/pedidos/pdv.js'];
    break;

    // MONITOR

    case 'balcao':
        $tituloSEO = 'Pedidos do Balcão';
        $linkPagina = 'controller/monitor/balcao/balcao.php';
        $arquivosCSS = ['css/monitor/balcao/balcao.css'];
        $arquivosJS = [];
    break;

    case 'cozinha':
        $tituloSEO = 'Pedidos da Cozinha';
        $linkPagina = 'controller/monitor/cozinha/cozinha.php';
        $arquivosCSS = ['css/monitor/cozinha/cozinha.css'];
        $arquivosJS = [];
    break;

    case 'editar-mesa-monitor':
        $tituloSEO = 'Editar Mesa';
        $linkPagina = 'controller/monitor/mesas/editar/editar.php';
        $arquivosCSS = ['css/plugins/select2/select2.css','css/monitor/mesas/editar/editar.css'];
        $arquivosJS = ['js/plugins/select2/select2.js','js/monitor/mesas/editar/editar.js'];
    break;

    case 'listar-mesas-monitor':
        $tituloSEO = 'Mesas';
        $linkPagina = 'controller/monitor/mesas/listar/listar.php';
        $arquivosCSS = ['css/monitor/mesas/listar/listar.css'];
        $arquivosJS = [];
    break;

    // SISTEMA

    case 'meus-dados':
        $tituloSEO = 'Meus dados';
        $linkPagina = 'controller/sistema/meus_dados/form.php';
        $arquivosCSS = ['css/plugins/calendario/mc-calendar.min.css','css/plugins/select2/select2.css','css/sistema/meus_dados/meus-dados.css'];
        $arquivosJS = ['js/plugins/mask/jquery.mask.min.js','js/plugins/calendario/mc-calendar.min.js','js/plugins/select2/select2.js','js/sistema/meus_dados/validacao.js'];
    break;

    case 'listar-usuarios':
        $tituloSEO = 'Listar Usuários';
        $linkPagina = 'controller/sistema/usuarios/listar/listar.php';
        $arquivosCSS = ['css/sistema/usuarios/listar/listar.css'];
        $arquivosJS = [];
    break;

    case 'cadastrar-usuario':
        $tituloSEO = 'Cadastrar Usuários';
        $linkPagina = 'controller/sistema/usuarios/cadastrar/form.php';
        $arquivosCSS = ['css/plugins/calendario/mc-calendar.min.css','css/plugins/select2/select2.css','css/sistema/usuarios/cadastrar/cadastrar.css'];
        $arquivosJS = ['js/plugins/mask/jquery.mask.min.js','js/plugins/calendario/mc-calendar.min.js','js/plugins/select2/select2.js','js/sistema/usuarios/formulario/validacao.js'];
    break;

    case 'listar-grupos-perfil':
        $tituloSEO = 'Listar Grupos/Perfil';
        $linkPagina = 'controller/sistema/grupo_perfil/listar/listar.php';
        $arquivosCSS = ['css/sistema/grupo_perfil/listar/listar.css'];
        $arquivosJS = [];
    break;

    case 'cadastrar-grupos-perfil':
        $tituloSEO = 'Cadastrar Grupos/Perfil';
        $linkPagina = 'controller/sistema/grupo_perfil/cadastrar/form.php';
        $arquivosCSS = ['css/sistema/grupo_perfil/cadastrar/cadastrar.css'];
        $arquivosJS = ['js/sistema/grupo_perfil/formulario/validacao.js'];
    break;

    case 'permissoes-grupos-perfil':
        $tituloSEO = 'Permissões Grupos/Perfil';
        $linkPagina = 'controller/sistema/grupo_perfil/permissoes/permissoes.php';
        $arquivosCSS = ['css/plugins/switcher/switcher.css','css/sistema/grupo_perfil/permissoes/permissoes.css'];
        $arquivosJS = ['js/plugins/switcher/switcher.min.js','js/sistema/grupo_perfil/permissoes/permissoes.js'];
    break;

    //RELATÓRIOS

    case 'listar-relatorios-caixa':
        $tituloSEO = 'Relatório Caixas';
        $linkPagina = 'controller/relatorios/listar/listar.php';
        $arquivosCSS = ['css/plugins/calendario/mc-calendar.min.css','css/plugins/select2/select2.css','css/relatorios/listar/listar.css'];
        $arquivosJS = ['js/plugins/mask/jquery.mask.min.js','js/plugins/calendario/mc-calendar.min.js','js/plugins/select2/select2.js','js/relatorios/listar/listar.js'];
    break;

    case 'detalhes-relatorio-caixa':
        $tituloSEO = 'Relatório Caixa';
        $linkPagina = 'controller/relatorios/detalhes/detalhes.php';
        $arquivosCSS = ['css/relatorios/detalhes/detalhes.css'];
        $arquivosJS = ['js/relatorios/detalhes/detalhes.js'];
    break;

    default:
        $tituloSEO = 'Home';
        $linkPagina = 'controller/home/home.php';
        $arquivosCSS = ['css/home/home.css'];
        $arquivosJS = [];
    break;

endswitch;

include('view/head.php'); //incluindo o head antes do body

?>

<body class="flexbox">

    <?php include('view/sidebar.php'); ?>

    <div class="content-container">
        <?php include('view/header.php'); ?>
        <?php include($linkPagina); ?>
    </div><!--content-container-->   

    <?php // include('view/footer.php'); ?>

    <script src="js/plugins/jquery.min.js"></script>
    <script src="js/sidebar/sidebar.js"></script>

    <?php foreach($arquivosJS as $arquivoJS): ?>
       <script src="<?= $arquivoJS; ?>"></script>
    <?php endforeach; ?>


</body>

</html>