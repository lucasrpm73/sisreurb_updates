<div id="load" style="display: none;">
  <div class="loader"></div>
</div>


<footer class="footer footer-black  footer-white ">
  <div class="container-fluid">

  </div>
</footer>
</div>
</div>
<!--   Core JS Files   -->
<script src="<?php echo base_url() ?>assets/build/js/core/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/build/js/core/popper.min.js"></script>
<script src="<?php echo base_url() ?>assets/build/js/core/bootstrap.min.js"></script>


<script src="<?php echo base_url() ?>assets/build/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/build/js/plugins/bootstrap-notify.js"></script>
<script src="<?php echo base_url() ?>assets/build/js/plugins/paper-dashboard.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/build/js/plugins/chartjs.min.js"></script>

<script src="<?php echo base_url() ?>assets/build/js/plugins/fontawesome.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/build/js/plugins/jquery.mask.js"></script>
<script src="<?php echo base_url(); ?>assets/build/js/plugins/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>assets/build/js/plugins/valida_cpf_cnpj.js"></script>
<script src="<?php echo base_url(); ?>assets/build/js/plugins/jquery.maskMoney.min.js"></script>
<script src="<?php echo base_url(); ?>assets/build/js/plugins/endereco.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


<script src="<?php echo base_url() ?>assets/build/js/app.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/build/js/tabelas.js"></script>

<div class="modais">



</div>


<script type="text/javascript">
  $(document).on('click', '.chama_modal', function () {
    var tipo_modal = $(this).data('id');
    console.log(tipo_modal);
    $.get('<?php echo base_url(); ?>modais/' + tipo_modal, function (response) {
      $('.modais').html(response);

      setTimeout(function () {
        $('#' + tipo_modal).modal('show');
      }, 200);
    });


  });
</script>

<script type="text/javascript">
  $(document).ready(function () {
    $('.select_write').select2();

    // $("#birth_date").mask("99/99/9999");
    $("#phone").mask("(99) 99999-9999");
    $(".phone").mask("(99) 99999-9999");
    $("#phone_fixed").mask("(99) 9999-9999");
    $("#cpf").mask("999.999.999-99");
    $(".cpf").mask("999.999.999-99");
    $("#cep").mask("99999-999");
    $(".cep").mask("99999-999");
    $("#cnpj").mask("99.999.999/9999-99");
    $(".cnpj").mask("99.999.999/9999-99");
    $(".processo").mask("999.9999");
    $(".cep").mask("99999-999");
    $(".cns").mask("99.999-9");
    // $(".cpf_cnpj").mask("99.999-9");

    $(".valor").maskMoney({
      prefix: "",
      decimal: ".",
      thousands: "",
    });

    $(".venal").maskMoney({
      prefix: "",
      decimal: ",",
      thousands: ".",
    });

    var options = {
      onKeyPress: function (cpf, ev, el, op) {
        var masks = ['000.000.000-000', '00.000.000/0000-00'];
        $('.cpfCnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
      }
    }

    $('.cpfCnpj').length > 11 ? $('.cpfCnpj').mask('00.000.000/0000-00', options) : $('.cpfCnpj').mask(
      '000.000.000-00#', options);


  });


  function verifyImmobileData() {
    const registerType = $("#requester_type");
    const fields = [];
    let aux;

    aux = true;

    if (registerType.val() == "fizico") {
      // fizico
      if ($('#real_state_home').val() == "") {
        aux = false;
        fields.push("real_state_home");
      }
      if ($('#sector').val() == "") {
        aux = false;
        fields.push("sector");
      }
      if ($('#city_block').val() == "") {
        aux = false;
        fields.push("city_block");
      }
      if ($('#allotment').val() == "") {
        aux = false;
        fields.push("allotment");
      }
      if ($('#property_registration_number').val() == "") {
        aux = false;
        fields.push("property_registration_number");
      }
      if ($('#realty_type_home').val() == "") {
        aux = false;
        fields.push("realty_type_home");
      }
      if ($('#realty_address_home').val() == "") {
        aux = false;
        fields.push("realty_address_home");
      }
      if ($('#realty_number_home').val() == "") {
        aux = false;
        fields.push("realty_number_home");
      }
      if ($('#realty_neighborhood_home').val() == "") {
        aux = false;
        fields.push("realty_neighborhood_home");
      }
      if ($('#georeferenced_property_area').val() == "") {
        aux = false;
        fields.push("georeferenced_property_area");
      }
      if ($('#venal').val() == "") {
        aux = false;
        fields.push("venal");
      }
      if ($('#slab_right').val() == "") {
        aux = false;
        fields.push("slab_right");
      }
      if ($('#type_property').val() == "") {
        aux = false;
        fields.push("type_property");
      }


    } else {
      // juridico
      if ($('#real_state_juridical').val() == "") {
        aux = false;
        fields.push("real_state_juridical");
      }
      if ($('#sector_juridical').val() == "") {
        aux = false;
        fields.push("sector_juridical");
      }
      if ($('#city_block_juridical').val() == "") {
        aux = false;
        fields.push("city_block_juridical");
      }
      if ($('#allotment_juridical').val() == "") {
        aux = false;
        fields.push("allotment_juridical");
      }
      if ($('#property_registration_number_juridical').val() == "") {
        aux = false;
        fields.push("property_registration_number_juridical");
      }
      if ($('#residential_property_juridical').val() == "") {
        aux = false;
        fields.push("residential_property_juridical");
      }
      if ($('#realty_address_juridical').val() == "") {
        aux = false;
        fields.push("realty_address_juridical");
      }
      if ($('#realty_number_juridical').val() == "") {
        aux = false;
        fields.push("realty_number_juridical");
      }
      if ($('#realty_neighborhood_juridical').val() == "") {
        aux = false;
        fields.push("realty_neighborhood_juridical");
      }
      if ($('#georeferenced_property_area_juridical').val() == "") {
        aux = false;
        fields.push("georeferenced_property_area_juridical");
      }
      if ($('#venal_juridical').val() == "") {
        aux = false;
        fields.push("venal_juridical");
      }
      if ($('#slab_right_juridical').val() == "") {
        aux = false;
        fields.push("slab_right_juridical");
      }
      if ($('#type_property_juridical').val() == "") {
        aux = false;
        fields.push("type_property_juridical");
      }
    }

    return {
      status: aux,
      fields
    };
  }

  $(document).on('click', '#finish_register_protocols', function () {
    console.log($('#type_property'))
    const {
      status,
      fields
    } = verifyImmobileData();
    const modalBody = $("#modal_conclusion_confirm_body");
    const modalTitle = $("#label_modal_confirmation");
    const modalButton = $("#id_protocol_history");
    const modalTitleValue = modalTitle.val();

    console.log(status)
    if (status)
      if (status) return;


    const fieldsListElement = () => {
      const div = document.createElement("div");
      const template = `
      <ul>
        ${fields.map((field) => `
          <li>${$(`#${field}`).data("field")}</li>
        `).join("")}
      </ul>
     `;
      div.innerHTML = template;

      return div.firstElementChild;
    }

    if (fields.length > 0) {
      modalTitle.text(
        "Não é possivel finalizar o seu cadastro porque os campos abaixo não estão preenchidos.  Obs.: Necessário salvar os dados para poder concluir cadastro."
      );
      modalButton.attr("disabled", true);
      modalBody.append(fieldsListElement);

      return;
    }

    modalBody.html("");
    modalTitle.text("Tem certeza de que deseja concluir o cadastro?");
    modalButton.removeAttr("disabled");
  });

  $(document).on('click', '#finish_register', function () {
    const {
      status,
      fields
    } = verifyImmobileData();
    const modalBody = $("#modal_conclusion_confirm_body");
    const modalTitle = $("#label_modal_confirmation");
    const modalButton = $("#id_protocol_history");
    const modalTitleValue = modalTitle.val();


    if (status) return;

    const fieldsListElement = () => {
      const div = document.createElement("div");
      const template = `
      <ul>
        ${fields.map((field) => `
          <li>${$(`#${field}`).data("field")}</li>
        `).join("")}
      </ul>
     `;
      div.innerHTML = template;

      return div.firstElementChild;
    }

    if (fields.length > 0) {
      modalTitle.text(
        "Não é possivel finalizar o seu cadastro porque os campos abaixo não estão preenchidos.  Obs.: Necessário salvar os dados para poder concluir cadastro."
      );
      modalButton.attr("disabled", true);
      modalBody.append(fieldsListElement);

      return;
    }

    modalBody.html("");
    modalTitle.text("Tem certeza de que deseja concluir o cadastro?");
    modalButton.removeAttr("disabled");
  });

  // $(document).on('change', '#marital_status_personal', function () {
  //   const self = $(this);
  //   if (self.val() == "Casado(a)") {
  //     $("#name_spouse").attr("required", true);
  //     $("#cpf_spouse").attr("required", true);
  //     $("#rg_spouse").attr("required", true);
  //     $("#orgao_expedidor_spouse").attr("required", true);
  //     $("#profession_spouse").attr("required", true);
  //     $("#date_of_birth_spouse").attr("required", true);
  //     $("#gender_spouse").attr("required", true);
  //     $("#nationality_spouse").attr("required", true);
  //     $("#mother_name_spouse").attr("required", true);
  //     $("#father_name_spouse").attr("required", true);
  //     $("#marital_status_spouse").attr("required", true);
  //     $("#marriage_regime_spouse").attr("required", true);
  //     $("#property_owner_spouse").attr("required", true);

  //     $("#name_spouse_warn").removeClass("d-none");
  //     $("#cpf_spouse_warn").removeClass("d-none");
  //     $("#rg_spouse_warn").removeClass("d-none");
  //     $("#orgao_expedidor_spouse_warn").removeClass("d-none");
  //     $("#profession_spouse_warn").removeClass("d-none");
  //     $("#date_of_birth_spouse_warn").removeClass("d-none");
  //     $("#gender_spouse_warn").removeClass("d-none");
  //     $("#nationality_spouse_warn").removeClass("d-none");
  //     $("#mother_name_spouse_warn").removeClass("d-none");
  //     $("#father_name_spouse_warn").removeClass("d-none");
  //     $("#marital_status_spouse_warn").removeClass("d-none");
  //     $("#marriage_regime_spouse_warn").removeClass("d-none");
  //     $("#property_owner_spouse_warn").removeClass("d-none");
  //     console.log(self.val());


  //     return;
  //   }
  //   $("#name_spouse").removeAttr("required");
  //   $("#cpf_spouse").removeAttr("required");
  //   $("#rg_spouse").removeAttr("required");
  //   $("#orgao_expedidor_spouse").removeAttr("required");
  //   $("#profession_spouse").removeAttr("required");
  //   $("#monthly_income_spouse").removeAttr("required");
  //   $("#date_of_birth_spouse").removeAttr("required");
  //   $("#gender_spouse").removeAttr("required");
  //   $("#nationality_spouse").removeAttr("required");
  //   $("#mother_name_spouse").removeAttr("required");
  //   $("#father_name_spouse").removeAttr("required");
  //   $("#marital_status_spouse").removeAttr("required");
  //   $("#marriage_regime_spouse").removeAttr("required");
  //   $("#property_owner_spouse").removeAttr("required");

  //   $("#name_spouse_warn").addClass("d-none");
  //   $("#cpf_spouse_warn").addClass("d-none");
  //   $("#rg_spouse_warn").addClass("d-none");
  //   $("#orgao_expedidor_spouse_warn").addClass("d-none");
  //   $("#profession_spouse_warn").addClass("d-none");
  //   $("#date_of_birth_spouse_warn").addClass("d-none");
  //   $("#gender_spouse_warn").addClass("d-none");
  //   $("#nationality_spouse_warn").addClass("d-none");
  //   $("#mother_name_spouse_warn").addClass("d-none");
  //   $("#father_name_spouse_warn").addClass("d-none");
  //   $("#marital_status_spouse_warn").addClass("d-none");
  //   $("#marriage_regime_spouse_warn").addClass("d-none");
  //   $("#property_owner_spouse_warn").addClass("d-none");
  // });

  function verifyPartnersFieldStatus() {
    const fields = [];
    let aux;

    aux = true;

    if ($('#name_personal').val() == "") {
      aux = false;
      fields.push("name_personal");
    }
    if ($('#cpf_personal').val() == "") {
      aux = false;
      fields.push("cpf_personal");
    }
    if ($('#rg_personal').val() == "") {
      aux = false;
      fields.push("rg_personal");
    }
    if ($('#consignor_organ').val() == "") {
      aux = false;
      fields.push("consignor_organ");
    }
    if ($('#profession_personal').val() == "") {
      aux = false;
      fields.push("profession_personal");
    }
    if ($('#monthly_income_personal').val() == "") {
      aux = false;
      fields.push("monthly_income_personal");
    }
    if ($('#date_of_birth_personal').val() == "") {
      aux = false;
      fields.push("date_of_birth_personal");
    }
    if ($('#gender_personal').val() == "") {
      aux = false;
      fields.push("gender_personal");
    }
    if ($('#nationality_personal').val() == "") {
      aux = false;
      fields.push("nationality_personal");
    }
    if ($('#marital_status_personal').val() == "") {
      aux = false;
      fields.push("marital_status_personal");
    }
    if ($('#date_marriage_personal').val() == "") {
      aux = false;
      fields.push("date_marriage_personal");
    }
    if ($('#marriage_regime_personal').val() == "") {
      aux = false;
      fields.push("marriage_regime_personal");
    }
    if ($('#mother_name_personal').val() == "") {
      aux = false;
      fields.push("mother_name_personal");
    }
    if ($('#father_name_personal').val() == "") {
      aux = false;
      fields.push("father_name_personal");
    }
    if ($('#property_owner_personal').val() == "") {
      aux = false;
      fields.push("property_owner_personal");
    }
    

    if ($('#name_spouse').val() == "") {
      aux = false;
      fields.push("name_spouse");
    }
    if ($('#cpf_spouse').val() == "") {
      aux = false;
      fields.push("cpf_spouse");
    }
    if ($('#rg_spouse').val() == "") {
      aux = false;
      fields.push("rg_spouse");
    }
    if ($('#orgao_expedidor_spouse').val() == "") {
      aux = false;
      fields.push("orgao_expedidor_spouse");
    }
    if ($('#profession_spouse').val() == "") {
      aux = false;
      fields.push("profession_spouse");
    }
    if ($('#monthly_income_spouse').val() == "") {
      aux = false;
      fields.push("monthly_income_spouse");
    }
    if ($('#date_of_birth_spouse').val() == "") {
      aux = false;
      fields.push("date_of_birth_spouse");
    }
    if ($('#gender_spouse').val() == "") {
      aux = false;
      fields.push("gender_spouse");
    }
    if ($('#nationality_spouse').val() == "") {
      aux = false;
      fields.push("nationality_spouse");
    }
    if ($('#mother_name_spouse').val() == "") {
      aux = false;
      fields.push("mother_name_spouse");
    }
    if ($('#father_name_spouse').val() == "") {
      aux = false;
      fields.push("father_name_spouse");
    }
    if ($('#property_owner_spouse').val() == "") {
      aux = false;
      fields.push("property_owner_spouse");
    }
    return {
      status: aux,
      fields
    };
  }

  function verifyFieldStatus() {
    const fields = [];
    let aux;

    aux = true;

    if ($('#name_personal').val() == "") {
      aux = false;
      fields.push("name_personal");
    }
    if ($('#cpf_personal').val() == "") {
      aux = false;
      fields.push("cpf_personal");
    }
    if ($('#rg_personal').val() == "") {
      aux = false;
      fields.push("rg_personal");
    }
    if ($('#consignor_organ').val() == "") {
      aux = false;
      fields.push("consignor_organ");
    }
    if ($('#profession_personal').val() == "") {
      aux = false;
      fields.push("profession_personal");
    }
    if ($('#monthly_income_personal').val() == "") {
      aux = false;
      fields.push("monthly_income_personal");
    }
    if ($('#date_of_birth_personal').val() == "") {
      aux = false;
      fields.push("date_of_birth_personal");
    }
    if ($('#gender_personal').val() == "") {
      aux = false;
      fields.push("gender_personal");
    }
    if ($('#nationality_personal').val() == "") {
      aux = false;
      fields.push("nationality_personal");
    }
    if ($('#mother_name_personal').val() == "") {
      aux = false;
      fields.push("mother_name_personal");
    }
    if ($('#father_name_personal').val() == "") {
      aux = false;
      fields.push("father_name_personal");
    }
    if ($('#property_owner_personal').val() == "") {
      aux = false;
      fields.push("property_owner_personal");
    }
    if ($('#marital_status_personal').val() == "") {
      aux = false;
      fields.push("marital_status_personal");
    }
    return {
      status: aux,
      fields
    };
  }
  
  $("#finish_register_requesters").on("click", function() {
    $("#update_requester_forms").submit();
  });
  
  $("#conclusao_cadastro").on("click", function () {
    const modalBody = $("#modal_conclusion_confirm_body");
    const modalAviso = $("#label_modal_aviso");
    const modalTitle = $("#label_modal_confirmation");
    const maritalStatusValue = $("#marital_status_personal").val();
    const modalTitleValue = modalTitle.val();
    const modalAvisoValue = modalAviso.val();
    const modalSubmitButton = $("#update_requester");
    let haveChanged = $("#have_changed").val();
    if (haveChanged == 1) {
      modalTitle.text("Obs: Necessário salvar os dados para poder concluir o cadastro");
      modalSubmitButton.attr("disabled", true);
      return;
    }

    if (maritalStatusValue === "Casado(a)") {
      const {
        status,
        fields
      } = verifyPartnersFieldStatus();
      if (!status) {
        const fieldsListElement = () => {
          const div = document.createElement("div");
          const template = `
                <ul>
                  ${fields.map((field) => `
                    <li>${$(`#${field}`).data("field")}</li>
                  `).join("")}
                </ul>
            `;
          div.innerHTML = template;
          return div.firstElementChild;
        }
        modalBody.html("");
        modalBody.append(fieldsListElement);
      }


      if (fields.length > 0) {
        console.log("------------------------------------>Dentro do If")
        modalTitle.text("Não é possivel finalizar o seu cadastro porque os campos abaixo não estão preenchido");

        modalSubmitButton.attr("disabled", true);
      } else {
        console.log("------------------------------------>Dentro do Else")
        $(modalBody).html("");
        modalTitle.text("Tem certeza de que deseja concluir o cadastro?");
        modalSubmitButton.removeAttr("disabled");
      }

    }
  });
  $("#conclusao_cadastro_2").on("click", function () {
    const modalBody = $("#modal_conclusion_confirm_body");
    const modalAviso = $("#label_modal_aviso");
    const modalTitle = $("#label_modal_confirmation");
    const modalSubmitButton = $("#finish_register_protocols");
    const maritalStatusValue = $("#marital_status_personal").val();
    const modalTitleValue = modalTitle.text();
    const modalAvisoValue = modalAviso.val();
    let haveChanged = $("#have_changed").val();

    if (haveChanged == 1) {
      modalTitle.text("Obs: Necessário salvar os dados para poder concluir o cadastro");
      modalSubmitButton.attr("disabled", true);
      return;
    }
    const {
      status,
      fields
    } = verifyImmobileData();

    const fieldsListElement = () => {
      const div = document.createElement("div");

      const template = `
        <ul>
          ${fields.map((field) => `
            <li>${$(`#${field}`).data("field")}</li>
          `).join("")}
        </ul>
     `;
      div.innerHTML = template;

      return div.firstElementChild;
    }
    modalBody.html("");
    modalBody.append(fieldsListElement);

    if (fields.length > 0) {
      modalTitle.text("Não é possivel finalizar o seu cadastro porque os campos abaixo não estão preenchido");

      modalSubmitButton.attr("disabled", true);
    } else {
      $(modalBody).html("");
      modalTitle.text("Tem certeza de que deseja concluir o cadastro?");
      modalSubmitButton.removeAttr("disabled");
    }

    return;

    $(modalBody).html("");
    modalTitle.text("Tem certeza de que deseja concluir o cadastro?");
    modalSubmitButton.removeAttr("disabled");

  });
</script>

</body>

</html>