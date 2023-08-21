<?php $this->load->view('elements/header');?>
<style media="screen">

</style>
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
              <h4 class="card-title" style="display: inline;">Clientes</h4>
              <a href="<?php echo base_url()?>clientes/cadastro" class="btn btn-primary float-md-right float-sm-right float-xs-right">Cadastrar</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="tabelaum" class="table table-striped">
                  <thead class=" text-primary">
                    <th>Empresa</th>
                    <th>Ramo</th>
                    <th>Endereços</th>
                    <th>Última palestra</th>
                    <th>Detalhe</th>
                  </thead>
                  <tbody>
                    <?php foreach ($clientes as $row): ?>
                      <tr>
                        <td><?php echo $row->empresa?></td>
                        <td><?php echo $row->ramo?></td>
                        <td><?php echo $row->endereco?>, <?php echo $row->numero?>, <?php echo $row->bairro?>, <?php echo $row->cidade?> - <?php echo $row->estado?></td>
                        <td><?php echo $row->data?></td>
                        <td>
                          <a href="<?php echo base_url()?>clientes/detalhe/<?php echo $row->id?>">
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
