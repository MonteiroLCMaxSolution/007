<?php

$ModelUserPermission = 'MaxComanda/model/permission/user-permission.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
	if (file_exists($tag . $ModelUserPermission)) {
		$parametro = 'n';
	} else {
		$tag = '../' . $tag;
	}
}
$ModelUserPermission = $tag . $ModelUserPermission;
include_once($ModelUserPermission);


?>

<header>
	<nav class="fixed" style="background-color: <?php echo $_SESSION['color']; ?>">
		<div class="nav-wrapper">
			<a href="index.php" class="brand-logo center">
				<?php if (isset($_SESSION['logo']) && !empty($_SESSION['logo'])) { ?>
					<img src="<?php echo $uploads; ?>/logo/<?php echo $_SESSION['logo']; ?>" width="130px" height="68px">
				<?php } else { ?>
					<img src="../../../MaxComanda/uploads/logo/logo-header.png" width="130px">
				<?php } ?>
			</a>

			<?php if (!isset($_GET['firstCompany'])) { ?>

				<!-- Botão - Menu Mobile -->
				<a href="#" data-target="header-left-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>



				<!-- Menu Desktop - Esquerda -->
				<ul id="header-left" class="left hide-on-med-and-down">




					<?php if ($ROW_Perm_Register->search == 'S' || $ROW_Perm_Register->include == 'S' || $ROW_Perm_Register->edit == 'S') { ?>

						<!-- Dropdown Cadastro -->
						<li><a class="dropdown-trigger" data-target="dropdownRegisterDesktop" style="color: <?php echo $_SESSION['color-text']; ?>">Cadastro<i class="material-icons right">arrow_drop_down</i></a></li>

					<?php } ?>

					<?php if ($ROW_Perm_Orders->search == 'S' || $ROW_Perm_Orders->include == 'S' || $ROW_Perm_Orders->edit == 'S') { ?>

						<!-- Dropdown Pedidos -->
						<li><a class="dropdown-trigger" data-target="dropdownOrderDesktop" style="color: <?php echo $_SESSION['color-text']; ?>">Pedidos<i class="material-icons right">arrow_drop_down</i></a></li>

					<?php } ?>


					<?php if ($ROW_Perm_Monitor->search == 'S' || $ROW_Perm_Monitor->include == 'S' || $ROW_Perm_Monitor->edit == 'S') { ?>

						<!-- Dropdown Monitor -->
						<li><a class="dropdown-trigger" data-target="dropdownMonitorDesktop" style="color: <?php echo $_SESSION['color-text']; ?>">Monitor<i class="material-icons right">arrow_drop_down</i></a></li>

					<?php } ?>

					<?php if ($ROW_Perm_System->search == 'S' || $ROW_Perm_System->include == 'S' || $ROW_Perm_System->edit == 'S') { ?>


						<!-- Dropdown Sistema -->
						<li><a class="dropdown-trigger" data-target="dropdownSystemDesktop" style="color: <?php echo $_SESSION['color-text']; ?>">Sistema<i class="material-icons right">arrow_drop_down</i></a></li>

					<?php } ?>





				</ul> <!-- Menu Desktop - Esquerda -->

			<?php } ?>

			<!-- Menu Desktop Direita-->
			<ul id="header-right" class="right">
				<a style="color: <?php echo $_SESSION['color-text']; ?>" onclick="logout()"><i class="material-icons" style="font-size: 35px">meeting_room</i></a>
			</ul>
			<div class="progress <?php echo $_SESSION['color']; ?>">
				<div class="indeterminate" hidden id="loading"></div>
			</div>
		</div>
	</nav>


	<!-- DROPDOWN DESKTOP -->

	<!-- Dropdown Cadastro -->
	<ul id="dropdownRegisterDesktop" class="dropdown-content">

		<?php if ($ROW_Perm_Register_Cashier->search == 'S' || $ROW_Perm_Register_Cashier->include == 'S' || $ROW_Perm_Register_Cashier->edit == 'S') { ?>
			<li><a href="?pg=cashier">Caixas</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Register_Category->search == 'S' || $ROW_Perm_Register_Category->include == 'S' || $ROW_Perm_Register_Category->edit == 'S') { ?>
			<li><a href="?pg=category">Categorias</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Register_Client->search == 'S' || $ROW_Perm_Register_Client->include == 'S' || $ROW_Perm_Register_Client->edit == 'S') { ?>
			<li><a href="?pg=client">Clientes</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Register_OrderSheet->search == 'S' || $ROW_Perm_Register_OrderSheet->include == 'S' || $ROW_Perm_Register_OrderSheet->edit == 'S') { ?>
			<li><a href="?pg=order-sheet">Comandas</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Register_Company->search == 'S' || $ROW_Perm_Register_Company->include == 'S' || $ROW_Perm_Register_Company->edit == 'S') { ?>
			<li><a href="?pg=company">Empresas</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Register_Provider->search == 'S' || $ROW_Perm_Register_Provider->include == 'S' || $ROW_Perm_Register_Provider->edit == 'S') { ?>
			<li><a href="?pg=provider">Fornecedores</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Register_Location->search == 'S' || $ROW_Perm_Register_Location->include == 'S' || $ROW_Perm_Register_Location->edit == 'S') { ?>
			<li><a href="?pg=location">Locais - Produtos</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Register_Table->search == 'S' || $ROW_Perm_Register_Table->include == 'S' || $ROW_Perm_Register_Table->edit == 'S') { ?>
			<li><a href="?pg=table">Mesas</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Register_Products->search == 'S' || $ROW_Perm_Register_Products->include == 'S' || $ROW_Perm_Register_Products->edit == 'S') { ?>
			<li><a href="?pg=product">Produtos</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Register_Promotion->search == 'S' || $ROW_Perm_Register_Promotion->include == 'S' || $ROW_Perm_Register_Promotion->edit == 'S') { ?>
			<li><a href="?pg=promotion">Promoção</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Register_Subcategory->search == 'S' || $ROW_Perm_Register_Subcategory->include == 'S' || $ROW_Perm_Register_Subcategory->edit == 'S') { ?>
			<li><a href="?pg=subcategory">SubCategorias</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Register_Supply->search == 'S' || $ROW_Perm_Register_Supply->include == 'S' || $ROW_Perm_Register_Supply->edit == 'S') { ?>
			<li><a href="?pg=supply">Suprimentos</a></li>
		<?php } ?>
	</ul> <!-- Dropdown Cadastro -->


	<!-- Dropdown Pedidos -->
	<ul id="dropdownOrderDesktop" class="dropdown-content">

		<?php if ($ROW_Perm_Orders_PDV->search == 'S' || $ROW_Perm_Orders_PDV->include == 'S' || $ROW_Perm_Orders_PDV->edit == 'S') { ?>
			<li><a href="?pg=PDV">PDV</a></li>
		<?php } ?>


		<li hidden><a href="?pg=order">Pedidos</a></li>
	</ul> <!-- Dropdown Pedidos -->

	<!-- Dropdown Monitor -->
	<ul id="dropdownMonitorDesktop" class="dropdown-content">

		<?php if ($ROW_Perm_Monitor_Counter->search == 'S' || $ROW_Perm_Monitor_Counter->include == 'S' || $ROW_Perm_Monitor_Counter->edit == 'S') { ?>
			<li><a href="?pg=order-counter">Balcão</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Monitor_Kitchen->search == 'S' || $ROW_Perm_Monitor_Kitchen->include == 'S' || $ROW_Perm_Monitor_Kitchen->edit == 'S') { ?>
			<li><a href="?pg=order-kitchen">Cozinha</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Monitor_Table->search == 'S' || $ROW_Perm_Monitor_Table->include == 'S' || $ROW_Perm_Monitor_Table->edit == 'S') { ?>
			<li><a href="?pg=order-table">Mesas</a></li>
		<?php } ?>

	</ul> <!-- Dropdown Monitor -->

	<!-- Dropdown Sistema -->
	<ul id="dropdownSystemDesktop" class="dropdown-content">
		<li><a href="?pg=data-user&idUser=<?php echo $_SESSION['id_user']; ?>">Meus Dados</a></li>

		<?php if ($ROW_Perm_System_User->search == 'S' || $ROW_Perm_System_User->include == 'S' || $ROW_Perm_System_User->edit == 'S') { ?>
			<li><a href="?pg=user">Usuários</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_System_Permission->search == 'S' || $ROW_Perm_System_Permission->include == 'S' || $ROW_Perm_System_Permission->edit == 'S') { ?>
			<li><a href="?pg=profile">Grupo / Perfil</a></li>
		<?php } ?>
	</ul> <!-- Dropdown Sistema -->








	<!-- DROPDOWN MOBILE -->

	<!-- Menu Mobile Esquerda-->
	<ul id="header-left-mobile" class="sidenav">
		<!-- Imagem Perfil -->
		<li>
			<div class="user-view center" style="background-color: <?php echo $_SESSION['color']; ?>">
				<div class="background">
				</div>
				<?php if (isset($_SESSION['userImage']) && !empty($_SESSION['userImage'])) { ?>
					<a href="?pg=data-user&idUser=<?php echo $_SESSION['id_user']; ?>"><img class="circle left" src="<?php echo $uploads; ?>/userImage/<?php echo $_SESSION['userImage']; ?>"></a>
				<?php } else { ?>
					<a href="?pg=data-user&idUser=<?php echo $_SESSION['id_user']; ?>"><img class="circle left" src="../../../MaxComanda/uploads/userImage/userImage.png"></a>
				<?php } ?>
				<a href="?pg=data-user&idUser=<?php echo $_SESSION['id_user']; ?>"><span class="name" style="color: <?php echo $_SESSION['color-text']; ?>"><?php echo $_SESSION['name_user']; ?></span></a>
				<a href="?pg=data-user&idUser=<?php echo $_SESSION['id_user']; ?>"><span class="email" style="color: <?php echo $_SESSION['color-text']; ?>"><?php echo $_SESSION['user_mail']; ?></span></a>
			</div>
		</li> <!-- Imagem Perfil -->


		<?php if ($ROW_Perm_Register->search == 'S' || $ROW_Perm_Register->include == 'S' || $ROW_Perm_Register->edit == 'S') { ?>
			<!-- Dropdown Cadastro -->
			<li><a class="dropdown-trigger" data-target="dropdownRegisterMobile">Cadastro<i class="material-icons right">arrow_drop_down</i></a></li>
			<li>
				<div class="divider"></div>
			</li>
		<?php } ?>

		<?php if ($ROW_Perm_Orders->search == 'S' || $ROW_Perm_Orders->include == 'S' || $ROW_Perm_Orders->edit == 'S') { ?>
			<!-- Dropdown Pedidos -->
			<li><a class="dropdown-trigger" data-target="dropdownOrderMobile">Pedidos<i class="material-icons right">arrow_drop_down</i></a></li>
			<li>
				<div class="divider"></div>
			</li>
		<?php } ?>


		<?php if ($ROW_Perm_Monitor->search == 'S' || $ROW_Perm_Monitor->include == 'S' || $ROW_Perm_Monitor->edit == 'S') { ?>
			<!-- Dropdown Monitor -->
			<li><a class="dropdown-trigger" data-target="dropdownMonitorMobile">Monitor<i class="material-icons right">arrow_drop_down</i></a></li>
			<li>
				<div class="divider"></div>
			</li>
		<?php } ?>

		<?php if ($ROW_Perm_System->search == 'S' || $ROW_Perm_System->include == 'S' || $ROW_Perm_System->edit == 'S') { ?>
			<!-- Dropdown Sistema -->
			<li><a class="dropdown-trigger" data-target="dropdownSystemMobile">Sistema<i class="material-icons right">arrow_drop_down</i></a></li>
		<?php } ?>


	</ul> <!-- Menu Mobile Esquerda-->

	<!-- Dropdown Cadastro Mobile -->
	<ul id="dropdownRegisterMobile" class="dropdown-content">


		<li><a class="subheader center">Produtos</a></li>

		<?php if ($ROW_Perm_Register_Products->search == 'S' || $ROW_Perm_Register_Products->include == 'S' || $ROW_Perm_Register_Products->edit == 'S') { ?>
			<li><a href="?pg=product">Cadastro de Produtos</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Register_Supply->search == 'S' || $ROW_Perm_Register_Supply->include == 'S' || $ROW_Perm_Register_Supply->edit == 'S') { ?>
			<li><a href="?pg=supply">Suprimentos</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Register_Location->search == 'S' || $ROW_Perm_Register_Location->include == 'S' || $ROW_Perm_Register_Location->edit == 'S') { ?>
			<li><a href="?pg=location">Locais - Produtos</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Register_Promotion->search == 'S' || $ROW_Perm_Register_Promotion->include == 'S' || $ROW_Perm_Register_Promotion->edit == 'S') { ?>
			<li><a href="?pg=promotion">Promoção</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Register_Category->search == 'S' || $ROW_Perm_Register_Category->include == 'S' || $ROW_Perm_Register_Category->edit == 'S') { ?>
			<li><a href="?pg=category">Categorias</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Register_Subcategory->search == 'S' || $ROW_Perm_Register_Subcategory->include == 'S' || $ROW_Perm_Register_Category->edit == 'S') { ?>
			<li><a href="?pg=subcategory">SubCategorias</a></li>
		<?php } ?>

		<li class="divider"></li>



		<li><a class="subheader center">Clientes</a></li>
		<?php if ($ROW_Perm_Register_Client->search == 'S' || $ROW_Perm_Register_Client->include == 'S' || $ROW_Perm_Register_Client->edit == 'S') { ?>
			<li><a href="?pg=client">Cadastro de Clientes</a></li>
		<?php } ?>
		<li class="divider"></li>


		<li><a class="subheader center">Fornecedores</a></li>
		<?php if ($ROW_Perm_Register_Provider->search == 'S' || $ROW_Perm_Register_Provider->include == 'S' || $ROW_Perm_Register_Provider->edit == 'S') { ?>
			<li><a href="?pg=provider">Cadastro de Fornecedores</a></li>
		<?php } ?>
		<li class="divider"></li>

		<li><a class="subheader center">Empresas</a></li>
		<?php if ($ROW_Perm_Register_Company->search == 'S' || $ROW_Perm_Register_Company->include == 'S' || $ROW_Perm_Register_Company->edit == 'S') { ?>
			<li><a href="?pg=company">Empresas</a></li>
		<?php } ?>
		<li class="divider"></li>

		<li><a class="subheader center">Parâmetros</a></li>
		<?php if ($ROW_Perm_Register_OrderSheet->search == 'S' || $ROW_Perm_Register_OrderSheet->include == 'S' || $ROW_Perm_Register_OrderSheet->edit == 'S') { ?>
			<li><a href="?pg=order-sheet">Comandas</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Register_Table->search == 'S' || $ROW_Perm_Register_Table->include == 'S' || $ROW_Perm_Register_Table->edit == 'S') { ?>
			<li><a href="?pg=table">Mesas</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Register_Cashier->search == 'S' || $ROW_Perm_Register_Cashier->include == 'S' || $ROW_Perm_Register_Cashier->edit == 'S') { ?>
			<li><a href="?pg=cashier">Caixas</a></li>
		<?php } ?>

		<li class="divider"></li>

	</ul> <!-- Dropdown Cadastro Mobile -->

	<!-- Dropdown Pedidos -->
	<ul id="dropdownOrderMobile" class="dropdown-content">
		<?php if ($ROW_Perm_Orders_PDV->search == 'S' || $ROW_Perm_Orders_PDV->include == 'S' || $ROW_Perm_Orders_PDV->edit == 'S') { ?>
			<li><a href="?pg=PDV">PDV</a></li>
		<?php } ?>

		<li hidden><a href="?pg=order">Pedidos</a></li>
	</ul> <!-- Dropdown Pedidos Mobile -->

	<!-- Dropdown Monitor -->
	<ul id="dropdownMonitorMobile" class="dropdown-content">
		<?php if ($ROW_Perm_Monitor_Table->search == 'S' || $ROW_Perm_Monitor_Table->include == 'S' || $ROW_Perm_Monitor_Table->edit == 'S') { ?>
			<li><a href="?pg=order-table">Mesas</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Monitor_Kitchen->search == 'S' || $ROW_Perm_Monitor_Kitchen->include == 'S' || $ROW_Perm_Monitor_Kitchen->edit == 'S') { ?>
			<li><a href="?pg=order-kitchen">Cozinha</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_Monitor_Counter->search == 'S' || $ROW_Perm_Monitor_Counter->include == 'S' || $ROW_Perm_Monitor_Counter->edit == 'S') { ?>
			<li><a href="?pg=order-counter">Balcão</a></li>
		<?php } ?>

	</ul> <!-- Dropdown Monitor Mobile-->

	<!-- Dropdown Sistema -->
	<ul id="dropdownSystemMobile" class="dropdown-content">
		<li><a class="subheader center">Acesso</a></li>
		<?php if ($ROW_Perm_System_User->search == 'S' || $ROW_Perm_System_User->include == 'S' || $ROW_Perm_System_User->edit == 'S') { ?>
			<li><a href="?pg=user">Cadastro de Usuários</a></li>
		<?php } ?>

		<?php if ($ROW_Perm_System_Permission->search == 'S' || $ROW_Perm_System_Permission->include == 'S' || $ROW_Perm_System_Permission->edit == 'S') { ?>
			<li><a href="?pg=profile">Grupo / Perfil</a></li>
		<?php } ?>

	</ul> <!-- Dropdown Sistema Mobile-->
</header>








<script src="<?php echo $lib; ?>/js/user/functions.js"></script>


