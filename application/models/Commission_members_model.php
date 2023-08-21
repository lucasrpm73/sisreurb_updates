<?php
class Commission_members_model extends CI_Model {

  public $table = 'members_commission';

  public function __construct(){
      parent::__construct();
  }

  public function insert($posts, $image){
    $data = array(
      'id_entity' => $_SESSION['user']['id_entity'],
      'type_register' => $posts['register_type'],
      'representative' => $posts['representative'],
      'appointment_ordinance' => $posts['appointment_ordinance'],
      'cpf' => $posts['cpf_president'],
      'name' => $posts['name_president'],
      'rg' => $posts['rg_president'],
      'dispatcher' => $posts['oe_president'],
      'profission' => $posts['profession_president'],
      'birth_date' => $posts['birth_president'],
      'gender' => $posts['gender_president'],
      'nationality' => $posts['nationality_president'],
      'phone' => $posts['phoneNumber_president'],
      'email' => $posts['email_president'],
      'img' => $image,
      'status' => 1,
    );

    $this->db->insert('members_commission', $data);
    return $this->db->insert_id();
  }

  public function fetch_members_commission(){
    $this->db->select('id, type_register, name, phone');
    $this->db->from('members_commission');
    $this->db->where('id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_member_commission($id){
    $this->db->select('id, id_entity, type_register, representative, appointment_ordinance,
    cpf, name, rg, dispatcher, profission, birth_date, gender, nationality,
    phone, email, img, status');
    $this->db->from('members_commission');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function update_commission_members($id, $posts){
    $this->db->set('cpf', $posts['cpf']);
    $this->db->set('name', $posts['nome']);
    $this->db->set('rg', $posts['rg']);
    $this->db->set('dispatcher', $posts['org_exp']);
    $this->db->set('birth_date', $posts['birth_date']);
    $this->db->set('gender', $posts['gender']);
    $this->db->set('nationality', $posts['nationality']);
    $this->db->set('phone', $posts['phone']);
    $this->db->set('email', $posts['email']);
    $this->db->set('status', $posts['active_commission']);
    $this->db->where('id', $id);
    $this->db->update('members_commission');
  }

  public function update_image($id, $image){
    $this->db->set('img', $image);
    $this->db->where('id', $id);
    $this->db->update('members_commission');
  }

  public function isset_mayor(){
    $this->db->select('id, id_entity, type_register, representative, appointment_ordinance,
    cpf, name, rg, dispatcher, profission, birth_date, gender, nationality,
    phone, email, img, status');
    $this->db->from('members_commission');
    $this->db->where('type_register', 'Presidente');
    $this->db->where('id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->row();
  }

}
