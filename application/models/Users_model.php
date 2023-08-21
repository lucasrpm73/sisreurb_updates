<?php
class users_model extends CI_Model {

  public $table = 'admin';

  public function __construct(){
      parent::__construct();
  }

  public function insert_address_user_entity($posts, $id){
    $data = [
      'id_user' => $id,
      'type_street' => $posts['account_type_home'],
      'street' => $posts['account_public_place'],
      'number' => $posts['account_number_home'],
      'complement' => $posts['account_complement_home'],
      'neighborhood' => $posts['account_neighborhood_home'],
      'city' => $posts['account_city_home'],
      'cep' => $posts['account_cep_home'],
      'uf' => $posts['account_uf_home'],
      'country' => $posts['account_country_home'],
    ];
    $this->db->insert('address_user_entity', $data);
    return $this->db->insert_id();
  }

  public function insert_log_view($name_view){
    $data = array(
      'id_user' => $_SESSION['user']['id'],
      'name_view' => $name_view,
    );

    $this->db->insert('log_view', $data);
    return $this->db->insert_id();
  }

  public function insert_queries_logs(){
    $CI = & get_instance();
		$query = $CI->db->queries;
    foreach ($query as $key => $value) {
      $data = array(
        'id_user' => $_SESSION['user']['id'],
        'query' => $value,
      );

      $this->db->insert('queries_logs', $data);
    }
    // return $this->db->insert_id();
  }

  public function fetch_address_user_entity($id){
    $this->db->select('id, type_street, street, number, complement, neighborhood, city, cep, uf, country');
    $this->db->from('address_user_entity');
    $this->db->where('id_user', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_users(){
    $this->db->select('u.id, u.name, u.email, u.status, t.description');
    $this->db->from('users as u');
    $this->db->join('type_register as t', 'u.profile = t.profile', 'left');
    $this->db->where('u.id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_user($id){
    $this->db->select('id, cpf, name, phone, email, note, profile, status');
    $this->db->from('users');
    $this->db->where('id', $id);
    $this->db->where('id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_user_detail($id){
    $this->db->select('id, id_entity, cpf, name, phone, email, note, profile, status');
    $this->db->from('users');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_entity(){
    $this->db->select('id, name');
    $this->db->from('entity');
    $this->db->where('id', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function update_user($rows){
    $this->db->set('cpf', $rows['cpf']);
    $this->db->set('name', $rows['name']);
    $this->db->set('email', $rows['email']);
    $this->db->set('phone', $rows['phone']);
    if ($rows['password'] != '') {
      $password = password_hash($rows['password'], PASSWORD_BCRYPT);
      $this->db->set('password', $password);
    }
    $this->db->set('note', $rows['note']);
    $this->db->set('status', $rows['status']);
		$this->db->where('id', $rows['id_user']);
    $this->db->where('id_entity', $_SESSION['user']['id_entity']);
		$this->db->update('users');
  }

  public function update_user_address($posts){
    $this->db->set('type_street', $posts['account_type_home']);
    $this->db->set('street', $posts['account_public_place']);
    $this->db->set('number', $posts['account_number_home']);
    $this->db->set('complement', $posts['account_complement_home']);
    $this->db->set('neighborhood', $posts['account_neighborhood_home']);
    $this->db->set('city', $posts['account_city_home']);
    $this->db->set('cep', $posts['account_cep_home']);
    $this->db->set('uf', $posts['account_uf_home']);
    $this->db->set('country', $posts['account_country_home']);
    $this->db->where('id', $posts['id_address_user']);
    $this->db->update('address_user_entity');
  }

}
