<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commission_members extends CI_Controller {
	public $user;

  public function __construct(){
		parent::__construct();

		$this->load->model("commission_members_model");
		$this->load->model("upload_image_model");
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
		$name_view = 'commission_members/';
		$this->users_model->insert_log_view($name_view);
		$data['commission_members'] = $this->commission_members_model->fetch_members_commission();

		$this->users_model->insert_queries_logs();
		$this->load->view('commission_members/list', $data);
	}

	public function detail($id)
	{
		$data['error'] 	= (isset($_SESSION['error'])? $_SESSION['error'] : '');
		$data['member_commission'] = $this->commission_members_model->fetch_member_commission($id);
		if (isset($data['member_commission']) && $data['member_commission']->id_entity == $_SESSION['user']['id_entity']) {
			$name_view = 'commission_members/detail/'.$id;
			$this->users_model->insert_log_view($name_view);
			$this->users_model->insert_queries_logs();

			$this->load->view('commission_members/detail', $data);
		} else {
			$data['error'] 	= (isset($_SESSION['error'])? $_SESSION['error'] : '');
			$data['data_error'] = 'Membro da Comissão não encontrado!!';

			$this->load->view('not_data_found/not_data_found', $data);
		}
	}

	public function update_commission_members($id){
		if (isset($_POST['register_commission_member'])) {
			$posts = $this->security->xss_clean($this->input->post());
			$this->commission_members_model->update_commission_members($id, $posts);
			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
		}
		redirect(base_url().'commission_members/detail/'.$id);
	}

	public function update_image($id){
		// if ($_FILES["img_commission_members"]['name'] != "") {
			// $image = file_get_contents($_FILES["img_commission_members"]['tmp_name']);
		// }
		$image = $this->upload_image_model->upload_img('img_commission_members', 'assets/build/img/commission_members', 'perfil.pnh');
		$this->commission_members_model->update_image($id, $image);

		$error = array();
		$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
		$error['error']['error_type'] = 'success'; // Warning | success | danger
		$this->session->set_flashdata($error);

		$this->users_model->insert_queries_logs();
		redirect(base_url().'commission_members/detail/'.$id);
	}

	public function register()
	{
		$name_view = 'commission_members/register';
		$this->users_model->insert_log_view($name_view);
		$data['isset_mayor'] = $this->commission_members_model->isset_mayor();

		$this->users_model->insert_queries_logs();
		$this->load->view('commission_members/register', $data);
	}

	public function register_commission_members(){
		if (isset($_POST['register_commission_member'])) {
			$posts = $this->security->xss_clean($this->input->post());

			$image = $this->upload_image_model->upload_img('img_commission_members', 'assets/build/img/commission_members', 'perfil.pnh');


			// if ($_FILES["img_commission_members"]['name'] == "") {
			// 	$image = 'perfil.png';
			// }else{
			// 	$image = file_get_contents($_FILES["img_commission_members"]['tmp_name']);
			// }

			$id = $this->commission_members_model->insert($posts, $image);
			$this->users_model->insert_queries_logs();
			$error = array();
			$error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
			$error['error']['error_type'] = 'success'; // Warning | success | danger
			$this->session->set_flashdata($error);
		}
		redirect(base_url().'commission_members/detail/'.$id);
	}

}
