<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Processing extends CI_Controller {
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
	}

	public function index()
	{
		$data['error'] 	= (isset($_SESSION['error'])? $_SESSION['error'] : '');
		$name_view = 'processing/';
		$this->users_model->insert_log_view($name_view);

		$this->users_model->insert_queries_logs();
		$this->load->view('processing');
	}
}
