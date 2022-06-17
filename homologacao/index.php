<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once 'config.php';
$lib = $_SESSION['main_link'] . $_SESSION['main_directory'];
$directory = explode('/', $_SERVER['PHP_SELF']);
$directory = $directory[1];
$ip_address = getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');

$jsondata = file_get_contents("http://timezoneapi.io/api/ip/?" . $ip_address);

$data = json_decode($jsondata, true);

if ($data['meta']['code'] == '200') {
    echo "City: " . $data['data']['city'] . "<br>";
    echo "Time: " . $data['data']['datetime']['date_time_txt'] . "<br>";
}
include_once $_SESSION['server'].'/model/index/index.php';
?>

<?php
if (!empty($_GET['screen'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo $lib; ?>/css/style.css">
        <link rel="stylesheet" href="<?php echo $lib; ?>/css/login/recuperar-senha/recuperar-senha.css">
        <!--font-awesome-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
        <!--Google fonts-->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Open+Sans:wght@600&family=Ubuntu:wght@300;400;700&display=swap" rel="stylesheet">
        <title>Nova Senha - Max Comanda</title>
    </head>

    <body>

        <section class="recuperar-senha-page">
            <div class="recuperar-senha-box">
                <div class="recuperar-senha-return">
                    <a href="?recover-password="><i class="fas fa-arrow-left"></i> Voltar</a>
                </div>
                <!--recuperar-senha-return-->
                <div class="recuperar-senha-title">
                    <h2>Nova senha</h2>
                    <h3 id="msgFinal">Digite sua nova senha:</h3>
                </div>
                <!--recuperar-senha-title-->
                <div class="recuperar-senha-form">
                    <form>
						<input hidden="hidden" id="recover" value="<?php echo $_GET['recover'];?>"/>
                        <div class="inp-single">
                            <p class="p-email">Nova Senha <span id="msgErrorPassword1"></span></p>
                            <input hidden="hidden" id='https' value="<?php echo  $lib; ?>">
                            <input hidden="hidden" id='directory' value="<?php echo  $directory; ?>">
                            <input type="password" id="password1" onkeyup="ConfirmPassword()">
                        </div>
                        <!--inp-single-->
                        <div class="inp-single">
                            <p class="p-email">Confirme sua nova Senha <span id="msgErrorPassword2"></span></p>
                            <input hidden="hidden" id='https' value="<?php echo  $lib; ?>">
                            <input hidden="hidden" id='directory' value="<?php echo  $directory; ?>">
                            <input type="password" id="password2" onkeyup="ConfirmPassword()">

                        </div>
                        <!--inp-single-->

                    </form>
                    <div style="height: 70px; margin: 10px"><a href="javascript: confirmNewPassword()" id="btnConfirmNewPassword" style="display: none"><button class="btn-recuperar">Confirmar</button></a></div>
                </div>
                <!--recuperar-senha-result-->
            </div>
            <!--recuperar-senha-box-->
        </section>
        <!--recuperar-senha-page-->
        <!-- FUNÇÕES GERAIS - JS -->
        <script src="<?php echo $lib; ?>/js/login/recuperar-senha/validacao.js?<?php echo $_COOKIE['VERSION']; ?>"></script>
    </body>
    <?php
} else {
    if (!empty($_GET['recover-password'])) {
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="<?php echo $lib; ?>/css/style.css">
            <link rel="stylesheet" href="<?php echo $lib; ?>/css/login/recuperar-senha/recuperar-senha.css">
            <!--font-awesome-->
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
            <!--Google fonts-->
            <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Open+Sans:wght@600&family=Ubuntu:wght@300;400;700&display=swap" rel="stylesheet">
            <title>Recuperar senha - Max Comanda</title>

            <!-- TOAST -->
            <link rel="stylesheet" href="<?= $lib ?>/lib/toast/toast.css?<?php echo $_COOKIE['VERSION'];?>">


        </head>

        <body>

            <section class="recuperar-senha-page">
                <div class="recuperar-senha-box">
                    <div class="recuperar-senha-return">
                        <a href="?recover-password="><i class="fas fa-arrow-left"></i> Voltar</a>
                    </div>
                    <!--recuperar-senha-return-->
                    <div class="recuperar-senha-title">
                        <h2>Recuperar senha</h2>
                        <h3>Digite seu email no campo abaixo</h3>
                    </div>
                    <!--recuperar-senha-title-->
                    <div class="recuperar-senha-form">
                        <form>
                            <div class="inp-single">
                                <p class="p-email">Email</p>
                                <input hidden="hidden" id='https' value="<?php echo  $lib; ?>">
                                <input hidden="hidden" id='directory' value="<?php echo  $directory; ?>">
                                <input type="email" id="email-recuperar-senha" onkeyup="validarFormulario()">
                            </div>
                            <!--inp-single-->

                        </form><a href="javascript: searchMail()"><button class="btn-recuperar">Pesquisar</button></a>
                        <div class="clear"></div>
                    </div>
                    <!--recuperar-senha-form-->
                    <div class="recuperar-senha-result">

                    </div>
                    <!--recuperar-senha-result-->
                </div>
                <!--recuperar-senha-box-->
            </section>
            <!--recuperar-senha-page-->
            
            <!-- JQUERY -->
            <script src="<?php echo $lib; ?>/lib/jquery-3.3.1.min.js?<?php echo $_COOKIE['VERSION']; ?>"></script>

            <!-- JQUERY - MÁSCARAS -->
            <script src="<?= $lib ?>/lib/jquery-mask.js?<?PHP echo $_COOKIE['VERSION']; ?>"></script>

            <!-- TOAST -->
            <script src="<?= $lib ?>/lib/toast/toast.js?<?PHP echo $_COOKIE['VERSION']; ?>"></script>

            <!-- FUNÇÕES GERAIS - JS -->
            <script src="<?= $lib ?>/lib/generalFunctions.js?<?PHP echo $_COOKIE['VERSION']; ?>"></script>
            
            <script src="<?php echo $lib; ?>/js/login/recuperar-senha/validacao.js?<?php echo $_COOKIE['VERSION']; ?>"></script>
        </body>
    <?php
    } else { ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="<?= $lib; ?>/css/style.css?<?= $_COOKIE['VERSION']; ?>">
            <link rel="stylesheet" href="<?= $lib; ?>/css/login/login.css?<?= $_COOKIE['VERSION']; ?>">
            <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Open+Sans:wght@600&family=Ubuntu:wght@300;400;700&display=swap" rel="stylesheet">
            <title>Fazer Login - Max Comanda</title>

            <!-- TOAST -->
            <link rel="stylesheet" href="<?= $lib ?>/lib/toast/toast.css?<?= $_COOKIE['VERSION'];?>">

        </head>

        <body>

            <input hidden='hidden' id="directory" value="<?php echo $directory; ?>">
            <input hidden='hidden' id='http' value="<?php echo $_SESSION['main_link']; ?>">
            <input hidden='hidden' id='main_directory' value="<?php echo $_SESSION['main_directory']; ?>">
            <input hidden='hidden' id='server' value="<?php echo $_SESSION['server']; ?>">
            <section class="login-page">
                <div class="login-box flexbox">
                    <div class="login-img w50">
                        <img src="<?php echo $lib; ?>/images/logo-max-comanda.png" alt="">
                    </div>
                    <!--login-img-->
                    <div class="login-form w50">
                        <div class="login-form-title">
                            <h2>Login</h2>
                        </div>
                        <div id="information">Seja bem vindo(a)</div>
                        <!--login-title-->
                        <form class="login-form">
							
							<!--inp-single-->
                            <div class="inp-single">
                                <p>Informe a sua loja</p>
                                <select id="company" >
									
									<?php 
											if($SQL_list_company->rowCount < 0){
												?>
									<option value="0">Nenhum dados da empresa encontrado</option>
									<?php
											}
										while($row_list_company = $SQL_list_company->fetch()){?>
									<option value="<?php echo $row_list_company->id;?>"><?php echo $row_list_company->id.' |'. $row_list_company->name_razao_social;?> </option>
									<?php } ?>
								</select>
                            </div>
                            <div class="inp-single">
                                <p>Email</p>
                                <input id="email" type="email">
                            </div>
                            <!--inp-single-->
                            <div class="inp-single">
                                <p>Senha</p>
                                <input id="password" type="password">
                            </div>
                            <!--inp-single-->
                            <a href="?recover-password=1">Esqueceu sua senha?</a>
                            <a href="javascript: login()"  class="login-btn"><span id="btnLogin">Entrar</span></a>
                        </form>
                    </div>
                    <!--login-form-->
                </div>
                <!--login-box-->
            </section>
            <!--login-page-->

            <!-- JQUERY -->
            <script src="<?php echo $lib; ?>/lib/jquery-3.3.1.min.js?<?php echo $_COOKIE['VERSION']; ?>"></script>

            <!-- JQUERY - MÁSCARAS -->
            <script src="<?= $lib ?>/lib/jquery-mask.js?<?PHP echo $_COOKIE['VERSION']; ?>"></script>

            <!-- TOAST -->
            <script src="<?= $lib ?>/lib/toast/toast.js?<?PHP echo $_COOKIE['VERSION']; ?>"></script>

            <!-- FUNÇÕES GERAIS - JS -->
            <script src="<?= $lib ?>/lib/generalFunctions.js?<?PHP echo $_COOKIE['VERSION']; ?>"></script>


            <script src="<?php echo $lib; ?>/js/user/functions.js?<?php echo $_COOKIE['VERSION']; ?>"></script>
            <script src="<?php echo $lib; ?>/js/variables.js?<?php echo $_COOKIE['VERSION']; ?>"></script>

            <script src="https://maxcomanda.com.br/homologacao/js/ws/ws.js?<?php echo $_COOKIE['VERSION']; ?>"></script>
        </body>

<?php }
}
?>












        </html>