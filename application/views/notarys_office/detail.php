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
      <form
      action="<?php echo base_url(); ?>notarys_office/update_property_registration/<?php echo $notary_office->id; ?>"
      method="post">
      <div class="card-header">
        <h2 class="card-title d-inline">Detalhes do Registro Civil</h2>
        <div class="d-flex justify-content-end float-right">
          <a href="<?php echo base_url()?>notarys_office" class="btn btn-secundary mr-1">Voltar</a>
          <button type="submit" name="update_registry" id="update_registry" class="btn btn-primary">Atualizar</button>
        </div>
        <hr>
        <div class="row">
          <div class="col-md pr-md-1">
            <button type="button" name="button" class="btn btn-sm <?php echo ($notary_office->status == '0') ? 'btn-primary' : 'btn-secondary'; ?> float-right mr-3"
              data-toggle="modal" data-target="#modalQuestion">
              <i class="fa fa-power-off"></i>
              <?php echo ($notary_office->status == '0') ? 'Ativar' : 'Desativar'; ?>
            </button>
        </div>
      </div>
      </div>
      <div class="card-body">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12 pr-md-1 pl-md-1">
                <div class="form-group">
                  <label for="notary_type">Tipo de Cartório</label>
                  <select class="form-control" name="notary_type" id="notary_type">
                    <option value=""></option>
                    <?php foreach ($type_notarys_office as $row): ?>
                    <option value="<?php echo $row->id; ?>"
                      <?= ($notary_office->type_notarys_office == $row->id) ? 'selected' : ''; ?>>
                      <?php echo $row->description; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
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
              <div class="col-md-4 pr-md-1 pl-md-1">
                <div class="form-group">
                  <label for="registration_officer">Oficial de Registro</label>
                  <input type="text" name="registration_officer" id="registration_officer" class="form-control"
                    value="<?php echo $notary_office->registration_officer; ?>">
                </div>
              </div>
              <div class="col-md-4 px-md-1">
                <div class="form-group">
                  <label for="substitute_officer">Oficial substituto</label>
                  <input type="text" name="substitute_officer" id="substitute_officer" class="form-control"
                    value="<?= $notary_office->substitute_officer; ?>">
                </div>
              </div>
              <div class="col-md-4 pr-md-1 pl-md-1">
                <div class="form-group">
                  <label for="cns_registry">C.N.S</label>
                  <input type="text" name="cns_registry" id="cns_registry" class="form-control cns"
                    value="<?php echo $notary_office->cns; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 pr-md-1 pl-md-1">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" value="<?php echo $notary_office->email; ?>" class="form-control">
                </div>
              </div>
              <div class="col-md-4 pl-md-1 pr-md-1">
                <div class="form-group">
                  <label for="phone">Telefone</label>
                  <input type="text" name="phone" id="phone" value="<?php echo $notary_office->phone; ?>" class="form-control">
                </div>
              </div>
              <div class="col-md-4 pl-md-1">
                <div class="form-group">
                  <label for="celphone">Celular</label>
                  <input type="text" name="celphone" id="celphone" value="<?php echo $notary_office->celphone; ?>" class="form-control phone">
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
              <div class="col-md-4 pl-md-1 pr-md-1">
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
              <div class="col-md-4 pr-md-1 pl-md-1">
                <div class="form-group">
                  <label for="public_place_registry">Logradouro</label>
                  <input type="text" name="public_place_registry" id="public_place_registry" class="form-control"
                    value="<?php echo $notary_office->public_place; ?>">
                </div>
              </div>
              <div class="col-md-4 pr-md-1 pl-md-1">
                <div class="form-group">
                  <label for="public_place_number_registry">Número</label>
                  <input type="text" name="public_place_number_registry" id="public_place_number_registry"
                    class="form-control" value="<?php echo $notary_office->number; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 pl-md-1 pr-md-1">
                <div class="form-group">
                  <label for="public_place_complement_registry">Complemento</label>
                  <input type="text" name="public_place_complement_registry" id="public_place_complement_registry"
                    class="form-control" value="<?php echo $notary_office->complement; ?>">
                </div>
              </div>
              <div class="col-md-6 pl-md-1 pr-md-1">
                <div class="form-group">
                  <label for="neighbourhood_registry">Bairro</label>
                  <input type="text" name="neighbourhood_registry" id="neighbourhood_registry" class="form-control"
                    value="<?php echo $notary_office->neighborhood; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 pl-md-1 pr-md-1">
                <div class="form-group">
                  <label for="city_registry">Cidade</label>
                  <input type="text" name="city_registry" id="city_registry" class="form-control"
                    value="<?php echo $notary_office->city; ?>">
                </div>
              </div>
              <div class="col-md-4 pr-md-1 pl-md-1">
                <div class="form-group">
                  <label for="postal_code_registry">CEP</label>
                  <input type="text" name="postal_code_registry" id="postal_code_registry" class="form-control cep"
                    value="<?php echo $notary_office->cep; ?>">
                </div>
              </div>
              <div class="col-md-4 pr-md-1 pl-md-1">
                <div class="form-group">
                  <label for="UF_registry">UF</label>
                  <input type="text" name="UF_registry" id="UF_registry" class="form-control"
                    value="<?php echo $notary_office->uf; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md pr-md-1 pl-md-1">
                <div class="form-group">
                  <label for="country_registry">País</label>
                  <input type="text" name="country_registry" id="country_registry" class="form-control"
                    value="<?php echo $notary_office->nationality; ?>">
                </div>
              </div>
            </div>

          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-md-12 d-flex justify-content-end">
                <a href="<?php echo base_url()?>notarys_office" class="btn btn-secundary mr-1">Voltar</a>
                <button type="submit" name="update_registry" id="update_registry" class="btn btn-primary">Atualizar</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- modalQuestion -->
    <div class="modal fade" id="modalQuestion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="<?php echo base_url(); ?>notarys_office/turn_off" method="post">
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
                  <input type="hidden" name="id" value="<?php echo $notary_office->id; ?>">
                  <input type="hidden" name="status" value="<?php echo $notary_office->status; ?>">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php $this->load->view('elements/footer');?>
