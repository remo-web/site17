$( "#contato-enviar" ).click(function() {
$("#etka_contato").submit();
    var email = document.forms["etka_contato"]["contato-email"].value;
    var contato_email = document.getElementById("contato-email");
    var mensagem = document.forms["etka_contato"]["contato-mensagem"].value;
    var contato_msg = document.getElementById("contato-mensagem");
    var att = document.createAttribute("required");
    if (email == "") {
        contato_email.setAttributeNode(att);
        return false;
        // handle the invalid form...
        formError();
    }
    if (mensagem == "") {
        contato_msg.setAttributeNode(att);
        return false;
        // handle the invalid form...
        formError();
    } 
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
    } else {
        // everything looks good!
        event.preventDefault();
        submitForm();
    }
});

function submitForm(){
    // Initiate Variables With Form Content
    var nome = $("#contato-nome").val();
    var email = $("#contato-email").val();
    var empresa = $("#contato-empresa").val();
    var tel = $("#contato-tel").val();
    var assunto = $("#contato-assunto").val();
    var mensagem = $("#contato-mensagem").val();
 
    $.ajax({
        type: "POST",
        url: "./contato/contato.php",
        data: "contato-nome=" + nome + "&contato-email=" + email + "&contato-empresa=" + empresa + "&contato-tel=" + tel + "&contato-assunto=" + assunto + "&contato-mensagem=" + mensagem,
        success : function(text){
            if (text == "success"){
                formSuccess();
            } else {
                formError();
            }
        }
    });
}

function formSuccess(){
    $( "#etka_contato-enviado" ).removeClass( "etka_contato-enviado" );
    $( '#contato-nome, #contato-email, #contato-empresa, #contato-tel, #contato-assunto, #contato-mensagem' ).val('');
}

function formError(){
    $( "#etka_contato-erro" ).removeClass( "etka_contato-erro" );
}

