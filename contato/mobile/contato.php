<?php

$error = "";

$nome = $_POST["m_contato-nome"];

//email
if (empty($_POST["m_contato-email"])) {
    $error .= "Email is required ";
} else {
    $email = $_POST["m_contato-email"];
}

$empresa = $_POST["m_contato-empresa"];
$telefone = $_POST["m_contato-tel"];
$assunto = $_POST["m_contato-assunto"];

//mensagem
if (empty($_POST["m_contato-mensagem"])) {
    $error .= "Mensagem is required ";
} else {
    $mensagem = $_POST["m_contato-mensagem"];
}
 
$To = "colemais@eticketa.com.br";
$uglySubject = "[Site | Contato] $assunto";
$Subject='=?UTF-8?B?'.base64_encode($uglySubject).'?=';

$Body .= "<html><body style='width: 690px'><b>$nome</b>, como <b>$empresa</b>, utilizou a área de contato do site querendo saber sobre <b>$assunto</b> e escreveu:<br/><br/>$mensagem<br/><br/>Para retornar este contato temos estas opções: <b>$email</b> <b>$telefone</b></body></html>";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-Transfer-Encoding: 8bit" . "\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
$headers .= "From: $email" . "\r\n";
 
// send email
$success = mail($To, $Subject, $Body, $headers);
 
// redirect to success page
if ($success && $error == ""){
   echo "success";
}else{
    if($error == ""){
        echo "Algo deu errado... Mas deu errado num nível, que é melhor você nos ligar no telefone (21) 3490-9292, porque pelo site vai ser difícil.";
    } else {
        echo $error;
    }
}
 
?>