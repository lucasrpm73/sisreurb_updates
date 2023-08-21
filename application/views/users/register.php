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
          <div class="card card-user">
            <div class="card-header">
            <a href="<?php echo base_url()?>users" class="btn btn-secundary mb-2 float-right">Voltar</a>
              <h5 class="card-title">Cadastrar usuário</h5>
              <hr>
            </div>
            <div class="card-body">
              <form action="<?php echo base_url(); ?>users/register" method="post">
                <div class="row pt-2">
                  <div class="col-md-3 pr-md-1">
                    <div class="form-group">
                      <label for="cpf_account">CPF</label>
                      <input type="text" name="cpf_account" id="cpf_account" value="" class="form-control cpf"
                        >
                    </div>
                  </div>
                  <div class="col-md-3 px-md-1">
                    <div class="form-group">
                      <label for="account_manager">Responsavel da conta</label>
                      <input type="text" name="account_manager" id="account_manager" value="" class="form-control"
                        >
                    </div>
                  </div>
                  <div class="col-md-3 px-md-1">
                    <div class="form-group">
                      <label for="phone_account">Telefone</label>
                      <input type="text" name="phone_account" id="phone_account" value="" class="form-control phone"
                        >
                    </div>
                  </div>
                  <div class="col-md-3 pl-md-1">
                    <div class="form-group">
                      <label for="profile_user">Perfil</label>
                      <select class="form-control" name="profile" id="profile_user">
                        <option value=""></option>
                        <option value="1">Master</option>
                        <option value="0">Padrão</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 pr-md-1">
                    <div class="form-group">
                      <label for="email_account">Email</label>
                      <input type="email" name="email_account" id="email_account" value="" class="form-control"
                        >
                    </div>
                  </div>
                  <div class="col-md-4 px-md-1">
                    <div class="form-group">
                      <label for="password">Senha</label>
                      <input type="password" name="password" id="password" value="" class="form-control" >
                    </div>
                  </div>
                  <div class="col-md-4 pl-md-1">
                    <div class="form-group">
                      <label for="repeat_password">Repita a senha</label>
                      <input type="password" name="repeat_password" id="repeat_password" value="" class="form-control"
                        >
                    </div>
                    <div class="row" id="error_password" style="display: none;">
                      <div class="col-md-12">
                        <p style="color: red !important;">As senhas devem ser iguais!!</p>
                      </div>
                    </div>
                  </div>
                </div>

                <h4 class="text-dark">Endereço Residencial</h4>
                <div class="row mt-3">
                  <div class="col-md pr-md-1">
                    <div class="form-group">
                      <label for="account_type_home">Tipo de logradouro</label>
                      <select class="form-control" name="account_type_home" id="account_type_home">
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
                      <label for="account_public_place">Logradouro</label>
                      <input type="text" name="account_public_place" id="account_public_place" class="form-control"
                        value="<?php echo set_value('account_public_place'); ?>">
                      <?php echo form_error('account_public_place'); ?>
                    </div>
                  </div>
                  <div class="col-md pl-md-1">
                    <div class="form-group">
                      <label for="account_number_home">Numero</label>
                      <input type="text" name="account_number_home" id="account_number_home" class="form-control"
                        value="<?php echo set_value('account_number_home'); ?>">
                      <?php echo form_error('account_number_home'); ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md pr-md-1">
                    <div class="form-group">
                      <label for="account_complement_home">Complemento</label>
                      <input type="text" name="account_complement_home" id="account_complement_home"
                        class="form-control" value="<?php echo set_value('account_complement_home'); ?>">
                      <?php echo form_error('account_complement_home'); ?>
                    </div>
                  </div>
                  <div class="col-md pl-md-1">
                    <div class="form-group">
                      <label for="account_neighborhood_home">Bairro</label>
                      <input type="text" name="account_neighborhood_home" id="account_neighborhood_home"
                        class="form-control" value="<?php echo set_value('account_neighborhood_home'); ?>">
                      <?php echo form_error('account_neighborhood_home'); ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md pr-md-1">
                    <div class="form-group">
                      <label for="account_city_home">Cidade</label>
                      <input type="text" name="account_city_home" id="account_city_home" class="form-control"
                        value="<?php echo set_value('account_city_home'); ?>">
                      <?php echo form_error('account_city_home'); ?>
                    </div>
                  </div>
                  <div class="col-md px-md-1">
                    <div class="form-group">
                      <label for="account_cep_home">CEP</label>
                      <input type="text" name="account_cep_home" id="account_cep_home" class="form-control cep"
                        value="<?php echo set_value('account_cep_home'); ?>">
                      <?php echo form_error('account_cep_home'); ?>
                    </div>
                  </div>
                  <div class="col-md pl-md-1">
                    <div class="form-group">
                      <label for="account_uf_home">UF</label>
                      <input type="text" name="account_uf_home" id="account_uf_home" class="form-control"
                        value="<?php echo set_value('account_uf_home'); ?>">
                      <?php echo form_error('account_uf_home'); ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md">
                    <div class="form-group">
                      <label for="account_country_home">País</label>
                      <input type="text" name="account_country_home" id="account_country_home" class="form-control"
                        value="<?php echo set_value('account_country_home'); ?>">
                      <?php echo form_error('account_country_home'); ?>
                    </div>
                  </div>
                </div>

                <!-- <div class="row">
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label>Nome **</label>
                      <input type="text" name="name" class="form-control" placeholder="Nome" value="<?php echo set_value('name'); ?>" autocomplete="off">
                      <?php echo form_error('name'); ?>
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-1">
                    <div class="form-group">
                      <label for="profile">Perfil **</label>
                      <select class="form-control" name="profile" id="profile">
                        <option value=""></option>
                        <option value="1">Administrador</option>
                        <option value="2">Agendador</option>
                      </select>
                      <?php echo form_error('perfil'); ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label for="email">E-mail **</label>
                      <input type="text" name="email" id="email" class="form-control" placeholder="E-mail" value="<?php echo set_value('email'); ?>" autocomplete="off">
                      <?php echo form_error('email'); ?>
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-1">
                    <div class="form-group">
                      <label for="password">Senha **</label>
                      <input type="password" name="password" id="password" class="form-control" placeholder="Senha" value="" autocomplete="off">
                      <?php echo form_error('senha'); ?>
                    </div>
                  </div>
                </div> -->
                <div class="row">
                  <div class="col-md-12">
                    <button type="submit" name="register_user" class="btn btn-primary btn-round float-md-right float-sm-right float-xs-right">Cadastrar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
<?php $this->load->view('elements/footer');?>
