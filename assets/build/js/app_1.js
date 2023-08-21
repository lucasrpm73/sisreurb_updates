$('#entrar').click(function(){
  var email = $('#email').val();
  var password = $('#password').val();
  var erro = 0;

  if (email == "") {
    $("#preencha_email").show();
    $("#email").css({"border" : "1px solid #FF0000"});
    erro++;
  }else{
    $("#preencha_usuario").hide();
    $("#usuario").css({"border" : "1px solid rgba(0, 0, 0, 0.15)"});
  }
  if (password == "") {
    $("#preencha_senha").show();
    $("#password").css({"border" : "1px solid #FF0000"});
    erro++;
  }else{
    $("#preencha_senha").hide();
    $("#password").css({"border" : "1px solid rgba(0, 0, 0, 0.15)"});
  }
  if (erro != 0) {
    console.log(erro);
    erro = 0;
    return false;
  }
});

$(document).ready(function(){
  $('.select_write').select2();
  $("#nascimento").mask("99/99/9999");
  $("#telefone").mask("(99) 99999-9999");
  $("#cpf").mask("999.999.999-99");
  $("#cep").mask("99999-999");
  $("#cnpj").mask("99.999.999/9999-99");
  $("#placa").mask("aaa - 9999");
 });
