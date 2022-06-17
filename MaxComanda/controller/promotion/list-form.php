<?php

$ModelPromotion = 'MaxComanda/model/promotion/promotion-model.php';

$parametro = 's';
$tag = '';
while ($parametro != 'n') {
    if (file_exists($tag . $ModelPromotion)) {
        $parametro = 'n';
    } else {
        $tag = '../' . $tag;
    }
}
$ModelPromotion = $tag . $ModelPromotion;
include_once($ModelPromotion);

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

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

if ($ROW_Perm_Register_Promotion->search == 'N' && $ROW_Perm_Register_Promotion->include == 'N' && $ROW_Perm_Register_Promotion->edit == 'N') {
    $modalPermission = $_SERVER['DOCUMENT_ROOT'] . '/MaxComanda/view/modalPermission.php';
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
                        <div class="input-field col s12 m4 l4">
                            </br>
                            <select class="select2 browser-default" name="product" id="product">
                                <option value="">Selecione o produto</option>
                                <?php while ($row = $SQL_list_products->fetch()) { ?>
                                    <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="input-field col s12 m3 l3">
                            <label for="start_date" class="active">Data - Início</label>
                            <input type="text" class="datepicker" id="start_date" name="start_date">
                            <span class="helper-text"></span>
                        </div>

                        <div class="input-field col s12 m3 l3">
                            <label for="end_date" class="active">Data - Fim</label>
                            <input type="text" class="datepicker" id="end_date" name="end_date">
                            <span class="helper-text"></span>
                        </div>

                        <div class="col s12 m2 l2 center">
                            <br />
                            <a class="btn-floating waves-effect waves-light blue tooltipped" data-tooltip="Pesquisar" onclick="searchPromotion()"><i class="material-icons">search</i></a>
                        </div>
                    </div>

                </div>

                <?php if ($ROW_Perm_Register_Promotion->include == 'S') { ?>
                <a href="?pg=data-promotion" class="btn-floating halfway-fab waves-effect waves-light green tooltipped" data-tooltip="Adicionar"><i class="material-icons">add</i></a>
                <?php } ?>

            </div>
        </div>
    </div>
</section>

<section>
    <div class="row">
        <div class="col s12">
            <div class="card-panel hoverable" style="border-top: 3px solid <?php echo $_SESSION['color']; ?>">
                <div id="listPromotion"></div>
            </div>
        </div>
    </div>
</section>