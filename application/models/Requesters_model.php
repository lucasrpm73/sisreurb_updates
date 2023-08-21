<?php
class Requesters_model extends CI_Model {

  public $table = 'requesters';

  public function __construct(){
      parent::__construct();
  }

  public function insert($posts){
    $data = array(
      'id_entity' => $_SESSION['user']['id_entity'],
      'type_requester' => $posts['people_type'],
      'status' => '1'
    );

    $this->db->insert('requesters', $data);
    return $this->db->insert_id();
  }

  public function insert_legal_request($posts, $id_requester){
    $data = array(
      'id_requester' => $id_requester,
      'name' => $posts['name_personal'],
      'cpf' => $posts['cpf_personal'],
      'rg' => $posts['rg_personal'],
      'consignor_organ' => $posts['orgao_expedidor_personal'],
      'profession' => $posts['profession_personal'],
      'monthly_income' => $posts['monthly_income_personal'],
      'birth_date' => $posts['date_of_birth_personal'],
      'gender' => $posts['gender_personal'],
      'nationality' => $posts['nationality_personal'],
      'scholarity' => $posts['schooling_personal'],
      'mother_name' => $posts['mother_name_personal'],
      'father_name' => $posts['father_name_personal'],
      'email' => $posts['email_personal'],
      'phone' => $posts['tel_personal'],
      'civil_status' => $posts['marital_status_personal'],
      'marriage_regime' => $posts['marriage_regime_personal'],
      'wedding_date' => $posts['date_marriage_personal'],
      'nis' => $posts['nis_personal'],
      'property_owner' => (isset($posts['property_owner_legal_person']))?$posts['property_owner_legal_person']:null,
      'cash_transfer_program' => (isset($posts['cash_transfer_program']))?$posts['cash_transfer_program']:null,
      'federal_government_income' => (isset($posts['federal_government_income']))?$posts['federal_government_income']:null,
    );

    $this->db->insert('legal_person', $data);
    return $this->db->insert_id();
  }

  public function insert_images($images, $id_requester){
    $data = [
      'id_requester' => $id_requester,
      'img_cpf' => $images['cpf'],
      'img_rg' => $images['rg'],
      'img_nascimento' => $images['nascimento'],
      'img_residencia' => $images['residencia'],
      'img_renda' => $images['renda'],
    ];
    $this->db->insert('checklist_requester', $data);
    return $this->db->insert_id();
  }

  public function insert_files_requester($posts, $file){
    $data = [
      'id_requester' => $posts['id_requester'],
      'id_documents' => $posts['type_arquivo'],
      'property_document' => $posts['property_document'],
      'file' => $file,
    ];
    $this->db->insert('files_requester', $data);
    return $this->db->insert_id();
  }


  public function insert_topographic_survey($id_requester, $topographic_survey){
    foreach ($topographic_survey as $value) {
      $data = [
        'id_requester' => $id_requester,
        'id_topographic_survey' => $value->id,
        // 'date' => date('Y-m-d H:i:s'),
        'status' => '0',
      ];
      $this->db->insert('topographic_survey', $data);
    }
    return $this->db->insert_id();
  }

  public function insert_spouse($posts, $id_requester){
    $data = array(
      'id_requester' => $id_requester,
      'name' => $posts['name_spouse'],
      'cpf' => $posts['cpf_spouse'],
      'rg' => $posts['rg_spouse'],
      'consignor_organ' => $posts['orgao_expedidor_spouse'],
      'profession' => $posts['profession_spouse'],
      'birth_date' => $posts['date_of_birth_spouse'],
      'gender' => $posts['gender_spouse'],
      'nationality' => $posts['nationality_spouse'],
      'scholarity' => $posts['schooling_spouse'],
      'mother_name' => $posts['mother_name_spouse'],
      'father_name' => $posts['father_name_spouse'],
      'email' => $posts['email_spouse'],
      'phone' => $posts['tel_spouse'],
      'civil_status' => $posts['marital_status_spouse'],
      'marriage_regime' => $posts['marriage_regime_spouse'],
      'monthly_income' => $posts['monthly_income_spouse'],
      'nis' => $posts['nis_spouse'],
      'property_owner' => (isset($posts['property_owner']))?$posts['property_owner']:null,
      'cash_transfer_program' => (isset($posts['cash_transfer_program_spouse']))?$posts['cash_transfer_program_spouse']:null,
      'federal_government_income' => (isset($posts['federal_government_income_spouse']))?$posts['federal_government_income_spouse']:null,
    );
    $this->db->insert('spouse', $data);
    return $this->db->insert_id();
  }

  public function insert_family_members($posts, $id_requester){
    $nome = $posts['name_members_family'];
    $cpf = $posts['cpf_members_family'];
    $birth_date = $posts['date_birth_family'];

    $monthly_income = $posts['monthly_income_members_family'];
    foreach ($nome as $key => $value) {
      $monthly_income_members_family = str_replace(".", "", $monthly_income[$key]);
      $monthly_income_format = str_replace(",", ".", $monthly_income_members_family);
      if ($value == "") {
        continue;
      }
      $data = array(
        'id_requester' => $id_requester,
        'name' => $value,
        'rg' => $posts['rg_members_family'][$key],
        'cpf' => $cpf[$key],
        'type' => $posts['type_members_family'][$key],
        'birth_date' => $birth_date[$key],
        'monthly_income' => $monthly_income_format,
      );
      $this->db->insert('family_members', $data);
    }
    return $this->db->insert_id();
  }

  public function insert_home_address($posts, $id_requester){
    $data = array(
      'id_requester' => $id_requester,
      'type_street' => $posts['home_type_home'],
      'public_place' => $posts['home_public_place'],
      'number' => $posts['home_number_home'],
      'complement' => $posts['home_complement_home'],
      'neighborhood' => $posts['home_neighborhood_home'],
      'city' => $posts['home_city_home'],
      'cep' => $posts['home_cep_home'],
      'uf' => $posts['home_uf_home'],
      'country' => $posts['home_country_home'],
    );

    $this->db->insert('home_address', $data);
    return $this->db->insert_id();
  }

  public function insert_property_details($posts, $id_requester){
    $data = array(
      'id_requester' => $id_requester,
      // 'people_type' => $posts['people_type'],
      'spouse_co_owner' => (isset($posts['spouse_co_owner'])) ? '0': '1',
      'type_street' => $posts['realty_type_home'],
      'public_place' => $posts['realty_address_home'],
      'number' => $posts['realty_number_home'],
      'complement' => $posts['realty_complement_home'],
      'neighborhood' => $posts['realty_neighborhood_home'],
      'city' => $posts['realty_city_home'],
      'cep' => $posts['realty_cep_home'],
      'uf' => $posts['realty_uf_home'],
      'country' => $posts['realty_country_home'],
      'Inauguration_date' => $posts['realty_address_posses_home'],
      'required_land_area' => $posts['required_terrain_area_home'],
      'georeferenced_property_area' => $posts['georeferenced_property_area'],
      'required_building_area' => $posts['required_edificated_area_home'],
      'sector' => $posts['sector'],
      'city_block' => $posts['city_block'],
      'allotment' => $posts['allotment'],
      'sub_lot' => $posts['sub_lot'],
      'property_registration_number' => $posts['property_registration_number'],
      'construction_features' => $posts['construction_features_home'],
      'venal' => $posts['venal'],
      'possession_origin' => $posts['possession_origin'],
      // 'possession_time' => $posts['possession_time'],
      'slab_right' => $posts['slab_right'],
      // 'confrontants' => $posts['confrontants'],
      'furniture_registration' => $posts['real_state_home'],
      'basic_infrastructure' => $posts['infrastructure_select_home'],
      'potable_water' => $posts['potable_water_select_home'],
      'energy' => $posts['infrastructure_select_home'],
      'sewage' => $posts['sewage_select_home'],
      'type_sewer' => $posts['type_sewer'],
      'paved_street' => $posts['paviment_select_home'],
      'type_property' => $posts['type_property'],
      'unit_situation' => $posts['unit_situation'],
      'paving_type' => $posts['paviment_type_select_home'],
      'internet_access' => $posts['internet_access_select_home'],
      'date_register' => $posts['register_date_home'],
    );
    $this->db->insert('property_details', $data);
    return $this->db->insert_id();
  }

  public function insert_property_images($images, $id_property){
    $data = [
      'id_property' => $id_property,
      'acquisition' => $images['aquisicao'],
      'iptu' => $images['iptu'],
      'confronting' => $images['confrotante'],
      'topographic' => $images['topografica'],
      'memorial' => $images['memorial'],
      'front' => $images['frontal'],
    ];
    $this->db->insert('property_images', $data);
    return $this->db->insert_id();
  }

  public function insert_property_images_juridical($images, $id_property){
    $data = [
      'id_property' => $id_property,
      'acquisition' => $images['aquisicao'],
      'iptu' => $images['iptu'],
      'confronting' => $images['confrotante'],
      'topographic' => $images['topografica'],
      'memorial' => $images['memorial'],
      'front' => $images['frontal'],
    ];
    $this->db->insert('property_images', $data);
    return $this->db->insert_id();
  }

  public function insert_juridical_requester($posts, $id_requester){
    $data = [
      'id_requester' => $id_requester,
      'cnpj' => $posts['cnpj_juridical'],
      'company_name' => $posts['corporate_name_juridical'],
      'activity_branch' => $posts['activity_branch_juridical'],
      'type_street' => $posts['type_street_juridical'],
      'public_place' => $posts['street_juridical'],
      'number' => $posts['number_name_juridical'],
      'complement' => $posts['complement_juridical'],
      'neighborhood' => $posts['neighborhood_juridical'],
      'city' => $posts['city_juridical'],
      'cep' => $posts['cep_juridical'],
      'uf' => $posts['uf_juridical'],
      'country' => $posts['country_juridical'],
      'monthly_invoicing' => $posts['monthly_invoicing_juridical'],
      'property_owner' => (isset($posts['property_owner_juridical']))?$posts['property_owner_juridical']:null,
    ];

    $this->db->insert('juridical_person', $data);
    return $this->db->insert_id();
  }

  public function insert_procurator($posts, $id_requester){
    $data = [
      'id_requester' => $id_requester,
      'name' => $posts['name_juridical_procurator'],
      'cpf' => $posts['cpf_juridical_procurator'],
      'rg' => $posts['rg_juridical_procurator'],
      'consignor_organ' => $posts['orgao_expedidor_juridical_procurator'],
      'profission' => $posts['profession_juridical_procurator'],
      'birth_date' => $posts['date_of_birth_juridical_procurator'],
      'gender' => $posts['gender_juridical_procurator'],
      'country' => $posts['nationality_juridical_procurator'],
      'email' => $posts['email_juridical_procurator'],
      'phone' => $posts['tel_juridical_procurator'],
    ];

    $this->db->insert('procurator', $data);
    return $this->db->insert_id();
  }

  public function insert_home_address_juridical($posts, $id_requester){
    $data = [
      'id_requester' => $id_requester,
      'type_street' => $posts['home_type_juridical'],
      'public_place' => $posts['home_address_juridical'],
      'number' => $posts['home_number_juridical'],
      'complement' => $posts['home_complement_juridical'],
      'neighborhood' => $posts['home_neighborhood_juridical'],
      'city' => $posts['home_city_juridical'],
      'cep' => $posts['home_cep_juridical'],
      'uf' => $posts['home_uf_juridical'],
      'country' => $posts['home_country_juridical'],
    ];

    $this->db->insert('home_address', $data);
    return $this->db->insert_id();
  }

  public function insert_property_details_juridical($posts, $id_requester){
    $data = array(
      'id_requester' => $id_requester,
      // 'people_type' => $posts['people_type'],
      'type_street' => $posts['residential_property_juridical'],
      'public_place' => $posts['realty_address_juridical'],
      'number' => $posts['realty_number_juridical'],
      'complement' => $posts['realty_complement_juridical'],
      'neighborhood' => $posts['realty_neighborhood_juridical'],
      'city' => $posts['realty_city_juridical'],
      'cep' => $posts['realty_cep_juridical'],
      'uf' => $posts['realty_uf_juridical'],
      'country' => $posts['realty_country_juridical'],
      'Inauguration_date' => $posts['realty_address_posses_juridical'],
      'required_land_area' => $posts['required_terrain_area_juridical'],
      'georeferenced_property_area' => $posts['georeferenced_property_area_juridical'],
      'required_building_area' => $posts['required_edificated_area_juridical'],
      'property_registration_number' => $posts['property_registration_number_juridical'],
      'construction_features' => $posts['construction_features_home_juridical'],

      'sector' => $posts['sector_juridical'],
      'city_block' => $posts['city_block_juridical'],
      'allotment' => $posts['allotment_juridical'],
      'sub_lot' => $posts['sub_lot_juridical'],

      'venal' => $posts['venal_juridical'],
      // 'possession_time' => $posts['possession_time_juridical'],
      'possession_origin' => $posts['possession_origin_juridical'],
      'slab_right' => $posts['slab_right_juridical'],
      // 'confrontants' => $posts['confrontants_juridical'],
      'furniture_registration' => $posts['real_state_juridical'],
      'basic_infrastructure' => $posts['infrastructure_select_juridical'],
      'potable_water' => $posts['potable_water_select_juridical'],
      'energy' => $posts['infrastructure_select_juridical'],
      'sewage' => $posts['sewage'],
      'type_sewer' => $posts['sewage_select_juridical'],
      'type_property' => $posts['type_property_juridical'],
      'unit_situation' => $posts['unit_situation_juridical'],
      'paved_street' => $posts['paviment_select_juridical'],
      'paving_type' => $posts['paviment_type_select_juridical'],
      'internet_access' => $posts['internet_access_select_juridical'],
      'date_register' => $posts['register_date_juridical'],
    );
    $this->db->insert('property_details', $data);
    return $this->db->insert_id();
  }

  public function insert_requirement($id_property, $posts){
    $data = [
      'id_entity' => $_SESSION['user']['id_entity'],
      'id_property' => $id_property,
      'id_procedure' => $posts['protocol_procedure'],
      'people_type' => $posts['people_type'],
      'classification_reurb' => ($posts['people_type'] == 1)? $posts['reurb'] : $posts['reurb_juridical'],
    ];
    $this->db->insert('requirements', $data);
    return $this->db->insert_id();
  }

  public function update_reurb_type($reurb_type, $id){
    $data = [
      'classification_reurb' => $reurb_type,
    ];
    $this->db->where('id', $id);
    $this->db->update('requirements', $data);
  }

  public function insert_requirement_juridical($id_property, $posts){
    $data = [
      'id_entity' => $_SESSION['user']['id_entity'],
      'id_property' => $id_property,
      'id_procedure' => $posts['protocol_procedure_juridical'],
      'people_type' => $posts['people_type'],
      // 'criteria_established_law' => $posts['reurb_juridical'],
    ];
    $this->db->insert('requirements', $data);
    return $this->db->insert_id();
  }

  public function insert_tenants($id, $posts){
    foreach ($posts['id_requester_condomino'] as $key => $value) {
      $data = [
        'id_requirement' => $id,
        'id_requester' => $value,
      ];
      $this->db->insert('tenants', $data);
    }
    return $this->db->insert_id();
  }

  public function insert_tenant($posts){
    $data = [
      'id_requirement' => $posts['id_requirement'],
      'id_requester' => $posts['id_requester'],
    ];
    $this->db->insert('tenants', $data);
    return $this->db->insert_id();
  }

  public function insert_confrotants_property($id_property, $posts){
    foreach ($posts['cpf_confrontants'] as $key => $value) {
      $data = [
        'id_property' => $id_property,
        'name' => $posts['name_confrontants'][$key],
        'cpf' => $value,
        'birth_date' => $posts['birth_date_confrontants'][$key],
        'confrontation_direction' => $posts['confrontation_direction'][$key],
      ];
      $this->db->insert('confrotants_property', $data);
    }
    return $this->db->insert_id();
  }

  public function insert_confrotants_property_juridical($id_property, $posts){
    foreach ($posts['cpf_confrontants_juridical'] as $key => $value) {
      $data = [
        'id_property' => $id_property,
        'name' => $posts['name_confrontants_juridical'][$key],
        'cpf' => $value,
        'birth_date' => $posts['birth_date_confrontants_juridical'][$key],
        'confrontation_direction' => $posts['confrontation_direction_juridical'][$key],
      ];
      $this->db->insert('confrotants_property', $data);
    }
    return $this->db->insert_id();
  }

  public function insert_new_confrotant_property($posts){
    $data = [
      'id_property' => $posts['id_property_confrotants'],
      'name' => $posts['add_name_confrontants'],
      'cpf' => $posts['add_cpf_confrontants'],
      'birth_date' => $posts['add_birth_date_confrontants'],
      'confrontation_direction' => $posts['confrontation_direction'],
    ];
    $this->db->insert('confrotants_property', $data);
    return $this->db->insert_id();
  }

  public function insert_checklist_requester($id){
    $data = [
      'id_requester' => $id,
      'img_cpf' => '',
      'img_rg' => '',
      'img_nascimento' => '',
      'img_residencia' => '',
      'img_renda' => '',
    ];
    $this->db->insert('checklist_requester', $data);
    return $this->db->insert_id();
  }

  public function register_protocol_history($posts, $status){
    $data = [
      'id_entity' => $_SESSION['user']['id_entity'],
    	'responsible' => $_SESSION['user']['id'],
    	'id_protocol' => $posts['id_protocol'],
      'status' => $status,
    ];
    if ($status == '0') {
      $data['reason'] = $posts['reason_cancel'];
    }
    $this->db->insert('protocol_history', $data);
    return $this->db->insert_id();
  }

  public function register_requester_history($posts, $status){
    $data = [
      'id_entity' => $_SESSION['user']['id_entity'],
      'responsible' => $_SESSION['user']['id'],
    	// 'responsible' => ($status == '1')? $posts['responsible_completion'] : $posts['responsible_cancel'],
    	'id_requester' => $posts['id_requester'],
      'status' => $status,
    ];
    if ($status == '0') {
      $data['reason'] = $posts['reason_cancel'];
    }
    $this->db->insert('requester_history', $data);
    return $this->db->insert_id();
  }

  public function update_protocol_history_data($posts){
    $data = [
    	'reason' => $posts['edit_reason'],
    ];
    $this->db->where('id', $posts['id_protocol_history']);
    $this->db->update('protocol_history', $data);
  }

  public function update_requester_history_data($posts){
    // if ($posts['status_protocol_history'] == '0') {
      $data = [
        'reason' => $posts['edit_reason'],
      ];
    // }
    $this->db->where('id', $posts['id_requester_history']);
    $this->db->update('requester_history', $data);
  }

  public function update_requirement($posts, $id_requirements){
    // $this->db->set('criteria_established_law', $posts['reurb']);
    $this->db->where('id', $id_requirements);
    $this->db->update('requirements');
  }

  public function update_requirement_juridical($posts, $id_requirements){
    $this->db->set('id_procedure', $posts['protocol_procedure_juridical']);
    $this->db->where('id', $id_requirements);
    $this->db->update('requirements');
  }

  public function update_embarkation_process($posts){
    $this->db->set('embarkation', '1');
    $this->db->where('id', $posts['id_protocol']);
    $this->db->update('requirements');
  }

  public function update_property_details_juridical($posts, $id){
    if (isset($posts['id_requester'])) {
      $this->db->set('id_requester', $posts['id_requester']);
    }
    $this->db->set('type_street', $posts['realty_type_juridical']);
    $this->db->set('public_place', $posts['realty_address_juridical']);
    $this->db->set('number', $posts['realty_number_juridical']);
    $this->db->set('complement', $posts['realty_complement_juridical']);
    $this->db->set('neighborhood', $posts['realty_neighborhood_juridical']);
    $this->db->set('city', $posts['realty_city_juridical']);
    $this->db->set('cep', $posts['realty_cep_juridical']);
    $this->db->set('uf', $posts['realty_uf_juridical']);
    $this->db->set('country', $posts['realty_country_juridical']);
    $this->db->set('inauguration_date', $posts['realty_address_posses_juridical']);
    $this->db->set('required_land_area', $posts['required_terrain_area_juridical']);
    $this->db->set('georeferenced_property_area', $posts['georeferenced_property_area_juridical']);
    $this->db->set('required_building_area', $posts['required_edificated_area_juridical']);
    $this->db->set('sector', $posts['sector_juridical']);
    $this->db->set('city_block', $posts['city_block_juridical']);
    $this->db->set('allotment', $posts['allotment_juridical']);
    $this->db->set('sub_lot', $posts['sub_lot_juridical']);
    $this->db->set('property_registration_number', $posts['property_registration_number_juridical']);
    $this->db->set('construction_features', $posts['construction_features_juridical']);
    $this->db->set('venal', $posts['venal_juridical']);
    $this->db->set('slab_right', $posts['slab_right_juridical']);
    $this->db->set('possession_origin', $posts['possession_origin_juridical']);
    // $this->db->set('possession_time', $posts['possession_time_juridical']);
    // $this->db->set('confrontants', $posts['confrontants_juridical']);
    $this->db->set('furniture_registration', $posts['real_state_juridical']);
    $this->db->set('basic_infrastructure', $posts['infrastructure_select_juridical']);
    $this->db->set('potable_water', $posts['potable_water_select_juridical']);
    $this->db->set('energy', $posts['infrastructure_select_juridical']);
    $this->db->set('sewage', $posts['sewage']);
    $this->db->set('type_sewer', $posts['sewage_select_juridical']);
    $this->db->set('type_property', $posts['type_property_juridical']);
    $this->db->set('unit_situation', $posts['unit_situation_juridical']);
    $this->db->set('paved_street', $posts['paviment_select_juridical']);
    $this->db->set('paving_type', $posts['paviment_type_select_juridical']);
    $this->db->set('internet_access', $posts['internet_access_select_juridical']);
    $this->db->set('date_register', $posts['register_date_juridical']);
    $this->db->where('id', $posts['id_property']);
    $this->db->update('property_details');
  }

  public function update_home_address_juridical($posts, $id){
    $this->db->set('type_street', $posts['home_type_juridical']);
    $this->db->set('public_place', $posts['home_address_juridical']);
    $this->db->set('number', $posts['home_number_juridical']);
    $this->db->set('neighborhood', $posts['home_neighborhood_juridical']);
    $this->db->set('city', $posts['home_city_juridical']);
    $this->db->set('cep', $posts['home_cep_juridical']);
    $this->db->set('uf', $posts['home_uf_juridical']);
    $this->db->set('country', $posts['home_country_juridical']);
    $this->db->where('id_requester', $id);
    $this->db->update('home_address');
  }

  public function update_legal_person($posts, $id){
    $this->db->set('name', $posts['name_personal']);
    $this->db->set('cpf', $posts['cpf_personal']);
    $this->db->set('rg', $posts['rg_personal']);
    $this->db->set('consignor_organ', $posts['consignor_organ']);
    $this->db->set('profession', $posts['profession_personal']);
    $this->db->set('monthly_income', $posts['monthly_income_personal']);
    $this->db->set('birth_date', $posts['date_of_birth_personal']);
    $this->db->set('gender', $posts['gender_personal']);
    $this->db->set('nationality', $posts['nationality_personal']);
    $this->db->set('scholarity', $posts['schooling_personal']);
    $this->db->set('mother_name', $posts['mother_name_personal']);
    $this->db->set('father_name', $posts['father_name_personal']);
    $this->db->set('email', $posts['email_personal']);
    $this->db->set('phone', $posts['tel_personal']);
    $this->db->set('civil_status', $posts['marital_status_personal']);
    $this->db->set('marriage_regime', $posts['marriage_regime_personal']);
    $this->db->set('wedding_date', $posts['date_marriage_personal']);
    $this->db->set('nis', $posts['nis_personal']);
    $this->db->set('property_owner', (isset($posts['property_owner_personal']))?$posts['property_owner_personal']:null);
    $this->db->set('cash_transfer_program', (isset($posts['cash_transfer_program']))?$posts['cash_transfer_program']:null);
    $this->db->set('federal_government_income', (isset($posts['federal_government_income']))?$posts['federal_government_income']:null);
    $this->db->where('id_requester', $id);
    $this->db->update('legal_person');
  }

  public function update_spouse($posts, $id){
    $this->db->set('name', $posts['name_spouse']);
    $this->db->set('cpf', $posts['cpf_spouse']);
    $this->db->set('rg', $posts['rg_spouse']);
    $this->db->set('consignor_organ', $posts['orgao_expedidor_spouse']);
    $this->db->set('profession', $posts['profession_spouse']);
    $this->db->set('birth_date', $posts['date_of_birth_spouse']);
    $this->db->set('gender', $posts['gender_spouse']);
    $this->db->set('nationality', $posts['nationality_spouse']);
    $this->db->set('scholarity', $posts['schooling_spouse']);
    $this->db->set('mother_name', $posts['mother_name_spouse']);
    $this->db->set('father_name', $posts['father_name_spouse']);
    $this->db->set('email', $posts['email_spouse']);
    $this->db->set('phone', $posts['tel_spouse']);
    $this->db->set('civil_status', $posts['marital_status_spouse']);
    $this->db->set('marriage_regime', $posts['marriage_regime_spouse']);
    $this->db->set('monthly_income', $posts['monthly_income_spouse']);
    $this->db->set('nis', $posts['nis_spouse']);
    $this->db->set('property_owner', (isset($posts['property_owner']))?$posts['property_owner']:null);
    $this->db->set('cash_transfer_program', (isset($posts['cash_transfer_program_spouse']))?$posts['cash_transfer_program_spouse']:null);
    $this->db->set('federal_government_income', (isset($posts['federal_government_income_spouse']))?$posts['federal_government_income_spouse']:null);
    $this->db->where('id_requester', $id);
    $this->db->update('spouse');
  }

  public function update_family_members($posts){
    if (isset($posts['id_family_members'])) {
      $id = $posts['id_family_members'];
      $name = $posts['edit_name_family'];
      foreach ($id as $key => $value) {
        $monthly_income_members_family = str_replace(".", "", $posts['edit_monthly_income_family'][$key]);
        $monthly_income_format = str_replace(",", ".", $monthly_income_members_family);

        $this->db->set('name', $name[$key]);
        $this->db->set('rg', $posts['rg_members_family'][$key]);
        $this->db->set('cpf', $posts['edit_cpf_family'][$key]);
        $this->db->set('type', $posts['type_members_family'][$key]);
        $this->db->set('birth_date', $posts['edit_date_birth_family'][$key]);
        $this->db->set('monthly_income', $monthly_income_format);
        $this->db->where('id', $value);
        $this->db->update('family_members');
      }
    }
  }

  public function update_legal_confrotants($posts){
    $id = $posts['id_confrontants'];
    foreach ($id as $key => $value) {
      $this->db->set('name', $posts['name_confrontants'][$key]);
      $this->db->set('cpf', $posts['cpf_confrontants'][$key]);
      $this->db->set('birth_date', $posts['birth_date_confrontants'][$key]);
      $this->db->set('confrontation_direction', $posts['confrontation_direction'][$key]);
      $this->db->where('id', $value);
      $this->db->update('confrotants_property');
    }
  }

  public function update_confrotants_juridical($posts){
    $id = $posts['id_confrontants_juridical'];
    foreach ($id as $key => $value) {
      $this->db->set('name', $posts['name_confrontants_juridical'][$key]);
      $this->db->set('cpf', $posts['cpf_confrontants_juridical'][$key]);
      $this->db->set('birth_date', $posts['birth_date_confrontants_juridical'][$key]);
      $this->db->set('confrontation_direction', $posts['confrontation_direction_juridical'][$key]);
      $this->db->where('id', $value);
      $this->db->update('confrotants_property');
    }
  }

  public function update_home_address($posts, $id){
    $this->db->set('type_street', $posts['home_type_home']);
    $this->db->set('public_place', $posts['home_public_place']);
    $this->db->set('number', $posts['home_number_home']);
    $this->db->set('complement', $posts['realty_complement_home']);
    $this->db->set('neighborhood', $posts['home_neighborhood_home']);
    $this->db->set('city', $posts['home_city_home']);
    $this->db->set('cep', $posts['home_cep_home']);
    $this->db->set('uf', $posts['home_uf_home']);
    $this->db->set('country', $posts['home_country_home']);
    $this->db->where('id_requester', $id);
    $this->db->update('home_address');
  }

  public function update_property_details($posts, $id){

    if (isset($posts['spouse_co_owner'])) {
      $spouse_co_owner = ($posts['spouse_co_owner'] == '') ? '0': '1';
    } else {
      $spouse_co_owner = 0;
    }

    $this->db->set('spouse_co_owner', $spouse_co_owner);
    $this->db->set('type_street', $posts['realty_type_home']);
    $this->db->set('public_place', $posts['realty_address_home']);
    $this->db->set('number', $posts['realty_number_home']);
    $this->db->set('complement', $posts['realty_complement_home']);
    $this->db->set('neighborhood', $posts['realty_neighborhood_home']);
    $this->db->set('city', $posts['realty_city_home']);
    $this->db->set('cep', $posts['realty_cep_home']);
    $this->db->set('uf', $posts['realty_uf_home']);
    $this->db->set('country', $posts['realty_country_home']);
    $this->db->set('inauguration_date', $posts['realty_address_posses_home']);
    $this->db->set('georeferenced_property_area', $posts['georeferenced_property_area']);
    $this->db->set('required_land_area', $posts['required_edificated_area_home']);
    $this->db->set('sector', $posts['sector']);
    $this->db->set('city_block', $posts['city_block']);
    $this->db->set('allotment', $posts['allotment']);
    $this->db->set('sub_lot', $posts['sub_lot']);
    $this->db->set('property_registration_number', $posts['property_registration_number']);
    $this->db->set('construction_features', $posts['construction_features']);
    $this->db->set('venal', $posts['venal']);
    // $this->db->set('possession_time', $posts['possession_time']);
    $this->db->set('possession_origin', $posts['possession_origin']);
    $this->db->set('slab_right', $posts['slab_right']);
    // $this->db->set('confrontants', $posts['required_edificated_area_home']);
    $this->db->set('furniture_registration', $posts['real_state_home']);
    $this->db->set('basic_infrastructure', $posts['infrastructure_select_home']);
    $this->db->set('potable_water', $posts['potable_water_select_home']);
    $this->db->set('energy', $posts['infrastructure_select_home']);
    $this->db->set('sewage', $posts['sewage_select_home']);
    $this->db->set('type_sewer', $posts['type_sewer']);
    $this->db->set('type_property', $posts['type_property']);
    $this->db->set('unit_situation', $posts['unit_situation']);
    $this->db->set('paved_street', $posts['paviment_select_home']);
    $this->db->set('paving_type', $posts['paviment_type_select_home']);
    $this->db->set('internet_access', $posts['internet_access_select_home']);
    $this->db->set('date_register', $posts['register_date_home']);
    $this->db->where('id', $posts['id_property']);
    $this->db->update('property_details');
  }

  public function update_juridical_requester($posts, $id){
    $this->db->set('cnpj', $posts['cnpj_juridical']);
    $this->db->set('company_name', $posts['corporate_name_juridical']);
    $this->db->set('activity_branch', $posts['activity_branch_juridical']);
    $this->db->set('type_street', $posts['type_street_juridical']);
    $this->db->set('public_place', $posts['street_juridical']);
    $this->db->set('number', $posts['number_name_juridical']);
    $this->db->set('complement', $posts['complement_juridical']);
    $this->db->set('neighborhood', $posts['neighborhood_juridical']);
    $this->db->set('city', $posts['city_juridical']);
    $this->db->set('cep', $posts['cep_juridical']);
    $this->db->set('uf', $posts['uf_juridical']);
    $this->db->set('country', $posts['country_juridical']);
    $this->db->set('monthly_invoicing', $posts['monthly_invoicing_juridical']);
    $this->db->set('property_owner', (isset($posts['property_owner_juridical']))?$posts['property_owner_juridical']:null);
    $this->db->where('id_requester', $id);
    $this->db->update('juridical_person');
  }

  public function update_procurator($posts, $id){
    $this->db->set('name', $posts['name_juridical_procurator']);
    $this->db->set('cpf', $posts['cpf_juridical_procurator']);
    $this->db->set('rg', $posts['rg_juridical_procurator']);
    $this->db->set('consignor_organ', $posts['orgao_expedidor_juridical_procurator']);
    $this->db->set('profission', $posts['profession_juridical_procurator']);
    $this->db->set('birth_date', $posts['date_of_birth_juridical_procurator']);
    $this->db->set('gender', $posts['gender_juridical_procurator']);
    $this->db->set('country', $posts['nationality_juridical_procurator']);
    $this->db->set('email', $posts['email_juridical_procurator']);
    $this->db->set('phone', $posts['tel_juridical_procurator']);
    $this->db->where('id_requester', $id);
    $this->db->update('procurator');
  }

  public function update_checklist($id, $images){
    if ($images['cpf'] != '') {
      $this->db->set('img_cpf', $images['cpf']);
    }
    if ($images['rg'] != '') {
      $this->db->set('img_rg', $images['rg']);
    }
    if ($images['nascimento'] != '') {
      $this->db->set('img_nascimento', $images['nascimento']);
    }
    if ($images['residencia'] != '') {
      $this->db->set('img_residencia', $images['residencia']);
    }
    if ($images['renda'] != '') {
      $this->db->set('img_renda', $images['renda']);
    }
    if ($images['cpf'] != '' || $images['rg'] != '' || $images['nascimento'] != '' || $images['residencia'] != '' || $images['renda'] != '') {
      $this->db->where('id_requester', $id);
      $this->db->update('checklist_requester');
    }
  }

  public function update_files_requesters($posts, $file){
    $this->db->set('file', $file);
    $this->db->where('id', $posts['id_arquivo']);
    $this->db->update('files_requester');
  }

  public function remove_tenants($posts){
    $this->db->set('status', '0');
    $this->db->where('id', $posts['id']);
    $this->db->update('tenants');
  }

  public function turn_off_requester($posts){
    $status = ($posts['status'] == '1') ? '0' : '1';
    $this->db->set('status', $status);
    $this->db->where('id', $posts['id']);
    $this->db->update('requesters');
  }
  public function disable_all_topographic_survey($topographic_survey){
    foreach ($topographic_survey as $row) {
      $this->db->set('status', '0');
      $this->db->set('activation_date', null);
      $this->db->where('id', $row->id);
      $this->db->update('topographic_survey');
    }
  }
  public function disable_topographic_survey($topographic_survey, $posts){
    foreach ($topographic_survey as $row) {
      foreach ($posts['id_topographic_survey'] as $key => $value) {
        if ($value != $row->id) {
          $this->db->set('status', '0');
          $this->db->set('activation_date', null);
          $this->db->where('id', $row->id);
          $this->db->update('topographic_survey');
        }
      }
    }
  }

  public function update_topographic_survey($topographic_survey, $posts){
    foreach ($posts['id_topographic_survey'] as $key => $value) {
      foreach ($topographic_survey as $row) {
        if ($value == $row->id) {
          if ($row->status == '0') {
            $this->db->set('status', '1');
            $this->db->set('activation_date', date('Y-m-d H:i:s'));
            $this->db->where('id', $value);
            $this->db->update('topographic_survey');
          }
        }
      }
    }
  }

  public function update_protocol_history($posts, $status){
    $this->db->set('status', $status);
    $this->db->where('id', $posts['id_protocol']);
    $this->db->update('requirements');
  }

  public function update_requester_history($posts, $status){
    $this->db->set('completion_status', $status);
    $this->db->where('id', $posts['id_requester']);
    $this->db->update('requesters');
  }

  public function fetch_maximum_family_income(){
    $this->db->select('id, maximum_family_income');
    $this->db->from('reurb_config');
    $this->db->where('id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function fetch_requesters(){
    $this->db->select('r.id, r.type_requester, l.name as legal_name, l.email as legal_email, l.cpf, l.phone as legal_phone, l.property_owner as property_owner_legal, l.monthly_income, j.company_name, j.cnpj, j.property_owner as property_owner_juridical, j.monthly_invoicing, p.email as procurator_email,
      p.phone as procurator_phone,
    ');
    $this->db->from('requesters as r');
    $this->db->join('legal_person as l', 'l.id_requester = r.id', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = r.id', 'left');
    $this->db->join('procurator as p', 'p.id_requester = r.id', 'left');
    $this->db->where('r.status', '1');
    $this->db->where('r.id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_completed_applicants()
  {
    $this->db->select('r.id, r.type_requester, l.name as legal_name, l.email as legal_email, l.cpf, l.phone as legal_phone, l.property_owner as property_owner_legal, l.monthly_income, j.company_name, j.cnpj, j.property_owner as property_owner_juridical, j.monthly_invoicing, p.email as procurator_email,
      p.phone as procurator_phone,
    ');
    $this->db->from('requesters as r');
    $this->db->join('legal_person as l', 'l.id_requester = r.id', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = r.id', 'left');
    $this->db->join('procurator as p', 'p.id_requester = r.id', 'left');
    $this->db->where('r.completion_status', '1');
    $this->db->where('r.status', '1');
    $this->db->where('r.id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_checklist_requester($id){
    $this->db->select('c.id, img_cpf, img_rg, img_nascimento, img_residencia, img_renda');
    $this->db->from('checklist_requester as c');
    $this->db->where('c.id_requester', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_files_checklist($id){
    $this->db->select('f.id, f.file, f.property_document, f.register, c.description, c.type');
    $this->db->from('files_requester as f');
    $this->db->join('checklist_documentos_prefeitura as c', 'f.id_documents = c.id');
    $this->db->where('f.id_requester', $id);
    $query = $this->db->get();
    return $query->result();
  }

  public function count_checklist_required_physical(){
    $this->db->select('count(id) as count');
    $this->db->from('checklist_documentos_prefeitura');
    $this->db->where('id_entity', $_SESSION['user']['id_entity']);
    $this->db->where('status', 1);
    $this->db->where('type', 1);
    $query = $this->db->get();
    return $query->row();
  }

  public function count_checklist_required_juridical(){
    $this->db->select('count(id) as count');
    $this->db->from('checklist_documentos_prefeitura');
    $this->db->where('id_entity', $_SESSION['user']['id_entity']);
    $this->db->where('status', 1);
    $this->db->where('type', 2);
    $query = $this->db->get();
    return $query->row();
  }

  public function count_checklist_send($id){
    $this->db->select('count(id) as count');
    $this->db->from('files_requester');
    $this->db->where('id_requester', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_checklist_not_send_requester_physical($id){
    $query = $this->db->query('
      select description from checklist_documentos_prefeitura c
      left join (select * from files_requester where id_requester = '.$id.' and property_document = 1) as sub
      on c.id = sub.id_documents
      where sub.id_documents is null
      and c.status = 1
      and c.id_entity = '.$_SESSION["user"]["id_entity"].' and c.type = 1
    ');
    return $query->result();
  }

  public function fetch_checklist_not_send_requester_juridical($id){
    $query = $this->db->query('
      select description from checklist_documentos_prefeitura c
      left join (select * from files_requester where id_requester = '.$id.' and property_document = 1) as sub
      on c.id = sub.id_documents
      where sub.id_documents is null
      and c.status = 1
      and c.id_entity = '.$_SESSION["user"]["id_entity"].' and c.type = 2
    ');
    return $query->result();
  }

  public function fetch_checklist_not_send_married_physical($id){
    $query = $this->db->query('
      select description from checklist_documentos_prefeitura c
      left join (select * from files_requester where id_requester = '.$id.' and property_document = 2) as sub
      on c.id = sub.id_documents
      where sub.id_documents is null
      and c.status = 1
      and c.id_entity = '.$_SESSION["user"]["id_entity"].' and c.type = 1
    ');
    return $query->result();
  }

  public function fetch_requester($id){
    $this->db->select('r.id, r.id_entity, r.type_requester, r.status,
    l.name as legal_name, l.cpf as legal_cpf, l.rg as legal_rg, l.consignor_organ as legal_consignor_organ, l.profession as legal_profession, l.monthly_income as legal_monthly_income, l.birth_date, l.gender, l.nationality as legal_nationality, l.scholarity, l.mother_name, l.father_name, l.email, l.phone as legal_phone, l.civil_status as legal_civil_status, l.marriage_regime, l.wedding_date, l.property_owner as property_owner_legal, l.nis as nis_personal,
    l.cash_transfer_program, l.federal_government_income,
    s.name as name_spouse, s.cpf as cpf_spouse, s.rg as rg_spouse, s.consignor_organ as consignor_organ_spouse, s.profession as profession_spouse, s.birth_date as birth_date_spouse, s.gender as gender_spouse,
    s.nationality as nationality_spouse, s.scholarity as scholarity_spouse, s.mother_name as mother_name_spouse, s.father_name as father_name_spouse, s.email as email_spouse, s.phone as phone_spouse, s.monthly_income as monthly_spouse, s.nis as nis_spouse,
    s.civil_status as civil_status_spouse, s.marriage_regime as marriage_regime_spouse, s.property_owner, s.cash_transfer_program as cash_transfer_program_spouse, s.federal_government_income as federal_government_income_spouse,
    j.company_name, j.cnpj, j.activity_branch, j.type_street as type_street_juridical, j.public_place as public_place_juridical, j.number as number_juridical, j.complement as complement_juridical, j.neighborhood as neighborhood_juridical, j.city as city_juridical, j.cep as cep_juridical, j.uf as uf_juridical, j.country, j.monthly_invoicing, j.property_owner,
    p.name, p.cpf, p.rg, p.consignor_organ, p.profission, p.birth_date, p.gender, p.country as country_procurator, p.email, p.phone,
    h.type_street, h.public_place, h.number, h.complement, h.neighborhood, h.city, h.cep, h.country as home_country, h.uf,
    pd.id as id_property, pd.type_street as street_property, pd.public_place as place_property, pd.number as number_property, pd.complement as complement_property, pd.neighborhood as neighborhood_property,
    pd.city as city_property, pd.cep as cep_property, pd.uf as uf_property, pd.country as country_property, pd.Inauguration_date, pd.required_land_area,
    pd.required_building_area, pd.construction_features, pd.confrontants, pd.furniture_registration, pd.basic_infrastructure, pd.potable_water, pd.energy, pd.sewage, pd.type_sewer,
    pd.paved_street, pd.paving_type, pd.internet_access, pd.date_register, pd.georeferenced_property_area,');
    $this->db->from('requesters as r');
    $this->db->join('legal_person as l', 'l.id_requester = r.id', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = r.id', 'left');
    $this->db->join('spouse as s', 's.id_requester = r.id', 'left');
    $this->db->join('procurator as p', 'p.id_requester = r.id', 'left');
    $this->db->join('home_address as h', 'h.id_requester = r.id', 'left');
    $this->db->join('property_details as pd', 'pd.id_requester = r.id', 'left');
    $this->db->where('r.id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_requester_juridical($id){
    $this->db->select('r.id, r.id_entity, r.type_requester, r.status,
    j.company_name, j.cnpj, j.activity_branch, j.type_street as type_street_juridical, j.public_place as public_place_juridical, j.number as number_juridical, j.complement as complement_juridical, j.neighborhood as neighborhood_juridical, j.city as city_juridical, j.cep as cep_juridical, j.uf as uf_juridical, j.country, j.monthly_invoicing, j.property_owner,
    p.name, p.cpf, p.rg, p.consignor_organ, p.profission, p.birth_date, p.gender, p.country as country_procurator, p.email, p.phone,
    h.type_street, h.public_place, h.number, h.complement, h.neighborhood, h.city, h.cep, h.country as home_country, h.uf,
    pd.id as id_property, pd.type_street as street_property, pd.public_place as place_property, pd.number as number_property, pd.complement as complement_property, pd.neighborhood as neighborhood_property,
    pd.city as city_property, pd.cep as cep_property, pd.uf as uf_property, pd.country as country_property, pd.Inauguration_date, pd.required_land_area,
    pd.required_building_area, pd.construction_features, pd.confrontants, pd.furniture_registration, pd.basic_infrastructure, pd.potable_water, pd.energy, pd.sewage, pd.type_sewer,
    pd.paved_street, pd.paving_type, pd.internet_access, pd.date_register, pd.georeferenced_property_area,');
    $this->db->from('requesters as r');
    $this->db->join('juridical_person as j', 'j.id_requester = r.id', 'left');
    $this->db->join('procurator as p', 'p.id_requester = r.id', 'left');
    $this->db->join('home_address as h', 'h.id_requester = r.id', 'left');
    $this->db->join('property_details as pd', 'pd.id_requester = r.id', 'left');
    $this->db->where('r.id', $id);
    $query = $this->db->get();
    return $query->row();
  }

public function fetch_requester_legal($id){
    $this->db->select('r.id, r.id_entity, r.type_requester, r.status, r.completion_status,
    l.name, l.cpf, l.rg, l.consignor_organ, l.profession, l.monthly_income, l.birth_date, l.gender, l.nationality, l.scholarity, l.mother_name, l.father_name, l.email, l.phone, l.civil_status, l.marriage_regime, l.wedding_date, l.property_owner as property_owner_legal, l.nis as nis_personal,
    l.cash_transfer_program, l.federal_government_income,
    s.name as name_spouse, s.cpf as cpf_spouse, s.rg as rg_spouse, s.consignor_organ as consignor_organ_spouse, s.profession as profession_spouse, s.birth_date as birth_date_spouse, s.gender as gender_spouse,
    s.nationality as nationality_spouse, s.scholarity as scholarity_spouse, s.mother_name as mother_name_spouse, s.father_name as father_name_spouse, s.email as email_spouse, s.phone as phone_spouse, s.monthly_income as monthly_spouse, s.nis as nis_spouse,
    s.civil_status as civil_status_spouse, s.marriage_regime as marriage_regime_spouse, s.property_owner, s.cash_transfer_program as cash_transfer_program_spouse, s.federal_government_income as federal_government_income_spouse,
    h.type_street, h.public_place, h.number, h.complement, h.neighborhood, h.city, h.cep, h.country as home_country, h.uf,
    pd.id as id_property, pd.type_street as street_property, pd.public_place as place_property, pd.number as number_property, pd.complement as complement_property, pd.neighborhood as neighborhood_property,
    pd.city as city_property, pd.cep as cep_property, pd.uf as uf_property, pd.country as country_property, pd.Inauguration_date, pd.required_land_area,
    pd.required_building_area, pd.construction_features, pd.confrontants, pd.furniture_registration, pd.basic_infrastructure, pd.potable_water, pd.energy, pd.sewage, pd.type_sewer,
    pd.paved_street, pd.paving_type, pd.internet_access, pd.date_register, pd.georeferenced_property_area');
    $this->db->from('requesters as r');
    $this->db->join('legal_person as l', 'l.id_requester = r.id', 'left');
    $this->db->join('spouse as s', 's.id_requester = r.id', 'left');
    $this->db->join('home_address as h', 'h.id_requester = r.id', 'left');
    $this->db->join('property_details as pd', 'pd.id_requester = r.id', 'left');
    $this->db->where('r.id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_conclusion_requester_legal($id){
    $this->db->select('r.id, r.id_entity, r.type_requester, r.status, r.completion_status');
    $this->db->from('requesters as r');
    $this->db->join('legal_person as l', 'l.id_requester = r.id', 'left');
    $this->db->join('spouse as s', 's.id_requester = r.id', 'left');
    $this->db->join('home_address as h', 'h.id_requester = r.id', 'left');
    $this->db->join('property_details as pd', 'pd.id_requester = r.id', 'left');
    $this->db->where('l.name !=', '');
    $this->db->where('l.cpf !=', '');
    $this->db->where('l.rg !=', '');
    $this->db->where('l.consignor_organ !=', '');
    $this->db->where('l.civil_status !=', '');
    $this->db->where('l.profession !=', '');
    $this->db->where('l.mother_name !=', '');
    $this->db->where('l.father_name !=', '');
    $this->db->where('h.type_street !=', '');
    $this->db->where('h.public_place !=', '');
    $this->db->where('h.number !=', '');
    $this->db->where('h.neighborhood !=', '');
    $this->db->where('h.city !=', '');
    $this->db->where('h.uf !=', '');
    $this->db->where('h.cep !=', '');
    $this->db->where('h.country !=', '');
    $this->db->where('r.id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_family_members($id){
    $this->db->select('f.id, f.name, f.rg, f.cpf, f.type, f.birth_date, f.monthly_income');
    $this->db->from('family_members as f');
    $this->db->where('f.id_requester', $id);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_family_members_requester($id){
    $this->db->select('sum(f.monthly_income) as monthly_income_family');
    $this->db->from('family_members as f');
    $this->db->where('f.id_requester', $id);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function fetch_requirements_legal($posts){
    $this->db->select('r.id, r.type_requester, l.name, l.email, l.cpf, l.phone, l.profession, l.birth_date');
    $this->db->from('requesters as r');
    $this->db->join('legal_person as l', 'l.id_requester = r.id', 'left');
    $this->db->where('l.cpf', $posts['cpf']);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_requirements_juridical($posts){
    $this->db->select('r.id, r.type_requester,
      j.company_name, j.cnpj, j.activity_branch, j.type_street, j.public_place, j.number, j.complement, j.neighborhood, j.city, j.cep, j.uf, j.country, j.monthly_invoicing,
    ');
    $this->db->from('requesters as r');
    $this->db->join('juridical_person as j', 'j.id_requester = r.id', 'left');
    $this->db->join('procurator as p', 'p.id_requester = r.id', 'left');
    $this->db->where('j.cnpj', $posts['cnpj']);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_requirements_process_number($process_number){
    $this->db->select('r.id, r.id_property, r.id_procedure, r.classification_reurb, r.status,
      rq.type_requester, r.embarkation,
      l.name as legal_name, l.email as legal_email, l.cpf,
      j.company_name, j.cnpj,
      p.email as procurator_email,
      pr.date_requester, pr.process_number, pr.stage, pr.core_name,
      pd.id_requester, pd.type_street as street_property, pd.public_place as place_property, pd.number as number_property, pd.complement as complement_property, pd.neighborhood as neighborhood_property,
      pd.city as city_property, pd.cep as cep_property, pd.uf as uf_property, pd.country as country_property, pd.inauguration_date, pd.required_land_area,
      pd.required_building_area, pd.construction_features, pd.confrontants, pd.furniture_registration, pd.basic_infrastructure, pd.potable_water, pd.energy, pd.sewage, pd.type_sewer,
      pd.paved_street, pd.paving_type, pd.internet_access, pd.date_register, pd.venal, pd.possession_origin, pd.spouse_co_owner,
      pd.slab_right, pd.possession_time, pd.sector, pd.city_block, pd.allotment, pd.sub_lot, pd.georeferenced_property_area, pd.property_registration_number,
      pd.type_property as type_property_details, pd.unit_situation,
    ');
    $this->db->from('requirements as r');
    $this->db->join('procedure_reurb as pr', 'r.id_procedure = pr.id');
    $this->db->join('property_details as pd', 'r.id_property = pd.id');
    $this->db->join('requesters as rq', 'pd.id_requester = rq.id', 'left');
    $this->db->join('legal_person as l', 'l.id_requester = pd.id_requester', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = pd.id_requester', 'left');
    $this->db->join('procurator as p', 'p.id_requester = pd.id_requester', 'left');
    $this->db->where('r.status', '1');
    $this->db->where('r.embarkation', '0');
    $this->db->where('pr.process_number', $process_number);
    $this->db->where('r.id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_requirements_numerical_indication($process_number){
    $this->db->select('r.id, pd.sector,  pd.city_block,  pd.allotment,  pd.sub_lot, pd.georeferenced_property_area, pd.property_registration_number,
       pr.process_number,
    ');
    $this->db->from('requirements as r');
    $this->db->join('procedure_reurb as pr', 'r.id_procedure = pr.id');
    $this->db->join('property_details as pd', 'r.id_property = pd.id');
    $this->db->join('requesters as rq', 'pd.id_requester = rq.id', 'left');
    $this->db->join('legal_person as l', 'l.id_requester = pd.id_requester', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = pd.id_requester', 'left');
    $this->db->join('procurator as p', 'p.id_requester = pd.id_requester', 'left');
    $this->db->where('pr.process_number', $process_number);
    $this->db->where('pd.sector !=', '');
    $this->db->where('pd.city_block !=', '');
    $this->db->where('pd.allotment !=', '');
    $this->db->where('pd.georeferenced_property_area !=', '');
    $this->db->where('r.id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_requirements_modality($id_procedure, $modality){
    $this->db->select('r.id, r.id_property, r.id_procedure, r.classification_reurb, r.status,
      rq.type_requester, r.embarkation,
      l.name as legal_name, l.email as legal_email, l.cpf,
      j.company_name, j.cnpj,
      p.email as procurator_email,
      pr.date_requester, pr.process_number, pr.stage, pr.core_name,
      pd.id_requester, pd.type_street as street_property, pd.public_place as place_property, pd.number as number_property, pd.complement as complement_property, pd.neighborhood as neighborhood_property,
      pd.city as city_property, pd.cep as cep_property, pd.uf as uf_property, pd.country as country_property, pd.inauguration_date, pd.required_land_area,
      pd.required_building_area, pd.construction_features, pd.confrontants, pd.furniture_registration, pd.basic_infrastructure, pd.potable_water, pd.energy, pd.sewage, pd.type_sewer,
      pd.paved_street, pd.paving_type, pd.internet_access, pd.date_register, pd.venal, pd.possession_origin, pd.spouse_co_owner,
      pd.slab_right, pd.possession_time, pd.sector,  pd.city_block,  pd.allotment,  pd.sub_lot, pd.georeferenced_property_area, pd.property_registration_number,
      pd.type_property as type_property_details, pd.unit_situation,
    ');
    $this->db->from('requirements as r');
    $this->db->join('procedure_reurb as pr', 'r.id_procedure = pr.id');
    $this->db->join('property_details as pd', 'r.id_property = pd.id');
    $this->db->join('requesters as rq', 'pd.id_requester = rq.id', 'left');
    $this->db->join('legal_person as l', 'l.id_requester = pd.id_requester', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = pd.id_requester', 'left');
    $this->db->join('procurator as p', 'p.id_requester = pd.id_requester', 'left');
    $this->db->where('r.id_procedure', $id_procedure);
    $this->db->where('r.status', '1');
    $this->db->where('r.embarkation', '0');
    if ($modality != 'Geral') {
      $this->db->where('r.classification_reurb', $modality);
    }
    $this->db->where('r.id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_generate_requirements_modality($process_number, $modality){
    $this->db->select('r.id, r.id_property, r.id_procedure, r.classification_reurb, r.status,
      rq.type_requester, rq.id as id_requester, r.embarkation,
      l.name as legal_name,  l.cpf, l.rg, l.consignor_organ, l.profession, l.monthly_income, l.birth_date, l.gender, l.nationality, l.scholarity, l.mother_name, l.father_name, l.email as legal_email, l.phone as legal_phone, l.civil_status, l.marriage_regime, l.wedding_date, l.property_owner as property_owner_legal, l.cash_transfer_program, l.federal_government_income,
      j.company_name, j.cnpj, j.activity_branch, j.type_street as type_street_juridical, j.public_place as public_place_juridical, j.number as number_juridical, j.complement as complement_juridical, j.neighborhood as neighborhood_juridical, j.city as city_juridical, j.cep as cep_juridical, j.uf as uf_juridical, j.country, j.monthly_invoicing, j.property_owner as property_owner_juridical,
      p.email as procurator_email,
      pr.date_requester, pr.process_number, pr.stage, pr.core_name, pr.publication_procedure,
      pd.id_requester, pd.type_street as street_property, pd.public_place as place_property, pd.number as number_property, pd.complement as complement_property, pd.neighborhood as neighborhood_property,
      pd.city as city_property, pd.cep as cep_property, pd.uf as uf_property, pd.country as country_property, pd.inauguration_date, pd.required_land_area,
      pd.required_building_area, pd.construction_features, pd.confrontants, pd.furniture_registration, pd.basic_infrastructure, pd.potable_water, pd.energy, pd.sewage, pd.type_sewer,
      pd.paved_street, pd.paving_type, pd.internet_access, pd.date_register, pd.venal, pd.possession_origin, pd.spouse_co_owner,
      pd.slab_right, pd.possession_time, pd.sector,  pd.city_block,  pd.allotment,  pd.sub_lot, pd.georeferenced_property_area, pd.property_registration_number,
      pd.type_property as type_property_details, pd.unit_situation,
      s.monthly_income as monthly_income_spouse,
      s.property_owner, s.federal_government_income as federal_government_income_spouse,
    ');
    $this->db->from('requirements as r');
    $this->db->join('procedure_reurb as pr', 'r.id_procedure = pr.id');
    $this->db->join('property_details as pd', 'r.id_property = pd.id');
    $this->db->join('requesters as rq', 'pd.id_requester = rq.id', 'left');
    $this->db->join('legal_person as l', 'l.id_requester = pd.id_requester', 'left');
    $this->db->join('spouse as s', 's.id_requester = pd.id_requester', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = pd.id_requester', 'left');
    $this->db->join('procurator as p', 'p.id_requester = pd.id_requester', 'left');
    $this->db->where('pr.process_number', $process_number);
    $this->db->where('r.status', '1');
    $this->db->where('r.embarkation', '0');
    if ($modality != 'Geral') {
      $this->db->where('r.classification_reurb', $modality);
    }
    $this->db->where('r.id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_requirements(){
    $this->db->select('r.id, r.id_property, r.id_procedure, r.status,
      rq.type_requester,
      l.name as legal_name, l.email as legal_email, l.cpf,
      j.company_name, j.cnpj,
      p.email as procurator_email,
      pr.date_requester, pr.process_number, pr.stage, pr.core_name,
    ');
    $this->db->from('requirements as r');
    $this->db->join('procedure_reurb as pr', 'r.id_procedure = pr.id');
    $this->db->join('property_details as pd', 'r.id_property = pd.id');
    $this->db->join('requesters as rq', 'pd.id_requester = rq.id', 'left');
    $this->db->join('legal_person as l', 'l.id_requester = pd.id_requester', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = pd.id_requester', 'left');
    $this->db->join('procurator as p', 'p.id_requester = pd.id_requester', 'left');
    $this->db->where('r.id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_requirement($posts) {
    $this->db->select('r.id, r.id_property, r.id_procedure, r.status,
      rq.type_requester, rq.id as id_requester, r.embarkation,
      l.name as legal_name, l.email as legal_email, l.cpf, l.monthly_income, l.federal_government_income,   l.property_owner as property_owner_legal,
      j.company_name, j.cnpj,
      p.email as procurator_email,
      pr.date_requester, pr.process_number, pr.stage, pr.core_name, pr.publication_procedure,
      s.monthly_income as monthly_income_spouse,
      s.property_owner, s.federal_government_income as federal_government_income_spouse,
    ');
    $this->db->from('requirements as r');
    $this->db->join('procedure_reurb as pr', 'r.id_procedure = pr.id');
    $this->db->join('property_details as pd', 'r.id_property = pd.id');
    $this->db->join('requesters as rq', 'pd.id_requester = rq.id', 'left');
    $this->db->join('legal_person as l', 'l.id_requester = pd.id_requester', 'left');
    $this->db->join('spouse as s', 's.id_requester = pd.id_requester', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = pd.id_requester', 'left');
    $this->db->join('procurator as p', 'p.id_requester = pd.id_requester', 'left');
    $this->db->where('r.id', $posts['process_number']);
    $this->db->where('r.id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_procedure($posts) {
    $this->db->select('pr.id, pr.date_requester, pr.process_number, pr.stage, pr.core_name, pr.publication_procedure, pr.total_regularized_area, pr.perimeter_description');
    $this->db->from('procedure_reurb as pr');
    $this->db->where('pr.id', $posts['process_number']);
    $this->db->where('pr.id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_requirement_procedure($posts) {
    $this->db->select('r.id, r.id_property, r.id_procedure, r.status,
      rq.type_requester, rq.id as id_requester, r.embarkation,
      l.name as legal_name, l.cpf, l.rg, l.consignor_organ, l.profession, l.monthly_income, l.birth_date, l.gender, l.nationality, l.scholarity, l.mother_name, l.father_name, l.email as legal_email, l.phone as legal_phone, l.civil_status, l.marriage_regime, l.wedding_date, l.property_owner as property_owner_legal, l.cash_transfer_program, l.federal_government_income,
      j.company_name, j.cnpj, j.activity_branch, j.type_street as type_street_juridical, j.public_place as public_place_juridical, j.number as number_juridical, j.complement as complement_juridical, j.neighborhood as neighborhood_juridical, j.city as city_juridical, j.cep as cep_juridical, j.uf as uf_juridical, j.country, j.monthly_invoicing, j.property_owner as property_owner_juridical,
      p.email as procurator_email,
      pr.date_requester, pr.process_number, pr.stage, pr.core_name, pr.publication_procedure,
      pd.type_property, pd.id_requester, pd.type_street as street_property, pd.public_place as place_property, pd.number as number_property, pd.complement as complement_property, pd.neighborhood as neighborhood_property,
      pd.city as city_property, pd.cep as cep_property, pd.uf as uf_property, pd.country as country_property, pd.inauguration_date, pd.required_land_area,
      pd.required_building_area, pd.construction_features, pd.confrontants, pd.furniture_registration, pd.basic_infrastructure, pd.potable_water, pd.energy, pd.sewage, pd.type_sewer,
      pd.paved_street, pd.paving_type, pd.internet_access, pd.date_register, pd.venal, pd.possession_origin, pd.spouse_co_owner,
      pd.slab_right, pd.possession_time, pd.sector,  pd.city_block,  pd.allotment,  pd.sub_lot, pd.georeferenced_property_area, pd.property_registration_number,
      pd.type_property as type_property_details, pd.unit_situation,
      s.monthly_income as monthly_income_spouse,
      s.property_owner, s.federal_government_income as federal_government_income_spouse,
    ');
    $this->db->from('requirements as r');
    $this->db->join('procedure_reurb as pr', 'r.id_procedure = pr.id');
    $this->db->join('property_details as pd', 'r.id_property = pd.id');
    $this->db->join('requesters as rq', 'pd.id_requester = rq.id', 'left');
    $this->db->join('legal_person as l', 'l.id_requester = pd.id_requester', 'left');
    $this->db->join('spouse as s', 's.id_requester = pd.id_requester', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = pd.id_requester', 'left');
    $this->db->join('procurator as p', 'p.id_requester = pd.id_requester', 'left');
    $this->db->where('r.id_procedure', $posts['process_number']);
    $this->db->where('r.id_entity', $_SESSION['user']['id_entity']);
    $query = $this->db->get();
    return $query->row();
  }

  public function isset_cpf_cnpj_requirements($posts){
    $this->db->select('rq.id as id_requester, rq.type_requester, rq.status, rq.completion_status,
      s.property_owner, s.monthly_income as monthly_income_spouse, s.federal_government_income as federal_government_income_spouse,
      rq.id, l.id_requester as id_legal_person, l.name as legal_name, l.email as legal_email, l.cpf, l.phone as legal_phone, l.profession as legal_profession, l.birth_date, l.civil_status, l.monthly_income, l.property_owner as property_owner_legal, l.federal_government_income,
      j.id_requester as id_juridical_person, j.company_name, j.cnpj, j.activity_branch, j.type_street, j.public_place, j.number, j.complement, j.neighborhood, j.city, j.cep, j.uf, j.country, j.monthly_invoicing, j.property_owner as property_owner_juridical,
      p.name as name_procurator, p.cpf as cpf_procurator, p.rg as rg_procurator, p.consignor_organ as consignor_organ_procurator, p.profission as profission_procurator, p.birth_date as birth_date_procurator, p.gender as gender_procurator, p.country as country_procurator, p.email as procurator_email, p.phone as phone_procurator,
    ');
    $this->db->from('requesters as rq');
    $this->db->join('legal_person as l', 'l.id_requester = rq.id', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = rq.id', 'left');
    $this->db->join('spouse as s', 's.id_requester = rq.id', 'left');
    $this->db->join('procurator as p', 'p.id_requester = rq.id', 'left');
    // $this->db->where('rq.completion_status', '1');
    $this->db->where('l.cpf', $posts['cpf_cnpj']);
    $this->db->or_where('j.cnpj', $posts['cpf_cnpj']);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function fetch_requeriment($id){
    $this->db->select('r.id, r.id_entity, r.id_property, r.id_procedure, r.people_type, r.register, r.criteria_established_law, r.embarkation, r.status,
      pd.id_requester, pd.type_street as street_property, pd.public_place as place_property, pd.number as number_property, pd.complement as complement_property, pd.neighborhood as neighborhood_property,
      pd.city as city_property, pd.cep as cep_property, pd.uf as uf_property, pd.country as country_property, pd.inauguration_date, pd.required_land_area, pd.georeferenced_property_area,
      pd.required_building_area, pd.construction_features, pd.confrontants, pd.furniture_registration, pd.basic_infrastructure, pd.potable_water, pd.energy, pd.sewage, pd.type_sewer,
      pd.paved_street, pd.paving_type, pd.internet_access, pd.date_register, pd.venal, pd.possession_origin, pd.spouse_co_owner,
      pd.slab_right, pd.possession_time, pd.sector,  pd.city_block,  pd.allotment,  pd.sub_lot, pd.georeferenced_property_area, pd.property_registration_number,
      pd.type_property as type_property_details, pd.unit_situation,
      rq.id as id_requester, rq.type_requester,
      l.name as legal_name, l.cpf, l.rg, l.consignor_organ, l.profession, l.monthly_income, l.birth_date, l.gender, l.nationality, l.scholarity, l.mother_name, l.father_name, l.email as legal_email, l.phone as legal_phone, l.civil_status, l.marriage_regime, l.wedding_date, l.property_owner as property_owner_legal, l.cash_transfer_program, l.federal_government_income,
      j.company_name, j.cnpj, j.activity_branch, j.type_street as type_street_juridical, j.public_place as public_place_juridical, j.number as number_juridical, j.complement as complement_juridical, j.neighborhood as neighborhood_juridical, j.city as city_juridical, j.cep as cep_juridical, j.uf as uf_juridical, j.country, j.monthly_invoicing, j.property_owner as property_owner_juridical,
      p.name as name_procurator, p.cpf as cpf_procurator, p.rg as rg_procurator, p.consignor_organ as consignor_organ_procurator, p.profission as profission_procurator, p.birth_date as birth_date_procurator, p.gender as gender_procurator, p.country as country_procurator, p.email as procurator_email, p.phone as phone_procurator,
      pi.id as id_property_imagens, pi.acquisition, pi.iptu, pi.confronting, pi.topographic, pi.memorial, pi.front,
      pr.process_number, pr.core_name , pr.stage, pr.modality, pr.id_entity, pr.date_requester, pr.end_date, pr.publication_procedure,
      pr.issue_date, pr.original_registration, pr.type_property,
      s.monthly_income as monthly_income_spouse, s.property_owner, s.federal_government_income as federal_government_income_spouse,
      h.type_street as type_street_home, h.public_place as public_place_home, h.number as number_home, h.complement as complement_home, h.neighborhood as neighborhood_home, h.city as city_home, h.cep as cep_home, h.country as country_home, h.uf as uf_home,
    ');
    $this->db->from('requirements as r');
    $this->db->join('property_details as pd', 'r.id_property = pd.id');
    $this->db->join('property_images as pi', 'pi.id_property = pd.id', 'left');
    $this->db->join('confrotants_property as cp', 'r.id_procedure = cp.id', 'left');
    $this->db->join('requesters as rq', 'pd.id_requester = rq.id', 'left');
    $this->db->join('legal_person as l', 'l.id_requester = pd.id_requester', 'left');
    $this->db->join('spouse as s', 's.id_requester = rq.id', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = pd.id_requester', 'left');
    $this->db->join('procurator as p', 'p.id_requester = pd.id_requester', 'left');
    $this->db->join('procedure_reurb as pr', 'r.id_procedure = pr.id', 'left');
    $this->db->join('home_address as h', 'h.id_requester = rq.id', 'left');
    $this->db->where('r.id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_conclusion_protocol($id)
  {
    $this->db->select('r.id, r.id_entity, r.type_requester, r.status, r.completion_status');
    $this->db->from('requesters as r');
    $this->db->join('legal_person as l', 'l.id_requester = r.id', 'left');
    $this->db->join('spouse as s', 's.id_requester = r.id', 'left');
    $this->db->join('home_address as h', 'h.id_requester = r.id', 'left');
    $this->db->join('property_details as pd', 'pd.id_requester = r.id', 'left');
    $this->db->where('l.name !=', '');
    $this->db->where('l.cpf !=', '');
    $this->db->where('l.rg !=', '');
    $this->db->where('l.consignor_organ !=', '');
    $this->db->where('l.civil_status !=', '');
    $this->db->where('l.profession !=', '');
    $this->db->where('l.mother_name !=', '');
    $this->db->where('l.father_name !=', '');
    $this->db->where('h.type_street !=', '');
    $this->db->where('h.public_place !=', '');
    $this->db->where('h.number !=', '');
    $this->db->where('h.neighborhood !=', '');
    $this->db->where('h.city !=', '');
    $this->db->where('h.uf !=', '');
    $this->db->where('h.cep !=', '');
    $this->db->where('h.country !=', '');
    $this->db->where('r.id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function isset_cpf_cnpj($posts){
    $this->db->select('r.id, r.status, r.completion_status, l.cpf, l.name, j.cnpj, j.company_name');
    $this->db->from('requesters as r');
    $this->db->join('legal_person as l', 'l.id_requester = r.id', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = r.id', 'left');
    // $this->db->where('r.completion_status', '1');
    $this->db->where('l.cpf', $posts['cpf_cnpj']);
    $this->db->or_where('j.cnpj', $posts['cpf_cnpj']);
    $query = $this->db->get();
    return $query->row();
  }

  public function cpf_cnpj($posts){
    $this->db->select('r.id, r.status,
      l.name as legal_name, l.cpf, l.rg, l.consignor_organ, l.profession, l.monthly_income, l.birth_date, l.gender, l.nationality, l.scholarity, l.mother_name, l.father_name, l.email as legal_email, l.phone as legal_phone, l.civil_status, l.marriage_regime, l.wedding_date, l.property_owner as property_owner_legal, l.cash_transfer_program, l.federal_government_income,
      j.company_name, j.cnpj, j.activity_branch, j.type_street as type_street_juridical, j.public_place as public_place_juridical, j.number as number_juridical, j.complement as complement_juridical, j.neighborhood as neighborhood_juridical, j.city as city_juridical, j.cep as cep_juridical, j.uf as uf_juridical, j.country, j.monthly_invoicing, j.property_owner as property_owner_juridical,
      p.name as name_procurator, p.cpf as cpf_procurator, p.rg as rg_procurator, p.consignor_organ as consignor_organ_procurator, p.profission as profission_procurator, p.birth_date as birth_date_procurator, p.gender as gender_procurator, p.country as country_procurator, p.email as procurator_email, p.phone as phone_procurator,
    ');
    $this->db->from('requesters as r');
    $this->db->join('legal_person as l', 'l.id_requester = r.id', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = r.id', 'left');
    $this->db->join('procurator as p', 'p.id_requester = r.id', 'left');
    $this->db->where('r.completion_status', '1');
    $this->db->where('l.cpf', $posts['cpf_cnpj']);
    $this->db->or_where('j.cnpj', $posts['cpf_cnpj']);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_tenants($id){
    $this->db->select('t.id, t.id_requirement,
    rq.type_requester,
    l.name as legal_name, l.cpf, l.rg, l.consignor_organ, l.profession, l.monthly_income, l.birth_date, l.gender, l.nationality, l.scholarity, l.mother_name, l.father_name, l.email as legal_email, l.phone as legal_phone, l.civil_status, l.marriage_regime, l.wedding_date, l.property_owner as property_owner_legal,
    s.name as name_spouse, s.nationality as nationality_spouse, s.profession as profession_spouse, s.mother_name as mother_name_spouse, s.father_name as father_name_spouse,
    s.cpf as cpf_spouse, s.rg as rg_spouse, s.name as name_spouse,
    s.monthly_income as monthly_income_spouse, s.property_owner, s.consignor_organ as consignor_organ_spouse,
    j.company_name, j.cnpj, j.activity_branch, j.type_street as type_street_juridical, j.public_place as public_place_juridical, j.number as number_juridical, j.complement as complement_juridical, j.neighborhood as neighborhood_juridical, j.city as city_juridical, j.cep as cep_juridical, j.uf as uf_juridical, j.country, j.monthly_invoicing, j.property_owner as property_owner_juridical,
    pr.name as name_procurator, pr.cpf as cpf_procurator, pr.rg as rg_procurator, pr.consignor_organ as consignor_organ_procurator, pr.profission as profission_procurator, pr.birth_date as birth_date_procurator, pr.gender as gender_procurator, pr.country as country_procurator, pr.email as email_procurator, pr.phone as phone_procurator,
    h.type_street as type_street_home, h.public_place as public_place_home, h.number as number_home, h.complement as complement_home, h.neighborhood as neighborhood_home, h.city as city_home, h.cep as cep_home, h.country as country_home, h.uf as uf_home,
    ');
    $this->db->from('tenants as t');
    $this->db->join('requesters as rq', 't.id_requester = rq.id', 'left');
    $this->db->join('legal_person as l', 'l.id_requester = t.id_requester', 'left');
    $this->db->join('spouse as s', 's.id_requester = rq.id', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = t.id_requester', 'left');
    $this->db->join('procurator as pr', 'pr.id_requester = t.id_requester', 'left');
    $this->db->join('home_address as h', 'h.id_requester = rq.id', 'left');
    $this->db->where('rq.completion_status', '1');
    $this->db->where('t.id_requirement', $id);
    $this->db->where('t.status', '1');
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_tenants_property_owner($id){
    $this->db->select('t.id, t.id_requirement,
    rq.type_requester,
    l.name as legal_name, l.cpf, l.rg, l.consignor_organ, l.profession, l.monthly_income, l.birth_date, l.gender, l.nationality, l.scholarity, l.mother_name, l.father_name, l.email as legal_email, l.phone as legal_phone, l.civil_status, l.marriage_regime, l.wedding_date, l.property_owner as property_owner_legal,
    s.name as name_spouse, s.nationality as nationality_spouse, s.profession as profession_spouse, s.mother_name as mother_name_spouse, s.father_name as father_name_spouse,
    s.cpf as cpf_spouse, s.rg as rg_spouse, s.name as name_spouse,
    s.monthly_income as monthly_income_spouse, s.property_owner, s.consignor_organ as consignor_organ_spouse,
    j.company_name, j.cnpj, j.activity_branch, j.type_street as type_street_juridical, j.public_place as public_place_juridical, j.number as number_juridical, j.complement as complement_juridical, j.neighborhood as neighborhood_juridical, j.city as city_juridical, j.cep as cep_juridical, j.uf as uf_juridical, j.country, j.monthly_invoicing, j.property_owner as property_owner_juridical,
    pr.name as name_procurator, pr.cpf as cpf_procurator, pr.rg as rg_procurator, pr.consignor_organ as consignor_organ_procurator, pr.profission as profission_procurator, pr.birth_date as birth_date_procurator, pr.gender as gender_procurator, pr.country as country_procurator, pr.email as email_procurator, pr.phone as phone_procurator,
    h.type_street as type_street_home, h.public_place as public_place_home, h.number as number_home, h.complement as complement_home, h.neighborhood as neighborhood_home, h.city as city_home, h.cep as cep_home, h.country as country_home, h.uf as uf_home,
    ');
    $this->db->from('tenants as t');
    $this->db->join('requesters as rq', 't.id_requester = rq.id', 'left');
    $this->db->join('legal_person as l', 'l.id_requester = t.id_requester', 'left');
    $this->db->join('spouse as s', 's.id_requester = rq.id', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = t.id_requester', 'left');
    $this->db->join('procurator as pr', 'pr.id_requester = t.id_requester', 'left');
    $this->db->join('home_address as h', 'h.id_requester = rq.id', 'left');
    $this->db->where('rq.completion_status', '1');
    $this->db->where('l.property_owner', '1');
    $this->db->or_where('j.property_owner', '1');
    $this->db->where('t.id_requirement', $id);
    $this->db->where('t.status', '1');
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_monthly_income_tenants($id){
    $this->db->select('sum(l.monthly_income) as monthly_income, sum(j.monthly_invoicing) as monthly_invoicing');
    $this->db->from('tenants as t');
    $this->db->join('requesters as rq', 't.id_requester = rq.id', 'left');
    $this->db->join('legal_person as l', 'l.id_requester = t.id_requester', 'left');
    $this->db->join('juridical_person as j', 'j.id_requester = t.id_requester', 'left');
    $this->db->join('procurator as p', 'p.id_requester = t.id_requester', 'left');
    $this->db->where('rq.completion_status', '1');
    $this->db->where('t.id_requirement', $id);
    $this->db->where('t.status', '1');
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_confrotants_property($id){
    $this->db->select('c.id, c.name, c.cpf, c.birth_date, c.confrontation_direction,
    ');
    $this->db->from('confrotants_property as c');
    $this->db->join('requirements as rq', 'c.id_property = rq.id_property', 'left');
    $this->db->where('rq.id', $id);
    $query = $this->db->get();
    return $query->result();
  }

  public function isset_confrotants($posts){
    $this->db->select('c.id, c.name, c.cpf, c.birth_date');
    $this->db->from('confrotants_property as c');
    // $this->db->join('requirements as rq', 'c.id_property = rq.id_property');
    $this->db->where('c.cpf', $posts['cpf']);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_city_hall($id){
    $this->db->select('e.id, e.status');
    $this->db->from('entity as e');
    $this->db->where('e.id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function fetch_documents_entity_physical(){
    $this->db->select('id, description, status, type');
    $this->db->from('checklist_documentos_prefeitura');
    $this->db->where('id_entity', $_SESSION['user']['id_entity']);
    $this->db->where('status', 1);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_status_topographic_survey(){
    $this->db->select('id, description');
    $this->db->from('status_topographic_survey');
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_topographic_survey($id){
    $this->db->select('t.id, t.id_requester, t.id_topographic_survey, t.activation_date, t.status, s.description');
    $this->db->from('topographic_survey as t');
    $this->db->join('status_topographic_survey as s', 't.id_topographic_survey = s.id');
    $this->db->where('t.id_requester', $id);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_protocol_history($id){
    $this->db->select('p.id, p.responsible, p.reason, p.status, p.register, u.name');
    $this->db->from('protocol_history as p');
    $this->db->join('users as u', 'u.id = p.responsible');
    $this->db->where('p.id_entity', $_SESSION['user']['id_entity']);
    $this->db->where('p.id_protocol', $id);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_requester_history($id){
    $this->db->select('r.id, r.responsible, r.reason, r.status, r.register,
      u.name,
    ');
    $this->db->from('requester_history as r');
    $this->db->join('users as u', 'u.id = r.responsible');
    $this->db->where('r.id_entity', $_SESSION['user']['id_entity']);
    $this->db->where('r.id_requester', $id);
    $query = $this->db->get();
    return $query->result();
  }

  public function fetch_requester_requester_history($id){
    $this->db->select('
      ph.id, ph.id_protocol, ph.responsible, ph.reason, ph.status, ph.register,
      pr.date_requester, pr.process_number, pr.stage, pr.core_name,
    ');
    $this->db->from('protocol_history as ph');
    $this->db->join('requirements as r', 'r.id = ph.id_protocol');
    $this->db->join('procedure_reurb as pr', 'r.id_procedure = pr.id', 'left');
    $this->db->join('property_details as pd', 'r.id_property = pd.id');
    $this->db->join('requesters as rq', 'pd.id_requester = rq.id', 'left');
    $this->db->where('rq.id', $id);
    $this->db->where('ph.status', '1');
    $this->db->where('ph.id_entity', $_SESSION['user']['id_entity']);
    $this->db->order_by('ph.id', 'DESC');
    // $this->db->order_by('rq.id', 'DESC');
    // $this->db->order_by('ph.id_protocol', 'DESC');
    $this->db->group_by('ph.id_protocol');
    $query = $this->db->get();
    return $query->result();
  }

  // public function fetch_requester_protocol_history($id){
  //   $this->db->select('
  //     ph.id, ph.id_protocol, ph.responsible, ph.reason, ph.status, ph.register,
  //     pr.date_requester, pr.process_number, pr.stage, pr.core_name,
  //   ');
  //   $this->db->from('protocol_history as ph');
  //   $this->db->join('requirements as r', 'r.id = ph.id_protocol');
  //   $this->db->join('procedure_reurb as pr', 'r.id_procedure = pr.id', 'left');
  //   $this->db->join('property_details as pd', 'r.id_property = pd.id');
  //   $this->db->join('requesters as rq', 'pd.id_requester = rq.id', 'left');
  //   $this->db->where('rq.id', $id);
  //   $this->db->where('ph.status', '1');
  //   $this->db->where('ph.id_entity', $_SESSION['user']['id_entity']);
  //   $this->db->order_by('ph.id', 'DESC');
  //   // $this->db->order_by('rq.id', 'DESC');
  //   // $this->db->order_by('ph.id_protocol', 'DESC');
  //   $this->db->group_by('ph.id_protocol');
  //   $query = $this->db->get();
  //   return $query->result();
  // }

}
