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
      <div class="col-md">
        <div class="card">
          <div class="card-header">
            <a href="<?php echo base_url()?>property_registration"
              class="btn btn-secundary mb-2 float-right btn-round">Voltar</a>
            <h2 class="card-title">Detalhe de Registro de Imóveis</h2>
            <hr>
          </div>
          <div class="card-body">
            <form
              action="<?php echo base_url(); ?>property_registration/update_property_registration/<?php echo $notary_office->id; ?>"
              method="post">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6 pr-md-1 pl-md-1">
                    <div class="form-group">
                      <label for="name_registry">Nome</label>
                      <input type="text" name="name_registry" id="name_registry" class="form-control"
                        value="<?php echo $notary_office->name_registry; ?>">
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-1 pr-md-1">
                    <div class="form-group">
                      <label for="judicial_district">Comarca</label>
                      <input type="text" name="judicial_district" id="judicial_district" class="form-control"
                        value="<?php echo $notary_office->judicial_district; ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 pr-md-1 pl-md-1">
                    <div class="form-group">
                      <label for="registration_officer">Oficial de Registro</label>
                      <input type="text" name="registration_officer" id="registration_officer" class="form-control"
                        value="<?php echo $notary_office->registration_officer; ?>">
                    </div>
                  </div>
                  <div class="col-md-6 pr-md-1 pl-md-1">
                    <div class="form-group">
                      <label for="cns_registry">C.N.S</label>
                      <input type="text" name="cns_registry" id="cns_registry" class="form-control"
                        value="<?php echo $notary_office->cns; ?>">
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
                  <div class="col-md-3 pr-md-1 pl-md-1">
                    <div class="form-group">
                      <label for="postal_code_registry">CEP</label>
                      <input type="text" name="postal_code_registry" id="postal_code_registry" class="form-control cep"
                        value="<?php echo $notary_office->cep; ?>">
                    </div>
                  </div>
                  <div class="col-md-3 pl-md-1 pr-md-1">
                    <div class="form-group">
                      <label for="public_place_type_registry">Tipo de logradouro</label>
                      <select class="custom-select" id="public_place_type_registry" name="public_place_type_registry">
                        <option value="<?php echo $notary_office->type_place; ?>" selected>
                          <?php echo $notary_office->type_place; ?></option>
                        <option value="Rua">Rua</option>
                        <option value="Avenida">Avenida</option>
                        <option value="Travessa">Travessa</option>
                        <option value="Outro">Outro</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3 pr-md-1 pl-md-1">
                    <div class="form-group">
                      <label for="public_place_registry">Logradouro</label>
                      <input type="text" name="public_place_registry" id="public_place_registry" class="form-control"
                        value="<?php echo $notary_office->public_place; ?>">
                    </div>
                  </div>
                  <div class="col-md-3 pr-md-1 pl-md-1">
                    <div class="form-group">
                      <label for="public_place_number_registry">Número</label>
                      <input type="text" name="public_place_number_registry" id="public_place_number_registry"
                        class="form-control" value="<?php echo $notary_office->number; ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 pl-md-1 pr-md-1">
                    <div class="form-group">
                      <label for="public_place_complement_registry">Complemento</label>
                      <input type="text" name="public_place_complement_registry" id="public_place_complement_registry"
                        class="form-control" value="<?php echo $notary_office->complement; ?>">
                    </div>
                  </div>
                  <div class="col-md-4 pl-md-1 pr-md-1">
                    <div class="form-group">
                      <label for="neighbourhood_registry">Bairro</label>
                      <input type="text" name="neighbourhood_registry" id="neighbourhood_registry" class="form-control"
                        value="<?php echo $notary_office->neighborhood; ?>">
                    </div>
                  </div>
                  <div class="col-md-4 pl-md-1 pr-md-1">
                    <div class="form-group">
                      <label for="district_registry">Distrito</label>
                      <input type="text" name="district_registry" id="district_registry" class="form-control"
                        value="<?php echo $notary_office->district; ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3 pl-md-1 pr-md-1">
                    <div class="form-group">
                      <label for="county_registry">Município</label>
                      <input type="text" name="county_registry" id="county_registry" class="form-control"
                        value="<?php echo $notary_office->county; ?>">
                    </div>
                  </div>
                  <div class="col-md-3 pl-md-1 pr-md-1">
                    <div class="form-group">
                      <label for="city_registry">Cidade</label>
                      <input type="text" name="city_registry" id="city_registry" class="form-control"
                        value="<?php echo $notary_office->city; ?>">
                    </div>
                  </div>
                  <div class="col-md-3 pr-md-1 pl-md-1">
                    <div class="form-group">
                      <label for="UF_registry">UF</label>
                      <input type="text" name="UF_registry" id="UF_registry" class="form-control"
                        value="<?php echo $notary_office->uf; ?>">
                    </div>
                  </div>
                  <div class="col-md-3 pr-md-1 pl-md-1">
                    <div class="form-group">
                      <label for="country_registry">País</label>
                      <input type="text" name="country_registry" id="country_registry" class="form-control"
                        value="<?php echo $notary_office->nationality; ?>">
                    </div>
                  </div>
                </div>
                <button type="submit" name="update_registry" id="update_registry"
                  class="btn btn-primary btn-round float-md-right float-sm-right float-xs-right mx-auto">
                  ATUALIZAR DADOS
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php $this->load->view('elements/footer');?>
