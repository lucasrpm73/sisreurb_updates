<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reurb_conclusion extends CI_Controller
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
		$name_view = 'reurb_conclusion/';
		$this->users_model->insert_log_view($name_view);
		$data['process_number'] = $this->procedure_reurb_model->fetch_process_numbers();
		$data['notarys_office'] = $this->property_registration_model->fetch_notaries_office();
		$data['requirements'] = $this->requesters_model->fetch_requirements();

		$this->users_model->insert_queries_logs();
		$this->load->view('reurb_conclusion', $data);
	}

	public function fetch_stages_process()
	{
		$posts = $this->security->xss_clean($this->input->post());
		$data_requirement = [];
		$data_analysis = [];
		// $return = $this->procedure_reurb_model->fetch_stages_process($posts);
		$requirement = $this->requesters_model->fetch_requirement($posts);
		$analysis = $this->procedure_reurb_model->fetch_embargo_under_analysis($posts['process_number']);
		$data_requirement['requirement'] = $requirement;
		$data_analysis['analysis'] = $analysis;

		$return = array_merge($data_requirement, $data_analysis);

		$this->users_model->insert_queries_logs();
		echo json_encode($return);
	}

	public function isset_stage()
	{
		$posts = $this->security->xss_clean($this->input->post());

		$return = $this->procedure_reurb_model->isset_stage($posts);

		$this->users_model->insert_queries_logs();
		echo json_encode($return);
	}

}
