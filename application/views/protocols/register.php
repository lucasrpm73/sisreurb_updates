<?php $this->load->view('elements/header');?>
<style>
  .text-danger{
    display: none;
  }
</style>
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
    <form action="<?php echo base_url(); ?>protocols/register_requirement/" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <a href="<?php echo base_url()?>protocols" class="btn btn-round btn-secundary float-right">Voltar</a>
              <button type="submit" name="register_protocols" id=""
                class="btn btn-primary btn-round float-md-right float-sm-right float-xs-right register_protocols">Cadastrar</button>
              <h4 class="card-title">Cadastro de protocolos</h4>
              <input type="hidden" name="id_requester" id="id_requester">
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
              <div id="pesquisarCadastroRequerimentos" class="row justify-content-center align-items-center">
                <div class="col-md-6 col-sm-12 span_cpf">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Informe o CPF" id="cpf"
                      aria-label="Recipiente para nickname" aria-describedby="basic-addon2">
                    <div class="input-group-append" id="btnProsseguirCPF">
                      <span class="input-group-text bg-primary text-white ">
                        <i class="fas fa-search ml-2 mx-1"></i>
                        Prosseguir
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6 alert_cpf_number" style="color: red; display: none;">
                    <p class="">CPF não encontrado!!</p>
                  </div>
                  <div class="col-md-12 alert_off alert alert-warning " style="display: none;">
                    <span class="text-requester font-weight-bold" >Requerente Desativado!</span>
                    <a href="#" class="btn btn-sm" id="name_requester"></a>
                  </div>
                </div>
              </div>
              <div id="pesquisarCadastroRequerimentosJuridico" class="row justify-content-center align-items-center"
                style="display: none;">
                <div class="col-md-6 col-sm-12 ">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Informe o CNPJ" id="cnpj"
                      aria-label="Recipiente para nickname" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <span class="input-group-text bg-primary text-white span_cnpj" id="span_cnpj">
                        <i class="fas fa-search ml-2 mx-1"></i>
                        Prosseguir
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6 alert_cpf_number" style="color: red; display: none;">
                    <p class="">CNPJ não encontrado!!</p>
                  </div>
                </div>
              </div>
              <div class="conteudoCadastroRequirements" style="display:none">
                <div class="row peopleFisica" class="conteudo">
                  <div class="col-md-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="personal-tab" data-toggle="tab" href="#personal" role="tab"
                          aria-controls="personal" aria-selected="true">Dados</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="tenants-tab" data-toggle="tab" href="#tenants_legal_tab" role="tab"
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
                        <a class="nav-link" id="home-checklist-tab" data-toggle="tab" href="#checklist"
                          role="tab" aria-controls="checklist" aria-selected="false">Checklist</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="personal" role="tabpanel"
                        aria-labelledby="personal-tab">
                        <div class="row mt-3">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="procedure">Procedimento</label>
                              <select type="text" name="protocol_procedure" id="procedure" class="form-control procedure_fisico" required>
                                <option value=""></option>
                                <?php foreach ($process_numbers as $row): ?>
                                  <?php if ($row->status == '1'): ?>
                                    <option value="<?php echo $row->id; ?>"><?php echo $row->process_number ?>.<?php echo $row->stage ?> / <?php echo $row->core_name ?></option>
                                    <?php else: ?>
                                      <option value="<?php echo $row->id; ?>" class="text-primary" disabled><?php echo $row->process_number ?>.<?php echo $row->stage ?> / <?php echo $row->core_name ?> - Desativado</option>
                                  <?php endif; ?>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row ">
                          <div class="col-md-6 pr-md-1">
                            <div class="form-group">
                              <label for="cpf_personal">CPF</label>
                              <input type="text" name="cpf_personal" id="cpf_personal" class="form-control"
                                value="<?php echo set_value('cpf_personal'); ?>" readonly>
                              <?php echo form_error('cpf_personal'); ?>
                            </div>
                          </div>
                          <div class="col-md-6 pl-md-1">
                            <div class="form-group">
                              <label for="name_personal">Nome</label>
                              <input type="text" name="name_personal" id="name_personal" class="form-control" value="" readonly>
                              <?php echo form_error('name_personal'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 pr-md-1">
                            <div class="form-group">
                              <label for="phone_personal">Telefone</label>
                              <input type="text" name="phone_personal" id="phone_personal" class="form-control"
                                value="<?php echo set_value('phone_personal'); ?>" readonly>
                              <?php echo form_error('phone_personal'); ?>
                            </div>
                          </div>
                          <div class="col-md-6 pl-md-1">
                            <div class="form-group">
                              <label for="email_personal">Email</label>
                              <input type="text" name="email_personal" id="email_personal" class="form-control"
                                value="<?php echo set_value('email_personal'); ?>" readonly>
                              <?php echo form_error('email_personal'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4 pr-md-1">
                            <div class="form-group">
                              <label for="profission_personal">Profissão</label>
                              <input type="text" name="profission_personal" id="profission_personal"
                                class="form-control" value="<?php echo set_value('profission_personal'); ?>" readonly>
                              <?php echo form_error('profission_personal'); ?>
                            </div>
                          </div>
                          <div class="col-md-4 px-md-1">
                            <div class="form-group">
                              <label for="birth_date_personal">Data de nascimento</label>
                              <input type="date" name="birth_date_personal" id="birth_date_personal"
                                class="form-control" value="<?php echo set_value('birth_date_personal'); ?>" readonly>
                              <?php echo form_error('birth_date_personal'); ?>
                            </div>
                          </div>
                          <div class="col-md-4 pl-md-1">
                            <div class="form-group">
                              <label for="civil_status">Estado civil</label>
                              <input type="text" name="civil_status"  id="civil_status"  class="form-control" value="" readonly>
                            </div>
                          </div>
                        </div>

                      </div>

                      <div class="tab-pane py-2" id="tenants_legal_tab" role="tabpanel" aria-labelledby="tenants-tab">
                        <div class="row">
                          <div class="col-md-12">
                            <a class="btn btn-primary btn-round float-md-right float-sm-right float-xs-right"
                              data-toggle="modal" data-target="#tenants_detail_legal"><i
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
                                  <th scope="col">Perfil</th>
                                  <th scope="col">E-mail</th>
                                  <th scope="col">É proprietário(a) de imóvel?</th>
                                  <th scope="col"></th>
                                </tr>
                              </thead>
                              <tbody id="tenants_list">
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane" id="realty_home" role="tabpanel" aria-labelledby="realty-home-tab">
                        <div class="row mt-3">
                          <div class="col-md-2 pr-md-1">
                            <div class="form-group">
                              <label for="real_state_home">Inscrição Imobiliária Municipal</label>
                              <input type="text" name="real_state_home" id="real_state_home" class="form-control"
                                value="<?php echo set_value('real_state_home'); ?>">
                                <span class="text-danger" id="span_real_state_home" >Campo obrigatório</span>
                              <?php echo form_error('real_state_home'); ?>
                            </div>
                          </div>
                          <div class="col-md-2 py-3 px-md-1">
                            <div class="form-group">
                              <label for="sector">Setor</label>
                              <input type="text" name="sector" id="sector" class="form-control" value="<?php echo set_value('sector'); ?>">
                              <span class="text-danger" id="span_sector">Campo obrigatório</span>
                            </div>
                          </div>
                          <div class="col-md-2 py-3 px-md-1">
                            <div class="form-group">
                              <label for="city_block">Quadra</label>
                              <input type="text" name="city_block" id="city_block" class="form-control" value="<?php echo set_value('city_block'); ?>">
                              <span class="text-danger" id="span_city_block">Campo obrigatório</span>
                            </div>
                          </div>
                          <div class="col-md-2 py-3 px-md-1">
                            <div class="form-group">
                              <label for="allotment">Lote</label>
                              <input type="text" name="allotment" id="allotment" class="form-control" value="<?php echo set_value('allotment'); ?>">
                              <span class="text-danger" id="span_allotment">Campo obrigatório</span>
                            </div>
                          </div>
                          <div class="col-md-1 py-3 px-md-1">
                            <div class="form-group">
                              <label for="sub_lot">Sub lote</label>
                              <input type="text" name="sub_lot" id="sub_lot" class="form-control" value="">
                            </div>
                          </div>
                            <div class="col-md-3 pl-1">
                                <div class="form-group">
                                    <label for="property_registration_number">Matrícula do imóvel aberta pelo Procedimento de REURB:</label>
                                    <input type="text" name="property_registration_number" id="property_registration_number"
                                           class="form-control" value="<?php echo set_value('property_registration_number'); ?>">
                                           <span class="text-danger" id="span_property_registration_number">Campo obrigatório</span>
                                    <?php echo form_error('property_registration_number'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4 pr-md-1">
                            <div class="form-group">
                              <label for="realty_type_home">Tipo de Logradouro</label>
                              <select class="custom-select" id="realty_type_home" name="realty_type_home" value= "<?php echo set_value('realty_type_home'); ?>">
                                <option value=""></option>
                                <option value="Alameda">Alameda</option>
                                <option value="Avenida">Avenida</option>
                                <option value="Praça">Praça</option>
                                <option value="Rua">Rua</option>
                                <option value="Travessa">Travessa</option>
                                <option value="Via">Via</option>
                                <option value="Viela">Viela</option>
                              </select>
                              <span class="text-danger" id="span_realty_type_home">Campo obrigatório</span>
                              <?php echo form_error('realty_type_home'); ?>
                            </div>
                          </div>
                          <div class="col-md-4 px-md-1">
                            <div class="form-group">
                              <label for="realty_address_home">Logradouro</label>
                              <input type="text" name="realty_address_home" id="realty_address_home"
                                class="form-control" value="<?php echo set_value('realty_address_home'); ?>">
                                <span class="text-danger" id="span_realty_address_home">Campo obrigatório</span>
                              <?php echo form_error('realty_address_home'); ?>
                            </div>
                          </div>
                          <div class="col-md-4 pl-md-1">
                            <div class="form-group">
                              <label for="realty_number_home">Numero</label>
                              <input type="text" name="realty_number_home" id="realty_number_home" class="form-control"
                                value="<?php echo set_value('realty_number_home'); ?>">
                                <span class="text-danger" id="span_realty_number_home">Campo obrigatório</span>
                              <?php echo form_error('realty_number_home'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 pr-md-1">
                            <div class="form-group">
                              <label for="realty_complement_home">Complemento</label>
                              <input type="text" name="realty_complement_home" id="realty_complement_home"
                                class="form-control" value="<?php echo set_value('realty_complement_home'); ?>">
                              <?php echo form_error('realty_complement_home'); ?>
                            </div>
                          </div>
                          <div class="col-md-6 pl-md-1">
                            <div class="form-group">
                              <label for="realty_neighborhood_home">Bairro</label>
                              <input type="text" name="realty_neighborhood_home" id="realty_neighborhood_home"
                                class="form-control" value="<?php echo set_value('realty_neighborhood_home'); ?>">
                                <span class="text-danger" id="span_realty_neighborhood_home">Campo obrigatório</span>
                              <?php echo form_error('realty_neighborhood_home'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4 pr-md-1">
                            <div class="form-group">
                              <label for="realty_city_home">Cidade</label>
                              <input type="text" name="realty_city_home" id="realty_city_home" class="form-control"
                              value="<?php echo set_value('realty_city_home'); ?>">
                              <?php echo form_error('realty_city_home'); ?>
                            </div>
                          </div>
                          <div class="col-md-4 px-md-1">
                            <div class="form-group">
                              <label for="realty_cep_home">CEP</label>
                              <input type="text" name="realty_cep_home" id="realty_cep_home" class="form-control cep"
                                value="<?php echo set_value('realty_cep_home'); ?>">
                              <?php echo form_error('realty_cep_home'); ?>
                            </div>
                          </div>
                          <div class="col-md-4 pl-md-1">
                            <div class="form-group">
                              <label for="realty_uf_home">UF</label>
                              <input type="text" name="realty_uf_home" id="realty_uf_home" class="form-control"
                              value="<?php echo set_value('realty_uf_home'); ?>">
                              <?php echo form_error('realty_uf_home'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md">
                            <div class="form-group">
                              <label for="realty_country_home">País</label>
                              <input type="text" name="realty_country_home" id="realty_country_home"
                                class="form-control" value="<?php echo set_value('realty_country_home'); ?>">
                              <?php echo form_error('realty_country_home'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="realty_address_posses_home">Data início da Posse / Ocupação</label>
                              <input type="date" name="realty_address_posses_home" id="realty_address_posses_home"
                                class="form-control" value="<?php echo set_value('realty_address_posses_home'); ?>">
                              <?php echo form_error('realty_address_posses_home'); ?>
                            </div>
                          </div>
                          <div class="col-md px-md-1">
                            <div class="form-group">
                              <label for="required_terrain_area_home pr-md-1">Área requerida do imóvel - m<sup>2</sup></label>
                              <input type="text" name="required_terrain_area_home" id="required_terrain_area_home"
                                class="form-control venal" value="<?php echo set_value('required_terrain_area_home'); ?>">
                              <?php echo form_error('required_terrain_area_home'); ?>
                            </div>
                          </div>
                          <div class="col-md px-md-1">
                            <div class="form-group">
                              <label for="georeferenced_property_area pr-md-1">Área do imóvel georreferenciada - m<sup>2</sup></label>
                              <input type="text" name="georeferenced_property_area" id="georeferenced_property_area"
                                class="form-control venal" value="<?php echo set_value('georeferenced_property_area'); ?>">
                                <span class="text-danger" id="span_georeferenced_property_area">Campo obrigatório</span>
                              <?php echo form_error('georeferenced_property_area'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="required_edificated_area_home">Área edificada - m<sup>2</sup></label>
                              <input type="text" name="required_edificated_area_home" id="required_edificated_area_home"
                                class="form-control venal" value="<?php echo set_value(''); ?>">
                              <?php echo form_error('required_edificated_area_home'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 pr-md-1">
                            <div class="form-group">
                              <label for="">Características da construção</label>
                              <input type="text" name="construction_features_home" id="construction_features_home"
                                class="form-control" value="<?php echo set_value('construction_features_home'); ?>">
                              <?php echo form_error('construction_features_home'); ?>
                            </div>
                          </div>
                          <div class="col-md-6 px-md-1">
                            <div class="form-group">
                              <label for="venal">Valor venal (avaliação no cadastro imobiliário Municipal)R$</label>
                              <input type="text" name="venal" id="venal" class="form-control venal"
                                value="<?php echo set_value('venal'); ?>">
                                <span class="text-danger" id="span_venal">Campo obrigatório</span>
                              <?php echo form_error('venal'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 pr-md-1">
                            <div class="form-group">
                              <label for="possession_origin">Origem da Posse</label>
                              <select class="form-control" name="possession_origin" id="possession_origin">
                                <option value=""></option>
                                <option value="Contrato/Recibo de Compra e Venda">Contrato/Recibo de Compra e Venda</option>
                                <option value="Doação">Doação</option>
                                <option value="Herança">Herança</option>
                                <option value="Declaração de Posse">Declaração de Posse</option>
                                <option value="Posse a Justo Título">Posse a Justo Título</option>
                                <option value="Posse por Simples Ocupação">Posse por Simples Ocupação</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6 pl-md-1">
                            <div class="form-group">
                              <label for="slab_right">Direito de Laje</label>
                              <select class="form-control" name="slab_right" value= "<?php echo set_value('slab_right'); ?>" >
                                <option value=""></option>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                              </select>
                              <span class="text-danger" id="span_slab_right">Campo obrigatório</span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="infrastructure_select_home">Infraestrutura básica</label>
                              <select name="infrastructure_select_home" class="form-control"
                                id="infrastructure_select_home">
                                <option value=""></option>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="potable_water_select_home">Água potável</label>
                              <select name="potable_water_select_home" class="form-control"
                                id="potable_water_select_home">
                                <option value=""></option>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
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
                                <option value=""></option>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md px-md-1">
                            <div class="form-group">
                              <label for="sewage_select_home">Esgotamento Sanitário</label>
                              <select name="sewage_select_home" class="form-control" id="sewage_select_home">
                                <option value=""></option>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6 pl-md-1">
                            <div class="form-group">
                              <label for="type_sewer">Tipo de esgoto</label>
                              <select name="type_sewer" class="form-control" id="type_sewer">
                                <option value=""></option>
                                <option value="Rede Pública">Rede Pública</option>
                                <option value="Fossa séptica">Fossa séptica</option>
                                <option value="Outro">Outro</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 pr-md-1">
                            <div class="form-group">
                              <label for="type_property">Tipo de imóvel:</label>
                              <select class="form-control" name="type_property" id="type_property" value="<?php echo set_value('type_property'); ?>">
                                <option value=""></option>
                                <option value="Residencial">Residencial</option>
                                <option value="Comercial">Comercial</option>
                                <option value="Misto Residencial/Comercial">Misto Residencial/Comercial</option>
                              </select>
                              <span class="text-danger" id="span_type_property">Campo obrigatório</span>
                            </div>
                          </div>
                          <div class="col-md-6 pl-md-1">
                            <div class="form-group">
                              <label for="unit_situation">Situação da unidade:</label>
                              <select class="form-control" name="unit_situation" id="unit_situation">
                                <option value=""></option>
                                <option value="Construída">Construída</option>
                                <option value="Em construção">Em construção</option>
                                <option value="Lote Vago">Lote Vago</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="paviment_select_home">Rua pavimentada</label>
                              <select name="paviment_select_home" class="form-control" id="paviment_select_home">
                                <option value=""></option>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md px-md-1">
                            <div class="form-group">
                              <label for="paviment_type_select_home">Tipo de pavimentação</label>
                              <select name="paviment_type_select_home" class="form-control"
                                id="paviment_type_select_home">
                                <option value=""></option>
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
                                <option value=""></option>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="register_date_home">Data cadastro</label>
                              <input type="date" name="register_date_home" id="register_date_home" class="form-control"
                                value="<?php echo set_value('register_date_home'); ?>">
                              <?php echo form_error('register_date_home'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row pt-2">
                          <div class="col-md-12">
                            <input type="checkbox" name="spouse_co_owner" id="spouse_co_owner" value="1">
                            <label for="spouse_co_owner">O Conjugê ou Companheiro(a) não é co-proprietário. Foi
apresentado anuência expressa.</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h4 class="text-dark">Confrontantes</h4>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2">
                            <div class="form-group">
                              <label for="cpf_confrontants">Cpf</label>
                              <input type="text" name="cpf_confrontants[]" id="cpf_confrontants" class="form-control cpf cpf_confrontants"
                                data-id_name="name_confrontants_0" data-id_nascimento="birth_date_confrontants_0"
                                value="<?php echo set_value('cpf_confrontants'); ?>">
                              <?php echo form_error('cpf_confrontants'); ?>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="name_confrontants">Nome</label>
                              <input type="text" name="name_confrontants[]" id="name_confrontants_0" class="form-control"
                                value="<?php echo set_value('name_confrontants'); ?>">
                              <?php echo form_error('name_confrontants'); ?>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="birth_date_confrontants">Data nacimento</label>
                              <input type="date" name="birth_date_confrontants[]" id="birth_date_confrontants_0" class="form-control"
                                value="<?php echo set_value('birth_date_confrontants'); ?>">
                              <?php echo form_error('birth_date_confrontants'); ?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="confrontation_direction">Confrontação</label>
                              <select class="form-control" name="confrontation_direction[]">
                                <option value=""></option>
                                <option value="Lado esquerdo">Lado esquerdo</option>
                                <option value="Lado direito">Lado direito</option>
                                <option value="Fundos">Fundos</option>
                              </select>
                              <span class="text-dark">*Descrever as confrontações de dentro do móvel olhando para rua</span>
                            </div>
                          </div>
                        </div>
                        <div id="list_confrotants"></div>
                        <div class="row">
                          <div class="col-md-2">
                            <button type="button" name="button" class="btn btn-primary" id="add_confrotants">+ Adicionar</button>
                          </div>
                        </div>
                        <!-- <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="user_register_home">Usuário que efetuou cadastro</label>
                            <input type="text" name="user_register_home" id="user_register_home" class="form-control"
                              value value="<?php echo set_value('register_date_home'); ?>">
                            <?php echo form_error('register_date_home'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="switch_home">Alterações</label>
                            <input type="date" name="user_register_home" id="user_register_home" class="form-control"
                              value value="<?php echo set_value('register_date_home'); ?>">
                            <?php echo form_error('register_date_home'); ?>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md pr-md-1">
                          <div class="form-group">
                            <label for="user_switch_home">Usuário que efetuou alteração</label>
                            <input type="text" name="user_switch_home" id="user_switch_home" class="form-control" value
                              value="<?php echo set_value('user_switch_home'); ?>">
                            <?php echo form_error('user_switch_home'); ?>
                          </div>
                        </div>
                        <div class="col-md pl-md-1">
                          <div class="form-group">
                            <label for="observation_home">Observações</label>
                            <input type="text" name="observation_home" id="observation_home" class="form-control" value
                              value="<?php echo set_value('observation_home'); ?>">
                            <?php echo form_error('observation_home'); ?>
                          </div>
                        </div>
                      </div> -->
                      </div>
                      <div class="tab-pane" id="enquadramento_reurb" role="tabpanel"
                        aria-labelledby="enquadramento_reurb-tab">
                        <div class="row mt-2 mb-2">
                          <div class="col-md-5 text-dark">
                              <span>Renda Total (membros da familia/condôminos): <p class="text-primary" id="monthly_income_total"></p></span>
                          </div>
                          <div class="col-md-7 text-dark">
                            <span>É proprietário(a) de imóvel urbano ou rural registrado em Cartório de Imóveis? <p class="text-primary" id="proprietario_imovel"></p></span>
                          </div>
                        </div>
                        <div class="row text-dark">
                          <div class="col-md-12">
                            <label for="criteria_established_law">De acordo com os critérios acima estabelecidos pela lei Federal nº 13.465/2017 e Decreto 9.310/18,
                              e legislação Municipal vigente, o requerente enquadra-se na modalidade de: </label><br>
                              <input type="text" class="text-primary" name="reurb" id="reurb" value="" readonly style="border: none;">
                          </div>
                          <input type="hidden" name="maximum_family_income" value="" id="maximum_family_income">
                        </div>
                      </div>

                    <div class="tab-pane fade" id="checklist" role="tabpanel" aria-labelledby="address-tab">
                      <div class="row mt-2">
                        <div class="col-md-12">
                          <h6 class="d-inline text-dark">Concluir cadastro de dados e anexar documentos</h6>
                          <button type="submit" name="register_protocols" id=""
                            class="btn btn-primary register_protocols">Cadastrar</button>
                        </div>
                      </div>
                      <div class="append_id_documents"></div>
                    </div>

                      <!-- <div class="tab-pane fade" id="checklist" role="tabpanel" aria-labelledby="address-tab">
                        <div class="row mt-3">
                          <div class="col-md-12">
                            <div class="list-group text-dark">
                              <div class="list-group-item d-inline align-items-center py-1 mb-1 ">
                                <span>Documento de aquisição do imóvel</span>
                                <a href="#" class="btn btn-sm btn-primary float-right" id="download_aquisicao" download="documento_aquisicao_imovel" style="display: none;">Baixar</a>
                                <button type="button" name="button" class="btn btn-sm btn-primary float-right img_aquisicao">
                                  enviar/upload +
                                </button>
                                <input type="file" name="file_aquisicao" id="pic_img_aquisicao" value="" style="display: none;">
                                <span class="d-flex align-items-center float-right text-primary mr-3 mt-2" id="name_aquisicao"></span>
                                <img src="" alt="" id="img_aquisicao" style="display: none;">
                              </div>
                              <div class="list-group-item  d-inline justify-content-between align-items-center py-1 mb-1 ">
                                <span>Guia de IPTU</span>
                                <a href="#" class="btn btn-sm btn-primary float-right" id="download_iptu" download="guia_iptu" style="display: none;">Baixar</a>
                                <button type="button" name="button" class="btn btn-sm btn-primary float-right img_iptu">enviar/upload +</button>
                                <input type="file" name="file_iptu" id="pic_img_iptu" value="" style="display: none;">
                                <span class="d-flex align-items-center float-right text-primary mr-3 mt-2" id="name_iptu"></span>
                                <img src="" alt="" id="img_iptu" style="display: none;">
                              </div>
                              <div class="list-group-item  d-inline justify-content-between align-items-center py-1 mb-1 ">
                                <span>Declaração de Confrontante</span>
                                <a href="#" class="btn btn-sm btn-primary float-right" id="download_confrotante" download="declaracao_confrontante" style="display: none;">Baixar</a>
                                <button type="button" name="button" class="btn btn-sm btn-primary float-right img_confrotante">enviar/upload +</button>
                                <input type="file" name="file_confrotante" id="pic_img_confrotante" value="" style="display: none;">
                                <span class="d-flex align-items-center float-right text-primary mr-3 mt-2" id="name_confrotante"></span>
                                <img src="" alt="" id="img_confrotante" style="display: none;">
                              </div>
                              <div class="list-group-item  d-inline justify-content-between align-items-center py-1 mb-1 ">
                                <span>Planta Topográfica</span>
                                <a href="#" class="btn btn-sm btn-primary float-right" id="download_topografica" download="planta_topografica" style="display: none;">Baixar</a>
                                <button type="button" name="button" class="btn btn-sm btn-primary float-right img_topografica">enviar/upload +</button>
                                <input type="file" name="file_topografica" id="pic_img_topografica" value="" style="display: none;">
                                <span class="d-flex align-items-center float-right text-primary mr-3 mt-2" id="name_topografica"></span>
                                <img src="" alt="" id="img_topografica" style="display: none;">
                              </div>
                              <div class="list-group-item  d-inline justify-content-between align-items-center py-1 mb-1 ">
                                <span>Memorial Descritivo</span>
                                <a href="#" class="btn btn-sm btn-primary float-right" id="download_memorial" download="memorial_descritivo" style="display: none;">Baixar</a>
                                <button type="button" name="button" class="btn btn-sm btn-primary float-right img_memorial">enviar/upload +</button>
                                <input type="file" name="file_memorial" id="pic_img_memorial" value="" style="display: none;">
                                <span class="d-flex align-items-center float-right text-primary mr-3 mt-2" id="name_memorial"></span>
                                <img src="" alt="" id="img_memorial" style="display: none;">
                              </div>
                              <div class="list-group-item  d-inline justify-content-between align-items-center py-1 mb-1 ">
                                <span>Foto Frontal</span>
                                <a href="#" class="btn btn-sm btn-primary float-right" id="download_frontal" download="foto_frontal" style="display: none;">Baixar</a>
                                <button type="button" name="button" class="btn btn-sm btn-primary float-right img_frontal">enviar/upload +</button>
                                <input type="file" name="file_frontal" id="pic_img_frontal" value="" style="display: none;">
                                <span class="d-flex align-items-center float-right text-primary mr-3 mt-2" id="name_frontal"></span>
                                <img src="" alt="" id="img_frontal" style="display: none;">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> -->
                    </div>
                  </div>
                </div>


                <!--************************
                      Pessoa Juridica
               *************************-->
                <div class="row peopleJuridica" style="display: none;">
                  <div class="col-md-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="juridical-person-tab" data-toggle="tab" href="#juridical-person"
                          role="tab" aria-controls="juridical" aria-selected="true">Juridica</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="tenants_tab" data-toggle="tab" href="#tenants_juridical_tab"
                          role="tab" aria-controls="realty-juridical" aria-selected="false">Condöminos</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="realty-juridical-tab" data-toggle="tab" href="#realtys-juridical"
                          role="tab" aria-controls="realty-juridical" aria-selected="false">Dados do imóvel</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="realty-juridical-tab" data-toggle="tab" href="#enquadramento_reurb_juridical"
                          role="tab" aria-controls="realty-juridical" aria-selected="false">Enquadramento na REURB</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="home-checklist-juridical-tab" data-toggle="tab" href="#checklist_juridical"
                          role="tab" aria-controls="checklist-juridical" aria-selected="false">Checklist</a>
                      </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                      <div class=" tab-pane fade show active" id="juridical-person" role="tabpanel"
                        aria-labelledby="juridical-person-tab">
                        <div class="row pt-3">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="procedure">Procedimento</label>
                              <select type="text" name="protocol_procedure_juridical" id="procedure"
                                class="form-control procedure_juridico">
                                <option value=""></option>
                                <?php foreach ($process_numbers as $row): ?>
                                <option value="<?php echo $row->id; ?>"><?php echo $row->process_number ?>.<?php echo $row->stage ?> / <?php echo $row->core_name ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4 pr-md-1">
                            <div class="form-group">
                              <label for="cnpj_juridical">CNPJ</label>
                              <input type="text" name="cnpj_juridical" id="cnpj_juridical" class="form-control cnpj"
                                value="<?php echo set_value('cnpj_juridical'); ?>" readonly>
                              <?php echo form_error('cnpj_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md-4 px-md-1">
                            <div class="form-group">
                              <label for="corporate_name_juridical">Razão social</label>
                              <input type="text" name="corporate_name_juridical" id="corporate_name_juridical"
                                class="form-control" value="<?php echo set_value('corporate_name_juridical'); ?>" readonly>
                              <?php echo form_error('corporate_name_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md-4 pl-md-1">
                            <div class="form-group">
                              <label for="activity_branch_juridical">Ramo de atividade</label>
                              <input type="text" name="activity_branch_juridical" id="activity_branch_juridical"
                                class="form-control" value="<?php echo set_value('activity_branch_juridical'); ?>" readonly>
                              <?php echo form_error('activity_branch_juridical'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4 pr-md-1">
                            <div class="form-group">
                              <label for="type_street_juridical">Tipo de logradouro</label>
                              <select class="custom-select" id="type_street_juridical" name="type_street_juridical" readonly="">
                                <option value=""></option>
                                <option value="Alameda">Alameda</option>
                                <option value="Avenida">Avenida</option>
                                <option value="Praça">Praça</option>
                                <option value="Rua">Rua</option>
                                <option value="Travessa">Travessa</option>
                                <option value="Via">Via</option>
                                <option value="Viela">Viela</option>
                              </select>
                              <?php echo form_error('type_street_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md-4 px-md-1">
                            <div class="form-group">
                              <label for="street_juridical">Logradouro</label>
                              <input type="text" name="street_juridical" id="street_juridical" class="form-control"
                                value="<?php echo set_value('street_juridical'); ?>" readonly>
                                <span class="text-danger" id="street_juridical">Campo obrigatório</span>
                              <?php echo form_error('street_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md-4 pl-md-1">
                            <div class="form-group">
                              <label for="number_name_juridical">Numero</label>
                              <input type="text" name="number_name_juridical" id="number_name_juridical"
                              class="form-control" value="<?php echo set_value('number_name_juridical'); ?>" readonly="">
                              <span class="text-danger" id="number_name_juridical">Campo obrigatório</span>
                              <?php echo form_error('number_name_juridical'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 pr-md-1">
                            <div class="form-group">
                              <label for="complement_juridical">Complemento</label>
                              <input type="text" name="complement_juridical" id="complement_juridical"
                                class="form-control" value="<?php echo set_value('complement_juridical'); ?>" readonly>
                              <?php echo form_error('complement_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md-6 pl-md-1">
                            <div class="form-group">
                              <label for="neighborhood_juridical">Bairro</label>
                              <input type="text" name="neighborhood_juridical" id="neighborhood_juridical"
                                class="form-control" value="<?php echo set_value('neighborhood_juridical'); ?>">
                                <span class="text-danger" id="span_neighborhood_juridical">Campo obrigatório</span>
                              <?php echo form_error('neighborhood_juridical'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4 pr-md-1">
                            <div class="form-group">
                              <label for="city_juridical">Cidade</label>
                              <input type="text" name="city_juridical" id="city_juridical" class="form-control"
                                value="<?php echo set_value('city_juridical'); ?>" readonly>
                              <?php echo form_error('city_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md-4 px-md-1">
                            <div class="form-group">
                              <label for="cep_juridical">CEP</label>
                              <input type="text" name="cep_juridical" id="cep_juridical" class="form-control cep"
                                value="<?php echo set_value('cep_juridical'); ?>" readonly>
                              <?php echo form_error('cep_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md-4 pl-md-1">
                            <div class="form-group">
                              <label for="uf_juridical">UF</label>
                              <input type="text_juridical" name="uf_juridical" id="uf_juridical" class="form-control"
                                value="<?php echo set_value('uf_juridical'); ?>" readonly>
                              <?php echo form_error('uf_juridical'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="country_juridical">País</label>
                              <input type="text" name="country_juridical" id="country_juridical" class="form-control"
                                value="<?php echo set_value('country_juridical'); ?>" readonly>
                              <?php echo form_error('country_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="monthly_invoicing_juridical">Faturamento mensal</label>
                              <input type="text" name="monthly_invoicing_juridical" id="monthly_invoicing_juridical"
                                class="form-control valor"
                                value="<?php echo set_value('monthly_invoicing_juridical'); ?>" readonly>
                              <?php echo form_error('monthly_invoicing_juridical'); ?>
                            </div>
                          </div>
                        </div>
                        <!-- <hr> -->
                        <!-- <div id="new_cnpj"></div>
                        <div id="pesquisar_new_requester_protocols"
                        class="row mt-3 justify-content-center align-items-center">
                        <div class="col-md-6 col-sm-12 pr-md-1">
                          <div class="input-group mb-3">
                            <input type="text" class="form-control cnpj" placeholder="Adicionar outro requerente (CNPJ)"
                            id="add_cnpj" aria-label="Recipiente para nickname" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                              <span class="input-group-text bg-primary text-white span_add_cnpj" id="span_add_cnpj">
                                <i class="fas fa-plus ml-2 mx-1"></i>
                                Adicionar
                              </span>
                            </div>
                          </div>
                        </div>
                      </div> -->
                      <div class="row d-flex justify-content-center">
                        <div class="col-md-6 alert_add_cpf_number" style="color: red; display: none;">
                          <p class="">CNPJ não encontrado!!</p>
                        </div>
                      </div>
                        <!-- </div> -->
                      </div>


                      <div class="tab-pane py-2" id="tenants_juridical_tab" role="tabpanel" aria-labelledby="tenants-tab">
                        <div class="row">
                          <div class="col-md-12">
                            <a class="btn btn-primary btn-round float-md-right float-sm-right float-xs-right"
                              data-toggle="modal" data-target="#tenants_detail_juridical"><i
                                class="fas fa-plus pr-2"></i>Adicionar</a>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12" id="table_tenants_juridical">
                            <table id="" class="table table-bordered table-striped text-dark w-100">
                              <thead>
                                <tr>
                                  <th scope="col">Cpf / Cnpj</th>
                                  <th scope="col">Nome</th>
                                  <th scope="col">Perfil</th>
                                  <th scope="col">E-mail</th>
                                  <th scope="col">É proprietário(a) de imóvel?</th>
                                  <th scope="col"></th>
                                </tr>
                              </thead>
                              <tbody id="tenants_list_juridical">
                              </tbody>
                            </table>
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
                                class="form-control" value="<?php echo set_value('real_state_juridical'); ?>">
                                <span class="text-danger" id="span_real_state_juridical">Campo obrigatório</span>
                                <?php echo form_error('real_state_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md-2 py-3 px-md-1">
                            <div class="form-group">
                              <label for="sector_juridical">Setor</label>
                              <input type="text" name="sector_juridical" id="sector_juridical" class="form-control" value="<?php echo set_value('sector_juridical');?>">
                              <span class="text-danger" id="span_sector_juridical">Campo obrigatório</span>
                            </div>
                          </div>
                          <div class="col-md-2 py-3 px-md-1">
                            <div class="form-group">
                              <label for="city_block_juridical">Quadra</label>
                              <input type="text" name="city_block_juridical" id="city_block_juridical" class="form-control" value="<?php echo set_value('city_block_juridical'); ?>">
                              <span class="text-danger" id="span_city_block_juridical">Campo obrigatório</span>
                            </div>
                          </div>
                          <div class="col-md-2 py-3 px-md-1">
                            <div class="form-group">
                              <label for="allotment_juridical">Lote</label>
                              <input type="text" name="allotment_juridical" id="allotment_juridical" class="form-control" value="<?php echo set_value('allotment_juridical'); ?>">
                              <span class="text-danger" id="span_allotment_juridical">Campo obrigatório</span>
                            </div>
                          </div>
                          <div class="col-md-1 py-3 px-md-1">
                            <div class="form-group">
                              <label for="sub_lot_juridical">Sub lote</label>
                              <input type="text" name="sub_lot_juridical" id="sub_lot_juridical" class="form-control" value="">
                            </div>
                          </div>
                            <div class="col-md-3 pl-md-1">
                                <div class="form-group">
                                    <label for="property_registration_number_juridical">Matrícula do imóvel aberta pelo Procedimento de REURB:</label>
                                    <input type="text" name="property_registration_number_juridical" id="property_registration_number_juridical"
                                           class="form-control" value="<?php echo set_value('property_registration_number_juridical'); ?>">
                                           <span class="text-danger" id="span_property_registration_number_juridical">Campo obrigatório</span>
                                    <?php echo form_error('property_registration_number_juridical'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4 pr-md-1">
                            <div class="form-group">
                              <label for="residential_property_juridical">Tipo de Logradouro</label>
                              <select class="custom-select" id="residential_property_juridical" name="residential_property_juridical" value="<?php echo set_value('residential_property_juridical'); ?>">
                                <option value=""></option>
                                <option value="Alameda">Alameda</option>
                                <option value="Avenida">Avenida</option>
                                <option value="Praça">Praça</option>
                                <option value="Rua">Rua</option>
                                <option value="Travessa">Travessa</option>
                                <option value="Via">Via</option>
                                <option value="Viela">Viela</option>
                              </select>
                              <span class="text-danger" id="span_residential_property_juridical">Campo obrigatório</span>
                              <?php echo form_error('realty_type_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md-4 px-md-1">
                            <div class="form-group">
                              <label for="realty_address_juridical">Logradouro</label>
                              <input type="text" name="realty_address_juridical" id="realty_address_juridical"
                                class="form-control" value="<?php echo set_value('realty_address_juridical'); ?>">
                                <span class="text-danger" id="span_realty_address_juridical">Campo obrigatório</span>
                              <?php echo form_error('realty_address_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md-4 pl-md-1">
                            <div class="form-group">
                              <label for="realty_number_juridical">Numero</label>
                              <input type="text" name="realty_number_juridical" id="realty_number_juridical"
                                class="form-control" value="<?php echo set_value('realty_number_juridical'); ?>">
                                <span class="text-danger" id="span_realty_number_juridical">Campo obrigatório</span>
                              <?php echo form_error('realty_number_juridical'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 pr-md-1">
                            <div class="form-group">
                              <label for="realty_complement_juridical">Complemento</label>
                              <input type="text" name="realty_complement_juridical" id="realty_complement_juridical"
                                class="form-control" value="<?php echo set_value('realty_complement_juridical'); ?>">
                              <?php echo form_error('realty_complement_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md-6 pl-md-1">
                            <div class="form-group">
                              <label for="realty_neighborhood_juridical">Bairro</label>
                              <input type="text" name="realty_neighborhood_juridical" id="realty_neighborhood_juridical"
                                class="form-control" value="<?php echo set_value('realty_neighborhood_juridical'); ?>">
                                <span class="text-danger" id="span_realty_neighborhood_juridical">Campo obrigatório</span>
                              <?php echo form_error('realty_neighborhood_juridical'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4 pr-md-1">
                            <div class="form-group">
                              <label for="realty_city_juridical">Cidade</label>
                              <input type="text" name="realty_city_juridical" id="realty_city_juridical"
                              class="form-control" value="<?php echo set_value('realty_city_juridical'); ?>">
                              <?php echo form_error('realty_city_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md-4 px-md-1">
                            <div class="form-group">
                              <label for="realty_cep_juridical">CEP</label>
                              <input type="text" name="realty_cep_juridical" id="realty_cep_juridical"
                                class="form-control cep" value="<?php echo set_value('realty_cep_juridical'); ?>">
                              <?php echo form_error('realty_cep_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md-4 pl-md-1">
                            <div class="form-group">
                              <label for="realty_uf_juridical">UF</label>
                              <input type="text" name="realty_uf_juridical" id="realty_uf_juridical"
                              class="form-control" value="<?php echo set_value('realty_uf_juridical'); ?>">
                              <?php echo form_error('realty_uf_juridical'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="realty_country_juridical">País</label>
                              <input type="text" name="realty_country_juridical" id="realty_country_juridical"
                                class="form-control" value="<?php echo set_value('realty_country_juridical'); ?>">
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
                                value="<?php echo set_value('realty_address_posses_juridical'); ?>">
                              <?php echo form_error('realty_address_posses_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md px-md-1">
                            <div class="form-group">
                              <label for="required_terrain_area_juridical pr-md-1">Área requerida do imóvel - m<sup>2</sup></label>
                              <input type="text" name="required_terrain_area_juridical"
                                id="required_terrain_area_juridical" class="form-control venal"
                                value="<?php echo set_value('required_terrain_area_juridical'); ?>">
                              <?php echo form_error('required_terrain_area_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md px-md-1">
                            <div class="form-group">
                              <label for="georeferenced_property_area_juridical pr-md-1">Área do imóvel georreferenciada - m<sup>2</sup></label>
                              <input type="text" name="georeferenced_property_area_juridical" id="georeferenced_property_area_juridical"
                                class="form-control venal" value="<?php echo set_value('georeferenced_property_area_juridical'); ?>">
                                <span class="text-danger" id="span_georeferenced_property_area_juridical">Campo obrigatório</span>
                              <?php echo form_error('georeferenced_property_area_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="required_edificated_area_juridical">Área edificada - m<sup>2</sup></label>
                              <input type="text" name="required_edificated_area_juridical"
                                id="required_edificated_area_juridical" class="form-control venal"
                                value="<?php echo set_value(''); ?>">
                              <?php echo form_error('required_edificated_area_juridical'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 pr-md-1">
                            <div class="form-group">
                              <label for="">Características da construção</label>
                              <input type="text" name="construction_features_home_juridical"
                                id="construction_features_home_juridical" class="form-control"
                                value="<?php echo set_value('construction_features_home_juridical'); ?>">
                              <?php echo form_error('construction_features_home_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md-6 px-md-1">
                            <div class="form-group">
                              <label for="venal_juridical">Valor venal (avaliação no cadastro imobiliário Municipal)R$</label>
                              <input type="text" name="venal_juridical" id="venal_juridical" class="form-control venal"
                                value="<?php echo set_value('venal_juridical'); ?>">
                              <?php echo form_error('venal_juridical'); ?>
                              <span class="text-danger" id="span_venal_juridical">Campo obrigatório</span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 pr-md-1">
                            <div class="form-group">
                              <label for="possession_origin_juridical">Origem da Posse</label>
                              <select class="form-control" name="possession_origin_juridical" id="possession_origin_juridical">
                                <option value=""></option>
                                <option value="Contrato/Recibo de Compra e Venda">Contrato/Recibo de Compra e Venda</option>
                                <option value="Doação" >Doação</option>
                                <option value="Herança" >Herança</option>
                                <option value="Declaração de Posse">Declaração de Posse</option>
                                <option value="Posse a Justo Título">Posse a Justo Título</option>
                                <option value="Posse por Simples Ocupação">Posse por Simples Ocupação</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6 pl-md-1">
                            <div class="form-group">
                              <label for="slab_right">Direito de Laje</label>
                              <select class="form-control" name="slab_right_juridical" value="<?php echo set_value('slab_right_juridical');?>">
                                <option value=""></option>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                              </select>
                              <span class="text-danger" id="span_slab_right_juridical">Campo obrigatório</span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md pr-md-1">
                            <div class="form-group">
                              <label for="infrastructure_select_juridical">Infraestrutura básica</label>
                              <select class="form-control" name="infrastructure_select_juridical"
                                id="infrastructure_select_juridical">
                                <option value=""></option>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="potable_water_select_juridical">Água potável</label>
                              <select class="form-control" name="potable_water_select_juridical"
                                id="potable_water_select_juridical">
                                <option value=""></option>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
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
                                <option value=""></option>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md px-md-1">
                            <div class="form-group">
                              <label for="sewage_select_juridical">Esgotamento Sanitário</label>
                              <select class="form-control" name="sewage" id="sewage">
                                <option value=""></option>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6 pl-md-1">
                            <div class="form-group">
                              <label for="sewage_select_juridical">Tipo de esgoto</label>
                              <select class="form-control" name="sewage_select_juridical" id="sewage_select_juridical">
                                <option value=""></option>
                                <option value="Rede Pública">Rede Pública</option>
                                <option value="Fossa séptica">Fossa séptica</option>
                                <option value="Outro">Outro</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 pr-md-1">
                            <div class="form-group">
                              <label for="type_property_juridical">Tipo de imóvel:</label>
                              <select class="form-control" name="type_property_juridical" id="type_property_juridical" value="<?php echo set_value('type_property_juridical'); ?>">
                                <option value=""></option>
                                <option value="Residencial">Residencial</option>
                                <option value="Comercial">Comercial</option>
                                <option value="Misto Residencial/Comercial">Misto Residencial/Comercial</option>
                              </select>
                              <span class="text-danger" id="span_type_property_juridical">Campo obrigatório</span>
                            </div>
                          </div>
                          <div class="col-md-6 pl-md-1">
                            <div class="form-group">
                              <label for="unit_situation_juridical">Situação da unidade:</label>
                              <select class="form-control" name="unit_situation_juridical" id="unit_situation_juridical">
                                <option value=""></option>
                                <option value="Construída">Construída</option>
                                <option value="Em construção">Em construção</option>
                                <option value="Lote Vago">Lote Vago</option>
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
                                <option value=""></option>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md px-md-1">
                            <div class="form-group">
                              <label for="paviment_type_select_juridical">Tipo de pavimentação</label>
                              <select class="form-control" name="paviment_type_select_juridical"
                                id="paviment_type_select_juridical">
                                <option value=""></option>
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
                                <option value=""></option>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md pl-md-1">
                            <div class="form-group">
                              <label for="register_date_juridical">Data cadastro</label>
                              <input type="date" name="register_date_juridical" id="register_date_juridical"
                                class="form-control" value="<?php echo set_value('register_date_juridical'); ?>">
                              <?php echo form_error('register_date_juridical'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h4 class="text-dark">Confrontantes</h4>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="name_confrontants_juridical">Nome</label>
                              <input type="text" name="name_confrontants_juridical[]" id="name_confrontants_juridical" class="form-control"
                                value="<?php echo set_value('name_confrontants_juridical'); ?>">
                              <?php echo form_error('name_confrontants_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label for="cpf_confrontants_juridical">Cpf</label>
                              <input type="text" name="cpf_confrontants_juridical[]" id="cpf_confrontants_juridical" class="form-control cpf"
                                value="<?php echo set_value('cpf_confrontants_juridical'); ?>">
                              <?php echo form_error('cpf_confrontants_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="birth_date_confrontants_juridical">Data nacimento</label>
                              <input type="date" name="birth_date_confrontants_juridical[]" id="birth_date_confrontants_juridical" class="form-control"
                                value="<?php echo set_value('birth_date_confrontants_juridical'); ?>">
                              <?php echo form_error('birth_date_confrontants_juridical'); ?>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="confrontation_direction_juridical">Confrontação</label>
                              <select class="form-control" name="confrontation_direction_juridical[]" id="confrontation_direction_juridical">
                                <option value=""></option>
                                <option value="Lado esquerdo">Lado esquerdo</option>
                                <option value="Lado direito">Lado direito</option>
                                <option value="Fundos">Fundos</option>
                              </select>
                              <span class="text-dark">*Descrever as confrontações de dentro do móvel olhando para rua</span>
                            </div>
                          </div>
                        </div>
                        <div id="list_confrotants_juridical"></div>
                        <div class="row">
                          <div class="col-md-2">
                            <button type="button" name="button" class="btn btn-primary" id="add_confrotants_juridical">+ Adicionar</button>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane" id="enquadramento_reurb_juridical" role="tabpanel"
                        aria-labelledby="enquadramento_reurb_juridical">
                        <div class="row mt-2 mb-2">
                          <div class="col-md-5 text-dark">
                              <span>Renda Total (membros da familia/condôminos): <p class="text-primary" id="monthly_income_total_juridical"></p></span>
                          </div>
                          <div class="col-md-7 text-dark">
                            <span>É proprietário(a) de imóvel urbano ou rural registrado em Cartório de Imóveis? <p class="text-primary" id="proprietario_imovel_juridical"></p></span>
                          </div>
                        </div>
                        <div class="row text-dark">
                          <div class="col-md-12">
                            <label for="criteria_established_law">De acordo com os critérios acima estabelecidos pela lei Federal nº 13.465/2017 e Decreto 9.310/18,
                              e legislação Municipal vigente, o requerente enquadra-se na modalidade de: </label>
                              <input type="text" class="text-primary" name="reurb_juridical" id="reurb_juridical" value="" readonly style="border: none;">
                          </div>
                          <input type="hidden" name="maximum_family_income" value="" id="maximum_family_income_juridical">
                        </div>
                      </div>

                      <div class="tab-pane fade" id="checklist_juridical" role="tabpanel" aria-labelledby="address-tab">
                        <div class="row mt-2">
                          <div class="col-md-12">
                            <h6 class="d-inline text-dark">Concluir cadastro de dados e anexar documentos</h6>
                            <button type="submit" name="register_protocols" id=""
                              class="btn btn-primary register_protocols">Cadastrar</button>
                          </div>
                        </div>
                        <div class="append_id_documents"></div>

                        <!-- <div class="row mt-3">
                          <div class="col-md-12">
                            <div class="list-group text-dark">
                              <div class="list-group-item d-inline align-items-center py-1 mb-1 ">
                                <span>Documento de aquisição do imóvel</span>
                                <a href="#" class="btn btn-sm btn-primary float-right" id="download_aquisicao_juridical" download="documento_aquisicao_imovel" style="display: none;">Baixar</a>
                                <button type="button" name="button" class="btn btn-sm btn-primary float-right img_aquisicao_juridical">
                                  enviar/upload +
                                </button>
                                <input type="file" name="file_aquisicao_juridical" id="pic_img_aquisicao_juridical" value="" style="display: none;">
                                <span class="d-flex align-items-center float-right text-primary mr-3 mt-2" id="name_aquisicao_juridical"></span>
                                <img src="" alt="" id="img_aquisicao_juridical" style="display: none;">
                              </div>
                              <div class="list-group-item  d-inline justify-content-between align-items-center py-1 mb-1 ">
                                <span>Guia de IPTU</span>
                                <a href="#" class="btn btn-sm btn-primary float-right" id="download_iptu_juridical" download="guia_iptu" style="display: none;">Baixar</a>
                                <button type="button" name="button" class="btn btn-sm btn-primary float-right img_iptu_juridical">enviar/upload +</button>
                                <input type="file" name="file_iptu_juridical" id="pic_img_iptu_juridical" value="" style="display: none;">
                                <span class="d-flex align-items-center float-right text-primary mr-3 mt-2" id="name_iptu_juridical"></span>
                                <img src="" alt="" id="img_iptu_juridical" style="display: none;">
                              </div>
                              <div class="list-group-item  d-inline justify-content-between align-items-center py-1 mb-1 ">
                                <span>Declaração de Confrontante</span>
                                <a href="#" class="btn btn-sm btn-primary float-right" id="download_confrotante_juridical" download="declaracao_confrontante" style="display: none;">Baixar</a>
                                <button type="button" name="button" class="btn btn-sm btn-primary float-right img_confrotante_juridical">enviar/upload +</button>
                                <input type="file" name="file_confrotante_juridical" id="pic_img_confrotante_juridical" value="" style="display: none;">
                                <span class="d-flex align-items-center float-right text-primary mr-3 mt-2" id="name_confrotante_juridical"></span>
                                <img src="" alt="" id="img_confrotante_juridical" style="display: none;">
                              </div>
                              <div class="list-group-item  d-inline justify-content-between align-items-center py-1 mb-1 ">
                                <span>Planta Topográfica</span>
                                <a href="#" class="btn btn-sm btn-primary float-right" id="download_topografica_juridical" download="planta_topografica" style="display: none;">Baixar</a>
                                <button type="button" name="button" class="btn btn-sm btn-primary float-right img_topografica_juridical">enviar/upload +</button>
                                <input type="file" name="front_photo_property_juridical" id="pic_img_topografica_juridical" value="" style="display: none;">
                                <span class="d-flex align-items-center float-right text-primary mr-3 mt-2" id="name_topografica_juridical"></span>
                                <img src="" alt="" id="img_topografica_juridical" style="display: none;">
                              </div>
                              <div class="list-group-item  d-inline justify-content-between align-items-center py-1 mb-1 ">
                                <span>Memorial Descritivo</span>
                                <a href="#" class="btn btn-sm btn-primary float-right" id="download_memorial_juridical" download="memorial_descritivo" style="display: none;">Baixar</a>
                                <button type="button" name="button" class="btn btn-sm btn-primary float-right img_memorial_juridical">enviar/upload +</button>
                                <input type="file" name="plant_motionless_juridical" id="pic_img_memorial_juridical" value="" style="display: none;">
                                <span class="d-flex align-items-center float-right text-primary mr-3 mt-2" id="name_memorial_juridical"></span>
                                <img src="" alt="" id="img_memorial_juridical" style="display: none;">
                              </div>
                              <div class="list-group-item  d-inline justify-content-between align-items-center py-1 mb-1 ">
                                <span>Foto Frontal</span>
                                <a href="#" class="btn btn-sm btn-primary float-right" id="download_frontal_juridical" download="foto_frontal" style="display: none;">Baixar</a>
                                <button type="button" name="button" class="btn btn-sm btn-primary float-right img_frontal_juridical">enviar/upload +</button>
                                <input type="file" name="descriptive_memorial_juridical" id="pic_img_frontal_juridical" value="" style="display: none;">
                                <span class="d-flex align-items-center float-right text-primary mr-3 mt-2" id="name_frontal_juridical"></span>
                                <img src="" alt="" id="img_frontal_juridical" style="display: none;">
                              </div>
                            </div>
                          </div>
                        </div> -->

                      </div>

                    </div>
                  </div>
                </div>
              </div>
          </form>
        </div>
        <div class="card-footer">
          <a href="<?php echo base_url()?>protocols" class="btn btn-round btn-secundary float-right">Voltar</a>
          <button type="submit" name="register_protocols" id=""
            class="btn btn-primary btn-round float-md-right float-sm-right float-xs-right register_protocols">Cadastrar</button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('elements/footer');?>


<!-- Modal -->
<div class="modal fade" id="tenants_detail_legal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Condôminos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <table id="tabelaTres" class="table table-bordered table-striped text-dark w-100">
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
                <?php foreach ($requesters as $row): ?>
                  <?php $count++; ?>
                  <tr>
                    <td><?php echo (isset($row->cpf)) ? $row->cpf : $row->cnpj ; ?></td>
                    <td><?php echo (isset($row->legal_name)) ? $row->legal_name : $row->company_name; ?></td>
                    <td><?php echo (isset($row->legal_phone)) ? $row->legal_phone : $row->procurator_phone; ?></td>
                    <td><?php echo (isset($row->legal_email)) ? $row->legal_email : $row->procurator_email; ?></td>
                    <td>
                      <?php if (isset($row->property_owner_legal)) {
                        $property_owner_legal = ($row->property_owner_legal == '1') ? 'Sim' : 'Não';
                        echo $property_owner_legal;
                      } else {
                        $property_owner_juridical = ($row->property_owner_juridical == '1') ? 'Sim' : 'Não';
                        echo $property_owner_juridical;
                      } ?>
                    </td>
                    <td>
                      <i class="fa fa-plus append_tenants_legal" data-id="<?php echo $row->id; ?>"
                      data-name="<?php echo (isset($row->legal_name)) ? $row->legal_name : $row->company_name; ?>"
                      data-cpf="<?php echo (isset($row->cpf)) ? $row->cpf : $row->cnpj ; ?>"
                      data-contato="<?php echo (isset($row->legal_phone)) ? $row->legal_phone : $row->procurator_phone; ?>"
                      data-email="<?php echo (isset($row->legal_email)) ? $row->legal_email : $row->procurator_email; ?>"
                      data-property_owner="<?php echo (isset($property_owner_legal)) ? $property_owner_legal : $property_owner_juridical; ?>"
                      data-monthly_income="<?php echo (isset($row->monthly_income)) ? $row->monthly_income : $row->monthly_invoicing; ?>"
                      ></i>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
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


<!-- Modal -->
<div class="modal fade" id="tenants_detail_juridical" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Condôminos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <table id="add_tenants" class="table table-bordered table-striped text-dark w-100">
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
                <?php foreach ($requesters as $row): ?>
                  <?php $count++; ?>

                  <tr>
                    <td><?php echo (isset($row->cpf)) ? $row->cpf : $row->cnpj ; ?></td>
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
                      <i class="fa fa-plus append_tenants_juridical" data-id="<?php echo $row->id; ?>"
                      data-name="<?php echo (isset($row->legal_name)) ? $row->legal_name : $row->company_name; ?>"
                      data-cpf="<?php echo (isset($row->cpf)) ? $row->cpf : $row->cnpj ; ?>"
                      data-contato="<?php echo (isset($row->legal_phone)) ? $row->legal_phone : $row->procurator_phone; ?>"
                      data-email="<?php echo (isset($row->legal_email)) ? $row->legal_email : $row->procurator_email; ?>"
                      data-property_owner="<?php echo (isset($legal)) ? $legal : $juridical; ?>"
                      data-monthly_income="<?php echo (isset($row->monthly_income)) ? $row->monthly_income : $row->monthly_invoicing; ?>"
                      ></i>
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

<script>
  // let inputCEP1 = document.querySelector('#realty_cep_home')
  // inputCEP1.addEventListener('input', () => {
  //   pegarCPF(inputCEP1, '#realty_address_home', '#realty_complement_home', '#realty_neighborhood_home',
  //     '#realty_city_home', '#realty_uf_home', )
  // })
  // let inputCEP2 = document.querySelector('#cep_juridical')
  // inputCEP2.addEventListener('input', () => {
  //   pegarCPF(inputCEP2, '#street_juridical', '#complement_juridical', '#neighborhood_juridical', '#city_juridical',
  //     '#uf_juridical', )
  // })
</script>
