<?php $this->load->view('elements/header');?>
<div class="wrapper ">
  <?php $this->load->view('elements/sidebar_lateral');?>
  <?php $this->load->view('elements/sidebar');?>
  <div class="content">

    <div class="row">
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
                  <p style="font-size:17px">Procedimentos de REURB<p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <hr>
            <div class="stats">
              <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url();?>procedure_reurb">Acessar</a>
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
                  <p style="font-size:17px">Decisão Instauradora<p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <hr>
            <div class="stats">
              <button type="button" name="button" class="btn btn-sm btn-primary float-right"
                data-toggle="modal" data-target="#modal_initiating_decision"
                >
                  Acessar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="modal_initiating_decision" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content modal-lg">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Decisão Instauradora</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?php echo base_url(); ?>forms/initiating_decision" target="_blank" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="process_number">Procedimento</label>
                  <select class="form-control " id="process_number_rcrf"
                    data-classe="id_process_statement"
                    name="process_number">
                    <option value=""></option>
                    <?php foreach ($requirements as $row): ?>
                      <option value="<?php echo $row->id; ?>">
                        <?php echo $row->process_number; ?>.<?php echo $row->stage; ?>.<?php echo  str_pad( $row->id , 3 , '0' , STR_PAD_LEFT); ?> / <?php echo $row->core_name; ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" name="application_registration_land" class="btn btn-primary  float-right">Acessar</button>
            <input type="hidden" name="id_process_statement" class="id_process_statement" value="">
          </div>
        </form>
      </div>
    </div>
  </div>

<?php $this->load->view('elements/footer');?>
