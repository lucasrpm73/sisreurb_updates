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
      <div class="col-md-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row align-items-center">
              <div class="col-3">
                <div class="icon-big text-center icon-warning">
                  <i class="nc-icon nc-bag-16 text-danger "></i>
                </div>
              </div>
              <div class="col-9">
                <div class="">
                  <p style="font-size:17px">Auto de demarcação urbanística<p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <hr>
            <div class="stats">
              <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url(); ?>forms/
self_urban_demarcation" target="_blank">Acessar</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row align-items-center">
              <div class="col-3">
                <div class="icon-big text-center icon-warning">
                  <i class="nc-icon nc-bag-16 text-danger "></i>
                </div>
              </div>
              <div class="col-9">
                <div class="">
                  <p style="font-size:17px">Requerimento para averbação do auto de demarcação urbanística<p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <hr>
            <div class="stats">
              <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url(); ?>forms/application_for_urban_demarcation" target="_blank">Acessar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row align-items-center">
              <div class="col-3">
                <div class="icon-big text-center icon-warning">
                  <i class="nc-icon nc-bag-16 text-danger "></i>
                </div>
              </div>
              <div class="col-9">
                <div class="">
                  <p style="font-size:17px">Certidão de regularização fundiária – C.R.F<p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <hr>
            <div class="stats">
              <button type="button" name="button" class="btn btn-sm btn-primary float-right"
                data-toggle="modal" data-target="#modal_generate_crf"
                >
                  Acessar
              </button>
              <!-- <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url(); ?>reurb_conclusion/generate">Acessar</a> -->
              <!-- <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url(); ?>forms/land_regularization_certificate" target="_blank">Acessar</a> -->
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row align-items-center">
              <div class="col-3">
                <div class="icon-big text-center icon-warning">
                  <i class="nc-icon nc-bag-16 text-danger"></i>
                </div>
              </div>
              <div class="col-9">
                <div class="">
                  <p style="font-size:17px">Decisão de Conclusão da Regularização Fundiária Urbana<p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <hr>
            <div class="stats">
              <button type="button" name="button" class="btn btn-sm btn-primary float-right"
                data-toggle="modal" data-target="#modal_generate_dcrf"
                >
                  Acessar
              </button>
              <!-- <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url(); ?>forms/decision_to_complete_urban_land_regularization" target="_blank">Acessar</a> -->

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row align-items-center">
              <div class="col-3">
                <div class="icon-big text-center icon-warning">
                  <i class="nc-icon nc-bag-16 text-danger "></i>
                </div>
              </div>
              <div class="col-9">
                <div class="">
                  <p style="font-size:17px">Requerimento para registro de certidão de regularização fundiária<p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <hr>
            <div class="stats">
              <button type="button" name="button" class="btn btn-sm btn-primary float-right"
                data-toggle="modal" data-target="#modal_generate_rcr"
              >
                  Acessar
              </button>
              <!-- <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url(); ?>forms/application_for_registration_of_land_regularization_certificate" target="_blank">Acessar</a> -->
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row align-items-center">
              <div class="col-3">
                <div class="icon-big text-center icon-warning">
                  <i class="nc-icon nc-bag-16 text-danger "></i>
                </div>
              </div>
              <div class="col-9">
                <div class="">
                  <p style="font-size:17px">Listagem dos ocupantes<p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <hr>
            <div class="stats">
              <button type="button" name="button" class="btn btn-sm btn-primary float-right"
                data-toggle="modal" data-target="#modal_generate_occupants"
              >
                  Acessar
              </button>
              <!-- <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url(); ?>forms/application_for_registration_of_land_regularization_certificate" target="_blank">Acessar</a> -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row align-items-center">
              <div class="col-3">
                <div class="icon-big text-center icon-warning">
                  <i class="nc-icon nc-bag-16 text-danger "></i>
                </div>
              </div>
              <div class="col-9">
                <div class="">
                  <p style="font-size:17px">Indicação Numérica das Unidades<p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <hr>
            <div class="stats">
              <button type="button" name="button" class="btn btn-sm btn-primary float-right"
                data-toggle="modal" data-target="#modal_generate_indication"
              >
                  Acessar
              </button>
              <!-- <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url(); ?>forms/application_for_registration_of_land_regularization_certificate" target="_blank">Acessar</a> -->
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row align-items-center">
              <div class="col-3">
                <div class="icon-big text-center icon-warning">
                  <i class="nc-icon nc-bag-16 text-danger "></i>
                </div>
              </div>
              <div class="col-9">
                <div class="">
                  <p style="font-size:17px">Título de legitimação fundiária urbana individual<p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <hr>
            <div class="stats">
              <button type="button" name="button" class="btn btn-sm btn-primary float-right"
                data-toggle="modal" data-target="#modal_generate_individual"
              >
                  Acessar
              </button>
            </div>
              <!-- <a class="btn btn-sm btn-primary float-right" href="<?php echo base_url(); ?>forms/application_for_registration_of_land_regularization_certificate" target="_blank">Acessar</a> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Modal Gerar C.R.F -->
<div class="modal fade" id="modal_generate_crf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Certidão de regularização fundiária – C.R.F</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>forms/land_regularization_certificate" target="_blank" method="post">
        <div class="modal-body">
          <div class="row error_process_embarkation" style="display: none;">
            <div class="col-md-12 text-center">
              <p class="alert alert-danger font-weight-bold">Procedimento embargado</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="process_number">Procedimento</label>
                <select class="form-control process_number" id="process_number" name="process_number"
                  data-classe="id_process">
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
          <div class="row">
            <div class="col-md-6 pr-md-1">
              <div class="form-group">
                <label for="modalidade">Modalidade</label>
                <select class="form-control modalidade" name="modalidade">
                  <option value=""></option>
                  <option value="REURB-E">REURB-E</option>
                  <option value="REURB-S">REURB-S</option>
                </select>
              </div>
            </div>
            <div class="col-md-6 pl-md-1">
              <div class="form-group">
                <label for="cartorio">Cartório</label>
                <select class="form-control cartorio" name="cartorio">
                  <option value=""></option>
                  <?php foreach ($notarys_office as $row): ?>
                    <option value="<?php echo $row->id; ?>"><?php echo $row->name_registry; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" name="land_regularization_certificate" class="btn btn-primary float-right btn_modal_form land_regularization_certificate">Acessar</button>
          <input type="hidden" name="id_process" class="id_process" value="">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Gerar R.R.C.R.F -->
<div class="modal fade" id="modal_generate_rcr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Requerimento para registro de certidão de regularização fundiária</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>forms/application_for_registration_of_land_regularization_certificate" target="_blank" method="post">
        <div class="modal-body">
          <div class="row error_process_embarkation" style="display: none;">
            <div class="col-md-12 text-center">
              <p class="alert alert-danger font-weight-bold">Procedimento embargado</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="process_number">Procedimento</label>
                <select class="form-control process_number" id="process_number_rcrf"
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
          <div class="row">
            <div class="col-md-6 pr-md-1">
              <div class="form-group">
                <label for="modalidade">Modalidade</label>
                <select class="form-control modalidade" name="">
                  <option value=""></option>
                  <option value="REURB-E">REURB-E</option>
                  <option value="REURB-S">REURB-S</option>
                </select>
              </div>
            </div>
            <div class="col-md-6 pl-md-1">
              <div class="form-group">
                <label for="cartorio">Cartório</label>
                <select class="form-control cartorio" name="cartorio">
                  <option value=""></option>
                  <?php foreach ($notarys_office as $row): ?>
                    <option value="<?php echo $row->id; ?>"><?php echo $row->name_registry; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" name="application_registration_land" class="btn btn-primary btn_modal_form float-right">Acessar</button>
          <input type="hidden" name="id_process_statement" class="id_process_statement" value="">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Gerar D.C.R.F.U -->
<div class="modal fade" id="modal_generate_dcrf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Decisão de Conclusão da Regularização Fundiária Urbana</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>forms/decision_to_complete_urban_land_regularization" target="_blank" method="post">
        <div class="modal-body">
          <div class="row error_process_embarkation" style="display: none;">
            <div class="col-md-12 text-center">
              <p class="alert alert-danger font-weight-bold">Procedimento embargado</p>
            </div>
          </div>
          <!-- <div class="row">
            <div class="col-md-12">
              <a href="#" class="btn btn-primary float-right" target="_blank">Listagem dos ocupantes/Indicação Numérica das Unidades</a>
            </div>
          </div> -->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="process_number">Procedimento</label>
                <select class="form-control process_number" id="process_number_rcrf"
                  data-classe="id_process_decision"
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
          <div class="row">
            <div class="col-md-6 pr-md-1">
              <div class="form-group">
                <label for="modalidade">Modalidade</label>
                <select class="form-control modalidade" name="modalidade">
                  <option value=""></option>
                  <option value="REURB-E">REURB-E</option>
                  <option value="REURB-S">REURB-S</option>
                </select>
              </div>
            </div>
            <div class="col-md-6 pl-md-1">
              <div class="form-group">
                <label for="cartorio">Cartório</label>
                <select class="form-control cartorio" name="cartorio">
                  <option value=""></option>
                  <?php foreach ($notarys_office as $row): ?>
                    <option value="<?php echo $row->id; ?>"><?php echo $row->name_registry; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" name="decision_to_complete_urban_land_regularization" class="btn btn-primary btn_modal_form float-right">Acessar</button>
          <input type="hidden" name="id_process_decision" class="id_process_decision" value="">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Gerar Listagem ocupantes -->
<div class="modal fade" id="modal_generate_occupants" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Listagem dos ocupantes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>forms/decision_to_complete_urban_land_regularization" target="_blank" method="post">
        <div class="modal-body">
          <div class="row error_process_embarkation" style="display: none;">
            <div class="col-md-12 text-center">
              <p class="alert alert-danger font-weight-bold">Procedimento embargado</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="process_number">Procedimento</label>
                <select class="form-control process_number" id="process_number_rcrf"
                  data-classe="id_process_occupants"
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
          <div class="row">
            <div class="col-md-6 pr-md-1">
              <div class="form-group">
                <label for="modalidade">Modalidade</label>
                <select class="form-control modalidade" name="">
                  <option value=""></option>
                  <option value="REURB-E">REURB-E</option>
                  <option value="REURB-S">REURB-S</option>
                </select>
              </div>
            </div>
            <div class="col-md-6 pl-md-1">
              <div class="form-group">
                <label for="cartorio">Cartório</label>
                <select class="form-control cartorio" name="cartorio">
                  <option value=""></option>
                  <?php foreach ($notarys_office as $row): ?>
                    <option value="<?php echo $row->id; ?>"><?php echo $row->name_registry; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" name="decision_to_complete_urban_land_regularization" class="btn btn-primary btn_modal_form float-right">Acessar</button>
          <input type="hidden" name="id_process_occupants" class="id_process_occupants" value="">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Gerar Indicação Numérica das Unidades -->
<div class="modal fade" id="modal_generate_indication" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Indicação Numérica das Unidades</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>forms/decision_to_complete_urban_land_regularization" target="_blank" method="post">
        <div class="modal-body">
          <div class="row error_process_embarkation" style="display: none;">
            <div class="col-md-12 text-center">
              <p class="alert alert-danger font-weight-bold">Procedimento embargado</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="process_number">Procedimento</label>
                <select class="form-control process_number" id="process_number_rcrf"
                  data-classe="id_process_indication"
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
          <div class="row">
            <div class="col-md-6 pr-md-1">
              <div class="form-group">
                <label for="modalidade">Modalidade</label>
                <select class="form-control modalidade" name="">
                  <option value=""></option>
                  <option value="REURB-E">REURB-E</option>
                  <option value="REURB-S">REURB-S</option>
                </select>
              </div>
            </div>
            <div class="col-md-6 pl-md-1">
              <div class="form-group">
                <label for="cartorio">Cartório</label>
                <select class="form-control cartorio" name="cartorio">
                  <option value=""></option>
                  <?php foreach ($notarys_office as $row): ?>
                    <option value="<?php echo $row->id; ?>"><?php echo $row->name_registry; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" name="decision_to_complete_urban_land_regularization" class="btn btn-primary btn_modal_form float-right">Acessar</button>
          <input type="hidden" name="id_process_indication" class="id_process_indication" value="">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Gerar Título de legitimação fundiária urbana individual -->
<div class="modal fade" id="modal_generate_individual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Título de legitimação fundiária urbana individual</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>forms/individual_urban_land_legitimation" target="_blank" method="post">
        <div class="modal-body">
          <div class="row error_process_embarkation" style="display: none;">
            <div class="col-md-12 text-center">
              <p class="alert alert-danger font-weight-bold">Procedimento embargado</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="process_number">Procedimento</label>
                <select class="form-control process_number" id="process_number" name="process_number"
                  data-classe="id_process_individual">
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
          <div class="row">
            <div class="col-md-6 pr-md-1">
              <div class="form-group">
                <label for="modalidade">Modalidade</label>
                <select class="form-control modalidade" name="modalidade">
                  <option value=""></option>
                  <option value="REURB-E">REURB-E</option>
                  <option value="REURB-S">REURB-S</option>
                </select>
              </div>
            </div>
            <div class="col-md-6 pl-md-1">
              <div class="form-group">
                <label for="cartorio">Cartório</label>
                <select class="form-control cartorio" name="cartorio">
                  <option value=""></option>
                  <?php foreach ($notarys_office as $row): ?>
                    <option value="<?php echo $row->id; ?>"><?php echo $row->name_registry; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" name="individual_urban_land_legitimation" class="btn btn-primary btn_modal_form float-right land_regularization_certificate">Acessar</button>
          <input type="hidden" name="id_process_individual" class="id_process_individual" value="">
        </div>
      </form>
    </div>
  </div>
</div>

  <?php $this->load->view('elements/footer'); ?>
