<?php

$directory = explode( '/', $_SERVER[ 'PHP_SELF' ] );
$directory = $directory[ 1 ];
include( 'cookie.php' );
include( $_COOKIE[ 'server' ] . '/model/config.php' );

$lib = $_SESSION[ 'main_link' ] . $_SESSION[ 'main_directory' ];

if ( !empty( $_GET[ 'pg' ] ) ) {
  $pg = $_GET[ 'pg' ];
} else {
  $pg = '';
}
switch ( $pg ):

// CADASTRO
case 'cashier':
  $tituloSEO = 'Listar Caixas';
  //$linkPagina = 'controller/cadastro/caixas/listar/listar.php';
  $linkPagina = 'controller/cashier/list-form.php';
  $arquivosCSS = [ 'css/cadastro/caixas/caixas.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = [ 'js/cashier/functions.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

case 'category':
  $tituloSEO = 'Listar Categorias';
  //$linkPagina = 'controller/cadastro/categorias/listar/listar.php';
  $linkPagina = 'controller/category/list-form.php';
  $arquivosCSS = [ 'css/cadastro/categorias/listar/listar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = ['js/category/functions.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

case 'data-category':
  $tituloSEO = 'Cadastrar Categoria';
  //$linkPagina = 'controller/cadastro/categorias/cadastrar/form.php';
  $linkPagina = 'controller/category/data-form.php';
  $arquivosCSS = ['css/cadastro/categorias/cadastrar/cadastrar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = ['js/cadastro/categorias/formulario/validacao.js?' . $_COOKIE[ 'VERSION' ], 'js/category/functions.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

case 'client':
  $tituloSEO = 'Listar Clientes';
  //$linkPagina = 'controller/cadastro/clientes/listar/listar.php';
  $linkPagina = 'controller/client/list-form.php';
  $arquivosCSS = [ 'css/cadastro/clientes/listar/listar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = [ 'js/client/functions.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

case 'data-client':
  $tituloSEO = 'Cadastrar Clientes';
  //$linkPagina = '../controller/cadastro/clientes/cadastrar/form.php';
  $linkPagina = 'controller/client/data-form.php';
  $arquivosCSS = ['css/cadastro/clientes/cadastrar/cadastrar.css?' . $_COOKIE[ 'VERSION' ], 'css/cadastro/clientes/listar/listar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = ['js/client/functions.js?' . $_COOKIE[ 'VERSION' ], 'lib/buscaCEP.js?' . $_COOKIE[ 'VERSION' ], 'lib/validaCNPJ.js?' . $_COOKIE[ 'VERSION' ], 'lib/validaCPF.js?' . $_COOKIE[ 'VERSION' ], 'lib/validaEmail.js?' . $_COOKIE[ 'VERSION' ], 'lib/buscaCNPJ.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

case 'order-sheet':
  $tituloSEO = 'Listar Comandas';
  //$linkPagina = 'controller/cadastro/comandas/listar/listar.php';
  $linkPagina = 'controller/order-sheet/list-form.php';
  $arquivosCSS = ['css/cadastro/comandas/comandas.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = ['js/order-sheet/functions.js?' . $_COOKIE[ 'VERSION' ]  ];
  break;

case 'company':
  $tituloSEO = 'Listar Empresas';
  //$linkPagina = 'controller/cadastro/empresas/listar/listar.php';
  $linkPagina = 'controller/company/list-form.php';
  $arquivosCSS = [ 'css/cadastro/empresas/listar/listar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = [ 'js/company/functions.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

case 'data-company':
  $tituloSEO = 'Cadastrar Empresas';
  //$linkPagina = 'controller/cadastro/empresas/cadastrar/form.php';
  $linkPagina = 'controller/company/data-form.php';
  $arquivosCSS = ['css/cadastro/empresas/cadastrar/cadastrar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = ['js/company/functions.js?' . $_COOKIE[ 'VERSION' ], 'lib/buscaCEP.js?' . $_COOKIE[ 'VERSION' ], 'lib/validaCNPJ.js?' . $_COOKIE[ 'VERSION' ], 'lib/validaCPF.js?' . $_COOKIE[ 'VERSION' ], 'lib/validaEmail.js?' . $_COOKIE[ 'VERSION' ], 'lib/buscaCNPJ.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

case 'listar-fornecedores':
  $tituloSEO = 'Listar Fornecedores';
  $linkPagina = 'controller/cadastro/fornecedores/listar/listar.php';
  $arquivosCSS = [ 'css/cadastro/fornecedores/listar/listar.css' ];
  $arquivosJS = [];
  break;

case 'cadastrar-fornecedor':
  $tituloSEO = 'Cadastrar Fornecedor';
  $linkPagina = 'controller/cadastro/fornecedores/cadastrar/form.php';
  $arquivosCSS = ['css/cadastro/fornecedores/cadastrar/cadastrar.css' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = ['js/cadastro/fornecedores/formulario/validacao.js' . $_COOKIE[ 'VERSION' ] ];
  break;

case 'listar-locais-produtos':
  $tituloSEO = 'Listar Localizações';
  $linkPagina = 'controller/cadastro/locais_produtos/listar/listar.php';
  $arquivosCSS = [ 'css/cadastro/locais_produtos/listar/listar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = [];
  break;

case 'cadastrar-local-produto':
  $tituloSEO = 'Cadastrar Localizações';
  $linkPagina = 'controller/cadastro/locais_produtos/cadastrar/form.php';
  $arquivosCSS = ['css/cadastro/locais_produtos/cadastrar/cadastrar.css?' . $_COOKIE[ 'VERSION' ]];
  $arquivosJS = ['js/cadastro/locais_produtos/formulario/validacao.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

case 'listar-mesas':
  $tituloSEO = 'Listar Mesas';
  $linkPagina = 'controller/cadastro/mesas/listar/listar.php';
  $arquivosCSS = [ 'css/cadastro/mesas/listar/listar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = [];
  break;

case 'cadastrar-mesa':
  $tituloSEO = 'Cadastrar Mesas';
  $linkPagina = 'controller/cadastro/mesas/cadastrar/form.php';
  $arquivosCSS = ['css/cadastro/mesas/cadastrar/cadastrar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = ['js/cadastro/mesas/formulario/validacao.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

case 'listar-produtos':
  $tituloSEO = 'Listar Produtos';
  $linkPagina = 'controller/cadastro/produtos/listar/listar.php';
  $arquivosCSS = [ 'css/cadastro/produtos/listar/listar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = [];
  break;

case 'cadastrar-produto':
  $tituloSEO = 'Cadastrar Produtos';
  $linkPagina = '../controller/cadastro/produtos/cadastrar/form.php';
  $arquivosCSS = ['css/cadastro/produtos/cadastrar/cadastrar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = ['js/cadastro/produtos/formulario/validacao.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

case 'listar-promocao':
  $tituloSEO = 'Listar Promoção';
  $linkPagina = 'controller/cadastro/promocao/listar/listar.php';
  $arquivosCSS = ['css/cadastro/promocao/listar/listar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = ['js/cadastro/promocao/listar/listar.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

case 'cadastrar-promocao':
  $tituloSEO = 'Cadastrar Promoção';
  $linkPagina = 'controller/cadastro/promocao/cadastrar/form.php';
  $arquivosCSS = ['css/cadastro/promocao/cadastrar/cadastrar.css' ];
  $arquivosJS = ['js/cadastro/promocao/formulario/validacao.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

case 'listar-subcategorias':
  $tituloSEO = 'Listar SubCategorias';
  $linkPagina = 'controller/cadastro/subcategorias/listar/listar.php';
  $arquivosCSS = [ 'css/cadastro/subcategorias/listar/listar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = [];
  break;

case 'cadastrar-subcategorias':
  $tituloSEO = 'Listar SubCategorias';
  $linkPagina = 'controller/cadastro/subcategorias/cadastrar/form.php';
  $arquivosCSS = ['css/cadastro/subcategorias/cadastrar/cadastrar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = ['js/cadastro/subcategorias/formulario/validacao.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

case 'listar-suprimentos':
  $tituloSEO = 'Listar Suprimentos';
  $linkPagina = 'controller/cadastro/suprimentos/listar/listar.php';
  $arquivosCSS = [ 'css/cadastro/suprimentos/listar/listar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = [];
  break;

case 'cadastrar-suprimento':
  $tituloSEO = 'Cadastrar Suprimentos';
  $linkPagina = 'controller/cadastro/suprimentos/cadastrar/form.php';
  $arquivosCSS = ['css/cadastro/suprimentos/cadastrar/cadastrar.css?' . $_COOKIE['VERSION'] ];
  $arquivosJS = ['js/cadastro/suprimentos/formulario/validacao.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

  // PRODUTOS

case 'pdv':
  $tituloSEO = 'PDV';
  $linkPagina = 'controller/pedidos/pdv.php';
  $arquivosCSS = [ 'css/pedidos/pdv.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = [ 'js/pedidos/pdv.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

  // MONITOR

case 'balcao':
  $tituloSEO = 'Pedidos do Balcão';
  $linkPagina = 'controller/monitor/balcao/balcao.php';
  $arquivosCSS = [ 'css/monitor/balcao/balcao.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = [];
  break;

case 'cozinha':
  $tituloSEO = 'Pedidos da Cozinha';
  $linkPagina = 'controller/monitor/cozinha/cozinha.php';
  $arquivosCSS = [ 'css/monitor/cozinha/cozinha.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = [];
  break;

case 'editar-mesa-monitor':
  $tituloSEO = 'Editar Mesa';
  $linkPagina = 'controller/monitor/mesas/editar/editar.php';
  $arquivosCSS = ['css/monitor/mesas/editar/editar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = ['js/monitor/mesas/editar/editar.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

case 'listar-mesas-monitor':
  $tituloSEO = 'Mesas';
  $linkPagina = 'controller/monitor/mesas/listar/listar.php';
  $arquivosCSS = ['css/monitor/mesas/listar/listar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = [];
  break;

  // SISTEMA

case 'meus-dados':
  $tituloSEO = 'Meus dados';
  $linkPagina = 'controller/sistema/meus_dados/form.php';
  $arquivosCSS = ['css/sistema/meus_dados/meus-dados.css?' . $_COOKIE['VERSION']];
  $arquivosJS = ['js/sistema/meus_dados/validacao.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

case 'user':
  $tituloSEO = 'Listar Usuários';
  //$linkPagina = 'controller/sistema/usuarios/listar/listar.php';
  $linkPagina = 'controller/user/list-form.php';
  $arquivosCSS = ['css/sistema/usuarios/listar/listar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = ['js/user/functions.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

case 'data-user':
  $tituloSEO = 'Cadastrar Usuários';
  //$linkPagina = 'controller/sistema/usuarios/cadastrar/form.php';
  $linkPagina = 'controller/user/data-form.php';
  $arquivosCSS = ['css/sistema/usuarios/cadastrar/cadastrar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = ['js/user/functions.js?' . $_COOKIE[ 'VERSION' ], 'lib/validaCPF.js?' . $_COOKIE[ 'VERSION' ], 'lib/validaEmail.js?' . $_COOKIE[ 'VERSION' ], 'lib/buscaCEP.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

case 'listar-grupos-perfil':
  $tituloSEO = 'Listar Grupos/Perfil';
  $linkPagina = 'controller/sistema/grupo_perfil/listar/listar.php';
  $arquivosCSS = [ 'css/sistema/grupo_perfil/listar/listar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = [];
  break;

case 'cadastrar-grupos-perfil':
  $tituloSEO = 'Cadastrar Grupos/Perfil';
  $linkPagina = 'controller/sistema/grupo_perfil/cadastrar/form.php';
  $arquivosCSS = [ 'css/sistema/grupo_perfil/cadastrar/cadastrar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = [ 'js/sistema/grupo_perfil/formulario/validacao.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

case 'permissoes-grupos-perfil':
  $tituloSEO = 'Permissões Grupos/Perfil';
  $linkPagina = 'controller/sistema/grupo_perfil/permissoes/permissoes.php';
  $arquivosCSS = ['css/sistema/grupo_perfil/permissoes/permissoes.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = ['js/sistema/grupo_perfil/permissoes/permissoes.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

  //RELATÓRIOS

case 'listar-relatorios-caixa':
  $tituloSEO = 'Relatório Caixas';
  $linkPagina = 'controller/relatorios/listar/listar.php';
  $arquivosCSS = ['css/relatorios/listar/listar.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = ['js/relatorios/listar/listar.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

case 'detalhes-relatorio-caixa':
  $tituloSEO = 'Relatório Caixa';
  $linkPagina = 'controller/relatorios/detalhes/detalhes.php';
  $arquivosCSS = [ 'css/relatorios/detalhes/detalhes.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = [ 'js/relatorios/detalhes/detalhes.js?' . $_COOKIE[ 'VERSION' ] ];
  break;

default:
  $tituloSEO = 'Home';
  $linkPagina = 'controller/home/home.php';
  $arquivosCSS = [ 'css/home/home.css?' . $_COOKIE[ 'VERSION' ] ];
  $arquivosJS = [];
  break;

  endswitch;

  include( 'head.php' ); //incluindo o head antes do body
echo $_SESSION['nameUser'];
  ?>

<body class="flexbox">
<input hidden id="directory" value="<?php echo $directory; ?>">
<input hidden id='http'  value="<?php echo $_COOKIE['server_name']; ?>">
<input hidden id='main_directory' value="<?php echo  $_COOKIE['main_directory'];?>">
<input hidden id='server' value="<?php echo  $_COOKIE['server'];?>">
<input hidden id="id_contract" value="<?php echo  $_COOKIE['id_contract'];?>">
<input hidden id="id_user" value="<?php echo  $_COOKIE['id_user'];?>">
<input hidden id="id_company" value="<?php echo  $_COOKIE['id_company'];?>">
<?php include('sidebar.php'); ?>
<div class="content-container">
  <?php include('header.php'); ?>
  <?php include($_COOKIE['server'].'/'.$linkPagina); ?>
</div>
<!--content-container-->

<?php // include('../../MaxComanda2023/view/footer.php'); ?>

<!-- JQUERY --> 
<script src="<?= $lib ?>/js/plugins/jquery.min.js?<?PHP echo $_COOKIE['VERSION'];?>"></script> 

<!-- JQUERY - MÁSCARAS --> 
<script src="<?= $lib ?>/lib/jquery-mask.js?<?PHP echo $_COOKIE['VERSION'];?>"></script> 

<!-- TOAST --> 
<script src="<?= $lib ?>/lib/toast/toast.js?<?PHP echo $_COOKIE['VERSION'];?>"></script> 
<script src="<?= $lib ?>/js/sidebar/sidebar.js?<?PHP echo $_COOKIE['VERSION'];?>"></script>

<!-- CALENDAR -->
<script src="<?= $lib ?>/js/plugins/calendario/mc-calendar.min.js?<?PHP echo $_COOKIE['VERSION'];?>"></script>

<!-- SELECT2 -->
<script src="<?= $lib ?>/js/plugins/select2/select2.js?<?PHP echo $_COOKIE['VERSION'];?>"></script>

<!-- SWITCHER -->
<script src="<?= $lib ?>/js/plugins/switcher/switcher.min.js?<?PHP echo $_COOKIE['VERSION'];?>"></script>

<!-- PICKER COLOR -->
<script src="<?= $lib ?>/js/plugins/color-picker/colorPick.min.js?<?PHP echo $_COOKIE['VERSION'];?>"></script>

<!-- TIME PICKER -->
<script src="<?= $lib ?>/js/plugins/time-picker/jquery-clock-timepicker.min.js?<?PHP echo $_COOKIE['VERSION'];?>"></script>

<!-- VARIÁVEIS EM JS --> 
<script src="<?= $lib ?>/js/variables.js?<?PHP echo $_COOKIE['VERSION'];?>"></script>
<?php foreach($arquivosJS as $arquivoJS): ?>
<script src="<?= $lib.'/'.$arquivoJS; ?>"></script>
<?php endforeach; ?>

<!-- FUNÇÕES GERAIS - JS --> 
<script src="<?= $lib ?>/lib/generalFunctions.js?<?PHP echo $_COOKIE['VERSION'];?>"></script>
</body>
</html>