<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notarys_office extends CI_Controller {
	public $user;

  public function __construct(){
		parent::__construct();

		$this->load->model("property_registration_model");
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
	}

	public function index()
	{
		$data['error'] 	= (isset($_SESSION['error'])? $_SESSION['error'] : '');
		$name_view = 'notarys_office/';
		$this->users_model->insert_log_view($name_view);
		// var_dump($_SESSION); die;
		// echo $_SESSION['user']['id_entity']; die;
		$data['notarys_office'] = $this->property_registration_model->fetch_notaries_office();

		$this->users_model->insert_queries_logs();
		$this->load->view('notarys_office/list', $data);
	}

	public function detail($id)
	{
		$data['error'] 	= (isset($_SESSION['error'])? $_SESSION['error'] : '');
		$data['notary_office'] = $this->property_registration_model->fetch_notary_office($id);
		if (isset($data['notary_office']) && $data['notary_office']->id_entity == $_SESSION['user']['id_entity']) {
			$data['type_notarys_office'] = $this->property_registration_model->fetch_type_notarys_office();

			$name_view = 'notarys_office/detail/'.$id;
			$this->users_model->insert_log_view($name_view);
			$this->users_model->insert_queries_logs();

			$this->load->view('notarys_office/detail', $data);
		} else {
			$data['error'] 	= (isset($_SESSION['error'])? $_SESSION['error'] : '');
			$data['data_error'] = 'Cartório não encontrado!!';

			$this->load->view('not_data_found/not_data_found', $data);
		}
	}

	public function update_property_registration($id){
		if (isset($_POST['update_registry'])) {
			$posts = $this->security->xss_clean($this->input->post());
			$this->property_registration_model->update_registry($id, $posts);

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
		}
		redirect(base_url().'notarys_office/detail/'.$id);
	}

	public function register()
	{
		$name_view = 'notarys_office/register';
		$this->users_model->insert_log_view($name_view);
		$data['type_notarys_office'] = $this->property_registration_model->fetch_type_notarys_office();

		$this->users_model->insert_queries_logs();
		$this->load->view('notarys_office/register', $data);
	}

	public function register_property(){
		if (isset($_POST['new_registry'])) {

			$posts = $this->security->xss_clean($this->input->post());
			// $type_notarys_office = 3;
			$id = $this->property_registration_model->insert($posts);
			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
		}
		redirect(base_url().'notarys_office/detail/'.$id);
	}

	public function turn_off(){
		if (isset($_POST['turn_off'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$this->property_registration_model->turn_off($posts);

			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Desativado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
			redirect(base_url().'notarys_office/detail/'.$posts['id']);
		} else {
			$error = array();
			$error['error']['error_string']	= 'Houve um erro, tente novamente! ';
			$error['error']['error_type'] = 'danger'; // Warning | success | danger
			$this->session->set_flashdata($error);
			redirect(base_url().'notarys_office');
		}
	}

}
