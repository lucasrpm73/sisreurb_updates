<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Process_sanitation extends CI_Controller
{
	public $user;

  public function __construct()
	{
		parent::__construct();

		$this->load->model("procedure_reurb_model");
		$this->load->model("property_registration_model");
		$this->load->model("requesters_model");

    $this->load->model("login_model", "login");
		$this->load->model("users_model");
		$logado = $this->login->checkUser();
		if (!$logado){
			redirect('/');
			exit();
		}

		// if ($_SESSION['user']['profile'] != '1') {
		// 	redirect(base_url().'inicio');
		// }

		$this->user = $this->login->user();
	}

	public function index()
	{
		$name_view = 'process_sanitation/';
		$this->users_model->insert_log_view($name_view);
		$data['requirements'] = $this->requesters_model->fetch_requirements();

		$this->users_model->insert_queries_logs();
		$this->load->view('process_sanitation/process_sanitation', $data);
	}

}
