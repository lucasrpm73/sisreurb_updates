<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_procedure_reurb extends CI_Controller {
	public $user;

  public function __construct(){
		parent::__construct();

		$this->load->model("procedure_reurb_model");
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

		$this->user = $this->login->user();
		$this->load->model("requesters_model");
		$this->load->model("upload_image_model");
		$this->load->model("property_registration_model");
	}

	public function registers()
	{
		$data['error'] 	= (isset($_SESSION['error'])? $_SESSION['error'] : '');
		$name_view = 'procedure_reurb/';
		$this->users_model->insert_log_view($name_view);
		$data['view_register'] = true;
		$data['process_number'] = $this->procedure_reurb_model->fetch_process_numbers();

		$this->users_model->insert_queries_logs();
		$this->load->view('procedure_reurb/list', $data);
	}

	public function detail($id)
	{
		$data['error'] 	= (isset($_SESSION['error']) ? $_SESSION['error'] : '');
		$data['process_number'] = $this->procedure_reurb_model->fetch_process_number($id);
		if (isset($data['process_number']) && $data['process_number']->id_entity == $_SESSION['user']['id_entity']) {
			$data['enrollments_reached'] = $this->procedure_reurb_model->fetch_enrollments_reached_procedure($id);
			$data['confrontant_enrollments'] = $this->procedure_reurb_model->fetch_confrontant_enrollments_procedure($id);
			$data['squatters'] = $this->procedure_reurb_model->fetch_squatters_procedure($id);
			$data['requesters'] = $this->requesters_model->fetch_requesters();
			$data['requirements'] = $this->requesters_model->fetch_requirements_process_number($data['process_number']->process_number);
			$data['upload_initiating_decision'] = $this->procedure_reurb_model->fetch_upload_initiating_decision($id);
			$data['upload_completion_decision'] = $this->procedure_reurb_model->fetch_upload_completion_decision($id);
			$data['upload_crf'] = $this->procedure_reurb_model->fetch_upload_crf($id);
			$data['notarys_office'] = $this->property_registration_model->fetch_notaries_office();
			$data['registration'] = $this->procedure_reurb_model->fetch_registrations($id);
			// maximum income
			$data['maximum_income'] = $this->requesters_model->fetch_maximum_family_income();

			// $data['monthly_income_total'] = $data['requirement']->monthly_income + $family['monthly_income_family'] + $data['requirement']->monthly_income_spouse + $data['requirement']->federal_government_income_spouse + $data['requirement']->federal_government_income + $data['monthly_income_tenants']->monthly_income + $data['monthly_income_tenants']->monthly_invoicing;

			$name_view = 'register_procedure_reurb/detail/' . $id;
			$this->users_model->insert_log_view($name_view);
			$this->users_model->insert_queries_logs();

			$this->load->view('register_procedure_reurb/detail_register', $data);
		} else {
			$data['data_error'] = 'Procedimento de REURB não encontrado!!';

			$this->load->view('not_data_found/not_data_found', $data);
		}
	}
	
}
