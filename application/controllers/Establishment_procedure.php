<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Establishment_procedure extends CI_Controller {
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

		// if ($_SESSION['user']['profile'] != '1') {
		// 	redirect(base_url().'inicio');
		// }

		$this->load->model("requesters_model");

		$this->user = $this->login->user();
	}

	public function index()
	{
		$data['error'] 	= (isset($_SESSION['error'])? $_SESSION['error'] : '');
		$name_view = 'establishment_procedure/';
		$this->users_model->insert_log_view($name_view);

		$data['requirements'] = $this->requesters_model->fetch_requirements();

		$this->users_model->insert_queries_logs();
		$this->load->view('establishment_procedure/list', $data);
	}
}
