<?php $paginaCorrente = $_SERVER['REQUEST_URI']; ?>
<div class="sidebar" data-color="white" data-active-color="danger">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
  <div class="logo">
    <a href="<?php echo base_url(); ?>inicial" class="">
      <div class="logo-image">
        <img src="<?php echo base_url(); ?>assets/build/img/logo-sisreurb.png">
      </div>
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="active-pro">
        <a href="<?php echo base_url(); ?>inicial">
          <i class="fas fa-home"></i>
          <p>Página inicial</p>
        </a>
      </li>
      <li class="active-pro">
        <a href="<?php echo base_url(); ?>register">
          <i class="fas fa-scroll"></i>
          <p>Cadastros</p>
        </a>
      </li>
      <li class="active-pro">
        <a href="<?php echo base_url(); ?>procedure_reurb">
          <div class="row">
            <div class="col-md-12">
              <i class="fas fa-toolbox"></i>
              <p>Gestão de</p>
            </div>
          </div>
          <div class="row">
            <div class="offset-md-2 col-md-10">
              <p style="padding-left: 5px;">Procedimentos Administrativos</p>
            </div>
          </div>
        </a>
      </li>
      <?php //if ($_SESSION['user']['profile'] == '1'): 
      ?>
      <li class="active-pro">
        <a href="<?php echo base_url(); ?>reports">
          <i class="fas fa-chart-line"></i>
          <p>Relatórios</p>
        </a>
      </li>
      <?php //endif; 
      ?>
      <li class="active-pro">
        <a href="<?php echo base_url(); ?>support">
          <i class="fas fa-headset"></i>
          <p>Suporte</p>
        </a>
      </li>
      <li class="active-pro">
        <a href="<?php echo base_url(); ?>specific_legislation">
          <i class="fas fa-book"></i>
          <p>Legislação Especifica</p>
        </a>
      </li>
      <li class="active-pro">
        <a href="<?php echo base_url(); ?>login/logout">
          <i class="nc-icon nc-button-power"></i>
          <p>Sair</p>
        </a>
      </li>
    </ul>
  </div>
</div>