<?php
if (!isset($_SESSION)) {
	session_start();
}
include_once 'config.php';

$lib = $_SESSION['main_link'].'/'.$_SESSION['main_directory'];
$directory = explode('/', $_SERVER['PHP_SELF']);
$directory = $directory[1];

$ip_address = getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');

$jsondata = file_get_contents("http://timezoneapi.io/api/ip/?" . $ip_address);

$data = json_decode($jsondata, true);

if ($data['meta']['code'] == '200') {
  echo "City: " . $data['data']['city'] . "<br>";
  echo "Time: " . $data['data']['datetime']['date_time_txt'] . "<br>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $lib; ?>/lib/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo $lib; ?>/lib/materialize-v1.0.0/css/materialize.css">
  <link rel="stylesheet" href="<?php echo $lib; ?>/lib/custom/style-custom.css">
  <!-- Select 2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<style>
  .vertical-align-center {
    position: absolute;
    top: 50%;
    width: 100%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%)
  }
</style>

<body class="blue">
  <input hidden="hidden" id="directory" value="<?php echo $directory; ?>">
  <input hidden="hidden" id='http' value="<?php echo $_SESSION['main_link']; ?>">
  <input hidden="hidden" id='main_directory' value="<?php echo $_SESSION['main_directory'];?>">
  <input hidden="hidden" id='server' value="<?php echo $_SESSION['server'];?>">

  <input  hidden="hidden" id='module' value="" >
  <div class="row vertical-align-center">
    <div class="col s12 m8 l4 offset-m2 offset-l4">
      <div class="col s12 card-panel">
        <div class="col s12">
          <h4 class="center"><img src="<?php echo $lib; ?>/uploads/logo/logo-index.png" width="200px"></h4>
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
                <div id="information"></div>
              </div>
              <div class="input-field col s12">
                <span id="btnLogin" onClick="login()" class="btn waves-effect waves-light col s12 blue darken-4">Entrar</span>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>





  <script src="<?php echo $lib; ?>/lib/jquery-3.3.1.min.js"></script>

  <script>
    $(document).keypress(function(e) {
      if (e.which == 13) $('#btnLogin').click();
    });
  </script>

  <script src="<?php echo $lib; ?>/lib/jquery-mask.js"></script>
  <!-- Select 2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="<?php echo $lib; ?>/lib/materialize-v1.0.0/js/materialize.js"></script>
  <script src="<?php echo $lib; ?>/lib/custom/script-custom.js"></script>
  <script src="<?php echo $lib; ?>/js/user/functions.js"></script>
  <script src="../js/ws/ws.js"></script>
</body>

</html>