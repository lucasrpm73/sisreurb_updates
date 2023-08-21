<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Protocols extends CI_Controller {
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
		$this->load->model("requesters_model");
		$this->load->model("procedure_reurb_model");
		$this->load->model("upload_image_model");
	}

	public function index()
	{
		$data['error'] 	= (isset($_SESSION['error'])? $_SESSION['error'] : '');
		$name_view = 'protocols/';
		$this->users_model->insert_log_view($name_view);
		$data['requirements'] = $this->requesters_model->fetch_requirements();

		$this->users_model->insert_queries_logs();
		$this->load->view('protocols/list', $data);
	}

	public function register()
	{
		$name_view = 'protocols/register';
		$this->users_model->insert_log_view($name_view);
		$data['process_numbers'] = $this->procedure_reurb_model->fetch_process_numbers();
		$data['requesters'] = $this->requesters_model->fetch_requesters();
		$data['documents_checklist_protocol'] = $this->procedure_reurb_model->fetch_checklist_protocol_entity();

		$this->users_model->insert_queries_logs();
		$this->load->view('protocols/register', $data);
	}

	public function register_requirement(){
		if (isset($_POST['register_protocols'])) {
			$posts = $this->security->xss_clean($this->input->post());
			$id_requester = $posts['id_requester'];
			if ($_POST['people_type'] == 1) {
				if ($_POST['protocol_procedure'] == '') {
					echo "<script>alert('Procedimento é obrigatótio'); history.go(-1)</script>";
				}else{
					$id_property = $this->requesters_model->insert_property_details($posts, $id_requester);
					$id = $this->requesters_model->insert_requirement($id_property, $posts);
					$this->requesters_model->insert_confrotants_property($id_property, $posts);
				}
			} else if($_POST['people_type'] == 2){
				if ($_POST['protocol_procedure_juridical'] == '') {
					echo "<script>alert('Procedimento é obrigatótio'); history.go(-1)</script>";
				}else{
					$id_property = $this->requesters_model->insert_property_details_juridical($posts, $id_requester);
					$id = $this->requesters_model->insert_requirement_juridical($id_property, $posts);
					$this->requesters_model->insert_confrotants_property_juridical($id_property, $posts);
				}
			}
			if (!empty($posts['id_requester_condomino'])) {
				$this->requesters_model->insert_tenants($id, $posts);
			}

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);

			redirect(base_url().'protocols/detail/'.$id);
		}
	}

	public function protocol_history(){
		if (isset($_POST['protocol_history'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$status = '1';
			$this->requesters_model->update_protocol_history($posts, $status);

			$this->requesters_model->register_protocol_history($posts, $status);

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Concluido com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
			redirect(base_url().'protocols/detail/'.$posts['id_protocol']);
		}
	}

	public function protocol_history_cancel(){
		if (isset($_POST['protocol_history_cancel'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$status = '0';
			$this->requesters_model->update_protocol_history($posts, $status);

			$this->requesters_model->register_protocol_history($posts, $status);

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
			redirect(base_url().'protocols/detail/'.$posts['id_protocol']);
		}
	}

	public function update_protocol_history(){
		if (isset($_POST['update_protocol_history'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$this->requesters_model->update_protocol_history_data($posts);

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Atualizado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
			redirect(base_url().'protocols/detail/'.$posts['id_protocol']);
		}
	}

	public function fetch_requirements_legal(){
		$posts = $this->security->xss_clean($this->input->post());
		$return = $this->requesters_model->fetch_requirements_legal($posts);
		$this->users_model->insert_queries_logs();
		echo json_encode($return);
	}

	public function fetch_requirements_juridical(){
		$posts = $this->security->xss_clean($this->input->post());
		$return = $this->requesters_model->fetch_requirements_juridical($posts);
		$this->users_model->insert_queries_logs();
		echo json_encode($return);
	}

	public function detail($id){
		$data['error'] 	= (isset($_SESSION['error'])? $_SESSION['error'] : '');
		$name_view = 'protocols/detail/'.$id;
		$this->users_model->insert_log_view($name_view);
		// echo $id;
		$data['requirement'] = $this->requesters_model->fetch_requeriment($id);
		// var_dump($data['requirement']); die;
		if (isset($data['requirement']) && $data['requirement']->id_entity == $_SESSION['user']['id_entity']) {
			$data['conclusion_protocol'] = $this->procedure_reurb_model->fetch_conclusion_protocol($id);
			// var_dump($data['conclusion_protocol']);
			// die;
			$data['process_numbers'] = $this->procedure_reurb_model->fetch_process_numbers();
			$data['requesters'] = $this->requesters_model->fetch_completed_applicants();
			$data['tenants'] = $this->requesters_model->fetch_tenants($id);
			$data['confrotants_property'] = $this->requesters_model->fetch_confrotants_property($id);
			$data['monthly_income_tenants'] = $this->requesters_model->fetch_monthly_income_tenants($id);
			$family = $this->requesters_model->fetch_family_members_requester($data['requirement']->id_requester);
			$data['monthly_income_total'] = $data['requirement']->monthly_income + $family['monthly_income_family'] + $data['requirement']->monthly_income_spouse + $data['requirement']->federal_government_income_spouse + $data['requirement']->federal_government_income + $data['monthly_income_tenants']->monthly_income + $data['monthly_income_tenants']->monthly_invoicing;
			$data['monthly_income_total_juridical'] = $data['requirement']->monthly_invoicing + $data['monthly_income_tenants']->monthly_income + $data['monthly_income_tenants']->monthly_invoicing;

			$data['maximum_income'] = $this->requesters_model->fetch_maximum_family_income();
			$data['documents_checklist_protocol'] = $this->procedure_reurb_model->fetch_checklist_protocol_entity();
			$data['id_protocol'] = $id;
			$data['files_checklist'] = $this->procedure_reurb_model->fetch_files_checklist($id);
			$data['front_photo'] = $this->procedure_reurb_model->fetch_front_photo($id);
			$data['checklist_not_send'] = $this->procedure_reurb_model->fetch_checklist_not_send($id);
			$data['count_checklist_required'] = $this->procedure_reurb_model->count_checklist_required();
			$data['count_checklist_send'] = $this->procedure_reurb_model->count_checklist_send($id);
			$data['embargo_history'] = $this->procedure_reurb_model->fetch_embargo_history($id);
			$data['status_embargo'] = $this->procedure_reurb_model->fetch_status_embargo();
			$data['embargo_under_analysis'] = $this->procedure_reurb_model->fetch_embargo_under_analysis($id);
			$data['protocol_history'] = $this->requesters_model->fetch_protocol_history($id);

			$this->users_model->insert_queries_logs();
			$this->load->view('protocols/detail', $data);
		} else {
			$data['data_error'] = 'Protocolo não encontrado!!';

			$this->load->view('not_data_found/not_data_found', $data);
		}
	}

	public function fetch_tenants(){
		$posts = $this->security->xss_clean($this->input->post());
		$requirement = $this->requesters_model->fetch_requeriment($posts['id_requirement']);
		$monthly_income_tenants = $this->requesters_model->fetch_monthly_income_tenants($posts['id_requirement']);
		$family = $this->requesters_model->fetch_family_members_requester($posts['id_requester']);

		if ($requirement->people_type == 1) {
			$monthly_income_total = $requirement->monthly_income + $family['monthly_income_family'] + $requirement->monthly_income_spouse + $requirement->federal_government_income_spouse + $requirement->federal_government_income + $monthly_income_tenants->monthly_income + $monthly_income_tenants->monthly_invoicing;
		} else {
			$monthly_income_total = $requirement->monthly_invoicing + $monthly_income_tenants->monthly_income + $monthly_income_tenants->monthly_invoicing;
		}

		$maximum_income = $this->requesters_model->fetch_maximum_family_income();

		if ($monthly_income_total > $maximum_income['maximum_family_income']) {
			$reurb_type = 'REURB-E';
		} else {
			$reurb_type = 'REURB-S';
		}
		$this->requesters_model->update_reurb_type($reurb_type, $posts['id_requirement']);

		$this->users_model->insert_queries_logs();
		echo json_encode($monthly_income_total);
	}

	public function update_requirement($id){
		if (isset($_POST['update_requirement'])) {
			$posts = $this->security->xss_clean($this->input->post());
			$id_requirements = $id;

			if ($posts['type_requester'] == 'fizico') {
				$this->requesters_model->update_property_details($posts, $id);
				// $this->requesters_model->update_requirement($posts, $id_requirements);
				$this->requesters_model->update_legal_confrotants($posts);
			} else if($posts['type_requester'] == 'juridico'){
				$this->requesters_model->update_property_details_juridical($posts, $id);
				// $this->requesters_model->update_requirement_juridical($posts, $id_requirements);
				$this->requesters_model->update_confrotants_juridical($posts);
			}

			// r . classification_reurb
			$this->requesters_model->update_reurb_type($posts['reurb_type'], $id);

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
		}
		redirect(base_url().'protocols/detail/'.$id_requirements);
	}

	public function isset_cpf_cnpj()
	{
		$posts = $this->security->xss_clean($this->input->post());

		$cpf_cnpj = $this->requesters_model->isset_cpf_cnpj_requirements($posts);
		if ($cpf_cnpj == null) {
			$return = false;
		} else {
			$family = $this->requesters_model->fetch_family_members_requester($cpf_cnpj['id']);
			$maximum_income = $this->requesters_model->fetch_maximum_family_income();

			if ($family == null) { $family = []; }
			if ($maximum_income == null) { $maximum_income = []; }

			$return = array_merge($cpf_cnpj, $family, $maximum_income);
		}
		$this->users_model->insert_queries_logs();
		echo json_encode($return);
	}

	public function remove_tenants(){
		$posts = $this->security->xss_clean($this->input->post());

		$this->requesters_model->remove_tenants($posts);
		$return = $this->requesters_model->fetch_tenants($posts['id_requirement']);

		$this->users_model->insert_queries_logs();
		echo json_encode($return);
	}

	public function insert_tenant(){
		$posts = $this->security->xss_clean($this->input->post());

		// $this->requesters_model->insert_tenant($posts);
		$return = $this->requesters_model->fetch_tenants($posts['id_requirement']);
		
		$this->users_model->insert_queries_logs();
		echo json_encode($return);
	}

	public function add_confrotants($id){
		if (isset($_POST['register_confrotants'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$this->requesters_model->insert_new_confrotant_property($posts);
			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
		}
		redirect(base_url().'protocols/detail/'.$id);
	}

	public function send_files()
	{
		if (isset($_POST['send_files'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$file = $this->upload_image_model->upload_img('arquivo', 'assets/build/img/checklist_protocols', '');

			if ($file != false) {
				$this->procedure_reurb_model->insert_files_protocols($posts, $file);
				$this->users_model->insert_queries_logs();

				$error = array();
				$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
				$error['error']['error_type'] = 'success'; // Warning | success | danger
				$this->session->set_flashdata($error);
			} else {
        $error = array();
        $error['error']['error_string']	= 'O arquivo não pode ser enviado.';
        $error['error']['error_type'] = 'danger'; // Warning | success | danger
        $this->session->set_flashdata($error);
      }

		} else {
			$error = array();
			$error['error']['error_string']	= 'Opss... Houve um erro!';
			$error['error']['error_type'] = 'danger'; // Warning | success | danger
			$this->session->set_flashdata($error);
		}
		redirect(base_url().'protocols/detail/'.$_POST['id_protocol']);
	}

	public function update_files(){
		if (isset($_POST['update_files'])) {
			$posts = $this->security->xss_clean($this->input->post());
			// var_dump($posts); die;
			$file = $this->upload_image_model->upload_img('edit_arquivo', 'assets/build/img/checklist_protocols', '');

			if ($file != false) {
				$this->procedure_reurb_model->update_files_protocols($posts, $file);
				// die;
				$this->users_model->insert_queries_logs();
				$error = array();
				$error['error']['error_string']	= 'Alterado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
				$error['error']['error_type'] = 'success'; // Warning | success | danger
				$this->session->set_flashdata($error);
			} else {
        $error = array();
        $error['error']['error_string']	= 'O arquivo não pode ser enviado.';
        $error['error']['error_type'] = 'danger'; // Warning | success | danger
        $this->session->set_flashdata($error);
      }
		} else {
			$error = array();
			$error['error']['error_string']	= 'Opss... Houve um erro!';
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
		}
		redirect(base_url().'protocols/detail/'.$_POST['id_protocol']);
	}

	public function fetch_type_arquivo()
	{
		$posts = $this->security->xss_clean($this->input->post());
		$return = $this->procedure_reurb_model->fetch_type_arquivo($posts);

		$this->users_model->insert_queries_logs();
		echo json_encode($return);
	}

	public function isset_confrotant(){
		$posts = $this->security->xss_clean($this->input->post());
		$return = $this->requesters_model->isset_confrotants($posts);

		$this->users_model->insert_queries_logs();
		echo json_encode($return);
	}

	public function embarkation_protocol(){
		if (isset($_POST['embarkation_protocol'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$file = $this->upload_image_model->upload_img('arquivo', 'assets/build/img/pdf_embarkation', '');
			// var_dump($file); die;
			$this->procedure_reurb_model->insert_embargo_history($posts, $file);
			$this->requesters_model->update_embarkation_process($posts);

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
		} else {
			$error = array();
			$error['error']['error_string']	= 'Opss... Houve um erro!';
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
		}
		redirect(base_url().'protocols/detail/'.$_POST['id_protocol']);
	}

	public function update_file_embarkation(){
		if(isset($_POST['update_file_embarkation'])){
			$posts = $this->security->xss_clean($this->input->post());

			$file = $this->upload_image_model->upload_img('edit_file', 'assets/build/img/pdf_embarkation', '', '');
			// var_dump($file); die;
			$this->procedure_reurb_model->update_embarkation_file($posts, $file);
			$error = array();
			$error['error']['error_string']	= 'Atualizado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
		} else {
			$error = array();
			$error['error']['error_string']	= 'Opss... Houve um erro!';
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
		}
		redirect(base_url().'protocols/detail/'.$_POST['id_protocol']);
	}

	public function update_files_analysis(){
		if(isset($_POST['update_files_analysis'])){
			$posts = $this->security->xss_clean($this->input->post());

			$file = $this->upload_image_model->upload_img('edit_files_analysis', 'assets/build/img/pdf_embarkation', '');
			$this->procedure_reurb_model->update_files_analysis($posts, $file);

			$error = array();
			$error['error']['error_string']	= 'Atualizado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
		} else {
			$error = array();
			$error['error']['error_string']	= 'Opss... Houve um erro!';
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
		}
		redirect(base_url().'protocols/detail/'.$_POST['id_protocol']);
	}

	public function update_embarkation(){
		if(isset($_POST['update_embarkation'])){
			$posts = $this->security->xss_clean($this->input->post());

			$file = $this->upload_image_model->upload_img('file_analysis', 'assets/build/img/pdf_embarkation', '');
			$this->procedure_reurb_model->update_embarkation($posts, $file);

			$error = array();
			$error['error']['error_string']	= 'Atualizado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
		} else {
			$error = array();
			$error['error']['error_string']	= 'Opss... Houve um erro!';
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
		}
		redirect(base_url().'protocols/detail/'.$_POST['id_protocol']);
	}

	public function fetch_cpf(){
		$posts = $this->security->xss_clean($this->input->post());

		$return = $this->requesters_model->isset_cpf_cnpj_requirements($posts);
		echo json_encode($return);
	}

}
