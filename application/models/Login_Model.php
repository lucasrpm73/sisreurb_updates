<?php

class Login_model extends CI_Model {

  public $table = 'users';

  public function __construct(){
      parent::__construct();
  }

  public function insert_recover_password(array $data){
    return $this->db->insert('recover_password', $data);
  }

  public function autentica_email($email){
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('email', $email);
    $query = $this->db->get();
    return $query->result();
  }

  public function autentica_token($token){
    $this->db->select('*');
    $this->db->from('recover_password');
    $this->db->where('token', $token);
    $query = $this->db->get();
    return $query->result();
  }

  public function autentica_login($email){
    $this->db->select('id');
    $this->db->from('admin');
		$this->db->where('email', $email);
		$query = $this->db->get();
    return $query->result();
  }

  public function registerUser($data) {
    # register user
    $password = password_hash($data['password'], PASSWORD_BCRYPT);
    // $user = $this->db->insert($this->table, array("id_entity" => $_SESSION['user']['id_entity'],
    // "cpf" => $data['cpf'],
    // "name" => $data['name'],
    // "phone" => $data['phone'],
    // "profile" => $data['profile'],
    // "email" => $data['email'],
    // "password" => $password,
    // "status" => '1'));

    $data = [
      'id_entity' => $_SESSION['user']['id_entity'],
      'cpf' => $data['cpf'],
      'name' => $data['name'],
      'phone' => $data['phone'],
      'profile' => $data['profile'],
      'email' => $data['email'],
      'password' => $password,
      'status' => '1'
    ];
    $this->db->insert('users', $data);
    return $this->db->insert_id();
  }

  public function insert_access_log($user){
    $data = [
      'id_user' => $user['id'],
    ];
    $this->db->insert('access_log', $data);
  }

  public function updateUser($data) {
    # update user
    $updatedata = array();

    if (!empty($data['password'])) {
      $senha = password_hash($data['password'], PASSWORD_BCRYPT);
      $updatedata['password'] = $senha;
    }

    // if (!empty($data['nome'])) {
    //   $updatedata['nome'] = $data['nome'];
    // }

    $user = $this->db->update($this->table, $updatedata, array("id" => $data['id']));

    return $user;
  }


  public function autentica($data = array()){
    if(!empty($data['email']) && !empty($data['password'])){

      // Primeiro valida o e-mail

      $return = $this->db->select('*')->where(array('email' => $data['email']))->get($this->table);

      if($return->num_rows()) {

        // usuário encontrado

        $user = $return->row_array();

        // faz a comparação da senha informada com a hash cadastrada;

        $validation = password_verify($data['password'], $user['password']);

        if ($validation)
          // sucesso
          return $user;
        else
          // sem sucesso
          return array();
      }
      return array();
    }
    return array();
  }

  public function checkUser() {
    try {
      $user = $this->session->userdata('user');
    }
    catch(\Exception $ex) {
      $user = array();
    }
    return $user;
  }

  public function user() {
    return @$this->session->userdata('user');
  }

}
