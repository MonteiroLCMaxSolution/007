<header>
    <div class="dashboard-icon float-l">
        <i class="fas fa-bars" id="sidebar-icon"></i>
    </div><!--dashboard-icon-->
    <div class="header-logo">
        <a href="?pg=home" title="Ir para o início">
			<?php
			if(empty($_SESSION['logo'])){
				$imageCompany = INCLUDE_HOMOLOGACAO."images/logo-max-comanda.png";
			}else{
				$imageCompany = $_SESSION['server_name'].$directory.'/uploads/logo/'.$_SESSION['logo'];
			}
			?>
            <img src="<?= $imageCompany ?>" alt="">
			
			
        </a>
    </div><!--header-logo-->
    <div class="logout-header-icon float-r">
        <a href="javascript: logout()"><i class="fas fa-door-open"></i></a>
    </div><!--logout-header-icon-->
    <div class="clear"></div>
</header>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../../<?php echo $_COOKIE['main_directory'];?>/js/user/functions.js"></script>