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


$(document).ready(function() {
    $('.select_write').select2();

    $('.select_write_modal_temas').select2({
      dropdownParent: $('#modalAddTema')
    });

    $('.select_write_modal_palestras').select2({
      dropdownParent: $('#modalAddPalestrante')
    });

    $(document).on('change', '#status_palestras', function(){

      var status = $(this).val();
      var id_palestrante = $('#id_palestrante').val();

      if (status == 4) {
        if (id_palestrante == 0) {
          $('#add_palestrante').css('border', '2px solid #FF0000');
          $('#add_palestrante').css('color', 'red');
          $('#info_add_palestrante').show();
          $('#alterar_status').hide();
        }else{
          $('#info_add_palestrante').hide();
          $('#alterar_status').show();
        }
      }else{
        $('#info_add_palestrante').hide();
        $('#alterar_status').show();
      }
    });

    $(document).on('change', '#participantes', function(){
      $('#participantes_livros').show();
    });

    $(document).on('change', '#livros_vendidos', function(){
      $('#participantes_livros').show();
    });

    $(document).on('change', '#status_palestras', function(){
      $('#btn_status').show();
    });

    $(document).on('change', '#alterar_palestrante_dashboard', function(){
      // alert('entrou');
      $('#cadastrar_palestrante').show();
    });

    $(document).on('click', '#cadastrar_palestrante', function(){
      var id_palestra = $('.id_palestra_hidden').val();
      var id_palestrante = $('#alterar_palestrante_dashboard').val();
      var nome_palestrante = $('#nome_palestrante').val();
      var dados = new Array(id_palestra, id_palestrante);

      $('#load').show();

      console.log(dados);
      $.ajax({
       url: 'http://localhost/gss-agendamentos/palestras/cadastrar_palestrante',
       method: 'POST',
       data: {dados:dados},
       success: function(data){
         $('#cadastrar_palestrante').hide();
         $('#nome_palestrante').val(data);
         $('#alterar_palestrante_dashboard').val("");
         $('#load').hide();
         $('#modalAddPalestrante').modal('hide');
      }
     });
    });

    $(document).on('click', '#btn_status', function(){
      var id_palestra = $('.id_palestra_hidden').val();
      var id_status = $('#status_palestras').val();
      var dados = new Array(id_palestra, id_status);

      $('#load').show();

      console.log(dados);
      $.ajax({
       url: 'http://localhost/gss-agendamentos/palestras/alterar_status',
       method: 'POST',
       data: {dados:dados},
       success: function(data){
         $('#btn_status').hide();
         $('#status').val(data);
         $('#status_palestras').val("");
         $('#load').hide();
      }
     });
    });


});
