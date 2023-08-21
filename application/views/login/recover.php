<?php $this->load->view('elements/header');?>
<div class="container">
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
  <br><br><br><br><br><br><br><br>
  <div class="row align-centered">
    <div class="col-md-5">
      <h1>Recuperar senha</h1>
      <form class="" action="" method="post">
        <div class='form-group'>
          <label for='senha'>Nova senha</label>
          <input type='password' class='form-control' id='senha' name='senha' placeholder='' required>
        </div>
        <div class='form-group'>
          <label for='repita_senha'>Repita senha</label>
          <input type='password' class='form-control' id='nova_senha' name='nova_senha' placeholder='' required>
          <span id='confere_senha' style='display: none; color: red;'>As senhas estão diferentes</span><br>
          <button type="submit" id="update_password" name="update_password" class="btn btn-primary" style="float: right;">Alterar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<br><br><br><br><br><br><br><br>
<?php $this->load->view('elements/footer');?>
<script type="text/javascript">
$(document).on('change', '#nova_senha', function(){
  var senha = $('#senha').val();
  var repita_senha = $('#nova_senha').val();

  if (senha != repita_senha) {
    $("#confere_senha").show();
  }else{
    $("#confere_senha").hide();
  }
});

$(document).on('click', '#nova_senha', function(){
  var senha = $('#senha').val();
  var repita_senha = $('#nova_senha').val();

  if (senha != repita_senha) {
    $("#confere_senha").show();
    return false;
  }else{
    $("#confere_senha").hide();
  }
});
</script>
