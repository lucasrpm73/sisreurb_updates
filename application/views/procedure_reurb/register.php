<?php $this->load->view('elements/header'); ?>
<div class="wrapper ">
  <?php $this->load->view('elements/sidebar_lateral'); ?>
  <?php $this->load->view('elements/sidebar'); ?>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- INI: AVISOS -->
        <?php if (!empty($error)) { ?>
          <div class="alert alert-<?php echo $error['error_type']; ?>" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <?php echo $error['error_string']; ?>
          </div>
        <?php } ?>
        <!-- INI: AVISOS -->
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form action="<?php echo base_url(); ?>procedure_reurb/register_procedure" method="post">
            <div class="card-header">
              <h5 class="card-title">Cadastro de Gestão de procedimentos de REURB</h5>
              <hr>
            </div>
            <div class="card-body">
              <div id="process_number" class="row justify-content-center align-items-center">
                <div class="col-md-6 col-sm-12 ">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control processo" name="process_number" placeholder="Número do processo" id="process_number_input">
                    <div class="input-group-append">
                      <span class="input-group-text bg-primary text-white" id="basic-addon2"><i class="fas fa-search ml-2 mx-1"></i>Prosseguir</span>
                    </div>
                  </div>
                  <div class="col-md-8 alert_process_number" style="color: red; display: none;">
                    <div class="row">
                      <div class="col-md-12">
                        <p class="d-inline">Esse processo já existe!!</p>
                        <select class="form-control col-md-6" name="stage_edit" id="stage_edit">
                          <option value="" disabled selected>Etapas</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mr-2">
                        <a href="" class="btn btn-primary" id="edit_reurb" disabled>Quero alterar</a>
                      </div>
                      <div class="col-md-4">
                        <button type="button" name="button" class="btn btn-primary new_stage">Criar nova etapa</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="register_procedure_data" style="display: none;">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#dados">Dados</a>
                  </li>
                  <!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#home">Requerentes</a>
                  </li> -->
                  <!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Matrículas e notificações</a>
                  </li> -->
                  <!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">Listagem dos ocupantes e títulos de legitimação</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu3">Indicação numerica das unidades regularizadas</a>
                  </li> -->
                </ul>
                <div class="tab-content">
                  <div id="dados" class="tab-pane active py-2">
                    <div class="row">
                      <div class="col-md pr-md-1">
                        <div class="form-group">
                          <label for="stage">Etapa</label>
                          <select class="form-control" name="stage" id="stage">
                            <option value=""></option>
                            <option value="01" class="stage_01">I</option>
                            <option value="02" class="stage_02">II</option>
                            <option value="03" class="stage_03">III</option>
                            <option value="04" class="stage_04">IV</option>
                            <option value="05" class="stage_05">V</option>
                            <option value="06" class="stage_06">VI</option>
                            <option value="07" class="stage_07">VII</option>
                            <option value="08" class="stage_08">VIII</option>
                            <option value="09" class="stage_09">IX</option>
                            <option value="10" class="stage_10">X</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md px-md-1">
                        <div class="form-group">
                          <label for="modalidade">Rito</label>
                          <select name="rito" class="form-control" id="rito">
                            <option value=""></option>
                            <option value="Demarcação Urbanística Prévia">Demarcação Urbanística Prévia</option>
                            <option value="Sem Demarcação Urbanística Prévia">Sem Demarcação Urbanística Prévia</option>
                            <option value="Inominada">Inominada</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md px-md-1">
                        <div class="form-group">
                          <label for="core_name">Nome do Núcleo</label>
                          <input type="text" name="core_name" id="core_name" class="form-control">
                        </div>
                      </div>
                      <div class="col-md pl-md-1">
                        <div class="form-group">
                          <label for="total_regularized_area">Área total regularizada m²</label>
                          <input type="text" name="total_regularized_area" id="total_regularized_area" class="form-control venal">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md pr-md-1 ">
                        <div class="form-group">
                          <label for="requester">Requerente</label>
                          <input type="text" name="requester" id="requester" class="form-control">
                        </div>
                      </div>
                      <div class="col-md pl-md-1">
                        <div class="form-group">
                          <label for="date_requester">Data requerimento</label>
                          <input type="date" name="date_requester" id="date_requester" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md pr-md-1 ">
                        <div class="form-group">
                          <label for="irregular_parceler">Parcelador/Empreendedor irregular</label>
                          <input type="text" name="irregular_parceler" id="irregular_parceler" class="form-control">
                        </div>
                      </div>
                      <div class="col-md pl-md-1">
                        <div class="form-group">
                          <label for="modalidade">Modalidade</label>
                          <select name="" class="form-control" id="modalidade">
                            <option value=""></option>
                            <option value="REURB-S">REURB-S</option>
                            <option value="REURB-E">REURB-E</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md pr-md-1">
                        <div class="form-group">
                          <label for="decision">Decisão</label>
                          <select name="" class="form-control" id="decision">
                            <option value=""></option>
                            <option value="Instauradora">Instauradora</option>
                            <option value="Denegátoria">Denegátoria</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md pl-md-1">
                        <div class="form-group">
                          <label for="profession_personal">Data de decisão</label>
                          <input type="date" name="decision_date" id="decision_date" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md pr-md-1">
                        <div class="form-group">
                          <label for="end_date">Data de Finalização</label>
                          <input type="date" name="end_date" value="" class="form-control" id="end_date">
                        </div>
                      </div>
                      <div class="col-md px-md-1">
                        <div class="form-group">
                          <label for="publication_procedure">Publicação do procedimento</label>
                          <input type="date" name="publication_procedure" value="" class="form-control" id="publication_procedure">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3 pr-md-1">
                        <div class="form-group">
                          <label for="original_registration">Matrícula originária da REURB</label>
                          <input type="text" name="original_registration" value="" class="form-control" id="original_registration">
                        </div>
                      </div>
                      <div class="col-md px-md-1">
                        <div class="form-group">
                          <label for="issue_date">Data de abertura da matrícula</label>
                          <input type="date" name="issue_date" value="" class="form-control" id="issue_date">
                        </div>
                      </div>
                      <div class="col-md-3 pl-md-1">
                        <div class="form-group">
                          <label for="type_property">Tipo imóvel</label>
                          <select class="form-control" name="type_property" id="type_property">
                            <option value=""></option>
                            <option value="público">público</option>
                            <option value="privado">privado</option>
                            <option value="misto">misto</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3 pl-md-1">
                        <div class="form-group">
                          <label for="cartorio">Cartório</label>
                          <select class="form-control" name="cartorio">
                            <option value=""></option>
                            <?php foreach ($notarys_office as $row) : ?>
                              <option value="<?php echo $row->id; ?>"><?php echo $row->name_registry; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div id="menu1" class="tab-pane py-2">
                    <div class="row">
                      <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" name="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_registration">Adicionar +</button>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <table id="tabelaDois" class="table table-striped table-bordered w-100 text-dark">
                          <thead class="text-primary">
                            <tr>
                              <th scope="col">Mat/Posse</th>
                              <th scope="col">Nome</th>
                              <th scope="col">CPF/ CNPJ</th>
                              <th scope="col">Ações</th>
                            </tr>
                          </thead>
                          <tbody id="tbody-notificacao">
                            <!-- <?php // foreach ($registration as $row): 
                                  ?>
                                <?php //
                                // if ($row->type_manifestation == 1) {
                                //   $type_manifestation = "Não Manifestou";
                                // } else if($row->type_manifestation == 2){
                                //   $type_manifestation = "Impugnou";
                                // } else if($row->type_manifestation == 3) {
                                //   $type_manifestation = "Recusou o recebimento";
                                // }
                                // $receiving_date = date_create($row->receiving_date);
                                // $deadline_manifestation = date_create($row->deadline_manifestation);
                                ?>
                                <tr>
                                  <td><?php // echo $row->number_registration; 
                                      ?></td>
                                  <td><?php // echo $row->owner; 
                                      ?></td>
                                  <td><?php // echo $row->document; 
                                      ?></td>
                                  <td><?php // echo (empty($row->receiving_date)) ? '' : date_format($receiving_date, 'd/m/Y'); 
                                      ?></td>
                                  <td><?php // echo (empty($row->deadline_manifestation)) ? '' : date_format($deadline_manifestation, 'd/m/Y'); 
                                      ?></td>
                                  <td>
                                    <span title="<?php // echo (empty($row->type_manifestation))? '' : $type_manifestation; 
                                                  ?>">
                                      <?php // echo (empty($row->type_manifestation))? '' : $type_manifestation; 
                                      ?>
                                    </span>
                                  </td>
                                  <td class="d-flex border-bottom-0">
                                    <a class="mr-2" href="#" id="detailNotificaded"
                                      data-toggle="modal" data-target="#modalDetailNotificaded"
                                      data-id="<?php // echo $row->id; 
                                                ?>"
                                      title="Detalhes">
                                      <i class="fa fa-search"></i>
                                    </a>
                                    <?php //
                                    // Privado mostra o de proprietario, publico mostra o de uniao
                                    // if ($row->property_type == '0') {
                                    //   $typeNotification = 'União';
                                    // } else if($row->property_type == '1'){
                                    //   $typeNotification = 'Confrontantes';
                                    // }
                                    ?>
                                    <div class="dropdown">
                                      <a class="mr-2 btn btn-sm dropdown-toggle" href="#" title="Upload/Visualização" id="upload_visualização" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-upload"></i>
                                      </a>
                                      <div class="dropdown-menu dropdown-upload" aria-labelledby="upload_visualização">
                                        <a class="dropdown-item modalUploadNotificacao" href="#" title="Gerar" id="gerar_notification"
                                          data-toggle="modal" data-target="#modal_notifications"
                                          data-notificacao="<?php // echo $typeNotification; 
                                                            ?>"
                                          >
                                          Gerar peça
                                        </a>

                                        <a href="#" class="dropdown-item modalUploadNotificacao"
                                          data-toggle="modal" data-target="#modal_upload_notifications"
                                          data-notificacao="<?php // echo $typeNotification; 
                                                            ?>" data-id_registration="<?php // echo $row->id; 
                                                                                                                        ?>"
                                          >
                                          Upload
                                        </a>
                                        <?php // if (isset($row->file)): 
                                        ?>
                                          <a href="<?php // echo base_url(); 
                                                    ?>assets/build/img/notifications/<?php // echo $row->file; 
                                                                                                              ?>" class="dropdown-item modalUploadNotificacao"
                                            target="_blank" rel="noopener norer"="<?php // echo $row->type; 
                                                                                  ?>"
                                            >
                                            Visualizar
                                          </a>
                                        <?php // endif; 
                                        ?>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              <?php // endforeach; 
                              ?> -->
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                </div>

                <!-- <div class="row mt-2">
                    <div class="col-md-12">
                      <h4 class="d-inline">Matrículas de imóveis atingidos (afetados)</h4>
                      <button type="button" name="button" class="btn btn-primary float-right" id="add_hit">Adicionar +</button>
                    </div>
                  </div>
                  <div class="row">
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
                  </div>
                <div id="append_hit"></div>
                <div class="row mt-2">
                  <div class="col-md-12">
                    <h4 class="d-inline">Matrículas de imóveis confrontantes</h4>
                    <button type="button" name="button" class="btn btn-primary float-right" id="add_confrontant">Adicionar +</button>
                  </div>
                </div>
                <div class="row">
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
                </div>
              <div id="append_confrontant"></div>
              <div class="row mt-2">
                <div class="col-md-12">
                  <h4 class="d-inline">Posseiros confrontantes - Imóvel objeto da REURB/Auto de Demarcação Urbanística</h4>
                  <button type="button" name="button" class="btn btn-primary float-right" id="add_squatters">Adicionar +</button>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-md-1">
                  <div class="form-group">
                    <label for="name_squatters">Nome</label>
                    <input type="text" name="name_squatters[]" id="name_squatters" class="form-control">
                  </div>
                </div>
                <div class="col-md-6 pl-md-1">
                  <div class="form-group">
                    <label for="address_squatters">Endereço</label>
                    <input type="text" name="address_squatters[]" id="address_squatters" class="form-control" >
                  </div>
                </div>
              </div>
              <div id="append_squatters"></div> -->
                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                      <a href="<?php echo base_url() ?>register_procedure_reurb/registers" class="btn btn-secundary mr-1">Voltar</a>
                      <button class="btn btn-primary" name="register_procedure">Cadastrar</button>
                      <input type="hidden" name="modality" id="value_modality" value="">
                      <input type="hidden" name="decision" id="value_decision" value="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal_registration" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel">Adicionar notificação</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="registration_number">Numero da Matrícula</label>
                      <input id="registration_number" name="registration_number" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="owner_squatter">Propietário/Posseiro</label>
                      <input id="owner_squatter" name="owner_squatter" type="text" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="cpf_cnpj">CPF/CNPJ</label>
                      <input id="cpf_cnpj" name="cpf_cnpj" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="registration_area">Área</label>
                      <input id="registration_area" name="registration_area" name="registration_area" type="text" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="real_estate_registry">Cartório de Registro de Imóveis</label>
                      <select class="form-control" name="real_estate_registry" id="real_estate_registry">
                        <option value=""></option>
                        <?php foreach ($notarys_office as $row) : ?>
                          <option value="<?php echo $row->id; ?>"><?php echo $row->name_registry; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <h4 class="border-bottom border-dark m-0 my-2">Endereço do imóvel</h4>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="public_place">Logradouro</label>
                      <input id="public_place" name="public_place" type="text" class="form-control logradouro">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="number">Número</label>
                      <input id="number" name="number" type="text" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="neigborhood">Bairro</label>
                      <input id="neigborhood" name="neigborhood" type="text" class="form-control bairro">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="cep">CEP</label>
                      <input id="cep" name="cep" type="text" class="form-control cep">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="country">Município</label>
                      <input id="country" name="country" type="text" class="form-control cidade">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-check d-flex align-items-center mx-4 mb-0">
                      <input class="form-check-input visible opacity-1 mb-1" name="notificaded_checking" type="checkbox" id="notificaded_checking">
                      <label class="form-check-label m-0" for="notificaded_checking">Notificado não reside no imóvel?</label>
                    </div>
                  </div>
                </div>
                <div class="mb-4 d-none" id="does_not_reside_in_the_property">
                  <div class="row">
                    <div class="col-md-12">
                      <h4 class="border-bottom border-dark m-0 my-2">Endereço para notificação</h4>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="public_place_notificaded">Logradouro</label>
                        <input id="public_place_notificaded" name="public_place_notificaded" type="text" class="form-control logradouro">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="number_notificaded">Número</label>
                        <input id="number_notificaded" name="number_notificaded" type="text" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="neigborhood_notificaded">Bairro</label>
                        <input id="neigborhood_notificaded" name="neigborhood_notificaded" type="text" class="form-control bairro">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="cep_notificaded">CEP</label>
                        <input id="cep_notificaded" name="cep_notificaded" type="text" class="form-control cep">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="country_notificaded">Município</label>
                        <input id="country_notificaded" name="country_notificaded" type="text" class="form-control cidade">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="property_type">Tipo de imóvel</label>
                      <select class="form-control" name="property_type" id="property_type">
                        <option value=""></option>
                        <option value="0">Privado</option>
                        <option value="1">Público</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="property_situation">Situação do imóvel</label>
                      <select class="form-control" name="property_situation" id="property_situation">
                        <option value=""></option>
                        <option value="0">Afetado/Atingido</option>
                        <option value="1">Controntante</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="notified_type">Tipo de notificado</label>
                      <select class="form-control" name="notified_type" id="notified_type">
                        <option value=""></option>
                        <option value="0">Proprietário</option>
                        <option value="1">Posseiro</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="procedure_type">Tipo de procedimento</label>
                      <select class="form-control" name="procedure_type" id="procedure_type">
                        <option value=""></option>
                        <option value="0">Processo Administrativo</option>
                        <option value="1">Auto de Demarcação Urbanística</option>
                      </select>
                    </div>
                  </div>
                </div>
                <h4 class="border-bottom border-dark m-0 my-2">Responsável pela notificação</h4>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="name_notificaded">Nome</label>
                      <input id="name_notificaded" name="name_notificaded" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="cpf_notificaded">CPF</label>
                      <input id="cpf_notificaded" name="cpf_notificaded" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="occupation_notificaded">Cargo/Função</label>
                      <input id="occupation_notificaded" name="occupation_notificaded" type="text" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <input type="hidden" name="id_procedure" value="">
            <button type="button" name="register_procedure_reurb_registration" class="btn btn-primary add_notification">
              Adicionar +
            </button>
          </div>
        </div>
      </div>
    </div>

    <?php $this->load->view('elements/footer'); ?>
    <!-- <script>
      let inputCEP3 = document.querySelector('.cep')
      inputCEP3.addEventListener('input', () => {
        pegarCPF(inputCEP3, '.logradouro', '.complemento', '.bairro', '.cidade', '.uf')
      })
    </script> -->