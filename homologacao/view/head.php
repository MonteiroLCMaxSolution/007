<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $lib ?>/css/style.css?<?php echo $_COOKIE['VERSION'];?>">
    <link rel="stylesheet" href="<?= $lib ?>/lib/toast/toast.css?<?php echo $_COOKIE['VERSION'];?>">
    <link rel="stylesheet" href="<?= $lib ?>/css/plugins/calendario/mc-calendar.min.css?'<?= $_COOKIE['VERSION']?> ">
    <link rel="stylesheet" href="<?= $lib ?>/css/plugins/select2/select2.css?'<?= $_COOKIE['VERSION']?>">
    <link rel="stylesheet" href="<?= $lib ?>/css/plugins/switcher/switcher.css?'<?= $_COOKIE['VERSION']?> ">
    <link rel="stylesheet" href="<?= $lib ?>/css/plugins/color-picker/colorPick.min.css?'<?= $_COOKIE['VERSION']?> ">
    <?php 
    foreach($arquivosCSS as $arquivoCSS): ?>
        <link rel="stylesheet" href="<?= $lib.'/'.$arquivoCSS ?>">
    <?php endforeach; ?>
    <script src="https://kit.fontawesome.com/d8d09d30c4.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Open+Sans:wght@600&family=Ubuntu:wght@300;400;700&display=swap" rel="stylesheet">
    <title><?= $tituloSEO ?></title>
    <?php
        $corPrimariaSistema = $_SESSION['color'];
        $corSecundariaSistema = "#ffc400";
        $corTexto = $_COOKIE['color-text'];
    ?>

    <?php
    include "../../".$_SESSION['main_directory']."/css/barra_rolagem/barra_rolagem.php";
    ?> 
</head>