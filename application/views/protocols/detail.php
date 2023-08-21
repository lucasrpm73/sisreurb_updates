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
    <?php if ($requirement->embarkation == '1') : ?>
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          Este protocolo está com <?php echo count($embargo_under_analysis); ?> embargos em analise
        </div>
      </div>
    </div>
    <?php endif; ?>
    <?php if (!empty($protocol_history) && $requirement->status == '1') : ?>
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-success" role="alert">
          Este protocolo foi concluído
        </div>
      </div>
    </div>
    <?php endif; ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form action="<?php echo base_url(); ?>protocols/update_requirement/<?php echo $requirement->id; ?>"
            method="post" enctype="multipart/form-data">
            <div class="card-header">
              <div class="row">
                <div class="col-md-12">
                  <h4 class="card-title d-inline">Detalhe -
                    <?php echo (isset($requirement->legal_name)) ? $requirement->legal_name : $requirement->company_name; ?>
                  </h4>
                  <div class="d-flex justify-content-end float-right">
                    <a href="<?php echo base_url() ?>protocols" class="btn btn-secundary mr-1">Voltar</a>


                    <?php if (!(!empty($protocol_history) && $requirement->status == '1')) : ?>
                    <button type="submit" name="update_requirement" id="update_requirement"
                      class="btn btn-primary">Atualizar</button>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <hr>
              <input type="hidden" name="id_property" value="<?php echo $requirement->id_property; ?>">
              <input type="hidden" name="id_requester" id="id_requester"
                value="<?php echo $requirement->id_requester; ?>">
              <?php if ($requirement->people_type == 1) : ?>
              <input id="requester_type" type="hidden" name="type_requester" value="fizico">
              <?php endif; ?>
              <?php if ($requirement->people_type == 2) : ?>
              <input id="requester_type" type="hidden" name="type_requester" value="juridico">
              <?php endif; ?>

              <div class="row">
                <div class="col-md-12">
                  <span class="text-secondary">Documentos enviados: </span>
                  <span
                    class="text-secondary float-right"><?php echo $count_checklist_send->count ?>/<?php echo $count_checklist_required->count; ?></span>
                  <!-- <div class="progress" style="height: 25px;">
                    <?php //$progess = ($count_checklist_send->count / $count_checklist_required->count) * 100; ?>

                    <div class="progress-bar" role="progressbar" style="width: <?php echo $progess ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo number_format($progess, 2, '.', ''); ?>%</div>
                  </div> -->
                </div>
              </div>
            </div>
            <div class="card-body">
              <?php if ($requirement->people_type == 1) : ?>
              <div class="row peopleFisica">
                <div class="col-md-12">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <?php if ($requirement->embarkation == 1) { ?>
                    <li class="nav-item">
                      <a class="nav-link <?php echo ($requirement->embarkation == '1') ? 'active' : '' ?>"
                        id="embarkation-tab" data-toggle="tab" href="#embarkation" role="tab"
                        aria-controls="embarkation" aria-selected="true">Embargo</a>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                      <a class="nav-link <?php echo ($requirement->embarkation == '1') ? '' : 'active' ?>"
                        id="personal-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal"
                        aria-selected="true">Dados</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="tenants-tab" data-toggle="tab" href="#tenants" role="tab"
                        aria-controls="personal" aria-selected="false">Condôminos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="realty_tab_home" data-toggle="tab" href="#realty_home" role="tab"
                        aria-controls="realty_tab_home" aria-selected="false">Dados do imóvel</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="realty_tab_home" data-toggle="tab" href="#enquadramento_reurb" role="tab"
                        aria-controls="enquadramento_reurb-tab" aria-selected="false">Enquadramento na REURB</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="realty_tab_home" data-toggle="tab" href="#checklist" role="tab"
                        aria-controls="checklist-tab" aria-selected="false">Checklist</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="realty_tab_home" data-toggle="tab" href="#register_conclusion" role="tab"
                        aria-controls="register_conclusion-tab" aria-selected="false">Conclusão de cadastro</a>
                    </li>
                  </ul>

                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane <?php echo ($requirement->embarkation == '1') ? 'fade show active' : '' ?>"
                      id="embarkation" role="tabpanel" aria-labelledby="embarkation-tab">
                      <?php $count = 0; ?>
                      <?php foreach ($embargo_history as $row) : ?>
                      <?php if ($count != 0) : ?>
                      <hr style="border: 1px solid black;">
                      <?php endif; ?>
                      <?php $count++; ?>
                      <div class="row text-dark">
                        <div class="col-md-12 mt-3 mb-3">
                          <h6 class="text-center">Embargo <?php echo $count; ?></h6>
                        </div>
                        <div class="col-md-3">
                          <p>
                            <strong>Embargante:</strong> <br>
                            <?php echo ($row->legal_name) ? $row->legal_name : $row->company_name; ?>
                          </p>
                        </div>
                        <div class="col-md-3">
                          <p>
                            <strong>Embargado:</strong> <br> <?php echo $requirement->legal_name; ?>
                          </p>
                        </div>
                        <div class="col-md-3">
                          <?php $date = date_create($row->register); ?>
                          <p>
                            <strong>Data de apresentação:</strong> <br> <?php echo $date->format('d/m/Y'); ?>
                          </p>
                        </div>
                        <div class="col-md-3">
                          <p>
                            <strong>Status:</strong> <br>
                            <?php echo $row->description; ?>
                            <button type="button" class="edit_embarkation" name="button" data-toggle="modal"
                              data-target="#modal_update_embargo" data-id="<?php echo $row->id; ?>"
                              data-status="<?php echo $row->status; ?>"
                              data-legal_decision_analysis="<?php echo $row->legal_decision_analysis; ?>"
                              data-file_analysis="<?php echo $row->file_analysis; ?>"
                              style="background: none; border: 1px solid blue;">
                              Alterar
                            </button>
                          </p>
                        </div>
                        <div class="col-md-12 mt-2">
                          <p>
                            <strong>Motivo:</strong> <br>
                            <?php echo $row->reason; ?>
                          </p>
                        </div>
                        <div class="col-md-12 list-group">
                          <div class="list-group-item d-inline align-items-center py-1 mb-1 ">
                            <strong>PDF do motivo</strong>
                            <?php if (!empty($row->file)) : ?>
                            <a href="<?php echo base_url(); ?>assets/build/img/pdf_embarkation/<?php echo $row->file; ?>"
                              class="btn btn-sm btn-primary float-right" download="pdf_do_motivo">Baixar</a>
                            <button type="button" name="button"
                              class="btn btn-sm btn-success float-right files_embarkation" data-toggle="modal"
                              data-target="#modal_edit_file_embarkation" data-id="<?php echo $row->id; ?>">
                              alterar arquivo
                            </button>
                            <?php else : ?>
                            <button type="button" name="button" class="btn btn-sm btn-primary float-right">sem
                              arquivo</button>
                            <button type="button" name="button"
                              class="btn btn-sm btn-success float-right files_embarkation" data-toggle="modal"
                              data-target="#modal_edit_file_embarkation" data-id="<?php echo $row->id; ?>">
                              Enviar arquivo
                            </button>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col-md-12 mt-2">
                          <p>
                            <strong>Análise / Decisão jurídica:</strong> <br>
                            <?php echo $row->legal_decision_analysis; ?>
                          </p>
                        </div>
                        <div class="col-md-12 list-group">
                          <div class="list-group-item d-inline align-items-center py-1 mb-1 ">
                            <strong>PDF da Análise / Decisão jurídica</strong>
                            <?php if (!empty($row->file_analysis)) : ?>
                            <a href="<?php echo base_url(); ?>assets/build/img/pdf_embarkation/<?php echo $row->file_analysis; ?>"
                              class="btn btn-sm btn-primary float-right" download>Baixar</a>
                            <button type="button" name="button"
                              class="btn btn-sm btn-success float-right files_analysis" data-toggle="modal"
                              data-target="#modal_files_analysis" data-id="<?php echo $row->id; ?>">
                              alterar arquivo
                            </button>
                            <?php else : ?>
                            <button type="button" name="button" class="btn btn-sm btn-primary float-right">sem
                              arquivo</button>
                            <button type="button" name="button"
                              class="btn btn-sm btn-success float-right files_analysis" data-toggle="modal"
                              data-target="#modal_files_analysis" data-id="<?php echo $row->id; ?>">
                              Enviar arquivo
                            </button>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>
                    <div class="tab-pane <?php echo ($requirement->embarkation == '1') ? '' : 'fade show active' ?> "
                      id="personal" role="tabpanel" aria-labelledby="personal-tab">
                      <div class="row">
                        <div class="col-md-4 pr-md-1">
                          <div class="form-group">
                            <label for="procedure">Procedimento</label>
                            <input type="text" name="protocol_procedure" id="procedure"
                              value="<?php echo $requirement->process_number . '.' . $requirement->stage . ' / ' . $requirement->core_name; ?>"
                              class="form-control" readonly>
                          </div>
                        </div>
                        <div class="col-md-4 px-md-1">
                          <div class="form-group">
                            <label for="cpf_personal">Identificador</label>
                            <input type="text" name="" id="" class="form-control"
                              value="<?php echo  str_pad($requirement->id, 3, '0', STR_PAD_LEFT); ?>" readonly>
                            <?php echo form_error('cpf_personal'); ?>
                          </div>
                        </div>
                        <div class="col-md-4 pl-md-1">
                          <div class="form-group">
                            <label for="data">Data</label>
                            <?php $data = date_create($requirement->register); ?>
                            <input type="text" name="data" id="data" class="form-control"
                              value="<?php echo date_format($data, 'd/m/Y'); ?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="row ">
                        <div class="col-md-6 pr-md-1">
                          <div class="form-group">
                            <label for="cpf_personal">CPF</label>
                            <input type="text" name="cpf_personal" id="cpf_personal" class="form-control"
                              value="<?php echo $requirement->cpf; ?>" readonly>
                            <?php echo form_error('cpf_personal'); ?>
                          </div>
                        </div>
                        <div class="col-md-6 pl-md-1">
                          <div class="form-group">
                            <label for="name_personal">Nome</label>
                            <input type="text" name="name_personal" id="name_personal" class="form-control"
                              value="<?php echo $requirement->legal_name; ?>" readonly>
                            <?php echo form_error('name_personal'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 pr-md-1">
                          <div class="form-group">
                            <label for="phone_personal">Telefone</label>
                            <input type="text" name="phone_personal" id="phone_personal" class="form-control"
                              value="<?php echo $requirement->legal_phone; ?>" readonly>
                            <?php echo form_error('phone_personal'); ?>
                          </div>
                        </div>
                        <div class="col-md-6 pl-md-1">
                          <div class="form-group">
                            <label for="email_personal">Email</label>
                            <input type="text" name="email_personal" id="email_personal" class="form-control"
                              value="<?php echo $requirement->legal_email; ?>" readonly>
                            <?php echo form_error('email_personal'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 pr-md-1">
                          <div class="form-group">
                            <label for="profission_personal">Profissão</label>
                            <input type="text" name="profission_personal" id="profission_personal" class="form-control"
                              value="<?php echo $requirement->profession; ?>" readonly>
                            <?php echo form_error('profission_personal'); ?>
                          </div>
                        </div>
                        <div class="col-md-4 px-md-1">
                          <div class="form-group">
                            <label for="birth_date_personal">Data de nascimento</label>
                            <input type="date" name="birth_date_personal" id="birth_date_personal" class="form-control"
                              value="<?php echo $requirement->birth_date; ?>" readonly>
                            <?php echo form_error('birth_date_personal'); ?>
                          </div>
                        </div>
                        <div class="col-md-4 pl-md-1">
                          <div class="form-group">
                            <label for="civil_status">Estado civil</label>
                            <input type="text" name="civil_status" class="form-control"
                              value="<?= $requirement->civil_status; ?>" id="civil_status" readonly>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane py-2" id="tenants" role="tabpanel" aria-labelledby="tenants-tab">
                      <div class="row">
                        <div class="col-md-12">
                          <a class="btn btn-primary btn-round float-md-right float-sm-right float-xs-right"
                            data-toggle="modal" data-target="#tenants_detail"><i
                              class="fas fa-plus pr-2"></i>Adicionar</a>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12" id="table_tenants">
                          <table id="" class="table table-bordered table-striped text-dark w-100">
                            <thead>
                              <tr>
                                <th scope="col">Cpf / Cnpj</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">É proprietário(a) de imóvel?</th>
                                <th></th>
                              </tr>
                            </thead>
                            <?php $property_owner_tenants = '0'; ?>
                            <tbody id="tenants_list_legal">
                              <?php $count = 0; ?>
                              <?php foreach ($tenants as $row) : ?>
                              <tr>
                                <td><?php echo (isset($row->cpf)) ? $row->cpf : $row->cnpj;  ?></td>
                                <td><?php echo (isset($row->legal_name)) ? $row->legal_name : $row->company_name;  ?>
                                </td>
                                <td>
                                  <?php echo (isset($row->legal_phone)) ? $row->legal_phone : $row->phone_procurator;  ?>
                                </td>
                                <td>
                                  <?php echo (isset($row->legal_email)) ? $row->legal_email : $row->email_procurator;  ?>
                                </td>
                                <td>
                                  <?php if (isset($row->property_owner_legal)) {
                                        $legal = ($row->property_owner_legal == '1') ? 'Sim' : 'Não';
                                        echo $legal;
                                        if ($legal == 'Sim') {
                                          $property_owner_tenants = '1';
                                        }
                                      } else {
                                        $juridical = ($row->property_owner_juridical == '1') ? 'Sim' : 'Não';
                                        echo $juridical;
                                        if ($juridical == 'Sim') {
                                          $property_owner_tenants = '1';
                                        }
                                      }
                                      ?>
                                </td>
                                <td>
                                  <button type="button" name="button" class="btn btn-sm btn-danger remove_tenants_legal"
                                    data-id="<?php echo $row->id; ?>"
                                    data-id_requirement="<?php echo $requirement->id; ?>"
                                    data-remove="remove_tenants<?= $count++; ?>">X</button>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                          <input type="hidden" name="id_requirement" value="<?php echo $requirement->id ?>"
                            id="id_requirement">
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane" id="realty_home" role="tabpanel" aria-labelledby="realty-home-tab">
                      <?php if (isset($front_photo)) : ?>
                      <div class="row">
                        <div class="col-md-12 text-dark">
                          <button type="button" name="button" class="btn btn-primary visualizar_frontal"
                            data-tipo="fisico">
                            Visualizar Foto Frontal
                          </button>
                        </div>
                      </div>
                      <div class="row imagem_frontal" style="display: none;">
                        <div class="col-md-12 d-flex justify-content-center">
                          <img
                            src="<?php echo base_url(); ?>assets/build/img/checklist_protocols/<?php echo $front_photo->file; ?>"
                            alt="" class="foto_frontal_confrotants">
                        </div>
                      </div>

                      <!-- <button type="button" name="button" class="btn btn-primary visualizar_foto">Visualizar Foto Frontal</button> -->

                      <!-- <div class="row mt-3">
                            <div class="col-md-12 d-flex justify-content-center">
                              <img src="<?php //echo base_url();
                                        ?>assets/build/img/checklist_protocols/<?php //echo $front_photo->file;
                                                                                ?>" alt="">
                            </div>
                          </div> -->
                      <?php endif; ?>
                      <div class="row mt-3">
                        <div class="col-md-2 pr-md-1">
                          <div class="form-group">
                            <label for="real_state_home">
                              Inscrição Imobiliária Municipal
                              <span class="text-danger">**</span>
                            </label>
                            <input type="text" name="real_state_home" id="real_state_home" class="form-control"
                              value="<?php echo $requirement->furniture_registration; ?>"
                              data-field="Inscrição Imobiliária Municipal">
                            <?php echo form_error('real_state_home'); ?>
                          </div>
                        </div>
                        <div class="col-md-2 py-3 px-md-1">
                          <div class="form-group">
                            <label for="sector">Setor 
                              <span class="text-danger">**</span>
                          </label>
                            <input type="text" name="sector" id="sector" class="form-control"
                              value="<?php echo $requirement->sector; ?>"
                              data-field="Setor">
                          </div>
                        </div>
                        <div class="col-md-2 py-3 px-md-1">
                          <div class="form-group">
                            <label for="city_block">Quadra 
                              <span class="text-danger">**</span>
                          </label>
                            <input type="text" name="city_block" id="city_block" class="form-control"
                              value="<?php echo $requirement->city_block; ?>"
                              data-field="Quadra">
                          </div>
                        </div>
                        <div class="col-md-2 py-3 px-md-1">
                          <div class="form-group">
                            <label for="allotment">Lote 
                              <span class="text-danger">**</span>
                          </label>
                            <input type="text" name="allotment" id="allotment" class="form-control"
                              value="<?php echo $requirement->allotment; ?>"
                              data-field="Lote">
                          </div>
                        </div>
                        <div class="col-md-1 py-3 px-md-1">
                          <div class="form-group">
                            <label for="sub_lot">Sub lote</label>
                            <input type="text" name="sub_lot" id="sub_lot" class="form-control"
                              value="<?php echo $requirement->sub_lot; ?>">
                          </div>
                        </div>
                        <div class="col-md-3 pl-md-1">
                          <div class="form-group">
                            <label for="property_registration_number">Matrícula do imóvel aberta pelo Procedimento de
                              REURB: 
                              <span class="text-danger">**</span>
                            </label>
                            <input type="text" name="property_registration_number" id="property_registration_number"
                              class="form-control" value="<?php echo $requirement->property_registration_number; ?>"
                              data-field="Matrícula do imóvel aberta pelo Procedimento de REURB:">
                            <?php echo form_error('property_registration_number'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 pr-md-1">
                          <div class="form-group">
                            <label for="realty_type_home">Tipo de Logradouro 
                              <span class="text-danger">**</span>
                            </label>
                            <select class="custom-select" id="realty_type_home" name="realty_type_home"
                              data-field="Tipo de Logradouro">
                              <option value=""></option>
                              <option value="Alameda"
                                <?php echo ($requirement->street_property == 'Alameda') ? 'selected' : ''; ?>>Alameda
                              </option>
                              <option value="Avenida"
                                <?php echo ($requirement->street_property == 'Avenida') ? 'selected' : ''; ?>>Avenida
                              </option>
                              <option value="Praça"
                                <?php echo ($requirement->street_property == 'Praça') ? 'selected' : ''; ?>>Praça
                              </option>
                              <option value="Rua"
                                <?php echo ($requirement->street_property == 'Rua') ? 'selected' : ''; ?>>Rua</option>
                              <option value="Travessa"
                                <?php echo ($requirement->street_property == 'Travessa') ? 'selected' : ''; ?>>Travessa
                              </option>
                              <option value="Via"
                                <?php echo ($requirement->street_property == 'Via') ? 'selected' : ''; ?>>Via</option>
                              <option value="Viela"
                                <?php echo ($requirement->street_property == 'Viela') ? 'selected' : ''; ?>>Viela
                              </option>
                            </select>
                            <?php echo form_error('realty_type_home'); ?>
                          </div>
                        </div>
                        <div class="col-md-4 px-md-1">
                          <div class="form-group">
                            <label for="realty_address_home">Logradouro <span class="text-danger">**</span>
                          </label>
                            <input type="text" name="realty_address_home" id="realty_address_home" class="form-control"
                              value="<?php echo $requirement->place_property; ?>"
                              data-field="Logradouro">
                            <?php echo form_error('realty_address_home'); ?>
                          </div>
                        </div>
                        <div class="col-md-4 pl-md-1">
                          <div class="form-group">
                            <label for="realty_number_home">Numero  
                              <span class="text-danger">**</span>
                          </label>
                            <input type="text" name="realty_number_home" id="realty_number_home" class="form-control"
                              value="<?php echo $requirement->number_property; ?>"
                              data-field="Numero">
                            <?php echo form_error('realty_number_home'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 pr-md-1 ">
                          <div class="form-group">
                            <label for="realty_complement_home">Complemento</label>
                            <input type="text" name="realty_complement_home" id="realty_complement_home"
                              class="form-control" value="<?php echo $requirement->complement_property; ?>">
                            <?php echo form_error('realty_complement_home'); ?>
                          </div>
                        </div>
                        <div class="col-md-6 pl-md-1">
                          <div class="form-group">
                            <label for="realty_neighborhood_home">Bairro 
                              <span class="text-danger">**</span>
                            </label>
                            <input type="text" name="realty_neighborhood_home" id="realty_neighborhood_home"
                              class="form-control" value="<?php echo $requirement->neighborhood_property; ?>"
                              data-field="Bairro">
                            <?php echo form_error('realty_neighborhood_home'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 pr-md-1 ">
                          <div class="form-group">
                            <label for="realty_city_home">Cidade</label>
                            <input type="text" name="realty_city_home" id="realty_city_home" class="form-control"
                              value="<?php echo $requirement->city_property; ?>">
                            <?php echo form_error('realty_city_home'); ?>
                          </div>
                        </div>
                        <div class="col-md-4 px-md-1">
                          <div class="form-group">
                            <label for="realty_cep_home">CEP</label>
                            <input type="text" name="realty_cep_home" id="realty_cep_home" class="form-control cep"
                              value="<?php echo $requirement->cep_property; ?>">
                            <?php echo form_error('realty_cep_home'); ?>
                          </div>
                        </div>
                        <div class="col-md-4 pl-md-1">
                          <div class="form-group">
                            <label for="realty_uf_home">UF</label>
                            <input type="text" name="realty_uf_home" id="realty_uf_home" class="form-control"
                              value="<?php echo $requirement->uf_property; ?>">
                            <?php echo form_error('realty_uf_home'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="realty_country_home">País</label>
                            <input type="text" name="realty_country_home" id="realty_country_home" class="form-control"
                              value="<?php echo $requirement->country_property; ?>">
                            <?php echo form_error('realty_country_home'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="realty_address_posses_home">Data início da Posse / Ocupação</label>
                            <input type="date" name="realty_address_posses_home" id="realty_address_posses_home"
                              class="form-control" value="<?php echo $requirement->inauguration_date; ?>">
                            <?php echo form_error('realty_address_posses_home'); ?>
                          </div>
                        </div>

                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="required_terrain_area_home pr-md-1">Área requerida do imóvel -
                              m<sup>2</sup></label>
                            <input type="text" name="required_terrain_area_home" id="required_terrain_area_home"
                              class="form-control valor" value="<?php echo $requirement->required_land_area; ?>">
                            <?php echo form_error('required_terrain_area_home'); ?>
                          </div>
                        </div>
                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="georeferenced_property_area_juridical">Área do imóvel georreferenciada -
                              m<sup>2</sup> 
                              <span class="text-danger">**</span>
                            </label>
                            <input type="text" name="georeferenced_property_area" id="georeferenced_property_area"
                              class="form-control venal"
                              value="<?php echo $requirement->georeferenced_property_area; ?>"
                              data-field="Área do imóvel georreferenciada - m² ">
                            <?php echo form_error('georeferenced_property_area'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="required_edificated_area_home">Área edificada - m<sup>2</sup></label>
                            <input type="text" name="required_edificated_area_home" id="required_edificated_area_home"
                              class="form-control valor" value="<?php echo $requirement->required_building_area; ?>">
                            <?php echo form_error('required_edificated_area_home'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 pr-md-1">
                          <div class="form-group">
                            <label for="construction_features">Características da construção</label>
                            <input type="text" name="construction_features" id="construction_features"
                              class="form-control" value="<?php echo $requirement->construction_features; ?>">
                            <?php echo form_error('construction_features'); ?>
                          </div>
                        </div>
                        <div class="col-md-6 pl-md-1">
                          <div class="form-group">
                            <label for="venal">Valor venal (avaliação no cadastro imobiliário Municipal)R$ 
                              <span class="text-danger">**</span>
                          </label>
                            <input type="text" name="venal" id="venal" class="form-control venal"
                              value="<?php echo $requirement->venal; ?>"
                              data-field="Valor venal">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 pr-md-1">
                          <div class="form-group">
                            <label for="possession_origin">Origem da Posse</label>
                            <select class="form-control" name="possession_origin" id="possession_origin">
                              <option value=""></option>
                              <option value="Contrato/Recibo de Compra e Venda"
                                <?php echo ($requirement->possession_origin == 'Contrato/Recibo de Compra e Venda') ? 'selected' : ''; ?>>
                                Contrato/Recibo de Compra e Venda</option>
                              <option value="Doação"
                                <?php echo ($requirement->possession_origin == 'Doação') ? 'selected' : ''; ?>>Doação
                              </option>
                              <option value="Herança"
                                <?php echo ($requirement->possession_origin == 'Herança') ? 'selected' : ''; ?>>Herança
                              </option>
                              <option value="Declaração de Posse"
                                <?php echo ($requirement->possession_origin == 'Declaração de Posse') ? 'selected' : ''; ?>>
                                Declaração de Posse</option>
                              <option value="Posse a Justo Título"
                                <?php echo ($requirement->possession_origin == 'Posse a Justo Título') ? 'selected' : ''; ?>>
                                Posse a Justo Título</option>
                              <option value="Posse por Simples Ocupação"
                                <?php echo ($requirement->possession_origin == 'Posse por Simples Ocupação') ? 'selected' : ''; ?>>
                                Posse por Simples Ocupação</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6 pl-md-1">
                          <div class="form-group">
                            <label for="slab_right">Direito de Laje 
                              <span class="text-danger">**</span>
                            </label>
                            <select class="form-control" name="slab_right" data-field="Direito de Laje">
                              <option value=""></option>
                              <option value="1" <?= ($requirement->slab_right == '1') ? 'selected' : ''; ?>>Sim</option>
                              <option value="0" <?= ($requirement->slab_right == '0') ? 'selected' : ''; ?>>Não</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="infrastructure_select_home">Infraestrutura básica</label>
                            <select name="infrastructure_select_home" class="form-control"
                              id="infrastructure_select_home">
                              <option value="<?php echo $requirement->basic_infrastructure ?>" selected>
                                <?php echo ($requirement->basic_infrastructure == '1') ? 'Sim' : 'Não'; ?></option>
                              <?php if ($requirement->basic_infrastructure == '1') : ?>
                              <option value="0">Não</option>
                              <?php else : ?>
                              <option value="1">Sim</option>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="potable_water_select_home">Água potável</label>
                            <select name="potable_water_select_home" class="form-control"
                              id="potable_water_select_home">
                              <option value="<?php echo $requirement->potable_water ?>" selected>
                                <?php echo ($requirement->potable_water == '1') ? 'Sim' : 'Não'; ?></option>
                              <?php if ($requirement->potable_water == '1') : ?>
                              <option value="0">Não</option>
                              <?php else : ?>
                              <option value="1">Sim</option>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="infrastructure_select_home">Energia</label>
                            <select name="infrastructure_select_home" class="form-control"
                              id="infrastructure_select_home">
                              <option value="<?php echo $requirement->energy ?>" selected>
                                <?php echo ($requirement->energy == '1') ? 'Sim' : 'Não'; ?></option>
                              <?php if ($requirement->energy == '1') : ?>
                              <option value="0">Não</option>
                              <?php else : ?>
                              <option value="1">Sim</option>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="sewage_select_home">Esgotamento Sanitário</label>
                            <select name="sewage_select_home" class="form-control" id="sewage_select_home">
                              <option value="<?php echo $requirement->sewage ?>" selected>
                                <?php echo ($requirement->sewage == '1') ? 'Sim' : 'Não'; ?></option>
                              <?php if ($requirement->sewage == '1') : ?>
                              <option value="0">Não</option>
                              <?php else : ?>
                              <option value="1">Sim</option>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6 pl-md-1">
                          <div class="form-group">
                            <label for="type_sewer">Tipo de esgoto</label>
                            <select name="type_sewer" class="form-control" id="type_sewer">
                              <option value=""></option>
                              <option value="Rede Pública"
                                <?php echo ($requirement->type_sewer == 'Rede Pública') ? 'selected' : ''; ?>>Rede
                                Pública</option>
                              <option value="Fossa séptica"
                                <?php echo ($requirement->type_sewer == 'Fossa séptica') ? 'selected' : ''; ?>>Fossa
                                séptica</option>
                              <option value="Outro"
                                <?php echo ($requirement->type_sewer == 'Outro') ? 'selected' : ''; ?>>Outro</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 pr-md-1">
                          <div class="form-group">
                            <label for="type_property">Tipo de imóvel:  
                              <span class="text-danger">**</span>
                            </label>
                            <select class="form-control" name="type_property" id="type_property"
                              data-field="Tipo de imóvel">
                              <option value=""></option>
                              <option value="Residencial"
                                <?php echo ($requirement->type_property_details == 'Residencial') ? 'selected' : ''; ?>>
                                Residencial</option>
                              <option value="Comercial"
                                <?php echo ($requirement->type_property_details == 'Comercial') ? 'selected' : ''; ?>>
                                Comercial</option>
                              <option value="Misto Residencial/Comercial"
                                <?php echo ($requirement->type_property_details == 'Misto Residencial/Comercial') ? 'selected' : ''; ?>>
                                Misto Residencial/Comercial</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6 pl-md-1">
                          <div class="form-group">
                            <label for="unit_situation">Situação da unidade:</label>
                            <select class="form-control" name="unit_situation" id="unit_situation">
                              <option value=""></option>
                              <option value="Construída"
                                <?php echo ($requirement->unit_situation == 'Construída') ? 'selected' : ''; ?>>
                                Construída</option>
                              <option value="Em construção"
                                <?php echo ($requirement->unit_situation == 'Em construção') ? 'selected' : ''; ?>>Em
                                construção</option>
                              <option value="Lote Vago"
                                <?php echo ($requirement->unit_situation == 'Lote Vago') ? 'selected' : ''; ?>>Lote Vago
                              </option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="paviment_select_home">Rua pavimentada</label>
                            <select name="paviment_select_home" class="form-control" id="paviment_select_home">
                              <option value="<?php echo $requirement->type_sewer ?>" selected>
                                <?php echo ($requirement->type_sewer == '1') ? 'Sim' : 'Não'; ?></option>
                              <?php if ($requirement->type_sewer == '1') : ?>
                              <option value="0">Não</option>
                              <?php else : ?>
                              <option value="1">Sim</option>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="paviment_type_select_home">Tipo de pavimentação</label>
                            <select name="paviment_type_select_home" class="form-control"
                              id="paviment_type_select_home">
                              <option value="<?php echo $requirement->paving_type ?>" selected>
                                <?php echo $requirement->paving_type; ?></option>
                              <option value="Asfalto">Asfalto</option>
                              <option value="Ladrilhos">Ladrilhos</option>
                              <option value="Bloquetes">Bloquetes</option>
                              <option value="Ladrilhos">Ladrilhos</option>
                              <option value="Outros">Outros</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="internet_access_select_home">Acesso à internet</label>
                            <select name="internet_access_select_home" class="form-control"
                              id="internet_access_select_home">
                              <option value="<?php echo $requirement->internet_access ?>" selected>
                                <?php echo ($requirement->internet_access == '1') ? 'Sim' : 'Não'; ?></option>
                              <?php if ($requirement->internet_access == '1') : ?>
                              <option value="0">Não</option>
                              <?php else : ?>
                              <option value="1">Sim</option>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="register_date_home">Data cadastro</label>
                            <input type="date" name="register_date_home" id="register_date_home" class="form-control"
                              value="<?php echo $requirement->date_register; ?>">
                            <?php echo form_error('register_date_home'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row pt-2">
                        <div class="col-md-12">
                          <input type="checkbox" name="spouse_co_owner" id="spouse_co_owner" value="1"
                            <?= ($requirement->spouse_co_owner == '1') ? 'checked' : ''; ?>>
                          <label for="spouse_co_owner">O Conjugê ou Companheiro(a) não é co-proprietário. Foi
                            apresentado anuência expressa.</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <h4 class="text-dark d-inline">Confrontantes</h4>
                          <?php if ($requirement->embarkation == '0') : ?>
                          <a href="<?php echo base_url(); ?>forms/statement_of_confrontants/<?php echo $requirement->id; ?>"
                            class="btn btn-sm btn-primary float-right" target="_blank">Gerar declaração de
                            confrontantes</a>
                          <?php endif; ?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <button type="button" name="button" class="btn btn-primary add_new_confrotant"
                            data-toggle="modal" data-target="#modal_confrotants"
                            data-id_property="<?php echo $requirement->id_property; ?>">+ Adicionar</button>
                        </div>
                      </div>
                      <?php foreach ($confrotants_property as $key => $row) : ?>
                      <div class="row">
                        <div class="col-md-2 pr-md-1">
                          <div class="form-group">
                            <label for="cpf_confrontants">Cpf</label>
                            <input type="text" name="cpf_confrontants[]" id="cpf_confrontants"
                              class="form-control cpf cpf_confrontants" value="<?php echo $row->cpf; ?>"
                              data-id_name="name_confrontants_<?php echo $key; ?>"
                              data-id_nascimento="birth_date_confrontants_<?php echo $key; ?>">
                          </div>
                        </div>
                        <div class="col-md-3 px-md-1">
                          <div class="form-group">
                            <label for="name_confrontants">Nome</label>
                            <input type="text" name="name_confrontants[]" id="name_confrontants_<?php echo $key; ?>"
                              class="form-control" value="<?php echo $row->name; ?>">
                          </div>
                        </div>
                        <div class="col-md-3 px-md-1">
                          <div class="form-group">
                            <label for="birth_date_confrontants">Data nacimento</label>
                            <input type="date" name="birth_date_confrontants[]"
                              id="birth_date_confrontants_<?php echo $key; ?>" class="form-control"
                              value="<?php echo $row->birth_date; ?>">
                            <?php echo form_error('birth_date_confrontants'); ?>
                          </div>
                        </div>
                        <div class="col-md-4 pl-md-1">
                          <div class="form-group">
                            <label for="confrontation_direction">Confrontação</label>
                            <select class="form-control" name="confrontation_direction[]">
                              <option value=""></option>
                              <option value="Lado esquerdo"
                                <?php echo ($row->confrontation_direction == 'Lado esquerdo') ? 'selected' : ''; ?>>Lado
                                esquerdo</option>
                              <option value="Lado direito"
                                <?php echo ($row->confrontation_direction == 'Lado direito') ? 'selected' : ''; ?>>Lado
                                direito</option>
                              <option value="Fundos"
                                <?php echo ($row->confrontation_direction == 'Fundos') ? 'selected' : ''; ?>>Fundos
                              </option>
                            </select>
                            <span class="text-dark">*Descrever as confrontações de dentro do móvel olhando para
                              rua</span>
                          </div>
                        </div>
                      </div>
                      <input type="hidden" name="id_confrontants[]" value="<?php echo $row->id; ?>">
                      <?php endforeach; ?>
                      <?php if (!empty($requirement->front)) : ?>
                      <div class="row">
                        <div class="col-md-12 text-dark">
                          <button type="button" name="button" class="btn btn-primary visualizar_frontal"
                            data-tipo="fisico">
                            Visualizar foto frontal do imóvel
                          </button>
                        </div>
                      </div>
                      <div class="row imagem_frontal" style="display: none;">
                        <div class="col-md-12 d-flex justify-content-center">
                          <img
                            src="<?php echo base_url(); ?>assets/build/img/checklist_protocols/<?php echo $requirement->front; ?>"
                            alt="" class="foto_frontal_confrotants">
                        </div>
                      </div>
                      <?php endif; ?>
                    </div>
                    <div class="tab-pane" id="enquadramento_reurb" role="tabpanel"
                      aria-labelledby="enquadramento_reurb-tab">
                      <div class="row mt-2 mb-2">
                        <div class="col-md-5 text-dark">
                          <span>Renda Total (membros da familia/condôminos): <p class="text-primary"
                              id="monthly_income_total">R$ <?php echo $monthly_income_total; ?></p></span>
                        </div>
                        <div class="col-md-7 text-dark">
                          <span>É proprietário(a) de imóvel urbano ou rural registrado em Cartório de Imóveis?
                            <?php
                              if ($requirement->property_owner == '1' || $requirement->property_owner_legal == '1' || $property_owner_tenants == '1') {
                                $property_owner = 'Sim';
                              } else {
                                $property_owner = 'Não';
                              }
                              ?>
                            <p class="text-primary" id="proprietario_imovel"><?php echo $property_owner; ?></p>
                          </span>
                        </div>
                      </div>
                      <div class="row text-dark">
                        <div class="col-md-12">
                          <label for="criteria_established_law">De acordo com os critérios acima estabelecidos pela lei
                            Federal nº 13.465/2017 e Decreto 9.310/18,
                            e legislação Municipal vigente, o requerente enquadra-se na modalidade de: </label>
                          <?php $type = ($property_owner == 'Sim' || $monthly_income_total > floatval($maximum_income['maximum_family_income'])) ? 'REURB-E' : 'REURB-S'; ?>
                          <p class="text-primary reurb_legal_personal" name="reurb" id="reurb">
                            <?php echo $type; ?>
                          </p>
                          <input type="hidden" name="reurb_type" value="<?php echo $type; ?>" id="reurb_type">
                        </div>
                        <input type="hidden" name="maximum_family_income"
                          value="<?php echo $maximum_income['maximum_family_income']; ?>"
                          id="maximum_family_income_detail">
                      </div>
                    </div>

                    <div class="tab-pane fade" id="checklist" role="tabpanel" aria-labelledby="address-tab">
                      <div class="row mt-3">
                        <div class="col-md-12">
                          <button type="button" name="button" class="btn btn-sm btn-primary float-right "
                            data-toggle="modal" data-target="#modal_add_document">
                            enviar/upload +
                          </button>
                          <a href="<?php echo base_url(); ?>forms/request_for_reurb/<?php echo $requirement->id; ?>"
                            class="btn btn-sm btn-primary float-right" target="_blank">Gerar requerimento</a>
                        </div>
                      </div>

                      <div class="row mt-2">
                        <div class="col-md-12">
                          <div class="list-group text-dark">
                            <h5>Documentos enviados</h5>
                            <?php $count = 0; ?>
                            <?php foreach ($files_checklist as $row) : ?>
                            <div class="list-group-item d-inline align-items-center py-1 mb-1 ">
                              <span><?php echo $row->description; ?></span>
                              <?php if ($row->file == 'perfil.png') : ?>
                              <a href="<?php echo base_url(); ?>assets/build/img/perfil.png"
                                class="btn btn-sm btn-primary float-right"
                                download="<?php echo $row->description; ?>">Baixar</a>
                              <?php else : ?>
                              <a href="<?php echo base_url(); ?>assets/build/img/checklist_protocols/<?php echo $row->file; ?>"
                                class="btn btn-sm btn-primary float-right"
                                download="<?php echo $row->description; ?>">Baixar</a>
                              <?php endif; ?>
                              <button type="button" name="button"
                                class="btn btn-sm btn-success float-right files_checklist" data-toggle="modal"
                                data-target="#modal_edit_document" data-id="<?php echo $row->id; ?>"
                                data-classe="id_documents_<?php echo $row->id; ?>">
                                alterar arquivo
                              </button>

                              <input type="file" name="files_checklist[]" id="pic_file_<?php echo $row->id; ?>"
                                class="pic_file" value="" data-id="<?php echo $row->id; ?>" style="display: none;">
                              <span
                                class="d-flex align-items-center float-right text-primary mr-3 mt-2 name_file_<?php echo $row->id; ?>"></span>
                              <img src="" alt="" id="img_cpf" style="display: none;">
                            </div>
                            <?php $count++; ?>
                            <?php endforeach; ?>
                            <?php if ($count == 0) : ?>
                            <span>Sem documentos anexados</span>
                            <?php endif; ?>
                          </div>
                          <div class="" style="color: red;">
                            <p>Documentos faltantes:
                              <?php foreach ($checklist_not_send as $row) : ?>
                              <br><span>* <?php echo $row->description ?></span>
                              <?php endforeach; ?>
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="append_id_documents"></div>
                    </div>

                    <div class="tab-pane fade" id="register_conclusion" role="tabpanel"
                      aria-labelledby="register_conclusion-tab">
                      <div class="row">
                        <div class="col-12">
                          <?php if (!empty($conclusion_protocol)) : ?>
                          <?php if (!empty($protocol_history) && $requirement->status == '1') : ?>
                          <button class="btn btn-danger d-block my-4 ml-auto" data-toggle="modal"
                            data-target="#modal_conclusion_cancel" type="button">Cancelar Conclusão</button>
                          <?php else : ?>
                          <!-- <button class="btn btn-primary d-block my-4 ml-auto" data-toggle="modal" -->
                            <!-- data-target="#modal_conclusion_confirm" type="button" id="conclusao_cadastro">Concluir -->
                            <!-- Cadastro</button> -->
                          <?php endif; ?>
                          <?php endif; ?>
                          <button class="btn btn-primary d-block my-4 ml-auto" data-toggle="modal"
                            data-target="#modal_conclusion_confirm" type="button" id="conclusao_cadastro_2">Concluir
                            Cadastro</button>
                          <div class="row">
                            <div class="col-md-12">
                              <table class="table text-dark">
                                <thead>
                                  <tr>
                                    <th>Data de conclusão</th>
                                    <th>Responsável</th>
                                    <th>Status</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($protocol_history as $row) : ?>
                                  <?php $date = date_create($row->register); ?>
                                  <tr>
                                    <td><?php echo date_format($date, 'd/m/Y'); ?></td>
                                    <td><?php echo $row->name; ?></td>
                                    <td><?php echo ($row->status == '1') ? 'Concluído' : 'Conclusão Cancelada'; ?></td>
                                    <td>
                                      <a href="#" class="edit_protocol_conpletion" data-toggle="modal"
                                        data-target="#modal_edit_protocol_conpletion" data-id="<?php echo $row->id; ?>"
                                        data-status="<?php echo $row->status; ?>"
                                        data-reason="<?php echo $row->reason; ?>"
                                        data-responsible="<?php echo $row->name; ?>"
                                        data-date="<?php echo date_format($date, 'd/m/Y'); ?>">
                                        <i class="fa fa-search"></i>
                                      </a>
                                    </td>
                                  </tr>
                                  <?php endforeach; ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <?php endif; ?>

              <!--************************
                  Pessoa Juridica
              *************************-->
              <?php if ($requirement->people_type == 2) : ?>

              <div class="row peopleJuridica">
                <div class="col-md-12">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <?php if ($requirement->embarkation == 1) { ?>
                    <li class="nav-item">
                      <a class="nav-link <?php echo ($requirement->embarkation == '1') ? 'active' : '' ?>"
                        id="embarkation-tab" data-toggle="tab" href="#embarkation" role="tab"
                        aria-controls="embarkation" aria-selected="true">Embargo</a>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                      <a class="nav-link <?php echo ($requirement->embarkation == '1') ? '' : 'active' ?>"
                        id="juridical-person-tab" data-toggle="tab" href="#juridical-person" role="tab"
                        aria-controls="juridical" aria-selected="true">Juridica</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="tenants-juridical-tab" data-toggle="tab" href="#tenants-juridical"
                        role="tab" aria-controls="tenants-juridical" aria-selected="true">Condôminos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="realty-juridical-tab" data-toggle="tab" href="#realtys-juridical"
                        role="tab" aria-controls="realty-juridical" aria-selected="false">Dados do imóvel</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="realty-juridical-tab" data-toggle="tab"
                        href="#enquadramento_reurb_juridical" role="tab" aria-controls="realty-juridical"
                        aria-selected="false">Enquadramento na REURB</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="realty_tab_home" data-toggle="tab" href="#checklist_juridical" role="tab"
                        aria-controls="checklist-tab" aria-selected="false">Checklist</a>
                    </li>
                  </ul>

                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane <?php echo ($requirement->embarkation == '1') ? 'fade show active' : '' ?>"
                      id="embarkation" role="tabpanel" aria-labelledby="embarkation-tab">
                      <?php $count = 0; ?>
                      <?php foreach ($embargo_history as $row) : ?>
                      <?php if ($count != 0) : ?>
                      <hr style="border: 1px solid black;">
                      <?php endif; ?>
                      <?php $count++; ?>
                      <div class="row text-dark">
                        <div class="col-md-12 mt-3 mb-3">
                          <h6 class="text-center">Embargo <?php echo $count; ?></h6>
                        </div>
                        <div class="col-md-3">
                          <p>
                            <strong>Embargante:</strong> <br> <?php echo $row->id_responsible; ?>
                          </p>
                        </div>
                        <div class="col-md-3">
                          <p>
                            <strong>Embargado:</strong> <br> <?php echo $requirement->legal_name; ?>
                          </p>
                        </div>
                        <div class="col-md-3">
                          <?php $date = date_create($row->register); ?>
                          <p>
                            <strong>Data de apresentação:</strong> <br> <?php echo $date->format('d/m/Y'); ?>
                          </p>
                        </div>
                        <div class="col-md-3">
                          <p>
                            <strong>Status:</strong> <br>
                            <?php if ($row->status == '1') : ?>
                            Em análise
                            <?php endif; ?>
                            <?php if ($row->status == '2') : ?>
                            Embargo Procedente
                            <?php endif; ?>
                            <?php if ($row->status == '3') : ?>
                            Embargo Improcedente
                            <?php endif; ?>
                            <?php if ($row->status == '4') : ?>
                            Arquivado
                            <?php endif; ?>
                            <button type="button" class="edit_embarkation" name="button" data-toggle="modal"
                              data-target="#modal_update_embargo" data-id="<?php echo $row->id; ?>"
                              data-status="<?php echo $row->status; ?>"
                              data-legal_decision_analysis="<?php echo $row->legal_decision_analysis; ?>"
                              data-file_analysis="<?php echo $row->file_analysis; ?>"
                              style="background: none; border: 1px solid blue;">
                              Alterar
                            </button>
                          </p>
                        </div>
                        <div class="col-md-12 mt-2">
                          <p>
                            <strong>Motivo:</strong> <br>
                            <?php echo $row->reason; ?>
                          </p>
                        </div>
                        <div class="col-md-12 list-group">
                          <div class="list-group-item d-inline align-items-center py-1 mb-1 ">
                            <strong>PDF do motivo</strong>
                            <?php if (!empty($row->file)) : ?>
                            <a href="<?php echo base_url(); ?>assets/build/img/pdf_embarkation/<?php echo $row->file; ?>"
                              class="btn btn-sm btn-primary float-right" download="pdf_do_motivo">Baixar</a>
                            <button type="button" name="button"
                              class="btn btn-sm btn-success float-right files_embarkation" data-toggle="modal"
                              data-target="#modal_edit_file_embarkation" data-id="<?php echo $row->id; ?>">
                              alterar arquivo
                            </button>
                            <?php else : ?>
                            <button type="button" name="button" class="btn btn-sm btn-primary float-right">sem
                              arquivo</button>
                            <button type="button" name="button"
                              class="btn btn-sm btn-success float-right files_embarkation" data-toggle="modal"
                              data-target="#modal_edit_file_embarkation" data-id="<?php echo $row->id; ?>">
                              Enviar arquivo
                            </button>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="col-md-12 mt-2">
                          <p>
                            <strong>Análise / Decisão jurídica:</strong> <br>
                            <?php echo $row->legal_decision_analysis; ?>
                          </p>
                        </div>
                        <div class="col-md-12 list-group">
                          <div class="list-group-item d-inline align-items-center py-1 mb-1 ">
                            <strong>PDF da Análise / Decisão jurídica</strong>
                            <?php if (!empty($row->file_analysis)) : ?>
                            <a href="<?php echo base_url(); ?>assets/build/img/pdf_embarkation/<?php echo $row->file_analysis; ?>"
                              class="btn btn-sm btn-primary float-right" download>Baixar</a>
                            <button type="button" name="button"
                              class="btn btn-sm btn-success float-right files_analysis" data-toggle="modal"
                              data-target="#modal_files_analysis" data-id="<?php echo $row->id; ?>">
                              alterar arquivo
                            </button>
                            <?php else : ?>
                            <button type="button" name="button" class="btn btn-sm btn-primary float-right">sem
                              arquivo</button>
                            <button type="button" name="button"
                              class="btn btn-sm btn-success float-right files_analysis" data-toggle="modal"
                              data-target="#modal_files_analysis" data-id="<?php echo $row->id; ?>">
                              Enviar arquivo
                            </button>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>
                    <div class="tab-pane fade show active" id="juridical-person" role="tabpanel"
                      aria-labelledby="juridical-person-tab">
                      <div class="row pt-3">
                        <div class="col-md-4 pr-md-1">
                          <div class="form-group">
                            <label for="protocol_procedure_juridical">Procedimento</label>
                            <input type="text" name="protocol_procedure_juridical" id="protocol_procedure_juridical"
                              value="<?php echo $requirement->process_number . '.' . $requirement->stage . ' / ' . $requirement->core_name; ?>"
                              class="form-control pr-md-1" readonly>
                          </div>
                        </div>
                        <div class="col-md-4 px-md-1">
                          <div class="form-group">
                            <label for="cpf_personal">Identificador</label>
                            <input type="text" name="" id="" class="form-control"
                              value="<?php echo  str_pad($requirement->id, 3, '0', STR_PAD_LEFT); ?>" readonly>
                            <?php echo form_error('cpf_personal'); ?>
                          </div>
                        </div>
                        <div class="col-md-4 pl-md-1">
                          <div class="form-group">
                            <label for="data">Data</label>
                            <?php $data = date_create($requirement->register); ?>
                            <input type="text" name="data" id="data" class="form-control"
                              value="<?php echo date_format($data, 'd/m/Y'); ?>" readonly>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4 pr-md-1">
                          <div class="form-group">
                            <label for="cnpj_juridical">CNPJ</label>
                            <input type="text" name="cnpj_juridical" id="cnpj_juridical" class="form-control"
                              value="<?php echo $requirement->cnpj; ?>" readonly>
                            <?php echo form_error('cnpj_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md-4 px-md-1">
                          <div class="form-group">
                            <label for="corporate_name_juridical">Razão social</label>
                            <input type="text" name="corporate_name_juridical" id="corporate_name_juridical"
                              class="form-control" value="<?php echo $requirement->company_name; ?>" readonly>
                            <?php echo form_error('corporate_name_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md-4 pl-md-1">
                          <div class="form-group">
                            <label for="activity_branch_juridical">Ramo de atividade</label>
                            <input type="text" name="activity_branch_juridical" id="activity_branch_juridical"
                              class="form-control" value="<?php echo $requirement->activity_branch; ?>" readonly>
                            <?php echo form_error('activity_branch_juridical'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 pr-md-1">
                          <div class="form-group">
                            <label for="type_street_juridical">Tipo de logradouro</label>
                            <select class="custom-select" id="type_street_juridical" name="type_street_juridical"
                              readonly disabled>
                              <option value=""></option>
                              <option value="Alameda"
                                <?php echo ($requirement->type_street_juridical == 'Alameda') ? 'selected' : ''; ?>>
                                Alameda</option>
                              <option value="Avenida"
                                <?php echo ($requirement->type_street_juridical == 'Avenida') ? 'selected' : ''; ?>>
                                Avenida</option>
                              <option value="Praça"
                                <?php echo ($requirement->type_street_juridical == 'Praça') ? 'selected' : ''; ?>>Praça
                              </option>
                              <option value="Rua"
                                <?php echo ($requirement->type_street_juridical == 'Rua') ? 'selected' : ''; ?>>Rua
                              </option>
                              <option value="Travessa"
                                <?php echo ($requirement->type_street_juridical == 'Travessa') ? 'selected' : ''; ?>>
                                Travessa</option>
                              <option value="Via"
                                <?php echo ($requirement->type_street_juridical == 'Via') ? 'selected' : ''; ?>>Via
                              </option>
                              <option value="Viela"
                                <?php echo ($requirement->type_street_juridical == 'Viela') ? 'selected' : ''; ?>>Viela
                              </option>
                            </select>
                            <?php echo form_error('type_street_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md-4 px-md-1">
                          <div class="form-group">
                            <label for="street_juridical">Logradouro</label>
                            <input type="text" name="street_juridical" id="street_juridical" class="form-control"
                              value="<?php echo $requirement->public_place_juridical; ?>" readonly>
                            <?php echo form_error('street_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md-4 pl-md-1">
                          <div class="form-group">
                            <label for="number_name_juridical">Numero</label>
                            <input type="text" name="number_name_juridical" id="number_name_juridical"
                              class="form-control" value="<?php echo $requirement->number_juridical; ?>" readonly>
                            <?php echo form_error('number_name_juridical'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 pr-md-1">
                          <div class="form-group">
                            <label for="complement_juridical">Complemento</label>
                            <input type="text" name="complement_juridical" id="complement_juridical"
                              class="form-control" value="<?php echo $requirement->complement_juridical; ?>" readonly>
                            <?php echo form_error('complement_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md-6 pl-md-1">
                          <div class="form-group">
                            <label for="neighborhood_juridical">Bairro</label>
                            <input type="text" name="neighborhood_juridical" id="neighborhood_juridical"
                              class="form-control" value="<?php echo $requirement->neighborhood_juridical; ?>" readonly>
                            <?php echo form_error('neighborhood_juridical'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 pr-md-1">
                          <div class="form-group">
                            <label for="city_juridical">Cidade</label>
                            <input type="text" name="city_juridical" id="city_juridical" class="form-control"
                              value="<?php echo $requirement->city_juridical; ?>" readonly>
                            <?php echo form_error('city_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md-4 px-md-1">
                          <div class="form-group">
                            <label for="cep_juridical">CEP</label>
                            <input type="text" name="cep_juridical" id="cep_juridical" class="form-control cep"
                              value="<?php echo $requirement->cep_juridical; ?>" readonly>
                            <?php echo form_error('cep_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md-4 pl-md-1">
                          <div class="form-group">
                            <label for="uf_juridical">UF</label>
                            <input type="text_juridical" name="uf_juridical" id="uf_juridical" class="form-control"
                              value="<?php echo $requirement->uf_juridical; ?>" readonly>
                            <?php echo form_error('uf_juridical'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="country_juridical">País</label>
                            <input type="text" name="country_juridical" id="country_juridical" class="form-control"
                              value="<?php echo $requirement->country; ?>" readonly>
                            <?php echo form_error('country_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="monthly_invoicing_juridical">Faturamento mensal</label>
                            <input type="text" name="monthly_invoicing_juridical" id="monthly_invoicing_juridical"
                              class="form-control valor" value="<?php echo $requirement->monthly_invoicing; ?>"
                              readonly>
                            <?php echo form_error('monthly_invoicing_juridical'); ?>
                          </div>
                        </div>
                      </div>

                    </div>

                    <div class="tab-pane py-2" id="tenants-juridical" role="tabpanel"
                      aria-labelledby="tenants-juridical-tab">
                      <div class="row">
                        <div class="col-md-12">
                          <a class="btn btn-primary btn-round float-md-right float-sm-right float-xs-right"
                            data-toggle="modal" data-target="#tenants_detail"><i
                              class="fas fa-plus pr-2"></i>Adicionar</a>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12" id="table_tenants">
                          <table id="" class="table table-bordered table-striped text-dark w-100">
                            <thead>
                              <tr>
                                <th scope="col">Cpf / Cnpj</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">É proprietário(a) de imóvel?</th>
                                <th></th>
                              </tr>
                            </thead>
                            <?php $property_owner_tenants = '0'; ?>
                            <tbody id="tenants_list">
                              <?php $count = 0; ?>
                              <?php foreach ($tenants as $row) : ?>
                              <?php $count++; ?>
                              <tr>
                                <td><?php echo (isset($row->cpf)) ? $row->cpf : $row->cnpj;  ?></td>
                                <td><?php echo (isset($row->legal_name)) ? $row->legal_name : $row->company_name;  ?>
                                </td>
                                <td>
                                  <?php echo (isset($row->legal_phone)) ? $row->legal_phone : $row->phone_procurator;  ?>
                                </td>
                                <td>
                                  <?php echo (isset($row->legal_email)) ? $row->legal_email : $row->email_procurator;  ?>
                                </td>
                                <td>
                                  <?php if (isset($row->property_owner_legal)) {
                                        $legal = ($row->property_owner_legal == '1') ? 'Sim' : 'Não';
                                        echo $legal;
                                        if ($legal == 'Sim') {
                                          $property_owner_tenants = '1';
                                        }
                                      } else {
                                        $juridical = ($row->property_owner_juridical == '1') ? 'Sim' : 'Não';
                                        echo $juridical;
                                        if ($juridical == 'Sim') {
                                          $property_owner_tenants = '1';
                                        }
                                      }
                                      ?>
                                </td>
                                <td>
                                  <button type="button" name="button"
                                    class="btn btn-sm btn-danger remove_tenants_juridical"
                                    data-id="<?php echo $row->id; ?>"
                                    data-id_requirement="<?php echo $requirement->id; ?>">X</button>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                          <input type="hidden" name="id_requirement" value="<?php echo $requirement->id ?>"
                            id="id_requirement">
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane" id="realtys-juridical" role="tabpanel"
                      aria-labelledby="realty_tab_home_juridical">
                      <div class="row mt-3">
                        <div class="col-md-2 pr-md-1">
                          <div class="form-group">
                            <label for="real_state_juridical">Inscrição Imobiliária Municipal</label>
                            <input type="text" name="real_state_juridical" id="real_state_juridical"
                              class="form-control" value="<?php echo $requirement->furniture_registration; ?>"
                              data-field="Inscrição Imobiliária Municipal">
                            <?php echo form_error('real_state_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md-2 py-3 px-md-1">
                          <div class="form-group">
                            <label for="sector_juridical">Setor</label>
                            <input type="text" name="sector_juridical" id="sector_juridical" class="form-control"
                              value="<?php echo $requirement->sector; ?>" data-field="Setor">
                          </div>
                        </div>
                        <div class="col-md-2 py-3 px-md-1">
                          <div class="form-group">
                            <label for="city_block_juridical">Quadra</label>
                            <input type="text" name="city_block_juridical" id="city_block_juridical"
                              class="form-control" value="<?php echo $requirement->city_block; ?>" data-field="Quadra">
                          </div>
                        </div>
                        <div class="col-md-2 py-3 px-md-1">
                          <div class="form-group">
                            <label for="allotment_juridical">Lote</label>
                            <input type="text" name="allotment_juridical" id="allotment_juridical" class="form-control"
                              value="<?php echo $requirement->allotment; ?>" data-field="Lote">
                          </div>
                        </div>
                        <div class="col-md-1 py-3 px-md-1">
                          <div class="form-group">
                            <label for="sub_lot_juridical">Sub lote</label>
                            <input type="text" name="sub_lot_juridical" id="sub_lot_juridical" class="form-control"
                              value="<?php echo $requirement->sub_lot; ?>">
                          </div>
                        </div>
                        <div class="col-md-3 pl-md-1">
                          <div class="form-group">
                            <label for="property_registration_number_juridical">Numero de matrícula do imóvel aberta
                              pelo Procedimento de REURB:</label>
                            <input type="text" name="property_registration_number_juridical"
                              id="property_registration_number_juridical" class="form-control"
                              value="<?php echo $requirement->property_registration_number; ?>"
                              date-field="Numero de matrícula do imóvel aberta pelo Procedimento de REURB:">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="residential_property_juridical">Tipo de Logradouro</label>
                            <select class="custom-select" id="realty_type_juridical" name="realty_type_juridical"
                              data-field="Tipo de Logradouro">
                              <option value=""></option>
                              <option value="Alameda"
                                <?php echo ($requirement->street_property == 'Alameda') ? 'selected' : ''; ?>>Alameda
                              </option>
                              <option value="Avenida"
                                <?php echo ($requirement->street_property == 'Avenida') ? 'selected' : ''; ?>>Avenida
                              </option>
                              <option value="Praça"
                                <?php echo ($requirement->street_property == 'Praça') ? 'selected' : ''; ?>>Praça
                              </option>
                              <option value="Rua"
                                <?php echo ($requirement->street_property == 'Rua') ? 'selected' : ''; ?>>Rua</option>
                              <option value="Travessa"
                                <?php echo ($requirement->street_property == 'Travessa') ? 'selected' : ''; ?>>Travessa
                              </option>
                              <option value="Via"
                                <?php echo ($requirement->street_property == 'Via') ? 'selected' : ''; ?>>Via</option>
                              <option value="Viela"
                                <?php echo ($requirement->street_property == 'Viela') ? 'selected' : ''; ?>>Viela
                              </option>
                            </select>
                            <?php echo form_error('realty_type_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md-6 px-md-1">
                          <div class="form-group">
                            <label for="realty_address_juridical">Logradouro</label>
                            <input type="text" name="realty_address_juridical" id="realty_address_juridical"
                              class="form-control" value="<?php echo $requirement->place_property; ?>"
                              data-field="Logradouro">
                            <?php echo form_error('realty_address_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="realty_number_juridical">Numero</label>
                            <input type="text" name="realty_number_juridical" id="realty_number_juridical"
                              class="form-control" value="<?php echo $requirement->number_property; ?>"
                              data-field="Numero">
                            <?php echo form_error('realty_number_juridical'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 pr-md-1">
                          <div class="form-group">
                            <label for="realty_complement_juridical">Complemento</label>
                            <input type="text" name="realty_complement_juridical" id="realty_complement_juridical"
                              class="form-control" value="<?php echo $requirement->complement_property; ?>">
                            <?php echo form_error('realty_complement_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md-6 pl-md-1">
                          <div class="form-group">
                            <label for="realty_neighborhood_juridical">Bairro</label>
                            <input type="text" name="realty_neighborhood_juridical" id="realty_neighborhood_juridical"
                              class="form-control" value="<?php echo $requirement->neighborhood_property; ?>"
                              data-field="Bairro">
                            <?php echo form_error('realty_neighborhood_juridical'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 pr-md-1 ">
                          <div class="form-group">
                            <label for="realty_city_juridical">Cidade</label>
                            <input type="text" name="realty_city_juridical" id="realty_city_juridical"
                              class="form-control" value="<?php echo $requirement->city_property; ?>">
                            <?php echo form_error('realty_city_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md-4 px-md-1">
                          <div class="form-group">
                            <label for="realty_cep_juridical">CEP</label>
                            <input type="text" name="realty_cep_juridical" id="realty_cep_juridical"
                              class="form-control cep" value="<?php echo $requirement->cep_property; ?>">
                            <?php echo form_error('realty_cep_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md-4 pl-md-1">
                          <div class="form-group">
                            <label for="realty_uf_juridical">UF</label>
                            <input type="text" name="realty_uf_juridical" id="realty_uf_juridical" class="form-control"
                              value="<?php echo $requirement->uf_property; ?>">
                            <?php echo form_error('realty_uf_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="realty_country_juridical">País</label>
                            <input type="text" name="realty_country_juridical" id="realty_country_juridical"
                              class="form-control" value="<?php echo $requirement->country_property; ?>">
                            <?php echo form_error('realty_country_juridical'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="realty_address_posses_juridical">Data início da Posse / Ocupação</label>
                            <input type="date" name="realty_address_posses_juridical"
                              id="realty_address_posses_juridical" class="form-control"
                              value="<?php echo $requirement->inauguration_date; ?>">
                            <?php echo form_error('realty_address_posses_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="required_terrain_area_juridical pr-md-1">Área requerida do imóvel -
                              m<sup>2</sup></label>
                            <input type="text" name="required_terrain_area_juridical"
                              id="required_terrain_area_juridical" class="form-control valor"
                              value="<?php echo $requirement->required_land_area; ?>">
                            <?php echo form_error('required_terrain_area_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="georeferenced_property_area_juridical pr-md-1">Área do imóvel georreferenciada -
                              m<sup>2</sup></label>
                            <input type="text" name="georeferenced_property_area_juridical"
                              id="georeferenced_property_area_juridical" class="form-control venal"
                              value="<?php echo $requirement->georeferenced_property_area; ?>"
                              data-field="Área do imóvel georreferenciada - m² ">
                            <?php echo form_error('georeferenced_property_area_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="required_edificated_area_juridical">Área edificada m<sup>2</sup></label>
                            <input type="text" name="required_edificated_area_juridical"
                              id="required_edificated_area_juridical" class="form-control valor"
                              value="<?php echo $requirement->construction_features; ?>">
                            <?php echo form_error('required_edificated_area_juridical'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 pr-md-1">
                          <div class="form-group">
                            <label for="construction_features_juridical">Características da construção</label>
                            <input type="text" name="construction_features_juridical"
                              id="construction_features_juridical" class="form-control"
                              value="<?php echo $requirement->confrontants; ?>">
                            <?php echo form_error('construction_features_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md-6 pl-md-1">
                          <div class="form-group">
                            <label for="venal_juridical">Valor venal (avaliação no cadastro imobiliário
                              Municipal)R$</label>
                            <input type="text" name="venal_juridical" id="venal_juridical" class="form-control venal"
                              value="<?php echo $requirement->venal; ?>" data-field="Valor venal">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 pr-md-1">
                          <div class="form-group">
                            <label for="possession_origin_juridical">Origem da Posse</label>
                            <select class="form-control" name="possession_origin_juridical"
                              id="possession_origin_juridical">
                              <option value=""></option>
                              <option value="Contrato/Recibo de Compra e Venda"
                                <?php echo ($requirement->possession_origin == 'Contrato/Recibo de Compra e Venda') ? 'selected' : ''; ?>>
                                Contrato/Recibo de Compra e Venda</option>
                              <option value="Doação"
                                <?php echo ($requirement->possession_origin == 'Doação') ? 'selected' : ''; ?>>Doação
                              </option>
                              <option value="Herança"
                                <?php echo ($requirement->possession_origin == 'Herança') ? 'selected' : ''; ?>>Herança
                              </option>
                              <option value="Declaração de Posse"
                                <?php echo ($requirement->possession_origin == 'Declaração de Posse') ? 'selected' : ''; ?>>
                                Declaração de Posse</option>
                              <option value="Posse a Justo Título"
                                <?php echo ($requirement->possession_origin == 'Posse a Justo Título') ? 'selected' : ''; ?>>
                                Posse a Justo Título</option>
                              <option value="Posse por Simples Ocupação"
                                <?php echo ($requirement->possession_origin == 'Posse por Simples Ocupação') ? 'selected' : ''; ?>>
                                Posse por Simples Ocupação</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6 pl-md-1">
                          <div class="form-group">
                            <label for="slab_right">Direito de Laje</label>
                            <select class="form-control" name="slab_right_juridical" data-field="Direito de Laje">
                              <option value=""></option>
                              <option value="1" <?= ($requirement->slab_right == '1') ? 'selected' : ''; ?>>Sim</option>
                              <option value="0" <?= ($requirement->slab_right == '0') ? 'selected' : ''; ?>>Não</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="infrastructure_select_juridical">Infraestrutura básica</label>
                            <select class="form-control" name="infrastructure_select_juridical"
                              id="infrastructure_select_juridical">
                              <option value="<?php echo $requirement->basic_infrastructure; ?>" selected>
                                <?php echo ($requirement->basic_infrastructure == '1') ? 'Sim' : 'Não'; ?></option>
                              <?php if ($requirement->basic_infrastructure == '1') : ?>
                              <option value="0">Não</option>
                              <?php else : ?>
                              <option value="1">Sim</option>
                              <?php endif; ?>

                            </select>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="potable_water_select_juridical">Água potável</label>
                            <select class="form-control" name="potable_water_select_juridical"
                              id="potable_water_select_juridical">
                              <option value="<?php echo $requirement->potable_water; ?>" selected>
                                <?php echo ($requirement->potable_water == '1') ? 'Sim' : 'Não'; ?></option>
                              <?php if ($requirement->potable_water == '1') : ?>
                              <option value="0">Não</option>
                              <?php else : ?>
                              <option value="1">Sim</option>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="infrastructure_select_juridical">Energia</label>
                            <select class="form-control" name="infrastructure_select_juridical"
                              id="infrastructure_select_juridical">
                              <option value="<?php echo $requirement->energy; ?>" selected>
                                <?php echo ($requirement->energy == '1') ? 'Sim' : 'Não'; ?></option>
                              <?php if ($requirement->energy == '1') : ?>
                              <option value="0">Não</option>
                              <?php else : ?>
                              <option value="1">Sim</option>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="sewage_select_juridical">Esgotamento Sanitário</label>
                            <select class="form-control" name="sewage" id="sewage">
                              <option value="<?php echo $requirement->sewage; ?>" selected>
                                <?php echo ($requirement->sewage == '1') ? 'Sim' : 'Não'; ?></option>
                              <?php if ($requirement->sewage == '1') : ?>
                              <option value="0">Não</option>
                              <?php else : ?>
                              <option value="1">Sim</option>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6 pl-md-1">
                          <div class="form-group">
                            <label for="sewage_select_juridical">Tipo de esgoto</label>
                            <select class="form-control" name="sewage_select_juridical" id="sewage_select_juridical">
                              <option value=""></option>
                              <option value="Rede Pública"
                                <?php echo ($requirement->type_sewer == 'Rede Pública') ? 'selected' : ''; ?>>Rede
                                Pública</option>
                              <option value="Fossa séptica"
                                <?php echo ($requirement->type_sewer == 'Fossa séptica') ? 'selected' : ''; ?>>Fossa
                                séptica</option>
                              <option value="Outro"
                                <?php echo ($requirement->type_sewer == 'Outro') ? 'selected' : ''; ?>>Outro</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 pr-md-1">
                          <div class="form-group">
                            <label for="type_property_juridical">Tipo de imóvel:</label>
                            <select class="form-control" name="type_property_juridical" id="type_property_juridical"
                              data-field="Tipo de imovel">
                              <option value=""></option>
                              <option value="Residencial"
                                <?php echo ($requirement->type_property_details == 'Residencial') ? 'selected' : ''; ?>>
                                Residencial</option>
                              <option value="Comercial"
                                <?php echo ($requirement->type_property_details == 'Comercial') ? 'selected' : ''; ?>>
                                Comercial</option>
                              <option value="Misto Residencial/Comercial"
                                <?php echo ($requirement->type_property_details == 'Misto Residencial/Comercial') ? 'selected' : ''; ?>>
                                Misto Residencial/Comercial</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6 pl-md-1">
                          <div class="form-group">
                            <label for="unit_situation_juridical">Situação da unidade:</label>
                            <select class="form-control" name="unit_situation_juridical" id="unit_situation_juridical">
                              <option value=""></option>
                              <option value="Construída"
                                <?php echo ($requirement->unit_situation == 'Construída') ? 'selected' : ''; ?>>
                                Construída</option>
                              <option value="Em construção"
                                <?php echo ($requirement->unit_situation == 'Em construção') ? 'selected' : ''; ?>>Em
                                construção</option>
                              <option value="Lote Vago"
                                <?php echo ($requirement->unit_situation == 'Lote Vago') ? 'selected' : ''; ?>>Lote Vago
                              </option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="paviment_select_juridical">Rua pavimentada</label>
                            <select class="form-control" name="paviment_select_juridical"
                              id="paviment_select_juridical">
                              <option value="<?php echo $requirement->paved_street; ?>" selected>
                                <?php echo ($requirement->paved_street == '1') ? 'Sim' : 'Não'; ?></option>
                              <?php if ($requirement->paved_street == '1') : ?>
                              <option value="0">Não</option>
                              <?php else : ?>
                              <option value="1">Sim</option>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="paviment_type_select_juridical">Tipo de pavimentação</label>
                            <select class="form-control" name="paviment_type_select_juridical"
                              id="paviment_type_select_juridical">
                              <option value="<?php echo $requirement->paving_type; ?>" selected>
                                <?php echo $requirement->paving_type; ?></option>
                              <option value="Asfalto">Asfalto</option>
                              <option value="Ladrilhos">Ladrilhos</option>
                              <option value="Bloquetes">Bloquetes</option>
                              <option value="Ladrilhos">Ladrilhos</option>
                              <option value="Outros">Outros</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="internet_access_select_juridical">Acesso à internet</label>
                            <select class="form-control" name="internet_access_select_juridical"
                              id="internet_access_select_juridical">
                              <option value="<?php echo $requirement->internet_access; ?>" selected>
                                <?php echo ($requirement->internet_access == '1') ? 'Sim' : 'Não'; ?></option>
                              <?php if ($requirement->internet_access == '1') : ?>
                              <option value="0">Não</option>
                              <?php else : ?>
                              <option value="1">Sim</option>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="register_date_juridical">Data cadastro</label>
                            <input type="date" name="register_date_juridical" id="register_date_juridical"
                              class="form-control" value="<?php echo $requirement->date_register; ?>">
                            <?php echo form_error('register_date_juridical'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <h4 class="text-dark d-inline">Confrontantes</h4>
                          <a href="<?php echo base_url(); ?>forms/statement_of_confrontants/<?php echo $requirement->id; ?>"
                            class="btn btn-sm btn-primary float-right" target="_blank">Gerar declaração de
                            confrontantes</a>
                        </div>
                      </div>
                      <?php foreach ($confrotants_property as $key => $row) : ?>
                      <div class="row">
                        <div class="col-md-2 pr-md-1">
                          <div class="form-group">
                            <label for="cpf_confrontants">Cpf</label>
                            <input type="text" name="cpf_confrontants_juridical[]" id="cpf_confrontants"
                              class="form-control cpf cpf_confrontants" value="<?php echo $row->cpf; ?>"
                              data-id_name="name_confrontants_<?php echo $key; ?>"
                              data-id_nascimento="birth_date_confrontants_<?php echo $key; ?>">
                          </div>
                        </div>
                        <div class="col-md-3 px-md-1">
                          <div class="form-group">
                            <label for="name_confrontants">Nome</label>
                            <input type="text" name="name_confrontants_juridical[]"
                              id="name_confrontants_<?php echo $key; ?>" class="form-control"
                              value="<?php echo $row->name; ?>">
                          </div>
                        </div>
                        <div class="col-md-3 px-md-1">
                          <div class="form-group">
                            <label for="birth_date_confrontants">Data nacimento</label>
                            <input type="date" name="birth_date_confrontants_juridical[]"
                              id="birth_date_confrontants_<?php echo $key; ?>" class="form-control"
                              value="<?php echo $row->birth_date; ?>">
                            <?php echo form_error('birth_date_confrontants'); ?>
                          </div>
                        </div>
                        <div class="col-md-4 pl-md-1">
                          <div class="form-group">
                            <label for="confrontation_direction">Confrontação</label>
                            <select class="form-control" name="confrontation_direction_juridical[]">
                              <option value=""></option>
                              <option value="Lado esquerdo"
                                <?php echo ($row->confrontation_direction == 'Lado esquerdo') ? 'selected' : ''; ?>>Lado
                                esquerdo</option>
                              <option value="Lado direito"
                                <?php echo ($row->confrontation_direction == 'Lado direito') ? 'selected' : ''; ?>>Lado
                                direito</option>
                              <option value="Fundos"
                                <?php echo ($row->confrontation_direction == 'Fundos') ? 'selected' : ''; ?>>Fundos
                              </option>
                            </select>
                            <span class="text-dark">*Descrever as confrontações de dentro do móvel olhando para
                              rua</span>
                          </div>
                        </div>
                      </div>
                      <input type="hidden" name="id_confrontants_juridical[]" value="<?php echo $row->id; ?>">
                      <?php endforeach; ?>
                      <div class="row">
                        <div class="col-md-2">
                          <button type="button" name="button" class="btn btn-primary add_new_confrotant"
                            data-toggle="modal" data-target="#modal_confrotants"
                            data-id_property="<?php echo $requirement->id_property; ?>">+ Adicionar</button>
                        </div>
                      </div>
                      <?php if (!empty($requirement->front)) : ?>
                      <div class="row">
                        <div class="col-md-12 text-dark">
                          <button type="button" name="button" class="btn btn-primary visualizar_frontal"
                            data-tipo="juridico">
                            Visualizar foto frontal do imóvel
                          </button>
                        </div>
                      </div>
                      <div class="row imagem_frontal_juridical" style="display: none;">
                        <div class="col-md-12 d-flex justify-content-center">
                          <img
                            src="<?php echo base_url(); ?>assets/build/img/checklist_protocols/<?php echo $requirement->front; ?>"
                            alt="" class="foto_frontal_confrotants">
                        </div>
                      </div>
                      <?php endif; ?>
                    </div>
                    <div class="tab-pane" id="enquadramento_reurb_juridical" role="tabpanel"
                      aria-labelledby="enquadramento_reurb_juridical">
                      <div class="row mt-2 mb-2">
                        <div class="col-md-5 text-dark">
                          <span>Renda Total (membros da familia/condôminos): <p class="text-primary"
                              id="monthly_income_total">R$ <?php echo $monthly_income_total_juridical; ?></p></span>
                        </div>
                        <div class="col-md-7 text-dark">
                          <span>É proprietário(a) de imóvel urbano ou rural registrado em Cartório de Imóveis?
                            <?php
                              if ($requirement->property_owner == '1' || $requirement->property_owner_legal == '1' || $property_owner_tenants == '1') {
                                $property_owner = 'Sim';
                              } else {
                                $property_owner = 'Não';
                              }
                              ?>
                            <p class="text-primary" id="proprietario_imovel"><?php echo $property_owner; ?></p>
                          </span>
                        </div>
                      </div>
                      <div class="row text-dark">
                        <div class="col-md-12">
                          <label for="criteria_established_law">De acordo com os critérios acima estabelecidos pela lei
                            Federal nº 13.465/2017 e Decreto 9.310/18,
                            e legislação Municipal vigente, o requerente enquadra-se na modalidade de: </label>
                          <p class="text-primary reurb_classification" name="reurb_juridical" id="reurb">
                            <?php echo ($property_owner == 'Sim' || $monthly_income_total_juridical > $maximum_income['maximum_family_income']) ? 'REURB-E' : 'REURB-S'; ?>
                          </p>
                          <input type="hidden" name="reurb_type" value="" id="reurb_type">
                        </div>
                        <input type="hidden" name="maximum_family_income" value="" id="maximum_family_income_juridical">
                      </div>
                    </div>

                    <div class="tab-pane fade" id="checklist_juridical" role="tabpanel" aria-labelledby="address-tab">
                      <div class="row mt-3">
                        <div class="col-md-12">
                          <button type="button" name="button" class="btn btn-sm btn-primary float-right "
                            data-toggle="modal" data-target="#modal_add_document">
                            enviar/upload +
                          </button>
                        </div>
                      </div>

                      <div class="row mt-2">
                        <div class="col-md-12">
                          <div class="list-group text-dark">
                            <h5>Documentos enviados</h5>
                            <?php $count = 0; ?>
                            <?php foreach ($files_checklist as $row) : ?>
                            <div class="list-group-item d-inline align-items-center py-1 mb-1 ">
                              <span><?php echo $row->description; ?></span>

                              <?php if ($row->file == 'perfil.png') : ?>
                              <a href="<?php echo base_url(); ?>assets/build/img/perfil.png"
                                class="btn btn-sm btn-primary float-right"
                                download="<?php echo $row->description; ?>">Baixar</a>
                              <?php else : ?>
                              <a href="data:image/png;base64,<?php echo base64_encode($row->file); ?>"
                                class="btn btn-sm btn-primary float-right"
                                download="<?php echo $row->description; ?>">Baixar</a>
                              <?php endif; ?>
                              <button type="button" name="button"
                                class="btn btn-sm btn-success float-right files_checklist" data-toggle="modal"
                                data-target="#modal_edit_document" data-id="<?php echo $row->id; ?>"
                                data-classe="id_documents_<?php echo $row->id; ?>">
                                alterar arquivo
                              </button>

                              <input type="file" name="files_checklist[]" id="pic_file_<?php echo $row->id; ?>"
                                class="pic_file" value="" data-id="<?php echo $row->id; ?>" style="display: none;">
                              <span
                                class="d-flex align-items-center float-right text-primary mr-3 mt-2 name_file_<?php echo $row->id; ?>"></span>
                              <img src="" alt="" id="img_cpf" style="display: none;">
                            </div>
                            <?php $count++; ?>
                            <?php endforeach; ?>
                            <?php if ($count == 0) : ?>
                            <span>Sem documentos anexados</span>
                            <?php endif; ?>
                          </div>
                          <div class="" style="color: red;">
                            <p>Documentos faltantes:
                              <?php foreach ($checklist_not_send as $row) : ?>
                              <br><span>* <?php echo $row->description ?></span>
                              <?php endforeach; ?>
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="append_id_documents"></div>
                    </div>
                  </div>
                </div>
              </div>

              <?php endif; ?>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-6 d-flex justify-content-start">
                    <button type="button" name="button" class="btn btn-primary float-left" data-toggle="modal"
                      data-target="#modal_embargar">
                      Embargo
                    </button>
                  </div>
                  <div class="col-md-6 d-flex justify-content-end">
                    <a href="<?php echo base_url() ?>protocols" class="btn btn-secundary mr-1">Voltar</a>

                    <?php if (!(!empty($protocol_history) && $requirement->status == '1')) : ?>
                    <button type="submit" name="update_requirement" id="update_requirement"
                      class="btn btn-primary">Atualizar</button>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tenants_detail" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar Condôminos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <table id="modal_table_tenants" class="table table-bordered table-striped text-dark w-100">
              <thead>
                <tr>
                  <th scope="col">Cpf / Cnpj</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Telefone</th>
                  <th scope="col">E-mail</th>
                  <th scope="col">É proprietário(a) de imóvel?</th>
                  <th scope="col">Ação</th>
                </tr>
              </thead>
              <tbody>
                <?php $count = 0; ?>
                <?php foreach ($requesters as $row) : ?>
                <?php $count++; ?>
                <tr>
                  <td><?php echo (isset($row->cpf)) ? $row->cpf : $row->cnpj; ?></td>
                  <td><?php echo (isset($row->legal_name)) ? $row->legal_name : $row->company_name; ?></td>
                  <td><?php echo (isset($row->legal_phone)) ? $row->legal_phone : $row->procurator_phone; ?></td>
                  <td><?php echo (isset($row->legal_email)) ? $row->legal_email : $row->procurator_email; ?></td>
                  <td>
                    <?php if (isset($row->property_owner_legal)) {
                        $legal = ($row->property_owner_legal == '1') ? 'Sim' : 'Não';
                        echo $legal;
                      } else {
                        $juridical = ($row->property_owner_juridical == '1') ? 'Sim' : 'Não';
                        echo $juridical;
                      } ?>
                  </td>
                  <td>
                    <i class="fa fa-plus add_new_tenants" data-id="<?php echo $row->id; ?>"
                      data-classe="property_owner_<?php echo $count ?>"></i>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
              <input type="hidden" name="id_requirement" id="id_requirement_requester"
                value="<?php echo $requirement->id; ?>">
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="<?php echo base_url(); ?>requesters/register" class="btn btn-primary">Cadastrar novo condômino</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- modal_confrotants -->
<div class="modal fade" id="modal_confrotants" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>protocols/add_confrotants/<?php echo $requirement->id; ?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Adicionar Confrontantes</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-2 pr-md-1">
              <div class="form-group">
                <label for="add_cpf_confrontants">Cpf</label>
                <input type="text" name="add_cpf_confrontants" id="add_cpf_confrontants"
                  class="form-control cpf cpf_confrontants" value="<?php echo set_value('add_cpf_confrontants'); ?>"
                  data-id_name="add_name_confrontants_0" data-id_nascimento="add_birth_date_confrontants_0">
                <?php echo form_error('add_cpf_confrontants'); ?>
              </div>
            </div>
            <div class="col-md-3 px-md-1">
              <div class="form-group">
                <label for="add_name_confrontants">Nome</label>
                <input type="text" name="add_name_confrontants" id="add_name_confrontants_0" class="form-control"
                  value="<?php echo set_value('add_name_confrontants'); ?>">
                <?php echo form_error('add_name_confrontants'); ?>
              </div>
            </div>
            <div class="col-md-3 px-md-1">
              <div class="form-group">
                <label for="add_birth_date_confrontants">Data nacimento</label>
                <input type="date" name="add_birth_date_confrontants" id="add_birth_date_confrontants_0"
                  class="form-control" value="<?php echo set_value('add_birth_date_confrontants'); ?>">
                <?php echo form_error('add_birth_date_confrontants'); ?>
              </div>
            </div>
            <div class="col-md-4 pl-md-1">
              <div class="form-group">
                <label for="confrontation_direction">Confrontação</label>
                <select class="form-control" name="confrontation_direction">
                  <option value=""></option>
                  <option value="Lado esquerdo">Lado esquerdo</option>
                  <option value="Lado direito">Lado direito</option>
                  <option value="Fundos">Fundos</option>
                </select>
                <span class="text-dark">*Descrever as confrontações de dentro do móvel olhando para rua</span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <input type="hidden" name="id_property_confrotants" id="id_property_confrotants" value="">
          <button type="submit" name="register_confrotants" class="btn btn-primary">Adicionar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_imagem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg ">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>protocols/editar_imagem/<?php echo $requirement->id; ?>" method="post"
        enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class=" d-flex justify-content-center" id="plusImgContent">
                <label class="picimg_4" id="picimg_4">
                  <img id="img_4" data-pic="picimg_4" data-img="img_4" class="add_img" src="">
                  <input id="picimg_4" name="imagens_protocol" type="file" style="display: none;">
                  <br><br>
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <input type="hidden" name="type_img" id="type_img" value="">
          <input type="hidden" name="id_property_imagens" id="id_property_imagens" value="">
          <button type="submit" name="edit_image" class="btn btn-primary">Alterar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modalAddDocument -->
<div class="modal fade" id="modal_add_document" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>protocols/send_files" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Enviar Arquivo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="type_arquivo">Tipo do Arquivo: </label>
                <select name="type_arquivo" class="form-control" id="type_arquivo">
                  <option value=""></option>
                  <?php foreach ($documents_checklist_protocol as $row) : ?>
                  <option value="<?php echo $row->id; ?>"><?php echo $row->description; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="arquivo">Arquivo: </label>
              </div>
              <input type="file" name="arquivo" value="" class="" id="arquivo">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
          <button type="submit" name="send_files" class="btn btn-primary">Enviar</button>
          <input type="hidden" name="id_protocol" value="<?php echo $id_protocol; ?>">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal_embargar -->
<div class="modal fade" id="modal_embargar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>protocols/embarkation_protocol" method="post"
        enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 text-center">
              <h5 class="modal-title" id="exampleModalLabel">Embargar</h5>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="responsible">Responsável</label>
                <input type="text" name="responsible" value="" class="form-control cpfCnpj" id="responsible">
              </div>
            </div>
          </div>
          <div class="row" id="responsible_data" style="display: none;">
            <div class="col-md-12 ">
              <p id="responsible_name"><span class="font-weight-bold">Nome: </span></p>
              <p id="responsible_email"><span class="font-weight-bold">Email: </span></p>
              <p id="responsible_phone"><span class="font-weight-bold">Telefone: </span></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="reason">Motivo</label>
                <textarea name="reason" rows="8" cols="80" class="form-control" id="reason"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="arquivo">Arquivo do motivo - PDF: </label>
              </div>
              <input type="file" name="arquivo" value="" class="" id="arquivo">
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-danger col-md-6" data-dismiss="modal">Cancelar</button>
          <button type="submit" name="embarkation_protocol" class="btn btn-primary col-md-6">Embargar</button>
          <!-- <button type="submit" name="id_requester_embarkation" class="btn btn-primary col-md-6" >Embargar</button> -->
          <input type="hidden" name="embarkation" value="<?php echo ($requirement->embarkation == '1') ? '0' : '1' ?>">
          <input type="hidden" name="id_protocol" value="<?php echo $id_protocol; ?>">
          <input type="hidden" name="id_requester_embarkation" value="" id="id_requester_embarkation">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- atualizar embargado -->
<div class="modal fade" id="modal_update_embargo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>protocols/update_embarkation" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 text-center">
              <h5 class="modal-title" id="exampleModalLabel">Atualizar embargo</h5>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="status_embarkation">Status</label>
                <select class="form-control" name="status_embarkation" id="status_embarkation">
                  <?php foreach ($status_embargo as $row) : ?>
                  <option value="<?php echo $row->id; ?>"><?php echo $row->description; ?></option>
                  <?php endforeach; ?>
                  <!-- <option value="1">Em análise </option>
                <option value="2">Embargo Procedente</option>
                <option value="3">Embargo Improcedente</option>
                <option value="4">Arquivado</option> -->
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="legal_decision_analysis">Análise / Decisão jurídica</label>
                <textarea name="legal_decision_analysis" rows="8" cols="80" class="form-control"
                  id="legal_decision_analysis"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="file_analysis">Arquivo da Análise / Decisão jurídica - PDF: </label>
              </div>
              <input type="file" name="file_analysis" value="" class="" id="file_analysis">
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-danger col-md-6" data-dismiss="modal">Cancelar</button>
          <button type="submit" name="update_embarkation" class="btn btn-primary col-md-6">Atualizar</button>
          <input type="hidden" name="id_embarkation_history" value="" id="id_embarkation_history">
          <!-- <input type="hidden" name="embarkation" value="<?php //echo ($requirement->embarkation == '1')? '0' : '1'
                                                              ?>"> -->
          <input type="hidden" name="id_protocol" value="<?php echo $id_protocol; ?>">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal_edit_document -->
<div class="modal fade" id="modal_edit_document" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>protocols/update_files" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Alterar Arquivo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="arquivo">Arquivo: </label>
              </div>
              <input type="file" name="edit_arquivo" value="" class="" id="edit_arquivo">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
          <button type="submit" name="update_files" class="btn btn-primary">Enviar</button>
          <input type="hidden" name="id_arquivo" value="" id="id_arquivo">
          <input type="hidden" name="id_protocol" value="<?php echo $id_protocol; ?>">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal_edit_file_embarkation -->
<div class="modal fade" id="modal_edit_file_embarkation" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>protocols/update_file_embarkation" method="post"
        enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Alterar Arquivo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="arquivo">Arquivo: </label>
              </div>
              <input type="file" name="edit_file" value="" class="" id="edit_file">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
          <button type="submit" name="update_file_embarkation" class="btn btn-primary">Enviar</button>
          <input type="hidden" name="id_embarkation" value="" id="id_embarkation">
          <input type="hidden" name="id_protocol" value="<?php echo $id_protocol; ?>">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal_files_analysis -->
<div class="modal fade" id="modal_files_analysis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>protocols/update_files_analysis" method="post"
        enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Alterar Arquivo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="arquivo">Arquivo: </label>
              </div>
              <input type="file" name="edit_files_analysis" value="" class="" id="edit_files_analysis">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
          <button type="submit" name="update_files_analysis" class="btn btn-primary">Enviar</button>
          <input type="hidden" name="id_embarkation_protocol" value="" id="id_embarkation_protocol">
          <input type="hidden" name="id_protocol" value="<?php echo $id_protocol; ?>">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal_files_analysis -->
<div class="modal fade" id="modal_conclusion_confirm" tabindex="-1" aria-labelledby="label_modal_confirmation"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>protocols/protocol_history" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="label_modal_confirmation">Tem certeza de que deseja concluir o cadastro?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row" id="modal_conclusion_confirm_body">

          </div>
          <!-- <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="responsible_completion">Responsável</label>
                <input type="text" name="responsible_completion" value="" class="form-control" id="responsible_completion">
              </div>
            </div>
          </div> -->
          <div class="row">
            <div class="col-md-6">
              <button type="button" class="btn btn-secondary col-md-12" data-dismiss="modal">Fechar</button>
            </div>
            <div class="col-md-6">
              <button type="submit" id="finish_register_protocols" name="protocol_history"
                class="btn btn-primary col-md-12">Concluir</button>
            </div>
            <input type="hidden" name="id_protocol" value="<?php echo $id_protocol; ?>">
          </div>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <input type="hidden" name="id_protocol" value="<?php //echo $id_protocol;
                                                          ?>">
          <button type="submit" name="protocol_history" class="btn btn-primary">Concluir</button>
        </div> -->
      </form>
    </div>
  </div>
</div>

<!-- modal_conclusion_cancel -->
<div class="modal fade" id="modal_conclusion_cancel" tabindex="-1" aria-labelledby="label_modal_confirmation"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>protocols/protocol_history_cancel" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="label_modal_confirmation">Tem certeza de que deseja cancelar?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="responsible_completion">Responsável</label>
                <input type="text" name="responsible_cancel" value="" class="form-control" id="responsible_completion">
              </div>
            </div>
          </div> -->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="reason_cancel">Motivo</label>
                <textarea name="reason_cancel" rows="8" cols="80" id="reason_cancel" class="form-control"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <input type="hidden" name="id_protocol" value="<?php echo $id_protocol; ?>">
          <button type="submit" name="protocol_history_cancel" class="btn btn-primary">Concluir</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal_edit_protocol_conpletion -->
<div class="modal fade" id="modal_edit_protocol_conpletion" tabindex="-1" aria-labelledby="label_modal_confirmation"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>protocols/update_protocol_history" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="label_modal_confirmation">Detalhes</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="responsible_completion">Responsável</label>
                <input type="text" name="edit_responsible" value="" class="form-control" id="edit_responsible" readonly>
              </div>
            </div>
          </div> -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Data</label>
                <input type="text" name="" value="" class="form-control" id="date_protocol_history" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Responsável</label>
                <input type="text" name="" value="" class="form-control" id="edit_responsible" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Status</label>
                <input type="text" name="" value="" class="form-control" id="edit_status_protocol_history" readonly>
              </div>
            </div>
          </div>

          <div class="row" id="div_cancel_motivo">
            <div class="col-md-12">
              <div class="form-group">
                <label for="reason_cancel">Motivo</label>
                <textarea name="edit_reason" rows="8" cols="80" id="edit_reason" class="form-control"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <input type="hidden" name="id_protocol" value="<?php echo $id_protocol; ?>">
          <input type="hidden" name="id_protocol_history" value="" id="id_protocol_history">
          <input type="hidden" name="status_protocol_history" value="" id="status_protocol_history">
          <button type="submit" name="update_protocol_history" class="btn btn-primary"
            id="update_protocol_history">Atualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php $this->load->view('elements/footer'); ?>