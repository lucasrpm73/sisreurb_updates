<?php
class Property_registration_model extends CI_Model {

  public $table = 'notarys_office';

  public function __construct(){
      parent::__construct();
  }

  public function insert($posts){
    $data = array(
      'id_entity' => $_SESSION['user']['id_entity'],
      'name_registry' => $posts['name_registry'],
      'judicial_district' => $posts['judicial_district'],
      'country' => $posts['country_registry'],
      'type_place' => $posts['public_place_type_registry'],
      'public_place' => $posts['public_place_registry'],
      // 'street' => $posts['street_registry'],
      'number' => $posts['public_place_number_registry'],
      'complement' => $posts['public_place_complement_registry'],
      'neighborhood' => $posts['neighbourhood_registry'],
      'city' => $posts['city_registry'],
      'cep' => $posts['postal_code_registry'],
      'uf' => $posts['UF_registry'],
      'nationality' => $posts['country_registry'],
      'registration_officer' => $posts['registration_officer'],
      'substitute_officer' => $posts['substitute_officer'],
      'cns' => $posts['cns_registry'],
      'email' => $posts['email'],
      'phone' => $posts['phone'],
      'celphone' => $posts['celphone'],
      'type_notarys_office' => $posts['notary_type'],
      'status' => '1',
    );
    $this->db->insert('notarys_office', $data);
    return $this->db->insert_id();
  }

  public function fetch_type_notarys_office(){
    $this->db->select('id, description');
    $this->db->from('status_notarys_office');
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_notaries_office(){
    $this->db->select('n.id, n.name_registry, n.type_place, n.public_place, n.number, n.uf, n.complement,
    n.neighborhood, n.city, n.street, n.email, n.phone, n.celphone, n.judicial_district,
    s.description');
    $this->db->from('notarys_office as n');
    $this->db->join('status_notarys_office as s', 'n.type_notarys_office = s.id');
    $this->db->where('n.status', '1');
    $this->db->where('n.id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_notary_office($id){
    $this->db->select('id, id_entity, name_registry, country, type_place, type_place,
      public_place, street, number, complement, neighborhood, city, cep, uf, nationality, registration_officer,
      cns, substitute_officer, type_notarys_office, email, phone, celphone, judicial_district, status,
    ');
    $this->db->from('notarys_office');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function update_registry($id, $posts){
    $this->db->set('name_registry', $posts['name_registry']);
    $this->db->set('judicial_district', $posts['judicial_district']);
    $this->db->set('country', $posts['country_registry']);
    $this->db->set('type_place', $posts['public_place_type_registry']);
    $this->db->set('public_place', $posts['public_place_registry']);
    // $this->db->set('street', $posts['street_registry']);
    $this->db->set('number', $posts['public_place_number_registry']);
    $this->db->set('complement', $posts['public_place_complement_registry']);
    $this->db->set('neighborhood', $posts['neighbourhood_registry']);
    $this->db->set('city', $posts['city_registry']);
    $this->db->set('cep', $posts['postal_code_registry']);
    $this->db->set('uf', $posts['UF_registry']);
    $this->db->set('nationality', $posts['country_registry']);
    $this->db->set('registration_officer', $posts['registration_officer']);
    $this->db->set('substitute_officer', $posts['substitute_officer']);
    $this->db->set('cns', $posts['cns_registry']);
    $this->db->set('email', $posts['email']);
    $this->db->set('phone', $posts['phone']);
    $this->db->set('celphone', $posts['celphone']);
    $this->db->set('type_notarys_office', $posts['notary_type']);
    $this->db->where('id', $id);
    $this->db->update('notarys_office');
  }

  public function turn_off($posts){
    $status = ($posts['status'] == '1') ? '0' : '1';
    $this->db->set('status', $status);
    $this->db->where('id', $posts['id']);
    $this->db->update('notarys_office');
  }

}
