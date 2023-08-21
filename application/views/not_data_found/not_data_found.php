<?php $this->load->view('elements/header'); ?>
<div class="wrapper ">
  <?php $this->load->view('elements/sidebar_lateral'); ?>
  <?php $this->load->view('elements/sidebar'); ?>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <img class="marca_dagua" src="<?php echo base_url(); ?>assets/build/img/logo-sisreurb-removebg.png" alt="" draggable="false">
        <div class="row position-relative">
          <div class="col-md-12">
            <div class="card card-stats">
              <div class="card-body py-5">
                <div class="row">
                  <div class="col-md-12 text-center">
                      <i class="fas fa-5x fa-exclamation-triangle text-warning"></i>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 d-flex justify-content-center">
                    <h4 class="font-weight-bold">
                      <?php echo $data_error; ?>
                    </h4>
                  </div>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('elements/footer'); ?>
