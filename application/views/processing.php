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
      <div class="col-lg-4 col-md-4 col-sm-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row align-items-center">
              <div class="col-4 col-md-4">
                <div class="icon-big text-center icon-warning">
                  <i class="fas fa-scroll text-danger"></i>
                </div>
              </div>
              <div class="col-8 col-md-8">
                <div class="">
                  <p style="font-size:17px">Protocolos
                  <p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer ">
            <hr>
            <div class="stats">
              <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url(); ?>protocols">Acessar</a>
            </div>
          </div>
        </div>
      </div>
      <?php //if ($_SESSION['user']['profile'] == "1"): 
      ?>
      <div class="col-lg-4 col-md-4 col-sm-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row align-items-center">
              <div class="col-4 col-md-4">
                <div class="icon-big text-center icon-warning">
                  <i class="fas fa-balance-scale text-danger"></i>
                </div>
              </div>
              <div class="col-8 col-md-8">
                <div class="">
                  <p style="font-size:17px">Instauração do Procedimento
                  <p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <hr>
            <div class="stats">
              <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url(); ?>establishment_procedure">Acessar</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row align-items-center">
              <div class="col-4 col-md-4">
                <div class="icon-big text-center icon-warning">
                  <i class="fas fa-balance-scale text-danger"></i>
                </div>
              </div>
              <div class="col-8 col-md-8">
                <div class="">
                  <p style="font-size:17px">Saneamento de Processos
                  <p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <hr>
            <div class="stats">
              <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url(); ?>process_sanitation">Acessar</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row align-items-center">
              <div class="col-4 col-md-4">
                <div class="icon-big text-center icon-warning">
                  <i class="far fa-check-circle text-danger"></i>
                </div>
              </div>
              <div class="col-8 col-md-8">
                <div class="">
                  <p style="font-size:17px">Conclusão da REURB
                  <p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <hr>
            <div class="stats">
              <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url(); ?>reurb_conclusion">Acessar</a>
            </div>
          </div>
        </div>
      </div>
      <?php //endif; 
      ?>

    </div>
  </div>
  <?php $this->load->view('elements/footer'); ?>