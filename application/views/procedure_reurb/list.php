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
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            
            <?php if ($view_register) : ?>
              <?php if ($_SESSION['user']['profile'] == '1') : ?>
                <a href="<?php echo base_url() ?>procedure_reurb/register" class="btn btn-primary float-md-right float-sm-right float-xs-right">Cadastrar</a>
                <?php endif; ?>
              <a href="<?php echo base_url() ?>procedure_reurb/" class="btn btn-primary float-md-right float-sm-right float-xs-right">Gestão de Procedimentos</a>
              <?php else : ?>
                <a href="<?php echo base_url() ?>register_procedure_reurb/registers" class="btn btn-primary float-md-right float-sm-right float-xs-right">Visualizar Cadastros</a>
            <?php endif; ?>
            
            <h5 class="card-title">
              <?php if ($view_register) : ?>
                Cadastros de Procedimentos de REURB
              <?php else : ?>
                Gestão de Procedimentos de REURB
              <?php endif; ?>
            </h5>
            <hr>
          </div>
          <div class="card-body">
            <table id="tabelaUm" class="table table-striped table-bordered w-100">
              <thead class=" text-primary">
                <tr>
                  <th scope="col">Número processo</th>
                  <th scope="col">Etapa</th>
                  <th scope="col">Nucleo</th>
                  <th scope="col">Modalidade</th>
                  <th scope="col">Detalhes</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($process_number as $row) : ?>
                  <?php if ($row->status == '1') : ?>
                    <tr>
                      <td><?php echo $row->process_number; ?></td>
                      <td><?php echo $row->stage; ?></td>
                      <td><?php echo $row->core_name; ?></td>
                      <td><?php echo $row->modality; ?></td>
                      <td>
                        <a href="<?php echo base_url() ?><?php echo ($view_register) ? 'register_procedure_reurb' : 'procedure_reurb'; ?>/detail/<?php echo $row->id; ?>">
                          <i class="nc-icon nc-zoom-split"></i>
                        </a>
                      </td>
                    </tr>
                  <?php endif; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('elements/footer'); ?>