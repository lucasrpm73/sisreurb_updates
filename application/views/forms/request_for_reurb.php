<?php

require_once 'vendor/autoload.php';

date_default_timezone_set('America/Sao_Paulo');
$dia_atual = date('d-m-Y H:i:s');

$mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'stretch', 'setAutoBottomMargin' => 'stretch']);

$people_type = ($requirement->people_type == '1')? 'Fisica': 'Jurídica';
$name = (isset($requirement->legal_name))? $requirement->legal_name: $requirement->name_procurator;
$nationality = (isset($requirement->nationality))? $requirement->nationality: $requirement->country_procurator;
$profession = (isset($requirement->profession))? $requirement->profession: $requirement->profission_procurator;
$cpf = (isset($requirement->cpf))? $requirement->cpf: $requirement->cpf_procurator;
$rg = (isset($requirement->rg))? $requirement->rg: $requirement->rg_procurator;
$consignor_organ = (isset($requirement->consignor_organ))? $requirement->consignor_organ: $requirement->consignor_organ_procurator;
$civil_status = (isset($requirement->civil_status))? $requirement->civil_status: $requirement->civil_status;
$mother_name = (isset($requirement->mother_name))? $requirement->mother_name: $requirement->mother_name;
$father_name = (isset($requirement->father_name))? $requirement->father_name: $requirement->father_name;
$email = (isset($requirement->legal_email))? $requirement->legal_email: $requirement->procurator_email;
$phone = (isset($requirement->legal_phone))? $requirement->legal_phone: $requirement->phone_procurator;

if ($monthly_income_total > $maximum_income['maximum_family_income'] || $requirement->property_owner == '1'){
  $type = '<td style="border: 1px solid #000" colspan="2">(&emsp;) REURB-S</td>
            <td style="border: 1px solid #000" colspan="3">(X) REURB-E</td>';
} else {
  $type = '<td style="border: 1px solid #000" colspan="2">(X) REURB-S</td>
          <td style="border: 1px solid #000" colspan="3">(&emsp;) REURB-E</td>';
}

if ($requirement->basic_infrastructure == '1') {
  $infraestrura = '<td style="border: 1px solid #000" colspan="2">(X) SIM</td>
  <td style="border: 1px solid #000" colspan="1">(&emsp;) NÃO</td>
  <td style="border: 1px solid #000" colspan="2">(&emsp;) PARCIAL</td>';
} else {
  $infraestrura = '<td style="border: 1px solid #000" colspan="2">(&emsp;) SIM</td>
  <td style="border: 1px solid #000" colspan="1">(X) NÃO</td>
  <td style="border: 1px solid #000" colspan="2">(&emsp;) PARCIAL</td>';
}

if ($requirement->type_property == 'Residencial') {
  $type_property = '<td style="border: 1px solid #000" colspan="1">( X ) Residencial</td>
  <td style="border: 1px solid #000" colspan="2">(&emsp;) Comercial&emsp;&emsp;</td>
  <td style="border: 1px solid #000" colspan="2">(&emsp;) Misto Residencial/Comercial&emsp;&emsp;</td>';

} else if($requirement->type_property == 'Comercial') {
  $type_property = '<td style="border: 1px solid #000" colspan="1">(&emsp;) Residencial</td>
  <td style="border: 1px solid #000" colspan="2">( X ) Comercial&emsp;&emsp;</td>
  <td style="border: 1px solid #000" colspan="2">(&emsp;) Misto Residencial/Comercial&emsp;&emsp;</td>';

} else {
  $type_property = '<td style="border: 1px solid #000" colspan="1">(&emsp;) Residencial</td>
  <td style="border: 1px solid #000" colspan="2">(&emsp;) Comercial&emsp;&emsp;</td>
  <td style="border: 1px solid #000" colspan="2">( X ) Misto Residencial/Comercial&emsp;&emsp;</td>';

}

if ($requirement->unit_situation == 'Construída') {
  $unit_situation = '<td style="border: 1px solid #000" colspan="1">( X ) Construída&emsp;&emsp;</td>
  <td style="border: 1px solid #000" colspan="2">(&emsp;) Em construção</td>
  <td style="border: 1px solid #000" colspan="2">(&emsp;) Lote Vago&emsp;&emsp;</td>';
} else if($requirement->unit_situation == 'Em construção') {
  $unit_situation = '<td style="border: 1px solid #000" colspan="1">(&emsp;) Construída&emsp;&emsp;</td>
  <td style="border: 1px solid #000" colspan="2">( X ) Em construção</td>
  <td style="border: 1px solid #000" colspan="2">(&emsp;) Lote Vago&emsp;&emsp;</td>';
} else {
  $unit_situation = '<td style="border: 1px solid #000" colspan="1">(&emsp;) Construída&emsp;&emsp;</td>
  <td style="border: 1px solid #000" colspan="2">(&emsp;) Em construção</td>
  <td style="border: 1px solid #000" colspan="2">( X ) Lote Vago&emsp;&emsp;</td>';
}

$mpdf->SetHTMLHeader('
    <div style="float: left; width: 10%;">
        <img src="'.base_url().'../admin/assets/build/img/profile_city_hall/'.$city_hall->administration_logo.'"/>
    </div>
    <div style="float: right; width: 88%; text-align: center; font-size: 12px; font-weight: bold;">
        <span>MUNICIPIO DE '.$city_hall->name.'</span><br>
        <span>ESTADO DE '.$city_hall->uf.' - CNPJ '.$city_hall->cnpj.'</span><br>
        <span>'.$city_hall->address.' '.$city_hall->public_place.', '.$city_hall->number.' - '.$city_hall->neighborhood.' - '.$city_hall->city.' - '.$city_hall->uf.', CEP: '.$city_hall->cep.'</span><br><br>
        <span>REGULARIZAÇÃO FUNDIÁRIA URBANA - REURB -ETAPA '.$requirement->stage.'</span><br>
    </div>
');

$html = '

<style>

    td, th {
        font-size: 12px;
    }

</style>

<div>
    <h4 style="text-align: center; text-decoration: underline;">REQUERIMENTO PARA REURB</h4>
</div>
<div>
    <span style="text-align: left; font-weight: bold; font-size: x-small;">Excelentíssimo Senhor</span>
</div>
<div>
    <span style="text-align: left; font-weight: bold; font-size: x-small;">'.$city_hall->name.'</span>
</div>
<div>
    <span style="text-align: left; font-weight: bold; font-size: x-small;">Prefeito Municipal de '.$city_hall->city.'</span>
</div>
<div style="padding-bottom: 8px;">
    <span style="text-align: left; font-weight: bold; font-size: x-small;">Nesta Cidade</span>
</div>

<table style="width:100%; border: 1px solid #FFF; border-collapse: collapse;">

    <tr style="font-size: small; border: 1px solid #000">
        <th style="background-color: #DCDCDC;" colspan="6">QUALIFICAÇÃO DO REQUERENTE/LEGITIMADO</th>
    </tr>
    <tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="1">Natureza:</td>
        <td style="font-weight: bold" colspan="5">'.$people_type.'</td>
    </tr>
    <tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="1">Nome:</td>
        <td style="font-weight: bold" colspan="5">'.$name.'</td>
    </tr>
    <tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="2">Nacionalidade: <b>'.$nationality.'</b></td>
        <td style="border: 1px solid #000" colspan="2">Est. Civil: <b>'.$civil_status.'</b></td>
        <td style="border: 1px solid #000" colspan="2">Profissão: <b>'.$profession.'</b></td>
    </tr>
    <tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="2">CPF(PF): <b>'.$cpf.'</b></td>
        <td style="border: 1px solid #000" colspan="2">CI/RG: <b>'.$rg.'</b></td>
        <td style="border: 1px solid #000" colspan="2">Órgáo exp.:<b>'.$consignor_organ.'</b></td>
    </tr>
    <tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="2">Filiação:</td>
        <td style="border: 1px solid #000" colspan="2">Mãe:<b>'.$mother_name.'</b></td>
        <td style="border: 1px solid #000" colspan="2">Pai:<b>'.$father_name.'</b></td>
    </tr>
</table>

<table style="width:100%; border: 1px solid #FFF; border-collapse: collapse;">
    <tr style="font-size: small; border: 1px solid #000">
        <th style="background-color: #DCDCDC;" colspan="6">Endereço Residencial</th>
    </tr>
    <tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="2">Logradouro: <b>'.$requirement->type_street_home.' '.$requirement->public_place_home.'</b></td>
        <td style="border: 1px solid #000" colspan="4">N°: <b>'.$requirement->number_home.'</b></td>
    </tr>
    <tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="2">Bairro: <b>'.$requirement->neighborhood_home.'</b></td>
        <td style="border: 1px solid #000" colspan="4">CEP: <b>'.$requirement->cep_home.'</b></td>
    </tr>
    <tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="2">Cidade: <b>'.$requirement->city_home.'</b></td>
        <td style="border: 1px solid #000" colspan="4">UF: <b>'.$requirement->uf_home.'</b></td>
    </tr>
    <tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="2">Telefone: <b>'.$email.'</b></td>
        <td style="border: 1px solid #000" colspan="4">E-mail: <b>'.$phone.'</b></td>
    </tr>

</table>

<div>
    <small>&emsp;</small>
</div>

<table style="width:100%; border: 1px solid #FFF; border-collapse: collapse;">
    <tr style="font-size: small; border: 1px solid #000">
        <th style="background-color: #DCDCDC;" colspan="6">IDENTIFICAÇÃO DO IMÓVEL REQUERIDO PARA LEGITIMAÇÃO</th>
    </tr>
    <tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="1">Tipo de imóvel:&emsp;&emsp;</td>
        '.$type_property.'
    </tr>
    <tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="1">Situação da unidade:</td>
        '.$unit_situation.'
    </tr>
    <tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="6">Área Requerida: <b>'.$requirement->georeferenced_property_area.'m²</b></td>
    </tr>
    <tr style="font-size: small; border: 1px solid #fff; border-top: 1px solid #000">
        <td style="border: 1px solid #fff; border-top: 1px solid #000" colspan="6">&emsp;</td>
    </tr>

    <tr style="font-size: small; border: 1px solid #000">
        <th style="background-color: #DCDCDC;" colspan="6">Localização</th>
    </tr>
    <tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="2">Logradouro: <b>'.$requirement->street_property.' '.$requirement->place_property.'</b></td>
        <td style="border: 1px solid #000" colspan="2">N°: <b>'.$requirement->number_property.'</b></td>
        <td style="border: 1px solid #000" colspan="2">Bairro: <b>'.$requirement->neighborhood_property.'</b></td>
    </tr>
    <tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="3">Cidade: <b>'.$requirement->city_property.'</b></td>
        <td style="border: 1px solid #000" colspan="3">CEP:: <b>'.$requirement->cep_property.'</b></td>
    </tr>
</table>

<div>
    <small>&emsp;</small>
</div>

<table style="width:100%; border: 1px solid #FFF; border-collapse: collapse;">
    <tr style="font-size: small; border: 1px solid #000">
        <th style="background-color: #DCDCDC;" colspan="6">IDENTIFICAÇÃO DO NÚCLEO URBANO INFORMAL</th>
    </tr>
    <tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="1">Tipo:</td>
        '.$type.'
    </tr>
    <tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="1">Nome do núcleo: </td>
        <td style="border: 1px solid #000" colspan="5">'.$requirement->core_name.'</td>
    </tr>
    <tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="1">Matrícula:</td>
        <td style="border: 1px solid #000" colspan="5">'.$requirement->original_registration.'</td>
    </tr>
    <tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="1">Beneficiário(s):</td>
        <td style="border: 1px solid #000" colspan="5">(X) Individual</td>
    </tr>
    <tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="1">Infraestrutura Essencial:</td>
        '.$infraestrura.'
    </tr>
</table>

<div>
    <small>&emsp;</small>
</div>

<table style="width:100%; border: 1px solid #FFF; border-collapse: collapse;">
    <tr style="font-size: small; border: 1px solid #000">
        <th style="background-color: #DCDCDC;" colspan="6">ANEXAÇÃO DE DOCUMENTOS</th>
    </tr>';

    foreach ($files_checklist as $row) {
      $html .= '<tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="6">( X ) '.$row->description.'</td>
      </tr>';
    }

    foreach ($checklist_not_send as $row) {
      $html .= '<tr style="font-size: small; border: 1px solid #000">
        <td style="border: 1px solid #000" colspan="6">(&emsp;) '.$row->description.'</td>
      </tr>';
    }

    $html .= '</table>

<div>
    <small>&emsp;</small>
</div>

<table style="width:100%; border: 1px solid #FFF; border-collapse: collapse;">
    <tr style="font-size: small; border: 1px solid #000">
        <th style="background-color: #DCDCDC;" colspan="6">REQUERIMENTO</th>
    </tr>
    <tr style="font-size: small; border: 1px solid #000; border-bottom: 1px solid #FFF;">
        <td style="border: 1px solid #000; border-bottom: 1px solid #FFF;" colspan="6">
        <p>&emsp;&emsp;O(A) requerente(s) acima qualificado(a) requer de Vossa Excelência a aprovação do parcelamento do solo através da REURB-S - Regularização Fundiária Urbana de Interesse Social, com base na Lei Federal n° 9.310, de 15/03/2018.</p>
        </td>
    </tr>
    <tr style="font-size: small; border: 1px solid #000; border-top: 1px solid #FFF;">
        <td style="border: 1px solid #000; border-top: 1px solid #FFF; text-align: center" colspan="6">
        <p>Termos em que pede e aguarda deferimento</p>
        </td>
    </tr>
</table>

<div>
    <small>&emsp;</small>
</div>

<div style="width: 66%; float: left">
    <table style="width:100%; border: 1px solid #FFF; border-collapse: collapse;">
        <tr style="font-size: small; border: 1px solid #000">
            <th style="background-color: #DCDCDC;" colspan="6">LOCAL, DATA E ASSINATURA</th>
        </tr>
        <tr style="font-size: small; border: 1px solid #000">
            <td style="border: 1px solid #000; text-align: center" colspan="2">Local e data</td>
            <td style="border: 1px solid #000; text-align: center" colspan="4">Assinatura do requerente ou seu representante legal</td>
        </tr>
        <tr style="font-size: small; border: 1px solid #000; border-bottom: 1px solid #FFF;">
            <td style="border: 1px solid #000" colspan="2"><b>'.$city_hall->city.'-'.$city_hall->uf.', em</b></td>
            <td style="border: 1px solid #000" colspan="4">&emsp;</td>
        </tr>
        <tr style="font-size: small; border: 1px solid #000; border-bottom: 1px solid #FFF; border-top: 1px solid #FFF;">
            <td style="border: 1px solid #000" colspan="2">&emsp;</td>
            <td style="border: 1px solid #000; text-align: center;" colspan="4">____________________________________________</td>
        </tr>
        <tr style="font-size: small; border: 1px solid #000; border-top: 1px solid #FFF;">
            <td style="border: 1px solid #000; text-align: center; font-weight: bold;" colspan="2">'.date('d/m/Y').'</td>
            <td style="border: 1px solid #000" colspan="4">&emsp;</td>
        </tr>
    </table>
</div>

<div style="width: 31%; float: right; position: relative;">
    <table style="width:100%; border: 1px solid #FFF; border-collapse: collapse;">
        <tr style="font-size: small; border: 1px solid #000">
            <th style="background-color: #DCDCDC;" colspan="6">6- Protocolo</th>
        </tr>
        <tr style="font-size: small; border: 1px solid #000; border-bottom: 1px solid #FFF;">
            <td style="border: 1px solid #000" colspan="6">&emsp;</td>
        </tr>
        <tr style="font-size: small; border: 1px solid #000; border-bottom: 1px solid #FFF; border-top: 1px solid #FFF;">
            <td style="border: 1px solid #000" colspan="6">&emsp;</td>
        </tr>
        <tr style="font-size: small; border: 1px solid #000; border-bottom: 1px solid #FFF; border-top: 1px solid #FFF;">
            <td style="border: 1px solid #000" colspan="6">&emsp;</td>
        </tr>
        <tr style="font-size: small; border: 1px solid #000; border-top: 1px solid #FFF;">
            <td style="border: 1px solid #000" colspan="6">&emsp;</td>
        </tr>
    </table>
</div>
';

$mpdf->WriteHTML($html);
ob_clean();
$mpdf->Output();

?>
