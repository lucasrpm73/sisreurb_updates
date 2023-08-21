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
        <h4 class="card-title">Registrar</h4>
        <hr>
      </div>
      <form action="<?php echo base_url(); ?>commission_members/register_commission_members" method="post"
        enctype="multipart/form-data">
        <div class="card-body">
          <div class="col-md-12">
            <div class="row mt-3">
              <div class="col-md-4 pl-md-1 pr-md-1">
                <label for="register_type">Tipo de cadastro</label>
                <select class="custom-select" name="register_type" id="register_type">
                  <option value=""></option>
                  <?php if (empty($isset_mayor)): ?>
                    <option value="Presidente">Presidente</option>
                  <?php endif; ?>
                  <option value="Membro">Membro</option>
                  <option value="Suplente">Suplente</option>
                </select>
              </div>
              <div class="col-md px-md-1">
                <div class="form-group">
                  <label for="representative">Representante do(a)</label>
                  <input type="text" name="representative" value="" class="form-control">
                </div>
              </div>
              <div class="col-md pl-md-1 pr-md-1">
                <div class="form-group">
                  <label for="appointment_ordinancet">Portaria de nomeação</label>
                  <input type="text" name="appointment_ordinance" id="appointment_ordinance" class="form-control"
                    value="<?php echo set_value('appointment_ordinance'); ?>">
                  <?php echo form_error('appointment_ordinance'); ?>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 pl-md-1 pr-1">
                <div class="form-group">
                  <label for="cpf_president">CPF</label>
                  <input type="text" name="cpf_president" id="cpf" class="form-control"
                    value="<?php echo set_value('cpf_president'); ?>">
                  <?php echo form_error('cpf_president'); ?>
                </div>
              </div>
              <div class="col-md-4 pl-md-1 pr-1">
                <div class="form-group">
                  <label for="name_president">Nome</label>
                  <input type="text" name="name_president" id="name_president" class="form-control"
                    value="<?php echo set_value('name_president'); ?>">
                  <?php echo form_error('name_president'); ?>
                </div>
              </div>
              <div class="col-md-2 pl-md-1 pr-1">
                <div class="form-group">
                  <label for="rg_president">R.G</label>
                  <input type="text" name="rg_president" id="rg_president" class="form-control"
                    value="<?php echo set_value('rg_president'); ?>">
                  <?php echo form_error('rg_president'); ?>
                </div>
              </div>
              <div class="col-md-2 pr-1 pl-md-1">
                <div class="form-group">
                  <label for="oe_president">Órgão Expeditor</label>
                  <input type="text" name="oe_president" id="oe_president" class="form-control"
                    value="<?php echo set_value('oe_president'); ?>">
                  <?php echo form_error('oe_president'); ?>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 pl-md-1 pr-1">
                <div class="form-group">
                  <label for="profession_president">Profissão</label>
                  <input type="text" name="profession_president" id="profession_president" class="form-control"
                    value="<?php echo set_value('profession_president'); ?>">
                  <?php echo form_error('profession_president'); ?>
                </div>
              </div>
              <div class="col-md-4 pl-md-1 pr-1">
                <div class="form-group">
                  <label for="birth_president">Data de nascimento</label>
                  <input type="date" name="birth_president" id="birth_date" class="form-control"
                    value="<?php echo set_value('birth_president'); ?>">
                  <?php echo form_error('birth_president'); ?>
                </div>
              </div>
              <div class="col-md-4 pr-1 pl-md-1">
                <div class="form-group">
                  <label for="gender_president">Gênero</label>
                  <select class="custom-select" id="gender_president" name="gender_president">
                    <option value=""></option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 pr-1 pl-md-1">
                <div class="form-group">
                  <label for="nationality_president">Nacionalidade</label>
                  <select class="custom-select" id="nationality_president" name="nationality_president">
                    <option value=""></option>
                    <option value="Brasileira">Brasileira</option>
                    <option value="Estrangeira">Estrangeira</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4 pl-md-1 pr-1">
                <div class="form-group">
                  <label for="phoneNumber_president">Telefone</label>
                  <input type="text" name="phoneNumber_president" id="phone" class="form-control"
                    value="<?php echo set_value('phoneNumber_president'); ?>">
                  <?php echo form_error('phoneNumber_president'); ?>
                </div>
              </div>
              <div class="col-md-4 pr-1 pl-md-1">
                <div class="form-group">
                  <label for="email_president">Email</label>
                  <input type="text" name="email_president" id="email_president" class="form-control"
                    value="<?php echo set_value('email_president'); ?>">
                  <?php echo form_error('email_president'); ?>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label class="newimgum">
                  <img id="imgum" class="foto_condominio" src="<?php echo base_url(); ?>assets/build/img/plus.jpg"
                    width="200px">
                  <input id="picimgum" class='pis' name="img_commission_members" type="file" style="display:none;">
                  <br><br>
                </label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 d-flex justify-content-end">
                <a href="<?php echo base_url()?>commission_members" class="btn btn-secundary mr-1">Voltar</a>
                <button type="submit" name="register_commission_member" class="btn btn-primary">Cadastrar</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php $this->load->view('elements/footer');?>
