<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

class Forms extends CI_Controller
{
  public $user;

  private $uploads_path;
  private $uploads_url;

  private $url;

  public function __construct()
  {
    parent::__construct();

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
    $this->load->model('requesters_model');
    $this->load->model('procedure_reurb_model');
    $this->load->model('property_registration_model');
    $this->load->model('entity_model');
    $this->load->model('commission_members_model');

    if ($_SERVER['HTTP_HOST'] == "localhost") {
      $this->uploads_path = FCPATH . "phpword\\";
      $this->uploads_url  = "http://localhost/uploads/sisreurb";
     } else {
      $this->uploads_path = dirname(__DIR__) . "/uploads/vistoria";
      $this->uploads_url  = "https://docs.capitalri.com.br/vistoria";
    }

    // Pegando a url atual e colocando em uma variavel
    $allowed_domains = array(
      'homolog.sisreurb.com.br', 'www.homolog.sisreurb.com.br',
      'sisreurb.com.br', 'www.sisreurb.com.br',
    );
    $development_domain  = 'localhost/sisreurb';

    $domain = $development_domain;
    if (in_array($_SERVER['HTTP_HOST'], $allowed_domains, TRUE)) {
      $domain = $_SERVER['HTTP_HOST'];
    }

    $url = 'http://' . $domain . '/';
    if (!empty($_SERVER['HTTPS'])) {
      $url = 'https://' . $domain . '/';
    }

    $this->url = $url;
  }

  public function index()
  {
    $data['error']   = (isset($_SESSION['error']) ? $_SESSION['error'] : '');
    //$this->load->view('dashboard');
  }

  private function current_date(){
    $month = ['meses', 'janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'];
    foreach ($month as $key => $value) {
      if (date('n') == $key) {
        $date_full = $value;
      }
    }
    return date('d').' de '.$date_full.' de '.date('Y');
  }

  private function conversion_state($key){
    $estadosBrasileiros = array('AC'=>'Acre', 'AL'=>'Alagoas', 'AP'=>'Amapá',
      'AM'=>'Amazonas', 'BA'=>'Bahia', 'CE'=>'Ceará', 'DF'=>'Distrito Federal',
      'ES'=>'Espírito Santo', 'GO'=>'Goiás', 'MA'=>'Maranhão', 'MT'=>'Mato Grosso',
      'MS'=>'Mato Grosso do Sul', 'MG'=>'Minas Gerais', 'PA'=>'Pará', 'PB'=>'Paraíba',
      'PR'=>'Paraná', 'PE'=>'Pernambuco', 'PI'=>'Piauí', 'RJ'=>'Rio de Janeiro',
      'RN'=>'Rio Grande do Norte', 'RS'=>'Rio Grande do Sul', 'RO'=>'Rondônia',
      'RR'=>'Roraima', 'SC'=>'Santa Catarina', 'SP'=>'São Paulo', 'SE'=>'Sergipe', 'TO'=>'Tocantins'
    );

    return $estadosBrasileiros[$key];
  }

  /********************************************
    // Esta função Formata um numero para extenso
  ********************************************/
  public function valorPorExtenso($valor=0) {
    $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
    $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");

    $c = array("", "cem", "duzentos", "trezentos", "quatrocentos","quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
    $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta","sessenta", "setenta", "oitenta", "noventa");
    $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze","dezesseis", "dezesete", "dezoito", "dezenove");
    $u = array("", "um", "dois", "três", "quatro", "cinco", "seis","sete", "oito", "nove");

    $z=0;
    $rt='';
    // $rt=$valor;
    $valor = number_format($valor, 2, ".", ".");
    $inteiro = explode(".", $valor);
    for($i=0;$i<count($inteiro);$i++)
        for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
            $inteiro[$i] = "0".$inteiro[$i];

    // $fim identifica onde que deve se dar junção de centenas por "e" ou por ","
    $fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
    for ($i=0;$i<count($inteiro);$i++) {
        $valor = $inteiro[$i];
        $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
        $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
        $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

        $r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd && $ru) ? " e " : "").$ru;
        $t = count($inteiro)-1-$i;
        $r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
        if ($valor == "000")$z++; elseif ($z > 0) $z--;
        if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t];
        if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
    }

    return(isset($rt) ? $rt : "zero");
  }

  public static function removerFormatacaoNumero( $strNumero )
  {
    $strNumero = trim(str_replace("R$", null, $strNumero));

    $vetVirgula = explode(",", $strNumero);
    if (count($vetVirgula) == 1)
    {
      $acentos = array(".");
      $resultado = str_replace($acentos, "", $strNumero);
      return $resultado;
    }
    else if ( count( $vetVirgula ) != 2 )
    {
        return $strNumero;
    }

    $strNumero = $vetVirgula[0];
    $strDecimal = mb_substr( $vetVirgula[1], 0, 2 );

    $acentos = array(".");
    $resultado = str_replace( $acentos, "", $strNumero );
    $resultado = $resultado . "." . $strDecimal;

    return $resultado;
  }

  /********************************************
    // Esta função Formata um numero para extenso
  ********************************************/
  public static function areaPorExtenso($valor = 0, $bolExibirMoeda = true, $bolPalavraFeminina = false)
  {
    $valor = self::removerFormatacaoNumero($valor);

    $singular = null;
    $plural = null;

    if ($bolExibirMoeda)
    {
      $singular = array("decímetros", "metro", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
      $plural = array("decímetros", "metros", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
    }
    else
    {
      $singular = array("", "", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
      $plural = array("", "", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
    }

    $c = array("", "cem", "duzentos", "trezentos", "quatrocentos","quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
    $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta","sessenta", "setenta", "oitenta", "noventa");
    $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze","dezesseis", "dezessete", "dezoito", "dezenove");
    $u = array("", "um", "dois", "três", "quatro", "cinco", "seis","sete", "oito", "nove");


    if ($bolPalavraFeminina)
    {
      if ($valor == 1)
      {
        $u = array("", "uma", "duas", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
      }
      else
      {
        $u = array("", "um", "duas", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
      }

      $c = array("", "cem", "duzentas", "trezentas", "quatrocentas","quinhentas", "seiscentas", "setecentas", "oitocentas", "novecentas");
    }

    $z = 0;

    $valor = number_format( $valor, 2, ".", "." );
    $inteiro = explode( ".", $valor );

    for ( $i = 0; $i < count( $inteiro ); $i++ )
    {
      for ( $ii = mb_strlen( $inteiro[$i] ); $ii < 3; $ii++ )
      {
        $inteiro[$i] = "0" . $inteiro[$i];
      }
    }

    // $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
    $rt = null;
    $fim = count($inteiro) - ($inteiro[count($inteiro) - 1] > 0 ? 1 : 2);
    for ($i = 0; $i < count($inteiro); $i++)
    {
      $valor = $inteiro[$i];
      $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
      $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
      $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

      $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd && $ru) ? " e " : "") . $ru;
      $t = count( $inteiro ) - 1 - $i;
      $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
      if ($valor == "000")
        $z++;
      elseif ($z > 0)
        $z--;

      if (($t == 1) && ($z > 0) && ($inteiro[0] > 0))
          $r .= ( ($z > 1) ? " de " : "") . $plural[$t];

      if ($r)
        $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
    }

    $rt = mb_substr($rt, 1);

    return($rt ? trim($rt) : "zero");
  }

  public function initiating_decision(){
    \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);

    $temp_file = $this->uploads_path."decisao_instauradora.docx";
    $document = new TemplateProcessor(FCPATH . 'docs/decisao_instauradora.docx');

    $entity = $this->entity_model->fetch_entity();
    $members_commission = $this->entity_model->fetch_members_commission();
		$notarys_office = $this->entity_model->fetch_notarys_office();

    $process_number = $this->procedure_reurb_model->fetch_process_number($_POST['process_number']);

    $name = (!empty($process_number->legal_name)) ? $process_number->legal_name : $process_number->name_procurator;
    $current_date = $this->current_date();

    $type_property = '(X) Imóvel Privado ou (X) Imóvel Público';
    if ($process_number->type_property == 'público') {
      $type_property = '(  ) Imóvel Privado ou (X) Imóvel Público';
    }
    if ($process_number->type_property == 'privado') {
      $type_property = '(X) Imóvel Privado ou (  ) Imóvel Público';
    }

    $document->setImageValue('image', $this->url.'admin/assets/build/img/profile_city_hall/'.$entity->img);
    $document->setValue("entity", $entity->name_entity);
    $document->setValue("uf", $entity->uf);
    $document->setValue("public_place", $entity->public_place);
    $document->setValue("address", $entity->address);
    $document->setValue("number", $entity->number);
    $document->setValue("complement", $entity->complement);
    $document->setValue("neighborhood", $entity->neighborhood);
    $document->setValue("city", $entity->city);
    $document->setValue("phone", $entity->phone);
    $document->setValue("site", $entity->site_entity);
    $document->setValue("name_entity", $entity->name);
    $document->setValue("profission_entity", $entity->profission);

    $document->cloneBlock("block_members_commission", count($members_commission), true, true);
    $count = 0;
    foreach ($members_commission as $key => $value) {
      $count++;
      $document->setValue("order#".$count, $count);
      $document->setValue("name_members#".$count, $value->name);
      $document->setValue("nationality_members#".$count, $value->nationality);
      $document->setValue("profission_members#".$count, $value->profission);
      $document->setValue("rg_members#".$count, $value->rg);
      $document->setValue("cpf_members#".$count, $value->cpf);
    }

    $today = date('d_m_Y');
    $document->setValue("hoje", $today);
    $document->setValue("core_name", $process_number->core_name);
    $document->setValue("original_registration", $process_number->original_registration);
    $document->setValue("city_property", $process_number->city_property);
    $document->setValue("uf_property", $process_number->uf_property);
    $document->setValue("reurb", $process_number->modality);
    $document->setValue("name", $name);
    $document->setValue("current_date", $current_date);
    $document->setValue("type_property", $type_property);

    $file_name = "decisao_instauradora_".$today;
    header("Content-Disposition: attachment; filename=".$file_name.".doc");
    $document->saveAs('php://output');
  }

  public function simple_requirement(){
    \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);

    $temp_file = $this->uploads_path."requerimento_simples_sisreurb.docx";
    $document = new TemplateProcessor(FCPATH . 'docs/requerimento_simples_sisreurb.docx');

    $entity = $this->entity_model->fetch_entity();
    $document->setValue("name_entity", $entity->name);
    $document->setValue("city_entity", $entity->city);
    $document->setValue("uf_entity", $entity->uf);
    $document->setValue("profission_entity", $entity->profission);

    $commission_member = $this->commission_members_model->isset_mayor();
    $document->setValue("member_name", $commission_member->name);
    // var_dump($commission_member);
    // die;

    $requester = $this->requesters_model->fetch_requester($_POST['id_requester']);
    $profession = (!empty($requester->legal_profession))? $requester->legal_profession : $requester->legal_profession;
    $nationality = (!empty($requester->legal_nationality))? $requester->legal_nationality : $requester->legal_nationality;
    $civil_status = (!empty($requester->legal_civil_status))? $requester->legal_civil_status : $requester->legal_civil_status;
    $name = (!empty($requester->legal_name))? $requester->legal_name : $requester->legal_name;
    $birth_date = (!empty($requester->birth_date))? $requester->birth_date : $requester->birth_date;
    $rg = (!empty($requester->legal_rg))? $requester->legal_rg : $requester->legal_rg;
    $consignor_organ = (!empty($requester->legal_consignor_organ))? $requester->legal_consignor_organ : $requester->legal_consignor_organ;
    $cpf = (!empty($requester->legal_cpf))? $requester->legal_cpf : $requester->legal_cpf;

    $document->setValue("profission_requester", $profession);
    $document->setValue("nationality_requester", $nationality);
    $document->setValue("civil_status", $civil_status);
    $document->setValue("name_requester", $name);
    $document->setValue("birth_date", $birth_date);
    $document->setValue("rg", $rg);
    $document->setValue("consignor_organ", $consignor_organ);
    $document->setValue("cpf_requester", $cpf);
    $document->setValue("place_property", $requester->place_property);
    $document->setValue("street_property", $requester->street_property);
    $document->setValue("city_requester", $requester->city_property);
    $document->setValue("uf_requester", $requester->uf_property);
    $document->setValue("phone_requester", $requester->legal_phone);

    $day = date('d/m/Y');
    $document->setValue("today", $day);

    $today = date('d_m_Y');
    $file_name = "requerimento_simples_sisreurb".$today;
    header("Content-Disposition: attachment; filename=".$file_name.".doc");
    $document->saveAs('php://output');
  }

  public function isset_cpf_cnpj()
	{
		$posts = $this->security->xss_clean($this->input->post());

		$return = $this->requesters_model->cpf_cnpj($posts);

		$this->users_model->insert_queries_logs();
		echo json_encode($return);
	}

  public function notification(){
    $posts = $this->security->xss_clean($this->input->post());
    $this->notification_word($posts);

//    if ($_POST['notification_type'] == "União") {
//      $response = $this->unity($posts);
////      var_dump($response);
//    } else if ($_POST['notification_type'] == "Estado") {
//      $response = $this->state($posts);
//    } else if ($_POST['notification_type'] == "Confrontantes do Núcleo(Proprietário de Domínio)") {
//      $response = $this->private($posts);
//    } else {
//      redirect(base_url().'process_sanitation');
//    }
  }

  private  function notification_word($posts)
  {
    $temp_file = $this->uploads_path."notificacao_imovel_privado_registrado.docx";
    $document = new TemplateProcessor(FCPATH . 'docs/notificacao_imovel_privado_registrado.docx');

    $entity = $this->entity_model->fetch_entity();
    $current_date = $this->current_date();

    $document->setValue("entity", $entity->name_entity);
    $document->setValue("uf_entity", $entity->uf);
    $document->setValue("city_entity", $entity->city);

    $document->setValue("address_entity", $entity->address);
    $document->setValue("number_entity", $entity->number);
    $document->setValue("neighborhood_entity", $entity->neighborhood);
    $document->setValue("city_entity", $entity->city);
    $document->setValue("uf_entity", $entity->uf);

    $procedure_reurb = $this->requesters_model->fetch_procedure($posts);
    $registration = $this->procedure_reurb_model->fetch_registration($_POST['id_notification']);
    $notary_office = $this->property_registration_model->fetch_notary_office($registration->id_notarys_office);
    $mayor = $this->commission_members_model->isset_mayor();
    $area = (empty($procedure_reurb->total_regularized_area)) ? 0.0 : $procedure_reurb->total_regularized_area;

    $document->setValue("owner", $registration->owner);
    $document->setValue("city_registration", $registration->country);
    $document->setValue("cep_registration", $registration->cep);
    $document->setValue("public_place_registration", $registration->public_place);
    $document->setValue("number_address_registration", $registration->number);
    $document->setValue("neigborhood_registration", $registration->neigborhood);
    $document->setValue("area", $area);
    $document->setValue("number_registration", $registration->number_registration);

    $document->setValue("comarca", $notary_office->judicial_district);
    $document->setValue('registration_officer', $mayor->name);
    $document->setValue('city_office', $notary_office->city);
    $document->setValue('uf_office', $notary_office->uf);

    $document->setValue('process_number', $procedure_reurb->process_number);
    $document->setValue('stage_procedure', $this->numberToRomanRepresentation($procedure_reurb->stage));
    $document->setValue('core_name', $procedure_reurb->core_name);
    $document->setValue("city_property", $registration->country);
    $document->setValue("uf_property", $registration->cep);
    $document->setValue("perimeter_description", $procedure_reurb->perimeter_description);

    $document->setValue("current_date", $current_date);

    $today = date('d_m_Y');
    $file_name = "notificacao_imovel_privado_registrado".$today;
    header("Content-Disposition: attachment; filename=".$file_name.".doc");
    $document->saveAs('php://output');
  }

  private function unity($posts){
    $temp_file = $this->uploads_path."notificacao_auto_demarcacao_ubarnistica_uniao.docx";
    $document = new TemplateProcessor(FCPATH . 'docs/notificacao_auto_demarcacao_ubarnistica_uniao.docx');

    $entity = $this->entity_model->fetch_entity();
    $current_date = $this->current_date();

    $document->setValue("entity", $entity->name_entity);
    $document->setValue("uf", $entity->uf);
    $document->setValue("city", $entity->city);

    $requirement = $this->requesters_model->fetch_requeriment($_POST['process_number']);

    $process_number = str_replace(".", "/", $requirement->process_number);
//     return $_POST['process_number'];
    $document->setValue("process_number", $process_number);
    $document->setValue("core_name", $requirement->core_name);

    $document->setValue("current_date", $current_date);
    $document->setValue("year", date('Y'));

    $members_commission = $this->entity_model->fetch_members_commission();
    $notarys_office = $this->entity_model->fetch_notarys_office();
    $document->setValue("georeferenced_property_area", $requirement->georeferenced_property_area);
    $document->setValue("core_name", $requirement->core_name);

    $document->setValue("process_number", $_POST['process_number']);

    $today = date('d_m_Y');
    $file_name = "notificacao_auto_demarcacao_ubarnistica_uniao_".$today;
    header("Content-Disposition: attachment; filename=".$file_name.".doc");
    $document->saveAs('php://output');
  }

  public function state(){
    $temp_file = $this->uploads_path."notificacao_auto_demarcacao_ubarnistica_estado.docx";
    $document = new TemplateProcessor(FCPATH . 'docs/notificacao_auto_demarcacao_ubarnistica_estado.docx');

    $entity = $this->entity_model->fetch_entity();
    $current_date = $this->current_date();

    $document->setValue("entity", $entity->name_entity);
    $document->setValue("uf", $entity->uf);
    $document->setValue("city", $entity->city);

    $requirement = $this->requesters_model->fetch_requeriment($_POST['process_number']);

    $process_number = str_replace(".", "/", $requirement->process_number);
    // return $process_number;
    $document->setValue("process_number", $process_number);
    $document->setValue("core_name", $requirement->core_name);

    $document->setValue("current_date", $current_date);
    $document->setValue("year", date('Y'));

    $members_commission = $this->entity_model->fetch_members_commission();
    $notarys_office = $this->entity_model->fetch_notarys_office();
    $document->setValue("georeferenced_property_area", $requirement->georeferenced_property_area);
    $document->setValue("core_name", $requirement->core_name);

    $document->setValue("process_number", $_POST['process_number']);

    $today = date('d_m_Y');
    $file_name = "notificacao_auto_demarcacao_ubarnistica_estado_".$today;
    header("Content-Disposition: attachment; filename=".$file_name.".doc");
    $document->saveAs('php://output');
  }

  public function private(){
    $temp_file = $this->uploads_path."notificacao_auto_demarcacao_ubarnistica_particulares.docx";
    $document = new TemplateProcessor(FCPATH . 'docs/notificacao_auto_demarcacao_ubarnistica_particulares.docx');

    $entity = $this->entity_model->fetch_entity();
    $current_date = $this->current_date();

    $document->setValue("entity", $entity->name_entity);
    $document->setValue("uf", $entity->uf);
    $document->setValue("city", $entity->city);

    $requirement = $this->requesters_model->fetch_requeriment($_POST['process_number']);

    $process_number = str_replace(".", "/", $requirement->process_number);
    // return $process_number;
    $document->setValue("process_number", $process_number);
    $document->setValue("core_name", $requirement->core_name);

    $document->setValue("current_date", $current_date);
    $document->setValue("year", date('Y'));

    $members_commission = $this->entity_model->fetch_members_commission();
    $notarys_office = $this->entity_model->fetch_notarys_office();
    $document->setValue("georeferenced_property_area", $requirement->georeferenced_property_area);
    $document->setValue("core_name", $requirement->core_name);

    $document->setValue("process_number", $_POST['process_number']);

    $today = date('d_m_Y');
    $file_name = "notificacao_auto_demarcacao_ubarnistica_particulares_".$today;
    header("Content-Disposition: attachment; filename=".$file_name.".doc");
    $document->saveAs('php://output');
  }

  public function confronting(){
    if (isset($_POST['notification'])) {
      $posts = $this->security->xss_clean($this->input->post());

      $temp_file = $this->uploads_path."notificacao_auto_demarcacao_ubarnistica_particulares.docx";
      $document = new TemplateProcessor(FCPATH . 'docs/notificacao_auto_demarcacao_ubarnistica_particulares.docx');

      // $entity = $this->entity_model->fetch_entity();

      // $document->setImageValue('image', 'http://localhost/sisreurb/admin/assets/build/img/profile_city_hall/'.$entity->img);
      // $document->setValue("entity", $entity->name_entity);


      $today = date('d_m_Y');
      $file_name = "notificacao_auto_demarcacao_ubarnistica_particulares_".$today;
      header("Content-Disposition: attachment; filename=".$file_name.".doc");
      $document->saveAs('php://output');
    } else {
      redirect(base_url().'process_sanitation');
    }
  }

  public function request_for_reurb($id)
  {
    $data['requirement'] = $this->requesters_model->fetch_requeriment($id);
    if ($data['requirement']->embarkation == '1') {
      redirect(base_url().'reurb_conclusion');
    }
    $data['confrotants_property'] = $this->requesters_model->fetch_confrotants_property($id);
    $data['city_hall'] = $this->procedure_reurb_model->fetch_city_hall($data['requirement']->id_entity);
    $data['monthly_income_tenants'] = $this->requesters_model->fetch_monthly_income_tenants($id);
		$family = $this->requesters_model->fetch_family_members_requester($data['requirement']->id_requester);
		$data['monthly_income_total'] = $data['requirement']->monthly_income + $family['monthly_income_family'] + $data['requirement']->monthly_income_spouse + $data['monthly_income_tenants']->monthly_income + $data['monthly_income_tenants']->monthly_invoicing;
    $data['files_checklist'] = $this->procedure_reurb_model->fetch_files_checklist($data['requirement']->id);
		$data['checklist_not_send'] = $this->procedure_reurb_model->fetch_checklist_not_send($data['requirement']->id);
    $name_view = 'forms/request_for_reurb/'.$id;
    $this->users_model->insert_log_view($name_view);

    $this->users_model->insert_queries_logs();
    $this->load->view('forms/request_for_reurb', $data);
  }

  public function socioeconomic_register()
  {
    $name_view = 'forms/socioeconomic_register';
    $this->users_model->insert_log_view($name_view);

    $this->users_model->insert_queries_logs();
    $this->load->view('forms/socioeconomic_register');
  }

  public function socioeconomic_register_couple()
  {
    $name_view = 'forms/socioeconomic_register_couple';
    $this->users_model->insert_log_view($name_view);

    $this->users_model->insert_queries_logs();
    $this->load->view('forms/socioeconomic_register_couple');
  }

  public function occupants_register()
  {
    $name_view = 'forms/occupants_register';
    $this->users_model->insert_log_view($name_view);

    $this->users_model->insert_queries_logs();
    $this->load->view('forms/occupants_register');
  }

  public function occupants_register_couple()
  {
    $name_view = 'forms/occupants_register_couple';
    $this->users_model->insert_log_view($name_view);

    $this->users_model->insert_queries_logs();
    $this->load->view('forms/occupants_register_couple');
  }

  public function statement_of_confrontants($id)
  {
    $name_view = 'forms/statement_of_confrontants/'.$id;
    $this->users_model->insert_log_view($name_view);
    $temp_file = $this->uploads_path . "statement_of_confrontants.docx";
    $document = new TemplateProcessor(FCPATH . 'docs/statement_of_confrontants.docx');

    $confrotants_property = $this->requesters_model->fetch_confrotants_property($id);
    $requirement = $this->requesters_model->fetch_requeriment($id);
    $city_hall = $this->procedure_reurb_model->fetch_city_hall($requirement->id_entity);
    $entity = $this->entity_model->fetch_entity();

    $this->users_model->insert_queries_logs();
    if ($requirement->embarkation == '1') {
      redirect(base_url().'reurb_conclusion');
    }

    $document->setImageValue('image',  array(
        "path"          => $this->url . 'admin/assets/build/img/profile_city_hall/' . $entity->img,
        'width'         => 130,
        'height'        => 130,
    ));
    $document->setImageValue('image_logo', array(
      "path"          => $this->url . 'admin/assets/build/img/profile_city_hall/' . $entity->administration_logo,
      'width'         => 130,
      'height'        => 130,
    ));

    $document->setValue("entity", $entity->name_entity);
    switch ($entity->uf) {
      case "MG":
        $uf_extenso = "MINAS GERAIS";
        break;
      default:
        $uf_extenso = $entity->uf;
        break;
    }
    $document->setValue("uf_city_hall", $uf_extenso);
    $document->setValue("cnpj_city_hall", $entity->cnpj);
    $document->setValue("public_place", $entity->public_place);
    $document->setValue("address_city_hall", $entity->address);
    $document->setValue("cep_city_hall", $entity->cep);
    $document->setValue("number_city_hall", $entity->number);
    $document->setValue("complement", $entity->complement);
    $document->setValue("neighborhood_city_hall", $entity->neighborhood);
    $document->setValue("city_hall", $entity->city);
    $document->setValue("phone", $entity->phone);
    $document->setValue("site", $entity->site_entity);
    $document->setValue("name_entity", $entity->name);
    $document->setValue("profission_entity", $entity->profission);

    $name = (isset($requirement->company_name)) ? $requirement->company_name : $requirement->legal_name;
    $document->setValue("name_requester", $name);
    $document->setValue("modality", $requirement->modality);
    $document->setValue("street_property", $requirement->street_property);
    $document->setValue("place_property", $requirement->place_property);
    $document->setValue("number_property", $requirement->number_property);
    $document->setValue("neighborhood_property", $requirement->neighborhood_property);
    $document->setValue("furniture_registration", $requirement->furniture_registration);
    $document->setValue("sector", str_pad($requirement->sector, 2, '0', STR_PAD_LEFT));
    $document->setValue("stage", $requirement->stage);
    $document->setValue("city_block", str_pad($requirement->city_block, 2, '0', STR_PAD_LEFT));
    $document->setValue("allotment", str_pad($requirement->allotment, 2, '0', STR_PAD_LEFT));
    $document->setValue("georeferenced_property_area", $requirement->georeferenced_property_area);

    $document->cloneBlock("block_confrotants", count($confrotants_property), true, true);
    $count = 0;

    foreach ($confrotants_property as $row) {
      $count++;
      $date = '';
      if ($row->birth_date != '0000-00-00') {
        $date_created = date_create($row->birth_date);
        $date = date_format($date_created, 'd/m/Y');
      }

      $document->setValue("name#" . $count, $row->name);
      $document->setValue("cpf#" . $count, $row->cpf);
      $document->setValue("birth_date#" . $count, $date);
      $document->setValue("confrontation_direction#" . $count, $row->confrontation_direction);
      $document->setValue("count#" . $count, $count);
  }

    $today = date('d_m_Y');
    $file_name = "statement_of_confrontants" . $today;
    header("Content-Disposition: attachment; filename=" . $file_name . ".doc");
    $document->saveAs('php://output');
  }

  public function application_for_urban_demarcation()
  {
    $name_view = 'forms/application_for_urban_demarcation';
    $this->users_model->insert_log_view($name_view);

    $this->users_model->insert_queries_logs();
    $this->load->view('forms/application_for_urban_demarcation');
  }

  public function self_urban_demarcation()
  {
    $name_view = 'forms/self_urban_demarcation';
    $this->users_model->insert_log_view($name_view);

    $this->users_model->insert_queries_logs();
    $this->load->view('forms/self_urban_demarcation');
  }

  public function land_regularization_certificate()
  {
    if (isset($_POST['land_regularization_certificate'])) {
      \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);

      $posts = $this->security->xss_clean($this->input->post());

      $temp_file = $this->uploads_path."crf.docx";
      $document = new TemplateProcessor(FCPATH . 'docs/crf.docx');

      $entity = $this->entity_model->fetch_entity();
      $current_date = $this->current_date();

      $document->setValue("mayor", $entity->name);
      $uf = $this->conversion_state($entity->uf);
      $document->setValue("city", $entity->city);
      $document->setValue("uf", $uf);
      $document->setValue("uf_single", $uf);
      $document->setValue("today", $current_date);

      $requirement = $this->requesters_model->fetch_requeriment($_POST['process_number']);

      // $process_number = str_replace(".", "/", $requirement->process_number);
      // $document->setValue("process_number", $process_number);
      $document->setValue("process_number", $requirement->process_number.".".$requirement->stage.".".str_pad( $requirement->id , 3 , '0' , STR_PAD_LEFT));

      $document->setValue("modality", $_POST['modalidade']);
      $meses = [ 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
      $date=date_create($requirement->publication_procedure);
      $publication_procedure = date_format($date, 'd-m-Y');
      $arr = explode("-", $publication_procedure);
      $publication_procedure = $arr[0]." de ".$meses[(int)$arr[1]-1]. " de ".$arr[2];
      $document->setValue("publication_procedure", $publication_procedure);
      $document->setValue("core_name", $requirement->core_name);


      // verificar se está embargado para impedir de ser gerado

      $name_view = 'forms/land_regularization_certificate';
      $this->users_model->insert_log_view($name_view);

      $this->users_model->insert_queries_logs();

      $file_name = "CERTIDÃO DE REGULARIZAÇÃO FUNDIÁRIA".$current_date;
      header("Content-Disposition: attachment; filename=".$file_name.".doc");
      $document->saveAs('php://output');

      // $data['procedure_reurb'] = $this->procedure_reurb_model->fetch_process_number($data['requirement']->id_procedure);
      // // $data['procedure_reurb'] = $this->procedure_reurb_model->fetch_process_number(intval($posts['id_process']));
      // $data['city_hall'] = $this->procedure_reurb_model->fetch_city_hall($data['procedure_reurb']->id_entity);
      // $data['data_atual'] = date('d').' de '.date('F').' de '.date('Y');
      // $mes = ['meses', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
      // foreach ($mes as $key => $value) {
      //   if (date('n') == $key) {
      //     $mes_extenco = $value;
      //   }
      // }
      // $data['data_atual'] = date('d').' de '.$mes_extenco.' de '.date('Y');
      //
      // if ($data['requirement']->embarkation == '1') {
      //   redirect(base_url().'reurb_conclusion');
      // }
      //
      // $this->load->view('forms/land_regularization_certificate', $data);
    }
  }

  public function decision_to_complete_urban_land_regularization()
  {
    if (isset($_POST['decision_to_complete_urban_land_regularization'])) {
      \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);

      $posts = $this->security->xss_clean($this->input->post());

      $temp_file = $this->uploads_path."decisao_conclusao_regularizacao_fundiaria_urbana.docx";
      $document = new TemplateProcessor(FCPATH . 'docs/decisao_conclusao_regularizacao_fundiaria_urbana.docx');

      $process_number = $this->procedure_reurb_model->fetch_process_number($_POST['process_number']);

      // var_dump($_POST['process_number']); die;
      // $requirement = $this->requesters_model->fetch_requeriment($_POST['process_number']);

      // var_dump($requirement->original_registration); die;

      // $process_number = str_replace(".", "/", $requirement->process_number);
      $document->setValue("process_number", $process_number->process_number.".".$process_number->stage);
      $document->setValue("modality", $process_number->modality);
      $document->setValue("core_name", $process_number->core_name);

      $document->setValue("type_property", $process_number->type_property);

      $document->setValue("original_registration", $process_number->original_registration);

      $document->setValue("property_registration_number", $process_number->property_registration_number);

      $area = $this->areaPorExtenso($process_number->total_regularized_area);
      $document->setValue("area", $area);
      $document->setValue("total_regularized_area", $process_number->total_regularized_area);

      $entity = $this->entity_model->fetch_entity();
      $current_date = $this->current_date();

      $document->setValue("mayor", $entity->name);
      $uf = $this->conversion_state($entity->uf);
      $document->setValue("city", $entity->city);
      $document->setValue("uf", $uf);
      $document->setValue("uf_single", $entity->uf);
      $document->setValue("today", $current_date);

      $notary_office = $this->entity_model->fetch_notary_office($_POST['cartorio']);
      // var_dump($notary_office->name_registry); die;
      $document->setValue("notary_office", $notary_office->name_registry);
      //
      //
      // $meses = [ 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
      // $date=date_create($requirement->publication_procedure);
      // $publication_procedure = date_format($date, 'd-m-Y');
      // $arr = explode("-", $publication_procedure);
      // $publication_procedure = $arr[0]." de ".$meses[(int)$arr[1]-1]. " de ".$arr[2];
      // $document->setValue("publication_procedure", $publication_procedure);


      // verificar se está embargado para impedir de ser gerado

      $name_view = 'forms/decision_to_complete_urban_land_regularization';
      $this->users_model->insert_log_view($name_view);

      $this->users_model->insert_queries_logs();

      $file_name = "decisao_conclusao_regularizacao_fundiaria_urbana".$current_date;
      header("Content-Disposition: attachment; filename=".$file_name.".doc");
      $document->saveAs('php://output');
    }

  }

  public function application_for_registration_of_land_regularization_certificate()
  {
    if (isset($_POST['application_registration_land'])) {
      $posts = $this->security->xss_clean($this->input->post());
      var_dump($posts['process_number']);
      die;
      $data['requirement'] = $this->requesters_model->fetch_requirement($posts);
      $data['procedure_reurb'] = $this->procedure_reurb_model->fetch_process_number($data['requirement']->id_procedure);

      // $data['procedure_reurb'] = $this->procedure_reurb_model->fetch_process_number(intval($posts['id_process_statement']));
      $data['city_hall'] = $this->procedure_reurb_model->fetch_city_hall($data['procedure_reurb']->id_entity);
      $data['notary_office'] = $this->property_registration_model->fetch_notary_office($posts['cartorio']);
      $mes = ['meses', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
      foreach ($mes as $key => $value) {
        if (date('n') == $key) {
          $mes_extenco = $value;
        }
      }
      $data['data_atual'] = date('d').' de '.$mes_extenco.' de '.date('Y');
      $name_view = 'forms/application_for_registration_of_land_regularization_certificate';
      $this->users_model->insert_log_view($name_view);

      $this->users_model->insert_queries_logs();
      if ($data['requirement']->embarkation == '1') {
        redirect(base_url().'reurb_conclusion');
      }

      $this->load->view('forms/application_for_registration_of_land_regularization_certificate', $data);
    }
  }

  public function individual_urban_land_legitimation()
  {
    if (isset($_POST['individual_urban_land_legitimation'])) {
      $posts = $this->security->xss_clean($this->input->post());

      // $data['procedure_reurb'] = $this->procedure_reurb_model->fetch_process_number(intval($posts['id_process_individual']));
      $data['requirement'] = $this->requesters_model->fetch_requirement($posts);
      $data['procedure_reurb'] = $this->procedure_reurb_model->fetch_process_number($data['requirement']->id_procedure);

      $venal = str_replace(".", "", $data['procedure_reurb']->venal);
      $venal_value = str_replace(",", ".", $venal);
      if (empty($venal_value)) {
        $venal_value = "0.00";
      }
      // var_dump($venal_value); die;
      $data['venal_extenco'] = $this->valorPorExtenso($venal_value);
      $data['venal'] = $venal_value;
      $data['enrollments_reached'] = $this->procedure_reurb_model->fetch_enrollments_reached_procedure($data['procedure_reurb']->id);
      $data['city_hall'] = $this->procedure_reurb_model->fetch_city_hall($data['procedure_reurb']->id_entity);
      $data['notary_office'] = $this->property_registration_model->fetch_notary_office($posts['cartorio']);
      $data['tenants'] = $this->requesters_model->fetch_tenants($data['requirement']->id);
      $mes = ['meses', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
      foreach ($mes as $key => $value) {
        if (date('n') == $key) {
          $mes_extenso = $value;
        }
      }
      $data['month'] = $mes;
      $data['data_atual'] = date('d').' de '.$mes_extenso.' de '.date('Y');
      $name_view = 'forms/individual_urban_land_legitimation';
      $this->users_model->insert_log_view($name_view);
      // var_dump($posts);
      // var_dump($posts);
      // die;

      $this->users_model->insert_queries_logs();
      if ($data['requirement']->embarkation == '1') {
        redirect(base_url().'reurb_conclusion');
      }
      // die;
      $this->load->view('forms/individual_urban_land_legitimation', $data);
    }
  }

  // if (isset($_POST['individual_urban_land_legitimation'])) {
  //   $posts = $this->security->xss_clean($this->input->post());

  //   // $data['procedure_reurb'] = $this->procedure_reurb_model->fetch_process_number(intval($posts['id_process_individual']));
  //   $data['requirement'] = $this->requesters_model->fetch_requirement($posts);
  //   $data['procedure_reurb'] = $this->procedure_reurb_model->fetch_process_number($data['requirement']->id_procedure);

  //   $venal = str_replace(".", "", $data['procedure_reurb']->venal);
  //   $venal_value = str_replace(",", ".", $venal);
  //   if (empty($venal_value)) {
  //     $venal_value = "0.00";
  //   }
  //   // var_dump($venal_value); die;
  //   $data['venal_extenco'] = $this->valorPorExtenso($venal_value);
  //   $data['venal'] = $venal_value;
  //   $data['enrollments_reached'] = $this->procedure_reurb_model->fetch_enrollments_reached_procedure($data['procedure_reurb']->id);
  //   $data['city_hall'] = $this->procedure_reurb_model->fetch_city_hall($data['procedure_reurb']->id_entity);
  //   $data['notary_office'] = $this->property_registration_model->fetch_notary_office($posts['cartorio']);
  //   $data['tenants'] = $this->requesters_model->fetch_tenants($data['requirement']->id);
  //   $mes = ['meses', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
  //   foreach ($mes as $key => $value) {
  //     if (date('n') == $key) {
  //       $mes_extenso = $value;
  //     }
  //   }
  //   $data['month'] = $mes;
  //   $data['data_atual'] = date('d') . ' de ' . $mes_extenso . ' de ' . date('Y');
  //   $name_view = 'forms/individual_urban_land_legitimation';
  //   $this->users_model->insert_log_view($name_view);
  //   // var_dump($posts);
  //   // var_dump($posts);
  //   // die;

  //   $this->users_model->insert_queries_logs();
  //   if ($data['requirement']->embarkation == '1') {
  //     redirect(base_url() . 'reurb_conclusion');
  //   }
  //   // die;
  //   $this->load->view('forms/individual_urban_land_legitimation', $data);
  // }

  /**
   * @param int $number
   * @return string
   */
  private function numberToRomanRepresentation($number)
  {
    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $returnValue = '';
    while ($number > 0) {
      foreach ($map as $roman => $int) {
        if ($number >= $int) {
          $number -= $int;
          $returnValue .= $roman;
          break;
        }
      }
    }
    return $returnValue;
  }

  public function legitimation_title()
  {
    if (isset($_POST['legitimation_title'])) {
      \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
      $posts = $this->security->xss_clean($this->input->post());

      $temp_file = $this->uploads_path."titulo_legitimacao.docx";
      $document = new TemplateProcessor(FCPATH . 'docs/titulo_legitimacao.docx');

      $requirement = $this->requesters_model->fetch_requirement($posts);
      $procedure_reurb = $this->procedure_reurb_model->fetch_process_number_legitimation_title($posts['process_number']);
      $tenants = $this->requesters_model->fetch_tenants($requirement->id);

			$family = $this->requesters_model->fetch_family_members_requester($requirement->id_requester);
      $monthly_income_tenants = $this->requesters_model->fetch_monthly_income_tenants($posts['process_number']);
      $monthly_income_total= $requirement->monthly_income + $family['monthly_income_family'] + $requirement->monthly_income_spouse + $requirement->federal_government_income_spouse + $requirement->federal_government_income + $monthly_income_tenants->monthly_income + $monthly_income_tenants->monthly_invoicing;

      $maximum_income = $this->requesters_model->fetch_maximum_family_income();
      $property_owner_tenants = $this->requesters_model->fetch_tenants_property_owner($requirement->id);

      $city_hall = $this->procedure_reurb_model->fetch_city_hall($procedure_reurb->id_entity);
      $notary_office = $this->property_registration_model->fetch_notary_office($posts['cartorio']);

      $property_owner = 'Não';
      if ($requirement->property_owner == '1' || $requirement->property_owner_legal == '1' || !empty($property_owner_tenants)) {
        $property_owner = 'Sim';
      }

      // var_dump($property_owner_tenants);
      // die;

      $modalidade = ($property_owner == 'Sim' || $monthly_income_total > $maximum_income['maximum_family_income'])? 'REURB-E': 'REURB-S';

      $venal_formated = str_replace(".", "", $procedure_reurb->venal);
      $venal_value = str_replace(",", ".", $venal_formated);
      if (empty($venal_value)) {
        $venal_value = "0.00";
      }

      $venal_extenco = $this->valorPorExtenso($venal_value);
      $end_date_create = date_create($procedure_reurb->end_date);
      $publication_procedure_create = date_create($procedure_reurb->publication_procedure);

      $mes = ['meses', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
      foreach ($mes as $key => $value) {
        if (date_format($end_date_create, 'm') == $key) {
          $mes_extenso_final = $value;
        }

        if (date_format($publication_procedure_create, 'm') == $key) {
          $mes_extenso_publicado = $value;
        }
      }
      // $data['month'] = $mes;
      // $data_atual = date('d').' de '.$mes_extenso.' de '.date('Y');
      $data_atual = $this->current_date();
      $end_date = date_format($end_date_create, 'd') . ' de ' . $mes_extenso_final . ' de ' . date_format($end_date_create, 'Y');
      $publication_procedure = date_format($publication_procedure_create, 'd') . ' de ' . $mes_extenso_publicado . ' de ' . date_format($publication_procedure_create, 'Y');

      if ($procedure_reurb->type_property == 'público') {
        $property = '( X ) Imóvel público  (  ) Imóvel privado (  ) Misto';
      } else if ($procedure_reurb->type_property == 'privado'){
        $property = '(  ) Imóvel público  ( X ) Imóvel privado (  ) Misto';
      } else {
        $property = '(  ) Imóvel público  (  ) Imóvel privado ( X ) Misto';
      }

      $name = (isset($procedure_reurb->legal_name))? $procedure_reurb->legal_name : $procedure_reurb->name_procurator;
      $cpf = (isset($procedure_reurb->cpf))? $procedure_reurb->cpf : $procedure_reurb->cpf_procurator;
      $rg = (isset($procedure_reurb->rg))? $procedure_reurb->rg : $procedure_reurb->rg_procurator;
      $nationality = (isset($procedure_reurb->nationality))? $procedure_reurb->nationality : $procedure_reurb->country_procurator;
      $profession = (isset($procedure_reurb->profession))? $procedure_reurb->profession : $procedure_reurb->profission_procurator;
      $consignor_organ = (isset($procedure_reurb->consignor_organ))? $procedure_reurb->consignor_organ : $procedure_reurb->consignor_organ_procurator;

      $wedding_date = date_create($procedure_reurb->wedding_date);
      $wedding_date = date_create($procedure_reurb->wedding_date);

      $text_requester = '';
      if ($procedure_reurb->civil_status != 'Casado(a)') {
        $text_requester .= $procedure_reurb->civil_status . ', ';
      }

      $text_requester .= 'nacionalidade '.$nationality . ', ' . $profession . ', filho(a) de ' . $procedure_reurb->mother_name . ' e ' . $procedure_reurb->father_name . ', portador(a)  do RG nº ' . $rg . ', órgão expedidor ' . $consignor_organ . ', e inscrito(a) no  CPF sob o nº ' . $cpf . ', ';

      $conjugue_name = '';
      $text_spouse = ' ';
      if ($procedure_reurb->civil_status == 'Casado(a)') {
        $text_requester .= ', '.$procedure_reurb->civil_status . ' em ' . date_format($wedding_date, 'd/m/Y') . ', sob o regime do casamento ' . $procedure_reurb->marriage_regime . ', tendo como cônjuge  ';
        $conjugue_name = ' '.$procedure_reurb->name_spouse;

        $text_spouse .= ', maior, nacionalidade ' . $procedure_reurb->nationality_spouse . ' ' . $procedure_reurb->profession_spouse . ', filho(a) de ' . $procedure_reurb->mother_name_spouse . ' e ' . $procedure_reurb->father_name_spouse;
        $text_spouse .= ' , portador(a)  do RG nº ' . $procedure_reurb->rg_spouse . ', órgão expedidor ' . $procedure_reurb->consignor_organ_spouse . ', e inscrito(a) no  CPF/MF sob o nº ' . $procedure_reurb->cpf_spouse . ', ';
        $text_spouse .= 'residentes e domiciliados na ' . $procedure_reurb->type_street_home . ' ' . $procedure_reurb->public_place_home . ', n° ' . $procedure_reurb->number_home . ', Bairro ' . $procedure_reurb->neighborhood_home . ', ' . $procedure_reurb->city_home . '-' . $procedure_reurb->uf_home . ', CEP ' . $procedure_reurb->cep_home;
      } else {
        $text_requester .= ', residente e domiciliado na ' . $procedure_reurb->type_street_home . ' ' . $procedure_reurb->public_place_home . ', n° ' . $procedure_reurb->number_home . ', Bairro ' . $procedure_reurb->neighborhood_home . ', ' . $procedure_reurb->city_home . '-' . $procedure_reurb->uf_home . ', CEP ' . $procedure_reurb->cep_home;
      }

      if (isset($procedure_reurb->cpf_procurator)) {
        $text_requester = 'nacionalidade ' . $nationality.', '.$profession.', portador(a)  do RG nº '.$rg.', órgão expedidor '.$consignor_organ.', e inscrito(a) no  CPF sob o nº '.$cpf.',
      	residente e domiciliado na '.$procedure_reurb->type_street_home.' '.$procedure_reurb->public_place_home.', n° '.$procedure_reurb->number_home.', Bairro '.$procedure_reurb->neighborhood_home.', '.$procedure_reurb->city_home.'-'.$procedure_reurb->uf_home.', CEP '.$procedure_reurb->cep_home;
      }

      $text_tenants = '';
      $document->cloneBlock("block_tenants", count($tenants), true, true);
      $count = 0;

      foreach ($tenants as $key => $value) {
        $count++;
        if ($value->civil_status == 'Casado(a)') {
          $wedding_date_tenants = date_create($value->wedding_date);;
          $text_tenants = ', nacionalidade ' . $value->nationality . ', ' . $value->profession . ', filho(a) de ' . $value->mother_name . ' e ' . $value->father_name . ', portador(a)  do RG nº ' . $value->rg . ', órgão expedidor ' . $value->consignor_organ . ', e inscrito(a) no  CPF/MF sob o nº ' . $value->cpf . ',
				' . $value->civil_status . ' em ' . date_format($wedding_date_tenants, 'd/m/Y') . ', sob o regime do casamento ' . $value->marriage_regime . ', tendo como cônjuge ' . $value->name_spouse . ', maior, nacionalidade ' . $value->nationality_spouse . ' ' . $value->profession_spouse . ', filho(a) de ' . $value->mother_name_spouse . '  e ' . $value->father_name_spouse . '
				, portador(a)  do RG nº ' . $value->rg_spouse . ', órgão expedidor ' . $value->consignor_organ_spouse . ', e inscrito(a) no  CPF/MF sob o nº ' . $value->cpf_spouse . ',
				 residentes e domiciliados na ' . $value->type_street_home . ' ' . $value->public_place_home . ', n° ' . $value->number_home . ', Bairro ' . $value->neighborhood_home . ', ' . $value->city_home . '-' . $value->uf_home . ', CEP ' . $value->cep_home.'. ';
        } else {
          $text_tenants = ',  ' . $value->nationality . ', ' . $value->civil_status . ', ' . $value->profession . ', portador(a)  do RG nº ' . $value->rg . ', órgão expedidor ' . $value->consignor_organ . ', e inscrito(a) no  CPF sob o nº ' . $value->cpf . ',
				filho(a) de ' . $value->mother_name . ' e ' . $value->father_name . ', residentes e domiciliados na ' . $value->type_street_home . ' ' . $value->public_place_home . ', n° ' . $value->number_home . ', Bairro ' . $value->neighborhood_home . ', ' . $value->city_home . '-' . $value->uf_home . ', CEP ' . $value->cep_home;
        }
        $document->setValue('name_tenants#' . $count, 'e ' . $value->legal_name);
        $document->setValue('text_tenants#' . $count, $text_tenants);

         if (isset($value->property_owner_legal)) {
            $legal = ($value->property_owner_legal == '1') ? 'Sim' : 'Não';
            if ($legal == 'Sim') {
              $property_owner_tenants = '1';
            }
          } else {
            $juridical = ($value->property_owner_juridical == '1') ? 'Sim' : 'Não';
            if ($juridical == 'Sim') {
              $property_owner_tenants = '1';
            }
          }
      }

      $area = 'zero metros';
      if (!empty($procedure_reurb->georeferenced_property_area)) {
        $area = $this->areaPorExtenso($procedure_reurb->georeferenced_property_area);
      }

      $document->setValue("type_property", $property);

      $document->setValue("city_hall", ucfirst($city_hall->city));
      switch ($city_hall->uf) {
        case "MG":
          $uf_extenso = "MINAS GERAIS";
          break;
        default:
          $uf_extenso = $city_hall->uf;
          break;
      }
      $document->setValue("uf_city_hall", $uf_extenso);
      $document->setValue("cnpj_city_hall", $city_hall->cnpj);

      $document->setValue("data_finalizado", $end_date);
      $document->setValue("data_publicado", $publication_procedure);

      $document->setValue("address_city_hall", $city_hall->address . ' ' . $city_hall->public_place);
      $document->setValue("number_city_hall", $city_hall->number);
      $document->setValue("neighborhood_city_hall", $city_hall->neighborhood);
      $document->setValue("cep_city_hall", $city_hall->cep);
      $document->setValue("name_entity", $city_hall->name_entity);
      $document->setValue("name_mayor", strtoupper($city_hall->name));

      $document->setValue("city_block", str_pad($procedure_reurb->city_block, 2, '0', STR_PAD_LEFT));
      $document->setValue("allotment", str_pad($procedure_reurb->allotment, 2, '0', STR_PAD_LEFT));
      $document->setValue("sector", str_pad($procedure_reurb->sector, 2, '0', STR_PAD_LEFT));
      $document->setValue("venal_value", number_format($venal_value, 2, ',', '.'));
      $document->setValue("venal_extenco", $venal_extenco);
      $document->setValue("data_atual", $data_atual);
      $document->setValue('process_number', $procedure_reurb->process_number);
      $document->setValue('stage', $this->numberToRomanRepresentation($procedure_reurb->stage));
      $document->setValue('core_name', $procedure_reurb->core_name);
      $document->setValue('name_registry', $notary_office->name_registry);
      $document->setValue('uf_notary_office', $notary_office->uf);
      $document->setValue('street_property', $procedure_reurb->street_property);
      $document->setValue('place_property', $procedure_reurb->place_property);
      $document->setValue('number_property', $procedure_reurb->number_property);
      $document->setValue('neighborhood_property', $procedure_reurb->neighborhood_property);
      $document->setValue('furniture_registration', $procedure_reurb->furniture_registration);
      $document->setValue('number_home', $procedure_reurb->number_home);
      $document->setValue('property_registration_number', $procedure_reurb->property_registration_number);
      $document->setValue('original_registration', $procedure_reurb->original_registration);
      $document->setValue('city_property', $procedure_reurb->city_property);

      $document->setValue('uf_property', $procedure_reurb->uf_property);
      $document->setValue('cep_property', $procedure_reurb->cep_property);

      $document->setValue("name_requester", $name);
      $document->setValue("text_requester", $text_requester);
      $document->setValue("conjugue_name", $conjugue_name);
      $document->setValue("text_spouse", $text_spouse);

      $property_owner = 'Não';
      if ($requirement->property_owner == '1' || $requirement->property_owner_legal == '1' || $property_owner_tenants == '1') {
        $property_owner = 'Sim';
      }

      $modalidade = ($property_owner == 'Sim' || $monthly_income_total > floatval($maximum_income['maximum_family_income'])) ? 'REURB-E' : 'REURB-S';

      $document->setValue("modality_process", $modalidade);
      $document->setValue('modality', $procedure_reurb->modality);

      $text_modality_one = 'I.	em caso de imóvel urbano com finalidade não residencial, seja reconhecido pelo poder público o interesse público de sua ocupação.';
      $text_modality_two = '';
      $text_modality_three = '';
      if ($modalidade == 'REURB-S') {
        $text_modality_one = 'I.	o beneficiário não seja concessionário, foreiro ou proprietário de imóvel urbano ou rural;';
        $text_modality_two = 'II.	o beneficiário  não tenha sido contemplado com legitimação de posse ou fundiária de imóvel urbano com a mesma finalidade, ainda que situado em núcleo urbano distinto; e';
        $text_modality_three = 'III.	em caso de imóvel urbano com finalidade não residencial, seja reconhecido pelo poder público o interesse público de sua ocupação.';
      }
      $document->setValue("text_modality_one", $text_modality_one);
      $document->setValue("text_modality_two", $text_modality_two);
      $document->setValue("text_modality_three", $text_modality_three);

      $document->setValue("georeferenced_property_area_extenso", $area.' quadrados');
      $document->setValue("georeferenced_property_area", (empty($procedure_reurb->georeferenced_property_area))? '0' : $procedure_reurb->georeferenced_property_area);

      $document->setImageValue('image',  array(
        "path"          => $this->url . 'admin/assets/build/img/profile_city_hall/' . $city_hall->img,
        'width'         => 130,
        'height'        => 130,
      ));
      $document->setImageValue('image_logo', array(
        "path"          => $this->url . 'admin/assets/build/img/profile_city_hall/' . $city_hall->administration_logo,
        'width'         => 130,
        'height'        => 130,
      ));

      // verificar se está embargado para impedir de ser gerado
      if ($requirement->embarkation == '1') {
        $error = array();
  			$error['error']['error_string']	= 'Protocolo em embargo, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
  			$error['error']['error_type'] = 'danger'; // Warning | success | danger
  			$this->session->set_flashdata($error);
        redirect(base_url().'procedure_reurb/detail/'.$requirement->id_procedure);
        exit();
      }
      $current_date = $this->current_date();
      $file_name = "titulo_legitimacao".$current_date;
      header("Content-Disposition: attachment; filename=".$file_name.".doc");
      $document->saveAs('php://output');
    }
  }

  public function generateLegitimationTitle()
  {
    if (isset($_POST['generateLegitimationTitle'])) {
      \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
      $posts = $this->security->xss_clean($this->input->post());

      $temp_file = $this->uploads_path."generateLegitimationTitle.docx";
      $document = new TemplateProcessor(FCPATH . 'docs/generateLegitimationTitle.docx');

      $modality = $posts['modalidade'];

		  $process_number = $this->procedure_reurb_model->fetch_process_number($posts['process_number']);
      $requirements = $this->requesters_model->fetch_generate_requirements_modality($process_number->process_number, $modality);

      $city_hall = $this->procedure_reurb_model->fetch_city_hall($_SESSION['user']['id_entity']);
      $notary_office = $this->property_registration_model->fetch_notary_office($posts['cartorio']);

      $document->cloneBlock("block_requeriments", count($requirements), true, true);
      $count = 0;

      foreach ($requirements as $row) {
        $count++;
        $posts['process_number'] = $row->id_procedure;
        $requirement = $row;
        // $requirement = $this->requesters_model->fetch_requirement_procedure($posts);
        // var_dump($requirement);
        // die;

        $procedure_reurb = $this->procedure_reurb_model->fetch_process_number_legitimation_title($requirement->id);
        $tenants = $this->requesters_model->fetch_tenants($requirement->id);

        $family = $this->requesters_model->fetch_family_members_requester($row->id_requester);
        $monthly_income_tenants = $this->requesters_model->fetch_monthly_income_tenants($posts['process_number']);
        $monthly_income_total = $requirement->monthly_income + $family['monthly_income_family'] + $requirement->monthly_income_spouse + $requirement->federal_government_income_spouse + $requirement->federal_government_income + $monthly_income_tenants->monthly_income + $monthly_income_tenants->monthly_invoicing;

        $maximum_income = $this->requesters_model->fetch_maximum_family_income();
        $property_owner_tenants = $this->requesters_model->fetch_tenants_property_owner($requirement->id);

        $city_hall = $this->procedure_reurb_model->fetch_city_hall($_SESSION['user']['id_entity']);
        $notary_office = $this->property_registration_model->fetch_notary_office($posts['cartorio']);

        $property_owner = 'Não';
        if ($requirement->property_owner == '1' || $requirement->property_owner_legal == '1' || !empty($property_owner_tenants)) {
          $property_owner = 'Sim';
        }

        $modalidade = ($property_owner == 'Sim' || $monthly_income_total > $maximum_income['maximum_family_income']) ? 'REURB-E' : 'REURB-S';

        $venal_formated = str_replace(".", "", $procedure_reurb->venal);
        $venal_value = str_replace(",", ".", $venal_formated);
        if (empty($venal_value)) {
          $venal_value = "0.00";
        }

        $venal_extenco = $this->valorPorExtenso($venal_value);
        $end_date_create = date_create($procedure_reurb->end_date);
        $publication_procedure_create = date_create($procedure_reurb->publication_procedure);

        $mes = ['meses', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
        foreach ($mes as $key => $value) {
          if (date('n') == $key) {
            $mes_extenso = $value;
          }

          if (date_format($end_date_create, 'm') == $key) {
            $mes_extenso_final = $value;
          }

          if (date_format($publication_procedure_create, 'm') == $key) {
            $mes_extenso_publicado = $value;
          }
        }
        $data['month'] = $mes;
        $data_atual = date('d') . ' de ' . $mes_extenso . ' de ' . date('Y');

        $end_date = date_format($end_date_create, 'd'). ' de ' . $mes_extenso_final . ' de ' . date_format($end_date_create, 'Y');
        $publication_procedure = date_format($publication_procedure_create, 'd'). ' de ' . $mes_extenso_publicado . ' de ' . date_format($publication_procedure_create, 'Y');

        $property = ($procedure_reurb->type_property == 'público') ? '( X ) Imóvel público  (  ) imóvel privado' : '(  ) Imóvel público  ( X ) imóvel privado';

        $name = (isset($procedure_reurb->legal_name)) ? $procedure_reurb->legal_name : $procedure_reurb->name_procurator;
        $cpf = (isset($procedure_reurb->cpf)) ? $procedure_reurb->cpf : $procedure_reurb->cpf_procurator;
        $rg = (isset($procedure_reurb->rg)) ? $procedure_reurb->rg : $procedure_reurb->rg_procurator;
        $nationality = (isset($procedure_reurb->nationality)) ? $procedure_reurb->nationality : $procedure_reurb->country_procurator;
        $profession = (isset($procedure_reurb->profession)) ? $procedure_reurb->profession : $procedure_reurb->profission_procurator;
        $consignor_organ = (isset($procedure_reurb->consignor_organ)) ? $procedure_reurb->consignor_organ : $procedure_reurb->consignor_organ_procurator;

        $wedding_date = date_create($procedure_reurb->wedding_date);
        $wedding_date = date_create($procedure_reurb->wedding_date);

        $text_requester = 'nacionalidade ' . $nationality . ', ' . $profession. ', filho(a) de ' . $procedure_reurb->mother_name . ' e ';
        $text_requester .= $procedure_reurb->father_name . ', portador(a)  do RG nº ' . $rg . ', órgão expedidor ' . $consignor_organ . ', e inscrito(a) no  CPF sob o nº ' . $cpf . ', ';

        $conjugue_name = '';
        $text_spouse = ' ';
        if ($procedure_reurb->civil_status == 'Casado(a)') {
          $text_requester .= ', ' . $procedure_reurb->civil_status . ' em ' . date_format($wedding_date, 'd/m/Y') . ', sob o regime do casamento ' . $procedure_reurb->marriage_regime . ', tendo como cônjugue  ';
          $conjugue_name = '  ' . $procedure_reurb->name_spouse;

          $text_spouse .= ', maior, nacionalidade ' . $procedure_reurb->nationality_spouse . ' ' . $procedure_reurb->profession_spouse . ', filho(a) de ' . $procedure_reurb->mother_name_spouse . ' e ' . $procedure_reurb->father_name_spouse;
          $text_spouse .= ', portador(a)  do RG nº ' . $procedure_reurb->cpf_spouse . ', órgão expedidor ' . $procedure_reurb->consignor_organ_spouse . ', e inscrito(a) no  CPF/MF sob o nº ' . $procedure_reurb->rg_spouse . ', ';
          $text_spouse .= 'residentes e domiciliados na ' . $procedure_reurb->type_street_home . ' ' . $procedure_reurb->public_place_home . ', n° ' . $procedure_reurb->number_home . ', Bairro ' . $procedure_reurb->neighborhood_home . ', ' . $procedure_reurb->city_home . '-' . $procedure_reurb->uf_home . ', CEP ' . $procedure_reurb->cep_home;
        } else {
          $text_requester .= ', residente e domiciliado na ' . $procedure_reurb->type_street_home . ' ' . $procedure_reurb->public_place_home . ', n° ' . $procedure_reurb->number_home . ', Bairro ' . $procedure_reurb->neighborhood_home . ', ' . $procedure_reurb->city_home . '-' . $procedure_reurb->uf_home . ', CEP ' . $procedure_reurb->cep_home;
        }

        if (isset($procedure_reurb->cpf_procurator)) {
          $text_requester = 'nacionalidade ' . $nationality . ', ' . $profession . ', portador(a)  do RG nº ' . $rg . ', órgão expedidor ' . $consignor_organ . ', e inscrito(a) no  CPF sob o nº ' . $cpf . ',
      	residente e domiciliado na ' . $procedure_reurb->type_street_home . ' ' . $procedure_reurb->public_place_home . ', n° ' . $procedure_reurb->number_home . ', Bairro ' . $procedure_reurb->neighborhood_home . ', ' . $procedure_reurb->city_home . '-' . $procedure_reurb->uf_home . ', CEP ' . $procedure_reurb->cep_home;
        }

        $text_tenants = '';
        $document->cloneBlock("block_tenants#". $count, count($tenants), true, true);
        $cont = 0;

        foreach ($tenants as $key => $value) {
          // $cont++;
          if ($value->civil_status == 'Casado(a)') {
            $wedding_date_tenants = date_create($value->wedding_date);;
            $text_tenants = ', nacionalidade ' . $value->nationality . ', ' . $value->profession . ', filho(a) de ' . $value->mother_name . ' e ' . $value->father_name . ', portador(a)  do RG nº ' . $value->rg . ', órgão expedidor ' . $value->consignor_organ . ', e inscrito(a) no  CPF/MF sob o nº ' . $value->cpf . ',
				' . $value->civil_status . ' em ' . date_format($wedding_date_tenants, 'd/m/Y') . ', sob o regime do casamento ' . $value->marriage_regime . ', tendo como cônjugue ' . $value->name_spouse . ', maior, nacionalidade ' . $value->nationality_spouse . ' ' . $value->profession_spouse . ', filho(a) de ' . $value->mother_name_spouse . '  e ' . $value->father_name_spouse . '
				, portador(a)  do RG nº ' . $value->cpf_spouse . ', órgão expedidor ' . $value->consignor_organ_spouse . ', e inscrito(a) no  CPF/MF sob o nº ' . $value->rg_spouse . ',
				 residentes e domiciliados na ' . $value->type_street_home . ' ' . $value->public_place_home . ', n° ' . $value->number_home . ', Bairro ' . $value->neighborhood_home . ', ' . $value->city_home . '-' . $value->uf_home . ', CEP ' . $value->cep_home;
          } else {
            $text_tenants = ',  ' . $value->nationality . ', ' . $value->civil_status . ', ' . $value->profession . ', portador(a)  do RG nº ' . $value->rg . ', órgão expedidor ' . $value->consignor_organ . ', e inscrito(a) no  CPF sob o nº ' . $value->cpf . ',
				filho(a) de ' . $value->mother_name . ' e ' . $value->father_name . ', residentes e domiciliados na ' . $value->type_street_home . ' ' . $value->public_place_home . ', n° ' . $value->number_home . ', Bairro ' . $value->neighborhood_home . ', ' . $value->city_home . '-' . $value->uf_home . ', CEP ' . $value->cep_home;
          }

          $document->setValue('name_tenants#' . $count.'#'.++$cont, 'e ' . $value->legal_name);
          $document->setValue('text_tenants#' . $count.'#'.$cont, $text_tenants);
          // $document->setValue('text_tenants#' . $count.'#'.$cont, $text_tenants);
        }

        $area = 'zero metros';
        if (!empty($procedure_reurb->georeferenced_property_area)) {
          $area = $this->areaPorExtenso($procedure_reurb->georeferenced_property_area);
        }

        $document->setValue("type_property#".$count, $property);

        $document->setValue("city_hall#".$count, ucfirst($city_hall->city));
        $document->setValue("uf_city_hall#".$count, $city_hall->uf);
        $document->setValue("cnpj_city_hall#".$count, $city_hall->cnpj);

        $document->setValue("data_finalizado#".$count, $end_date);
        $document->setValue("data_publicado#".$count, $publication_procedure);

        $document->setValue("address_city_hall#".$count, $city_hall->address . ' ' . $city_hall->public_place);
        $document->setValue("number_city_hall#".$count, $city_hall->number);
        $document->setValue("neighborhood_city_hall#".$count, $city_hall->neighborhood);
        $document->setValue("cep_city_hall#".$count, $city_hall->cep);
        $document->setValue("name_entity#".$count, $city_hall->name_entity);

        $document->setValue("city_block#".$count, $procedure_reurb->city_block);
        $document->setValue("allotment#".$count, $procedure_reurb->allotment);
        $document->setValue("sector#".$count, $procedure_reurb->sector);
        $document->setValue("venal_value#".$count, $venal_value);
        $document->setValue("venal_extenco#".$count, $venal_extenco);
        $document->setValue("data_atual#".$count, $data_atual);
        $document->setValue('furniture_registration#'.$count, $procedure_reurb->furniture_registration);
        $document->setValue('property_registration_number#'.$count, $procedure_reurb->property_registration_number);
        $document->setValue('original_registration#'.$count, $procedure_reurb->original_registration);

        $document->setValue('process_number#'.$count, $procedure_reurb->process_number);

        $document->setValue('stage#'.$count, $procedure_reurb->stage);
        $document->setValue('core_name#'.$count, $procedure_reurb->core_name);
        $document->setValue('original_registration#'.$count, $procedure_reurb->original_registration);
        $document->setValue('name_registry#'.$count, $notary_office->name_registry);
        $document->setValue('uf_notary_office#'.$count, $notary_office->uf);
        $document->setValue('street_property#'.$count, $procedure_reurb->street_property);
        $document->setValue('place_property#'.$count, $procedure_reurb->place_property);
        $document->setValue('number_property#'.$count, $procedure_reurb->number_property);
        $document->setValue('neighborhood_property#'.$count, $procedure_reurb->neighborhood_property);
        $document->setValue('furniture_registration#'.$count, $procedure_reurb->furniture_registration);
        $document->setValue('property_registration_number#'.$count, $procedure_reurb->property_registration_number);
        $document->setValue('original_registration#'.$count, $procedure_reurb->original_registration);
        $document->setValue('city_property#'.$count, $procedure_reurb->city_property);
        $document->setValue('uf_property#'.$count, $procedure_reurb->uf_property);
        $document->setValue('cep_property#' . $count, $procedure_reurb->cep_property);

        $document->setValue("name_requester#" . $count, $name);
        $document->setValue("text_requester#" . $count, $text_requester);
        $document->setValue("conjugue_name#" . $count, $conjugue_name);
        $document->setValue("text_spouse#" . $count, $text_spouse);

        $document->setValue("modality_process#" . $count, $modalidade);
        $document->setValue('modality#'.$count, $procedure_reurb->modality);

        $text_modality_one = 'I.	em caso de imóvel urbano com finalidade não residencial, seja reconhecido pelo poder público o interesse público de sua ocupação.';
        $text_modality_two = '';
        $text_modality_three = '';
        if ($modalidade == 'REURB-S') {
          $text_modality_one = 'I.	o beneficiário não seja concessionário, foreiro ou proprietário de imóvel urbano ou rural;';
          $text_modality_two = 'II.	o beneficiário  não tenha sido contemplado com legitimação de posse ou fundiária de imóvel urbano com a mesma finalidade, ainda que situado em núcleo urbano distinto; e';
          $text_modality_three = 'III.	em caso de imóvel urbano com finalidade não residencial, seja reconhecido pelo poder público o interesse público de sua ocupação.';
        }
        $document->setValue("text_modality_one#" . $count, $text_modality_one);
        $document->setValue("text_modality_two#" . $count, $text_modality_two);
        $document->setValue("text_modality_three#" . $count, $text_modality_three);

        $document->setValue("georeferenced_property_area_extenso#".$count, $area . ' quadrados');
        $document->setValue("georeferenced_property_area#".$count, (empty($procedure_reurb->georeferenced_property_area)) ? '0' : $procedure_reurb->georeferenced_property_area);
      }

      $document->setImageValue('image',  array(
        "path"          => $this->url . 'admin/assets/build/img/profile_city_hall/' . $city_hall->img,
        'width'         => 130,
        'height'        => 130,
      ));
      $document->setImageValue('image_logo', array(
        "path"          => $this->url . 'admin/assets/build/img/profile_city_hall/' . $city_hall->administration_logo,
        'width'         => 130,
        'height'        => 130,
      ));

      $document->setValue("city_hall", strtoupper($city_hall->city));
      $document->setValue("uf_city_hall", $city_hall->uf);
      $document->setValue("cnpj_city_hall", $city_hall->cnpj);

      $document->setValue("address_city_hall", $city_hall->address . ' ' . $city_hall->public_place);
      $document->setValue("number_city_hall", $city_hall->number);
      $document->setValue("neighborhood_city_hall", $city_hall->neighborhood);
      $document->setValue("cep_city_hall", $city_hall->cep);
      $document->setValue("name_entity", $city_hall->name_entity);

      // verificar se está embargado para impedir de ser gerado
      // if ($row->embarkation == '1') {
      //   $error = array();
  		// 	$error['error']['error_string']	= 'Protocolo em embargo, registrado em '.date('d/m/Y \à\s H\h \e i\m\i\n');
  		// 	$error['error']['error_type'] = 'danger'; // Warning | success | danger
  		// 	$this->session->set_flashdata($error);
      //   redirect(base_url().'procedure_reurb/detail/'.$requirement->id_procedure);
      //   exit();
      // }
      $current_date = $this->current_date();
      $file_name = "generateLegitimationTitle".$current_date;
      header("Content-Disposition: attachment; filename=".$file_name.".doc");
      $document->saveAs('php://output');
    }
  }

  public function word_listagem_ocupantes()
  {
    if (isset($_POST['word_listagem_ocupantes'])) {
      \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
      $posts = $this->security->xss_clean($this->input->post());

      $temp_file = $this->uploads_path."word_listagem_ocupantes.docx";
      $document = new TemplateProcessor(FCPATH . 'docs/word_listagem_ocupantes.docx');

      if ($posts['modalidade'] == 'Geral') {
        $modality = 'Geral';
      } else if($posts['modalidade'] == 'REURB-S'){
        $modality = 'REURB-S';
      } else {
        $modality = 'REURB-E';
      }

      $requirements = $this->requesters_model->fetch_requirements_modality($posts['process_number'], $modality);
      $process_number = $this->procedure_reurb_model->fetch_process_number($posts['process_number']);

      $procedure_reurb = $this->procedure_reurb_model->fetch_process_number($posts['process_number']);

      $city_hall = $this->procedure_reurb_model->fetch_city_hall($procedure_reurb->id_entity);
      $entity = $this->entity_model->fetch_entity();
      // var_dump($entity);
      // die;

      $mes = ['meses', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
      foreach ($mes as $key => $value) {
        if (date('n') == $key) {
          $mes_extenso = $value;
        }
      }
      $data['month'] = $mes;
      $data_atual = date('d').' de '.$mes_extenso.' de '.date('Y');

      $document->setValue("city_hall", $city_hall->city);
      $document->setValue("uf_hall", $city_hall->uf);
      $document->setValue("profission_entity", $entity->profission);
      $document->setValue("processing_office", $city_hall->processing_office);

      $document->setValue("process_number", $procedure_reurb->process_number);
      $document->setValue("core_name", $procedure_reurb->core_name);

      $document->setValue("data_atual", $data_atual);

      $document->cloneBlock("block_occupants", count($requirements), true, true);
      $count = 0;
      foreach ($requirements as $row) {
        $count++;
        $name = (isset($row->legal_name)) ? $row->legal_name : $row->company_name;
        $cpf = (isset($row->cpf)) ? $row->cpf : $row->cnpj;

        $document->setValue("name#".$count, $name);
        $document->setValue("cpf#".$count, $cpf);
        $document->setValue("sector#".$count, $row->sector);
        $document->setValue("city_block#".$count, $row->city_block);
        $document->setValue("allotment#".$count, $row->allotment);
        $document->setValue("address#".$count, $row->street_property.' '.$row->place_property.', n° '.$row->number_property);
        $document->setValue("classification_reurb#".$count, $row->classification_reurb);
      }

      // $document->setImageValue('image', 'https://homolog.sisreurb.com.br/admin/assets/build/img/profile_city_hall/'.$city_hall->img);
      // $document->setImageValue('image_logo', 'https://homolog.sisreurb.com.br/admin/assets/build/img/profile_city_hall/'.$city_hall->administration_logo);

      // $entity = $this->entity_model->fetch_entity();

      $document->setImageValue('image', $this->url.'admin/assets/build/img/profile_city_hall/'.$entity->img);
      $document->setValue("entity", $entity->name_entity);
      $document->setValue("uf", $entity->uf);
      $document->setValue("public_place", $entity->public_place);
      $document->setValue("address", $entity->address);
      $document->setValue("number", $entity->number);
      $document->setValue("complement", $entity->complement);
      $document->setValue("neighborhood", $entity->neighborhood);
      $document->setValue("city", $entity->city);
      $document->setValue("phone", $entity->phone);
      $document->setValue("site", $entity->site_entity);
      $document->setValue("name_entity", $entity->name);
      $document->setValue("profission_entity", $entity->profission);

      $current_date = $this->current_date();
      $document->setValue("mayor", $entity->name);
      $uf = $this->conversion_state($entity->uf);
      $document->setValue("city", $entity->city);
      $document->setValue("uf", $uf);
      $document->setValue("uf_single", $uf);
      $document->setValue("today", $current_date);

      $file_name = "word_listagem_ocupantes".$current_date;
      header("Content-Disposition: attachment; filename=".$file_name.".doc");
      $document->saveAs('php://output');
    }
  }

  public function word_indicacao_numerica_unidades()
  {
    if (isset($_POST['word_indicacao_numerica_unidades'])) {
      \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
      $posts = $this->security->xss_clean($this->input->post());

      $temp_file = $this->uploads_path."indicacao_numerica_unidades.docx";
      $document = new TemplateProcessor(FCPATH . 'docs/indicacao_numerica_unidades.docx');

      // if ($posts['modalidade'] == 'Geral') {
      //   $modality = 'Geral';
      // } else if($posts['modalidade'] == 'REURB-S'){
      //   $modality = 'REURB-S';
      // } else {
      //   $modality = 'REURB-E';
      // }

      $procedure_reurb = $this->procedure_reurb_model->fetch_process_number($posts['id_procedure_reurb']);
			$requirements = $this->requesters_model->fetch_requirements_numerical_indication($procedure_reurb->process_number);

      $process_number = $this->procedure_reurb_model->fetch_process_number($procedure_reurb->process_number);

      $city_hall = $this->procedure_reurb_model->fetch_city_hall($procedure_reurb->id_entity);

      $entity = $this->entity_model->fetch_entity();

      $mes = ['meses', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
      foreach ($mes as $key => $value) {
        if (date('n') == $key) {
          $mes_extenso = $value;
        }
      }
      $data['month'] = $mes;
      $data_atual = date('d').' de '.$mes_extenso.' de '.date('Y');

      // $document->setValue("city_hall", $city_hall->city);
      // $document->setValue("uf_hall", $city_hall->uf);
      $document->setValue("profission_entity", $entity->profission);
      $document->setValue("processing_office", $city_hall->processing_office);

      $document->setValue("process_number", $procedure_reurb->process_number);
      $document->setValue("core_name", $procedure_reurb->core_name);

      // $document->setValue("data_atual", $data_atual);

      $document->cloneBlock("block_numerical_indication_units", count($requirements), true, true);
      $count = 0;
      foreach ($requirements as $row) {
        $count++;
        $document->setValue("sector#".$count, $row->sector);
        $document->setValue("city_block#".$count, $row->city_block);
        $document->setValue("allotment#".$count, $row->allotment);
        $document->setValue("area#".$count, $row->georeferenced_property_area);
      }

      // $document->setImageValue('image', 'https://homolog.sisreurb.com.br/admin/assets/build/img/profile_city_hall/'.$city_hall->img);
      // $document->setImageValue('image_logo', 'https://homolog.sisreurb.com.br/admin/assets/build/img/profile_city_hall/'.$city_hall->administration_logo);

      $document->setImageValue('image', $this->url.'admin/assets/build/img/profile_city_hall/'.$entity->img);
      $document->setValue("entity", $entity->name_entity);
      $document->setValue("uf", $entity->uf);
      $document->setValue("public_place", $entity->public_place);
      $document->setValue("address", $entity->address);
      $document->setValue("number", $entity->number);
      $document->setValue("complement", $entity->complement);
      $document->setValue("neighborhood", $entity->neighborhood);
      $document->setValue("city", $entity->city);
      $document->setValue("phone", $entity->phone);
      $document->setValue("site", $entity->site_entity);
      $document->setValue("name_entity", $entity->name);
      $document->setValue("profission_entity", $entity->profission);

      $current_date = $this->current_date();
      $document->setValue("mayor", $entity->name);
      $uf = $this->conversion_state($entity->uf);
      $document->setValue("city", $entity->city);
      $document->setValue("uf", $uf);
      $document->setValue("uf_single", $uf);
      $document->setValue("today", $current_date);

      $file_name = "indicacao_numerica_unidades".$current_date;
      header("Content-Disposition: attachment; filename=".$file_name.".doc");
      $document->saveAs('php://output');
    }
  }

}
