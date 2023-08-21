<?php $this->load->view('elements/header');?>
<div class="wrapper ">
  <?php $this->load->view('elements/sidebar_lateral');?>
  <?php $this->load->view('elements/sidebar');?>
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
    <form action="<?php echo base_url(); ?>requesters/save_conclusion_requester/<?php echo $id; ?>" method="post"
      enctype="multipart/form-data" id="update_requester_forms">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-12">
                  <h4 class="card-title d-inline">QUALIFICAÇÕES DOS REQUERENTES</h4>
                  <input type="hidden" id="have_changed" value="0">
                  <div class="d-flex justify-content-end float-right">
                    <a href="<?php echo base_url()?>requesters" class="btn btn-secundary mr-1">Voltar</a>
                    <button type="submit" id="btnSalvarAlteracao" name="save_conclusion_requester" class="btn btn-primary">Salvar alterações</button>
                    <input type="hidden" value="" id="idTypeForm" name="idTypeForm">
                   
                  </div>
                  <?php if ($requester_juridical->type_requester == 1): ?>
                  <input type="hidden" name="type_requester" id="type_requester" value="fisico" />
                  <?php endif; ?>
                  <?php if ($requester_juridical->type_requester == 2): ?>
                  <input type="hidden" name="type_requester" id="type_requester" value="juridico" />
                  <?php endif; ?>
                </div>
              </div>


            </div>
            <hr>
            <div class="card-body">
              <?php if ($requester_juridical->type_requester == 1): ?>
              <div class="row mb-4">
                <div class="col-md-12">
                  <span class="text-secondary">Documentos enviados: </span>
                  <span
                    class="text-secondary float-right"><?php echo $count_checklist_send->count ?>/<?php echo $count_checklist_required_physical->count * 2; ?></span>
                  <div class="progress" style="height: 25px;">
                    <?php $progess = ($count_checklist_send->count / ($count_checklist_required_physical->count * 2))*100; ?>
                    <div class="progress-bar" role="progressbar" style="width: <?php echo $progess ?>%;"
                      aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                      <?php echo number_format($progess, 2, '.', ''); ?>%</div>
                  </div>
                </div>
              </div>
              <div class="row peopleFisica">
                <div class="col-md-12">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link <?php echo (empty($error)) ? 'active' : ''; ?>" id="personal-tab"
                        data-toggle="tab" href="#personal" role="tab" aria-controls="personal"
                        aria-selected="<?php echo (empty($error)) ? 'true' : 'false'; ?>">Dados</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="spouse-tab" data-toggle="tab" href="#spouse" role="tab"
                        aria-controls="spouse" aria-selected="false">Cônjuge/Companheiro(a)</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link <?php echo (!empty($error)) ? 'active' : ''; ?>" id="members-family-tab"
                        data-toggle="tab" href="#members-family" role="tab" aria-controls="members-family"
                        aria-selected="<?php echo (!empty($error)) ? 'true' : 'false'; ?>">Membros da família</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="address_home_tab" data-toggle="tab" href="#address_home" role="tab"
                        aria-controls="address_home" aria-selected="false">Endereço residencial</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="arquivos_tab" data-toggle="tab" href="#arquivos" role="tab"
                        aria-controls="arquivos" aria-selected="false">Arquivos / Checklist</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="arquivos_tab" data-toggle="tab" href="#topographic_survey" role="tab"
                        aria-controls="topographic_survey" aria-selected="false">Levantamento Topográfico</a>
                    </li>
                    <!-- <li class="nav-item">
                    <a class="nav-link" id="checklist_tab" data-toggle="tab" href="#checklist" role="tab"
                      aria-controls="checklist" aria-selected="false">Checklist</a>
                  </li> -->
                    <li class="nav-item">
                      <a class="nav-link" id="realty_tab_home" data-toggle="tab" href="#requester_conclusion" role="tab"
                        aria-controls="register_conclusion-tab" aria-selected="false">Conclusão de cadastro</a>
                    </li>
                  </ul>

                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade <?php echo (empty($error)) ? 'show active' : ''; ?> " id="personal"
                      role="tabpanel" aria-labelledby="personal-tab">
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <button type="button" name="button"
                            class="btn btn-sm <?php echo ($requester_legal->status == '0') ? 'btn-primary' : 'btn-secondary'; ?> float-right mr-3"
                            data-toggle="modal" data-target="#modalQuestion">
                            <i class="fa fa-power-off"></i>
                            <?php echo ($requester_legal->status == '0') ? 'Ativar' : 'Desativar'; ?>
                          </button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="name_personal">Nome</label>
                            <input type="text" name="name_personal" id="name_personal" class="form-control"
                              value="<?php echo $requester_legal->name; ?>" data-field="Nome">
                            <?php echo form_error('name_personal'); ?>
                          </div>
                        </div>
                        <div class="col-md pr-md-1 pl-md-1">
                          <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" name="cpf_personal" id="cpf_personal" data-field="CPF"
                              class="form-control cpf  " value="<?php echo $requester_legal->cpf; ?>">
                            <?php echo form_error('cpf_personal'); ?>
                          </div>
                        </div>
                        <div class="col-md pr-md-1 pl-md-1">
                          <div class="form-group">
                            <label for="rg_personal">RG</label>
                            <input type="text" name="rg_personal" id="rg_personal" class="form-control"
                              value="<?php echo $requester_legal->rg; ?>" data-field="RG">
                            <?php echo form_error('rg_personal'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="orgao_expedidor_personal">Órgão Expedidor</label>
                            <input type="text" name="consignor_organ" id="consignor_organ" class="form-control"
                              value="<?php echo $requester_legal->consignor_organ; ?>" data-field="Órgão Expedidor">
                            <?php echo form_error('orgao_expedidor'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="profession_personal">Profissão</label>
                            <input type="text" name="profession_personal" id="profession_personal" class="form-control"
                              value="<?php echo $requester_legal->profession; ?>" data-field="Profissão">
                            <?php echo form_error('profession_personal'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1 pr-md-1">
                          <div class="form-group">
                            <label for="monthly_income_personal">Renda mensal (R$)</label>
                            <input type="text" name="monthly_income_personal" id="monthly_income_personal"
                              class="form-control venal"
                              value="<?php echo number_format($requester_legal->monthly_income, 2, ',', '.'); ?>"
                              data-field="Renda mensal">
                            <?php echo form_error('monthly_income'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1 pr-md-1">
                          <div class="form-group_personal">
                            <label for="date_of_birth_personal">Data de nascimento</label>
                            <input type="date" name="date_of_birth_personal" id="date_of_birth_personal"
                              class="form-control" value="<?php echo $requester_legal->birth_date; ?>"
                              data-field="Data de nascimento">
                            <?php echo form_error('date_of_birth_personal'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="sex_personal">Sexo</label>
                            <select name="gender_personal" class="form-control" id="gender_personal" data-field="Sexo">
                              <option value=""></option>
                              <option value="M" <?= ($requester_legal->gender == 'M') ? 'selected': ''; ?>>Masculino
                              </option>
                              <option value="F" <?= ($requester_legal->gender == 'F') ? 'selected': ''; ?>>Feminino
                              </option>
                              <option value="O" <?= ($requester_legal->gender == 'O') ? 'selected': ''; ?>>Outros
                              </option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="nationality_personal">Nacionalidade</label>
                            <select name="nationality_personal" class="form-control" id="nationality_personal"
                              data-field="Nacionalidade">
                              <option value="<?php echo $requester_legal->nationality; ?>">
                                <?php echo $requester_legal->nationality; ?></option>
                              <?php if ($requester_legal->nationality != 'Brasileira'): ?>
                              <option value="Brasileira">Brasileira</option>
                              <?php else: ?>
                              <option value="Estrangeira">Estrangeira</option>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="marital_status_personal">Estado civil</label>
                            <select name="marital_status_personal" class="form-control" id="marital_status_personal"
                              data-field="Estado Civil">
                              <option value=""></option>
                              <option value="Casado(a)"
                                <?= ($requester_legal->civil_status == 'Casado(a)') ? 'selected' : ''; ?>>Casado(a)
                              </option>
                              <option value="Solteiro(a)"
                                <?= ($requester_legal->civil_status == 'Solteiro(a)') ? 'selected' : ''; ?>>Solteiro(a)
                              </option>
                              <option value="Separado(a)"
                                <?= ($requester_legal->civil_status == 'Separado(a)') ? 'selected' : ''; ?>>Separado(a)
                              </option>
                              <option value="Divorciado(a)"
                                <?= ($requester_legal->civil_status == 'Divorciado(a)') ? 'selected' : ''; ?>>
                                Divorciado(a)</option>
                              <option value="Viúvo(a)"
                                <?= ($requester_legal->civil_status == 'Viúvo(a)') ? 'selected' : ''; ?>>Viúvo(a)
                              </option>
                            </select>
                          </div>
                        </div>
                        <div class="row">
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="date_marriage_personal">Data casamento / União Estável</label>
                            <input type="date" name="date_marriage_personal" id="date_marriage_personal"
                              class="form-control" value="<?php echo $requester_legal->wedding_date; ?>"
                              data-field="Data casamento">
                            <?php echo form_error('date_marriage_personal'); ?>
                          </div>
                        </div>
                        <div class="col-md pr-md-1 pl-md-1">
                          <div class="form-group">
                            <label for="marriage_regime_personal">Regime de casamento/União Estável</label>
                            <select name="marriage_regime_personal" class="form-control" id="marriage_regime_personal"
                              data-field="regime de casamento">
                              <option value=""></option>
                              <option value="Comunhão Parcial de Bens"
                                <?= ($requester_legal->marriage_regime == 'Comunhão Parcial de Bens') ? 'selected' : ''; ?>>
                                Comunhão Parcial de Bens
                              </option>
                              <option value="Comunhão Universal de Bens"
                                <?= ($requester_legal->marriage_regime == 'Comunhão Universal de Bens') ? 'selected' : ''; ?>>
                                Comunhão Universal de Bens
                              </option>
                              <option value="Separação de bens"
                                <?= ($requester_legal->marriage_regime == 'Separação de bens') ? 'selected' : ''; ?>>
                                Separação de bens
                              </option>
                              <option value="Separação convencional/Absoluta de bens"
                                <?= ($requester_legal->marriage_regime == 'Separação convencional/Absoluta de bens') ? 'selected' : ''; ?>>
                                Separação convencional/Absoluta de bens
                              </option>
                              <option value="Participação final nos aquestos"
                                <?= ($requester_legal->marriage_regime == 'Participação final nos aquestos') ? 'selected' : ''; ?>>
                                Participação final nos aquestos
                              </option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="mother_name_personal">Nome da mãe</label>
                            <input type="text" name="mother_name_personal" id="mother_name_personal"
                              class="form-control" value="<?php echo $requester_legal->mother_name; ?>"
                              data-field="Nome da Mãe">
                            <?php echo form_error('mother_name_personal'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="father_name_personal">Nome do pai</label>
                            <input type="text" name="father_name_personal" id="father_name_personal"
                              class="form-control" value="<?php echo $requester_legal->father_name; ?>"
                              data-field="Nome do Pai">
                            <?php echo form_error('father_name_personal'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <span class="text-dark d-flex justify-content-center">É proprietário(a) de imóvel urbano ou
                            rural registrado em Cartório de Imóveis?</span>
                          <div class="form-group d-flex justify-content-center pt-2">
                            <input type="radio" name="property_owner_personal" id="sim" value="1"
                              <?php echo ($requester_legal->property_owner_legal == '1') ? 'checked' : ''; ?>
                              data-field="É proprietário(a) de imóvel urbano ou
                            rural registrado em Cartório de Imóveis?">
                            <label for="sim" class="pr-4">Sim</label>
                            <input type="radio" name="property_owner_personal" id="nao" value="0"
                              <?php echo ($requester_legal->property_owner_legal == '0') ? 'checked' : ''; ?>>
                            <label for="nao">Não</label>
                          </div>
                        </div>
                      </div>
          
                      <div class="row">
                        <div class="col-md pr-md-1 pr-md-1">
                          <div class="form-group">
                            <label for="schooling_personal">Escolaridade</label>
                            <select name="schooling_personal" class="form-control" id="schooling_personal">
                              <option value=""></option>
                              <option value="Fundamental - Incompleto"
                                <?php echo ($requester_legal->scholarity == 'Fundamental - Incompleto') ? 'selected': ''; ?>>
                                Fundamental - Incompleto</option>
                              <option value="Fundamental - Completo"
                                <?php echo ($requester_legal->scholarity == 'Fundamental - Completo') ? 'selected': ''; ?>>
                                Fundamental - Completo</option>
                              <option value="Médio - Incompleto"
                                <?php echo ($requester_legal->scholarity == 'Médio - Incompleto') ? 'selected': ''; ?>>
                                Médio - Incompleto</option>
                              <option value="Médio - Completo"
                                <?php echo ($requester_legal->scholarity == 'Médio - Completo') ? 'selected': ''; ?>>
                                Médio - Completo</option>
                              <option value="Superior - Incompleto"
                                <?php echo ($requester_legal->scholarity == 'Superior - Incompleto') ? 'selected': ''; ?>>
                                Superior - Incompleto</option>
                              <option value="Superior - Completo"
                                <?php echo ($requester_legal->scholarity == 'Superior - Completo') ? 'selected': ''; ?>>
                                Superior - Completo</option>
                              <option value="Pós-graduação - Incompleto"
                                <?php echo ($requester_legal->scholarity == 'Pós-graduação - Incompleto') ? 'selected': ''; ?>>
                                Pós-graduação - Incompleto</option>
                              <option value="Pós-graduação - Completo"
                                <?php echo ($requester_legal->scholarity == 'Pós-graduação - Completo') ? 'selected': ''; ?>>
                                Pós-graduação - Completo</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="email_personal">E-mail</label>
                            <input type="email" name="email_personal" id="email_personal" class="form-control"
                              value="<?php echo $requester_legal->email; ?>">
                            <?php echo form_error('email_personal'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="phone">Telefone</label>
                            <input type="text" name="tel_personal" id="phone" class="form-control phone"
                              value="<?php echo $requester_legal->phone; ?>">
                            <?php echo form_error('tel_personal'); ?>
                          </div>
                        </div>
                      </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="nis_personal">N.I.S</label>
                            <input type="text" name="nis_personal" value="<?php echo $requester_legal->nis_personal; ?>"
                              class="form-control" id="nis_personal">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <span class="text-dark d-flex justify-content-center">O requerente participa de programa de
                            transferência de renda do governo federal?</span>
                          <div class="form-group d-flex justify-content-center pt-2">
                            <input type="radio" name="cash_transfer_program" id="cash_transfer_program_sim" value="1"
                              class="cash_transfer_program"
                              <?php echo ($requester_legal->cash_transfer_program == 1) ? 'checked' : ''; ?>>
                            <label for="cash_transfer_program_sim" class="pr-4">Sim</label>
                            <input type="radio" name="cash_transfer_program" id="cash_transfer_program_nao" value="0"
                              class="cash_transfer_program"
                              <?php echo ($requester_legal->cash_transfer_program == 0) ? 'checked' : ''; ?>>
                            <label for="cash_transfer_program_nao">Não</label>
                          </div>
                        </div>
                      </div>
                      <div class="row " id="input_federal_government_income"
                        <?php echo ($requester_legal->cash_transfer_program == 0) ? 'style="display: none;"' : ''; ?>>
                        <div class="col-md-12 d-flex justify-content-center">
                          <div class="form-group">
                            <label for="federal_government_income">Renda do governo federal</label>
                            <input type="text" name="federal_government_income"
                              value="<?php echo number_format($requester_legal->federal_government_income, 2, ',', '.'); ?>"
                              class="form-control venal col-md-12" id="federal_government_income">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="spouse" role="tabpanel" aria-labelledby="spouse-tab">
                      <div class="row mt-3">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="name_spouse">Nome</label>
                            <input type="text" name="name_spouse" id="name_spouse" class="form-control"
                              value="<?php echo $requester_legal->name_spouse; ?>" data-field="Nome do Cônjuge">
                            <span id="name_spouse_warn" class="text-dark d-none">Campo Obrigatório</span>
                            <?php echo form_error('name_spouse'); ?>
                          </div>
                        </div>
                        <div class="col-md pr-md-1 pl-md-1">
                          <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" name="cpf_spouse" id="cpf_spouse" class="form-control cpf"
                              value="<?php echo $requester_legal->cpf_spouse; ?>" data-field="CPF do Cônjuge">
                            <span id="cpf_spouse_warn" class="text-dark d-none">Campo Obrigatório</span>
                            <?php echo form_error('cpf_spouse'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1 pr-md-1">
                          <div class="form-group">
                            <label for="rg_spouse">RG</label>
                            <input type="text" name="rg_spouse" id="rg_spouse" class="form-control"
                              value="<?php echo $requester_legal->rg_spouse; ?>" data-field="RG do Cônjuge">
                            <span id="rg_spouse_warn" class="text-dark d-none">Campo Obrigatório</span>
                            <?php echo form_error('rg_spouse'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="orgao_expedidor_spouse">Órgão Expedidor</label>
                            <input type="text" name="orgao_expedidor_spouse" id="orgao_expedidor_spouse"
                              class="form-control" value="<?php echo $requester_legal->consignor_organ_spouse; ?>"
                              data-field="Órgão Expedidor do Cônjuge">
                            <span id="orgao_expedidor_spouse_warn" class="text-dark d-none">Campo Obrigatório</span>
                            <?php echo form_error('orgao_expedidor_spouse'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="profession_spouse">Profissão</label>
                            <input type="text" name="profession_spouse" id="profession_spouse" class="form-control"
                              value="<?php echo $requester_legal->profession_spouse; ?>"
                              data-field="Profissão do Cônjuge">
                            <?php echo form_error('profession_spouse'); ?>
                            <span id="profession_spouse_warn" class="text-dark d-none">Campo Obrigatório</span>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="monthly_income_spouse">Renda mensal (R$)</label>
                            <input type="text" name="monthly_income_spouse" id="monthly_income_spouse"
                              class="form-control venal" data-field="Renda mensal do Cônjuge"
                              value="<?php echo number_format($requester_legal->monthly_spouse, 2, ',', '.'); ?>">
                            <?php echo form_error('monthly_income_spouse'); ?>
                            <span id="monthly_income_spouse_warn" class="text-dark d-none">Campo Obrigatório</span>
                          </div>
                        </div>
                        <div class="col-md pl-md-1 pr-md-1">
                          <div class="form-group">
                            <label for="date_of_birth_spouse">Data de nascimento</label>
                            <input type="date" name="date_of_birth_spouse" id="date_of_birth_spouse"
                              class="form-control" value="<?php echo $requester_legal->birth_date_spouse; ?>"
                              data-field="Data de nascimento do Cônjuge">
                            <span id="date_of_birth_spouse_warn" class="text-dark d-none">Campo Obrigatório</span>
                            <?php echo form_error('date_of_birth_spouse'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="sex_spouse">Sexo</label>
                            <select name="gender_spouse" class="form-control" id="gender_spouse"
                              data-field="Sexo do Cônjuge">
                              <option value="M" <?php echo ($requester_legal->gender_spouse == 'M')? 'selected' :''; ?>>
                                Masculino</option>
                              <option value="F" <?php echo ($requester_legal->gender_spouse == 'F')? 'selected' :''; ?>>
                                Feminino</option>
                            </select>
                            <span id="gender_spouse_warn" class="text-dark d-none">Campo Obrigatório</span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="nationality_spouse">Nacionalidade</label>
                            <select name="nationality_spouse" class="form-control" id="nationality_spouse"
                              data-field="Nacionalidade do Cônjuge">
                              <option value=""></option>
                              <option value="Brasileira"
                                <?php echo ($requester_legal->nationality_spouse == 'Brasileira')? 'selected' :''; ?>>
                                Brasileira</option>
                              <option value="Estrangeira"
                                <?php echo ($requester_legal->nationality_spouse == 'Estrangeira')? 'selected' :''; ?>>
                                Estrangeira</option>
                            </select>
                            <span id="nationality_spouse_warn" class="text-dark d-none">Campo Obrigatório</span>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="schooling_spouse">Escolaridade</label>
                            <select name="schooling_spouse" class="form-control" id="schooling_spouse">
                              <option value=""></option>
                              <option value="Fundamental - Incompleto"
                                <?php echo ($requester_legal->scholarity_spouse == 'Fundamental - Incompleto')? 'selected' :''; ?>>
                                Fundamental - Incompleto</option>
                              <option value="Fundamental - Completo"
                                <?php echo ($requester_legal->scholarity_spouse == 'Fundamental - Completo')? 'selected' :''; ?>>
                                Fundamental - Completo</option>
                              <option value="Médio - Incompleto"
                                <?php echo ($requester_legal->scholarity_spouse == 'Médio - Incompleto')? 'selected' :''; ?>>
                                Médio - Incompleto</option>
                              <option value="Médio - Completo"
                                <?php echo ($requester_legal->scholarity_spouse == 'Médio - Completo')? 'selected' :''; ?>>
                                Médio - Completo</option>
                              <option value="Superior - Incompleto"
                                <?php echo ($requester_legal->scholarity_spouse == 'Superior - Incompleto')? 'selected' :''; ?>>
                                Superior - Incompleto</option>
                              <option value="Superior - Completo"
                                <?php echo ($requester_legal->scholarity_spouse == 'Superior - Completo')? 'selected' :''; ?>>
                                Superior - Completo</option>
                              <option value="Superior - Completo"
                                <?php echo ($requester_legal->scholarity_spouse == 'Superior - Completo')? 'selected' :''; ?>>
                                Superior - Completo</option>
                              <option value="Pós-graduação - Incompleto"
                                <?php echo ($requester_legal->scholarity_spouse == 'Pós-graduação - Incompleto')? 'selected' :''; ?>>
                                Pós-graduação - Incompleto</option>
                              <option value="Pós-graduação - Completo"
                                <?php echo ($requester_legal->scholarity_spouse == 'Pós-graduação - Completo')? 'selected' :''; ?>>
                                Pós-graduação - Completo</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="mother_name_spouse">Nome da mãe</label>
                            <input type="text" name="mother_name_spouse" id="mother_name_spouse" class="form-control"
                              value="<?php echo $requester_legal->mother_name_spouse; ?>"
                              data-field="Nome da Mãe do Cônjuge">
                            <span id="mother_name_spouse_warn" class="text-dark d-none">Campo Obrigatório</span>
                            <?php echo form_error('mother_name_spouse'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="father_name_spouse">Nome do pai</label>
                            <input type="text" name="father_name_spouse" id="father_name_spouse" class="form-control"
                              value="<?php echo $requester_legal->father_name_spouse; ?>"
                              data-field="Nome do Pai do Cônjuge">
                            <span id="father_name_spouse_warn" class="text-dark d-none">Campo Obrigatório</span>
                            <?php echo form_error('father_name_spouse'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="email_spouse">E-mail</label>
                            <input type="email" name="email_spouse" id="email_spouse" class="form-control"
                              value="<?php echo $requester_legal->email_spouse; ?>">
                            <?php echo form_error('email_spouse'); ?>
                          </div>
                        </div>
                        <div class="col-md pr-md-1 pl-md-1">
                          <div class="form-group">
                            <label for="phone">Telefone</label>
                            <input type="text" name="tel_spouse" id="phone" class="form-control phone"
                              value="<?php echo $requester_legal->phone_spouse; ?>">
                            <?php echo form_error('tel_spouse'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <?php if ($requester_legal->civil_status != 'Casado(a)'): ?>
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="marital_status_spouse">Estado civil</label>
                            <select name="marital_status_spouse" class="form-control" id="marital_status_spouse"
                              data-field="Estado civil">
                              <option value=""></option>
                              <option value="Casado(a)"
                                <?= ($requester_legal->civil_status_spouse == 'Casado(a)') ? 'selected' : ''; ?>>
                                Casado(a)
                              </option>
                              <option value="Solteiro(a)"
                                <?= ($requester_legal->civil_status_spouse == 'Solteiro(a)') ? 'selected' : ''; ?>>
                                Solteiro(a)</option>
                              <option value="Separado(a)"
                                <?= ($requester_legal->civil_status_spouse == 'Separado(a)') ? 'selected' : ''; ?>>
                                Separado(a)</option>
                              <option value="Divorciado(a)"
                                <?= ($requester_legal->civil_status_spouse == 'Divorciado(a)') ? 'selected' : ''; ?>>
                                Divorciado(a)</option>
                              <option value="Viúvo(a)"
                                <?= ($requester_legal->civil_status_spouse == 'Viúvo(a)') ? 'selected' : ''; ?>>Viúvo(a)
                              </option>
                            </select>
                            <span id="marital_status_spouse_warn" class="text-dark d-none">Campo Obrigatório</span>
                          </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="marriage_regime_spouse">Regime de casamento/União Estável</label>
                            <select name="marriage_regime_spouse" class="form-control" id="marriage_regime_spouse"
                              data-field="Regime de casamento">
                              <option value=""></option>
                              <option value="Comunhão Parcial de Bens"
                                <?= ($requester_legal->marriage_regime_spouse == 'Comunhão Parcial de Bens') ? 'selected' : ''; ?>>
                                Comunhão Parcial de Bens
                              </option>
                              <option value="Comunhão Universal de Bens"
                                <?= ($requester_legal->marriage_regime_spouse == 'Comunhão Universal de Bens') ? 'selected' : ''; ?>>
                                Comunhão Universal de Bens
                              </option>
                              <option value="Separação de bens"
                                <?= ($requester_legal->marriage_regime_spouse == 'Separação de bens') ? 'selected' : ''; ?>>
                                Separação de bens
                              </option>
                              <option value="Separação convencional/Absoluta de bens"
                                <?= ($requester_legal->marriage_regime_spouse == 'Separação convencional/Absoluta de bens') ? 'selected' : ''; ?>>
                                Separação convencional/Absoluta de bens
                              </option>
                              <option value="Participação final nos aquestos"
                                <?= ($requester_legal->marriage_regime_spouse == 'Participação final nos aquestos') ? 'selected' : ''; ?>>
                                Participação final nos aquestos
                              </option>
                            </select>
                            <span id="marriage_regime_spouse_warn" class="text-dark d-none">Campo Obrigatório</span>
                          </div>
                        </div>
                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="nis_spouse">N.I.S</label>
                            <input type="text" name="nis_spouse" value="<?php echo $requester_legal->nis_spouse; ?>"
                              class="form-control" id="nis_spouse">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <span class="text-dark d-flex justify-content-center">O requerente participa de programa de
                            transferência de renda do governo federal?</span>
                          <div class="form-group d-flex justify-content-center pt-2">
                            <input type="radio" name="cash_transfer_program_spouse"
                              id="cash_transfer_program_spouse_sim" value="1" class="cash_transfer_program_spouse"
                              <?php echo ($requester_legal->cash_transfer_program_spouse == 1) ? 'checked' : ''; ?>>
                            <label for="cash_transfer_program_spouse_sim" class="pr-4">Sim</label>
                            <input type="radio" name="cash_transfer_program_spouse"
                              id="cash_transfer_program_spouse_nao" value="0" class="cash_transfer_program_spouse"
                              <?php echo ($requester_legal->cash_transfer_program_spouse == 0) ? 'checked' : ''; ?>>
                            <label for="cash_transfer_program_spouse_nao">Não</label>
                          </div>
                        </div>
                      </div>
                      <div class="row " id="input_federal_government_income_spouse"
                        <?php echo ($requester_legal->cash_transfer_program_spouse == 0) ? 'style="display: none;"' : ''; ?>>
                        <div class="col-md-12 d-flex justify-content-center">
                          <div class="form-group">
                            <label for="federal_government_income_spouse">Renda do governo federal</label>
                            <input type="text" name="federal_government_income_spouse"
                              value="<?php echo number_format($requester_legal->federal_government_income_spouse, 2, ',', '.'); ?>"
                              class="form-control venal col-md-12" id="federal_government_income_spouse">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <span class="text-dark d-flex justify-content-center">É proprietário(a) de imóvel urbano ou
                            rural registrado em Cartório de Imóveis?</span>
                          <span id="property_owner_spouse_warn" class="text-dark d-none">Campo Obrigatório</span>
                          <div class="form-group d-flex justify-content-center pt-2">
                            <input type="radio" name="property_owner" id="sim" value="1"
                              <?php echo ($requester_legal->property_owner == '1') ? 'checked' : ''; ?>>
                            <label for="sim" class="pr-4">Sim</label>
                            <input type="radio" name="property_owner" id="nao" value="0"
                              <?php echo ($requester_legal->property_owner == '0') ? 'checked' : ''; ?>>
                            <label for="nao">Não</label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!--------------------------------------------------------->
                    <!-- INICIO DO ENDERECO DE MORADIA -->
                    <!--------------------------------------------------------->

                    <div class="tab-pane" id="address_home" role="tabpanel" aria-labelledby="address_home-tab">
                      <div class="row mt-3">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="home_type_home">Tipo de Logradouro</label>
                            <select class="form-control" name="home_type_home" id="home_type_home">
                              <option value=""></option>
                              <option value="Alameda"
                                <?= ($requester_legal->type_street == 'Alameda')? 'selected' : ''; ?>>Alameda</option>
                              <option value="Avenida"
                                <?= ($requester_legal->type_street == 'Avenida')? 'selected' : ''; ?>>Avenida</option>
                              <option value="Praça" <?= ($requester_legal->type_street == 'Praça')? 'selected' : ''; ?>>
                                Praça</option>
                              <option value="Rua" <?= ($requester_legal->type_street == 'Rua')? 'selected' : ''; ?>>Rua
                              </option>
                              <option value="Travessa"
                                <?= ($requester_legal->type_street == 'Travessa')? 'selected' : ''; ?>>Travessa</option>
                              <option value="Via" <?= ($requester_legal->type_street == 'Via')? 'selected' : ''; ?>>Via
                              </option>
                              <option value="Viela" <?= ($requester_legal->type_street == 'Viela')? 'selected' : ''; ?>>
                                Viela</option>
                              <option value="Fazenda/Comunidade Rural"
                                <?= ($requester_legal->type_street == 'Fazenda/Comunidade Rural')? 'selected' : ''; ?>>
                                Fazenda/Comunidade Rural
                              </option>

                            </select>
                            <input type="hidden" name="id_property"
                              value="<?php echo $requester_legal->id_property; ?>">
                            <?php echo form_error('home_type_home'); ?>
                          </div>
                        </div>
                        <div class="col-md-6 pl-md-1 pr-md-1">
                          <div class="form-group">
                            <label for="home_public_place">Logradouro</label>
                            <input type="text" name="home_public_place" id="home_public_place" class="form-control"
                              value="<?php echo $requester_legal->public_place; ?>">
                            <?php echo form_error('home_public_place'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="home_number_home">Numero</label>
                            <input type="text" name="home_number_home" id="home_number_home" class="form-control"
                              value="<?php echo $requester_legal->number; ?>">
                            <?php echo form_error('home_number_home'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="home_neighborhood_home">Complemento</label>
                            <input type="text" name="realty_complement_home" id="home_neighborhood_home"
                              class="form-control" value="<?php echo $requester_legal->complement; ?>">
                            <?php echo form_error('home_neighborhood_home'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="home_neighborhood_home">Bairro</label>
                            <input type="text" name="home_neighborhood_home" id="home_neighborhood_home"
                              class="form-control" value="<?php echo $requester_legal->neighborhood; ?>">
                            <?php echo form_error('home_neighborhood_home'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="home_city_home">Cidade</label>
                            <input type="text" name="home_city_home" id="home_city_home" class="form-control"
                              value="<?php echo $requester_legal->city; ?>">
                            <?php echo form_error('home_city_home'); ?>
                          </div>
                        </div>
                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="home_cep_home">CEP</label>
                            <input type="text" name="home_cep_home" id="home_cep_home" class="form-control cep"
                              value="<?php echo $requester_legal->cep; ?>">
                            <?php echo form_error('home_cep_home'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="home_uf_home">UF</label>
                            <input type="text" name="home_uf_home" id="home_uf_home" class="form-control"
                              value="<?php echo $requester_legal->uf; ?>">
                            <?php echo form_error('home_uf_home'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md">
                          <div class="form-group">
                            <label for="home_country_home">País</label>
                            <input type="text" name="home_country_home" id="home_country_home" class="form-control"
                              value="<?php echo $requester_legal->home_country; ?>">
                            <?php echo form_error('home_country_home'); ?>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane fade" id="arquivos" role="tabpanel" aria-labelledby="address-tab">
                      <div class="row mt-3">
                        <div class="col-md-12">
                          <button type="button" name="button" class="btn btn-sm btn-primary float-right "
                            data-toggle="modal" data-target="#modal_add_document">
                            enviar/upload +
                          </button>
                          <!-- <button type="button" name="button" class="btn btn-sm btn-primary float-right img_cpf">enviar/upload +</button> -->
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-md-12">
                          <div class="list-group text-dark">
                            <h5>Requerente</h5>
                            <?php $count = 0; ?>
                            <?php foreach ($files_checklist as $row): ?>
                            <?php if ($row->property_document == 1): ?>
                            <div class="list-group-item d-inline align-items-center py-1 mb-1 ">
                              <span><?php echo $row->description; ?></span>
                              <?php if ($row->file == 'perfil.png'): ?>
                              <a href="<?php echo base_url(); ?>assets/build/img/perfil.png"
                                class="btn btn-sm btn-primary float-right"
                                download="<?php echo $row->description; ?>">Baixar</a>
                              <?php else: ?>
                              <a href="<?php echo base_url(); ?>assets/build/img/checklist_requester/<?php echo $row->file; ?>"
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
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if ($count == 0): ?>
                            <span>Sem documentos anexados</span>
                            <?php endif; ?>
                          </div>
                          <div class="" style="color: red;">
                            <p>Documentos faltantes:
                              <?php foreach ($checklist_not_send_requester as $row): ?>
                              <br><span>* <?php echo $row->description ?></span>
                              <?php endforeach; ?>
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-md-12">
                          <div class="list-group text-dark">
                            <h5>Cônjuge/Companheiro(a)</h5>
                            <?php $count = 0; ?>
                            <?php foreach ($files_checklist as $row): ?>
                            <?php if ($row->property_document == 2): ?>
                            <div class="list-group-item d-inline align-items-center py-1 mb-1 ">
                              <span><?php echo $row->description; ?></span>

                              <?php if ($row->file == 'perfil.png'): ?>
                              <a href="<?php echo base_url(); ?>assets/build/img/perfil.png"
                                class="btn btn-sm btn-primary float-right"
                                download="<?php echo $row->description; ?>">Baixar</a>
                              <?php else: ?>
                              <a href="<?php echo base_url(); ?>assets/build/img/checklist_requester/<?php echo $row->file; ?>"
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
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if ($count == 0): ?>
                            <span>Sem documentos anexados</span>
                            <?php endif; ?>
                          </div>
                          <div class="" style="color: red;">
                            <p>Documentos faltantes:
                              <?php foreach ($checklist_not_send_married as $row): ?>
                              <br><span>* <?php echo $row->description ?></span>
                              <?php endforeach; ?>
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="append_id_documents"></div>
                    </div>

                    <div class="tab-pane fade" id="topographic_survey" role="tabpanel"
                      aria-labelledby="topographic_survey-tab">
                      <?php $count = 0; ?>
                      <?php foreach ($topographic_survey as $row): ?>
                      <?php $date = date_create($row->activation_date); ?>
                      <div class="row <?php echo ($count == 0)? 'pt-3' : ''; ?>">
                        <div class="col-md-12">
                          <div class="form-group">
                            <?php if ($_SESSION['user']['profile'] == '1'): ?>
                            <input type="checkbox" name="id_topographic_survey[]" value="<?php echo $row->id; ?>"
                              id="topographic_survey_<?php echo $row->id; ?>"
                              <?php echo ($row->status == '1')? 'checked' : ''; ?>>
                            <?php else: ?>
                            <span class="<?php echo ($row->status == '1')? 'text-primary' : 'text-secondary'; ?>">
                              <i class="fa fa-check-circle"></i>
                            </span>
                            <?php endif; ?>
                            <label for="topographic_survey_<?php echo $row->id; ?>"><?php echo $row->description; ?>
                              <?php echo (!empty($row->activation_date))? ' - '.date_format($date, 'd/m/Y H:i:s') : ''; ?></label>
                          </div>
                        </div>
                      </div>
                      <?php $count = 1; ?>
                      <?php endforeach; ?>
                    </div>
                    <div class="tab-pane fade" id="requester_conclusion" role="tabpanel"
                      aria-labelledby="register_conclusion-tab">
                      <div class="row">
                        <div class="col-12">
                        <?php if (!empty($requester_history) && $requester_legal->completion_status == '1'): ?>
                          <button class="btn btn-danger d-block my-4 ml-auto" data-toggle="modal"
                            data-target="#modal_conclusion_cancel" type="button">Cancelar Conclusão</button>
                          <?php else: ?>
                          <button id="conclusao_cadastro" class="btn btn-primary d-block my-4 ml-auto" data-toggle="modal"
                            data-target="#modal_conclusion_confirm" type="button">Concluir Cadastro</button>
                          <?php endif; ?>
                          <div class="row">
                            <div class="col-md-12">
                              <table class="table text-dark">
                                <thead>
                                  <tr>
                                    <th>Protocolo</th>
                                    <th>Data de conclusão</th>
                                    <th>Responsável</th>
                                    <th>Status</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($requester_history as $row): ?>
                                  <?php if ($row->status != ''): ?>
                                  <?php $date = date_create($row->register); ?>
                                  <tr>
                                    <td>
                                        <a href="<?php //echo base_url(); ?>protocols/detail/<?php //echo $row->id_protocol; ?>" target="_blank">
                                          <i class="fa fa-search"></i>
                                          <?php //echo $row->process_number; ?>.<?php //echo $row->stage; ?>.<?php //echo  str_pad($row->id_protocol , 3 , '0' , STR_PAD_LEFT); ?>
                                        </a>
                                      </td>
                                    <td><?php echo date_format($date, 'd/m/Y'); ?></td>
                                    <td><?php echo $row->name; ?></td>
                                    <td><?php echo ($row->status == '1')? 'Concluído' : 'Conclusão Cancelada'; ?></td>
                                    <td>
                                      <a href="#" class="edit_requester_conpletion" data-toggle="modal"
                                        data-target="#modal_edit_requester_conpletion" data-id="<?php echo $row->id; ?>"
                                        data-status="<?php echo $row->status; ?>"
                                        data-reason="<?php echo $row->reason; ?>"
                                        data-responsible="<?php echo $row->name; ?>"
                                        data-date="<?php echo date_format($date, 'd/m/Y'); ?>">
                                        <i class="fa fa-search"></i>
                                      </a>
                                    </td>
                                  </tr>
                                  <?php endif; ?>
                                  <?php endforeach; ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane fade" id="checklist" role="tabpanel" aria-labelledby="checklist-tab">
                      <div class="accordion text-dark" id="accordionExample">
                        <div class="border-primary text-center m-2" data-toggle="collapse" data-target="#collapseCpf"
                          aria-expanded="true" aria-controls="collapseCpf" style="border: 2px solid #4373bc;">
                          <h5 class="font-weight-bold mt-3" style="color: #0162c0;">
                            Cpf
                          </h5>
                        </div>
                        <div id="collapseCpf" class="collapse m-2" aria-labelledby="headingOne"
                          data-parent="#accordionExample" style="border: 2px solid #4373bc; border-top: none;">
                          <div class="d-flex justify-content-center">
                            <?php if ($checklist->img_cpf == ""){ ?>
                            <span>Não a arquivo</span>
                            <?php }else{ ?>
                            <img
                              src="<?php echo base_url(); ?>assets/build/img/checklist_requester/<?php echo $checklist->img_cpf; ?>"
                              alt="" class="pt-2 pb-2">
                            <?php } ?>
                          </div>
                        </div>
                        <div class="" id="headingTwo">
                          <div class="border-primary text-center collapsed m-2" data-toggle="collapse"
                            data-target="#collapseRg" aria-expanded="true" aria-controls="collapseRg"
                            style="border: 2px solid #4373bc;">
                            <h5 class="font-weight-bold mt-3" style="color: #0162c0;">
                              RG
                            </h5>
                          </div>
                        </div>
                        <div id="collapseRg" class="collapse m-2" aria-labelledby="headingRg"
                          data-parent="#accordionExample" style="border: 2px solid #4373bc; border-top: none;">
                          <div class="d-flex justify-content-center">
                            <?php if ($checklist->img_rg == ""){ ?>
                            <h6>Arquivo não encontrado.</h6>
                            <?php }else{ ?>
                            <img
                              src="<?php echo base_url(); ?>assets/build/img/checklist_requester/<?php echo $checklist->img_rg; ?>"
                              alt="" class="pt-2 pb-2">
                            <?php } ?>
                          </div>
                        </div>
                        <div class="" id="headingCertidao">
                          <div class="border-primary text-center collapsed m-2" data-toggle="collapse"
                            data-target="#collapseCertidao" aria-expanded="true" aria-controls="collapseCertidao"
                            style="border: 2px solid #4373bc;">
                            <h5 class="font-weight-bold mt-3" style="color: #0162c0;">
                              Certidão de Nascimento/Casamento
                            </h5>
                          </div>
                        </div>
                        <div id="collapseCertidao" class="collapse m-2" aria-labelledby="headingCertidao"
                          data-parent="#accordionExample" style="border: 2px solid #4373bc; border-top: none;">
                          <div class="d-flex justify-content-center">
                            <?php if ($checklist->img_nascimento == ""){ ?>
                            <h6>Arquivo não encontrado.</h6>
                            <?php }else{ ?>
                            <img
                              src="<?php echo base_url(); ?>assets/build/img/checklist_requester/<?php echo $checklist->img_nascimento; ?>"
                              alt="" class="pt-2 pb-2">
                            <?php } ?>
                          </div>
                        </div>

                        <div class="" id="headingResidencia">
                          <div class="border-primary text-center collapsed m-2" data-toggle="collapse"
                            data-target="#collapseResidencia" aria-expanded="true" aria-controls="collapseResidencia"
                            style="border: 2px solid #4373bc;">
                            <h5 class="font-weight-bold mt-3" style="color: #0162c0;">
                              Comprovante de Residência
                            </h5>
                          </div>
                        </div>
                        <div id="collapseResidencia" class="collapse m-2" aria-labelledby="headingResidencia"
                          data-parent="#accordionExample" style="border: 2px solid #4373bc; border-top: none;">
                          <div class="d-flex justify-content-center">
                            <?php if ($checklist->img_residencia == ""){ ?>
                            <h6>Arquivo não encontrado.</h6>
                            <?php }else{ ?>
                            <img
                              src="<?php echo base_url(); ?>assets/build/img/checklist_requester/<?php echo $checklist->img_residencia; ?>"
                              alt="" class="pt-2 pb-2">
                            <?php } ?>
                          </div>
                        </div>
                        <div class="" id="headingRenda">
                          <div class="border-primary text-center collapsed m-2" data-toggle="collapse"
                            data-target="#collapseRenda" aria-expanded="true" aria-controls="collapseRenda"
                            style="border: 2px solid #4373bc;">
                            <h5 class="font-weight-bold mt-3" style="color: #0162c0;">
                              Comprovante de Renda
                            </h5>
                          </div>
                        </div>
                        <div id="collapseRenda" class="collapse m-2" aria-labelledby="headingRenda"
                          data-parent="#accordionExample" style="border: 2px solid #4373bc; border-top: none;">
                          <div class="d-flex justify-content-center">
                            <?php if ($checklist->img_renda == ""){ ?>
                            <h6>Arquivo não encontrado.</h6>
                            <?php }else{ ?>
                            <img
                              src="<?php echo base_url(); ?>assets/build/img/checklist_requester/<?php echo $checklist->img_renda; ?>"
                              alt="" class="pt-2 pb-2">
                            <?php } ?>
                          </div>
                        </div>
                      </div>

                    </div>

                    <div class="tab-pane fade <?php echo (!empty($error)) ? 'show active' : ''; ?>" id="members-family"
                      role="tabpanel" aria-labelledby="members-family-tab">
                      <?php foreach ($family_members as $row): ?>
                      <div class="row mt-3">
                        <div class="col-md-3 pr-md-1">
                          <div class="form-group">
                            <label for="name_members_family">Nome</label>
                            <input type="text" name="edit_name_family[]" id="name_members_family" class="form-control"
                              value="<?php echo $row->name; ?>">
                            <?php echo form_error('name_members-family'); ?>
                            <input type="hidden" name="id_family_members[]" value="<?php echo $row->id; ?>">
                          </div>
                        </div>
                        <div class="col-md pl-md-1 pr-md-1">
                          <div class="form-group">
                            <label for="rg_members_family">C.I / RG</label>
                            <input type="text" name="rg_members_family[]" id="rg" class="form-control"
                              value="<?php echo $row->rg; ?>">
                          </div>
                        </div>
                        <div class="col-md pl-md-1 pr-md-1">
                          <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" name="edit_cpf_family[]" id="cpf" class="form-control cpf"
                              value="<?php echo $row->cpf; ?>">
                            <?php echo form_error('cpf_members_family'); ?>
                          </div>
                        </div>

                        <div class="col-md pl-md-1 pr-md-1">
                          <div class="form-group">
                            <label for="type_members_family">Tipo</label>
                            <select class="form-control" name="type_members_family[]" id="type_members_family">
                              <option value=""></option>
                              <option value="Mãe" <?= ($row->type == 'Mãe') ? 'selected' : ''; ?>>Mãe</option>
                              <option value="Pai" <?= ($row->type == 'Pai') ? 'selected' : ''; ?>>Pai</option>
                              <option value="Irmão(a)" <?= ($row->type == 'Irmão(a)') ? 'selected' : ''; ?>>Irmão(a)
                              </option>
                              <option value="Filho(a)" <?= ($row->type == 'Filho(a)') ? 'selected' : ''; ?>>Filho(a)
                              </option>
                              <option value="Sobrinho(a)" <?= ($row->type == 'Sobrinho(a)') ? 'selected' : ''; ?>>
                                Sobrinho(a)</option>
                              <option value="Cunhado(a)" <?= ($row->type == 'Cunhado(a)') ? 'selected' : ''; ?>>
                                Cunhado(a)
                              </option>
                              <option value="Primo(a)" <?= ($row->type == 'Primo(a)') ? 'selected' : ''; ?>>Primo(a)
                              </option>
                              <option value="Tio(a)" <?= ($row->type == 'Tio(a)') ? 'selected' : ''; ?>>Tio(a)</option>
                              <option value="Avô" <?= ($row->type == 'Avô') ? 'selected' : ''; ?>>Avô</option>
                              <option value="Avó" <?= ($row->type == 'Avó') ? 'selected' : ''; ?>>Avó</option>
                              <option value="Outros" <?= ($row->type == 'Outros') ? 'selected' : ''; ?>>Outros</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md pr-md-1 pl-md-1">
                          <div class="form-group">
                            <label for="date_birth_family">Data de nascimento</label>
                            <input type="date" name="edit_date_birth_family[]" id="date_birth_family"
                              class="form-control" value="<?php echo $row->birth_date; ?>">
                            <?php echo form_error('date_birth_family'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="monthly_income_members-family">Renda mensal (R$)</label>
                            <input type="text" name="edit_monthly_income_family[]" id="monthly_income_members_family"
                              class="form-control venal"
                              value="<?php echo number_format($row->monthly_income, 2, ',', '.'); ?>">
                            <?php echo form_error('monthly_income_members_family'); ?>
                          </div>
                        </div>
                      </div>
                      <?php endforeach; ?>


                      <div id="members_list"></div>

                      <div class="row">
                        <div class="col-md-12">
                          <button type="button" name="button"
                            class="btn btn-secondary float-md-right  float-sm-right  float-xs-right" data-toggle="modal"
                            data-target="#modalExemplo">Novo membro</button>
                          <!-- <input type='button'  id="add_member" value="Novo membro"> -->
                        </div>
                      </div>


                    </div>
                  </div>
                </div>
              </div>
              <?php endif; ?>
              <?php if ($requester_juridical->type_requester == 2): ?>
              <div class="row peopleJuridica">
                <div class="col-md-12">
                  <div class="row mb-4">
                    <div class="col-md-12">
                      <span class="text-secondary">Documentos enviados: </span>
                      <span
                        class="text-secondary float-right"><?php echo $count_checklist_send->count ?>/<?php echo $count_checklist_required_juridical->count; ?></span>
                      <div class="progress" style="height: 25px;">
                        <?php $progess = ($count_checklist_send->count / ($count_checklist_required_juridical->count * 2))*100; ?>
                        <div class="progress-bar" role="progressbar" style="width: <?php echo $progess ?>%;"
                          aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                          <?php echo number_format($progess, 2, '.', ''); ?>%</div>
                      </div>
                    </div>
                  </div>
                  <ul class="nav nav-tabs" id="myTab2" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="juridical-person-tab" data-toggle="tab" href="#juridical-person"
                        role="tab" aria-controls="juridical" aria-selected="true">Dados</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="procurator-tab" data-toggle="tab" href="#procurator" role="tab"
                        aria-controls="procurator" aria-selected="false">Representante Legal</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="home-address-juridical-tab" data-toggle="tab" href="#address-juridical"
                        role="tab" aria-controls="address-juridical" aria-selected="false">Endereço Residencial</a>
                    </li>
                    <!-- <li class="nav-item">
                    <a class="nav-link" id="home-checklist-juridical-tab" data-toggle="tab" href="#checklist_juridical"
                      role="tab" aria-controls="checklist-juridical" aria-selected="false">Checklist</a>
                  </li> -->
                    <li class="nav-item">
                      <a class="nav-link" id="home-checklist-juridical-tab" data-toggle="tab"
                        href="#checklist_juridical" role="tab" aria-controls="checklist-juridical"
                        aria-selected="false">Arquivos / Checklist</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="topographic_survey_juridical_tab" data-toggle="tab"
                        href="#topographic_survey_juridical" role="tab" aria-controls="topographic_survey_juridical"
                        aria-selected="false">Levantamento Topográfico</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="realty_tab_home" data-toggle="tab" href="#requester_conclusion" role="tab"
                        aria-controls="register_conclusion-tab" aria-selected="false">Conclusão de cadastro aaaaaAaaAA</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent2">

                    <div class="tab-pane fade show active" id="juridical-person" role="tabpanel"
                      aria-labelledby="juridical-person-tab">
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <button type="button" name="button"
                            class="btn btn-sm <?php echo ($requester_juridical->status == '0') ? 'btn-primary' : 'btn-secondary'; ?> float-right mr-3"
                            data-toggle="modal" data-target="#modalQuestion">
                            <i class="fa fa-power-off"></i>
                            <?php echo ($requester_juridical->status == '0') ? 'Ativar' : 'Desativar'; ?>
                          </button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="cnpj_juridical">CNPJ</label>
                            <input type="text" name="cnpj_juridical" id="cnpj_juridical" class="form-control cnpj"
                              value="<?php echo $requester_juridical->cnpj; ?>">
                            <?php echo form_error('cnpj_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md pr-md-1 pl-md-1">
                          <div class="form-group">
                            <label for="corporate_name_juridical">Razão social</label>
                            <input type="text" name="corporate_name_juridical" id="corporate_name_juridical"
                              class="form-control" value="<?php echo $requester_juridical->company_name; ?>">
                            <?php echo form_error('corporate_name_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="activity_branch_juridical">Ramo de atividade</label>
                            <input type="text" name="activity_branch_juridical" id="activity_branch_juridical"
                              class="form-control" value="<?php echo $requester_juridical->activity_branch; ?>">
                            <?php echo form_error('activity_branch_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="monthly_invoicing_juridical">Faturamento mensal</label>
                            <input type="text" name="monthly_invoicing_juridical" id="monthly_invoicing_juridical"
                              class="form-control venal"
                              value="<?php echo number_format($requester_juridical->monthly_invoicing, 2, ',', '.'); ?>">
                            <?php echo form_error('monthly_invoicing_juridical'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="type_street_juridical">Tipo de logradouro</label>
                            <select class="form-control" name="type_street_juridical" id="type_stree_juridical">
                              <option value=""></option>
                              <option value="Alameda"
                                <?= ($requester_juridical->type_street_juridical == 'Alameda')? 'selected' : ''; ?>>
                                Alameda</option>
                              <option value="Avenida"
                                <?= ($requester_juridical->type_street_juridical == 'Avenida')? 'selected' : ''; ?>>
                                Avenida</option>
                              <option value="Praça"
                                <?= ($requester_juridical->type_street_juridical == 'Praça')? 'selected' : ''; ?>>Praça
                              </option>
                              <option value="Rua"
                                <?= ($requester_juridical->type_street_juridical == 'Rua')? 'selected' : ''; ?>>Rua
                              </option>
                              <option value="Travessa"
                                <?= ($requester_juridical->type_street_juridical == 'Travessa')? 'selected' : ''; ?>>
                                Travessa</option>
                              <option value="Via"
                                <?= ($requester_juridical->type_street_juridical == 'Via')? 'selected' : ''; ?>>Via
                              </option>
                              <option value="Viela"
                                <?= ($requester_juridical->type_street_juridical == 'Viela')? 'selected' : ''; ?>>Viela
                              </option>
                            </select>
                            <?php echo form_error('type_street_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md-4 px-md-1">
                          <div class="form-group">
                            <label for="street_juridical">Logradouro</label>
                            <input type="text" name="street_juridical" id="street_juridical" class="form-control"
                              value="<?php echo $requester_juridical->public_place_juridical; ?>">
                            <?php echo form_error('street_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="number_name_juridical">Numero</label>
                            <input type="text" name="number_name_juridical" id="number_name_juridical"
                              class="form-control" value="<?php echo $requester_juridical->number_juridical; ?>">
                            <?php echo form_error('number_name_juridical'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="complement_juridical">Complemento</label>
                            <input type="text" name="complement_juridical" id="complemen_juridical" class="form-control"
                              value="<?php echo $requester_juridical->complement_juridical; ?>">
                            <?php echo form_error('complement_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="neighborhood_juridical">Bairro</label>
                            <input type="text" name="neighborhood_juridical" id="neighborhood_juridical"
                              class="form-control" value="<?php echo $requester_juridical->neighborhood_juridical; ?>">
                            <?php echo form_error('neighborhood_juridical'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="city_juridical">Cidade</label>
                            <input type="text" name="city_juridical" id="city_juridical" class="form-control"
                              value="<?php echo $requester_juridical->city_juridical; ?>">
                            <?php echo form_error('city_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="cep_juridical">CEP</label>
                            <input type="text" name="cep_juridical" id="cep_juridical" class="form-control cep"
                              value="<?php echo $requester_juridical->cep_juridical; ?>">
                            <?php echo form_error('cep_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="uf_juridical">UF</label>
                            <input type="text_juridical" name="uf_juridical" id="uf_juridical" class="form-control"
                              value="<?php echo $requester_juridical->uf_juridical; ?>">
                            <?php echo form_error('uf_juridical'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md">
                          <div class="form-group">
                            <label for="country_juridical">País</label>
                            <input type="text" name="country_juridical" id="country_juridical" class="form-control"
                              value="<?php echo $requester_juridical->country; ?>">
                            <?php echo form_error('country_juridical'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <span class="text-dark d-flex justify-content-center">É proprietário(a) de imóvel urbano ou
                            rural registrado em Cartório de Imóveis?</span>
                          <div class="form-group d-flex justify-content-center pt-2">
                            <input type="radio" name="property_owner_juridical" id="sim" value="1"
                              <?php echo ($requester_juridical->property_owner == '1') ? 'checked' : ''; ?>>
                            <label for="sim" class="pr-4">Sim</label>
                            <input type="radio" name="property_owner_juridical" id="nao" value="0"
                              <?php echo ($requester_juridical->property_owner == '0') ? 'checked' : ''; ?>>
                            <label for="nao">Não</label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane" id="procurator" role="tabpanel" aria-labelledby="procurator-tab">
                      <div class="row mt-3">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="name_juridical_procurator">Nome</label>
                            <input type="text" name="name_juridical_procurator" id="name_juridical_procurator"
                              class="form-control" value="<?php echo $requester_juridical->name; ?>">
                            <?php echo form_error('name_juridical_procurator'); ?>
                          </div>
                        </div>
                        <div class="col-md pr-md-1 pl-md-1">
                          <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" name="cpf_juridical_procurator" id="cpf" class="form-control cpf"
                              value="<?php echo $requester_juridical->cpf; ?>">
                            <?php echo form_error('cpf_juridical_procurator'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1 pr-md-1">
                          <div class="form-group">
                            <label for="rg">RG</label>
                            <input type="text" name="rg_juridical_procurator" id="rg_juridical_procurator"
                              class="form-control" value="<?php echo $requester_juridical->rg; ?>">
                            <?php echo form_error('rg_juridical_procurator'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1 ">
                          <div class="form-group">
                            <label for="orgao_expedidor_juridical_procurator">Órgão Expedidor</label>
                            <input type="text" name="orgao_expedidor_juridical_procurator"
                              id="orgao_expedidor_juridical_procurator" class="form-control"
                              value="<?php echo $requester_juridical->consignor_organ; ?>">
                            <?php echo form_error('orgao_expedidor_juridical_procurator'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="profession_juridical_procurator">Profissão</label>
                            <input type="text" name="profession_juridical_procurator"
                              id="profession_juridical_procurator" class="form-control"
                              value="<?php echo $requester_juridical->profission; ?>">
                            <?php echo form_error('profession_juridical_procurator'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1 pr-md-1">
                          <div class="form-group">
                            <label for="date_of_birth_juridical_procurator">Data de nascimento</label>
                            <input type="date" name="date_of_birth_juridical_procurator"
                              id="date_of_birth_juridical_procurator" class="form-control"
                              value="<?php echo $requester_juridical->birth_date; ?>">
                            <?php echo form_error('date_of_birth_juridical_procurator'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="gender_juridical_procurator">Sexo</label>
                            <select class="form-control" name="gender_juridical_procurator"
                              id="gender_juridical_procurator">
                              <?php if ($requester_juridical->gender): ?>
                              <option value="<?php echo $requester_juridical->gender ?>">
                                <?php echo ($requester_juridical->gender == 'M') ? 'Masculino' : 'Feminino' ;?></option>
                              <?php if ($requester_juridical->gender != 'M'): ?>
                              <option value="M">Masculino</option>
                              <?php else: ?>
                              <option value="F">Feminino</option>
                              <?php endif; ?>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="nationality_juridical_procurator">Nacionalidade</label>
                            <select class="form-control" name="nationality_juridical_procurator"
                              id="nationality_juridical_procurator">
                              <?php if ($requester_juridical->country_procurator): ?>
                              <option value="<?php echo $requester_juridical->country_procurator ?>">
                                <?php echo $requester_juridical->country_procurator; ?></option>
                              <?php if ($requester_juridical->country_procurator != 'Brasileira'): ?>
                              <option value="Brasileira">Brasileira</option>
                              <?php else: ?>
                              <option value="Estrangeira">Estrangeira</option>
                              <?php endif; ?>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md pr-md-1 pl-md-1">
                          <div class="form-group">
                            <label for="email_juridical_procurator">E-mail</label>
                            <input type="email_juridical_procurator" name="email_juridical_procurator"
                              id="email_juridical_procurator" class="form-control"
                              value="<?php echo $requester_juridical->email; ?>">
                            <?php echo form_error('email_juridical_procurator'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="phone">Telefone</label>
                            <input type="text" name="tel_juridical_procurator" id="phone" class="form-control phone"
                              value="<?php echo $requester_juridical->phone; ?>">
                            <?php echo form_error('tel_juridical_procurator'); ?>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane" id="address-juridical" role="tabpanel"
                      aria-labelledby="home-address-juridical-tab">
                      <div class="row mt-3">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="home_type_juridical">Tipo de Logradouro</label>
                            <select class="form-control" name="home_type_juridical" id="home_type_juridical">
                              <option value=""></option>
                              <option value="Alameda"
                                <?= ($requester_legal->type_street == 'Alameda')? 'selected' : ''; ?>>Alameda</option>
                              <option value="Avenida"
                                <?= ($requester_legal->type_street == 'Avenida')? 'selected' : ''; ?>>Avenida</option>
                              <option value="Praça" <?= ($requester_legal->type_street == 'Praça')? 'selected' : ''; ?>>
                                Praça</option>
                              <option value="Rua" <?= ($requester_legal->type_street == 'Rua')? 'selected' : ''; ?>>Rua
                              </option>
                              <option value="Travessa"
                                <?= ($requester_legal->type_street == 'Travessa')? 'selected' : ''; ?>>Travessa</option>
                              <option value="Via" <?= ($requester_legal->type_street == 'Via')? 'selected' : ''; ?>>Via
                              </option>
                              <option value="Viela" <?= ($requester_legal->type_street == 'Viela')? 'selected' : ''; ?>>
                                Viela</option>
                              <option value="Fazenda/Comunidade Rural"
                                <?= ($requester_juridical->type_street == 'Fazenda/Comunidade Rural')? 'selected' : ''; ?>>
                                Fazenda/Comunidade Rural
                              </option>
                            </select>
                            <?php echo form_error('home_type_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md-6 px-md-1">
                          <div class="form-group">
                            <label for="home_address_juridical">Logradouro</label>
                            <input type="text" name="home_address_juridical" id="home_address_juridical"
                              class="form-control" value="<?php echo $requester_juridical->public_place; ?>">
                            <?php echo form_error('home_address_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="home_number_juridical">Numero</label>
                            <input type="text" name="home_number_juridical" id="home_number_juridical"
                              class="form-control" value="<?php echo $requester_juridical->number; ?>">
                            <?php echo form_error('home_number_juridical'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="home_complement_juridical">Complemento</label>
                            <input type="text" name="home_complement_juridical" id="home_complement_juridical"
                              class="form-control" value="<?php echo $requester_juridical->complement; ?>">
                            <?php echo form_error('home_complement_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md pr-md-1 pl-md-1">
                          <div class="form-group">
                            <label for="home_neighborhood_juridical">Bairro</label>
                            <input type="text" name="home_neighborhood_juridical" id="home_neighborhood_juridical"
                              class="form-control" value="<?php echo $requester_juridical->neighborhood; ?>">
                            <?php echo form_error('home_neighborhood_juridical'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="home_city_juridical">Cidade</label>
                            <input type="text" name="home_city_juridical" id="home_city_juridical" class="form-control"
                              value="<?php echo $requester_juridical->city; ?>">
                            <?php echo form_error('home_city_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md px-md-1">
                          <div class="form-group">
                            <label for="home_cep_juridical">CEP</label>
                            <input type="text" name="home_cep_juridical" id="home_cep_juridical"
                              class="form-control cep" value="<?php echo $requester_juridical->cep; ?>">
                            <?php echo form_error('home_cep_juridical'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="uf_address_juridical">UF</label>
                            <input type="text" name="home_uf_juridical" id="home_uf_juridical" class="form-control"
                              value="<?php echo $requester_juridical->uf; ?>">
                            <?php echo form_error('home_uf_juridical'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md">
                          <div class="form-group">
                            <label for="home_country_juridical">País</label>
                            <input type="text" name="home_country_juridical" id="home_country_juridical"
                              class="form-control" value="<?php echo $requester_juridical->home_country; ?>">
                            <?php echo form_error('home_country_juridical'); ?>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane fade" id="checklist_juridical" role="tabpanel"
                      aria-labelledby="checklist_juridical-tab">
                      <div class="row mt-3">
                        <div class="col-md-12">
                          <button type="button" name="button" class="btn btn-sm btn-primary float-right "
                            data-toggle="modal" data-target="#modal_add_document_juridical">
                            enviar/upload +
                          </button>
                          <!-- <button type="button" name="button" class="btn btn-sm btn-primary float-right img_cpf">enviar/upload +</button> -->
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-md-12">
                          <div class="list-group text-dark">
                            <h5>Requerente</h5>
                            <?php $count = 0; ?>
                            <?php foreach ($files_checklist as $row): ?>
                            <?php if ($row->property_document == 1): ?>
                            <div class="list-group-item d-inline align-items-center py-1 mb-1 ">
                              <span><?php echo $row->description; ?></span>
                              <?php if ($row->file == 'perfil.png'): ?>
                              <a href="<?php echo base_url(); ?>assets/build/img/perfil.png"
                                class="btn btn-sm btn-primary float-right"
                                download="<?php echo $row->description; ?>">Baixar</a>
                              <?php else: ?>
                              <a href="<?php echo base_url(); ?>assets/build/img/checklist_requester/<?php echo $row->file; ?>"
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
                              <!-- <input type="hidden" name="id_documents[]" value="<?php echo $row->id; ?>" class="id_documents_<?php echo $row->id; ?>"> -->
                              <span
                                class="d-flex align-items-center float-right text-primary mr-3 mt-2 name_file_<?php echo $row->id; ?>"></span>
                              <img src="" alt="" id="img_cpf" style="display: none;">
                            </div>
                            <?php $count++; ?>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if ($count == 0): ?>
                            <span>Sem documentos anexados</span>
                            <?php endif; ?>
                          </div>
                          <div class="" style="color: red;">
                            <p>Documentos faltantes:
                              <?php foreach ($checklist_not_send_requester_juridical as $row): ?>
                              <?php //if ($row->type == '2'): ?>
                              <br><span>* <?php echo $row->description ?></span>
                              <?php //endif; ?>
                              <?php endforeach; ?>
                            </p>
                          </div>
                        </div>
                      </div>
                      <!-- <div class="row mt-2">
                      <div class="col-md-12">
                        <div class="list-group text-dark">
                          <h5>Cônjuge/Companheiro(a)</h5>
                          <?php $count = 0; ?>
                          <?php foreach ($files_checklist as $row): ?>
                            <?php if ($row->property_document == 2): ?>
                              <div class="list-group-item d-inline align-items-center py-1 mb-1 ">
                                <span><?php echo $row->description; ?></span>

                                <a href="<?php echo base_url(); ?>assets/build/img/checklist_requester/<?php echo $row->file; ?>" class="btn btn-sm btn-primary float-right" download="<?php echo $row->description; ?>">Baixar</a>
                                <button type="button" name="button" class="btn btn-sm btn-success float-right files_checklist"
                                  data-id="<?php echo $row->id; ?>" data-classe="id_documents_<?php echo $row->id; ?>"
                                  >
                                  alterar arquivo
                                </button>

                                <input type="file" name="files_checklist[]"
                                  id="pic_file_<?php echo $row->id; ?>" class="pic_file" value=""
                                  data-id="<?php echo $row->id; ?>"
                                  style="display: none;">
                                <span class="d-flex align-items-center float-right text-primary mr-3 mt-2 name_file_<?php echo $row->id; ?>"></span>
                                <img src="" alt="" id="img_cpf" style="display: none;">
                              </div>
                              <?php $count++; ?>
                            <?php endif; ?>
                          <?php endforeach; ?>
                          <?php if ($count == 0): ?>
                            <span>Sem documentos anexados</span>
                          <?php endif; ?>
                        </div>
                        <div class="" style="color: red;">
                          <p>Documentos faltantes:
                            <?php foreach ($checklist_not_send_married as $row): ?>
                              <br><span>* <?php echo $row->description ?></span>
                            <?php endforeach; ?>
                          </p>
                        </div>
                      </div>
                    </div> -->
                      <div class="append_id_documents"></div>
                    </div>

                    <div class="tab-pane fade" id="topographic_survey_juridical" role="tabpanel"
                      aria-labelledby="topographic_survey-tab">
                      <?php $count = 0; ?>
                      <?php foreach ($topographic_survey as $row): ?>
                      <?php $date = date_create($row->activation_date); ?>
                      <div class="row <?php echo ($count == 0)? 'pt-3' : ''; ?>">
                        <div class="col-md-12">
                          <div class="form-group">
                            <?php if ($_SESSION['user']['profile'] == '1'): ?>
                            <input type="checkbox" name="id_topographic_survey[]" value="<?php echo $row->id; ?>"
                              id="topographic_survey_<?php echo $row->id; ?>"
                              <?php echo ($row->status == '1')? 'checked' : ''; ?>>
                            <?php else: ?>
                            <span class="<?php echo ($row->status == '1')? 'text-primary' : 'text-secondary'; ?>">
                              <i class="fa fa-check-circle"></i>
                            </span>
                            <?php endif; ?>
                            <label for="topographic_survey_<?php echo $row->id; ?>"><?php echo $row->description; ?>
                              <?php echo (!empty($row->activation_date))? ' - '.date_format($date, 'd/m/Y H:i:s') : ''; ?></label>
                          </div>
                        </div>
                      </div>
                      <?php $count = 1; ?>
                      <?php endforeach; ?>
                    </div>

                    <div class="tab-pane fade" id="requester_conclusion" role="tabpanel"
                      aria-labelledby="register_conclusion-tab">
                      <div class="row">
                        <div class="col-12">
                          
                        <?php if (!empty($requester_history) && $requester_legal->completion_status == '1'): ?>
                          <button class="btn btn-danger d-block my-4 ml-auto" data-toggle="modal"
                            data-target="#modal_conclusion_cancel" type="button">Cancelar Conclusão</button>
                          <?php else: ?>
                          <button class="btn btn-primary d-block my-4 ml-auto" data-toggle="modal"
                            data-target="#modal_conclusion_confirm" type="button">Concluir Cadastro</button>
                          <?php endif; ?>
                          <div class="row">
                            <div class="col-md-12">
                              <table class="table text-dark">
                                <thead>
                                  <tr>
                                    <!-- <th>Protocolo</th> -->
                                    <th>Data de conclusão</th>
                                    <th>Responsável</th>
                                    <th>Status</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($requester_history as $row): ?>
                                  <?php if ($row->status != ''): ?>
                                  <?php $date = date_create($row->register); ?>
                                  <tr>
                                    <!-- <td>
                                        <a href="<?php //echo base_url(); ?>protocols/detail/<?php //echo $row->id_protocol; ?>" target="_blank">
                                          <i class="fa fa-search"></i>
                                          <?php //echo $row->process_number; ?>.<?php //echo $row->stage; ?>.<?php //echo  str_pad($row->id_protocol , 3 , '0' , STR_PAD_LEFT); ?>
                                        </a>
                                      </td> -->
                                    <td><?php echo date_format($date, 'd/m/Y'); ?></td>
                                    <td><?php echo $row->name; ?></td>
                                    <td><?php echo ($row->status == '1')? 'Concluído' : 'Conclusão Cancelada'; ?></td>
                                    <td>
                                      <a href="#" class="edit_requester_conpletion" data-toggle="modal"
                                        data-target="#modal_edit_requester_conpletion" data-id="<?php echo $row->id; ?>"
                                        data-status="<?php echo $row->status; ?>"
                                        data-reason="<?php echo $row->reason; ?>"
                                        data-responsible="<?php echo $row->name; ?>"
                                        data-date="<?php echo date_format($date, 'd/m/Y H:i'); ?>">
                                        <i class="fa fa-search"></i>
                                      </a>
                                    </td>
                                  </tr>
                                  <?php endif; ?>
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
            </div>
            <div class="card-footer">
              <div class="modal fade" id="modal_conclusion_confirm" tabindex="-1"
                aria-labelledby="label_modal_confirmation" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="label_modal_confirmation">Tem certeza de que deseja concluir o
                        cadastro?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row" id="modal_conclusion_confirm_body">

                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <button type="button" class="btn btn-secondary col-md-12" data-dismiss="modal">Fechar</button>
                        </div>
                        <div class="col-md-6">
                          <button type="submit" id="update_requester" name="save_conclusion_requester"
                            class="btn btn-primary col-md-12">Concluir</button>
                        </div>
                        <input type="hidden" name="id_requester" value="<?php echo $id; ?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </form>
  </div>
</div>
<?php $this->load->view('elements/footer');?>

<!-- Modal -->
<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>requesters/register_new_member_family/<?php echo $id; ?>" method="post"
        enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Adicionar novo membro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="name_members_family">Nome</label>
                <input type="text" name="name_members_family[]" id="name_members-family" class="form-control" value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="rg_members_family">C.I / RG</label>
                <input type="text" name="rg_members_family[]" class="form-control" id="" value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="cpf_members_family">CPF</label>
                <input type="text" name="cpf_members_family[]" class="form-control cpf" id="cpf" value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="type_members_family">Tipo</label>
                <select class="form-control" name="type_members_family[]" id="type_members_family">
                  <option value=""></option>
                  <option value="Mãe">Mãe</option>
                  <option value="Pai">Pai</option>
                  <option value="Irmão(a)">Irmão(a)</option>
                  <option value="Filho(a)">Filho(a)</option>
                  <option value="Sobrinho(a)">Sobrinho(a)</option>
                  <option value="Cunhado(a)">Cunhado(a)</option>
                  <option value="Primo(a)">Primo(a)</option>
                  <option value="Tio(a)">Tio(a)</option>
                  <option value="Avô">Avô</option>
                  <option value="Avó">Avó</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="date_birth_family">Data de nascimento</label>
                <input type="date" name="date_birth_family[]" id="date_birth_family" class="form-control" value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="monthly_income_members_family">Renda mensal (R$)</label>
                <input type="text" name="monthly_income_members_family[]" id="monthly_income_members_family"
                  class="form-control venal" value="">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary" name="register_new_member_family">Adicionar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modalQuestion -->
<div class="modal fade" id="modalQuestion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>requesters/turn_off_requester" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tem certeza?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row d-flex justify-content-center">
            <div class="col-md-12 d-flex justify-content-center">
              <button type="submit" name="turn_off_requester" class="btn btn-primary col-md-6">Sim</button>
              <button type="button" class="btn btn-danger col-md-6" data-dismiss="modal">Nao</button>
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="hidden" name="status" value="<?php echo $requester_legal->status; ?>">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal_add_document_juridical -->
<div class="modal fade" id="modal_add_document_juridical" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>requesters/send_files" method="post" enctype="multipart/form-data">
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
                  <?php foreach ($documents_entity_physical as $row): ?>
                  <?php if ($row->type == 2): ?>
                  <option value="<?php echo $row->id; ?>"><?php echo $row->description; ?></option>
                  <?php endif; ?>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <!-- <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="property_document">Proprietário: </label>
                <select name="property_document" class="form-control" id="property_document">
                  <option value=""></option>
                  <option value="1">Requerente</option>
                  <option value="2">Cônjuge/Companheiro(a)</option>
                </select>
              </div>
            </div>
          </div> -->
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
          <input type="hidden" name="property_document" value="1">
          <input type="hidden" name="id_requester" value="<?php echo $id; ?>">
          <!-- <input type="hidden" name="status" value="<?php echo $requester_legal->status; ?>"> -->
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modalAddDocument -->
<div class="modal fade" id="modal_add_document" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>requesters/send_files" method="post" enctype="multipart/form-data">
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
                  <?php foreach ($documents_entity_physical as $row): ?>
                  <?php if ($row->type == 1): ?>
                  <option value="<?php echo $row->id; ?>"><?php echo $row->description; ?></option>
                  <?php endif; ?>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="property_document">Referente: </label>
                <select name="property_document" class="form-control" id="property_document">
                  <option value=""></option>
                  <option value="1">Requerente</option>
                  <option value="2">Cônjuge/Companheiro(a)</option>
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
          <input type="hidden" name="id_requester" value="<?php echo $id; ?>">
          <!-- <input type="hidden" name="status" value="<?php echo $requester_legal->status; ?>"> -->
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal_edit_document -->
<div class="modal fade" id="modal_edit_document" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>requesters/update_files" method="post" enctype="multipart/form-data">
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
          <input type="hidden" name="id_requester" value="<?php echo $id; ?>">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal_conclusion_cancel -->
<div class="modal fade" id="modal_conclusion_cancel" tabindex="-1" aria-labelledby="label_modal_confirmation"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>requesters/requester_history_cancel" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="label_modal_confirmation">Tem certeza de que deseja cancelar?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
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
          <input type="hidden" name="id_requester" value="<?php echo $id; ?>">
          <button type="submit" name="requester_history_cancel" class="btn btn-primary">Concluir</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal_edit_requester_conpletion -->
<div class="modal fade" id="modal_edit_requester_conpletion" tabindex="-1" aria-labelledby="label_modal_confirmation"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>requesters/update_requester_history" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="label_modal_confirmation">Detalhes</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Data</label>
                <input type="text" name="" value="" class="form-control" id="date_requester_history" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Responsável</label>
                <input type="text" name="" value="" class="form-control" id="responsible_requester_history" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Status</label>
                <input type="text" name="" value="" class="form-control" id="status_requester_history" readonly>
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
          <input type="hidden" name="id_requester" value="<?php echo $id; ?>">
          <input type="hidden" name="id_requester_history" value="" id="id_requester_history">
          <input type="hidden" name="status_requester_history" value="" id="status_requester_history">
          <button type="submit" name="update_requester_history" class="btn btn-primary"
            id="update_requester_history">Atualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>