<?php $this->load->view('elements/header');?>
<div class="wrapper ">
  <?php $this->load->view('elements/sidebar_lateral');?>
  <?php $this->load->view('elements/sidebar');?>
  <div class="content">
    <!-- INI: AVISOS -->
    <?php if (!empty($error)) { ?>
      <div class="alert alert-<?php echo $error['error_type']; ?>" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <?php echo $error['error_string']; ?>
      </div>
    <?php } ?>
    <!-- INI: AVISOS -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title text-center d-inline"><?php echo $user_detail->name; ?></h4>
            <a href="<?php echo base_url()?>users" class="btn btn-secundary mb-2 float-right">Voltar</a>
            <hr>
          </div>
          <div class="card-body">

          </div>
        </div>
      </div>

    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card card-user">
          <div class="card-body">
            <form id="form_update_user" action="<?php echo base_url()?>users/update_user" method="post">
              <div class="row pt-2">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="status">Situacao **</label>
                    <select class="form-control" name="status" id="status">
                      <option value=""></option>
                      <option value="1" <?php echo $user_detail->status=='1'?'selected':''; ?>>Ativado</option>
                      <option value="0" <?php echo $user_detail->status=='0'?'selected':''; ?>>Desativado</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 pr-md-1">
                  <div class="form-group">
                    <label for="cpf_account">CPF</label>
                    <input type="text" name="cpf_account" id="cpf_account" value="<?php echo $user_detail->cpf; ?>" class="form-control cpf"
                      >
                  </div>
                </div>
                <div class="col-md-3 px-md-1">
                  <div class="form-group">
                    <label for="account_manager">Responsavel da conta</label>
                    <input type="text" name="name" id="account_manager" value="<?php echo $user_detail->name; ?>" class="form-control"
                      >
                  </div>
                </div>
                <div class="col-md-3 px-md-1">
                  <div class="form-group">
                    <label for="phone_account">Telefone</label>
                    <input type="text" name="phone_account" id="phone_account" value="<?php echo $user_detail->phone; ?>" class="form-control phone"
                      >
                  </div>
                </div>
                <div class="col-md-3 pl-md-1">
                  <div class="form-group">
                    <label for="profile_user">Perfil</label>
                    <select class="form-control" name="profile" id="profile_user">
                      <option value=""></option>
                      <option value="1" <?php echo ($user_detail->profile == '1')? 'selected' : ''; ?>>Master</option>
                      <option value="0" <?php echo ($user_detail->profile == '0')? 'selected' : ''; ?>>Padrão</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 pr-md-1">
                  <div class="form-group">
                    <label for="email_account">Email</label>
                    <input type="email" name="email" id="email_account" value="<?php echo $user_detail->email; ?>" class="form-control"
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
                      <p style="color: red !important;">As senhas não são iguais</p>
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
                      <option value="Alameda" <?= ($address->type_street == 'Alameda') ? 'selected' : '' ;?>>Alameda</option>
                      <option value="Avenida" <?= ($address->type_street == 'Avenida') ? 'selected' : '' ;?>>Avenida</option>
                      <option value="Praça" <?= ($address->type_street == 'Praça') ? 'selected' : '' ;?>>Praça</option>
                      <option value="Rua" <?= ($address->type_street == 'Rua') ? 'selected' : '' ;?>>Rua</option>
                      <option value="Travessa" <?= ($address->type_street == 'Travessa') ? 'selected' : '' ;?>>Travessa</option>
                      <option value="Via" <?= ($address->type_street == 'Via') ? 'selected' : '' ;?>>Via</option>
                      <option value="Viela" <?= ($address->type_street == 'Viela') ? 'selected' : '' ;?>>Viela</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4 px-md-1">
                  <div class="form-group">
                    <label for="account_public_place">Logradouro</label>
                    <input type="text" name="account_public_place" id="account_public_place" class="form-control"
                      value="<?php echo $address->street; ?>">
                    <?php echo form_error('account_public_place'); ?>
                  </div>
                </div>
                <div class="col-md pl-md-1">
                  <div class="form-group">
                    <label for="account_number_home">Numero</label>
                    <input type="text" name="account_number_home" id="account_number_home" class="form-control"
                      value="<?php echo $address->number; ?>">
                    <?php echo form_error('account_number_home'); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md pr-md-1">
                  <div class="form-group">
                    <label for="account_complement_home">Complemento</label>
                    <input type="text" name="account_complement_home" id="account_complement_home"
                      class="form-control" value="<?php echo $address->complement; ?>">
                    <?php echo form_error('account_complement_home'); ?>
                  </div>
                </div>
                <div class="col-md pl-md-1">
                  <div class="form-group">
                    <label for="account_neighborhood_home">Bairro</label>
                    <input type="text" name="account_neighborhood_home" id="account_neighborhood_home"
                      class="form-control" value="<?php echo $address->neighborhood; ?>">
                    <?php echo form_error('account_neighborhood_home'); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md pr-md-1">
                  <div class="form-group">
                    <label for="account_city_home">Cidade</label>
                    <input type="text" name="account_city_home" id="account_city_home" class="form-control"
                      value="<?php echo $address->city; ?>">
                    <?php echo form_error('account_city_home'); ?>
                  </div>
                </div>
                <div class="col-md px-md-1">
                  <div class="form-group">
                    <label for="account_cep_home">CEP</label>
                    <input type="text" name="account_cep_home" id="account_cep_home" class="form-control cep"
                      value="<?php echo $address->cep; ?>">
                    <?php echo form_error('account_cep_home'); ?>
                  </div>
                </div>
                <div class="col-md pl-md-1">
                  <div class="form-group">
                    <label for="account_uf_home">UF</label>
                    <input type="text" name="account_uf_home" id="account_uf_home" class="form-control"
                      value="<?php echo $address->uf; ?>">
                    <?php echo form_error('account_uf_home'); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label for="account_country_home">País</label>
                    <input type="text" name="account_country_home" id="account_country_home" class="form-control"
                      value="<?php echo $address->country; ?>">
                    <?php echo form_error('account_country_home'); ?>
                  </div>
                </div>
              </div>

              <!-- <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nome"
                      value="<?php echo $user_detail->name; ?>">
                  </div>
                </div>
                <div class="col-md-6 pl-md-1">
                  <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="exemplo@email.com"
                      value="<?php echo $user_detail->email; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-md-1">
                  <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" name="password" value="" id="password" class="form-control">
                  </div>
                </div>
                <div class="col-md-6 pl-md-1">
                  <div class="form-group">
                    <label for="repeat_password">Repita a senha</label>
                    <input type="password" name="repeat_password" id="repeat_password" value="" class="form-control">
                  </div>
                  <div class="row" id="error_password" style="display: none;">
                    <div class="col-md-12">
                      <p style="color: red !important;">As senhas não são iguais</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label for="profile">Perfil **</label>
                    <select class="form-control" name="profile" id="profile">
                      <option value=""></option>
                      <option value="1" <?php echo $user_detail->profile=='1'?'selected':''; ?>>Administrador</option>
                      <option value="2" <?php echo $user_detail->profile=='2'?'selected':''; ?>>Agendador</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6 pl-md-1">
                  <div class="form-group">
                    <label for="status">Situacao **</label>
                    <select class="form-control" name="status" id="status">
                      <option value=""></option>
                      <option value="1" <?php echo $user_detail->status=='1'?'selected':''; ?>>Ativado</option>
                      <option value="0" <?php echo $user_detail->status=='0'?'selected':''; ?>>Desativado</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="note">Observação</label>
                    <textarea name="note" id="note" class="form-control textarea"><?php echo $user_detail->note; ?></textarea>
                  </div>
                </div>
              </div> -->
              <div class="row">
                <div class="update ml-auto mr-auto">
                  <input type="hidden" name="id_user" value="<?php echo $user_detail->id; ?>">
                  <input type="hidden" name="id_address_user" value="<?php echo $address->id; ?>">
                  <button id="update_user" name="update_user" class="btn btn-primary btn-round">Alterar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAlterar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar dados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Realmente editar dados?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" id="btn_modal_alterar_usuario" class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('elements/footer');?>
<script type="text/javascript">
  $(document).on('click', '#alterar_usuario', function () {
    $('#modalAlterar').modal('show');
    return false;
  });

  $(document).on('click', '#btn_modal_alterar_usuario', function () {
    $('#form_alterar_usuario').submit();
  });
</script>
