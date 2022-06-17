<?php
$Config = '/home/maxcomanda/public_html/MaxComanda/conexao-pdo/config.php';
include_once($Config);

$MenuModel = $_SERVER['DOCUMENT_ROOT'] . '/MaxComanda/model/menu/menu-model.php';
include_once($MenuModel);

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


?>


<footer class="page-footer" style="background-color: <?php echo $color_header; ?>">

  <div class="container footer">
    <div class="left" style="color: <?php echo $color_text; ?>">
      <strong>Copyright &copy; 2021-<?php echo date('Y'); ?> <a href="https://lcmaxsolution.com.br" style="color: <?php echo $color_text; ?>"><b>LC MAX SOLUTION</b></a>.</strong> All rights reserved.
    </div>

    <div class="right" style="color: <?php echo $color_text; ?>">
      Versão <?php echo $version; ?>
    </div>

  </div>






</footer>