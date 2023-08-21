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
            <a href="<?php echo base_url()?>protocols/register"
              class="btn btn-primary float-md-right float-sm-right float-xs-right">Cadastrar</a>
            <h4 class="card-title">Protocolos</h4>
            <hr>
          </div>
          <div class="card-body">
            <table id="tabelaUm" class="table table-striped table-bordered w-100">
              <thead class=" text-primary">
                <tr>
                  <th scope="col">Protocolo</th>
                  <th scope="col">Cpf / Cnpj</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Perfil</th>
                  <th scope="col">E-mail</th>
                  <th scope="col">Ação</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($requirements as $row): ?>
                <?php $date = date_create($row->date_requester); ?>
                <tr>
                  <td>
                    <?php echo $row->process_number; ?>.<?php echo $row->stage; ?>.<?php echo  str_pad( $row->id , 3 , '0' , STR_PAD_LEFT); ?>
                  </td>
                  <td><?php echo (isset($row->cpf)) ? $row->cpf : $row->cnpj; ?></td>
                  <td><?php echo (isset($row->legal_name)) ? $row->legal_name : $row->company_name; ?></td>
                  <td><?php echo ($row->type_requester == 1) ? 'Físico' : 'Jurídico'; ?></td>
                  <td><?php echo (isset($row->legal_email)) ? $row->legal_email : $row->procurator_email; ?></td>
                  <td>
                    <a href="<?php echo base_url(); ?>protocols/detail/<?php echo $row->id; ?>">
                      <i class="fa fa-search"></i>
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
  <?php $this->load->view('elements/footer');?>