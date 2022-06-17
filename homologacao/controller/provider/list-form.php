<?php

if (!isset($_SESSION)) {
    session_start();
}
if(isset($_GET['directory'])){
	$directory = $_GET['directory'];
} else{
	$directory = explode('/', $_SERVER['PHP_SELF']);
	$directory = $directory[1];
}

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

$ModelUserPermission = $_SESSION['server'].'/model/permission/user-permission.php';
include_once($ModelUserPermission);

if ($ROW_Perm_Register_Company->search == 'N' && $ROW_Perm_Register_Company->include == 'N' && $ROW_Perm_Register_Company->edit == 'N') {
    $modalPermission = $_SESSION['server']. '/view/modalPermission.php';
    include_once($modalPermission);
}

?>
<section>
    <nav style="max-height: 37px; line-height: 30px; background-color: <?php echo $_SESSION['color']; ?>">
        <div class="container">
            <div class="center pageBreadcrumb">
                <a href="index.php" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>">Home</a>
                <a href="#" class="breadcrumb" style="color: <?php echo $_SESSION['color-text']; ?>"><?php echo $pageName; ?></a>
            </div>
        </div>
    </nav>
</section>

<section>
    <div class="row">
        <div class="col s12">
            <div class="card hoverable" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">

                <div class="card-content">
                    <div class="row">
                        <div class="input-field col s10">
                            <input id="providerName" type="text">
                            <label for="providerName">Nome do Fornecedor</label>
                            <span class="helper-text">Pesquise pelo Nome</span>
                        </div>
                        <div class="col s1 left">
                            <br />
                            <a class="btn-floating waves-effect waves-light blue tooltipped" data-tooltip="Pesquisar" onclick="searchProvider()"><i class="material-icons">search</i></a>
                        </div>
                    </div>

                </div>
                <?php if ($ROW_Perm_Register_Provider->include == 'S') { ?>
                <a href="?pg=data-provider" class="btn-floating halfway-fab waves-effect waves-light green tooltipped" data-tooltip="Adicionar"><i class="material-icons">add</i></a>
                <?php } ?>

            </div>
        </div>
    </div>
</section>

<section>
    <div class="row">
        <div class="col s12">
            <div class="card-panel hoverable" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">
                <div id="listProvider"></div>
            </div>
        </div>
    </div>
</section>