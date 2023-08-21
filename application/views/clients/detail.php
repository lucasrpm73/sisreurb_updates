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
        <div class="col-md-5">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title text-center"><?php echo $cliente->empresa?></h4>
            </div>
            <div class="card-body">

            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h4 class="card-title text-center">Contatos</h4>
              <button type="button" class="btn btn-primary" name="button" data-toggle="modal" data-target="#modalAddContato">Adicionar contato</button>
            </div>
            <div class="card-body">
              <table class="table" id="tabelaum">
                <thead class=" text-primary">
                  <tr>
                    <th>Nome</th>
                    <th>Cargo</th>
                    <th>Tel</th>
                    <th>E-mail</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($contatos as $row): ?>
                    <tr>
                      <td><?php echo $row->nome?></td>
                      <td><?php echo $row->cargo?></td>
                      <td><?php echo $row->telefone?></td>
                      <td><?php echo $row->email?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="card card-user">
            <div class="card-body">
              <form action="<?php echo base_url()?>clientes/alterar_cliente" id="form_alterar_cliente" method="post">
                  <?php $id_cliente = $cliente->id;?>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label for="empresa">Empresa</label>
                        <input type="text" name="empresa" id="empresa" class="form-control" placeholder="Empresa" value="<?php echo $cliente->empresa?>">
                      </div>
                    </div>
                    <div class="col-md-6 pl-md-1">
                      <div class="form-group">
                        <label for="cnpj">CNPJ</label>
                        <input type="text" name="cnpj" id="cnpj" class="form-control" placeholder="00.000.000/0000-00" value="<?php echo $cliente->cnpj?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label for="ramo">Ramo</label>
                        <input type="text" name="ramo" id="ramo" class="form-control" placeholder="Empreendimento" value="<?php echo $cliente->ramo?>">
                      </div>
                    </div>
                    <div class="col-md-6 pl-md-1">
                      <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="exemplo@email.com" value="<?php echo $cliente->email?>">
                      </div>
                    </div>
                  </div>
                  <!-- <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" name="telefone" id="telefone" class="form-control" placeholder="(00) 0 0000-0000" value="<?php echo $cliente->telefone?>">
                      </div>
                    </div>
                    <div class="col-md-4 pl-md-1 pr-1">
                      <div class="form-group">
                        <label for="responsavel">Responsavel</label>
                        <input type="text" name="responsavel" id="responsavel" class="form-control" placeholder="Responsavel" value="<?php echo $cliente->responsavel?>">
                      </div>
                    </div>
                    <div class="col-md-4 pl-md-1">
                      <div class="form-group">
                        <label for="cargo">Cargo</label>
                        <input type="text" name="cargo" id="cargo" class="form-control" placeholder="Cargo" value="<?php echo $cliente->cargo?>">
                      </div>
                    </div>
                  </div> -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="checkbox" name="construtora" id="construtora" <?php if ($cliente->construtora) { echo "checked"; }?>>
                        <label for="construtora">Construtora / Incorporadora</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="observacao">Observação</label>
                        <textarea name="observacao" id="observacao" class="form-control textarea"><?php echo $cliente->observacao?></textarea>
                      </div>
                    </div>
                  </div>
                <div class="row">
                  <div class="update ml-auto mr-auto">
                    <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
                    <button id="alterar_cliente" name="alterar_cliente" class="btn btn-primary btn-round">Alterar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title text-center">Palestras</h4>
            </div>
            <div class="card-body">
              <table class="table table-striped" id="tabeladois">
                <thead class=" text-primary">
                  <tr>
                    <th>Data</th>
                    <th>Endereço</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($palestras as $row): ?>
                    <tr>
                      <td>
                        <?php echo $row->data?> - <?php echo $row->horario?>
                      </td>
                      <td>
                        <?php echo $row->endereco?>, <?php echo $row->numero?>, <?php echo $row->complemento?>,
                        <?php echo $row->bairro?>, <?php echo $row->cidade?> - <?php echo $row->estado?>
                      </td>
                      <td>
                        <a href="<?php echo base_url()?>palestras/detalhe/<?php echo $row->id?>"><i class="nc-icon nc-zoom-split"></a></i>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title text-center">Histórico</h4>
              <button type="button" class="btn btn-primary" name="button" data-toggle="modal" data-target="#modalAddHistorico">Adicionar historico</button>
            </div>
            <div class="card-body">
              <table class="table" id="tabelatres">
                <thead class=" text-primary">
                  <th>Data</th>
                  <th>Mensagem</th>
                  <th>Retornar em</th>
                </thead>
                <tbody>
                  <?php foreach ($historico as $row): ?>
                    <tr>
                      <td><?php echo $row->data?></td>
                      <td><?php echo $row->mensagem?></td>
                      <td><?php echo $row->retornar_em?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title text-center">Endereços</h4>
              <button type="button" class="btn btn-primary" name="button" data-toggle="modal" data-target="#modalAddEndereco">Adicionar endereço</button>
            </div>
            <div class="card-body">
              <table class="table" id="tabelaquatro">
                <thead class=" text-primary">
                  <th>cep</th>
                  <th>endereco</th>
                  <th>numero</th>
                  <th>complemento</th>
                  <th>bairro</th>
                  <th>cidade</th>
                  <th>estado</th>
                  <th>empreendimento</th>
                </thead>
                <tbody>
                  <?php foreach ($enderecos as $row): ?>
                    <tr>
                      <td><?php echo $row->cep?></td>
                      <td><?php echo $row->endereco?></td>
                      <td><?php echo $row->numero?></td>
                      <td><?php echo $row->complemento?></td>
                      <td><?php echo $row->bairro?></td>
                      <td><?php echo $row->cidade?></td>
                      <td><?php echo $row->estado?></td>
                      <td><?php echo $row->empreendimento?></td>
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
<?php if (count($enderecos) == 0): ?>
  <script type="text/javascript">
  $(document).ready(function(){
    $('#modalAddEndereco').modal('show');
  });
  </script>
<?php endif; ?>
<!-- Modal -->
<div class="modal fade" id="modalAlterar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar dados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Realmente editar dados?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" id="btn_modal_alterar_cliente" class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAddEndereco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar endereço</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="" action="<?php echo base_url()?>clientes/cadastrar_endereco" method="post">
          <div class="form-group">
          	<label class="label-input-style" for="cep">CEP: </label>
          	<input type="text" class="col-md-12 cep" name="cep" id="cep" size="10" maxlength="9" onblur="pesquisacep(this.value);" required/>
          </div>
          <div class="form-group">
          	<label class="label-input-style" for="rua">Endereco: </label>
          	<input type="text" class="col-md-12" name="rua" id="rua" size='30' required/>
          </div>
          <div class="form-group">
          	<label class="label-input-style" for="numero">Numero: </label>
          	<input type="text" class="col-md-12" name="numero" id="numero" required/>
          </div>
          <div class="form-group">
          	<label class="label-input-style" for="complemento">Complemento: </label>
          	<input type="text" class="col-md-12" name="complemento" id="complemento"/>
          </div>
          <div class="form-group">
          	<label class="label-input-style" for="bairro">Bairro: </label>
          	<input type="text" class="col-md-12" name="bairro" id="bairro" required/>
          </div>
          <div class="form-group">
          	<label class="label-input-style" for="cidade">Cidade: </label>
          	<input type="text" class="col-md-12" name="cidade" id="cidade" required/>
          </div>
          <div class="form-group">
          	<label class="label-input-style" for="uf">Estado: </label>
          	<input type="text" class="col-md-12" name="uf"  id="uf" required/>
          </div>
          <div class="form-group">
          	<label class="label-input-style" for="empreendimento">Empreendimento (opcional): </label>
          	<input type="text" class="col-md-12" name="empreendimento"  id="empreendimento"/>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_cliente" value="<?php echo $id_cliente?>">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" name="cadastrar_endereco" class="btn btn-primary">Cadastrar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAddHistorico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar histórico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="" action="<?php echo base_url()?>clientes/cadastrar_historico" method="post">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="mensagem">Mensagem</label>
                <textarea name="mensagem" id="mensagem" class="form-control textarea" style="max-height: 800px !important; height: 200px !important;"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="retornar_em">Retorno</label>
                <input type="date" name="retornar_em" id="retornar_em" class="form-control" value="">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_cliente" value="<?php echo $id_cliente?>">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" name="cadastrar_endereco" class="btn btn-primary">Cadastrar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAddContato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar contato</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="" action="<?php echo base_url()?>clientes/cadastrar_contato" method="post">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome" value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="cargo">Cargo</label>
                <input type="text" name="cargo" id="cargo" class="form-control" placeholder="Cargo" value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" id="telefone" class="form-control telefone" value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email" class="form-control" value="">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_cliente" value="<?php echo $id_cliente?>">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" name="cadastrar_contato" class="btn btn-primary">Cadastrar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).on('click', '#alterar_cliente',  function(){
    $('#modalAlterar').modal('show');
    return false;
  });

  $(document).on('click', '#btn_modal_alterar_cliente', function(){
    $('#form_alterar_cliente').submit();
  });
</script>
