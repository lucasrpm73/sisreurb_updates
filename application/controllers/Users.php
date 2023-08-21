<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class users extends CI_Controller {
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

    if ($_SESSION['user']['profile'] != "1") {
      redirect('/');
			exit();
    }

		$this->user = $this->login->user();
	}

	public function index()
	{
    $data['error'] 	= (isset($_SESSION['error'])? $_SESSION['error'] : '');
    $name_view = 'users/';
		$this->users_model->insert_log_view($name_view);
    $data['users'] = $this->users_model->fetch_users();

    $this->users_model->insert_queries_logs();
		$this->load->view('users/users', $data);
	}

  public function register()
	{
    if (isset($_POST['register_user'])) {
      // $this->form_validation->set_rules('name', 'name', 'trim|required|min_length[2]');
      // $this->form_validation->set_rules('profile', 'profile', 'trim|required');
      // $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
      // $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[8]');
      // $this->form_validation->set_error_delimiters("<p class='text-danger'>", "</p>");
      //
      // $sucess = $this->form_validation->run();
      //
      // if ($sucess) {
        $posts = $this->security->xss_clean($this->input->post());

        $data = array(
          "id_entity" => $_SESSION['user']['id_entity'],
          "cpf" => $this->input->post('cpf_account'),
          "name" => $this->input->post('account_manager'),
          'phone' => $this->input->post('phone_account'),
          'email' => $this->input->post('email_account'),
          'password' => $this->input->post('repeat_password'),
          'profile' => $this->input->post('profile'),
        );
  			$id = $this->login->registerUser($data);
        $this->users_model->insert_address_user_entity($posts, $id);
        //MENSAGEM DE AVISO
        $error = array();
        $error['error']['error_string'] 	= 'Registro realizado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
        $error['error']['error_type'] 		= 'success'; // Warning | success | danger
        $this->session->set_flashdata($error);
        redirect(base_url().'users/detail/'.$id);
      // }
    }
    // die;
    $name_view = 'users/register';
		$this->users_model->insert_log_view($name_view);

    $this->users_model->insert_queries_logs();
		$this->load->view('users/register');
	}

  public function detail($id){
    $data['error'] 	= (isset($_SESSION['error'])? $_SESSION['error'] : '');
    $data['user_detail'] = $this->users_model->fetch_user_detail($id);
    if (isset($data['user_detail'])) {
      if ($data['user_detail']->id_entity == $_SESSION['user']['id_entity']) {
        $data['address'] = $this->users_model->fetch_address_user_entity($id);

        $name_view = 'users/detail/'.$id;
        $this->users_model->insert_log_view($name_view);
        $this->users_model->insert_queries_logs();
        $this->load->view('users/detail', $data);
      } else {
        $data['data_error'] = 'Usuário não encontrado!!';

        $this->load->view('not_data_found/not_data_found', $data);
      }
		} else {
			$data['data_error'] = 'Usuário não encontrado!!';

			$this->load->view('not_data_found/not_data_found', $data);
		}
  }

  public function update_user(){
    $posts = $this->security->xss_clean($this->input->post());
    $rows = array();

    $rows['cpf'] = $this->security->xss_clean($this->input->post('cpf_account'));
    $rows['phone'] = $this->security->xss_clean($this->input->post('phone_account'));
    $rows['name'] = $this->security->xss_clean($this->input->post('name'));
    $rows['email'] = $this->security->xss_clean($this->input->post('email'));
    $rows['password'] = $this->security->xss_clean($this->input->post('password'));
    $rows['profile'] = $this->security->xss_clean($this->input->post('profile'));
    $rows['note'] = $this->security->xss_clean($this->input->post('note'));
    $rows['status'] = $this->security->xss_clean($this->input->post('status'));
		$rows['id_user'] = $this->security->xss_clean($this->input->post('id_user'));

    $this->users_model->update_user($rows);
    $this->users_model->update_user_address($posts);
    $this->users_model->insert_queries_logs();
    $error = array();
    $error['error']['error_string']	= 'Registrado com sucesso, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
    $error['error']['error_type'] = 'success'; // Warning | success | danger
    $this->session->set_flashdata($error);
    redirect(base_url().'users/detail/'.$this->input->post('id_user'));
  }
}
