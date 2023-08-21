<?php
class Procedure_reurb_model extends CI_Model {

  public $table = 'notarys_office';

  public function __construct(){
      parent::__construct();
  }

  public function insert($posts){
    $data = [
      'id_entity' => $_SESSION['user']['id_entity'],
      'id_notarys_office' => $posts['cartorio'],
      'process_number' => $posts['process_number'],
      'requester' => $posts['requester'],
      'total_regularized_area' => $posts['total_regularized_area'],
      'date_requester' => $posts['date_requester'],
      'core_name' => $posts['core_name'],
      'irregular_parceler' => $posts['irregular_parceler'],
      'modality' => $posts['modality'],
      'rito' => $posts['rito'],
      'decision' => $posts['decision'],
      'decision_date' => $posts['decision_date'],
      'end_date' => $posts['end_date'],
      'publication_procedure' => $posts['publication_procedure'],
      'issue_date' => $posts['issue_date'],
      'original_registration' => $posts['original_registration'],
      'type_property' => $posts['type_property'],
      'perimeter_description' => $posts['description'],
      'stage' => $posts['stage'],
      'status' => '1',
    ];
    $this->db->insert('procedure_reurb', $data);
    return $this->db->insert_id();
  }

  public function insert_embargo_history($posts, $file){
    $data = [
      'id_entity' => $_SESSION['user']['id_entity'],
      'id_procedure' => $posts['id_protocol'],
      'id_responsible' => $posts['id_requester_embarkation'],
      'reason' => $posts['reason'],
      'file' => $file,
      'status' => '1',
    ];
    $this->db->insert('embargo_history', $data);
    return $this->db->insert_id();
  }

  public function insert_enrollments_reached_procedure($posts, $id){
    foreach ($posts['number_hit'] as $key => $value) {
      $data = [
        'id_procedure' => $id,
        'number' => $value,
        'area' => $posts['area_hit'][$key],
        'property_registration' => $posts['property_registration_hit'][$key],
        'owner' => $posts['owner_hit'][$key],
        'address' => $posts['address_hit'][$key],
      ];
      $this->db->insert('enrollments_reached_procedure', $data);
    }
  }

  public function insert_files_protocols($posts, $file){
    $data = [
      'id_protocol' => $posts['id_protocol'],
      'id_document' => $posts['type_arquivo'],
      'file' => $file,
    ];
    $this->db->insert('checklist_protocol_files', $data);
    return $this->db->insert_id();
  }

  public function insert_files_checklist_protocols($id, $posts, $images){
    foreach ($images['file_checklist'] as $key => $value) {
      $data = [
        'id_protocol' => $id,
        'id_document' => $posts['type_arquivo_checklist'][$key],
        'file' => $value,
      ];
      $this->db->insert('checklist_protocol_files', $data);
    }
  }

  public function update_files_protocols($posts, $file){
    // foreach ($images['files_checklist'] as $key => $value) {
      // if ($value != '') {
        $this->db->set('file', $file);
        $this->db->where('id_protocol', $posts['id_protocol']);
        $this->db->where('id', $posts['id_arquivo']);
        $this->db->update('checklist_protocol_files');
      // }
    // }
  }

  public function register_enrollments_reached_procedure($posts){
    $data = [
      'id_procedure' => $posts['id_procedure'],
      'number' => $posts['modal_number_hit'],
      'area' => $posts['modal_field_hit'],
      'property_registration' => $posts['modal_property_registration_hit'],
      'owner' => $posts['modal_propertys_hit'],
      'address' => $posts['modal_address_hit'],
    ];
    $this->db->insert('enrollments_reached_procedure', $data);
  }

  public function insert_confrontant_enrollments_procedure($posts, $id){
    foreach ($posts['number_confrontant'] as $key => $value) {
      $data = [
        'id_procedure' => $id,
        'number' => $value,
        'area' => $posts['area_confrontant'][$key],
        'property_registration' => $posts['property_registration_confrontant'][$key],
        'owner' => $posts['owner_confrontant'][$key],
        'address' => $posts['address_confrontant'][$key],
      ];
      $this->db->insert('confrontant_enrollments_procedure', $data);
    }
  }

  public function register_confrontant_enrollments_procedure($posts){
    $data = [
      'id_procedure' => $posts['id_procedure'],
      'number' => $posts['modal_number_confrontant'],
      'area' => $posts['modal_field_confrontant'],
      'property_registration' => $posts['modal_property_registration_confrontant'],
      'owner' => $posts['modal_propertys_confrontant'],
      'address' => $posts['modal_address_confrontant'],
    ];
    $this->db->insert('confrontant_enrollments_procedure', $data);
  }

  public function insert_squatters_procedure($posts, $id){
    foreach ($posts['name_squatters'] as $key => $value) {
      $data = [
        'id_procedure' => $id,
        'name' => $value,
        'address' => $posts['address_squatters'][$key],
      ];
      $this->db->insert('squatters_procedure', $data);
    }
  }

  public function register_squatters($posts){
    $data = [
      'id_procedure' => $posts['id_procedure'],
      'name' => $posts['modal_name_squatters'],
      'address' => $posts['modal_address_squatters'],
    ];
    $this->db->insert('squatters_procedure', $data);
  }

  public function insert_upload_initiating_decision($id_procedure, $file){
    $data = [
      'id_entity' => $_SESSION['user']['id_entity'],
      'id_procedure' => $id_procedure,
      'file' => $file,
    ];
    $this->db->insert('uploads_initiating_decision', $data);
  }

  public function insert_upload_crf($id_procedure, $file){
    $data = [
      'id_entity' => $_SESSION['user']['id_entity'],
      'id_procedure' => $id_procedure,
      'file' => $file,
    ];
    $this->db->insert('uploads_crf', $data);
  }

  public function insert_upload_notifications($posts, $file){
    $data = [
      'id_entity' => $_SESSION['user']['id_entity'],
      'id_procedure' => $posts['id_procedure'],
      'id_registration' => $posts['id_registration_upload'],
      'file' => $file,
      'type' => $posts['notification_type_upload'],
    ];
    $this->db->insert('uploads_notifications', $data);
  }

  public function insert_registrations($id_procedure, $posts){
    $insert = [];
    foreach ($posts['registration_number'] as $key => $value) {
      $data = [
        'id_entity' => $_SESSION['user']['id_entity'],
        'id_notarys_office' => $posts['real_estate_registry'][$key],
        'id_procedure' => $id_procedure,
        'number_registration' => $value,
        'owner' => $posts['owner_squatter'][$key],
        'document' => $posts['cpf_cnpj'][$key],
        'area' => $posts['registration_area'][$key],
        'property_type' => $posts['property_type'][$key],
        'property_situation' => $posts['property_situation'][$key],
        'notified_type' => $posts['notified_type'][$key],
        'procedure_type' => $posts['procedure_type'][$key],
        'name_notificaded' => $posts['name_notificaded'][$key],
        'cpf_notificaded' => $posts['cpf_notificaded'][$key],
        'occupation_notificaded' => $posts['occupation_notificaded'][$key],
      ];
      $this->db->insert('procedure_reurb_registration', $data);
      $insert[] = $this->db->insert_id();
    }
    return $insert;
  }

  public function insert_registration($posts){
    $data = [
      'id_entity' => $_SESSION['user']['id_entity'],
      'id_notarys_office' => $posts['real_estate_registry'],
      'id_procedure' => $posts['id_procedure'],
      'number_registration' => $posts['registration_number'],
      'owner' => $posts['owner_squatter'],
      'document' => $posts['cpf_cnpj'],
      'area' => $posts['registration_area'],
      'property_type' => $posts['property_type'],
      'property_situation' => $posts['property_situation'],
      'notified_type' => $posts['notified_type'],
      'procedure_type' => $posts['procedure_type'],
      'name_notificaded' => $posts['name_notificaded'],
      'cpf_notificaded' => $posts['cpf_notificaded'],
      'occupation_notificaded' => $posts['occupation_notificaded'],
    ];
    $this->db->insert('procedure_reurb_registration', $data);
    return $this->db->insert_id();
  }

  public function insert_registrations_properties_address($id_registration, $posts){
    foreach ($id_registration as $key => $value) {
      $data = [
        'id_registration' => $value,
        'public_place' => $posts['public_place'][$key],
        'number' => $posts['number'][$key],
        'neigborhood' => $posts['neigborhood'][$key],
        'cep' => $posts['cep'][$key],
        'country' => $posts['country'][$key],
        'notificaded_checking' => (isset($posts['notificaded_checking'][$key]))? $posts['notificaded_checking'][$key] : '0',
      ];
      $this->db->insert('registration_property_address', $data);
    }
  }

  public function insert_registration_property_address($id_registration, $posts){
    $data = [
      'id_registration' => $id_registration,
      'public_place' => $posts['public_place'],
      'number' => $posts['number'],
      'neigborhood' => $posts['neigborhood'],
      'cep' => $posts['cep'],
      'country' => $posts['country'],
      'notificaded_checking' => (isset($posts['notificaded_checking']))? '1' : '0',
    ];
    $this->db->insert('registration_property_address', $data);
  }

  public function insert_address_of_notifications($id_registration, $posts){
    foreach ($id_registration as $key => $value) {
      $data = [
        'id_registration' => $value,
        'public_place' => (isset($posts['public_place_notificaded'][$key]))? $posts['public_place_notificaded'][$key] : null,
        'number' => (isset($posts['number_notificaded'][$key]))? $posts['number_notificaded'][$key] : null,
        'neigborhood' => (isset($posts['neigborhood_notificaded'][$key]))? $posts['neigborhood_notificaded'][$key] : null,
        'cep' => (isset($posts['cep_notificaded'][$key]))? $posts['cep_notificaded'][$key] : null,
        'country' => (isset($posts['country_notificaded'][$key]))? $posts['country_notificaded'][$key] : null,
      ];
      $this->db->insert('registration_address_notificaded', $data);
    }
  }

  public function insert_registration_address_notificaded($id_registration, $posts){
    $data = [
      'id_registration' => $id_registration,
      'public_place' => (isset($posts['public_place_notificaded']))? $posts['public_place_notificaded'] : null,
      'number' => (isset($posts['number_notificaded']))? $posts['number_notificaded'] : null,
      'neigborhood' => (isset($posts['neigborhood_notificaded']))? $posts['neigborhood_notificaded'] : null,
      'cep' => (isset($posts['cep_notificaded']))? $posts['cep_notificaded'] : null,
      'country' => (isset($posts['country_notificaded']))? $posts['country_notificaded'] : null,
    ];
    $this->db->insert('registration_address_notificaded', $data);
  }

  public function update_registration_address_notificaded($posts){
    $data = [
      'public_place' => (isset($posts['edit_public_place_notificaded']))? $posts['edit_public_place_notificaded'] : null,
      'number' => (isset($posts['edit_number_notificaded']))? $posts['edit_number_notificaded'] : null,
      'neigborhood' => (isset($posts['edit_neigborhood_notificaded']))? $posts['edit_neigborhood_notificaded'] : null,
      'cep' => (isset($posts['edit_cep_notificaded']))? $posts['edit_cep_notificaded'] : null,
      'country' => (isset($posts['edit_country_notificaded']))? $posts['edit_country_notificaded'] : null,
    ];
    $this->db->where('id_registration', $posts['id_registration']);
    $this->db->update('registration_address_notificaded', $data);
  }

  public function update_registration($posts){
    $data = [
      'id_notarys_office' => $posts['edit_real_estate_registry'],
      'number_registration' => $posts['edit_registration_number'],
      'owner' => $posts['edit_owner_squatter'],
      'document' => $posts['edit_cpf_cnpj'],
      'area' => $posts['edit_registration_area'],
      'property_type' => $posts['edit_property_type'],
      'property_situation' => $posts['edit_property_situation'],
      'notified_type' => $posts['edit_notified_type'],
      'procedure_type' => $posts['edit_procedure_type'],
      'name_notificaded' => $posts['edit_name_notificaded'],
      'cpf_notificaded' => $posts['edit_cpf_notificaded'],
      'occupation_notificaded' => $posts['edit_occupation_notificaded'],
    ];
    if ($posts['receiving_date'] != 0000-00-00) {
      $data['receiving_date'] = $posts['receiving_date'];
    }
    if ($posts['deadline_manifestation'] != 0000-00-00) {
      $data['deadline_manifestation'] = $posts['deadline_manifestation'];
    }
    if (!empty($posts['type_manifestation'])) {
      $data['type_manifestation'] = $posts['type_manifestation'];
    }
    $this->db->where('id', $posts['id_registration']);
    $this->db->update('procedure_reurb_registration', $data);
  }

  public function update_registration_property_address($posts){
    $data = [
      'public_place' => $posts['edit_public_place'],
      'number' => $posts['edit_number'],
      'neigborhood' => $posts['edit_neigborhood'],
      'cep' => $posts['edit_cep'],
      'country' => $posts['edit_country'],
      'notificaded_checking' => (isset($posts['edit_notificaded_checking']))? '1' : '0',
    ];
    $this->db->where('id_registration', $posts['id_registration']);
    $this->db->update('registration_property_address', $data);
  }

  public function fetch_registration($id){
    $this->db->select('r.id as id_registration, r.id_notarys_office, r.number_registration, r.owner, r.document, r.area, r.property_type,
      r.property_situation, r.notified_type, r.procedure_type, r.name_notificaded, r.cpf_notificaded, r.occupation_notificaded, r.register,
      r.receiving_date, r.deadline_manifestation, r.type_manifestation,
      p.public_place, p.number, p.neigborhood, p.cep, p.country, p.notificaded_checking,
      n.public_place as public_place_notificaded, n.number as number_notificaded, n.neigborhood as neigborhood_notificaded,
      n.cep as cep_notificaded, n.country as country_notificaded
    ');
    $this->db->from('procedure_reurb_registration as r');
    $this->db->join('registration_property_address as p', 'p.id_registration = r.id', 'left');
    $this->db->join('registration_address_notificaded as n', 'n.id_registration = r.id', 'left');
    $this->db->where('r.id', $id);
    $this->db->where('r.id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_registrations($id_procedure){
    $this->db->select('r.id, r.id_notarys_office, r.number_registration, r.owner, r.document, r.area, r.property_type,
      r.property_situation, r.notified_type, r.procedure_type, r.name_notificaded, r.cpf_notificaded, r.occupation_notificaded, r.register,
      r.receiving_date, r.deadline_manifestation, r.type_manifestation,
      p.public_place, p.number, p.neigborhood, p.cep, p.country, p.notificaded_checking,
      n.public_place as public_place_notificaded, n.number as number_notificaded, n.neigborhood as neigborhood_notificaded,
      n.cep as cep_notificaded, n.country as country_notificaded,
      u.file, u.type,
    ');
    $this->db->from('procedure_reurb_registration as r');
    $this->db->join('registration_property_address as p', 'p.id_registration = r.id', 'left');
    $this->db->join('registration_address_notificaded as n', 'n.id_registration = r.id', 'left');
    $this->db->join('uploads_notifications as u', 'u.id_registration = r.id', 'left');
    $this->db->where('r.id_procedure', $id_procedure);
    $this->db->where('r.id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->result();
  }

  public function update_procedure($posts, $id){
    $this->db->set('process_number', $posts['process_number']);
    $this->db->set('requester', $posts['requester']);
    $this->db->set('total_regularized_area', $posts['total_regularized_area']);
    $this->db->set('date_requester', $posts['date_requester']);
    $this->db->set('core_name', $posts['core_name']);
    $this->db->set('irregular_parceler', $posts['irregular_parceler']);
    $this->db->set('modality', $posts['modality']);
    $this->db->set('rito', $posts['rito']);
    $this->db->set('decision', $posts['decision']);
    $this->db->set('decision_date', $posts['decision_date']);
    $this->db->set('end_date', $posts['end_date']);
    $this->db->set('publication_procedure', $posts['publication_procedure']);
    $this->db->set('issue_date', $posts['issue_date']);
    $this->db->set('original_registration', $posts['original_registration']);
    $this->db->set('type_property', $posts['type_property']);
    $this->db->set('stage', $posts['stage']);
    $this->db->set('id_notarys_office', $posts['cartorio']);
    $this->db->set('perimeter_description', $posts['description']);
    $this->db->set('update_for', $_SESSION['user']['id']);
    $this->db->where('id', $id);
    $this->db->update('procedure_reurb');
  }

  public function update_enrollments_reached($posts, $id){
    foreach ($posts['id_enrollments_reached'] as $key => $value) {
      $this->db->set('number', $posts['number_hit'][$key]);
      $this->db->set('area', $posts['area_hit'][$key]);
      $this->db->set('property_registration', $posts['property_registration_hit'][$key]);
      $this->db->set('owner', $posts['owner_hit'][$key]);
      $this->db->set('address', $posts['address_hit'][$key]);
      $this->db->where('id', $value);
      $this->db->update('enrollments_reached_procedure');
    }
  }

  public function update_confrontant_enrollments($posts, $id){
    foreach ($posts['id_confrontant_enrollments'] as $key => $value) {
      $this->db->set('number', $posts['number_confrontant'][$key]);
      $this->db->set('area', $posts['area_confrontant'][$key]);
      $this->db->set('property_registration', $posts['property_registration_confrontant'][$key]);
      $this->db->set('owner', $posts['owner_confrontant'][$key]);
      $this->db->set('address', $posts['address_confrontant'][$key]);
      $this->db->where('id', $value);
      $this->db->update('confrontant_enrollments_procedure');
    }
  }

  public function update_squatters_procedure($posts, $id){
    foreach ($posts['id_squatters'] as $key => $value) {
      $this->db->set('name', $posts['name_squatters'][$key]);
      $this->db->set('address', $posts['address_squatters'][$key]);
      $this->db->where('id', $value);
      $this->db->update('squatters_procedure');
    }
  }

  public function turn_off($posts){
    $status = ($posts['status'] == '1') ? '0' : '1';
    $this->db->set('status', $status);
    $this->db->where('id', $posts['id']);
    $this->db->update('procedure_reurb');
  }

  public function off_embarkation($posts){
    $data = [
      'status' => '0',
    ];
    $this->db->where('id', $posts['id_embarkation_history']);
    $this->db->update('embargo_history', $data);
  }

  public function update_embarkation_file($posts, $file){
    $data = [
      'file' => $file,
    ];
    $this->db->where('id', $posts['id_embarkation']);
    $this->db->update('embargo_history', $data);
  }

  public function update_files_analysis($posts, $file){
    $data = [
      'file_analysis' => $file,
    ];
    $this->db->where('id', $posts['id_embarkation_protocol']);
    $this->db->update('embargo_history', $data);
  }

  public function update_embarkation($posts, $file){
    $data = [
      'status' => $posts['status_embarkation'],
      'legal_decision_analysis' => $posts['legal_decision_analysis'],
    ];
    if (!empty($file)) {
      $data['file_analysis'] = $file;
    }
    $this->db->where('id', $posts['id_embarkation_history']);
    $this->db->update('embargo_history', $data);
  }

  public function update_upload_initiating_decision($id_upload, $file){
    $data = [
      'file' => $file,
    ];
    $this->db->where('id', $id_upload);
    $this->db->update('uploads_initiating_decision', $data);
  }

  public function update_upload_notifications($id_upload, $file, $posts){
    $data = [
      'file' => $file,
      'type' => $posts['notification_type_upload'],
    ];
    $this->db->where('id', $id_upload);
    $this->db->update('uploads_notifications', $data);
  }

  public function fetch_upload_initiating_decision($id_procedure){
    $this->db->select('id, id_procedure, file');
    $this->db->from('uploads_initiating_decision');
    $this->db->where('id_procedure', $id_procedure);
    $this->db->where('id_entity' , $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_upload_completion_decision($id_procedure){
    $this->db->select('id, id_procedure, file');
    $this->db->from('uploads_completion_decision');
    $this->db->where('id_procedure', $id_procedure);
    $this->db->where('id_entity' , $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_upload_crf($id_procedure){
    $this->db->select('id, id_procedure, file');
    $this->db->from('uploads_crf');
    $this->db->where('id_procedure', $id_procedure);
    $this->db->where('id_entity' , $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_upload_notifications($id_procedure, $id_registration){
    $this->db->select('id, id_procedure, id_registration, file, type');
    $this->db->from('uploads_notifications');
    $this->db->where('id_registration', $id_registration);
    $this->db->where('id_procedure', $id_procedure);
    $this->db->where('id_entity' , $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_process_numbers(){
    $this->db->select('id, process_number, requester, date_requester, status,
    core_name, irregular_parceler, modality, rito, decision, decision_date, stage, update_for');
    $this->db->from('procedure_reurb');
    $this->db->where('id_entity' , $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_process_number($id){
    $this->db->select('p.id, p.id_entity, p.id_notarys_office,  p.process_number, p.requester, p.date_requester, p.end_date, p.publication_procedure,
      p.issue_date, p.original_registration, p.type_property, p.total_regularized_area, p.perimeter_description,
      p.core_name, p.irregular_parceler, p.modality, p.rito, p.decision, p.decision_date, p.stage, p.id_entity, p.status, p.update_for,
      u.name as user_name,
      r.classification_reurb,
      pd.id_requester, pd.type_street as street_property, pd.public_place as place_property, pd.number as number_property, pd.complement as complement_property, pd.neighborhood as neighborhood_property,
      pd.city as city_property, pd.cep as cep_property, pd.uf as uf_property, pd.country as country_property, pd.inauguration_date, pd.required_land_area,
      pd.required_building_area, pd.construction_features, pd.confrontants, pd.furniture_registration, pd.basic_infrastructure, pd.potable_water, pd.energy, pd.sewage, pd.type_sewer,
      pd.paved_street, pd.paving_type, pd.internet_access, pd.date_register, pd.venal, pd.spouse_co_owner,
      pd.slab_right, pd.possession_time, pd.sector,  pd.city_block,  pd.allotment,  pd.sub_lot, pd.georeferenced_property_area, pd.property_registration_number,
      rq.id as id_requester, rq.type_requester,
      l.name as legal_name, l.cpf, l.rg, l.consignor_organ, l.profession, l.monthly_income, l.birth_date, l.gender, l.nationality, l.scholarity, l.mother_name, l.father_name, l.email as legal_email, l.phone as legal_phone, l.civil_status, l.marriage_regime, l.wedding_date,
      s.name as name_spouse, s.nationality as nationality_spouse, s.profession as profession_spouse, s.mother_name as mother_name_spouse, s.father_name as father_name_spouse,
      s.cpf as cpf_spouse, s.rg as rg_spouse, s.name as name_spouse,
      s.monthly_income as monthly_income_spouse, s.property_owner, s.consignor_organ as consignor_organ_spouse,
      j.company_name, j.cnpj, j.activity_branch, j.type_street as type_street_juridical, j.public_place as public_place_juridical, j.number as number_juridical, j.complement as complement_juridical, j.neighborhood as neighborhood_juridical, j.city as city_juridical, j.cep as cep_juridical, j.uf as uf_juridical, j.country, j.monthly_invoicing,
      pr.name as name_procurator, pr.cpf as cpf_procurator, pr.rg as rg_procurator, pr.consignor_organ as consignor_organ_procurator, pr.profission as profission_procurator, pr.birth_date as birth_date_procurator, pr.gender as gender_procurator, pr.country as country_procurator, pr.email as email_procurator, pr.phone as phone_procurator,
      h.type_street as type_street_home, h.public_place as public_place_home, h.number as number_home, h.complement as complement_home, h.neighborhood as neighborhood_home, h.city as city_home, h.cep as cep_home, h.country as country_home, h.uf as uf_home,
    ');
    $this->db->from('procedure_reurb as p');
    $this->db->join('users as u', 'p.update_for = u.id', 'left');
    $this->db->join('requirements as r', 'r.id_procedure = p.id', 'left');
    $this->db->join('property_details as pd', 'r.id_property = pd.id', 'left');
    $this->db->join('requesters as rq', 'pd.id_requester = rq.id', 'left');
    $this->db->join('legal_person as l', 'l.id_requester = pd.id_requester', 'left');
    $this->db->join('spouse as s', 's.id_requester = rq.id', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = pd.id_requester', 'left');
    $this->db->join('procurator as pr', 'pr.id_requester = pd.id_requester', 'left');
    $this->db->join('home_address as h', 'h.id_requester = rq.id', 'left');
    $this->db->where('p.id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_process_number_legitimation_title($id){
    $this->db->select('p.id, p.id_entity, p.process_number, p.requester, p.date_requester, p.end_date, p.publication_procedure, r.id as id_requirement,
      p.issue_date, p.original_registration, p.type_property,
      p.core_name, p.irregular_parceler, p.modality, p.rito, p.decision, p.decision_date, p.stage, p.id_entity, p.status,
      r.classification_reurb,
      pd.id_requester, pd.type_street as street_property, pd.public_place as place_property, pd.number as number_property, pd.complement as complement_property, pd.neighborhood as neighborhood_property,
      pd.city as city_property, pd.cep as cep_property, pd.uf as uf_property, pd.country as country_property, pd.inauguration_date, pd.required_land_area,
      pd.required_building_area, pd.construction_features, pd.confrontants, pd.furniture_registration, pd.basic_infrastructure, pd.potable_water, pd.energy, pd.sewage, pd.type_sewer,
      pd.paved_street, pd.paving_type, pd.internet_access, pd.date_register, pd.venal, pd.spouse_co_owner,
      pd.slab_right, pd.possession_time, pd.sector,  pd.city_block,  pd.allotment,  pd.sub_lot, pd.georeferenced_property_area, pd.property_registration_number,
      rq.id as id_requester, rq.type_requester,
      l.name as legal_name, l.cpf, l.rg, l.consignor_organ, l.profession, l.monthly_income, l.birth_date, l.gender, l.nationality, l.scholarity, l.mother_name, l.father_name, l.email as legal_email, l.phone as legal_phone, l.civil_status, l.marriage_regime, l.wedding_date,
      s.name as name_spouse, s.nationality as nationality_spouse, s.profession as profession_spouse, s.mother_name as mother_name_spouse, s.father_name as father_name_spouse,
      s.cpf as cpf_spouse, s.rg as rg_spouse, s.name as name_spouse,
      s.monthly_income as monthly_income_spouse, s.property_owner, s.consignor_organ as consignor_organ_spouse,
      j.company_name, j.cnpj, j.activity_branch, j.type_street as type_street_juridical, j.public_place as public_place_juridical, j.number as number_juridical, j.complement as complement_juridical, j.neighborhood as neighborhood_juridical, j.city as city_juridical, j.cep as cep_juridical, j.uf as uf_juridical, j.country, j.monthly_invoicing,
      pr.name as name_procurator, pr.cpf as cpf_procurator, pr.rg as rg_procurator, pr.consignor_organ as consignor_organ_procurator, pr.profission as profission_procurator, pr.birth_date as birth_date_procurator, pr.gender as gender_procurator, pr.country as country_procurator, pr.email as email_procurator, pr.phone as phone_procurator,
      h.type_street as type_street_home, h.public_place as public_place_home, h.number as number_home, h.complement as complement_home, h.neighborhood as neighborhood_home, h.city as city_home, h.cep as cep_home, h.country as country_home, h.uf as uf_home,
    ');
    $this->db->from('procedure_reurb as p');
    $this->db->join('requirements as r', 'r.id_procedure = p.id', 'left');
    $this->db->join('property_details as pd', 'r.id_property = pd.id', 'left');
    $this->db->join('requesters as rq', 'pd.id_requester = rq.id', 'left');
    $this->db->join('legal_person as l', 'l.id_requester = pd.id_requester', 'left');
    $this->db->join('spouse as s', 's.id_requester = rq.id', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = pd.id_requester', 'left');
    $this->db->join('procurator as pr', 'pr.id_requester = pd.id_requester', 'left');
    $this->db->join('home_address as h', 'h.id_requester = rq.id', 'left');
    $this->db->where('r.id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_enrollments_reached_procedure($id){
    $this->db->select('id, number, area,
      property_registration, owner, address,
    ');
    $this->db->from('enrollments_reached_procedure');
    $this->db->where('id_procedure', $id);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_confrontant_enrollments_procedure($id){
    $this->db->select('id, number, area,
      property_registration, owner, address,
    ');
    $this->db->from('confrontant_enrollments_procedure');
    $this->db->where('id_procedure', $id);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_squatters_procedure($id){
    $this->db->select('id, name, address,');
    $this->db->from('squatters_procedure');
    $this->db->where('id_procedure', $id);
    $query = $this->db->get();
    return $query->result();
  }

  public function isset_process_number($posts){
    $this->db->select('id, process_number, requester, date_requester, core_name, stage, irregular_parceler, modality, rito, decision, decision_date, status');
    $this->db->from('procedure_reurb');
    $this->db->where('process_number', $posts['process_number']);
    $this->db->where('id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->result();
  }

  public function isset_stage($posts){
    $this->db->select('id, process_number, requester, date_requester, core_name, stage, irregular_parceler, modality, rito, decision, decision_date, status');
    $this->db->from('procedure_reurb');
    $this->db->where('stage', $posts['stage']);
    $this->db->where('process_number', $posts['process_number']);
    $this->db->where('id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_stages_process($posts){
    $this->db->select('id, id_entity, process_number, requester, date_requester, core_name, stage, irregular_parceler, modality, rito, decision, decision_date');
    $this->db->from('procedure_reurb');
    $this->db->where('process_number', $posts['process_number']);
    $this->db->where('id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_city_hall($id){
    $this->db->select('e.id, e.cnpj, e.country, e.public_place, e.address, e.number, e.complement, e.neighborhood, e.uf, e.city, e.cep, e.destrict, e.nation, e.img, e.administration_logo,
      e.processing_office,
      c.civil_status, e.name as name_entity, e.phone as phone_entity, e.email as email_entity, e.site as site_entity,
      c.id as id_mayor, c.cpf, c.name, c.rg, c.dispatcher, c.profission, c.birth_date, c.gender, c.nacionality, c.phone, c.email,
      c.type_street as type_street_mayor, c.street as street_mayor, c.number as number_mayor, c.complement as complement_mayor, c.neighborhood as neighborhood_mayor,
      c.city as city_mayor, c.cep as cep_mayor, c.uf as uf_mayor, c.country as country_mayor,
      p.id as id_president, p.cpf as cpf_president, p.name as name_president, p.rg as rg_president, p.dispatcher as dispatcher_president, p.profission as profission_president, p.birth_date as birth_date_president, p.gender as gender_president, p.nationality as nationality_president, p.phone as phone_president, p.email as email_president,
    ');
    $this->db->from('entity as e');
    $this->db->join('city_mayor as c', 'c.id_entity = e.id', 'left');
    $this->db->join('president_commission as p', 'p.id_entity = e.id', 'left');
    $this->db->where('e.id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_checklist_protocol_entity(){
    $this->db->select('id, description, status');
    $this->db->from('checklist_protocol_entity');
    $this->db->where('id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_files_checklist($id){
    $this->db->select('f.id, f.file, f.register, c.description');
    $this->db->from('checklist_protocol_files as f');
    $this->db->join('checklist_protocol_entity as c', 'f.id_document = c.id');
    $this->db->where('f.id_protocol', $id);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_front_photo($id){
    $this->db->select('f.id, f.file, f.register, c.description');
    $this->db->from('checklist_protocol_files as f');
    $this->db->join('checklist_protocol_entity as c', 'f.id_document = c.id');
    $this->db->where('c.description', 'Foto Frontal');
    $this->db->where('f.id_protocol', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_type_arquivo($posts){
    $this->db->select('c.id, c.description');
    $this->db->from('checklist_protocol_entity as c');
    $this->db->where('c.id', $posts['type_arquivo']);
    $this->db->where('c.id_entity', $_SESSION["user"]["id_entity"]);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_checklist_not_send($id){
    $query = $this->db->query('
      select description from checklist_protocol_entity c
      left join (select * from checklist_protocol_files where id_protocol = '.$id.') as sub
      on c.id = sub.id_document
      where sub.id_document is null
      and c.id_entity = '.$_SESSION["user"]["id_entity"].'
    ');
    return $query->result();
  }

  public function count_checklist_required(){
    $this->db->select('count(id) as count');
    $this->db->from('checklist_protocol_entity');
    $this->db->where('id_entity', $_SESSION['user']['id_entity']);
    $this->db->where('status', 1);
    $query = $this->db->get();
    return $query->row();
  }

  public function count_checklist_send($id){
    $this->db->select('count(id) as count');
    $this->db->from('checklist_protocol_files');
    $this->db->where('id_protocol', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_embargo_history($id){
    $this->db->select('e.id, e.id_procedure, e.id_responsible, e.reason, e.file, e.status, e.register, e.legal_decision_analysis, e.file_analysis,
      s.description,
      l.name as legal_name, l.email as legal_email, l.phone as legal_phone,
      j.company_name,
      p.email as procurator_email, p.phone as phone_procurator,
    ');
    $this->db->from('embargo_history as e');
    $this->db->join('status_embargo as s', 'e.status = s.id');
    $this->db->join('requesters as rq', 'e.id_responsible = rq.id', 'left');
    $this->db->join('legal_person as l', 'l.id_requester = rq.id', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = rq.id', 'left');
    $this->db->join('procurator as p', 'p.id_requester = rq.id', 'left');
    $this->db->order_by('e.id', 'ASC');
    $this->db->where('e.id_procedure', $id);
    $this->db->where('e.id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_status_embargo(){
    $this->db->select('id, description');
    $this->db->from('status_embargo');
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_embargo_under_analysis($id){
    $this->db->select('id, id_procedure, id_responsible, reason, file, status, register, legal_decision_analysis, file_analysis');
    $this->db->from('embargo_history');
    $this->db->order_by('id', 'DESC');
    $this->db->where('id_procedure', $id);
    $this->db->where('status !=', 3);
    $this->db->where('status !=', 4);
    $this->db->where('id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_specific_legislations(){
    $this->db->select('id, name, link');
    $this->db->from('specific_legislation');
    $query = $this->db->get();
    return $query->result();
  }


  // Setor, Quadra, Lote, Área, Endereço, Inscrição imobiliária                        
  // matrícula aberta para o lote no procedimento de REURB e Valor
  // Venal do imóvel
  public function fetch_conclusion_protocol($id)
  {
    $this->db->select('
      pd.sector, pd.city_block, pd.allotment, pd.type_street as street_property, pd.public_place as place_property, pd.number as number_property, pd.neighborhood as neighborhood_property,
      pd.city as city_property, pd.cep as cep_property, pd.uf as uf_property, pd.country as country_property, pd.georeferenced_property_area,
      pd.property_registration_number, pd.venal, pd.furniture_registration
    ');
    $this->db->from('procedure_reurb as p');
    $this->db->join('requirements as r', 'r.id_procedure = p.id', 'left');
    $this->db->join('property_details as pd', 'r.id_property = pd.id', 'left');
    $this->db->join('requesters as rq', 'pd.id_requester = rq.id', 'left');
    $this->db->join('legal_person as l', 'l.id_requester = pd.id_requester', 'left');
    $this->db->join('spouse as s', 's.id_requester = rq.id', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = pd.id_requester', 'left');
    $this->db->join('procurator as pr', 'pr.id_requester = pd.id_requester', 'left');
    $this->db->join('home_address as h', 'h.id_requester = rq.id', 'left');

    $this->db->where('pd.sector !=', '');
    $this->db->where('pd.city_block !=', '');
    $this->db->where('pd.allotment !=', '');
    $this->db->where('pd.type_street !=', '');
    $this->db->where('pd.public_place !=', '');
    $this->db->where('pd.number !=', '');
    $this->db->where('pd.neighborhood !=', '');
    $this->db->where('pd.city !=', '');
    $this->db->where('pd.uf !=', '');
    $this->db->where('pd.country !=', '');
    $this->db->where('pd.georeferenced_property_area !=', '');
    $this->db->where('pd.venal !=', '');
    $this->db->where('pd.furniture_registration !=', '');
    $this->db->where('r.id', $id);
    $query = $this->db->get();
    return $query->row();
  }

}
