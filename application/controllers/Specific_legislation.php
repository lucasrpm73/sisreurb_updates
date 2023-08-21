<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class specific_legislation extends CI_Controller {
	public $user;

  public function __construct(){
		parent::__construct();

    $this->load->model("login_model", "login");
		$this->load->model("users_model");
		$logado = $this->login->checkUser();
		if (!$logado) {
			redirect('/');
			exit();
		}

		$this->user = $this->login->user();
    $this->load->model('procedure_reurb_model');
	}

	public function index()
	{
		$data['error'] 	= (isset($_SESSION['error'])? $_SESSION['error'] : '');
		$name_view = 'specific_legislation/';
		$this->users_model->insert_log_view($name_view);

		$this->users_model->insert_queries_logs();

    $data['specific_legislations'] = $this->procedure_reurb_model->fetch_specific_legislations();

		$this->load->view('specific_legislation/specific_legislation', $data);
	}
}
