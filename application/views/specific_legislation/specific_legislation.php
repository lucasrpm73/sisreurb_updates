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
            <h4 class="card-title">Legislação Especifica</h4>
            <hr>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tabelaUm" class="table table-striped table-bordered w-100">
                <thead class=" text-primary">
                  <tr>
                    <th scope="col">Nome</th>
                  </tr>
                </thead>
                <tbody >
                  <?php foreach ($specific_legislations as $row): ?>
                    <tr>
                      <td>
                        <?php echo $row->name; ?>
                        <a href="<?php echo $row->link; ?>" class="float-right " target="_blank">
                          Ir para
                          <i class="fas fa-external-link-alt mr-3"></i>
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
