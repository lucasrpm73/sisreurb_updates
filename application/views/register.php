<?php $this->load->view('elements/header'); ?>
<div class="wrapper ">
  <?php $this->load->view('elements/sidebar_lateral'); ?>
  <?php $this->load->view('elements/sidebar'); ?>
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
      <?php //if ($_SESSION['user']['profile'] == '1'): 
      ?>
      <div class="col-lg-4 col-md-4 col-sm-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row align-items-center">
              <div class="col-3 col-md-4">
                <div class="icon-big text-center icon-warning">
                  <i class="fas fa-folder-open text-danger"></i>
                </div>
              </div>
              <div class="col-9 col-md-8">
                <div class="">
                  <p style="font-size:17px" class="">Comissão de Regularização Fundiária Urbana
                  <p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer ">
            <hr>
            <div class="stats">
              <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url(); ?>commission_members">Acessar</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row align-items-center">
              <div class="col-3 col-md-4">
                <div class="icon-big text-center icon-warning">
                  <i class="fas fa-building text-danger"></i>
                </div>
              </div>
              <div class="col-9 col-md-8">
                <div class="">
                  <p style="font-size:17px" class="">Cartórios
                  <p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer ">
            <hr>
            <div class="stats">
              <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url(); ?>notarys_office">Acessar</a>
            </div>
          </div>
        </div>
      </div>
      <?php //endif; 
      ?>
      <div class="col-lg-4 col-md-4 col-sm-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row align-items-center">
              <div class="col-3 col-md-4">
                <div class="icon-big text-center icon-warning">
                  <i class="fas fa-address-card text-danger"></i>
                </div>
              </div>
              <div class="col-9 col-md-8">
                <div class="">
                  <p style="font-size:17px">Requerentes
                  <p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer ">
            <hr>
            <div class="stats">
              <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url(); ?>requesters">Acessar</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row align-items-center">
              <div class="col-3 col-md-4">
                <div class="icon-big text-center icon-warning">
                  <i class="fas fa-calendar-alt text-danger"></i>
                </div>
              </div>
              <div class="col-9 col-md-8">
                <div class="">
                  <p style="font-size:17px">Gestão de procedimentos de REURB
                  <p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <hr>
            <div class="stats">
              <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url(); ?>procedure_reurb">Acessar</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row align-items-center">
              <div class="col-3 col-md-4">
                <div class="icon-big text-center icon-warning">
                  <i class="fas fa-calendar-alt text-danger"></i>
                </div>
              </div>
              <div class="col-9 col-md-8">
                <div>
                  <p style="font-size:17px">Cadastro de Procedimentos Administrativos
                  <p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <hr>
            <div class="stats">
              <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url(); ?>register_procedure_reurb/registers">Acessar</a>
            </div>
          </div>
        </div>
      </div>
      <?php //if ($_SESSION['user']['profile'] == "1") { 
      ?>
      <div class="col-lg-4 col-md-4 col-sm-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row align-items-center">
              <div class="col-4 col-md-4">
                <div class="icon-big text-center icon-warning">
                  <i class="fas fa-user-cog text-danger"></i>
                </div>
              </div>
              <div class="col-8 col-md-8">
                <div class="">
                  <p style="font-size:17px">Usuários
                  <p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <hr>
            <div class="stats">
              <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url(); ?>users">Acessar</a>
            </div>
          </div>
        </div>
      </div>
      <?php //} 
      ?>
    </div>
  </div>
  <?php $this->load->view('elements/footer'); ?>