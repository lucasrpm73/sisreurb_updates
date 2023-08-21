<div class="modal fade" id="modalAddPalestrante" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar palestrante</h5>
        <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- <form class="" action="<?php echo base_url()?>palestras/cadastrar_palestrante" method="post"> -->
        <div class="modal-body">
          <label for="">Palestrante</label>
          <select name="palestrante" class="form-control select_write_modal_palestras" id="alterar_palestrante_dashboard" style="width: 100%;">
            <option ></option>
            <?php foreach ($palestrantes as $row): ?>
              <option value="<?php echo $row->id; ?>"><?php echo $row->nome; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_palestra" class="id_palestra_hidden" value="<?php echo $palestra->id?>">
          <input type="hidden" name="email_cliente" value="<?php echo $palestra->email?>">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" name="cadastrar_palestrante" id="cadastrar_palestrante" class="btn btn-primary">Cadastrar</button>
        </div>
      <!-- </form> -->
    </div>
  </div>
</div>
