
<?php

if (!isset($_SESSION)) {
    session_start();
}

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
$ConexaoMysql = $_SESSION['server'].'/model/recover-password/recover-password.php';
include_once($ConexaoMysql);

if(!empty($user_name)){
	$row_data_user = $SQL_data_user->fetch();
	
	// DISPARA O EMAIL PARA O USUÁRIO RECUPERAR A SUA SENHA - MONTEIRO - 16/05/2022
		require_once("lib/PHPMailer/PHPMailerAutoload.php");
      
// Inicia a classe PHPMailer
// Inicia a classe PHPMailer
$mail = new PHPMailer(true);

// Define os dados do servidor e tipo de conex�o
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsSMTP(); // Define que a mensagem ser� SMTP
 
try {
     $mail->Host = 'lcmaxsolution.com.br';
     //$mail->Charset = 'UTF-8';
     $mail->SMTPAuth   = true;  // Usar autentica��o SMTP (obrigat�rio para smtp.seudom�nio.com.br)
     $mail->Port       = '465'; //  Usar 587 porta SMTP
     $mail->SMTPSecure = 'ssl';
     $mail->Username = 'leonidas@lcmaxsolution.com.br'; // Usu�rio do servidor SMTP (endere�o de email)
     $mail->Password = '0_~TYFhpRTW?';//'Lcmax@leonardo2019'; // Senha do servidor SMTP (senha do email usado)


     $mail->SetFrom('leonidas@lcmaxsolution.com.br', "MAXCOMANDA - RECUPERAR A SENHA DO USUÁRIO"); //Seu e-mail
     $mail->Subject = (htmlspecialchars_decode("MAXCOMANDA - RECUPERAR A SENHA DO USUÁRIO"));//Assunto do e-mail
 
 
     
    $mail->AddAddress('leonidas@lcmaxsolution.com.br', (htmlspecialchars_decode("MAXCOMANDA - RECUPERAR A SENHA DO USUÁRIO")));
   $mail->AddCC('foxs.sbc11@gmail.com'); // Copia
      // $mail->AddBCC('');
   //  $mail->AddBCC('');
     $mail->AddBCC($user_email, '"MAXCOMANDA - RECUPERAR A SENHA DO USUÁRIO"'); // C�pia Oculta
     
     //$mail->AddAttachment('images/phpmailer.gif');      // Adicionar um anexo
    $HTML = utf8_decode('<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sem título</title>
</head>

<body style="background: #053576">

	<table border="0" cellpadding="0" cellspacing="0" width="100%" background="white" >
 <tr>
  <td align="center" valign="top"><div style="width: 100%;background: #053576"> <img src="https://maxcomanda.com.br/homologacao/img/logo.png"></div></td>
  </tr>
 <tr>
   <td valign="top" bgcolor=white style="padding: 30px 30px 30px 30px;"><span style="color:dimgrey; font-size: 19px">Ola, <strong>'.(htmlspecialchars_decode($user_name)).'!</strong></span></td>
   </tr>
 <tr>
   <td valign="top" bgcolor=white style="padding: 30px 30px 30px 30px; color: #747474; text-align: center"><p>Foi solicitado através de nosso sistema a intenção de recuperar a Senha.</p><p> Ao Clicar no link abaixo, você será redirecionado para uma tela onde poderá alterar a sua senha!</p></td>
 </tr>
 <tr>
   <td valign="top"><div style="background: #78BAF0; height: 50px;line-height: 50px; text-align: center"><a style="text-decoration: none;color:#A4090B" href="'.$_SESSION['server_name'].$user_folder.'/?screen=1&recover='.$key_password.'"><strong>Clique aqui para recuperar sua senha</strong></a></div></td>
 </tr>
 <tr>
   <td valign="top">&nbsp;</td>
   
 </tr>
 <tr>
   <td valign="top" bgcolor=white style="padding: 30px 30px 30px 30px; color: #747474;text-align: center"><p>Não se preocupe, assim que você criar a nova senha, a antiga será apagada automaticamente, ok?</p><p> Escolha uma senha forte para manter sua conta segura.</p><p></p><p>
			Se você não solicitou a alteração de senha, ignore este e-mail.</p><p>Conte sempre com a gente!</p>
			<p>
Equipe MaxComanda 💙</p></td>
 </tr>
 <tr>
   <td valign="top">&nbsp;</td>
 </tr>
</table>

</body>
</html>
');
 ///' .utf8_decode(htmlspecialchars_decode($assunto)). '
     //Define o corpo do email
     $mail->MsgHTML($HTML); 

 
     $mail->Send();
    //caso apresente algum erro � apresentado abaixo com essa exce��o.
     //echo 'enviou';
     $msg = 'Email enviado!';
    }catch (phpmailerException $e) {
        $msg = 'não enviou Email!';
      //echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
}	
	// FIM - DISPARA O EMAIL PARA O USUÁRIO RECUPERAR A SUA SENHA - MONTEIRO - 16/05/2022
	
	$cod = 2;
	
}else{
	$cod = 1;
	$msg = "Email não encontrado!";
}

$result = array('cod' => $cod,'msg'=> $msg);
echo json_encode($result);
exit();
?>