<?php
class Entity_model extends CI_Model {

  public $table = 'entity';

  public function __construct(){
      parent::__construct();
  }

  public function fetch_entity(){
    $this->db->select('e.id, e.cnpj, e.country, e.public_place, e.address, e.number, e.complement, e.neighborhood, e.uf, e.city, e.cep, e.destrict, e.nation, e.img, e.administration_logo, e.status,
      c.civil_status, e.name as name_entity, e.phone as phone_entity, e.email as email_entity, e.site as site_entity,
      c.id as id_mayor, c.cpf, c.name, c.rg, c.dispatcher, c.profission, c.birth_date, c.gender, c.nacionality, c.phone, c.email,
      c.type_street as type_street_mayor, c.street as street_mayor, c.number as number_mayor, c.complement as complement_mayor, c.neighborhood as neighborhood_mayor,
      c.city as city_mayor, c.cep as cep_mayor, c.uf as uf_mayor, c.country as country_mayor,
      p.id as id_president, p.cpf as cpf_president, p.name as name_president, p.rg as rg_president, p.dispatcher as dispatcher_president, p.profission as profission_president, p.birth_date as birth_date_president, p.gender as gender_president, p.nationality as nationality_president, p.phone as phone_president, p.email as email_president,
    ');
    $this->db->from('entity as e');
    $this->db->join('city_mayor as c', 'c.id_entity = e.id', 'left');
    $this->db->join('president_commission as p', 'p.id_entity = e.id', 'left');
    $this->db->where('e.id', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_members_commission(){
    $this->db->select('m.id, m.cpf, m.name, m.rg, m.dispatcher, m.profission, m.birth_date, m.gender, m.nationality, m.phone, m.email');
    $this->db->from('members_commission as m');
    $this->db->where('m.id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_notarys_office(){
    $this->db->select('n.id, n.country, n.judicial_district, n.type_place, n.public_place, n.number, n.complement, n.neighborhood, n.city, n.cep, n.uf, n.district, n.nationality, n.registration_officer,');
    $this->db->from('notarys_office as n');
    $this->db->where('n.id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_notary_office($id){
    $this->db->select('n.id, n.name_registry, n.country, n.judicial_district, n.type_place, n.public_place, n.number, n.complement, n.neighborhood, n.city, n.cep, n.uf, n.district, n.nationality, n.registration_officer,');
    $this->db->from('notarys_office as n');
    $this->db->where('n.id_entity', $_SESSION['user']['id_entity']);
    $this->db->where('n.id', $id);
    $query = $this->db->get();
    return $query->row();
  }

}
