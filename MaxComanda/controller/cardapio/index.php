<?php
if (!isset($_SESSION)) {
    session_start();
}




$MenuModel = $_SERVER['DOCUMENT_ROOT'] . '/MaxComanda/model/menu/menu-model.php';
include_once($MenuModel);


ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

?>

<style>
    html,
    body,
    .block {
        min-height: 50vh;
    }

    nav ul li a:hover,
    nav ul li a.active {
        background-color: rgba(0, 0, 0, .1);
    }

    footer {
        padding-left: 0;
    }

    .pinned {
        z-index: 2;
    }
</style>

<?php
if ($searchCompany->rowCount() > 1 && !isset($_SESSION['idCompany'])) {
    include_once('modal-select-company.php');
} else {
    if ($searchCompany->rowCount() > 1 && isset($_SESSION['idCompany'])) {?>
        <input type="text" id="idCompany" hidden value="<?php echo $_SESSION['idCompany']; ?>">
    <?php } else {?>
        <input type="text" id="idCompany" hidden value="1">
<?php }
}

?>
<div id="listMenu"></div>

<?php if (isset($_SESSION['idCompany']) || $searchCompany->rowCount() == 1) {?>
    <!-- JQuery -->
    <script src="<?php echo $lib; ?>/lib/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function() {
            listMenu();
        });
    </script>
<?php } ?>