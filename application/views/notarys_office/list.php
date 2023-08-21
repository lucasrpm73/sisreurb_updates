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
        <div class="card">
          <div class="card-header">
            <a href="<?php echo base_url()?>notarys_office/register"
              class="btn btn-primary float-md-right float-sm-right float-xs-right btn-round">Cadastrar</a>
            <h2 class="card-title ">Cartórios</h2>
            <hr>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tabelaUm" class="table table-striped table-bordered w-100">
                <thead class=" text-primary">
                  <th>Tipo</th>
                  <th>Nome</th>
                  <th>Endereço</th>
                  <th>Ação</th>
                </thead>
                <tbody>
                  <?php foreach ($notarys_office as $row): ?>
                  <tr>
                    <td><?php echo $row->description; ?></td>
                    <td><?php echo $row->name_registry; ?></td>
                    <td>
                      <?php echo $row->type_place; ?> <?php echo $row->public_place; ?>, <?php echo $row->number; ?>, <?php echo $row->complement; ?>, <?php echo $row->neighborhood; ?>
                    </td>
                    <td>
                      <a href="<?php echo base_url()?>notarys_office/detail/<?php echo $row->id; ?>">
                        <i class="nc-icon nc-zoom-split"></i>
                      </a>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('elements/footer');?>
