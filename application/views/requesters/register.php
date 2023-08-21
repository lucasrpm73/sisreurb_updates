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
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form action="<?php echo base_url(); ?>requesters/register_requesters/" method="post" enctype="multipart/form-data">
            <div class="card-header">
              <a href="<?php echo base_url()?>requesters"
                class="btn btn-secundary float-right btn-round mb-2">Voltar</a>
              <button type="submit" name="register_requesters" id="register_requesters"
                class="btn btn-primary btn-round float-md-right float-sm-right float-xs-right">Cadastrar</button>
              <h5 class="card-title ">QUALIFICAÇÕES DOS REQUERENTES</h5>
              <hr>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input peopleType" type="radio" name="people_type" id="physics" value="1"
                      checked>
                    <label class="form-check-label" for="physics">Física</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input peopleType" type="radio" name="people_type" id="juridical" value="2">
                    <label class="form-check-label" for="juridical">Jurídica</label>
                  </div>
                </div>
              </div>
              <div id="pesquisarCadastroCpf" class="row justify-content-center align-items-center">
                <div class="col-md-6 col-sm-12 ">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control cpf_cnpj" placeholder="Informe o CPF"
                      aria-label="Recipiente para nickname" aria-describedby="basic-addon2" id="cpf">
                    <div class="input-group-append">
                      <span class="input-group-text bg-primary text-white  " id="basic-addon2"><i
                          class="fas fa-search ml-2 mx-1"></i>Prosseguir</span>
                    </div>
                  </div>
                </div>
              </div>
              <div id="pesquisarCadastroCnpj" class="row justify-content-center align-items-center"
                style="display: none;">
                <div class="col-md-6 col-sm-12 ">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Informe o CNPJ"
                      aria-label="Recipiente para nickname" aria-describedby="basic-addon2" id="cnpj">
                    <div class="input-group-append">
                      <span class="input-group-text bg-primary text-white  " id="basic-addon2"><i
                          class="fas fa-search ml-2 mx-1"></i>Prosseguir</span>
                    </div>
                  </div>
                </div>
              </div>
              <div  id="requerente_cadastrado"
                style="display: none;">
                <div class="row justify-content-center align-items-center">
                  <div class="col-md-6 col-sm-12 alert_off alert alert-danger">
                    <span class="text-requester font-weight-bold">Requerente cadastrado!</span>
                    <a href="#" class="btn btn-sm  ml-3" id="name_requester"></a>
                  </div>
                </div>
              </div>
              <div class="conteudoCadastroRequirente" style="display:none">
                <div class="row peopleFisica">
                  <div class="col-md-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="personal-tab" data-toggle="tab" href="#personal" role="tab"
                          aria-controls="personal" aria-selected="true">Dados</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="spouse-tab" data-toggle="tab" href="#spouse" role="tab"
                          aria-controls="spouse" aria-selected="false">Cônjuge/Companheiro(a)</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="members-family-tab" data-toggle="tab" href="#members-family" role="tab"
                          aria-controls="members-family" aria-selected="false">Membros da família</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="address_home_tab" data-toggle="tab" href="#address_home" role="tab"
                          aria-controls="address_home" aria-selected="false">Endereço residencial</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="checklist_tab" data-toggle="tab" href="#checklist" role="tab"
                          aria-controls="checklist" aria-selected="false">Checklist</a>
                      </li>

                    </ul>

                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade active show" id="personal" role="tabpanel"
                        aria-labelledby="personal-tab">
                        <div class="row mt-3">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="cpf">CPF</label>
                              <input type="text" name="cpf_personal" id="cpf" class="form-control cpf_personal cpf"
                                value="<?php echo set_value('cpf_personal'); ?>" required>
                              <?php echo form_error('cpf_personal'); ?>
                            </div>
                          </div>
                          <div class="col-md pr-md-1 pl-md-1">
                            <div class="form-group">
                              <label for="name_personal">Nome</label>
                              <input type="text" name="name_personal" id="name_personal" class="form-control"
                                value="<?php echo set_value('name_personal'); ?>" required>
                              <?php echo form_error('name_personal'); ?>
                            </div>
                          </div>
                          <div class="col-md pr-md-1 pl-md-1">
                            <div class="form-group">
                              <label for="rg_personal">R.G</label>
                              <input type="text" name="rg_personal" id="rg_personal" class="form-control"
                                value="<?php echo set_value('rg_personal'); ?>">
                              <?php echo form_error('rg_personal'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="orgao_expedidor_personal">Órgão Expedidor</label>
                              <input type="text" name="orgao_expedidor_personal" id="orgao_expedidor_personal"
                                class="form-control" value="<?php echo set_value('orgao_expedidor_personal'); ?>">
                              <?php echo form_error('orgao_expedidor'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="profession_personal">Profissão</label>
                              <input type="text" name="profession_personal" id="profession_personal"
                                class="form-control" value="<?php echo set_value('profession_personal'); ?>">
                              <?php echo form_error('profession_personal'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1 pr-md-1">
                            <div class="form-group">
                              <label for="monthly_income_personal">Renda mensal (R$)</label>
                              <input type="text" name="monthly_income_personal" id="monthly_income_personal"
                                class="form-control venal" value="<?php echo set_value('monthly_income_personal'); ?>">
                              <?php echo form_error('monthly_income_personal'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1 pr-md-1">
                            <div class="form-group_personal">
                              <label for="date_of_birth_personal">Data de nascimento</label>
                              <input type="date" name="date_of_birth_personal" id="date_of_birth_personal"
                                class="form-control" value="<?php echo set_value('date_of_birth_personal'); ?>">
                              <?php echo form_error('date_of_birth_personal'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="sex_personal">Sexo</label>
                              <select name="gender_personal" class="form-control" id="gender_personal">
                                <option value=""></option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                                <option value="O">Outros</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="nationality_personal">Nacionalidade</label>
                              <select name="nationality_personal" class="form-control" id="nationality_personal">
                                <option value=""></option>
                                <option value="Brasileira">Brasileira</option>
                                <option value="Estrangeira">Estrangeira</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md px-md-1">
                            <div class="form-group">
                              <label for="mother_name_personal">Nome da mãe</label>
                              <input type="text" name="mother_name_personal" id="mother_name_personal"
                                class="form-control" value="<?php echo set_value('mother_name_personal'); ?>">
                              <?php echo form_error('mother_name_personal'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="father_name_personal">Nome do pai</label>
                              <input type="text" name="father_name_personal" id="father_name_personal"
                                class="form-control" value="<?php echo set_value('father_name_personal'); ?>">
                              <?php echo form_error('father_name_personal'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="schooling_personal">Escolaridade</label>
                              <select name="schooling_personal" class="form-control" id="schooling_personal">
                                <option value=""></option>
                                <option value="Fundamental - Incompleto">Fundamental - Incompleto</option>
                                <option value="Fundamental - Completo">Fundamental - Completo</option>
                                <option value="Médio - Incompleto">Médio - Incompleto</option>
                                <option value="Médio - Completo">Médio - Completo</option>
                                <option value="Superior - Incompleto">Superior - Incompleto</option>
                                <option value="Superior - Completo">Superior - Completo</option>
                                <option value="Pós-graduação - Incompleto">Pós-graduação - Incompleto</option>
                                <option value="Pós-graduação - Completo">Pós-graduação - Completo</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md px-md-1">
                            <div class="form-group">
                              <label for="email_personal">E-mail</label>
                              <input type="email" name="email_personal" id="email_personal" class="form-control"
                                value="<?php echo set_value('email_personal'); ?>">
                              <?php echo form_error('email_personal'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="phone">Telefone</label>
                              <input type="text" name="tel_personal" id="phone" class="form-control phone"
                                value="<?php echo set_value('tel_personal'); ?>">
                              <?php echo form_error('tel_personal'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="marital_status_personal">Estado civil</label>
                              <select name="marital_status_personal" class="form-control"
                                id="marital_status_personal_register">
                                <option value=""></option>
                                <option value="Casado(a)">Casado(a)</option>
                                <option value="Solteiro(a)">Solteiro(a)</option>
                                <option value="Separado(a)">Separado(a)</option>
                                <option value="Divorciado(a)">Divorciado(a)</option>
                                <option value="Viúvo(a)">Viúvo(a)</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md pr-md-1 pl-md-1">
                            <div class="form-group">
                              <label for="marriage_regime_personal">Regime de casamento/União Estável</label>
                              <select name="marriage_regime_personal" class="form-control" id="marriage_regime_personal">
                                <option value=""></option>
                                <option value="Comunhão Parcial de Bens">
                                  Comunhão Parcial de Bens
                                </option>
                                <option value="Comunhão Universal de Bens">
                                  Comunhão Universal de Bens
                                </option>
                                <option value="Separação de bens">
                                  Separação de bens
                                </option>
                                <option value="Separação convencional/Absoluta de bens">
                                  Separação convencional/Absoluta de bens
                                </option>
                                <option value="Participação final nos aquestos">
                                  Participação final nos aquestos
                                </option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="date_marriage_personal">Data casamento / União Estável</label>
                              <input type="date" name="date_marriage_personal" id="date_marriage_personal"
                                class="form-control" value="<?php echo set_value('date_marriage_personal'); ?>">
                              <?php echo form_error('date_marriage_personal'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="nis_personal">N.I.S</label>
                              <input type="text" name="nis_personal" value="" class="form-control" id="nis_personal">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <span class="text-dark d-flex justify-content-center">O requerente participa de programa de transferência de renda do governo federal?</span>
                            <div class="form-group d-flex justify-content-center pt-2">
                              <input type="radio" name="cash_transfer_program" id="cash_transfer_program_sim" value="1" class="cash_transfer_program">
                              <label for="cash_transfer_program_sim" class="pr-4">Sim</label>
                              <input type="radio" name="cash_transfer_program" id="cash_transfer_program_nao" value="0" class="cash_transfer_program">
                              <label for="cash_transfer_program_nao">Não</label>
                            </div>
                          </div>
                        </div>
                        <div class="row " id="input_federal_government_income" style="display: none;">
                          <div class="col-md-12 d-flex justify-content-center">
                            <div class="form-group">
                              <label for="federal_government_income">Renda do governo federal</label>
                              <input type="text" name="federal_government_income" value="" class="form-control venal col-md-12" id="federal_government_income">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <span class="text-dark d-flex justify-content-center">É proprietário(a) de imóvel urbano ou rural registrado em Cartório de Imóveis?</span>
                            <div class="form-group d-flex justify-content-center pt-2">
                              <input type="radio" name="property_owner_legal_person" id="sim" value="1">
                              <label for="sim" class="pr-4">Sim</label>
                              <input type="radio" name="property_owner_legal_person" id="nao" value="0">
                              <label for="nao">Não</label>
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
                                value="<?php echo set_value('name_spouse'); ?>">
                              <?php echo form_error('name_spouse'); ?>
                            </div>
                          </div>
                          <div class="col-md pr-md-1 pl-md-1">
                            <div class="form-group">
                              <label for="cpf">CPF</label>
                              <input type="text" name="cpf_spouse" id="cpf" class="form-control cpf"
                                value="<?php echo set_value('cpf_spouse'); ?>">
                              <?php echo form_error('cpf_spouse'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1 pr-md-1">
                            <div class="form-group">
                              <label for="rg_spouse">R.G</label>
                              <input type="text" name="rg_spouse" id="rg_spouse" class="form-control"
                                value="<?php echo set_value('rg_spouse'); ?>">
                              <?php echo form_error('rg_spouse'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="orgao_expedidor_spouse">Órgão Expedidor</label>
                              <input type="text" name="orgao_expedidor_spouse" id="orgao_expedido_spouser"
                                class="form-control" value="<?php echo set_value('orgao_expedidor_spouse'); ?>">
                              <?php echo form_error('orgao_expedidor_spouse'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="profession_spouse">Profissão</label>
                              <input type="text" name="profession_spouse" id="profession_spouse" class="form-control"
                                value="<?php echo set_value('profession_spouse'); ?>">
                              <?php echo form_error('profession_spouse'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1 pr-md-1">
                            <div class="form-group">
                              <label for="date_of_birth_spouse">Data de nascimento</label>
                              <input type="date" name="date_of_birth_spouse" id="date_of_birth_spouse"
                                class="form-control" value="<?php echo set_value('date_of_birth_spouse'); ?>">
                              <?php echo form_error('date_of_birth_spouse'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="sex_spouse">Sexo</label>
                              <select name="gender_spouse" class="form-control" id="gender_spouse">
                                <option value=""></option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                                <option value="O">Outros</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="nationality_spouse">Nacionalidade</label>
                              <select name="nationality_spouse" class="form-control" id="nationality_spouse">
                                <option value=""></option>
                                <option value="Brasileira">Brasileira</option>
                                <option value="Estrangeira">Estrangeira</option>
                              </select>
                            </div>
                          </div>
                          <!-- </div>
                        <div class="row"> -->

                          <div class="col-md px-md-1">
                            <div class="form-group">
                              <label for="mother_name_spouse">Nome da mãe</label>
                              <input type="text" name="mother_name_spouse" id="mother_name_spouse" class="form-control"
                                value="<?php echo set_value('mother_name_spouse'); ?>">
                              <?php echo form_error('mother_name_spouse'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="father_name_spouse">Nome do pai</label>
                              <input type="text" name="father_name_spouse" id="father_name_spouse" class="form-control"
                                value="<?php echo set_value('father_name_spouse'); ?>">
                              <?php echo form_error('father_name_spouse'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="schooling_spouse">Escolaridade</label>
                              <select name="schooling_spouse" class="form-control" id="schooling_spouse">
                                <option value=""></option>
                                <option value="Fundamental - Incompleto">Fundamental - Incompleto</option>
                                <option value="Fundamental - Completo">Fundamental - Completo</option>
                                <option value="Médio - Incompleto">Médio - Incompleto</option>
                                <option value="Médio - Completo">Médio - Completo</option>
                                <option value="Superior - Incompleto">Superior - Incompleto</option>
                                <option value="Superior - Completo">Superior - Completo</option>
                                <option value="Superior - Completo">Superior - Completo</option>
                                <option value="Pós-graduação - Incompleto">Pós-graduação - Incompleto</option>
                                <option value="Pós-graduação - Completo">Pós-graduação - Completo</option>
                              </select>
                            </div>
                          </div>
                          <!-- </div>
                        <div class="row"> -->
                          <div class="col-md px-md-1">
                            <div class="form-group">
                              <label for="email_spouse">E-mail</label>
                              <input type="email" name="email_spouse" id="email_spouse" class="form-control"
                                value="<?php echo set_value('email_spouse'); ?>">
                              <?php echo form_error('email_spouse'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="phone">Telefone</label>
                              <input type="text" name="tel_spouse" id="phone" class="form-control phone"
                                value="<?php echo set_value('tel_spouse'); ?>">
                              <?php echo form_error('tel_spouse'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md pr-md-1" id="status_civil_spouse">
                            <div class="form-group">
                              <label for="marital_status_spouse">Estado civil</label>
                              <select name="marital_status_spouse" class="form-control" id="marital_status_spouse">
                                <option value=""></option>
                                <option value="Casado(a)">Casado(a)</option>
                                <option value="Solteiro(a)">Solteiro(a)</option>
                                <option value="Separado(a)">Separado(a)</option>
                                <option value="Divorciado(a)">Divorciado(a)</option>
                                <option value="Viúvo(a)">Viúvo(a)</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md px-md-1" id="marriage_regime_spouse_div">
                            <div class="form-group">
                              <label for="marriage_regime_spouse">Regime de casamento/União Estável</label>
                              <select name="marriage_regime_spouse" class="form-control" id="marriage_regime_spouse">
                                <option value=""></option>
                                <option value="Comunhão Parcial de Bens">
                                  Comunhão Parcial de Bens
                                </option>
                                <option value="Comunhão Universal de Bens">
                                  Comunhão Universal de Bens
                                </option>
                                <option value="Separação de bens">
                                  Separação de bens
                                </option>
                                <option value="Separação convencional/Absoluta de bens">
                                  Separação convencional/Absoluta de bens
                                </option>
                                <option value="Participação final nos aquestos">
                                  Participação final nos aquestos
                                </option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md px-md-1">
                            <div class="form-group">
                              <label for="nis_spouse">N.I.S</label>
                              <input type="text" name="nis_spouse" value="" class="form-control" id="nis_spouse">
                            </div>
                          </div>
                          <div class="col-md pl-md-1" id="monthly_income_spouse_div">
                            <div class="form-group">
                              <label for="monthly_income_spouse">Renda mensal (R$)</label>
                              <input type="text" name="monthly_income_spouse" id="monthly_income_spouse"
                                class="form-control venal" value="<?php echo set_value('monthly_income_spouse'); ?>">
                              <?php echo form_error('monthly_income_spouse'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <span class="text-dark d-flex justify-content-center">O requerente participa de programa de transferência de renda do governo federal?</span>
                            <div class="form-group d-flex justify-content-center pt-2">
                              <input type="radio" name="cash_transfer_program_spouse" id="cash_transfer_program_spouse_sim" value="1" class="cash_transfer_program_spouse">
                              <label for="cash_transfer_program_spouse_sim" class="pr-4">Sim</label>
                              <input type="radio" name="cash_transfer_program_spouse" id="cash_transfer_program_spouse_nao" value="0" class="cash_transfer_program_spouse">
                              <label for="cash_transfer_program_spouse_nao">Não</label>
                            </div>
                          </div>
                        </div>
                        <div class="row " id="input_federal_government_income_spouse" style="display: none;">
                          <div class="col-md-12 d-flex justify-content-center">
                            <div class="form-group">
                              <label for="federal_government_income_spouse">Renda do governo federal</label>
                              <input type="text" name="federal_government_income_spouse" value="" class="form-control venal col-md-12" id="federal_government_income_spouse">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <span class="text-dark d-flex justify-content-center">É proprietário(a) de imóvel urbano ou rural registrado em Cartório de Imóveis?</span>
                            <div class="form-group d-flex justify-content-center pt-2">
                              <input type="radio" name="property_owner" id="sim" value="1">
                              <label for="sim" class="pr-4">Sim</label>
                              <input type="radio" name="property_owner" id="nao" value="0">
                              <label for="nao">Não</label>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="address_home" role="tabpanel" aria-labelledby="address-tab">
                        <div class="row mt-3">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="home_type_home">Tipo de logradouro</label>
                              <select class="form-control" name="home_type_home" id="home_type_home">
                                <option value=""></option>
                                <option value="Alameda">Alameda</option>
                                <option value="Avenida">Avenida</option>
                                <option value="Praça">Praça</option>
                                <option value="Rua">Rua</option>
                                <option value="Travessa">Travessa</option>
                                <option value="Via">Via</option>
                                <option value="Viela">Viela</option>
                                <option value="Fazenda/Comunidade Rural">Fazenda/Comunidade Rural</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4 px-md-1">
                            <div class="form-group">
                              <label for="home_address_home">Logradouro</label>
                              <input type="text" name="home_public_place" id="home_public_place" class="form-control"
                                value="<?php echo set_value('home_public_place'); ?>">
                              <?php echo form_error('home_public_place'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="home_number_home">Numero</label>
                              <input type="text" name="home_number_home" id="home_number_home" class="form-control"
                                value="<?php echo set_value('home_number_home'); ?>">
                              <?php echo form_error('home_number_home'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="home_complement_home">Complemento</label>
                              <input type="text" name="home_complement_home" id="home_complement_home"
                                class="form-control" value="<?php echo set_value('home_complement_home'); ?>">
                              <?php echo form_error('home_complement_home'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="home_neighborhood_home">Bairro</label>
                              <input type="text" name="home_neighborhood_home" id="home_neighborhood_home"
                                class="form-control" value="<?php echo set_value('home_neighborhood_home'); ?>">
                              <?php echo form_error('home_neighborhood_home'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="home_city_home">Cidade</label>
                              <input type="text" name="home_city_home" id="home_city_home" class="form-control"
                                value="<?php echo set_value('home_city_home'); ?>">
                              <?php echo form_error('home_city_home'); ?>
                            </div>
                          </div>
                          <div class="col-md px-md-1">
                            <div class="form-group">
                              <label for="home_cep_home">CEP</label>
                              <input type="text" name="home_cep_home" id="home_cep_home" class="form-control cep"
                                value="<?php echo set_value('home_cep_home'); ?>">
                              <?php echo form_error('home_cep_home'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="home_uf_home">UF</label>
                              <input type="text" name="home_uf_home" id="home_uf_home" class="form-control"
                                value="<?php echo set_value('home_uf_home'); ?>">
                              <?php echo form_error('home_uf_home'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md">
                            <div class="form-group">
                              <label for="home_country_home">País</label>
                              <input type="text" name="home_country_home" id="home_country_home" class="form-control"
                                value="<?php echo set_value('home_country_home'); ?>">
                              <?php echo form_error('home_country_home'); ?>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="checklist" role="tabpanel" aria-labelledby="address-tab">
                        <div class="row mt-3">
                          <div class="col-md-12">
                            <h6 class="d-inline text-dark">Concluir cadastro de dados e anexar documentos</h6>
                            <button type="submit" name="register_requesters" id="register_requesters"
                              class="btn btn-primary">Cadastrar</button>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="members-family" role="tabpanel"
                        aria-labelledby="members-family-tab">
                        <div class="row mt-3">
                          <div class="col-md-3 pr-md-1">
                            <div class="form-group">
                              <label for="name_members_family">Nome</label>
                              <input type="text" name="name_members_family[]" id="name_members_family"
                                class="form-control" value="<?php echo set_value('name_members-family'); ?>">
                              <?php echo form_error('name_members-family'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1 pr-md-1">
                            <div class="form-group">
                              <label for="rg_members_family">C.I / RG</label>
                              <input type="text" name="rg_members_family[]" id="rg" class="form-control"
                                value="<?php echo set_value('rg_members_family'); ?>">
                              <?php echo form_error('rg_members_family'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1 pr-md-1">
                            <div class="form-group">
                              <label for="cpf">CPF</label>
                              <input type="text" name="cpf_members_family[]" id="" class="form-control cpf"
                                value="<?php echo set_value('cpf_members_family'); ?>">
                              <?php echo form_error('cpf_members_family'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1 pr-md-1">
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
                                <option value="Outros">Outros</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md pr-md-1 pl-md-1">
                            <div class="form-group">
                              <label for="date_birth_family">Data de nascimento</label>
                              <input type="date" name="date_birth_family[]" id="date_birth_family" class="form-control"
                                value="<?php echo set_value('date_birth_family'); ?>">
                              <?php echo form_error('date_birth_family'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="monthly_income_members-family">Renda mensal (R$)</label>
                              <input type="text" name="monthly_income_members_family[]"
                                id="monthly_income_members_family" class="form-control venal"
                                value="<?php echo set_value('monthly_income_members_family'); ?>">
                              <?php echo form_error('monthly_income_members_family'); ?>
                            </div>
                          </div>
                        </div>

                        <div id="members_list"></div>

                        <div class="row">
                          <div class="col-md-12">
                            <input type='button'
                              class="btn btn-secondary float-md-right  float-sm-right  float-xs-right" id="add_member"
                              value="Novo membro">
                          </div>
                        </div>


                      </div>
                    </div>
                  </div>
                </div>
                <div class="row peopleJuridica" style="display:none;">
                  <div class="col-md-12">
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
                      <li class="nav-item">
                        <a class="nav-link" id="home-checklist-juridical-tab" data-toggle="tab" href="#checklist_juridical"
                          role="tab" aria-controls="checklist-juridical" aria-selected="false">Checklist</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent2">

                      <div class="tab-pane fade show active" id="juridical-person" role="tabpanel"
                        aria-labelledby="juridical-person-tab">
                        <div class="row mt-3">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="cnpj_juridical">CNPJ</label>
                              <input type="text" name="cnpj_juridical" id="cnpj_juridical" class="form-control cnpj"
                                value="<?php echo set_value('cnpj_juridical'); ?>">
                              <?php echo form_error('cnpj_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md pr-md-1 pl-md-1">
                            <div class="form-group">
                              <label for="corporate_name_juridical">Razão social</label>
                              <input type="text" name="corporate_name_juridical" id="corporate_name_juridical"
                                class="form-control" value="<?php echo set_value('corporate_name_juridical'); ?>">
                              <?php echo form_error('corporate_name_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="activity_branch_juridical">Ramo de atividade</label>
                              <input type="text" name="activity_branch_juridical" id="activity_branch_juridical"
                                class="form-control" value="<?php echo set_value('activity_branch_juridical'); ?>">
                              <?php echo form_error('activity_branch_juridical'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="type_street_juridical">Tipo de logradouro</label>
                              <select class="form-control" name="type_street_juridical" id="type_stree_juridical">
                                <option value=""></option>
                                <option value="Alameda">Alameda</option>
                                <option value="Avenida">Avenida</option>
                                <option value="Praça">Praça</option>
                                <option value="Rua">Rua</option>
                                <option value="Travessa">Travessa</option>
                                <option value="Via">Via</option>
                                <option value="Viela">Viela</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4 px-md-1">
                            <div class="form-group">
                              <label for="street_juridical">Logradouro</label>
                              <input type="text" name="street_juridical" id="street_juridical" class="form-control"
                                value="<?php echo set_value('street_juridical'); ?>">
                              <?php echo form_error('street_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="number_name_juridical">Numero</label>
                              <input type="text" name="number_name_juridical" id="number_name_juridical"
                                class="form-control" value="<?php echo set_value('number_name_juridical'); ?>">
                              <?php echo form_error('number_name_juridical'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="complement_juridical">Complemento</label>
                              <input type="text" name="complement_juridical" id="complemen_juridical"
                                class="form-control" value="<?php echo set_value('complement_juridical'); ?>">
                              <?php echo form_error('complement_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="neighborhood_juridical">Bairro</label>
                              <input type="text" name="neighborhood_juridical" id="neighborhood_juridical"
                                class="form-control" value="<?php echo set_value('neighborhood_juridical'); ?>">
                              <?php echo form_error('neighborhood_juridical'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="city_juridical">Cidade</label>
                              <input type="text" name="city_juridical" id="city_juridical" class="form-control"
                                value="<?php echo set_value('city_juridical'); ?>">
                              <?php echo form_error('city_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md px-md-1">
                            <div class="form-group">
                              <label for="cep_juridical">CEP</label>
                              <input type="text" name="cep_juridical" id="cep_juridical" class="form-control cep"
                                value="<?php echo set_value('cep_juridical'); ?>">
                              <?php echo form_error('cep_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="uf_juridical">UF</label>
                              <input type="text_juridical" name="uf_juridical" id="uf_juridical" class="form-control"
                                value="<?php echo set_value('uf_juridical'); ?>">
                              <?php echo form_error('uf_juridical'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="country_juridical">País</label>
                              <input type="text" name="country_juridical" id="country_juridical" class="form-control"
                                value="<?php echo set_value('country_juridical'); ?>">
                              <?php echo form_error('country_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="monthly_invoicing_juridical">Faturamento mensal</label>
                              <input type="text" name="monthly_invoicing_juridical" id="monthly_invoicing_juridical"
                                class="form-control venal" value="<?php echo set_value('monthly_invoicing_juridical'); ?>">
                              <?php echo form_error('monthly_invoicing_juridical'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <span class="text-dark d-flex justify-content-center">É proprietário(a) de imóvel urbano ou rural registrado em Cartório de Imóveis?</span>
                            <div class="form-group d-flex justify-content-center pt-2">
                              <input type="radio" name="property_owner_juridical" id="sim" value="1">
                              <label for="sim" class="pr-4">Sim</label>
                              <input type="radio" name="property_owner_juridical" id="nao" value="0">
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
                                class="form-control" value="<?php echo set_value('name_juridical_procurator'); ?>">
                              <?php echo form_error('name_juridical_procurator'); ?>
                            </div>
                          </div>
                          <div class="col-md pr-md-1 pl-md-1">
                            <div class="form-group">
                              <label for="cpf">CPF</label>
                              <input type="text" name="cpf_juridical_procurator" id="cpf" class="form-control cpf"
                                value="<?php echo set_value('cpf_juridical_procurator'); ?>">
                              <?php echo form_error('cpf_juridical_procurator'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1 pr-md-1">
                            <div class="form-group">
                              <label for="rg">R.G</label>
                              <input type="text" name="rg_juridical_procurator" id="rg_juridical_procurator"
                                class="form-control" value="<?php echo set_value('rg_juridical_procurator'); ?>">
                              <?php echo form_error('rg_juridical_procurator'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1 ">
                            <div class="form-group">
                              <label for="orgao_expedidor_juridical_procurator">Órgão Expedidor</label>
                              <input type="text" name="orgao_expedidor_juridical_procurator"
                                id="orgao_expedidor_juridical_procurator" class="form-control"
                                value="<?php echo set_value('orgao_expedidor_juridical_procurator'); ?>">
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
                                value="<?php echo set_value('profession_juridical_procurator'); ?>">
                              <?php echo form_error('profession_juridical_procurator'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1 pr-md-1">
                            <div class="form-group">
                              <label for="date_of_birth_juridical_procurator">Data de nascimento</label>
                              <input type="date" name="date_of_birth_juridical_procurator"
                                id="date_of_birth_juridical_procurator" class="form-control"
                                value="<?php echo set_value('date_of_birth_juridical_procurator'); ?>">
                              <?php echo form_error('date_of_birth_juridical_procurator'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="gender_juridical_procurator">Sexo</label>
                              <select class="form-control" name="gender_juridical_procurator"
                                id="gender_juridical_procurator">
                                <option value=""></option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                                <option value="O">Outros</option>
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
                                <option value=""></option>
                                <option value="Brasileira">Brasileira</option>
                                <option value="Estrangeira">Estrangeira</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md pr-md-1 pl-md-1">
                            <div class="form-group">
                              <label for="email_juridical_procurator">E-mail</label>
                              <input type="email_juridical_procurator" name="email_juridical_procurator"
                                id="email_juridical_procurator" class="form-control"
                                value="<?php echo set_value('email_juridical_procurator'); ?>">
                              <?php echo form_error('email_juridical_procurator'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="phone">Telefone</label>
                              <input type="text" name="tel_juridical_procurator" id="phone" class="form-control phone"
                                value="<?php echo set_value('tel_juridical_procurator'); ?>">
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
                                <option value="Alameda">Alameda</option>
                                <option value="Avenida">Avenida</option>
                                <option value="Praça">Praça</option>
                                <option value="Rua">Rua</option>
                                <option value="Travessa">Travessa</option>
                                <option value="Via">Via</option>
                                <option value="Fazenda/Comunidade Rural">Fazenda/Comunidade Rural</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6 px-md-1">
                            <div class="form-group">
                              <label for="home_address_juridical">Logradouro</label>
                              <input type="text" name="home_address_juridical" id="home_address_juridical"
                                class="form-control" value="<?php echo set_value('home_address_juridical'); ?>">
                              <?php echo form_error('home_address_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="home_number_juridical">Número</label>
                              <input type="text" name="home_number_juridical" id="home_number_juridical"
                                class="form-control" value="<?php echo set_value('home_number_juridical'); ?>">
                              <?php echo form_error('home_number_juridical'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="home_complement_juridical">Complemento</label>
                              <input type="text" name="home_complement_juridical" id="home_complement_juridical"
                                class="form-control" value="<?php echo set_value('home_complement_juridical'); ?>">
                              <?php echo form_error('home_complement_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="home_neighborhood_juridical">Bairro</label>
                              <input type="text" name="home_neighborhood_juridical" id="home_neighborhood_juridical"
                                class="form-control" value="<?php echo set_value('home_neighborhood_juridical'); ?>">
                              <?php echo form_error('home_neighborhood_juridical'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="home_city_juridical">Cidade</label>
                              <input type="text" name="home_city_juridical" id="home_city_juridical"
                                class="form-control" value="<?php echo set_value('home_city_juridical'); ?>">
                              <?php echo form_error('home_city_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md px-md-1">
                            <div class="form-group">
                              <label for="home_cep_juridical">CEP</label>
                              <input type="text" name="home_cep_juridical" id="home_cep_juridical" class="form-control cep"
                                value="<?php echo set_value('home_cep_juridical'); ?>">
                              <?php echo form_error('home_cep_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="uf_address_juridical">UF</label>
                              <input type="text" name="home_uf_juridical" id="home_uf_juridical" class="form-control"
                                value="<?php echo set_value('home_uf_juridical'); ?>">
                              <?php echo form_error('home_uf_juridical'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md">
                            <div class="form-group">
                              <label for="home_country_juridical">País</label>
                              <input type="text" name="home_country_juridical" id="home_country_juridical"
                                class="form-control" value="<?php echo set_value('home_country_juridical'); ?>">
                              <?php echo form_error('home_country_juridical'); ?>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="checklist_juridical" role="tabpanel" aria-labelledby="checklist_juridical-tab">
                        <div class="row mt-3">
                          <div class="col-md-12">
                            <h6 class="d-inline text-dark">Concluir cadastro de dados e anexar documentos</h6>
                            <button type="submit" name="register_requesters" id="register_requesters"
                              class="btn btn-primary">Cadastrar</button>
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
    </div>
  </div>
</div>
<?php $this->load->view('elements/footer');?>
<script>
  // !! inputCEP,logradouro(ou endereço),complemento,bairro,cidade,uf
  // falta ttrocar ids
  let inputCEP1 = document.querySelector('#realty_cep_home')
  inputCEP1.addEventListener('input', () => {
    pegarCPF(inputCEP1, '#realty_address_home', '#realty_complement_home', '#realty_neighborhood_home',
      '#realty_city_home', '#realty_uf_home', )
  })
  let inputCEP2 = document.querySelector('#cep_juridical')
  inputCEP2.addEventListener('input', () => {
    pegarCPF(inputCEP2, '#street_juridical', '#complement_juridical', '#neighborhood_juridical', '#city_juridical',
      '#uf_juridical', )
  })
</script>
