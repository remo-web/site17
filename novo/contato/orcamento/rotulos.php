<?php
$error = "";
$nome = $_POST["o_rotulos-nome"];
//email
if (empty($_POST["o_rotulos-email"])) {
    $error .= "Email is required ";
} else {
    $email = $_POST["o_rotulos-email"];
};
$empresa = $_POST["o_rotulos-empresa"];
$telefone = $_POST["o_rotulos-telefone"];
$largura = $_POST["o_rotulos-largura"];
$altura = $_POST["o_rotulos-altura"];
$formato = $_POST["o_rotulos-formato"];
$quantidade = $_POST["o_rotulos-quantidade"];
$frente = $_POST["o_rotulos-frente"];
$verso = $_POST["o_rotulos-verso"];
$finalidade = $_POST["o_rotulos-finalidade"];
$mensagem = $_POST["o_rotulos-mensagem"];

$To = "raphael.pais@eticketa.com.br";
$uglySubject = "[Site | Orçamento] Rótulos";
$Subject='=?UTF-8?B?'.base64_encode($uglySubject).'?=';
 
// prepare email body text
$Body .= "Nome: ";
$Body .= $nome;
$Body .= "\n";
 
$Body .= "E-mail: ";
$Body .= $email;
$Body .= "\n";
 
$Body .= "Cargo / Empresa: ";
$Body .= $empresa;
$Body .= "\n";
 
$Body .= "Telefone: ";
$Body .= $telefone;
$Body .= "\n";
 
$Body .= "Largura: ";
$Body .= $largura;
$Body .= " cm";
$Body .= "\n";
 
$Body .= "Altura: ";
$Body .= $altura;
$Body .= " cm";
$Body .= "\n";
 
$Body .= "Formato: ";
$Body .= $formato;
$Body .= "\n";
 
$Body .= "Quantidade: ";
$Body .= $quantidade;
$Body .= "\n";
 
$Body .= "Frente: ";
$Body .= $frente;
$Body .= " cores";
$Body .= "\n";
 
$Body .= "Verso: ";
$Body .= $verso;
$Body .= " cores";
$Body .= "\n";
 
$Body .= "Finalidade: ";
$Body .= $finalidade;
$Body .= "\n";
 
$Body .= "Observações: ";
$Body .= $mensagem;
$Body .= "\n";

$arquivo = isset($_FILES["o-rotulos-anexo"]) ? $_FILES["o-rotulos-anexo"] : FALSE; 
if(file_exists($arquivo["tmp_name"]) and !empty($arquivo)){ 
$fp = fopen($_FILES["o-rotulos-anexo"]["tmp_name"],"rb"); 
$anexo = fread($fp,filesize($_FILES["o-rotulos-anexo"]["tmp_name"])); 
$anexo = base64_encode($anexo); 
fclose($fp); 
$anexo = chunk_split($anexo); 
    
$mens = "--$boundary\n";        
$mens .= "Content-Transfer-Encoding: 8bits\n";        
$mens .= "Content-Type: text/html; charset=\"ISO-8859-1\"\n\n"; 
//plain        
$mens .= "$mensagem\n";        
$mens .= "--$boundary\n";        
$mens .= "Content-Type: ".$arquivo["type"]."\n";        
$mens .= "Content-Disposition: attachment; filename=\"".
$arquivo["name"]."\"\n";        
$mens .= "Content-Transfer-Encoding: base64\n\n";       
$mens .= "$anexo\n";       
$mens .= "--$boundary--\r\n";
    

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-Transfer-Encoding: 8bit" . "\r\n";
$headers .= "Content-Type: multipart/mixed; charset=UTF-8" . "\r\n";
$headers .= "From: $email" . "\r\n";
$headers .= "$boundary\n";
 
// send email
mail($To, $Subject, $mens, $headers);
 
// redirect to success page
/*if ($success && $error == ""){
    echo "success";
} else {
    if($error == ""){
        echo "Algo deu errado... Mas deu errado num nível, que é melhor você nos ligar no telefone (21) 3490-9292, porque pelo site vai ser difícil.";
    } else {
        echo $error;
    }
}*/ 
?>