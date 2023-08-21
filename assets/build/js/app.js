const { href } = location;
console.log(href);
// const url_atual = href.includes('homolog') ? 'https://homolog.sisreurb.com.br/painel/' : 'https://sisreurb.com.br/painel/' ;
const url_atual = href.includes('homolog') ? 'https://homolog.sisreurb.com.br/painel/' : 'http://localhost/sisreurb/painel/' ;

$(document).ready(function () {});

$('form').keypress(function(e) {
    if(e.which == 13) {
      e.preventDefault();
      console.log('Não vou enviar');
    }
});

$('.peopleType').on('click', function () {
  var value = $(this).val();
  if (value == '1') {
    $('.peopleJuridica').hide();
    $('.peopleFisica').show();
    $('.conteudoCadastroRequirente').hide();
    $('#pesquisarCadastro').show();
    $('.conteudoCadastroRequirements').hide();
    $('#pesquisarCadastroRequerimentosJuridico').hide();
    $('#pesquisarCadastroRequerimentos').show();
    $('#pesquisarCadastroCnpj').hide();
    $('#pesquisarCadastroCpf').show();
    $('.procedure_fisico').prop('required', true);
    $('.procedure_juridico').prop('required', false);
    $('.cpf_personal').prop('required', true);
    $('#name_personal').prop('required', true);
  } else {
    $('.peopleFisica').hide();
    $('.peopleJuridica').show();
    $('.conteudoCadastroRequirente').hide();
    $('#pesquisarCadastro').show();
    $('.conteudoCadastroRequirements').hide();
    $('#pesquisarCadastroRequerimentos').hide();
    $('#pesquisarCadastroRequerimentosJuridico').show();
    $('#pesquisarCadastroCpf').hide();
    $('#pesquisarCadastroCnpj').show();
    $('.procedure_juridico').prop('required', true);
    $('.procedure_fisico').prop('required', false);
    $('.cpf_personal').prop('required', false);
    $('#name_personal').prop('required', false);
  }
});

$(document).on('change', '#same_address_home', function () {
  if ($(this).is(":checked")) {
    $('#realty_type_home').val($('#home_type_home').val());
    $('#realty_address_home').val($('#home_address_home').val());
    $('#realty_number_home').val($('#home_number_home').val());
    $('#realty_complement_home').val($('#home_complement_home').val());
    $('#realty_neighborhood_home').val($('#home_neighborhood_home').val());
    $('#realty_city_home').val($('#home_city_home').val());
    $('#realty_cep_home').val($('#home_cep_home').val());
    $('#realty_uf_home').val($('#home_uf_home').val());
    $('#realty_district_home').val($('#home_district_home').val());
    $('#realty_country_home').val($('#home_country_home').val());
  } else {
    $('#realty_type_home').val('');
    $('#realty_address_home').val('');
    $('#realty_number_home').val('');
    $('#realty_complement_home').val('');
    $('#realty_neighborhood_home').val('');
    $('#realty_city_home').val('');
    $('#realty_cep_home').val('');
    $('#realty_uf_home').val('');
    $('#realty_district_home').val('');
    $('#realty_country_home').val('');
  }
});

$(document).on('change', '#same_address_juridical', function () {
  if ($(this).is(":checked")) {
    $('#realty_type_juridical').val($('#home_type_juridical').val());
    $('#realty_address_juridical').val($('#home_address_juridical').val());
    $('#realty_number_juridical').val($('#home_number_juridical').val());
    $('#realty_complement_juridical').val($('#home_complement_juridical').val());
    $('#realty_neighborhood_juridical').val($('#home_neighborhood_juridical').val());
    $('#realty_city_juridical').val($('#home_city_juridical').val());
    $('#realty_cep_juridical').val($('#home_cep_juridical').val());
    $('#realty_uf_juridical').val($('#home_uf_juridical').val());
    $('#realty_district_juridical').val($('#home_district_juridical').val());
    $('#realty_country_juridical').val($('#home_country_juridical').val());
  } else {
    $('#realty_type_juridical').val('');
    $('#realty_address_juridical').val('');
    $('#realty_number_juridical').val('');
    $('#realty_complement_juridical').val('');
    $('#realty_neighborhood_juridical').val('');
    $('#realty_city_juridical').val('');
    $('#realty_cep_juridical').val('');
    $('#realty_uf_juridical').val('');
    $('#realty_district_juridical').val('');
    $('#realty_country_juridical').val('');
  }
});

$(document).on('click', '#add_member', function () {
  $('#members_list').append('<div class="row">\
  <div class="col-md-3 pr-md-1">\
    <div class="form-group">\
      <label for="name_members_family">Nome</label>\
      <input type="text" name="name_members_family[]" id="name_members-family" class="form-control" value="">\
    </div>\
  </div>\
  <div class="col-md pl-md-1 pr-md-1">\
    <div class="form-group">\
      <label for="rg_members_family">C.I / RG</label>\
      <input type="text" name="rg_members_family[]" id="rg" class="form-control"\
        value="">\
    </div>\
  </div>\
  <div class="col-md pl-md-1 pr-md-1">\
    <div class="form-group">\
      <label for="cpf_members_family">CPF</label>\
      <input type="text" name="cpf_members_family[]" id="cpf_members_family" class="form-control cpf" id="cpf" value="">\
    </div>\
  </div>\
  <div class="col-md pl-md-1 pr-md-1">\
    <div class="form-group">\
      <label for="type_members_family">Tipo</label>\
      <select class="form-control" name="type_members_family[]" id="type_members_family">\
      <option value=""></option>\
      <option value="Mãe">Mãe</option>\
      <option value="Pai">Pai</option>\
      <option value="Irmão(a)">Irmão(a)</option>\
      <option value="Filho(a)">Filho(a)</option>\
      <option value="Sobrinho(a)">Sobrinho(a)</option>\
      <option value="Cunhado(a)">Cunhado(a)</option>\
      <option value="Primo(a)">Primo(a)</option>\
      <option value="Tio(a)">Tio(a)</option>\
      <option value="Avô">Avô</option>\
      <option value="Avó">Avó</option>\
      <option value="Outros">Outros</option>\
      </select>\
    </div>\
  </div>\
  <div class="col-md pr-md-1 pl-md-1">\
    <div class="form-group">\
      <label for="date_birth_family">Data de nascimento</label>\
      <input type="date" name="date_birth_family[]" id="date_birth_family" class="form-control" value="">\
    </div>\
  </div>\
  <div class="col-md pl-md-1">\
    <div class="form-group">\
      <label for="monthly_income_members_family">Renda mensal (R$)</label>\
      <input type="text" name="monthly_income_members_family[]" id="monthly_income_members_family" class="form-control venal" value="">\
    </div>\
  </div>\
  </div>\
  ');

  $(".venal").maskMoney({
    prefix: "",
    decimal: ",",
    thousands: ".",
  });
  $(".cpf").mask("999.999.999-99");
});

$(document).on('change', '#cpf_personal', function () {
  var cpf = $(this).val();

  $.ajax({
    url: url_atual + 'requirements/fetch_requirements_legal',
    method: 'post',
    dataType: 'json',
    data: {
      cpf: cpf
    },
    success: function (data) {
      if (cpf) {
        $('#name_personal').val(data.name);
        $('#phone_personal').val(data.phone);
        $('#email_personal').val(data.email);
        $('#profission_personal').val(data.profession);
        $('#birth_date_personal').val(data.birth_date);
        $('#id_requester').val(data.id);
      } else {
        $('#name_personal').val('');
        $('#phone_personal').val('');
        $('#email_personal').val('');
        $('#profission_personal').val('');
        $('#birth_date_personal').val('');
        $('#id_requester').val('');
      }

    }
  });
});

$(document).on('change', '#cnpj_juridical', function () {
  var cnpj = $(this).val();

  $.ajax({
    url: url_atual + 'requirements/fetch_requirements_juridical',
    method: 'post',
    dataType: 'json',
    data: {
      cnpj: cnpj
    },
    success: function (data) {
      if (cnpj) {
        $('#corporate_name_juridical').val(data.company_name);
        $('#activity_branch_juridical').val(data.activity_branch);
        $('#type_street_juridical').val(data.type_street);
        $('#street_juridical').val(data.public_place);
        $('#number_name_juridical').val(data.number);
        $('#complement_juridical').val(data.complement);
        $('#neighborhood_juridical').val(data.neighborhood);
        $('#city_juridical').val(data.city);
        $('#cep_juridical').val(data.cep);
        $('#uf_juridical').val(data.uf);
        $('#district_juridical').val(data.district);
        $('#country_juridical').val(data.country);
        $('#monthly_invoicing_juridical').val(data.monthly_invoicing);
        $('#id_requester').val(data.id);
      } else {
        $('#corporate_name_juridical').val('');
        $('#activity_branch_juridical').val('');
        $('#type_street_juridical').val('');
        $('#street_juridical').val('');
        $('#number_name_juridical').val('');
        $('#complement_juridical').val('');
        $('#neighborhood_juridical').val('');
        $('#city_juridical').val('');
        $('#cep_juridical').val('');
        $('#uf_juridical').val('');
        $('#district_juridical').val('');
        $('#country_juridical').val('');
        $('#monthly_invoicing_juridical').val('');
        $('#id_requester').val('');
      }

    }
  });
});
// --> Checklist Requesters Pessoa Fisico
$('.img_cpf').bind("click", function () {
  $('#pic_img_cpf').click();
  let id = $(this).data("id");
  let classe = $(this).data("classe");

  $("."+classe).val(id);
});

$(document).on("change", "#pic_img_cpf", function () {
  img_documents(this, '#img_cpf', '#download_cpf', '#name_cpf');
});

// RG
$('.img_rg').bind("click", function () {
  $('#pic_img_rg').click();
});

$(document).on("change", "#pic_img_rg", function () {
  img_documents(this, '#img_rg', '#download_rg', '#name_rg');
});

// Nascimento/Casamento
$('.img_nascimento').bind("click", function () {
  $('#pic_img_nascimento').click();
});

$(document).on("change", "#pic_img_nascimento", function () {
  img_documents(this, '#img_nascimento', '#download_nascimento', '#name_nascimento');
});


// Comprovante de Residência
$('.img_residencia').bind("click", function () {
  $('#pic_img_residencia').click();
});

$(document).on("change", "#pic_img_residencia", function () {
  img_documents(this, '#img_residencia', '#download_residencia', '#name_residencia');
});


// Comprovante de Renda
$('.img_renda').bind("click", function () {
  $('#pic_img_renda').click();
});

$(document).on("change", "#pic_img_renda", function () {
  img_documents(this, '#img_renda', '#download_renda', '#name_renda');
});

// Checklist Requesters Pessoa juridica
$('.img_cpf_juridical').bind("click", function () {
  $('#pic_img_cpf_juridical').click();
});

$(document).on("change", "#pic_img_cpf_juridical", function () {
  img_documents(this, '#img_cpf_juridical', '#download_cpf_juridical', '#name_cpf_juridical');
});

// RG
$('.img_rg_juridical').bind("click", function () {
  $('#pic_img_rg_juridical').click();
});

$(document).on("change", "#pic_img_rg_juridical", function () {
  img_documents(this, '#img_rg_juridical', '#download_rg_juridical', '#name_rg_juridical');
});

// Nascimento/Casamento
$('.img_nascimento_juridical').bind("click", function () {
  $('#pic_img_nascimento_juridical').click();
});

$(document).on("change", "#pic_img_nascimento_juridical", function () {
  img_documents(this, '#img_nascimento_juridical', '#download_nascimento_juridical', '#name_nascimento_juridical');
});

// Comprovante de Residência
$('.img_residencia_juridical').bind("click", function () {
  $('#pic_img_residencia_juridical').click();
});

$(document).on("change", "#pic_img_residencia_juridical", function () {
  img_documents(this, '#img_residencia_juridical', '#download_residencia_juridical', '#name_residencia_juridical');
});

// Comprovante de Renda
$('.img_renda_juridical').bind("click", function () {
  $('#pic_img_renda_juridical').click();
});

$(document).on("change", "#pic_img_renda_juridical", function () {
  img_documents(this, '#img_renda', '#download_renda_juridical', '#name_renda_juridical');
});

// Checklist Protocols Pessoa fisica
$('.img_aquisicao').bind("click", function () {
  $('#pic_img_aquisicao').click();
});

$(document).on("change", "#pic_img_aquisicao", function () {
  img_documents(this, '#img_aquisicao', '#download_aquisicao', '#name_aquisicao');
});

// Gui Iptu
$('.img_iptu').bind("click", function () {
  $('#pic_img_iptu').click();
});

$(document).on("change", "#pic_img_iptu", function () {
  img_documents(this, '#img_iptu', '#download_iptu', '#name_iptu');
});

// Declaração de Confrontante
$('.img_confrotante').bind("click", function () {
  $('#pic_img_confrotante').click();
});

$(document).on("change", "#pic_img_confrotante", function () {
  img_documents(this, '#img_confrotante', '#download_confrotante', '#name_confrotante');
});

// Planta Topográfica
$('.img_topografica').bind("click", function () {
  $('#pic_img_topografica').click();
});

$(document).on("change", "#pic_img_topografica", function () {
  img_documents(this, '#img_topografica', '#download_topografica', '#name_topografica');
});

// Memorial Descritivo
$('.img_memorial').bind("click", function () {
  $('#pic_img_memorial').click();
});

$(document).on("change", "#pic_img_memorial", function () {
  img_documents(this, '#img_memorial', '#download_memorial', '#name_memorial');
});

// Foto Frontal
$('.img_frontal').bind("click", function () {
  $('#pic_img_frontal').click();
});

$(document).on("change", "#pic_img_frontal", function () {
  img_documents(this, '#img_frontal', '#download_frontal', '#name_frontal');
});

// Checklist Protocols Pessoa Juridica
$('.img_aquisicao_juridical').bind("click", function () {
  $('#pic_img_aquisicao_juridical').click();
});

$(document).on("change", "#pic_img_aquisicao_juridical", function () {
  img_documents(this, '#img_aquisicao_juridical', '#download_aquisicao_juridical', '#name_aquisicao_juridical');
});

// Gui Iptu
$('.img_iptu_juridical').bind("click", function () {
  $('#pic_img_iptu_juridical').click();
});

$(document).on("change", "#pic_img_iptu_juridical", function () {
  img_documents(this, '#img_iptu_juridical', '#download_iptu_juridical', '#name_iptu_juridical');
});

// Declaração de Confrontante
$('.img_confrotante_juridical').bind("click", function () {
  $('#pic_img_confrotante_juridical').click();
});

$(document).on("change", "#pic_img_confrotante_juridical", function () {
  img_documents(this, '#img_confrotante_juridical', '#download_confrotante_juridical', '#name_confrotante_juridical');
});

// Planta Topográfica
$('.img_topografica_juridical').bind("click", function () {
  $('#pic_img_topografica_juridical').click();
});

$(document).on("change", "#pic_img_topografica_juridical", function () {
  img_documents(this, '#img_topografica_juridical', '#download_topografica_juridical', '#name_topografica_juridical');
});

// Memorial Descritivo
$('.img_memorial_juridical').bind("click", function () {
  $('#pic_img_memorial_juridical').click();
});

$(document).on("change", "#pic_img_memorial_juridical", function () {
  img_documents(this, '#img_memorial_juridical', '#download_memorial_juridical', '#name_memorial_juridical');
});

// Foto Frontal
$('.img_frontal_juridical').bind("click", function () {
  $('#pic_img_frontal_juridical').click();
});

$(document).on("change", "#pic_img_frontal_juridical", function () {
  img_documents(this, '#img_frontal_juridical', '#download_frontal_juridical', '#name_frontal_juridical');
});

// File
$('.files_checklist').bind("click", function () {
  let id = $(this).data("id");
  let classe = $(this).data("classe");

  $('#id_arquivo').val(id);

  // $('#pic_file_'+id).click();
  // $("."+classe).val(id);
});

$(document).on("change", ".pic_file", function () {
  let id = $(this).data('id');

  $('.append_id_documents').append('<input type="hidden" name="id_documents[]" value="'+ id +'" class="id_documents_'+ id +'">');
  img_documents(this, '#img_cpf', '#download_cpf', '.name_file_'+id);
});

function img_documents(input, id, download, name_arquivo) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $(id).attr('src', e.target.result);
      var filename = $(input).val().replace(/C:\\fakepath\\/i, '');
      $(name_arquivo).text(filename);
      $(download).prop('href', e.target.result);
      $(download).show();
    };
    reader.readAsDataURL(input.files[0]);
  }
}

$(document).on("change", ".file_checklist_protocol", function () {
  let id = $(this).data('id');

  $('.append_documents_protocol').append('<input type="hidden" name="type_arquivo_checklist[]" value="'+ id +'">');
  img_documents(this, '#img_cpf', '#download_cpf', '.name_file_'+id);
});


// --> IMG
$('.newimgum').bind("click", function () {
  $('#picimgum').click();
});

$(document).on("change", "#picimgum", function () {
  readURLum(this, '#imgum');
});

function readURLum(input, id) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $(id).attr('src', e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
}

$(document).on('click', '#picimgum', () => {
  $('#save').show();
})

$(document).on("click", '.add_img', function () {
  var pic = '#' + $(this).data('pic');
  var img = '#' + $(this).data('img');

  console.log(pic);
  console.log(img);

  $(document).on("change", pic, function () {
    console.log(pic);
    readURLum(this);
  });

  function readURLum(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $(img).attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
});

$(document).on('submit', '#pesquisarCadastro span', () => {
  $('.conteudoCadastroRequirente').show();
  $('#pesquisarCadastro').hide();
});

$(document).on('click', '#pesquisarCadastroCpf span', function (){
  var cpf_cnpj = $('#cpf').val();
  if (cpf_cnpj == '') {
    $('#requerente_cadastrado').show();
    $('.text-requester').text('Cpf invalido!');
    $('#name_requester').hide();
    $('.alert_off').addClass('alert-danger');
    $('.alert_off').removeClass('alert-warning');
    return;
  }

  $.ajax({
    url: url_atual+'requesters/isset_cpf_cnpj',
    method: 'post',
    dataType: 'json',
    data: {cpf_cnpj:cpf_cnpj},
    success: function (data){
      if (data) {
        $('#requerente_cadastrado').show();
        if (data.status == '0') {
          $('.text-requester').text('Requerente desativado!');
          $('.alert_off').addClass('alert-warning');
          $('.alert_off').removeClass('alert-danger');
        } else {
          $('.text-requester').text('Requerente cadastrado!');
          $('.alert_off').removeClass('alert-warning');
          $('.alert_off').addClass('alert-danger');
        }

        if (data.completion_status == '0') {
          $('.text-requester').text('Requerente ainda não concluído!');
          $('.alert_off').addClass('alert-warning');
          $('.alert_off').removeClass('alert-danger');
        }

        $('#name_requester').text('Acessar cadastro de ' + data.name);
        $('#name_requester').attr('href', url_atual+'requesters/detail/'+data.id);
      } else {
        $('#requerente_cadastrado').hide();
        $('#pesquisarCadastroCpf').hide();
        $('.conteudoCadastroRequirente').show();
        $('.cpf_personal').val(cpf_cnpj);
      }
    }
  });
});

$(document).on('click', '#pesquisarCadastroCnpj span', function (){
  var cpf_cnpj = $('#cnpj').val();
  if (cpf_cnpj == '') {
    $('#requerente_cadastrado').show();
    $('.text-requester').text('Cpf invalido!');
    $('#name_requester').hide();
    $('.alert_off').addClass('alert-danger');
    $('.alert_off').removeClass('alert-warning');
    return;
  }

  $.ajax({
    url: url_atual+'requesters/isset_cpf_cnpj',
    method: 'post',
    dataType: 'json',
    data: {cpf_cnpj:cpf_cnpj},
    success: function (data){
      if (data) {
        if (data.status == '0') {
          $('.text-requester').text('Requerente desativado!');
          $('.alert_off').addClass('alert-warning');
          $('.alert_off').removeClass('alert-danger');
        } else {
          $('.text-requester').text('Requerente cadastrado!');
          $('.alert_off').removeClass('alert-warning');
          $('.alert_off').addClass('alert-danger');
        }

        if (data.completion_status == '0') {
          $('.text-requester').text('Requerente ainda não concluído!');
          $('.alert_off').addClass('alert-warning');
          $('.alert_off').removeClass('alert-danger');
        }

        $('#requerente_cadastrado').show();
        $('#name_requester').text(data.company_name);
        $('#name_requester').attr('href', url_atual+'requesters/detail/'+data.id);
      } else {
        $('#requerente_cadastrado').hide();
        $('#pesquisarCadastroCnpj').hide();
        $('.conteudoCadastroRequirente').show();
        $('#cnpj_juridical').val(cpf_cnpj);
      }
    }
  });
});

$(document).on('click', '#pesquisarCadastroRequerimentos span', function (){
  var cpf_cnpj = $('#cpf').val();
  if (cpf_cnpj == '') {
    $('#name_requester').hide();

    $('.alert_cpf_number').hide();
    $('.alert_off').removeClass('alert-warning');
    $('.alert_off').addClass('alert-danger');
    $('.alert_off').show();

    $('.text-requester').text('Cpf invalido!');
    return;
  }
  $('#name_requester').show();

  $.ajax({
    url: url_atual+'protocols/isset_cpf_cnpj',
    method: 'post',
    dataType: 'json',
    data: {cpf_cnpj:cpf_cnpj},
    success: function (data){
      if (data && data.status == '1') {
        if (data.completion_status == '0') {
          $('.alert_cpf_number').hide();
          $('.alert_off').removeClass('alert-warning');
          $('.alert_off').addClass('alert-danger');
          $('.alert_off').show();

          $('.text-requester').text('Requerente ainda não concluído!');
          $('#name_requester').text('Acessar cadastro de ' + data.legal_name);
          $('#name_requester').attr('href', url_atual + 'requesters/detail/' + data.id);
          return;
        }

        let property_owner = (data.property_owner_legal == '0') ? 'Não' : 'Sim';
        if (data.property_owner == '1' || data.property_owner_legal == '1') {
          property_owner = 'Sim';
        } else {
          property_owner = 'Não';
        }
        let federal_government_income = (data.federal_government_income == null)? 0 : data.federal_government_income;
        let monthly_income = (data.monthly_income == null)? 0 : data.monthly_income;
        let monthly_income_family = (data.monthly_income_family == null)? 0 : data.monthly_income_family;
        let monthly_income_spouse = (data.monthly_income_spouse == null)? 0 : data.monthly_income_spouse;
        let federal_government_income_spouse = (data.federal_government_income_spouse == null)? 0 : data.federal_government_income_spouse;
        let monthly_income_total = parseFloat(monthly_income) + parseFloat(monthly_income_family) + parseFloat(federal_government_income) + parseFloat(monthly_income_spouse) + parseFloat(federal_government_income_spouse);

        $('#pesquisarCadastroRequerimentos').hide();
        $('.conteudoCadastroRequirements').show();
        $('.alert_cpf_number').hide();
        $('#requirements_register').hide();
        $('#cpf_personal').val(data.cpf);
        $('#proprietario_imovel').text(property_owner);

        $('#monthly_income_total').text('R$ '+parseFloat(monthly_income_total));
        $('#maximum_family_income').val(parseFloat(data.maximum_family_income));

        if (property_owner == 'Sim' || monthly_income_total > data.maximum_family_income) {
          $("#reurb").val('REURB-E');
        } else {
          $("#reurb").val('REURB-S');
        }

        $('#name_personal').val(data.legal_name);
        $('#phone_personal').val(data.legal_phone);
        $('#email_personal').val(data.legal_email);
        $('#profission_personal').val(data.legal_profession);
        $('#birth_date_personal').val(data.birth_date);
        $('#civil_status').val(data.civil_status);
        $('#id_requester').val(data.id_legal_person);
      } else {
        $('#requirements_register').show();
        if (data.status == '0') {
          $('.alert_cpf_number').hide();
          $('.alert_off').show();
          $('#name_requester').text('Acessar cadastro de ' + data.legal_name);
          $('#name_requester').attr('href', url_atual+'requesters/detail/'+data.id);
        } else {
          $('.alert_cpf_number').show();
          $('.alert_off').hide();
        }
      }
    }
  });
});

$(document).on('click', '#pesquisarCadastroRequerimentosJuridico span', function (){
  var cpf_cnpj = $('#cnpj').val();

  $.ajax({
    url: url_atual+'protocols/isset_cpf_cnpj',
    method: 'post',
    dataType: 'json',
    data: {cpf_cnpj:cpf_cnpj},
    success: function (data){
      if (data) {
        let property_owner = (data.property_owner_juridical == '0') ? 'Não' : 'Sim';
        if (data.property_owner == '1' || data.property_owner_juridical == '1') {
          property_owner = 'Sim';
        } else {
          property_owner = 'Não';
        }
        let monthly_invoicing = (data.monthly_invoicing == null)? 0 : data.monthly_invoicing;
        let monthly_income_total = parseFloat(monthly_invoicing);
          $('#pesquisarCadastroRequerimentosJuridico').hide();
          $('.conteudoCadastroRequirements').show();
          $('.alert_cpf_number').hide();
          $('#requirements_register').hide();
          // PESSOA JURIDICA
          $('#cnpj_juridical').val(data.cnpj);
          $('#corporate_name_juridical').val(data.company_name);
          $('#activity_branch_juridical').val(data.activity_branch);
          $('#type_street_juridical').val(data.type_street);
          $('#street_juridical').val(data.public_place);
          $('#number_name_juridical').val(data.number);
          $('#complement_juridical').val(data.complement);
          $('#neighborhood_juridical').val(data.neighborhood);
          $('#city_juridical').val(data.city);
          $('#cep_juridical').val(data.cep);
          $('#country_juridical').val(data.country);
          $('#monthly_invoicing_juridical').val(data.monthly_invoicing);
          $('#district_juridical').val(data.district);
          $('#uf_juridical').val(data.uf);
          $('#id_requester').val(data.id_juridical_person);

          $('#proprietario_imovel_juridical').text(property_owner);
          $('#monthly_income_total_juridical').text('R$ '+parseFloat(monthly_income_total));
          $('#maximum_family_income_juridical').val(parseFloat(data.maximum_family_income));
          if (property_owner == 'Sim' || monthly_income_total > data.maximum_family_income) {
            $("#reurb_juridical").val('REURB-E');
          } else {
            $("#reurb_juridical").val('REURB-S');
          }

      } else {
        $('#requirements_register').show();
        $('.alert_cpf_number').show();
      }
    }
  });
});

$(document).on('click', '#pesquisar_new_requester_protocols span', function (){
  var cpf_cnpj = $('#cpf').val();

  $.ajax({
    url: url_atual+'protocols/isset_cpf_cnpj',
    method: 'post',
    dataType: 'json',
    data: {cpf_cnpj:cpf_cnpj},
    success: function (data){
      // if (data) {
      //   $('#pesquisarCadastroRequerimentos').hide();
      //   $('.conteudoCadastroRequirements').show();
      //   $('.alert_cpf_number').hide();
      //   $('#requirements_register').hide();
      //   $('#cpf_personal').val(data.cpf);
      //   $('#name_personal').val(data.legal_name);
      //   $('#phone_personal').val(data.legal_phone);
      //   $('#email_personal').val(data.legal_email);
      //   $('#profission_personal').val(data.legal_profession);
      //   $('#birth_date_personal').val(data.birth_date);
      //   $('#civil_status').val(data.civil_status);
      //   $('#id_requester').val(data.id_legal_person);
      // } else {
      //   $('#requirements_register').show();
      //   $('.alert_cpf_number').show();
      // }
    }
  });
});

$(document).on('click', '#process_number span', function (){
  let process_number = $('#process_number_input').val();
  $.ajax({
    url: url_atual+'procedure_reurb/isset_process_number',
    method: 'post',
    dataType: 'json',
    data: {process_number:process_number},
    success: function (data){
        if(data == '' || data == []) {
         $('.alert_process_number').hide(300);
         $('.register_procedure_data').show();
         $('#requester').val('');
         $('#date_requester').val('');
         $('#irregular_parceler').val('');
         $('#modalidade').val('');
         $('#decision').val('');
         $('#decision_date').val('');
         for (let i = 0; i <= 10; i++) {
           $('.stage_0'+i).prop('disabled', false);
           $('.stage_0'+i).css('color', 'black');
           if (i == 10) {
             $('.stage_10').prop('disabled', false);
             $('.stage_10').css('color', 'black');
           }
         }
         $('#requester').prop('readonly', false);
         $('#requester').prop('readonly', false);
         $('#date_requester').prop('readonly', false);
         $('#irregular_parceler').prop('readonly', false);
         $('#modalidade').prop('disabled', false);
         $('#decision').prop('disabled', false);
         $('#decision_date').prop('readonly', false);
       } else {
          $('.alert_process_number').show(300);
          $('.register_procedure_data').hide();
          $('#stage_edit').html('<option value="" disabled selected>Etapas</option>');
          $.each(data, function (index, value){

          if (value != '' && value != []) {
            // console.log(value.stage);
            let status = (value.status == '0') ? 'style="color: red;"' : '';
            let desativado = (value.status == '0') ? '- Desativado' : '';

            $('#stage_edit').append('<option value="'+value.stage+'" '+ status +'>'+value.stage+' '+ desativado +'</option>');
            $('.stage_'+value.stage).prop('disabled', true);
            $('.stage_'+value.stage).css('color', 'red');

            $('#requester').val(value.requester);
            $('#date_requester').val(value.date_requester);
            $('#irregular_parceler').val(value.irregular_parceler);
            $('#modalidade').val(value.modality);
            $('#decision').val(value.decision);
            $('#decision_date').val(value.decision_date);
            $('#value_modality').val(value.modality);
            $('#value_decision').val(value.decision);

            $('#requester').prop('readonly', true);
            $('#requester').prop('readonly', true);
            $('#date_requester').prop('readonly', true);
            $('#irregular_parceler').prop('readonly', true);
            $('#modalidade').prop('disabled', true);
            $('#decision').prop('disabled', true);
            $('#decision_date').prop('readonly', true);
          }
        });
      }
    }
  });
});

$(document).on('change', '#stage_edit', function (){
  let process_number = $('#process_number_input').val();
  let stage = $(this).val();
  $.ajax({
    url: url_atual+'procedure_reurb/isset_stage',
    method: 'post',
    dataType: 'json',
    data: {process_number:process_number, stage:stage},
    success: function (data){
      if (data.status == '0') {
        $('.new_stage').prop('disabled', true);
      }
      $('#edit_reurb').attr('href', url_atual+'procedure_reurb/detail/'+data.id);
      $('#edit_reurb').attr('disabled', false);
    }
  });
});

$(document).on('change', '#modality', function (){
  let modality = $(this).val();
  $('#value_modality').val(modality);
});

$(document).on('change', '#value_decision', function (){
  let value_decision = $(this).val();
  $('#value_decision').val(value_decision);
});

$(document).on('click', '.new_stage', function (){
    $('.new_stage').prop('checked', false);
    $('.alert_process_number').hide(300);
    $('.register_procedure_data').show();
});

let count = 0;
$(document).on('click' , '.append_tenants_legal' , function(){
  let id = $(this).data('id');
  let name = $(this).data('name');
  let cpf = $(this).data('cpf');
  let contato = $(this).data('contato');
  let email = $(this).data('email');
  let classe = $(this).data('classe');
  // let property_owner = $('.'+classe).val();
  let property_owner = $(this).data('property_owner');
  let monthly_income = $(this).data('monthly_income');
  let text = $('#monthly_income_total').text();
  let monthly_income_total = text.replace("R$", "");
  let amount = parseFloat(monthly_income_total) + parseFloat(monthly_income);
  $('#monthly_income_total').text('R$ '+amount);
  let maximum_family_income = $('#maximum_family_income').val();
  if (amount > maximum_family_income) {
    $('#reurb').val('REURB-E');
  } else {
    $('#reurb').val('REURB-S');
  }

  let property_owner_legal = $('#proprietario_imovel').text();
  if (property_owner_legal == 'Não') {
    if (property_owner == 'Sim') {
      $('#proprietario_imovel').html('Sim');
    } else {
      $('#proprietario_imovel').html('Não');
    }
  }

  count++;
  $('#tenants_list').append(`<tr class="text-dark remove_requester_${count}">\
    <td>${cpf}</td>\
    <td>${name}</td>\
    <td>${contato}</td>\
    <td>${email}</td>\
    <td>${property_owner}</td>\
    <td>\
      <button type="button" name="button" class="btn btn-danger remove_requester_condomino" data-remove="remove_requester_${count}" data-amount="${monthly_income}" data-type="1">X</button>\
    </td>\
    <input type="hidden" name="id_requester_condomino[]" value="${id}">\
  </tr>`);

});

$(document).on('click', '.remove_requester_condomino', function (){
  let remove_requester = $(this).data('remove');
  let type = $(this).data('type');
  let amount = $(this).data('amount');
  let monthly_income = '';
  if (type == 1) {
     monthly_income = $('#monthly_income_total').text();
  } else {
     monthly_income = $('#monthly_income_total_juridical').text();
  }
  let monthly_income_total = monthly_income.replace('R$', '');
  let amount_total = parseFloat(monthly_income_total) - parseFloat(amount);

  if (type == 1) {
    $('#monthly_income_total').text('R$ '+amount_total);
  } else {
    $('#monthly_income_total_juridical').text('R$ '+amount_total);
  }

  $('.'+remove_requester).html('');
});

$(document).on('click', '.remove_requester_condomino', function (){
  let remove_requester = $(this).data('remove');
  let amount = $(this).data('amount');
  let monthly_income = $('#monthly_income_total').text();
  let monthly_income_total = monthly_income.replace('R$', '');

  let amount_total = parseFloat(monthly_income_total) - parseFloat(amount);
  $('#monthly_income_total').text('R$ '+amount_total);

  $('.'+remove_requester).html('');
});

$(document).on('click' , '.append_tenants_juridical' , function(){
  let id = $(this).data('id');
  let name = $(this).data('name');
  let cpf = $(this).data('cpf');
  let contato = $(this).data('contato');
  let email = $(this).data('email');
  let property_owner = $(this).data('property_owner');
  let monthly_income = $(this).data('monthly_income');
  let text = $('#monthly_income_total_juridical').text();
  let monthly_income_total = text.replace("R$", "");
  let amount = parseFloat(monthly_income_total) + parseFloat(monthly_income);
  $('#monthly_income_total_juridical').text('R$ '+amount);
  let maximum_family_income = $('#maximum_family_income_juridical').val();
  if (amount > maximum_family_income) {
    $('#reurb_juridical').val('REURB-E');
  } else {
    $('#reurb_juridical').val('REURB-S');
  }

  let property_owner_legal = $('#proprietario_imovel').text();
  if (property_owner_legal == 'Não') {
    if (property_owner == 'Sim') {
      $('#proprietario_imovel').html('Sim');
    } else {
      $('#proprietario_imovel').html('Não');
    }
  }

  count++
  $('#tenants_list_juridical').append(`<tr class="text-dark remove_requester_${count}">\
    <td>${cpf}</td>\
    <td>${name}</td>\
    <td>${contato}</td>\
    <td>${email}</td>\
    <td>${property_owner}</td>\
    <td>\
      <button type="button" name="button" class="btn btn-danger remove_requester_condomino" data-remove="remove_requester_${count}"  data-amount="${monthly_income}" data-type="2">X</button>\
    </td>\
    <input type="hidden" name="id_requester_condomino[]" value="${id}">\
  </tr>`);
});

$(document).on('click', '.remove_tenants_legal', function (){
  let id = $(this).data('id');
  let id_requirement = $(this).data('id_requirement');

  $.ajax({
    url: url_atual+'protocols/remove_tenants',
    method: 'post',
    dataType: 'json',
    data: {id_requirement:id_requirement, id:id},
    success: function (data){
      $('#tenants_list_legal').html('');
      $.each(data, function (index, value){
        let cpf = (value.cpf) ? value.cpf : value.cnpj;
        let name = (value.legal_name) ? value.legal_name : value.company_name;
        let phone = (value.legal_phone) ? value.legal_phone : value.phone_procurator;
        let email = (value.legal_email) ? value.legal_email : value.email_procurator;
        phone = (phone == null)? '': phone;
        email = (email == null)? '': email;
        let property_owner = '';
        if (value.property_owner_legal) {
          property_owner = (value.property_owner_legal == '1') ? 'Sim' : 'Não';
        } else {
          property_owner = (value.property_owner_juridical == '1') ? 'Sim' : 'Não';
        }

        $('#tenants_list_legal').append('<tr>\
          <td>'+cpf+'</td>\
          <td>'+name+'</td>\
          <td>'+phone+'</td>\
          <td>'+email+'</td>\
          <td>'+property_owner+'</td>\
          <td>\
            <button type="button" name="button" class="btn btn-sm btn-danger remove_tenants_legal"\
              data-id="'+value.id+'" data-id_requirement="'+value.id_requirement+'"\
              >X</button>\
          </td>\
        </tr>');
      });
    }
  });
});

$(document).on('click', '.remove_tenants_legal', function (){
  let id_requester = $('#id_requester').val();
  let id_requirement = $('#id_requirement').val();
  $.ajax({
    url: url_atual+'protocols/fetch_tenants',
    method: 'post',
    dataType: 'json',
    data: {id_requester:id_requester, id_requirement:id_requirement},
    success: function (data){
      console.log(data);
      $('#monthly_income_total').text('R$ '+data);
      let maximum_income = $('#maximum_family_income_detail').val();

      if (data > maximum_income) {
        $('#reurb').text('REURB-E');
        $('#reurb_type').val('REURB-E');
      } else {
        $('#reurb').text('REURB-S');
        $('#reurb_type').val('REURB-S');
      }
    }
  });
});

$(document).on('click', '.remove_tenants_juridical', function (){
  let id = $(this).data('id');
  let id_requirement = $(this).data('id_requirement');

  $.ajax({
    url: url_atual+'protocols/remove_tenants',
    method: 'post',
    dataType: 'json',
    data: {id_requirement:id_requirement, id:id},
    success: function (data){
      $('#tenants_list').html('');
      $.each(data, function (index, value){
        let cpf = (value.cpf) ? value.cpf : value.cnpj;
        let name = (value.legal_name) ? value.legal_name : value.company_name;
        let phone = (value.legal_phone) ? value.legal_phone : value.phone_procurator;
        let email = (value.legal_email) ? value.legal_email : value.email_procurator;
        phone = (phone == null)? '': phone;
        email = (email == null)? '': email;
        let property_owner = '';
        if (value.property_owner_legal) {
          property_owner = (value.property_owner_legal == '1') ? 'Sim' : 'Não';
        } else {
          property_owner = (value.property_owner_juridical == '1') ? 'Sim' : 'Não';
        }

        $('#tenants_list').append('<tr>\
          <td>'+cpf+'</td>\
          <td>'+name+'</td>\
          <td>'+phone+'</td>\
          <td>'+email+'</td>\
          <td>'+property_owner+'</td>\
          <td>\
          <button type="button" name="button" class="btn btn-sm btn-danger remove_tenants_juridical"\
            data-id="'+value.id+'" data-id_requirement="'+value.id_requirement+'"\
            >X</button>\
          </td>\
        </tr>');
      });
    }
  });
});

$(document).on('click', '.remove_tenants_juridical', function (){
  let id_requester = $('#id_requester').val();
  let id_requirement = $('#id_requirement').val();
  $.ajax({
    url: url_atual+'protocols/fetch_tenants',
    method: 'post',
    dataType: 'json',
    data: {id_requester:id_requester, id_requirement:id_requirement},
    success: function (data){
      console.log(data);
      $('#monthly_income_total').text('R$ '+data);
    }
  });
});


$(document).on('click', '.add_new_tenants', function (){
  let id_requester = $(this).data('id');
  let id_requirement = $('#id_requirement_requester').val();

  $.ajax({
    url: url_atual+'protocols/insert_tenant',
    method: 'post',
    dataType: 'json',
    data: {id_requirement:id_requirement, id_requester:id_requester},
    success: function (data){
      $('#tenants_list').html('');
      $('#tenants_list_legal').html('');
      $.each(data, function (index, value){
        let cpf = (value.cpf) ? value.cpf : value.cnpj;
        let name = (value.legal_name) ? value.legal_name : value.company_name;
        let phone = (value.legal_phone) ? value.legal_phone : value.phone_procurator;
        let email = (value.legal_email) ? value.legal_email : value.email_procurator;
        phone = (phone == null)? '': phone;
        email = (email == null)? '': email;
        let property_owner = '';
        if (value.property_owner_legal) {
          property_owner = (value.property_owner_legal == '1') ? 'Sim' : 'Não';
        } else {
          property_owner = (value.property_owner_juridical == '1') ? 'Sim' : 'Não';
        }

        let property_owner_legal = $('#proprietario_imovel').text();
        if (property_owner_legal == 'Não') {
          if (property_owner == 'Sim') {
            $('#proprietario_imovel').html('Sim');
          } else {
            $('#proprietario_imovel').html('Não');
          }
        }

        $('#tenants_list').append('<tr>\
          <td>'+cpf+'</td>\
          <td>'+name+'</td>\
          <td>'+phone+'</td>\
          <td>'+email+'</td>\
          <td>'+property_owner+'</td>\
          <td>\
            <button type="button" name="button" class="btn btn-sm btn-danger remove_tenants_juridical"\
              data-id="'+value.id+'" data-id_requirement="'+value.id_requirement+'"\
              >X</button>\
          </td>\
        </tr>');

        $('#tenants_list_legal').append('<tr>\
          <td>'+cpf+'</td>\
          <td>'+name+'</td>\
          <td>'+phone+'</td>\
          <td>'+email+'</td>\
          <td>'+property_owner+'</td>\
          <td>\
            <button type="button" name="button" class="btn btn-sm btn-danger remove_tenants_legal"\
              data-id="'+value.id+'" data-id_requirement="'+value.id_requirement+'"\
              >X</button>\
          </td>\
        </tr>');
      });
    }
  });
});

$(document).on('click', '.add_new_tenants', function (){
  let id_requester = $('#id_requester').val();
  let id_requirement = $('#id_requirement').val();
  $.ajax({
    url: url_atual+'protocols/fetch_tenants',
    method: 'post',
    dataType: 'json',
    data: {id_requester:id_requester, id_requirement:id_requirement},
    success: function (data){
      $('#monthly_income_total').text('R$ '+data);
      let maximum_income = $('#maximum_family_income_detail').val();

      if (data > maximum_income) {
        $('#reurb').text('REURB-E');
        $('#reurb_type').val('REURB-E');
      } else {
        $('#reurb').text('REURB-S');
        $('#reurb_type').val('REURB-S');
      }
    }
  });
});

$(document).on('click', '#add_confrotants', function (){
  let qtd = $('.cpf_confrontants').length;

  $('#list_confrotants').append('<div class="row">\
    <div class="col-md-2">\
      <div class="form-group">\
        <label for="cpf_confrontants">Cpf</label>\
        <input type="text" name="cpf_confrontants[]" id="cpf" class="form-control cpf cpf_confrontants"\
          data-id_name="name_confrontants_'+qtd+'" data-id_nascimento="birth_date_confrontants_'+qtd+'"\
          value="">\
      </div>\
    </div>\
    <div class="col-md-3">\
      <div class="form-group">\
        <label for="name_confrontants">Nome</label>\
        <input type="text" name="name_confrontants[]" id="name_confrontants_'+qtd+'" class="form-control"\
          value="">\
      </div>\
    </div>\
    <div class="col-md-3">\
      <div class="form-group">\
        <label for="birth_date_confrontants">Data nacimento</label>\
        <input type="date" name="birth_date_confrontants[]" id="birth_date_confrontants_'+qtd+'" class="form-control"\
          value="">\
      </div>\
    </div>\
    <div class="col-md-4">\
      <div class="form-group">\
        <label for="confrontation_direction">Direção Confrontante</label>\
        <select class="form-control" name="confrontation_direction[]">\
          <option value=""></option>\
          <option value="Lado esquerdo">Lado esquerdo</option>\
          <option value="Lado direito">Lado direito</option>\
          <option value="Fundos">Fundos</option>\
        </select>\
        <span class="text-dark">*Descrever as confrontações de dentro do móvel olhando para rua</span>\
      </div>\
    </div>\
  </div>');
  $(".cpf").mask("999.999.999-99");
});

$(document).on('click', '#add_confrotants_juridical', function (){
  let qtd = $('.cpf_confrontants_juridical').length;
  $('#list_confrotants_juridical').append('<div class="row">\
    <div class="col-md-2">\
      <div class="form-group">\
        <label for="cpf_confrontants_juridical">Cpf</label>\
        <input type="text" name="cpf_confrontants_juridical[]" id="cpf_confrontants_juridical" class="form-control cpf cpf_confrontants"\
          data-id_name="name_confrontants_juridical_'+qtd+'" data-id_nascimento="birth_date_confrontants_juridical_'+qtd+'"\
          value="" >\
      </div>\
    </div>\
    <div class="col-md-3">\
      <div class="form-group">\
        <label for="name_confrontants_juridical">Nome</label>\
        <input type="text" name="name_confrontants_juridical[]" id="name_confrontants_juridical_'+qtd+'" class="form-control"\
          value="">\
      </div>\
    </div>\
    <div class="col-md-3">\
      <div class="form-group">\
        <label for="birth_date_confrontants_juridical">Data nacimento</label>\
        <input type="date" name="birth_date_confrontants_juridical[]" id="birth_date_confrontants_juridical_'+qtd+'" class="form-control"\
          value="">\
      </div>\
    </div>\
    <div class="col-md-4">\
      <div class="form-group">\
        <label for="confrontation_direction">Direção Confrontante</label>\
        <select class="form-control" name="confrontation_direction_juridical[]" id="confrontation_direction_juridical">\
          <option value=""></option>\
          <option value="Lado esquerdo">Lado esquerdo</option>\
          <option value="Lado direito">Lado direito</option>\
          <option value="Fundos">Fundos</option>\
        </select>\
        <span class="text-dark">*Descrever as confrontações de dentro do móvel olhando para rua</span>\
      </div>\
    </div>\
  </div>');
  $(".cpf").mask("999.999.999-99");
});


$(document).on('change', '.cpf_confrontants', function (){
  let cpf = $(this).val();
  let id_name = $(this).data('id_name');
  let id_nascimento = $(this).data('id_nascimento');
  $.ajax({
    url: url_atual+'protocols/isset_confrotant',
    method: 'post',
    dataType: 'json',
    data: {cpf:cpf},
    success: function (data){
      if (data) {
        $('#'+id_name).val(data.name);
        $('#'+id_nascimento).val(data.birth_date);
      } else {
        $('#'+id_name).val('');
        $('#'+id_nascimento).val('');
      }
    }
  });
});

$(document).on('click', '.add_new_confrotant', function (){
  let id_property = $(this).data('id_property');

  $('#id_property_confrotants').val(id_property);
});

$(document).on('change', '#marital_status_personal_register', function (){
  let civil_status = $(this).val();
  if (civil_status == 'Casado(a)') {
    $('#status_civil_spouse').hide();
    $('#marriage_regime_spouse_div').hide();
    $('#marital_status_spouse').val('');
    $('#marriage_regime_spouse').val('');
    $('#monthly_income_spouse_div').removeClass('pl-md-1');
  } else {
    $('#status_civil_spouse').show();
    $('#marriage_regime_spouse_div').show();
    $('#marital_status_spouse').val('');
    $('#marriage_regime_spouse').val('');
  }
});

$(document).on('change', '#repeat_password', function (){
  let repeat_password = $(this).val();
  let password = $('#password').val();

  if (repeat_password != password) {
    $('#error_password').show(200);
    $('#cadastrarPrefeitura').prop('disabled', true);
    $('#update_user').prop('disabled', true);
  } else {
    $('#error_password').hide(200);
    $('#cadastrarPrefeitura').prop('disabled', false);
    $('#update_user').prop('disabled', false);
  }
});

$(document).on('click', '.uploads', function (){
  let img = $(this).data('img');
  let id = $(this).data('id');
  let type = $(this).data('type');

  $('#img_4').attr('src', url_atual+'assets/build/img/propertys/'+img);
  $('#id_property_imagens').val(id);
  $('#type_img').val(type);
});

$(document).on('click', '#add_hit', function (){
  $('#append_hit').append(`<div class="row">
      <div class="col-md-2 pr-md-1">
        <div class="form-group">
          <label for="number_hit">Número</label>
          <input type="text" name="number_hit[]" id="number_hit" class="form-control">
        </div>
      </div>
      <div class="col-md-2 px-md-1">
        <div class="form-group">
          <label for="area_hit">Área m<sup>2</sup>/ha</label>
          <input type="text" name="area_hit[]" id="area_hit" class="form-control" >
        </div>
      </div>
      <div class="col-md-3 px-md-1">
        <div class="form-group">
          <label for="property_registration_hit">Cartório Registro de Imóveis</label>
          <input type="text" name="property_registration_hit[]" id="property_registration_hit" class="form-control" >
        </div>
      </div>
      <div class="col-md-3 px-md-1">
        <div class="form-group">
          <label for="owner_hit">Proprietário(s)</label>
          <input type="text" name="owner_hit[]" id="owner_hit" class="form-control" >
        </div>
      </div>
      <div class="col-md-2 pl-md-1">
        <div class="form-group">
          <label for="address_hit">Endereço</label>
          <input type="text" name="address_hit[]" id="address_hit" class="form-control">
        </div>
      </div>
    </div>`);

});

$(document).on('click', '#add_confrontant', function (){
  $('#append_confrontant').append(`<div class="row">
    <div class="col-md-2 pr-md-1">
      <div class="form-group">
        <label for="number_confrontant">Número</label>
        <input type="text" name="number_confrontant[]" id="number_confrontant" class="form-control">
      </div>
    </div>
    <div class="col-md-2 px-md-1">
      <div class="form-group">
        <label for="area_confrontant">Área m<sup>2</sup>/ha</label>
        <input type="text" name="area_confrontant[]" id="area_confrontant" class="form-control" >
      </div>
    </div>
    <div class="col-md-3 px-md-1">
      <div class="form-group">
        <label for="property_registration_confrontant">Cartório Registro de Imóveis</label>
        <input type="text" name="property_registration_confrontant[]" id="property_registration_confrontant" class="form-control" >
      </div>
    </div>
    <div class="col-md-3 px-md-1">
      <div class="form-group">
        <label for="owner_confrontant">Proprietário(s)</label>
        <input type="text" name="owner_confrontant[]" id="owner_confrontant" class="form-control" >
      </div>
    </div>
    <div class="col-md-2 pl-md-1">
      <div class="form-group">
        <label for="address_confrontant">Endereço</label>
        <input type="text" name="address_confrontant[]" id="address_confrontant" class="form-control">
      </div>
    </div>
  </div>`);
});

$(document).on('click', '#add_squatters', function (){
  $('#append_squatters').append(`<div class="row">
    <div class="col-md-6 pr-md-1">
      <div class="form-group">
        <label for="number_squatters">Nome</label>
        <input type="text" name="number_squatters[]" id="number_squatters" class="form-control">
      </div>
    </div>
    <div class="col-md-6 pl-md-1">
      <div class="form-group">
        <label for="area_squatters">Endereço</label>
        <input type="text" name="area_squatters[]" id="area_squatters" class="form-control" >
      </div>
    </div>
  </div>`);
});

$(document).on('click', '.visualizar_frontal', function (){
  let tipo = $(this).data('tipo');
  if (tipo == 'fisico') {
    $('.imagem_frontal').toggle(300);
  } else {
    $('.imagem_frontal_juridical').toggle(300);
  }
});

$(document).on('change', '.process_number', function (){
  let process_number = $(this).val();
  // let classe = $(this).data('classe');

  $.ajax({
    url: url_atual+'reurb_conclusion/fetch_stages_process',
    method: 'post',
    dataType: 'json',
    data: {process_number:process_number},
    success: function (data){
      // if (data.embarkation == '1') {
      //   $('.btn_modal_form').attr('disabled', true);
      //   $('.error_process_embarkation').show();
      // } else {
        $('.btn_modal_form').attr('disabled', false);
        $('.error_process_embarkation').hide();
      // }
    }
  });
});

$(document).on('change', '.cash_transfer_program', function (){
  let cash_transfer_program = $(this).val();

  if (cash_transfer_program == 1) {
    $('#input_federal_government_income').show();
  } else {
    $('#input_federal_government_income').hide();
  }
});

$(document).on('change', '.cash_transfer_program_spouse', function (){
  let cash_transfer_program = $(this).val();

  if (cash_transfer_program == 1) {
    $('#input_federal_government_income_spouse').show();
  } else {
    $('#input_federal_government_income_spouse').hide();
  }
});

$(document).on('click', '.files_embarkation', function (){
  let id = $(this).data('id');

  $('#id_embarkation').val(id);
});

$(document).on('click', '.edit_embarkation', function (){
  let id = $(this).data('id');
  let status = $(this).data('status');
  let legal_decision_analysis = $(this).data('legal_decision_analysis');
  let file_analysis = $(this).data('file_analysis');

  $('#id_embarkation_history').val(id);
  $('#status_embarkation').val(status);
  $('#legal_decision_analysis').val(legal_decision_analysis);
  // $('#file_analysis').val(file_analysis);
});

$(document).on('click', '.files_analysis', function (){
  let id = $(this).data('id');

  $('#id_embarkation_protocol').val(id);
});

$(document).on('change', '#responsible', function(){
 let cpfCnpj = $(this).val();

 $.ajax({
     url: url_atual+'protocols/fetch_cpf',
     method: 'post',
     dataType: 'json',
     data: {cpf_cnpj:cpfCnpj},
     success: function (data){
       if (data) {
         let name = (data.legal_name)? data.legal_name : data.company_name;
         let email = (data.legal_email)? data.legal_email : data.procurator_email;
         let phone = (data.legal_phone)? data.legal_phone : data.phone_procurator;
         $('#responsible_data').show();
         $('#responsible_name').html('<span class="font-weight-bold">Nome: </span>'+name);
         $('#responsible_email').html('<span class="font-weight-bold">Email: </span> '+email);
         $('#responsible_phone').html('<span class="font-weight-bold">Telefone: </span> '+phone);
         $('#id_requester_embarkation').val(data.id_requester);
       }
    }
   });
});

$(document).on('change', '#document_requester', function(){
 let cpfCnpj = $(this).val();

 $.ajax({
     url: url_atual+'forms/isset_cpf_cnpj',
     method: 'post',
     dataType: 'json',
     data: {cpf_cnpj:cpfCnpj},
     success: function (data){
       console.log(data);
       if (data) {
         let name = (data.legal_name)? data.legal_name : data.company_name;
         let phone = (data.legal_phone)? data.legal_phone : data.phone_procurator;
         let email = (data.legal_email)? data.legal_email : data.procurator_email;
         $('#id_requester').val(data.id);
         $('#name').html(`Nome: ${name}`);
         $('#phone').html(`Telefone: ${phone}`);
         $('#email').html(`Email: ${email}`);
       }
    }
   });
});

$(document).on('click', '#detailNotificaded', function(){
 let id = $(this).data('id');

 $.ajax({
     url: url_atual+'procedure_reurb/fetch_registration',
     method: 'post',
     dataType: 'json',
     data: {id:id},
     success: function (data){
       if (data) {
         $('#edit_registration_number').val(data.number_registration);
         $('#edit_owner_squatter').val(data.owner);
         $('#edit_cpf_cnpj').val(data.document);
         $('#edit_registration_area').val(data.area);
         $('#edit_real_estate_registry').val(data.id_notarys_office);

         $('#edit_public_place').val(data.public_place);
         $('#edit_number').val(data.number);
         $('#edit_neigborhood').val(data.neigborhood);
         $('#edit_cep').val(data.cep);
         $('#edit_country').val(data.country);
         if (data.notificaded_checking == '1') {
           $('#edit_notificaded_checking').attr('checked', true);
           $('#does_not_reside_in_the_property_detail').removeClass('d-none');
         } else {
           $('#edit_notificaded_checking').attr('checked', false);
           $('#does_not_reside_in_the_property_detail').addClass('d-none');
         }

         $('#edit_public_place_notificaded').val(data.public_place_notificaded);
         $('#edit_number_notificaded').val(data.number_notificaded);
         $('#edit_neigborhood_notificaded').val(data.neigborhood_notificaded);
         $('#edit_cep_notificaded').val(data.cep_notificaded);
         $('#edit_country_notificaded').val(data.country_notificaded);

         $('#edit_property_type').val(data.property_type);
         $('#edit_property_situation').val(data.property_situation);
         $('#edit_notified_type').val(data.notified_type);
         $('#edit_procedure_type').val(data.procedure_type);

         $('#edit_name_notificaded').val(data.name_notificaded);
         $('#edit_cpf_notificaded').val(data.cpf_notificaded);
         $('#edit_occupation_notificaded').val(data.occupation_notificaded);

         $('#receiving_date').val(data.receiving_date);
         $('#deadline_manifestation').val(data.deadline_manifestation);
         $('#type_manifestation').val(data.type_manifestation);

         $('#id_registration').val(data.id_registration);
       }
    }
   });
});

$('#notificaded_checking').on('change', () => {
  $('#does_not_reside_in_the_property').toggleClass('d-none');
});

$('#edit_notificaded_checking').on('change', () => {
  $('#does_not_reside_in_the_property_detail').toggleClass('d-none');
});

$(document).on('click', '.modalGerarNotificacao', function (){
  // União, Estado, Confrontantes
  const typeNotification = $(this).data('notificacao');
  const id = $(this).data('id');
  $('#id_notification').val(id);

  if (typeNotification == 'União') {
    $('#notification_type').val('União');
    $('#text_notification').text('União');
  } else if(typeNotification == 'Estado') {
    $('#notification_type').val('Estado');
    $('#text_notification').text('Estado');
  } else {
    $('#notification_type').val('Confrontantes do Núcleo(Proprietário de Domínio)');
    $('#text_notification').text('Confrontantes');
  }
});

$(document).on('click', '.modalUploadNotificacao', function (){
  // União, Estado, Confrontantes
  const typeNotification = $(this).data('notificacao');
  const idRegistration = $(this).data('id_registration');

  $('#id_registration_upload').val(idRegistration);
  if (typeNotification == 'União') {
    $('#notification_type_upload').val('União');
    $('#text_notification_upload').text('União');
  } else if(typeNotification == 'Estado') {
    $('#notification_type_upload').val('Estado');
    $('#text_notification_upload').text('Estado');
  } else {
    $('#notification_type_upload').val('Confrontantes do Núcleo(Proprietário de Domínio)');
    $('#text_notification_upload').text('Confrontantes');
  }
});

$(document).on('click', '.modal_title_individual', function (){
  let id = $(this).data('id');
  let classification_reurb = $(this).data('classification_reurb');
  let embarkation = $(this).data('embarkation');
  if (embarkation == 1) {
    $('#errorProcessEmbarkation').show();
    $('#dataFormGenerateIndividual').hide();
    $('.land_regularization_certificate').hide();
  } else {
    $('#errorProcessEmbarkation').hide();
    $('#dataFormGenerateIndividual').show();
    $('.land_regularization_certificate').show();
  }

  $('#process_number_title').val(id);
  $('.modalidade').val(classification_reurb);
});

$(document).on('click', '.imprimir_word_listagem', function (){
  let impressao_listagem = $('#impressao_listagem').val();

  $('#modalidade_listagem_ocupantes').val(impressao_listagem);
});

$(document).on('click', '.buttonGenerateLegitimationTitle', function (){
  let impressao_listagem = $('#modality_legitimation_title').val();

  $('#modalidade_listagem_todos_ocupantes').val(impressao_listagem);
});

// $(document).on('change', '.etapa', function (){
//   let stage = $(this).val();
//   let processo = $(this).data('processo');
//   let process_number = $('.'+processo).val();
//
//   $.ajax({
//     url: url_atual+'reurb_conclusion/isset_stage',
//     method: 'post',
//     dataType: 'json',
//     data: {process_number:process_number, stage:stage},
//     success: function (data){
      // $('.modalidade').val(data.modality);
      // $('.cartorio').val(data.)
      // $('.land_regularization_certificate').attr('href', url_atual+'forms/land_regularization_certificate/'+data.id);
//     }
//   });
// });

//TODO: Criar uma solução em que apenas aumente a especificidade do css
//TODO: pois a solução atual contém um bug que pega apenas uma parte da url

// $(document).on('click', '.reduce_menu', function(e){
//   e.preventDefault();
//   console.log("reduce");

//   $('<link/>', {
//      rel: 'stylesheet',
//      type: 'text/css',
//      href: 'assets/build/css/reduced.css'
//   }).addClass('reduced').appendTo('head');

//   $(this).removeClass("reduce_menu").addClass("expand_menu");
//   $(this).text(">>");
// });

// $(document).on('click', '.expand_menu', function(e){
//   e.preventDefault();
//   console.log("expand");

//   $("link.reduced").remove();

//   $(this).removeClass("expand_menu").addClass("reduce_menu");
//   $(this).text("<<");
// });

$(document).on('click', '.edit_protocol_conpletion', function (){
  const id = $(this).data('id');
  const status = $(this).data('status');
  const responsible = $(this).data('responsible');
  const reason = $(this).data('reason');
  const date = $(this).data('date');

  if (status == '0') {
    $('#div_cancel_motivo').show();
    $('#update_protocol_history').show();
  } else {
    $('#div_cancel_motivo').hide();
    $('#update_protocol_history').hide();
  }

  $('#edit_responsible').val(responsible);
  $('#edit_reason').val(reason);
  $('#id_protocol_history').val(id);
  $('#status_protocol_history').val(status);
  $('#date_protocol_history').val(date);
  $('#edit_status_protocol_history').val((status == '0') ? 'Conclusão Cancelada' : 'Concluído');
});

$(document).on('click', '.edit_requester_conpletion', function (){
  const id = $(this).data('id');
  const status = $(this).data('status');
  const responsible = $(this).data('responsible');
  const date = $(this).data('date');
  const reason = $(this).data('reason');
  if (status == '0') {
    $('#div_cancel_motivo').show();
    $('#update_requester_history').show();
  } else {
    $('#div_cancel_motivo').hide();
    $('#update_requester_history').hide();
  }

  // $('#edit_responsible').val(responsible);
  $('#edit_reason').val(reason);
  $('#id_requester_history').val(id);
  $('#status_requester_history').val(status);

  $('#date_requester_history').val(date);
  $('#responsible_requester_history').val(responsible);
  $('#status_requester_history').val((status == '0') ? 'Conclusão Cancelada' : 'Concluído');
});

$(document).on('click', '.add_notification', event => {
  const self = event.target;

  let registration_number = $('#registration_number').val();
  let owner_squatter = $('#owner_squatter').val();
  let cpf_cnpj = $('#cpf_cnpj').val();

  let registration_area = $('#registration_area').val();
  let real_estate_registry = $('#real_estate_registry').val();
  let public_place = $('#public_place').val();
  let number = $('#number').val();
  let neigborhood = $('#neigborhood').val();
  let cep = $('#cep').val();
  let country = $('#country').val();
  let notificaded_checking = $('#notificaded_checking').val();
  let public_place_notificaded = $('#public_place_notificaded').val();
  let number_notificaded = $('#number_notificaded').val();
  let neigborhood_notificaded = $('#neigborhood_notificaded').val();
  let cep_notificaded = $('#cep_notificaded').val();
  let country_notificaded = $('#country_notificaded').val();
  let property_type = $('#property_type').val();
  let property_situation = $('#property_situation').val();
  let notified_type = $('#notified_type').val();
  let procedure_type = $('#procedure_type').val();
  let name_notificaded = $('#name_notificaded').val();
  let cpf_notificaded = $('#cpf_notificaded').val();
  let occupation_notificaded = $('#occupation_notificaded').val();

  const listNotifications = $('.list-notifications');
  if (listNotifications.length == 0) {
    $('#tbody-notificacao').html('');
  }

  $('#tbody-notificacao').append(`<tr class="list-notifications notification-${listNotifications.length}">
    <td>${registration_number}</td>
    <td>${owner_squatter}</td>
    <td>${cpf_cnpj}</td>
    <td>
      <button type="button" class="btn btn-sm btn-danger removeNotification"
        data-notification="notification-${listNotifications.length}">
        Remover
      </button>
    </td>
    <input type="hidden" name="registration_number[]" value="${registration_number}">
    <input type="hidden" name="owner_squatter[]" value="${owner_squatter}">
    <input type="hidden" name="cpf_cnpj[]" value="${cpf_cnpj}">
    <input type="hidden" name="registration_area[]" value="${registration_area}">
    <input type="hidden" name="real_estate_registry[]" value="${real_estate_registry}">
    <input type="hidden" name="public_place[]" value="${public_place}">
    <input type="hidden" name="number[]" value="${number}">
    <input type="hidden" name="neigborhood[]" value="${neigborhood}">
    <input type="hidden" name="cep[]" value="${cep}">
    <input type="hidden" name="country[]" value="${country}">
    <input type="hidden" name="notificaded_checking[]" value="${notificaded_checking}">
    <input type="hidden" name="public_place_notificaded[]" value="${public_place_notificaded}">
    <input type="hidden" name="number_notificaded[]" value="${number_notificaded}">
    <input type="hidden" name="neigborhood_notificaded[]" value="${neigborhood_notificaded}">
    <input type="hidden" name="cep_notificaded[]" value="${cep_notificaded}">
    <input type="hidden" name="country_notificaded[]" value="${country_notificaded}">
    <input type="hidden" name="property_type[]" value="${property_type}">
    <input type="hidden" name="property_situation[]" value="${property_situation}">
    <input type="hidden" name="notified_type[]" value="${notified_type}">
    <input type="hidden" name="procedure_type[]" value="${procedure_type}">
    <input type="hidden" name="name_notificaded[]" value="${name_notificaded}">
    <input type="hidden" name="cpf_notificaded[]" value="${cpf_notificaded}">
    <input type="hidden" name="occupation_notificaded[]" value="${occupation_notificaded}">
  </tr>`);
});

$(document).on('click', '.removeNotification', event => {
  const self = event.target;

  const classNotification = $(self).data('notification');
  $(`.${classNotification}`).html('');
});
$(document).on('click', '#btnSalvarAlteracao', function(){
  $("#idTypeForm").val('0')
  console.log("Salvei Alteração")
});
$(document).on('click', '#update_requester', function(){
  $("#idTypeForm").val('1')
});