<?php $this->load->view('elements/header'); ?>
<div class="wrapper ">
  <?php $this->load->view('elements/sidebar_lateral'); ?>
  <?php $this->load->view('elements/sidebar'); ?>
    <!<!-- <?php echo "lucas"; ?>  -->
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
        <img class="marca_dagua" src="<?php echo base_url(); ?>assets/build/img/logo-sisreurb-removebg.png" alt="" draggable="false">
        <div class="row position-relative">
          <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row align-items-center">
                  <div class="col-3 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="fas fa-scroll  text-danger"></i>
                    </div>
                  </div>
                  <div class="col-9 col-md-8">
                    <div class="">
                      <p style="font-size:17px" class="">Cadastro de requerente
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
                      <i class="fas fa-folder-open text-danger"></i>
                    </div>
                  </div>
                  <div class="col-9 col-md-8">
                    <div class="">
                      <p style="font-size:17px" class="">Protocolos
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
                      <p style="font-size:17px" class="">Requerimento simples<p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url(); ?>forms/simple_requirement"
                    data-toggle="modal" data-target="#modal_simple_requiriment">
                    Acessar
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modal_simple_requiriment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Requerimento Simples</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?php echo base_url(); ?>forms/simple_requirement" method="post" target="_blank">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="document_requester">Documento do requerente</label>
                  <input type="text" name="document_requester" value="" class="form-control cpf" id="document_requester">
                  <!-- <input type="text" name="document_requester" value="" class="form-control cpfCnpj" id="document_requester"> -->
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 font-weight-bold">
                <p id="name"></p>
                <p id="phone"></p>
                <p id="email"></p>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <input type="hidden" name="id_requester" value="" id="id_requester">
            <button type="submit" class="btn btn-primary">Gerar</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <?php $this->load->view('elements/footer'); ?>
