<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requesters extends CI_Controller {
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
		$this->load->model("upload_image_model");
	}

	public function index()
	{
		$data['error'] 	= (isset($_SESSION['error'])? $_SESSION['error'] : '');
		$name_view = 'requesters/';
		$this->users_model->insert_log_view($name_view);
		$data['requesters'] = $this->requesters_model->fetch_requesters();

		$this->users_model->insert_queries_logs();
		$this->load->view('requesters/list', $data);
	}

	public function register()
	{
		$name_view = 'requesters/register';
		$this->users_model->insert_log_view($name_view);

		$this->users_model->insert_queries_logs();
		$this->load->view('requesters/register');
	}

	public function detail($id)
	{
		$data['error'] 	= (isset($_SESSION['error'])? $_SESSION['error'] : '');
		$name_view = 'requesters/detail/'.$id;
		$this->users_model->insert_log_view($name_view);

		// var_dump($_SESSION['user']['id_entity']); die;

		$data['requester_juridical'] = $this->requesters_model->fetch_requester_juridical($id);
		$data['conclusion_requester_legal'] = $this->requesters_model->fetch_conclusion_requester_legal($id);
		$data['requester_legal'] = $this->requesters_model->fetch_requester_legal($id);
		$data['requester_history'] = $this->requesters_model->fetch_requester_history($id);
		// echo "<pre>";
		// var_dump($data['requester_legal']); die;

		// $data['protocol_history'] = $this->requesters_model->fetch_requester_protocol_history($id);
		// echo "<pre>";
		// var_dump($data['protocol_history']);
		// die;
		// var_dump($data['requester_juridical']->id_entity); die;

		// if (isset($data['requester_juridical']) || isset($data['requester_legal'])) {
			// if ($data['requester_legal']->id_entity == $_SESSION['user']['id_entity'] || $data['requester_juridical'] == $_SESSION['user']['id_entity']) {
				$data['family_members'] = $this->requesters_model->fetch_family_members($id);
				$data['checklist_physical'] = $this->requesters_model->fetch_checklist_requester($id);
				$data['documents_entity_physical'] = $this->requesters_model->fetch_documents_entity_physical();

				if (empty($data['checklist'])) {
					$this->requesters_model->insert_checklist_requester($id);
				}

				$data['checklist'] = $this->requesters_model->fetch_checklist_requester($id);
				$data['files_checklist'] = $this->requesters_model->fetch_files_checklist($id);
				$data['count_checklist_required_physical'] = $this->requesters_model->count_checklist_required_physical();
				$data['count_checklist_required_juridical'] = $this->requesters_model->count_checklist_required_juridical();
				$data['count_checklist_send'] = $this->requesters_model->count_checklist_send($id);
				$data['checklist_not_send_requester'] = $this->requesters_model->fetch_checklist_not_send_requester_physical($id);
				$data['checklist_not_send_requester_juridical'] = $this->requesters_model->fetch_checklist_not_send_requester_juridical($id);
				$data['checklist_not_send_married'] = $this->requesters_model->fetch_checklist_not_send_married_physical($id);
				$data['topographic_survey'] = $this->requesters_model->fetch_topographic_survey($id);

				if (empty($data['topographic_survey'])) {
					$add_topographic_survey = $this->requesters_model->fetch_status_topographic_survey();
					$this->requesters_model->insert_topographic_survey($id, $add_topographic_survey);
					$data['topographic_survey'] = $this->requesters_model->fetch_topographic_survey($id);
				}

				$data['id'] = $id;

				$this->users_model->insert_queries_logs();

				$this->load->view('requesters/detail', $data);
			// } else {
			// 	$data['data_error'] = 'Requerente não encontrado!!';
			//
			// 	$this->load->view('not_data_found/not_data_found', $data);
			// }
		// } else {
		// 	$data['data_error'] = 'Requerente não encontrado!!';
		//
		// 	$this->load->view('not_data_found/not_data_found', $data);
		// }
	}

	public function turn_off_requester(){
		if (isset($_POST['turn_off_requester'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$this->requesters_model->turn_off_requester($posts);

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Desativado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
			redirect(base_url().'requesters/detail/'.$posts['id']);
		} else {
			$error = array();
			$error['error']['error_string']	= 'Houve um erro, tente novamente! ';
			$error['error']['error_type'] = 'danger'; // Warning | success | danger
			$this->session->set_flashdata($error);
			redirect(base_url().'requesters');
		}
	}

	public function update_requester($id, $posts){
		if (isset($posts['save_conclusion_requester'])) {
			if ($posts['type_requester'] == 'fisico') {
				$monthly_income_personal = str_replace(".", "", $posts['monthly_income_personal']);
				$posts['monthly_income_personal'] = str_replace(",", ".", $monthly_income_personal);

				$monthly_income_spouse = str_replace(".", "", $posts['monthly_income_spouse']);
				$posts['monthly_income_spouse'] = str_replace(",", ".", $monthly_income_spouse);

				if ($posts['cash_transfer_program'] == 1) {
					$federal_government_income = str_replace(".", "", $posts['federal_government_income']);
					$posts['federal_government_income'] = str_replace(",", ".", $federal_government_income);
				}

				if ($posts['cash_transfer_program_spouse'] == 1) {
					$federal_government_income_spouse = str_replace(".", "", $posts['federal_government_income_spouse']);
					$posts['federal_government_income_spouse'] = str_replace(",", ".", $federal_government_income_spouse);
				}

				$this->requesters_model->update_legal_person($posts, $id);
				$this->requesters_model->update_spouse($posts, $id);
				$this->requesters_model->update_family_members($posts);
				$this->requesters_model->update_home_address($posts, $id);

				if ($_SESSION['user']['profile'] == '1') {
					if (isset($posts['id_topographic_survey'])) {
						$topographic_survey = $this->requesters_model->fetch_topographic_survey($id);
						$this->requesters_model->disable_topographic_survey($topographic_survey, $posts);

						$topographic_new_data = $this->requesters_model->fetch_topographic_survey($id);
						$this->requesters_model->update_topographic_survey($topographic_new_data, $posts);
					} else {
						$topographic_survey = $this->requesters_model->fetch_topographic_survey($id);
						$this->requesters_model->disable_all_topographic_survey($topographic_survey);
					}
				}
				// $this->requesters_model->update_property_details($posts, $id);

			} else if($posts['type_requester'] == 'juridico'){
				$monthly_invoicing_juridical = str_replace(".", "", $posts['monthly_invoicing_juridical']);
				$posts['monthly_invoicing_juridical'] = str_replace(",", ".", $monthly_invoicing_juridical);

				if ($posts['cash_transfer_program'] == 1) {
					$federal_government_income = str_replace(".", "", $posts['federal_government_income_juridical']);
					$posts['federal_government_income_juridical'] = str_replace(",", ".", $federal_government_income);
				}

				$this->requesters_model->update_juridical_requester($posts, $id);
				$this->requesters_model->update_procurator($posts, $id);
				$this->requesters_model->update_home_address_juridical($posts, $id);
				// $this->requesters_model->update_property_details_juridical($posts, $id);

				if ($_SESSION['user']['profile'] == '1') {
					if (isset($posts['id_topographic_survey'])) {
						$topographic_survey = $this->requesters_model->fetch_topographic_survey($id);
						$this->requesters_model->disable_topographic_survey($topographic_survey, $posts);

						$topographic_new_data = $this->requesters_model->fetch_topographic_survey($id);
						$this->requesters_model->update_topographic_survey($topographic_new_data, $posts);
					} else {
						$topographic_survey = $this->requesters_model->fetch_topographic_survey($id);
						$this->requesters_model->disable_all_topographic_survey($topographic_survey);
					}
				}

			}
			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
		}
		redirect(base_url().'requesters/detail/'.$id);
	}
	
	public function register_new_member_family($id){
		if (isset($_POST['register_new_member_family'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$id_requester = $id;
			$this->requesters_model->insert_family_members($posts, $id_requester);
			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Membro da familia adicionado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
		}
		redirect(base_url().'requesters/detail/'.$id);
	}

	public function register_requesters(){
		if (isset($_POST['register_requesters'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$id_requester = $this->requesters_model->insert($posts);
			if ($_POST['people_type'] == 1) {
				$monthly_income_personal = str_replace(".", "", $posts['monthly_income_personal']);
				$posts['monthly_income_personal'] = str_replace(",", ".", $monthly_income_personal);

				$monthly_income_spouse = str_replace(".", "", $posts['monthly_income_spouse']);
				$posts['monthly_income_spouse'] = str_replace(",", ".", $monthly_income_spouse);

				if (isset($posts['cash_transfer_program'])) {
					if ($posts['cash_transfer_program'] == 1) {
						$federal_government_income = str_replace(".", "", $posts['federal_government_income']);
						$posts['federal_government_income'] = str_replace(",", ".", $federal_government_income);
					}
				}

				if (isset($posts['cash_transfer_program_spouse'])) {
					if ($posts['cash_transfer_program_spouse'] == 1) {
						$federal_government_income_spouse = str_replace(".", "", $posts['federal_government_income_spouse']);
						$posts['federal_government_income_spouse'] = str_replace(",", ".", $federal_government_income_spouse);
					}
				}

				$this->requesters_model->insert_legal_request($posts, $id_requester);
				$this->requesters_model->insert_spouse($posts, $id_requester);
				$this->requesters_model->insert_family_members($posts, $id_requester);
				$this->requesters_model->insert_home_address($posts, $id_requester);

				$topographic_survey = $this->requesters_model->fetch_status_topographic_survey();
				$this->requesters_model->insert_topographic_survey($id_requester, $topographic_survey);

			} else if($_POST['people_type'] == 2){
				$monthly_invoicing_juridical = str_replace(".", "", $posts['monthly_invoicing_juridical']);
				$posts['monthly_invoicing_juridical'] = str_replace(",", ".", $monthly_invoicing_juridical);

				if ($posts['cash_transfer_program'] == 1) {
					$federal_government_income = str_replace(".", "", $posts['federal_government_income_juridical']);
					$posts['federal_government_income_juridical'] = str_replace(",", ".", $federal_government_income);
				}

				$this->requesters_model->insert_juridical_requester($posts, $id_requester);
				$this->requesters_model->insert_procurator($posts, $id_requester);
				$this->requesters_model->insert_home_address_juridical($posts, $id_requester);

				$topographic_survey = $this->requesters_model->fetch_status_topographic_survey();
				$this->requesters_model->insert_topographic_survey($id_requester, $topographic_survey);

			}
			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
		}

		redirect(base_url().'requesters/detail/'.$id_requester);
	}

	public function update_files(){
		if (isset($_POST['update_files'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$file = $this->upload_image_model->upload_img('edit_arquivo', 'assets/build/img/checklist_requester', '');
			// var_dump($file); die;
			if ($file != false) {
				$this->requesters_model->update_files_requesters($posts, $file);

				$this->users_model->insert_queries_logs();
				$error = array();
				$error['error']['error_string']	= 'Alterado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
				$error['error']['error_type'] = 'success'; // Warning | success | danger
				$this->session->set_flashdata($error);
			}else{
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
		redirect(base_url().'requesters/detail/'.$_POST['id_requester']);
	}

	public function isset_cpf_cnpj()
	{
		$posts = $this->security->xss_clean($this->input->post());

		$return = $this->requesters_model->isset_cpf_cnpj($posts);

		$this->users_model->insert_queries_logs();
		echo json_encode($return);
	}

	public function send_files()
	{
		// echo "entrou"; die;
		if (isset($_POST['send_files'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$file = $this->upload_image_model->upload_img('arquivo', 'assets/build/img/checklist_requester', '');

			if ($file != false) {
				$this->requesters_model->insert_files_requester($posts, $file);
				// echo "entrou";
				$this->users_model->insert_queries_logs();
				$error = array();
				$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
				$error['error']['error_type'] = 'success'; // Warning | success | danger
				$this->session->set_flashdata($error);
			}else{
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
		redirect(base_url().'requesters/detail/'.$_POST['id_requester']);
	}

	public function requester_history($posts){
			$status = '1';
			$this->requesters_model->update_requester_history($posts, $status);

			$this->requesters_model->register_requester_history($posts, $status);

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Concluido com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
			redirect(base_url().'requesters/detail/'.$posts['id_requester']);
	}


	public function requester_history_cancel(){
			$posts = $this->security->xss_clean($this->input->post());

			$status = '0';
			$this->requesters_model->update_requester_history($posts, $status);

			$this->requesters_model->register_requester_history($posts, $status);
			// $this->requesters_model->register_protocol_history($posts, $status);

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
			redirect(base_url().'requesters/detail/'.$posts['id_requester']);
		
	}

	public function update_requester_history(){
			$posts = $this->security->xss_clean($this->input->post());

			$this->requesters_model->update_requester_history_data($posts);

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Atualizado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
			redirect(base_url().'requesters/detail/'.$posts['id_requester']);

	}
	public function save_conclusion_requester($id){
		$posts = $this->security->xss_clean($this->input->post());
		if($posts["idTypeForm"]== 1){
			$this->requester_history($posts);
			$this->update_requester($id, $posts);
		}else{
			$this->update_requester($id, $posts);
		}
	}

}
