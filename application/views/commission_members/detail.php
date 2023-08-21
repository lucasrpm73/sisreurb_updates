<?php $this->load->view('elements/header');?>
<div class="wrapper ">
  <?php $this->load->view('elements/sidebar');?>
  <?php $this->load->view('elements/sidebar_lateral');?>
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
      <div class="col-md-4">
        <div class="card ">
          <div class="card-header text-center">
            <form method="post"
              action="<?php echo base_url(); ?>commission_members/update_image/<?php echo $member_commission->id; ?>"
              enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                  <label class="newimgum">
                    <img src="<?php echo base_url(); ?>assets/build/img/commission_members/<?php echo $member_commission->img; ?>" id="imgum" class="foto_condominio">
                    <!-- <?php //if ($member_commission->img == 'perfil.png'): ?>
                      <?php //else: ?>
                        <img id="imgum" class="foto_condominio"
                          src="data:image/png;base64,<?php echo base64_encode($member_commission->img); ?>"
                          width="150px">
                    <?php //endif; ?> -->
                    <input id="picimgum" class='pis' name="img_commission_members" type="file" style="display:none;">
                  </label>
                </div>
                <div class="col-md-12">
                  <button class="btn btn-sm btn-primary" style="display:none;" id="save" type="submit">salvar</button>
                </div>

              </div>
            </form>
          </div>
          <div class="card-body text-center">
            <p class="border-bottom" id=""><?php echo $member_commission->type_register; ?></p>
            <p class="border-bottom" id=""><?php echo $member_commission->representative; ?></p>
            <p class="border-bottom" id=""><?php echo $member_commission->appointment_ordinance; ?></p>
          </div>
        </div>
      </div>
      <!-- END CARD -->


      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Detalhes</h4>
            <hr>
          </div>
          <form
            action="<?php echo base_url(); ?>commission_members/update_commission_members/<?php echo $member_commission->id; ?>"
            method="post">
            <div class="card-body">
              <div class="row mt-0">

                <div class="col-md pr-md-1 ">
                  <label for="active_commission">Comissão ativa?</label>
                  <select class="custom-select" name="active_commission" id="active_commission">
                    <?php if ($member_commission->status == 1): ?>
                    <option value="1" selected>Sim</option>
                    <option value="0">Não</option>
                    <?php else: ?>
                    <option value="1">Sim</option>
                    <option value="0" selected>Não</option>
                    <?php endif; ?>
                  </select>
                </div>

                <div class="col-md pr-md-1 pl-md-1">
                  <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="form-control"
                      value="<?php echo $member_commission->cpf; ?>">
                  </div>
                </div>
                <div class="col-md pl-md-1">
                  <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control"
                      value="<?php echo $member_commission->name; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 pr-md-1">
                  <div class="form-group">
                    <label for="rg">R.G</label>
                    <input type="text" name="rg" id="rg" class="form-control"
                      value="<?php echo $member_commission->rg; ?>">
                  </div>
                </div>
                <div class="col-md-4 pr-md-1 pl-md-1">
                  <div class="form-group">
                    <label for="org_exp">Órgão expeditor</label>
                    <input type="text" name="org_exp" id="org_exp" class="form-control"
                      value="<?php echo $member_commission->dispatcher; ?>">
                  </div>
                </div>
                <div class="col-md-4 pl-md-1">
                  <div class="form-group">
                    <label for="nascimento">Data de nascimento</label>
                    <input type="date" name="birth_date" id="" class="form-control"
                      value="<?php echo $member_commission->birth_date; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-md-1">
                  <label for="">Gênero</label>
                  <select class="custom-select" id="gender" name="gender">
                    <option value=""></option>
                    <?php if ($member_commission->gender == 'M'): ?>
                    <option value="M" selected>Masculino</option>
                    <option value="F">Feminino</option>
                    <?php else: ?>
                    <option value="F" selected>Feminino</option>
                    <option value="M">Masculino</option>
                    <?php endif; ?>
                  </select>
                </div>
                <div class="col-md-6 pl-md-1">
                  <label for="">Nacionalidade</label>
                  <select class="custom-select" id="nationality" name="nationality">
                    <option value=""></option>
                    <?php if ($member_commission->nationality == 'Estrangeira'): ?>
                    <option value="Brasileira">Brasileira</option>
                    <option value="Estrangeira" selected>Estrangeira</option>
                    <?php else: ?>
                    <option value="Brasileira" selected>Brasileira</option>
                    <option value="Estrangeira">Estrangeira</option>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-md-1">
                  <div class="form-group">
                    <label for="">Telefone</label>
                    <input type="text" name="phone" id="phone" class="form-control"
                      value="<?php echo $member_commission->phone; ?>">
                  </div>
                </div>
                <div class="col-md-6 pl-md-1">
                  <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" id="email" class="form-control"
                      value="<?php echo $member_commission->email; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                  <div class="form-group">
            <a href="<?php echo base_url()?>commission_members" class="btn btn-secundary mr-1">Voltar</a>
                    <button type="submit" name="register_commission_member"
                      class="btn btn-primary">Atualizar</button>
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
