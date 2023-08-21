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
          <?php unset($_SESSION['error']); ?>
        <?php } ?>
        <!-- INI: AVISOS -->
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card card-user">
          <form class="" action="<?php echo base_url(); ?>procedure_reurb/update_procedure/<?php echo $process_number->id; ?>" method="post">
            <div class="card-header">
              <div class="row">
                <div class="col-md-12">
                  <h5 class="card-title d-inline">Detalhe de Gestão de procedimentos de REURB</h5>
                  <div class="d-flex justify-content-end float-right">
                    <a href="<?php echo base_url() ?>procedure_reurb" class="btn btn-secundary mr-1 float-md-right float-sm-right float-xs-right">Voltar</a>
                    <button class="btn btn-primary" name="update_procedure">Atualizar</button>
                  </div>
                </div>
              </div>
              <hr>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-4 pr-md-1">
                      <input type="text" class="form-control" value="<?php echo $process_number->process_number . '/' . $process_number->core_name; ?>" readonly>
                    </div>
                    <div class="col-md pr-md-1">
                      <button type="button" name="button" class="btn btn-sm <?php echo ($process_number->status == '0') ? 'btn-primary' : 'btn-secondary'; ?> float-right mr-3" data-toggle="modal" data-target="#modalQuestion">
                        <i class="fa fa-power-off"></i>
                        <?php echo ($process_number->status == '0') ? 'Ativar' : 'Desativar'; ?>
                      </button>
                    </div>
                  </div>

                  <ul class="nav nav-tabs">
                    <!-- <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#dados">Dados</a>
                    </li> -->
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#home">Requerentes</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#menu1">Matrículas e notificações</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#menu2">Listagem dos ocupantes e títulos de legitimação</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#menu3">Indicação numerica das unidades regularizadas</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <!-- <div id="dados" class="tab-pane active py-2">
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="process_number">Número do processo</label>
                            <input type="text" class="form-control processo" name="process_number" placeholder="Número do processo" value="<?php echo $process_number->process_number; ?>" id="process_number">
                          </div>
                        </div>
                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="stage">Etapa</label>
                            <select class="form-control" name="stage" id="stage">
                              <option value=""></option>
                              <option value="01" <?= ($process_number->stage == '01') ? 'selected' : ''; ?>>I</option>
                              <option value="02" <?= ($process_number->stage == '02') ? 'selected' : ''; ?>>II</option>
                              <option value="03" <?= ($process_number->stage == '03') ? 'selected' : ''; ?>>III</option>
                              <option value="04" <?= ($process_number->stage == '04') ? 'selected' : ''; ?>>IV</option>
                              <option value="05" <?= ($process_number->stage == '05') ? 'selected' : ''; ?>>V</option>
                              <option value="06" <?= ($process_number->stage == '06') ? 'selected' : ''; ?>>VI</option>
                              <option value="07" <?= ($process_number->stage == '07') ? 'selected' : ''; ?>>VII</option>
                              <option value="08" <?= ($process_number->stage == '08') ? 'selected' : ''; ?>>VIII</option>
                              <option value="09" <?= ($process_number->stage == '09') ? 'selected' : ''; ?>>IX</option>
                              <option value="10" <?= ($process_number->stage == '10') ? 'selected' : ''; ?>>X</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="total_regularized_area">Área total regularizada m²</label>
                            <input type="text" name="total_regularized_area" id="total_regularized_area" class="form-control venal" value="<?php echo $process_number->total_regularized_area; ?>">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="profession_personal">Requerente</label>
                            <input type="text" name="requester" id="profession_personal" class="form-control" value="<?php echo $process_number->requester; ?>">
                          </div>
                        </div>
                        <div class="col-md-2 pr-md-1 pl-md-1">
                          <div class="form-group">
                            <label for="profession_personal">Data requerimento</label>
                            <input type="date" name="date_requester" id="profession_personal" class="form-control" value="<?php echo $process_number->date_requester ?>">
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="profession_personal">Nome do Núcleo</label>
                            <input type="text" name="core_name" id="profession_personal" class="form-control" value="<?php echo $process_number->core_name ?>">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1 ">
                          <div class="form-group">
                            <label for="profession_personal">Parcelador/Empreendedor irregular</label>
                            <input type="text" name="irregular_parceler" id="profession_personal" class="form-control" value="<?php echo $process_number->irregular_parceler ?>">
                          </div>
                        </div>
                        <div class="col-md pr-md-1 pl-md-1">
                          <div class="form-group">
                            <label for="modalidade">Modalidade</label>
                            <select name="modality" class="form-control" id="modalidade">
                              <option value="REURB-S" <?= ($process_number->modality == 'REURB-S') ? 'selected' : ''; ?>>REURB-S</option>
                              <option value="REURB-E" <?= ($process_number->modality == 'REURB-E') ? 'selected' : ''; ?>>REURB-E</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="modalidade">Rito</label>
                            <select name="rito" class="form-control" id="modalidade">
                              <option value="<?php echo $process_number->rito ?>"><?php echo $process_number->rito; ?></option>
                              <option value="Demarcação Urbanística Prévia">Demarcação Urbanística Prévia</option>
                              <option value="Sem Demarcação Urbanística Prévia">Sem Demarcação Urbanística Prévia</option>
                              <option value="Inominada">Inominada</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="modalidade">Decisão</label>
                            <select name="decision" class="form-control" id="modalidade">
                              <?php if ($process_number->decision == 'Instauradora') : ?>
                                <option value="Instauradora" selected>Instauradora</option>
                                <option value="Denegátoria">Denegátoria</option>
                              <?php else : ?>
                                <option value="Instauradora">Instauradora</option>
                                <option value="Denegátoria" selected>Denegátoria</option>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-3 pl-md-1">
                          <div class="form-group">
                            <label for="profession_personal">Data de decisão</label>
                            <input type="date" name="decision_date" id="profession_personal" class="form-control" value="<?php echo $process_number->decision_date; ?>">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="end_date">Data de Finalização</label>
                            <input type="date" name="end_date" value="<?php echo $process_number->end_date; ?>" class="form-control" id="end_date">
                          </div>
                        </div>
                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="publication_procedure">Publicação do procedimento</label>
                            <input type="date" name="publication_procedure" value="<?php echo $process_number->publication_procedure; ?>" class="form-control" id="publication_procedure">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3 pr-md-1">
                          <div class="form-group">
                            <label for="original_registration">Matrícula originária da REURB</label>
                            <input type="text" name="original_registration" value="<?php echo $process_number->original_registration; ?>" class="form-control" id="original_registration">
                          </div>
                        </div>
                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="issue_date">Data de abertura da matrícula</label>
                            <input type="date" name="issue_date" value="<?php echo $process_number->issue_date; ?>" class="form-control" id="issue_date">
                          </div>
                        </div>
                        <div class="col-md-3 pl-md-1">
                          <div class="form-group">
                            <label for="type_property">Tipo imóvel</label>
                            <select class="form-control" name="type_property" id="type_property">
                              <option value=""></option>
                              <option value="público" <?php echo ($process_number->type_property == 'público') ? 'selected' : ''; ?>>público</option>
                              <option value="privado" <?php echo ($process_number->type_property == 'privado') ? 'selected' : ''; ?>>privado</option>
                              <option value="misto" <?php echo ($process_number->type_property == 'misto') ? 'selected' : ''; ?>>misto</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-3 pl-md-1">
                          <div class="form-group">
                            <label for="cartorio">Cartório</label>
                            <select class="form-control" name="cartorio">
                              <option value=""></option>
                              <?php foreach ($notarys_office as $row) : ?>
                                <option value="<?php echo $row->id; ?>" <?php echo ($process_number->id_notarys_office == $row->id) ? 'selected' : ''; ?>><?php echo $row->name_registry; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                          <div class="dropdown d-inline-block">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="decision_instituted" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Decisão Instauradora</button>
                            <div class="dropdown-menu" aria-labelledby="decision_instituted">
                              <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal_initiating_decision">
                                Gerar peça
                                </button>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalUploadInitiatingDecision">
                                  Upload da peça
                                </a>
                                <?php if (!empty($upload_initiating_decision->file)) : ?>
                                  <a class="dropdown-item" href="<?php echo base_url(); ?>assets/build/img/initiating_decision/<?php echo $upload_initiating_decision->file; ?>" target="_blank" rel="noopener norer">
                                    Visualizar upload
                                  </a>
                                <?php endif; ?>
                            </div>
                          </div>
                          <div class="dropdown d-inline-block">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="decision_conclusion" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Decisão de conclusão</button>
                            <div class="dropdown-menu" aria-labelledby="decision_conclusion">
                              <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal_generate_dcrf">
                                Gerar peça
                              </a>
                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalUploadCompletionDecision">
                                Upload da peça
                              </a>
                              <?php if (!empty($upload_completion_decision->file)) : ?>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>assets/build/img/completion_decision/<?php echo $upload_completion_decision->file; ?>" target="_blank" rel="noopener norer">
                                  Visualizar upload
                                </a>
                              <?php endif; ?>
                            </div>
                          </div>
                          <div class="dropdown d-inline-block">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="crf" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CRF</button>
                            <div class="dropdown-menu" aria-labelledby="crf">
                              <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal_generate_crf">
                                Gerar peça
                              </a>
                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalUploadCrf">
                                Upload da peça
                              </a>

                              <?php if (!empty($upload_completion_decision->file)) : ?>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>assets/build/img/crf/<?php echo $upload_crf->file; ?>" target="_blank" rel="noopener norer">
                                  Visualizar upload
                                </a>
                              <?php endif; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 d-flex justify-content-end">
                          <a href="<?php echo base_url() ?>procedure_reurb" class="btn btn-secundary mr-1">Voltar</a>
                          <button class="btn btn-primary" name="update_procedure">Atualizar</button>
                        </div>
                      </div>

                    </div> -->

                    <div id="home" class="tab-pane active py-2">
                      <div class="row mb-2">
                        <div class="col-md-2 ">
                          <label for="">Totalização:</label>
                          <input type="text" name="" value="<?php echo count($requirements) ?>" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <table id="tabelaUm" class="table table-striped table-bordered text-dark w-100">
                            <thead class="text-primary">
                              <tr>
                                <th scope="col">Protocolo</th>
                                <th scope="col">Cpf / Cnpj</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Perfil</th>
                                <th scope="col">E-mail</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($requirements as $row) : ?>
                                <?php $date = date_create($row->date_requester); ?>
                                <tr>
                                  <td>
                                    <a href="<?php echo base_url(); ?>protocols/detail/<?php echo $row->id; ?>">
                                      <i class="fa fa-search"></i>
                                      <?php echo $row->process_number; ?>.<?php echo $row->stage; ?>.<?php echo  str_pad($row->id, 3, '0', STR_PAD_LEFT); ?>
                                    </a>
                                  </td>
                                  <td>
                                    <a href="<?php echo base_url(); ?>requesters/detail/<?php echo $row->id_requester ?>" target="_blank">
                                      <i class="fa fa-search"></i>
                                      <?php echo (isset($row->cpf)) ? $row->cpf : $row->cnpj; ?>
                                    </a>
                                  </td>
                                  <td><?php echo (isset($row->legal_name)) ? $row->legal_name : $row->company_name; ?></td>
                                  <td><?php echo ($row->type_requester == 1) ? 'Físico' : 'Jurídico'; ?></td>
                                  <td><?php echo (isset($row->legal_email)) ? $row->legal_email : $row->procurator_email; ?></td>
                                </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
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
                                <th scope="col">Data de Recebimento</th>
                                <th scope="col">Prazo Final Manifestação</th>
                                <th scope="col">Tipo de Manifestação</th>
                                <th scope="col">Ações</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($registration as $row) : ?>
                                <?php
                                if ($row->type_manifestation == 1) {
                                  $type_manifestation = "Não Manifestou";
                                } else if ($row->type_manifestation == 2) {
                                  $type_manifestation = "Impugnou";
                                } else if ($row->type_manifestation == 3) {
                                  $type_manifestation = "Recusou o recebimento";
                                }
                                $receiving_date = date_create($row->receiving_date);
                                $deadline_manifestation = date_create($row->deadline_manifestation);
                                ?>
                                <tr>
                                  <td><?php echo $row->number_registration; ?></td>
                                  <td><?php echo $row->owner; ?></td>
                                  <td><?php echo $row->document; ?></td>
                                  <td><?php echo (empty($row->receiving_date)) ? '' : date_format($receiving_date, 'd/m/Y'); ?></td>
                                  <td><?php echo (empty($row->deadline_manifestation)) ? '' : date_format($deadline_manifestation, 'd/m/Y'); ?></td>
                                  <td>
                                    <span title="<?php echo (empty($row->type_manifestation)) ? '' : $type_manifestation; ?>">
                                      <?php echo (empty($row->type_manifestation)) ? '' : $type_manifestation; ?>
                                    </span>
                                  </td>
                                  <td class="d-flex border-bottom-0">
                                    <a class="mr-2" href="#" id="detailNotificaded" data-toggle="modal" data-target="#modalDetailNotificaded" data-id="<?php echo $row->id; ?>" title="Detalhes">
                                      <i class="fa fa-search"></i>
                                    </a>
                                    <?php
                                    // Privado mostra o de proprietario, publico mostra o de uniao
                                    if ($row->property_type == '0') {
                                      $typeNotification = 'União';
                                    } else if ($row->property_type == '1') {
                                      $typeNotification = 'Confrontantes';
                                    }
                                    ?>
                                    <!-- <a class="mr-2 btn btn-sm modalGerarNotificacao" href="#" title="Gerar" id="gerar_notification"
                                      data-toggle="modal" data-target="#modal_notifications"
                                      data-notificacao="<?php //echo $typeNotification; 
                                                        ?>"
                                      >
                                      <i class="fas fa-plus"></i>
                                    </a> -->
                                    <div class="dropdown">
                                      <a class="mr-2 btn btn-sm dropdown-toggle" href="#" title="Upload/Visualização" id="upload_visualização" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-upload"></i>
                                      </a>
                                      <div class="dropdown-menu dropdown-upload" aria-labelledby="upload_visualização">
                                        <a class="dropdown-item modalGerarNotificacao" href="#" title="Gerar" id="gerar_notification" data-toggle="modal" data-target="#modal_notifications" data-id="<?php echo $row->id; ?>" data-notificacao="<?php echo $typeNotification; ?>">
                                          Gerar peça
                                        </a>

                                        <a href="#" class="dropdown-item modalUploadNotificacao" data-toggle="modal" data-target="#modal_upload_notifications" data-notificacao="<?php echo $typeNotification; ?>" data-id_registration="<?php echo $row->id; ?>">
                                          Upload
                                        </a>
                                        <?php if (isset($row->file)) : ?>
                                          <a href="<?php echo base_url(); ?>assets/build/img/notifications/<?php echo $row->file; ?>" class="dropdown-item modalUploadNotificacao" target="_blank" rel="noopener norer"="<?php echo $row->type; ?>">
                                            Visualizar
                                          </a>
                                        <?php endif; ?>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <!-- <div class="row mt-2">
                        <div class="col-md-12">
                          <h5 class="d-inline text-dark">Matrículas de imóveis atingidos (afetados)</h5>
                        </div>
                      </div>
                      <?php //foreach ($enrollments_reached as $row) : 
                      ?>
                        <div class="row">
                          <div class="col-md-2 pr-md-1">
                            <div class="form-group">
                              <label for="number_hit">Número</label>
                              <input type="text" name="number_hit[]" id="number_hit" class="form-control" value="<?php echo $row->number; ?>">
                            </div>
                          </div>
                          <div class="col-md-2 px-md-1">
                            <div class="form-group">
                              <label for="area_hit">Área m<sup>2</sup>/ha</label>
                              <input type="text" name="area_hit[]" id="area_hit" class="form-control" value="<?php echo $row->area; ?>">
                            </div>
                          </div>
                          <div class="col-md-3 px-md-1">
                            <div class="form-group">
                              <label for="property_registration_hit">Cartório Registro de Imóveis</label>
                              <input type="text" name="property_registration_hit[]" id="property_registration_hit" class="form-control" value="<?php echo $row->property_registration; ?>">
                            </div>
                          </div>
                          <div class="col-md-3 px-md-1">
                            <div class="form-group">
                              <label for="owner_hit">Proprietário(s)</label>
                              <input type="text" name="owner_hit[]" id="owner_hit" class="form-control" value="<?php echo $row->owner; ?>">
                            </div>
                          </div>
                          <div class="col-md-2 pl-md-1">
                            <div class="form-group">
                              <label for="address_hit">Endereço</label>
                              <input type="text" name="address_hit[]" id="address_hit" class="form-control" value="<?php echo $row->address; ?>">
                            </div>
                          </div>
                        </div>
                        <input type="hidden" name="id_enrollments_reached[]" value="<?php echo $row->id; ?>">
                      <?php //endforeach; 
                      ?>
                      <div class="row mt-2">
                        <div class="col-md-12">
                          <h5 class="d-inline text-dark">Matrículas de imóveis confrontantes</h5>
                        </div>
                      </div>
                      <?php //foreach ($confrontant_enrollments as $row) : 
                      ?>
                        <div class="row">
                          <div class="col-md-2 pr-md-1">
                            <div class="form-group">
                              <label for="number_confrontant">Número</label>
                              <input type="text" name="number_confrontant[]" id="number_confrontant" class="form-control" value="<?php echo $row->number; ?>">
                            </div>
                          </div>
                          <div class="col-md-2 px-md-1">
                            <div class="form-group">
                              <label for="area_confrontant">Área m<sup>2</sup>/ha</label>
                              <input type="text" name="area_confrontant[]" id="area_confrontant" class="form-control" value="<?php echo $row->area; ?>">
                            </div>
                          </div>
                          <div class="col-md-3 px-md-1">
                            <div class="form-group">
                              <label for="property_registration_confrontant">Cartório Registro de Imóveis</label>
                              <input type="text" name="property_registration_confrontant[]" id="property_registration_confrontant" class="form-control" value="<?php echo $row->property_registration; ?>">
                            </div>
                          </div>
                          <div class="col-md-3 px-md-1">
                            <div class="form-group">
                              <label for="owner_confrontant">Proprietário(s)</label>
                              <input type="text" name="owner_confrontant[]" id="owner_confrontant" class="form-control" value="<?php echo $row->owner; ?>">
                            </div>
                          </div>
                          <div class="col-md-2 pl-md-1">
                            <div class="form-group">
                              <label for="address_confrontant">Endereço</label>
                              <input type="text" name="address_confrontant[]" id="address_confrontant" class="form-control" value="<?php echo $row->address; ?>">
                            </div>
                          </div>
                        </div>
                        <input type="hidden" name="id_confrontant_enrollments[]" value="<?php echo $row->id; ?>">
                      <?php //endforeach; 
                      ?>
                      <div class="row mt-2">
                        <div class="col-md-12">
                          <h5 class="d-inline text-dark">Posseiros confrontantes - Imóvel objeto da REURB/Auto de Demarcação Urbanística</h5>
                        </div>
                      </div>
                      <?php //foreach ($squatters as $row) : 
                      ?>
                        <div class="row">
                          <div class="col-md-6 pr-md-1">
                            <div class="form-group">
                              <label for="name_squatters">Nome</label>
                              <input type="text" name="name_squatters[]" id="name_squatters" class="form-control" value="<?php echo $row->name; ?>">
                            </div>
                          </div>
                          <div class="col-md-6 pl-md-1">
                            <div class="form-group">
                              <label for="address_squatters">Endereço</label>
                              <input type="text" name="address_squatters[]" id="address_squatters" class="form-control" value="<?php echo $row->address; ?>">
                            </div>
                          </div>
                        </div>
                        <input type="hidden" name="id_squatters[]" value="<?php echo $row->id; ?>">
                      <?php //endforeach; 
                      ?> -->
                    </div>
                    <div id="menu2" class="tab-pane py-2">
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="">Impressão da Listagem</label>
                            <select class="form-control" name="impressao_listagem" id="impressao_listagem">
                              <option value=""></option>
                              <option value="Geral">Geral</option>
                              <option value="REURB-S">REURB-S</option>
                              <option value="REURB-E">REURB-E</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4 mt-3">
                          <button type="button" name="word_listagem_ocupantes" class="btn btn-primary imprimir_word_listagem" data-toggle="modal" data-target="#modalImprimirWord">
                            Imprimir
                          </button>
                        </div>

                        <div class="col-md-3 float-right">
                          <div class="form-group">
                            <label for="">Titulo de Legitimação</label>
                            <select class="form-control" name="modality_legitimation_title" id="modality_legitimation_title">
                              <option value=""></option>
                              <option value="Geral">Geral</option>
                              <option value="REURB-S">REURB-S</option>
                              <option value="REURB-E">REURB-E</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-2 mt-3">
                          <button type="button" name="word_listagem_ocupantes" class="btn btn-primary buttonGenerateLegitimationTitle" data-toggle="modal" data-target="#modalGenerateLegitimationTitle">
                            Gerar
                          </button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="">Totalização:</label>
                            <input type="text" name="" value="<?php echo count($requirements) ?>" class="form-control" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <table id="tabelaQuatro" class="table table-striped table-bordered w-100">
                            <thead class="text-primary">
                              <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">CPF</th>
                                <th scope="col">Unidade Atribuída</th>
                                <th scope="col">Classificação na REURB</th>
                                <th scope="col">Impressão de Título de legitimação</th>
                              </tr>
                            </thead>
                            <tbody class="text-dark">
                              <?php foreach ($requirements as $row) : ?>
                                <?php $date = date_create($row->date_requester); ?>
                                <tr>
                                  <td><?php echo (isset($row->legal_name)) ? $row->legal_name : $row->company_name; ?></td>
                                  <td>
                                    <a href="<?php echo base_url(); ?>requesters/detail/<?php echo $row->id_requester; ?>">
                                      <?php echo (isset($row->cpf)) ? $row->cpf : $row->cnpj; ?>
                                    </a>
                                  </td>
                                  <td>
                                    <table class="table table-striped w-100 text-dark bg-white">
                                      <thead>
                                        <tr>
                                          <th scope="col">Setor</th>
                                          <th scope="col">Quadra</th>
                                          <th scope="col">Lote</th>
                                          <th scope="col">Endereço</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td><?php echo $row->sector; ?></td>
                                          <td><?php echo $row->city_block; ?></td>
                                          <td><?php echo $row->allotment; ?></td>
                                          <td>
                                            <?php echo $row->street_property; ?> <?php echo $row->place_property; ?>, n° <?php echo $row->number_property; ?>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                  <td><?php echo $row->classification_reurb; ?></td>
                                  <td>
                                    <!-- <form action="<?php //echo base_url(); 
                                                        ?>forms/legitimation_title" method="post"> -->
                                    <button type="button" name="legitimation_title" class="btn btn-primary modal_title_individual" data-toggle="modal" data-target="#modal_generate_individual" data-id="<?php echo $row->id; ?>" data-classification_reurb="<?php echo $row->classification_reurb; ?>" data-embarkation="<?php echo $row->embarkation; ?>">
                                      Gerar <i class="fas fa-file-alt"></i>
                                    </button>
                                    <!-- </form> -->
                                  </td>
                                  <!-- <td>
                                  <a href="<?php //echo base_url(); 
                                            ?>protocols/detail/<?php //echo $row->id; 
                                                                ?>">
                                    <i class="fa fa-search"></i>
                                  </a>
                                </td> -->
                                </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div id="menu3" class="tab-pane py-2">
                      <div class="row">
                        <div class="col-md-4 mt-3">
                          <button type="button" name="word_listagem_ocupantes" class="btn btn-primary imprimir_word_indicacao_numerica" data-toggle="modal" data-target="#modalImprimirIndicacaoNumerica">
                            Imprimir
                          </button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <table id="tabelaQuatro" class="table table-striped table-bordered w-100 text-primary">
                            <thead>
                              <tr>
                                <th scope="col">Setor</th>
                                <th scope="col">Quadra</th>
                                <th scope="col">Lote</th>
                                <th scope="col">Área m²</th>
                              </tr>
                            </thead>
                            <tbody class="text-dark">
                              <?php foreach ($requirements as $row) : ?>
                                <?php $date = date_create($row->date_requester); ?>
                                <tr>
                                  <td><?php echo $row->sector; ?></td>
                                  <td><?php echo $row->city_block; ?></td>
                                  <td><?php echo $row->allotment; ?></td>
                                  <td>
                                    <?php echo $row->georeferenced_property_area; ?>
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
                <!-- <div class="card-footer">
              <div class="row d-none">
                <div class="col-md-12 d-flex justify-content-end">
                  <a href="<?php echo base_url() ?>procedure_reurb" class="btn btn-secundary mr-1">Voltar</a>
                  <button class="btn btn-primary" name="update_procedure">Atualizar</button>
                </div>
              </div>
            </div> -->
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal_add_hit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Matrículas de imóveis atingidos (afetados)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>procedure_reurb/register_hit" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="modal_number_hit">Número:</label>
                <input type="text" name="modal_number_hit" class="form-control" id="modal_number_hit">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="modal_field_hit">Área m<sup>2</sup>/ha</label>
                <input type="text" name="modal_field_hit" class="form-control" id="modal_field_hit">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="modal_property_registration_hit">Cartório Registro de imóveis:</label>
                <input type="text" name="modal_property_registration_hit" class="form-control" id="modal_property_registration_hit">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="modal_propertys_hit">Proprietário(s):</label>
                <input type="text" name="modal_propertys_hit" class="form-control" id="modal_propertys_hit">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="modal_address_hit">Endereço:</label>
                <input type="text" name="modal_address_hit" class="form-control" id="modal_address_hit">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <input type="hidden" name="id_procedure" value="<?php echo $process_number->id; ?>">
          <button type="submit" name="register_hit" class="btn btn-primary">Cadastrar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_add_confrontant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Matrículas de imóveis confrontantes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>procedure_reurb/register_confrontant_enrollments" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="modal_number_confrontant">Número:</label>
                <input type="text" name="modal_number_confrontant" class="form-control" id="modal_number_confrontant">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="modal_field_confrontant">Área m<sup>2</sup>/ha</label>
                <input type="text" name="modal_field_confrontant" class="form-control" id="modal_field_confrontant">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="modal_property_registration_confrontant">Cartório Registro de imóveis:</label>
                <input type="text" name="modal_property_registration_confrontant" class="form-control" id="modal_property_registration_confrontant">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="modal_propertys_confrontant">Proprietário(s):</label>
                <input type="text" name="modal_propertys_confrontant" class="form-control" id="modal_propertys_confrontant">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="modal_address_confrontant">Endereço:</label>
                <input type="text" name="modal_address_confrontant" class="form-control" id="modal_address_confrontant">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <input type="hidden" name="id_procedure" value="<?php echo $process_number->id; ?>">
          <button type="submit" name="register_confrontant_enrollments" class="btn btn-primary">Cadastrar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_add_squatters" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Posseiros confrontantes - Imóvel objeto da REURB/Auto de Demarcação Urbanística</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>procedure_reurb/register_squatters" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="modal_name_squatters">Nome:</label>
                <input type="text" name="modal_name_squatters" class="form-control" id="modal_name_squatters">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="modal_address_squatters">Endereço:</label>
                <input type="text" name="modal_address_squatters" class="form-control" id="modal_address_squatters">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <input type="hidden" name="id_procedure" value="<?php echo $process_number->id; ?>">
          <button type="submit" name="register_squatters" class="btn btn-primary">Cadastrar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modalQuestion -->
<div class="modal fade" id="modalQuestion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>procedure_reurb/turn_off" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tem certeza?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row d-flex justify-content-center">
            <div class="col-md-12 d-flex justify-content-center">
              <button type="submit" name="turn_off" class="btn btn-primary col-md-6">Sim</button>
              <button type="button" class="btn btn-danger col-md-6" data-dismiss="modal">Nao</button>
              <input type="hidden" name="id" value="<?php echo $process_number->id; ?>">
              <input type="hidden" name="status" value="<?php echo $process_number->status; ?>">
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
        <h6 class="modal-title" id="exampleModalLabel">Cadastrar notificação</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>procedure_reurb/register_procedure_reurb_registration" method="post">
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
                    <input id="public_place" name="public_place" type="text" class="form-control">
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
                    <input id="neigborhood" name="neigborhood" type="text" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="cep">CEP</label>
                    <input id="cep" name="cep" type="text" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="country">Município</label>
                    <input id="country" name="country" type="text" class="form-control">
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
                      <label for="public_place">Logradouro</label>
                      <input id="public_place" name="public_place_notificaded" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="number">Número</label>
                      <input id="number" name="number_notificaded" type="text" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="neigborhood">Bairro</label>
                      <input id="neigborhood" name="neigborhood_notificaded" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="cep">CEP</label>
                      <input id="cep" name="cep_notificaded" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="country">Município</label>
                      <input id="country" name="country_notificaded" type="text" class="form-control">
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
                    <label for="name">Nome</label>
                    <input id="name" name="name_notificaded" type="text" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input id="cpf" name="cpf_notificaded" type="text" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="occupation">Cargo/Função</label>
                    <input id="occupation" name="occupation_notificaded" type="text" class="form-control">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <input type="hidden" name="id_procedure" value="<?php echo $process_number->id; ?>">
          <button type="submit" name="register_procedure_reurb_registration" class="btn btn-primary">Cadastrar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modalDetailNotificaded -->
<div class="modal fade" id="modalDetailNotificaded" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalhe da notificação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>procedure_reurb/update_registration" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="receiving_date">Data recebimento</label>
                <input type="date" name="receiving_date" id="receiving_date" value="" class="form-control">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="deadline_manifestation">Prazo Final Manifestação</label>
                <input type="date" name="deadline_manifestation" id="deadline_manifestation" value="" class="form-control">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="type_manifestation">Tipo de Manifestação</label>
                <select class="form-control" name="type_manifestation" id="type_manifestation">
                  <option value=""></option>
                  <option value="1">Não Manifestou</option>
                  <option value="2">Impugnou</option>
                  <option value="3">Recusou o recebimento</option>
                </select>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="edit_registration_number">Numero da Matrícula</label>
                    <input id="edit_registration_number" name="edit_registration_number" type="text" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="edit_owner_squatter">Proprietário/Posseiro</label>
                    <input id="edit_owner_squatter" name="edit_owner_squatter" type="text" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="edit_cpf_cnpj">CPF/CNPJ</label>
                    <input id="edit_cpf_cnpj" name="edit_cpf_cnpj" type="text" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="edit_registration_area">Área</label>
                    <input id="edit_registration_area" name="edit_registration_area" name="registration_area" type="text" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="edit_real_estate_registry">Cartório de Registro de Imóveis</label>
                    <select class="form-control" name="edit_real_estate_registry" id="edit_real_estate_registry">
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
                    <label for="edit_public_place">Logradouro</label>
                    <input id="edit_public_place" name="edit_public_place" type="text" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="edit_number">Número</label>
                    <input id="edit_number" name="edit_number" type="text" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="edit_neigborhood">Bairro</label>
                    <input id="edit_neigborhood" name="edit_neigborhood" type="text" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="edit_cep">CEP</label>
                    <input id="edit_cep" name="edit_cep" type="text" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="edit_country">Município</label>
                    <input id="edit_country" name="edit_country" type="text" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-check d-flex align-items-center mx-4 mb-0">
                    <input class="form-check-input visible opacity-1 mb-1" name="edit_notificaded_checking" type="checkbox" id="edit_notificaded_checking">
                    <label class="form-check-label m-0" for="edit_notificaded_checking">Notificado não reside no imóvel?</label>
                  </div>
                </div>
              </div>
              <!-- <div class="row">
                <div class="col-md-12">
                  <div class="form-check d-flex align-items-center mx-4 mb-0">
                    <input class="form-check-input visible opacity-1 mb-1" name="notificaded_checking" type="checkbox" id="notificaded_checking">
                    <label class="form-check-label m-0" for="notificaded_checking">Notificado não reside no imóvel?</label>
                  </div>
                </div>
              </div>
              <div class="mb-4 d-none" id="does_not_reside_in_the_property"> -->

              <div class="mb-4 d-none" id="does_not_reside_in_the_property_detail">
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="border-bottom border-dark m-0 my-2">Endereço para notificação</h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="edit_public_place_notificaded">Logradouro</label>
                      <input id="edit_public_place_notificaded" name="edit_public_place_notificaded" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="edit_number_notificaded">Número</label>
                      <input id="edit_number_notificaded" name="edit_number_notificaded" type="text" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="edit_neigborhood_notificaded">Bairro</label>
                      <input id="edit_neigborhood_notificaded" name="edit_neigborhood_notificaded" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="edit_cep_notificaded">CEP</label>
                      <input id="edit_cep_notificaded" name="edit_cep_notificaded" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="edit_country_notificaded">Município</label>
                      <input id="edit_country_notificaded" name="edit_country_notificaded" type="text" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="edit_property_type">Tipo de imóvel</label>
                    <select class="form-control" name="edit_property_type" id="edit_property_type">
                      <option value=""></option>
                      <option value="0">Privado</option>
                      <option value="1">Público</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="edit_property_situation">Situação do imóvel</label>
                    <select class="form-control" name="edit_property_situation" id="edit_property_situation">
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
                    <label for="edit_notified_type">Tipo de notificado</label>
                    <select class="form-control" name="edit_notified_type" id="edit_notified_type">
                      <option value=""></option>
                      <option value="0">Proprietário</option>
                      <option value="1">Posseiro</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="edit_procedure_type">Tipo de procedimento</label>
                    <select class="form-control" name="edit_procedure_type" id="edit_procedure_type">
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
                    <label for="edit_name_notificaded">Nome</label>
                    <input id="edit_name_notificaded" name="edit_name_notificaded" type="text" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="edit_cpf_notificaded">CPF</label>
                    <input id="edit_cpf_notificaded" name="edit_cpf_notificaded" type="text" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="edit_occupation_notificaded">Cargo/Função</label>
                    <input id="edit_occupation_notificaded" name="edit_occupation_notificaded" type="text" class="form-control">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <!-- <input type="hidden" name="id_registration" id="id_registration" value=""> -->
          <input type="hidden" name="id_registration" id="id_registration" value="">
          <input type="hidden" name="id_procedure" value="<?php echo $process_number->id; ?>">
          <button type="submit" name="update_registration" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalUploadInitiatingDecision" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fazer upload</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>procedure_reurb/upload_initiating_decision" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="initiating_decision">Arquivo</label>
              </div>
              <input type="file" name="initiating_decision" value="" id="initiating_decision">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <input type="hidden" name="id_procedure" value="<?php echo $process_number->id; ?>">
          <button type="submit" name="upload_initiating_decision" class="btn btn-primary">Adicionar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modalUploadCompletionDecision -->
<div class="modal fade" id="modalUploadCompletionDecision" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fazer upload</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>procedure_reurb/upload_completion_decision" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="completion_decision">Arquivo</label>
              </div>
              <input type="file" name="completion_decision" value="" id="completion_decision">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <input type="hidden" name="id_procedure" value="<?php echo $process_number->id; ?>">
          <button type="submit" name="upload_completion_decision" class="btn btn-primary">Adicionar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modalUploadCrf -->
<div class="modal fade" id="modalUploadCrf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fazer upload</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>procedure_reurb/upload_crf" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="file_crf">Arquivo</label>
              </div>
              <input type="file" name="file_crf" value="" id="file_crf">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <input type="hidden" name="id_procedure" value="<?php echo $process_number->id; ?>">
          <button type="submit" name="upload_crf" class="btn btn-primary">Adicionar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_initiating_decision" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gerar Decisão Instauradora</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>forms/initiating_decision" target="_blank" method="post">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary col-md-6" data-dismiss="modal">Fechar</button>
          <button type="submit" name="application_registration_land" class="btn btn-primary col-md-6">Gerar</button>
          <input type="hidden" name="process_number" value="<?php echo $process_number->id; ?>">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Gerar D.C.R.F.U -->
<div class="modal fade" id="modal_generate_dcrf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Decisão de Conclusão da Regularização Fundiária Urbana</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>forms/decision_to_complete_urban_land_regularization" target="_blank" method="post">
        <!-- <div class="modal-body"> -->
        <!-- <div class="row error_process_embarkation" style="display: none;">
            <div class="col-md-12 text-center">
              <p class="alert alert-danger font-weight-bold">Procedimento embargado</p>
            </div>
          </div> -->
        <!-- <div class="row">
            <div class="col-md-12">
              <a href="#" class="btn btn-primary float-right" target="_blank">Listagem dos ocupantes/Indicação Numérica das Unidades</a>
            </div>
          </div> -->
        <!-- <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="process_number">Procedimento</label>
                <select class="form-control process_number" id="process_number_rcrf"
                  data-classe="id_process_decision"
                  name="process_number">
                  <option value=""></option>
                  <?php //foreach ($requirements as $row): 
                  ?>
                    <option value="<?php //echo $row->id; 
                                    ?>">
                      <?php //echo $row->process_number; 
                      ?>.<?php //echo $row->stage; 
                          ?>.<?php //echo  str_pad( $row->id , 3 , '0' , STR_PAD_LEFT); 
                              ?> / <?php //echo $row->core_name; 
                                    ?>
                    </option>
                  <?php //endforeach; 
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 pr-md-1">
              <div class="form-group">
                <label for="modalidade">Modalidade</label>
                <select class="form-control modalidade" name="modalidade">
                  <option value=""></option>
                  <option value="REURB-E">REURB-E</option>
                  <option value="REURB-S">REURB-S</option>
                </select>
              </div>
            </div> -->
        <!-- <div class="col-md-6 pl-md-1">
              <div class="form-group">
                <label for="cartorio">Cartório</label>
                <select class="form-control cartorio" name="cartorio">
                  <option value=""></option>
                  <?php //foreach ($notarys_office as $row): 
                  ?>
                    <option value="<?php //echo $row->id; 
                                    ?>"><?php //echo $row->name_registry; 
                                        ?></option>
                  <?php //endforeach; 
                  ?>
                </select>
              </div>
            </div> -->
        <!-- </div> -->
        <!-- </div> -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary col-md-6" data-dismiss="modal">Fechar</button>
          <button type="submit" name="decision_to_complete_urban_land_regularization" class="btn btn-primary col-md-6">Gerar</button>
          <input type="hidden" name="process_number" value="<?php echo $process_number->id; ?>">
          <input type="hidden" name="cartorio" value="<?php echo $process_number->id_notarys_office; ?>">
          <input type="hidden" name="id_process_decision" class="id_process_decision" value="">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Gerar C.R.F -->
<div class="modal fade" id="modal_generate_crf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Certidão de regularização fundiária – C.R.F</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>forms/land_regularization_certificate" target="_blank" method="post">
        <div class="modal-body">
          <div class="row error_process_embarkation" style="display: none;">
            <div class="col-md-12 text-center">
              <p class="alert alert-danger font-weight-bold">Procedimento embargado</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="process_number">Procedimento</label>
                <select class="form-control process_number" id="process_number" name="process_number" data-classe="id_process">
                  <option value=""></option>
                  <?php foreach ($requirements as $row) : ?>
                    <option value="<?php echo $row->id; ?>">
                      <?php echo $row->process_number; ?>.<?php echo $row->stage; ?>.<?php echo  str_pad($row->id, 3, '0', STR_PAD_LEFT); ?> / <?php echo $row->core_name; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 pr-md-1">
              <div class="form-group">
                <label for="modalidade">Modalidade</label>
                <select class="form-control modalidade" name="modalidade">
                  <option value=""></option>
                  <option value="REURB-E">REURB-E</option>
                  <option value="REURB-S">REURB-S</option>
                </select>
              </div>
            </div>
            <div class="col-md-6 pl-md-1">
              <div class="form-group">
                <label for="cartorio">Cartório</label>
                <select class="form-control cartorio" name="cartorio">
                  <option value=""></option>
                  <?php foreach ($notarys_office as $row) : ?>
                    <option value="<?php echo $row->id; ?>"><?php echo $row->name_registry; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" name="land_regularization_certificate" class="btn btn-primary float-right btn_modal_form land_regularization_certificate">Acessar</button>
          <input type="hidden" name="id_process" class="id_process" value="">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="modal_notifications" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
<!--          <h5 class="modal-title" id="exampleModalLabel">Notificação <span id="text_notification"></span></h5>-->
          <h5 class="modal-title" id="exampleModalLabel">Gerar Notificação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>forms/notification" target="_blank" method="post" id="form_notification_type">
        <div class="modal-body">
          <!-- <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="notification_type">Tipo da notificação</label>
                <select class="form-control " id="notification_type"
                  name="notification_type">
                  <option value=""></option>
                  <option value="União">União</option>
                  <option value="Estado">Estado</option>
                  <option value="Confrontantes do Núcleo(Proprietário de Domínio)">Confrontantes do Núcleo(Proprietário de Domínio)</option>
                </select>
              </div>
            </div>
          </div> -->
          <!--<div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="process_number">Procedimento</label>
                <select class="form-control " id="process_number_rcrf" data-classe="id_process_statement" name="process_number">
                  <option value=""></option>
                  <?php /*foreach ($requirements as $row) : */?>
                    <option value="<?php /*echo $row->id; */?>">
                      <?php /*echo $row->process_number; */?>.<?php /*echo $row->stage; */?>.<?php /*echo  str_pad($row->id, 3, '0', STR_PAD_LEFT); */?> / <?php /*echo $row->core_name; */?>
                    </option>
                  <?php /*endforeach; */?>
                </select>
              </div>
            </div>
          </div>-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" name="notification" class="btn btn-primary  float-right">Acessar</button>
          <input type="hidden" name="notification_type" id="notification_type" value="">
          <input type="hidden" name="id_process_statement" class="id_process_statement" value="">

            <input type="hidden" name="id_notification" id="id_notification" value="">
            <input type="hidden" name="process_number" id="" value="<?php echo $process_number->id; ?>">
<!--            <input type="hidden" name="id_process_individual" class="id_process_individual" value="">-->
<!--            <input type="hidden" name="modalidade" class="form-control modalidade" value="">-->

        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal_upload_notifications -->
<div class="modal fade" id="modal_upload_notifications" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Notificação <span id="text_notification_upload"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>procedure_reurb/notification_upload" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="input-group mb-3">
                <!-- <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon01">Arquivo</span>
                </div> -->
                <div class="custom-file">
                  <input type="file" name="file_notification" value="" class="custom-file-input" id="file_notification" aria-describedby="inputGroupFileAddon01">
                  <label class="custom-file-label" for="inputGroupFile01">Escolher Arquivo</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" name="notification_upload" class="btn btn-primary  float-right">Acessar</button>
          <input type="hidden" name="notification_type_upload" id="notification_type_upload" value="">
          <input type="hidden" name="id_registration_upload" id="id_registration_upload" value="">
          <input type="hidden" name="id_procedure" id="id_procedure" value="<?php echo $process_number->id; ?>">
          <input type="hidden" name="id_process_statement" class="id_process_statement" value="">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Gerar Título de legitimação fundiária urbana individual -->
<div class="modal fade" id="modal_generate_individual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Título de legitimação fundiária urbana individual</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>forms/legitimation_title" target="_blank" method="post">
        <div class="modal-body">
          <div class="row error_process_embarkation" style="display: none;">
            <div class="col-md-12 text-center">
              <p class="alert alert-danger font-weight-bold">Procedimento embargado</p>
            </div>
          </div>
          <!-- <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="process_number">Procedimento</label>
                <select class="form-control process_number" id="process_number" name="process_number"
                  data-classe="id_process_individual">
                  <option value=""></option>
                  <?php //foreach ($requirements as $row): 
                  ?>
                    <option value="<?php //echo $row->id; 
                                    ?>">
                      <?php //echo $row->process_number; 
                      ?>.<?php //echo $row->stage; 
                          ?>.<?php //echo  str_pad( $row->id , 3 , '0' , STR_PAD_LEFT); 
                              ?> / <?php //echo $row->core_name; 
                                    ?>
                    </option>
                  <?php //endforeach; 
                  ?>
                </select>
              </div>
            </div>
          </div> -->
          <div id="errorProcessEmbarkation" style="display: none;">
            <p class="alert alert-danger">Processo embargado.</p>
          </div>
          <div class="row" id="dataFormGenerateIndividual">
            <!-- <div class="col-md-12">
              <div class="form-group">
                <label for="modalidade">Modalidade</label>
                <select class="form-control modalidade" name="modalidade">
                  <option value=""></option>
                  <option value="Geral">Geral</option>
                  <option value="REURB-E">REURB-E</option>
                  <option value="REURB-S">REURB-S</option>
                </select>
              </div>
            </div> -->
            <div class="col-md-12">
              <div class="form-group">
                <label for="cartorio">Cartório</label>
                <select class="form-control cartorio" name="cartorio">
                  <option value=""></option>
                  <?php foreach ($notarys_office as $row) : ?>
                    <option value="<?php echo $row->id; ?>"><?php echo $row->name_registry; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" name="legitimation_title" class="btn btn-primary btn_modal_form float-right land_regularization_certificate">Acessar</button>
          <input type="hidden" name="process_number" id="process_number_title" value="">
          <input type="hidden" name="id_process_individual" class="id_process_individual" value="">
          <input type="hidden" name="modalidade" class="form-control modalidade" value="">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modalImprimirWord -->
<div class="modal fade" id="modalImprimirWord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gerar listagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>forms/word_listagem_ocupantes" target="_blank" method="post">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary col-md-6" data-dismiss="modal">Fechar</button>
          <button type="submit" name="word_listagem_ocupantes" class="btn btn-primary float-right col-md-6">Gerar</button>
          <input type="hidden" name="process_number" id="process_number_title" value="<?php echo $process_number->id; ?>">
          <input type="hidden" name="modalidade" class="form-control " value="" id="modalidade_listagem_ocupantes">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modalImprimirIndicacaoNumerica -->
<div class="modal fade" id="modalImprimirIndicacaoNumerica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gerar listagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>forms/word_indicacao_numerica_unidades" target="_blank" method="post">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary col-md-6" data-dismiss="modal">Fechar</button>
          <button type="submit" name="word_indicacao_numerica_unidades" class="btn btn-primary float-right col-md-6">Gerar</button>
          <input type="hidden" name="id_procedure_reurb" id="id_procedure_reurb" value="<?php echo $process_number->id; ?>">
          <input type="hidden" name="modalidade" class="form-control " value="" id="modalidade_listagem_ocupantes">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modalImprimirWord -->
<div class="modal fade" id="modalImprimirWord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gerar listagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>forms/word_listagem_ocupantes" target="_blank" method="post">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary col-md-6" data-dismiss="modal">Fechar</button>
          <button type="submit" name="word_listagem_ocupantes" class="btn btn-primary float-right col-md-6">Gerar</button>
          <input type="hidden" name="process_number" id="process_number_title" value="<?php echo $process_number->id; ?>">
          <input type="hidden" name="modalidade" class="form-control " value="" id="modalidade_listagem_ocupantes">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modalGenerateLegitimationTitle -->
<div class="modal fade" id="modalGenerateLegitimationTitle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gerar Titulo de Legitimação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>forms/generateLegitimationTitle" target="_blank" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="cartorio">Cartório</label>
                <select class="form-control cartorio" name="cartorio">
                  <option value=""></option>
                  <?php foreach ($notarys_office as $row) : ?>
                    <option value="<?php echo $row->id; ?>"><?php echo $row->name_registry; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" name="generateLegitimationTitle" class="btn btn-primary float-right">Gerar</button>
          <input type="hidden" name="process_number" id="process_number_title" value="<?php echo $process_number->id; ?>">
          <input type="hidden" name="modalidade" class="form-control " value="" id="modalidade_listagem_todos_ocupantes">
        </div>
      </form>
    </div>
  </div>
</div>

<?php $this->load->view('elements/footer'); ?>