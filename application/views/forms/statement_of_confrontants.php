<?php

require_once 'vendor/autoload.php';

date_default_timezone_set('America/Sao_Paulo');
$dia_atual = date('d-m-Y H:i:s');

$mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'stretch', 'setAutoBottomMargin' => 'stretch']);

$mpdf->SetHTMLHeader('
    <div style="float: left; width: 12%;">
        <img src="'.base_url().'../admin/assets/build/img/profile_city_hall/'.$city_hall->administration_logo.'"/>
    </div>
    <div style="float: right; width: 88%; text-align: center; font-size: 12px; font-weight: bold;">
        <span>MUNICIPIO DE '.$city_hall->name.'</span><br>
        <span>ESTADO DE '.$city_hall->uf.' - CNPJ '.$city_hall->cnpj.'</span><br>
        <span>'.$city_hall->address.' '.$city_hall->public_place.', '.$city_hall->number.' - '.$city_hall->neighborhood.' - '.$city_hall->city.' - '.$city_hall->uf.', CEP: '.$city_hall->cep.'</span><br><br>
        <span>REGULARIZAÇÃO FUNDIÁRIA URBANA - REURB -ETAPA '.$requirement->stage.'</span><br>
    </div>
');
$name = (isset($requirement->company_name)) ? $requirement->company_name : $requirement->legal_name;
$html = '<div>
    <h4 style="text-align: center; text-decoration: underline;">DECLARAÇÃO DE CONFRONTANTES</h4>
</div>
<div>
    <p style="font-size: small;">&emsp; &emsp; &emsp; Nós abaixo assinados, na qualidade de confrontante do Sr.(a) <span style="text-decoration: underline; font-weight: bold;">'.$name.'</span>, DECLARAMOS para os devidos fins junto a Comissão Municipal de Regularização Fundiária Urbana do Municipio de Montezuma, no âmbito de Processo de Regularização Fundiária Urbana de Interesse Social - '.$requirement->modality.' sob as penas da lei, que conhecemos o referido senhor(a) e que o(a) mesmo(a) é legítimo(a) possuidor(a) do imóvel abaixo identificado, exercendo a posse de forma mansa, pacífica,
    continua e sem oposição de um lote urbano situado na à <span style="text-decoration: underline; font-weight: bold;">'.$requirement->street_property.' '.$requirement->place_property.', n° '.$requirement->number_property.', '.$requirement->neighborhood_property.', inserido no Cadastro imobiliário n° '.$requirement->furniture_registration.' no Setor '.$requirement->sector.', Quadra '.$requirement->city_block.',
    Lote '.$requirement->allotment.',</span> com área aproximada de <span style="text-decoration: underline; font-weight: bold;">m² '.$requirement->georeferenced_property_area.'.</span> Declaramos, ainda, estar em pleno acordo com a medição realizada em nome do(a) mesmo(a), e por ser vedade, para surta os seus efeitos legais, firmamos a presente.</p>
</div>
<div>
    <span style="text-align: left; text-decoration: underline; font-weight: bold;">CONFRONTANTES / VIZINHOS</span>
</div>';
$cont = 0;
foreach ($confrotants_property as $row):
  $cont++;
  $date = date_create($row->birth_date);
           $html .='<table style="width:100%; border: 1px solid white; border-collapse: collapse;">
                 <tr style="border-right: 1px solid white; border-collapse: collapse;">
                   <td style="border: 1px solid #000; font-size: small;" colspan="8">
                       <p>'.$cont.' - Nome: '.$row->name.'</p>
                   </td>
                   <td style="border: 1px solid #fff; border-right: 1px solid #000; border-top: 1px solid #000; text-align: center; font-size: 9px; margin-left: 10px;" colspan="4">
                       <span style="font-size: 12px; text-align: right; display: block;">POLEGAR DIREITO</span>
                       <p>(caso não assine)</p>
                   </td>
               </tr>
               <tr style="border-right: 1px solid white; border-collapse: collapse;">
                   <td style="border: 1px solid #000; font-size: small;" colspan="3">
                       <p>CPF: '.$row->cpf.'</p>
                   </td>
                   <td style="border: 1px solid #000; padding: 5px 0; font-size: small;" colspan="3">
                       <p>Data nascimento: '.date_format($date, 'd/m/Y').'</p><br>
                   </td>
                   <td style="border: 1px solid #000; padding: 5px 5px; font-size: small;" colspan="2">
                       <p>Confrontação: <br>'.$row->confrontation_direction.'</p>
                   </td>
                   <td style="border: 1px solid #fff; border-right: 1px solid #000; text-align: center; font-size: 10px;" colspan="4">
                       <p>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</p>
                   </td>
               </tr>
               <tr style="border-right: 1px solid white; border-collapse: collapse;">
                   <td style="border: 1px solid #000; border-bottom: 1px solid #FFF; border-right: 1px solid white; font-size: small;" colspan="5">
                       <p>Declarante '.$cont.': ________________________________________.</p>
                   </td>
                   <td style="border: 1px solid #000; border-bottom: 1px solid #FFF; border-left: 1px solid #FFF; padding: 5px 0; font-size: small;" colspan="3">
                       <p>Em ______/______/_______.</p>
                   </td>
                   <td style="border: 1px solid #fff; border-right: 1px solid #000; text-align: center; font-size: 10px;" colspan="4">
                       <p>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</p>
                   </td>
               </tr>
               <tr style="border-right: 1px solid white; border-collapse: collapse;">
                   <td style="border: 1px solid #000; border-right: 1px solid white; border-top: 1px solid white; font-size: small; text-align: center;" colspan="5">
                       <span>Assinatura.</span>
                   </td>
                   <td style="border: 1px solid #000; border-top: 1px solid #FFF; border-left: 1px solid #FFF; padding: 5px 0; font-size: small;" colspan="3">
                       <p></p>
                   </td>
                   <td style="border: 1px solid #fff; border-bottom: 1px solid #000; border-right: 1px solid #000; text-align: center; font-size: 10px;" colspan="4">
                       <p>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</p>
                   </td>
               </tr>
               </table>
               <a>&emsp;</a>';
    endforeach;

    $mpdf->WriteHTML($html);

ob_clean();
$mpdf->Output();

?>
