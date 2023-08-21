<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procedure_reurb extends CI_Controller {
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

	public function index()
	{
		$data['error'] 	= (isset($_SESSION['error'])? $_SESSION['error'] : '');
		$name_view = 'procedure_reurb/';
		$this->users_model->insert_log_view($name_view);
		$data['view_register'] = false;
		$data['process_number'] = $this->procedure_reurb_model->fetch_process_numbers();

		$this->users_model->insert_queries_logs();
		$this->load->view('procedure_reurb/list', $data);
	}

	public function register()
	{
		$name_view = 'procedure_reurb/register';
		$this->users_model->insert_log_view($name_view);
		$data['notarys_office'] = $this->property_registration_model->fetch_notaries_office();

		$this->users_model->insert_queries_logs();
		$this->load->view('procedure_reurb/register', $data);
	}

	public function register_procedure(){
		if (isset($_POST['register_procedure'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$id = $this->procedure_reurb_model->insert($posts);
			$this->procedure_reurb_model->insert_enrollments_reached_procedure($posts, $id);
			$this->procedure_reurb_model->insert_confrontant_enrollments_procedure($posts, $id);
			$this->procedure_reurb_model->insert_squatters_procedure($posts, $id);

			// $id_registration = $this->procedure_reurb_model->insert_registrations($id, $posts);
			// $this->procedure_reurb_model->insert_registrations_properties_address($id_registration, $posts);
			// $this->procedure_reurb_model->insert_address_of_notifications($id_registration, $posts);

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
		}
		redirect(base_url().'procedure_reurb/detail/'.$id);
	}

	public function isset_process_number(){
		$posts = $this->security->xss_clean($this->input->post());

		$return = $this->procedure_reurb_model->isset_process_number($posts);
		$this->users_model->insert_queries_logs();
		echo json_encode($return);
	}

	public function isset_stage(){
		$posts = $this->security->xss_clean($this->input->post());

		$return = $this->procedure_reurb_model->isset_stage($posts);
		$this->users_model->insert_queries_logs();
		echo json_encode($return);
	}

	public function detail($id){
		$data['error'] 	= (isset($_SESSION['error'])? $_SESSION['error'] : '');
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

			$name_view = 'procedure_reurb/detail/'.$id;
			$this->users_model->insert_log_view($name_view);
			$this->users_model->insert_queries_logs();

			$this->load->view('procedure_reurb/detail', $data);
		} else {
			$data['data_error'] = 'Procedimento de REURB não encontrado!!';

			$this->load->view('not_data_found/not_data_found', $data);
		}
	}

	public function upload_initiating_decision(){
		if (isset($_POST['upload_initiating_decision'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$file = $this->upload_image_model->upload_img('initiating_decision', 'assets/build/img/initiating_decision', '', 'pdf|PDF');
			if ($file != false) {
				$upload = $this->procedure_reurb_model->fetch_upload_initiating_decision($posts['id_procedure']);
				if (empty($upload)) {
					// insert file
					$this->procedure_reurb_model->insert_upload_initiating_decision($posts['id_procedure'], $file);
				} else {
					// update file
					$this->procedure_reurb_model->update_upload_initiating_decision($upload->id, $file);
				}
			} else {
				$error = array();
				$error['error']['error_string']	= 'Ouve um erro ao fazer upload, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
				$error['error']['error_type'] = 'danger'; // Warning | success | danger
				$this->session->set_flashdata($error);
				if (isset($_POST['register_procedure_reurb'])) {
					redirect(base_url() . 'register_procedure_reurb/detail/' . $posts['id_procedure']);
					exit;
				}
				redirect(base_url() . 'procedure_reurb/detail/' . $posts['id_procedure']);
				exit;
			}

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
			if (isset($_POST['register_procedure_reurb'])) {
				redirect(base_url() . 'register_procedure_reurb/detail/' . $posts['id_procedure']);
				exit;
			}
			redirect(base_url().'procedure_reurb/detail/'.$posts['id_procedure']);
			exit;
		}
		redirect(base_url().'procedure_reurb/');
	}

	public function upload_completion_decision(){
		if (isset($_POST['upload_completion_decision'])) {
			$posts = $this->security->xss_clean($this->input->post());
			$file = $this->upload_image_model->upload_img('completion_decision', 'assets/build/img/completion_decision', '', 'pdf|PDF');
			if ($file != false) {
				$upload = $this->procedure_reurb_model->fetch_upload_completion_decision($posts['id_procedure']);
				if (empty($upload)) {
					// insert file
					$this->procedure_reurb_model->insert_upload_completion_decision($posts['id_procedure'], $file);
				} else {
					// update file
					$this->procedure_reurb_model->update_upload_completion_decision($upload->id, $file);
				}
			}

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
			if (isset($_POST['register_procedure_reurb'])) {
				redirect(base_url() . 'register_procedure_reurb/detail/' . $posts['id_procedure']);
				exit;
			}
			redirect(base_url() . 'procedure_reurb/detail/' . $posts['id_procedure']);
			exit;
		}
		redirect(base_url().'procedure_reurb/');
	}

	public function upload_crf(){
		if (isset($_POST['upload_crf'])) {
			$posts = $this->security->xss_clean($this->input->post());
			$file = $this->upload_image_model->upload_img('file_crf', 'assets/build/img/crf', '', 'pdf|PDF');
			if ($file != false) {
				$upload = $this->procedure_reurb_model->fetch_upload_crf($posts['id_procedure']);
				if (empty($upload)) {
					// insert file
					$this->procedure_reurb_model->insert_upload_crf($posts['id_procedure'], $file);
				} else {
					// update file
					$this->procedure_reurb_model->update_upload_crf($upload->id, $file);
				}
			}

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
			if (isset($_POST['register_procedure_reurb'])) {
				redirect(base_url() . 'register_procedure_reurb/detail/' . $posts['id_procedure']);
				exit;
			}
			redirect(base_url() . 'procedure_reurb/detail/' . $posts['id_procedure']);
			exit;
		}
		redirect(base_url().'procedure_reurb/');
	}

	public function update_procedure($id){
		if (isset($_POST['update_procedure'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$this->procedure_reurb_model->update_procedure($posts, $id);
			$this->procedure_reurb_model->update_enrollments_reached($posts, $id);
			$this->procedure_reurb_model->update_confrontant_enrollments($posts, $id);
			if (isset($posts['id_squatters'])) {
				$this->procedure_reurb_model->update_squatters_procedure($posts, $id);
			}

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
			if (isset($_POST['register_procedure_reurb'])) {
				redirect(base_url(). 'register_procedure_reurb/detail/'.$id);
				exit;
			} 
			redirect(base_url(). 'procedure_reurb/detail/'.$id);
			exit;
		}
		redirect(base_url().'procedure_reurb/');
	}

	public function register_procedure_reurb_registration(){
		if (isset($_POST['register_procedure_reurb_registration'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$id_registration = $this->procedure_reurb_model->insert_registration($posts);
			$this->procedure_reurb_model->insert_registration_property_address($id_registration, $posts);
			$this->procedure_reurb_model->insert_registration_address_notificaded($id_registration, $posts);

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
			redirect(base_url().'procedure_reurb/detail/'.$posts['id_procedure']);
		}
		redirect(base_url().'procedure_reurb/');
	}

	public function update_registration(){
		if (isset($_POST['update_registration'])) {
			$posts = $this->security->xss_clean($this->input->post());
			// var_dump($posts['edit_notificaded_checking']);
			// die;
			$this->procedure_reurb_model->update_registration($posts);
			$this->procedure_reurb_model->update_registration_property_address($posts);
			$this->procedure_reurb_model->update_registration_address_notificaded($posts);

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Atualizado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
			redirect(base_url().'procedure_reurb/detail/'.$posts['id_procedure']);
		}
		redirect(base_url().'procedure_reurb/');
	}

	public function notification_upload(){
    if (isset($_POST['notification_upload'])) {
      $posts = $this->security->xss_clean($this->input->post());
      $file = $this->upload_image_model->upload_img('file_notification', 'assets/build/img/notifications', '');
      if ($file) {
				$upload = $this->procedure_reurb_model->fetch_upload_notifications($posts['id_procedure'], $posts['id_registration_upload']);
				if (empty($upload)) {
					// insert file
					$this->procedure_reurb_model->insert_upload_notifications($posts, $file);
				} else {
					// update file
					$this->procedure_reurb_model->update_upload_notifications($upload->id, $file, $posts);
				}
			}

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
			redirect(base_url().'procedure_reurb/detail/'.$posts['id_procedure']);
		}
		redirect(base_url().'procedure_reurb/');
	}

	public function fetch_registration(){
		$return = $this->procedure_reurb_model->fetch_registration($_POST['id']);

		echo json_encode($return);
	}

	public function turn_off(){
		if (isset($_POST['turn_off'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$this->procedure_reurb_model->turn_off($posts);

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Desativado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
			if (isset($_POST['register_procedure_reurb'])) {
				redirect(base_url() . 'register_procedure_reurb/detail/' . $posts['id']);
				exit;
			}
			redirect(base_url() . 'procedure_reurb/detail/' . $posts['id']);
			exit;
		} else {
			$error = array();
			$error['error']['error_string']	= 'Houve um erro, tente novamente! ';
			$error['error']['error_type'] = 'danger'; // Warning | success | danger
			$this->session->set_flashdata($error);
			redirect(base_url().'procedure_reurb');
		}
	}

	public function register_hit(){
		if (isset($_POST['register_hit'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$this->procedure_reurb_model->register_enrollments_reached_procedure($posts);

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
			redirect(base_url().'procedure_reurb/detail/'.$posts['id_procedure']);
		}
	}

	public function register_confrontant_enrollments(){
		if (isset($_POST['register_confrontant_enrollments'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$this->procedure_reurb_model->register_confrontant_enrollments_procedure($posts);

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
			redirect(base_url().'procedure_reurb/detail/'.$posts['id_procedure']);
		}
	}

	public function register_squatters(){
		if (isset($_POST['register_squatters'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$this->procedure_reurb_model->register_squatters($posts);

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
			redirect(base_url().'procedure_reurb/detail/'.$posts['id_procedure']);
		}
	}

}
