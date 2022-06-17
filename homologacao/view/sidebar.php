<?php
if (!isset($_SESSION)) {
  session_start(); 
}
$directory = explode('/', $_SERVER['PHP_SELF']);
$directory = $directory[1];
if(empty($_SESSION['id_user']) and empty($_COOKIE['id_user'])){
	?>
<script>
	window.location.href = 'https://<?php echo $_SERVER['SERVER_NAME'].'/'.$directory;?>';
</script>

<?php
}
?>

<aside id="sidebar">
    <div class="dashboard-close-icon">
        <i class="fas fa-times"></i>
    </div><!--dashboard-close-icon-->
    <div class="dashboard-user-box flexbox">
		<?php
			if(empty($_SESSION[ 'userImage' ])){
				$imageUser = INCLUDE_HOMOLOGACAO."uploads/userImage/userImage.png";
			}else{
				$imageUser = $_SESSION['server_name'].$directory.'/uploads/userImage/'.$_SESSION['userImage'];
			}
			?>
        <div class="dashboard-user-img" style="background-image: url('<?php echo $imageUser;?>');">
        </div><!--dashboard-user-img-->
        <div class="dashboard-user-infos">
            <div class="dashboard-user-infos-box">
                <div class="dashboard-user-name">
                    <h2><?php echo $_SESSION['name_user'];?></h2>
                </div><!--dashboard-user-name-->
                <div class="dashboard-user-email">
                    <h3><?php echo $_SESSION['user_mail'];?></h3>
                </div><!--dashboard-user-email-->
            </div><!--dashboard-user-infos-box-->
        </div><!--dashboard-user-infos-->
    </div><!--dashboard-user-box-->
    <div class="dashboard-container">
        <div class="dashboard-box">
            <div class="dashboard-box-title">
                <div class="dashboard-box-title-content flexbox float-l">
                    <i class="fas fa-home"></i>
                    <a href="?pg=home">Home</a>
                </div><!--dashboard-box-title-content-->
                <div class="clear"></div>
            </div><!--dashboard-box-title-->
        </div><!--dashboard-box-->
        <div class="dashboard-box">
            <div class="dashboard-box-title" id="cadastroSidebar">
                <div class="dashboard-box-title-content flexbox float-l">
                    <i class="far fa-clipboard"></i>
                    <h2>Cadastro</h2>
                </div><!--dashboard-box-title-content-->
                <div class="dashboard-box-title-arrow float-r">
                    <i class="fas fa-angle-down"></i>
                </div><!--dashboard-box-title-arrow-->
                <div class="clear"></div>
            </div><!--dashboard-box-title-->
            <div class="dashboard-box-itens" id="cadastroSidebarBox">
                <div class="dashboard-box-item-single">
                    <a href="?pg=cashier">Caixas</a>
                </div><!--dashboard-box-item-single-->
                <div class="dashboard-box-item-single">
                    <a href="?pg=category">Categorias</a>
                </div><!--dashboard-box-item-single-->
                <div class="dashboard-box-item-single">
                    <a href="?pg=client">Clientes</a>
                </div><!--dashboard-box-item-single-->
                <div class="dashboard-box-item-single">
                    <a href="?pg=order-sheet">Comandas</a>
                </div><!--dashboard-box-item-single-->
                <div class="dashboard-box-item-single">
                    <a href="?pg=company">Empresas</a>
                </div><!--dashboard-box-item-single-->
                <div class="dashboard-box-item-single">
                    <a href="?pg=listar-fornecedores">Fornecedores</a>
                </div><!--dashboard-box-item-single-->
                <div class="dashboard-box-item-single">
                    <a href="?pg=listar-locais-produtos">Locais - Produtos</a>
                </div><!--dashboard-box-item-single-->
                <div class="dashboard-box-item-single">
                    <a href="?pg=listar-mesas">Mesas</a>
                </div><!--dashboard-box-item-single-->
                <div class="dashboard-box-item-single">
                    <a href="?pg=listar-produtos">Produtos</a>
                </div><!--dashboard-box-item-single-->
                <div class="dashboard-box-item-single">
                    <a href="?pg=listar-promocao">Promoção</a>
                </div><!--dashboard-box-item-single-->
                <div class="dashboard-box-item-single">
                    <a href="?pg=listar-subcategorias">SubCategorias</a>
                </div><!--dashboard-box-item-single-->
                <div class="dashboard-box-item-single">
                    <a href="?pg=listar-suprimentos">Suprimentos</a>
                </div><!--dashboard-box-item-single-->
            </div><!--dashboard-box-itens-->
        </div><!--dashboard-box-->
        <div class="dashboard-box">
            <div class="dashboard-box-title" id="pedidoSidebar">
                <div class="dashboard-box-title-content flexbox float-l">
                    <i class="fas fa-book-open"></i>
                    <h2>Pedidos</h2>
                </div><!--dashboard-box-title-content-->
                <div class="dashboard-box-title-arrow float-r">
                    <i class="fas fa-angle-down"></i>
                </div><!--dashboard-box-title-arrow-->
                <div class="clear"></div>
            </div><!--dashboard-box-title-->
            <div class="dashboard-box-itens" id="pedidoSidebarBox">
                <div class="dashboard-box-item-single">
                    <a href="?pg=pdv">PDV</a>
                </div><!--dashboard-box-item-single-->
            </div><!--dashboard-box-itens-->
        </div><!--dashboard-box-->
        <div class="dashboard-box">
            <div class="dashboard-box-title" id="monitorSidebar">
                <div class="dashboard-box-title-content flexbox float-l">
                    <i class="fas fa-desktop"></i>
                    <h2>Monitor</h2>
                </div><!--dashboard-box-title-content-->
                <div class="dashboard-box-title-arrow float-r">
                    <i class="fas fa-angle-down"></i>
                </div><!--dashboard-box-title-arrow-->
                <div class="clear"></div>
            </div><!--dashboard-box-title-->
            <div class="dashboard-box-itens" id="monitorSidebarBox">
                <div class="dashboard-box-item-single">
                    <a href="?pg=balcao">Balcao</a>
                </div><!--dashboard-box-item-single-->
                <div class="dashboard-box-item-single">
                    <a href="?pg=cozinha">Cozinha</a>
                </div><!--dashboard-box-item-single-->
                <div class="dashboard-box-item-single">
                    <a href="?pg=listar-mesas-monitor">Mesas</a>
                </div><!--dashboard-box-item-single-->
            </div><!--dashboard-box-itens-->
        </div><!--dashboard-box-->
        <div class="dashboard-box">
            <div class="dashboard-box-title" id="sistemaSidebar">
                <div class="dashboard-box-title-content flexbox float-l">
                    <i class="fas fa-globe"></i>
                    <h2>Sistema</h2>
                </div><!--dashboard-box-title-content-->
                <div class="dashboard-box-title-arrow float-r">
                    <i class="fas fa-angle-down"></i>
                </div><!--dashboard-box-title-arrow-->
                <div class="clear"></div>
            </div><!--dashboard-box-title-->
            <div class="dashboard-box-itens" id="sistemaSidebarBox">
                <div class="dashboard-box-item-single">
                    <a href="?pg=meus-dados">Meus Dados</a>
                </div><!--dashboard-box-item-single-->
                <div class="dashboard-box-item-single">
                    <a href="?pg=user">Usuários</a>
                </div><!--dashboard-box-item-single-->
                <div class="dashboard-box-item-single">
                    <a href="?pg=listar-grupos-perfil">Grupo / Perfil</a>
                </div><!--dashboard-box-item-single-->
            </div><!--dashboard-box-itens-->
        </div><!--dashboard-box-->
        <div class="dashboard-box">
            <div class="dashboard-box-title" id="relatorioSidebar">
                <div class="dashboard-box-title-content flexbox float-l">
                    <i class="fas fa-chart-bar"></i>
                    <h2>Relatórios</h2>
                </div><!--dashboard-box-title-content-->
                <div class="dashboard-box-title-arrow float-r">
                    <i class="fas fa-angle-down"></i>
                </div><!--dashboard-box-title-arrow-->
                <div class="clear"></div>
            </div><!--dashboard-box-title-->
            <div class="dashboard-box-itens" id="relatorioSidebarBox">
                <div class="dashboard-box-item-single">
                    <a href="?pg=listar-relatorios-caixa">Caixa</a>
                </div><!--dashboard-box-item-single-->
            </div><!--dashboard-box-itens-->
        </div><!--dashboard-box-->
    </div><!--dashboard-container-->
</aside>