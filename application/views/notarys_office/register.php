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
    <div class="card">
      <div class="card-header">
        <h2 class="card-title">Cadastro de serventia</h2>
        <hr>
      </div>
      <form action="<?php echo base_url(); ?>notarys_office/register_property" method="post">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="notary_type">Tipo de Cartório</label>
                    <select class="form-control" name="notary_type" id="notary_type">
                      <option value=""></option>
                      <?php foreach ($type_notarys_office as $row): ?>
                      <option value="<?php echo $row->id; ?>"><?php echo $row->description; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-md-1">
                  <div class="form-group">
                    <label for="name_registry">Nome</label>
                    <input type="text" name="name_registry" id="name_registry" class="form-control"
                      value="<?php echo set_value('name_registry'); ?>">
                    <?php echo form_error('name_registry'); ?>
                  </div>
                </div>
                <div class="col-md-6 pl-md-1">
                  <div class="form-group">
                    <label for="judicial_district">Comarca</label>
                    <input type="text" name="judicial_district" id="judicial_district" class="form-control"
                      value="<?php echo set_value('judicial_district'); ?>">
                    <?php echo form_error('judicial_district'); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 pr-md-1">
                  <div class="form-group">
                    <label for="registration_officer">Oficial de Registro</label>
                    <input type="text" name="registration_officer" id="registration_officer" class="form-control"
                      value="<?php echo set_value('registration_officer'); ?>">
                    <?php echo form_error('registration_officer'); ?>
                  </div>
                </div>
                <div class="col-md-4 px-md-1">
                  <div class="form-group">
                    <label for="substitute_officer">Oficial substituto</label>
                    <input type="text" name="substitute_officer" id="substitute_officer" class="form-control"
                      value="<?php echo set_value('substitute_officer'); ?>">
                    <?php echo form_error('substitute_officer'); ?>
                  </div>
                </div>
                <div class="col-md-4 pl-md-1">
                  <div class="form-group">
                    <label for="cns_registry">C.N.S</label>
                    <input type="text" name="cns_registry" id="cns_registry" class="form-control cns"
                      value="<?php echo set_value('cns_registry'); ?>">
                    <?php echo form_error('cns_registry'); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 pr-md-1">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="" class="form-control">
                  </div>
                </div>
                <div class="col-md-4 px-md-1">
                  <div class="form-group">
                    <label for="phone">Telefone</label>
                    <input type="text" name="phone" id="phone" value="" class="form-control">
                  </div>
                </div>
                <div class="col-md-4 pl-md-1">
                  <div class="form-group">
                    <label for="celphone">Celular</label>
                    <input type="text" name="celphone" id="celphone" value="" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4>Endereço</h4>
                  <hr>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-4 pr-md-1">
                  <div class="form-group">
                    <label for="public_place_type_registry">Tipo de logradouro</label>
                    <select class="custom-select" id="public_place_type_registry" name="public_place_type_registry">
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
                    <label for="public_place_registry">Logradouro</label>
                    <input type="text" name="public_place_registry" id="public_place_registry"
                      class="form-control logradouro" value="<?php echo set_value('public_place_registry'); ?>">
                    <?php echo form_error('public_place_registry'); ?>
                  </div>
                </div>
                <div class="col-md-4 pl-md-1">
                  <div class="form-group">
                    <label for="public_place_number_registry">Número</label>
                    <input type="text" name="public_place_number_registry" id="public_place_number_registry"
                      class="form-control" value="<?php echo set_value('public_place_number_registry'); ?>">
                    <?php echo form_error('public_place_number_registry'); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-md-1">
                  <div class="form-group">
                    <label for="public_place_complement_registry">Complemento</label>
                    <input type="text" name="public_place_complement_registry" id="public_place_complement_registry"
                      class="form-control complemento"
                      value="<?php echo set_value('public_place_complement_registry'); ?>">
                    <?php echo form_error('public_place_complement_registry'); ?>
                  </div>
                </div>
                <div class="col-md-6 pl-md-1">
                  <div class="form-group">
                    <label for="neighbourhood_registry">Bairro</label>
                    <input type="text" name="neighbourhood_registry" id="neighbourhood_registry"
                      class="form-control bairro" value="<?php echo set_value('neighbourhood_registry'); ?>">
                    <?php echo form_error('neighbourhood_registry'); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 pr-md-1">
                  <div class="form-group">
                    <label for="city_registry">Cidade</label>
                    <input type="text" name="city_registry" id="city_registry" class="form-control cidade"
                      value="<?php echo set_value('city_registry'); ?>">
                    <?php echo form_error('city_registry'); ?>
                  </div>
                </div>
                <div class="col-md-4 px-md-1">
                  <div class="form-group">
                    <label for="postal_code_registry">CEP</label>
                    <input type="text" name="postal_code_registry" id="postal_code_registry" class="form-control cep"
                      value="<?php echo set_value('postal_code_registry'); ?>">
                    <?php echo form_error('postal_code_registry'); ?>
                  </div>
                </div>
                <div class="col-md-4 pl-md-1">
                  <div class="form-group">
                    <label for="UF_registry">UF</label>
                    <input type="text" name="UF_registry" id="UF_registry" class="form-control uf"
                      value="<?php echo set_value('UF_registry'); ?>">
                    <?php echo form_error('UF_registry'); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="country_registry">País</label>
                    <input type="text" name="country_registry" id="country_registry" class="form-control"
                      value="<?php echo set_value('country_registry'); ?>">
                    <?php echo form_error('country_registry'); ?>
                  </div>
                </div>
              </div>
              <!-- <div class="registry_list">
              </div> -->
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
            <a href="<?php echo base_url()?>notarys_office" class="btn btn-secundary mr-1">Voltar</a>
            <button type="submit" name="new_registry" id="new_registry" class="btn btn-primary">Salvar</button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <?php $this->load->view('elements/footer');?>
    <!-- <script>
      let inputCEP3 = document.querySelector('.cep')
      inputCEP3.addEventListener('input', () => {
        pegarCPF(inputCEP3, '.logradouro', '.complemento', '.bairro', '.cidade', '.uf')
      })
    </script> -->
