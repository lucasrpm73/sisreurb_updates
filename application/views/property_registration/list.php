<?php $this->load->view('elements/header');?>
<div class="wrapper ">
  <?php $this->load->view('elements/sidebar_lateral');?>
  <?php $this->load->view('elements/sidebar');?>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a href="<?php echo base_url()?>property_registration/register"
              class="btn btn-primary float-md-right float-sm-right float-xs-right btn-round">Cadastrar</a>
            <h2 class="card-title">Cartórios de Registro de Imóveis</h2>
            <hr>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead class=" text-primary">
                  <th>Nome</th>
                  <th>Endereço</th>
                  <th>Ação</th>
                </thead>
                <tbody>
                  <?php foreach ($notarys_office as $row): ?>
                  <tr>
                    <td><?php echo $row->name_registry; ?></td>
                    <td>
                      <?php echo $row->type_place; ?> <?php echo $row->public_place; ?>, <?php echo $row->number; ?>, <?php echo $row->complement; ?>, <?php echo $row->neighborhood; ?>
                    </td>
                    <td>
                      <a href="<?php echo base_url()?>property_registration/detail/<?php echo $row->id; ?>">
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
