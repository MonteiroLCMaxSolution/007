<?php
$Config = '/home/maxcomanda/public_html/MaxComanda/conexao-pdo/config.php';
include_once($Config);
?>


<footer class="page-footer" style="background-color: <?php echo $_SESSION['color']; ?>">

  <div class="container footer">
    <div class="left" style="color: <?php echo $_SESSION['color-text']; ?>">
      <strong>Copyright &copy; 2021-<?php echo date('Y'); ?> <a href="https://lcmaxsolution.com.br" class="blue-text text-darken-4"><b>LC MAX SOLUTION</b></a>.</strong> All rights reserved.
    </div>

    <div class="right" style="color: <?php echo $_SESSION['color-text']; ?>">
      Versão <?php echo $version; ?>
    </div>

  </div>






</footer>