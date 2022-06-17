<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login/recuperar-senha/recuperar-senha.css">
    <!--font-awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!--Google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Open+Sans:wght@600&family=Ubuntu:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Recuperar senha - Max Comanda</title>
</head>
<body>
    <section class="recuperar-senha-page">
        <div class="recuperar-senha-box">
            <div class="recuperar-senha-return">
                <a href="login.php"><i class="fas fa-arrow-left"></i> Voltar</a>
            </div><!--recuperar-senha-return-->
            <div class="recuperar-senha-title">
                <h2>Recuperar senha</h2>
                <h3>Digite seu email no campo abaixo</h3>
            </div><!--recuperar-senha-title-->
            <div class="recuperar-senha-form">
                <form action="">
                    <div class="inp-single">
                        <p class="p-email">Email</p>
                        <input type="email" id="email-recuperar-senha" onkeyup="validarFormulario()">
                    </div><!--inp-single-->
                    <button id="pesquisar-email-recuperar-senha">Pesquisar</button>
                </form>
            </div><!--recuperar-senha-form-->
            <div class="recuperar-senha-result">
                <div class="recuperar-senha-result-title">
                    <h2>Conta(s) vinculada(s) à esse email:</h2>
                </div><!--recuperar-senha-result-title-->
                <div class="recuperar-senha-result-single">
                    <h3>Nome: <b>Lanchonete Rocket</b></h3>
                    <h3>CNPJ: <b>00.000.000/0000-00</b></h3>
                    <a href="#">Recuperar senha</a>
                </div><!--recuperar-senha-result-single-->
                <div class="recuperar-senha-result-single">
                    <h3>Nome: <b>Padaria Maria</b></h3>
                    <h3>CNPJ: <b>99.999.999/9999-99</b></h3>
                    <a href="#">Recuperar senha</a>
                </div><!--recuperar-senha-result-single-->
            </div><!--recuperar-senha-result-->
        </div><!--recuperar-senha-box-->
    </section><!--recuperar-senha-page-->
    <script src="js/login/recuperar-senha/validacao.js"></script>
</body>
</html>