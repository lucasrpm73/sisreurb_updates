<?php $this->load->view('elements/header');?>
<div class="wrapper ">
   
  <?php $this->load->view('elements/sidebar_lateral');?>
    
  <?php $this->load->view('elements/sidebar');?>
     
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 d-flex justify-content-center my-5">
                <img src="<?php echo base_url(); ?>assets/build/img/logo.png" alt="" class="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php $this->load->view('elements/footer');?>
