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
              <h5 class="card-title">Cadastrar cliente</h5>
            </div>
            <div class="card-body">
              <form action="" method="post">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="empresa">Empresa</label>
                      <input type="text" name="empresa" id="empresa" class="form-control" placeholder="Empresa" value="<?php echo set_value('empresa'); ?>">
                      <?php echo form_error('empresa'); ?>
                    </div>
                  </div>
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label for="cnpj">CNPJ</label>
                      <input type="text" name="cnpj" id="cnpj" class="form-control" placeholder="CNPJ" value="<?php echo set_value('cnpj'); ?>">
                      <?php echo form_error('cnpj'); ?>
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-1">
                    <div class="form-group">
                      <label for="ramo">Ramo</label>
                      <input type="text" name="ramo" id="ramo" class="form-control" placeholder="Ramo" value="<?php echo set_value('ramo'); ?>">
                      <?php echo form_error('ramo'); ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label for="responsavel">Responsável</label>
                      <input type="text" name="responsavel" id="responsavel" class="form-control" placeholder="Responsável" value="<?php echo set_value('responsavel'); ?>">
                      <?php echo form_error('responsavel'); ?>
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-1">
                    <div class="form-group">
                      <label for="cargo">Cargo</label>
                      <input type="text" name="cargo" id="cargo" class="form-control" placeholder="Cargo" value="<?php echo set_value('cargo'); ?>">
                      <?php echo form_error('cargo'); ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label for="telefone">Telefone</label>
                      <input type="text" name="telefone" id="telefone" class="form-control" placeholder="Telefone" value="<?php echo set_value('telefone'); ?>">
                      <?php echo form_error('telefone'); ?>
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-1">
                    <div class="form-group">
                      <label for="email">E-mail</label>
                      <input type="text" name="email" id="email" class="form-control" placeholder="E-mail" value="<?php echo set_value('email'); ?>">
                      <?php echo form_error('email'); ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="checkbox" name="construtora" id="construtora" >
                      <label for="construtora">Construtora / Incorporadora</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <button type="submit" name="cadastrar_cliente" class="btn btn-primary btn-round float-md-right float-sm-right float-xs-right">Cadastrar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php $this->load->view('elements/footer');?>
