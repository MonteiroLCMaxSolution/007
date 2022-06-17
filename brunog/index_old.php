<?php
$clientService = 'c94f21e96bf804c7c037c055c3dcc2e732929a03';
$pasta = '/leus/ ';
?>
<div id="divLogado" style="display: none">
<!DOCTYPE html>
<html lang="pt-br">
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="../MaxComanda/lib/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../MaxComanda/lib/materialize-v1.0.0/css/materialize.css">
  <link rel="stylesheet" href="../MaxComanda/lib/custom/style-custom.css">
 </head>
<style>
  #login-page {
    position: relative;
    top: 50%;
    transform: translateY(-50%);
  }
</style>
<body ng-app="mainModule" ng-controller="mainController" class="orange lighten-2" onLoad="payment_status('<?php echo $clientService;?>')">
	<input id="directory" hidden="hidden" value="<?php echo $pasta;?>">
  <div id="login-page" class="row">
    <div class="col s10 m6 l6 xl4 push-s1 push-m3 push-l3 push-xl4 card-panel">
      <h4 class="center"><a class="orange-text"><b>MA<i class="material-icons icon-food" style="font-size: 37px; font-weight: bold">
              restaurant_menu</i></b>Comanda</a></h4>
      <form class="login-form">
        <div class="row">
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">mail_outline</i>
            <input class="validate" id="email" type="email">
            <label for="email" data-error="wrong" data-success="right">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">lock_outline</i>
            <input id="password" type="password">
            <label for="password">Senha</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <div id="information">Seja bem vindo!</div>
          </div>
			<div class="input-field col s12">
            <span class="btn waves-effect waves-light col s12 orange" onClick="login()">Entrar</span>
          </div>
        </div>

      </form>
    </div>
  </div>
  <script src="../MaxComanda/lib/jquery-3.3.1.min.js"></script>
  <script src="../MaxComanda/lib/materialize-v1.0.0/js/materialize.js"></script>
  <script src="../MaxComanda/lib/custom/script-custom.js"></script>
  <script src="../MaxComanda/js/user/functions.js"></script>
	<script src="../js/ws/ws.js"></script>
</body>
</html>
	</div>
	<div id="divNegado" style="display: none">
	acesso negado</div>