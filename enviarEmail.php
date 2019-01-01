<?php
date_default_timezone_set('America/Sao_Paulo');
$Nome		= $_POST["nome"];	// Pega o valor do campo Nome
$Email		= $_POST["email"];	// Pega o valor do campo Email
$Assunto    = $_POST["assunto"]; //Pega o valor do campo Assunto
$Mensagem	= $_POST["mensagem"];	// Pega os valores do campo Mensagem
//$Assunto 	= "Contato Site";
$para 	= "maluupereiraa@gmail.com";

// Variável que junta os valores acima e monta o corpo do email
	
require_once("js/components/phpmailer/class.phpmailer.php");

	$Vai = file_get_contents('templates/email/template-email.html'); 
    $Vai = str_replace('%nome%', $Nome, $Vai); 
	$Vai = str_replace('%email%', $Email, $Vai); 
	//$Vai = str_replace('%assunto%'), $Assunto, $Vai);
	$Vai = str_replace('%mensagem%', $Mensagem, $Vai); 

define('GUSER', $para);	// <-- Insira aqui o seu GMail
define('GPWD', 'magicous24@..!!!');		// <-- Insira aqui a senha do seu GMail

function smtpmailer($para, $Email, $Nome, $Assunto, $Vai) { 
	global $error;
	$mail = new PHPMailer();
	$mail->IsSMTP();		// Ativar SMTP
	$mail->SMTPDebug = 0;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
	$mail->SMTPAuth = true;		// Autenticação ativada
	$mail->SMTPSecure = 'tls';	// SSL REQUERIDO pelo GMail
	$mail->Host = 'smtp.gmail.com';	// SMTP utilizado
	$mail->Port = 587;  		// A porta 587 deverá estar aberta em seu servidor
	$mail->Username = GUSER;
	$mail->Password = GPWD;
	$mail->SetFrom($Email, $Nome);
	$mail->Subject = $Assunto;
	$mail->Body = $Vai;
	$mail->AddCC($Email, $Nome);
	$mail->IsHTML(true);
	$mail->AddAddress($para);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = 'Mensagem enviada!';
		return true;
	}
}

// Insira abaixo o email que irá receber a mensagem, o email que irá enviar (o mesmo da variável GUSER), 
//o nome do email que envia a mensagem, o Assunto da mensagem e por último a variável com o corpo do email.

 if (smtpmailer($para, $Email, $Nome, $Assunto, $Vai)) {
	echo "";
	//Header("location:http://www.dominio.com.br/obrigado.html"); // Redireciona para uma página de obrigado.

}
if (!empty($error)) echo $error;
?>