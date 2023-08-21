<?php

require_once 'vendor/autoload.php';

date_default_timezone_set('America/Sao_Paulo');
$dia_atual = date('d-m-Y H:i:s');

$mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'false', 'setAutoBottomMargin' => 'false']);

$mpdf->SetHTMLHeader('

');
$name = (isset($procedure_reurb->legal_name))? $procedure_reurb->legal_name : $procedure_reurb->name_procurator;
$cpf = (isset($procedure_reurb->cpf))? $procedure_reurb->cpf : $procedure_reurb->cpf_procurator;
$rg = (isset($procedure_reurb->rg))? $procedure_reurb->rg : $procedure_reurb->rg_procurator;
$nationality = (isset($procedure_reurb->nationality))? $procedure_reurb->nationality : $procedure_reurb->country_procurator;
$profession = (isset($procedure_reurb->profession))? $procedure_reurb->profession : $procedure_reurb->profission_procurator;
// $mother_name = (isset($procedure_reurb->mother_name))? $procedure_reurb->mother_name : $procedure_reurb->profission_procurator;
// $father_name = (isset($procedure_reurb->father_name))? $procedure_reurb->father_name : $procedure_reurb->profission_procurator;
$consignor_organ = (isset($procedure_reurb->consignor_organ))? $procedure_reurb->consignor_organ : $procedure_reurb->consignor_organ_procurator;
// $civil_status = (isset($procedure_reurb->civil_status))? $procedure_reurb->civil_status : $procedure_reurb->consignor_organ_procurator;
// $marriage_regime = (isset($procedure_reurb->marriage_regime))? $procedure_reurb->marriage_regime : $procedure_reurb->consignor_organ_procurator;

// name_spouse
// nationality_spouse
// profession_spouse
// mother_name_spouse
// father_name_spouse
// rg_spouse
// consignor_organ_spouse
// cpf_spouse

$wedding_date = date_create($procedure_reurb->wedding_date);
$end_date_procedure = date_create($procedure_reurb->end_date);;
$publication_procedure_procedure = date_create($procedure_reurb->publication_procedure);;
$wedding_date = date_create($procedure_reurb->wedding_date);;

foreach ($month as $key => $value) {
	if (date_format($end_date_procedure, 'n') == $key) { $end_date_extenso = $value; }
	if (date_format($publication_procedure_procedure, 'n') == $key) { $publication_procedure_extenso = $value; }
}
$end_date = date_format($end_date_procedure, 'd').' de '.$end_date_extenso.' de '.date_format($end_date_procedure, 'Y');
$publication_procedure = date_format($publication_procedure_procedure, 'd').' de '.$publication_procedure_extenso.' de '.date_format($publication_procedure_procedure, 'Y');


$beneficiario = 'BENEFICIÁRIO(A): <strong>'.$name.'</strong>,  '.$nationality.', '.$procedure_reurb->civil_status.', '.$profession.', portador(a)  do RG nº '.$rg.', órgão expedidor '.$consignor_organ.', e inscrito(a) no  CPF sob o nº '.$cpf.',
filho(a) de '.$procedure_reurb->mother_name.' e '.$procedure_reurb->father_name.', residentes e domiciliados na '.$procedure_reurb->type_street_home.' '.$procedure_reurb->public_place_home.', n° '.$procedure_reurb->number_home.', Bairro '.$procedure_reurb->neighborhood_home.', '.$procedure_reurb->city_home.'-'.$procedure_reurb->uf_home.', CEP '.$procedure_reurb->cep_home.', e ';

if($procedure_reurb->civil_status == 'Casado(a)'){
	$beneficiario = 'BENEFICIÁRIO(A): <strong>'.$name.'</strong>, nacionalidade '.$nationality.', '.$profession.', filho(a) de '.$procedure_reurb->mother_name.' e '.$procedure_reurb->father_name.', portador(a)  do RG nº '.$rg.', órgão expedidor '.$consignor_organ.', e inscrito(a) no  CPF/MF sob o nº '.$cpf.',
	'.$procedure_reurb->civil_status.' em '.date_format($wedding_date, 'd/m/Y').', sob o regime do casamento '.$procedure_reurb->marriage_regime.', tendo como cônjugue '.$procedure_reurb->name_spouse.', maior, nacionalidade '.$procedure_reurb->nationality_spouse.' '.$procedure_reurb->profession_spouse.', filho(a) de '.$procedure_reurb->mother_name_spouse.'  e '.$procedure_reurb->father_name_spouse.'
	, portador(a)  do RG nº '.$procedure_reurb->cpf_spouse.', órgão expedidor '.$procedure_reurb->consignor_organ_spouse.', e inscrito(a) no  CPF/MF sob o nº '.$procedure_reurb->rg_spouse.',
	 residentes e domiciliados na '.$procedure_reurb->type_street_home.' '.$procedure_reurb->public_place_home.', n° '.$procedure_reurb->number_home.', Bairro '.$procedure_reurb->neighborhood_home.', '.$procedure_reurb->city_home.'-'.$procedure_reurb->uf_home.', CEP '.$procedure_reurb->cep_home.', e ';
}

if (isset($procedure_reurb->cpf_procurator)) {
	$beneficiario = 'BENEFICIÁRIO(A): <strong>'.$name.'</strong>,  '.$nationality.', '.$profession.', portador(a)  do RG nº '.$rg.', órgão expedidor '.$consignor_organ.', e inscrito(a) no  CPF sob o nº '.$cpf.',
	residente e domiciliado na '.$procedure_reurb->type_street_home.' '.$procedure_reurb->public_place_home.', n° '.$procedure_reurb->number_home.', Bairro '.$procedure_reurb->neighborhood_home.', '.$procedure_reurb->city_home.'-'.$procedure_reurb->uf_home.', CEP '.$procedure_reurb->cep_home;
}

if ($procedure_reurb->type_property == 'público') {
	$property = '( X ) Imóvel público  ( &emsp; ) imóvel privado';
} else {
	$property = '( &emsp; ) Imóvel público  ( X ) imóvel privado';
}

$html = '
<div style="margin: 0 auto; padding-top: 0px; width: 95%;">
	<div style="text-align: justify;">
		<div style="text-align: center;">
				<h3>TÍTULO DE LEGITIMAÇÃO FUNDIÁRIA URBANA INDIVIDUAL – '.$_POST['modalidade'].'</h3>
		</div>
		<p style="font-size: 16px;">Procedimento nº '.$procedure_reurb->process_number.' – ETAPA '.$procedure_reurb->stage.' - '.$procedure_reurb->core_name.'
			<br>
      Matrícula/transcrição originária: '.$procedure_reurb->original_registration.' – '.$notary_office->name_registry.' – '.$notary_office->uf.'
      <br>
      <br>
      '.$property.'
		</p>

		<p style="font-size: 16px;">A prefeita  municipal de '.$city_hall->city.' - '.$city_hall->uf.', nos termos da decisão do procedimento de Regularização Fundiária Urbana de Interesse Social - '.$_POST['modalidade'].', decorrente do Procedimento Administrativo em epígrafe, em sua ETAPA '.$procedure_reurb->stage.',finalizado em '.$end_date.'  e publicado em '.$publication_procedure.', CONCEDE o presente <strong>TÍTULO DE LEGITIMAÇÃO FUNDIÁRIA URBANA</strong>,   do imóvel caracterizado neste Título ao(s) beneficiário(os),  qualificado(os) abaixo:</p>

		<p style="font-size: 16px;">IMÓVEL: LOTE: '.$procedure_reurb->allotment.', QUADRA: '.$procedure_reurb->city_block.',  SETOR: '.$procedure_reurb->sector.', com área de '.$procedure_reurb->georeferenced_property_area.' m²,  situado no Município de '.$procedure_reurb->city_property.' - '.$procedure_reurb->uf_property.',
		 localizado na '.$procedure_reurb->street_property.' '.$procedure_reurb->place_property.', n° '.$procedure_reurb->number_property.', Bairro '.$procedure_reurb->neighborhood_property.',  cadastrado no Município sob o nº '.$procedure_reurb->furniture_registration.', registrado sob a matrícula nº '.$procedure_reurb->property_registration_number.'  , Livro 2-RG, fls. 01,  registro anterior matrícula n° '.$procedure_reurb->original_registration.', de titularidade do Município de '.$city_hall->city.', ambas do Cartório de Registro de Imóveis desta Comarca.</p>
		';
		$html .= '<p style="font-size: 16px;">'.$beneficiario.'';

		foreach ($tenants as $key => $value) {
			if ($value->civil_status == 'Casado(a)') {
				$wedding_date_tenants = date_create($value->wedding_date);;
				$html .= ' <strong>'.$value->legal_name.'</strong>, nacionalidade '.$value->nationality.', '.$value->profession.', filho(a) de '.$value->mother_name.' e '.$value->father_name.', portador(a)  do RG nº '.$value->rg.', órgão expedidor '.$value->consignor_organ.', e inscrito(a) no  CPF/MF sob o nº '.$value->cpf.',
				'.$value->civil_status.' em '.date_format($wedding_date_tenants, 'd/m/Y').', sob o regime do casamento '.$value->marriage_regime.', tendo como cônjugue '.$value->name_spouse.', maior, nacionalidade '.$value->nationality_spouse.' '.$value->profession_spouse.', filho(a) de '.$value->mother_name_spouse.'  e '.$value->father_name_spouse.'
				, portador(a)  do RG nº '.$value->cpf_spouse.', órgão expedidor '.$value->consignor_organ_spouse.', e inscrito(a) no  CPF/MF sob o nº '.$value->rg_spouse.',
				 residentes e domiciliados na '.$value->type_street_home.' '.$value->public_place_home.', n° '.$value->number_home.', Bairro '.$value->neighborhood_home.', '.$value->city_home.'-'.$value->uf_home.', CEP '.$value->cep_home.'</p>';
			} else {
				$html .= '<strong>'.$value->legal_name.'</strong>,  '.$value->nationality.', '.$value->civil_status.', '.$value->profession.', portador(a)  do RG nº '.$value->rg.', órgão expedidor '.$value->consignor_organ.', e inscrito(a) no  CPF sob o nº '.$value->cpf.',
				filho(a) de '.$value->mother_name.' e '.$value->father_name.', residentes e domiciliados na '.$value->type_street_home.' '.$value->public_place_home.', n° '.$value->number_home.', Bairro '.$value->neighborhood_home.', '.$value->city_home.'-'.$value->uf_home.', CEP '.$value->cep_home.'</p>';
			}
		}

		$html .= '<p style="font-size: 16px;">O presente título constitui forma originária de aquisição do direito real de propriedade conferido por ato do poder público em favor daquele que detive em área pública ou possuir em área privada, como sua, unidade imobiliária com destinação urbana, integrante de núcleo urbano informal consolidado existente em 22 de dezembro de 2016. A unidade imobiliária ficará livre e desembaraçada de quaisquer ônus, direitos reais, gravames ou inscrições, eventualmente 		existentes em sua matrícula de origem, exceto quando disserem respeito ao próprio legitimado, nos termos do art. 23 da Lei n° 13.465/2.017.</p>

		<p style="font-size: 16px;">Atribui-se ao imóvel o valor de R$'.number_format($venal, 2, ',', '.').' ('.$venal_extenco.').</p>

		<p style="font-size: 16px; text-align: center; margin-bottom: 30px;">'.$city_hall->city.'-'.$city_hall->uf.', '.$data_atual.'</p>

		<p style="text-align: center;">'.$city_hall->name.'
      <br>
      Prefeito(a) Municipal '.$city_hall->city.'
    </p>
	</div>
</div>
';

$mpdf->WriteHTML($html);
ob_clean();
$mpdf->Output();
